<?php

namespace App\Http\Controllers\Existencias;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Existencias\{Producto, Requerimientos, Transferencia};
use App\Models\Config\{Sede, Proveedor};
use App\Models\Punziones;
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
                    ->select('a.id','a.id_producto','a.cantidad','a.usuario','a.paciente','a.origen','a.precio','a.tipo_ingreso','a.created_at','c.name','c.lastname','d.nombre','d.codigo','p.name as nomper','p.lastname as apeper','b.nombres','b.apellidos')
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
                    ->select('a.id','a.id_producto','a.cantidad','a.usuario','a.origen','a.precio','a.tipo_ingreso','a.created_at','c.name','c.lastname','d.nombre','d.codigo','p.name as nomper','p.lastname as apeper','b.nombres','b.apellidos')
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

    	return view('existencias.punziones.create', ["productos" => Producto::where('almacen','=',2)->where('categoria','=',6)->get(["id", "nombre","codigo"]),"personal" => Personal::where('estatus','=',1)->get(),"pacientes" => Pacientes::where('estatus','=',1)->get()]);
    }


          public function delete($id){
      $p = Requerimientos::find($id);
      $res = $p->delete();
      
       Toastr::success('Eliminado Exitosamente.', 'Requerimiento!', ['progressBar' => true]);
        return redirect()->action('Existencias\RequerimientosController@index', ["created" => false]);
    }



    public function create(Request $request){

   
    if (isset($request->id_laboratorio)) {
      foreach ($request->id_laboratorio['laboratorios'] as $key => $laboratorio) {
        if (!is_null($laboratorio['laboratorio'])) {

          $lab = new Punziones();
          $lab->id_producto =  $laboratorio['laboratorio'];
          $lab->cantidad =  $request->monto_abol['laboratorios'][$key]['abono'];;
          $lab->precio =$request->precio;
          $lab->origen = $request->origen;
          $lab->paciente = $request->paciente;
          $lab->tipo_ingreso = $request->tipo_ingreso;
          $lab->tipo_servicio = $request->tipo_servicio;
          $lab->usuario = Auth::user()->id;
          $lab->save();

        } 
      }
    }

          if($request->tipo_servicio == 2){

          $comision = new ComisionPunzion();
          $comision->paciente = $request->paciente;
          $comision->origen =$request->origen;
          $comision->monto= 5;
          $comision->comision= 5;
          $comision->usuario = Auth::user()->id;
          $comision->save();

      } else if($request->tipo_servicio == 3){

      	 $comision = new ComisionPunzion();
          $comision->paciente = $request->paciente;
          $comision->origen =$request->origen;
          $comision->monto= 3;
          $comision->comision= 3;
          $comision->usuario = Auth::user()->id;
          $comision->save();

       } else {

       	$comision = new ComisionPunzion();
          $comision->paciente = $request->paciente;
          $comision->origen =$request->origen;
          $comision->monto= 5;
          $comision->comision= 5;
          $comision->usuario = Auth::user()->id;
          $comision->save();

      }



          $creditos = new Creditos();
          $creditos->origen = 'VENTA DE PUNZIONES';
          $creditos->id_atencion =NULL;
          $creditos->monto= $request->precio;
          $creditos->tipo_ingreso = $request->tipo_ingreso;
          $creditos->descripcion = 'VENTA DE PUNZIONES';
          $creditos->save();

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

       
}
