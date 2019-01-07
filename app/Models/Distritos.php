<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Distritos extends Model
{
    protected $fillable = [
    	'nombre', 'provincia'
    ];



  public static function distbypro($id){
                $distritos = DB::table('distritos as a')
                ->select('a.nombre')
                     ->where('a.id_provincia','=', $id)
                     ->get()->pluck('nombre');

         if(!is_null($distritos)){
            return $distritos;
         }else{
            return false;
         }

    }



}
