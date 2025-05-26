<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Couleur;

class CouleursTableSeeder extends Seeder
{
    public function run(): void
    {
        $couleurs = [
            ['nom' => 'Blanc', 'code_hex' => '#FFFFFF', 'image' => null],
            ['nom' => 'Noir', 'code_hex' => '#000000', 'image' => null],
        ];

        foreach ($couleurs as $couleur) {
            Couleur::create($couleur);
        }
    }
}
