@extends('layouts.app')

@section('content')

<body>
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-linux"></i>
					<span>Reportes/ Número de Atenciones</span>

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
			{!! Form::open(['method' => 'get', 'route' => ['comollego.search']]) !!}

			<div class="row">
				<div class="col-md-2">
					{!! Form::label('inicio', 'Fecha Inicio', ['class' => 'control-label']) !!}
					{!! Form::date('inicio', old('inicio'), ['id'=>'inicio','class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
					<p class="help-block"></p>
					@if($errors->has('inicio'))
					<p class="help-block">
						{{ $errors->first('inicio') }}
					</p>
					@endif
				</div>
				<div class="col-md-2">
					{!! Form::label('final', 'Fecha Fin', ['class' => 'control-label']) !!}
					{!! Form::date('final', old('final'), ['id'=>'final','class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
					<p class="help-block"></p>
					@if($errors->has('final'))
					<p class="help-block">
						{{ $errors->first('final') }}
					</p>
					@endif
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
