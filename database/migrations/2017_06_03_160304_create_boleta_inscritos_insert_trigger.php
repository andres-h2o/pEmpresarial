<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBoletaInscritosInsertTrigger extends Migration
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

        CREATE TRIGGER tr_ActInscritos AFTER insert ON boletas
        FOR EACH ROW BEGIN
                select id_evento into @evento from grupos
                where grupos.id=new.id_grupo;

                UPDATE eventos SET inscritos=inscritos+1
                WHERE eventos.id=@evento;

                select m.id into @movimiento
                from detalle_movimientos as m,informes as i,grupos as g
                where i.id_evento=g.id_evento and
                i.id=m.id_informe and
                g.id=new.id_grupo;

                UPDATE detalle_movimientos SET monto=monto+new.monto
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
