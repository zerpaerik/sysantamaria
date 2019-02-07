<?php
namespace App\Http\Controllers;
/**
 * 
 */
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use App\Models\Atenciones;
use App\Models\Debitos;
use App\Models\Analisis;
use App\Models\Creditos;
use Auth;
use Toastr;

class ReporteIngresosController extends Controller
{
	
	public function indexa(Request $request){


    $f1 = $request->fecha;
    $f2 = $request->fecha2;    


     



         $atenciones = DB::table('atenciones as a')
    ->select('a.id','a.created_at','a.id_paciente','a.origen_usuario','a.origen','a.id_servicio','a.pendiente','a.porc_pagar','a.id_paquete','a.id_laboratorio','a.es_servicio','a.es_laboratorio','a.es_paquete','a.monto','a.porcentaje','a.abono','b.nombres','b.apellidos','b.dni','c.detalle as servicio','e.name','e.lastname','d.name as laboratorio','f.detalle as paquete')
    ->join('pacientes as b','b.id','a.id_paciente')
    ->join('servicios as c','c.id','a.id_servicio')
    ->join('analises as d','d.id','a.id_laboratorio')
    ->join('users as e','e.id','a.origen_usuario')
    ->join('paquetes as f','f.id','a.id_paquete')
    ->whereNotIn('a.monto',[0,0.00,99999])
    ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])
    ->groupBy('a.id')
    ->get();



  


         $monto = Atenciones::whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59',strtotime($f2))])
                       ->whereNotIn('monto',[0,0.00,99999])
                       ->select(DB::raw('SUM(monto) as monto'))
                       ->first();
        if ($monto->monto == 0) {
        }

          $abono = Atenciones::whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59',strtotime($f2))])
                       ->whereNotIn('monto',[0,0.00,99999])
                       ->select(DB::raw('SUM(abono) as monto'))
                       ->first();
        if ($abono->monto == 0) {
        }

         $pendiente = Atenciones::whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59',strtotime($f2))])
                       ->whereNotIn('monto',[0,0.00,99999])
                       ->select(DB::raw('SUM(pendiente) as monto'))
                       ->first();
        if ($pendiente->monto == 0) {
        }

          $comision = Atenciones::whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59',strtotime($f2))])
                       ->whereNotIn('monto',[0,0.00,99999])
                       ->select(DB::raw('SUM(porcentaje) as monto'))
                       ->first();
        if ($comision->monto == 0) {
        }

          $cantidad = Atenciones::whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59',strtotime($f2))])
                                    ->whereNotIn('monto',[0,0.00,99999])
                                    ->select(DB::raw('COUNT(*) as cantidad'))
                                    ->first();
        if ($cantidad->cantidad == 0) {
        }


    


        return view('reportes.general_atenciones.index', ["atenciones" => $atenciones,"monto" => $monto,"pendiente" => $pendiente,"abono" => $abono,"cantidad" => $cantidad,"comision" => $comision]);
  }

    public function searcha(Request $request)
    {
      $search = $request->nom;
      $split = explode(" ",$search);
      $total = 0;

      if (!isset($split[1])) {
       
        $split[1] = '';
        $atenciones = $this->elasticSearch($request->inicio,$request->final,$split[0],$split[1]);
        foreach ($atenciones as $aten) {
          $total = $total + $aten->abono;
        }
        return view('reportes.general_atenciones.search', ["atenciones" => $atenciones,"total" => $total]); 

      }else{
        $atenciones = $this->elasticSearch($request->inicio,$request->final,$split[0],$split[1]); 
        foreach ($atenciones as $aten) {
          $total =  $total + $aten->abono; 
        } 
        return view('reportes.general_atenciones.search', ["atenciones" => $atenciones, "total" => $total]);   
      }    
    }

    public function indexe(Request $request){



          $f1 = $request->fecha;
          $f2 = $request->fecha2;    


        $atenciones = DB::table('debitos as a')
        ->select('a.id','a.descripcion','a.monto','a.origen','a.created_at')
        ->whereNotIn('a.monto',[0,0.00,99999])
        ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])
        ->orderby('a.id','desc')
        ->get();

          $aten = Debitos::whereNotIn('monto',[0,0.00,99999])
                        ->whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])
                       ->select(DB::raw('SUM(monto) as monto'))
                       ->first();

        if ($aten->monto == 0) {
        }

        $cantidad = Debitos::whereNotIn('monto',[0,0.00,99999])
                        ->whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])
                        ->select(DB::raw('COUNT(*) as cantidad'))
                       ->first();

        if ($cantidad->cantidad == 0) {
        }

        



        
        return view('reportes.general_egresos.index', ["atenciones" => $atenciones, "aten" => $aten,"cantidad" => $cantidad]);
  }

  

 
}