<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBoletasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boletas', function (Blueprint $table) {
            $table->increments('id');

            $table->dateTime('fecha');
            $table->float('monto') ;
            $table->integer('id_campista')->unsigned();
            $table->integer('id_grupo')->unsigned();

            $table->foreign('id_campista')->references('id')->on('campistas')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('id_grupo')->references('id')->on('grupos')
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
        Schema::dropIfExists('boletas');
    }
}
