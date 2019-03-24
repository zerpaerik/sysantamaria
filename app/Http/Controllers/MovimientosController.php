<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use App\Models\Atenciones;
use App\Models\Debitos;
use App\Models\Analisis;
use App\Models\Creditos;
use App\Models\Historiales;
use App\Models\HistorialCobros;
use Auth;


class MovimientosController extends Controller

{

	public function index(Request $request)
  {

  	if($request->tipo){
  		$tipo=$request->tipo;
  	}else{
  		$tipo='';
  	}

 
  	if(!is_null($request->fecha)){

  		$fecha=$request->fecha;

  $atenciones = DB::table('atenciones as a')
          ->select('a.id','a.tipo_factura','a.numero_serie','a.usuario','a.numero_factura','a.created_at','a.id_paciente','a.origen_usuario','a.origen','a.id_servicio','a.id_paquete','a.id_laboratorio','a.es_servicio','a.estatus','a.es_laboratorio','a.es_paquete','a.monto','a.porcentaje','a.abono','b.nombres','b.apellidos','b.dni','c.detalle as servicio','e.name','e.lastname','d.name as laboratorio','f.detalle as paquete','u.name as username','u.lastname as userlast')
          ->join('pacientes as b','b.id','a.id_paciente')
          ->join('servicios as c','c.id','a.id_servicio')
          ->join('analises as d','d.id','a.id_laboratorio')
          ->join('users as e','e.id','a.origen_usuario')
          ->join('paquetes as f','f.id','a.id_paquete')
          ->join('users as u','u.id','a.usuario')
          ->where('a.estatus','=',1)
          ->whereNotIn('a.monto',[0,0.00,99999])
         // ->where('a.created_at', '=',$fecha)
          ->whereDate('a.created_at', [date('Y-m-d 00:00:00', strtotime($fecha))])
          ->orderby('a.id','desc')
          ->get();



    $consultas = DB::table('events as e')
    ->select('e.id as EventId','e.paciente','e.monto','e.usuario','e.comollego','e.title','e.created_at','e.evaluacion','e.profesional','e.date','e.time','p.dni','p.direccion','p.telefono','p.fechanac','p.gradoinstruccion','p.ocupacion','p.nombres','p.apellidos','p.id as pacienteId','per.name as nombrePro','per.lastname as apellidoPro','per.id as profesionalId','rg.start_time','rg.end_time','rg.id','eva.nombre as nombreEval','u.name as username','u.lastname as userlast')
    ->join('pacientes as p','p.id','=','e.paciente')
    ->join('personals as per','per.id','=','e.profesional')
    ->join('rangoconsultas as rg','rg.id','=','e.time')
    ->join('evaluaciones as eva','eva.id','=','e.evaluacion')
        ->join('users as u','u.id','e.usuario')
          ->whereDate('e.created_at', [date('Y-m-d 00:00:00', strtotime($fecha))])
    ->get();

     $ventas = DB::table('ventas as a')
            ->select('a.id','a.id_producto','a.created_at','a.monto','a.id_usuario','a.cantidad','e.name','e.lastname','b.nombre','b.codigo')
            ->join('users as e','e.id','a.id_usuario')
            ->join('productos as b','b.id','a.id_producto')
          ->whereDate('a.created_at', [date('Y-m-d 00:00:00', strtotime($fecha))])
            ->orderby('a.id','desc')
            ->get();



    $punziones = DB::table('punziones as a')
                    ->select('a.id','a.id_producto','a.cantidad','a.usuario','a.origen','a.precio','a.tipo_ingreso','a.created_at','c.name','c.lastname','d.nombre','d.codigo','p.name as nomper','p.lastname as apeper','b.nombres','b.apellidos')
                    ->join('users as c','c.id','a.usuario')
                    ->join('productos as d','d.id','a.id_producto')
                    ->join('personals as p','a.origen','p.id')
                    ->join('pacientes as b','a.paciente','b.id')
                    ->whereDate('a.created_at', [date('Y-m-d 00:00:00', strtotime($fecha))])
                    ->orderby('a.created_at','desc')
                    ->get(); 

       $ingresos = DB::table('creditos as a')
            ->select('a.id','a.descripcion','a.monto','a.origen','a.created_at')
            ->orderby('a.id','desc')
          ->whereDate('a.created_at', [date('Y-m-d 00:00:00', strtotime($fecha))])
            ->where('a.origen','=','OTROS INGRESOS')
            ->get(); 

     } else {

     	 $atenciones = DB::table('atenciones as a')
          ->select('a.id','a.tipo_factura','a.numero_serie','a.usuario','a.numero_factura','a.created_at','a.id_paciente','a.origen_usuario','a.estatus','a.origen','a.id_servicio','a.id_paquete','a.id_laboratorio','a.es_servicio','a.es_laboratorio','a.es_paquete','a.monto','a.porcentaje','a.abono','b.nombres','b.apellidos','b.dni','c.detalle as servicio','e.name','e.lastname','d.name as laboratorio','f.detalle as paquete','u.name as username','u.lastname as userlast')
          ->join('pacientes as b','b.id','a.id_paciente')
          ->join('servicios as c','c.id','a.id_servicio')
          ->join('analises as d','d.id','a.id_laboratorio')
          ->join('users as e','e.id','a.origen_usuario')
          ->join('paquetes as f','f.id','a.id_paquete')
          ->join('users as u','u.id','a.usuario')
          ->where('a.estatus','=',1)
          ->whereNotIn('a.monto',[0,0.00,99999])
          ->whereDate('a.created_at', '=',Carbon::today()->toDateString())
          ->orderby('a.id','desc')
          ->get();

    $consultas = DB::table('events as e')
    ->select('e.id as EventId','e.paciente','e.monto','e.usuario','e.comollego','e.title','e.created_at','e.evaluacion','e.profesional','e.date','e.time','p.dni','p.direccion','p.telefono','p.fechanac','p.gradoinstruccion','p.ocupacion','p.nombres','p.apellidos','p.id as pacienteId','per.name as nombrePro','per.lastname as apellidoPro','per.id as profesionalId','rg.start_time','rg.end_time','rg.id','eva.nombre as nombreEval','u.name as username','u.lastname as userlast')
    ->join('pacientes as p','p.id','=','e.paciente')
    ->join('personals as per','per.id','=','e.profesional')
    ->join('rangoconsultas as rg','rg.id','=','e.time')
    ->join('evaluaciones as eva','eva.id','=','e.evaluacion')
        ->join('users as u','u.id','e.usuario')
    ->whereDate('e.created_at','=',Carbon::today()->toDateString())
    ->get();

     $ventas = DB::table('ventas as a')
            ->select('a.id','a.id_producto','a.created_at','a.monto','a.id_usuario','a.cantidad','e.name','e.lastname','b.nombre','b.codigo')
            ->join('users as e','e.id','a.id_usuario')
            ->join('productos as b','b.id','a.id_producto')
            ->whereDate('a.created_at', '=',Carbon::today()->toDateString())
            ->orderby('a.id','desc')
            ->get();



    $punziones = DB::table('punziones as a')
                    ->select('a.id','a.id_producto','a.cantidad','a.usuario','a.origen','a.precio','a.tipo_ingreso','a.created_at','c.name','c.lastname','d.nombre','d.codigo','p.name as nomper','p.lastname as apeper','b.nombres','b.apellidos')
                    ->join('users as c','c.id','a.usuario')
                    ->join('productos as d','d.id','a.id_producto')
                    ->join('personals as p','a.origen','p.id')
                    ->join('pacientes as b','a.paciente','b.id')
                     ->whereDate('a.created_at', '=',Carbon::today()->toDateString())
                    ->orderby('a.created_at','desc')
                    ->get(); 

       $ingresos = DB::table('creditos as a')
            ->select('a.id','a.descripcion','a.monto','a.origen','a.created_at')
            ->orderby('a.id','desc')
            ->whereDate('a.created_at','=', Carbon::now()->toDateString())
            ->where('a.origen','=','OTROS INGRESOS')
            ->get(); 

            $fecha = Carbon::now()->toDateString(); 

     }






  	 return view('movimientos.index',[
      'atenciones' => $atenciones,
      'ventas' => $ventas,
      'consultas' => $consultas,
      'punziones' => $punziones,
      'ingresos' => $ingresos,
      'fecha' => $fecha,
      'tipo' => $tipo

    ]);

  
}

}
