@extends('layouts.app')

@section('content')

<body>
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-linux"></i>
					<span>Requerimientos/Recibidos</span>

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
					@foreach($requerimientos2 as $req)					
						  @if($req->estatus == 'Solicitado')
							<th>Usuario Solicitante</th>
							<th>Producto</th>
							<th>Cantidad Solicitada</th>
							<th>Estatus</th>
							<th>Fecha</th>
							<th>Cantidad a Entregar</th>
							@else
							<th>Usuario Solicitante</th>
							<th>Producto</th>
							<th>Cantidad</th>
						    <th>Cantidad Entregada</th>
							<th>Estatus</th>
							<th>Fecha</th>
							@endif
						</tr>
						</tr>
					</thead>
					<tbody>
	<tr>
							   @if($req->estatus == 'Solicitado')
								<td>{{$req->solicitante}}</td>
								<td>{{$req->nombre}}-<strong>Còdigo:</strong>{{$req->codigo}}</td>
							    <td>{{$req->cantidad}}</td>
								<td>{{$req->estatus}}</td>
								<td>{{$req->created_at}}</td>
							    <td><form method="get" action="requerimientos-edit"><input type="hidden" value="{{$req->id}}" name="id"><input type="text" name="cantidadd" value="" size="8"><button style="margin-left: 35px;" type="submit" class="btn btn-xs btn-danger">Procesar</button></form></td>		
								@else
								<td>{{$req->solicitante}}</td>
								<td>{{$req->nombre}}</td>
							    <td>{{$req->cantidad}}</td>
							    <td>{{$req->cantidadd}}</td>
								<td>{{$req->estatus}}</td>
								<td>{{$req->created_at}}</td>
								@endif
							</tr>
						@endforeach
				
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
