<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Article;

class Welcome extends Component
{
    public $articles;

    /*public function __construct()
    {
        $query = request('query');

        $this->articles = Article::when($query, function ($q) use ($query) {
            $q->where('libelle', 'like', "%{$query}%")
              ->orWhere('description', 'like', "%{$query}%");
        })->paginate(12);
    }*/

    public function __construct()
{
    $query = request('query');

    $this->articles = Article::when($query, function ($q) use ($query) {
        $q->whereRaw('LOWER(libelle) LIKE ?', ['%' . strtolower($query) . '%'])
          ->orWhereRaw('LOWER(description) LIKE ?', ['%' . strtolower($query) . '%']);
    })->paginate(12);
}


    public function render()
    {
        return view('components.welcome', [
            'articles' => $this->articles
        ]);
    }
}
