<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Storage;

class ArticleFactory extends Factory
{
    // Liste de types de vêtements
    private $clothingTypes = [
        't-shirt', 'jeans', 'dress', 'jacket', 'sweater',
        'shirt', 'skirt', 'shorts', 'coat', 'hoodie'
    ];

    public function definition(): array
    {
        $clothingType = $this->faker->randomElement($this->clothingTypes);
        $color = $this->faker->safeColorName();
        $uniqueId = $this->faker->unique()->randomNumber(5);

        return [
            'libelle' => ucfirst($clothingType) . ' ' . $this->faker->word . ' ' . $color,
            'prix' => $this->faker->randomFloat(2, 10, 200),
            'description' => $this->faker->paragraph(),
            'quantite' => $this->faker->numberBetween(1, 50),
            'image' => $this->generateClothingImage($clothingType, $color, $uniqueId),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => now(),
        ];
    }

    /**
     * Génère une URL d'image réaliste de vêtement depuis Unsplash
     */
    private function generateClothingImage(string $type, string $color, int $uniqueId): string
    {
        // Construction des mots-clés de recherche pour Unsplash
        $keywords = implode(',', [$type, 'clothing', $color, 'fashion', 'apparel']);

        // Unsplash Source API avec `sig` pour obtenir des images variées
        return "https://source.unsplash.com/600x800/?{$keywords}&sig={$uniqueId}";
    }

    private function downloadAndStoreImage(string $url, string $filename): string
{
    $client = new Client();
    $response = $client->get($url);
    $imageContent = $response->getBody()->getContents();

    // Stocker l'image dans le répertoire storage/app/public
    Storage::disk('public')->put($filename, $imageContent);

    return $filename;
}
}
