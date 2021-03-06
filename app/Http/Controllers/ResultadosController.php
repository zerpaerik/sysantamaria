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
use Auth;
use Carbon\Carbon;



class ResultadosController extends Controller

{

	public function index(Request $request){

    if(!is_null($request->paciente)){


      	$resultados = DB::table('atenciones as a')
        ->select('a.id','a.id_paquete','a.id_paciente','a.origen_usuario','a.atendido','a.es_servicio','a.es_laboratorio','a.created_at','a.origen','a.id_servicio','a.es_paquete','a.pendiente','a.id_laboratorio','a.monto','a.porcentaje','a.abono','a.pendiente','a.resultado','b.nombres','b.apellidos','b.dni','c.detalle as servicio','e.name','e.lastname','pa.detalle as paquete')
        ->join('pacientes as b','b.id','a.id_paciente')
        ->join('servicios as c','c.id','a.id_servicio')
        ->join('users as e','e.id','a.origen_usuario')
        ->join('paquetes as pa','pa.id','a.id_paquete')
        ->where('a.id_paciente','=',$request->paciente)
        ->whereNull('a.atendido')
        ->whereNotIn('a.monto',[0,0.00])
        //->whereNotIn('a.es_paquete',[1])
        ->orderby('a.id','desc')
        ->get();


          $total = Atenciones::where('id_paciente','=',$request->paciente)
        ->whereNull('atendido')
                        ->whereNotIn('monto',[0,0.00])
                          ->whereNotIn('es_paquete',[1])
                      ->select(DB::raw('COUNT(*) as cantidad'))
                      ->first();

      } else {

        $resultados = DB::table('atenciones as a')
        ->select('a.id','a.id_paquete','a.id_paciente','a.origen_usuario','a.atendido','a.es_servicio','a.es_laboratorio','a.created_at','a.origen','a.id_servicio','a.es_paquete','a.pendiente','a.id_laboratorio','a.monto','a.porcentaje','a.abono','a.pendiente','a.resultado','b.nombres','b.apellidos','b.dni','c.detalle as servicio','e.name','e.lastname','pa.detalle as paquete')
        ->join('pacientes as b','b.id','a.id_paciente')
        ->join('servicios as c','c.id','a.id_servicio')
        ->join('users as e','e.id','a.origen_usuario')
        ->join('paquetes as pa','pa.id','a.id_paquete')
        ->whereNull('a.atendido')
        ->whereNotIn('a.es_paquete',[1])
        ->whereNotIn('a.monto',[0,0.00])
        ->where('a.created_at','=',Carbon::today()->toDateString())
        ->orderby('a.id','desc')
        ->get();

        $total = Atenciones::where('id_paciente','=',$request->paciente)
                       ->where('atendido','=',333)
                      ->select(DB::raw('COUNT(*) as cantidad'))
                      ->first();



      }


      
        $informe = Informe::all();
        $personal = Personal::where('estatus','=',1)->get();

        $pacientes = DB::table('pacientes as a')
        ->select('a.id','a.nombres','a.apellidos','a.dni','b.id_paciente')
        ->join('atenciones as b','b.id_paciente','a.id')
        ->groupBy('a.id')
        ->get();

         return view('resultados.index', ['resultados' => $resultados, 'personal' => $personal, 'pacientes' => $pacientes,'total' => $total]); 
	}

  public function search(Request $request)
  {
    $search = $request->nom;
    $split = explode(" ",$search);

    if (!isset($split[1])) {
      $split[1] = '';
      return $this->elasticSearch($split[0],$split[1]);
    }else{
      return $this->elasticSearch($split[0],$split[1]);     
    }
  }


	public function editView($id, Request $request){

    $atencion = Atenciones::findOrFail($id);
    $informe = Informe::where('id',$request->informe)->first();

    return view('resultados.create', [
      'atencion' => $atencion,
      'informe' => $informe
      ]);

    }


    public function informe()
    {
      return view ('informe.create');
    }

    public function informeIndex()
    {
      $informes = Informe::orderBy('id','desc')->paginate(10);

      return view('informe.index',[
        'data' => $informes
      ]);
    }

    public function informeEditar(Informe $id)
    {
      return view('informe.edit',[
        'data' => $id
      ]);
    }

    public function informeEdit(Informe $id, Request $request)
    {
      $id->update($request->all());

      return back();
    }

    public function informeSearch(Request $request)
    {
      $informe = Informe::where('title','like','%'.$request->title.'%')->get();

      return view('informe.search',[
        'data' => $informe
      ]);
    }

    
    public function informeCreate(Request $request)
    {
      $informe = Informe::create([
        'title' => $request->title,
        'content' => $request->content,
        'reporte_id' => '1'
      ]);

      return back();
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

          $searchServicioTec = DB::table('servicios')
                    ->select('*')
                   // ->where('estatus','=','1')
                    ->where('id','=', $id_servicio)
                    ->get();

            foreach ($searchServicioTec as $servicios) {
                    $por_tec = $servicios->por_tec;
                }



          if ($por_tec > 0) {
                
                $p = Atenciones::findOrFail($id);
                $p->resultado = 1;  
                $p->pago_com_tec = 0;      
                $p->save();

          } else {

                $p = Atenciones::findOrFail($id);
                $p->resultado = 1;  
                $p->save();

          }


                $creditos = new ResultadosServicios();
                $creditos->id_atencion = $request->id;
                $creditos->id_servicio = $id_servicio;
                $creditos->descripcion= $request->descripcion;
                $creditos->user_id = Auth::user()->id;
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


      public function atender(Request $request){

     
      $p = Atenciones::find($request->id);
      $p->atendido = $request->atendido;
      $res = $p->save();

      Toastr::success('Atendido Exitosamente.', 'Paciente!', ['progressBar' => true]);
      return redirect()->action('ResultadosController@index', ["edited" => $res]);
    }


    private function elasticSearch($nom, $ape)
    {     
      $resultados = DB::table('atenciones as a')
      ->select('a.id','a.id_paciente','a.origen_usuario','a.origen','a.id_servicio','a.pendiente','a.id_laboratorio','a.monto','a.porcentaje','a.abono','a.pendiente','a.resultado','b.nombres','b.apellidos','c.detalle as servicio','e.name','e.lastname','d.name as laboratorio')
      ->join('pacientes as b','b.id','a.id_paciente')
      ->join('servicios as c','c.id','a.id_servicio')
      ->join('analises as d','d.id','a.id_laboratorio')
      ->join('users as e','e.id','a.origen_usuario')
      ->whereNotIn('a.monto',[0,0.00])
      ->where('a.resultado','=', NULL)
      ->where('b.nombres','like','%'.$nom.'%')
      ->where('b.apellidos','like','%'.$ape.'%')
      ->orderby('a.id','desc')
      ->paginate(5000);


      $informe = Informe::all();

       return view('resultados.index', [
      "icon" => "fa-list-alt",
      "model" => "resultados",
      "headers" => ["Nombre Paciente", "Apellido Paciente","Nombre Profesional","Apellido Profesional","Servicio","laboratorio","Acción","Tipo Informe"],
      "data" => $resultados,
      "informes" => $informe,
      "fields" => ["nombres", "apellidos","name","lastname","servicio","laboratorio"],
        "actions" => [
          '<button type="button" class="btn btn-info">Transferir</button>',
          '<button type="button" class="btn btn-warning">Editar</button>'
        ]
    ]);     
    }

    }


