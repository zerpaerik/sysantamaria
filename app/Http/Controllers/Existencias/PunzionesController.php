<?php

namespace App\Http\Controllers\Existencias;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Existencias\{Producto, Requerimientos, Transferencia};
use App\Models\Config\{Sede, Proveedor};
use App\Models\Punziones;
use App\Models\Pun;
use App\Models\Punsion;
use App\Models\Personal;
use App\Models\Creditos;
use App\Models\Pacientes;
use App\Models\ComisionPunzion;
use DB;
use Toastr;
use Carbon\Carbon;
use Auth;



class PunzionesController extends Controller
{

    public function index(Request $request){

    	       if(! is_null($request->fecha)) {

    	       	 $f1 = $request->fecha;
                 $f2 = $request->fecha2;  


      $punziones = DB::table('punziones as a')
                    ->select('a.id','id_pun','a.id_producto','a.cantidad','a.usuario','a.paciente','a.origen','a.precio','a.tipo_ingreso','a.created_at','c.name','c.lastname','d.nombre','d.codigo','p.name as nomper','p.lastname as apeper','b.nombres','b.apellidos')
                    ->join('users as c','c.id','a.usuario')
                    ->join('productos as d','d.id','a.id_producto')
                    ->join('personals as p','a.origen','p.id')
                    ->join('pacientes as b','a.paciente','b.id')
                    ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])
                    ->orderby('a.created_at','desc')
                    ->get(); 


             $pun = Punziones::whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59',strtotime($f2))])
                                    ->select(DB::raw('SUM(precio) as monto'))
                                    ->first();

            if ($pun->monto == 0) {
        }
          
           $cantidad = Punziones::whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59',                        strtotime($f2))])
               ->select(DB::raw('COUNT(*) as cantidad'))
               ->first(); 




                } else {




                	  $punziones = DB::table('punziones as a')
                    ->select('a.id','a.id_pun','a.id_producto','a.cantidad','a.usuario','a.origen','a.precio','a.tipo_ingreso','a.created_at','c.name','c.lastname','d.nombre','d.codigo','p.name as nomper','p.lastname as apeper','b.nombres','b.apellidos')
                    ->join('users as c','c.id','a.usuario')
                    ->join('productos as d','d.id','a.id_producto')
                    ->join('personals as p','a.origen','p.id')
                    ->join('pacientes as b','a.paciente','b.id')
                     ->whereDate('a.created_at', '=',Carbon::today()->toDateString())
                    ->orderby('a.created_at','desc')
                    ->get(); 

            $pun = Punziones::whereDate('created_at', '=',Carbon::today()->toDateString())
                                    ->select(DB::raw('SUM(precio) as monto'))
                                    ->first();

            if ($pun->monto == 0) {
        }
          
           $cantidad = Punziones::whereDate('created_at', '=',Carbon::today()->toDateString())
               ->select(DB::raw('COUNT(*) as cantidad'))
               ->first(); 
 


                }

			return view('existencias.punziones.index',compact('punziones','pun','cantidad'));   	
    }

   


    public function createView(){

    	return view('existencias.punziones.create', ["productos" => Producto::where('almacen','=',2)->where('categoria','=',6)->get(["id", "nombre","codigo"]),"personal" => Personal::where('estatus','=',1)->get(),"pacientes" => Pacientes::where('estatus','=',1)->get(),"punsion" => Punsion::where('estatus','=',1)->get()]);
    }


     


    public function create(Request $request){

          $pun = new Pun();
          $pun->precio =$request->precio;
          $pun->save();

          $creditos = new Creditos();
          $creditos->origen = 'VENTA DE PUNZIONES';
          $creditos->id_atencion =NULL;
          $creditos->monto= $request->precio;
          $creditos->tipo_ingreso = $request->tipo_ingreso;
          $creditos->descripcion = 'VENTA DE PUNZIONES';
          $creditos->id_punzion = $pun->id;
          $creditos->save();

    /////////////

   if($request->id_laboratorio==NULL){

      dd('con producto');


   
    if (isset($request->id_laboratorio)) {
      foreach ($request->id_laboratorio['laboratorios'] as $key => $laboratorio) {
        if (!is_null($laboratorio['laboratorio'])) {

          $lab = new Punziones();
          $lab->id_producto =  $laboratorio['laboratorio'];
          $lab->cantidad =  $request->monto_abol['laboratorios'][$key]['abono'];
          $lab->precio =$request->precio;
          $lab->origen = $request->origen;
          $lab->paciente = $request->paciente;
          $lab->tipo_ingreso = $request->tipo_ingreso;
          $lab->tipo_servicio = $request->tipo_servicio;
          $lab->usuario = Auth::user()->id;
          $lab->id_pun= $pun->id;
          $lab->save();


          $pfrom = Producto::where("id", '=', $laboratorio['laboratorio'])->get()->first();
	      $pfrom->cantidad = $pfrom->cantidad - $request->monto_abol['laboratorios'][$key]['abono'];
	      $wasSubs = $pfrom->save();



        } 
      }
    }

} else {

          $lab = new Punziones();
          $lab->id_producto = 1;
          $lab->cantidad = 0;
          $lab->precio =$request->precio;
          $lab->origen = $request->origen;
          $lab->paciente = $request->paciente;
          $lab->tipo_ingreso = $request->tipo_ingreso;
          $lab->tipo_servicio = $request->tipo_servicio;
          $lab->usuario = Auth::user()->id;
          $lab->id_pun= $pun->id;
          $lab->save();
}

    //////////

        
        
    return redirect()->route('punziones.index');

    }

      public function edit(Request $request){

        $searchRequerimiento = DB::table('requerimientos')
                    ->select('*')
                    ->where('id','=', $request->id)
                    ->first();                    
					
                    $producto = $searchRequerimiento->id_producto;
                  
        $searchProducto = DB::table('productos')
                    ->select('*')
                    ->where('id','=', $producto)
                    ->first();  

                    $cantidadactual = $searchProducto->cantidad;
                    $codigo = $searchProducto->codigo;
                    $nombre = $searchProducto->nombre;
                    $categoria = $searchProducto->categoria;
                    $medida = $searchProducto->medida;
                    $preciounidad = $searchProducto->preciounidad;
                    $precioventa = $searchProducto->precioventa;

      $p = Requerimientos::find($request->id);
      $p->estatus = 'Procesado';
      $p->cantidadd= $request->cantidadd;
      $res = $p->save();

      $p = Producto::find($producto);
      $p->cantidad= $cantidadactual - $request->cantidadd;
      $res = $p->save();

      $p = Producto::where("codigo", "=", $codigo)->where("almacen","=", 2)->get()->first();

      if($p){
        $p->cantidad = $p->cantidad + $request->cantidadd;
        $p->save();
      }else{

        $prod = new Producto();
        $prod->nombre =  $nombre;
        $prod->categoria =  $categoria;
        $prod->codigo = $codigo;
        $prod->medida =  $medida;
        $prod->preciounidad = $preciounidad;
        $prod->precioventa = $precioventa;
        $prod->cantidad = $request->cantidadd;
        $prod->almacen = 2;
        $prod->save();

      }

        Toastr::success('Procesado Exitosamente.', 'Requerimiento!', ['progressBar' => true]);

      return redirect()->action('Existencias\RequerimientosController@index2', ["edited" => $res]);
    }

    public function delete($id){


    $getPunz= Punziones::where('id_pun','=',$id)->get();

      foreach($getPunz as $value)
       {
        $productsId = $value->id_producto;
        $cantidadv = $value->cantidad;

        $p = Producto::where("id", "=", $productsId)->get()->first();
        $p->cantidad = $p->cantidad + $cantidadv;
        $p->update();
        
      } 

 
  
      $pun= Pun::find($id);
      $pun->delete();

      $punziones= Punziones::where('id_pun','=',$id);
      $punziones->delete();

      $creditos= Creditos::where('id_punzion','=',$id);
      $creditos->delete();

      Toastr::success('Eliminado Exitosamente.', 'Punzion!', ['progressBar' => true]);
      return redirect()->route('movimientos.index');




    }

     public function getExist($tipo, $sede){
      $ex = Punsion::where('id', '=', $tipo)->get()->first();
      $tipo = Punsion::where('id', '=', $tipo)->get()->first();
      if($ex){
        return response()->json(["punsion" => $ex, "exists" => true, "precio" => $tipo->precio]);
      }else{
        return response()->json(["exists" => false, "precio" => $tipo->precio]);
      }
    }


    public function ticketpunziones($id) {

    $punziones = DB::table('punziones as a')
    ->select('a.id','a.id_pun','a.id_producto','a.cantidad','a.usuario','a.origen','a.precio','a.tipo_ingreso','a.created_at','c.name','c.lastname','d.nombre','d.codigo','p.name as nomper','p.lastname as apeper','b.nombres','b.apellidos','b.dni')
    ->join('users as c','c.id','a.usuario')
    ->join('productos as d','d.id','a.id_producto')
    ->join('personals as p','a.origen','p.id')
    ->join('pacientes as b','a.paciente','b.id')
    ->where('a.id_pun','=',$id)
    ->first();

    $view = \View::make('existencias.punziones.ticket')->with('punziones', $punziones);
    $pdf = \App::make('dompdf.wrapper');
    $pdf->setPaper(array(0,0,800.00,3000.00));
    $pdf->loadHTML($view);
    
    return $pdf->stream('ticket_ver');

    }

       
}
