<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriarCorreioTabela extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('correio', function (Blueprint $table) {
            $table->increments('id');
            $table->string('assunto');
            $table->text('observacoes');
            $table->timestamps();
            $table->timestamp('inseridoem');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('correio');
    }
}
