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
         // Inverser le panier pour que les éléments les plus récents soient en haut
    $panier = array_reverse($panier);
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
            'status' => 'en attente',
            'mode_paiement' => $mode_paiement,
            'user_id' => Auth::id(),
        ]);

        // 3. Création des lignes de commande
        $total = 0;

        foreach ($panier as $item) {
            LigneCommande::create([
                'commande_id' => $commande->id,
                'article_id' => $item['article_id'],
                'variante_id' => $item['variante_id'] ?? null,
                'quantite_commande' => $item['quantite'],
                'taille' => $item['taille'] ?? null,
                'couleur' => $item['couleur'] ?? null,
                'prix' => $item['prix'],
                'image' => $item['image'] ?? null,
            ]);

            $total += $item['prix'] * $item['quantite'];
        }

        DB::commit();

        // 4. Vider le panier
        session()->forget('panier');
        session()->forget('cart_count');

        // 5. Envoi de l'e-mail de confirmation
        try {
            Mail::to($commande->user->email)->send(new ConfirmationCommandeMail($commande, $total));
        } catch (\Exception $e) {
            \Log::error('Erreur lors de l’envoi de l’email : ' . $e->getMessage());
            // Pas d'interruption
        }

        // 6. Redirection vers page de succès
        return redirect()->route('commande.success')->with('success', '🎉 Merci pour votre commande ! Un e-mail de confirmation vous a été envoyé.');

    } catch (\Exception $e) {
        DB::rollBack();
        \Log::error('Erreur de commande : ' . $e->getMessage());

        // Gestion d'erreur personnalisée
        return back()->with('error', $this->getTriggerMessage($e));
    }
}

private function getTriggerMessage(\Exception $e): string
{
    $message = $e->getMessage();

    if (str_contains($message, 'quantite_stock_insuffisante')) {
        return "La quantité demandée dépasse le stock disponible. Veuillez ajuster votre panier.";
    }

    return "Une erreur est survenue lors de la validation de votre commande. Veuillez réessayer.";
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
   $commandes = $user->commande()

    ->with('lignes')
    ->orderBy('created_at', 'desc') // tri décroissant par date de création
    ->get();


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
    // Récupère uniquement les commandes non supprimées
    $commande = Commande::with('lignes.article')->findOrFail($id);

    if ($commande->user_id !== auth()->id()) {
        abort(403, "Action non autorisée.");
    }

    // Si la commande est déjà annulée (soft deleted), on bloque
    if ($commande->status === 'annulé') {
        abort(400, "La commande est déjà annulée.");
    }

    // Si la commande est encore "en attente", on l'annule
    if ($commande->status === 'en attente') {
        $commande->status = 'annulé';
        $commande->save();
        $commande->delete(); // soft delete

        try {
            Mail::to($commande->user->email)->send(new CommandeAnnuleeMail($commande));
        } catch (\Exception $e) {
            \Log::error("Erreur envoi mail annulation commande: " . $e->getMessage());
        }

        return redirect()->route('commandes.client', auth()->id())
            ->with('success', 'La commande a été annulée avec succès.');
    }

    // Toute autre situation n'est pas autorisée (ex: livré)
    abort(400, "Le statut de cette commande ne permet pas de l'annuler.");
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
