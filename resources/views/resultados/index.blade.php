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


			{!! Form::open(['method' => 'get', 'route' => ['resultados.index']]) !!}

			<div class="row">
				<div class="col-md-4">
					<select id="el2" name="paciente">
							<option>Seleccione un Paciente</option>
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
							<th>Fecha</th>
							<th>Paciente</th>
      						<th>Origen</th>
							<th>Detalle</th>
							<th width="20%">Atendido Por:</th>
							<th>Acciones:</th>
							


						</tr>
					</thead>
					<tbody>
					@foreach($resultados as $p)					
						<tr>
						<td>{{$p->id}}</td>
						<td>{{$p->created_at}}</td>
						<td>{{$p->nombres}},{{$p->apellidos}}</td>
						<td>{{$p->name}},{{$p->lastname}}</td>
						@if($p->es_servicio =='1')
						<td>{{$p->servicio}}</td>
						@else
						<td>{{$p->paquete}}</td>
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
