<?php

namespace Practica;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'categorias';
    protected $fillable = ['nombre',"v1","v2","v3","v4"];
}
