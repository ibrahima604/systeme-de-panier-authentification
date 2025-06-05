<?php
// database/factories/ArticleFactory.php

use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ArticleFactory extends Factory
{
    protected $model = Article::class;

    public function definition(): array
    {
        return [
            'libelle' => $this->faker->word(),
            'prix' => $this->faker->randomFloat(2, 10, 200),
            'description' => $this->faker->sentence(10),
            'quantite' => 0, // sera calculée via les variantes
            'image' => null, // sera définie après
        ];
    }
}
