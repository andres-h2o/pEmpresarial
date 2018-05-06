<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBoletaInscritosTrigger extends Migration
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

        CREATE TRIGGER tr_updInscritos AFTER Delete ON boletas
        FOR EACH ROW BEGIN
                select id_evento into @evento from grupos
                where grupos.id=old.id_grupo;

                UPDATE eventos SET inscritos=inscritos-1
                WHERE eventos.id=@evento;

                select m.id into @movimiento
                from detalle_movimientos as m,informes as i,grupos as g
                where i.id_evento=g.id_evento and
                i.id=m.id_informe and
                g.id=old.id_grupo;

                UPDATE detalle_movimientos SET monto=monto-old.monto
                WHERE detalle_movimientos.id=@movimiento;


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
