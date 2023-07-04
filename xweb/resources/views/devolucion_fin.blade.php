@extends("base")

@section("dashboard")

<div class="devoluciones">
	
	@if ($ccodcl == 0)
		<div class="rmaContSolicitudes">
			<div class="rmaSolT">
				<div class="rmaSolC" style="padding: 60px 0; font-size: 14pt;"> 
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
					<span style="color: #5d7ea4; font-weight: bold; font-size: 10pt;"></span>
				</div>
				
				<div class="devolCabTD devolCab2">
					<div class="devolCab2_1">
						<img src="/xweb/public/images/devol.jpg">
					</div>
						
					<div class="devolCab2_2">
						<form>
							<input type="hidden" name="codigoBusq" id="codigoBusq" value="{{$ccodcl}}" />
							<span style="font-size: 10pt;">Referencia / nº de serie:</span><br /><br />
							<input type="text" class="devolbuscar" name="devolbuscar" id="devolbuscar" placeholder="Buscar..."  oninput="buscadorDevoluciones()" />
						</form>
					</div>
				</div>
			</div>

			<br/>
			@if (Request::has('enviarrma'))

				@if (count($arrRMAs) > 0)

					@if (!$soloRMA)
						<div class="devolCab" style="background-color: #80ff9a; ">
							<br /><span style='font-weight: bold; font-size: 11pt;'>SOLICITUD DE RMA COMPLETADA</span><br /><br />
							<span style='font-weight: bold; font-size: 10pt;'>Por favor, espere la autorización de la devolución solicitada</span><br /><br />
						</div>
					@else
						<div></div>
					@endif

				@endif
			@endif

			<div class="devolArticulosT" id="devolArticulosT">
				<div class="fingarantia" style="display: block;">
					
					@if (!$soloRMA)
						<div>
							<br /><br /><b>POR FAVOR, SIGUE ESTAS SENCILLAS INSTRUCCIONES:</b>
						</div>

						<br /><br />

						<div class="rmaC2" style="text-align: center;"><br /><br />
							<a href="/resources/pdfrma/{{$nomPDF2}}">
								<img src="/xweb/public/images/rmapasos.png">
							</a>
						</div>

						<div class="rmaC2" style="display: none;">
							<div class="rmaTPasos">
								<div class="rmaPasos"><span class="bold rmaAzul">1.</span> Guarda el equipo en su embalaje original o en otro resistente.</div>
								<div class="rmaPasos">
									<span class="bold rmaAzul">2.</span> Imprime estos dos PDF. Podrás volver a consultarlos en la sección de RMA:<br />
									<div style="width: 200px; display: table; margin-top: 10px;">
										<div style="display: table-cell; width: 50px; vertical-align: middle;">
											<div style="display: table-cell; width: 50%; vertical-align: middle;">
												<img src="/xweb/public/images/pdfdownload.jpg" width="25" />
											</div>

											<div style="display: table-cell; vertical-align: middle;">
												<a style="text-decoration: none; color: #376696;" class="linkpdf linkpdf2" href="/xweb/public/pdfrma/descargar/{{$nomPDF}}">RMA</a>
											</div>
										</div>
										<div style="display: table-cell; width: 50%; vertical-align: middle;">
											<div style="display: table-cell; width: 50%; vertical-align: middle;">
												<img src="/xweb/public/images/pdfdownload.jpg" width="25" />
											</div>

											<div style="display: table-cell; vertical-align: middle;">
												<a style="text-decoration: none; color: #376696;" class="linkpdf linkpdf2" href="/xweb/public/pdfrma/descargar/{{$nomPDF2}}">Env&iacute;o</a>
											</div>
										</div>
									</div>
								</div>

								<div class="rmaPasos"><span class="bold rmaAzul">3.</span> Introduce la hoja con el motivo de la devolución en el paquete.<br /><br />Pega en el exterior la copia con el número de parte e información del cliente.</div>
							</div>

							<div class="rmaTPasos">
								<div class="rmaPasos2"><span class="bold rmaAzul">4.</span> Realiza el envío a portes pagados.<br /><br />No se aceptarán envíos a portes debidos salvo autorización expresa del Departamento de RMA.</div>
								<div class="rmaPasos2"><span class="bold rmaAzul">5.</span> Tan pronto se haya resuelto el caso, recibirás un correo electrónico confirmando el abono o envío del equipo reparado.</div>
							</div>
						</div>
					@else
						<div>
							<br /><br />
							<b>Se ha generado RMA con el n&uacute;mero {{$rmacreado}}. El departamento de RMA se pondr&aacute; en contacto con usted.</b>
							<!--<b>Se ha generado RMA con el n&uacute;mero <?php //echo $numRMA; ?>. Por favor, copie este n&uacute;mero y facil&iacute;telo en el centro de soporte para atender su solicitud.</b>-->											
						</div>
						<br /><br />
					@endif

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
									<img src="images/devces2.jpg" style="margin-top: 2px;" />
								@endif
							</div>

							<div class="devolCestaArt2">
								<form method="post" action="" onsubmit="return confirm('&iquest;Eliminar de la solicitud?');">
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