@extends('layouts.app')

@section('content')
<br>
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-users"></i>
					<span><strong>Agregar Paciente</strong></span>
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
				<form class="form-horizontal" role="form" method="post" action="pacientes/create3">
					{{ csrf_field() }}
					<div class="form-group">
						<label class="col-sm-1 control-label">Nombres</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="nombres" placeholder="Nombres" data-toggle="tooltip" data-placement="bottom" title="Nombres">
						</div>
						<label class="col-sm-1 control-label">Apellidos</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="apellidos" placeholder="Apellidos" data-toggle="tooltip" data-placement="bottom" title="Apellidos">
						</div>
						<label class="col-sm-1 control-label">DNI</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="dni" placeholder="DNI" data-toggle="tooltip" data-placement="bottom" title="DNI">
						</div>
						<label class="col-sm-1 control-label">Telèfono</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="telefono" placeholder="Telèfono" data-toggle="tooltip" data-placement="bottom" title="Telèfono">
						</div>
						
						<label class="col-sm-1 control-label">Dirección</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="direccion" placeholder="Dirección" data-toggle="tooltip" data-placement="bottom" title="Dirección">
						</div>	
						
						<label class="col-sm-1 control-label">Referencia</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="Referencia" placeholder="Referencia" data-toggle="tooltip" data-placement="bottom" title="Referencia">
						</div>

						<label class="col-sm-1 control-label">Provincia</label>
						<div class="col-sm-3">

							<select id="pro" class="form-control" name="provincia">
							<option value="0">Seleccione</option>
							@foreach($provincias as $pro)
							<option value="{{$pro->id}}">{{$pro->nombre}}</option>
							@endforeach
						</select>
						</div>	

                         <label class="col-sm-1 control-label">Distritos</label>

						<div class="col-sm-3">
							  <div id="distbypro">
						</div>
					   </div>

					

						<label class="col-sm-1 control-label">Zonas</label>
						<div class="col-sm-3">

							<select id="pro" class="form-control" name="gradoinstruccion">
							<option value="0">Seleccione</option>
							@foreach($zonas as $pro)
							<option value="{{$pro->nombre}}">{{$pro->nombre}}</option>
							@endforeach
						</select>
						</div>	



						<label class="col-sm-1 control-label">Ocupaciòn</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="ocupacion" placeholder="ocupacion" data-toggle="tooltip" data-placement="bottom" title="ocupacion">
						</div>


						<label class="col-sm-1 control-label">Nacimiento</label>
						<div class="col-sm-3">
							<input type="date" class="form-control" name="fechanac" placeholder="fechanac" data-toggle="tooltip" data-placement="bottom" title="fechanac">
						</div>
                        <div class="row">
						<label class="col-sm-1 control-label">Convenio</label>
						<div class="col-sm-3">
							<select id="conv" name="convenio">
								    <option value="0">Seleccione</option>
									<option value="1">Si</option>
									<option value="2">No</option>
							</select>
						</div>
                       <label class="col-sm-1 control-label"></label>

						<div class="col-sm-3">
							  <div id="origen1">
						</div>
					   </div>

					   	<div class="col-sm-3">

							<select  class="form-control" name="sexo">
							<option value="0">Seleccione Sexo</option>
							<option value="M">Masculino</option>
						    <option value="F">Femenino</option>
						</select>
						</div>	

						

						<input type="submit" onclick="form.submit()"  style="margin-left:20px; margin-top: 20px;" class="col-sm-3 btn btn-primary" value="Agregar">

						<a href="{{route('pacientes.index')}}" style="margin-left:15px; margin-top: 20px;" class="col-sm-3 btn btn-danger">Volver</a>
					</div>			
				</form>	
			</div>
		</div>
	</div>
</div>
@section('scripts')

<script type="text/javascript">
      $(document).ready(function(){
        $('#conv').on('change',function(){
          var link;
          if ($(this).val() ==  1) {
            link = '/archivos/pacientes/empresas/';
          }else{
            link = '/archivos/pacientes/nada/';
          }

          $.ajax({
                 type: "get",
                 url:  link,
                 success: function(a) {
                    $('#origen1').html(a);
                 }
          });

        });
        

      });
       
    </script>


 <script type="text/javascript">
    $('#pro').on('change',function(){
      var id= $('#pro').val();
      var link= '/pacientes/distbypro/id';
      link= link.replace('id',id);
      $.ajax({
       type: "get",
       url: link ,
       success: function(a) {
        $('#distbypro').html(a);
    }
});

  });
</script>
    @endsection
@endsection