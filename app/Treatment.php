<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Treatment extends Model
{
    protected $guarded = [];

    public function Consultas()
    {
    	return $this->belongsTo('App\Consulta');
    }
}
