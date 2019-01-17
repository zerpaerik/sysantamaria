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
						<h3>Datos personales</h3>
						<label for="">Seleccione un paciente</label>
						<select name="paciente" id="el2">
						@foreach($pacientes as $paciente)
							<option value="{{$paciente->id}}">{{$paciente->nombres}} {{$paciente->apellidos}}-{{$paciente->dni}}</option>
						@endforeach
						</select>
						<br><br>
						<h3>Datos de profesional</h3>
						<label for="">Seleccione un profesional</label>
						<select name="profesional" id="el9">
						@foreach($profesional as $p)
							<option value="{{$p->id}}">{{$p->name}} {{$p->apellidos}}</option>
						@endforeach
						</select>
						<br><br>						
						<h3>Procedimiento</h3>

						<label class="col-sm-1 control-label">CHC</label>
						<div class="col-sm-3">
							<input type="checkbox" class="form-control" name="chc" placeholder="gesta" data-toggle="tooltip" data-placement="bottom" title="gesta">
						</div>

							<label class="col-sm-1 control-label">ELECT</label>
						<div class="col-sm-3">
							<input type="checkbox" class="form-control" name="elect" placeholder="viven" data-toggle="tooltip" data-placement="bottom" title="viven">
						</div>

							<label class="col-sm-1 control-label">EJERCICIO</label>
						<div class="col-sm-3">
							<input type="checkbox" class="form-control" name="ej" placeholder="cesarea" data-toggle="tooltip" data-placement="bottom" title="cesaria">
						</div>
						
						<label class="col-sm-1 control-label">CF</label>
						<div class="col-sm-3">
							<input type="checkbox" class="form-control" name="cf" placeholder="gesta" data-toggle="tooltip" data-placement="bottom" title="gesta">
						</div>

							<label class="col-sm-1 control-label">LASER</label>
						<div class="col-sm-3">
							<input type="checkbox" class="form-control" name="laser" placeholder="viven" data-toggle="tooltip" data-placement="bottom" title="viven">
						</div>

							<label class="col-sm-1 control-label">MASAJE</label>
						<div class="col-sm-3">
							<input type="checkbox" class="form-control" name="masaje" placeholder="cesarea" data-toggle="tooltip" data-placement="bottom" title="cesaria">
						</div>
						
							<label class="col-sm-1 control-label">US</label>
						<div class="col-sm-3">
							<input type="checkbox" class="form-control" name="us" placeholder="gesta" data-toggle="tooltip" data-placement="bottom" title="gesta">
						</div>

							<label class="col-sm-1 control-label">MAG</label>
						<div class="col-sm-3">
							<input type="checkbox" class="form-control" name="mag" placeholder="viven" data-toggle="tooltip" data-placement="bottom" title="viven">
						</div>

							<label class="col-sm-1 control-label">OTROS</label>
						<div class="col-sm-3">
							<input type="checkbox" class="form-control" name="otros" placeholder="cesarea" data-toggle="tooltip" data-placement="bottom" title="cesaria">
						</div>
						<br><br>
						<h3>Evolución</h3>

						<label class="col-sm-1 control-label">DESFAVORABLE</label>
						<div class="col-sm-3">
							<input type="checkbox" class="form-control" name="desf" placeholder="gesta" data-toggle="tooltip" data-placement="bottom" title="gesta">
						</div>

							<label class="col-sm-1 control-label">MANTIENE</label>
						<div class="col-sm-3">
							<input type="checkbox" class="form-control" name="man" placeholder="viven" data-toggle="tooltip" data-placement="bottom" title="viven">
						</div>

							<label class="col-sm-1 control-label">FAVORABLE</label>
						<div class="col-sm-3">
							<input type="checkbox" class="form-control" name="fav" placeholder="cesarea" data-toggle="tooltip" data-placement="bottom" title="cesaria">
						</div>
						 <br>
						
						<input type="submit" class="btn btn-primary" value="Guardar" onclick="form.submit()" >														
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
	$("#el2").select2();
	$("#el1").select2();
	$("#el3").select2();
	$("#el9").select2();
  $("#el5").select2();
  $("#el4").select2();
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