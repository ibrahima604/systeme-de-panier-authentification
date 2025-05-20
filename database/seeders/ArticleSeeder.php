<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;

class ArticleSeeder extends Seeder
{
public function run()
{
    $faker = \Faker\Factory::create();

    $clothingTypes = ['tshirt', 'jeans', 'jacket', 'dress', 'skirt', 'shorts', 'sweater'];
    $clothingType = $faker->randomElement($clothingTypes);
    $color = $faker->safeColorName();
    $uniqueId = $faker->unique()->randomNumber(5);
    $imageUrl = $this->generateClothingImage($clothingType, $color, $uniqueId);
    $filename = 'image_' . $uniqueId . '.jpg';

    $this->downloadAndStoreImage($imageUrl, $filename);

    // Enregistrer l'image dans la base de données
    Article::create([
        'libelle' => ucfirst($clothingType) . ' ' . $faker->word . ' ' . $color,
        'prix' => $faker->randomFloat(2, 10, 200),
        'description' => $faker->paragraph(),
        'quantite' => $faker->numberBetween(1, 50),
        'image' => $filename,
        'created_at' => $faker->dateTimeBetween('-1 year', 'now'),
        'updated_at' => now(),
    ]);
}

/**
 * Download an image from a URL and store it in the public/images directory.
 */
protected function downloadAndStoreImage($url, $filename)
{
    $imageContents = @file_get_contents($url);
    if ($imageContents === false) {
        // Handle error or use a default image
        $imageContents = '';
    }
    $imagePath = public_path('images/' . $filename);
    // Ensure the directory exists
    if (!file_exists(dirname($imagePath))) {
        mkdir(dirname($imagePath), 0755, true);
    }
    file_put_contents($imagePath, $imageContents);
}

/**
 * Generate a fake clothing image URL.
 */
protected function generateClothingImage($clothingType, $color, $uniqueId)
{
    // You can use a placeholder image service like Lorem Picsum or placehold.co
    // Here is an example using placehold.co with text
    $text = urlencode(ucfirst($clothingType) . " " . $color);
    return "https://placehold.co/400x400/{$color}/white?text={$text}";
}

}
