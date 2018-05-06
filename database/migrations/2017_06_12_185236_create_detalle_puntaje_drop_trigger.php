<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetallePuntajeDropTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('

        CREATE TRIGGER tr_newPuntajeResta AFTER delete ON detalle_puntajes
        FOR EACH ROW BEGIN

        UPDATE puntajes SET puntos=puntos-old.puntos
                WHERE puntajes.id=old.id_puntaje;
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
