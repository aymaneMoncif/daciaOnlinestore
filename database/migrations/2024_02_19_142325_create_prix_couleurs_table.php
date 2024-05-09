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
        Schema::create('prix_couleurs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('version_id');
            $table->unsignedBigInteger('couleur_id'); 
            $table->float('prix'); 
            $table->timestamps();

            // Define foreign key constraints
            $table->foreign('version_id')->references('id')->on('versions');
            $table->foreign('couleur_id')->references('id')->on('couleurs');

            // Ensure uniqueness of combination of version_id and equipement_id
            $table->unique(['version_id', 'couleur_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prix_couleurs');
    }
};
