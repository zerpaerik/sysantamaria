<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Treatment;
use App\Models\Pacientes;

use Toastr;

class TreatmentController extends Controller
{

      public function report($id){


      $ficha = Treatment::where('paciente','=',$id)->get();

      $paciente = Pacientes::where('id','=',$id)->first();

     

       $view = \View::make('consultas.historias.ficha')->with('ficha', $ficha)->with('paciente', $paciente);
       $pdf = \App::make('dompdf.wrapper');
       $pdf->loadHTML($view);
       return $pdf->stream('ficha_pdf');

  }




	public function create(Request $request){
	Treatment::create([
      "ficha_eval" => $request->ficha_eval, 
      "eva_eval" =>            $request->eva_eval,
      "frecuencia_eval" =>            $request->frecuencia_eval,
      "exac_eval" =>            json_encode($request->exac_eval),
      "inicio_eval" =>            $request->inicio_eval,
      "inicio_tiempo_eval" =>            $request->inicio_tiempo_eval,
      "dolor_eval" =>            json_encode($request->dolor_eval),
      "retraccion_eval" =>            json_encode($request->retraccion_eval),
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
      "rusa_corriente_trat" =>            json_encode($request->rusa_corriente_trat),
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
      "consulta_id" => $request->consulta_id,
      "metodo" => json_encode($request->metodo),
      "reduccion" => json_encode($request->reduc),
      "fortale" => json_encode($request->fortale),
      "tratamiento" => $request->tratamiento,
      "evento" => $request->evento_id,
      "paciente" => $request->paciente,
      "intensidad" => $request->intensidad,
      "tiempo" => $request->tiempo,
      "ciclo" => json_encode($request->ciclo),
      "magneto" => json_encode($request->magneto),
      //nuevos campos
      "actividad_exar" => $request->actividad_exar,
      "dolor_neuro" => $request->dolor_neuro,
     // "diagnostico_zona_eval" => $request->diagnostico_zona_eval,
      "ejercicios" => $request->ejercicios,
      "trata_compresas" => $request->trata_compresas,
      "intensidad_comp" => $request->tiempo,
      "tiempociclo" => $request->tiempociclo,
      "tiempocompresa" => $request->tiempocompresa,
      "tipo_dolor" => $request->tipo_dolor,
      "ciclo_eval" => $request->ciclo_eval
    ]);
	

	Toastr::success('Registrado Exitosamente.', '!', ['progressBar' => true]);

    return redirect()->route('consultas.inicio');
	}



}
