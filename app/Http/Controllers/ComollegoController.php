<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use App\Models\Atenciones;
use App\Models\Debitos;
use App\Models\Analisis;
use Auth;
use Toastr;

class ComollegoController extends Controller

{

		public function index(){
       
        return view('reportes.comollego.index');
	}
	
	public function search(){

        $inicio = Carbon::now()->toDateString();
        $final = Carbon::now()->addDay()->toDateString();
        $vallas = $this->elasticSearch1($inicio,$final);
	       $carteles = $this->elasticSearch2($inicio,$final);
        $pacientes = $this->elasticSearch3($inicio,$final);
        $medicos = $this->elasticSearch4($inicio,$final);
        $redes = $this->elasticSearch5($inicio,$final);
        $radio = $this->elasticSearch6($inicio,$final);
                $radioi = $this->elasticSearch7($inicio,$final);
                                $tv = $this->elasticSearch8($inicio,$final);
                                                                $motor = $this->elasticSearch9($inicio,$final);

                                $otro = $this->elasticSearch10($inicio,$final);



        return view('reportes.comollego.search', ["redes" => $redes,"vallas" => $vallas,"carteles" => $carteles,"medicos" => $medicos, "pacientes" => $pacientes,"radio" => $radio,"radioi" => $radioi,"tv" => $tv,"motor" => $motor,"otro" => $otro]);
	}
	
	private function elasticSearch1($initial, $final)
  { 
      $vallas = Atenciones::where('comollego', 'Vallas publicitarias externas')
                                    ->select(DB::raw('COUNT(*) as cantidad'))
									->whereNotIn('monto',[0,0.00])
									->whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($initial)), date('Y-m-d 23:59:59', strtotime($final))])
                                    ->whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($initial)), date('Y-m-d 23:59:59', strtotime($final))])
                                    ->first();

        return $vallas;
  }
  
  private function elasticSearch2($initial, $final)
  { 
      $carteles = Atenciones::where('comollego', 'Carteles publicitarios en el mismo local')
                                    ->select(DB::raw('COUNT(*) as cantidad'))
									->whereNotIn('monto',[0,0.00])
									->whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($initial)), date('Y-m-d 23:59:59', strtotime($final))])
                                    ->whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($initial)), date('Y-m-d 23:59:59', strtotime($final))])
                                    ->first();

        return $carteles;
  }
  
   private function elasticSearch3($initial, $final)
  { 
      $pacientes = Atenciones::where('comollego', 'Recomendación por pacientes')
                                    ->select(DB::raw('COUNT(*) as cantidad'))
									->whereNotIn('monto',[0,0.00])
									->whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($initial)), date('Y-m-d 23:59:59', strtotime($final))])
                                    ->whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($initial)), date('Y-m-d 23:59:59', strtotime($final))])
                                    ->first();

        return $pacientes;
  }
  
   private function elasticSearch4($initial, $final)
  { 
      $medicos = Atenciones::where('comollego', 'Recomendación por médicos')
                                    ->select(DB::raw('COUNT(*) as cantidad'))
									->whereNotIn('monto',[0,0.00])
									->whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($initial)), date('Y-m-d 23:59:59', strtotime($final))])
                                    ->whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($initial)), date('Y-m-d 23:59:59', strtotime($final))])
                                    ->first();

        return $medicos;
  }
	
	 private function elasticSearch5($initial, $final)
  { 
      $redes = Atenciones::where('comollego', 'Redes sociales (Facebook, Instagram, Twitter)s')
                                    ->select(DB::raw('COUNT(*) as cantidad'))
									->whereNotIn('monto',[0,0.00])
									->whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($initial)), date('Y-m-d 23:59:59', strtotime($final))])
                                    ->whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($initial)), date('Y-m-d 23:59:59', strtotime($final))])
                                    ->first();

        return $redes;
  }


     private function elasticSearch6($initial, $final)
  { 
      $radio = Atenciones::where('comollego', 'Radio (AM/FM/XM)')
                                    ->select(DB::raw('COUNT(*) as cantidad'))
                  ->whereNotIn('monto',[0,0.00])
                  ->whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($initial)), date('Y-m-d 23:59:59', strtotime($final))])
                                    ->whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($initial)), date('Y-m-d 23:59:59', strtotime($final))])
                                    ->first();

        return $radio;
  }
  

     private function elasticSearch7($initial, $final)
  { 
      $radioi = Atenciones::where('comollego', 'Radio por Internet')
                                    ->select(DB::raw('COUNT(*) as cantidad'))
                  ->whereNotIn('monto',[0,0.00])
                  ->whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($initial)), date('Y-m-d 23:59:59', strtotime($final))])
                                    ->whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($initial)), date('Y-m-d 23:59:59', strtotime($final))])
                                    ->first();

        return $radioi;
  }
  

     private function elasticSearch8($initial, $final)
  { 
      $tv = Atenciones::where('comollego', 'Televisión')
                                    ->select(DB::raw('COUNT(*) as cantidad'))
                  ->whereNotIn('monto',[0,0.00])
                  ->whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($initial)), date('Y-m-d 23:59:59', strtotime($final))])
                                    ->whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($initial)), date('Y-m-d 23:59:59', strtotime($final))])
                                    ->first();

        return $tv;
  }
  

     private function elasticSearch9($initial, $final)
  { 
      $motor = Atenciones::where('comollego', 'Motor de búsqueda (Google, Bing, Yahoo!')
                                    ->select(DB::raw('COUNT(*) as cantidad'))
                  ->whereNotIn('monto',[0,0.00])
                  ->whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($initial)), date('Y-m-d 23:59:59', strtotime($final))])
                                    ->whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($initial)), date('Y-m-d 23:59:59', strtotime($final))])
                                    ->first();

        return $motor;
  }
  

     private function elasticSearch10($initial, $final)
  { 
      $otro = Atenciones::where('comollego', 'Otros')
                                    ->select(DB::raw('COUNT(*) as cantidad'))
                  ->whereNotIn('monto',[0,0.00])
                  ->whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($initial)), date('Y-m-d 23:59:59', strtotime($final))])
                                    ->whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($initial)), date('Y-m-d 23:59:59', strtotime($final))])
                                    ->first();

        return $otro;
  }
  
	
	
	









       
   
}
