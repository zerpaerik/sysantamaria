@extends('layouts.app')

@section('content')

<body>
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-linux"></i>
					<span>Lista de Consultas</span>
				</div>


				<div class="box-icons">
					<a class="collapse-link">
						<i class="fa fa-chevron-up"></i>
					</a>
					<a class="expand-link">
						<i class="fa fa-expand"></i>
					</a>
					<a class="close-link">
						<i class="fa fa-times"></i>
					</a>
				</div>

				<div class="no-move"></div>
				
			</div>
			{!! Form::open(['method' => 'get', 'route' => ['consultas.inicio']]) !!}

			<div class="row">
				<div class="col-md-2">
					<label>Fecha Inicio</label>
					<input type="date" value="{{$f1}}" name="fecha" style="line-height: 20px">
				</div>
				<div class="col-md-2">
					<label>Fecha Fin</label>
					<input type="date" value="{{$f2}}" name="fecha2" style="line-height: 20px">
				</div>
				<div class="col-md-2">

					{!! Form::submit(trans('Buscar'), array('class' => 'btn btn-info')) !!}
					{!! Form::close() !!}

				</div>
				
			</div>	

			<div class="box-content no-padding">
				<table class="table table-bordered table-striped table-hover table-heading table-datatable" id="datatable-3">
					<thead>
						<tr>
							<th>Id</th>
							<th>Paciente</th>
							<th>Especialista</th>
							<th>Eval</th>
						    <th>Como Llego</th>
							<th>Fecha</th>
							<th>Registrado Por</th>
							<th>Acciones:</th>
						</tr>
					</thead>
					<tbody>

						@foreach($eventos as $d)
						<tr>
						<td>{{$d->EventId}}</td>
						<td>{{$d->nombres}} {{$d->apellidos}}</td>
						<td>{{$d->nombrePro}} {{$d->apellidoPro}}</td>
						<td>{{$d->nombreEval}}</td>
						<td>{{$d->comollego}}</td>
						<td>{{$d->date}}</td>
						<td>{{$d->username}}-{{$d->userlast}}</td>
						<td>
						<a  class="btn btn-danger" href="event-{{$d->EventId}}">Cargar Historia</a>	
						
						@if(\Auth::user()->role_id <> 7)
						<a target="_blank" class="btn btn-primary" href="consulta-ticket-ver-{{$d->EventId}}">Ver Ticket</a>

						@endif
						@if(\Auth::user()->role_id <> 6 && \Auth::user()->role_id <> 7)							 
						<a class="btn btn-warning" href="consulta-delete-{{$d->EventId}}" onclick="return confirm('¿Desea Eliminar este registro?')">Eliminar</a>	

						@endif
							

						</td>

				        @endforeach
				    </tr>
					</tbody>
					<tfoot>
						<tr>
							<th>Id</th>
							<th>Paciente</th>
							<th>Especialista</th>
							<th>Eval</th>
						    <th>Como Llego</th>
							<th>Fecha</th>
							<th>Registrado Por</th>
							<th>Acciones:</th>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</div>
</div>

</body>

<script src="{{url('/tema/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{url('/tema/plugins/jquery-ui/jquery-ui.min.js')}}"></script>







<script type="text/javascript">
// Run Datables plugin and create 3 variants of settings
function AllTables(){
	TestTable1();
	TestTable2();
	TestTable3();
	LoadSelect2Script(MakeSelect2);
}
function MakeSelect2(){
	$('select').select2();
	$('.dataTables_filter').each(function(){
		$(this).find('label input[type=text]').attr('placeholder', 'Search');
	});
}
$(document).ready(function() {
	// Load Datatables and run plugin on tables 
	LoadDataTablesScripts(AllTables);
	// Add Drag-n-Drop feature
	WinMove();
});
</script>
@endsection
