<?php

namespace Practica;

use Illuminate\Database\Eloquent\Model;

class Detalle_bitacora extends Model
{
    protected $table = 'detalle_bitacoras';
    protected $fillable = ['fecha','accion','detalle','id_bitacora'];

    public function scope_detallesBitacora($query,$id_bitacora)
    {
        $detalles =$query->where('id_bitacora',$id_bitacora)
            ->orderby('created_at','desc');
        return  $detalles;
    }
}
