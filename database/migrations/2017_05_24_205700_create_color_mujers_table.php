<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateColorMujersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('color_mujers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('color',10);
            $table->string('codigo',8);
            $table->integer('id_evento')->unsigned();

            $table->foreign('id_evento')->references('id')->on('eventos')
                ->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('color_mujers');
    }
}
