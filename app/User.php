<?php

namespace Practica;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','id_categoria'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function scope_buscarEmail($query,$email)
    {
        $id_usuario=$query->where('email',$email)->select('id')->get()->first()->id;
        return $id_usuario;
    }
    public function setPasswordAttribute($valor){
        if(!empty($valor)){
            $this->attributes['password']= \Hash::make($valor);
        }
    }
}
