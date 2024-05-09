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
        Schema::create('dossier_achats', function (Blueprint $table) {
            $table->id();
            $table->string('modepaiement');
            $table->string('cin');
            $table->string('Attestationsalaire');
            $table->string('bulletinpaie');
            $table->string('relevebancaire');
            $table->string('justificatifdomiciliation');
            $table->string('rib');
            $table->string('relevecnss');
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
        Schema::dropIfExists('dossier_achats');
    }
};
