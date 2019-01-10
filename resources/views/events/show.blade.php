@extends('layouts.app')
@section('content')
	<h2>CONSULTA {{$data->title}}</h2>
	<p>Paciente: {{$data->nombres}} {{$data->apellidos}} </p>
	<p>Doctor: {{$data->nombrePro}} {{$data->apellidoPro}}</p>
	<p>Fecha de cita: {{$data->date}}</p>
	<p>Hora: {{$data->start_time}} Hasta las {{$data->end_time}}</p>
    <p>Evaluaciòn: {{$data->evaluacion}}</p>
	<br>

	<h2>DATOS DE FILIACIÒN</h2>
	<p>Nombre: {{$data->nombres}} {{$data->apellidos}} </p>
	<p>DNI paciente: {{$data->dni}}</p>
	<p>Direccion del paciente: {{$data->direccion}}</p>
	<p>Telefono del paciente: {{$data->telefono}}</p>
	<p>Fecha de nacimiento: {{$data->fechanac}}</p>
	<p>Grado de isntruccion del paciente: {{$data->gradoinstruccion}}</p>
	<p>Ocupacion del paciente: {{$data->ocupacion}}</p>	
	<p>Edad del paciente: {{$edad}} años</p>	
	<br>	
	<br>
	<h2>Resultados anteriores de {{$data->nombres}} {{$data->apellidos}}</h2>
	@foreach($consultas as $consulta)
	<div class="rows">
		<div class="col-sm-12">
			<div class="rows">
				<h3 class="col-sm-12"><strong>Consulta del {{$consulta->created_at}}</strong></h3>
				<p class="col-sm-6"><strong>Motivo de Consulta:</strong> {{ $consulta->motivo }}</p>
				<p class="col-sm-6"><strong>Causa Relacionada:</strong> {{ $consulta->causa }}</p>
				<p class="col-sm-6"><strong>Tiempo de Lesión:</strong> {{ $consulta->tiempo }}</p>
				<br>
				<p class="col-sm-6"><strong>Antecedentes.ENFERMEDADES:</strong> {{ $consulta->enf }}</p>
				<p class="col-sm-6"><strong>Antecedentes.OPERACIONES:</strong> {{ $consulta->fra }}</p>
				<p class="col-sm-6"><strong>Antecedentes.TRATAMIENTOS HABITUALES:</strong> {{ $consulta->ope }}</p>
				<p class="col-sm-6"><strong>Antecedentes.ALERGIAS:</strong> {{ $consulta->aler }}</p>
			    <p class="col-sm-6"><strong>Examen Fisico:</strong> Funciones Vitales</p>
			    <p class="col-sm-1"><strong>P/A:</strong> {{ $consulta->pa }}</p>
			    <p class="col-sm-1"><strong>FC:</strong> {{ $consulta->fc }}</p>
			    <p class="col-sm-1"><strong>FR:</strong> {{ $consulta->fr }}</p>
			    <p class="col-sm-1"><strong>SPO2:</strong> {{ $consulta->spo2 }}</p>
			    <p class="col-sm-1"><strong>Peso:</strong> {{ $consulta->peso }}</p>
			    <p class="col-sm-1"><strong>Talla:</strong>{{ $consulta->talla }}</p>
				<p class="col-sm-6"><strong>Examen General:</strong> {{ $consulta->exa }}</p>
				<p class="col-sm-6"><strong>Diag.Presuntivo:</strong> {{ $consulta->pres }}</p>
				<p class="col-sm-6"><strong>CIE-X:</strong> {{ $consulta->ciex }}</p>
				<p class="col-sm-12"><strong>Examenes Auxiliares:</strong> {{ $consulta->aux }}</p>
				<p class="col-sm-6"><strong>Diag.Definitivo:</strong> {{ $consulta->def }}</p>
			    <p class="col-sm-6"><strong>CIE-X:</strong> {{ $consulta->ciex2 }}</p>
				<p class="col-sm-6"><strong>Diag.Topogràfico:</strong> {{ $consulta->top }}</p>
				<p class="col-sm-6"><strong>Plan de Tratamiento:</strong> {{ $consulta->plan }}</p>
				<p class="col-sm-6"><strong>Nro Sesiones:</strong> {{ $consulta->ses }}</p>
				<p class="col-sm-6"><strong>Atentido Por:</strong> {{ $consulta->personal }}</p>
				@if(!empty($consulta->treatment))
				 	<p class="col-sm-6"><strong>ficha eval:</strong>{{ $consulta->treatment->ficha_eval }}</p>
            		<p class="col-sm-6"><strong>evalauacion eval:</strong>{{ $consulta->treatment->eva_eval }}</p>
            		<p class="col-sm-6"><strong>frecuencia eval:</strong>{{ $consulta->treatment->frecuencia_eval }}</p>
            		<p class="col-sm-6"><strong>exac_eval:</strong>{{ $consulta->treatment->exac_eval }}</p>
            		<p class="col-sm-6"><strong>inicio_eval:</strong>{{ $consulta->treatment->inicio_eval }}</p>
            		<p class="col-sm-6"><strong>inicio_tiempo_eval:</strong>{{ $consulta->treatment->inicio_tiempo_eval }}</p>
            		<p class="col-sm-6"><strong>dolor_eval:</strong>{{ $consulta->treatment->dolor_eval }}</p>
            		<p class="col-sm-6"><strong>retraccion_eval:</strong>{{ $consulta->treatment->retraccion_eval }}</p>
            		<p class="col-sm-6"><strong>parestecia_eval:</strong>{{ $consulta->treatment->parestecia_eval }}</p>
            		<p class="col-sm-6"><strong>hiperalgesia_eval:</strong>{{ $consulta->treatment->hiperalgesia_eval }}</p>
            		<p class="col-sm-6"><strong>hiperalgesia_zona_eval:</strong>{{ $consulta->treatment->hiperalgesia_zona_eval }}</p>
            		<p class="col-sm-6"><strong>limitacion_eval:</strong>{{ $consulta->treatment->limitacion_eval }}</p>
            		<p class="col-sm-6"><strong>localizacion_eval:</strong>{{ $consulta->treatment->localizacion_eval }}</p>
            		<p class="col-sm-6"><strong>irradiacion_eval:</strong>{{ $consulta->treatment->irradiacion_eval }}</p>
            		<p class="col-sm-6"><strong>irradiacion_zona_eval:</strong>{{ $consulta->treatment->irradiacion_zona_eval }}</p>
            		<p class="col-sm-6"><strong>observaciones_eval:</strong>{{ $consulta->treatment->observaciones_eval }}</p>
            		<p class="col-sm-6"><strong>diagnostico_eval:</strong>{{ $consulta->treatment->diagnostico_eval }}</p>
            		<p class="col-sm-6"><strong>chc_trat:</strong>{{ $consulta->treatment->chc_trat }}</p>
            		<p class="col-sm-6"><strong>cf_trat:</strong>{{ $consulta->treatment->cf_trat }}</p>
            		<p class="col-sm-6"><strong>tiempo_trat:</strong>{{ $consulta->treatment->tiempo_trat }}</p>
            		<p class="col-sm-6"><strong>frecuencia_ultrasonido_trat:</strong>{{ $consulta->treatment->frecuencia_ultrasonido_trat }}</p>
            		<p class="col-sm-6"><strong>intensidad_ultrasonido_trat:</strong>{{ $consulta->treatment->intensidad_ultrasonido_trat }}</p>
            		<p class="col-sm-6"><strong>ciclo_ultrasonido_trat:</strong>{{ $consulta->treatment->ciclo_ultrasonido_trat }}</p>
            		<p class="col-sm-6"><strong>tiempo_ultrasonido_trat:</strong>{{ $consulta->treatment->tiempo_ultrasonido_trat }}</p>
            		<p class="col-sm-6"><strong>dolor_laser_trat:</strong>{{ $consulta->treatment->dolor_laser_trat }}</p>
            		<p class="col-sm-6"><strong>tenosinovitis_laser_trat:</strong>{{ $consulta->treatment->tenosinovitis_laser_trat }}</p>
            		<p class="col-sm-6"><strong>esguince_laser_trat:</strong>{{ $consulta->treatment->esguince_laser_trat }}</p>
            		<p class="col-sm-6"><strong>tension_laser_trat:</strong>{{ $consulta->treatment->tension_laser_trat }}</p>
            		<p class="col-sm-6"><strong>rusa_corriente_trat:</strong>{{ $consulta->treatment->rusa_corriente_trat }}</p>
            		<p class="col-sm-6"><strong>interferencial_corriente_trat:</strong>{{ $consulta->treatment->interferencial_corriente_trat }}</p>
            		<p class="col-sm-6"><strong>alto_corriente_trat:</strong>{{ $consulta->treatment->alto_corriente_trat }}</p>
            		<p class="col-sm-6"><strong>tens_corriente_trat:</strong>{{ $consulta->treatment->tens_corriente_trat }}</p>
            		<p class="col-sm-6"><strong>estiramiento_trat:</strong>{{ $consulta->treatment->estiramiento_trat }}</p>
            		<p class="col-sm-6"><strong>klapp_metodo_trat:</strong>{{ $consulta->treatment->klapp_metodo_trat }}</p>
            		<p class="col-sm-6"><strong>william_metodo_trat:</strong>{{ $consulta->treatment->william_metodo_trat }}</p>
            		<p class="col-sm-6"><strong>wilson_metodo_trat:</strong>{{ $consulta->treatment->wilson_metodo_trat }}</p>
            		<p class="col-sm-6"><strong>fnp_metodo_trat:</strong>{{ $consulta->treatment->fnp_metodo_trat }}</p>
            		<p class="col-sm-6"><strong>codman_metodo_trat:</strong>{{ $consulta->treatment->codman_metodo_trat }}</p>
            		<p class="col-sm-6"><strong>burguer_metodo_trat:</strong>{{ $consulta->treatment->burguer_metodo_trat }}</p>
            		<p class="col-sm-6"><strong>kaltenbron_metodo_trat:</strong>{{ $consulta->treatment->kaltenbron_metodo_trat }}</p>
            		<p class="col-sm-6"><strong>feldenkrais_metodo_trat:</strong>{{ $consulta->treatment->feldenkrais_metodo_trat }}</p>
            		<p class="col-sm-6"><strong>isometrico_fortalecimiento_trat:</strong>{{ $consulta->treatment->isometrico_fortalecimiento_trat }}</p>
            		<p class="col-sm-6"><strong>isocarga_fortalecimiento_trat:</strong>{{ $consulta->treatment->isocarga_fortalecimiento_trat }}</p>
            		<p class="col-sm-6"><strong>nocarga_fortalecimiento_trat:</strong>{{ $consulta->treatment->nocarga_fortalecimiento_trat }}</p>
            		<p class="col-sm-6"><strong>bozu_fortalecimiento_trat:</strong>{{ $consulta->treatment->bozu_fortalecimiento_trat }}</p>
            		<p class="col-sm-6"><strong>theraband_fortalecimiento_trat:</strong>{{ $consulta->treatment->theraband_fortalecimiento_trat }}</p>
            		<p class="col-sm-6"><strong>reduccion_trat:</strong>{{ $consulta->treatment->reduccion_trat }}</p>
            		<p class="col-sm-6"><strong>rolido_marcha_trat:</strong>{{ $consulta->treatment->rolido_marcha_trat }}</p>
            		<p class="col-sm-6"><strong>sentado_marcha_trat:</strong>{{ $consulta->treatment->sentado_marcha_trat }}</p>
            		<p class="col-sm-6"><strong>arrastre_marcha_trat:</strong>{{ $consulta->treatment->arrastre_marcha_trat }}</p>
            		<p class="col-sm-6"><strong>puntos_marcha_trat:</strong>{{ $consulta->treatment->puntos_marcha_trat }}</p>
            		<p class="col-sm-6"><strong>rodillas_marcha_trat:</strong>{{ $consulta->treatment->rodillas_marcha_trat }}</p>
            		<p class="col-sm-6"><strong>bipedo_marcha_trat:</strong>{{ $consulta->treatment->bipedo_marcha_trat }}</p>
            		<p class="col-sm-6"><strong>descarga_marcha_trat:</strong>{{ $consulta->treatment->descarga_marcha_trat }}</p>
            		<p class="col-sm-6"><strong>equilibrio_marcha_trat:</strong>{{ $consulta->treatment->equilibrio_marcha_trat }}</p>
            		<p class="col-sm-6"><strong>coordinacion_marcha_trat:</strong>{{ $consulta->treatment->coordinacion_marcha_trat }}</p>
            		<p class="col-sm-6"><strong>disocion_marcha_trat:</strong>{{ $consulta->treatment->disocion_marcha_trat }}</p>
				@endif				
				<br>
			</div>
		</div>
	
	@endforeach
	<div class="col-sm-12">
	<h3>REGISTRAR NUEVA HISTORIA</h3>
	    <br>
	<form action="observacion/create" method="post" class="form-horizontal">
		{{ csrf_field() }}
		<div class="form-group">
			<input type="hidden" name="paciente_id" value="{{$data->pacienteId}}">
			<input type="hidden" name="profesional_id" value="{{$data->profesionalId}}">
           <div class="row">
            <label for="" class="col-sm-2 control-label">PARTE I - ANAMNESIS</label>
		  </div>

			<label for="" class="col-sm-2 control-label">a) Motivo de Consulta:</label>
			<div class="col-sm-10">
				<input type="text" name="motivo" class="form-control">
			</div>
			
			<label for="" class="col-sm-2 control-label">b) Causa Relacionada:</label>
			<div class="col-sm-10">	
				<input  class="form-control" type="text" name="causa">
			</div>
			
			<label for="" class="col-sm-2 control-label">c) Tiempo de Lesiòn:</label>
			<div class="col-sm-10">	
				<input   class="form-control" placeholder="" type="text" name="tiempo">
			</div>
			<br>
			<div class="row">
            <label for="" class="col-sm-2 control-label">PARTE II - ANTECEDENTES</label>
		    </div>
			
			<label for="" class="col-sm-2 control-label">a) Enfermedades:</label>
			<div class="col-sm-10">			
				<input  class="form-control" type="text" name="enf">
			</div>
			<label for="" class="col-sm-2 control-label">b) Operaciones:</label>
			<div class="col-sm-10">	
				<input   class="form-control" type="text" name="fra">
			</div>
			<label for="" class="col-sm-2 control-label">c) Trat.Habit:</label>
			<div class="col-sm-10">	
				<input   class="form-control" placeholder="Tratamientos Habituales" type="text" name="ope">
			</div>
			<label for="" class="col-sm-2 control-label">d) Alérg.Medic:</label>
			<div class="col-sm-10">	
				<input  class="form-control" placeholder="Alergias Medicamentosas" type="text" name="aler">
			</div>

			<div class="row">
            <label for="" class="col-sm-2 control-label">PARTE III - EXAMEN FISICO</label>
		    </div>
		    <div class="row">
		    <label for="" class="col-sm-2 control-label">a) Funciones Vitales</label>
		    </div>
             
             <label for="" class="col-sm-1 control-label">P/A</label>
			<div class="col-sm-1">	
				<input  class="form-control"  type="text" name="pa">
			</div>
			<label for="" class="col-sm-1 control-label">FC</label>
			<div class="col-sm-1">	
				<input  class="form-control" type="text" name="fc">
			</div>
			<label for="" class="col-sm-1 control-label">FR</label>
			<div class="col-sm-1">	
				<input  class="form-control"  type="text" name="fr">
			</div>
			<label for="" class="col-sm-1 control-label">SPO2</label>
			<div class="col-sm-1">	
				<input  class="form-control"  type="text" name="spo2">
			</div>
			<label for="" class="col-sm-1 control-label">Peso</label>
			<div class="col-sm-1">	
				<input  class="form-control" type="text" name="peso">
			</div>

			<label for="" class="col-sm-1 control-label">Talla</label>
			<div class="col-sm-1">	
				<input  class="form-control" type="text" name="talla">
			</div>
			
			<label for="" class="col-sm-2 control-label">b) Examen General</label>
			<div class="col-sm-10">	
				<textarea name="exa" cols="10" rows="10" class="form-control" ></textarea>
			</div>
			<br>
			
			<br>
            <div class="row">
			<label for="" class="col-sm-2 control-label">c) Diagnòstico Presuntivo</label>
			<div class="col-sm-4">	
				<input   class="form-control" placeholder="Diagnóstico Presuntivo" type="text" name="pres">
			</div>

			<label class="col-sm-1">CIE-X:</label>
			<div class="col-sm-4">
				<select id="el3" name="ciex">
					@foreach($ciex as $c)
					<option value="{{$c->codigo}}-{{$c->nombre}}">
						{{$c->codigo}}-{{$c->nombre}}
					</option>
					@endforeach
				</select>
			</div> 
			
			</div>
			<label for="" class="col-sm-2 control-label">d) Examenes Auxiliares</label>
			<div class="col-sm-10">	
				<textarea name="aux" cols="10" rows="10" class="form-control" ></textarea>
			</div>
			<br>
			<br>
            <div class="row">
			<label for="" class="col-sm-2 control-label">e) Diagnòstivo Definitivo</label>
			<div class="col-sm-4">	
				<input   class="form-control" placeholder="Diagnóstico Definitivo" type="text" name="def">
			</div>

			<label class="col-sm-1">CIE-X:</label>
			<div class="col-sm-4">
				<select id="el4" name="ciex2">
					@foreach($ciex as $c)
					<option value="{{$c->codigo}}-{{$c->nombre}}">
						{{$c->codigo}}-{{$c->nombre}}
					</option>
					@endforeach
				</select>
			</div> 
			
			</div>
			
			<label for="" class="col-sm-2 control-label">f) Diag.Topográfico:</label>
			<div class="col-sm-10">	
				<select id="el6" name="top">
					<option value="Cabeza">Cabeza</option>
					<option value="Cuello">Cuello</option>
					<option value="Hombro">Hombro</option>
					<option value="Codo">Codo</option>
					<option value="Muñeca">Muñeca</option>
					<option value="Mano">Mano</option>
					<option value="Espalda">Espalda</option>
					<option value="Cintura">Cintura</option>
					<option value="Cadera">Cadera</option>
					<option value="Rodilla">Rodilla</option>
					<option value="Pierna">Pierna</option>
					<option value="Tobillo">Tobillo</option>
					<option value="Pie">Pie</option>

				</select>
			</div>
			
				<label for="" class="col-sm-2 control-label">g) Plan.Tratamiento:</label>
			<div class="col-sm-10">	
				<input  class="form-control" placeholder="" type="text" name="plan">
			</div>
			<label for="" class="col-sm-2 control-label">h) Nro de Sesiones:</label>
			<div class="col-sm-10">	
				<input  class="form-control" placeholder="" type="text" name="ses">
			</div>
			
			<label class="col-sm-2">i) Atendido Por:</label>
			<div class="col-sm-10">
				<select id="el5" name="personal">
					@foreach($personal as $c)
					<option value="{{$c->name}}-{{$c->lastname}}">
						{{$c->name}}-{{$c->lastname}}
					</option>
					@endforeach
				</select>
			</div> 



			<label class="col-sm-1">Adjunto:</label>

				<div class="form-group row">
					<label for="form-1-1" class="col-md-12 control-label">
					</label>
					<div class="col-md-10">
						{{Form::file('informe', ["class"=>"form-control"])}}
					</div>
			</div>
			
            <label class="col-sm-2">Ficha de Evaluacion Terapeutica</label>
			<div class="col-sm-10">
				<input type="radio" name="ficha_eval" value="Nuevo">Nuevo
				<input type="radio" name="ficha_eval" value="Reevaluacion">Reevaluacion
				<input type="radio" name="ficha_eval" value="Reingresante">Reingresante
			</div>  
			
			<br>
			<br><br>

			<label class="col-sm-2">Eva</label>
			<div class="col-sm-10">
				<input type="radio" name="eva_eval" value="Antes">Antes
				<input type="radio" name="eva_eval" value="Despues">Despues
			</div>  

			<br>
			<br>

			<label class="col-sm-2">Frecuencia</label>
			<div class="col-sm-10">
				<input type="radio" name="frecuencia_eval" value="Continuo">Continuo
				<input type="radio" name="frecuencia_eval" value="Intermitente">Intermitente 
			</div>  
			<br><br>

			<label class="col-sm-2">Exacervacion</label>
			<div class="col-sm-10">
				<input type="radio" name="exac_eval" value="Actividad">Actividad
				<input type="radio" name="exac_eval" value="Reposo">Reposo 
				<input type="radio" name="exac_eval" value="Levantarse">Levantarse
				<input type="radio" name="exac_eval" value="Dia">Dia 
				<input type="radio" name="exac_eval" value="Noche">Noche								
			</div>  
			<br><br>

			<label class="col-sm-2">Forma de inicio</label>
			<div class="col-sm-10">
				<input type="radio" name="inicio_eval" value="Progesivo">Progesivo
				<input type="radio" name="inicio_eval" value="Subito">Subito
				<input type="text" name="inicio_tiempo_eval">Tiempo  
			</div>  
			<br><br>	

			<label class="col-sm-2">Tipo de dolor</label>
			<div class="col-sm-10">
				<input type="radio" name="dolor_eval" value="Quemante">Quemante
				<input type="radio" name="dolor_eval" value="Punzante">Punzante 
				<input type="radio" name="dolor_eval" value="Electrico">Electrico
			</div>  
			<br><br>

			<label class="col-sm-2">Retraccion</label>
			<div class="col-sm-10">
				<input type="radio" name="retraccion_eval" value="Fascia">Fascia
				<input type="radio" name="retraccion_eval" value="Muscular">Muscular
				<input type="radio" name="retraccion_eval" value="Articular">Articular
			</div>  
			<br><br>	

			<label class="col-sm-2">Parestecia</label>
			<div class="col-sm-10">
				<input type="radio" name="parestecia_eval" value="Si">Si
				<input type="radio" name="parestecia_eval" value="No">No
			</div>  
			<br><br>

			<label class="col-sm-2">Hiperalgesia</label>
			<div class="col-sm-10">
				<input type="radio" name="hiperalgesia_eval" value="Si">Si
				<input type="radio" name="hiperalgesia_eval" value="No">No
				<input type="text" name="hiperalgesia_zona_eval">Zona
			</div>  
			<br><br>		

			<label class="col-sm-2">Limitacion</label>
			<div class="col-sm-10">
				<input type="text" name="limitacion_eval">
			</div>  
			<br><br>

			<label class="col-sm-2">Localizacion</label>
			<div class="col-sm-10">
				<input type="text" name="localizacion_eval">
			</div>  
			<br><br>	


			<label class="col-sm-2">Irradiacion</label>
			<div class="col-sm-10">
				<input type="radio" name="irradiacion_eval" value="Si">Si
				<input type="radio" name="irradiacion_eval" value="No">No
				<input type="text" name="irradiacion_zona_eval">Zona
			</div>  
			<br><br>

			<label class="col-sm-2">Observaciones</label>
			<div class="col-sm-10">
				<input type="text" name="observaciones_eval">
			</div>  
			<br><br>

			<label class="col-sm-2">Diagnostico</label>
			<div class="col-sm-10">
				<input type="text" name="diagnostico_eval">
			</div>  
			<br><br>																				

			<h3 class="col-sm-12">Tratamiento</h3>

			<label class="col-sm-2">CHC</label>
			<div class="col-sm-10">
				<input type="text" name="chc_trat">
			</div>  
			<br><br><br>


			<label class="col-sm-2">CF</label>
			<div class="col-sm-10">
				<input type="text" name="cf_trat">
			</div>  
			<br><br>


			<label class="col-sm-2">Tiempo </label>
			<div class="col-sm-10">
				<input type="text" name="tiempo_trat">
			</div>  
			<br><br><br>
			
			<label class="col-sm-2">Ultrasonido</label>
			<div class="col-sm-12">
				Frecuencia<input type="text" name="frecuencia_ultrasonido_trat">
				Intensidad<input type="text" name="intensidad_ultrasonido_trat">
				Ciclo<input type="text" name="ciclo_ultrasonido_trat">
				Tiempo<input type="text" name="tiempo_ultrasonido_trat">
			</div>  
			<br><br><br>

			<label class="col-sm-1">Laser</label>
			<div class="col-sm-12">
				Dolor<input type="text" name="dolor_laser_trat">
				Tenosinovitis<input type="text" name="tenosinovitis_laser_trat">
				Esguince<input type="text" name="esguince_laser_trat">
				Tension Repetitiva<input type="text" name="tension_laser_trat">
			</div>  
			<br><br><br>

			<label class="col-sm-2">Corriente</label>
			<div class="col-sm-12">
				Rusa<input type="text" name="rusa_corriente_trat">
				interferencial<input type="text" name="interferencial_corriente_trat">
				alto vontaje<input type="text" name="alto_corriente_trat">
				Tens<input type="text" name="tens_corriente_trat">
			</div>  
			<br><br><br>

			<label class="col-sm-1">Estiramiento </label>
			<div class="col-sm-11">
				<input type="text" name="estiramiento_trat">
			</div>  
			<br><br><br>

			<label class="col-sm-2">Metodo Terapeutico</label>
			<div class="col-sm-12">
				Klapp<input type="checkbox" name="klapp_metodo_trat">
				William<input type="checkbox" name="william_metodo_trat">
				Wilson<input type="checkbox" name="wilson_metodo_trat">
				FNP<input type="checkbox" name="fnp_metodo_trat">
				Codman<input type="checkbox" name="codman_metodo_trat">
				Burguer<input type="checkbox" name="burguer_metodo_trat">
				KaltenBron<input type="checkbox" name="kaltenbron_metodo_trat">
				Feldenkrais<input type="checkbox" name="feldenkrais_metodo_trat">				
			</div>  
			<br><br><br>	

			<label class="col-sm-2">Fortalecimiento</label>
			<div class="col-sm-12">
				Isomentrico<input type="checkbox" name="isometrico_fortalecimiento_trat">
				Isotonico con carga<input type="checkbox" name="isocarga_fortalecimiento_trat">
				Sin carga<input type="checkbox" name="nocarga_fortalecimiento_trat">
				Bozu<input type="checkbox" name="bozu_fortalecimiento_trat">
				THERABAND<input type="checkbox" name="theraband_fortalecimiento_trat">			
			</div>  
			<br><br><br>	

			<label class="col-sm-5">Reduccion de la marcha</label>
			<div class="col-sm-12">
				<input type="radio" name="reduccion_trat" value="Si">Si
				<input type="radio" name="reduccion_trat" value="No">No
			</div>  
			<div class="col-sm-12">
				Rolido<input type="checkbox" name="rolido_marcha_trat"><br>
				Sentado<input type="checkbox" name="sentado_marcha_trat"><br>
				Arrastre<input type="checkbox" name="arrastre_marcha_trat"><br>
				4 Puntos<input type="checkbox" name="puntos_marcha_trat"><br>
				Rodillas<input type="checkbox" name="rodillas_marcha_trat"><br>
				Bipedo<input type="checkbox" name="bipedo_marcha_trat"><br>
				Descarga de peso<input type="checkbox" name="descarga_marcha_trat"><br>
				Equilibrio<input type="checkbox" name="equilibrio_marcha_trat"><br>		
				Coordinacion<input type="checkbox" name="coordinacion_marcha_trat"><br>
				Disocion<input type="checkbox" name="disocion_marcha_trat"><br>								
			</div>  			
			<br><br>																
	
            <div id="laboratorios" class="embed ">
            
                <!-- Form template-->
                <div id="laboratorios_template" class="template row">


                    </div>

                    <a id="laboratorios_remove_current" style="cursor: pointer;"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
                </div>
                <!-- /Form template-->
                
                <!-- No forms template -->
                <div id="laboratorios_noforms_template" class="noItems col-sm-12 text-center">Ningún laboratorios</div>
                <!-- /No forms template-->
                
                <!-- Controls -->
                <div id="laboratorios_controls" class="controls col-sm-11 col-sm-offset-1">
                    <div id="laboratorios_remove_last" class="btn form removeLast"><a><span><i class="fa fa-close-circle"></i> Eliminar ultimo</span></a></div>
                    <div id="laboratorios_remove_all" class="btn form removeAll"><a><span><i class="fa fa-close-circle"></i> Eliminar todos</span></a></div>
                </div>
                <!-- /Controls -->
                
            </div>
            <!-- /sheepIt Form --> 
						
					</div>
          <hr>

    
			
		
			<div class="col-sm-12">
				<input type="submit" value="Registrar" class="btn btn-success" class="form-control">
			</div>
		</div>
		</div>
	</form>
	</div>
</div>
@section('scripts')
<script src="{{ asset('plugins/sheepit/jquery.sheepItPlugin.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('plugins/jqNumber/jquery.number.min.js') }}" type="text/javascript"></script>

<script type="text/javascript">

  $(document).ready(function() {

    $(".monto").keyup(function(event) {
      var montoId = $(this).attr('id');
      var montoArr = montoId.split('_');
      var id = montoArr[1];
      var montoH = parseFloat($('#servicios_'+id+'_montoHidden').val());
      var monto = parseFloat($(this).val());
      $('#servicios_'+id+'_montoHidden').val(monto);
      calcular();
      calculo_general();
    });

    $(".montol").keyup(function(event) {
      var montoId = $(this).attr('id');
      var montoArr = montoId.split('_');
      var id = montoArr[1];
      var montoH = parseFloat($('#laboratorios_'+id+'_montoHidden').val());
      var monto = parseFloat($(this).val());
      $('#laboratorios_'+id+'_montoHidden').val(monto);
      calcular();
      calculo_general();
    });

    $(".abonoL, .abonoS").keyup(function(){
      var total = 0;
      var selectId = $(this).attr('id');
      var selectArr = selectId.split('_');
      
      if(selectArr[0] == 'servicios'){
          if(parseFloat($(this).val()) > parseFloat($("#servicios_"+selectArr[1]+"_monto").val())){
              alert('La cantidad insertada en abono es mayor al monto.');
              $(this).val('0.00');
              calculo_general();
          } else {
              calculo_general();
          }
      } else {
        if(parseFloat($(this).val()) > parseFloat($("#laboratorios_"+selectArr[1]+"_monto").val())){
              alert('La cantidad insertada en abono es mayor al monto.');
              $(this).val('0.00');
              calculo_general();
          } else {
              calculo_general();
          }
      }
    });

    var botonDisabled = true;

    // Main sheepIt form
    var phonesForm = $("#laboratorios").sheepIt({
        separator: '',
        allowRemoveCurrent: true,
        allowAdd: true,
        allowRemoveAll: true,
        allowRemoveLast: true,

        // Limits
        maxFormsCount: 10,
        minFormsCount: 1,
        iniFormsCount: 0,

        removeAllConfirmationMsg: 'Seguro que quieres eliminar todos?',
        
        afterRemoveCurrent: function(source, event){
          calcular();
          calculo_general();
        }
    });

 
    $(document).on('change', '.selectLab', function(){
      var labId = $(this).attr('id');
      var labArr = labId.split('_');
      var id = labArr[1];

      $.ajax({
         type: "GET",
         url:  "analisis/getAnalisi/"+$(this).val(),
         success: function(a) {
            $('#laboratorios_'+id+'_montoHidden').val(a.preciopublico);
            $('#laboratorios_'+id+'_monto').val(a.preciopublico);
            var total = parseFloat($('#total').val());
            $("#total").val(total + parseFloat(a.preciopublico));
            calcular();
            calculo_general();
         }
      });
    })
});


function calcular() {
  var total = 0;
      $(".monto").each(function(){
        total += parseFloat($(this).val());
      })

      $(".montol").each(function(){
        total += parseFloat($(this).val());
      })

      $("#total").val(total);
}

function calculo_general() {
  var total = 0;
  $(".abonoL").each(function(){
    total += parseFloat($(this).val());
  })

  $(".abonoS").each(function(){
    total += parseFloat($(this).val());
  })

  $("#total_a").val(total);
  $("#total_g").val(parseFloat($("#total").val()) - parseFloat(total));
}

// Run Select2 on element
function Select2Test(){
	$("#el2").select2();
	$("#el1").select2();
	$("#el3").select2();
  $("#el5").select2();
   $("#el6").select2();
  $("#el4").select2();
}
$(document).ready(function() {
	// Load script of Select2 and run this
	LoadSelect2Script(Select2Test);
	LoadTimePickerScript(DemoTimePicker);
	WinMove();
});

function DemoTimePicker(){
	$('#input_date').datepicker({
	setDate: new Date(),
	minDate: 0});
	$('#input_time').timepicker({
		setDate: new Date(),
		stepMinute: 10
	});
	$('#input_time2').timepicker({
		setDate: new Date(),
		stepMinute: 10
	});
}
</script>


@endsection
@endsection