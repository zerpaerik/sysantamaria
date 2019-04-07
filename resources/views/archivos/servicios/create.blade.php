@extends('layouts.app')

@section('content')
<br>
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-users"></i>
					<span><strong>Agregar Servicio</strong></span>
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
				<form class="form-horizontal" role="form" method="post" action="servicios/create">
					{{ csrf_field() }}
					<div class="form-group">
						<label class="col-sm-2 control-label">Detalle</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" name="detalle" placeholder="Detalle" data-toggle="tooltip" data-placement="bottom" title="Detalle">
						</div>
						<label class="col-sm-2 control-label">Precio</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" name="precio" placeholder="Precio Particular" data-toggle="tooltip" data-placement="bottom" title="Precio">
						</div>

						<label class="col-sm-2 control-label">Precio.Conv</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" name="precio1" placeholder="Precio Convenio" data-toggle="tooltip" data-placement="bottom" title="Precio">
						</div>

						<label class="col-sm-2 control-label">Precio.Otro</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" name="precio2" placeholder="Precio Otro" data-toggle="tooltip" data-placement="bottom" title="Precio">
						</div>

						<label class="col-sm-2 control-label">Porcentaje</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" name="porcentaje" placeholder="porcentaje" data-toggle="tooltip" data-placement="bottom" title="porcentaje">
						</div>
						
						<label class="col-sm-2 control-label">Personaje Personal</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" name="por_per" placeholder="porcentaje personal" data-toggle="tooltip" data-placement="bottom" title="porcentaje">
						</div>
						
				

						<br>
						<input onclick="form.submit()"  type="submit" style="margin-left:15px; margin-top: 20px;" class="col-sm-2 btn btn-primary" value="Agregar">

						<a href="{{route('servicios.index')}}" style="margin-left:15px; margin-top: 20px;" class="col-sm-2 btn btn-danger">Volver</a>
					</div>			
				</form>	
			</div>
		</div>
	</div>
</div>
@section('scripts')
<script src="{{ asset('plugins/sheepit/jquery.sheepItPlugin.min.js') }}" type="text/javascript"></script>

<script type="text/javascript">
  $(document).ready(function() {
	    // Main sheepIt form
	    var phonesForm = $("#materiales").sheepIt({
	        separator: '',
	        allowRemoveCurrent: true,
	        allowAdd: true,
	        allowRemoveAll: true,
	        allowRemoveLast: true,

	        // Limits
	        maxFormsCount: 10,
	        minFormsCount: 0,
	        iniFormsCount: 0,
	        removeAllConfirmationMsg: 'Seguro que quieres eliminar todos?'
	    });   
	});

</script>
@endsection
@endsection