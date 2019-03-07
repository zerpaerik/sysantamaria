@extends('layouts.app')
@section('content')
	<h3>Servicio PROGRAMADO:</h3>
    <p>Paciente: {{$data->nompac}} {{$data->apepac}} </p>
	<p>Especialista: {{$data->nombrePro}} {{$data->apellidoPro}} </p>
	@if($data->tipo==1)
	<p>Servicio: {{$data->srDetalle}}</p>
	@elseif($data->tipo==2)
    <p>Consulta: {{$data->evaluacion}}</p>
	@else
    <p>Punzion: {{$data->punsion}}</p>
	@endif
	<p>Hora: {{$data->start_time}} Hasta las {{$data->end_time}}</p>
	<br>	
@endsection