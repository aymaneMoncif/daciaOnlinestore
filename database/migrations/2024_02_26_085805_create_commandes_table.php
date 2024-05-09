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
        Schema::create('commandes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('modele_id');
            $table->unsignedBigInteger('version_id');
            $table->unsignedBigInteger('couleur_id');

            $table->foreign('modele_id')->references('id')->on('modeles');
            $table->foreign('version_id')->references('id')->on('versions');
            $table->foreign('couleur_id')->references('id')->on('couleurs');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('commandes');
    }
};
