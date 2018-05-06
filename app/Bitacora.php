<?php

namespace Practica;

use Illuminate\Database\Eloquent\Model;

class Bitacora extends Model
{
    protected $table = 'bitacoras';
    protected $fillable = ['id_usuario'];

    public function scope_getIdUltima($query,$id_usuario)
    {
        $id = $query->where('id_usuario',$id_usuario)
            ->orderby('created_at','desc')->first()->id;
        return $id;
    }
    public function scope_bitacorasUsuario($query,$id_usuario)
    {
        $bitacoras =$query->where('id_usuario',$id_usuario)
            ->orderby('created_at','desc');
        return  $bitacoras;
    }
}
