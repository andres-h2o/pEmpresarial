<?php

namespace Practica;

use Illuminate\Database\Eloquent\Model;

class ValArm extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'val_arms';

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
    protected $fillable = ['t', 'q', 'id_armonicas'];

    
}
