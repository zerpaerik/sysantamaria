<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    protected $guarded = [];

    public function Treatment()
    {
    	return $this->hasOne('App\Treatment');
    }
}
