@extends('layouts.app')
@section('content')
	<h2>EVALUACIÒN</h2>
	<p>Fecha: {{$prenatal->created_at}}</p>
	<p>Paciente: {{$paciente->nombres}} {{$paciente->apellidos}} </p>
	<p>Procedimiento: {{$prenatal->procedimiento}}</p>
	<p>Evoluciòn: {{$prenatal->evolucion}}</p>
	<p>Observaciòn: {{$prenatal->observacion}}</p>
   
@endsection



