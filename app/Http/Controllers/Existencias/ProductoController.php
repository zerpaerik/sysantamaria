<?php

namespace App\Http\Controllers\Existencias;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Existencias\{Producto, Existencia, Transferencia};
use App\Models\Config\{Medida, Categoria, Sede, Proveedor};
use App\Models\{Creditos, Ventas};
use DB;
use Toastr;
use Auth;
use Carbon\Carbon;




class ProductoController extends Controller
{


      public function index(){
    //  $producto = Producto::all();
      $producto =Producto::where("almacen",'=', 1)->get();
      return view('existencias.central',compact('producto'));    
    }


      public function index2(){
    //  $producto = Producto::all();
      $producto =Producto::where("almacen",'=', 2)->get();
      return view('generics.index5', [
        "icon" => "fa-list-alt",
        "model" => "existencias",
        "model1" => "Productos en Almacen Local",
        "headers" => ["id", "Nombre","Còdigo", "Medida", "Categoria","Cantidad","Precio Unidad","Precio Venta", "Editar", "Eliminar"],
        "data" => $producto,
        "fields" => ["id", "nombre","codigo", "medida", "categoria","cantidad","preciounidad","precioventa"],
          "actions" => [
            '<button type="button" class="btn btn-info">Transferir</button>',
            '<button type="button" class="btn btn-warning">Editar</button>'
          ]
      ]);     
    }

  

    public function createView($extraArgs = []){
    	return view('existencias.create', ["categorias" => Categoria::all(), "medidas" => Medida::all()] + $extraArgs);
    }

    public function editView($id){
      $p = Producto::find($id);
      return view('existencias.edit', ["medidas" => Medida::all(), "categorias" => Categoria::all(), "nombre" => $p->nombre, "cantidad" => $p->cantidad,"codigo" => $p->codigo, "id" => $p->id, 'preciounidad' => $p->preciounidad, 'precioventa' => $p->precioventa]);
      
    }

   /* public function productInView(){
      return view('existencias.entrada', [
        "productos" => Producto::where('sede_id', '=', 1)->get(['id', 'nombre']),
        "sedes" => Sede::all(),
        "proveedores" => Proveedor::all()
      ]);
    }*/

     public function productInView(){
      $sedes = Sede::where("id",'=',1)->get(["id", "name"]);
      return view('existencias.entrada', ["productos" => Producto::
where("almacen",'=', 1)->get(['id', 'nombre','codigo']),"sedes" => $sedes,"proveedores" => Proveedor::all()]);    
    }

    public function productOutView(){
      return view('existencias.salida', [
        "productos" => Producto::where("almacen",'=', 2)->orderby('nombre','asc')->get(['id', 'nombre','codigo']),
        "sedes" => Sede::all(),
        "proveedores" => Proveedor::all()
      ]);    
    }

    public function productTransView(){
      $sedes = Sede::whereNotIn("id", [\Session::get('sede')])->get(["id", "name"]);
      return view('existencias.transferir', ["productos" => Producto::where("almacen",'=', 1)->get(['id', 'nombre']), "sedes" => $sedes]);    
    }

    public function getProduct($id){
      $p = Producto::find($id);
      return response()->json(["producto" => $p], 200);
    }

      public function addCant(Request $request){
		  
		 
	
       $searchProduct = DB::table('productos')
                    ->select('*')
					->where('almacen','=','2')
                    ->where('id','=', $request->producto)
					->where('almacen','=','2')
                    ->first(); 
					

                    $nombre = $searchProduct->nombre;
					$cantidadactual = $searchProduct->cantidad;
					
		
		if( $request->cantidadplus > $cantidadactual){
		 Toastr::error('Cantidad excede Maximo en stock', 'Error!', ['progressBar' => true]);
		 return redirect()->action('Existencias\ProductoController@index2', ["created" => true]);
		} else {
			
		  Producto::where('id', $request->producto)
                  ->update([
                      'cantidad' => $cantidadactual - $request->cantidadplus,
                  ]);
				  
		      $creditos = new Creditos();
              $creditos->origen = 'VENTA DE PRODUCTOS';
              $creditos->id_atencion = NULL;
              $creditos->monto= $request->monto;
              $creditos->tipo_ingreso = $request->tipopago;
              $creditos->descripcion = 'VENTA DE PRODUCTOS';
              $creditos->save();
			  
			  $ventas = new Ventas();
              $ventas->id_producto = $request->producto;
              $ventas->monto = $request->monto;
              $ventas->cantidad= $request->cantidadplus;
              $ventas->id_usuario = Auth::user()->id;
              $ventas->save();
			  
       Toastr::success('Registrada Exitosamente', 'Venta!', ['progressBar' => true]);
    return redirect()->route('movimientos.index');
		}
    
    }

    public function transfer(Request $request){
      $pfrom = Producto::where("id", '=', $request->producto)->get()->first();
      $pfrom->cantidad = $pfrom->cantidad - $request->cantidadplus;
      $wasSubs = $pfrom->save();
	  
	  $arr = [
          ['codigo', $pfrom->codigo],
          ['almacen', 2]
      ];

       $p = Producto::where($arr)->first();
	   
   
        if($p){
          $p->cantidad = $p->cantidad + $request->cantidadplus;
          $res = $p->save();
          Toastr::success('La Transferencia se Registro Exitosamente.', 'Producto!', ['progressBar' => true]);
          return redirect()->action('Existencias\ProductoController@index2', ["created" => false]);
        }else{
          $newprod = Producto::create([
            "nombre" => $pfrom->nombre,
            "categoria" => $pfrom->getOriginal("categoria"),
            "medida" => $pfrom->getOriginal("medida"),
			"preciounidad" => $pfrom->getOriginal("preciounidad"),
			"precioventa" => $pfrom->getOriginal("precioventa"),
			"codigo" => $pfrom->getOriginal("codigo"),
            "cantidad" => $request->cantidadplus,
            "almacen" => 2
          ]);
          Toastr::success('La Transferencia se Registro Exitosamente.', 'Producto!', ['progressBar' => true]);
          return redirect()->action('Existencias\ProductoController@index2', ["created" => false]);
        }

    }

    public function edit(Request $request){
      $p = Producto::find($request->id);
      $p->nombre = $request->nombre;
      $p->categoria = $request->categoria;
      $p->medida = $request->medida;
      $p->cantidad = $request->cantidad;
      $p->codigo = $request->codigo;
      $p->preciounidad = $request->unidad;
      $p->precioventa = $request->venta;
      $res = $p->save();
      return redirect()->action('Existencias\ProductoController@index', ["edited" => $res]);
    }
	
	 public function entrada(Request $request){
    
          $p = Producto::find($request->producto);
          $p->cantidad = $p->cantidad + $request->cantidadplus;
          $res = $p->save();
          Toastr::success('La Entrada se Registro Exitosamente.', 'Producto!', ['progressBar' => true]);
          return redirect()->action('Existencias\ProductoController@index', ["created" => false]);
  
    }


    public function delete($id){
      $p = Producto::find($id);
      $p = $p->delete();
      
       Toastr::success('Eliminado Exitosamente.', 'Producto!', ['progressBar' => true]);
        return redirect()->action('Existencias\ProductoController@index2', ["created" => false]);
    }

    public function getExist($prod, $sede){
      $ex = Producto::where('id', '=', $prod)->where("sede_id", "=", $sede)->where("almacen",'=', 1)
      ->get(["cantidad"])->first();
      $prod = Producto::where('id', '=', $prod)->get()->first();
      if($ex){
        return response()->json(["existencia" => $ex, "exists" => true, "medida" => $prod->medida]);
      }else{
        return response()->json(["exists" => false, "medida" => $prod->medida]);
      }
    }


    public function codigoProduct(Request $request){

        $searchpacienteDNI = DB::table('productos')
                    ->select('*')
                   // ->where('estatus','=','1')
                    ->where('codigo','=', $request->codigo)
                    ->where('sede_id','=',$request->session()->get('sede'))
                    ->get();

           if (count($searchpacienteDNI) > 0){

              return true;
           } else {

              return false;
           }

    }

    public function create(Request $request){
      $validator = \Validator::make($request->all(), [
        'nombre' => 'required|string|max:255',
        'codigo' => 'required|unique:productos'
      ]);

      if($validator->fails()) $this->createView(["created" => false]);

      If (ProductoController::codigoProduct($request)){ 

        Toastr::error('El Còdigo de Producto ya esta en Uso.', 'Producto!', ['progressBar' => true]);
        return redirect()->action('Existencias\ProductoController@createView', ["created" => false]);

      } else {

       $producto = Producto::create([
        "nombre" => $request->nombre,
        "codigo" => $request->codigo,
        "categoria" => $request->categoria,
        "medida" => $request->medida,
        "preciounidad" => $request->preciounidad,
        "precioventa" => $request->precioventa,
        "sede_id" => $request->session()->get('sede'),
        "almacen" => 1
      ]);
       Toastr::success('Registrado Exitosamente.', 'Producto!', ['progressBar' => true]);
       return redirect()->action('Existencias\ProductoController@index', ["created" => true]);
       
     }


   }
   
		

    public function historicoView(){
      return view('existencias.historico', ["transferencias" => $this->unique_multidim_array(Transferencia::all(), "code")]);
    }

    public function transView($code){
      $t = Transferencia::where('code', '=', $code)->get();
      return view('existencias.transferencia', ["transferencias" => $t, "code" => $code]);
    }

    function unique_multidim_array($array, $key) { 
        $temp_array = array(); 
        $i = 0; 
        $key_array = array(); 
        
        foreach($array as $val) { 
            if (!in_array($val[$key], $key_array)) { 
                $key_array[$i] = $val[$key]; 
                $temp_array[$i] = $val; 
            } 
            $i++; 
        } 
        return $temp_array; 
    }  

    public function indexv(Request $request){

       if(! is_null($request->fecha)) {

    $f1 = $request->fecha;
    $f2 = $request->fecha2;    


          $atenciones = DB::table('ventas as a')
            ->select('a.id','a.id_producto','a.created_at','a.monto','a.id_usuario','a.cantidad','e.name','e.lastname','b.nombre','b.codigo')
            ->join('users as e','e.id','a.id_usuario')
            ->join('productos as b','b.id','a.id_producto')
            ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])
            ->orderby('a.id','desc')
            ->get();

           $aten = Ventas::whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59',                        strtotime($f2))])
                                    ->select(DB::raw('SUM(monto) as monto'))
                                    ->first();

            if ($aten->monto == 0) {
        }
          
           $cantidad = Ventas::whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59',                        strtotime($f2))])
                        ->select(DB::raw('COUNT(*) as cantidad'))
                       ->first();

        if ($cantidad->cantidad == 0) {
        }


        


        } else {


           $atenciones = DB::table('ventas as a')
            ->select('a.id','a.id_producto','a.created_at','a.monto','a.id_usuario','a.cantidad','e.name','e.lastname','b.nombre','b.codigo')
            ->join('users as e','e.id','a.id_usuario')
            ->join('productos as b','b.id','a.id_producto')
            ->whereDate('a.created_at', '=',Carbon::today()->toDateString())
            ->orderby('a.id','desc')
            ->get();
           

        $aten = Ventas::whereDate('created_at', '=',Carbon::today()->toDateString())
                                    ->select(DB::raw('SUM(monto) as monto'))
                                    ->first();
        if ($aten->monto == 0) {
        }

            $cantidad = Ventas::whereDate('created_at', '=',Carbon::today()->toDateString())
                        ->select(DB::raw('COUNT(*) as cantidad'))
                       ->first();

        if ($cantidad->cantidad == 0) {
        }





        }


        return view('existencias.ventas.index', ["atenciones" => $atenciones, "aten" => $aten,"cantidad" => $cantidad]);
	}

   
	
    	
}
