<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Atenciones;
use App\Models\Debitos;
use App\Models\Analisis;
use App\Models\Creditos;
use App\Models\Punziones;
use App\Models\ResultadosServicios;
use App\Models\ResultadosLaboratorios;
use App\Models\Events\Event;
use PDF;
use Auth;
use Carbon\Carbon;
use PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpWord\Style\Font;
use HTMLtoOpenXML;
class ReportesController extends Controller

{

	 public function verResultado($id=void){
       
                $searchtipo = DB::table('atenciones as a')
                ->select('a.id','a.es_servicio','a.es_laboratorio','a.resultado')
                ->where('a.resultado','=',1)
                ->where('a.id','=', $id)
                ->first();
           
                $es_servicio = $searchtipo->es_servicio;
                $es_laboratorio = $searchtipo->es_laboratorio;


                if (!is_null($es_servicio)) {

                $resultado = DB::table('atenciones as a')
                ->select('a.id','a.id_paciente','a.origen_usuario','a.resultado','a.id_servicio','b.name as nompac','b.lastname as apepac','c.nombres','c.apellidos','d.descripcion','e.detalle','a.created_at')
                ->join('users as b','b.id','a.origen_usuario')
                ->join('pacientes as c','c.id','a.id_paciente')
                ->join('resultados_servicios as d','d.id_atencion','a.id')
                ->join('servicios as e','e.id','a.id_servicio')
                ->where('a.resultado','=',1)
                ->where('a.id','=', $id)
                ->first();

                } else {

                $resultado = DB::table('atenciones as a')
                ->select('a.id','a.id_paciente','a.origen_usuario','a.resultado','a.id_laboratorio','b.name as nompac','b.lastname as apepac','c.nombres','c.apellidos','d.descripcion','e.name as detalle','a.created_at')
                ->join('users as b','b.id','a.origen_usuario')
                ->join('pacientes as c','c.id','a.id_paciente')
                ->join('resultados_laboratorios as d','d.id_atencion','a.id')
                ->join('analises as e','e.id','a.id_laboratorio')
                ->where('a.resultado','=',1)
                ->where('a.id','=', $id)
                ->first();


                }

        if(!is_null($resultado)){
            return $resultado;
         }else{
            return false;
         }  

     }


    public function editar($id)
    {
        $resultados = ReportesController::verResultado($id);

        return view('resultadosguardados.editar', ["resultados" => $resultados]);
    }

    public function update($id,Request $request)
    {      
        $searchtipo = DB::table('atenciones as a')
        ->select('a.id','a.es_servicio','a.es_laboratorio','a.resultado')
        ->where('a.resultado','=',1)
        ->where('a.id','=', $id)
        ->first();
           
        $es_servicio = $searchtipo->es_servicio;
        $es_laboratorio = $searchtipo->es_laboratorio;

        if (!is_null($es_servicio)) {
            DB::table('resultados_servicios')
            ->where('id_atencion',$searchtipo->id)
            ->update(['descripcion' => $request->descripcion]);
            return back();

        }
        else{
            DB::table('resultados_laboratorios')
            ->where('id_atencion',$searchtipo->id)
            ->update(['descripcion' => $request->descripcion]);
            return back();
        }

    }


      public function recibo_caja_ver(Request $request,$id) 
    {

    
      
      $caja = DB::table('cajas as  a')
        ->select('a.id','a.cierre_matutino','a.cierre_vespertino','a.created_at','a.fecha','a.balance','a.usuario','b.name','b.lastname')
        ->join('users as b','b.id','a.usuario')
        ->where('a.id','=',$id)
        ->first();


        $fecha=$caja->created_at;
        $fechainic=date('Y-m-d H:i:s', strtotime($caja->fecha));
        $fechafin=$caja->fecha." 23:59:59";
   
        


        $atenciones = Creditos::where('origen', 'ATENCIONES')
                                    ->whereNotIn('monto',[0,0.00,99999])
                                    //->whereBetween('created_at', [strtotime($fechainic),strtotime($fecha)])
                                    ->whereRaw("created_at >= ? AND created_at <= ?", 
                                     array($fechainic, $fecha))
                                    //->where('created_at','<=',$fecha)
                                   // ->whereBetween('created_at', [$fecha, $fecha])
                                    ->select(DB::raw('COUNT(*) as cantidad, SUM(monto) as monto'))
                                    ->first();
                           
                                

        if ($atenciones->cantidad == 0) {
            $atenciones->monto = 0;
        }

        $punziones = Creditos::where('origen','VENTA DE PUNZIONES')
                                    //->whereNotIn('monto',[0,0.00,99999])
                                    //->whereBetween('created_at', [strtotime($fechainic),strtotime($fecha)])
                                    ->whereRaw("created_at >= ? AND created_at <= ?", 
                                     array($fechainic, $fecha))
                                    //->where('created_at','<=',$fecha)
                                   // ->whereBetween('created_at', [$fecha, $fecha])
                                    ->select(DB::raw('COUNT(*) as cantidad, SUM(monto) as monto'))
                                    ->first();
                           
                                

        if ($punziones->cantidad == 0) {
            $punziones->monto = 0;
        }

       // dd($punziones);
       // die();


         $consultas = Creditos::where('origen', 'CONSULTAS')
                                    ->whereRaw("created_at >= ? AND created_at <= ?", 
                                     array($fechainic, $fecha))
                                    ->select(DB::raw('COUNT(*) as cantidad, SUM(monto) as monto'))
                                    ->first();
        if ($consultas->cantidad == 0) {
            $consultas->monto = 0;
        }

        $otros_servicios = Creditos::where('origen', 'OTROS INGRESOS')
                                    ->whereRaw("created_at >= ? AND created_at <= ?", 
                                     array($fechainic, $fecha))
                                    ->select(DB::raw('COUNT(*) as cantidad, SUM(monto) as monto'))
                                    ->first();
        if ($otros_servicios->cantidad == 0) {
            $otros_servicios->monto = 0;
        }

        $cuentasXcobrar = Creditos::where('origen', 'CUENTAS POR COBRAR')
                                    ->whereRaw("created_at >= ? AND created_at <= ?", 
                                     array($fechainic, $fecha))
                                    ->select(DB::raw('COUNT(*) as cantidad, SUM(monto) as monto'))
                                    ->first();
        if ($cuentasXcobrar->cantidad == 0) {
            $cuentasXcobrar->monto = 0;
        }

         $ventas = Creditos::where('origen','VENTA DE PRODUCTOS')
                                    ->whereRaw("created_at >= ? AND created_at <= ?", 
                                     array($fechainic, $fecha))
                                    ->select(DB::raw('COUNT(*) as cantidad, SUM(monto) as monto'))
                                    ->first();
        if ($ventas->cantidad == 0) {
            $ventas->monto = 0;
        }

        $egresos = Debitos::whereRaw("created_at >= ? AND created_at <= ?", 
                                     array($fechainic, $fecha))
                            ->select(DB::raw('origen, descripcion, monto'))
                            ->get();

        $efectivo = Creditos::where('tipo_ingreso', 'EF')
                            ->whereNotIn('monto',[0,0.00,99999])
                            ->whereRaw("created_at >= ? AND created_at <= ?", 
                                     array($fechainic, $fecha))
                            ->select(DB::raw('SUM(monto) as monto'))
                            ->first();
        if (is_null($efectivo->monto)) {
            $efectivo->monto = 0;
        }

        $tarjeta = Creditos::where('tipo_ingreso', 'TJ')
                            ->whereNotIn('monto',[0,0.00,99999])
                            ->whereRaw("created_at >= ? AND created_at <= ?", 
                                     array($fechainic, $fecha))
                            ->select(DB::raw('SUM(monto) as monto'))
                            ->first();

        if (is_null($tarjeta->monto)) {
            $tarjeta->monto = 0;
        }

         $totalEgresos = 0;

        foreach ($egresos as $egreso) {
            $totalEgresos += $egreso->monto;
        }
    
         $totalIngresos = $atenciones->monto + $consultas->monto + $otros_servicios->monto + $cuentasXcobrar->monto + $ventas->monto + $punziones->monto;

        
 


       
       $view = \View::make('reportes.cierre_caja_ver', compact('atenciones', 'consultas','otros_servicios', 'cuentasXcobrar','punziones','ventas','caja','egresos','efectivo','tarjeta','totalEgresos','totalIngresos'));
      
       //$view = \View::make('reportes.cierre_caja_ver')->with('caja', $caja);
       $pdf = \App::make('dompdf.wrapper');
       //$pdf->setPaper('A4', 'landscape');
       $pdf->loadHTML($view);
       return $pdf->stream('recibo_cierre_caja_ver');
    /* }else{
      return response()->json([false]);
     }*/
    }

    //
    public function recibo_caja_verd(Request $request,$id) 
    {

    
      
      $caja = DB::table('cajas as  a')
        ->select('a.id','a.cierre_matutino','a.cierre_vespertino','a.created_at','a.fecha','a.balance','a.usuario','b.name','b.lastname')
        ->join('users as b','b.id','a.usuario')
        ->where('a.id','=',$id)
        ->first();


        $fecha=$caja->created_at;
        $fechainic=date('Y-m-d H:i:s', strtotime($caja->fecha));
        $fechafin=$caja->fecha." 23:59:59";
   
    

          $servicios = DB::table('atenciones as a')
        ->select('a.id','a.created_at','a.id_paciente','a.origen_usuario','a.origen','a.id_servicio','a.id_paquete','a.id_laboratorio','a.es_servicio','a.monto','a.tipopago','a.porcentaje','a.abono','b.nombres','b.apellidos','c.detalle as servicio','e.name','e.lastname')
        ->join('pacientes as b','b.id','a.id_paciente')
        ->join('servicios as c','c.id','a.id_servicio')
        ->join('users as e','e.id','a.origen_usuario')
        ->where('a.es_servicio','=', 1)
         ->whereRaw("a.created_at >= ? AND a.created_at <= ?", 
                                     array($fechainic, $fecha))
        ->whereNotIn('a.monto',[0,0.00,99999])
        ->orderby('a.id','desc')
        ->get();

        $totalServicios = Atenciones::where('es_servicio',1)
                                     ->whereRaw("created_at >= ? AND created_at <= ?", 
                                     array($fechainic, $fecha))
                                    ->select(DB::raw('SUM(abono) as abono'))
                                    ->first();


         $laboratorios = DB::table('atenciones as a')
        ->select('a.id','a.created_at','a.id_paciente','a.origen_usuario','a.origen','a.id_servicio','a.id_paquete','a.id_laboratorio','a.es_laboratorio','a.monto','a.tipopago','a.porcentaje','a.abono','b.nombres','b.apellidos','c.name as laboratorio','e.name','e.lastname')
        ->join('pacientes as b','b.id','a.id_paciente')
        ->join('analises as c','c.id','a.id_laboratorio')
        ->join('users as e','e.id','a.origen_usuario')
        ->where('a.es_laboratorio','=', 1)
         ->whereRaw("a.created_at >= ? AND a.created_at <= ?", 
                                     array($fechainic, $fecha))
        ->whereNotIn('a.monto',[0,0.00])
        ->orderby('a.id','desc')
        ->get();

        $totalLaboratorios = Atenciones::where('es_laboratorio',1)
                                     ->whereRaw("created_at >= ? AND created_at <= ?", 
                                     array($fechainic, $fecha))
                                    ->select(DB::raw('SUM(abono) as abono'))
                                    ->first();

         $paquetes = DB::table('atenciones as a')
        ->select('a.id','a.created_at','a.id_paciente','a.origen_usuario','a.origen','a.id_servicio','a.id_paquete','a.id_laboratorio','a.es_laboratorio','a.monto','a.tipopago','a.porcentaje','a.abono','b.nombres','b.apellidos','c.detalle as paquete','e.name','e.lastname')
        ->join('pacientes as b','b.id','a.id_paciente')
        ->join('paquetes as c','c.id','a.id_paquete')
        ->join('users as e','e.id','a.origen_usuario')
        ->where('a.es_paquete','=', 1)
        ->whereRaw("a.created_at >= ? AND a.created_at <= ?", 
                                     array($fechainic, $fecha))
        ->whereNotIn('a.monto',[0,0.00])
        ->orderby('a.id','desc')
        ->get();

        $totalpaquetes = Atenciones::where('es_paquete',1)
                                    ->whereRaw("created_at >= ? AND created_at <= ?", 
                                     array($fechainic, $fecha))
                                    ->select(DB::raw('SUM(abono) as abono'))
                                    ->first();
       
         $consultas = DB::table('events as a')
        ->select('a.id','a.profesional','a.paciente','a.monto','a.date','a.created_at','b.nombres','b.apellidos','c.name','c.lastname as apepro')
        ->join('pacientes as b','b.id','a.paciente')
        ->join('personals as c','c.id','a.profesional')
        ->whereRaw("a.created_at >= ? AND a.created_at <= ?", 
                                     array($fechainic, $fecha))
        ->orderby('a.id','desc')
        ->get();

       

        $totalconsultas = Event::whereRaw("created_at >= ? AND created_at <= ?", 
                                     array($fechainic, $fecha))
                                    ->select(DB::raw('SUM(monto) as monto'))
                                    ->first();

         $punziones = DB::table('punziones as a')
        ->select('a.id','a.id_producto','a.cantidad','a.precio','a.tipo_ingreso','a.paciente','b.nombres','b.apellidos','c.nombre')
        ->join('pacientes as b','b.id','a.paciente')
        ->join('productos as c','c.id','a.id_producto')
        ->whereRaw("a.created_at >= ? AND a.created_at <= ?", 
                                     array($fechainic, $fecha))
        ->orderby('a.id','desc')
        ->get();

       

        $totalpunziones = Punziones::whereRaw("created_at >= ? AND created_at <= ?", 
                                     array($fechainic, $fecha))
                                    ->select(DB::raw('SUM(precio) as monto'))
                                    ->first();

        $otrosingresos = DB::table('creditos as a')
        ->select('a.id','a.origen','a.descripcion','a.tipo_ingreso','a.monto','a.created_at')
        ->where('a.origen','=','OTROS INGRESOS')
         ->whereRaw("a.created_at >= ? AND a.created_at <= ?", 
                                     array($fechainic, $fecha))
        ->orderby('a.id','desc')
        ->get();

        $totalotrosingresos = Creditos::where('origen','OTROS INGRESOS')
                                     ->whereRaw("created_at >= ? AND created_at <= ?", 
                                     array($fechainic, $fecha))
                                    ->select(DB::raw('SUM(monto) as monto'))
                                    ->first();

        $cuentasporcobrar = DB::table('creditos as a')
        ->select('a.id','a.origen','a.descripcion','a.tipo_ingreso','a.monto','a.created_at','a.id_atencion','b.id_paciente','b.id_servicio','b.id_laboratorio','b.id_paquete','b.es_servicio','b.es_laboratorio','b.es_paquete','c.nombres','c.apellidos','s.detalle as servicio','l.name as laboratorio','p.detalle as paquete')
        ->join('atenciones as b','b.id','a.id_atencion')
        ->join('pacientes as c','c.id','b.id_paciente')
        ->join('servicios as s','s.id','b.id_servicio')
        ->join('analises as l','l.id','b.id_laboratorio')
        ->join('paquetes as p','p.id','b.id_paquete')
        ->where('a.origen','=','CUENTAS POR COBRAR')
         ->whereRaw("a.created_at >= ? AND a.created_at <= ?", 
                                     array($fechainic, $fecha))
        ->orderby('a.id','desc')
        ->get();

        $totalcuentasporcobrar = Creditos::where('origen','CUENTAS POR COBRAR')
                                     ->whereRaw("created_at >= ? AND created_at <= ?", 
                                     array($fechainic, $fecha))
                                    ->select(DB::raw('SUM(monto) as monto'))
                                    ->first();
    
         $ventas = DB::table('ventas as a')
        ->select('a.id','a.id_producto','a.cantidad','a.monto','a.created_at','b.nombre')
        ->join('productos as b','b.id','a.id_producto')
         ->whereRaw("a.created_at >= ? AND a.created_at <= ?", 
                                     array($fechainic, $fecha))
        ->orderby('a.id','desc')
        ->get();

        $totalventas = Creditos::where('origen','VENTA DE PRODUCTOS')
                                     ->whereRaw("created_at >= ? AND created_at <= ?", 
                                     array($fechainic, $fecha))
                                    ->select(DB::raw('SUM(monto) as monto'))
                                    ->first();
     
 

        $view = \View::make('reportes.cierre_caja_verd', compact('servicios', 'totalServicios','laboratorios', 'totalLaboratorios', 'consultas', 'totalconsultas','otrosingresos','totalotrosingresos','cuentasporcobrar','totalcuentasporcobrar','ventas','totalventas','paquetes','totalpaquetes','caja','punziones','totalpunziones'));
      
       //$view = \View::make('reportes.cierre_caja_ver')->with('caja', $caja);
       $pdf = \App::make('dompdf.wrapper');
       //$pdf->setPaper('A4', 'landscape');
       $pdf->loadHTML($view);
       return $pdf->stream('recibo_cierre_caja_ver_detallado');
    /* }else{
      return response()->json([false]);
     }*/
    }





    //

     public function recibo_caja_ver2(Request $request,$id,$fecha1=NULL,$fecha2=NULL) 
    {
      


    

    if(!is_null($request->fecha1) && (!is_null($request->fecha2))){

        $cajamañana=DB::table('cajas as  a')
        ->select('a.id','a.cierre_matutino','a.cierre_vespertino','a.created_at','a.fecha','a.balance','a.usuario','b.name','b.lastname')
        ->join('users as b','b.id','a.usuario')
        ->whereDate('a.fecha','=',$request->fecha1)
        ->first(); 
        
        $fechamañana=$cajamañana->created_at; 

 
        

   } else {

     $cajamañana=DB::table('cajas as  a')
        ->select('a.id','a.cierre_matutino','a.cierre_vespertino','a.created_at','a.fecha','a.balance','a.usuario','b.name','b.lastname')
        ->join('users as b','b.id','a.usuario')
        ->whereDate('fecha','=',Carbon::today()->toDateString())
        ->first();  

      $fechamañana=$cajamañana->created_at; 
}
    
      
      $caja = DB::table('cajas as  a')
        ->select('a.id','a.cierre_matutino','a.cierre_vespertino','a.created_at','a.fecha','a.balance','a.usuario','b.name','b.lastname')
        ->join('users as b','b.id','a.usuario')
        ->where('a.id','=',$id)
        ->first();

        $fecha=$caja->created_at;


           

  
      //  $ver=Carbon::toDateTimeString($caja->created_at);

        $atenciones = Creditos::where('origen', 'ATENCIONES')
                                    ->whereNotIn('monto',[0,0.00,99999])
                                    //->whereBetween('created_at', [strtotime($fechainic),strtotime($fecha)])
                                    ->whereRaw("created_at > ? AND created_at <= ?", 
                                     array($fechamañana, $fecha))
                                    //->where('created_at','>',Carbon::toDateTimeString($caja->created_at))
                                 //   ->whereBetween('created_at', ['2019-01-20 11','2019-01-20 23'])
                                    //->where('created_at','>=',$fecha)
                                    //->whereTime('created_at', '>=', $fecha)
                                    ->select(DB::raw('COUNT(*) as cantidad, SUM(monto) as monto'))
                                    ->first();
             


        if ($atenciones->cantidad == 0) {
            $atenciones->monto = 0;
        }

        $punziones = Punziones::whereRaw("created_at > ? AND created_at <= ?", 
                                     array($fechamañana, $fecha))
                                    //->where('created_at','<=',$fecha)
                                   // ->whereBetween('created_at', [$fecha, $fecha])
                                    ->select(DB::raw('COUNT(*) as cantidad, SUM(precio) as monto'))
                                    ->first();
                           
                                

        if ($punziones->cantidad == 0) {
            $punziones->monto = 0;
        }


         $consultas = Creditos::where('origen', 'CONSULTAS')
                                      ->whereRaw("created_at > ? AND created_at <= ?", 
                                     array($fechamañana, $fecha))
                                    ->select(DB::raw('COUNT(*) as cantidad, SUM(monto) as monto'))
                                    ->first();
        if ($consultas->cantidad == 0) {
            $consultas->monto = 0;
        }

        $otros_servicios = Creditos::where('origen', 'OTROS INGRESOS')
                                      ->whereRaw("created_at > ? AND created_at <= ?", 
                                     array($fechamañana, $fecha))
                                    ->select(DB::raw('COUNT(*) as cantidad, SUM(monto) as monto'))
                                    ->first();
        if ($otros_servicios->cantidad == 0) {
            $otros_servicios->monto = 0;
        }

        $cuentasXcobrar = Creditos::where('origen', 'CUENTAS POR COBRAR')
                                       ->whereRaw("created_at > ? AND created_at <= ?", 
                                     array($fechamañana, $fecha))
                                    ->select(DB::raw('COUNT(*) as cantidad, SUM(monto) as monto'))
                                    ->first();
        if ($cuentasXcobrar->cantidad == 0) {
            $cuentasXcobrar->monto = 0;
        }

         $ventas = Creditos::where('origen','VENTA DE PRODUCTOS')
                                    ->whereRaw("created_at > ? AND created_at <= ?", 
                                     array($fechamañana, $fecha))
                                    ->select(DB::raw('COUNT(*) as cantidad, SUM(monto) as monto'))
                                    ->first();
        if ($ventas->cantidad == 0) {
            $ventas->monto = 0;
        }


        $egresos = Debitos::whereRaw("created_at > ? AND created_at <= ?", 
                                     array($fechamañana, $fecha))
                            ->select(DB::raw('origen, descripcion, monto'))
                            ->get();

        $efectivo = Creditos::where('tipo_ingreso', 'EF')
                            ->whereNotIn('monto',[0,0.00,99999])
                            ->whereRaw("created_at > ? AND created_at <= ?", 
                                     array($fechamañana, $fecha))
                            ->select(DB::raw('SUM(monto) as monto'))
                            ->first();
        if (is_null($efectivo->monto)) {
            $efectivo->monto = 0;
        }

        $tarjeta = Creditos::where('tipo_ingreso', 'TJ')
                            ->whereNotIn('monto',[0,0.00,99999])
                            ->whereRaw("created_at > ? AND created_at <= ?", 
                                     array($fechamañana, $fecha))
                            ->select(DB::raw('SUM(monto) as monto'))
                            ->first();

        if (is_null($tarjeta->monto)) {
            $tarjeta->monto = 0;
        }

         $totalEgresos = 0;

        foreach ($egresos as $egreso) {
            $totalEgresos += $egreso->monto;
        }
    
         $totalIngresos = $atenciones->monto + $consultas->monto + $otros_servicios->monto + $cuentasXcobrar->monto + $ventas->monto + $punziones->monto;

    

        
 

       // $fecha = $caja->fecha;

       
       $view = \View::make('reportes.cierre_caja_ver', compact('atenciones', 'consultas','otros_servicios', 'cuentasXcobrar','ventas','punziones','caja','egresos','totalEgresos','totalIngresos','efectivo','tarjeta','caja'));
      
       //$view = \View::make('reportes.cierre_caja_ver')->with('caja', $caja);
       $pdf = \App::make('dompdf.wrapper');
       //$pdf->setPaper('A4', 'landscape');
       $pdf->loadHTML($view);
       return $pdf->stream('recibo_cierre_caja_ver');
    /* }else{
     }*/
    }

    //
      public function recibo_caja_ver2d(Request $request,$id,$fecha1=NULL,$fecha2=NULL) 
    {
      


    

    if(!is_null($request->fecha1) && (!is_null($request->fecha2))){

        $cajamañana=DB::table('cajas as  a')
        ->select('a.id','a.cierre_matutino','a.cierre_vespertino','a.created_at','a.fecha','a.balance','a.usuario','b.name','b.lastname')
        ->join('users as b','b.id','a.usuario')
        ->whereDate('a.fecha','=',$request->fecha1)
        ->first(); 
        
        $fechamañana=$cajamañana->created_at; 

 
        

   } else {

     $cajamañana=DB::table('cajas as  a')
        ->select('a.id','a.cierre_matutino','a.cierre_vespertino','a.created_at','a.fecha','a.balance','a.usuario','b.name','b.lastname')
        ->join('users as b','b.id','a.usuario')
        ->whereDate('fecha','=',Carbon::today()->toDateString())
        ->first();  

      $fechamañana=$cajamañana->created_at; 
}
    
      
      $caja = DB::table('cajas as  a')
        ->select('a.id','a.cierre_matutino','a.cierre_vespertino','a.created_at','a.fecha','a.balance','a.usuario','b.name','b.lastname')
        ->join('users as b','b.id','a.usuario')
        ->where('a.id','=',$id)
        ->first();

        $fecha=$caja->created_at;


        
       //
           $servicios = DB::table('atenciones as a')
        ->select('a.id','a.created_at','a.id_paciente','a.origen_usuario','a.origen','a.id_servicio','a.id_paquete','a.id_laboratorio','a.es_servicio','a.monto','a.tipopago','a.porcentaje','a.abono','b.nombres','b.apellidos','c.detalle as servicio','e.name','e.lastname')
        ->join('pacientes as b','b.id','a.id_paciente')
        ->join('servicios as c','c.id','a.id_servicio')
        ->join('users as e','e.id','a.origen_usuario')
        ->where('a.es_servicio','=', 1)
        ->whereRaw("a.created_at > ? AND a.created_at <= ?", 
                                     array($fechamañana, $fecha))
        ->whereNotIn('a.monto',[0,0.00,99999])
        ->orderby('a.id','desc')
        ->get();

        $totalServicios = Atenciones::where('es_servicio',1)
                                     ->whereRaw("created_at > ? AND created_at <= ?", 
                                     array($fechamañana, $fecha))
                                    ->select(DB::raw('SUM(abono) as abono'))
                                    ->first();

         $laboratorios = DB::table('atenciones as a')
        ->select('a.id','a.created_at','a.id_paciente','a.origen_usuario','a.origen','a.id_servicio','a.id_paquete','a.id_laboratorio','a.es_laboratorio','a.monto','a.tipopago','a.porcentaje','a.abono','b.nombres','b.apellidos','c.name as laboratorio','e.name','e.lastname')
        ->join('pacientes as b','b.id','a.id_paciente')
        ->join('analises as c','c.id','a.id_laboratorio')
        ->join('users as e','e.id','a.origen_usuario')
        ->where('a.es_laboratorio','=', 1)
         ->whereRaw("a.created_at > ? AND a.created_at <= ?", 
                                     array($fechamañana, $fecha))
        ->whereNotIn('a.monto',[0,0.00])
        ->orderby('a.id','desc')
        ->get();

        $totalLaboratorios = Atenciones::where('es_laboratorio',1)
                                     ->whereRaw("created_at > ? AND created_at <= ?", 
                                     array($fechamañana, $fecha))
                                    ->select(DB::raw('SUM(abono) as abono'))
                                    ->first();

         $paquetes = DB::table('atenciones as a')
        ->select('a.id','a.created_at','a.id_paciente','a.origen_usuario','a.origen','a.id_servicio','a.id_paquete','a.id_laboratorio','a.es_laboratorio','a.monto','a.tipopago','a.porcentaje','a.abono','b.nombres','b.apellidos','c.detalle as paquete','e.name','e.lastname')
        ->join('pacientes as b','b.id','a.id_paciente')
        ->join('paquetes as c','c.id','a.id_paquete')
        ->join('users as e','e.id','a.origen_usuario')
        ->where('a.es_paquete','=', 1)
        ->whereRaw("a.created_at > ? AND a.created_at <= ?", 
                                     array($fechamañana, $fecha))
        ->whereNotIn('a.monto',[0,0.00])
        ->orderby('a.id','desc')
        ->get();

        $totalpaquetes = Atenciones::where('es_paquete',1)
                                    ->whereRaw("created_at > ? AND created_at <= ?", 
                                     array($fechamañana, $fecha))
                                    ->select(DB::raw('SUM(abono) as abono'))
                                    ->first();
       
         $consultas = DB::table('events as a')
        ->select('a.id','a.profesional','a.paciente','a.monto','a.date','a.created_at','b.nombres','b.apellidos','c.name','c.lastname as apepro')
        ->join('pacientes as b','b.id','a.paciente')
        ->join('personals as c','c.id','a.profesional')
        ->whereRaw("a.created_at > ? AND a.created_at <= ?", 
                                     array($fechamañana, $fecha))
        ->orderby('a.id','desc')
        ->get();

         $punziones = DB::table('punziones as a')
        ->select('a.id','a.id_producto','a.cantidad','a.precio','a.tipo_ingreso','a.paciente','b.nombres','b.apellidos','c.nombre','a.created_at')
        ->join('pacientes as b','b.id','a.paciente')
        ->join('productos as c','c.id','a.id_producto')
        ->whereRaw("a.created_at > ? AND a.created_at <= ?", 
                                     array($fechamañana, $fecha))
        ->orderby('a.id','desc')
        ->get();

       

        $totalpunziones = Punziones::whereRaw("created_at > ? AND created_at <= ?", 
                                     array($fechamañana, $fecha))
                                    ->select(DB::raw('SUM(precio) as monto'))
                                    ->first();

       

        $totalconsultas = Event::whereRaw("created_at > ? AND created_at <= ?", 
                                     array($fechamañana, $fecha))
                                    ->select(DB::raw('SUM(monto) as monto'))
                                    ->first();

        $otrosingresos = DB::table('creditos as a')
        ->select('a.id','a.origen','a.descripcion','a.tipo_ingreso','a.monto','a.created_at')
        ->where('a.origen','=','OTROS INGRESOS')
         ->whereRaw("a.created_at > ? AND a.created_at <= ?", 
                                     array($fechamañana, $fecha))
        ->orderby('a.id','desc')
        ->get();

        $totalotrosingresos = Creditos::where('origen','OTROS INGRESOS')
                                     ->whereRaw("created_at > ? AND created_at <= ?", 
                                     array($fechamañana, $fecha))
                                    ->select(DB::raw('SUM(monto) as monto'))
                                    ->first();

        $cuentasporcobrar = DB::table('creditos as a')
        ->select('a.id','a.origen','a.descripcion','a.tipo_ingreso','a.monto','a.created_at','a.id_atencion','b.id_paciente','b.id_servicio','b.id_laboratorio','b.id_paquete','b.es_servicio','b.es_laboratorio','b.es_paquete','c.nombres','c.apellidos','s.detalle as servicio','l.name as laboratorio','p.detalle as paquete')
        ->join('atenciones as b','b.id','a.id_atencion')
        ->join('pacientes as c','c.id','b.id_paciente')
        ->join('servicios as s','s.id','b.id_servicio')
        ->join('analises as l','l.id','b.id_laboratorio')
        ->join('paquetes as p','p.id','b.id_paquete')
        ->where('a.origen','=','CUENTAS POR COBRAR')
        ->whereRaw("a.created_at > ? AND a.created_at <= ?", 
                                     array($fechamañana, $fecha))
        ->orderby('a.id','desc')
        ->get();

        $totalcuentasporcobrar = Creditos::where('origen','CUENTAS POR COBRAR')
                                     ->whereRaw("created_at > ? AND created_at <= ?", 
                                     array($fechamañana, $fecha))
                                    ->select(DB::raw('SUM(monto) as monto'))
                                    ->first();
    
         $ventas = DB::table('ventas as a')
        ->select('a.id','a.id_producto','a.cantidad','a.monto','a.created_at','b.nombre')
        ->join('productos as b','b.id','a.id_producto')
        ->whereRaw("a.created_at > ? AND a.created_at <= ?", 
                                     array($fechamañana, $fecha))
        ->orderby('a.id','desc')
        ->get();

        $totalventas = Creditos::where('origen','VENTA DE PRODUCTOS')
                                    ->whereRaw("created_at > ? AND created_at <= ?", 
                                     array($fechamañana, $fecha))
                                    ->select(DB::raw('SUM(monto) as monto'))
                                    ->first();
     

       // $fecha = $caja->fecha;

       

        $view = \View::make('reportes.cierre_caja_verd', compact('servicios', 'totalServicios','laboratorios', 'totalLaboratorios', 'consultas', 'totalconsultas','otrosingresos','totalotrosingresos','cuentasporcobrar','totalcuentasporcobrar','ventas','totalventas','paquetes','totalpaquetes','caja','punziones','totalpunziones'));


      
       //$view = \View::make('reportes.cierre_caja_ver')->with('caja', $caja);
       $pdf = \App::make('dompdf.wrapper');
       //$pdf->setPaper('A4', 'landscape');
       $pdf->loadHTML($view);
       return $pdf->stream('recibo_cierre_caja_ver_detallado');
    /* }else{
     }*/
    }





    //



    public function resultados_ver($id) 
    {
        $resultados =ReportesController::verResultado($id);
        $view = \View::make('reportes.resultados_ver')->with('resultados', $resultados);
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('resultados_ver');
    }
	
	
	 public function verTicket($id){
       
                $searchtipo = DB::table('atenciones')
                ->select('id','es_servicio','es_laboratorio')
                ->where('id','=', $id)
                ->first();
           
                $es_servicio = $searchtipo->es_servicio;
                $es_laboratorio = $searchtipo->es_laboratorio;
				
		
                if (!is_null($es_servicio)) {

                $ticket = DB::table('atenciones as a')
                ->select('a.id','a.id_paciente','a.origen_usuario','a.id_servicio','b.name as nompac','b.lastname as apepac','c.nombres','c.apellidos','c.dni','e.detalle','a.created_at','a.abono','a.pendiente','a.monto')
                ->join('users as b','b.id','a.origen_usuario')
                ->join('pacientes as c','c.id','a.id_paciente')
                ->join('servicios as e','e.id','a.id_servicio')
                ->where('a.id','=', $id)
                ->first();
				
			 

                } else {

                $ticket = DB::table('atenciones as a')
                ->select('a.id','a.id_paciente','a.origen_usuario','a.id_laboratorio','b.name as nompac','b.lastname as apepac','c.nombres','c.dni','c.apellidos','e.name as detalle','a.created_at','a.abono','a.pendiente','a.monto')
                ->join('users as b','b.id','a.origen_usuario')
                ->join('pacientes as c','c.id','a.id_paciente')
                ->join('analises as e','e.id','a.id_laboratorio')
                ->where('a.id','=', $id)
                ->first();


                }

        if(!is_null($ticket)){
            return $ticket;
         }else{
            return false;
         }  

     }
	
	 public function ticket_ver($id) 
    {
        $ticket =ReportesController::verTicket($id);
        $view = \View::make('reportes.ticket_atencion_ver')->with('ticket', $ticket);
        $pdf = \App::make('dompdf.wrapper');
        //$pdf->setPaper(array(0,0,867.00,343.80));
        $pdf->loadHTML($view);
        return $pdf->stream('ticket_ver');
    }

    public function formDiario()
    {
        return view('reportes.form_diario');
    }

      public function formConsolidado()
    {
        return view('reportes.form_consolidado');
    }


    public function relacion_diario(Request $request)
    {
        $atenciones = Creditos::where('origen', 'ATENCIONES')
                                    ->whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($request->fecha)), date('Y-m-d 23:59:59', strtotime($request->fecha))])
                                    ->whereNotIn('monto',[0,0.00])
                                    ->select(DB::raw('COUNT(*) as cantidad, SUM(monto) as monto'))
                                    ->first();
        if ($atenciones->cantidad == 0) {
            $atenciones->monto = 0;
        }

        $consultas = Creditos::where('origen', 'CONSULTAS')
                                    ->whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($request->fecha)), date('Y-m-d 23:59:59', strtotime($request->fecha))])
                                    ->select(DB::raw('COUNT(*) as cantidad, SUM(monto) as monto'))
                                    ->first();
        if ($consultas->cantidad == 0) {
            $consultas->monto = 0;
        }

        $otros_servicios = Creditos::where('origen', 'OTROS INGRESOS')
                                    ->whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($request->fecha)), date('Y-m-d 23:59:59', strtotime($request->fecha))])
                                    ->select(DB::raw('COUNT(*) as cantidad, SUM(monto) as monto'))
                                    ->first();
        if ($otros_servicios->cantidad == 0) {
            $otros_servicios->monto = 0;
        }

        $cuentasXcobrar = Creditos::where('origen', 'CUENTAS POR COBRAR')
                                    ->whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($request->fecha)), date('Y-m-d 23:59:59', strtotime($request->fecha))])
                                    ->select(DB::raw('COUNT(*) as cantidad, SUM(monto) as monto'))
                                    ->first();
        if ($cuentasXcobrar->cantidad == 0) {
            $cuentasXcobrar->monto = 0;
        }
		
		 $ventas = Creditos::where('origen', 'VENTA DE PRODUCTOS')
                                    ->whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($request->fecha)), date('Y-m-d 23:59:59', strtotime($request->fecha))])
                                    ->select(DB::raw('COUNT(*) as cantidad, SUM(monto) as monto'))
                                    ->first();
        if ($ventas->cantidad == 0) {
            $ventas->monto = 0;
        }

        $punziones = Punziones::whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($request->fecha)), date('Y-m-d 23:59:59', strtotime($request->fecha))])
                                    ->select(DB::raw('COUNT(*) as cantidad, SUM(precio) as monto'))
                                    ->first();
        if ($punziones->cantidad == 0) {
            $punziones->monto = 0;
        }

        $egresos = Debitos::whereDate('created_at','=',$request->fecha)
                            ->select(DB::raw('origen, descripcion, monto'))
                            ->get();

      

        $efectivo = Creditos::where('tipo_ingreso', 'EF')
                            ->whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($request->fecha)), date('Y-m-d 23:59:59', strtotime($request->fecha))])
                            ->select(DB::raw('SUM(monto) as monto'))
                            ->first();
        if (is_null($efectivo->monto)) {
            $efectivo->monto = 0;
        }

        $tarjeta = Creditos::where('tipo_ingreso', 'TJ')
                            ->whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($request->fecha)), date('Y-m-d 23:59:59', strtotime($request->fecha))])
                            ->select(DB::raw('SUM(monto) as monto'))
                            ->first();

        if (is_null($tarjeta->monto)) {
            $tarjeta->monto = 0;
        }

        $totalIngresos = $atenciones->monto + $consultas->monto + $otros_servicios->monto + $cuentasXcobrar->monto + $ventas->monto + $punziones->monto;

        $totalEgresos = 0;

        foreach ($egresos as $egreso) {
            $totalEgresos += $egreso->monto;
        }

        $fecha= $request->fecha;

        $view = \View::make('reportes.diario', compact('atenciones', 'consultas','otros_servicios', 'cuentasXcobrar', 'egresos', 'tarjeta', 'efectivo', 'totalEgresos', 'totalIngresos','ventas','punziones','fecha'));

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
     
       
        return $pdf->stream('diario_'.$request->fecha.'.pdf');

    }


    public function verReciboProfesional($id){
       
         $reciboprofesional = DB::table('atenciones as a')
        ->select('a.id','a.id_paciente','a.created_at','a.origen_usuario','a.origen','a.porcentaje','a.id_servicio','es_laboratorio','a.es_paquete','a.id_paquete','a.pagado_com','a.id_laboratorio','a.es_servicio','a.es_laboratorio','a.recibo','a.monto','a.porcentaje','a.abono','b.nombres','b.apellidos','c.detalle as servicio','d.name as laboratorio','e.name','e.lastname','d.name as laboratorio','p.detalle as paquete')
        ->join('pacientes as b','b.id','a.id_paciente')
        ->join('servicios as c','c.id','a.id_servicio')
        ->join('analises as d','d.id','a.id_laboratorio')
        ->join('paquetes as p','p.id','a.id_paquete')
        ->join('users as e','e.id','a.origen_usuario')
        ->where('a.pagado_com','=', 1)
        ->where('a.recibo','=', $id)
       // ->orderby('a.id','desc')
        ->get();

        if($reciboprofesional){
            return $reciboprofesional;
         }else{
            return false;
         }  

     }

     public function verReciboProfesional2($id){
       
         $reciboprofesional2 = DB::table('atenciones as a')
        ->select('a.id','a.id_paciente','a.origen_usuario','a.recibo','a.monto','a.porcentaje','a.abono','b.nombres','b.apellidos','e.name','e.lastname')
        ->join('pacientes as b','b.id','a.id_paciente')
        ->join('users as e','e.id','a.origen_usuario')
        ->where('a.pagado_com','=', 1)
        ->where('a.recibo','=', $id)
        ->groupBy('a.recibo')
        ->get();

        if($reciboprofesional2){
            return $reciboprofesional2;
         }else{
            return false;
         }  

     }

     public function verTotalRecibo($id){


        $totalRecibo = Atenciones::where('recibo', $id)
                            ->select(DB::raw('SUM(porcentaje) as totalrecibo'))
                            ->get();
     
        if($totalRecibo){
            return $totalRecibo;
         }else{
            return false;
         }  

     }

      public function recibo_profesionales_ver($id) 
    {

    
       $reciboprofesional = ReportesController::verReciboProfesional($id);
       $reciboprofesional2 = ReportesController::verReciboProfesional2($id);
       $totalrecibo = ReportesController::verTotalRecibo($id);



      
       $view = \View::make('reportes.recibo_profesionales_ver')->with('reciboprofesional', $reciboprofesional)->with('reciboprofesional2', $reciboprofesional2)->with('totalrecibo', $totalrecibo);
       $pdf = \App::make('dompdf.wrapper');
       $pdf->loadHTML($view);
       return $pdf->stream('recibo_profesionales_ver');
    /* }else{
      return response()->json([false]);
     }*/
    }


    public function general_ingresos(Reques $request){


     $otrosingresos = DB::table('creditos as a')
        ->select('a.id','a.origen','a.descripcion','a.tipo_ingreso','a.id_sede','a.monto','a.created_at')
        ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($request->fecha)), date('Y-m-d 23:59:59', strtotime($request->fecha))])
        ->where('a.id_sede','=', \Session::get("sede"))
        ->orderby('a.id','desc')
        ->get();








    }








    public function relacion_detallado(Request $request)
    {

        $servicios = DB::table('atenciones as a')
        ->select('a.id','a.created_at','a.id_paciente','a.origen_usuario','a.origen','a.id_servicio','a.id_paquete','a.id_laboratorio','a.es_servicio','a.monto','a.tipopago','a.porcentaje','a.abono','b.nombres','b.apellidos','c.detalle as servicio','e.name','e.lastname')
        ->join('pacientes as b','b.id','a.id_paciente')
        ->join('servicios as c','c.id','a.id_servicio')
        ->join('users as e','e.id','a.origen_usuario')
        ->where('a.es_servicio','=', 1)
        ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($request->fecha)), date('Y-m-d 23:59:59', strtotime($request->fecha))])
        ->whereNotIn('a.monto',[0,0.00,99999])
        ->orderby('a.id','desc')
        ->get();

        $totalServicios = Atenciones::where('es_servicio',1)
                                    ->whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($request->fecha)), date('Y-m-d 23:59:59', strtotime($request->fecha))])
                                    ->select(DB::raw('SUM(abono) as abono'))
                                    ->first();

         $laboratorios = DB::table('atenciones as a')
        ->select('a.id','a.created_at','a.id_paciente','a.origen_usuario','a.origen','a.id_servicio','a.id_paquete','a.id_laboratorio','a.es_laboratorio','a.monto','a.tipopago','a.porcentaje','a.abono','b.nombres','b.apellidos','c.name as laboratorio','e.name','e.lastname')
        ->join('pacientes as b','b.id','a.id_paciente')
        ->join('analises as c','c.id','a.id_laboratorio')
        ->join('users as e','e.id','a.origen_usuario')
        ->where('a.es_laboratorio','=', 1)
        ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($request->fecha)), date('Y-m-d 23:59:59', strtotime($request->fecha))])
        ->whereNotIn('a.monto',[0,0.00])
        ->orderby('a.id','desc')
        ->get();

        $totalLaboratorios = Atenciones::where('es_laboratorio',1)
                                    ->whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($request->fecha)), date('Y-m-d 23:59:59', strtotime($request->fecha))])
                                    ->select(DB::raw('SUM(abono) as abono'))
                                    ->first();

         $paquetes = DB::table('atenciones as a')
        ->select('a.id','a.created_at','a.id_paciente','a.origen_usuario','a.origen','a.id_servicio','a.id_paquete','a.id_laboratorio','a.es_laboratorio','a.monto','a.tipopago','a.porcentaje','a.abono','b.nombres','b.apellidos','c.detalle as paquete','e.name','e.lastname')
        ->join('pacientes as b','b.id','a.id_paciente')
        ->join('paquetes as c','c.id','a.id_paquete')
        ->join('users as e','e.id','a.origen_usuario')
        ->where('a.es_paquete','=', 1)
        ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($request->fecha)), date('Y-m-d 23:59:59', strtotime($request->fecha))])
        ->whereNotIn('a.monto',[0,0.00])
        ->orderby('a.id','desc')
        ->get();

        $totalpaquetes = Atenciones::where('es_paquete',1)
                                    ->whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($request->fecha)), date('Y-m-d 23:59:59', strtotime($request->fecha))])
                                    ->select(DB::raw('SUM(abono) as abono'))
                                    ->first();
       
         $consultas = DB::table('events as a')
        ->select('a.id','a.profesional','a.paciente','a.monto','a.date','a.created_at','b.nombres','b.apellidos','c.name','c.lastname as apepro')
        ->join('pacientes as b','b.id','a.paciente')
        ->join('personals as c','c.id','a.profesional')
        ->whereDate('a.created_at','=',$request->fecha)
        ->orderby('a.id','desc')
        ->get();

  

       

        $totalconsultas = Event::where('sede',NULL)
                                    ->whereDate('date','=',$request->fecha)
                                    ->select(DB::raw('SUM(monto) as monto'))
                                    ->first();

        $otrosingresos = DB::table('creditos as a')
        ->select('a.id','a.origen','a.descripcion','a.tipo_ingreso','a.monto','a.created_at')
        ->where('a.origen','=','OTROS INGRESOS')
        ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($request->fecha)), date('Y-m-d 23:59:59', strtotime($request->fecha))])
        ->orderby('a.id','desc')
        ->get();

        $totalotrosingresos = Creditos::where('origen','OTROS INGRESOS')
                                    ->whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($request->fecha)), date('                 Y-m-d 23:59:59', strtotime($request->fecha))])
                                    ->select(DB::raw('SUM(monto) as monto'))
                                    ->first();

        $cuentasporcobrar = DB::table('creditos as a')
        ->select('a.id','a.origen','a.descripcion','a.tipo_ingreso','a.monto','a.created_at','a.id_atencion','b.id_paciente','b.id_servicio','b.id_laboratorio','b.id_paquete','b.es_servicio','b.es_laboratorio','b.es_paquete','c.nombres','c.apellidos','s.detalle as servicio','l.name as laboratorio','p.detalle as paquete')
        ->join('atenciones as b','b.id','a.id_atencion')
        ->join('pacientes as c','c.id','b.id_paciente')
        ->join('servicios as s','s.id','b.id_servicio')
        ->join('analises as l','l.id','b.id_laboratorio')
        ->join('paquetes as p','p.id','b.id_paquete')
        ->where('a.origen','=','CUENTAS POR COBRAR')
        ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($request->fecha)), date('Y-m-d 23:59:59', strtotime($request->fecha))])
        ->orderby('a.id','desc')
        ->get();

        $totalcuentasporcobrar = Creditos::where('origen','CUENTAS POR COBRAR')
                                    ->whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($request->fecha)), date('                 Y-m-d 23:59:59', strtotime($request->fecha))])
                                    ->select(DB::raw('SUM(monto) as monto'))
                                    ->first();
    
         $ventas = DB::table('ventas as a')
        ->select('a.id','a.id_producto','a.cantidad','a.monto','a.created_at','b.nombre')
		->join('productos as b','b.id','a.id_producto')
        ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($request->fecha)), date('Y-m-d 23:59:59', strtotime($request->fecha))])
        ->orderby('a.id','desc')
        ->get();

        $totalventas = Creditos::where('origen','VENTA DE PRODUCTOS')
                                    ->whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($request->fecha)), date('                 Y-m-d 23:59:59', strtotime($request->fecha))])
                                    ->select(DB::raw('SUM(monto) as monto'))
                                    ->first();
     
               $fecha= $request->fecha;

       
        $view = \View::make('reportes.detallado', compact('servicios', 'totalServicios','laboratorios', 'totalLaboratorios', 'consultas', 'totalconsultas','otrosingresos','totalotrosingresos','cuentasporcobrar','totalcuentasporcobrar','ventas','totalventas','paquetes','totalpaquetes','fecha'));

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
     
       
        return $pdf->stream('detallado'.$request->fecha.'.pdf');

    }
    
  
}


