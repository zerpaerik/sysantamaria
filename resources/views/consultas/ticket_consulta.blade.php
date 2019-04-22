<style>
	.paciente {

margin-left: 100px;
margin-top: 45px;
margin-bottom: 2px;
}
.fecha {

margin-left: 100px;
margin-top:-30px;


}
.servicios {

margin-left: 50px;
margin-top:40px;

}
.analisis {

margin-left: 50px;
margin-top:-30px;

}

.acuenta {

margin-left: 50px;
margin-top:40px;
margin-bottom: 1px;

}

.pendiente {

margin-left: 180px;
margin-top:-50px;

}

.origen {

margin-left: 50px;
margin-top:-60px;

}

.total {

margin-left: 410px;
margin-top: -20px;
}
</style>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Ticket de Atención</title>
</head>
<body>

	<div class="" style="font-size: 35px; text-align: center; margin-bottom: -15px;">
		<img src="/var/www/html/sysantamaria/public/img/logo2.png" style="width: 30%;"/>
	</div>

	<div class="paciente">
			<p><strong>Paciente: {{$paciente->nombres}} {{$paciente->apellidos}}</strong></p>

		</div>

		<div class="fecha">
			<p><strong>Fecha de cita: {{ $paciente->date}}</strong></p>
		</div>
		<div class="servicios">
			<p><strong>Especialista: {{ $paciente->nombrePro}} {{ $paciente->apellidoPro}}</strong></p>
		</div>

		<div class="servicios">
			<p><strong>Especialista: {{ $paciente->nombreEval}}</strong></p>
		</div>
		
		<div class="total">
			<p><strong>Monto: {{ $paciente->monto}}</strong></p>
		</div>	
</body>
</html>
