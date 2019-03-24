<style>
	.row{
		width: 1024px;
		margin: 0 auto;
	}

	.col-12{
		width: 100%;
	}
	
	.col-6{
		width: 49%;
		float: left;
		padding: 8px 5px;
		font-size: 18px;
	}

	.text-center{
		text-align: center;
	}
	
	.text-right{
		text-align: right;
	}

	.title-header{
		font-size: 22px; 
		text-transform: uppercase; 
		padding: 12px 0;
	}
	table{
		width: 100%;
		text-align: center;
		margin: 10px 0;
	}
	
	tr th{
		font-size: 14px;
		text-transform: uppercase;
		padding: 8px 5px;
	}

	tr td{
		font-size: 14px;
		padding: 8px 5px;
	}
</style>
		 <img src="/var/www/html/sysantamaria/public/img/logo2.png"  style="width: 20%;"/>

<div>
	<div class="text-center title-header col-12">
				<center><strong>REPORTE DE COMISIONES PAGADAS</strong> </center><
		<strong></strong> 
	</div>
</div>
<div>
	<div class="col-6">
		Fecha de Impresión: {{ Carbon\Carbon::now()->format('d/m/Y') }}
	</div>
	

</div>

<br>


<div style="margin-top:10px; background: #eaeaea;">
	<table style="">
		<tr>
			<th>RECIBO</th>
			<th">ORIGEN</th>
			<th>FECHA PAGO</th>
		    <th>COMISIÒN</th>
			
		</tr>
		@foreach ($pagadas as $atec)
			<tr>
				<td style="padding: 0;text-overflow: ellipsis;">{{$atec->recibo}}</td>
				<td style="padding: 0;text-overflow: ellipsis;text-align: left;">{{$atec->name}},{{$atec->lastname}}</td>
				<td style="padding: 0;text-overflow: ellipsis;">{{$atec->fecha_pago_comision}}</td>
				<td style="padding: 0;text-overflow: ellipsis;">{{$atec->totalrecibo}}</td>
			</tr>
		@endforeach
		<tr>
			<th>TOTAL PAGADO</th>
			<th>TOTAL SOBRES</th>
		</tr>
		<tr>
			<td>{{$atec->totalrecibo}}</td>
			<td>{{$sobres->total}}</td>
			
		</tr>
	</table>
</div>











