<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriarMovimento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movimento', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_tipo_correio');
            $table->integer('id_tipo_movimento');
            $table->integer('colaborador_origem');
            $table->integer('servico_origem');
            $table->integer('colaborador_destino');
            $table->integer('servico_destino');
            $table->timestamp('recebido_em');
            $table->integer('recebido_por');
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
        Schema::drop('movimento');
    }
}
