@extends('layouts.app')

@section('content')

<body>
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-linux"></i>
					<span>Movimientos/Comisiones Pagadas</span>

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
			{!! Form::open(['method' => 'get', 'route' => ['compagadas.index']]) !!}

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
			<div class="row">

				<form action="reporte/pagadas" method="get">

					<input type="hidden" value="{{$f1}}" name="f1">
				    <input type="hidden" value="{{$f2}}" name="f2">
						
				<button style="margin-left: 15px;" target="_blank" type="submit">Generar Reporte</button>
			   </form>
				
			</div>


			<div class="box-content no-padding">
				<table class="table table-bordered table-striped table-hover table-heading table-datatable" id="datatable-3">
					<thead>
						<tr>
							<th>Recibo</th>
							<th>Origen</th>
							<th>Fecha Atenciòn</th>
							<th>Total Pagado</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody>
                          @foreach($atenciones as $atec)	

							<tr>
								<td>{{$atec->recibo}}</td>
								<td>{{$atec->name}},{{$atec->lastname}}</td>
								<td>{{$atec->created_at}}</td>
								<td>{{$atec->totalrecibo}}</td>
                                <td><a  href="{{asset('recibo_profesionales_ver')}}/{{$atec->recibo}}" class="btn btn-xs btn-primary">Ver</a>
                                <a href="{{asset('/reversar')}}/{{$atec->recibo}}" class="btn btn-xs btn-danger">Reversar</a></td>
                            </tr>
						@endforeach
					</tbody>
					<tfoot>
						<tr>
							<th>Recibo</th>
							<th>Origen</th>
							<th>Fecha Atenciòn</th>
							<th>Total Pagado</th>
							<th>Acciones</th>
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
