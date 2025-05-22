<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArticleRequest;
use App\Models\Article;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Services\OpenAIService;

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
    $article->quantite = $request->quantite;
    $article->prix = $request->prix;

    $article->save();

    return redirect()->route('admin.articles.index')->with('success', 'Article mis à jour avec succès.');
}

public function generateWithAI(OpenAIService $openAI)
{
    try {
        Log::info('Generating article with AI...');

        // Génération des données de l'article
        $data = $openAI->generateCompleteArticle();
        Log::info('Generated article data:', $data);

        if (empty($data['libelle'])) {
            throw new \Exception("Le champ 'libelle' est manquant dans la réponse AI.");
        }

        // Génération de l'image à partir du libellé
        $imageUrl = $openAI->generateImage($data['libelle']);
        Log::info('Generated image URL:', ['url' => $imageUrl]);

        if (!$imageUrl) {
            throw new \Exception("Impossible de générer l'image.");
        }

        // Récupération du contenu de l'image
        $imageContent = @file_get_contents($imageUrl);
        if ($imageContent === false) {
            throw new \Exception("Impossible de récupérer le contenu de l'image depuis l'URL.");
        }

        // Création d'un nom unique pour l'image
        $imageName = 'articles/' . uniqid() . '.png';

        // Sauvegarde de l'image dans le disque public (vérifier que le disque 'public' est configuré)
        Storage::disk('public')->put($imageName, $imageContent);

        // Création de l'article en base
        Article::create([
            'libelle' => $data['libelle'],
            'description' => $data['description'] ?? '',
            'quantite' => isset($data['quantite']) ? (int) $data['quantite'] : 1,
            'prix' => isset($data['prix']) ? (float) $data['prix'] : 0.0,
            'image' => $imageName,
        ]);

        Log::info('Article generated successfully.');

        return redirect()->route('articles.index')->with('success', 'Article généré avec succès !');
    } catch (\Exception $e) {
        Log::error('Error generating article with AI:', ['error' => $e->getMessage()]);
        return back()->with('error', 'Erreur IA : ' . $e->getMessage());
    }
}
   
}
