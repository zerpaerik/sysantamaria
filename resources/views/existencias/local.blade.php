@extends('layouts.app')

@section('content')
</br>
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-users"></i>
					<span><strong>Productos en Almacen local</strong></span>
					<a href="{{route('existencias.create')}}" class="btn btn-primary">Agregar</a>
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
					<thead>
						<tr>
							<th>Nombre</th>
							<th>Còdigo</th>
							<th>Medida</th>
							<th>Categoria</th>
							<th>Cantidad</th>
							<th>Precio Unidad</th>
							<th>Precio Venta</th>
							@if(\Auth::user()->role_id <> 7)
							<th>Acciones</th>
							@endif

							
						</tr>
					</thead>
					<tbody>
						@foreach($producto as $ana)					
							<tr>
								<td>{{$ana->nombre}}</td>
								<td>{{$ana->codigo}}</td>
								<td>{{$ana->medida}}</td>
								<td>{{$ana->categoria}}</td>
								@if($ana->cantidad <= 3)
								<td style="background:#33FF52;">{{$ana->cantidad}}</td>
								@else
								<td>{{$ana->cantidad}}</td>
								@endif
								<td>{{$ana->preciounidad}}</td>
								<td>{{$ana->precioventa}}</td>
								@if(\Auth::user()->role_id <> 7)
								<td>
									<a class="btn btn-warning" href="existencias-edit-{{$ana->id}}">Editar</a>
									<a href="existencias-delete-{{$ana->id}}" class="btn btn-danger">Eliminar</a>
								</td>
								@endif
							</tr>
						@endforeach
					</tbody>
					<tfoot>
					</tfoot>
				</table>
			</div>
		</div>
	</div>
</div>

<script src="{{url('/tema/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{url('/tema/plugins/jquery-ui/jquery-ui.min.js')}}"></script>

@if(isset($created))
	<div class="alert alert-success" role="alert">
	  A simple success alert—check it out!
	</div>
@endif
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