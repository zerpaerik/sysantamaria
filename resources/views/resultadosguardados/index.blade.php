@extends('layouts.app')

@section('content')

<body>
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-linux"></i>
					<span>Sesiones/Atendidas</span>

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
			{!! Form::open(['method' => 'get', 'route' => ['resultadosguardados.index']]) !!}

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
				@if($total->cantidad)

				<div class="col-md-2">
					<strong>Total Sesiones:</strong>{{$total->cantidad}}
				</div>
				@endif
			</div>	

		


			<div class="box-content no-padding">
				<table class="table table-bordered table-striped table-hover table-heading table-datatable" id="datatable-3">
					<thead>

						<tr>
							<th>Id</th>
							<th>Paciente</th>
							<th>DNI</th>
							<th>Origen</th>
							<th>Detalle</th>
							<th>Fecha Sesión</th>
							<th>Atendido Por:</th>
							<th>Acciones</th>
					   </tr>
										
				   </thead>
					<tbody>
                         @foreach($resultadosguardados as $d)
						<tr>
						<td>{{$d->id}}</td>
						<td>{{$d->nombres}},{{$d->apellidos}}</td>
						<td>{{$d->dni}}</td>
						<td>{{$d->name}},{{$d->lastname}}</td>
						@if($d->es_servicio =='1')
						<td>{{$d->servicio}}</td>
						@elseif($d->es_laboratorio =='1')
						<td>{{$d->laboratorio}}</td>
						@else
						<td>{{$d->paquete}}</td>
						@endif
						<td>{{$d->fecha_atencion}}</td>
						<td>{{$d->nomper}},{{$d->apeper}}</td>
						<td>
						@if(\Auth::user()->role_id <> 6 && \Auth::user()->role_id <> 7)

							<a class="btn btn-danger" href="atender-delete-{{$d->id}}">Reversar</a>
					    @endif
							<a target="_blank" class="btn btn-primary" href="ticket1-ver-{{$d->id}}">Ver Ticket</a>
						</td>
		
						</tr>
						@endforeach	
					</tbody>
					<tfoot>
						<tr>
						    <th>Id</th>
							<th>Paciente</th>
							<th>DNI</th>
							<th>Origen</th>
							<th>Detalle</th>
							<th>Fecha Sesión</th>
							<th>Atendido Por:</th>
							<th>Acciones</th>
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
