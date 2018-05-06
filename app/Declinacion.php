<?php

namespace Practica;

use Illuminate\Database\Eloquent\Model;

class Declinacion extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'declinacions';

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
    protected $fillable = ['t', 'v1', 'v2', 'v3'];

    
}
