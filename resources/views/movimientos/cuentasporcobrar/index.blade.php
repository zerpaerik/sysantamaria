@extends('layouts.app')

@section('content')

<body>
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-linux"></i>
					<span>Movimientos/Cuentas Por Cobrar</span>

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
			{!! Form::open(['method' => 'get', 'route' => ['cuentasporcobrar.index']]) !!}

			<div class="row">
				<div class="col-md-4">
					<select id="el2" name="paciente">
							<option selected hidden disabled>Seleccione un Paciente</option>
							@foreach($pacientes as $p)
								    <option value="{{$p->id}}">{{$p->apellidos}},{{$p->nombres}}</option>
							@endforeach
						</select>
				</div>
				<div class="col-md-2">
					{!! Form::submit(trans('Buscar'), array('class' => 'btn btn-info')) !!}
					{!! Form::close() !!}

				</div>
				<div class="col-md-2">
				<strong>Monto por Cobrar:</strong>{{$aten->monto}}
			   </div>
			   <div class="col-md-2">
				<strong>Total Items:</strong>{{$total->total}}
			   </div>
			</div>	

				

			<div class="box-content no-padding">

				<table class="table table-bordered table-striped table-hover table-heading table-datatable" id="datatable-3">
					<thead>
						<tr>
							<th>Id</th>
							<th>Fecha</th>
							<th>Paciente</th>
							<th>DNI</th>
							<th>Monto</th>
							<th>Monto Abonado</th>
							<th>Monto Pendiente</th>
							<th>Acciones:</th>
						</tr>
					</thead>
					<tbody>

						@foreach($cuentasporcobrar as $d)
						<tr>
						<td>{{$d->id}}</td>
						<td>{{$d->created_at}}</td>
						<td>{{$d->nombres}},{{$d->apellidos}}</td>
						<td>{{$d->dni}}</td>
						<td>{{$d->monto}}</td>
						<td>{{$d->abono}}</td>
						<td>{{$d->pendiente}}</td>
						<td>

						<a  class="btn btn-success" href="cuentasporcobrar-edit-{{$d->id}}">Cobrar</a>	

							
						</td>

				        @endforeach
				    </tr>
					</tbody>
					<tfoot>
						<tr>
							<th>Id</th>
							<th>Paciente</th>
							<th>Monto</th>
							<th>Monto Abonado</th>
							<th>Monto Pendiente</th>
							<th>Acciones:</th>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</div>
</div>

</body>



@section('scripts')
<script src="{{url('/tema/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{url('/tema/plugins/jquery-ui/jquery-ui.min.js')}}"></script>

<script type="text/javascript">
// Run Select2 on element
$(document).ready(function() {
      LoadTimePickerScript(DemoTimePicker);
      LoadSelect2Script(function (){
            $("#el2").select2();
            $("#el1").select2();
            $("#el3").select2({disabled : true});
      });
      WinMove();
});

$('#input_date').on('change', getAva);
$('#el1').on('change', getAva);

function getAva (){
            var d = $('#input_date').val();
            var e = $("#el1").val();
            if(!d) return;
            $.ajax({
      url: "available-time/"+e+"/"+d,
      headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
      type: "get",
      success: function(res){
            $('#el3').find('option').remove().end();
            for(var i = 0; i < res.length; i++){
                              var newOption = new Option(res[i].start_time+"-"+res[i].end_time, res[i].id, false, false);
                              $('#el3').append(newOption).trigger('change');
            }
      }
    });     
}

function DemoTimePicker(){
      $('#input_date').datepicker({
      setDate: new Date(),
      minDate: 0});
}
</script>
@endsection
@endsection
