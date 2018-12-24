<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pacientes\Paciente;
use App\Models\Historiales;
use App\Prenatal;
use App\Control;
use DB;
use Toastr;

class PrenatalController extends Controller
{

	public function index(){
    
        $prenatal = $this->elasticSearch('','');
   
        return view('prenatal.index', ["prenatal" => $prenatal]);
	}

    public function search(Request $request)
    {
      $search = $request->dni;
      $split = explode(" ",$search);
    

      if (!isset($split[1])) {
       
        $split[1] = '';
        $prenatal = $this->elasticSearch($split[0],$split[1]);
      
        return view('prenatal.search', ["prenatal" => $prenatal]); 

      }else{
        $prenatal = $this->elasticSearch($split[0],$split[1]); 
      
        return view('prenatal.search', ["prenatal" => $prenatal]);   
      }    
    }

      private function elasticSearch($dni)
  { 
      $prenatal = DB::table('prenatals as a')
    	->select( 'a.id',
    		'a.paciente',
    		'a.chc',
			'a.elect',
			'a.ej',
			'a.cf',
			'a.laser',
			'a.masaje',
			'a.us',
			'a.mag',
			'a.otros',
			'a.desf',
			'a.man',
			'a.fav',
			'a.created_at',
			 'p.nombres',
			 'p.apellidos',
			 'p.dni',
			 'p.id as idPaciente')
    	->join('pacientes as p','p.id','a.paciente')
        ->where('p.dni','like','%'.$dni.'%')
        ->paginate(20);
        return $prenatal;
  }

    public function createView()
    {
    	$paciente = Paciente::all();

    	return view('prenatal.create',[
    		 'pacientes' => $paciente
    	]); 
    }
	
      public function show($id)
    {
        $data = Prenatal::where('paciente', $id)->first();
        $paciente = Paciente::where('id',$data->id)->first();
        return view('prenatal.show',[
        	'data' => $data,
        	'paciente' => $paciente
        ]);
    }

    public function create(Request $request)
    {
    		Prenatal::create([
		    	'paciente' =>$request->paciente,
				'chc' =>$request->chc,
				'elect' =>$request->elect,
				'ej' =>$request->ej,
				'cf' =>$request->cf,
				'laser' =>$request->laser,
				'masaje' =>$request->masaje,
				'us' =>$request->us,
				'mag' =>$request->mag,
				'otros' =>$request->otros,
				'desf' =>$request->desf,
				'man' =>$request->man,
				'fav' =>$request->fav,
				
			]);
			
			 $historial = new Historiales();
          $historial->accion ='Registro';
          $historial->origen ='Evaluaciones';
		  $historial->detalle ='Registro de Evaluación a Paciente';
          $historial->id_usuario = \Auth::user()->id;
          $historial->save();

		Toastr::success('Registrado Exitosamente.', 'Evaluación!', ['progressBar' => true]);

		return redirect()->action('PrenatalController@index', ["created" => true, "prenatal" => Prenatal::all()]);
		
    }

    public function verControl($id)
    {

    	$paciente = Paciente::where('id',$id)->first();
    	$prenatal = Prenatal::where('paciente',$id)->get();
    	$view = \View::make('prenatal.reporte')->with('paciente', $paciente)->with('prenatal', $prenatal);
        $pdf = \App::make('dompdf.wrapper');
		$pdf->setPaper(array(0,0,867.00,480.00));
        $pdf->loadHTML($view);
        return $pdf->stream('resultados_ver');
    }

  
}
