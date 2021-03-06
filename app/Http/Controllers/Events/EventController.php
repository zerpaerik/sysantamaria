<?php

namespace App\Http\Controllers\Events;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pacientes\Paciente;
use App\Models\Personal;
use App\Models\Profesionales\Profesional;
use App\Models\Events\{Event, RangoConsulta};
use App\Models\Creditos;
use App\Models\Events;
use App\Models\Evaluaciones;
use App\Models\Ciex;
use App\Models\Historiales;
use Calendar;
use Carbon\Carbon;
use DB;
use App\Models\Existencias\{Producto, Existencia, Transferencia};
use App\Historial;
use App\Consulta;
use App\Treatment;
use Auth;

class EventController extends Controller
{

  public function index(Request $request)
  {
	  $personal = DB::table('personals as e')
    ->select('e.id','e.name','e.lastname','e.dni')
    ->join('events as p','p.profesional','=','e.id')
    ->groupBy('e.id')
    ->get();

 
	
    if($request->isMethod('get')){
      $calendar = false;
	  
      return view('events.index', ["calendar" => $calendar, "especialistas" => $personal]);
    }else{
      $calendar = Calendar::addEvents($this->getEvents($request->especialista))
      ->setOptions([
        'locale' => 'es',
      ]);
      return view('events.index',[ "calendar" => $calendar, "especialistas" => $personal]);
    }
  }

  public function show(Request $request,$id)
  {
    $event = DB::table('events as e')
    ->select('e.id','e.paciente','e.title','e.profesional','e.evaluacion','e.date','e.time','p.dni','p.direccion','p.telefono','p.fechanac','p.gradoinstruccion','p.ocupacion','p.nombres','p.apellidos','p.fechanac','p.id as pacienteId','per.name as nombrePro','per.lastname as apellidoPro','per.id as profesionalId','ev.nombre as evaluacion')
    ->join('pacientes as p','p.id','=','e.paciente')
    ->join('personals as per','per.id','=','e.profesional')
    ->join('evaluaciones as ev','ev.id','=','e.evaluacion')
    ->where('e.id','=',$id)
    ->first();

 
    $edad = Carbon::parse($event->fechanac)->age;
    $historial = Historial::where('paciente_id','=',$event->pacienteId)->first();
    $consultas = Consulta::where('paciente_id','=',$event->pacienteId)->get();
    $treatment = Treatment::where('evento','=',$event->id)->get();


    $personal = Personal::where('estatus','=',1)->get();
    $ciex = Ciex::all();

    return view('events.show',[
      'data' => $event,
      'historial' => $historial,
      'consultas' => $consultas,
      'personal' => $personal,
      'treatment' => $treatment,
      'ciex' => $ciex,
      'edad' => $edad
    ]);
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
    $data = ($args) ? Event::where('profesional', '=', $args)->get() : Event::all();
    if($data->count()) {
      foreach ($data as $key => $value) {
        $datetime = RangoConsulta::find($value->time);
        $events[] = Calendar::event(
          $value->title,
          false,
          new \DateTime($value->date." ".$datetime->start_time),
          new \DateTime($value->date." ".$datetime->end_time),
          null,
          [
            'color' => self::toggleType($value->entrada),
            'url' => 'event-'.$value->id
          ]
        );
      }
    }
    return $events;    
  }

  public function create(Request $request){
    $validator = \Validator::make($request->all(), [
      "paciente" => "required", 
      "especialista" => "required", 
      "date" => "required", 
      "title" => "required"
    ]);

    if($validator->fails()){
      $this->createView([
        "fail" => true,
        "errors" => $validator->errors()
      ]);
    }

    $paciente = Paciente::find($request->paciente);

   
      $precioeva = DB::table('evaluaciones')
      ->select('*')
      ->where('id','=',$request->evaluaciones)
      ->first();

     $evt = new Event;
        $evt->paciente=$request->paciente;
        $evt->profesional=$request->especialista;
        $evt->date=Carbon::today()->toDateString();
        $evt->title=$paciente->nombres . " " . $paciente->apellidos . " Paciente.";
        $evt->monto=$precioeva->precio;
        $evt->sede=$request->session()->get('sede');
        $evt->comollego=$request->comollego;
        $evt->evaluacion=$request->evaluaciones;
        $evt->usuario =Auth::user()->id;
        $evt->save();



    
      $credito = Creditos::create([
        "origen" => 'CONSULTAS',
        "descripcion" => 'CONSULTAS',
        "monto" => $precioeva->precio,
        "tipo_ingreso" => $request->metodopago,
        "id_event" => $evt->id
      ]);
	  
	  $historial = new Historiales();
          $historial->accion ='Registro';
          $historial->origen ='Consultas';
		  $historial->detalle = $paciente->nombres . " " . $paciente->apellidos . " Paciente.";
          $historial->id_usuario = \Auth::user()->id;
          $historial->save();
   
    return redirect()->action('Events\EventController@all');

  }

  public function availableTime($e, $d, $m, $y){
    $times = Event::where('date', '=', $y."/".$m."/".$d)
    ->where('profesional', '=', $e)->get(['time']);
    $arrTimes = [];
    if($times){
      foreach ($times as $time) {
        array_push($arrTimes, $time->time);
      }
      return response()->json(RangoConsulta::whereNotIn("id", $arrTimes)->get(["start_time", "end_time", "id"]));
    }
    return response()->json(RangoConsulta::all()); 
  }

  public function createView($extra = []){
    $data = [
	  "especialistas" => Personal::where('estatus','=','1')->get(),
      "pacientes" => Paciente::where('estatus','=',1)->get(),
      "tiempos" => RangoConsulta::all(),
	  "ciex" => Ciex::all(),
    "evaluaciones" => Evaluaciones::all()
    ];
    return view('consultas.create', $data + $extra);
  }

    public function createficha(){

    return view('events.create');
  }

  public function si(){

       return view('events.si');

  }

  public function no(){

     return view('events.no');


  }

  public function all(Request $request)
  {

       if(! is_null($request->fecha)) {

    $f1 = $request->fecha;
   $f2= $request->fecha2; 


    $event = DB::table('events as e')
    ->select('e.id as EventId','e.paciente','e.usuario','e.comollego','e.title','e.created_at','e.evaluacion','e.profesional','e.date','e.time','p.dni','p.direccion','p.telefono','p.fechanac','p.gradoinstruccion','p.ocupacion','p.nombres','p.apellidos','p.id as pacienteId','per.name as nombrePro','per.lastname as apellidoPro','per.id as profesionalId','eva.nombre as nombreEval','u.name as username','u.lastname as userlast')
    ->join('pacientes as p','p.id','=','e.paciente')
    ->join('personals as per','per.id','=','e.profesional')
    ->join('evaluaciones as eva','eva.id','=','e.evaluacion')
    ->join('users as u','u.id','e.usuario')
    ->whereBetween('e.created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])
    ->orderBy('EventId','desc')
    ->get();

  } else {

    $event = DB::table('events as e')
    ->select('e.id as EventId','e.paciente','e.usuario','e.comollego','e.title','e.created_at','e.evaluacion','e.profesional','e.date','e.time','p.dni','p.direccion','p.telefono','p.fechanac','p.gradoinstruccion','p.ocupacion','p.nombres','p.apellidos','p.id as pacienteId','per.name as nombrePro','per.lastname as apellidoPro','per.id as profesionalId','eva.nombre as nombreEval','u.name as username','u.lastname as userlast')
    ->join('pacientes as p','p.id','=','e.paciente')
    ->join('personals as per','per.id','=','e.profesional')
    ->join('evaluaciones as eva','eva.id','=','e.evaluacion')
        ->join('users as u','u.id','e.usuario')
    ->whereDate('e.created_at','=',Carbon::today()->toDateString())
    ->orderBy('EventId','desc')
    ->get();

     $f1 = Carbon::today()->toDateString();
   $f2= Carbon::today()->toDateString();



  }
  

    return view('consultas.index',[
      'eventos' => $event,
      'f1' => $f1,
      'f2' => $f2
    ]);
  }  

  public function delete_consulta($id)
  {
     $consulta = Event::find($id);
    $consulta->delete();


    $creditos = Creditos::where('id_event','=',$id);
    $creditos->delete();
    
    return back();
  }

public function editView_consulta($id)
  {
  
    $paciente = DB::table('events as e')
    ->select('e.id as EventId','e.paciente','e.title','e.profesional','e.date','e.monto','e.time','p.dni','p.direccion','p.telefono','p.fechanac','p.gradoinstruccion','p.ocupacion','p.nombres','p.apellidos','p.id as pacienteId','per.name as nombrePro','per.lastname as apellidoPro','per.id as profesionalId','rg.start_time','rg.end_time','rg.id')
    ->join('pacientes as p','p.id','=','e.paciente')
    ->join('personals as per','per.id','=','e.profesional')
    ->join('rangoconsultas as rg','rg.id','=','e.time')
    ->where('e.id','=',$id)
    ->first();

    $especialistas = Personal::where('estatus','=','1')->get();

    $tiempos = RangoConsulta::all();
    
    $evaluaciones = Evaluaciones::all();

    return view('consultas.edit',[
      'paciente' => $paciente,
      'especialistas' => $especialistas,
      'tiempos' => $tiempos,
      'evaluaciones' => $evaluaciones
    ]);   
  
  }

  public function edit_consulta(Request $request)
  {
    DB::table('events')
            ->where('id', $request->event)
            ->update([
              'profesional' => $request->especialista,
              'paciente' => $request->paciente,
              'date' => Carbon::createFromFormat('d/m/Y', $request->date),
              'time' => $request->time,
              'evaluacion' => $request->evaluaciones
            ]);
  return redirect('consulta');            
  }   

  public function ticket_ver($id) 
  {
    $paciente = DB::table('events as e')
    ->select('e.id as EventId','e.paciente','e.evaluacion','e.title','e.profesional','e.date','e.monto','e.time','p.dni','p.direccion','p.telefono','p.fechanac','p.gradoinstruccion','p.ocupacion','p.nombres','p.apellidos','p.id as pacienteId','per.name as nombrePro','per.lastname as apellidoPro','per.id as profesionalId','eva.nombre as nombreEval')
    ->join('pacientes as p','p.id','=','e.paciente')
    ->join('personals as per','per.id','=','e.profesional')
    ->join('evaluaciones as eva','eva.id','=','e.evaluacion')
    ->where('e.id','=',$id)
    ->first();

    $view = \View::make('consultas.ticket_consulta')->with('paciente', $paciente);
    $pdf = \App::make('dompdf.wrapper');
    $pdf->setPaper(array(0,0,800.00,3000.00));
    $pdf->loadHTML($view);
    
    return $pdf->stream('ticket_ver');
  }
}