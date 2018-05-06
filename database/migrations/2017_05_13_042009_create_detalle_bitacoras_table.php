<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetalleBitacorasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_bitacoras', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('fecha');
            $table->String('accion',255);
            $table->String('detalle',500);
            $table->integer('id_bitacora')->unsigned();

            $table->foreign('id_bitacora')->references('id')->on('bitacoras')
                ->onDelete('no action')
                ->onUpdate('no action');

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
        Schema::dropIfExists('detalle_bitacoras');
    }
}
