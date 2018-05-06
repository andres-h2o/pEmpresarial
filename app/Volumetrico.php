<?php

namespace Practica;

use Illuminate\Database\Eloquent\Model;

class Volumetrico extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'volumetricos';

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
    protected $fillable = ['nombre', 'a', 'b', 'h', 'o', 'swc', 'gop', 'g'];

    
}
