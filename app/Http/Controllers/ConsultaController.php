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

    Treatment::create([
      "ficha_eval" => $request->ficha_eval, 
      "eva_eval" =>            $request->eva_eval,
      "frecuencia_eval" =>            $request->frecuencia_eval,
      "exac_eval" =>            $request->exac_eval,
      "inicio_eval" =>            $request->inicio_eval,
      "inicio_tiempo_eval" =>            $request->inicio_tiempo_eval,
      "dolor_eval" =>            $request->dolor_eval,
      "retraccion_eval" =>            $request->retraccion_eval,
      "parestecia_eval" =>            $request->parestecia_eval,
      "hiperalgesia_eval" =>            $request->hiperalgesia_eval,
      "hiperalgesia_zona_eval" =>            $request->hiperalgesia_zona_eval,
      "limitacion_eval" =>            $request->limitacion_eval,
      "localizacion_eval" =>            $request->localizacion_eval,
      "irradiacion_eval" =>            $request->irradiacion_eval,
      "irradiacion_zona_eval" =>            $request->irradiacion_zona_eval,
      "observaciones_eval" =>            $request->observaciones_eval,
      "diagnostico_eval" =>            $request->diagnostico_eval,
      "chc_trat" =>            $request->chc_trat,
      "cf_trat" =>            $request->cf_trat,
      "tiempo_trat" =>            $request->tiempo_trat,
      "frecuencia_ultrasonido_trat" =>            $request->frecuencia_ultrasonido_trat,
      "intensidad_ultrasonido_trat" =>            $request->intensidad_ultrasonido_trat,
      "ciclo_ultrasonido_trat" =>            $request->ciclo_ultrasonido_trat,
      "tiempo_ultrasonido_trat" =>            $request->tiempo_ultrasonido_trat,
      "dolor_laser_trat" =>            $request->dolor_laser_trat,
      "tenosinovitis_laser_trat" =>            $request->tenosinovitis_laser_trat,
      "esguince_laser_trat" =>            $request->esguince_laser_trat,
      "tension_laser_trat" =>            $request->tension_laser_trat,
      "rusa_corriente_trat" =>            $request->rusa_corriente_trat,
      "interferencial_corriente_trat" =>            $request->interferencial_corriente_trat,
      "alto_corriente_trat" =>            $request->alto_corriente_trat,
      "tens_corriente_trat" =>            $request->tens_corriente_trat,
      "estiramiento_trat" =>            $request->estiramiento_trat,
      "klapp_metodo_trat" =>            $request->klapp_metodo_trat,
      "william_metodo_trat" => $request->william_metodo_trat,
      "wilson_metodo_trat" => $request->wilson_metodo_trat,
      "fnp_metodo_trat" => $request->fnp_metodo_trat,
      "codman_metodo_trat" => $request->codman_metodo_trat,
      "burguer_metodo_trat" => $request->burguer_metodo_trat,
      "kaltenbron_metodo_trat" => $request->kaltenbron_metodo_trat,
      "feldenkrais_metodo_trat" => $request->feldenkrais_metodo_trat,
      "isometrico_fortalecimiento_trat" => $request->isometrico_fortalecimiento_trat,
      "isocarga_fortalecimiento_trat" => $request->isocarga_fortalecimiento_trat,
      "nocarga_fortalecimiento_trat" => $request->nocarga_fortalecimiento_trat,
      "bozu_fortalecimiento_trat" => $request->bozu_fortalecimiento_trat,
      "theraband_fortalecimiento_trat" => $request->theraband_fortalecimiento_trat,
      "reduccion_trat" => $request->reduccion_trat,
      "rolido_marcha_trat" =>            $request->rolido_marcha_trat,
      "sentado_marcha_trat" => $request->sentado_marcha_trat,
      "arrastre_marcha_trat" => $request->arrastre_marcha_trat,
      "puntos_marcha_trat" => $request->puntos_marcha_trat,
      "rodillas_marcha_trat" => $request->rodillas_marcha_trat,
      "bipedo_marcha_trat" => $request->bipedo_marcha_trat,
      "descarga_marcha_trat" => $request->descarga_marcha_trat,
      "equilibrio_marcha_trat" => $request->equilibrio_marcha_trat,
      "coordinacion_marcha_trat" => $request->coordinacion_marcha_trat,
      "disocion_marcha_trat" => $request->disocion_marcha_trat,
      "consulta_id" => $consulta->id
    ]);
		
		return back();

    }
      
}
