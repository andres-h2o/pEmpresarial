<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateVolumetricosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('volumetricos', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('nombre')->nullable();
            $table->double('a')->nullable();
            $table->double('b')->nullable();
            $table->double('h')->nullable();
            $table->double('o')->nullable();
            $table->double('swc')->nullable();
            $table->integer('gop')->nullable();
            $table->double('g')->nullable();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('volumetricos');
    }
}
