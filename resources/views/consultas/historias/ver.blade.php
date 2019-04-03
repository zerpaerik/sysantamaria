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
				<br>
				<h3 class="col-sm-12"><strong>Consulta del {{$consulta->created_at}}</strong></h3>
				<br>
				<br>
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



			</div>
		</div>

	</div>
	@endforeach	
@endsection