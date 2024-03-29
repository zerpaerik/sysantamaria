<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use App\Models\Atenciones;
use App\Models\Creditos;
use App\Models\Debitos;
use App\Models\Analisis;
use App\Models\Historiales;
use App\Models\HistorialCobros;
use Auth;
use Toastr;

class HistorialCobrosController extends Controller

{

	public function index(Request $request){



      if(! is_null($request->fecha)) {

    $f1 = $request->fecha;
    $f2 = $request->fecha2;    
        

        $atenciones = DB::table('historialcobros as a')
        ->select('a.id','a.id_atencion','a.id_paciente','a.monto','a.abono_parcial','a.abono','a.pendiente','b.nombres','b.apellidos','b.dni','a.created_at','a.updated_at')
        ->join('pacientes as b','b.id','a.id_paciente')
        ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])
        ->orderby('a.id','ASC')
        ->get();

        $totalm = HistorialCobros::whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])
                      ->select(DB::raw('SUM(abono_parcial) as monto'))
                      ->first();

        $totalc = HistorialCobros::whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])
                                    ->select(DB::raw('COUNT(*) as cantidad'))
                                    ->first();



      } else {

        
        $atenciones = DB::table('historialcobros as a')
        ->select('a.id','a.id_atencion','a.id_paciente','a.monto','a.abono_parcial','a.abono','a.pendiente','b.nombres','b.apellidos','b.dni','a.created_at','a.updated_at')
        ->join('pacientes as b','b.id','a.id_paciente')
        ->whereDate('a.created_at', '=',Carbon::today()->toDateString())
        ->orderby('a.id','ASC')
        ->get();

         $totalm = HistorialCobros::whereDate('created_at', '=',Carbon::today()->toDateString())
                      ->select(DB::raw('SUM(abono_parcial) as monto'))
                      ->first();
                      
        $totalc = HistorialCobros::whereDate('created_at', '=',Carbon::today()->toDateString())
                                    ->select(DB::raw('COUNT(*) as cantidad'))
                                    ->first();

      }
       
        return view('movimientos.historialcobros.index', ["atenciones" => $atenciones,"totalm" => $totalm,"totalc" => $totalc]);
	}

  public function indexp(Request $request){



      if(! is_null($request->paciente)) {

 

        $atenciones = DB::table('historialcobros as a')
        ->select('a.id','a.id_atencion','a.id_paciente','a.monto','a.abono_parcial','a.abono','a.pendiente','b.nombres','b.apellidos','b.dni','a.created_at','a.updated_at')
        ->join('pacientes as b','b.id','a.id_paciente')
        ->where('a.id_paciente','=',$request->paciente)
        ->orderby('a.id','ASC')
        ->get();

      } else {

        
        $atenciones = DB::table('historialcobros as a')
        ->select('a.id','a.id_atencion','a.id_paciente','a.monto','a.abono_parcial','a.abono','a.pendiente','b.nombres','b.apellidos','b.dni','a.created_at','a.updated_at')
        ->join('pacientes as b','b.id','a.id_paciente')
        ->where('a.id_paciente','=',8989898988)
        ->orderby('a.id','ASC')
        ->get();

      }

        $pacientes = DB::table('pacientes as a')
        ->select('a.id','a.nombres','a.apellidos','a.dni','b.id_paciente')
        ->join('historialcobros as b','b.id_paciente','a.id')
        ->groupBy('a.id')
        ->get();
       
        return view('movimientos.historialcobros.indexp', ["atenciones" => $atenciones,"pacientes" => $pacientes]);
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
        ->get();
        return $atenciones;
  }

  public function delete($id){


    $historiac = DB::table('historialcobros as a')
        ->select('*')
       ->where('id_atencion','=',$id)
        ->first();

        $abono= $historiac->abono_parcial;

     $atenciones = DB::table('atenciones as a')
        ->select('*')
       ->where('id','=',$id)
        ->first();

      $pendiente= $atenciones->pendiente; 
      $abonado= $atenciones->abono;

    
    $atec = Atenciones::find($id);
    $atec->pendiente=$pendiente + $abono;
   // $atec->abono= $abonado - $abono;
    $atec->update();


    $creditos = HistorialCobros::where('id_atencion','=',$id);
    $creditos->delete();


    $creditoss = Creditos::where('id_atencion','=',$id);
    $creditoss->delete();

    Toastr::success('Eliminado Exitosamente.', 'Cobro!', ['progressBar' => true]);
        return redirect()->route('historialcobros.index');






  }




  
       
   
}
