@extends('layouts.app')

@section('content')

<body>
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-linux"></i>
					<span>Reportes/Clientes por Mes</span>

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

			    {!! Form::open(['method' => 'get', 'route' => ['pacientes.indexr']]) !!}



      <div class="row">
     
 <div class="col-md-3">
			         <select id="el1" name="mes">
									<option value="01">Enero</option>
								    <option value="02">Febrero</option>
									<option value="03">Marzo</option>
									<option value="04">Abril</option>
									<option value="05">Mayo</option>
									<option value="06">Junio</option>
									<option value="07">Julio</option>
									<option value="08">Agosto</option>
									<option value="09">Septiembre</option>
									<option value="10">Octubre</option>
									<option value="11">Noviembre</option>
									<option value="12">Diciembre</option>

					</select>
        </div>
      
     
        <div class="col-md-2">
            {!! Form::submit(trans('Buscar'), array('class' => 'btn btn-info')) !!}
            {!! Form::close() !!}

        </div>
         <div class="col-md-2">
                     <p><strong>Mes Consultado: </strong>{{$mes}}</p>
                     <p><strong>Total Clientes: </strong>{{$total->total}}</p>
            
        </div>
    </div>
			<div class="box-content no-padding">
				<table class="table table-bordered table-striped table-hover table-heading table-datatable" id="datatable-3">
					<thead>
						<tr>
							<th>Id</th>
							<th>Nombres</th>
							<th>Apellidos</th>
							<th>DNI</th>
							<th>Telèfono</th>
							<th>Direcciòn</th>
							<th>Registrado Por:</th>


						</tr>
					</thead>
					<tbody>
					@foreach($pacientes as $p)					
						<tr>
						<td>{{$p->id}}</td>
						<td>{{$p->nombres}}</td>
						<td>{{$p->apellidos}}</td>
						<td>{{$p->dni}}</td>
						<td>{{$p->telefono}}</td>
						<td>{{$p->direccion}}</td>
						<td>{{$p->user}}</td>
						
						</tr>
						
				    @endforeach
					</tbody>
					<tfoot>
						<tr>
							<th>Id</th>
							<th>Nombres</th>
							<th>Apellidos</th>
							<th>DNI</th>
							<th>Telèfono</th>
							<th>Direcciòn</th>
							<th>Registrado Por:</th>

						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</div>
</div>

 <div class="modal fade" id="viewPaciente" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            <h4 class="modal-title" id="myModalLabel">Detalles del Paciente</h4>
          </div>
          <div class="modal-body"></div>
        </div>
      </div>
    </div>

</body>

<style type="text/css">
		.modal-backdrop.in {
		    filter: alpha(opacity=50);
		    opacity: 0;
		    z-index: 0;
		}

		.modal {
			top:35px;
		}
</style>

	<script type="text/javascript">
		function view(e){
		    var id = $(e).attr('id');
		    
		    $.ajax({
		        type: "GET",
		        url: "/pacientes/view/"+id,
		        success: function (data) {
		            $("#viewPaciente .modal-body").html(data);
		            $('#viewPaciente').modal('show');
		        },
		        error: function (data) {
		            console.log('Error:', data);
		        }
		    });
		}

		function eliminar(e) {
			var id = $(e).attr('id');
			var r = confirm("Seguro que deseas eliminar este material!");
			if (r) {
				//$(e).parent('div').hide('slow');
				$.ajax({
		        type: "GET",
			        url: "/servicio/material_eliminar/"+id,
			        success: function (data) {
			        	if (data == 1) {
			        		$(e).parent('div').hide('slow');
			            	toastr.success('El materia ha sido eliminado.', 'Servicios!');
			        	} else {
			        		toastr.error('El material no pudo ser eliminado.', 'Servicios!')
			        	}
			        },
			        error: function (data) {
			            toastr.error('Se genero un problema al momento de realizar el proceso de eliminación.', 'Servicios!')
			        }
			    });
			}
			
		}
	</script>

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
