<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Consulta;
use App\Http\Requests\CreateConsultaRequest;
use Carbon\Carbon;
use DB;
use App\Models\ConsultaMateriales;
use App\Models\Atenciones;
use App\Models\Personal;
use App\Models\Punziones;
use App\Models\Events\Event;
use App\Models\Existencias\{Producto, Existencia, Transferencia,Historiales};
use Toastr;
use App\Historial;
use App\Treatment;

class ProduccionController extends Controller
{


   public function index(Request $request){

   	if((!is_null($request->fecha)) && (is_null($request->fecha))){


   		$f1=$request->fecha;
   		$f2=$request->fecha2;


   		 $consultas = DB::table('events as a')
        ->select('a.id','a.profesional','a.paciente','a.time','a.monto','a.date','a.created_at','b.nombres','b.apellidos','c.name','c.lastname as apepro','r.start_time','r.end_time')
        ->join('pacientes as b','b.id','a.paciente')
        ->join('personals as c','c.id','a.profesional')
        ->join('rangoconsultas as r','r.id','a.time')
        ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])
        ->orderby('a.id','desc')
        ->get();

        $totalconsultas = Event::whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($f1                         )), date('Y-m-d 23:59:59', strtotime($f2))])
                                    ->select(DB::raw('SUM(monto) as monto'))
                                    ->first();
        $totalc = Event::whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date                         ('Y-m-d 23:59:59', strtotime($f2))])
                                    ->select(DB::raw('COUNT(*) as cantidad'))
                                    ->first();

      $punziones = DB::table('punziones as a')
                    ->select('a.id','a.id_producto','a.cantidad','a.usuario','a.paciente','a.origen','a.precio','a.tipo_ingreso','a.created_at','c.name','c.lastname','d.nombre','d.codigo','p.name as nomper','p.lastname as apeper','b.nombres','b.apellidos')
                    ->join('users as c','c.id','a.usuario')
                    ->join('productos as d','d.id','a.id_producto')
                    ->join('personals as p','a.origen','p.id')
                    ->join('pacientes as b','a.paciente','b.id')
                    ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])
                    ->orderby('a.created_at','desc')
                    ->get(); 


		             $totalpunziones = Punziones::whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59',strtotime($f2))])
		                                    ->select(DB::raw('SUM(precio) as monto'))
		                                    ->first();

				            if ($totalpunziones->monto == 0) {
				        }
          
			           $totalp = Punziones::whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59',                        strtotime($f2))])
			               ->select(DB::raw('COUNT(*) as cantidad'))
			               ->first(); 

	   $sesiones = DB::table('atenciones as a')
        ->select('a.id','a.id_paquete','a.id_paciente','a.origen_usuario','a.atendido','a.es_servicio','a.es_laboratorio','a.created_at','a.origen','a.id_servicio','a.es_paquete','a.pendiente','a.id_laboratorio','a.monto','a.porcentaje','a.abono','a.pendiente','a.resultado','b.nombres','b.apellidos','b.dni','c.detalle as servicio','e.name','e.lastname','d.name as laboratorio','pa.detalle as paquete','pr.name as nomate','pr.lastname as apeate')
        ->join('pacientes as b','b.id','a.id_paciente')
        ->join('servicios as c','c.id','a.id_servicio')
        ->join('analises as d','d.id','a.id_laboratorio')
        ->join('users as e','e.id','a.origen_usuario')
        ->join('paquetes as pa','pa.id','a.id_paquete')
        ->join('personals as pr','pr.id','a.atendido')
        ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])
        ->where('a.atendido','<>',NULL)
        ->whereNotIn('a.monto',[0,0.00])
        //->whereNotIn('a.es_paquete',[1])
        ->where('a.resultado','=', NULL)
        ->orderby('a.id','desc')
        ->get();

          $totalsesiones = Atenciones::whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59',strtotime($f2))])
                                            ->where('atendido','<>',NULL)
		                                    ->select(DB::raw('SUM(abono) as monto'))
		                                    ->first();

				            if ($totalsesiones->monto == 0) {
				        }
	      $totals = Atenciones::whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59',strtotime($f2))])
	                       ->where('atendido','<>',NULL)
			               ->select(DB::raw('COUNT(*) as cantidad'))
			               ->first(); 


   	}elseif((!is_null($request->fecha)) && (!is_null($request->pro))){



   			$f1=$request->fecha;
   		    $f2=$request->fecha2;

           

 

       $consultas = DB::table('events as a')
        ->select('a.id','a.profesional','a.paciente','a.time','a.monto','a.date','a.created_at','b.nombres','b.apellidos','c.name','c.lastname as apepro','r.start_time','r.end_time')
        ->join('pacientes as b','b.id','a.paciente')
        ->join('personals as c','c.id','a.profesional')
        ->join('rangoconsultas as r','r.id','a.time')
        ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])
        ->where('a.profesional','=',$request->pro)
        ->orderby('a.id','desc')
        ->get();

        $totalconsultas = Event::whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($f1                         )), date('Y-m-d 23:59:59', strtotime($f2))])
                                    ->where('profesional','=',$request->pro) 
                                    ->select(DB::raw('SUM(monto) as monto'))
                                    ->first();

        $totalc = Event::whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date                         ('Y-m-d 23:59:59', strtotime($f2))])
                                     ->where('profesional','=',$request->pro) 
                                    ->select(DB::raw('COUNT(*) as cantidad'))
                                    ->first();

      $punziones = DB::table('punziones as a')
                    ->select('a.id','a.id_producto','a.cantidad','a.usuario','a.paciente','a.origen','a.precio','a.tipo_ingreso','a.created_at','c.name','c.lastname','d.nombre','d.codigo','p.name as nomper','p.lastname as apeper','b.nombres','b.apellidos')
                    ->join('users as c','c.id','a.usuario')
                    ->join('productos as d','d.id','a.id_producto')
                    ->join('personals as p','a.origen','p.id')
                    ->join('pacientes as b','a.paciente','b.id')
                    ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])
                    ->where('a.origen','=',$request->pro) 
                    ->orderby('a.created_at','desc')
                    ->get(); 


		             $totalpunziones = Punziones::whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59',strtotime($f2))])
		                                    ->where('origen','=',$request->pro) 
		                                    ->select(DB::raw('SUM(precio) as monto'))
		                                    ->first();

				            if ($totalpunziones->monto == 0) {
				        }
          
			           $totalp = Punziones::whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59',                        strtotime($f2))])
			           	   ->where('origen','=',$request->pro) 
			               ->select(DB::raw('COUNT(*) as cantidad'))
			               ->first(); 

	   $sesiones = DB::table('atenciones as a')
        ->select('a.id','a.id_paquete','a.id_paciente','a.origen_usuario','a.atendido','a.es_servicio','a.es_laboratorio','a.created_at','a.origen','a.id_servicio','a.es_paquete','a.pendiente','a.id_laboratorio','a.monto','a.porcentaje','a.abono','a.pendiente','a.resultado','b.nombres','b.apellidos','b.dni','c.detalle as servicio','e.name','e.lastname','d.name as laboratorio','pa.detalle as paquete','pr.name as nomate','pr.lastname as apeate')
        ->join('pacientes as b','b.id','a.id_paciente')
        ->join('servicios as c','c.id','a.id_servicio')
        ->join('analises as d','d.id','a.id_laboratorio')
        ->join('users as e','e.id','a.origen_usuario')
        ->join('paquetes as pa','pa.id','a.id_paquete')
        ->join('personals as pr','pr.id','a.atendido')
        ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])
        ->where('a.atendido','=',$request->pro)
        ->orderby('a.id','desc')
        ->get();

          $totalsesiones = Atenciones::whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59',strtotime($f2))])
                                            ->where('atendido','=',$request->pro)
		                                    ->select(DB::raw('SUM(abono) as monto'))
		                                    ->first();

				            if ($totalsesiones->monto == 0) {
				        }
	      $totals = Atenciones::whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59',strtotime($f2))])
                           ->where('atendido','=',$request->pro)
			               ->select(DB::raw('COUNT(*) as cantidad'))
			               ->first(); 



   	}elseif(!is_null($request->pro)){

   		  $f1 = Carbon::today()->toDateString();
          $f2 = Carbon::today()->toDateString(); 


      $consultas = DB::table('events as a')
        ->select('a.id','a.profesional','a.paciente','a.time','a.monto','a.date','a.created_at','b.nombres','b.apellidos','c.name','c.lastname as apepro','r.start_time','r.end_time')
        ->join('pacientes as b','b.id','a.paciente')
        ->join('personals as c','c.id','a.profesional')
        ->join('rangoconsultas as r','r.id','a.time')
        ->where('a.profesional','=',$request->pro)
        ->orderby('a.id','desc')
        ->get();

        $totalconsultas = Event::where('profesional','=',$request->pro) 
                                    ->select(DB::raw('SUM(monto) as monto'))
                                    ->first();

        $totalc = Event::where('profesional','=',$request->pro) 
                                    ->select(DB::raw('COUNT(*) as cantidad'))
                                    ->first();

      $punziones = DB::table('punziones as a')
                    ->select('a.id','a.id_producto','a.cantidad','a.usuario','a.paciente','a.origen','a.precio','a.tipo_ingreso','a.created_at','c.name','c.lastname','d.nombre','d.codigo','p.name as nomper','p.lastname as apeper','b.nombres','b.apellidos')
                    ->join('users as c','c.id','a.usuario')
                    ->join('productos as d','d.id','a.id_producto')
                    ->join('personals as p','a.origen','p.id')
                    ->join('pacientes as b','a.paciente','b.id')
                    ->where('a.origen','=',$request->pro) 
                    ->orderby('a.created_at','desc')
                    ->get(); 


		             $totalpunziones = Punziones::where('origen','=',$request->pro) 
		                                    ->select(DB::raw('SUM(precio) as monto'))
		                                    ->first();

				            if ($totalpunziones->monto == 0) {
				        }
          
			           $totalp = Punziones::where('origen','=',$request->pro) 
			               ->select(DB::raw('COUNT(*) as cantidad'))
			               ->first(); 
 $sesiones = DB::table('atenciones as a')
        ->select('a.id','a.id_paquete','a.id_paciente','a.origen_usuario','a.atendido','a.es_servicio','a.es_laboratorio','a.created_at','a.origen','a.id_servicio','a.es_paquete','a.pendiente','a.id_laboratorio','a.monto','a.porcentaje','a.abono','a.pendiente','a.resultado','b.nombres','b.apellidos','b.dni','c.detalle as servicio','e.name','e.lastname','d.name as laboratorio','pa.detalle as paquete','pr.name as nomate','pr.lastname as apeate')
        ->join('pacientes as b','b.id','a.id_paciente')
        ->join('servicios as c','c.id','a.id_servicio')
        ->join('analises as d','d.id','a.id_laboratorio')
        ->join('users as e','e.id','a.origen_usuario')
        ->join('paquetes as pa','pa.id','a.id_paquete')
        ->join('personals as pr','pr.id','a.atendido')
        ->where('a.atendido','=',$request->pro)
        ->orderby('a.id','desc')
        ->get();

          $totalsesiones = Atenciones::where('atendido','=',$request->pro)
		                                    ->select(DB::raw('SUM(abono) as monto'))
		                                    ->first();

				            if ($totalsesiones->monto == 0) {
				        }
	      $totals = Atenciones::where('atendido','=',$request->pro)
			               ->select(DB::raw('COUNT(*) as cantidad'))
			               ->first(); 


   	}else{

   		 $f1 = Carbon::today()->toDateString();
          $f2 = Carbon::today()->toDateString(); 


            $consultas = DB::table('events as a')
        ->select('a.id','a.profesional','a.paciente','a.time','a.monto','a.date','a.created_at','b.nombres','b.apellidos','c.name','c.lastname as apepro','r.start_time','r.end_time')
        ->join('pacientes as b','b.id','a.paciente')
        ->join('personals as c','c.id','a.profesional')
        ->join('rangoconsultas as r','r.id','a.time')
        ->orderby('a.id','desc')
        ->get();

        $totalconsultas = Event::select(DB::raw('SUM(monto) as monto'))
                                    ->first();

        $totalc = Event::select(DB::raw('COUNT(*) as cantidad'))
                                    ->first();

      $punziones = DB::table('punziones as a')
                    ->select('a.id','a.id_producto','a.cantidad','a.usuario','a.paciente','a.origen','a.precio','a.tipo_ingreso','a.created_at','c.name','c.lastname','d.nombre','d.codigo','p.name as nomper','p.lastname as apeper','b.nombres','b.apellidos')
                    ->join('users as c','c.id','a.usuario')
                    ->join('productos as d','d.id','a.id_producto')
                    ->join('personals as p','a.origen','p.id')
                    ->join('pacientes as b','a.paciente','b.id')
                    ->orderby('a.created_at','desc')
                    ->get(); 


		             $totalpunziones = Punziones::select(DB::raw('SUM(precio) as monto'))
		                                    ->first();

				            if ($totalpunziones->monto == 0) {
				        }
          
			           $totalp = Punziones::select(DB::raw('COUNT(*) as cantidad'))
			               ->first(); 

	   $sesiones = DB::table('atenciones as a')
        ->select('a.id','a.id_paquete','a.id_paciente','a.origen_usuario','a.atendido','a.es_servicio','a.es_laboratorio','a.created_at','a.origen','a.id_servicio','a.es_paquete','a.pendiente','a.id_laboratorio','a.monto','a.porcentaje','a.abono','a.pendiente','a.resultado','b.nombres','b.apellidos','b.dni','c.detalle as servicio','e.name','e.lastname','d.name as laboratorio','pa.detalle as paquete','pr.name as nomate','pr.lastname as apeate')
        ->join('pacientes as b','b.id','a.id_paciente')
        ->join('servicios as c','c.id','a.id_servicio')
        ->join('analises as d','d.id','a.id_laboratorio')
        ->join('users as e','e.id','a.origen_usuario')
        ->join('paquetes as pa','pa.id','a.id_paquete')
        ->join('personals as pr','pr.id','a.atendido')
        ->orderby('a.id','desc')
        ->get();

          $totalsesiones = Atenciones::select(DB::raw('SUM(abono) as monto'))
                                             ->where('atendido','<>',NULL)
		                                    ->first();

				            if ($totalsesiones->monto == 0) {
				        }
	      $totals = Atenciones::select(DB::raw('COUNT(*) as cantidad'))
                                                       ->where('atendido','<>',NULL)
			                                           ->first(); 


   	}



    
    



            $personal = Personal::where('estatus','=',1)->get();
       
        return view('produccion.index',["personal" => $personal,"f1" => $f1,"f2" => $f2,"consultas" => $consultas, "totalconsultas" => $totalconsultas,"totalc" => $totalc,"punziones" => $punziones, "totalpunziones" => $totalpunziones,"totalp" => $totalp,"sesiones" => $sesiones, "totalsesiones" => $totalsesiones,"totals" => $totals]);
    }

   
      
}
