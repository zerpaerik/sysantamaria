<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Atenciones;
use App\Models\Debitos;
use App\Models\Analisis;
use App\Models\Creditos;
use App\Models\Personal;
use App\Models\ResultadosServicios;
use App\Models\ResultadosLaboratorios;
use App\Informe;
use Carbon\Carbon;
use Auth;


class ResultadosGuardadosController extends Controller

{

	public function index(Request $request){


      if(! is_null($request->paciente)) {   


        $resultadosguardados = DB::table('atenciones as a')
        ->select('a.id','a.id_paciente','a.origen_usuario','a.atendido','a.fecha_atencion','a.origen','a.id_servicio','a.pendiente','a.id_paquete','a.id_laboratorio','a.monto','a.porcentaje','a.created_at','a.abono','a.pendiente','a.es_servicio','a.es_laboratorio','a.es_paquete','a.resultado','b.nombres','b.apellidos','b.dni','c.detalle as servicio','e.name','e.lastname','d.name as laboratorio','p.name as nomper','p.lastname as apeper','pq.detalle as paquete')
        ->join('pacientes as b','b.id','a.id_paciente')
        ->join('servicios as c','c.id','a.id_servicio')
        ->join('analises as d','d.id','a.id_laboratorio')
        ->join('users as e','e.id','a.origen_usuario')
        ->join('paquetes as pq','pq.id','a.id_paquete')
        ->join('personals as p','a.atendido','p.id')
        ->where('a.id_paciente','=',$request->paciente)
        //->where('a.es_paquete','<>',1)
        ->whereNotIn('a.monto',[0,0.00])
        //->whereBetween('a.fecha_atencion', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])
        ->where('a.atendido','<>',NULL)
        ->orderby('a.id','desc')
        ->get();

        $total = Atenciones::where('id_paciente','=',$request->paciente)
                       ->where('atendido','<>',NULL)
                        ->whereNotIn('monto',[0,0.00])
                        ->whereNotIn('es_paquete',[1])
                      ->select(DB::raw('COUNT(*) as cantidad'))
                      ->first();

      } else {

         $resultadosguardados = DB::table('atenciones as a')
        ->select('a.id','a.id_paciente','a.origen_usuario','a.atendido','a.fecha_atencion','a.origen','a.id_servicio','a.fecha_atencion','a.pendiente','a.id_paquete','a.id_laboratorio','a.monto','a.porcentaje','a.created_at','a.abono','a.pendiente','a.es_servicio','a.es_laboratorio','a.es_paquete','a.resultado','b.nombres','b.apellidos','b.dni','c.detalle as servicio','e.name','e.lastname','d.name as laboratorio','p.name as nomper','p.lastname as apeper','pq.detalle as paquete')
        ->join('pacientes as b','b.id','a.id_paciente')
        ->join('servicios as c','c.id','a.id_servicio')
        ->join('analises as d','d.id','a.id_laboratorio')
        ->join('paquetes as pq','pq.id','a.id_paquete')
        ->join('users as e','e.id','a.origen_usuario')
        ->join('personals as p','a.atendido','p.id')
        ->whereNotIn('a.monto',[0,0.00])
        ->whereDate('a.fecha_atencion', '=',date('Y-m-d'))
        ->orderby('a.id','desc')
        ->get();

        $total = Atenciones::where('fecha_atencion','=',date('Y-m-d'))
                     ->whereNotIn('monto',[0,0.00])
                      ->select(DB::raw('COUNT(*) as cantidad'))
                      ->first();

      }

      $informe = Informe::all();
      $personal = Personal::all();

      $pacientes = DB::table('pacientes as a')
      ->select('a.id','a.nombres','a.apellidos','a.dni','b.id_paciente')
      ->join('atenciones as b','b.id_paciente','a.id')
      ->groupBy('a.id')
      ->get();

       return view('resultadosguardados.index', ['resultadosguardados' => $resultadosguardados, 'personal' => $personal, 'pacientes' => $pacientes,'total' => $total]); 
	}

   public function search(Request $request){
      //Pendiente Validar Fechas de entrada, lo hago despues
      $resultadosguardados = $this->elasticSearch($request->inicio);

    return view('resultadosguardados.search', ["resultadosguardados" => $resultadosguardados]);

  }

   private function elasticSearch($initial)
  {

   $resultadosguardados = DB::table('atenciones as a')
        ->select('a.id','a.id_paciente','a.origen_usuario','a.origen','a.id_servicio','a.pendiente','a.id_laboratorio','a.monto','a.porcentaje','a.created_at','a.abono','a.pendiente','a.es_servicio','a.es_laboratorio','a.es_paquete','a.resultado','b.nombres','b.apellidos','c.detalle as servicio','e.name','e.lastname','d.name as laboratorio')
        ->join('pacientes as b','b.id','a.id_paciente')
        ->join('servicios as c','c.id','a.id_servicio')
        ->join('analises as d','d.id','a.id_laboratorio')
        ->join('users as e','e.id','a.origen_usuario')
        ->whereNotIn('a.monto',[0,0.00])
        ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($initial)), date('Y-m-d 23:59:59', strtotime($initial))])
        ->where('a.id_sede','=', \Session::get("sede"))
        ->where('a.resultado','=', 1)
        ->orderby('a.id','desc')
        ->paginate(20);

    return $resultadosguardados;
  }


	public function editView($id){

    $atencion = Atenciones::findOrFail($id);

    return view('resultados.create', compact('atencion'));

    }

	 public function edit($id,Request $request){


     $searchAtenciones = DB::table('atenciones')
                    ->select('*')
                   // ->where('estatus','=','1')
                    ->where('id','=', $request->id)
                    ->get();

            foreach ($searchAtenciones as $atenciones) {
                    $es_servicio = $atenciones->es_servicio;
                    $es_laboratorio = $atenciones->es_laboratorio;
                }

        if (!is_null($es_servicio)) {

           $searchAtencionesServicios = DB::table('atenciones')
                    ->select('*')
                   // ->where('estatus','=','1')
                    ->where('id','=', $request->id)
                    ->get();

            foreach ($searchAtencionesServicios as $servicios) {
                    $id_servicio = $servicios->id_servicio;
                }

                $p = Atenciones::findOrFail($id);
                $p->resultado = 1;
                $p->save();


                $creditos = new ResultadosServicios();
                $creditos->id_atencion = $request->id;
                $creditos->id_servicio = $id_servicio;
                $creditos->descripcion= $request->descripcion;
                $creditos->save();

       } else {

           $searchAtencionesLaboratorios = DB::table('atenciones')
                    ->select('*')
                   // ->where('estatus','=','1')
                    ->where('id','=', $request->id)
                    ->get();

            foreach ($searchAtencionesLaboratorios as $laboratorio) {
                    $id_laboratorio = $laboratorio->id_laboratorio;
                }


                 $p = Atenciones::findOrFail($id);
                $p->resultado = 1;
                $p->save();


                $creditos = new ResultadosLaboratorios();
                $creditos->id_atencion = $request->id;
                $creditos->id_laboratorio = $id_laboratorio;
                $creditos->descripcion= $request->descripcion;
                $creditos->save();

       }
                
      return redirect()->action('ResultadosController@index');

    }

 //

    }


