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
