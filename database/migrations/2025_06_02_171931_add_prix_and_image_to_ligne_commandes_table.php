<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('ligne_commandes', function (Blueprint $table) {
            $table->decimal('prix', 8, 2)->after('quantite'); // Ajuste la position si besoin
            $table->string('image')->nullable()->after('prix');
        });
    }

    public function down(): void
    {
        Schema::table('ligne_commandes', function (Blueprint $table) {
            $table->dropColumn(['prix', 'image']);
        });
    }
};
