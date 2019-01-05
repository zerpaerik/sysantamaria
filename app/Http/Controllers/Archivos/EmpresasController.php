<?php

namespace App\Http\Controllers\Archivos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Empresas;
use App\Models\Laboratorios;
use App\Models\Historiales;
use DB;
use Toastr;
use Auth;

class EmpresasController extends Controller
{

	public function index(){


	$empresas = DB::table('empresas as a')
        ->select('a.id','a.nombre','a.rif','a.direccion','a.personacontacto','a.telefono','a.estatus','a.user','b.name','b.lastname')
        ->join('users as b','b.id','a.user')
        ->orderby('a.id','desc')
        ->where('a.estatus','=', 1)
        ->paginate(5000);     
        return view('generics.index', [
        "icon" => "fa-list-alt",
        "model" => "empresas",
        "headers" => ["Nombre", "Rif", "Direcciòn", "Persona Contacto", "Telefono Contacto","Registrado Por:", "Editar", "Eliminar"],
        "data" => $empresas,
        "fields" => [ "nombre", "rif", "direccion", "personacontacto", "telefono","name"],
          "actions" => [
            '<button type="button" class="btn btn-info">Transferir</button>',
            '<button type="button" class="btn btn-warning">Editar</button>'
          ]
      ]);  
	}



	public function create(Request $request){
        $validator = \Validator::make($request->all(), [
          
        ]);
        if($validator->fails()) 
          return redirect()->action('Archivos\EmpresasController@createView', ['errors' => $validator->errors()]);
		$empresas = Empresas::create([
	      'nombre' => $request->nombre,
	      'rif' => $request->rif,
	      'direccion' => $request->direccion,
	      'personacontacto' => $request->personacontacto,
          'telefono' => $request->telefono,
          'estatus' => 1,
		  'user' => \Auth::user()->id

	    
   		]);
           
          $historial = new Historiales();
          $historial->accion ='Registro';
          $historial->origen ='Empresas';
		  $historial->detalle =$request->nombre;
          $historial->id_usuario = \Auth::user()->id;
          $historial->save();		   
		
            Toastr::success('Registrado Exitosamente.', 'Empresa!', ['progressBar' => true]);

		return redirect()->action('Archivos\EmpresasController@index', ["created" => true, "empresas" => Empresas::all()]);
	}    

  public function delete($id){
    $empresas = Empresas::find($id);
    $empresas->estatus = 0;
    $empresas->save();
    return redirect()->action('Archivos\EmpresasController@index', ["deleted" => true, "analisis" => Analisis::all()]);
  }

  public function createView() {


    return view('archivos.empresas.create');
  }

    public function editView($id){
      $p = Empresas::find($id);
      return view('archivos.empresas.edit', ["nombre" => $p->nombre, "rif" => $p->rif,"direccion" => $p->direccion,"personacontacto" => $p->personacontacto, "telefono" => $p->telefono,"id" => $p->id]);
    }

      public function edit(Request $request){
      $p = Empresas::find($request->id);
      $p->nombre = $request->nombre;
      $p->rif = $request->rif;
      $p->direccion = $request->direccion;
      $p->personacontacto = $request->personacontacto;
      $p->telefono = $request->telefono;
      $res = $p->save();
      return redirect()->action('Archivos\EmpresasController@index', ["edited" => $res]);
    }

  public function getAnalisi($id)
  {
    return Analisis::findOrFail($id);
  }
}
