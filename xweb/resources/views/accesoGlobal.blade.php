@extends("base")

@section("titulo")
{{session("entorno")->config->x_nomemp}} - {{T::tr('registro de usuario')}}
@endsection

@section("localizador")
<h1>
    Acceso global
    <small></small>
</h1>
@endsection

@section("dashboard")
@endsection

@section("central")
<FORM ACTION="{{URL::current()}}" METHOD="POST">
	<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
	<div class="form-group form-inline">
		<label for="buscar">{{T::tr('Buscar cliente')}}</label>
		<input autocomplete="new-password" type="text" value="{{$texto}}" class="form-control autoWidth" maxlength="25" name="textoG" id="textoG" placeholder="{{T::tr('Buscar')}}" value="{{$texto}}" style=""/>
		<label for="clave">{{T::tr('Clave de acceso')}}</label>
		<input autocomplete="new-password" type="password" value="{{$clave}}" class="form-control autoWidth" maxlength="25" name="claveG" id="claveG" placeholder="{{T::tr('Clave')}}" value="{{$clave}}" style=""/>
		<button type="submit" class="btn btn-primary" onclick="">{{T::tr('Buscar')}}</button>
	</div>
</form>
<table data-toggle="table">
	<thead>
		<tr>
			<th>{{T::tr('Código')}}</th>
			<th>{{T::tr('Cliente')}}</th>
			<th>{{T::tr('Acceso')}}</th>
		</tr>
	</thead>
	<tbody>
		@foreach($clientes as $dato)
		<tr>
			<td>{{$dato->ccodcl}}
			</td>
			<td>{{$dato->cnom}}
			</td>
			<td>
				<form action="{{URL::to('')}}" method="post" name="formsesG">
					<div class="form-group">
						<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
						<button type="submit"
							class="btn btn-success btn-sm"
							onclick="
								if(app.iniciosesionGlobal('{{URL::to('iniciosesion')}}',{{$dato->ccodcl}},'{{session("entorno")->config->x_clamaestra}}','{{URL::to('')}}')){
									return true;
								}else{
									//displayDivId('notificaciones');
									return false;
								}
								">{{T::tr('Entrar')}}</button>
					</div>
				</form>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>
@endsection
