@extends("base")

@section("dashboard")

<div class="devoluciones">
	@if(session('usuario')->uData->codigo == 0)
		<div class="rmaContSolicitudes">
			<div class="rmaSolT">
				<div class="rmaSolC" style="padding: 90px 0;"> 
					Por favor, inicia sesión para continuar
					<br /><br /><br /><br /><br /><br /><br /><br /><br />
				</div>
			</div>
		</div>
	@else
		<div class="devoluciones1" id="devoluciones1">
			<div class="devolCab">
				<div class="devolCabTD devolCab1">
					<span style="font-size: 16pt; ">Devoluciones</span>
					<br /><br /><br />
					<span style="color: #5d7ea4; font-weight: bold; font-size: 10pt;">M&eacute;todo de env&iacute;o</span>
				</div>
				
				<div class="devolCabTD devolCab2" style="visibility: hidden;">
					<div class="devolCab2_1">
						<img src="/xweb/public/images/devol.jpg">
					</div>
						
					<div class="devolCab2_2" >
						<form>
							<input type="hidden" name="codigoBusq" id="codigoBusq" value="{{$ccodcl}}" />
							<span style="font-size: 10pt;">Referencia / nº de serie:</span><br /><br />
							<input type="text" class="devolbuscar" name="devolbuscar" id="devolbuscar" placeholder="Buscar..."  oninput="buscadorDevoluciones()" />
						</form>
					</div>
				</div>
			</div>

			<div class="devolArticulosT" id="devolArticulosT" style="margin-top: 0px;">
				<br/><br/>
				<div class="fingarantia" style="display: block;">
					<div class="rmaC2" style="text-align: center;">
						
						<form action="/xweb/devolucionguardar" method="post" onsubmit="return confirm('&iquest;Confirma que desea enviar la solicitud?')" >
							<input type="hidden" name="_token" value="{{csrf_token()}}"/>
							<input type="hidden" name="portes_precio" value="{{$recogidaPrecio}}" />
							<div class="devolRmaEnvio">
								<div style="font-weight: bold; width: 600px; text-align: left; margin: 0 auto 20px auto;">&iquest;Desea que recojamos nosotros el paquete? </b></div>
								<div class="devolRmaEnvioTR">
									<div class="devolRmaEnvioTD">
										<div class="devolRmaEnvioTD1"><img src="/xweb/public/images/devenvio1.png" /></div>

										<div class="devolRmaEnvioTD2">
											<div class="devolRmaEnvioTD2_1">
												<input type="radio" {{$disabled}}  id="tipoenvio" name="tipoenvio" value="recogida"  />
												Sí (coste de {{$recogidaPrecioF}}&euro; iva incl.)
											</div>
										</div>

										<div class="devolRmaEnvioTD3">
											<div style="display: block;">Se generará una factura por este importe en el momento de recoger la mercanc&iacute;a.</div>
											<div style="color: black; display: none;">Opci&oacute;n temporalmente no disponible.</div>
										</div>

										<div class="devolRmaEnvioTD4" style="visibility: hidden;">
											<a class="devolRmaEnvioTD4A" href="/xweb/devolucion">
												<< REGRESAR
											</a>
										</div>
									</div>

									<div class="devolRmaEnvioTD" style="border-left: 0;">
										<div class="devolRmaEnvioTD1"><img src="/xweb/public/images/devenvio0.png" /></div>

										<div class="devolRmaEnvioTD2">
											<div class="devolRmaEnvioTD2_1">
												<input type="radio" checked="" id="tipoenvio" name="tipoenvio" value="agencia" />
												No (enviarlo por su agencia)
											</div>
										</div>

										<div class="devolRmaEnvioTD3">
											&nbsp;
										</div>
										<div class="devolRmaEnvioTD4">
											<input class="devolRmaEnvioTD4A" type="submit" name="enviarrma" id="enviarrma" value="CONTINUAR >>" />
										</div>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>

				<br />
				<br />
				<br />
			</div>
		</div>

		<div class="devoluciones2">
			<div class="devolCestaCab">Productos a devolver</div>

			<div class="devolCesta">
				<div class="devolCestaArts">
					@foreach ($arrArtsDevolucion as $artDev) 

						<div class="devolCestaArt <?php if ($artDev->rautorizado == 0) { echo "devolCestaArtNoAut"; } ?>">
							<div class="devolCestaArt1">
								@if ($artDev->rautorizado == 0)
									<img src="/xweb/public/images/devces1.jpg" />
								@endif
								<img title="{{$artDev->rdescr}}" src="{{$artDev->urlfoto}}" width="75" />
								<br />
								{{$artDev->rcodar}}
								<br />
								@if ($artDev->rautorizado == 0)
									<img src="/xweb/public/images/devces2.jpg" style="margin-top: 2px;" />
								@endif
							</div>

							<div class="devolCestaArt2">
								<form method="post" action="/xweb/devolucion" onsubmit="return confirm('&iquest;Eliminar de la solicitud?');">
									<input type="hidden" name="_token" value="{{ csrf_token() }}"/>
									<input type="hidden" name="devolElim" value="1" />
									<input type="hidden" name="idartic" value="{{$artDev->id}}" />
									<input type="image" title="Quitar de la solicitud" src="/xweb/public/images/deleteicon1.png" width="10" height="10" />
								</form>
							</div>
						</div>
					@endforeach
				</div>
			</div>
		</div>
	@endif
</div>

@endsection