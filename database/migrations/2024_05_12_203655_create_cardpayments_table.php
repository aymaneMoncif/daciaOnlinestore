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
        Schema::create('cardpayments', function (Blueprint $table) {
            $table->id();
            $table->string('codecmr');
            $table->string('repauto');
            $table->string('emailrd');
            $table->string('nomprenom');
            $table->string('numTrans');
            $table->string('numautorisation');
            $table->string('numCarte');
            $table->string('typecarte');
            $table->string('montant');
            $table->string('idmsg');
            $table->string('signature');
            $table->string('nom_cmr');

            $table->unsignedBigInteger('id_commande');
            $table->foreign('id_commande')->references('id')->on('commandes');

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
        Schema::dropIfExists('cardpayments');
    }
};
