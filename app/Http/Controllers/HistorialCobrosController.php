<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use App\Models\Atenciones;
use App\Models\Debitos;
use App\Models\Analisis;
use App\Models\Historiales;
use Auth;
use Toastr;

class HistorialCobrosController extends Controller

{

	public function index(){
        $inicio = Carbon::now()->toDateString();
        $final = Carbon::now()->addDay()->toDateString();
        $atenciones = $this->elasticSearch($inicio,$final,'','');
       
        return view('movimientos.historialcobros.index', ["atenciones" => $atenciones]);
	}

    public function search(Request $request)
    {
      $search = $request->nom;
      $split = explode(" ",$search);
      $total = 0;

      if (!isset($split[1])) {
       
        $split[1] = '';
        $atenciones = $this->elasticSearch($request->inicio,$request->final,$split[0],$split[1]);
      
        return view('movimientos.historialcobros.search', ["atenciones" => $atenciones]); 

      }else{
        $atenciones = $this->elasticSearch($request->inicio,$request->final,$split[0],$split[1]); 
       
        return view('movimientos.historialcobros.search', ["atenciones" => $atenciones]);   
      }    
    }

	

  private function elasticSearch($initial,$final,$nom,$ape)
  { 
        $atenciones = DB::table('historialcobros as a')
        ->select('a.id','a.id_atencion','a.id_paciente','a.monto','a.abono_parcial','a.abono','a.pendiente','b.nombres','b.apellidos','a.created_at','a.updated_at')
        ->join('pacientes as b','b.id','a.id_paciente')
        ->where('b.nombres','like','%'.$nom.'%')
        ->where('b.apellidos','like','%'.$ape.'%')
        ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($initial)), date('Y-m-d 23:59:59', strtotime($initial))])
        ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($final)), date('Y-m-d 23:59:59', strtotime($final))])
        ->orderby('a.id','desc')
        ->paginate(20);
        return $atenciones;
  }




  
       
   
}
