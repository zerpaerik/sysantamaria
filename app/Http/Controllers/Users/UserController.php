<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\Role;
use App\Models\Config\Sede;
use DB;
use Toastr;
use Auth;

class UserController extends Controller
{
	public function index(){
		  $users = DB::table('users as a')
      ->select('a.id','a.name','a.lastname','a.dni','a.tipo','a.email','a.role_id','b.name as rol','a.estatus')
      ->join('roles as b','b.id','a.role_id')
      ->orderby('a.id','desc')
      ->where('a.tipo','=',NULL)
      ->where('a.estatus','=',1)
      ->get();  
		return view('archivos.users.index', ["users" => $users]);
	}

    public static function updatepass(Request $request){
    

        $id= Auth::user()->id;
        $usuario = User::where('id', '=', $id)->get()[0];
        $usuario->password = \Hash::make($request->password);
        $usuario = $usuario->update();

     Toastr::success('Modificado Exitosamente.', 'Contraseña!', ['progressBar' => true]);

         return redirect()->route('users.password');

     


    }


    public function updatepasswd()
    {
        $id= Auth::user()->id;
        $usuario = User::where('id', '=', $id)->first();
        return view('archivos.users.updatepasswd', ["usuario" => $usuario]);
    }

	public function create(Request $request){
        $validator = \Validator::make($request->all(), [
          'name' => 'required|string|max:255',
          'lastname' => 'required|string|max:255',
          'email' => 'required|email|unique:users',
          'role_id' => 'required',
          'password' => 'required|string|min:6',
        ]);
        if($validator->fails()) 
          return redirect()->action('Users\UserController@createView', ['errors' => $validator->errors()]);
		$user = User::create([
      'name' => $request->name,
      'lastname' => $request->lastname,
      'email' => $request->email,
      'role_id' => $request->role_id,
      'password' => \Hash::make($request->password),
    ]);

    
		return redirect()->action('Users\UserController@index', ["created" => true, "users" => User::all()]);
	}

   public function delete($id){
    $users = User::find($id);
    $users->password='';
    $users->estatus=0;
    $users->save();
    return redirect()->action('Users\UserController@index', ["deleted" => true, "users" => User::all()]);
  }

  public function loginView(){
    return view('auth.login', ["sedes" => Sede::all()]);
  }

  public function createView() {
    return view('archivos.users.create', ["roles" => Role::all()]);
  }

}
