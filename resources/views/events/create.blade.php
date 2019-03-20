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
			<h4 class="page-header"></h4>
			<br><br>

			<div class="row">
				<div class="col-md-2">
			<label class="col-sm-2 control-label">EVA</label>
						<div class="col-sm-6">
							<select id="el18" name="eva_eval">
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

						<div class="col-md-3" style="margin-left: -80px;">
			<label class="col-sm-4 control-label">Frecuencia del dolor</label>
						<div class="col-sm-8">
							<!--cambio en los valores 1MHZ y 3MHZ-->
							<select id="el1" name="frecuencia_eval">
							<option value="" selected disabled hidden >Seleccione</option>
							<option value="continuo">Contínuo</option>
							<option value="intermitente">Intermitente</option>
						
						</select>
						</div>	
					</div>

					<div class="col-md-3" style="margin-left: -40px;">
			<label class="col-sm-4 control-label">Exacervación</label>
						<div class="col-sm-7" style=" margin-left: 10px;">
							<select id="el2" name="exac_eval[]" multiple="" placeholder="Seleccione">
							<option value="Actividad">Actividad</option>
							<option value="Reposo">Reposo</option>
							<option value="Dia">Dia</option>
							<option value="Noche">Noche</option>

						
						</select>
						</div>
							
					</div>
					<div class="col-md-1" style="margin-left: -45px;">
							<input type="text" name="actividad_exar" placeholder="Tipo de actividad" style="max-width: 110px;">
						</div>

					<div class="col-md-3" style="margin-left: 20px;">
					<label class="col-sm-3 control-label">Forma de Inicio</label>
						<div class="col-sm-8">
							<select id="el3" name="inicio_eval">
							<option value="" selected hidden disabled>Seleccione</option>
							<option value="Progesivo">Progesivo</option>
							<option value="Subito">Subito</option>
						</select>
						</div>

					</div>

					<div class="col-md-1" style="margin-left: -50px;">
					<input type="text" name="inicio_tiempo_eval" placeholder="Tiempo" style="max-width: 90px;">
					</div>

			</div> 

				<div class="row">
				<div class="col-md-3">
			<label class="col-sm-4 control-label">Intensidad</label>
						<div class="col-sm-6">
							<input type="text" name="intensidad" placeholder="Intensidad" style="max-width: 100px;">
						</div>	
					</div>

						<div class="col-md-3" style="margin-left: -75px;">
			<label class="col-sm-4 control-label">Tiempo</label>
						<div class="col-sm-6">
							<input type="text" name="tiempo" placeholder="Tiempo" style="max-width: 100px;">
						</div>	
					</div>

					<div class="col-md-3" style="margin-left: -65px;">
			<label class="col-sm-4 control-label">Ciclo</label>
						<div class="col-sm-8">
							<select  name="ciclo[]" multiple="" id="el4" placeholder="Seleccione">
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
							<select  name="magneto[]" multiple="" id="el5" placeholder="Seleccione">
							<option value="Vascularizacion">Vascularizacion</option>
							<option value="Inflamaciòn">Inflamaciòn</option>
						    <option value="Dolor">Dolor</option>
						    <option value="Regeneraciòn">Regeneraciòn</option>
						    <option value="ConsolidaHueso">ConsolidaHueso</option>
						</select>
						</div>	
					</div>

			</div> 
			<br>
			<div class="row">
				<div class="col-md-4">
			<label class="col-sm-3 control-label">Dolor</label>
						<div class="col-sm-3" style="margin-left: 5px;">
							<select id="el6" name="dolor_eval[]" multiple="" placeholder="Seleccione" style="width: 130px;">
							<option value="Quemante">Quemante</option>
							<option value="Punzante">Punzante</option>
							<option value="Electrico">Electrico</option>

						</select>
						</div>	
					</div>

						<div class="col-md-3">
			<label class="col-sm-4 control-label">Retractación</label>
						<div class="col-sm-6" style="margin-left: 10px;">
							<select id="el7" name="retraccion_eval[]" multiple="" placeholder="Seleccione">
							<option value="Fascia">Fascia</option>
							<option value="Muscular">Muscular</option>
						    <option value="Articular">Articular</option>

						
						</select>
						</div>	
					</div>

					<div class="col-md-3" style="margin-left: -50px;">
						<label class="col-sm-6 control-label">Dolor Neuro</label>
						<div class="col-sm-6">
							<!--nuevo name-->
							<select id="el8" name="dolor_neuro">
							<option value="" selected hidden disabled>Seleccione</option>
							<option value="Parestesia">Parestesia</option>
							<option value="Alodinia">Alodinia</option>
							<option value="Hiperolpesia">Hiperolpesia</option>
						</select>
						</div>	
					</div>

					<!--<div class="col-md-3" style="margin-left: -20px;">
			<label class="col-sm-4 control-label">Hiperalgesia</label>
						<div class="col-sm-6" style="margin-left: 5px;">
							<select id="el9" name="hiperalgesia_eval">
							<option value="Si">Si</option>
							<option value="No">No</option>
						</select>
						</div>

					</div>

					<div class="col-md-1" style="margin-left: -75px;">
					<input type="text" name="hiperalgesia_zona_eval" placeholder="Zona" style="max-width: 50px;">
					</div>-->

			</div> 
	
		<br>
		<div class="row">
			<div class="col-md-4">

				<label class="col-sm-3">Limitación</label>
				<div class="col-sm-6">
					<input type="text" name="limitacion_eval" placeholder="Limitación">
				</div>  
			</div>
				<div class="col-md-4">
				<label class="col-sm-3">Localización</label>
				<div class="col-sm-6" style="margin-left: 5px;">
					<input type="text" name="localizacion_eval" placeholder="Localización">
				</div>  
				</div>

			<div class="col-md-4">

			<label class="col-sm-3">Irradiación</label>
				<div class="col-sm-3">
                    <select id="el10" name="irradiacion_eval">
					<option value="Si">Si</option>
					<option value="No">No</option>
					</select>			
				</div>
			<!--nuevo name-->
			<div class="col-md-1">
				<input type="text" name="irradiacion_zona_eval" placeholder="Zona" style="max-width: 50px;">
			</div>  
			</div>


		</div>
		<br>  
	      <div class="row">
	      	<div class="col-md-4">


				<label class="col-sm-3">Observación</label>
					<div class="col-sm-6">
						<input type="text" name="observaciones_eval" placeholder="Observación">
					</div> 
			</div> 
			<div class="col-md-4">
				<label class="col-sm-3">Diagnostico</label>
				<div class="col-sm-9">
					<select id="el11"  name="diagnostico_zona_eval">
				    @foreach($ciex as $lab)
				    <option value="" selected hidden disabled>Seleccione</option>
					<option value="{{$lab->codigo}}-{{$lab->nombre}}">{{$lab->codigo}}-{{$lab->nombre}}</option>
					@endforeach
				    </select>
				</div>  
			</div>
			<!--nuevo name-->
			<div class="col-md-1">
				<input type="text" name="diagnostico_cie_eval" placeholder="CIE-X" style="max-width: 100px;">
			</div>
			</div>																				
			<h4 class="page-header"></h4>
			<h3 class="col-sm-12">Tratamiento</h3>
			<div class="row">
				<br>
				<br>
				<div class="col-md-4">
					<label class="col-sm-4">Compresas</label>
					<div class="col-sm-8">
						<select id="el12" name="trata_compresas">
							<option value="" selected hidden disabled>Seleccione</option>
							<option value="CHC">CHC</option>
							<option value="CF">CF</option>
						    <option value="Combinada">Combinada</option>
						</select>	
					</div>
				</div>
				<div class="col-md-3">
					<label class="col-sm-4 control-label">Tiempo</label>
					<div class="col-sm-8">
						<input type="text" name="tiempocompresa" placeholder="Tiempo">
					</div>	
				</div>
				<div class="col-md-3">
					<label class="col-sm-4">Laser</label>
					<div class="col-sm-8">
						<select id="el14" name="dolor_laser_trat">
							<option value="" selected hidden disabled>Seleccione</option>
							<option value="ControlDeDolor">Control de dolor</option>
							<option value="Esguince">Esguince</option>
						    <option value="TensionRepetitiva">Tension Repetitiva</option>
						    <option value="Tenosinovitis">Tenosinovitis</option>
							<option value="TendinitisAquilea">Tendinitis Aquilea</option>
							<option value="ArtritisReumatoidea">Tendinitis Reumatoidea</option>
						    <option value="FascetePlantar">Fascete Plantar</option>
						    <option value="Neuralgea">Neuralgea</option>
						    <option value="HombroConglado">Hombro Conglado</option>
						</select>	
					</div> 
				</div>
				<div class="col-md-3">
					<label class="col-sm-4 control-label">Tipo</label>
					<div class="col-sm-8">
						<!--nuevo name-->
						<select id="el23" name="tipo_dolor">
						<option value="" selected hidden disabled>Seleccione</option>
						<option value="Agudo">Agudo</option>
						<option value="Cronico">Crónico</option>
					</select>
					</div>	
				</div>  
			</div>
		<br>
		<div class="row">
			<div class="col-md-1">
				<label class="col-sm-1">Ultrasonido:</label>	
			</div>
			<div class="col-md-3">
				<label class="col-sm-4 control-label">Frecuencia</label>
				<div class="col-sm-6">
					<select id="el20" name="frecuencia_eval">
					<option value="" selected hidden disabled>Seleccione</option>
					<option value="1MHZ">1MHZ</option>
					<option value="3MHZ">3MHZ</option>
					</select>
				</div>	
			</div>
			<div class="col-md-3" style="max-width: 250px;">
				<label class="col-sm-4 control-label">Intensidad</label>
				<div class="col-sm-5">
					<select  name="intensidad_comp" id="el21">
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
						<option value="11">11</option>
						<option value="12">12</option>
						<option value="13">13</option>
						<option value="14">14</option>
						<option value="15">15</option>
						<option value="16">16</option>
						<option value="17">17</option>
						<option value="18">18</option>
						<option value="19">19</option>
						<option value="20">20</option>

				</select>
				</div>
			</div>
			<div class="col-md-3">
			<label class="col-sm-3 control-label">Ciclo</label>
				<div class="col-sm-8">
					<select id="el22" name="ciclo_eval">
					<option value="" selected hidden disabled>Seleccione</option>
					<option value="100%">100%</option>
					<option value="50%">50%</option>
					<option value="20%">20%</option>
					<option value="10%">10%</option>
					</select>
				</div>	
			</div>
			<div class="col-md-2">
				<label class="col-sm-4 control-label">Tiempo</label>
				<div class="col-sm-6">
					<input type="text" name="tiempo" placeholder="Tiempo" style="max-width: 70px;">
				</div>	
			</div>

		</div>

           <div class="row">
           	<br>
           	<div class="col-md-4">
			<label class="col-sm-3">Corriente</label>
			<div class="col-sm-9">
				<select id="el15" name="rusa_corriente_trat[]" multiple="" placeholder="Seleccione">
					<option value="Rusa">Rusa</option>
					<option value="interferencial">interferencial</option>
				    <option value="alto vontaje">alto vontaje</option>
				    <option value="Tens">Tens</option>
				</select>	
			</div>
           		
           	</div>

           		<div class="col-md-4">

   
			<label class="col-sm-3" style="margin-right: 5px; ">Estiramiento</label>
			<div class="col-sm-8">
				<input type="text" name="estiramiento_trat" placeholder="Estiramiento">
			</div>  
           		
           	</div>

           		<div class="col-md-4">


			<label class="col-sm-4">M.Terapeutico</label>
			<div class="col-sm-8">
				 <select  name="metodo[]" multiple="" id="el16" placeholder="Seleccione">
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
           	<br>
           	<div class="col-md-4">


			<label class="col-sm-3">Fortalecimiento</label>
			<div class="col-sm-9">
				 <select name="fortale[]" multiple="" id="el17" placeholder="Seleccione uno o más">
							<option value="Isomentrico">Isomentrico</option>
							<option value="Isotonico con carga">Isotonico con carga</option>
						    <option value="Sin carga">Sin carga</option>
						    <option value="Bozu">Bozu</option>
					        <option value="THERABAND">THERABAND</option>
						</select>	
			</div>
           		
           	</div>

           	<div class="col-md-4">
			<label class="col-sm-3">Reduccion de la Marcha</label>
			<div class="col-sm-9">
		 		<select id="reduc" name="reduc[]" multiple="" placeholder="Seleccione uno o más">
					<option value="Rolido">Rolido</option>
					<option value="Sentado">Sentado</option>
					<option value="Arrastre">Arrastre</option>
					<option value="4P">4puntos</option>
					<option value="Rodillas">Rodillas</option>
					<option value="Bipedo">Bipedo</option>
					<option value="Descarga ">Descarga </option>
					<option value="Equilibrio">Equilibrio</option>
					<option value="Coordinacion">Coordinacion</option>
					<option value="Disocion">Disocion</option>
				</select>	
			</div>
           		
           	</div>

           	<div class="col-md-4">
				<label class="col-sm-3">Ejercicios de Propiocepción</label>
					<div class="col-sm-9">
				 		<select id="redux" name="ejercicios">
				 			<option value="" selected hidden disabled>Seleccione</option>
							<option value="Bozu">Bozu</option>
							<option value="Disco">Disco propedeutico</option>
						</select>	
					</div>
           		
           	</div>

           </div>
			</div>
			<br>
			<!-- BOTÓN REGISTRAR-->
			<div class="col-sm-12">
				<input onclick="form.submit()"  type="submit" value="Registrar" class="btn btn-success" class="form-control">
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
          <!--AQUÍ ESTABA EL BOTÓN REGISTRAR-->
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
 	$("#el4").select2();
    $("#el5").select2();
  	$("#el6").select2();
  	$("#el7").select2();
	$("#el8").select2();
	$("#el9").select2();
  	$("#el10").select2();
   	$("#el11").select2();
 	$("#el12").select2();
  	$("#el13").select2();
	$("#el14").select2();
	$("#el15").select2();
  	$("#el16").select2();
   	$("#el17").select2();
 	$("#el18").select2();
   	$("#el19").select2();
   	$("#el20").select2();
 	$("#el21").select2();
  	$("#el22").select2();
	$("#el23").select2();
	$("#el24").select2();
  	$("#el25").select2();
   	$("#el26").select2();
 	$("#el27").select2();
 	$("#reduc").select2();
 	$("#redux").select2();
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

<!--<script type="text/javascript">
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
                    $("#redux").select2();
                 }
          });

        });
        
    </script>-->


@endsection
@endsection