<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCampistasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campistas', function (Blueprint $table) {

            $table->increments('id');
            $table->string('nombre',50);
            $table->string('apellido',50);
            $table->integer('ci')->unsigned()->nullable();
            $table->date('fecha_nacimiento');
            $table->string('sexo',1);
            $table->integer('cod_iglesia')->unsigned()->nullable();
            $table->foreign('cod_iglesia')->references('cod')->on('iglesias')
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
        Schema::dropIfExists('campistas');
    }
}
