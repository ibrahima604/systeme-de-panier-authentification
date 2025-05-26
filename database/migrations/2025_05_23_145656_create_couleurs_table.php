<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */

    public function up(): void
    {
        Schema::create('couleurs', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('code_hex')->nullable(); // ex: #FF0000
            $table->string('image')->nullable(); // image liée à la couleur
            $table->timestamps();
            $table->softDeletes(); // optionnel
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('couleurs');
    }
};
