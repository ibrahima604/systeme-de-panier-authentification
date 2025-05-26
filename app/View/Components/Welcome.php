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

        $this->articles = Article::with([
            'variantes.couleur',  
            'variantes.taille',   
            'couleurImages.couleur'
        ])
        ->when($query, function ($q) use ($query) {
            $q->whereRaw('LOWER(libelle) LIKE ?', ['%' . strtolower($query) . '%'])
              ->orWhereRaw('LOWER(description) LIKE ?', ['%' . strtolower($query) . '%']);
        })
        ->paginate(12);

        // Récupérer les images par couleur pour tous les articles paginés
        $articleIds = collect($this->articles->items())->pluck('id')->toArray();

        $this->articleCouleurImages = ArticleCouleurImage::whereIn('article_id', $articleIds)->get();
    }

    public function render()
    {
        return view('components.welcome', [
            'articles' => $this->articles,
            'articleCouleurImages' => $this->articleCouleurImages,
        ]);
    }
}
