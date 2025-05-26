<?php
namespace App\Http\Controllers;
use App\Models\Article;
use App\Models\Couleur;
use App\Models\Taille;
use App\Models\Variante;
use Illuminate\Http\Request;

class VarianteController extends Controller
{
    public function create($articleId)
    {
        $article = Article::findOrFail($articleId);
        $couleurs = Couleur::all();
        $tailles = Taille::all();

        return view('admin.variantes.create', compact('article', 'couleurs', 'tailles'));
    }

    public function store(Request $request, $articleId)
{
    $request->validate([
        'couleur_id' => 'required|exists:couleurs,id',
        'taille_ids' => 'required|array',
        'taille_ids.*' => 'exists:tailles,id',
        'quantite' => 'required|integer|min:0',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Vérifie si l'association article + couleur existe déjà
    $article = Article::findOrFail($articleId);
    $couleurId = $request->couleur_id;

    // Si une image est uploadée
    $imagePath = null;
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('article_couleur_images', 'public');
    }

    // Associe la couleur à l'article avec une image dans la table pivot
    $article->couleursAvecImages()->syncWithoutDetaching([
        $couleurId => ['image' => $imagePath]
    ]);

    // Crée une variante pour chaque taille sélectionnée
    foreach ($request->taille_ids as $tailleId) {
        Variante::create([
            'article_id' => $articleId,
            'couleur_id' => $couleurId,
            'taille_id'  => $tailleId,
            'quantite'   => $request->quantite,
        ]);
    }

    return redirect()->back()->with('success', 'Variantes ajoutées avec succès avec image associée à la couleur.');
}


}
