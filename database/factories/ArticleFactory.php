<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;

class ArticleFactory extends Factory
{
    private $clothingTypes = [
        't-shirt', 'jeans', 'dress', 'jacket', 'sweater',
        'shirt', 'skirt', 'shorts', 'coat', 'hoodie'
    ];

    public function definition(): array
    {
        $type = $this->faker->randomElement($this->clothingTypes);
        $color = $this->faker->safeColorName();
        $uniqueId = uniqid();
        $filename = "articles/{$type}_{$color}_{$uniqueId}.jpg";

        return [
            'libelle' => ucfirst($type) . ' ' . $this->faker->word . ' ' . $color,
            'prix' => $this->faker->randomFloat(2, 10, 200),
            'description' => $this->faker->paragraph(),
            'quantite' => $this->faker->numberBetween(1, 50),
            'image' => $this->fetchAndStoreImage($type, $filename),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => now(),
        ];
    }

    private function fetchAndStoreImage(string $query, string $filename): string
    {
        $key = config('services.unsplash.key');

        try {
            $response = Http::get('https://api.unsplash.com/photos/random', [
                'query' => $query,
                'client_id' => $key,
                'orientation' => 'squarish'
            ]);

            if ($response->successful()) {
                $imageUrl = $response->json()['urls']['regular'];
                $imageContent = file_get_contents($imageUrl);
                Storage::disk('public')->put($filename, $imageContent);

                return $filename;
            }
        } catch (\Exception $e) {
            // Échec de récupération → retourne image par défaut
        }

        return 'default.jpg';
    }
}
