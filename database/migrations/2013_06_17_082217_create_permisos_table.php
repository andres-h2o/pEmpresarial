<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermisosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permisos', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('id_categoria')->unsigned()->nullable();
            $table->integer('id_privilegio')->unsigned()->nullable();
            $table->foreign('id_categoria')->references('id')->on('categorias')
                ->onUpdate('no action')->onDelete('no action');
            $table->foreign('id_privilegio')->references('id')->on('privilegios')
                ->onUpdate('no action')->onDelete('no action');
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
        //
    }
}
