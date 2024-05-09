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
        Schema::create('images_three_sixties', function (Blueprint $table) {
            $table->id();
            $table->string('image');

            $table->unsignedBigInteger('version_id');
            $table->unsignedBigInteger('couleur_id'); 
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
        Schema::dropIfExists('images_three_sixties');
    }
};
