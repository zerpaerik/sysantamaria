@extends('layouts.app')

@section('content')
<br>
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-users"></i>
					<span><strong>Agregar Empresa</strong></span>
				</div>
				<div class="box-icons">
					<a class="collapse-link">
						<i class="fa fa-chevron-up"></i>
					</a>
					<a class="expand-link">
						<i class="fa fa-expand"></i>
					</a>
				</div>
				<div class="no-move"></div>
			</div>
			<div class="box-content">
				<h4 class="page-header"></h4>
				<form class="form-horizontal" role="form" method="post" action="empresas/create">
					{{ csrf_field() }}
					<div class="form-group">
						<label class="col-sm-1 control-label">Nombre</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="nombre" placeholder="Nombre" data-toggle="tooltip" data-placement="bottom" title="Nombres">
						</div>
						<label class="col-sm-1 control-label">Rif</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="rif" placeholder="Rif" data-toggle="tooltip" data-placement="bottom" title="Precio">
						</div>
						<label class="col-sm-1 control-label">Direcciòn</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="direccion" placeholder="direccion" data-toggle="tooltip" data-placement="bottom" title="Costo">
						</div>
						
						<label class="col-sm-1 control-label">Contacto</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="personacontacto" placeholder="Persona de contacto" data-toggle="tooltip" data-placement="bottom" title="Tiempo">
						</div>

						<label class="col-sm-1 control-label">Telefono</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="telefono" placeholder="Telefono de Contacto" data-toggle="tooltip" data-placement="bottom" title="telefono">
						</div>	

	
													
						<br>
						<input type="submit" style="margin-left:15px; margin-top: 20px;" class="col-sm-1 btn btn-primary" value="Agregar">

						<a href="{{route('empresas.index')}}" style="margin-left:15px; margin-top: 20px;" class="col-sm-1 btn btn-danger">Volver</a>
					</div>			
				</form>	
			</div>
		</div>
	</div>
</div>
@endsection