<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use App\Models\Atenciones;
use App\Models\Debitos;
use App\Models\Analisis;
use App\Models\Creditos;
use App\Models\Punziones;
use App\Caja;
use Auth;
use Toastr;
use PDF;



class CajaController extends Controller
{
    public function index(Request $request)
    {

       if(! is_null($request->fecha)) {

    $f1 = $request->fecha;
    $f2 = $request->fecha2;  

     // $caja = DB::table('cajas')->select('*')->where('sede','=',$request->session()->get('sede'))->whereBetween('fecha', [date('Y-m-d', strtotime($f1)), date('Y-m-d', strtotime($f2))])->get();


    
      $caja = DB::table('cajas as  a')
        ->select('a.id','a.cierre_matutino','a.cierre_vespertino','a.fecha','a.balance','a.usuario','b.name','b.lastname','a.created_at')
        ->join('users as b','b.id','a.usuario')
        ->whereBetween('a.fecha', [date('Y-m-d', strtotime($f1)), date('Y-m-d', strtotime($f2))])
        ->get();

        $aten = Creditos::whereNotIn('monto',[0,0.00])
                       ->whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])
                       ->select(DB::raw('SUM(monto) as monto'))
                       ->first();
      

        $mensaje;                      

        if (count($caja) == 0) {
            $mensaje = 'Matutino';
        }

        if(count($caja) >= 1)
        {
            $mensaje = 'Vespertino';
        }  




} else {


	 //  $caja = DB::table('cajas')->select('*')->where('sede','=',$request->session()->get('sede'))->where('fecha','=',Carbon::now()->toDateString())->get();

        $caja = DB::table('cajas as  a')
        ->select('a.id','a.cierre_matutino','a.cierre_vespertino','a.fecha','a.balance','a.usuario','b.name','b.lastname','a.created_at')
        ->join('users as b','b.id','a.usuario')
        ->where('a.fecha','=',Carbon::now()->toDateString())
        ->get();

	    $aten = Creditos::whereNotIn('monto',[0,0.00])
	                   ->whereDate('created_at', '=',Carbon::today()->toDateString())
	                   ->select(DB::raw('SUM(monto) as monto'))
	                   ->first();
      

		$mensaje;	                   


    	
    	
    	if (count($caja) == 0) {
    		$mensaje = 'Matutino';
    	}

    	if(count($caja) >= 1)
    	{
    		$mensaje = 'Vespertino';
    	}

        }

        $hoy =date('Y-m-d H:i:s');
		

	    return view('caja.index',[
	    	'total' => $aten,
	    	'mensaje' => $mensaje,
	    	'caja' => $caja,
	    	'fecha' => Carbon::now()->toDateString(),
            'fecha1' => $request->fecha,
            'fecha2' =>$request->fecha2,
            'hoy' => $hoy
	    ]);    	
    }

    public function saldo($id){

        $caja=Caja::where('fecha','=',Carbon::now()->toDateString())->first();

        if($caja){
        $fechamañana=$caja->created_at; 

        $fechanoche=date('Y-m-d H:i:s');
        

         $atenciones = Creditos::where('origen', 'ATENCIONES')
                                    ->whereNotIn('monto',[0,0.00,99999])
                                    ->whereRaw("created_at > ? AND created_at <= ?", 
                                     array($fechamañana, $fechanoche))
                                    ->select(DB::raw('COUNT(*) as cantidad, SUM(monto) as monto'))
                                    ->first();
             


        if ($atenciones->cantidad == 0) {
            $atenciones->monto = 0;
        }

        $punziones = Punziones::whereRaw("created_at > ? AND created_at <= ?", 
                                     array($fechamañana, $fechanoche))
                                    //->where('created_at','<=',$fecha)
                                   // ->whereBetween('created_at', [$fecha, $fecha])
                                    ->select(DB::raw('COUNT(*) as cantidad, SUM(precio) as monto'))
                                    ->first();
                           
                                

        if ($punziones->cantidad == 0) {
            $punziones->monto = 0;
        }


         $consultas = Creditos::where('origen', 'CONSULTAS')
                                      ->whereRaw("created_at > ? AND created_at <= ?", 
                                     array($fechamañana, $fechanoche))
                                    ->select(DB::raw('COUNT(*) as cantidad, SUM(monto) as monto'))
                                    ->first();
        if ($consultas->cantidad == 0) {
            $consultas->monto = 0;
        }

        $otros_servicios = Creditos::where('origen', 'OTROS INGRESOS')
                                      ->whereRaw("created_at > ? AND created_at <= ?", 
                                     array($fechamañana, $fechanoche))
                                    ->select(DB::raw('COUNT(*) as cantidad, SUM(monto) as monto'))
                                    ->first();
        if ($otros_servicios->cantidad == 0) {
            $otros_servicios->monto = 0;
        }

        $cuentasXcobrar = Creditos::where('origen', 'CUENTAS POR COBRAR')
                                       ->whereRaw("created_at > ? AND created_at <= ?", 
                                     array($fechamañana, $fechanoche))
                                    ->select(DB::raw('COUNT(*) as cantidad, SUM(monto) as monto'))
                                    ->first();
        if ($cuentasXcobrar->cantidad == 0) {
            $cuentasXcobrar->monto = 0;
        }

         $ventas = Creditos::where('origen','VENTA DE PRODUCTOS')
                                    ->whereRaw("created_at > ? AND created_at <= ?", 
                                     array($fechamañana, $fechanoche))
                                    ->select(DB::raw('COUNT(*) as cantidad, SUM(monto) as monto'))
                                    ->first();
        if ($ventas->cantidad == 0) {
            $ventas->monto = 0;
        }


        $egresos = Debitos::whereRaw("created_at > ? AND created_at <= ?", 
                                     array($fechamañana, $fechanoche))
                            ->select(DB::raw('origen, descripcion, monto'))
                            ->get();

        $efectivo = Creditos::where('tipo_ingreso','EF')
                            ->whereNotIn('monto',[0,0.00,99999])
                            ->whereRaw("created_at > ? AND created_at <= ?", 
                                     array($fechamañana, $fechanoche))
                            ->select(DB::raw('SUM(monto) as monto'))
                            ->first();
        if (is_null($efectivo->monto)) {
            $efectivo->monto = 0;
        }

        $tarjeta = Creditos::where('tipo_ingreso','TJ')
                            ->whereNotIn('monto',[0,0.00,99999])
                            ->whereRaw("created_at > ? AND created_at <= ?", 
                                     array($fechamañana, $fechanoche))
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


        }else{

            $fecha= Carbon::now()->toDateString();


            $atenciones = Creditos::where('origen', 'ATENCIONES')
                                    ->whereDate('created_at','=',$fecha)
                                    ->whereNotIn('monto',[0,0.00])
                                    ->select(DB::raw('COUNT(*) as cantidad, SUM(monto) as monto'))
                                    ->first();

                                    
        if ($atenciones->cantidad == 0) {
            $atenciones->monto = 0;
        }

        $consultas = Creditos::where('origen', 'CONSULTAS')
                                    ->whereDate('created_at','=',$fecha)
                                    ->select(DB::raw('COUNT(*) as cantidad, SUM(monto) as monto'))
                                    ->first();
        if ($consultas->cantidad == 0) {
            $consultas->monto = 0;
        }

        $otros_servicios = Creditos::where('origen', 'OTROS INGRESOS')
                                    ->whereDate('created_at','=',$fecha)
                                    ->select(DB::raw('COUNT(*) as cantidad, SUM(monto) as monto'))
                                    ->first();
        if ($otros_servicios->cantidad == 0) {
            $otros_servicios->monto = 0;
        }

        $cuentasXcobrar = Creditos::where('origen', 'CUENTAS POR COBRAR')
                                    ->whereDate('created_at','=',$fecha)
                                    ->select(DB::raw('COUNT(*) as cantidad, SUM(monto) as monto'))
                                    ->first();
        if ($cuentasXcobrar->cantidad == 0) {
            $cuentasXcobrar->monto = 0;
        }
        
         $ventas = Creditos::where('origen', 'VENTA DE PRODUCTOS')
                                    ->whereDate('created_at','=',$fecha)
                                    ->select(DB::raw('COUNT(*) as cantidad, SUM(monto) as monto'))
                                    ->first();
        if ($ventas->cantidad == 0) {
            $ventas->monto = 0;
        }

        $punziones = Punziones::whereDate('created_at','=',$fecha)
                                    ->select(DB::raw('COUNT(*) as cantidad, SUM(precio) as monto'))
                                    ->first();
        if ($punziones->cantidad == 0) {
            $punziones->monto = 0;
        }

        $egresos = Debitos::whereDate('created_at','=',$fecha)
                            ->select(DB::raw('origen, descripcion, monto'))
                            ->get();

      

        $efectivo = Creditos::where('tipo_ingreso','=','EF')
                            ->whereDate('created_at','=',$fecha)
                            ->select(DB::raw('SUM(monto) as monto'))
                            ->first();
        if (is_null($efectivo->monto)) {
            $efectivo->monto = 0;
        }

        $tarjeta = Creditos::where('tipo_ingreso','=','TJ')
                           ->whereDate('created_at','=',$fecha)
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
        }

              $hoy =date('Y-m-d H:i:s');

      return view('caja.saldo', compact('atenciones', 'consultas', 'otros_servicios','cuentasXcobrar','ventas','punziones','totalIngresos','totalEgresos','hoy','egresos','efectivo','tarjeta'));

    }


        public function create(Request $request)
    {
        $caja = DB::table('cajas')
        ->select('*')
        ->where('fecha','=',Carbon::now()->toDateString())
        ->get();

      

        if (count($caja) == 0) {
            Caja::create([
                'cierre_matutino' => $request->total,
                'cierre_vespertino' => 0,
                'fecha' => Carbon::now()->toDateString(),
                'balance' => $request->total,
                'usuario' => Auth::user()->id
            ]);
        }

        if(count($caja) == 1)
        {
             Caja::create([
                'cierre_matutino' => 0,
                'cierre_vespertino' => $request->total - $caja[0]->cierre_matutino,
                'fecha' => Carbon::now()->toDateString(),
                'balance' => $request->total,
                'usuario' => Auth::user()->id
            ]);
        }
        return redirect('/cierre-caja');

    }

  

    public function delete($id){

    $caja = Caja::find($id);
    $caja->delete();

    Toastr::success('Reversado Exitosamente.', 'Cierre de Caja!', ['progressBar' => true]);

     return redirect()->action('CajaController@index', ["created" => true, "caja" => Caja::all()]);
    
    
  }

   
    
}
