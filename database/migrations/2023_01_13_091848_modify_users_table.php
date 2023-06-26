<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('salaire')->after('email');
            $table->integer('secteur_id');
            $table->integer('metier_id');
            $table->integer('poste_id');
            $table->integer('stack_id');
            $table->foreign('secteur_id')->references('id')->on('secteurs');
            $table->foreign('metier_id')->references('id')->on('metiers');
            $table->foreign('poste_id')->references('id')->on('postes');
            $table->foreign('stack_id')->references('id')->on('stacks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['secteur_id']);
            $table->dropForeign(['metier_id']);
            $table->dropForeign(['poste_id']);
            $table->dropForeign(['stack_id']);
            $table->dropColumn('secteur_id');
            $table->dropColumn('metier_id');
            $table->dropColumn('poste_id');
            $table->dropColumn('stack_id');
        });
    }
};
