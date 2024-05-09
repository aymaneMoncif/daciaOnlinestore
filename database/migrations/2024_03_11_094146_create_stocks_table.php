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
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->string('n_chassis');
            $table->string('compteproorietaire');
            $table->string('acquisition');
            $table->string('avancement');
            $table->string('etatfacturation');

            $table->unsignedBigInteger('version_id');
            $table->unsignedBigInteger('modele_id');

            $table->foreign('version_id')->references('id')->on('versions')->onDelete('cascade');
            $table->foreign('modele_id')->references('id')->on('modeles')->onDelete('cascade');

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
        Schema::dropIfExists('stocks');
    }
};
