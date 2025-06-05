<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToCommandesTable extends Migration
{
    public function up()
    {
        Schema::table('commandes', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->after('id');

            // Si tu veux une contrainte de clé étrangère
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('commandes', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
}
