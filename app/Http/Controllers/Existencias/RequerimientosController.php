<?php

namespace App\Http\Controllers\Existencias;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Existencias\{Producto, Requerimientos, Transferencia};
use App\Models\Config\{Sede, Proveedor};
use Illuminate\Support\Facades\Auth;
use DB;
use Toastr;
use Carbon\Carbon;
use Auth;



class RequerimientosController extends Controller
{

    public function index(){

      $requerimientos = DB::table('requerimientos as a')
                    ->select('a.id','a.id_sede_solicita','a.id_sede_solicitada','a.usuario','a.id_producto','a.cantidadd','a.cantidad','a.estatus','a.created_at','c.name as solicitante','d.nombre','d.codigo')
                    ->join('users as c','c.id','a.usuario')
                    ->join('productos as d','d.id','a.id_producto')
					           ->where('id_sede_solicita','=',2)
                      ->orderby('a.created_at','desc')
                    ->get();  

			return view('existencias.requerimientos.index',compact('requerimientos'));   	
    }

     public function index2(){

       

        $requerimientos2 = DB::table('requerimientos as a')
                    ->select('a.id','a.id_sede_solicita','a.id_sede_solicitada','a.usuario','a.id_producto','a.cantidad','a.estatus','a.created_at','a.cantidadd','c.name as solicitante','d.nombre','d.codigo')
                    ->join('users as c','c.id','a.usuario')
                    ->join('productos as d','d.id','a.id_producto')
                    ->where('a.id_sede_solicita', '=', 2)
                    ->orderby('a.created_at','desc')
                    ->get();

        return view('existencias.requerimientos.index2', ["requerimientos2" => $requerimientos2]);   	
    }

     public function search(Request $request)
    {
        $requerimientos2 = $this->elasticSearch($request->inicio,$request->final);
        return view('existencias.requerimientos.index2', ["requerimientos2" => $requerimientos2]); 
    }

     private function elasticSearch($initial, $final)
  { 
         $requerimientos2 = DB::table('requerimientos as a')
                    ->select('a.id','a.id_sede_solicita','a.id_sede_solicitada','a.usuario','a.id_producto','a.cantidad','a.estatus','a.created_at','a.cantidadd','c.name as solicitante','d.nombre','d.codigo')
                    ->join('users as c','c.id','a.usuario')
                    ->join('productos as d','d.id','a.id_producto')
                    ->where('a.id_sede_solicita', '=', 2)
                     ->whereBetween('a.created_at', [date('Y-m-d', strtotime($initial)), date('Y-m-d', strtotime($final))])
                    ->orderby('a.id','desc')
                    ->get();

        return $requerimientos2;
  }





    public function createView(){
    	return view('existencias.requerimientos.create', ["productos" => Producto::where('almacen','=',1)->orderBy('nombre','asc')->get(["id", "nombre","codigo"])]);
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
          $lab = new Requerimientos();
          $lab->id_producto =  $laboratorio['laboratorio'];
          $lab->cantidad =  $request->monto_abol['laboratorios'][$key]['abono'];;
          $lab->id_sede_solicita =2;
          $lab->usuario = Auth::user()->id;
          $lab->id_sede_solicitada = 1;
          $lab->estatus = 'Solicitado';
          $lab->save();

        } 
      }
    }

    return redirect()->route('requerimientos.index');

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
