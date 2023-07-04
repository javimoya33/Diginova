@extends("base")

<!--@section("titulo")
{{session("entorno")->config->x_nomemp}} - {{T::tr('registro de usuario')}}
@endsection-->



@section("localizador")
@endsection

@section("dashboard")
	@if($exito==false)
      <div class="row ">
        <div class="col-xs-12 alert alert-danger">
        </div>
      </div>
	@endif
@endsection

@section("central")
<script src='https://www.google.com/recaptcha/api.js'></script>
<div id='xw_boxcentral' style="min-height:500px; padding-top: 0px; border-top: 8px #333 solid;">

		<img class="contactoImg" alt="Contacto" src="/xweb/public/images/foto_auricular-28.png" />

		<div class="registroTxt">
			Completa el formulario de registro<br />y aprovecha nuestras ofertas exclusivas para tiendas
		</div>

		<form @submit.prevent="app.registro()" class="" role="form" method="post" action="{{URL::to('')}}" name="formRegistro" id="formRegistro" autocomplete="off"> 
			<input type="hidden" id="_token" name="_token" value="{{{ csrf_token() }}}" />
			
			<div class="registroContTabs">
			<div class="registroT1">
				<table class="tContacto tRegistro">
					<tr>
						<td>
							<input type="text" value="" class="form-control autoWidth" maxlength="50" minlength="6"
										name="nombreUsuario" id="nombreUsuario" v-model="nombreUsuario"
										placeholder="{{T::tr('Nombre de Usuario')}}" />
						</td>

						<td>
							<input type="text" value="" class="form-control" maxlength="50" minlength="5"
										name="nombreCliente" id="nombreCliente" v-model="nombreCliente" placeholder="{{T::tr('Nombre y Apellidos')}}" />
						</td>
					</tr>

					<tr>
						<td>
							<input type="password" value="" class="form-control autoWidth" maxlength="15" minlength="6" name="clave1"
										id="clave1" v-model="clave1" placeholder="{{T::tr('Contraseña')}}" />
						</td>
					
						<td>
							<input type="password" value="" class="form-control autoWidth" maxlength="15" name="clave2"
										id="clave2" v-model="clave2" placeholder="{{T::tr('Repita la Contraseña')}}" /></td>
						</td>								
					</tr>

					<tr>
						<td>
							<input type="email" value="" class="form-control autoWidth" maxlength="52" name="eMail" v-model="eMail"
											id="eMail" placeholder="Email" />
						</td>
						<td>
							<input type="text" value="" class="form-control autoWidth" maxlength="20" name="dni" minlength="5"
											id="dni" v-model="dni" placeholder="NIF" />
						</td>
					</tr>

					<tr>
						<td colspan="2">
							<input type="text" value="" class="form-control" maxlength="50" name="direccion" id="direccion" v-model="direccion" minlength="15"
											placeholder="{{T::tr('Domicilio')}}" style="width: 97%;" />
						</td>
					</tr>
				</table>

				<table class="tContacto tRegistro tRegistro2">
					<tr>
						<td>
							<input type="text" value="" class="form-control autoWidth" maxlength="8" minlength="4"
											name="codigoPostal" id="codigoPostal" v-model="codigoPostal" placeholder="C.P." />
						</td>

						<td>
							<select id="provincia" name="provincia" v-model="provincia">
								<option value="-1" selected>{{T::tr('Provincia')}}</option>
								@foreach(Utils::matrizProvincias() as $mar)
									<option value="{{$mar['id']}}">{{$mar['nombre']}}</option>
								@endforeach
							</select>
						</td>

						<td>
							<input type="text" value="" class="form-control" maxlength="40" name="poblacion" id="poblacion" v-model="poblacion" minlength="3"
									placeholder="Población" />
						</td>
					</tr>
				</table>

				<table class="tContacto tRegistro tRegistro2">
					<tr>
						<td colspan="2">
							<input type="text" value="" class="form-control autoWidth" maxlength="20" name="telefono" v-model="telefono" minlength="6"
										id="telefono" placeholder="Teléfono" style="width: 97%;" />
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<!--<input type="text" value="" class="form-control autoWidth" maxlength="50" name="actividadCliente" v-model="actividadCliente" minlength="6"
										id="actividadCliente" placeholder="Actividad principal de la empresa" style="width: 97%;" />-->
										<input type="hidden" name="actividadCliente" value=" ">
						</td>
					</tr>
				</table>

			</div>

			<div class="registroT2">
				<table class="tContacto tRegistro tRegistro2 tRegObserv">
					<tr>
						<td colspan="2" style="font-size: 20pt; font-family: montserratlight;">
							Observaciones
						</td>
					</tr>

					<tr>
						<td colspan="2">
							<textarea class="form-control" rows="5" name="observaciones" id="observaciones" v-model="observaciones" placeholder="Puede indicar una dirección distinta de envío o cualquier cosa que necesite que sepamos de usted o su negocio"></textarea>
						</td>
					</tr>

					<tr>
						<td style="font-size: 9pt;" colspan="2">
							<input type="checkbox" id="acepto" onclick="">
								&nbsp;{{T::tr('He leído y estoy de acuerdo con las ')}}
								<a style="text-decoration: none; color: black;" target="_blank" href="/xweb/condiciones">Condiciones de uso</a> y la 
								<a style="text-decoration: none; color: black;" target="_blank" href="/xweb/avisolegal">Política de privacidad</a>
							</input>
						</td>
					</tr>

					<tr>
						<td style="font-size: 9pt;" colspan="2">
							<input type="checkbox" name="boletin" v-model="boletin" checked="checked">&nbsp;{{T::tr('Deseo recibir un boletín con ofertas y descuentos para mi tienda')}}
						</td>
					</tr>

					<tr>
						<td>
							<div class="g-recaptcha" data-sitekey="6LfL5BETAAAAAK7SPnbuVMByqEfDYDbKOvS25Qhl" data-callback="callback"></div>
						</td>
						<td style=" vertical-align: middle; padding-left: 30px;">
							<button type="submit" class="enviadatos" onclick="if(document.getElementById('acepto').checked==false) { alertify.alert('','{{T::tr('Acepte las Condiciones de uso y la Política de privacidad')}}'); return false;};">{{T::tr('Enviar')}}</button>
						</td>
					</tr>
				</table>
			</div>

			</div>
		</form>

		<br /><br /><br /><br /><br /><br />
	</div>
</form>
@endsection
