<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePozosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pozos', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('Pozo')->nullable();
            $table->double('x')->nullable();
            $table->double('y')->nullable();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pozos');
    }
}
