<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class empleados extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['codigo','nombre','salarioDolares','salarioPesos','direccion','estado','ciudad','telefono','correo','active','deleted_at'];
}
