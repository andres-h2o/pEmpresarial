<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetallePuntajeTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        DB::unprepared('

        CREATE TRIGGER tr_newPuntaje AFTER insert ON detalle_puntajes
        FOR EACH ROW BEGIN

               UPDATE puntajes SET puntos=puntos+NEW.puntos
                WHERE puntajes.id=NEW.id_puntaje;
        END

        ');
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
