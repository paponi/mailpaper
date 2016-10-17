<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriarUtilizadorServicos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('utilizadorservicos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_utilizador');
            $table->integer('id_servico');
            $table->integer('inserido_por');
            $table->integer('alterado_por');
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
        Schema::drop('utilizadorservicos');
    }
}
