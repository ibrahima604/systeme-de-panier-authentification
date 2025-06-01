<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Article;
use App\Models\ArticleCouleurImage;

class Welcome extends Component
{
    public $articles;
    public $articleCouleurImages;

    public function __construct()
    {
        $query = request('query');
        $isAjax = request()->ajax() || request()->has('ajax');

        $this->articles = Article::with([
            'variantes.couleur',
            'variantes.taille',
            'couleurImages.couleur'
        ])
        ->when($query, function ($q) use ($query) {
            $q->whereRaw('LOWER(libelle) LIKE ?', ['%' . strtolower($query) . '%'])
              ->orWhereRaw('LOWER(description) LIKE ?', ['%' . strtolower($query) . '%']);
        })
        ->paginate(8);

        // Pour les requêtes AJAX, on ne charge les images que si nécessaire
        if (!$isAjax) {
            $articleIds = collect($this->articles->items())->pluck('id')->toArray();
            $this->articleCouleurImages = ArticleCouleurImage::whereIn('article_id', $articleIds)->get();
        }
    }

    public function render()
    {
        // Si c'est une requête AJAX, on retourne seulement les parties à mettre à jour
        if (request()->ajax() || request()->has('ajax')) {
            return response()->json($this->articles);
        }

        return view('components.welcome', [
            'articles' => $this->articles,
            'articleCouleurImages' => $this->articleCouleurImages,
        ]);
    }
}
