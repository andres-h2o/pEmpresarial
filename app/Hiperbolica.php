<?php

namespace Practica;

use Illuminate\Database\Eloquent\Model;

class Hiperbolica extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'hiperbolicas';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre', 'qi', 'q', 'd', 'b'];

    
}
