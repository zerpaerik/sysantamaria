@extends('layouts.app')
@section('content')
<br>
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-users"></i>
					<span><strong>Agregar Evaluación</strong></span>
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
			<div class="box-content">	
				<form class="form-horizontal" role="form" method="post" action="prenatal/create">
					{{ csrf_field() }}
					<div class="form-group">
						<div class="row">
							<div class="col-md-6">					
								<h3>Datos personales</h3>
								<label for="">Seleccione un paciente</label>
								<select name="paciente" id="el2">
								@foreach($pacientes as $paciente)
									<option value="{{$paciente->id}}">{{$paciente->nombres}} {{$paciente->apellidos}}-{{$paciente->dni}}</option>
								@endforeach
								</select>
							</div>
							<div class="col-md-6">
								<h3>Datos de profesional</h3>
								<label for="">Seleccione un profesional</label>
								<select name="profesional" id="el9">
								@foreach($profesional as $p)
									<option value="{{$p->id}}">{{$p->lastname}} {{$p->name}}</option>
								@endforeach
								</select>
							</div>
						</div>
						<br><br>
						<div class="row">
							<div class="col-md-6">						
								<h3>Procedimiento</h3>
								<select id="el10" multiple="" name="procedimiento[]" placeholder="Seleccione">
								<option value="CHC">CHC</option>
								<option value="ELECT">ELECT</option>
								<option value="EJERCICIO">EJERCICIO</option>
								<option value="CF">CF</option>
								<option value="LASER">LASER</option>
								<option value="MASAJE">MASAJE</option>
								<option value="US">US</option>
								<option value="MAG">MAG</option>
								<option value="OTROS">OTROS</option>
								</select>

							</div><!--fin div col-->
							<div class="col-md-6">
								<h3>Evolución</h3>
								<select id="el8" name="evolucion">
								<option value="" selected hidden disabled>Seleccione</option>
								<option value="Desfavorable">Desfavorable</option>
								<option value="Mantiene">Mantiene</option>
								<option value="Favorable">Favorable</option>
								</select>
							</div>
						</div><!--fin div row-->
					</div>
					<div class="row">
						<div class="col-md-12">
							<label class="col-sm-2">OBSERVACIÓN</label>
							<div class="col-sm-10">
							<input type="text" class="form-control" name="observacion" placeholder="Observacion" data-toggle="tooltip" data-placement="bottom" title="cesaria">
							</div>
						</div>
						<div class="col-md-1">
							<br>
							<input type="submit" class="btn btn-primary" value="Guardar" onclick="form.submit()">
						</div>
					</div><!--fin row-->
				</div>
			</div>																																																										
		</div>
				</div>
				</form>
			</div>	
		</div>
	</div>
</div>
@section('scripts')
<script src="{{ asset('plugins/sheepit/jquery.sheepItPlugin.min.js') }}" type="text/javascript"></script>


<script type="text/javascript">

// Run Select2 on element
function Select2Test(){
	$("#el1").select2();
	$("#el2").select2();
	$("#el3").select2();
	$("#el4").select2();
	$("#el5").select2();
	$("#el8").select2();
	$("#el9").select2();
	$("#el10").select2();
  

  
}
$(document).ready(function() {
	// Load script of Select2 and run this
	LoadSelect2Script(Select2Test);
	LoadTimePickerScript(DemoTimePicker);
	WinMove();
});

function DemoTimePicker(){
	$('#input_date').datepicker({
	setDate: new Date(),
	minDate: 0});
	$('#input_time').timepicker({
		setDate: new Date(),
		stepMinute: 10
	});
	$('#input_time2').timepicker({
		setDate: new Date(),
		stepMinute: 10
	});
}

</script>


   
@endsection	
@endsection