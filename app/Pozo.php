<?php

namespace Practica;

use Illuminate\Database\Eloquent\Model;

class Pozo extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'pozos';

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
    protected $fillable = ['Pozo', 'x', 'y'];

    
}
