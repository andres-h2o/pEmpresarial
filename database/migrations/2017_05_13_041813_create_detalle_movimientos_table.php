<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetalleMovimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_movimientos', function (Blueprint $table) {
            $table->increments('id');
            $table->String('tipo',1);
            $table->dateTime('fecha')->nullable();
            $table->String('responsable',50);
            $table->String('detalle');

            $table->integer('id_informe')->unsigned();
            $table->float('monto');

            $table->foreign('id_informe')->references('id')->on('informes')
                ->onDelete('cascade')
                ->onUpdate('cascade');

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
        Schema::dropIfExists('detalle_movimientos');
    }
}
