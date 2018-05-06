<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIglesiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('iglesias', function (Blueprint $table) {
            $table->increments('cod');
            $table->string('nombre',100);
            $table->integer('ci_pastor')->unsigned()->nullable();
            $table->string('pais',50);
            $table->string('departamento',50);
            $table->string('ciudad',50);
            $table->string('direccion',100)->nullable();
            $table->foreign('ci_pastor')->references('ci')->on('pastors');
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
        Schema::dropIfExists('iglesias');
    }
}
