<?php
// database/factories/VarianteFactory.php

use App\Models\Variante;
use Illuminate\Database\Eloquent\Factories\Factory;

class VarianteFactory extends Factory
{
    protected $model = Variante::class;

    public function definition(): array
    {
        return [
            'quantite' => $this->faker->numberBetween(1, 50),
            // les autres champs seront passés dynamiquement
        ];
    }
}
