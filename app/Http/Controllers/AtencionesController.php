<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Atenciones;
use App\Models\Servicios;
use App\Models\Analisis;
use App\Models\Pacientes;
use App\Models\Personal;
use App\Models\Profesionales;
use App\Models\Creditos;
use App\Models\Paquetes;
use App\Models\Existencias\Producto;
use App\Models\ServicioMaterial;
use App\User;
use Auth;
use Carbon\Carbon;
use Toastr;

class AtencionesController extends Controller

{

	public function index(Request $request){


        if(! is_null($request->fecha)) {


          $atenciones = DB::table('atenciones as a')
          ->select('a.id','a.tipo_factura','a.numero_serie','a.usuario','a.numero_factura','a.created_at','a.id_paciente','a.origen_usuario','a.origen','a.id_servicio','a.id_paquete','a.id_laboratorio','a.es_servicio','a.es_laboratorio','a.es_paquete','a.monto','a.porcentaje','a.abono','b.nombres','b.apellidos','b.dni','c.detalle as servicio','e.name','e.lastname','d.name as laboratorio','f.detalle as paquete','u.name as username','u.lastname as userlast')
          ->join('pacientes as b','b.id','a.id_paciente')
          ->join('servicios as c','c.id','a.id_servicio')
          ->join('analises as d','d.id','a.id_laboratorio')
          ->join('users as e','e.id','a.origen_usuario')
          ->join('paquetes as f','f.id','a.id_paquete')
          ->join('users as u','u.id','a.usuario')
          ->whereNotIn('a.monto',[0,0.00,99999])
          ->whereDate('a.created_at', '=',$request->fecha)
          ->orderby('a.id','desc')
          ->get();



        } else {

          $atenciones = DB::table('atenciones as a')
          ->select('a.id','a.tipo_factura','a.numero_serie','a.usuario','a.numero_factura','a.created_at','a.id_paciente','a.origen_usuario','a.origen','a.id_servicio','a.id_paquete','a.id_laboratorio','a.es_servicio','a.es_laboratorio','a.es_paquete','a.monto','a.porcentaje','a.abono','b.nombres','b.apellidos','b.dni','c.detalle as servicio','e.name','e.lastname','d.name as laboratorio','f.detalle as paquete','u.name as username','u.lastname as userlast')
          ->join('pacientes as b','b.id','a.id_paciente')
          ->join('servicios as c','c.id','a.id_servicio')
          ->join('analises as d','d.id','a.id_laboratorio')
          ->join('users as e','e.id','a.origen_usuario')
          ->join('paquetes as f','f.id','a.id_paquete')
                    ->join('users as u','u.id','a.usuario')
          ->whereNotIn('a.monto',[0,0.00,99999])
          ->whereDate('a.created_at', '=',Carbon::today()->toDateString())
          ->orderby('a.id','desc')
          ->get();


        }


    return view('movimientos.atenciones.index', ['atenciones' => $atenciones]); 

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


    
    return view('movimientos.atenciones.create', compact('servicios','laboratorios','pacientes','paquetes'));
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
              $paq->save(); 

              $creditos = new Creditos();
              $creditos->origen = 'ATENCIONES';
              $creditos->id_atencion = $paq->id;
              $creditos->monto= $request->monto_abop['paquetes'][$key]['abono'];
              $creditos->tipo_ingreso = $request->tipopago;
              $creditos->descripcion = 'INGRESO DE ATENCIONES';
              $creditos->save();


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
              $serMateriales = ServicioMaterial::where('servicio_id', $servicio['servicio'])
                                        ->with('material', 'servicio')
                                        ->get();

            

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
              $serv->save(); 

              $creditos = new Creditos();
              $creditos->origen = 'ATENCIONES';
              $creditos->id_atencion = $serv->id;
              $creditos->monto= $request->monto_abos['servicios'][$key]['abono'];
              $creditos->tipo_ingreso = $request->tipopago;
              $creditos->descripcion = 'INGRESO DE ATENCIONES';
              $creditos->save();
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
          $lab->save();

          $creditos = new Creditos();
          $creditos->origen = 'ATENCIONES';
          $creditos->id_atencion = $lab->id;
          $creditos->monto= $request->monto_abol['laboratorios'][$key]['abono'];
          $creditos->tipo_ingreso = $request->tipopago;
          $creditos->descripcion = 'INGRESO DE ATENCIONES';
          $creditos->save();
        } else {

        }
      }
    }
    	 Toastr::success('Registrado Exitosamente.', 'Ingreso de Atenciòn!', ['progressBar' => true]);

    return redirect()->route('atenciones.index');
  }

  public function personal(){
     
       $personal = DB::table('users')
                    ->select('*')
                   // ->where('estatus','=','1')
                    ->where('tipo','=','1')
                    ->get();  

    return view('movimientos.atenciones.personal', compact('personal'));
  }

   public function profesional(){
     
        $profesional = DB::table('users')
                    ->select('*')
                   // ->where('estatus','=','1')
                    ->where('tipo','=','2')
                    ->get();  

    return view('movimientos.atenciones.profesional', compact('profesional'));
  }


   public function convenio(){
     
        $convenio = DB::table('users')
                    ->select('*')
                    ->where('tipo','=','4')
                  // ->where('estatus','=','1')
                    ->get();  

    return view('movimientos.atenciones.convenio', compact('convenio'));
  }


   public function recomendacion(){
     
        $recomendacion = DB::table('users')
                    ->select('*')
                    ->where('tipo','=','3')
                  // ->where('estatus','=','1')
                    ->get();  

    return view('movimientos.atenciones.recomendacion', compact('recomendacion'));
  }


   public function seleccione(){
     

    return view('movimientos.atenciones.seleccione');
  }

  public function editView($id)
  {
    //$servicios = Servicios::all();
    //$laboratorios = Analisis::all();
    //$pacientes = Pacientes::all();

    $servicios =Servicios::where("estatus", '=', 1)->get();
    $laboratorios =Analisis::where("estatus", '=', 1)->get();
    $pacientes =Pacientes::where("estatus", '=', 1)->get();
    $paquetes =Paquetes::where("estatus", '=', 1)->get();
    //$personal = Personal::all();
    //$profesional = Profesionales::all();
    $users = User::all();

    $atencion = Atenciones::findOrFail($id);
    
    return view('movimientos.atenciones.edit', compact('atencion','servicios','laboratorios','pacientes', 'users','paquetes'));
  }

  public function edit(Request $request, $id)
  {
    $atencion = Atenciones::findOrFail($id);
    
    $creditos = Creditos::where('id_atencion', $atencion->id)->first();

    
    $searchUsuarioID = DB::table('users')
                    ->select('*')
                    ->where('id','=', $request->origen_usuario)
                    ->first();       
                    
    if (isset($request->id_servicio)) {
      $atencion->origen = $request->origen;
      $atencion->origen_usuario = $searchUsuarioID->id;
      $atencion->id_servicio =  $request->id_servicio['servicios'][0]['servicio'];
      $atencion->es_servicio =  true;
      $atencion->tipopago = $request->tipopago;
      $atencion->pendiente = (float)$request->monto_s['servicios'][0]['monto'] - (float)$request->monto_abos['servicios'][0]['abono'];
      $atencion->monto = $request->monto_s['servicios'][0]['monto'];
      $atencion->abono = $request->monto_abos['servicios'][0]['abono'];

      $creditos->monto= $request->monto_abos['servicios'][0]['abono'];
      $creditos->tipo_ingreso = $request->tipopago;
    } else if(isset($request->id_laboratorio)) {
      $atencion->origen = $request->origen;
      $atencion->origen_usuario = $searchUsuarioID->id;
      $atencion->id_laboratorio =  $request->id_laboratorio['laboratorios'][0]['laboratorio'];
      $atencion->tipopago = $request->tipopago;
      $atencion->pendiente = (float)$request->monto_s['laboratorios'][0]['monto'] - (float)$request->monto_abos['laboratorios'][0]['abono'];
      $atencion->monto = $request->monto_l['laboratorios'][0]['monto'];
      $atencion->abono = $request->monto_abol['laboratorios'][0]['abono'];

      $creditos->monto= $request->monto_abol['laboratorios'][0]['abono'];
      $creditos->tipo_ingreso = $request->tipopago;
    } else {

      $atencion->origen = $request->origen;
      $atencion->origen_usuario = $searchUsuarioID->id;
      $atencion->id_paquete =  $request->id_paquete['paquetes'][0]['paquete'];
      $atencion->tipopago = $request->tipopago;
      $atencion->pendiente = (float)$request->monto_p['paquetes'][0]['monto'] - (float)$request->monto_abop['paquetes'][0]['abono'];
      $atencion->monto = $request->monto_p['paquetes'][0]['monto'];
      $atencion->abono = $request->monto_abop['paquetes'][0]['abono'];

      $creditos->monto= $request->monto_abop['paquetes'][0]['abono'];
      $creditos->tipo_ingreso = $request->tipopago;

    }



    if ($atencion->save() && $creditos->save()) {
      return redirect()->route('atenciones.index');
    } else {
      throw new Exception("Error en el proceso de actualizaciÃ³n", 1);
    }
  }

  private function elasticSearch($initial,$nombre,$apellido)
  {
    $atenciones = DB::table('atenciones as a')
    ->select('a.id','a.created_at','a.id_paciente','a.origen_usuario','a.origen','a.id_servicio','a.id_paquete','a.id_laboratorio','a.es_servicio','a.es_laboratorio','a.es_paquete','a.monto','a.porcentaje','a.abono','b.nombres','b.apellidos','c.detalle as servicio','e.name','e.lastname','d.name as laboratorio','f.detalle as paquete')
    ->join('pacientes as b','b.id','a.id_paciente')
    ->join('servicios as c','c.id','a.id_servicio')
    ->join('analises as d','d.id','a.id_laboratorio')
    ->join('users as e','e.id','a.origen_usuario')
    ->join('paquetes as f','f.id','a.id_paquete')
    ->whereNotIn('a.monto',[0,0.00])
    ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($initial)), date('Y-m-d 23:59:59', strtotime($initial))])
    ->where('b.nombres','like','%'.$nombre.'%')
    ->where('b.apellidos','like','%'.$apellido.'%')
    ->orderby('a.id','desc')
    ->paginate(20);
	
    return $atenciones;
  }
  
   public function delete($id){
    $atenciones = Atenciones::find($id);
    $atenciones->delete();
	
	$creditos = Creditos::where('id_atencion','=',$id);
    $creditos->delete();
  
	 Toastr::error('Eliminado Exitosamente.', 'Ingreso de Atenciòn!', ['progressBar' => true]);

     return redirect()->action('AtencionesController@index', ["created" => true, "atenciones" => Atenciones::all()]);
	
  }


   public function atender(Request $request){

     
      $p = Atenciones::find($request->id);
      $p->atendido = $request->atendido;
      $p->fecha_atencion = Carbon::today()->toDateString();
      $res = $p->save();

      Toastr::success('Atendido Exitosamente.', 'Paciente!', ['progressBar' => true]);
      return redirect()->action('ResultadosController@index', ["edited" => $res]);
    }










}
