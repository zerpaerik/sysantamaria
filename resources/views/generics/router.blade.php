@extends('layouts.app')

@section('content')

<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-users"></i>
					<span><strong>Registros de ingresos/Gastos</strong></span>
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
				<div class="form-horizontal" role="form">
					{{ csrf_field() }}
					<div class="form-group">
						<div class="row">
							<div class="col-sm-3" style="margin-left: 15px;">
								<select id="sel-adm">
									<option value="0" selected disabled hidden> Seleccione </option>
									<option value="1">Atención</option>
									<option value="2">Consulta</option>
									<option value="3">Ventas</option>
									<option value="4">Punziones</option>
									<option value="5">Gastos</option>
								</select>
							</div>
						</div>
						<button id="btn-sbm" style="margin-left:15px; margin-top: 20px;" class="col-sm-2 btn btn-primary">ACEPTAR</button>

						<!--<a href="{{route('generics.router')}}" style="margin-left:15px; margin-top: 20px;" class="col-sm-2 btn btn-danger">Volver</a>-->
						<div class="col-xs-12">
							<div id="viewport" style="width:100%; padding: 10px;"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


@endsection

@section('scripts')

<script type="text/javascript">

function Select2Test(){
    $("#sel-adm").select2();
}
        $(document).ready( function() {
            LoadSelect2Script(Select2Test);
            $('#sel-adm').change( function() {
                var url;
                if($(this).val() == 1)
                {
                    url = 'atenciones-create';
                }else if($(this).val() == 2)
                {
                    url = 'consulta-create';
                }else if($(this).val() == 3)
                {
                    url = 'existencias-out';
                }else if($(this).val() == 4)
                {
                    url = 'punziones-create';
                }else if($(this).val() == 5){
                    url = 'gastos-create';
                }else {
                    url = window.location.href;
                }

                $('#btn-sbm').on('click', function(){
                    window.location = url;
                });
            });  
        });    

</script>

@endsection