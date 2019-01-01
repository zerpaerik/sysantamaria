<label class="col-sm-5 control-label">Pacientes</label>
						<div class="col-sm-3">
							<select id="el1" name="origen_usuario">
								@foreach($convenio as $pac)
									<option value="{{$pac->id}}">
										{{$pac->name}} {{$pac->lastname}}-{{$pac->dni}}
									</option>
								@endforeach
							</select>
						</div>