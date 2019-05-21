<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">					
					<span>
						<strong>Paciente:</strong> {{$atenciones->apellidos}} {{$atenciones->nombres}}
						<strong>Fecha:</strong> {{$atenciones->created_at}} 
					</span>
				</div>
			</div>
			<div class="box-content">
				<div class="row">
					<div class="col-sm-6">
						<strong>Origen:</strong> {{$atenciones->lastname}} {{$atenciones->name}} 		
					</div>
					<div class="col-sm-3">
						<strong>Monto:</strong> {{$atenciones->monto}}
					</div>
					<div class="col-sm-3">
						<strong>Abono:</strong> {{$atenciones->abono}}
					</div>

				</div>	
				<div class="row">
					<div class="col-sm-12">
						<strong>Detalle:</strong>
						@if($atenciones->es_servicio =='1')
						<td>{{$atenciones->servicio}}</td>
						@else
						<td>{{$atenciones->paquete}}</td>
						@endif
					</div>
					
				</div>
				<div class="row">
					<div class="col-sm-4">
						<strong>TipoFactura:</strong>{{$atenciones->tipo_factura}}
					</div>
					<div class="col-sm-4">
						<strong>Serie:</strong>{{$atenciones->numero_serie}}
					</div>
					<div class="col-sm-4">
						<strong>Numeraciòn:</strong>{{$atenciones->numero_factura}}
					</div>
					
				</div>	
				<div class="row">
					<div class="col-sm-12">
						<strong>Observaciòn:</strong>{{$atenciones->observacion}}
					</div>
					
					
				</div>			
					
			</div>
		</div>
	</div>
</div>
