@extends('layouts.app')

@section('content')

<body>
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-linux"></i>
					<span>Reportes/Historial de Pacientes</span>

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
			{!! Form::open(['method' => 'get', 'route' => ['historial.pacientes']]) !!}

			<div class="row">
					<div class="col-md-6">

							<select id="el1"  name="paciente">
								<option value="">Busque el Paciente</option>
								@foreach($pacientes as $role)
									<option value="{{$role->dni}}">{{$role->apellidos}},{{$role->nombres}}-{{$role->dni}}</option>
								@endforeach
							</select>
						</div>	
				<div class="col-md-6">
					{!! Form::submit(trans('Buscar'), array('class' => 'btn btn-info')) !!}
					{!! Form::close() !!}

				</div>
			</div>	
            <span><strong>ATENCIONES</strong></span>
			<div class="box-content no-padding">
				<table class="table table-bordered table-striped table-hover table-heading table-datatable" id="datatable-3">
					<thead>
						<tr>
							<th>Id</th>
							<th>Paciente</th>
							<th>Origen</th>
							<th>Detalle</th>
							<th>Fecha</th>
							<th>Registrado Por:</th>
						</tr>
					</thead>
					<tbody>
						@foreach($atenciones as $d)
						<tr>
						<td>{{$d->id}}</td>
						<td>{{$d->apellidos}},{{$d->nombres}}</td>
						<td>{{$d->name}},{{$d->lastname}}</td>
						@if($d->es_servicio =='1')
						<td>{{$d->servicio}}</td>
						@elseif($d->es_laboratorio =='1')
						<td>{{$d->laboratorio}}</td>
						@else
						<td>{{$d->paquete}}</td>
						@endif
						
						<td>{{date('d-m-Y H:i', strtotime($d->created_at))}}</td>
						<td>{{$d->user}},{{$d->userp}}</td>
						

					</tr>
						@endforeach
						
                      
					</tbody>
					<tfoot>
						    <th>Id</th>
							<th>Paciente</th>
							<th>Origen</th>
							<th>Detalle</th>
							<th>Fecha</th>
							<th>Registrado Por:</th>
					</tfoot>
				</table>
			</div>
		
		       <span><strong>CONSULTAS</strong></span>
				<div class="box-content no-padding">
				<table class="table table-bordered table-striped table-hover table-heading table-datatable" id="datatable-3">
					@foreach($event as $d)
					<thead>
						<tr>
							<th>Paciente</th>
							<th>Especialista</th>
							<th>Monto</th>
							<th>Fecha</th>
							@if($d->atendido == 1)
							<th>Estatus</th>
							<th>Atendido Por:</th>
							@else
						    <th>Estatus</th>
							@endif
						</tr>
					</thead>
					<tbody>
						<tr>
						<td>{{$d->apellidos}} {{$d->nombres}}</td>
						<td>{{$d->nombrePro}} {{$d->apellidoPro}}</td>
						<td>{{$d->monto}}</td>
						<td>{{$d->date}}</td>
						@if($d->atendido == 1)
						<td style="background: #82FA58;">Fue Atendido</td>
						<td>{{$d->nomate}} {{$d->apeate}}</td>
						@else
						<td style="background: #FE642E;">No ha sido Atendido</td>
						@endif
					</tr>
						@endforeach
		
                      
					</tbody>
					<tfoot>
						    <th>Paciente</th>
							<th>Especialista</th>
							<th>Monto</th>
							<th>Fecha</th>
							<th>Horas</th>
							<th>Estatus</th>
					</tfoot>
				</table>
			</div>

		</div>
	</div>
</div>

</body>



@section('scripts')
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
