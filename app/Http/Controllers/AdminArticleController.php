<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArticleRequest;
use App\Models\Article;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class AdminArticleController extends Controller
{
    // Affiche tous les articles
    public function index()
    {
        $articles = Article::withTrashed()->paginate(20); // 10 articles par page
        return view('admin.articles.admin-article', compact('articles'));
    }


    // Affiche un article spécifique
    public function show($id)
    {
        $article = Article::findOrFail($id);
        return view('articles.show', compact('article'));
    }

    public function create()
    {
        return view('admin.articles.create');
    }
   public function store(StoreArticleRequest $request)
{
    DB::beginTransaction();

    try {
        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('articles', 'public');
        }

        Article::create([
            'libelle'     => $request->libelle,
            'description' => $request->description,
            'quantite'    => $request->quantite,
            'prix'        => $request->prix,
            'image'       => $imagePath,
        ]);

        DB::commit();

        return redirect()->route('admin.articles.index')
            ->with('success', 'Article créé avec succès.');

    } catch (\Exception $e) {
        DB::rollBack();

        // Si une image a été enregistrée mais que l'insertion a échoué, on la supprime
        if ($imagePath && Storage::disk('public')->exists($imagePath)) {
            Storage::disk('public')->delete($imagePath);
        }

        return redirect()->back()
            ->withErrors(['error' => 'Échec de la création de l\'article.'])
            ->withInput();
    }
}

    public function softDelete(Article $article)
    {
        $article->delete();
        return redirect()->back()->with('success', 'Article désactivé avec succès.');
    }
    public function restore($id)
    {
        $article = Article::withTrashed()->findOrFail($id);
        $article->restore();
        return redirect()->back()->with('success', 'Article réactivé avec succès.');
    }
    public function edit(int $id)
    {
        $article = Article::findOrFail($id);
        return view('admin.articles.edit', compact('article'));
    }
   public function update(StoreArticleRequest $request, int $id)
{
    $article = Article::findOrFail($id);

    // Vérifie s'il y a une nouvelle image envoyée
    if ($request->hasFile('image')) {
        // Supprimer l'ancienne image s'il y en a une
        if ($article->image && Storage::disk('public')->exists($article->image)) {
            Storage::disk('public')->delete($article->image);
        }

        // Stocker la nouvelle image
        $imagePath = $request->file('image')->store('articles', 'public');

        // Mettre à jour le chemin de l'image dans la base de données
        $article->image = $imagePath;
    }

    // Mise à jour des autres champs
    $article->libelle = $request->libelle;
    $article->description = $request->description;
    $article->quantite = $request->quantity;
    $article->prix = $request->prix;

    $article->save();

    return redirect()->route('admin.articles.index')->with('success', 'Article mis à jour avec succès.');
}
   
}
