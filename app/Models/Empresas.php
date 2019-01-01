<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empresas extends Model
{
    protected $fillable = [
    	'nombre','rif','direccion','personacontacto','telefono','estatus','user'
    ];
}
