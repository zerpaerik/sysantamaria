<div>
		<img src="/var/www/html/sysantamaria/public/img/logo2.png"  style="width: 20%;"/>

	<div class="text-center title-header col-12">
		<center><strong>HOJA DE EVALUACIÓN</strong> </center>
	</div>
</div>
<div>
	<div class="col-6">
		<strong>Fecha de Impresión: </strong>{{ Carbon\Carbon::now()->format('d/m/Y') }}
	</div>
	<div class="col-6 text-right">
		<strong>Paciente: </strong>{{$paciente->nombres}}, {{$paciente->apellidos}}- DNI:{{$paciente->dni}}
	</div> 
</div>


<div style="width: 100%;">
	<fieldset style="border: 1px solid #000; border-radius: 5px;">
		<div style="font-weight: bold; font-size: 14px">
			FECHA DE EVALUACIÒN: {{$prenatal->created_at}}
		</div>
		<br>

		<p style="text-align: left;"><strong>PROCEDIMIENTO: </strong>{{$prenatal->procedimiento}}</p>

		<p style="text-align: left;"><strong>EVOLUCIÓN: </strong>{{$prenatal->evolucion}}</p>

		<div style="font-weight: bold; font-size: 14px">
			OBSERVACIÓN: {{$prenatal->observacion}}
		<br>
		<br>
		</div>
	</fieldset>
</div>



