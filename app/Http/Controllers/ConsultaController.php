<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Consulta;
use App\Http\Requests\CreateConsultaRequest;
use Carbon\Carbon;
use DB;
use App\Models\ConsultaMateriales;
use App\Models\Existencias\{Producto, Existencia, Transferencia,Historiales};
use Toastr;
use App\Treatment;


class ConsultaController extends Controller
{


   public function index(){
        $inicio = Carbon::now()->toDateString();
        $final = Carbon::now()->addDay()->toDateString();
        $atenciones = $this->elasticSearch($inicio,$final,'','');
       
        return view('consultas.proxima.index', ["atenciones" => $atenciones]);
    }

    public function search(Request $request)
    {
      $search = $request->nom;
      $split = explode(" ",$search);

      if (!isset($split[1])) {
       
        $split[1] = '';
        $atenciones = $this->elasticSearch($request->inicio,$request->final,$split[0],$split[1]);

   
       
        return view('consultas.proxima.search', ["atenciones" => $atenciones]); 

      }else{
        $atenciones = $this->elasticSearch($request->inicio,$request->final,$split[0],$split[1]); 

      
       
        return view('consultas.proxima.search', ["atenciones" => $atenciones]);   
      }    
    }

     private function elasticSearch($initial, $final,$nom,$ape)
  { 
        $atenciones = DB::table('consultas as a')
        ->select('a.id','a.paciente_id','a.created_at','a.profesional_id','a.prox','b.nombres','b.apellidos','c.name as nompro','c.apellidos as apepro')
        ->join('pacientes as b','b.id','a.paciente_id')
        ->join('profesionales as c','c.id','a.profesional_id')
        ->where('b.nombres','like','%'.$nom.'%')
        ->where('b.nombres','like','%'.$ape.'%')
        ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($initial)), date('Y-m-d 23:59:59', strtotime($initial))])
        ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($final)), date('Y-m-d 23:59:59', strtotime($final))])
        ->orderby('a.id','desc')
        ->paginate(20);
        return $atenciones;

  }

  
     public function indexh(){


      $historias = DB::table('events as e')
        ->select('e.id','e.paciente','e.title','e.profesional','e.date','e.time','p.dni','p.direccion','p.telefono','p.fechanac','p.gradoinstruccion','p.ocupacion','p.nombres','p.dni','p.apellidos','p.id as pacienteId',
    'per.name as nombrePro','per.lastname as apellidoPro','per.id as profesionalId','rg.start_time','rg.end_time','rg.id',
    'a.motivo','a.causa','a.tiempo','a.enf','a.fra','a.ope','a.aler','a.pres','a.aux','a.def','a.top','a.ciex','a.ciex2','a.plan','a.ses','a.atendido','a.paciente_id','a.profesional_id','a.created_at','a.exa','a.pa','a.fc','a.spo2','a.peso','a.talla','a.personal',
    'b.antecedentes_familiar','b.antecedentes_personales','b.antecedentes_patologicos','b.alergias','b.menarquia','b.prs','b.paciente_id')
    ->join('consultas as a','a.paciente_id','e.paciente')
    ->join('historials as b','e.paciente','b.paciente_id')
    ->join('pacientes as p','p.id','=','e.paciente')
    ->join('personals as per','per.id','=','e.profesional')
    ->join('rangoconsultas as rg','rg.id','=','e.time')
    ->groupBy('e.paciente')
    ->get();
    
   
        return view('consultas.historias.index', ["historias" => $historias]);
  }



    public function create(Request $request)
    {	
		$consulta = new Consulta;
		$consulta->motivo =$request->motivo;
		$consulta->causa =$request->causa;
		$consulta->tiempo =$request->tiempo;
		$consulta->enf =$request->enf;
		$consulta->fra =$request->fra;
		$consulta->ope =$request->ope;
		$consulta->aler =$request->aler;
		$consulta->pres =$request->pres;
		$consulta->aux =$request->aux;
		$consulta->def =$request->def;
		$consulta->top =$request->top;
		$consulta->ciex =$request->ciex;
		$consulta->ciex2=$request->ciex2;
		$consulta->plan=$request->plan;
		$consulta->ses =$request->ses;
    $consulta->pa =$request->pa;
    $consulta->fc =$request->fc;
    $consulta->fr =$request->fr;
    $consulta->spo2 =$request->spo2;
    $consulta->peso =$request->peso;
    $consulta->talla =$request->talla;
	  $consulta->paciente_id =$request->paciente_id;
    $consulta->personal =$request->personal;
		$consulta->save();

   
		return view('events.create',[
      'consulta' => $consulta->id,
      'evento' => $request->evento_id
    ]);

    }
      
}
