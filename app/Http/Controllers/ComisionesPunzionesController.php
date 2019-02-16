<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use App\Models\Atenciones;
use App\Models\Debitos;
use App\Models\Analisis;
use App\Models\Historiales;
use App\Models\ComisionPunzion;
use App\Models\Punziones;
use Auth;
use Toastr;

class ComisionesPunzionesController extends Controller

{

	public function index(){

    $punziones = DB::table('comision_punzions as a')
    ->select('a.id','a.paciente','a.monto','a.comision','a.created_at','a.estatus','a.origen','a.usuario','c.name as username','c.lastname as userlast','d.name','d.lastname','d.dni','b.nombres as nompac','b.apellidos as apepac')
    ->join('pacientes as b','b.id','a.paciente')
    ->join('users as c','c.id','a.usuario')
    ->join('personals as d','d.id','a.origen')
    ->where('a.estatus','=',0)
    ->orderby('a.id','desc')
    ->get();

    $total = ComisionPunzion::whereDate('created_at', '=',Carbon::today()->toDateString())
                      ->where('estatus','=',0)
                      ->select(DB::raw('SUM(monto) as monto'))
                      ->first();

    return view('movimientos.compunziones.index', ['punziones' => $punziones,'total' => $total]);
  }

    

	public function pagarcom($id, Request $request) {

          $last = ComisionPunzion::select('recibo')->orderby('recibo', 'DESC')->first();
          if (!empty($last->recibo)) {
            $last = explode("-", $last->recibo);
            $last = array_pop($last);
          } else {
            $last = 0;
          }

          ComisionPunzion::where('id', $id)
                  ->update([
                      'estatus' => 1,
                      'recibo' => 'REC'.date('Y').'-'.str_pad($last+1, 4, "0", STR_PAD_LEFT)
                  ]);
				  
		  
     
    Toastr::success('La comisión ha sido pagada.', 'Comisiones!', ['progressBar' => true]);
    return redirect()->route('compunziones.index');

  }

 




  public function pagarmultiple(Request $request)
  {
    if(isset($request->com)){
      $last = ComisionPunzion::select('recibo')->orderby('recibo', 'DESC')->first();
      if (!empty($last->recibo)) {
        $last = explode("-", $last->recibo);
        $last = array_pop($last);
      } else {
        $last = 0;
      }

      $recibo = 'REC'.date('Y').'-'.str_pad($last+1, 4, "0", STR_PAD_LEFT);
      
      foreach ($request->com as $comision) {
        ComisionPunzion::where('id', $comision)
                  ->update([
                      'estatus' => 1,
                      'recibo' => $recibo
                  ]);
      }

      Toastr::success('Las comisiones han sido pagadas.', 'Comisiones!', ['progressBar' => true]);
    } 

    return redirect()->route('compunziones.index');
  }
       
   
}
