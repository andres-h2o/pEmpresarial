<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetallePuntajesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_puntajes', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('fecha');
            $table->integer('id_usuario')->unsigned();
            $table->integer('id_puntaje')->unsigned();
            $table->integer('puntos');
            $table->String('detalles');


            $table->foreign('id_puntaje')->references('id')->on('puntajes')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('id_usuario')->references('id')->on('users');
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
        Schema::dropIfExists('detalle_puntajes');
    }
}
