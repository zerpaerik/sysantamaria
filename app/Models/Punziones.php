<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Punziones extends Model
{
    protected $fillable = [
    	'id_producto','cantidad','precio','origen','usuario','tipo_ingreso','tipo_servicio','paciente'
    ];

}
