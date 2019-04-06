@extends('layouts.app')

@section('content')
<br>
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-users"></i>
					<span><strong>Nueva Consulta</strong></span>
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
		<a href="{{route('pacientes.create3')}}"><i class="fa fa-wheelchair"></i> Crear Pacientes<a>
			<div class="box-content">
				<h4 class="page-header"></h4>
				<form class="form-horizontal" role="form" method="post" action="consulta/create">
					{{ csrf_field() }}
					<div class="form-group">
						
						<label class="col-sm-1 control-label">Especialistas</label>
						<div class="col-sm-3">
							<select id="el1" name="especialista">
								@foreach($especialistas as $especialista)
									<option value="{{$especialista->id}}">
										{{$especialista->name}} {{$especialista->lastname}}
										/ {{$especialista->dni}}
									</option>
								@endforeach
							</select>
						</div>

					<label class="col-sm-1 control-label">Pacientes</label>
						<div class="col-sm-3">
							<select id="el2" name="paciente">
								@foreach($pacientes as $paciente)
									<option value="{{$paciente->id}}">
										{{$paciente->dni}} - 
										{{$paciente->nombres}} {{$paciente->apellidos}}
									</option>
								@endforeach
							</select>
						</div>

						<label class="col-sm-1 control-label">Evaluaciones</label>
						<div class="col-sm-3">
							<select id="el4" name="evaluaciones">
								@foreach($evaluaciones as $eva)
									<option value="{{$eva->id}}">
										{{$eva->nombre}} -Precio:{{$eva->precio}} 
									</option>
								@endforeach
							</select>
						</div>

						<label class="col-sm-1 control-label">Método de pago</label>
						<div class="col-sm-3">
							<select id="el6" name="metodopago" required="required">
								<option value="" selected hidden disabled>Seleccione</option>
								<option value="EF">EF</option>
								<option value="TJ">TJ</option>
							</select>
						</div>
								
				<label class="col-sm-1 control-label">Cómo Llego?:</label>
	            <div class="col-sm-3">
	              <select id="el5" name="comollego">
	                  <option value="Seleccione">Seleccione</option>
	                  <option value="Vallas publicitarias externas">Vallas publicitarias externas</option>
	                  <option value="Carteles publicitarios en el mismo local">Carteles publicitarios en el mismo local</option>
	                  <option value="Recomendación por pacientes">Recomendación por pacientes</option>
	                  <option value="Recomendación por médicos">Recomendación por médicos</option>
	                  <option value="Redes sociales (Facebook, Instagram, Twitter)s">Redes sociales (Facebook, Instagram, Twitter)</option>
	                  <option value="Radio (AM/FM/XM)">Radio (AM/FM/XM)</option>
	                  <option value="Radio por Internet">Radio por Internet</option>
	                  <option value="Televisión">Televisión</option>
	                  <option value="Motor de búsqueda (Google, Bing, Yahoo!">Motor de búsqueda (Google, Bing, Yahoo!)</option>
	                  <option value="Otros">Otros</option>


	              </select>
	            </div>

						<br>
						<input onclick="form.submit()"  type="submit" style="margin-left:15px; margin-top: 20px;" class="col-sm-3 btn btn-primary" value="Agregar">
						<a href="{{route('generics.router')}}" style="margin-left:15px; margin-top: 20px;" class="col-sm-2 btn btn-danger">Volver</a>

					</div>			
				</form>	
			</div>
		</div>
	</div>
</div>
@section('scripts')
<script type="text/javascript">
// Run Select2 on element
$(document).ready(function() {
	LoadTimePickerScript(DemoTimePicker);
	LoadSelect2Script(function (){
		$("#el1").select2();
		$("#el2").select2();
		$("#el3").select2({disabled : true});
		$("#el4").select2();
		$("#el5").select2();
		$("#el6").select2();

		
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
