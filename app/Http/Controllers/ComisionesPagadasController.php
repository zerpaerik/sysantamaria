<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use App\Models\Atenciones;
use App\Models\Debitos;
use App\Models\Analisis;
use Auth;
use Toastr;

class ComisionesPagadasController extends Controller

{

	 public function index(Request $request){


      if(! is_null($request->fecha)) {

    $f1 = $request->fecha;
    $f2 = $request->fecha2;    


   $atenciones = DB::table('atenciones as a')
 ->select('a.id','a.id_paciente','a.created_at','a.origen_usuario','a.origen','a.porc_pagar','a.id_servicio','es_laboratorio','a.pagado_com','a.fecha_pago_comision','a.id_laboratorio','a.es_servicio','a.es_laboratorio','a.recibo','a.monto','a.porcentaje','a.abono','b.nombres','b.apellidos','c.detalle as servicio','e.name','e.lastname','d.name as laboratorio',DB::raw('SUM(a.porcentaje) as totalrecibo'))
 ->join('pacientes as b','b.id','a.id_paciente')
 ->join('servicios as c','c.id','a.id_servicio')
 ->join('analises as d','d.id','a.id_laboratorio')
 ->join('users as e','e.id','a.origen_usuario')
 ->where('a.pagado_com','=', 1)
 ->whereNotIn('a.monto',[0,0.00])
 ->whereNotIn('a.origen_usuario',[99999999])
 ->whereBetween('a.fecha_pago_comision', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))]) 
 ->groupBy('a.recibo')
 ->orderby('a.id','desc')
 ->paginate(2000000);


 }else{

 $atenciones = DB::table('atenciones as a')
 ->select('a.id','a.id_paciente','a.created_at','a.origen_usuario','a.origen','a.porc_pagar','a.id_servicio','es_laboratorio','a.pagado_com','a.fecha_pago_comision','a.id_laboratorio','a.es_servicio','a.es_laboratorio','a.recibo','a.monto','a.porcentaje','a.abono','b.nombres','b.apellidos','c.detalle as servicio','e.name','e.lastname','d.name as laboratorio',DB::raw('SUM(a.porcentaje) as totalrecibo'))
 ->join('pacientes as b','b.id','a.id_paciente')
 ->join('servicios as c','c.id','a.id_servicio')
 ->join('analises as d','d.id','a.id_laboratorio')
 ->join('users as e','e.id','a.origen_usuario')
 ->where('a.pagado_com','=', 1)
 ->whereNotIn('a.monto',[0,0.00])
 ->whereNotIn('a.origen_usuario',[99999999])
 ->whereDate('a.fecha_pago_comision', '=',Carbon::today()->toDateString())
 ->groupBy('a.recibo')
 ->orderby('a.id','desc')
 ->get();

  $f1 = Carbon::today()->toDateString();
    $f2 = Carbon::today()->toDateString(); 


 }
       
        return view('movimientos.compagadas.index', ["atenciones" => $atenciones,"f1" => $f1,"f2" => $f2]);
  }


   

    public function reversar($id) {

        

          Atenciones::where('recibo', $id)
                  ->update([
                      'pagado_com' => NULL,
                      'recibo' => nULL
                  ]);
     
    Toastr::success('El pago de la comisiòn fue reversado.', 'Pago Reversado!', ['progressBar' => true]);
    return redirect()->route('compagadas.index');

  }

   public function reporte_pagadas(Request $request){

     $pagadas = DB::table('atenciones as a')
 ->select('a.id','a.id_paciente','a.created_at','a.origen','a.fecha_pago_comision','a.origen_usuario','a.origen','a.porc_pagar','a.id_servicio','es_laboratorio','a.pagado_com','a.id_laboratorio','a.es_servicio','a.es_laboratorio','a.recibo','a.monto','a.porcentaje','a.abono','b.nombres','b.apellidos','c.detalle as servicio','e.name','e.lastname','d.name as laboratorio',DB::raw('SUM(a.porcentaje) as totalrecibo'))
 ->join('pacientes as b','b.id','a.id_paciente')
 ->join('servicios as c','c.id','a.id_servicio')
 ->join('analises as d','d.id','a.id_laboratorio')
 ->join('users as e','e.id','a.origen_usuario')
 ->where('a.pagado_com','=', 1)
 ->whereNotIn('a.monto',[0,0.00])
 ->whereNotIn('a.origen_usuario',[99999999])
 ->whereBetween('a.fecha_pago_comision', [date('Y-m-d 00:00:00', strtotime($request->f1)), date('Y-m-d 23:59:59', strtotime($request->f2))]) 
 ->groupBy('a.recibo')
 ->orderby('a.recibo','desc')
 ->get();


   $aten = Atenciones::whereBetween('fecha_pago_comision', [date('Y-m-d', strtotime($request->f1)), date('Y-m-d', strtotime($request->f2))])
                                    //->whereNotIn('monto',[0,0.00])
                                    // ->whereNotIn('origen_usuario',[99999999])
                                     ->where('pagado_com','=', 1)
                                     ->select(DB::raw('SUM(porcentaje) as monto'))
                                    ->first();


        if ($aten->monto == 0) {
        }
    

     $sobres = Atenciones::whereBetween('fecha_pago_comision', [date('Y-m-d 00:00:00', strtotime($request->f1)), date('Y-m-d 23:59:59', strtotime($request->f2))])
                                    ->select(DB::raw('COUNT(DISTINCT recibo) as total'))
                                    ->first();
        if ($sobres->total == 0) {
        }

        $view = \View::make('movimientos.compagadas.reporte')->with('pagadas', $pagadas)->with('aten', $aten)->with('sobres', $sobres);
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('comisiones_pagadas');

  }
   
}
