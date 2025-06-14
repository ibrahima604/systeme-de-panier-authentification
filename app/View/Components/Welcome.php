<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\DB; // N'oublie pas d'importer DB
use App\Models\Article;
use App\Models\ArticleCouleurImage;

class Welcome extends Component
{
    public $articles;
    public $articleCouleurImages;
    public $labels;  // pour les libellés des top produits
    public $data;    // pour les quantités vendues

    public function __construct()
    {
        $query = request('query');
        $isAjax = request()->ajax() || request()->has('ajax');

        // Chargement des articles avec pagination + relations
        $this->articles = Article::with([
            'variantes.couleur',
            'variantes.taille',
            'couleurImages.couleur'
        ])
        ->when($query, function ($q) use ($query) {
            $q->whereRaw('LOWER(libelle) LIKE ?', ['%' . strtolower($query) . '%'])
              ->orWhereRaw('LOWER(description) LIKE ?', ['%' . strtolower($query) . '%']);
        })
        ->paginate(20);

        if (!$isAjax) {
            $articleIds = collect($this->articles->items())->pluck('id')->toArray();
            $this->articleCouleurImages = ArticleCouleurImage::whereIn('article_id', $articleIds)->get();
        }

        // Ajout de la logique topProducts ici
        $topProducts = DB::table('ligne_commandes as lc')
            ->join('articles as a', 'lc.article_id', '=', 'a.id')
            ->select('a.libelle', DB::raw('SUM(lc.quantite_commande) as total_vendu'))
            ->groupBy('a.libelle')
            ->orderByDesc('total_vendu')
            ->limit(10)
            ->get();

        $this->labels = $topProducts->pluck('libelle');
        $this->data = $topProducts->pluck('total_vendu');
    }

    public function render()
    {
        if (request()->ajax() || request()->has('ajax')) {
            return response()->json($this->articles);
        }

        return view('components.welcome', [
            'articles' => $this->articles,
            'articleCouleurImages' => $this->articleCouleurImages,
            'labels' => $this->labels,
            'data' => $this->data,
        ]);
    }
}
