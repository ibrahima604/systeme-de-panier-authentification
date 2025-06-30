<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commande;
use App\Models\LigneCommande;
use App\Models\Article;
use App\Models\User;
use Carbon\Carbon;
use App\Mail\CommandeStatusChangedMail;
use Illuminate\Support\Facades\Mail;
use App\Mail\AdminSupprimeeCommandeMail;


class AdminCommandeController extends Controller
{
    public function index(Request $request)
    {
        $query = Commande::with(['user', 'lignes.article'])
    ->whereHas('user', function ($q) {
        $q->whereNull('deleted_at'); // Ne garder que les utilisateurs non supprimés
    });


        // Filtres
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        if ($request->has('date')) {
            $date = Carbon::now();

            switch ($request->date) {
                case 'today':
                    $query->whereDate('created_at', $date->today());
                    break;
                case 'week':
                    $query->whereBetween('created_at', [$date->startOfWeek(), $date->endOfWeek()]);
                    break;
                case 'month':
                    $query->whereMonth('created_at', $date->month);
                    break;
                case 'year':
                    $query->whereYear('created_at', $date->year);
                    break;
            }
        }

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->whereHas('user', function($q) use ($search) {
                    $q->where('nom', 'like', "%{$search}%")
                      ->orWhere('prenom', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%");
                })
                ->orWhere('id', 'like', "%{$search}%");
            });
        }

        $commandes = $query->paginate(10);

        // Calcul des totaux
        foreach ($commandes as $commande) {
            $total = 0;
            foreach ($commande->lignes as $ligne) {
                $total += $ligne->prix * $ligne->quantite_commande;
            }
            $commande->total = $total;
        }

        // Statistiques
        $stats = [
            'commandesAujourdhui' => Commande::whereDate('created_at', Carbon::today())->count(),
            'commandesEnAttente' => Commande::where('status', 'en attente')->count(),
            'commandesEnCours' => Commande::where('status', 'en cours')->count(),
            'caMois' => Commande::whereMonth('created_at', Carbon::now()->month)
                ->with('lignes')
                ->get()
                ->sum(function($commande) {
                    return $commande->lignes->sum(function($ligne) {
                        return $ligne->prix * $ligne->quantite_commande;
                    });
                })
        ];

        return view('admin.commandes.commande_admin', compact('commandes', 'stats'));
    }

    public function show($id)
    {
        $commande = Commande::with(['user', 'lignes.article'])->findOrFail($id);

        $total = 0;
        foreach ($commande->lignes as $ligne) {
            $total += $ligne->prix * $ligne->quantite_commande;
        }
        $commande->total = $total;

        return view('admin.commandes.show', compact('commande'));
    }

    public function update(Request $request, $id)
    {
        $commande = Commande::findOrFail($id);
        $commande->status = $request->status;
        $commande->save();
        

        return back()->with('success', 'Statut de la commande mis à jour');
    }

   public function destroy($id)
{
    $commande = Commande::findOrFail($id);

    // Récupérer l'utilisateur avant suppression
    $user = $commande->user;

    // Envoie de l'email
    Mail::to($user->email)->send(new AdminSupprimeeCommandeMail($commande));

    // Suppression de la commande
    $commande->delete();

    return back()->with('success', 'Commande supprimée avec succès et email envoyé.');
}
   public function updateStatus(Request $request, Commande $commande)
{
    $request->validate([
        'status' => 'required|in:en attente,en cours,expédiée,livrée',
    ]);

    $ancienStatus = $commande->status;
    $nouveauStatus = $request->input('status');
    $total=0;
    foreach($commande->lignes as $ligne){
        $total+=$ligne->prix*$ligne->quantite_commande;

    }

    if ($ancienStatus !== $nouveauStatus) {
        $commande->status = $nouveauStatus;
        $commande->save();

        // Envoi du mail à l'utilisateur
        Mail::to($commande->user->email)->send(new CommandeStatusChangedMail($commande,$total));
    }

    return redirect()->back()->with('success', 'Statut mis à jour avec succès et notification envoyée à l\'utilisateur.');
}

}
