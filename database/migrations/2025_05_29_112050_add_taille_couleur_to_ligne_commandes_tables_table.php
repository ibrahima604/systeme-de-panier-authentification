<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('ligne_commandes', function (Blueprint $table) {
            $table->string('taille')->nullable();
            $table->string('couleur')->nullable();

            // Index nommés pour pouvoir les supprimer correctement
            $table->index('taille', 'ligne_commandes_taille_index');
            $table->index('couleur', 'ligne_commandes_couleur_index');
        });
    }

    public function down(): void
    {
        Schema::table('ligne_commandes', function (Blueprint $table) {
            $table->dropIndex('ligne_commandes_taille_index');
            $table->dropIndex('ligne_commandes_couleur_index');
            $table->dropColumn(['taille', 'couleur']);
        });
    }
};
