<!DOCTYPE html>
<html lang="en">
<head>
	<title>Ficha Evaluaciòn</title>

</head>
<body>

	 <img src="/var/www/html/sysantamaria/public/img/logo2.png"  style="width: 20%;"/>
	<br><br>
	<CENTER><p><strong>FICHA DE EVALUACIÒN TERAPEUTICA</strong></p></CENTER>
	@foreach($ficha as $f)
  <p style="text-align: center;"><strong>EVALUACIÒN:</strong></p> 
 <p style="text-align: left;"><strong>FECHA:</strong>{{$f->created_at}}</p> 
 <p style="text-align: left;"><strong>EVA:</strong>{{$f->eva_eval}}</p> 
 <p style="text-align: right; margin-top: -30px; margin-right: 400px;"><strong>FRECUENCIA:</strong>{{$f->frecuencia_eval}}</p>
 <p style="text-align: right; margin-top: -30px; margin-right: 100px;"><strong>EXACERVACION:</strong>{{$f->exac_eval}}</p>
  <p style="text-align: left;"><strong>FORMA DE INICIO:</strong>{{$f->inicio_eval}}</p> 
 <p style="text-align: right; margin-top: -30px; margin-right: 400px;"><strong>TIEMPO:</strong>{{$f->inicio_tiempo_eval}}</p>
 <p style="text-align: right; margin-top: -30px; margin-right: 100px;"><strong>TIPO DOLOR:</strong>{{$f->dolor_eval}}</p>
  <p style="text-align: left;"><strong>RETRACTACION:</strong>{{$f->retraccion_eval}}</p> 
 <p style="text-align: right; margin-top: -30px; margin-right: 400px;"><strong>PARESTESIA:</strong>{{$f->parestecia_eval}}</p>
 <p style="text-align: right; margin-top: -30px; margin-right: 100px;"><strong>HIPERALGESIA:</strong>{{$f->hiperalgesia_eval}}</p>

  <p style="text-align: left;"><strong>LIMITACIÒN:</strong>{{$f->limitacion_eval}}</p> 
 <p style="text-align: right; margin-top: -30px; margin-right: 400px;"><strong>LOCALIZACIÒN:</strong>{{$f->localizacion_eval}}</p>
 <p style="text-align: right; margin-top: -30px; margin-right: 100px;"><strong>IRRADIACIÒN:</strong>{{$f->irradiacion_eval}}</p>

 <p style="text-align: left;"><strong>OBSERVACIONES:</strong> {{$f->observaciones_eval}}</p>
 <p style="text-align: left;"><strong>DIÀGNOSTICO:</strong>{{$f->diagnostico_eval}}</p> 

 <p style="text-align: center;"><strong>TRATAMIENTO:</strong></p> 

  <p style="text-align: left;"><strong>CHC:</strong>{{$f->chc_trat}}</p> 
 <p style="text-align: right; margin-top: -30px; margin-right: 400px;"><strong>CF:</strong>{{$f->cf_trat}}</p>
 <p style="text-align: right; margin-top: -30px; margin-right: 100px;"><strong>TIEMPO:</strong>{{$f->tiempo_trat}}</p>

 <p style="text-align: left;"><strong>ULTRASONIDO:</strong></p> 
 <p style="text-align: right; margin-top: -30px; margin-right: 400px;"><strong>TIEMPO:</strong></p>
 <p style="text-align: right; margin-top: -30px; margin-right: 100px;"><strong>MAGNETO:</strong></p>

 <p style="text-align: left;"><strong>LASER:</strong></p> 
 <p style="text-align: right; margin-top: -30px; margin-right: 400px;"><strong>CORRIENTE:</strong></p>
 <p style="text-align: left;"><strong>ESTIRAMIENTO:</strong>{{$f->estiramiento_trat}}</p> 
 <p style="text-align: left;"><strong>MÈTODO TERAPEUTICO:</strong>{{$f->metodo}}</p> 
 <p style="text-align: left;"><strong>FORTALECIMIENTO:</strong>{{$f->fortale}}</p> 
 <p style="text-align: left;"><strong>REEDUCACIÒN DE LA MARCHA:</strong></p> 
 @endforeach







 



</div>

   

   


    

 
</body>
</html>