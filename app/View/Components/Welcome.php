<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Article;

class Welcome extends Component
{
    public $articles;

    public function __construct()
    {
        // Tu récupères les articles ici (tu peux aussi les passer depuis le contrôleur)
        $this->articles = Article::paginate(12);
    }

    public function render()
    {
        return view('components.welcome', [
            'articles' => $this->articles
        ]);
    }
}
