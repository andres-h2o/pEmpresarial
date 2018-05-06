<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTriggerNuevoEvento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('

        CREATE TRIGGER tr_nuevoInforme AFTER insert ON eventos
        FOR EACH ROW BEGIN
           insert into informes (ingresos,egresos,saldo,id_evento) values (0,0,0,new.id);
            select id into @id from informes;
            insert into detalle_movimientos (tipo,detalle,responsable,monto,id_informe)
           values ("I","Inscripciones","Tesorero",0,@id);
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
