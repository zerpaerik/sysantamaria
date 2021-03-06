@extends('layouts.app')

@section('content')

<body>
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-linux"></i>
					<span><strong>Ingresos</strong></span>

				</div>


				<div class="box-icons">
					<a class="collapse-link">
						<i class="fa fa-chevron-up"></i>
					</a>
					<a class="expand-link">
						<i class="fa fa-expand"></i>
					</a>
					<a class="close-link">
						<i class="fa fa-times"></i>
					</a>
				</div>

				<div class="no-move"></div>
				
			</div>
					{!! Form::open(['method' => 'get', 'route' => ['movimientos.index']]) !!}

			<br>
			<div class="row">
				<div class="col-md-2">
					<label>Fecha Inicio</label>
					<input type="date" value="{{$fecha}}" name="fecha" style="line-height: 20px">
				</div>

				<div class="col-md-2">
					<label>Fecha Fin</label>
					<input type="date" value="{{$fecha2}}" name="fecha2" style="line-height: 20px">
				</div>

				<div class="col-md-4">
					<label>Tipo de Ingreso</label>
					<select name="tipo" id="tipo">
						<option value="" selected disabled hidden>Seleccione</option>
						<option value="1">Atenciones</option>
						<option value="2">Consultas</option>
						<option value="3">Ventas</option>
						<option value="4">Punziones</option>
					    <option value="5">Otros Ingresos</option>
					    <option value="6">Cuentas por Cobrar</option>

						
					</select>
					
				</div>
					
				<div class="col-md-4">
					{!! Form::submit(trans('Buscar'), array('class' => 'btn btn-info', 'style' => 'margin-top:25px; width:75px' )) !!}
					{!! Form::close() !!}

				</div>
			</div>
			<br>
			<hr class="page-header"></hr>	
		@if($tipo==1)

            <span><strong>ATENCIONES</strong></span>
            <div class="row">
            	<div class="col-md-2">
            		<strong>Total Abono:</strong>{{$totalatenciones->monto}}
            	</div>
            	
            </div>
			<div class="box-content no-padding">
				<table class="table table-bordered table-striped table-hover table-heading table-datatable" id="datatable-3">
					<thead>
						<tr>
							<th>Id</th>
							<th>Paciente</th>
							<th>Origen</th>
							<th>Registrado Por</th>
							<th>Detalle</th>
							<th>Monto</th>
							<th>Monto Abonado</th>
							<th>TipoPago</th>
							<th>Fecha</th>
							<th>Acciones</th>
					
						</tr>
					</thead>
					<tbody>
						<tr>
				           @foreach($atenciones as $d)

						<td>{{$d->id}}</td>
						<td>{{$d->apellidos}},{{$d->nombres}}</td>
						<td>{{$d->name}},{{$d->lastname}}</td>
						<td>{{$d->username}},{{$d->userlast}}</td>
						@if($d->es_servicio =='1')
						<td>{{$d->servicio}}</td>
						@elseif($d->es_laboratorio =='1')
						<td>{{$d->laboratorio}}</td>
						@else
						<td>{{$d->paquete}}</td>
						@endif
						<td>{{$d->monto}}</td>
						<td>{{$d->abono}}</td>
						<td>{{$d->tipopago}}</td>
						<td>{{date('d-m-Y H:i', strtotime($d->created_at))}}</td>
						<td>


                        <a href="#" class="btn btn-primary view" onclick="view(this)" data-id="{{$d->id}}">Ver Detalle</a>

						<a target="_blank" class="btn btn-primary" href="ticket-ver-{{$d->id}}">Ver Ticket</a>

					    @if(\Auth::user()->role_id <> 6)	

						<a  class="btn btn-success" href="atenciones-edit-{{$d->id}}">Editar</a>	

						<a class="btn btn-danger" href="atenciones-delete-{{$d->id}}">Eliminar</a>	

						@endif
							
						</td>
						
					</tr>
						@endforeach
                      
					</tbody>
					<tfoot>
						   <th>Id</th>
							<th>Paciente</th>
							<th>Origen</th>
							<th>Registrado Por</th>
							<th>Detalle</th>
							<th>Monto</th>
							<th>Monto Abonado</th>
							<th>Fecha</th>
							<th>Acciones</th>
							
					</tfoot>
				</table>
			</div>

		<br>
		@elseif($tipo==2)

		       <span><strong>CONSULTAS</strong></span>
		        <div class="row">
            	<div class="col-md-2">
            		<strong>Total:</strong>{{$totalconsultas->monto}}
            	</div>
            	
            </div>
				<div class="box-content no-padding">
				<table class="table table-bordered table-striped table-hover table-heading table-datatable" id="datatable-3">
					<thead>
						<tr>
							<th>Paciente</th>
							<th>Especialista</th>
							<th>Registrado Por</th>
							<th>Monto</th>
							<th>TipoPago</th>
							<th>Fecha</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody>
						@foreach($consultas as $d)
						<tr>
						<td>{{$d->apellidos}} {{$d->nombres}}</td>
						<td>{{$d->nombrePro}} {{$d->apellidoPro}}</td>
						<td>{{$d->username}},{{$d->userlast}}</td>
						<td>{{$d->monto}}.00</td>
						<td>{{$d->tipo_ingreso}}</td>
						<td>{{$d->date}}</td>
						<td>
						<a  class="btn btn-danger" href="event-{{$d->EventId}}">Cargar Historia</a>	

						<a target="_blank" class="btn btn-primary" href="consulta-ticket-ver-{{$d->EventId}}">Ver Ticket</a>
						@if(\Auth::user()->role_id <> 6 && \Auth::user()->role_id <> 7)							 



						<a class="btn btn-danger" href="consulta-delete-{{$d->EventId}}" onclick="return confirm('¿Desea Eliminar este registro?')">Eliminar</a>	

						@endif
							

						</td>
						
					</tr>
						@endforeach
		
                      
					</tbody>
					<tfoot>
						    <th>Paciente</th>
							<th>Especialista</th>
							<th>Registrado Por</th>
							<th>Monto</th>
							<th>Fecha</th>
							<th>Acciones</th>
					</tfoot>
				</table>
			</div>

			<br>
		 @elseif($tipo==3)

			 <span><strong>VENTAS</strong></span>
			   <div class="row">
            	<div class="col-md-2">
            		<strong>Total:</strong>{{$totalventas->monto}}
            	</div>
            	
            </div>
				<div class="box-content no-padding">
				<table class="table table-bordered table-striped table-hover table-heading table-datatable" id="datatable-3">
					<thead>
						<tr>
							<th>Nro</th>
							<th>Producto</th>
							<th>Cantidad</th>
							<th>Monto</th>
							<th>Usuario</th>
							<th>TipoPago</th>
						    <th>Fecha</th>
						    <th>Acciones</th>
						</tr>
					</thead>
					<tbody>
						@foreach($ventas as $atec)	

							<tr>
								<td>{{$atec->id}}</td>
								<td>{{$atec->nombre}}-<strong>Còdigo:</strong>{{$atec->codigo}}</td>
								<td>{{$atec->cantidad}}</td>
						        <td>{{$atec->monto}}</td>
								<td>{{$atec->name}},{{$atec->lastname}}</td>
								<td>{{$atec->tipo_ingreso}}</td>
								<td>{{$atec->created_at}}</td>
								<td>
							    @if(\Auth::user()->role_id <> 6 && \Auth::user()->role_id <> 7)							 
								<a href="ventas-delete-{{$atec->id}}" class="btn btn-danger"  onclick="return confirm('¿Desea Eliminar este registro?')">Eliminar</a>
							      @endif
							    <a target="_blank" href="ventas-ticket-{{$atec->id}}" class="btn btn-primary">Ticket</a>	
								</td>
							</tr>
						@endforeach
		
                      
					</tbody>
					<tfoot>
						  <th>Nro</th>
							<th>Producto</th>
							<th>Cantidad</th>
							<th>Monto</th>
							<th>Usuario</th>
						    <th>Fecha</th>
						    <th>Acciones</th>
					</tfoot>
				</table>
			</div>
					<br>
		@elseif($tipo==4)
			 <span><strong>PUNZIONES</strong></span>
			  <div class="row">
            	<div class="col-md-2">
            		<strong>Total:</strong>{{$totalpunziones->monto}}
            	</div>
            	
            </div>
				<div class="box-content no-padding">
				<table class="table table-bordered table-striped table-hover table-heading table-datatable" id="datatable-3">
					<thead>
						<tr>
							<th>Nro</th>
						    <th>Origen</th>
						    <th>Paciente</th>
							<th>Producto</th>
							<th>Cantidad</th>
							<th>Monto</th>
							<th>Registrado Por:</th>
						    <th>Fecha</th>
						    <th>Acciones</th>
						</tr>
					</thead>
					<tbody>
						@foreach($punziones as $atec)	

							<tr>
								<td>{{$atec->id}}</td>
								<td>{{$atec->nomper}},{{$atec->apeper}}</td>
								<td>{{$atec->nombres}},{{$atec->apellidos}}</td>
								<td>{{$atec->nombre}}</td>
								<td>{{$atec->cantidad}}</td>
						        <td>{{$atec->precio}}</td>
								<td>{{$atec->name}},{{$atec->lastname}}</td>
								<td>{{$atec->created_at}}</td>
								<td>
									 @if(\Auth::user()->role_id == 4)	
									<a href="punzion-delete-{{$atec->id_pun}}" class="btn btn-danger">Eliminar</a>
									@endif
									@if(\Auth::user()->role_id == 5)	
									<a href="punzion-delete-{{$atec->id_pun}}" class="btn btn-danger">Eliminar</a>
									@endif
									<a target="_blank" href="punzion-ticket-{{$atec->id_pun}}" class="btn btn-primary">Ticket</a>
								</td>
							</tr>
						@endforeach
		
                      
					</tbody>
					<tfoot>
						  <th>Nro</th>
						    <th>Origen</th>
						    <th>Paciente</th>
							<th>Producto</th>
							<th>Cantidad</th>
							<th>Monto</th>
							<th>Registrado Por:</th>
						    <th>Fecha</th>
						    <th>Acciones</th>
					</tfoot>
				</table>
			</div>
			<br>
	   @elseif($tipo==5)
			 <span><strong>OTROS INGRESOS</strong></span>
			  <div class="row">
            	<div class="col-md-2">
            		<strong>Total:</strong>{{$totalingresos->monto}}
            	</div>
            	
            </div>
				<div class="box-content no-padding">
				<table class="table table-bordered table-striped table-hover table-heading table-datatable" id="datatable-3">
					<thead>
						<tr>
							<th>Id</th>
							<th>Descripciòn</th>
							<th>Monto</th>
							<th>TipoPago</th>
							<th>Fecha</th>
							<th>Acciones:</th>
						</tr>
					</thead>
					<tbody>
						@foreach($ingresos as $d)
						<tr>
						<td>{{$d->id}}</td>
						<td>{{$d->descripcion}}</td>
						<td>{{$d->monto}}</td>
						<td>{{$d->tipo_ingreso}}</td>
						<td>{{$d->created_at}}</td>
						<td>

						@if(\Auth::user()->role_id <> 6)	


						<a  class="btn btn-success" href="ingresos-edit-{{$d->id}}">Editar</a>	

						<a  class="btn btn-danger" href="ingresos-delete-{{$d->id}}">Eliminar</a>	
							@endif

						</td>

				        @endforeach
		
                      
					</tbody>
					<tfoot>
						  <th>Id</th>
							<th>Descripciòn</th>
							<th>Monto</th>
							<th>Fecha</th>
							<th>Acciones:</th>
					</tfoot>
				</table>
			</div>
		@elseif($tipo==6)
			 <span><strong>CUENTAS POR COBRAR</strong></span>
			  <div class="row">
            	<div class="col-md-2">
            		<strong>Total:</strong>{{$totalcobros->monto}}
            	</div>
            	
            </div>
				<div class="box-content no-padding">
				<table class="table table-bordered table-striped table-hover table-heading table-datatable" id="datatable-3">
					<thead>
						<tr>
						    <th>Nº Atenciòn</th>
							<th>Paciente</th>
							<th>DNI</th>
							<th>Monto Total</th>
							<th>Monto Abonado</th>
							<th>Monto Total Abonado</th>
							<th>Monto Pendiente</th>
							<th>Fecha</th>
							@if(\Auth::user()->role_id <> 6)
							<th>Acciones</th>
							@endif
						</tr>
					</thead>
					<tbody>
							@foreach($cobros as $atec)	

							<tr>
								<td>{{$atec->id_atencion}}</td>
								<td>{{$atec->nombres}},{{$atec->apellidos}}</td>
								<td>{{$atec->dni}}</td>
								<td>{{$atec->monto}}</td>
								<td>{{$atec->abono_parcial}}</td>
								<td>{{$atec->abono}}</td>
								<td>{{$atec->pendiente}}</td>
								<td>{{$atec->updated_at}}</td>
								<td>
							     <a target="_blank" href="{{asset('recibo_cobro_ver')}}/{{$atec->id}}" class="btn btn-xs btn-primary">Recibo</a>
								@if(\Auth::user()->role_id <> 6)
														 
									<a class="btn btn-danger" href="historialcobros-delete-{{$atec->id_atencion}}"  onclick="return confirm('¿Desea Eliminar este registro?')">Eliminar</a>	
									
								</td>
								@endif
							</tr>
						@endforeach
                      
					</tbody>
					<tfoot>
						  <th>Nº Atenciòn</th>
							<th>Paciente</th>
							<th>DNI</th>
							<th>Monto Total</th>
							<th>Monto Abonado</th>
							<th>Monto Total Abonado</th>
							<th>Monto Pendiente</th>
							<th>Fecha</th>
							@if(\Auth::user()->role_id <> 6)
							<th>Acciones</th>
							@endif
					</tfoot>
				</table>
			</div>

		@else

		 <span><strong>ATENCIONES</strong></span>
		  <div class="row">
            	<div class="col-md-2">
            		<strong>Total Abono:</strong>{{$totalatenciones->monto}}
            	</div>
            	
            </div>
			<div class="box-content no-padding">
				<table class="table table-bordered table-striped table-hover table-heading table-datatable" id="datatable-3">
					<thead>
						<tr>
							<th>Id</th>
							<th>Paciente</th>
							<th>Origen</th>
							<th>Registrado Por</th>
							<th>Detalle</th>
							<th>Monto</th>
							<th>Monto Abonado</th>
							<th>TipoPago</th>
							<th>Fecha</th>
							<th>Acciones</th>
					
						</tr>
					</thead>
					<tbody>
						<tr>
				           @foreach($atenciones as $d)

						<td>{{$d->id}}</td>
						<td>{{$d->apellidos}},{{$d->nombres}}</td>
						<td>{{$d->name}},{{$d->lastname}}</td>
						<td>{{$d->username}},{{$d->userlast}}</td>
						@if($d->es_servicio =='1')
						<td>{{$d->servicio}}</td>
						@elseif($d->es_laboratorio =='1')
						<td>{{$d->laboratorio}}</td>
						@else
						<td>{{$d->paquete}}</td>
						@endif
						<td>{{$d->monto}}</td>
						<td>{{$d->abono}}</td>
						<td>{{$d->tipopago}}</td>
						<td>{{date('d-m-Y H:i', strtotime($d->created_at))}}</td>
						<td>

					    <a href="#" class="btn btn-primary view" onclick="view(this)" data-id="{{$d->id}}">Ver Detalle</a>
						<a target="_blank" class="btn btn-primary" href="ticket-ver-{{$d->id}}">Ver Ticket</a>

					    @if(\Auth::user()->role_id <> 6)	

						<a  class="btn btn-success" href="atenciones-edit-{{$d->id}}">Editar</a>	

						<a class="btn btn-danger" href="atenciones-delete-{{$d->id}}">Eliminar</a>	

						@endif
							
						</td>
						
					</tr>
						@endforeach
                      
					</tbody>
					<tfoot>
						   <th>Id</th>
							<th>Paciente</th>
							<th>Origen</th>
							<th>Registrado Por</th>
							<th>Detalle</th>
							<th>Monto</th>
							<th>Monto Abonado</th>
							<th>Fecha</th>
							<th>Acciones</th>
							
					</tfoot>
				</table>
			</div>

		<br>

		       <span><strong>CONSULTAS</strong></span>
		         <div class="row">
            	<div class="col-md-2">
            		<strong>Total:</strong>{{$totalconsultas->monto}}
            	</div>
            	
            </div>
				<div class="box-content no-padding">
				<table class="table table-bordered table-striped table-hover table-heading table-datatable" id="datatable-3">
					<thead>
						<tr>
							<th>Paciente</th>
							<th>Especialista</th>
							<th>Registrado Por</th>
							<th>Monto</th>
							<th>TipoPago</th>
							<th>Fecha</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody>
						@foreach($consultas as $d)
						<tr>
						<td>{{$d->apellidos}} {{$d->nombres}}</td>
						<td>{{$d->nombrePro}} {{$d->apellidoPro}}</td>
						<td>{{$d->username}},{{$d->userlast}}</td>
						<td>{{$d->monto}}.00</td>
					    <td>{{$d->tipo_ingreso}}</td>
						<td>{{$d->date}}</td>
						<td>
						<a  class="btn btn-danger" href="event-{{$d->EventId}}">Cargar Historia</a>	

						<a target="_blank" class="btn btn-primary" href="consulta-ticket-ver-{{$d->EventId}}">Ver Ticket</a>
						@if(\Auth::user()->role_id <> 6 && \Auth::user()->role_id <> 7)							 



						<a class="btn btn-danger" href="consulta-delete-{{$d->EventId}}" onclick="return confirm('¿Desea Eliminar este registro?')">Eliminar</a>	

						@endif
							

						</td>
						
					</tr>
						@endforeach
		
                      
					</tbody>
					<tfoot>
						    <th>Paciente</th>
							<th>Especialista</th>
							<th>Registrado Por</th>
							<th>Monto</th>
							<th>Fecha</th>
							<th>Acciones</th>
					</tfoot>
				</table>
			</div>

					<br>

			 <span><strong>VENTAS</strong></span>
			  <div class="row">
            	<div class="col-md-2">
            		<strong>Total:</strong>{{$totalventas->monto}}
            	</div>
            	
            </div>
				<div class="box-content no-padding">
				<table class="table table-bordered table-striped table-hover table-heading table-datatable" id="datatable-3">
					<thead>
						<tr>
							<th>Nro</th>
							<th>Producto</th>
							<th>Cantidad</th>
							<th>Monto</th>
							<th>Usuario</th>
							<th>TipoPago</th>
						    <th>Fecha</th>
						    <th>Acciones</th>
						</tr>
					</thead>
					<tbody>
						@foreach($ventas as $atec)	

							<tr>
								<td>{{$atec->id}}</td>
								<td>{{$atec->nombre}}-<strong>Còdigo:</strong>{{$atec->codigo}}</td>
								<td>{{$atec->cantidad}}</td>
						        <td>{{$atec->monto}}</td>
								<td>{{$atec->name}},{{$atec->lastname}}</td>
								<td>{{$atec->tipo_ingreso}}</td>
								<td>{{$atec->created_at}}</td>
								<td>
								 @if(\Auth::user()->role_id <> 6 && \Auth::user()->role_id <> 7)							 
								<a href="ventas-delete-{{$atec->id}}" class="btn btn-danger"  onclick="return confirm('¿Desea Eliminar este registro?')">Eliminar</a>
							      @endif
							     <a target="_blank" href="ventas-ticket-{{$atec->id}}" class="btn btn-primary">Ticket</a>	
								</td>
							</tr>
						@endforeach
		
                      
					</tbody>
					<tfoot>
						  <th>Nro</th>
							<th>Producto</th>
							<th>Cantidad</th>
							<th>Monto</th>
							<th>Usuario</th>
						    <th>Fecha</th>
						    <th>Acciones</th>
						    					</tfoot>
				</table>
			</div>
					<br>
			 <span><strong>PUNZIONES</strong></span>
			 <div class="row">
            	<div class="col-md-2">
            		<strong>Total:</strong>{{$totalpunziones->monto}}
            	</div>
            	
            </div>
				<div class="box-content no-padding">
				<table class="table table-bordered table-striped table-hover table-heading table-datatable" id="datatable-3">
					<thead>
						<tr>
							<th>Nro</th>
						    <th>Origen</th>
						    <th>Paciente</th>
							<th>Producto</th>
							<th>Cantidad</th>
							<th>Monto</th>
							<th>Registrado Por:</th>
							<th>TipoPago</th>
						    <th>Fecha</th>
						    <th>Acciones</th>
						</tr>
					</thead>
					<tbody>
						@foreach($punziones as $atec)	

							<tr>
								<td>{{$atec->id}}</td>
								<td>{{$atec->nomper}},{{$atec->apeper}}</td>
								<td>{{$atec->nombres}},{{$atec->apellidos}}</td>
								<td>{{$atec->nombre}}</td>
								<td>{{$atec->cantidad}}</td>
						        <td>{{$atec->precio}}</td>
								<td>{{$atec->name}},{{$atec->lastname}}</td>
								<td>{{$atec->tipo_ingreso}}</td>
								<td>{{$atec->created_at}}</td>
								<td>
								   @if(\Auth::user()->role_id == 4)	
									<a href="punzion-delete-{{$atec->id_pun}}" class="btn btn-danger">Eliminar</a>
									@endif
									@if(\Auth::user()->role_id == 5)	
									<a href="punzion-delete-{{$atec->id_pun}}" class="btn btn-danger">Eliminar</a>
									@endif
									<a target="_blank" href="punzion-ticket-{{$atec->id_pun}}" class="btn btn-primary">Ticket</a>
								</td>
							</tr>
						@endforeach
		
                      
					</tbody>
					<tfoot>
						  <th>Nro</th>
						    <th>Origen</th>
						    <th>Paciente</th>
							<th>Producto</th>
							<th>Cantidad</th>
							<th>Monto</th>
							<th>Registrado Por:</th>
						    <th>Fecha</th>
						    <th>Acciones</th>
					</tfoot>
				</table>
			</div>
			<br>
			 <span><strong>OTROS INGRESOS</strong></span>
			 <div class="row">
            	<div class="col-md-2">
            		<strong>Total:</strong>{{$totalingresos->monto}}
            	</div>
            	
            </div>
				<div class="box-content no-padding">
				<table class="table table-bordered table-striped table-hover table-heading table-datatable" id="datatable-3">
					<thead>
						<tr>
							<th>Id</th>
							<th>Descripciòn</th>
							<th>Monto</th>
							<th>TipoPago</th>
							<th>Fecha</th>
							<th>Acciones:</th>
						</tr>
					</thead>
					<tbody>
						@foreach($ingresos as $d)
						<tr>
						<td>{{$d->id}}</td>
						<td>{{$d->descripcion}}</td>
						<td>{{$d->monto}}</td>
						<td>{{$d->tipo_ingreso}}</td>
						<td>{{$d->created_at}}</td>
						<td>

																		    @if(\Auth::user()->role_id <> 6)	


						<a  class="btn btn-success" href="ingresos-edit-{{$d->id}}">Editar</a>	

						<a  class="btn btn-warning" href="ingresos-delete-{{$d->id}}">Eliminar</a>	
							@endif

						</td>

				        @endforeach
		
                      
					</tbody>
					<tfoot>
						  <th>Id</th>
							<th>Descripciòn</th>
							<th>Monto</th>
							<th>Fecha</th>
							<th>Acciones:</th>
					</tfoot>
				</table>
			</div>

		<span><strong>CUENTAS POR COBRAR</strong></span>
			  <div class="row">
            	<div class="col-md-2">
            		<strong>Total:</strong>{{$totalcobros->monto}}
            	</div>
            	
            </div>
				<div class="box-content no-padding">
				<table class="table table-bordered table-striped table-hover table-heading table-datatable" id="datatable-3">
					<thead>
						<tr>
						    <th>Nº Atenciòn</th>
							<th>Paciente</th>
							<th>DNI</th>
							<th>Monto Total</th>
							<th>Monto Abonado</th>
							<th>Monto Total Abonado</th>
							<th>Monto Pendiente</th>
							<th>Fecha</th>
							@if(\Auth::user()->role_id <> 6)
							<th>Acciones</th>
							@endif
						</tr>
					</thead>
					<tbody>
							@foreach($cobros as $atec)	

							<tr>
								<td>{{$atec->id_atencion}}</td>
								<td>{{$atec->nombres}},{{$atec->apellidos}}</td>
								<td>{{$atec->dni}}</td>
								<td>{{$atec->monto}}</td>
								<td>{{$atec->abono_parcial}}</td>
								<td>{{$atec->abono}}</td>
								<td>{{$atec->pendiente}}</td>
								<td>{{$atec->updated_at}}</td>
								<td>
							     <a target="_blank" href="{{asset('recibo_cobro_ver')}}/{{$atec->id}}" class="btn btn-xs btn-primary">Recibo</a>
								@if(\Auth::user()->role_id <> 6)
														 
									<a class="btn btn-danger" href="historialcobros-delete-{{$atec->id_atencion}}"  onclick="return confirm('¿Desea Eliminar este registro?')">Eliminar</a>	
									
								</td>
								@endif
							</tr>
						@endforeach
                      
					</tbody>
					<tfoot>
						  <th>Nº Atenciòn</th>
							<th>Paciente</th>
							<th>DNI</th>
							<th>Monto Total</th>
							<th>Monto Abonado</th>
							<th>Monto Total Abonado</th>
							<th>Monto Pendiente</th>
							<th>Fecha</th>
							@if(\Auth::user()->role_id <> 6)
							<th>Acciones</th>
							@endif
					</tfoot>
				</table>
			</div>


		@endif

		</div>
	</div>
</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel">Detalle de Atenciòn</h4>
              </div>
              <div class="modal-body"></div>
            </div>
          </div>
        </div>

</body>



@section('scripts')
<script type="text/javascript">
// Run Select2 on element
$(document).ready(function() {
      LoadTimePickerScript(DemoTimePicker);
      LoadSelect2Script(function (){
            $("#tipo").select2();
            $("#el1").select2();
            $("#el3").select2({disabled : true});
      });
      WinMove();
});

$('#input_date').on('change', getAva);
$('#el1').on('change', getAva);

function getAva (){
            var d = $('#input_date').val();
            var e = $("#el1").val();
            if(!d) return;
            $.ajax({
      url: "available-time/"+e+"/"+d,
      headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
      type: "get",
      success: function(res){
            $('#el3').find('option').remove().end();
            for(var i = 0; i < res.length; i++){
                              var newOption = new Option(res[i].start_time+"-"+res[i].end_time, res[i].id, false, false);
                              $('#el3').append(newOption).trigger('change');
            }
      }
    });     
}

function DemoTimePicker(){
      $('#input_date').datepicker({
      setDate: new Date(),
      minDate: 0});
}

function view(e){
        var id = $(e).attr('data-id');
        
        $.ajax({
            type: "GET",
            url: "/atenciones/view/"+id,
            success: function (data) {
                $(".modal-body").html(data);
                $('#myModal').modal('show');
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    };
</script>

<style type="text/css">
		.modal-backdrop.in {
		    filter: alpha(opacity=50);
		    opacity: 0;
		    z-index: 0;
		}

		.modal {
			top:35px;
		}
</style>
@endsection
@endsection
