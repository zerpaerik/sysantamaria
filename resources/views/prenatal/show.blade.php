@extends('layouts.app')

@section('content')


<div>
	<div class="text-center title-header col-12">
		<center><strong>HOJA DE EVALUACI?N</strong> </center>
	</div>
</div>

<div class="col-6 text-right">
		<strong>Paciente:</strong>{{$paciente->nombres}},{{$paciente->apellidos}}- DNI:{{$paciente->dni}}
	</div> 

@foreach($prenatal as $pre)					

<div style="font-weight: bold; font-size: 14px">
		FECHA: {{$pre->created_at}}
</div>
<br>
<div style="font-weight: bold; font-size: 14px">
		PROCEDIMIENTO
</div>
<div style="background: #eaeaea;">
	<table width="100%">
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
<br>
<div style="font-weight: bold; font-size: 14px">
		EVALUACI?N
</div>
<div style="background: #eaeaea;">
	<table width="100%">
		<tr>
			<th width="30%">DESFAVORABLE</th>
			<th width="30%">SE MANTIENE</th>
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
	<br>
</div>
@endforeach

@endsection



