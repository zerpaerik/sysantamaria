@extends('layouts.app')

@section('content')

<body>
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-linux"></i>
					<span>Sesiones/Atender</span>

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
			<div class="box-content no-padding">
				<table class="table table-bordered table-striped table-hover table-heading table-datatable" id="datatable-3">
					<thead>
						<tr>
							<th>Id</th>
							<th>Fecha</th>
							<th>Paciente</th>
							<th>DNI</th>
							<th>Origen</th>
							<th>Detalle</th>
							<th>Atendido Por:</th>
							<th>Acciones:</th>
							


						</tr>
					</thead>
					<tbody>
					@foreach($resultados as $p)					
						<tr>
						<td>{{$p->id}}</td>
						<td>{{$p->created_at}}</td>
						<td>{{$p->nombres}},{{$p->apellidos}}</td>
						<td>{{$p->dni}}</td>
						<td>{{$p->name}},{{$p->lastname}}</td>
						@if($p->es_servicio =='1')
						<td>{{$p->servicio}}</td>
						@else
						<td>{{$p->laboratorio}}</td>
						@endif
					
					
								<td>
							   <form method="get" action="atenciones-atender">	
							   <input type="hidden" value="{{$p->id}}" name="id">		
								<select id="informe" name="atendido">
								@foreach($personal as $pac)
									<option value="{{$pac->id}}">
										{{$pac->name}} {{$pac->lastname}}-{{$pac->dni}}
									</option>
								@endforeach
							</select>
							</td>
							<td><input type="submit" class="btn btn-success" value="Atender"></td>
						    </form>
							
						</tr>
						@endforeach	
					</tbody>
					<tfoot>
						<tr>
						    <th>Id</th>
							<th>Fecha</th>
							<th>Paciente</th>
							<th>Origen</th>
							<th>Detalle</th>
							<th>Informe</th>
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
