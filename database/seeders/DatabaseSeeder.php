<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\CouleursTableSeeder;
use Database\Seeders\TaillesTableSeeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            ArticleSeeder::class,
           
        ]);
    }
}
