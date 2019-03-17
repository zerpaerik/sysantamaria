<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Debitos;
use App\Models\Historiales;
use DB;
use Carbon\Carbon;
use Auth;


class GastosController extends Controller
{

	public function index(Request $request){


     if(! is_null($request->fecha)) {

      $gastos = DB::table('debitos as a')
      ->select('a.id','a.descripcion','a.monto','a.created_at','a.id_sede','a.usuario','u.name','u.lastname')
      ->join('users as u','u.id','a.usuario')
      ->whereDate('a.created_at','=' ,$request->fecha)
      ->orderby('a.id','ASC')
      ->paginate(200000);  

    } else {

       $gastos = DB::table('debitos as a')
      ->select('a.id','a.descripcion','a.monto','a.created_at','a.id_sede','a.usuario','u.name','u.lastname')
            ->join('users as u','u.id','a.usuario')
      ->whereDate('a.created_at','=' ,Carbon::today()->toDateString())

      ->orderby('a.id','ASC')
      ->paginate(200000);  


    }  

   

        return view('movimientos.gastos.index', ['gastos' => $gastos]);  
	}



  

	public function create(Request $request){
        $validator = \Validator::make($request->all(), [
          'descripcion' => 'required|string|max:255'
      
        ]);
        if($validator->fails()) 
          return redirect()->action('GastosController@createView', ['errors' => $validator->errors()]);
		$gastos = Debitos::create([
	      'descripcion' => $request->descripcion,
	      'monto' => $request->monto,
	      'origen' => 'RELACION DE GASTOS',
	      'id_sede' => $request->session()->get('sede'),
        'usuario' => Auth::user()->id

   		]);
		
		  $historial = new Historiales();
          $historial->accion ='Registro';
          $historial->origen ='Gasto';
		  $historial->detalle = $request->descripcion;
          $historial->id_usuario = \Auth::user()->id;
          $historial->save();
		  
		    return redirect()->route('movimientos.index');

	}    

  public function delete($id){
    $gastos = Debitos::find($id);
    $gastos->delete();
    return redirect()->action('GastosController@index', ["deleted" => true, "gastos" => Debitos::all()]);
  }

  public function createView() {

    $gastos = Debitos::all();

    return view('movimientos.gastos.create', compact('gastos'));
  }

    public function editView($id){
      $p = Debitos::find($id);
      return view('movimientos.gastos.edit', ["descripcion" => $p->descripcion, "monto" => $p->monto,"id" => $p->id]);
    }

      public function edit(Request $request){
      $p = Debitos::find($request->id);
      $p->descripcion = $request->descripcion;
      $p->monto = $request->monto;
      $res = $p->save();
      return redirect()->action('GastosController@index', ["edited" => $res]);
    }


}
