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


	<div class="" style="font-size: 40px; text-align: center;margin-bottom:-40px;margin-top: 2px;">
		<p><strong>SANTA MARÍA</strong></p>
	    <p><strong>TICKET: 0000{{ $ticket->id}}</strong></p>
	</div>

    <div class="" style="font-size: 40px; text-align: left;margin-bottom:-40px;">
    	@if($ticket->fecha_atencion == NULL)
		<p><strong>FECHA: {{ $ticket->created_at}}</strong></p>
		@else
	    <p><strong>FECHA: {{ $ticket->fecha_atencion}}</strong></p>
		@endif
	</div>

	<div class="" style="font-size: 40px; text-align: left;margin-bottom:-40px;">
		<p><strong>PACIENTE: {{ $ticket->nombres}},</strong></p>
		<p><strong>{{ $ticket->apellidos}}.</strong></p>
		<p><strong>DNI: {{ $ticket->dni}}</strong></p>
	</div>

	<div class="" style="font-size: 40px; text-align: left;margin-bottom:-40px;">
		<p><strong>DETALLE: {{ $ticket->detalle}}
		</strong></p>
	</div>
    
	<div class="" style="font-size: 40px; text-align: left;margin-bottom:-40px;">
	    	@if($ticket->fecha_atencion == NULL)
			<p><strong>ORIGEN: {{ $ticket->nompac}},</strong></p>
			<p><strong>{{ $ticket->apepac}}.</strong></p>
			@else
			<p><strong>ORIGEN: {{ $ticket->nomate}},</strong></p>
			<p><strong>{{ $ticket->apeate}}.</strong></p>
			@endif
	</div>

	<div class="" style="font-size: 40px; text-align: left;margin-bottom:-40px;">
		@if($ticket->monto == '99999')
		<p><strong>MONTO: 0</strong></p>
		@else
		<p><strong>MONTO: {{ $ticket->monto}}</strong></p>
		@endif
	</div>

	<div class="" style="font-size: 40px; text-align: left;margin-bottom:-40px;">
		<p><strong>PAGADO: {{ $ticket->abono}}</strong></p>
	</div>

	<div class="" style="font-size: 40px; text-align: left;">
		<p><strong>RESTA: {{ $ticket->pendiente}}</strong></p>
	</div>




</body>
</html>
