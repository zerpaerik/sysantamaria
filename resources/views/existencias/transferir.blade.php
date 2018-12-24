@extends('layouts.app')

@section('content')
<style type="text/css invisible">
	
		visibility: hidden;
	}
</style>

<br>
<div class="row">
	<div class="col-xs-12">
		<div class="box">

			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-users"></i>
					<span><strong>Transferir productos</strong></span>
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
				<form class="form-horizontal" role="form" method="post" action="transfer">
						<div class="form-group">
						{{ csrf_field() }}

						<label class="col-sm-1 control-label">Producto</label>
						<div class="col-sm-3">
							<select class="form-control" id="prod" name="producto"  data-toggle="tooltip" data-placement="bottom">
								<option value="0">Seleccione un producto</option>
								@foreach($productos as $producto)
									<option value="{{$producto->id}}">{{$producto->nombre}}</option>
								@endforeach
							</select>
						</div>						

						<label class="col-sm-1 control-label">Medida</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" id="medida" name="medida" data-toggle="tooltip" data-placement="bottom" title="Medida" disabled="disabled">
						</div>

						<label class="col-sm-1 control-label">Cant.Act</label>
						<div class="col-sm-3">
							<input type="number" class="form-control" name="cantidad" id="cantidad" placeholder="Cantidad actual" data-toggle="tooltip" data-placement="bottom" title="Cantidad" min="0" disabled="disabled">
						</div>

					

						<label class="col-sm-1 control-label">Salida</label>
						<div class="col-sm-3">
							<input type="number" class="form-control" id="cantidadplus" name="cantidadplus" data-toggle="tooltip" data-placement="bottom" title="Cantidad" required="required">
						</div>

						<div class="col-sm-12" style="float:right;">
							<input type="submit"  class="col-sm-2 btn btn-primary" value="Ejecutar" style="float:right;">
						</div>						

						<input type="hidden" name="id" id="idp">

					</form>	
					</div>			
			</div>
		</div>
	</div>



<script type="text/javascript">
	document.getElementById("prod").addEventListener('change', function(evt){
		var id = document.getElementById("prod").value;
		if(id < 1) return;
		$.ajax({
      url: "producto/"+id,
      headers: {
    		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  		},
      type: "get",
      success: function(res){
      	$('#medida').val(res.producto.medida);
      	$('#cantidad').val(res.producto.cantidad);
      	$("#cantidadplus").attr('max', res.producto.cantidad);
      	$('#idp').val(res.producto.id);
      }
    });
	});
</script>





@endsection