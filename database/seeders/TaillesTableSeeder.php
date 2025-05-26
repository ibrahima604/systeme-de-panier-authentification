<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Taille;

class TaillesTableSeeder extends Seeder
{
    public function run(): void
    {
        $tailles = ['S', 'M', 'L', 'XL'];

        foreach ($tailles as $taille) {
            Taille::create(['nom' => $taille]);
        }
    }
}
