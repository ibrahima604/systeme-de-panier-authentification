<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index()
{
    // Récupération du panier depuis la session
    $panier = session()->get('panier', []);

    // Calcul du total
    $total = 0;
    foreach ($panier as $item) {
        $total += $item['prix'] * $item['quantite'];
    }

    // Envoi des données à la vue
    return view('panier.index', compact('panier', 'total'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    public function ajouter(Request $request, $id)
    {
        $article = Article::findOrFail($id);

        $panier = session()->get('panier', []);

        if (isset($panier[$id])) {
            $panier[$id]['quantite']++;
        } else {
            $panier[$id] = [
                'libelle' => $article->libelle,
                'prix' => $article->prix,
                'image' => $article->image,
                'quantite' => 1,
            ];
        }

        session()->put('panier', $panier);
        session()->put('cart_count', array_sum(array_column($panier, 'quantite')));

        return redirect()->back()->with('success', 'Article ajouté au panier !');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $panier=session()->get('panier');
        if(isset($panier[$id])){
            $panier[$id]['quantite']=$request->quantite;
            session()->put('panier',$panier);
            session()->put('cart_count', array_sum(array_column($panier, 'quantite')));

        }
        return redirect()->back()->with('success', 'Quantité mise à jour !');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function vider()
    {
        // Suppression du panier de la session
        session()->forget('panier');
        session()->forget('cart_count');

        return redirect()->back()->with('success', 'Panier vidé !');
        
    }
    public function supprimer($id)
    {
        $panier = session()->get('panier');

        if (isset($panier[$id])) {
            unset($panier[$id]);
            session()->put('panier', $panier);
            session()->put('cart_count', array_sum(array_column($panier, 'quantite')));
        }

        return redirect()->back()->with('success', 'Article supprimé du panier !');
    }
}
