<div class="row">
	<div class="col-xs-12 col-md-12">
		<form role="form" method="get" name="busqueda" action="{{URL::to('buscar').'/1'}}">
			<div class="row">
				<div class="col-xs-12 col-md-6">
					<div class="input-group ">
						<input type="text" class="form-control" placeholder="{{T::tr('Buscar texto')}}"
							aria-describedby="basic-addon1" id="busqueda_texto"
							name="busqueda_texto"
							value="{{session('articulo')->matBusquedas->texto}}">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-remove puntero"
							onclick="$('#busqueda_texto').val('');$('#busqueda_texto_2').val('');"></span></span></input>
					</div>
				</div>
			</div>
			<div class="row" style="margin-top:15px;">
				<div class="col-xs-6 col-md-3">
					<div>
						<select class="form-control" id="busqueda_marca"
							name="busqueda_marca">
							<option>{{T::tr('Marca')}}</option>
							@foreach(Session('articulo')->matMarcas as $mar)
							<option {{Session('articulo')->matBusquedas->marca==$mar->marca?"selected":""}}>{{$mar->marca}}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="col-xs-6 col-md-3">
					<div>
						<select class="form-control" id="busqueda_familia"
							name="busqueda_familia">
							<option value="0">Sección</option>
							@foreach(session('articulo')->matFamilias as $fae)
							    <option value="{{$fae->codigo}}"{{Session('articulo')->matBusquedas->familia==$fae->codigo?"selected":""}}>{{$fae->descripcion}}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="col-xs-6 col-md-3">
					<div>
						<select class="form-control" id="busqueda_tipo"
							name="busqueda_tipo">
							<option value="0">Tipo</option>
							@foreach(session('articulo')->matTipo as $fae)
							    <option value="{{$fae->codigo}}"{{Session('articulo')->matBusquedas->tipo==$fae->codigo?"selected":""}}>{{$fae->descripcion}}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="col-xs-6 col-md-3">
					<div>
						<select class="form-control" id="busqueda_tipo2"
							name="busqueda_tipo2">
							<option value="0">Tipo adicional</option>
							@foreach(session('articulo')->matTipo2 as $fae)
							    <option value="{{$fae->codigo}}"{{Session('articulo')->matBusquedas->tipo2==$fae->codigo?"selected":""}}>{{$fae->descripcion}}</option>
							@endforeach
						</select>
					</div>
				</div>






				<div class="col-xs-12 col-md-12" style="margin-top:15px;">
					<div>
						<button class="btn btn-default btn-xs " type="submit">
							<span class="glyphicon glyphicon-search"></span> {{T::tr('Buscar')}}</button>
						<button class="btn btn-default btn-xs"
							onclick="$('#busqueda_familia').prop('selectedIndex',0);
								$('#busqueda_marca').prop('selectedIndex',0);
								$('#busqueda_texto').val('');
								$('#busqueda_texto_2').val('');
								$('#busqueda_tipo').val('');
								$('#busqueda_tipo2').val('');
								return false;">
							<span class="glyphicon glyphicon-remove"></span> {{T::tr('Borrar')}}</button>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
<div class="boxSeparador">&nbsp;</div>