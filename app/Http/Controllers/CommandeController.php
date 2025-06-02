<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Commande;
use App\Models\LigneCommande;

use Illuminate\Http\Request;

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

    // 2. Récupération des données validées
    $adresse = $request->input('adresse');
    $pays = $request->input('pays');
    $ville = $request->input('ville');
    $mode_paiement = $request->input('mode_paiement');

    $panier = session('panier', []);

    // 3. Vérifier si le panier est vide
    if (empty($panier)) {
        return back()->with('error', 'Votre panier est vide. Veuillez ajouter des articles avant de passer une commande.');
    }

    // 4. Transaction pour création de la commande et des lignes
    DB::beginTransaction();

    try {
        // Création de la commande principale
        $commande = Commande::create([
            'adresse' => $adresse . ', ' . $ville . ', ' . $pays,
            'status' => 'en cours',
            'mode_paiement' => $mode_paiement,
        ]);

        // Ajout des lignes de commande
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

        // Valider la transaction
        DB::commit();

        // Nettoyer le panier
        session()->forget('panier');
        session()->forget('cart_count');

        // Message utilisateur agréable
        return redirect()->route('commande.success')->with('success', '🎉 Merci pour votre commande ! Nous l\'avons bien reçue et elle est en cours de traitement.');

    } catch (\Exception $e) {
        // Annuler la transaction
        DB::rollBack();

        // Logger l’erreur si besoin (optionnel)
        // Log::error('Erreur de commande : ' . $e->getMessage());

        return back()->with('error', '😥 Une erreur est survenue lors du traitement de votre commande. Veuillez réessayer plus tard.');
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
    public function destroy(string $id)
    {
        //
    }
}
