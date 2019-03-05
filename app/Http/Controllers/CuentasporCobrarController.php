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


class CuentasporCobrarController extends Controller

{

	public function index(Request $request)
  {

    $cuentasporcobrar = DB::table('atenciones as a')
    ->select('a.id','a.created_at','a.id_paciente','a.origen_usuario','a.origen','a.id_servicio','a.pendiente','a.id_laboratorio','a.monto','a.porcentaje','a.abono','a.pendiente','b.nombres','b.apellidos','b.dni','c.detalle as servicio','e.name','e.lastname','d.name as laboratorio')
    ->join('pacientes as b','b.id','a.id_paciente')
    ->join('servicios as c','c.id','a.id_servicio')
    ->join('analises as d','d.id','a.id_laboratorio')
    ->join('users as e','e.id','a.origen_usuario')
    ->where('a.pendiente','>',0)
    ->whereNotIn('a.monto',[0,0.00])
    ->orderby('a.id','desc')
    ->get(); 

    $aten = Atenciones::whereNotIn('origen_usuario',[99999999])
                      ->where('pendiente','>',0)
                      ->whereNotIn('monto',[0,0.00])
                      ->select(DB::raw('SUM(pendiente) as monto'))
                      ->first();

      $totalorigen = Atenciones::where('pendiente','>',0)
                                     ->whereNotIn('monto',[0,0.00])
                                     ->select(DB::raw('COUNT(*) as total'))
                                     ->first();
        
        return view('movimientos.cuentasporcobrar.index', ['cuentasporcobrar' => $cuentasporcobrar,'aten' => $aten,'total' => $totalorigen]); 
  }


  public function search(Request $request)
  {
    $search = $request->nom;
    $split = explode(" ",$search);

    if (!isset($split[1])) {
     
      $split[1] = '';
      $cuentasporcobrar = $this->elasticSearch($split[0],$split[1]);   
      return view('movimientos.cuentasporcobrar.index', [
      "icon" => "fa-list-alt",
      "model" => "cuentasporcobrar",
      "model1" => "Cuentas Por Cobrar",
      "headers" => ["id", "Nombre Paciente", "Apellido Paciente","Monto","Monto Abonado","Monto Pendiente","Fecha Atenciòn","Acción"],
      "data" => $cuentasporcobrar,
      "fields" => ["id", "nombres", "apellidos","monto","abono","pendiente","created_at"],
        "actions" => [
          '<button type="button" class="btn btn-info">Transferir</button>',
          '<button type="button" class="btn btn-warning">Editar</button>'
        ]
    ]); 
    }else{
      $cuentasporcobrar = $this->elasticSearch($split[0],$split[1]);  
      return view('movimientos.cuentasporcobrar.index', [
      "icon" => "fa-list-alt",
      "model" => "cuentasporcobrar",
      "model1" => "Cuentas Por Cobrar",
      "headers" => ["id", "Nombre Paciente", "Apellido Paciente","Monto","Monto Abonado","Monto Pendiente","Fecha Atenciòn","Acción"],
      "data" => $cuentasporcobrar,
      "fields" => ["id", "nombres", "apellidos","monto","abono","pendiente","created_at"],
        "actions" => [
          '<button type="button" class="btn btn-info">Transferir</button>',
          '<button type="button" class="btn btn-warning">Editar</button>'
        ]
    ]); 
    }          
  }

	public function editView($id){
      $p = Atenciones::find($id);
      return view('movimientos.cuentasporcobrar.edit', ["pendiente" => $p->pendiente,"id" => $p->id]);
    }

	 public function edit(Request $request){

       $searchAtencionID = DB::table('atenciones')
                    ->select('*')
                   // ->where('estatus','=','1')
                    ->where('id','=', $request->id)
                    ->first();                    
                    //->get();
                    
                    $pendiente = $searchAtencionID->pendiente;
					$abono = $searchAtencionID->abono;
                    $atencion = $searchAtencionID->id;
					$paciente = $searchAtencionID->id_paciente;
				    $monto = $searchAtencionID->monto;



                    $p = Atenciones::find($request->id);
                    $p->pendiente = $pendiente-$request->monto;
					$p->abono = $abono + $request->monto;
                    $res = $p->save();
					
					$historialcobros = new HistorialCobros();
                    $historialcobros->id_atencion = $atencion;
                    $historialcobros->id_paciente = $paciente;
                    $historialcobros->monto= $monto;
                    $historialcobros->abono = $abono + $request->monto;
					$historialcobros->abono_parcial = $request->monto;
                    $historialcobros->pendiente = $p->pendiente;
                    $historialcobros->save();
					
					
                    $creditos = new Creditos();
                    $creditos->origen = 'CUENTAS POR COBRAR';
                    $creditos->id_atencion = $atencion;
                    $creditos->monto= $request->monto;
                    $creditos->tipo_ingreso = $request->tipopago;
                    $creditos->descripcion = 'CUENTAS POR COBRAR';
                    $creditos->save();
					
					$historial = new Historiales();
          $historial->accion ='Registro';
          $historial->origen ='Cuentas por Cobrar';
		  $historial->detalle = $request->monto;
          $historial->id_usuario = \Auth::user()->id;
          $historial->save();



      return redirect()->action('CuentasporCobrarController@index', ["edited" => $res]);
    }

  private function elasticSearch($nom, $ape)
  {
     $cuentasporcobrar = DB::table('atenciones as a')
    ->select('a.id','a.created_at','a.id_paciente','a.origen_usuario','a.origen','a.id_servicio','a.pendiente','a.id_laboratorio','a.monto','a.porcentaje','a.abono','a.pendiente','b.nombres','b.apellidos','c.detalle as servicio','e.name','e.lastname','d.name as laboratorio')
    ->join('pacientes as b','b.id','a.id_paciente')
    ->join('servicios as c','c.id','a.id_servicio')
    ->join('analises as d','d.id','a.id_laboratorio')
    ->join('users as e','e.id','a.origen_usuario')
    ->where('b.nombres','like','%'.$nom.'%')
    ->where('b.apellidos','like','%'.$ape.'%')
    ->where('a.pendiente','>',0)
    ->whereNotIn('a.monto',[0,0.00])
    ->orderby('a.id','desc')
    ->get(); 

    return $cuentasporcobrar;   
  }
}
