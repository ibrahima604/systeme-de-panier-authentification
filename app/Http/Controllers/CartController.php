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
    public function create() {}

    public function ajouter(Request $request, $id)
    {
        $article = Article::findOrFail($id);

        $tailleId = $request->input('taille_id');
        $couleurId = $request->input('couleur_id');
        $quantite=$request->input('quantite',1);

        // Initialisation pour éviter les erreurs de portée
        $Taille = [];
        $TailleIDS = [];
        $Couleur = [];
        $CouleurIDS = [];
        $imageArticle = [];

        $panier = session()->get('panier', []);

        $key = $id . '-' . ($tailleId ?? '0') . '-' . ($couleurId ?? '0');

        if (isset($panier[$key])) {
            $panier[$key]['quantite']++;
        } else {
            // Gestion de la taille
            if ($tailleId) {
                $VarianteTaille = $article->variantes()->where('taille_id', $tailleId)->first();
                $tailleNom = $VarianteTaille && $VarianteTaille->taille ? $VarianteTaille->taille->nom : 'Taille inconnue';
            } else {
                $variantes = $article->variantes()->whereNotNull('taille_id')->get();
                foreach ($variantes as $variante) {
                    if ($variante->taille && !in_array($variante->taille_id, $TailleIDS)) {
                        $TailleIDS[] = $variante->taille_id;
                        $Taille[] = $variante->taille->nom;
                    }
                }
                $tailleId = 0;
                $tailleNom = 'Taille par défaut';
            }

            // Gestion de la couleur
            if ($couleurId) {
                $VarianteCouleur = $article->variantes()->where('couleur_id', $couleurId)->first();
                $couleurNom = $VarianteCouleur && $VarianteCouleur->couleur ? $VarianteCouleur->couleur->nom : 'Couleur inconnue';
            } else {
                $variantes = $article->variantes()->whereNotNull('couleur_id')->get();
                foreach ($variantes as $variante) {
                    if ($variante->couleur && !in_array($variante->couleur_id, $CouleurIDS)) {
                        $CouleurIDS[] = $variante->couleur_id;
                        $Couleur[] = $variante->couleur->nom;
                    }
                }
                $couleurId = 0;
                $couleurNom = 'Couleur par défaut';

                // Récupération des images associées aux couleurs
                $variantesImage = $article->couleursAvecImages()->whereNotNull('image')->get();
                foreach ($variantesImage as $varianteImage) {
                    if ($varianteImage->pivot->image && !in_array($varianteImage->pivot->image, $imageArticle)) {
                        $imageArticle[] = $varianteImage->pivot->image;
                    }
                }
            }

            // Récupération de l'image de la variante si disponible
            $varianteImage = $article->couleursAvecImages()->where('couleur_id', $couleurId)->first();
            $image = $varianteImage && $varianteImage->pivot->image ? $varianteImage->pivot->image : $article->image;

            // Ajout de l'article au panier
            $panier[$key] = [
                'article_id' => $id,
                'libelle' => $article->libelle,
                'prix' => $article->prix,
                'image' => $image,
                'quantite' => $quantite,
                'taille' => $tailleNom,
                'couleur' => $couleurNom,
                'taille_id' => $tailleId,
                'couleur_id' => $couleurId,
                'couleurArticle' => $Couleur,
                'tailleArticle' => $Taille,
                'couleurArticleIDS' => $CouleurIDS,
                'tailleArticleIDS' => $TailleIDS,
                'imageArticle' => $imageArticle,
            ];
        }

        // Calcul du nombre total d'articles dans le panier
        $cartCount = array_sum(array_column($panier, 'quantite'));
        session()->put('cart_count', $cartCount);


        session()->put('panier', $panier);
        if (auth()->check()) {
            return redirect()->route('dashboard')->with('success', 'Article ajouté au panier.');
        }
        // Redirection vers la page d'accueil (ou une autre route nommée)
        return redirect('/')->with('success', 'Article ajouté au panier.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function changerCouleur(Request $request)
    {
        $articleId = $request->input('article_id');
        $nouvelleCouleurId = $request->input('nouvelle_couleur');
        $tailleId = $request->input('taille_id');
        $oldKey = $request->input('old_key');

        $article = Article::findOrFail($articleId);
        $panier = session()->get('panier', []);

        // Vérifie que l'item existe
        if (!isset($panier[$oldKey])) {
            return redirect()->route('panier.index')->with('error', 'Article introuvable dans le panier.');
        }

        // Récupérer les données à conserver AVANT suppression
        $couleurArticle = $panier[$oldKey]['couleurArticle'] ?? [];
        $tailleArticle = $panier[$oldKey]['tailleArticle'] ?? [];
        $couleurArticleIDS = $panier[$oldKey]['couleurArticleIDS'] ?? [];
        $tailleArticleIDS = $panier[$oldKey]['tailleArticleIDS'] ?? [];
        $imageArticle = $panier[$oldKey]['imageArticle'] ?? [];
        $quantite = $panier[$oldKey]['quantite'] ?? 1;

        // Supprimer l'ancien item
        unset($panier[$oldKey]);

        // Reconstituer la nouvelle clé avec la nouvelle couleur
        $newKey = $articleId . '-' . ($tailleId ?? 0) . '-' . $nouvelleCouleurId;

        // Trouver les infos de la nouvelle couleur
        $varianteCouleur = $article->variantes()->where('couleur_id', $nouvelleCouleurId)->first();
        $couleurNom = $varianteCouleur->couleur->nom ?? 'Couleur inconnue';

        // Trouver les infos de la taille
        if ($tailleId && $tailleId != 0) {
            $varianteTaille = $article->variantes()->where('taille_id', $tailleId)->first();
            $tailleNom = $varianteTaille->taille->nom ?? 'Taille inconnue';
        } else {
            $tailleNom = 'Taille par défaut';
        }

        // Récupérer image selon la nouvelle couleur
        $varianteImage = $article->couleursAvecImages()->where('couleur_id', $nouvelleCouleurId)->first();
        $image = $varianteImage->pivot->image ?? $article->image;

        // Ajouter le nouvel item avec la nouvelle clé
        $panier[$newKey] = [
            'article_id' => $articleId,
            'libelle' => $article->libelle,
            'prix' => $article->prix,
            'image' => $image,
            'quantite' => $quantite,
            'taille' => $tailleNom,
            'couleur' => $couleurNom,
            'taille_id' => $tailleId,
            'couleur_id' => $nouvelleCouleurId,
            'couleurArticle' => $couleurArticle,
            'tailleArticle' => $tailleArticle,
            'couleurArticleIDS' => $couleurArticleIDS,
            'tailleArticleIDS' => $tailleArticleIDS,
            'imageArticle' => $imageArticle,
        ];

        session()->put('panier', $panier);

        return redirect()->route('panier.index')->with('success', 'Couleur modifiée avec succès.');
    }


    public function changerTaille(Request $request)
    {
        $articleId = $request->input('article_id');
        $nouvelleTailleId = $request->input('nouvelle_taille');
        $couleurId = $request->input('couleur_id');
        $oldKey = $request->input('old_key');

        $article = Article::findOrFail($articleId);
        $panier = session()->get('panier', []);

        // Vérifier que l'article existe dans le panier
        if (!isset($panier[$oldKey])) {
            return redirect()->route('panier.index')->with('error', 'Article introuvable dans le panier.');
        }

        // Récupérer les données existantes
        $item = $panier[$oldKey];

        // Trouver les infos de la nouvelle taille
        $varianteTaille = $article->variantes()->where('taille_id', $nouvelleTailleId)->first();
        $tailleNom = $varianteTaille->taille->nom ?? 'Taille inconnue';

        // Récupérer image selon la couleur
        $varianteImage = $article->couleursAvecImages()->where('couleur_id', $couleurId)->first();
        $image = $varianteImage->pivot->image ?? $article->image;

        // Mise à jour directe dans la même ligne de commande
        $panier[$oldKey]['taille'] = $tailleNom;
        $panier[$oldKey]['taille_id'] = $nouvelleTailleId;
        $panier[$oldKey]['image'] = $image;

        // Initialiser ou conserver les champs additionnels
        $panier[$oldKey]['couleurArticle'] = $panier[$oldKey]['couleurArticle'] ?? [];
        $panier[$oldKey]['tailleArticle'] = $panier[$oldKey]['tailleArticle'] ?? [];
        $panier[$oldKey]['couleurArticleIDS'] = $panier[$oldKey]['couleurArticleIDS'] ?? [];
        $panier[$oldKey]['tailleArticleIDS'] = $panier[$oldKey]['tailleArticleIDS'] ?? [];
        $panier[$oldKey]['imageArticle'] = $panier[$oldKey]['imageArticle'] ?? [];

        session()->put('panier', $panier);

        return redirect()->route('panier.index')->with('success', 'Taille modifiée avec succès.');
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
    public function update(Request $request, mixed $id)
    {
        $panier = session()->get('panier');
        if (isset($panier[$id])) {
            $panier[$id]['quantite'] = $request->quantite;
            session()->put('panier', $panier);
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

        if (auth()->check()) {
            return redirect()->route('dashboard')->with('success', 'Panier vidé !');
        }

        // Redirection vers la page d'accueil (ou une autre route nommée)
        return redirect('/')->with('success', 'Panier vidé !');
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
