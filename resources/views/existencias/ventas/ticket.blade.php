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
	<title>Ticket de Venta</title>
</head>
<body>

	<div class="" style="font-size: 35px; text-align: center; margin-bottom: -15px;">
		<img src="/var/www/html/grupomastersalud/public/img/0.png"  style="width: 30%;"/>
	</div>

   <div class="" style="font-size: 40px; text-align: center;">
		<p><strong>SANTA MARÍA FISIOCENTER</strong></p>
	    <p><strong>TICKET: 0000{{$ventas->id}}</strong></p>
	</div>

    <div class="" style="font-size: 40px;">
		<p><strong>FECHA: {{ $ventas->created_at}}</strong></p>
	</div>

	<div class="" style="font-size: 40px;">
		<p><strong>PRODUCTO: {{ $ventas->nombre}}
		</strong></p>
	</div>

	<div class="" style="font-size: 40px;">
		<p><strong>CANTIDAD: {{ $ventas->cantidad}}
		</strong></p>
	</div>

	<div class="" style="font-size: 40px;">
		<p><strong>MONTO: {{ $ventas->monto}}</strong></p>
	</div>



	

	

	



</body>
</html>
