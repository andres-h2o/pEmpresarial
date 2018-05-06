<?php

namespace Practica;

use Illuminate\Database\Eloquent\Model;

class Permiso extends Model
{
    protected $table = 'permisos';
    protected $fillable = ['id_categoria','id_privilegio'];

    public function scope_siTiene($query,$id_usuario,$cu)
    {
        $permiso=$query->join('users as u','u.id_categoria','permisos.id_categoria')
        ->where('u.id',$id_usuario)
        ->where('permisos.id_privilegio',$cu)->get();
        if(count($permiso)==0){
            return false;
        }
        return false;
    }
}
