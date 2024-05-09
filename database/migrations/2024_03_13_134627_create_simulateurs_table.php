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
        Schema::create('simulateurs', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('apport');
            $table->string('durree');
            $table->string('taux');
            $table->string('fraisdossier');
            $table->string('mensualite');

            $table->unsignedBigInteger('command_id');
            $table->unsignedBigInteger('client_id');

            $table->foreign('command_id')->references('id')->on('commandes');
            $table->foreign('client_id')->references('id')->on('users');

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
        Schema::dropIfExists('simulateurs');
    }
};
