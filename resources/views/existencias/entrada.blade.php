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
					<span><strong>Entrada de productos</strong></span>
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
				<form class="form-horizontal" role="form" method="post" action="entrada">
						<div class="form-group">
						{{ csrf_field() }}

						<label class="col-sm-1 control-label">Producto</label>
						<div class="col-sm-3">
							<select id="prod" name="producto"  data-toggle="tooltip" data-placement="bottom">
								<option value="0">Seleccione un producto</option>
								@foreach($productos as $producto)
									<option value="{{$producto->id}}">{{$producto->nombre}} - {{$producto->codigo}}</option>
								@endforeach
							</select>
						</div>						

						<label class="col-sm-1 control-label">Proveed.</label>
						<div class="col-sm-3">
							<select id="provee" name="provee">
								@foreach($proveedores as $proveedor)
									<option value="{{$proveedor->id}}">{{$proveedor->codigo}} - {{$proveedor->nombre}}</option>
								@endforeach
							</select>
						</div>

						<label class="col-sm-1 control-label">Fact.</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="factura" id="factura" placeholder="Nº Factura" data-toggle="tooltip" data-placement="bottom" title="Cantidad" min="0" >
						</div>

						<label class="col-sm-1 control-label">Mont.Fact</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="monto" id="monto" placeholder="Monto Factura" data-toggle="tooltip" data-placement="bottom" title="Cantidad" min="0">
						</div>

						<label class="col-sm-1 control-label">Agreg.</label>
						<div class="col-sm-3">
							<input type="number" class="form-control" id="cantidadplus" name="cantidadplus" data-toggle="tooltip" data-placement="bottom" title="Cantidad" min="0" required="required">
						</div>

						<div class="col-sm-12" style="float:right;">
							<input type="submit" class="col-sm-2 btn btn-primary" value="Ejecutar" style="float:right;">
						</div>				

					</form>	
					</div>			
			</div>
		</div>
		<div class="alert alert-success invisible" id="successalrt" role="alert">Actualizado</div>
	</div>

	<table class="table">
		<thead>
			<tr>
				<th>Tipo</th>
				<th>Producto</th>
				<th>Cantidad</th>
			</tr>
		</thead>
		<tbody id="table-b">
		</tbody>
	</table>

<script type="text/javascript">

	window.onunload = clear;

	function clear(){
  	window.sessionStorage.clear();
	};

	function getQuan(evt){
		evt.preventDefault();
		var prod = $("#prod").val();
		if(prod < 1) return;

		$.ajax({
      url: "existencia/"+prod+"/"+$("#sede").val(),
      headers: {
    		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  		},
      type: "get",
      success: function(res){
      	if(res.exists){
      		$("#cantidad").val(res.existencia.cantidad);
      		$("#medida").val(res.medida);
      	}else{
      		$("#medida").val(res.medida);
      		$("#cantidad").val(0);
      	}
      }
    });
  }		

</script>



@endsection
@section('scripts')
<script>

	$("#prod").on('change', getQuan);
	$("#sede").on('change', getQuan);

	$("#updatepro").on('click', function(evt){
		evt.preventDefault();

		if($('#prod').val() < 1) return;

		var cs = window.sessionStorage.getItem("currentTime");
		if(!cs){
			cs = new Date().getTime();
			window.sessionStorage.setItem("currentTime", cs);
		}

		var d = {
			"code" :  cs,
			"proveedor" : $('#provee').val(),
			"id" : $('#prod').val(),
			"sede" : $("#sede").val(),
			"cantidadplus" : $('#cantidadplus').val()
		};

		$.ajax({
      url: "producto/",
      headers: {
    		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  		},
      type: "patch",
      data: d,
      success: function(res){
      	if(res.success){
					$( "#table-b" ).append("<tr><td>Entrada</td><td>"+$("#prod").val()+"</td><td>"+$('#cantidadplus').val()+"</td></tr>" );      		
			  	$('#cantidad').val(res.producto.cantidad);
			  	$('#cantidadplus').val(0);      				
      		$("#successalrt").toggleClass("invisible");
      		setTimeout(function(){
      			$("#successalrt").toggleClass("invisible");
      		}, 3000)
      	};
      }
    });
	});

	$(document).ready(function() {
		LoadSelect2Script(function (){
			$("#provee").select2();
			$("#sede").select2();
			$("#prod").select2();
		});
	});
</script>
@endsection