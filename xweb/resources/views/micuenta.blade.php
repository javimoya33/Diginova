@extends("base")

@section("titulo")
{{session("entorno")->config->x_nomemp}} - Área de cliente
@endsection

@section("localizador")
<div class="informTit" style="margin: 0 auto; padding: 20px 0px; text-align: center; width: 1240px; margin: 0px auto;">
	@if($seccion=='')
	{{T::tr('Área de cliente')}}
	@endif

	@if($seccion == 'pedidos')
		<button class="btnSolicitarMayor btnAtras" style="position: absolute; margin-left: -427px;">
			<a href="/xweb/micuenta" style="color: #fff;">
				<i class="fa fa-chevron-left" aria-hidden="true"></i> Atrás
			</a>
		</button>
	@endif
 
	@if($seccion == 'facturas')
		<button class="btnSolicitarMayor btnAtras" style="position: absolute; margin-left: -548px;">
			<a href="/xweb/micuenta" style="color: #fff;">
				<i class="fa fa-chevron-left" aria-hidden="true"></i> Atrás
			</a>
		</button>
	@endif

	@if($seccion == 'pendiente')
		<button class="btnSolicitarMayor btnAtras" style="position: absolute; margin-left: -410px;">
			<a href="/xweb/micuenta" style="color: #fff;">
				<i class="fa fa-chevron-left" aria-hidden="true"></i> Atrás
			</a>
		</button>
	@endif

	@if($seccion == 'modelo347')
		<button class="btnSolicitarMayor btnAtras" style="position: absolute; margin-left: -343px;">
			<a href="/xweb/micuenta" style="color: #fff;">
				<i class="fa fa-chevron-left" aria-hidden="true"></i> Atrás
			</a>
		</button>
	@endif

	@if($seccion == 'datos')
		<button class="btnSolicitarMayor btnAtras" style="float: left; margin-top: 5px;">
			<a href="/xweb/micuenta" style="color: #fff;">
				<i class="fa fa-chevron-left" aria-hidden="true"></i> Atrás
			</a>
		</button>
	@endif

	@if($seccion == 'presupuestos')
		<button class="btnSolicitarMayor btnAtras" style="float: left; margin-top: 5px;">
			<a href="/xweb/micuenta" style="color: #fff;">
				<i class="fa fa-chevron-left" aria-hidden="true"></i> Atrás
			</a>
		</button>
	@endif

	@if($seccion=='datos')
		<div class="titulo_tr" style="margin-top: 5px; margin-bottom: 10px; text-align: left; width: 1010px;">
			<span style="font-family: gothamultra;">Configuración de la cuenta</span>
		</div>
	@endif

	@if($seccion=='direcciones')
		<button class="btnSolicitarMayor btnAtras" style="position: absolute; margin-left: -116px; margin-top: 6px;">
			<a href="/xweb/micuenta" style="color: #fff;">
				<i class="fa fa-chevron-left" aria-hidden="true"></i> Atrás
			</a>
		</button>
		<div class="titulo_tr" style="margin-top: 5px; margin-bottom: 10px; text-align: left; width: 1010px; padding: 5px 0px;">
			<span style="font-family: gothamultra;">Mis direcciones de envío</span>
		</div>
	@endif


	@if($seccion=='envios')
	{{T::tr('Listado de envíos')}}
	@endif
	@if($seccion=='direcciones')
	<!--{{T::tr('Editar dirección')}}-->
	@endif
	@if($seccion=='tarifas')
	{{T::tr('descarga de tarifas')}}
	@endif
	@if($seccion=='modelo347')
	<div class="titulo_tr" style="margin-top: 5px;margin-bottom: 10px;">
		<span style="font-family: gothamultra;">Datos contables</span>
	</div>
	<input type="hidden" name="_token" id="_token" value="{{{ csrf_token() }}}" />
	<button onclick="envioMailSolicitudMayor(<?php echo session('usuario')->uData->codigo ?>, '<?php echo session('usuario')->uData->cnom ?>', this)" class="btnSolicitarMayor" style="position: absolute; margin-left: 85px;">Solicitar mayor de mi cuenta</button>
	@endif
	@if($seccion=='pendiente')
		<div class="titulo_tr" style="margin-top: 5px;margin-bottom: 10px;">
			<span style="font-family: gothamultra;">Recibos</span>
		</div>
	@endif
	@if($seccion=='presupuestos'||$seccion=='pedidos'||$seccion=='albaranes'||$seccion=='facturas'||$seccion=='rma')
		<span style="text-transform: capitalize; font-family: gothamultra;">{{$seccion}}</span>
	@endif
</div>
@endsection

@section("dashboard")
@endsection

@section("central")
<!-- datos de mi cuenta -->
<!-- datos de mi cuenta -->
<!-- datos de mi cuenta -->
@if($seccion=="datos")
<?php
	$desactivar="disabled";
	$desactivar="";
?>

<div id="anadirDireccionUsuario" class="anadirDireccionUsuario">
	<div class="anadirDireccionUsuario-content" style="border: 2px #5cdb5c solid;">
		<span class="closeAnadirDireccionUsuario" id="closeAnadirDireccionUsuario" onclick="ocultarAgregarDireccion()">&times;</span>
		<div class="anadirDireccionUsuario-content1">Se acabar de enviar un mail a <b>contabilidad@diginova.es</b> con el cambio propuesto en tu ficha de datos fiscales. En breve le avisaremos sobre si el cambio ha sido aceptado o no.</div>
	</div>
</div>
@if($errors->any())
	<h4>{{$errors->first()}}</h4>
@endif
<div class="formRegistro" role="form" method="post" action="{{URL::to('')}}" name="formRegistro" id="formRegistro">
	<div id="xw_boxcontacto" class="xw_boxcontacto" style="min-height: 700px; width: 1240px; margin: 0 auto;">
		<div style="width: 500px; float: left;">
			<form @submit.prevent="app.registro_actualizar()" class="" role="form" method="post" action="{{URL::to('')}}" name="formRegistro" id="formRegistro">
				<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />

				<table align="center" class="tcontacto2">
					<tr>
						<td colspan="2" style="font-family: gothamultra; font-size: 14pt;">Usuario y contraseña</td>
					</tr>
					<tr>
						<td style="vertical-align: bottom;">Nombre Usuario:</td>
						<td>
							<input type="text" name="nombreUsuario" id="nombreUsuario"v-model="nombreUsuario" disabled="enabled" maxlength="20" size="20" value="{{$datosCL->nomusu}}" placeholder="{{T::tr('Elija un nombre de Usuario')}}" />
						</td>
					</tr>
					<tr>
						<td style="vertical-align: bottom;">{{T::tr('Contraseña actual:')}}</td>
						<td>
							<input type="password" value="" maxlength="20" size="20" name="clave0" id="clave0" v-model="clave0" placeholder="{{T::tr('Entre 6 y 20 caracteres')}}" />
						</td>
					</tr>
					<tr>
						<td style="vertical-align: bottom;">{{T::tr('Nueva contraseña:')}}</td>
						<td>
							<input type="password" value="" maxlength="20" size="20" name="clave1" id="clave1" v-model="clave1" placeholder="{{T::tr('Entre 6 y 20 caracteres')}}" />
						</td>
					</tr>
					<tr>
						<td style="vertical-align: bottom;">{{T::tr('Repetir nueva contraseña:')}}</td>
						<td>
							<input type="password" value="" maxlength="20" size="20" name="clave2" id="clave2" v-model="clave2" placeholder="{{T::tr('Repetir contraseña')}}" />
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<button type="submit" class="btnSolicitarMayor" style="text-transform: none; float: right;" onclick="">{{T::tr('Actualizar')}}</button>
						</td>
					</tr>
					<tr style="display: none">
						<td colspan="2">
							<input type="text" value="{{$datosCL->nombre}}" class="form-control" maxlength="50" name="nombreCliente" id="nombreCliente" v-model="nombreCliente" placeholder="{{T::tr('Mínimo 15 caracteres')}}" {{$desactivar}} />
							<input type="text" value="{{$datosCL->dni}}" class="form-control autoWidth" maxlength="20" name="dni" v-model="dni" id="dni" placeholder="" {{$desactivar}} />
							<input type="text" value="{{$datosCL->direccion}}" class="form-control" maxlength="50" name="direccion" v-model="direccion" id="direccion" placeholder="({{T::tr('Calle,Plaza, etc.')}})" {{$desactivar}} />
							<input type="text" value="{{$datosCL->poblacion}}" class="form-control" maxlength="40" name="poblacion" v-model="poblacion" id="poblacion" placeholder="" {{$desactivar}} />
							<input type="text" value="{{$datosCL->cpostal}}" class="form-control autoWidth" maxlength="8" name="codigoPostal" v-model="codigoPostal" id="codigoPostal" placeholder="" {{$desactivar}} />
							<select class="form-control autoWidth" id="provincia" name="provincia" v-model="provincia" {{$desactivar}}>
								<option value="-1">{{T::tr('Provincia')}}</option>
								@foreach(Utils::matrizProvincias() as $pro)
									<option value="{{$pro['id']}}" {!!strtoupper($datosCL->provincia)==$pro['nombre']?"selected":''!!}>{{$pro['nombre']}}</option>
								@endforeach
							</select>
							<input type="email" value="{{$datosCL->email}}" class="form-control autoWidth" maxlength="100" name="eMail" id="eMail" v-model="eMail" placeholder="" />
							<input type="text" value="{{$datosCL->telefono}}" class="form-control autoWidth" maxlength="20" name="telefono" id="telefono" v-model="telefono" placeholder="" {{$desactivar}} />
							<label><input type="checkbox" name="boletin" v-model="boletin" checked="checked">&nbsp;{{T::tr('Suscribirse a la lista de correo')}}</label>
						</td>
					</tr>
				</table>
			</form>
			
			<table align="center" class="tcontacto2">
				<tr>
					<td colspan="2" style="font-family: gothamultra; font-size: 14pt; padding-top: 70px;">Datos fiscales</td>
				</tr>
				<tr>
					<td>{{T::tr('Nombre y Apellidos:')}}</td>
					<td>
						<div><b class="font_datos_fiscales">{{$datosCL->nombre}}</div>
					</td>
				</tr>
				<tr>
					<td>{{T::tr('NIF./CIF.:')}}</td>
					<td>
						<div><b class="font_datos_fiscales">{{$datosCL->dni}}</b></div>
					</td>
				</tr>
				<tr>
					<td>{{T::tr('Domicilio:')}}</td>
					<td>
						<div><b class="font_datos_fiscales">{{$datosCL->direccion}}</b></div>
					</td>
				</tr>
				<tr>
					<td>{{T::tr('Código Postal:')}}</td>
					<td>
						<div><b class="font_datos_fiscales">{{$datosCL->cpostal}}</b></div>
					</td>
				</tr>
				<tr>
					<td>{{T::tr('Población:')}}</td>
					<td>
						<div><b class="font_datos_fiscales">{{$datosCL->poblacion}}</b></div>
					</td>
				</tr>
				<tr>
					<td>{{T::tr('Provincia:')}}</td>
					<td>
						<div><b class="font_datos_fiscales">{{$datosCL->provincia}}</b></div>
					</td>
				</tr>
				<tr>
					<td>{{T::tr('e-mail:')}}</td>
					<td>
						<div><b class="font_datos_fiscales">{{$datosCL->email}}</b></div>
					</td>
				</tr>
				<tr>
					<td>{{T::tr('Teléfono:')}}</td>
					<td>
						<div><b class="font_datos_fiscales">{{$datosCL->telefono}}</b></div>
					</td>
				</tr>
				<tr>
					<td>
						<h1>¿Recibir boletines informativos?:</h1>
					</td>
					<td>
						<input type="checkbox" name="boletin" checked="checked">
					</td>
				</tr>
			</table>
		</div>
		<form role="form" method="post" action="{{URL::to('micuenta/datos')}}" id="formDatos" name="formDatos" enctype="multipart/form-data">
			<input type="hidden" id="_token" name="_token" value="{{{ csrf_token() }}}" />
			<table align="center" class="tcontacto2" style="width: 695px; margin-top: 337px; margin-left: 30px;">
				<tr>
					<td style="font-family: gothamultra; font-size: 14pt;">¿Quiere solicitar un cambio en sus datos fiscales?</td>
				</tr>
				<tr>
					<td>Escriba en el siguiente recuadro los cambios que quiera solicitar y aporte un documento acreditativo 'Identificación fiscal o Modelo 036'.</td>
				</tr>
				<tr>
					<td>
						<textarea class="form-control" rows="5" id="tt_cambio_fiscal" name="tt_cambio_fiscal" data-validation="required" data-validation-regexp="^[a-zA-Z ]{2,30}$">{{$txtCambioFiscal}}</textarea>
					</td>
				</tr>
				<tr>
					<td>
						<input type="file" id="btn_cambio_fiscal" name="btn_cambio_fiscal" style="float: right" accept="image/*, .pdf" />
						<span style="float: right; padding-right: 10px; ">Adjuntar Identificación fiscal o Modelo 036 </span>
					</td>
				</tr>
				<tr>
					<td>
						<input type="submit" id="solicitar_cambio_fiscal" class="btnSolicitarMayor" style="float: right" value="Enviar solicitud" />
					</td>
				</tr>
				<tr id="mensaje_error_solicitud">
					<td colspan="2" style="color: {{$colorMsjMailSolicitud}}; text-align: right;">{{$txtMsjMailSolicitud}}</td>
				</tr>
			</table>
		</form>
	</div>
</div>
	<script>
		$(document).ready( function () {
			app.nombreUsuario="{{$datosCL->nomusu}}";
			app.nombreCliente="{{$datosCL->nombre}}";
			app.dni="{{$datosCL->dni}}";
			app.direccion="{{$datosCL->direccion}}";
			app.poblacion="{{$datosCL->poblacion}}";
			app.codigoPostal="{{$datosCL->cpostal}}";
			app.eMail="{{$datosCL->email}}";
			app.telefono="{{$datosCL->telefono}}";
			app.boletin={{$datosCL->boletines=="S"?"true":"false"}};
			@foreach(Utils::matrizProvincias() as $pro)
				@if(strtoupper($datosCL->provincia)==$pro['nombre'])
					app.provincia="{{$pro['id']}}";
				@endif
			@endforeach
		});

		function solicitarCambio()
		{
			var usuario = '';
			var cliente = '';
			var dni = '';
			var direccion = '';
			var poblacion = '';
			var codigoPostal = '';
			var email = '';
			var telefono = '';

			var hayCambios = false;

			if ('{{$datosCL->nomusu}}' != $('#nombreUsuario').val())
			{
				usuario = $('#nombreUsuario').val();
				hayCambios = true;
			}

			if ('{{$datosCL->nombre}}' != $('#nombreCliente').val())
			{
				cliente = $('#nombreCliente').val();
				hayCambios = true;
			}

			if ('{{$datosCL->dni}}' != $('#dni').val())
			{
				dni = $('#dni').val();
				hayCambios = true;
			}

			if ('{{$datosCL->direccion}}' != $('#direccion').val())
			{
				direccion = $('#direccion').val();
				hayCambios = true;
			}

			if ('{{$datosCL->poblacion}}' != $('#poblacion').val())
			{
				poblacion = $('#poblacion').val();
				hayCambios = true;
			}

			if ('{{$datosCL->cpostal}}' != $('#codigoPostal').val())
			{
				codigoPostal = $('#codigoPostal').val();
				hayCambios = true;
			}

			if ('{{$datosCL->email}}' != $('#eMail').val())
			{
				email = $('#eMail').val();
				hayCambios = true;
			}

			if ('{{$datosCL->telefono}}' != $('#telefono').val())
			{
				telefono = $('#telefono').val();
				hayCambios = true;
			}

			if (hayCambios)
			{
				var formData = new FormData();
			    formData.append('usuario', usuario);
			    formData.append('cliente', cliente);
			    formData.append('dni', dni);
			    formData.append('direccion', direccion);
			    formData.append('poblacion', poblacion);
			    formData.append('codigoPostal', codigoPostal);
			    formData.append('email', email);
			    formData.append('telefono', telefono);
			    formData.append('_token', $('#_token').val());

			    $.ajax({
			        url: '/envioMailCambioUsuario',
			        type: 'post',
			        data: formData,
			        contentType: false,
			        processData: false,
			        success: function(response) {

			            pulsarAgregarDireccion();
			        }
			    });
			}
		}
	</script>
<!-- direcciones alternativas (subclientes) -->
<div id="posic" class="alert alert-info" style="margin-top: 15px; background-color: #fff !important; border: none; display: none;">
	<div class="row">
		<div class="col-xs-8">
			{{T::tr('Direcciones adicionales')}}{{count((array)$datosSB)==0?'&nbsp;(vacío)':''}}&nbsp;&nbsp;
			<strong>
				<a onclick="" href="{{URL::to('micuenta/direcciones/nueva')}}"><i class="fa fa-address-book"></i>&nbsp;{{T::tr('Agregar nueva')}}</a>
			</strong>
		</div>
	</div>
</div>

<div class="xw_boxcontacto" style="min-height: 1075px; width: 100%; padding: 0px 0px 0px 20px; float: left; background-color: white; display: none;">
	@foreach($datosSB as $sb)
		<div class="div_direccion_editar">
			<h3 style="float:left; display: contents;">
				<div style="width: 630px; margin: auto; margin-bottom: 60px;">
					<div class="pfacturas2 divpresupu" style="font-size: 16pt; font-family:'gothamultra'; text-transform: uppercase;">{{T::tr('Dirección alternativa nº')}} {{$sb->id}}</div>
				</div>
			</h3>
			<h6>
				<form  class="formRegistro" role="form" method="post" action="{{URL::to('micuenta/direccionesmodificar')}}" id="formModif{{$sb->id}}" name="formModif{{$sb->id}}">
					<input type="hidden" id="_token" name="_token" value="{{{ csrf_token() }}}" />
					<input type="hidden" name="id" value="{{$sb->id}}" />
					<table align="center" class="tcontacto2">
						<tr>
							<td>{{T::tr('Nombre dirección')}}</td>
							<td>
								<input type="text" value="{{$sb->nombre}}" maxlength="50" name="nombreCliente" placeholder="{{T::tr('Mínimo 15 caracteres')}}"/>
							</td>
						</tr>
						<tr>
							<td>{{T::tr('Dirección')}}</td>
							<td>
								<input type="text" value="{{$sb->direccion}}" maxlength="50" name="direccion" placeholder="({{T::tr('Calle, Plaza, etc...')}})"/>
							</td>
						</tr>
						<tr>
							<td>{{T::tr('Población')}}</td>
							<td>
								<input type="text" value="{{$sb->poblacion}}" maxlength="40" name="poblacion" placeholder=""/>
							</td>
						</tr>
						<tr>
							<td>{{T::tr('Código Postal')}}</td>
							<td>
								<input type="text" value="{{$sb->cpostal}}" maxlength="8" name="codigoPostal" placeholder=""/>
							</td>
						</tr>
						<tr>
							<td>{{T::tr('Provincia:')}}</td>
							<td>
								<select name="provincia">
									<option value="-1">{{T::tr('Provincia')}}</option>
									@foreach(Utils::matrizProvincias() as $mar)
										<option value="{{$mar['id']}}" {!!strtoupper($sb->provincia)==$mar['nombre']?"selected":''!!}>{{$mar['nombre']}}</option>
									@endforeach
								</select>
							</td>
						</tr>
						<tr>
							<td>{{T::tr('Teléfono:')}}</td>
							<td>
								<input type="text" value="{{$sb->telefono}}" maxlength="20" name="telefono" placeholder="" />
							</td>
						</tr>
						<tr>
							<td>{{T::tr('Observaciones')}}</td>
							<td>
								<textarea class="form-control" rows="5" name="observaciones">{{$sb->observaciones}}</textarea>
							</td>
						</tr>
						<tr>
							<td></td>
							<td>
								<input type="submit" name="submi{{$sb->id}}" class="btn btn-primary pull-right enviadatos" value="Editar"/>
							</td>
						</tr>
					</table>
				</form>
			</h6>
		</div>
	@endforeach
</div>

@endif




<!-- Direcciones de envío  (Centros) 1234 -->
@if($seccion=="direcciones")
<?php
$desactivar="disabled";
$desactivar="";
?>

<div id="anadirDireccionUsuario" class="anadirDireccionUsuario">
	<div class="anadirDireccionUsuario-content">
		<span class="closeAnadirDireccionUsuario" id="closeAnadirDireccionUsuario" onclick="ocultarAgregarDireccion()">&times;</span>
		<div class="anadirDireccionUsuario-content1">
			<?php
			$contadorDatosCC = 0;
			?>
			@foreach($datosCC as $sb)
				@if ($contadorDatosCC == 0)
					<div id="div_nueva_direccion" class="div_direccion_editar">
						<h3 style="float:left; display: contents;">
							<div style="width: 630px; margin: auto; margin-bottom: 60px;">
								<div class="pfacturas2 divpresupu" style="font-size: 16pt; font-family:'gothamultra'; text-transform: uppercase;">{{T::tr('Nueva dirección de envío')}}</div>
							</div>
						</h3>
						<h6>
							<form class="formRegistro" role="form" method="post" action="{{URL::to('micuenta/centrosmodificar')}}" id="formModif{{$ultCentro}}" name="formModif{{$ultCentro}}">
								<input type="hidden" id="_token" name="_token" value="{{{ csrf_token() }}}" />
								<input type="hidden" name="id" value="{{$ultCentro}}" />
								<table align="center" class="tcontacto2" style="text-align: left;">
									<tr>
										<td style="min-width: 130px;">{{T::tr('Nombre')}}</td>
										<td>
											<input type="text" value="" maxlength="50" name="nombreCliente" placeholder="{{T::tr('Mínimo 15 caracteres')}}" />
										</td>
									</tr>
									<tr>
										<td>{{T::tr('Dirección')}}</td>
										<td>
											<input type="text" value="" maxlength="50" name="direccion" placeholder="({{T::tr('Calle, Plaza, etc.')}})" />
										</td>
									</tr>
									<tr>
										<td>{{T::tr('Población')}}</td>
										<td>
											<input type="text" value="" maxlength="40" name="poblacion" placeholder="" />
										</td>
									</tr>
									<tr>
										<td>{{T::tr('Código Postal')}}</td>
										<td>
											<input type="text" value="" maxlength="8" name="codigoPostal" placeholder=""  />
										</td>
									</tr>
									<tr>
										<td>{{T::tr('Provincia:')}}</td>
										<td>
											<select class="form-control autoWidth" name="provincia" >
												<option value="-1">{{T::tr('Provincia')}}</option>
												@foreach(Utils::matrizProvincias() as $mar)
													<option value="{{$mar['id']}}" {!!strtoupper($sb->ZPAIS)==$mar['nombre']?"selected":''!!}>{{$mar['nombre']}}</option>
												@endforeach
											</select>
										</td>
									</tr>
									<tr>
										<td>{{T::tr('Teléfono:')}}</td>
										<td>
											<input type="text" value="" maxlength="20" name="telefono" placeholder=""  />
										</td>
									</tr>
									<tr>
										<td>{{T::tr('Observaciones')}}</td>
										<td>
											<textarea class="form-control" rows="5" name="observaciones"></textarea>
										</td>
									</tr>
									<tr>
										<td></td>
										<td>
											<button type="submit" name="submit" value="submit"  class="btnSolicitarMayor" style="float: right; margin-top: 10px;">Guardar cambios</button>
										</td>
									</tr>
								</table>
							</form>
						</h6>
					</div>
				@endif
				<?php
				$contadorDatosCC += 1;
				?>
			@endforeach
		</div>
	</div>
</div>

<div class="xw_boxcontacto" style="min-height: 465px; width: 1240px; margin: auto; padding: 0px; background-color: white;">
	<div style="margin-bottom: 25px;">
		<div class="lista_direcciones" style="float: left;">Lista de direcciones</div>
		<select id="select_direcciones" onchange="filtrarDireccion(this)">
			@foreach($datosCC as $sb)
				@if ($sb->ZNOM != '' && $sb->ZDOM != '' && $sb->ZPOB != '')
					@if ($sb->ZDESACT == 'N')
						<option value="{{$sb->ZCEN}}">{{$sb->ZDOM}}, {{$sb->ZPOB}}, {{$sb->ZCODPO}}</option>
					@else
						<option value="{{$sb->ZCEN}}" style="background-color: #ccc">{{$sb->ZDOM}}, {{$sb->ZPOB}}, {{$sb->ZCODPO}}</option>
					@endif
				@endif
			@endforeach
		</select>
		<button class="btnSolicitarMayor btnAgregarDireccion" style="position: absolute; margin-left: 30px; margin-top: -7px;">
			<a onclick="pulsarAgregarDireccion()" style="color: #fff"><i class="fa fa-address-book"></i>&nbsp;{{T::tr('Agregar nueva dirección')}}</a>
		</button>
	</div>
	<?php
	$numDatosDireccion = 0;
	?>
	@foreach($datosCC as $sb)
		@if ($sb->ZNOM != '' && $sb->ZDOM != '' && $sb->ZPOB != '')
			<?php
			$numDatosDireccion += 1;
			?>
			<div id="div_direccion_editar_{{$sb->ZCEN}}" class="div_direccion_editar" <?php if ($numDatosDireccion == 1) { ?> style="display: block; width: 500px" <?php } else { ?> style="display: none" <?php } ?>>
				<h4 style="float:left; display: contents;">
					<div style="width: 630px; margin: auto; margin-bottom: 60px;">
						<div class="pfacturas2 divpresupu" style="font-size: 16pt; font-family:'gothamultra'; text-transform: uppercase;">{{T::tr('Dirección de envío nº')}} {{$sb->ZCEN}}</div>
					</div>
				</h4>
				<h6>
					<form class="formRegistro" role="form" method="post" action="" onsubmit="return false;" id="formModif{{$sb->ZCEN}}" name="formModif{{$sb->ZCEN}}">
						<input type="hidden" id="_token" name="_token" value="{{{ csrf_token() }}}" />
						<table align="center" class="tcontacto2" style="width: 370px;">
							<tr>
								<td>{{T::tr('Nombre y apellidos /')}}<br/>{{T::tr('nombre de la empresa')}}</td>
								<td>
									<div><b class="font_datos_fiscales">{{$sb->ZNOM}}</div>
								</td>
							</tr>
							<tr>
								<td>{{T::tr('Dirección')}}</td>
								<td>
									<div><b class="font_datos_fiscales">{{$sb->ZDOM}}</div>
								</td>
							</tr>
							<tr>
								<td>{{T::tr('Población')}}</td>
								<td>
									<div><b class="font_datos_fiscales">{{$sb->ZPOB}}</div>
								</td>
							</tr>
							<tr>
								<td>{{T::tr('Código Postal')}}</td>
								<td>
									<div><b class="font_datos_fiscales">{{$sb->ZCODPO}}</div>
								</td>
							</tr>
							<tr>
								<td>{{T::tr('Provincia:')}}</td>
								<td>
									<div><b class="font_datos_fiscales">{{$sb->ZPAIS}}</div>
								</td>
							</tr>
							<tr>
								<td>{{T::tr('Teléfono:')}}</td>
								<td>
									<div><b class="font_datos_fiscales">{{$sb->ZTEL}}</div>
								</td>
							</tr>
							<tr>
								<td>{{T::tr('Observaciones')}}</td>
								<td>
									<div><b class="font_datos_fiscales">{{$sb->ZOBS}}</div>
								</td>
							</tr>
							<tr>
								<td></td>
								<td>
									<div style="padding: 10px 0px;">
										<input type="checkbox" id="check_centro" name="check_centro" <?php if ($sb->ZDESACT == 'N') { ?> checked <?php } ?> onclick="activarCentro({{$sb->ZCLI}}, {{$sb->ZCEN}}, this)" value="{{$sb->ZCEN}}">
										<span>Activar centro</span>
									</div>
								</td>
							</tr>
							<tr class="mensaje_exito_activar_centro" style="display: none">
								<td colspan="2" style="color: #239B56; display: table-cell;">Su centro ha sido activado.</td>
							</tr>
							<tr class="mensaje_exito_desactivar_centro" style="display: none">
								<td colspan="2" style="color: #239B56; display: table-cell;">Su centro ha sido desactivado.</td>
							</tr>
						</table>
					</form>
				</h6>
			</div>
		@endif
	@endforeach
</div>

@endif





<!-- datos de direcciones adicionales -->
<!-- if($seccion=="direcciones") 1234 -->
@if(false)
	<div class="xw_boxcontacto" style="min-height: 1075px; width: 100%; margin: 0 auto; margin-left: 20px; float: left;">
		@foreach($datosSB as $sb)
			<div class="div_direccion_editar">
				<h3 style="float:left; display: contents;">
					<div style="width: 630px; margin: auto; margin-bottom: 60px;">
						<div class="pfacturas2 divpresupu" style="font-size: 16pt; font-family:'gothamultra'; text-transform: uppercase;">{{T::tr('Dirección de envío nº')}} {{$sb->id}}</div>
					</div>
				</h3>
				<h6>
					<form class="formRegistro" role="form" method="post" action="{{URL::to('micuenta/direccionesmodificar')}}" id="formModif{{$sb->id}}" name="formModif{{$sb->id}}">
						<input type="hidden" id="_token" name="_token" value="{{{ csrf_token() }}}" />
						<input type="hidden" name="id" value="{{$sb->id}}" />
						<table align="center" class="tcontacto2">
							<tr>
								<td>{{T::tr('Nombre y apellidos')}}</td>
								<td>
									<input type="text" value="{{$sb->nombre}}" maxlength="50" name="nombreCliente" placeholder="{{T::tr('Mínimo 15 caracteres')}}" />
								</td>
							</tr>
							<tr>
								<td>{{T::tr('Dirección')}}</td>
								<td>
									<input type="text" value="{{$sb->direccion}}" maxlength="50" name="direccion" placeholder="({{T::tr('Calle, Plaza, etc.')}})" />
								</td>
							</tr>
							<tr>
								<td>{{T::tr('Población')}}</td>
								<td>
									<input type="text" value="{{$sb->poblacion}}" maxlength="40" name="poblacion" placeholder="" />
								</td>
							</tr>
							<tr>
								<td>{{T::tr('Código Postal')}}</td>
								<td>
									<input type="text" value="{{$sb->cpostal}}" maxlength="8" name="codigoPostal" placeholder=""  />
								</td>
							</tr>
							<tr>
								<td>{{T::tr('Provincia:')}}</td>
								<td>
									<select class="form-control autoWidth" name="provincia" >
										<option value="-1">{{T::tr('Provincia')}}</option>
										@foreach(Utils::matrizProvincias() as $mar)
											<option value="{{$mar['id']}}" {!!strtoupper($sb->provincia)==$mar['nombre']?"selected":''!!}>{{$mar['nombre']}}</option>
										@endforeach
									</select>
								</td>
							</tr>
							<tr>
								<td>{{T::tr('Teléfono:')}}</td>
								<td>
									<input type="text" value="{{$sb->telefono}}" maxlength="20" name="telefono" placeholder=""  />
								</td>
							</tr>
							<tr>
								<td>{{T::tr('Observaciones')}}</td>
								<td>
									<textarea class="form-control" rows="5" name="observaciones">{{$sb->observaciones}}</textarea>
								</td>
							</tr>
							<tr>
								<td></td>
								<td>
									<button type="submit" name="submit" value="submit" class="btn btn-primary pull-right" >Guardar cambios</button>
								</td>
							</tr>
						</table>
					</form>
				</h6>
			</div>
		@endforeach
	</div>



	<div class="xw_boxcontacto" style="min-height: 1075px; width: 100%; margin: 0 auto; margin-left: 20px; float: left;">
		@foreach($datosCC as $sb)
		<div class="div_direccion_editar">
			<h3 style="float:left; display: contents;">
				<div style="width: 630px; margin: auto; margin-bottom: 60px;">
					<div class="pfacturas2 divpresupu" style="font-size: 16pt; font-family:'gothamultra'; text-transform: uppercase;">{{T::tr('Dirección alternativa nº')}} {{$sb->id}}</div>
				</div>
			</h3>
			<h6>
				<form role="form" method="post" action="{{URL::to('micuenta/centrosmodificar')}}" name="formModif" class="formRegistro">
					<input type="hidden" id="_token" name="_token" value="{{{ csrf_token() }}}" />
					<input type="hidden" name="id" value="{{$sb->id}}" />

					<table align="center" class="tcontacto2">
						<tr>
							<td>{{T::tr('Nombre y apellidos /')}}<br/>{{T::tr('nombre de la empresa')}}</td>
							<td>
								<input type="text" value="{{$sb->nombre}}" maxlength="50" name="nombreCliente" placeholder="{{T::tr('Mínimo 15 caracteres')}}" />
							</td>
						</tr>
						<tr>
							<td>{{T::tr('Dirección')}}</td>
							<td>
								<input type="text" value="{{$sb->direccion}}" maxlength="50" name="direccion" placeholder="({{T::tr('Calle, Plaza, etc.')}})" />
							</td>
						</tr>
						<tr>
							<td>{{T::tr('Población')}}</td>
							<td>
								<input type="text" value="{{$sb->poblacion}}" maxlength="40" name="poblacion" placeholder="" />
							</td>
						</tr>
						<tr>
							<td>{{T::tr('Código Postal')}}</td>
							<td>
								<input type="text" value="{{$sb->cpostal}}" maxlength="8" name="codigoPostal" placeholder=""  />
							</td>
						</tr>
						<tr>
							<td>{{T::tr('Provincia:')}}</td>
							<td>
								<select class="form-control autoWidth" name="provincia" >
									<option value="-1">{{T::tr('Provincia')}}</option>
									@foreach(Utils::matrizProvincias() as $mar)
										<option value="{{$mar['id']}}" {!!strtoupper($sb->provincia)==$mar['nombre']?"selected":''!!}>{{$mar['nombre']}}</option>
									@endforeach
								</select>
							</td>
						</tr>
						<tr>
							<td>{{T::tr('Teléfono:')}}</td>
							<td>
								<input type="text" value="{{$sb->telefono}}" maxlength="20" name="telefono" placeholder=""  />
							</td>
						</tr>
						<tr>
							<td>{{T::tr('Observaciones')}}</td>
							<td>
								<textarea class="form-control" rows="5" name="observaciones">{{$sb->observaciones}}</textarea>
							</td>
						</tr>
						<tr>
							<td></td>
							<td>
								<button type="submit" name="submit" value="submit" class="btnSolicitarMayor" style="float: right; margin-top: 10px;" >Guardar cambios</button>
							</td>
						</tr>
					</table>
				</form>
			</h6>
		</div>
		@endforeach
	</div>
@endif


@if($seccion=="presupuestos" || $seccion=="pedidos" || $seccion=="albaranes" || $seccion=="facturas")
	@if(Session::has("manno")==false)
		<?php
		$a=array();
		$a[]="todos";
		?>
		@foreach($datos as $dato)
			<?php 
				$anno=date('Y',strtotime($dato->fecha))."";
				if(!in_array($anno, $a)){
					$a[]=$anno;
				}
			?>
		@endforeach
		<?php Session::put("manno",$a);	?>
		<?php Session::put("ruta",URL::to('/micuenta/'.$seccion));	?>
		@endif
@endif

<!-- listado de presupuestos -->
@if($seccion=="presupuestos")
<div class="row">
	<div class="col-xs-12 col-md-12 text-left">
		<h3 style="text-align: left">
			<div style="width: 350px; margin: auto;">
				<div class="pfacturas2 divpresupu" style="font-size: 12pt; font-family: montserratregular;">{{T::tr('Historial de presupuestos')}}&nbsp;</div>
				<div class="rangofacturas2" style="float: left;">
					<select onchange="document.location.href=this.value;">
						@foreach(session("manno") as $ditt)
							<option value="{{is_numeric($ditt)?session("ruta").'/'.$ditt : session("ruta")}}" {{$ditt==$annosele?"selected":""}}>{{$ditt}}</option>
						@endforeach
					</select>
				</div>
			</div>
		</h3>	
		
		<br /><br /><br /><br />	

		<table data-toggle="table" data-pagination="true" data-page-list="[25,10]" border="0" align="center" style="width: 700px;" class="tdocumentos">
			<tr>
				<td>{{T::tr('Nº Presupuesto')}}</td>
				<td>{{T::tr('Fecha')}}</td>
				<td style="width: 100px; text-align: right;">{{T::tr('Total')}}</td>
				<td style="text-align: right">{{T::tr('PDF')}}</td>
			</tr>
			@if (count($datos) > 0)
				@foreach($datos as $dato)
					<tr>
						<td>
							<a href="/xweb/presupuestogenerado/{{$dato->BLINKPDF}}" target="_blank">{{Utils::pedidoBarras($dato->BPRESU)}}</a>
						</td>
						<td>{{$dato->fecha}}</td>
						<td style="text-align: right">{{Utils::numFormat($dato->BIMPOR)}}&euro;</td>
						<td style="text-align: right">
							<a href="/xweb/resources/pdfpresu/presu_{{$dato->BLINKPDF}}.pdf" target="_blank">
								<img align="top" src="/xweb/public/images/facpdf.jpg" border="0" title="Ver PDF" alt="Ver PDF" />
							</a>
						</td>
					</tr>
				@endforeach
			@else
				<tr>
					<td colspan="4" style="text-align: center;">No tienes presupuestos en este año</td>
				</tr>
			@endif
		</table>
	</div>
</div>
@endif
<!-- listado de pedidos -->
@if($seccion=="pedidos")
<div class="row">
	<div class="col-xs-12 col-md-12 text-left">
		<h3 style="float:left; display: contents;">
			<div style="width: 350px; margin: auto;">
				<div class="pfacturas2 divpresupu" style="font-size: 12pt; font-family: montserratregular;">{{T::tr('Historial de pedidos')}}&nbsp;</div>
				<div class="rangofacturas2" style="float: left;">
					<select onchange="document.location.href=this.value;">
						@foreach(session("manno") as $ditt)
							@if ($ditt != 'todos')
								<option value="{{is_numeric($ditt)?session("ruta").'/'.$ditt : session("ruta")}}" {{$ditt==$annosele?"selected":""}}>{{$ditt}}</option>
							@endif
						@endforeach
					</select>
				</div>
			</div>
		</h3>		
		<table data-toggle="table" data-pagination="true" data-page-list="[25,10]" border="0" align="center" style="width: 950px;" class="tdocumentos">
			<tr>
				<td>{{T::tr('Nº Pedido')}}</td>
				<td>{{T::tr('Fecha')}}</td>
				<td style="text-align: right; width: 135px; padding-right: 35px;">{{T::tr('Total')}}</td>
				<td style="text-align: center;">{{T::tr('Seguimiento')}}</td>
			</tr>
			@foreach($datos as $dato)
				<?php

					if ($seccion == "pedidos")
					{
						// Por cada pedido, buscarlo en la matriz de campos auxiliares "pedidosAux". Detectar el total del pedido, campo btobru:

							// Por si no detecto el total del pedido, por defecto muestro la base imponible:
								$btobru = $dato->impor; 

							$encontrado = false; $i = 0;

							while (!$encontrado && $i < count($pedidosAux))
							{
								if ($dato->docum == $pedidosAux[$i]->bped)
								{
									$encontrado = true;
									$btobru = $pedidosAux[$i]->btobru;
									$btobruF = number_format($btobru, 2, ",", "."); $btobruF .= "&euro;";
								}

								$i++;
							}
					}


				?>
			<tr>
				<td class="text-right"><a
					href="{{URL::to('documentos/pedido/'.$dato->docum.'/1')}}">{{Utils::pedidoBarras($dato->docum)}}</a></td>
				<td>{{Utils::fechaEsp($dato->fecha)}}</td>
				<td class="text-right" style="text-align: right; width: 135px; padding-right: 35px;">{{$btobruF}}</td>


					<td style="text-align: center;">
						<?php
						$linkSeguimiento = '';
						$observaciones = '';
						$agencia = ""; // Agencia según envío
						$rcodigoenv = "";
						$logotracking = "";
						$cp = "";
						$fdoc = ""; $factEncontrada = false; $i = 0;

						foreach ($arrFacturas as $fila) 
						{
							if ($dato->docum == $fila -> BPED)
							{
								$fdoc = $fila -> FDOC;
							}
						}

						if ($fdoc != "")
						{
							foreach ($arrEnvios as $envio) 
							{
								if ($fdoc == $envio -> fdoc)
								{
									$agencia = $envio -> bagencia;
									$rcodigoenv = $envio -> rcodigoenv;
									$cp = $envio -> cp;
								}
							}

						}


						if ($agencia == 4 || $agencia == 16)
						{
							//$linkSeguimiento = 'https://www.mrw.es/seguimiento_envios/MRW_resultados_consultas.asp?modo=nacional&envio='.$fdoc;
							$linkSeguimiento = 'https://www.mrw.es/seguimiento_envios/MRW_resultados_consultas.asp?modo=nacional&envio='.$rcodigoenv;
							$logotracking = "https://diginova.es/xweb/public/images/mrw_logo.png";

							if ($fdoc == "") { $linkSeguimiento = ""; }
						}
						else if ($agencia == 11)
						{
							$linkSeguimiento = "https://s.correosexpress.com/c?n=".$rcodigoenv;
							$logotracking = "https://diginova.es/img/tracking_cex.png";
						}
						else if ($agencia == 18)
						{
							$linkSeguimiento = "http://extranet.gls-spain.es/Extranet/public/ExpedicionASM.aspx?codigo=".$rcodigoenv."&cpDst=".$cp;
							$logotracking = "https://diginova.es/img/tracking_gls.png";
						}

						?>
						@foreach ($arrFacturas as $arrFactura)
							@if ($dato->docum == $arrFactura->FDOC)
								<?php 
								//$linkSeguimiento = 'https://www.mrw.es/seguimiento_envios/MRW_resultados_consultas.asp?modo=nacional&envio='.$arrFactura->FDOC;
								$observaciones = $arrFactura->FPEDID;
								break; 
								?>
							@endif
						@endforeach

						@if ($linkSeguimiento == "")
							<span class="textoRojo">No disponible</span>
						@else
							<a href="{{$linkSeguimiento}}" target="_blank">
								<img src="{{$logotracking}}" style="width: 40px;">
							</a>
						@endif
					</td>




				<td style="text-align: center; display: none;">
					<?php
					$linkSeguimiento = '';
					?>
					@foreach ($arrFacturas as $arrFactura)
						@if ($dato->docum == $arrFactura->BPED)
							<?php 
							$linkSeguimiento = 'https://www.mrw.es/seguimiento_envios/MRW_resultados_consultas.asp?modo=nacional&envio='.$arrFactura->FDOC;
							break; 
							?>
						@endif
					@endforeach

					@if ($linkSeguimiento == "")
						<span class="textoRojo">No disponible</span>
					@else
						<a href="{{$linkSeguimiento}}" target="_blank">
							<img src="/xweb/public/images/mrw_logo.png" style="width: 40px;">
						</a>
					@endif
				</td>
			</tr>
			@endforeach
		</table>
	</div>
</div>
@endif
<!-- listado de albaranes -->
@if($seccion=="albaranes")
<div class="row">
	<div class="col-xs-12 col-md-12 text-left">
		<h3 style="float:left; display: contents;">
			<div style="width: 350px; margin: auto;">
				<div class="pfacturas2 divpresupu" style="font-size: 12pt; font-family: montserratregular;">{{T::tr('Historial de albaranes')}}&nbsp;</div>
				<div class="rangofacturas2" style="float: left;">
					<select onchange="document.location.href=this.value;">
						@foreach(session("manno") as $ditt)
							<option value="{{is_numeric($ditt)?session("ruta").'/'.$ditt : session("ruta")}}" {{$ditt==$annosele?"selected":""}}>{{$ditt}}</option>
						@endforeach
					</select>
				</div>
			</div>
		</h3>		
		<table data-toggle="table" data-pagination="true" data-page-list="[25,10]" border="0" align="center" style="width: 950px;" class="tdocumentos">
			<tr>
				<td>{{T::tr('Nº Albarán')}}</td>
				<td>{{T::tr('Fecha')}}</td>
				<td>{{T::tr('Base imponible')}}</td>
				<td>{{T::tr('Estado')}}</td>
			</tr>
			@foreach($datos as $dato)
				<tr>
					<td class="text-right"><a
						href="{{URL::to('documentos/albaran/'.$dato->docum)}}">{{Utils::pedidoBarras($dato->docum)}}</a></td>
					<td>{{Utils::fechaEsp($dato->fecha)}}</td>
					<td class="text-right">{{Utils::numFormat($dato->impor)}}</td>
					<td class="{{($dato->facturadosn=="S"?"textoVerde":"textoRojo")}}">{{($dato->facturadosn=="S"?T::tr('Facturado'):T::tr('Sin facturar'))}}</td>
				</tr>
			@endforeach
		</table>
	</div>
</div>
@endif
<!-- listado de facturas -->
@if($seccion=="facturas")
<div class="row">
	<div id="tableFacturas" class="col-xs-12 col-md-12 text-left overflow-x">
		<h3 style="float:left; display: contents;">
			<div style="width: 350px; margin: auto;">
				<div class="pfacturas2 divpresupu" style="font-size: 12pt; font-family: montserratregular;">{{T::tr('Historial de facturas')}}&nbsp;</div>
				<div class="rangofacturas2" style="float: left;">
					<select onchange="document.location.href=this.value;">
						@foreach($arrAniosModelo347 as $arrAnioModelo347)
							<option value="/xweb/micuenta/facturas/{{$arrAnioModelo347}}" <?php if ($arrAnioModelo347 == $anio) { ?> selected <?php } ?>>{{$arrAnioModelo347}}</option>
						@endforeach
					</select>
				</div>
			</div>
		</h3>	
		<table data-toggle="table" data-pagination="true" data-page-list="[25,10]" border="0" align="center" style="width: 1200px;" class="tdocumentos">
			<tr>
				<td>{{T::tr('Nº Factura')}}</td>
				<td class="lineaMiCuentaPC">{{T::tr('Fecha')}}</td>
				<td style="text-align: right;">{{T::tr('Total factura')}}</td>
				<td style="text-align: center;">{{T::tr('PDF')}}</td>
				<td style="text-align: center;">{{T::tr('Seguimiento')}}</td>
				<td>{{T::tr('Observaciones')}}</td>
			</tr>
			@foreach($datos as $dato)
				<tr>
					<td class="text-right">
						<a href="{{URL::to('documentos/factura/'.$dato->docum)}}">{{Utils::pedidoBarras($dato->docum)}}</a>
						<a class="lineaMiCuentaMv">{{Utils::fechaEsp($dato->fecha)}}</a>
					</td>
					<td class="lineaMiCuentaPC">{{Utils::fechaEsp($dato->fecha)}}</td>
					<td class="text-right" style="text-align: right;">{{Utils::numFormat($dato->ftotal)}}</td>
					<td>
						@if($dato->pdoc!==null)
							<a href="{{URL::to('descargarPDF/'.$dato->pdoc)}}" target="_blank" title="Download" style="display: block; text-align: center;">
								<img align="top" src="/xweb/public/images/facpdf.jpg" border="0" width="15" height="15" title="Guardar PDF" alt="Guardar PDF">
							</a>
						@endif
						@if($dato->pdoc==null && file_exists("../facturas/FAC".substr("000000".$dato->docum,-14).".pdf"))
							<a href="{{URL::to('descargarPDFFile/'.$dato->docum)}}" target="_blank" title="Download" style="display: block; text-align: center;">
								<img align="top" src="/xweb/public/images/facpdf.jpg" border="0" width="15" height="15" title="Guardar PDF" alt="Guardar PDF">
							</a>
						@endif
						@if($dato->xdoc!==null)
							<?php
							$a=$dato->xmlfactura;
							$a=str_replace("\r\n","",$a);
							//$a=substr($a,0,60);
							?>
							<a href="#" onclick="saveTextAsFile('{{$a}}','{{$dato->xdoc}}.xml')" title="Download" style="display: block; text-align: center;">
								<span class="glyphicon glyphicon-download-alt"></span>
							</a>
						@endif
					</td>
					<td style="text-align: center;">
						<?php
						$linkSeguimiento = '';
						$observaciones = '';
						$agencia = ""; // Agencia según envío
						$rcodigoenv = "";
						$logotracking = "";
						$cp = "";

						foreach ($arrEnvios as $envio) 
						{
							if ($dato->docum == $envio -> fdoc)
							{
								$agencia = $envio -> bagencia;
								$rcodigoenv = $envio -> rcodigoenv;
								$cp = $envio -> cp;
							}
						}

						if ($agencia == 4 || $agencia == 16 || $agencia == "")
						{
							//$linkSeguimiento = 'https://www.mrw.es/seguimiento_envios/MRW_resultados_consultas.asp?modo=nacional&envio='.$dato->docum;
							$linkSeguimiento = 'https://www.mrw.es/seguimiento_envios/MRW_resultados_consultas.asp?modo=nacional&envio='.$rcodigoenv;
							$logotracking = "https://diginova.es/xweb/public/images/mrw_logo.png";
						}
						else if ($agencia == 11)
						{
							$linkSeguimiento = "https://s.correosexpress.com/c?n=".$rcodigoenv;
							$logotracking = "https://diginova.es/img/tracking_cex.png";
						}
						else if ($agencia == 18)
						{
							$linkSeguimiento = "http://extranet.gls-spain.es/Extranet/public/ExpedicionASM.aspx?codigo=".$rcodigoenv."&cpDst=".$cp;
							$logotracking = "https://diginova.es/img/tracking_gls.png";
						}

						?>
						@foreach ($arrFacturas as $arrFactura)
							@if ($dato->docum == $arrFactura->FDOC)
								<?php 
								//$linkSeguimiento = 'https://www.mrw.es/seguimiento_envios/MRW_resultados_consultas.asp?modo=nacional&envio='.$arrFactura->FDOC;
								$observaciones = $arrFactura->FPEDID;
								break; 
								?>
							@endif
						@endforeach

						@if ($linkSeguimiento == "")
							<span class="textoRojo">No disponible</span>
						@else
							<a href="{{$linkSeguimiento}}" target="_blank">
								<img src="{{$logotracking}}" style="width: 40px;">
							</a>
						@endif
					</td>
					<td>
						@foreach ($arrObservaciones as $arrObservacion)
							@if ($dato->docum == $arrObservacion->FDOC)
								{{$arrObservacion->FPEDID}}
							@endif
						@endforeach
					</td>
				</tr>
			@endforeach
		</table>
	</div>
</div>
@endif



<!-- listado de albaranes recibos cobros pendientes -->
@if($seccion=="pendiente")
<div class="row" style="display: none">
	<div class="col-xs-12 col-md-12 text-left">
		<h4 style="float:left; display: contents;">
			<div style="width: 400px; margin: auto; margin-bottom: 15px;">
				<div class="pfacturas2 divpresupu" style="font-size: 11pt; font-family: montserratregular;">{{T::tr('Relación de albaranes pendientes de facturar:')}}</div>
			</div>
		</h4>
		<table data-toggle="table" data-pagination="true" data-page-list="[25,10]" border="0" align="center" style="width: 950px;" class="tdocumentos">
			<tr>
				<td>{{T::tr('Nº Albarán')}}</td>
				<td>{{T::tr('Fecha')}}</td>
				<td>{{T::tr('Texto informativo')}}</td>
				<td>{{T::tr('Base imponible')}}</td>
			</tr>
			@if(count($datosAP) > 0)
				@foreach($datosAP as $dato)
					<tr>
						<td class="text-right"><a
							href="{{URL::to('documentos/albaran/'.$dato->docum)}}">{{Utils::pedidoBarras($dato->docum)}}</a></td>
						<td>{{Utils::fechaEsp($dato->fecha)}}</td>
						<td>{{($dato->txtpedido)}}</td>
						<td class="text-right">{{Utils::numFormat($dato->impor)}}</td>
					</tr>
				@endforeach
			@else
				<tr>
					<td colspan="4">
						<div class="azul">
							<img src="/xweb/public/images/info.png" border="0" width="20px" height="20px" />
							&nbsp;&nbsp;No hay datos en este apartado.
						</div>
					</td>
				</tr>
			@endif
		</table>
	</div>
</div>
<div class="row">
	<div id="tableRecibos" class="col-xs-12 col-md-12 text-left overflow-x">
		<h4 style="float:left; display: contents;">
			<div style="width: 630px; margin: auto; margin-bottom: 60px;">
				<div class="pfacturas2 divpresupu" style="font-size: 11pt; font-family: montserratregular;">{{T::tr('Recibos pendientes de cobro:')}}</div>
			</div>
		</h4>

		<?php
		// detectamos si tenemos configurado pago por tpv virtual redsys o iupay
		//{{var_dump(session('entorno')->formasPago)}}
		$cobrotar=false;
		foreach(session('entorno')->formasPago as $f){
			if($f->wcod=="2"||$f->wcod=="3"){
				$cobrotar=true;
			}
		}
		?>
		<table data-toggle="table" data-pagination="true" data-page-list="[25,10]" border="0" align="center" style="width: 950px; margin-bottom: 50px;" class="tdocumentos">
			<tr>
				<td>{{T::tr('Factura')}}</td>
				<td class="lineaMiCuentaPC">{{T::tr('Fecha')}}</td>
				<td>{{T::tr('Vencimiento')}}</td>
				<td>{{T::tr('Importe')}}</td>
				<td>{{T::tr('Cobrado')}}</td>
				<td>{{T::tr('Pendiente')}}</td>
			</tr>
			@if(count($datosRP) > 0)
				@foreach($datosRP as $dato)
					<tr>
						<td class="text-right">
							<a href="{{URL::to('documentos/factura/'.$dato->rfac)}}">
								<img align="top" src="/xweb/public/images/Lupa_DiginovaIcon.png" border="0" title="Ver" alt="Ver" class="lineaMiCuentaPC" />
								{{Utils::pedidoBarras($dato->rfac)}}-{{Utils::numFormat($dato->rrec,0)}}
							</a>
							<a class="lineaMiCuentaMv">{{Utils::fechaEsp($dato->rfecha)}}</a>
						</td>
						<td class="lineaMiCuentaPC">{{Utils::fechaEsp($dato->rfecha)}}</td>
						<td>{{Utils::fechaEsp($dato->rfecvto)}}</td>
						<td class="text-right">{{Utils::numFormat($dato->rimp)}}</td>
						<td class="text-right">{{Utils::numFormat($dato->rimpcobr)}}</td>
						<td class="text-right">{{Utils::numFormat($dato->rpdte)}}</td>
					</tr>
				@endforeach
				<tr>
					<td></td>
					<td class="lineaMiCuentaPC"></td>
					<td></td>
					<td></td>
					<td style="background-color: #0b2e48; color: #fff;" align="right">Suma: </td>
					<td style="background-color: #0b2e48; color: #fff;">{{Utils::numFormat($totalPendiente)}}€</td>
				</tr>
			@else
				<tr>
					<td colspan="7">
						<div class="azul">
							<img src="/xweb/public/images/info.png" border="0" width="20px" height="20px" />
							&nbsp;&nbsp;No hay datos en este apartado.
						</div>
					</td>
				</tr>
			@endif
		</table>
	</div>
</div>
<div class="row" style="display: none">
	<div class="col-xs-12 col-md-12 text-left">
		<h4 style="float:left; display: contents;">
			<div style="width: 630px; margin: auto; margin-bottom: 60px;">
				<div class="pfacturas2 divpresupu" style="font-size: 11pt; font-family: montserratregular;">{{T::tr('Relación de cobros recibidos pendientes de vencimiento:')}}</div>
			</div>
		</h4>
		<table data-toggle="table" data-pagination="true" data-page-list="[25,10]" border="0" align="center" style="width: 950px;" class="tdocumentos">
			<tr>
				<td>{{T::tr('Nº Factura')}}</td>
				<td>{{T::tr('Fecha')}}</td>
				<td>{{T::tr('Vencimiento')}}</td>
				<td>{{T::tr('Cobrado')}}</td>
			</tr>
			@if(count($datosCP) > 0)
				@foreach($datosCP as $dato)
					<tr>
						<td class="text-right"><a
							href="{{URL::to('documentos/factura/'.$dato->rfac)}}">{{Utils::pedidoBarras($dato->rfac)}}-{{Utils::numFormat($dato->rrec,0)}}</a></td>
						<td>{{Utils::fechaEsp($dato->rfecha)}}</td>
						<td>{{Utils::fechaEsp($dato->rfecvto)}}</td>
						<td class="text-right">{{Utils::numFormat($dato->rimp)}}</td>
						<td class="text-right">{{Utils::numFormat($dato->rimpcobr)}}</td>
						<td class="text-right">{{Utils::numFormat($dato->rpdte)}}</td>
					</tr>
				@endforeach
			@else
				<tr>
					<td colspan="7">
						<div class="azul">
							<img src="/xweb/public/images/info.png" border="0" width="20px" height="20px" />
							&nbsp;&nbsp;No hay datos en este apartado.
						</div>
					</td>
				</tr>
			@endif
		</table>
	</div>
</div>
@endif

<!-- listado de envios -->
@if($seccion=="envios")
<div class="row">
	<div class="col-xs-12 col-md-12 text-left">
		<h3 style="float:left; display: contents;">
			<div style="width: 630px; margin: auto; margin-bottom: 60px;">
				<div class="pfacturas2 divpresupu" style="font-size: 12pt; font-family: montserratregular;">{{T::tr('Pendiente de preparación')}}:</div>
			</div>
		</h3>
		<table data-toggle="table" data-pagination="true" data-page-list="[25,10]" border="0" align="center" style="width: 950px;" class="tdocumentos">
			<tr>
				<td>{{T::tr('Nº Pedido')}}</td>
				<td>{{T::tr('Estado')}}</td>
				<td>{{T::tr('Fecha pedido')}}</td>
				<td>{{T::tr('Bultos')}}</td>
				<td>{{T::tr('Agencia tte.')}}</td>
			</tr>
			@if(count($datosPE) > 0)
				@foreach($datosPE as $dato)
					<tr>
						<td class="text-right"><a
							href="{{URL::to('documentos/pedido/'.$dato->docum.'/1')}}">{{Utils::pedidoBarras($dato->docum)}}</a></td>
						<td>{{T::tr('Pendiente')}}</td>
						<td class="text-right">{{Utils::fechaEsp($dato->fecha)}}</td>
						<td class="text-right">{{Utils::numFormat($dato->bultos,0)}}</td>
						<td class="textoRojo">{{T::tr('No asignada')}}</td>
					</tr>
				@endforeach
			@else
				<tr>
					<td colspan="6">
						<div class="azul">
							<img src="/xweb/public/images/info.png" border="0" width="20px" height="20px" />
							&nbsp;&nbsp;No hay datos en este apartado.
						</div>
					</td>
				</tr>
			@endif
		</table>
	</div>
</div>
<div class="row">
	<div class="col-xs-12 col-md-12 text-left">
		<h4 style="float:left; display: contents;">
			<div style="width: 630px; margin: auto; margin-bottom: 60px;">
				<div class="pfacturas2 divpresupu" style="font-size: 12pt; font-family: montserratregular;">{{T::tr('Envíos preparados')}}:</div>
			</div>
		</h4>
		<table data-toggle="table" data-pagination="true" data-page-list="[25,10]" border="0" align="center" style="width: 950px; margin-top: 45px;" class="tdocumentos">
			<tr>
				<td>{{T::tr('Nº Albarán')}}</td>
				<td>{{T::tr('Estado')}}</td>
				<td>{{T::tr('Fecha envío')}}</td>
				<td>{{T::tr('Bultos')}}</td>
				<td>{{T::tr('Agencia tte.')}}</td>
				<td>{{T::tr('Seguimiento')}}</td>
			</tr>
			@if(count($datosPR) > 0)
				@foreach($datosPR as $dato)
					<tr>
						<td class="text-right"><a
							href="{{URL::to('documentos/albaran/'.$dato->docum)}}">{{Utils::pedidoBarras($dato->docum)}}</a></td>
						
						@if($dato->remesa==0)
						<td>{{($dato->descrage==""?T::tr('Sin envío'):T::tr('Pendiente'))}}</td>
						<td class="{{($dato->descrage==""?"textoVerde":"textoRojo")}}">{{($dato->descrage==""?T::tr('Sin envío'):T::tr('No enviado'))}}</td>
						@endif	
						@if($dato->remesa>0)
						<td>{{($dato->descrage==""?T::tr('Sin envío'):T::tr('Enviado'))}}</td>
						<td class="textoVerde">{{Utils::fechaEsp($dato->fecha)}}</td>
						@endif	
													
						<td class="text-right">{{Utils::numFormat($dato->bultos,0)}}</td>
						<td class="{{($dato->descrage==""?"textoVerde":"textoRojo")}}">{{($dato->descrage==""?"No
							asignada":$dato->descrage)}}</td>
						<td>
						@if(strlen($dato->vlinprod)>0 && strlen($dato->wnum)>0)
							<a href="{{str_replace('$$codigo',$dato->wnum,str_replace('$$cpostal',$dato->ccodpo,$dato->vlinprod))}}" target="_blank" title="cód. {{$dato->wnum}}">
							<span class="glyphicon glyphicon-download-alt"></span> cód. {{$dato->wnum}}</a>
						@endif
						</td>
					</tr>
				@endforeach
			@else
				<tr>
					<td colspan="6">
						<div class="azul">
							<img src="/xweb/public/images/info.png" border="0" width="20px" height="20px" />
							&nbsp;&nbsp;No hay datos en este apartado.
						</div>
					</td>
				</tr>
			@endif
		</table>
	</div>
</div>
@endif

<!-- NUEVO RMA -->
@if($seccion=="nuevorma")
	<div class="row">
		<div class="col-xs-12 col-md-12 text-left">
			<h3 style="float:left;">
			<i class="fa fa-share-square"></i> {{T::tr('Nuevo documento de RMA')}}
			</h3>
		</div>
		<!--objeto añadir producto-->
		<div class="col-xs-12 col-md-12 text-left">
			<label for="">{{T::tr('Añadir un producto')}}:</label>
		</div>
		<div class="form-group col-xs-5 col-md-2">
			<label for="rma_addproduct">{{T::tr('Producto')}}</label>
				<input type="text" class="form-control" maxlength="30"
				name="" id="rma_addproduct" v-model="rma_addproduct" value="" onclick="this.select()" @keyup="app.rma_buscarproducto('{{URL::to('buscarrma')}}')"
				placeholder="{{T::tr('Buscar código')}}" />
		</div>
		<div class="form-group col-xs-7 col-md-4">
			<label for="rma_addproduct_des">{{T::tr('Descripción')}}</label>
				<input type="text" class="form-control" maxlength="30"
				name="" id="rma_addproduct_des" v-model="rma_addproduct_des" value="" disabled
				placeholder="" />
		</div>
		<div class="form-group col-xs-5 col-md-4">
			<label for="rma_addproduct_solicita">{{T::tr('Solicitud')}}</label>
				<select class="form-control" id="rma_addproduct_solicita" name="rma_addproduct_solicita" v-model="rma_addproduct_solicita">
					<option value="0"></option>
					<option value="devolución y abono">{{T::tr('devolución y abono')}}</option>
					<option value="reparación en garantía">{{T::tr('reparación en garantía')}}</option>
					<option value="reparación fuera de garantía">{{T::tr('reparación fuera de garantía')}}</option>
					<option value="reposición (artículo nuevo defectuoso)">{{T::tr('reposición (artículo nuevo defectuoso)')}}</option>
					<option value="reposición (incidencia en el transporte)">{{T::tr('reposición (incidencia en el transporte)')}}</option>
				</select>
		</div>
		<div class="form-group col-xs-2 col-md-1">
			<label for="rma_addproduct_cantidad">{{T::tr('Cantidad')}}</label>
				<input type="number" id="rma_addproduct_cantidad" value="1" v-model="rma_addproduct_cantidad"
					class="form-control text-right" name="rma_addproduct_cantidad" id="rma_addproduct_cantidad"/>
		</div>
		<div class="form-group col-xs-2 col-md-1">
			<label for="">&nbsp;&nbsp;</label>
			<button type="" class="btn btn-success" onclick="app.rma_addrow()"><span class="glyphicon glyphicon-ok" style=""></span></button>
		</div>
		<div id="resul-div" class="form-group col-md-8 col-xs-12" v-show="rma_cajabusqueda"
				style="margin-left: 14px; border-style: groove;display:none;">
				<ul id="results">
					<li>
						<a href="#" v-on:click="" title="caramba">caramba</a>   caramba
					</li>
					<li v-for="(item,idx) in rma_json">
						<a href="#" v-on:click="rma_seleccionarproducto(item)" title="{!item.acodar!}">{!item.acodar!}</a>   {!item.adescr!}
					</li>
				</ul>
		</div>
		<!--grid de datos-->
		<div class="form-group col-xs-12 col-md-12">
			<table name="rmagrid" id="rmagrid" data-toggle="table_quitado" data-pagination="true" class="fondoblanco table table-striped table-bordered table-hover">
				<thead>
					<tr>
						<th>{{T::tr('Producto')}}</th>
						<th>{{T::tr('Descripción')}}</th>
						<th>{{T::tr('Solicitud')}}</th>
						<th>{{T::tr('Cantidad')}}</th>
						<th>x</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td class="" name="rprod">
						</td>
						<td class="" name="rdescri">
						</td>
						<td class="" name="rsoli">
						</td>
						<td class="text-right" name="rcanti">
						</td>
						<td class="" name="rx">
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<!--datos de recogida-->
		<div class="col-xs-12 col-md-12 text-left">
			<form @submit.prevent="app.rma_alta('{{URL::to('altarma')}}')" class="" role="form" method="post" action="{{URL::to('')}}" name="formRMA" id="formRMA">
				<input type="hidden" id="_token" name="_token" value="{{{ csrf_token() }}}" />
				<hr />

				<div class="form-group">
					<label><input type="checkbox" name="rma_recogida" v-model="rma_recogida" checked="checked">&nbsp;{{T::tr('Solicitar recogida')}}</label>
				</div>
				<div v-if="rma_recogida">
					<div class="form-group col-md-12">
						<label for="rma_recnombre">{{T::tr('Nombre del que envía')}}</label>
							<input type="text" class="form-control" maxlength="200"
							name="" id="rma_recnombre" v-model="rma_recnombre" value=""
							placeholder="{{T::tr('Nombre del que envía')}}" />
					</div>
					<hr />
					<div class="form-group col-md-12">
						<label for="rma_reccalle">{{T::tr('Calle')}}</label>
							<input type="text" class="form-control" maxlength="100"
							name="" id="rma_reccalle" v-model="rma_reccalle" value=""
							placeholder="{{T::tr('Calle ó plaza')}}" />
					</div>
					<div class="form-group col-md-4">
						<label for="rma_recpoblacion">{{T::tr('Población')}}</label>
							<input type="text" class="form-control" maxlength="50"
							name="" id="rma_recpoblacion" v-model="rma_recpoblacion" value=""
							placeholder="{{T::tr('Población')}}" />
					</div>
					<div class="form-group col-md-4">
						<label for="rma_recprovincia">{{T::tr('Provincia')}}</label>
							<input type="text" class="form-control" maxlength="30"
							name="" id="rma_recprovincia" v-model="rma_recprovincia" value=""
							placeholder="{{T::tr('Provincia')}}" />
					</div>
					<div class="form-group col-md-4">
						<label for="rma_recpostal">{{T::tr('Código Postal')}}</label>
							<input type="text" class="form-control" maxlength="10"
							name="" id="rma_recpostal" v-model="rma_recpostal" value=""
							placeholder="{{T::tr('Código Postal')}}" />
					</div>
					<hr />
					<div class="form-group col-md-4">
						<label for="rma_rectelefono">{{T::tr('Teléfono')}}</label>
							<input type="text" class="form-control" maxlength="20"
							name="" id="rma_rectelefono" v-model="rma_rectelefono" value=""
							placeholder="{{T::tr('Teléfono')}}" />
					</div>
					<div class="form-group col-md-4">
						<label for="rma_rechorario">{{T::tr('Horario')}}</label>
							<input type="text" class="form-control" maxlength="50"
							name="" id="rma_rechorario" v-model="rma_rechorario" value=""
							placeholder="{{T::tr('Horario')}}" />
					</div>
					<hr />
				</div>
				<div class="form-group col-md-8">
					<label for="rma_anotaciones">{{T::tr('Anotaciones')}}</label>
						<textarea rows="5" class="form-control" maxlength=""
						name="" id="rma_anotaciones" v-model="rma_anotaciones" value=""
						placeholder="Anotaciones"></textarea>
				</div>
			</form>
				<div class="form-group col-md-12">
					<label for="rma_anotaciones">{{T::tr('Adjuntar archivos')}}</label><br/>
					<input type="file" id="file1" ref="file1" v-on:change="rma_handleFileUpload('{{URL::to('altarma')}}',1)"/>
					<input type="file" id="file2" ref="file2" v-on:change="rma_handleFileUpload('{{URL::to('altarma')}}',2)"/>
					<input type="file" id="file3" ref="file3" v-on:change="rma_handleFileUpload('{{URL::to('altarma')}}',3)"/>
					<input type="file" id="file4" ref="file4" v-on:change="rma_handleFileUpload('{{URL::to('altarma')}}',4)"/>
					<input type="file" id="file5" ref="file5" v-on:change="rma_handleFileUpload('{{URL::to('altarma')}}',5)"/>
				</div>
				<div class="form-group col-md-12">
					<button type="submit" class="btn btn-success text-right" onclick="app.rma_alta('{{URL::to('altarma')}}')" style="float:right">Confirmar RMA</button>
				</div>
		</div>
	</div>
@endif
<!-- RMA -->
@if($seccion=="rma")
<div class="row">
	<div class="col-xs-12 col-md-12 text-left">
		<h3 style="float:left;">
		<i class="fa fa-share-square"></i> {{T::tr('Documentos de RMA')}}:
		</h3>
		<a href="{{URL::to('micuenta/nuevorma')}}" title="{{T::tr('Alta nuevo RMA')}}">
		<button type="" class="btn btn-lg btn-success text-right" onclick="" style="float:right;">{{T::tr('Alta nuevo RMA')}}</button>
		</a>
		<table data-toggle="table_quitado" data-pagination="true" data-page-list="[25,10]" class="fondoblanco table table-striped table-bordered table-hover">
			<thead>
				<tr>
					<th>{{T::tr('Nº RMA')}}</th>
					<th>{{T::tr('Fecha')}}</th>
					<th>{{T::tr('Ref.Cliente')}}</th>
					<th>{{T::tr('Estado')}}</th>
				</tr>
			</thead>
			<tbody>
				@foreach($datos as $dato)
				<tr>
					<td class="text-right">
						<a href="{{URL::to('documentos/rma/'.$dato->walba)}}" title="{{Utils::pedidoBarras($dato->walba)}}">{{Utils::pedidoBarras($dato->walba)}}</a>
					</td>
					<td class="{{($dato->canti==0?"textoVerde":"textoRojo")}}">{{Utils::fechaEsp($dato->wfecha)}}</td>
					<td class="">{{$dato->wrefcli}}</td>
					@if($dato->canti==0)
					<td class="textoVerde">{{T::tr('Pendiente')}}</td>
					@endif	
					@if($dato->canti>0)
					<td class="textoRojo">{{T::tr('Procesado')}}</td>
					@endif	
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
@endif

<!-- modelo 347 -->
@if($seccion=="modelo347")
<div class="div_historial_modelo347">
	<div class="pfacturas2 divpresupu" style="font-size: 12pt; font-family: montserratregular; display: contents;">{{T::tr('Elija el ejercicio')}}&nbsp;</div>
	<div class="rangofacturas2" style="float: left; display: contents;">
		<select id="anioejercicio" name="anioejercicio" onchange="document.location.href='/xweb/micuenta/modelo347/' + this.value;">
			@foreach($arrAniosModelo347 as $arrAnioModelo347)
				<option value="{{$arrAnioModelo347}}" <?php if ($annosele == $arrAnioModelo347) {?> selected <?php } ?>>{{$arrAnioModelo347}}</option>
			@endforeach
		</select>
	</div>
</div>
<div class="div_mensaje_modelo347">
	Si tiene alguna duda póngase en contacto con 
	<a href="mailto:contabilidad@diginova.es" style="color: #0b2e48; text-decoration: none;">contabilidad@diginova.es</a>
</div>
<div class="row">
	<div id="tableContables" class="col-xs-12 col-md-12 text-left overflow-x">
		<table class="tsolicitudes" border="0" align="center" style="width: 950px;" class="tdocumentos">
            <tr class="tsolicitudes1 tfacts1">
            	<td colspan="2" style="padding: 7px 0;">
            		<p class="lineaMiCuentaPC" style="margin: 0">&nbsp;&nbsp;&nbsp;&nbsp;Datos por trimestres</p>
            		<p class="lineaMiCuentaMv" style="margin: 0">Trimestres</p>
            	</td>
            	<td style="padding: 7px 0;">Base imponible</td>
            	<td>IVA</td>
            	<td>Recargo</td>
            	<td>Total</td>
            </tr>

            <?php
            for ($t = 1; $t <= 4; $t++)
            {
                ?>
                <tr>
                    <td style="padding-top: 20px"></td> <td style="font-weight: bold; text-align: left; padding-top: 20px;">ISP</td> 

                    <?php
                    $base0 = 0;
                    $iva0 = 0;
                    $rec0 = 0;
                    $total0 = 0;

                    $base0 = $matriz[$t]['sp'][0]->base;
                    $iva0 = $matriz[$t]['sp'][0]->iva;
                    $rec0 = $matriz[$t]['sp'][0]->rec;
                    $total0 = $matriz[$t]['sp'][0]->total;

                    $base0F = number_format($base0, 2, ",", "."); $base0F .= "&euro;";
                    $iva0F = number_format($iva0, 2, ",", "."); $iva0F .= "&euro;";
                    $rec0F = number_format($rec0, 2, ",", "."); $rec0F .= "&euro;";
                    $total0F = number_format($total0, 2, ",", "."); $total0F .= "&euro;";

                    ?>

                    <td style="text-align: right; padding-right: 70px; padding-top: 20px;"><?php echo $base0F; ?></td>
                    <td style="text-align: right; padding-right: 70px; padding-top: 20px;"><?php echo $iva0F; ?></td>
                    <td style="text-align: right; padding-right: 70px; padding-top: 20px;"><?php echo $rec0F; ?></td>
                    <td style="text-align: right; padding-right: 70px; padding-top: 20px;"><?php echo $total0F; ?></td>
                </tr>

                <tr>
                    <td>Trimestre <?php echo $t; ?></td> <td style="font-weight: bold; text-align: left;">IVA 21%</td> 

                    <?php
                    $base21 = $matriz[$t]['iva'][0]->base; 
                    $iva21 = $matriz[$t]['iva'][0]->iva;  
                    $rec21 = $matriz[$t]['iva'][0]->rec;  
                    $total21 = $matriz[$t]['iva'][0]->total;  

                    $base21F = number_format($base21, 2, ",", "."); $base21F .= "&euro;";
                    $iva21F = number_format($iva21, 2, ",", "."); $iva21F .= "&euro;";
                    $rec21F = number_format($rec21, 2, ",", "."); $rec21F .= "&euro;";
                    $total21F = number_format($total21, 2, ",", "."); $total21F .= "&euro;";
                    ?>

                    <td style="text-align: right; padding-right: 70px;"><?php echo $base21F; ?></td>
                    <td style="text-align: right; padding-right: 70px;"><?php echo $iva21F; ?></td>
                    <td style="text-align: right; padding-right: 70px;"><?php echo $rec21F; ?></td>
                    <td style="text-align: right; padding-right: 70px;"><?php echo $total21F; ?></td>
                </tr>

                <tr style="font-weight: bold;">
                    <td></td> <td style="font-weight: bold; text-align: left;">Total</td> 

                    <?php
                    $base21 = $matriz[$t]["total"]["base"]; 
                    $iva21 = $matriz[$t]["total"]["iva"]; 
                    $rec21 = $matriz[$t]["total"]["rec"]; 
                    $total21 = $matriz[$t]["total"]["total"]; 

                    $base21F = number_format($base21, 2, ",", "."); $base21F .= "&euro;";
                    $iva21F = number_format($iva21, 2, ",", "."); $iva21F .= "&euro;";
                    $rec21F = number_format($rec21, 2, ",", "."); $rec21F .= "&euro;";
                    $total21F = number_format($total21, 2, ",", "."); $total21F .= "&euro;";

                    ?>

                    <td style="text-align: right; padding-right: 70px;"><?php echo $base21F; ?></td>
                    <td style="text-align: right; padding-right: 70px;"><?php echo $iva21F; ?></td>
                    <td style="text-align: right; padding-right: 70px;"><?php echo $rec21F; ?></td>
                    <td style="text-align: right; padding-right: 70px;"><?php echo $total21F; ?></td>
                </tr>

                <?php
            }
            ?>

            <tr style="font-weight: bold;">
                <td style="padding-top: 20px;"></td> <td style="font-weight: bold; text-align: left; padding-top: 20px;">ISP</td> 

                <?php
                    $anioSPBaseF = number_format($anioSPBase, 2, ",", "."); $anioSPBaseF .= "&euro;";
                    $anioSPIvaF = number_format($anioSPIva, 2, ",", "."); $anioSPIvaF .= "&euro;";
                    $anioSPRecF = number_format($anioSPRec, 2, ",", "."); $anioSPRecF .= "&euro;";
                    $anioSPTotalF = number_format($anioSPTotal, 2, ",", "."); $anioSPTotalF .= "&euro;";

                    ?>

                    <td style="text-align: right; padding-right: 70px; padding-top: 20px;"><?php echo $anioSPBaseF; ?></td>
                    <td style="text-align: right; padding-right: 70px; padding-top: 20px;"><?php echo $anioSPIvaF; ?></td>
                    <td style="text-align: right; padding-right: 70px; padding-top: 20px;"><?php echo $anioSPRecF; ?></td>
                    <td style="text-align: right; padding-right: 70px; padding-top: 20px;"><?php echo $anioSPTotalF; ?></td>

                    <?php

                ?>

            </tr>

            <tr style="font-weight: bold;">
                <td>Total anual</td> <td style="font-weight: bold; text-align: left;">IVA 21%</td> 

                <?php
                    $anioIVABaseF = number_format($anioIVABase, 2, ",", "."); $anioIVABaseF .= "&euro;";
                    $anioIVAIvaF = number_format($anioIVAIva, 2, ",", "."); $anioIVAIvaF .= "&euro;";
                    $anioIVARecF = number_format($anioIVARec, 2, ",", "."); $anioIVARecF .= "&euro;";
                    $anioIVATotalF = number_format($anioIVATotal, 2, ",", "."); $anioIVATotalF .= "&euro;";

                    ?>

                    <td style="text-align: right; padding-right: 70px;"><?php echo $anioIVABaseF; ?></td>
                    <td style="text-align: right; padding-right: 70px;"><?php echo $anioIVAIvaF; ?></td>
                    <td style="text-align: right; padding-right: 70px;"><?php echo $anioIVARecF; ?></td>
                    <td style="text-align: right; padding-right: 70px;"><?php echo $anioIVATotalF; ?></td>

                    <?php

                ?>
            </tr>

            <tr style="font-weight: bold;">
                <td></td> <td style="font-weight: bold; text-align: left;">Total</td> 

                <?php
                    $anioTotalBase = $anioSPBase + $anioIVABase;
                    $anioTotalBaseF = number_format($anioTotalBase, 2, ",", "."); $anioTotalBaseF .= "&euro;";

                    $anioTotalIva = $anioSPIva + $anioIVAIva;
                    $anioTotalIvaF = number_format($anioTotalIva, 2, ",", "."); $anioTotalIvaF .= "&euro;";

                    $anioTotalRec = $anioSPRec + $anioIVARec;
                    $anioTotalRecF = number_format($anioTotalRec, 2, ",", "."); $anioTotalRecF .= "&euro;";

                    $anioTotalTotal = $anioSPTotal + $anioIVATotal;
                    $anioTotalTotalF = number_format($anioTotalTotal, 2, ",", "."); $anioTotalTotalF .= "&euro;";

                    ?>

                    <td style="text-align: right; padding-right: 70px;"><?php echo $anioTotalBaseF; ?></td>
                    <td style="text-align: right; padding-right: 70px;"><?php echo $anioTotalIvaF; ?></td>
                    <td style="text-align: right; padding-right: 70px;"><?php echo $anioTotalRecF; ?></td>
                    <td style="text-align: right; padding-right: 70px;"><?php echo $anioTotalTotalF; ?></td>

                    <?php

                ?>
            </tr>

        </table>

        <div style="font-family:montserratlight; font-size: 14pt; margin: 50px 0px 10px 0px; text-align: center;">Facturas:</div>

        <table class="tsolicitudes" border="0" align="center" style="width: 950px; margin-bottom: 50px;" class="tdocumentos">
        	<tr class="tsolicitudes1 tfacts1">
        		<td>Documento</td>
        		<td>Fecha</td>
        		<td style="padding: 7px 0;">Base imponible</td>
        		<td>IVA</td>
        		<td>Recargo</td>
        		<td>Total</td>
        		<td>PDF</td>
        	</tr>
        	@foreach($arrFacturasAnio as $arrFacturaAnio)
        		<tr>
	        		<td>{{$arrFacturaAnio->FDOC}}</td>
	        		<td>{{$arrFacturaAnio->FFECHA}}</td>
	        		<td style="padding: 7px 0;">{{$arrFacturaAnio->BASE}}€</td>
	        		<td>{{$arrFacturaAnio->IVA}}€</td>
	        		<td>{{$arrFacturaAnio->REC}}€</td>
	        		<td>{{$arrFacturaAnio->TOTAL}}€</td>
	        		<td>
						<a href="{{URL::to('descargarPDF/'.$arrFacturaAnio->CODPDF)}}" target="_blank" title="Download">
							<img align="top" src="/xweb/public/images/facpdf.jpg" border="0" width="15" height="15" title="Guardar PDF" alt="Guardar PDF">
						</a>
	        		</td>
	        	</tr>
        	@endforeach
        </table>
	</div>
</div>
@endif

<!-- tarifas de articulos -->
<!-- tarifas de articulos -->
<!-- tarifas de articulos -->
@if($seccion=="tarifas" && session('entorno')->config->x_downtarifas)
<div class="row">
	<h3>
	&nbsp;<i class="fa fa-table"></i> {{T::tr('Descarga de tarifas en formato Excel')}}:
	</h3>
	@if(session('entorno')->config->x_extarart)
	<div class="col-xs-12 col-md-12 text-left">
		<h4>
		<i class="fa fa-table"></i>&nbsp;<a href="{{URL::to('micuenta/tarifa_art')}}" target="_blank" title="{{T::tr('Tarifa de artículos')}}">{{T::tr('Tarifa de artículos')}}</a>
		</h4>
	</div>
	@endif
	@if(session('entorno')->config->x_extarfam)
	<div class="col-xs-12 col-md-12 text-left">
		<h4>
		<i class="fa fa-table"></i>&nbsp;<a href="{{URL::to('micuenta/tarifa_fam')}}" target="_blank" title="{{T::tr('Familias de artículos (compras)')}}">{{T::tr('Familias de artículos (compras)')}}</a>
		</h4>
	</div>
	@endif
	@if(session('entorno')->config->x_extarfcp)
	<div class="col-xs-12 col-md-12 text-left">
		<h4>
		<i class="fa fa-table"></i>&nbsp;<a href="{{URL::to('micuenta/tarifa_fcp')}}" target="_blank" title="{{T::tr('Familias de artículos (ventas)')}}">{{T::tr('Familias de artículos (ventas)')}}</a>
		</h4>
	</div>
	@endif
	@if(session('entorno')->config->x_extarblo)
	<div class="col-xs-12 col-md-12 text-left">
		<h4>
		<i class="fa fa-table"></i>&nbsp;<a href="{{URL::to('micuenta/tarifa_blo')}}" target="_blank" title="{{T::tr('Artículos bloqueados')}}">{{T::tr('Artículos bloqueados')}}</a>
		</h4>
	</div>
	@endif
</div>
@endif

<!-- seccion inicial, listado de opciones -->
<!-- seccion inicial, listado de opciones -->
<!-- seccion inicial, listado de opciones -->
@if($seccion=="")
	<div class="micuentaMenu">
		<a class="micuentaOpc" href="/xweb/micuenta/pedidos">
			<table>
				<tr>
					<td style="width: 60px;">
						<img src="{{URL::asset('public/images/icono_menu_izq.png')}}" width="32" height="32">
					</td>
					<td class="titulo_area_cliente" style="width: 625px;">Pedidos</td>
					<td style="width: 140px;">
						<img src="/xweb/public/images/icono_menu_pedidos.png" width="60" height="60">
					</td>
				</tr>
			</table>
		</a>
		<a class="micuentaOpc" href="/xweb/micuenta/facturas">
			<table>
				<tr>
					<td style="width: 60px;">
						<img src="{{URL::asset('public/images/icono_menu_izq.png')}}" width="32" height="32">
					</td>
					<td class="titulo_area_cliente" style="width: 625px;">Facturas</td>
					<td style="width: 140px;">
						<img src="/xweb/public/images/icono_menu_facturas.png" width="60" height="60">
					</td>
				</tr>
			</table>
		</a>
		<a class="micuentaOpc" href="/xweb/micuenta/pendiente">
			<table>
				<tr>
					<td style="width: 60px;">
						<img src="{{URL::asset('public/images/icono_menu_izq.png')}}" width="32" height="32">
					</td>
					<td class="titulo_area_cliente" style="width: 625px;">Recibos</td>
					<td style="width: 140px;">
						<img src="/xweb/public/images/icono_menu_recibos.png" width="60" height="60">
					</td>
				</tr>
			</table>
		</a>
		<a class="micuentaOpc" href="/xweb/micuenta/presupuestos">
			<table>
				<tr>
					<td style="width: 60px;">
						<img src="{{URL::asset('public/images/icono_menu_izq.png')}}" width="32" height="32">
					</td>
					<td class="titulo_area_cliente" style="width: 625px;">Presupuestos</td>
					<td style="width: 140px;">
						<img src="/xweb/public/images/icono_menu_presupuestos.png" width="60" height="60">
					</td>
				</tr>
			</table>
		</a>
		<a class="micuentaOpc" href="/xweb/micuenta/modelo347">
			<table>
				<tr>
					<td style="width: 60px;">
						<img src="{{URL::asset('public/images/icono_menu_izq.png')}}" width="32" height="32">
					</td>
					<td class="titulo_area_cliente" style="width: 625px;">Datos contables - Modelo 347</td>
					<td style="width: 140px;">
						<img src="/xweb/public/images/icono_menu_contab.png" width="60" height="60">
					</td>
				</tr>
			</table>
		</a>
		<a class="micuentaOpc" href="/xweb/micuenta/datos">
			<table>
				<tr>
					<td style="width: 60px;">
						<img src="{{URL::asset('public/images/icono_menu_izq.png')}}" width="32" height="32">
					</td>
					<td class="titulo_area_cliente" style="width: 625px;">Configuración de la cuenta</td>
					<td style="width: 140px;">
						<img src="/xweb/public/images/icono_menu_config.png" width="60" height="60">
					</td>
				</tr>
			</table>
		</a>
		<a class="micuentaOpc" href="/xweb/micuenta/direcciones">
			<table>
				<tr>
					<td style="width: 60px;">
						<img src="{{URL::asset('public/images/icono_menu_izq.png')}}" width="32" height="32">
					</td>
					<td class="titulo_area_cliente" style="width: 625px;">Mis direcciones de envío</td>
					<td style="width: 140px;">
						<img src="/xweb/public/images/icono_menu_pedidos.png" width="60" height="60">
					</td>
				</tr>
			</table>
		</a>

		<!--<a class="micuentaOpc micuentaOpc1" onclick="muestraDocumentos(1)"></a>
		<a class="micuentaOpc micuentaOpc9" href="/xweb/micuenta/pedidos"></a>
		<a class="micuentaOpc micuentaOpc2" href="/xweb/micuenta/pendiente"></a>
		<a class="micuentaOpc micuentaOpc4" href="/xweb/micuenta/envios"></a>
		<a class="micuentaOpc micuentaOpc5" href="/xweb/micuenta/modelo347"></a>
		<a class="micuentaOpc micuentaOpc6" href="/xweb/micuenta/datos"></a>
		<a class="micuentaOpc micuentaOpc7" href="/driver"></a>-->
	</div>
	<div id="menu_micuenta2" style="margin-top: 30px;">
		<div class="contenidocuenta" id="contenido_img1">
			<div class="contenidotitul">
				<span>Documentos del cliente</span>
			</div>
			<a href="/xweb/micuenta/presupuestos">Presupuestos</a>
			<a href="/xweb/micuenta/albaranes">Albaranes</a>
			<a href="/xweb/micuenta/facturas">Facturas</a>
		</div>
	</div>

	@if(session('entorno')->config->x_downtarifas)
	<div class="row micuenta">
		<div class="col-xs-12 col-md-12 text-left">
			<h3>
			<i class="fa fa-table"></i>&nbsp;<a
					href="{{URL::to('micuenta/tarifas')}}" title="{{T::tr('Tarifa en Excel')}}">{{T::tr('Tarifa en Excel')}}</a>
			</h3>
			<h4></h4>
		</div>
	</div>
	@endif
@endif 

<script type="text/javascript">

function envioMailSolicitudMayor(ccodcl, cliente, elemento)
{
    var formData = new FormData();
    formData.append('ccodcl', ccodcl);
    formData.append('cliente', cliente);
    formData.append('_token', $('#_token').val());
    formData.append('anioejercicio', $('#anioejercicio').val());

    $.ajax({
        url: '/xweb/envioMailSolicitudMayor',
        type: 'post',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {

            $(elemento).css('pointer-events', 'none');
            $(elemento).css('background', 'linear-gradient(to bottom, #b8e356 5%, #a5cc52 100%)');
            $(elemento).css('margin-left', '192px');
            $(elemento).text('✓ Solicitud enviada');
        }
    });
}

function solicitarCambioFiscal()
{
    var txtCambioFiscal = $('#tt_cambio_fiscal').val();
    var btnCambioFiscal = $('#btn_cambio_fiscal')[0].files[0];

    if ($('#btn_cambio_fiscal').get(0).files.length === 0)
    {
        $('#mensaje_error_solicitud').css('display', 'block');
    }
    else if (txtCambioFiscal == '')
    {
        $('#mensaje_error_solicitud').css('display', 'block');
    }
    else
    {
        var formData = new FormData();
        formData.append('txtCambioFiscal', txtCambioFiscal);
        formData.append('btnCambioFiscal', btnCambioFiscal);
        formData.append('_token', $('#_token2').val());

        $.ajax({
            url: '/xweb/envioMailCambioUsuario',
            type: 'post',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {

                $('#mensaje_exito_solicitud').css('display', 'block');
            }
        });
    }
}
</script>
@endsection
