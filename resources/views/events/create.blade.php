@extends('layouts.app')
@section('content')
	<h3>REGISTRAR NUEVA HISTORIA</h3>
	    <br>
	<form action="treatment/create" method="post" class="form-horizontal">
		{{ csrf_field() }}
		<div class="form-group">
			<input type="hidden" name="consulta_id" value="{{$consulta}}">
			<input type="hidden" name="evento_id" value="{{$evento}}">
            <label class="col-sm-2">Ficha de Evaluacion Terapeutica</label>
			<div class="col-sm-10">
				<input type="radio" name="ficha_eval" value="Nuevo">Nuevo
				<input type="radio" name="ficha_eval" value="Reevaluacion">Reevaluacion
				<input type="radio" name="ficha_eval" value="Reingresante">Reingresante
			</div>  
			
			<br>
			<br><br>
			<label class="col-sm-2">Eva</label>
			<div class="col-sm-10">
				<input type="radio" name="eva_eval" value="Antes">Antes
				<input type="radio" name="eva_eval" value="Despues">Despues
			</div>  

			<br>
			<br>

			<label class="col-sm-2">Frecuencia</label>
			<div class="col-sm-10">
				<input type="radio" name="frecuencia_eval" value="Continuo">Continuo
				<input type="radio" name="frecuencia_eval" value="Intermitente">Intermitente 
			</div>  
			<br><br>

			<label class="col-sm-2">Exacervacion</label>
			<div class="col-sm-10">
				<input type="radio" name="exac_eval" value="Actividad">Actividad
				<input type="radio" name="exac_eval" value="Reposo">Reposo 
				<input type="radio" name="exac_eval" value="Levantarse">Levantarse
				<input type="radio" name="exac_eval" value="Dia">Dia 
				<input type="radio" name="exac_eval" value="Noche">Noche								
			</div>  
			<br><br>

			<label class="col-sm-2">Forma de inicio</label>
			<div class="col-sm-10">
				<input type="radio" name="inicio_eval" value="Progesivo">Progesivo
				<input type="radio" name="inicio_eval" value="Subito">Subito
				<input type="text" name="inicio_tiempo_eval">Tiempo  
			</div>  
			<br><br>	

			<label class="col-sm-2">Tipo de dolor</label>
			<div class="col-sm-10">
				<input type="radio" name="dolor_eval" value="Quemante">Quemante
				<input type="radio" name="dolor_eval" value="Punzante">Punzante 
				<input type="radio" name="dolor_eval" value="Electrico">Electrico
			</div>  
			<br><br>

			<label class="col-sm-2">Retraccion</label>
			<div class="col-sm-10">
				<input type="radio" name="retraccion_eval" value="Fascia">Fascia
				<input type="radio" name="retraccion_eval" value="Muscular">Muscular
				<input type="radio" name="retraccion_eval" value="Articular">Articular
			</div>  
			<br><br>	

			<label class="col-sm-2">Parestecia</label>
			<div class="col-sm-10">
				<input type="radio" name="parestecia_eval" value="Si">Si
				<input type="radio" name="parestecia_eval" value="No">No
			</div>  
			<br><br>

			<label class="col-sm-2">Hiperalgesia</label>
			<div class="col-sm-10">
				<input type="radio" name="hiperalgesia_eval" value="Si">Si
				<input type="radio" name="hiperalgesia_eval" value="No">No
				<input type="text" name="hiperalgesia_zona_eval">Zona
			</div>  
			<br><br>		

			<label class="col-sm-2">Limitacion</label>
			<div class="col-sm-10">
				<input type="text" name="limitacion_eval">
			</div>  
			<br><br>

			<label class="col-sm-2">Localizacion</label>
			<div class="col-sm-10">
				<input type="text" name="localizacion_eval">
			</div>  
			<br><br>	


			<label class="col-sm-2">Irradiacion</label>
			<div class="col-sm-10">
				<input type="radio" name="irradiacion_eval" value="Si">Si
				<input type="radio" name="irradiacion_eval" value="No">No
				<input type="text" name="irradiacion_zona_eval">Zona
			</div>  
			<br><br>

			<label class="col-sm-2">Observaciones</label>
			<div class="col-sm-10">
				<input type="text" name="observaciones_eval">
			</div>  
			<br><br>

			<label class="col-sm-2">Diagnostico</label>
			<div class="col-sm-10">
				<input type="text" name="diagnostico_eval">
			</div>  
			<br><br>																				

			<h3 class="col-sm-12">Tratamiento</h3>

			<label class="col-sm-2">CHC</label>
			<div class="col-sm-10">
				<input type="text" name="chc_trat">
			</div>  
			<br><br><br>


			<label class="col-sm-2">CF</label>
			<div class="col-sm-10">
				<input type="text" name="cf_trat">
			</div>  
			<br><br>


			<label class="col-sm-2">Tiempo </label>
			<div class="col-sm-10">
				<input type="text" name="tiempo_trat">
			</div>  
			<br><br><br>
			
			<label class="col-sm-2">Ultrasonido</label>
			<div class="col-sm-12">
				Frecuencia<input type="text" name="frecuencia_ultrasonido_trat">
				Intensidad<input type="text" name="intensidad_ultrasonido_trat">
				Ciclo<input type="text" name="ciclo_ultrasonido_trat">
				Tiempo<input type="text" name="tiempo_ultrasonido_trat">
			</div>  
			<br><br><br>

			<label class="col-sm-1">Laser</label>
			<div class="col-sm-12">
				Dolor<input type="text" name="dolor_laser_trat">
				Tenosinovitis<input type="text" name="tenosinovitis_laser_trat">
				Esguince<input type="text" name="esguince_laser_trat">
				Tension Repetitiva<input type="text" name="tension_laser_trat">
			</div>  
			<br><br><br>

			<label class="col-sm-2">Corriente</label>
			<div class="col-sm-12">
				Rusa<input type="text" name="rusa_corriente_trat">
				interferencial<input type="text" name="interferencial_corriente_trat">
				alto vontaje<input type="text" name="alto_corriente_trat">
				Tens<input type="text" name="tens_corriente_trat">
			</div>  
			<br><br><br>

			<label class="col-sm-1">Estiramiento </label>
			<div class="col-sm-11">
				<input type="text" name="estiramiento_trat">
			</div>  
			<br><br><br>

			<label class="col-sm-2">Metodo Terapeutico</label>
			<div class="col-sm-12">
				Klapp<input type="checkbox" name="klapp_metodo_trat">
				William<input type="checkbox" name="william_metodo_trat">
				Wilson<input type="checkbox" name="wilson_metodo_trat">
				FNP<input type="checkbox" name="fnp_metodo_trat">
				Codman<input type="checkbox" name="codman_metodo_trat">
				Burguer<input type="checkbox" name="burguer_metodo_trat">
				KaltenBron<input type="checkbox" name="kaltenbron_metodo_trat">
				Feldenkrais<input type="checkbox" name="feldenkrais_metodo_trat">				
			</div>  
			<br><br><br>	

			<label class="col-sm-2">Fortalecimiento</label>
			<div class="col-sm-12">
				Isomentrico<input type="checkbox" name="isometrico_fortalecimiento_trat">
				Isotonico con carga<input type="checkbox" name="isocarga_fortalecimiento_trat">
				Sin carga<input type="checkbox" name="nocarga_fortalecimiento_trat">
				Bozu<input type="checkbox" name="bozu_fortalecimiento_trat">
				THERABAND<input type="checkbox" name="theraband_fortalecimiento_trat">			
			</div>  
			<br><br><br>	

			<label class="col-sm-5">Reduccion de la marcha</label>
			<div class="col-sm-12">
				<input type="radio" name="reduccion_trat" value="Si">Si
				<input type="radio" name="reduccion_trat" value="No">No
			</div>  
			<div class="col-sm-12">
				Rolido<input type="checkbox" name="rolido_marcha_trat"><br>
				Sentado<input type="checkbox" name="sentado_marcha_trat"><br>
				Arrastre<input type="checkbox" name="arrastre_marcha_trat"><br>
				4 Puntos<input type="checkbox" name="puntos_marcha_trat"><br>
				Rodillas<input type="checkbox" name="rodillas_marcha_trat"><br>
				Bipedo<input type="checkbox" name="bipedo_marcha_trat"><br>
				Descarga de peso<input type="checkbox" name="descarga_marcha_trat"><br>
				Equilibrio<input type="checkbox" name="equilibrio_marcha_trat"><br>		
				Coordinacion<input type="checkbox" name="coordinacion_marcha_trat"><br>
				Disocion<input type="checkbox" name="disocion_marcha_trat"><br>								
			</div>  			
			<br><br>																
	
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