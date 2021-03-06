<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use App\Models\Atenciones;
use App\Models\Debitos;
use App\Models\Pacientes\Paciente;
use App\Models\Creditos;
use App\Models\Historiales;
use App\Models\HistorialCobros;
use App\Models\LaboratoriosPagados;

use Auth;


class LaboratoriosPagadosController extends Controller

{

	public function index(Request $request)
  {


  	if(! is_null($request->fecha)) {

    $f1 = $request->fecha;
    $f2 = $request->fecha2;  

    $pagados = DB::table('laboratorios_pagados as a')
    ->select('a.id','a.laboratorio','a.analisis','a.monto','a.paciente','a.usuario','a.created_at','a.sede','b.name as laboratorio','d.name as analisis','e.name as nombre','e.lastname as apellido','p.nombres as nompac','p.apellidos as apepac')
    ->join('laboratorios as b','b.id','a.laboratorio')
    ->join('analises as d','d.id','a.analisis')
    ->join('users as e','e.id','a.usuario')
    ->join('pacientes as p','p.id','a.paciente')
    ->whereBetween('a.created_at',[$f1,$f2])
    ->orderby('a.id','desc')
    ->get(); 

} else {

	  $pagados = DB::table('laboratorios_pagados as a')
    ->select('a.id','a.laboratorio','a.analisis','a.monto','a.paciente','a.usuario','a.created_at','a.sede','b.name as laboratorio','d.name as analisis','e.name as nombre','e.lastname as apellido','p.nombres as nompac','p.apellidos as apepac')
    ->join('laboratorios as b','b.id','a.laboratorio')
    ->join('analises as d','d.id','a.analisis')
    ->join('users as e','e.id','a.usuario')
    ->join('pacientes as p','p.id','a.paciente')
    ->orderby('a.id','desc')
    ->get(); 



}

        return view('movimientos.labpagados.index', ['pagados' => $pagados]); 
	}



	

}
