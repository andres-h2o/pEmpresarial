<?php

namespace Practica;

use Illuminate\Database\Eloquent\Model;

class Privilegio extends Model
{
    protected $table = 'privilegios';
    protected $fillable = ['cu'];
}
