<!DOCTYPE html>
<html lang="en">
<head>
	<title>Ficha Evaluación</title>

</head>
	<body>

	 	<img src="/var/www/html/sysantamaria/public/img/logo2.png"  style="width: 20%;"/>
			<br><br>
		<CENTER><p><strong>FICHA DE EVALUACIÒN TERAPEUTICA</strong></p></CENTER>
@foreach($ficha as $f)

	<div style="width: 100%;">
		<fieldset style="border: 1px solid #000; border-radius: 5px;">
			<legend style="border-radius: 5px;"><strong>EVALUACIÓN</strong></legend>

				<p style="text-align: left;"><strong>FECHA: </strong>{{$f->created_at}}</p>

				<p style="text-align: left;"><strong>EVA: </strong>{{$f->eva_eval}}</p>

				<p style="text-align: left; margin-top: -35px; margin-left: 80px;"><strong>FRECUENCIA: </strong>{{$f->frecuencia_eval}}</p>

				<p style="text-align: left; margin-top: -35px; margin-left: 255px;"><strong>EXACERVACIÓN: </strong>{{$f->exac_eval}}</p>

				<p style="text-align: left;"><strong>ACTIVIDAD: </strong>{{$f->actividad_exar}}</p>

				<p style="text-align: left; margin-top: -35px; margin-left: 190px;"><strong>FORMA DE INICIO: </strong>{{$f->inicio_eval}}</p>

				<p style="text-align: left; margin-top: -35px; margin-left: 440px;"><strong>TIEMPO: </strong>{{$f->inicio_tiempo_eval}}</p>

				<p style="text-align: left;"><strong>DOLOR: </strong>{{$f->dolor_eval}}</p>

				<p style="text-align: left; margin-top: -35px; margin-left: 320px;"><strong>RETRACTACION: </strong>{{$f->retraccion_eval}}</p>

				<p style="text-align: left;"><strong>DOLOR NEUROLÓGICO: </strong>{{$f->dolor_neuro}}</p>

				<p style="text-align: left;"><strong>LIMITACIÓN: </strong>{{$f->limitacion_eval}}</p>

				<p style="text-align: left;"><strong>LOCALIZACIÓN: </strong>{{$f->localizacion_eval}}</p>


				<p style="text-align: left;"><strong>IRRADIACIÓN: </strong>{{$f->irradiacion_eval}}</p>

				<p style="text-align: left; margin-top: -35px; margin-left: 160px;"><strong>ZONA: </strong>{{$f->irradiacion_zona_eval}}</p>

				<p style="text-align: left;"><strong>OBSERVACIONES: </strong>{{$f->observaciones_eval}}</p>

				<p style="text-align: left;"><strong>DIAGNÓSTICO: </strong>{{$f->diagnostico_eval}}</p>

				<p style="text-align: left; margin-top: -35px; margin-left: 430px;"><strong>CIE-X: </strong>{{$f->diagnostico_cie_eval}}</p> 

				<br>
				 <p style="text-align: center;"><strong>TRATAMIENTO</strong></p> 

				<p style="text-align: left;"><strong>COMPRESA: </strong>{{$f->trata_compresas}}</p>

				<p style="text-align: left; margin-top: -35px; margin-left: 200px;"><strong>TIEMPO COMPRESA: </strong>{{$f->tiempocompresa}}</p>

				<p style="text-align: left; margin-top: -35px; margin-left: 410px;"><strong>LASER: </strong>{{$f->dolor_laser_trat}}</p>

				<p style="text-align: left; margin-top: -35px; margin-left: 600px;"><strong>TIPO:</strong>{{$f->tipo_dolor}}</p>

				<br>
				<p style="text-align: center;"><strong>ULTRASONIDO</strong></p>

				<p style="text-align: left;"><strong>FRECUENCIA: </strong>{{$f->frecuencia_eval}}</p>

				<p style="text-align: left; margin-top: -35px; margin-left: 230px;"><strong>INTENSIDAD: </strong>2.0{{$f->intensidad_comp}}</p>

				<p style="text-align: left; margin-top: -35px; margin-left: 430px;"><strong>CICLO: </strong>{{$f->ciclo_eval}}</p>

				<p style="text-align: left; margin-top: -35px; margin-left: 580px;"><strong>TIEMPO: </strong>{{$f->tiempociclo}}</p>

				<p style="text-align: left;"><strong>MAGNETO: </strong>{{$f->magneto}}</p>

				<p style="text-align: left;"><strong>CORRIENTE: </strong>{{$f->rusa_corriente_trat}}</p> 
				<p style="text-align: left; margin-top: -35px; margin-left: 430px;"><strong>ESTIRAMIENTO: </strong>{{$f->estiramiento_trat}}</p> 
				<p style="text-align: left;"><strong>MÉTODO TERAPEUTICO: </strong>{{$f->metodo}}</p> 
				<p style="text-align: left;"><strong>FORTALECIMIENTO: </strong>{{$f->fortale}}</p> 
				<p style="text-align: left;"><strong>REEDUCACIÓN DE LA MARCHA: </strong>{{$f->reduccion}}</p>
				<p style="text-align: left;"><strong>EJERCICIOS DE PROPIECPCIÓN: </strong>{{$f->ejercicios}}</p> 
				@endforeach
		</fieldset> 
 	</div>
	</body>
</html>