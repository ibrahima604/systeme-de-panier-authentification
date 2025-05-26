<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('article_couleur_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('article_id')->constrained()->onDelete('cascade');
            $table->foreignId('couleur_id')->constrained()->onDelete('cascade');
            $table->string('image'); // Chemin ou nom de fichier
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('article_couleur_images');
    }
};
