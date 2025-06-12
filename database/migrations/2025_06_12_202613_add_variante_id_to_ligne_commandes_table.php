<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::table('ligne_commandes', function (Blueprint $table) {
        $table->unsignedBigInteger('variante_id')->nullable()->after('article_id');

        $table->foreign('variante_id')->references('id')->on('variantes')->onDelete('set null');
    });
}

public function down()
{
    Schema::table('ligne_commandes', function (Blueprint $table) {
        $table->dropForeign(['variante_id']);
        $table->dropColumn('variante_id');
    });
}

};
