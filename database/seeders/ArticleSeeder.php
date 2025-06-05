<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        $faker = \Faker\Factory::create();

        $clothingTypes = ['tshirt', 'jeans', 'jacket', 'dress', 'skirt', 'shorts', 'sweater'];

        for ($i = 0; $i < 2; $i++) {
            $type = $faker->randomElement($clothingTypes);
            $color = $faker->safeColorName();
            $name = ucfirst($type) . ' ' . $faker->word . ' ' . $color;

            // Télécharger une image depuis Unsplash
            $imageUrl = $this->getUnsplashImage($type);
            $filename = uniqid('article_') . '.jpg';
            $path = 'articles/' . $filename;

            try {
                $imageContent = file_get_contents($imageUrl);
                Storage::disk('public')->put($path, $imageContent);
            } catch (\Exception $e) {
                // Utiliser une image par défaut si échec
                $defaultImage = file_get_contents("https://placehold.co/400x400?text=Image+Not+Found");
                Storage::disk('public')->put($path, $defaultImage);
            }

            Article::create([
                'libelle' => $name,
                'prix' => $faker->randomFloat(2, 10, 200),
                'description' => $faker->paragraph(),
                'quantite' => $faker->numberBetween(1, 50),
                'image' => $path, // accessible via storage/articles/filename
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    protected function getUnsplashImage(string $query): string
    {
        $key = config('services.unsplash.key');

        $response = Http::get("https://api.unsplash.com/photos/random", [
            'query' => $query,
            'client_id' => $key,
            'orientation' => 'squarish'
        ]);

        if ($response->successful()) {
            return $response->json()['urls']['regular'];
        }

        throw new \Exception('Failed to fetch image from Unsplash');
    }
}
