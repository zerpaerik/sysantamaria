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

<div>
	<div class="text-center title-header col-12">
		<center><strong>HOJA DE EVALUACIÓN</strong> </center>
	</div>
</div>
<div>
	<div class="col-6">
		Fecha de Impresión: {{ Carbon\Carbon::now()->format('d/m/Y') }}
	</div>
	<div class="col-6 text-right">
		<strong>Paciente:</strong>{{$paciente->nombres}},{{$paciente->apellidos}}- DNI:{{$paciente->dni}}
	</div> 
</div>

@foreach($prenatal as $pre)					

<div style="font-weight: bold; font-size: 14px">
		FECHA DE EVALUACIÒN: {{$pre->created_at}}
</div>
<br>
<div style="font-weight: bold; font-size: 14px">
		PROCEDIMIENTO
</div>
<div style="background: #eaeaea;">
	<table>
		<tr>
			<th>CHC</th>
			<th>CF</th>
			<th>US</th>
			<th>ELECT</th>
			<th>LASER</th>
			<th>MAG</th>
			<th>EJ</th>
			<th>MASAJE</th>
			<th>OTROS</th>
		</tr>
			<tr>
				@if($pre->chc == 'on')
				<td>Si</td>
			    @else
		        <td>No</td>
			    @endif
				@if($pre->cf == 'on')
				<td>Si</td>
			    @else
		        <td>No</td>
			    @endif
				@if($pre->us == 'on')
				<td>Si</td>
			    @else
		        <td>No</td>
			    @endif
				@if($pre->elect == 'on')
				<td>Si</td>
			    @else
		        <td>No</td>
			    @endif
				@if($pre->laser == 'on')
				<td>Si</td>
			    @else
		        <td>No</td>
			    @endif
				@if($pre->mag == 'on')
				<td>Si</td>
			    @else
		        <td>No</td>
			    @endif
				@if($pre->ej == 'on')
				<td>Si</td>
			    @else
		        <td>No</td>
			    @endif
				@if($pre->masaje == 'on')
				<td>Si</td>
			    @else
		        <td>No</td>
			    @endif
				@if($pre->otros == 'on')
				<td>Si</td>
			    @else
		        <td>No</td>
			    @endif
			</tr>
	</table>
</div>

<div style="font-weight: bold; font-size: 14px">
		EVALUACIÓN
</div>
<div style="background: #eaeaea;">
	<table>
		<tr>
			<th>DESFAVORABLE</th>
			<th>SE MANTIENE</th>
			<th>FAVORABLE</th>
		</tr>
		<tr>
				@if($pre->desf == 'on')
				<td>Si</td>
			    @else
		        <td>No</td>
			    @endif
				@if($pre->man == 'on')
				<td>Si</td>
			    @else
		        <td>No</td>
			    @endif
				@if($pre->fav == 'on')
				<td>Si</td>
			    @else
		        <td>No</td>
			    @endif
			</tr>
	</table>
</div>
<div style="font-weight: bold; font-size: 14px">
		OBSERVACIÒN: {{$pre->observacion}}
</div>
@endforeach



