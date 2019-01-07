<div class="col-sm-3">
	<select id="el1" name="distrito">
		@foreach($distritos as $pac)
		<option value="{{$pac->id}}">
			{{$pac->nombre}} 
		</option>
		@endforeach
	</select>
</div>

