@extends("base")

@section("titulo")
{{session("entorno")->config->x_nomemp}} - {{T::tr('cambio de clave')}}
@endsection

@section("dashboard")
	@if($exito==false)
      <div class="row ">
        <!-- ./col -->
        <div class="col-xs-12 alert alert-danger">
		{{$descripcion}}
        </div>
      </div>
	@endif
@endsection

@section("central")
<div id='xw_boxcentral' style="min-height:500px; padding-top: 0px; border-top: 8px #333 solid;">
	<div class="registroTxt" style="text-align: center;">{{T::tr('Cambio de clave de acceso')}}</div>
	<form class="" role="form" method="post" action="{{URL::current()}}"
		onsubmit="" id="formRegistro" name="formRegistro">
		<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
		<input type="hidden" name="codigo" value="{{$codigo}}" />

		<table class="tContacto tRegistro">
			<tr>
				<td>
					<input type="password" value="" class="form-control autoWidth" maxlength="15" name="clave1"
				id="clave1" placeholder="{{T::tr('Nueva clave de acceso')}}" />
				</td>
			</tr>
			<tr>
				<td>
					<input type="password" value="" class="form-control autoWidth" maxlength="15" name="clave2"
				id="clave2" placeholder="{{T::tr('Repetir clave')}}" />
				</td>
			</tr>
			<tr>
				<td>
					<button type="submit" class="enviadatos" v-on:click="">{{T::tr('Cambiar')}}</button>
				</td>
			</tr>
		</table>
	</form>
</div>
@endsection
