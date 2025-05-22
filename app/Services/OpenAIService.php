<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Models\Article;

class OpenAIService
{
    public function generateCompleteArticle()
    {
        $prompt = "Génère un article fictif pour une boutique de vêtements.
Donne un JSON avec les champs suivants :
- libelle : un nom de vêtement (ex : 'T-shirt en coton noir')
- description : une brève description du produit
- quantite : un entier entre 1 et 100
- prix : un nombre décimal en euros

Formate uniquement le JSON (sans texte autour).";

        // IMPORTANT : Utiliser la clé OPENROUTER_API_KEY pour OpenRouter
        $response = Http::withToken(env('OPENROUTER_API_KEY'))
            ->post('https://openrouter.ai/v1/chat/completions', [
                'model' => 'mistralai/mistral-7b-instruct',
                'messages' => [
                    ['role' => 'user', 'content' => $prompt]
                ],
                'temperature' => 0.7,
            ]);

        // Logs complets pour debug
        Log::info('Response HTTP status: ' . $response->status());
        Log::info('Response headers: ' . json_encode($response->headers()));
        Log::info('Response body: ' . $response->body());

        $jsonResponse = $response->json();

        if (is_null($jsonResponse)) {
            Log::info('OpenRouter API Response: réponse vide ou null');
            throw new \Exception("Réponse vide ou JSON invalide de l'API OpenRouter");
        }

        Log::info('OpenRouter API Response JSON:', $jsonResponse);

        $content = $jsonResponse['choices'][0]['message']['content'] ?? '';

        // Nettoyer la chaîne pour extraire juste le JSON (enlever espaces, retours à la ligne)
        $jsonString = trim($content);

        // Tenter de décoder
        $data = json_decode($jsonString, true);

        if (!$data) {
            // Essaie de détecter si JSON mal formé (ex: JSON à l'intérieur d'un string)
            throw new \Exception("Contenu JSON manquant ou mal formé");
        }

        // Exemple : prendre le premier produit pour créer un article
        $firstProduct = is_array($data) ? reset($data) : null;

        if (!$firstProduct || !isset($firstProduct['libelle'])) {
            throw new \Exception("Données produit invalides");
        }

        return $firstProduct;
    }

    // Génération d'image via OpenAI
    public function generateImage(string $libelle)
    {
        $imagePrompt = "Image de vêtement pour un catalogue produit : $libelle, fond blanc, style commercial";

        $response = Http::withToken(env('OPENAI_API_KEY'))
            ->post('https://api.openai.com/v1/images/generations', [
                'prompt' => $imagePrompt,
                'n' => 1,
                'size' => '512x512',
            ]);

        $json = $response->json();

        if (!isset($json['data'][0]['url'])) {
            throw new \Exception("Erreur lors de la génération d'image");
        }

        return $json['data'][0]['url'];
    }
}

// Fonction d’utilisation de OpenAIService à placer dans un contrôleur Laravel, par exemple ArticleController :

/*
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
*/
