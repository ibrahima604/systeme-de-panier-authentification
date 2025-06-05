<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Commande;
use App\Models\LigneCommande;
use App\Models\Article;
use App\Models\User;
use Illuminate\Support\Facades\Auth; // si ce n’est pas encore importé
use Illuminate\Support\Facades\Mail;
use App\Mail\ConfirmationCommandeMail;
use Illuminate\Http\Request;
use App\Mail\CommandeAnnuleeMail;
use App\Mail\CommandeReactiveeMail;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Notifications\FactureGeneree;
use App\Mail\CommandeSupprimeeMail;


class CommandeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $panier=session('panier', []);
        $total=0;
        foreach ($panier as $item) {
            $total += $item['prix'] * $item['quantite'];
        }
        return view('commandes.index',compact('total','panier'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

  

    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request)
{
    // 1. Validation des données
    $request->validate([
        'adresse' => 'required|string|max:255',
        'pays' => 'required|string|max:255',
        'ville' => 'required|string|max:255',
        'mode_paiement' => 'required|string|in:carte,especes',
    ]);

    $adresse = $request->input('adresse');
    $pays = $request->input('pays');
    $ville = $request->input('ville');
    $mode_paiement = $request->input('mode_paiement');
    $panier = session('panier', []);

    if (empty($panier)) {
        return back()->with('error', 'Votre panier est vide.');
    }

    DB::beginTransaction();

    try {
        // 2. Création de la commande
        $commande = Commande::create([
            'adresse' => "$adresse, $ville, $pays",
            'status' => 'en cours',
            'mode_paiement' => $mode_paiement,
            'user_id' => Auth::id(),
        ]);

        // 3. Création des lignes de commande
          $total = 0;
        foreach ($panier as $item) {
            LigneCommande::create([
                'commande_id' => $commande->id,
                'article_id' => $item['article_id'],
                'quantite_commande' => $item['quantite'],
                'taille' => $item['taille'] ?? null,
                'couleur' => $item['couleur'] ?? null,
                'prix' => $item['prix'],
                'image' => $item['image'] ?? null,
            ]);
        }
      
foreach ($panier as $item) {
    $total += $item['prix'] * $item['quantite'];
}


        DB::commit();

        // 4. Vider le panier
        session()->forget('panier');
        session()->forget('cart_count');

        // 5. Envoi de l'email de confirmation
        try {
         

           Mail::to($commande->user->email)->send(new ConfirmationCommandeMail($commande,$total));
        } catch (\Exception $e) {
            \Log::error('Erreur lors de l’envoi de l’email : ' . $e->getMessage());
           
            die('erreur:'.$e->getMessage());
            // Pas d'interruption : continuer vers la page de succès même si l'email échoue
        }

        // 6. Redirection vers la page de succès
        return redirect()->route('commande.success')->with('success', '🎉 Merci pour votre commande ! Un e-mail de confirmation vous a été envoyé.');

    } catch (\Exception $e) {
        DB::rollBack();
        \Log::error('Erreur de commande : ' . $e->getMessage());
        return back()->with('error', 'Une erreur est survenue. Veuillez réessayer plus tard.');
    }
}
    /**
     * Show the form for editing the specified resource.
     **/
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
 public function destroy($id)
{
    $commande = Commande::findOrFail($id);

    if ($commande->user_id !== auth()->id()) {
        abort(403, "Action non autorisée.");
    }

    $commande->load('user'); // Très important pour éviter une erreur dans l’email

    Mail::to($commande->user->email)->send(new CommandeSupprimeeMail($commande));

    $commande->delete(); // soft delete uniquement

    return redirect()->route('commandes.client', auth()->id())
        ->with('success', 'La commande a été supprimée et un e-mail de confirmation vous a été envoyé.');
}



public function commandesClient($id)
{
    $user = User::findOrFail($id);
    // Récupérer toutes les commandes, y compris les soft deleted
    $commandes = $user->commande()->withTrashed()->with('lignes')->get();

    foreach ($commandes as $commande) {
        $totalCommande = 0;
        foreach ($commande->lignes as $ligne) {
            $totalCommande += $ligne->quantite_commande * $ligne->prix;
        }
        $commande->total = $totalCommande; // Ajout dynamique
    }

    return view('commandes.commandes-client', compact('commandes'));
}

public function show($id)
{
    // Récupération de la commande avec ses lignes, articles et utilisateur
     // Inclure les commandes supprimées
    $commande = Commande::withTrashed()
        ->with(['lignes.article', 'user'])
        ->findOrFail($id);

    // Calcul du total de la commande
    $totalCommande = 0;
    foreach ($commande->lignes as $ligne) {
        $totalCommande += $ligne->quantite_commande * $ligne->prix;
    }
    // Ajout dynamique du total à l'objet commande
    $commande->total = $totalCommande;

    // Sécurité : vérifier que la commande appartient à l'utilisateur connecté
    if (auth()->id() !== $commande->user_id) {
        abort(403, "Vous n'avez pas accès à cette commande.");
    }

    // Retour de la vue avec la commande
    return view('commandes.show', compact('commande'));
}


public function toggleStatus($id)
{
     $commande = Commande::with('lignes.article')->findOrFail($id);;

    if ($commande->user_id !== auth()->id()) {
        abort(403, "Action non autorisée.");
    }

    if ($commande->status === 'annulé') {
        $commande->status = 'en cours';
        $message = 'La commande a été réactivée avec succès.';
        $commande->save();

        try {
            Mail::to($commande->user->email)->send(new CommandeReactiveeMail($commande));
        } catch (\Exception $e) {
            \Log::error("Erreur envoi mail réactivation commande: ".$e->getMessage());
        }

    } elseif ($commande->status === 'en cours') {
        $commande->status = 'annulé';
        $message = 'La commande a été annulée avec succès.';
        $commande->save();

        try {
            Mail::to($commande->user->email)->send(new CommandeAnnuleeMail($commande));
        } catch (\Exception $e) {
            \Log::error("Erreur envoi mail annulation commande: ".$e->getMessage());
        }

    } else {
        abort(400, "Le statut de cette commande ne peut pas être modifié.");
    }

    return redirect()->route('commandes.client', auth()->id())
        ->with('success', $message);
}


public function generateFacture($id)
{
    $commande = Commande::with(['lignes.article', 'user'])->findOrFail($id);

    // Vérification d'autorisation
    if (Auth::id() !== $commande->user_id && !Auth::user()->isAdmin()) {
        abort(403);
    }

    // Calcul du total
    $total = $commande->lignes->sum(function ($ligne) {
        return $ligne->prix * $ligne->quantite_commande;
    });

    // Données pour la vue
    $data = [
        'commande' => $commande,
        'date' => now()->format('d/m/Y'),
        'numero_facture' => 'FACT-' . str_pad($commande->id, 6, '0', STR_PAD_LEFT),
        'total' => $total,
    ];

    // Génération du PDF
    $pdf = \Pdf::loadView('facture', $data);

    // Notification par email avec pièce jointe
    $commande->user->notify(new FactureGeneree($commande, $pdf));

    // Retourner le téléchargement direct
    return $pdf->download('facture-' . $commande->id . '.pdf');
}








}
