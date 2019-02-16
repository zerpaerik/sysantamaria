<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComisionPunzion extends Model
{
    protected $fillable = [
    	'origen', 'comision','usuario','monto','estatus'
    ];
}
