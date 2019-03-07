@extends('layouts.app')
@section('content')
	<h3></h3>
	    <br>
	<form action="treatment/create" method="post" class="form-horizontal">
		{{ csrf_field() }}
		<div class="form-group">
			<input type="hidden" name="consulta_id" value="{{$consulta}}">
			<input type="hidden" name="evento_id" value="{{$evento}}">
			<input type="hidden" name="paciente" value="{{$paciente}}">
            <label class="col-sm-6"><strong>Ficha de Evaluacion Terapeutica</strong></label>
		
			
			<br>
			<br><br>

			<div class="row">
				<div class="col-md-1">
			<label class="col-sm-4 control-label">EVA</label>
						<div class="col-sm-6">
							<select class="form-control" name="eva_eval">
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
							<option value="7">7</option>
							<option value="8">8</option>
							<option value="9">9</option>
							<option value="10">10</option>

						</select>
						</div>	
					</div>

						<div class="col-md-3">
			<label class="col-sm-4 control-label">Frecuencia</label>
						<div class="col-sm-8">
							<select class="form-control" name="frecuencia_eval">
							<option value="1MHZ">1MHZ</option>
							<option value="3MHZ">3MHZ</option>
						
						</select>
						</div>	
					</div>

					<div class="col-md-3">
			<label class="col-sm-4 control-label">Exacervación</label>
						<div class="col-sm-8">
							<select class="form-control" name="exac_eval">
							<option value="Actividad">Actividad</option>
							<option value="Reposo">Reposo</option>

							<option value="Levantarse">Levantarse</option>
							<option value="Dia">Dia</option>
							<option value="Noche">Noche</option>

						
						</select>
						</div>	
					</div>

					<div class="col-md-3">
			<label class="col-sm-4 control-label">Forma de Inicio</label>
						<div class="col-sm-8">
							<select class="form-control" name="inicio_eval">
							<option value="Progesivo">Progesivo</option>
							<option value="Subito">Subito</option>
						</select>
						</div>

					</div>

					<div class="col-md-1">
					<input type="text" name="inicio_tiempo_eval" placeholder="Tiempo" style="max-width: 100px;">
					</div>

			</div> 

				<div class="row">
				<div class="col-md-3">
			<label class="col-sm-4 control-label">Intensidad</label>
						<div class="col-sm-6">
							<input type="text" name="intensidad" placeholder="Intensidad" style="max-width: 100px;">
						</div>	
					</div>

						<div class="col-md-3">
			<label class="col-sm-4 control-label"></label>
						<div class="col-sm-6">Tiempo
							<input type="text" name="tiempo" placeholder="Tiempo" style="max-width: 100px;">
						</div>	
					</div>

					<div class="col-md-3">
			<label class="col-sm-4 control-label">Ciclo</label>
						<div class="col-sm-8">
							<select  name="ciclo" multiple="" id="el3">
							<option value="Continuo">Continuo</option>
							<option value="50%">50%</option>
							<option value="20%">20%</option>
						    <option value="10%">10%</option>
		
						</select>
						</div>	
					</div>

					<div class="col-md-3">
			<label class="col-sm-4 control-label">Magneto</label>
						<div class="col-sm-8">
							<select  name="magneto" multiple="" id="el4">
							<option value="Vascularizacion">Vascularizacion</option>
							<option value="Inflamaciòn">Inflamaciòn</option>
						    <option value="Dolor">Dolor</option>
						    <option value="Regeneraciòn">Regeneraciòn</option>
						    <option value="ConsolidaHueso">ConsolidaHueso</option>
						</select>
						</div>	
					</div>

			</div> 

			<div class="row">
				<div class="col-md-2">
			<label class="col-sm-3 control-label">Dolor</label>
						<div class="col-sm-3">
							<select class="form-control" name="dolor_eval">
							<option value="Quemante">Quemante</option>
							<option value="Punzante">Punzante</option>
							<option value="Electrico">Electrico</option>

						</select>
						</div>	
					</div>

						<div class="col-md-3">
			<label class="col-sm-4 control-label">Retractación</label>
						<div class="col-sm-6">
							<select class="form-control" name="retraccion_eval">
							<option value="Fascia">Fascia</option>
							<option value="Muscular">Muscular</option>
						    <option value="Articular">Articular</option>

						
						</select>
						</div>	
					</div>

					<div class="col-md-3">
			<label class="col-sm-4 control-label">Parestesia</label>
						<div class="col-sm-6">
							<select class="form-control" name="parestecia_eval">
							<option value="Si">Si</option>
							<option value="No">No</option>
						</select>
						</div>	
					</div>

					<div class="col-md-3">
			<label class="col-sm-4 control-label">Hiperalgesia</label>
						<div class="col-sm-6">
							<select class="form-control" name="hiperalgesia_eval">
							<option value="Si">Si</option>
							<option value="No">No</option>
						</select>
						</div>

					</div>

					<div class="col-md-1">
					<input type="text" name="hiperalgesia_zona_eval" placeholder="Zona" style="max-width: 50px;">
					</div>

			</div> 
	

		<div class="row">
			<div class="col-md-4">

			<label class="col-sm-3">Limitacion</label>
			<div class="col-sm-6">
				<input type="text" name="limitacion_eval">
			</div>  
			</div>

						<div class="col-md-4">


			<label class="col-sm-3">Localizacion</label>
			<div class="col-sm-6">
				<input type="text" name="localizacion_eval">
			</div>  
			</div>

			<div class="col-md-4">

			<label class="col-sm-3">Irradiacion</label>
			<div class="col-sm-6">
                             <select class="form-control" name="irradiacion_eval">
							<option value="Si">Si</option>
							<option value="No">No</option>
						</select>			
					</div>  
			</div>

	</div>  
	      <div class="row">
	      				<div class="col-md-4">


			<label class="col-sm-3">Observacion</label>
			<div class="col-sm-6">
				<input type="text" name="observaciones_eval">
			</div> 
			</div> 
						<div class="col-md-4">


			<label class="col-sm-3">Diagnostico</label>
			<div class="col-sm-9">
				<select id="el1"  name="diagnostico_eval">
			    @foreach($ciex as $lab)
				<option value="{{$lab->codigo}}-{{$lab->nombre}}">{{$lab->codigo}}-{{$lab->nombre}}</option>
				@endforeach
			    </select>
			</div>  
			</div>
		</div>																				

			<h3 class="col-sm-12">Tratamiento</h3>
			<div class="row">

			<div class="col-md-4">

			<label class="col-sm-3">Tratamiento</label>
			<div class="col-sm-9">
				 <select class="form-control" name="tratamiento">
							<option value="CHc">CHC</option>
							<option value="CF">CF</option>
						    <option value="Tiempo">Tiempo</option>
						</select>	
			</div>
			</div>  

			<div class="col-md-4">

			
			<label class="col-sm-3">Ultrasonido</label>
			<div class="col-sm-9">
				 <select class="form-control" name="frecuencia_ultrasonido_trat">
							<option value="Frecuencia">Frecuencia</option>
							<option value="Intensidad">Intensidad</option>
						    <option value="Ciclo">Ciclo</option>
						     <option value="Ciclo">Tiempo</option>
						</select>	
			</div> 
			</div> 

				<div class="col-md-4">

			
			<label class="col-sm-3">Laser</label>
			<div class="col-sm-9">
				 <select class="form-control" name="dolor_laser_trat">
							<option value="Dolor">Dolor</option>
							<option value="Tenosinovitis">Tenosinovitis</option>
						    <option value="TensionRepetitiva">Tension Repetitiva</option>
						     <option value="Esguince">Esguince</option>
						</select>	
			</div> 
			</div> 
           </div>

           <div class="row">
           	<div class="col-md-4">


			<label class="col-sm-3">Corriente</label>
			<div class="col-sm-9">
				 <select class="form-control" name="rusa_corriente_trat">
							<option value="Rusa">Rusa</option>
							<option value="interferencial">interferencial</option>
						    <option value="alto vontaje">alto vontaje</option>
						     <option value="Tens">Tens</option>
						</select>	
			</div>
           		
           	</div>

           		<div class="col-md-4">

   
			<label class="col-sm-3">Estiramiento</label>
			<div class="col-sm-9">
				<input type="text" name="estiramiento_trat">
			</div>  
           		
           	</div>

           		<div class="col-md-4">


			<label class="col-sm-4">M.Terapeutico</label>
			<div class="col-sm-8">
				 <select  name="metodo[]" multiple="" id="el6">
							<option value="Klapp">Klapp</option>
							<option value="William">William</option>
						    <option value="Wilson">Wilson</option>
						     <option value="FNP">FNP</option>
						     <option value="Codman">Codman</option>
						     <option value="Burguer">Burguer</option>
						     <option value="KaltenBron">KaltenBron</option>
						     <option value="FNP">FNP</option>
						    <option value="Feldenkrais">Feldenkrais</option>
						</select>	
			</div>
           		
           	</div>
           	
           </div>

                  <div class="row">
           	<div class="col-md-4">


			<label class="col-sm-3">Fortalecimiento</label>
			<div class="col-sm-9">
				 <select name="fortale[]" multiple="" id="el2">
							<option value="Isomentrico">Isomentrico</option>
							<option value="Isotonico con carga">Isotonico con carga</option>
						    <option value="Sin carga">Sin carga</option>
						    <option value="Bozu">Bozu</option>
					        <option value="THERABAND">THERABAND</option>
						</select>	
			</div>
           		
           	</div>

           	 	<div class="col-md-4">


			<label class="col-sm-3">Reduccion Marcha</label>
			<div class="col-sm-9">
				 <select id="reduc"  class="form-control" name="rrrrr">
				 			<option value="">Seleccione</option>
							<option value="1">Si</option>
							<option value="2">No</option>
					
						</select>	
			</div>
           		
           	</div>

           	<div class="col-md-4">


			<label class="col-sm-3"></label>
			<div class="col-sm-9" id="origen1">
					
			</div>
           		
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
				<input onclick="form.submit()"  type="submit" value="Registrar" class="btn btn-success" class="form-control">
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

<script type="text/javascript">
      $(document).ready(function(){
        $('#reduc').on('change',function(){
          var link;
          if ($(this).val() ==  1) {
            link = '/events/si/';
          }else {
            link = '/events/no/';
          }

          $.ajax({
                 type: "get",
                 url:  link,
                 success: function(a) {
                    $('#origen1').html(a);
                 }
          });

        });
        

      });
       
    </script>


@endsection
@endsection