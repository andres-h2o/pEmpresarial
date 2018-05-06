<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTriggerInsertMovimiento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('

        CREATE TRIGGER tr_newMovimiento AFTER insert ON detalle_movimientos
        FOR EACH ROW BEGIN
                if new.tipo="I" THEN

                    UPDATE informes SET ingresos=ingresos+NEW.monto
                    WHERE informes.id=NEW.id_informe;
                elseif  new.tipo="E"  then
                    UPDATE informes SET egresos=egresos+NEW.monto
                    WHERE informes.id=NEW.id_informe;
                end if;
                UPDATE informes SET saldo=ingresos-egresos
                WHERE informes.id=NEW.id_informe;

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
