<!DOCTYPE html>
<html lang="en">
<head>
	<title>Ficha Evaluación</title>

</head>
	<body>

	<img src="/var/www/html/sysantamaria/public/img/logo2.png"  style="width: 20%;"/>
	<br>
	<CENTER><p><strong>FICHA DE EVALUACIÓN TERAPEUTICA</strong></p></CENTER>
	<div style="width: 100%;">
        <fieldset style="border: 1px solid #000; border-radius: 5px;">
            <legend style="border-radius: 5px;"><strong>DATOS DEL PACIENTE</strong></legend>
            <p style="margin-bottom: 8px;"><strong>Nombre: </strong>{{$paciente->nombres}}, {{$paciente->apellidos}}</p>
            <p style="margin-left:380px;margin-top: -30px;"><strong>DNI: </strong>{{$paciente->dni}}</p>
            <p style="margin-bottom: 8px;"><strong>Edad: </strong>{{$edad}}</p>
            <p style="margin-left:380px;margin-top: -30px;"><strong>Sexo: </strong>{{$paciente->sexo}}</p>

        </fieldset> 
     </div>
	<p style="text-align: center;"><strong>EVALUACIÓN</strong></p>

	<p style="text-align: left;"><strong>FECHA: </strong>{{$ficha->created_at}}</p>

	<p style="text-align: left;"><strong>EVA: </strong>{{$ficha->eva_eval}}</p>

	<p style="text-align: left; margin-top: -35px; margin-left: 80px;"><strong>FRECUENCIA: </strong>{{$ficha->frecuencia_eval}}</p>

	<p style="text-align: left;"><strong>EXACERVACIÓN: </strong>{{$ficha->exac_eval}}</p>

	<p style="text-align: left;"><strong>ACTIVIDAD: </strong>{{$ficha->actividad_exar}}</p>

	<p style="text-align: left;"><strong>FORMA DE INICIO: </strong>{{$ficha->inicio_eval}}</p>

	<p style="text-align: left; margin-top: -35px; margin-left: 440px;"><strong>TIEMPO: </strong>{{$ficha->inicio_tiempo_eval}}</p>

	<p style="text-align: left;"><strong>TIPO DE DOLOR: </strong>{{$ficha->dolor_eval}}</p>

	<p style="text-align: left;"><strong>RETRACTACION: </strong>{{$ficha->retraccion_eval}}</p>

	<p style="text-align: left;"><strong>DOLOR NEUROLÓGICO: </strong>{{$ficha->dolor_neuro}}</p>

	<p style="text-align: left;"><strong>LIMITACIÓN: </strong>{{$ficha->limitacion_eval}}</p>

	<p style="text-align: left;"><strong>LOCALIZACIÓN: </strong>{{$ficha->localizacion_eval}}</p>


	<p style="text-align: left;"><strong>IRRADIACIÓN: </strong>{{$ficha->irradiacion_eval}}</p>

	<p style="text-align: left; margin-top: -35px; margin-left: 160px;"><strong>ZONA: </strong>{{$ficha->irradiacion_zona_eval}}</p>

	<p style="text-align: left;"><strong>OBSERVACIONES: </strong>{{$ficha->observaciones_eval}}</p>

	<p style="text-align: left;"><strong>DIAGNÓSTICO: </strong>{{$ficha->diagnostico_eval}}</p>

	<p style="text-align: left; margin-top: -35px; margin-left: 430px;"><strong>CIE-X: </strong>{{$ficha->diagnostico_cie_eval}}</p> 

	<br>
	 <p style="text-align: center;"><strong>TRATAMIENTO</strong></p> 

	<p style="text-align: left;"><strong>COMPRESA: </strong>{{$ficha->trata_compresas}}</p>

	<p style="text-align: left; margin-top: -35px; margin-left: 200px;"><strong>TIEMPO COMPRESA: </strong>{{$ficha->tiempocompresa}}</p>

	<p style="text-align: left;"><strong>ULTRASONIDO: FRECUENCIA: </strong>{{$ficha->frecuencia_eval}}</p>

	<p style="text-align: left; margin-top: -35px; margin-left: 330px;"><strong>INTENSIDAD: </strong>{{$ficha->intensidad_comp}}</p>

	<p style="text-align: left; margin-top: -35px; margin-left: 490px;"><strong>CICLO: </strong>{{$ficha->ciclo_eval}}</p>

	<p style="text-align: left; margin-top: -35px; margin-left: 595px;"><strong>TIEMPO: </strong>{{$ficha->tiempociclo}}</p>

	<p style="text-align: left;"><strong>MAGNETO: </strong>{{$ficha->magneto}}</p>

	<p style="text-align: left;"><strong>LASER: </strong>{{$ficha->dolor_laser_trat}}</p>

	<p style="text-align: left; margin-top: -35px; margin-left: 295px;"><strong>TIPO:</strong>{{$ficha->tipo_dolor}}</p>

	<p style="text-align: left;"><strong>CORRIENTE: </strong>{{$ficha->rusa_corriente_trat}}</p> 
	<p style="text-align: left;"><strong>ESTIRAMIENTO: </strong>{{$ficha->estiramiento_trat}}</p> 
	<p style="text-align: left;"><strong>MÉTODO TERAPEUTICO: </strong>{{$ficha->metodo}}</p> 
	<p style="text-align: left;"><strong>FORTALECIMIENTO: </strong>{{$ficha->fortale}}</p> 
	<p style="text-align: left;"><strong>REEDUCACIÓN DE LA MARCHA: </strong>{{$ficha->reduccion}}</p>
	<p style="text-align: left;"><strong>EJERCICIOS DE PROPIECPCIÓN: </strong>{{$ficha->ejercicios}}</p> 
		
	</body>
</html>