<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Profesionales\Especialidad;
use App\Models\Profesionales\Profesional;
use App\Models\Events\{Event, RangoConsulta};
use App\Models\Existencias\{Producto, Existencia, Transferencia};
use App\Models\Creditos;
use App\Models\Servicios;
use App\Models\Personal;
use App\Models\Events;
use App\Models\Atenciones;
use App\Models\Pacientes;
use App\Models\Evaluaciones;
use App\Models\Punsion;
use Calendar;
use Carbon\Carbon;
use DB;
use App\Historial;
use App\Consulta;
use App\Service;
use Toastr;

class ServiceController extends Controller
{

	public function index(Request $request)
  	{
    if($request->isMethod('get')){
      $calendar = false;
      return view('service.index', ["calendar" => $calendar, "especialistas" =>   Personal::all()]);
    }else{
      $calendar = Calendar::addEvents($this->getEvents($request->especialista))
      ->setOptions([
        'locale' => 'es',
      ]);
      return view('service.index',[ "calendar" => $calendar, "especialistas" => Personal::all()]);
    }
  }
  private static function toggleType($type){
    switch ($type) {
      case "0":
        return "#43D12C";
        break;
      
      default:
        return '#f05050';
        break;
    }
  }

  private function getEvents($args = null){
    $events = [];
    $data = ($args) ? Service::where('especialista_id', '=', $args)->get() : Service::all();
    if($data->count()) {
      foreach ($data as $d) {
        $datetime = RangoConsulta::find($d->hora_id);
        $events[] = Calendar::event(
          $d->title,
          false,
          new \DateTime($d->date." ".$datetime->start_time),
          new \DateTime($d->date." ".$datetime->end_time),
          null,
          [
            'color' => self::toggleType($d->entrada),
            'url' => 'service-'.$d->id
          ]
        );
      }
    }
    return $events;    
  }

   public function servicios(){
     
        $servicios= Servicios::where('estatus','=',1)->get(); 

    return view('service.servicios', compact('servicios'));
  }

    public function consultas(){
     
          $consultas= Evaluaciones::all(); 


    return view('service.consulta', compact('consultas'));
  }

   public function punziones(){
     
        $punziones = Punsion::all();

    return view('service.punziones', compact('punziones'));
  }


  public function show($id)
  {
    $services = DB::table('services as s')
    ->select('s.id','s.especialista_id','s.title','s.tipo','s.punsion','s.consulta','s.paciente_id','s.servicio_id','s.date','s.hora_id','pro.name as nombrePro','pro.lastname as apellidoPro','pro.id as profesionalId','rg.start_time','rg.end_time','rg.id','sr.detalle as srDetalle','sr.id as srId','pc.nombres as nompac','pc.apellidos as apepac','pr.nombre as punsion','eva.nombre as evaluacion')
    ->join('personals as pro','pro.id','=','s.especialista_id')
    ->join('rangoconsultas as rg','rg.id','=','s.hora_id')
    ->join('servicios as sr','sr.id','=','s.servicio_id')
    ->join('pacientes as pc','pc.id','=','s.paciente_id')
    ->join('punsions as pr','pr.id','s.punsion')
    ->join('evaluaciones as eva','eva.id','s.consulta')
    ->where('s.id','=',$id)
    ->first();
    return view('service.show',[
      'data' => $services,
    ]);
  }  
  public function inicio()
  {
    $services = DB::table('services as s')
    ->select('s.id as SerId','s.especialista_id','s.title','s.paciente_id','s.servicio_id','s.date','s.hora_id','pro.name as nombrePro','pro.lastname as apellidoPro','pro.id as profesionalId','rg.start_time','rg.end_time','rg.id','sr.detalle as srDetalle','sr.id as srId','pc.nombres as nompac','pc.apellidos as apepac')
    ->join('personals as pro','pro.id','=','s.especialista_id')
    ->join('rangoconsultas as rg','rg.id','=','s.hora_id')
    ->join('servicios as sr','sr.id','=','s.servicio_id')
    ->join('pacientes as pc','pc.id','=','s.paciente_id')
    ->get(); 
    

    return view('service.inicio',[
      'data' => $services
    ]);           
  }


  public function delete($id)
  {
    $servicio = Service::find($id);  
    $servicio->delete();
    return back();
  }

  public function editView($id)
  {
    $especialistas = Personal::all();
    $servicios = Servicios::all();
    $tiempos = RangoConsulta::all();
    $pacientes = Pacientes::where("estatus", '=', 1)->first();

    $service = Service::find($id);

    $atenciones = DB::table('atenciones as a')
    ->select('a.id','a.created_at','a.id_paciente','a.origen_usuario','a.origen','a.id_servicio','a.id_paquete','a.id_laboratorio','a.serv_prog','a.es_servicio','a.es_laboratorio','a.es_paquete','a.monto','a.porcentaje','a.abono','b.nombres','b.apellidos','b.dni','c.detalle as servicio','e.name','e.lastname','d.name as laboratorio','f.detalle as paquete')
    ->join('pacientes as b','b.id','a.id_paciente')
    ->join('servicios as c','c.id','a.id_servicio')
    ->join('analises as d','d.id','a.id_laboratorio')
    ->join('users as e','e.id','a.origen_usuario')
    ->join('paquetes as f','f.id','a.id_paquete')
    ->where('a.serv_prog','=',1)
    ->orderby('a.id','desc')
    ->get();   

    return view('service.edit', 
      [
      'especialistas' => $especialistas,
      'atenciones' => $atenciones,
      'servicios' => $servicios,
      'tiempos' =>  $tiempos, 
      'pacientes' => $pacientes,
      'service' => $service
    ]);
  }

  public function edit(Request $request)
  {
    DB::table('services')
    ->where('id',$request->id_servicio)
    ->update([    
        "especialista_id" => $request->especialista,
        "date" => Carbon::createFromFormat('d/m/Y', $request->date),
        "hora_id" => $request->time,
      ]);

    return redirect('/services-inicio');    
  }  

  public function createView($extra = []){
  
      $especialistas = Personal::all();
      $servicios = Servicios::where("estatus", '=', 1)->get();
      $tiempos = RangoConsulta::all();
      $pacientes = Pacientes::where("estatus", '=', 1)->get();
	
	 $atenciones = DB::table('atenciones as a')
    ->select('a.id','a.created_at','a.id_paciente','a.origen_usuario','a.origen','a.id_servicio','a.id_paquete','a.id_laboratorio','a.serv_prog','a.es_servicio','a.es_laboratorio','a.es_paquete','a.monto','a.porcentaje','a.abono','b.nombres','b.apellidos','b.dni','c.detalle as servicio','e.name','e.lastname','d.name as laboratorio','f.detalle as paquete')
    ->join('pacientes as b','b.id','a.id_paciente')
    ->join('servicios as c','c.id','a.id_servicio')
    ->join('analises as d','d.id','a.id_laboratorio')
    ->join('users as e','e.id','a.origen_usuario')
    ->join('paquetes as f','f.id','a.id_paquete')
    ->orderby('a.id','desc')
    ->get();

    return view('service.create', compact('especialistas', 'atenciones','servicios','tiempos','pacientes'));
	
  }

   public function create(Request $request){


   $especialista = Personal::find($request->especialista);

    
      if($request->tipo == 1){ // servicios

      $servicios = Servicios::where('id','=',$request->servicio_id)->first();

      $evt = Service::create([
        "especialista_id" => $request->especialista,
        "paciente_id" => $request->paciente,
        "date" => Carbon::createFromFormat('d/m/Y', $request->date),
        "hora_id" => $request->time,
        "tipo" => $request->tipo,
        "servicio_id" => $request->servicio_id,
        "consulta" =>10,
        "punsion" =>4,
        "title" => $especialista->name." ".$especialista->lastname." "."Especialista" . "Servicio-".$servicios->detalle
      ]);

	  } else if($request->tipo == 2){//consultas
        $evt = Service::create([
        "especialista_id" => $request->especialista,
        "paciente_id" => $request->paciente,
        "date" => Carbon::createFromFormat('d/m/Y', $request->date),
        "hora_id" => $request->time,
        "tipo" => $request->tipo,
        "servicio_id" => 1,
        "consulta" =>$request->consulta,
        "punsion" =>4,
        "title" => $especialista->name." ".$especialista->lastname." "."Especialista"
      ]);

    } else if($request->tipo == 3){//punziones

        $evt = Service::create([
        "especialista_id" => $request->especialista,
        "paciente_id" => $request->paciente,
        "date" => Carbon::createFromFormat('d/m/Y', $request->date),
        "hora_id" => $request->time,
        "tipo" => $request->tipo,
        "servicio_id" => 1,
        "consulta" =>10,
        "punsion" =>$request->punzion,
        "title" => $especialista->name." ".$especialista->lastname." "."Especialista"
      ]);

    } else {

    }

    $calendar = Calendar::addEvents($this->getEvents())
    ->setOptions([
      'locale' => 'es',
    ]);
	
	 Toastr::success('Registrado Exitosamente.', 'Programaciòn!', ['progressBar' => true]);
    return redirect()->action('ServiceController@index');

  

}
 
}