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
use App\Models\Servicios;
use App\Models\Pacientes;
use App\Models\Paquetes;
use App\User;
use Auth;
use Toastr;


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
                      ->whereNotIn('monto',[0,0.00,99999])
                      ->select(DB::raw('SUM(pendiente) as monto'))
                      ->first();

      $totalorigen = Atenciones::where('pendiente','>',0)
                                     //->whereNotIn('origen_usuario',[99999999])
                                     ->whereNotIn('monto',[0,0.00,99999])
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
            $origen= $searchAtencionID->origen;
            $origen_usuario= $searchAtencionID->origen_usuario;
            $paciente= $searchAtencionID->id_paciente;
            $tipo_factura=$searchAtencionID->tipo_factura;
            $numero_serie=$searchAtencionID->numero_serie;
            $numero_factura=$searchAtencionID->numero_factura;

            $es_laboratorio=$searchAtencionID->es_laboratorio;
            $es_servicio=$searchAtencionID->es_servicio;
            $es_paquete=$searchAtencionID->es_paquete;
            $servicio=$searchAtencionID->id_servicio;
            $lab=$searchAtencionID->id_laboratorio;
            $paquete=$searchAtencionID->id_paquete;
            $comollego=$searchAtencionID->comollego;
            $tp=$searchAtencionID->tipopago;



    




                    $p = Atenciones::find($request->id);
                    $p->pendiente = $pendiente-$request->monto;
					         // $p->abono = $abono + $request->monto;
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

                   $usuario=User::where('id','=',$origen_usuario)->first();

              if($usuario->esp==0){
              $paq = new Atenciones();
              $paq->tipo_factura = $tipo_factura;               
              $paq->numero_serie = $numero_serie;             
              $paq->numero_factura = $numero_factura;              
              $paq->id_paciente = $paciente;
              $paq->origen = $origen;
              $paq->origen_usuario = $origen_usuario;
              $paq->id_laboratorio =  $lab;
              $paq->id_servicio =  $servicio;
              $paq->id_paquete = $paquete;
              $paq->comollego = $comollego;
              $paq->es_servicio =$es_servicio;
              $paq->es_paquete =$es_laboratorio;
              $paq->es_laboratorio =$es_paquete;
              $paq->serv_prog = FALSE;
              $paq->tipopago = $tp;
              $paq->porc_pagar =10;
              $paq->porcentaje = ($request->monto*10)/100;
              $paq->pendiente = $pendiente-$request->monto;
              $paq->monto = $monto;
              $paq->abono = $request->monto;
              $paq->estatus = 2;
              $paq->usuario = Auth::user()->id;
              $paq->save(); 
            }elseif($usuario->esp==1){
               $paq = new Atenciones();
              $paq->tipo_factura = $tipo_factura;               
              $paq->numero_serie = $numero_serie;             
              $paq->numero_factura = $numero_factura;              
              $paq->id_paciente = $paciente;
              $paq->origen = $origen;
              $paq->origen_usuario = $origen_usuario;
              $paq->id_laboratorio =  $lab;
              $paq->id_servicio =  $servicio;
              $paq->id_paquete = $paquete;
              $paq->comollego = $comollego;
              $paq->es_paquete =  true;
              $paq->serv_prog = FALSE;
              $paq->tipopago = $tp;
              $paq->porc_pagar =15;
              $paq->porcentaje = ($request->monto*15)/100;
              $paq->pendiente = $pendiente-$request->monto;
              $paq->monto = $monto;
              $paq->abono = $request->monto;
              $paq->estatus = 2;
              $paq->usuario = Auth::user()->id;
              $paq->save(); 

            }elseif ($usuario->esp==2) {
               $paq = new Atenciones();
              $paq->tipo_factura = $tipo_factura;               
              $paq->numero_serie = $numero_serie;             
              $paq->numero_factura = $numero_factura;              
              $paq->id_paciente = $paciente;
              $paq->origen = $origen;
              $paq->origen_usuario = $origen_usuario;
              $paq->id_laboratorio =  $lab;
              $paq->id_servicio =  $servicio;
              $paq->id_paquete = $paquete;
              $paq->comollego = $comollego;
              $paq->es_paquete =  true;
              $paq->serv_prog = FALSE;
              $paq->tipopago = $tp;
              $paq->porc_pagar =0;
              $paq->porcentaje = 5;
              $paq->pendiente = $pendiente-$request->monto;
              $paq->monto = $monto;
              $paq->abono = $request->monto;
              $paq->estatus = 2;
              $paq->usuario = Auth::user()->id;
              $paq->save(); 
            }else{

            }
					

             
			



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

    public function createView() {

    //$servicios = Servicios::all();
    //$laboratorios = Analisis::all();
    //$pacientes = Pacientes::all();
    //$paquetes = Paquetes::all();
    $servicios =Servicios::where("estatus", '=', 1)->get();
    $laboratorios =Analisis::where("estatus", '=', 1)->get();
    $pacientes =Pacientes::where("estatus", '=', 1)->get();
    $paquetes =Paquetes::where("estatus", '=', 1)->get();


    
    return view('movimientos.cuentasporcobrar.create', compact('servicios','laboratorios','pacientes','paquetes'));
  }

  public function create(Request $request)
  {


   
    $searchUsuarioID = DB::table('users')
                    ->select('*')
                    ->where('id','=', $request->origen_usuario)
                    ->first();    

 
    if (is_null($request->id_servicio['servicios'][0]['servicio']) && is_null($request->id_laboratorio['laboratorios'][0]['laboratorio'])){
      return redirect()->route('atenciones.create');
    }

    if (isset($request->id_paquete)) {
      
      foreach ($request->id_paquete['paquetes'] as $key => $paquete) {
        if (!is_null($paquete['paquete'])) {
              $paquete = Paquetes::findOrFail($paquete['paquete']);
              $paq = new Atenciones();
              $paq->tipo_factura = $request->factura_tipo;               
              $paq->numero_serie = $request->numero_serie;             
              $paq->numero_factura = $request->numero_factura;              
              $paq->id_paciente = $request->id_paciente;
              $paq->origen = $request->origen;
              $paq->origen_usuario = $searchUsuarioID->id;
              $paq->id_laboratorio =  1;
              $paq->id_servicio =  1;
              $paq->id_paquete = $paquete->id;
              $paq->comollego = $request->comollego;
              $paq->es_paquete =  true;
        $paq->serv_prog = FALSE;
              $paq->tipopago = $request->tipopago;
              $paq->porc_pagar = $paquete->porcentaje;
              $paq->pendiente = (float)$request->monto_p['paquetes'][$key]['monto'] - (float)$request->monto_abop['paquetes'][$key]['abono'];
              $paq->monto = $request->monto_p['paquetes'][$key]['monto'];
              $paq->abono = $request->monto_abop['paquetes'][$key]['abono'];
              $paq->porcentaje = ((float)$request->monto_p['paquetes'][$key]['monto']* $paquete->porcentaje)/100;
              $paq->estatus = 1;
              $paq->usuario = Auth::user()->id;
              $paq->created_at= $request->fecha;
              $paq->save(); 



        } else {

        }
      }

 //////
     if(! is_null($request->id_paquete)){
     foreach ($request->id_paquete as $key => $value) {

        $searchServPaq = DB::table('paquete_servicios')
        ->select('*')
                   // ->where('estatus','=','1')
        ->where('paquete_id','=', $value)
        ->get();
    
    

        foreach ($searchServPaq as $serv) {
            $id_servicio = $serv->servicio_id;
      
      $servdetalle =  DB::table('servicios')
      ->select('*')
      ->where('id','=',$id_servicio)
      ->first();
      
      $detalle = $servdetalle->detalle;

            if(! is_null($id_servicio)){
              $s = new Atenciones();
              $s->tipo_factura = $request->factura_tipo;               
              $s->numero_serie = $request->numero_serie;             
              $s->numero_factura = $request->numero_factura;             
              $s->id_paciente = $request->id_paciente;
              $s->origen = $request->origen;
              $s->origen_usuario = $searchUsuarioID->id;
              $s->id_laboratorio =  1;
              $s->id_servicio =  $id_servicio;
              $s->id_paquete = 1;
              $s->comollego = $request->comollego;
              $s->es_paquete =  FALSE;
        $s->es_servicio =  1;
              $s->es_laboratorio =  FALSE;
        $s->serv_prog = FALSE;
              $s->tipopago = $request->tipopago;
              $s->porc_pagar = 0;
              $s->pendiente = 0;
              $s->monto = 99999;
              $s->abono = 0;
              $s->porcentaje =0;
              $s->estatus = 1;
              $s->created_at= $request->fecha;
              $s->usuario = Auth::user()->id;
              $s->save(); 
             
         }
        }

        $searchLabPaq = DB::table('paquete_laboratorios')
        ->select('*')
        ->where('paquete_id','=', $value)
        ->get();

         foreach ($searchLabPaq as $lab) {
            $id_laboratorio = $lab->laboratorio_id;


            if(! is_null($id_laboratorio)){
        $l = new Atenciones();
        $l->tipo_factura = $request->factura_tipo;         
        $l->numero_serie = $request->numero_serie;        
        $l->numero_factura = $request->numero_factura;              
        $l->id_paciente = $request->id_paciente;
              $l->origen = $request->origen;
              $l->origen_usuario = $searchUsuarioID->id;
              $l->id_laboratorio = $id_laboratorio;
              $l->id_servicio = 1;
              $l->id_paquete = 1;
              $l->comollego = $request->comollego;
              $l->es_paquete =  FALSE;
        $l->es_servicio =  FALSE;
              $l->es_laboratorio = 1;
        $l->serv_prog = FALSE;
              $l->tipopago = $request->tipopago;
              $l->porc_pagar = 0;
              $l->pendiente = 0;
              $l->monto = 99999;
              $l->abono = 0;
              $l->porcentaje =0;
              $l->estatus = 1;
              $l->usuario = Auth::user()->id;
              $l->created_at= $request->fecha;
              $l->save(); 

         }
        }


}
}
    //////

    }

    if (isset($request->id_servicio)) {
      $searchServicio = DB::table('servicios')
              ->select('*')
              ->where('id','=', $request->id_servicio)
              ->first();  
        
     // $porcentaje = $searchServicio->porcentaje;
    $programa = $searchServicio->programa;
    
    if ($request->origen == 1 ){
        $porcentaje = $searchServicio->por_per;
    } else {
        $porcentaje = $searchServicio->porcentaje;
    }
    
  
      foreach ($request->id_servicio['servicios'] as $key => $servicio) {
        if (!is_null($servicio['servicio'])) {
              

            

              $serv = new Atenciones();
              $serv->tipo_factura = $request->factura_tipo;              
              $serv->numero_serie = $request->numero_serie;               
              $serv->numero_factura = $request->numero_factura;             
              $serv->id_paciente = $request->id_paciente;
              $serv->origen = $request->origen;
              $serv->origen_usuario = $searchUsuarioID->id;
              $serv->id_laboratorio =  1;
              $serv->id_paquete =  1;
              $serv->id_servicio =  $servicio['servicio'];
              $serv->es_servicio =  true;
        $serv->serv_prog =  $programa;
              $serv->tipopago = $request->tipopago;
              $serv->porc_pagar = $porcentaje;
              $serv->comollego = $request->comollego;
              $serv->pendiente = (float)$request->monto_s['servicios'][$key]['monto'] - (float)$request->monto_abos['servicios'][$key]['abono'];
              $serv->monto = $request->monto_s['servicios'][$key]['monto'];
              $serv->abono = $request->monto_abos['servicios'][$key]['abono'];
              $serv->porcentaje = ((float)$request->monto_s['servicios'][$key]['monto']* $porcentaje)/100;
              $serv->estatus = 1;
              $serv->usuario = Auth::user()->id;
              $serv->created_at= $request->fecha;
              $serv->save(); 

           
        } else {

        }
      }
    }

    if (isset($request->id_laboratorio)) {

       $searchAnalisis = DB::table('analises')
                    ->select('*')
                   // ->where('estatus','=','1')
                    ->where('id','=', $request->id_laboratorio)
                    ->first();   
                   
                   $porcentaje =  $searchAnalisis->porcentaje;

      foreach ($request->id_laboratorio['laboratorios'] as $key => $laboratorio) {
        if (!is_null($laboratorio['laboratorio'])) {
          $lab = new Atenciones();
          $lab->tipo_factura = $request->factura_tipo;           
          $lab->numero_serie = $request->numero_serie;           
          $lab->numero_factura = $request->numero_factura;         
          $lab->id_paciente = $request->id_paciente;
          $lab->origen = $request->origen;
          $lab->origen_usuario = $searchUsuarioID->id;
          $lab->id_servicio = 1;
          $lab->id_paquete =  1;
          $lab->id_laboratorio =  $laboratorio['laboratorio'];
          $lab->es_laboratorio =  true;
          $lab->tipopago = $request->tipopago;
          $lab->porc_pagar = $porcentaje;
      $lab->serv_prog = FALSE;
          $lab->comollego = $request->comollego;
          $lab->pendiente = (float)$request->monto_l['laboratorios'][$key]['monto'] - (float)$request->monto_abol['laboratorios'][$key]['abono'];
          $lab->monto = $request->monto_l['laboratorios'][$key]['monto'];
          $lab->abono = $request->monto_abol['laboratorios'][$key]['abono'];
          $lab->porcentaje = ((float)$request->monto_l['laboratorios'][$key]['monto']* $porcentaje)/100;
          $lab->pendiente = $request->total_g;
          $lab->estatus = 1;
                        $lab->usuario = Auth::user()->id;
                        $lab->created_at= $request->fecha;
          $lab->save();

         
        } else {

        }
      }
    }
       Toastr::success('Registrado Exitosamente.', 'Cuenta Por Cobrar!', ['progressBar' => true]);

    return redirect()->route('cuentasporcobrar.index');
  }
  




}
