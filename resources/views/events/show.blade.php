@extends('layouts.app')
@section('content')
	<h2>CONSULTA {{$data->title}}</h2>
	<p>Paciente: {{$data->nombres}} {{$data->apellidos}} </p>
	<p>Doctor: {{$data->nombrePro}} {{$data->apellidoPro}}</p>
	<p>Fecha de cita: {{$data->date}}</p>
	<p>Hora: {{$data->start_time}} Hasta las {{$data->end_time}}</p>
    <p>Evaluaciòn: {{$data->evaluacion}}</p>
	<br>

	<h2>DATOS DE FILIACIÒN</h2>
	<p>Nombre: {{$data->nombres}} {{$data->apellidos}} </p>
	<p>DNI paciente: {{$data->dni}}</p>
	<p>Direccion del paciente: {{$data->direccion}}</p>
	<p>Telefono del paciente: {{$data->telefono}}</p>
	<p>Fecha de nacimiento: {{$data->fechanac}}</p>
	<p>Grado de isntruccion del paciente: {{$data->gradoinstruccion}}</p>
	<p>Ocupacion del paciente: {{$data->ocupacion}}</p>	
	<p>Edad del paciente: {{$edad}} años</p>	
	<br>	
	<br>
	<h2>Resultados anteriores de {{$data->nombres}} {{$data->apellidos}}</h2>
	@foreach($consultas as $consulta)
	<div class="rows">
		<div class="col-sm-12">
			<div class="rows">
				<br>
				<h3 class="col-sm-12"><strong>Consulta del {{$consulta->created_at}}</strong></h3>
				<br>
				<br>
				<p class="col-sm-6"><strong>Motivo de Consulta:</strong> {{ $consulta->motivo }}</p>
				<p class="col-sm-6"><strong>Causa Relacionada:</strong> {{ $consulta->causa }}</p>
				<p class="col-sm-6"><strong>Tiempo de Lesión:</strong> {{ $consulta->tiempo }}</p>
				<br>
				<p class="col-sm-6"><strong>Antecedentes.ENFERMEDADES:</strong> {{ $consulta->enf }}</p>
				<p class="col-sm-6"><strong>Antecedentes.OPERACIONES:</strong> {{ $consulta->fra }}</p>
				<p class="col-sm-6"><strong>Antecedentes.TRATAMIENTOS HABITUALES:</strong> {{ $consulta->ope }}</p>
				<p class="col-sm-6"><strong>Antecedentes.ALERGIAS:</strong> {{ $consulta->aler }}</p>
			    <p class="col-sm-6"><strong>Examen Fisico:</strong> Funciones Vitales</p>
			    <p class="col-sm-1"><strong>P/A:</strong> {{ $consulta->pa }}</p>
			    <p class="col-sm-1"><strong>FC:</strong> {{ $consulta->fc }}</p>
			    <p class="col-sm-1"><strong>FR:</strong> {{ $consulta->fr }}</p>
			    <p class="col-sm-1"><strong>SPO2:</strong> {{ $consulta->spo2 }}</p>
			    <p class="col-sm-1"><strong>Peso:</strong> {{ $consulta->peso }}</p>
			    <p class="col-sm-1"><strong>Talla:</strong>{{ $consulta->talla }}</p>
				<p class="col-sm-6"><strong>Examen General:</strong> {{ $consulta->exa }}</p>
				<p class="col-sm-6"><strong>Diag.Presuntivo:</strong> {{ $consulta->pres }}</p>
				<p class="col-sm-6"><strong>CIE-X:</strong> {{ $consulta->ciex }}</p>
				<p class="col-sm-12"><strong>Examenes Auxiliares:</strong> {{ $consulta->aux }}</p>
				<p class="col-sm-6"><strong>Diag.Definitivo:</strong> {{ $consulta->def }}</p>
			    <p class="col-sm-6"><strong>CIE-X:</strong> {{ $consulta->ciex2 }}</p>
				<p class="col-sm-6"><strong>Diag.Topogràfico:</strong> {{ $consulta->top }}</p>
				<p class="col-sm-6"><strong>Plan de Tratamiento:</strong> {{ $consulta->plan }}</p>
				<p class="col-sm-6"><strong>Nro Sesiones:</strong> {{ $consulta->ses }}</p>
				<p class="col-sm-6"><strong>Atentido Por:</strong> {{ $consulta->personal }}</p>



			</div>
		</div>

	</div>
	@endforeach				

	
	<div class="col-sm-12">
	<h3>REGISTRAR NUEVA HISTORIA</h3>
	    <br>
	<form action="observacion-create" method="post" class="form-horizontal">
		{{ csrf_field() }}
		<div class="form-group">
			<input type="hidden" name="paciente_id" value="{{$data->pacienteId}}">
			<input type="hidden" name="evento_id" value="{{$data->id}}">
           <div class="row">
            <label for="" class="col-sm-2 control-label">PARTE I - ANAMNESIS</label>
		  </div>

			<label for="" class="col-sm-2 control-label">a) Motivo de Consulta:</label>
			<div class="col-sm-10">
				<input type="text" name="motivo" class="form-control">
			</div>
			
			<label for="" class="col-sm-2 control-label">b) Causa Relacionada:</label>
			<div class="col-sm-10">	
				<input  class="form-control" type="text" name="causa">
			</div>
			
			<label for="" class="col-sm-2 control-label">c) Tiempo de Lesiòn:</label>
			<div class="col-sm-10">	
				<input   class="form-control" placeholder="" type="text" name="tiempo">
			</div>
			<br>
			<div class="row">
            <label for="" class="col-sm-2 control-label">PARTE II - ANTECEDENTES</label>
		    </div>
			
			<label for="" class="col-sm-2 control-label">a) Enfermedades:</label>
			<div class="col-sm-10">			
				<input  class="form-control" type="text" name="enf">
			</div>
			<label for="" class="col-sm-2 control-label">b) Operaciones:</label>
			<div class="col-sm-10">	
				<input   class="form-control" type="text" name="fra">
			</div>
			<label for="" class="col-sm-2 control-label">c) Trat.Habit:</label>
			<div class="col-sm-10">	
				<input   class="form-control" placeholder="Tratamientos Habituales" type="text" name="ope">
			</div>
			<label for="" class="col-sm-2 control-label">d) Alérg.Medic:</label>
			<div class="col-sm-10">	
				<input  class="form-control" placeholder="Alergias Medicamentosas" type="text" name="aler">
			</div>

			<div class="row">
            <label for="" class="col-sm-2 control-label">PARTE III - EXAMEN FISICO</label>
		    </div>
		    <div class="row">
		    <label for="" class="col-sm-2 control-label">a) Funciones Vitales</label>
		    </div>
             
             <label for="" class="col-sm-1 control-label">P/A</label>
			<div class="col-sm-1">	
				<input  class="form-control"  type="text" name="pa">
			</div>
			<label for="" class="col-sm-1 control-label">FC</label>
			<div class="col-sm-1">	
				<input  class="form-control" type="text" name="fc">
			</div>
			<label for="" class="col-sm-1 control-label">FR</label>
			<div class="col-sm-1">	
				<input  class="form-control"  type="text" name="fr">
			</div>
			<label for="" class="col-sm-1 control-label">SPO2</label>
			<div class="col-sm-1">	
				<input  class="form-control"  type="text" name="spo2">
			</div>
			<label for="" class="col-sm-1 control-label">Peso</label>
			<div class="col-sm-1">	
				<input  class="form-control" type="text" name="peso">
			</div>

			<label for="" class="col-sm-1 control-label">Talla</label>
			<div class="col-sm-1">	
				<input  class="form-control" type="text" name="talla">
			</div>
			
			<label for="" class="col-sm-2 control-label">b) Examen General</label>
			<div class="col-sm-10">	
				<textarea name="exa" cols="10" rows="10" class="form-control" ></textarea>
			</div>
			<br>
			
			<br>
            <div class="row">
			<label for="" class="col-sm-2 control-label">c) Diagnòstico Presuntivo</label>
			<div class="col-sm-4">	
				<input   class="form-control" placeholder="Diagnóstico Presuntivo" type="text" name="pres">
			</div>

			<label class="col-sm-1">CIE-X:</label>
			<div class="col-sm-4">
				<select id="el3" name="ciex">
					@foreach($ciex as $c)
					<option value="{{$c->codigo}}-{{$c->nombre}}">
						{{$c->codigo}}-{{$c->nombre}}
					</option>
					@endforeach
				</select>
			</div> 
			
			</div>
			<label for="" class="col-sm-2 control-label">d) Examenes Auxiliares</label>
			<div class="col-sm-10">	
				<textarea name="aux" cols="10" rows="10" class="form-control" ></textarea>
			</div>
			<br>
			<br>
            <div class="row">
			<label for="" class="col-sm-2 control-label">e) Diagnòstivo Definitivo</label>
			<div class="col-sm-4">	
				<input   class="form-control" placeholder="Diagnóstico Definitivo" type="text" name="def">
			</div>

			<label class="col-sm-1">CIE-X:</label>
			<div class="col-sm-4">
				<select id="el4" name="ciex2">
					@foreach($ciex as $c)
					<option value="{{$c->codigo}}-{{$c->nombre}}">
						{{$c->codigo}}-{{$c->nombre}}
					</option>
					@endforeach
				</select>
			</div> 
			
			</div>
			
			<label for="" class="col-sm-2 control-label">f) Diag.Topográfico:</label>
			<div class="col-sm-10">	
				<select id="el6" name="top">
					<option value="Cabeza">Cabeza</option>
					<option value="Cuello">Cuello</option>
					<option value="Hombro">Hombro</option>
					<option value="Codo">Codo</option>
					<option value="Muñeca">Muñeca</option>
					<option value="Mano">Mano</option>
					<option value="Espalda">Espalda</option>
					<option value="Cintura">Cintura</option>
					<option value="Cadera">Cadera</option>
					<option value="Rodilla">Rodilla</option>
					<option value="Pierna">Pierna</option>
					<option value="Tobillo">Tobillo</option>
					<option value="Pie">Pie</option>

				</select>
			</div>
			
				<label for="" class="col-sm-2 control-label">g) Plan.Tratamiento:</label>
			<div class="col-sm-10">	
				<input  class="form-control" placeholder="" type="text" name="plan">
			</div>
			<label for="" class="col-sm-2 control-label">h) Nro de Sesiones:</label>
			<div class="col-sm-10">	
				<input  class="form-control" placeholder="" type="text" name="ses">
			</div>
			
			<label class="col-sm-2">i) Atendido Por:</label>
			<div class="col-sm-10">
				<select id="el5" name="personal">
					@foreach($personal as $c)
					<option value="{{$c->name}}-{{$c->lastname}}">
						{{$c->name}}-{{$c->lastname}}
					</option>
					@endforeach
				</select>
			</div> 



			<label class="col-sm-1">Adjunto:</label>

				<div class="form-group row">
					<label for="form-1-1" class="col-md-12 control-label">
					</label>
					<div class="col-md-10">
						{{Form::file('informe', ["class"=>"form-control"])}}
					</div>
			</div>
			
            <div id="laboratorios" class="embed ">
            
                <!-- Form template-->
                <div id="laboratorios_template" class="template row">


                    </div>

                    <a id="laboratorios_remove_current" style="cursor: pointer;"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
                </div>
                <!-- /Form template-->
                
                <!-- No forms template -->
                <div id="laboratorios_noforms_template" class="noItems col-sm-12 text-center">Ningún laboratorios</div>
                <!-- /No forms template-->
                
                <!-- Controls -->
                <div id="laboratorios_controls" class="controls col-sm-11 col-sm-offset-1">
                    <div id="laboratorios_remove_last" class="btn form removeLast"><a><span><i class="fa fa-close-circle"></i> Eliminar ultimo</span></a></div>
                    <div id="laboratorios_remove_all" class="btn form removeAll"><a><span><i class="fa fa-close-circle"></i> Eliminar todos</span></a></div>
                </div>
                <!-- /Controls -->
                
            </div>
            <!-- /sheepIt Form --> 
						
					</div>
          <hr>

    
			
		
			<div class="col-sm-12">
				<input type="submit" value="Registrar" class="btn btn-success" class="form-control">
			</div>
		</div>
		</div>
	</form>
	</div>
</div>
@section('scripts')
<script src="{{ asset('plugins/sheepit/jquery.sheepItPlugin.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('plugins/jqNumber/jquery.number.min.js') }}" type="text/javascript"></script>

<script type="text/javascript">

  $(document).ready(function() {

    $(".monto").keyup(function(event) {
      var montoId = $(this).attr('id');
      var montoArr = montoId.split('_');
      var id = montoArr[1];
      var montoH = parseFloat($('#servicios_'+id+'_montoHidden').val());
      var monto = parseFloat($(this).val());
      $('#servicios_'+id+'_montoHidden').val(monto);
      calcular();
      calculo_general();
    });

    $(".montol").keyup(function(event) {
      var montoId = $(this).attr('id');
      var montoArr = montoId.split('_');
      var id = montoArr[1];
      var montoH = parseFloat($('#laboratorios_'+id+'_montoHidden').val());
      var monto = parseFloat($(this).val());
      $('#laboratorios_'+id+'_montoHidden').val(monto);
      calcular();
      calculo_general();
    });

    $(".abonoL, .abonoS").keyup(function(){
      var total = 0;
      var selectId = $(this).attr('id');
      var selectArr = selectId.split('_');
      
      if(selectArr[0] == 'servicios'){
          if(parseFloat($(this).val()) > parseFloat($("#servicios_"+selectArr[1]+"_monto").val())){
              alert('La cantidad insertada en abono es mayor al monto.');
              $(this).val('0.00');
              calculo_general();
          } else {
              calculo_general();
          }
      } else {
        if(parseFloat($(this).val()) > parseFloat($("#laboratorios_"+selectArr[1]+"_monto").val())){
              alert('La cantidad insertada en abono es mayor al monto.');
              $(this).val('0.00');
              calculo_general();
          } else {
              calculo_general();
          }
      }
    });

    var botonDisabled = true;

    // Main sheepIt form
    var phonesForm = $("#laboratorios").sheepIt({
        separator: '',
        allowRemoveCurrent: true,
        allowAdd: true,
        allowRemoveAll: true,
        allowRemoveLast: true,

        // Limits
        maxFormsCount: 10,
        minFormsCount: 1,
        iniFormsCount: 0,

        removeAllConfirmationMsg: 'Seguro que quieres eliminar todos?',
        
        afterRemoveCurrent: function(source, event){
          calcular();
          calculo_general();
        }
    });

 
    $(document).on('change', '.selectLab', function(){
      var labId = $(this).attr('id');
      var labArr = labId.split('_');
      var id = labArr[1];

      $.ajax({
         type: "GET",
         url:  "analisis/getAnalisi/"+$(this).val(),
         success: function(a) {
            $('#laboratorios_'+id+'_montoHidden').val(a.preciopublico);
            $('#laboratorios_'+id+'_monto').val(a.preciopublico);
            var total = parseFloat($('#total').val());
            $("#total").val(total + parseFloat(a.preciopublico));
            calcular();
            calculo_general();
         }
      });
    })
});


function calcular() {
  var total = 0;
      $(".monto").each(function(){
        total += parseFloat($(this).val());
      })

      $(".montol").each(function(){
        total += parseFloat($(this).val());
      })

      $("#total").val(total);
}

function calculo_general() {
  var total = 0;
  $(".abonoL").each(function(){
    total += parseFloat($(this).val());
  })

  $(".abonoS").each(function(){
    total += parseFloat($(this).val());
  })

  $("#total_a").val(total);
  $("#total_g").val(parseFloat($("#total").val()) - parseFloat(total));
}

// Run Select2 on element
function Select2Test(){
	$("#el2").select2();
	$("#el1").select2();
	$("#el3").select2();
  $("#el5").select2();
   $("#el6").select2();
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