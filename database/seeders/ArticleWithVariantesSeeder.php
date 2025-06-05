<?php

// database/seeders/ArticleWithVariantesSeeder.php
namespace Database\Seeders;

use App\Models\Article;
use App\Models\Variante;
use App\Models\Couleur;
use App\Models\Taille;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class ArticleWithVariantesSeeder extends Seeder
{
    public function run(): void
    {
        // Récupérer les couleurs noir et blanc
        $noir = Couleur::where('nom', 'noir')->firstOrFail();
        $blanc = Couleur::where('nom', 'blanc')->firstOrFail();

        // Récupérer les tailles S, M, L, XL
        $tailles = Taille::whereIn('nom', ['S', 'M', 'L', 'XL'])->get();

        for ($i = 0; $i < 1; $i++) { // crée 5 articles
            $article = Article::factory()->create();

            $quantiteTotale = 0;

            foreach ([$noir, $blanc] as $couleur) {
                // Associe une image pour la couleur
                $imagePath = "article_couleur_images/{$couleur->nom}.jpg";
                if (!Storage::disk('public')->exists($imagePath)) {
                    // Génère une image à partir d'Unsplash si non existante
                    $unsplashUrl = "https://source.unsplash.com/400x400/?clothes,{$couleur->nom}";
                    $imageContent = file_get_contents($unsplashUrl);
                    Storage::disk('public')->put($imagePath, $imageContent);
                }

                // Ajout dans article_couleur_images
                \DB::table('article_couleur_images')->insert([
                    'article_id' => $article->id,
                    'couleur_id' => $couleur->id,
                    'image' => $imagePath,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                foreach ($tailles as $taille) {
                    $quantite = rand(1, 10);

                    Variante::factory()->create([
                        'article_id' => $article->id,
                        'couleur_id' => $couleur->id,
                        'taille_id' => $taille->id,
                        'quantite' => $quantite,
                    ]);

                    $quantiteTotale += $quantite;
                }
            }

            // Met à jour l'image principale de l’article (couleur par défaut = noir)
            $article->image = "article_couleur_images/noir.jpg";
            $article->quantite = $quantiteTotale;
            $article->save();
        }
    }
}

