@extends('layouts.app')

@section('content')
</br>

<div class="row">
	<div class="col-xs-12">
		<div class="box">
		
			<div class="box-header">
				
				<div class="box-name">
					<i class="fa {{$icon}}"></i>
					<span><strong>{{ucfirst($model1)}}</strong></span>				
				</div>
				<div class="col-sm-3">
					<input type="date" id="input_date" class="form-control" placeholder="Fecha" name="date">
				</div>
				<div class="box-icons">
					<a class="collapse-link">
						<i class="fa fa-chevron-up"></i>
					</a>
					<a class="expand-link">
						<i class="fa fa-expand"></i>
					</a>
				</div>
			</div>
			<div class="box-content no-padding">
				<table class="table table-bordered table-striped table-hover table-heading table-datatable" id="datatable-1">
					<thead>
						<tr>
							@foreach($headers as $header)
								<th>{{$header}}</th>
							@endforeach
						</tr>
					</thead>
					<tbody>
						@foreach($data as $d)
						<tr>
							@foreach($fields as $f)
								<td>{{$d->$f}}</td>
							@endforeach						
							<td><a class="btn btn-primary" target="_blank" href="{{$model . '-ver-' .$d->id}}">Imprimir</a></td>
						</tr>
						@endforeach						
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@if(isset($created))
	<div class="alert alert-success" role="alert">
	  A simple success alert—check it out!
	</div>
@endif

<script type="text/javascript">
	$('#input_date').on('change', getAva);

	function del(id){
		$.ajax({
      url: "{{$model}}-delete-"+id,
      headers: {
    		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  		},
      type: "delete",
      dataType: "json",
      data: {},
      success: function(res){
      	location.reload(true);
      }
    });
	}

	function closeModal(){
		$('#myModal').modal('hide');
	}

	function openmodal(){
		$("#myModal").show();
	}

</script>

<div id="myModal" class="modal" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Confirmation</h4>
            </div>
            <div class="modal-body">
                <p>Modal Body</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" onclick="closeModal()" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

@endsection
