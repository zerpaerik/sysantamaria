<!DOCTYPE html>
<html lang="en">
<head>
	<title>Recibo de Cobro</title>

</head>
<body>
    
    <div class="" style="font-size: 35px; text-align: center; margin-bottom: -15px;">
		<img src="/var/www/html/sysantamaria/public/img/logo2.png" style="width: 30%;"/>
    </div>

    <div class="" style="font-size: 40px; text-align: center;margin-bottom: 60px;">
        <p><strong>SANTA MARIA FISIOCENTER</strong></p>
    </div>

    <div class="" style="font-size: 40px; text-align: left;margin-bottom: 60px;">
        <p><strong>RECIBO PAGO A CUENTA Nº: 0000{{$recibo->id}}</strong></p>
    </div>

    <div class="" style="font-size: 40px; text-align: left;margin-bottom: 60px;">
        <p><strong>FECHA: {{ $recibo->created_at}}</strong></p>
    </div>

    <div class="" style="font-size: 40px; text-align: left;margin-bottom: 60px;">
        <p><strong>PACIENTE: {{ $recibo->nombres}},{{ $recibo->apellidos}}</strong></p>
        <p><strong>DNI: {{ $recibo->dni}}</strong></p>
    </div>

    <div class="" style="font-size: 40px; text-align: left;margin-bottom: 60px;">
        <p><strong>MONTO TOTAL: {{ $recibo->monto}}</strong></p>
    </div>

    <div class="" style="font-size: 40px; text-align: left;margin-bottom: 60px;">
        <p><strong>MONTO ABONADO: {{ $recibo->abono_parcial}}</strong></p>
    </div>

    <div class="" style="font-size: 40px; text-align: left;margin-bottom: 40px;">
        <p><strong>MONTO TOTAL ABONADO: {{ $recibo->abono}}</strong></p>
    </div>

    <div class="" style="font-size: 40px; text-align: left;">
        <p><strong>RESTA: {{ $recibo->pendiente}}</strong></p>
    </div>
</body>
</html>