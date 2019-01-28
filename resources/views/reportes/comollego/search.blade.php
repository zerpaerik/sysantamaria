@extends('layouts.app')

@section('content')
</br>
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-users"></i>
					<span><strong>Nùmero de Atenciones</strong></span>
				</div>
				<div class="box-icons">
					<a class="collapse-link">
						<i class="fa fa-chevron-up"></i>
					</a>
					<a class="expand-link">
						<i class="fa fa-expand"></i>
					</a>
				</div>
				<div class="no-move"></div>
			</div>
			<div class="box-content no-padding">
				<table class="table table-bordered table-striped table-hover table-heading table-datatable" id="datatable-1">
					<form action="/comollego-search" method="get">
						<label for="">Inicio</label>
						<input type="date" name="inicio" value="{{ Carbon\Carbon::now()->toDateString()}}" style="line-height: 20px">
						<label for="">Final</label>
						<input type="date" name="final" value="{{ Carbon\Carbon::now()->toDateString()}}" style="line-height: 20px">
						<label for=""></label>
						<input type="submit" value="Buscar" class="btn btn-primary" style="margin-left: 30px;">
					</form>
				<thead>
						<tr>
							<th>Vallas</th>
							<th>Carteles</th>
							<th>Recomendacion.Paciente</th>
					        <th>Recomendacion.Medico</th>
							<th>Redes Sociales</th>
						    <th>Radio</th>
						    <th>Radio Internet</th>
						    <th>TV</th>
						    <th>Google</th>
						    <th>Otros</th>
						</tr>
					</thead>
					<tbody>

							<tr>
								<td>{{$vallas->cantidad}}</td>
								<td>{{$carteles->cantidad}}</td>
								<td>{{$pacientes->cantidad}}</td>
								<td>{{$medicos->cantidad}}</td>
								<td>{{$redes->cantidad}}</td>
							    <td>{{$radio->cantidad}}</td>
								<td>{{$radioi->cantidad}}</td>
								<td>{{$tv->cantidad}}</td>
								<td>{{$motor->cantidad}}</td>
								<td>{{$otro->cantidad}}</td>

							</tr>
					</tbody>
					
					</form>
				</table>
			</div>
	
		</div>
	</div>
</div>
@if(isset($created))
	<div class="alert alert-success" role="alert">
	  A simple success alert—check it out!
	</div>
@endif

@endsection