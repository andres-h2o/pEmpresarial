<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTriggerDeleteMovimiento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('

        CREATE TRIGGER tr_deleteMovimiento AFTER delete ON detalle_movimientos
        FOR EACH ROW BEGIN
                if(old.tipo="I")then
                     UPDATE informes SET ingresos=ingresos-old.monto
                     WHERE informes.id=old.id_informe;
                elseif old.tipo="E" then
                    UPDATE informes SET egresos=egresos-old.monto
                    WHERE informes.id=old.id_informe;
                end if;
                UPDATE informes SET saldo=ingresos-egresos
                WHERE informes.id=old.id_informe;

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
