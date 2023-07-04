<style>
.solido {
	border: 1px #000000 solid;
	border-collapse: collapse;
	padding: 3px;
}
</style>

<table style="border-collapse: collapse; display: block; table-layout: fixed; width: 800px;">
	<thead>
		<tr>
			@if($desgloseCesta->importeDescuentoCliente > 0 || $desgloseCesta->descuentoPromociones<>0)
			<td colspan="7">
			@else
			<td colspan="6">
			@endif
				<img src="https://diginova.es/testmail2/img/diginovaemail.png" style="width: 100.2%; margin-bottom: -5px; margin-left: -1px;">
			</td>
		</tr>
		<tr style="background-color: #333333;">
			<td style="font-family: sans-serif; font-weight: 600; color: #cccccc; padding: 12px; font-size: 11pt;"></td>
			<td style="font-family: sans-serif; font-weight: 600; color: #cccccc; padding: 12px; font-size: 11pt;">Código</td>
			<td style="font-family: sans-serif; font-weight: 600; color: #cccccc; padding: 12px; font-size: 11pt;">Descr. Artículo</td>
			<td style="font-family: sans-serif; font-weight: 600; color: #cccccc; padding: 12px; font-size: 11pt; text-align: center">Cantidad</td>
			<td style="font-family: sans-serif; font-weight: 600; color: #cccccc; padding: 12px; font-size: 11pt; text-align: right;">Precio</td>
			<td style="font-family: sans-serif; font-weight: 600; color: #cccccc; padding: 12px; font-size: 11pt; text-align: right; background-color: #444444">Importe</td>
		</tr>
	</thead>
	<tbody>
		<?php 
		$contFila = 0; 
		$importePortes = $portes;

        $matrizCesta = collect($matrizCesta)->sortBy('esAmpliacion')->toArray();
		?>

		@foreach($matrizCesta as $bces)
			@if (!$bces->esAmpliacion || $bces->acodar == 'POG' || $bces->acodar == 'POA' || $bces->acodar == 'POV' || $bces->acodar == 'POGS' || $bces->acodar == 'POAS' || $bces->acodar == 'PO')
				@if ($bces->acodar == 'POG' || $bces->acodar == 'POA' || $bces->acodar == 'POV' || $bces->acodar == 'POGS' || $bces->acodar == 'POAS' || $bces->acodar == 'PO')
					<?php
					//$importePortes += $bces->totalLinea;
					?>
				@else
					<?php 
					$contFila += 1;
					$refImagen = strtolower($bces->acodar);
					$enlaceImg = 'https://diginova.es/xweb3/fotoartic/art_'.$refImagen.'_1.jpg';
					?>
					<tr style="background-color: #f9f9f9">
						<td style="font-family: sans-serif; color: #333333; padding: 10px 10px; font-size: 11pt; border-bottom: 1px #333 solid; text-align: left;">
							@if (is_array(@getimagesize($enlaceImg)))
								<img src="https://diginova.es/xweb3/fotoartic/art_{{$refImagen}}_1.jpg" width="50" />
							@endif
						</td>
						<td style="font-family: sans-serif; color: #333333; padding: 10px 10px; font-size: 11pt; border-bottom: 1px #333 solid; text-align: left;">{{$bces->acodar}}</td>
						<td style="font-family: sans-serif; color: #333333; padding: 10px 10px; font-size: 11pt; border-bottom: 1px #333 solid; text-align: left;">{{$bces->adescr}}</td>
						<td style="font-family: sans-serif; color: #333333; padding: 10px 10px; font-size: 11pt; border-bottom: 1px #333 solid; text-align: center;">
							{{Utils::numFormat($bces->cantiCesta,0)}}
						</td>
						<td style="font-family: sans-serif; color: #333333; padding: 20px 10px; font-size: 11pt; border-bottom: 1px #333 solid; text-align: right;">
							{{Utils::numFormat($bces->precioSinIva,2)}}€
						</td>
				
						<td style="font-family: sans-serif; color: #333333; padding: 20px 10px; font-size: 11pt; border-bottom: 1px #333 solid; text-align: right; background-color: #e2e2e2;">						{{Utils::numFormat($bces->totalLinea)}}€
						</td>
					</tr>
					<?php
					for ($i = 0; $i < count($bces->ampliacion); $i++) 
					{ 
						$refImagen = strtolower($bces->ampliacion[$i]);
						$enlaceImg = 'https://diginova.es/xweb3/fotoartic/art_'.$refImagen.'_1.jpg';
						?>
						<tr style="background-color: #f9f9f9">
							<td style="font-family: sans-serif; color: #333333; padding: 10px 10px; font-size: 11pt; border-bottom: 1px #333 solid; text-align: left;"></td>
							<td style="font-family: sans-serif; color: #333333; padding: 10px 10px; font-size: 11pt; border-bottom: 1px #333 solid; text-align: left;">{{$bces->ampliacion[$i]}}</td>
							<td style="font-family: sans-serif; color: #333333; padding: 10px 10px; font-size: 11pt; border-bottom: 1px #333 solid; text-align: left;">{{$bces->descrAmpliacion[$i]}}</td>
							<td style="font-family: sans-serif; color: #333333; padding: 10px 10px; font-size: 11pt; border-bottom: 1px #333 solid; text-align: center;">
								{{Utils::numFormat($bces->cantAmpliacion[$i], 0)}}
							</td>
							<td style="font-family: sans-serif; color: #333333; padding: 20px 10px; font-size: 11pt; border-bottom: 1px #333 solid; text-align: right;">
								{{Utils::numFormat($bces->precioAmpliacion[$i], 2)}}€
							</td>
					
							<td style="font-family: sans-serif; color: #333333; padding: 20px 10px; font-size: 11pt; border-bottom: 1px #333 solid; text-align: right; background-color: #e2e2e2;">				{{Utils::numFormat($bces->importeAmpliacion[$i], 2)}}€
							</td>
						</tr>
						<?php
					}
					?>
				@endif
			@endif
		@endforeach

		@if($desgloseCesta->importeDescuentoCliente > 0)
			<tr style="background-color: #333333">
				<td style="font-family: sans-serif; color: #ccc; padding: 5px 12px; font-size: 10pt; border-bottom: 1px #333 solid"></td>
				<td style="font-family: sans-serif; color: #ccc; padding: 5px 12px; font-size: 10pt; border-bottom: 1px #333 solid"></td>
				<td style="font-family: sans-serif; color: #ccc; padding: 5px 12px; font-size: 10pt; border-bottom: 1px #333 solid"></td>
				<td style="font-family: sans-serif; color: #ccc; padding: 5px 12px; font-size: 10pt; border-bottom: 1px #333 solid"></td>
				<td style="font-family: sans-serif; color: #ccc; padding: 5px 12px; font-size: 10pt; border-bottom: 1px #333 solid"></td>
				<td style="font-family: sans-serif; color: #fff; padding: 5px 12px; font-size: 10pt; border-bottom: 1px #333 solid">
					<span style="font-weight: 600">Descuento {{Utils::numFormat($desgloseCesta->descuentoCliente)}}%: </span>
				</td>
				<td style="font-family: sans-serif; color: #fff; padding: 5px 12px; font-size: 10pt; text-align: right; font-weight: 600; background-color: #444444;">
					<span style="font-weight: 600">{{Utils::numFormat($desgloseCesta->importeDescuentoCliente)}}€</span>
				</td>
			</tr>
		@endif

		<?php
		//$sumaTotalArticulos = $desgloseCesta->sumaTotalSinImpuestos - $importePortes;
		$sumaTotalArticulos = $desgloseCesta->sumaTotalSinImpuestos;
		$articulosYportes = $sumaTotalArticulos + $importePortes;
		
		$iva2 = $desgloseCesta->iva2; 

	    //if ($cinvsujpas == "N" && $desgloseCesta -> iva2 > 0 ) { $iva2 = $articulosYportes * 0.21; }
	    //if ($cinvsujpas == "S" && $desgloseCesta -> iva2 > 0) { $iva2 = $desgloseCesta -> iva2; } 

		if ( $desgloseCesta->iva2 != 0 ) { $iva2 = $articulosYportes * 0.21; }

		$rec2 = $desgloseCesta->rec2;

	    //if ($cinvsujpas == "N" && $desgloseCesta -> rec2 > 0 ) { $rec2 = $articulosYportes * 0.052; }
	    //if ($cinvsujpas == "S" && $desgloseCesta -> rec2 > 0) { $rec2 = $desgloseCesta -> rec2; } 

		if ( $desgloseCesta->rec2 != 0 ) { $rec2 = $articulosYportes * 0.052; }

		$total = $articulosYportes + $iva2 + $rec2;

		?>

		<tr style="background-color: #333333">
			<td style="font-family: sans-serif; color: #ccc; padding: 5px 12px; font-size: 10pt; border-bottom: 1px #333 solid"></td>
			<td style="font-family: sans-serif; color: #ccc; padding: 5px 12px; font-size: 10pt; border-bottom: 1px #333 solid"></td>
			<td style="font-family: sans-serif; color: #ccc; padding: 5px 12px; font-size: 10pt; border-bottom: 1px #333 solid"></td>
			<td style="font-family: sans-serif; color: #ccc; padding: 5px 12px; font-size: 10pt; border-bottom: 1px #333 solid"></td>
			@if($desgloseCesta->importeDescuentoCliente > 0)
				<td style="font-family: sans-serif; color: #ccc; padding: 5px 12px; font-size: 10pt; border-bottom: 1px #333 solid"></td>
			@endif
			<td style="font-family: sans-serif; color: #fff; padding: 5px 12px; font-size: 10pt; border-bottom: 1px #333 solid; text-align: right">
				<span style="font-weight: 600">{{T::tr('Suma')}}</span>
			</td>
			<td style="font-family: sans-serif; color: #fff; padding: 5px 12px; font-size: 10pt; text-align: right; font-weight: 600; background-color: #444444;">
				<span style="font-weight: 600">{{Utils::numFormat($sumaTotalArticulos)}}€</span>
			</td>
		</tr>

		<tr style="background-color: #333333">
			<td style="font-family: sans-serif; color: #ccc; padding: 5px 12px; font-size: 10pt; border-bottom: 1px #333 solid"></td>
			<td style="font-family: sans-serif; color: #ccc; padding: 5px 12px; font-size: 10pt; border-bottom: 1px #333 solid"></td>
			<td style="font-family: sans-serif; color: #ccc; padding: 5px 12px; font-size: 10pt; border-bottom: 1px #333 solid"></td>
			<td style="font-family: sans-serif; color: #ccc; padding: 5px 12px; font-size: 10pt; border-bottom: 1px #333 solid"></td>
			<td style="font-family: sans-serif; color: #fff; padding: 5px 12px; font-size: 10pt; border-bottom: 1px #333 solid; text-align: right">
				<span style="font-weight: 600">{{T::tr('Portes')}}</span>
			</td>
			<td style="font-family: sans-serif; color: #fff; padding: 5px 12px; font-size: 10pt; text-align: right; font-weight: 600; background-color: #444444;">
				<span style="font-weight: 600">{{Utils::numFormat($importePortes)}}€</span>
			</td>
		</tr>

		<tr style="background-color: #333333">
			<td style="font-family: sans-serif; color: #ccc; padding: 5px 12px; font-size: 10pt; border-bottom: 1px #333 solid"></td>
			<td style="font-family: sans-serif; color: #ccc; padding: 5px 12px; font-size: 10pt; border-bottom: 1px #333 solid"></td>
			<td style="font-family: sans-serif; color: #ccc; padding: 5px 12px; font-size: 10pt; border-bottom: 1px #333 solid"></td>
			<td style="font-family: sans-serif; color: #ccc; padding: 5px 12px; font-size: 10pt; border-bottom: 1px #333 solid"></td>
			<td style="font-family: sans-serif; color: #fff; padding: 5px 12px; font-size: 10pt; border-bottom: 1px #333 solid; text-align: right">
				<span style="font-weight: 600">{{T::tr('I.V.A.')}}</span>
			</td>
			<td style="font-family: sans-serif; color: #fff; padding: 5px 12px; font-size: 10pt; text-align: right; font-weight: 600; background-color: #444444;">
				<span style="font-weight: 600">{{Utils::numFormat($iva2)}}€</span>
			</td>
		</tr>

		@if($desgloseCesta->rec2 > 0)
			<tr style="background-color: #333333">
				<td style="font-family: sans-serif; color: #ccc; padding: 5px 12px; font-size: 10pt; border-bottom: 1px #333 solid"></td>
				<td style="font-family: sans-serif; color: #ccc; padding: 5px 12px; font-size: 10pt; border-bottom: 1px #333 solid"></td>
				<td style="font-family: sans-serif; color: #ccc; padding: 5px 12px; font-size: 10pt; border-bottom: 1px #333 solid"></td>
				<td style="font-family: sans-serif; color: #ccc; padding: 5px 12px; font-size: 10pt; border-bottom: 1px #333 solid"></td>
				<td style="font-family: sans-serif; color: #fff; padding: 5px 12px; font-size: 10pt; border-bottom: 1px #333 solid; text-align: right">
					<span style="font-weight: 600">{{T::tr('Recargo')}}</span>
				</td>
				<td style="font-family: sans-serif; color: #fff; padding: 12px; font-size: 10pt; text-align: right; font-weight: 600; background-color: #444444;">
					<span style="font-weight: 600">{{Utils::numFormat($rec2)}}€</span>
				</td>
			</tr>
		@endif

		<tr style="background-color: #333333">
			<td style="font-family: sans-serif; color: #ccc; padding: 10px 10px; font-size: 11pt; border-bottom: 1px #333 solid"></td>
			<td style="font-family: sans-serif; color: #ccc; padding: 10px 10px; font-size: 11pt; border-bottom: 1px #333 solid"></td>
			<td style="font-family: sans-serif; color: #ccc; padding: 10px 10px; font-size: 11pt; border-bottom: 1px #333 solid"></td>
			<td style="font-family: sans-serif; color: #ccc; padding: 10px 10px; font-size: 11pt; border-bottom: 1px #333 solid"></td>
			@if($desgloseCesta->importeDescuentoCliente > 0)
				<td style="font-family: sans-serif; color: #ccc; padding: 12px; font-size: 10pt; border-bottom: 1px #333 solid"></td>
			@endif
			<td style="font-family: sans-serif; color: #fff; padding: 10px 10px; font-size: 11pt; border-bottom: 1px #333 solid; text-align: right; font-weight: 600">
				<span style="font-weight: 600">TOTAL: </span>
			</td>
			<td style="font-family: sans-serif; color: #fff; padding: 10px 10px; font-size: 11pt; text-align: right; font-weight: 600; background-color: #444444;">
				<span style="font-weight: 600; font-size: 12pt;">{{Utils::numFormat($total)}}€</span>
			</td>
		</tr>

		@if ($desgloseCesta->anotaciones != "")
			<tr style="background-color: #f9f9f9">
				@if($desgloseCesta->importeDescuentoCliente > 0)
				<td style="font-family: sans-serif; color: #333333; padding: 10px 10px; font-size: 11pt; border-bottom: 1px #333 solid; text-align: left; padding-top: 35px" colspan="7">
				@else
				<td style="font-family: sans-serif; color: #333333; padding: 10px 10px; font-size: 11pt; border-bottom: 1px #333 solid; text-align: left; padding-top: 35px" colspan="6">
				@endif
					<ul style="padding-inline-start: 15px; margin-block-start: 0em; margin-block-end: 0em;">
						<li>Observaciones del cliente: <span style="font-weight: 600; color: #333333;">{{$desgloseCesta->anotaciones}}</span></li>
					</ul>
				</td>
			</tr>
		@endif

		<tr style="background-color: #efefef">
			@if($desgloseCesta->importeDescuentoCliente > 0)
			<td style="font-family: sans-serif; color: #333333; padding: 5px 10px; font-size: 11pt; border-bottom: 1px #333 solid; text-align: left;" colspan="7">
			@else
			<td style="font-family: sans-serif; color: #333333; padding: 5px 10px; font-size: 11pt; border-bottom: 1px #333 solid; text-align: left;" colspan="6">
			@endif
				<ul style="padding-inline-start: 15px; margin-block-start: 0em; margin-block-end: 0em;">
					<li>Número de pedido: <span style="font-weight: 600; color: #333333;">{{$desgloseCesta->numPedido}}</span></li>
				</ul>
			</td>
		</tr>

		<tr style="background-color: #f9f9f9">
			@if($desgloseCesta->importeDescuentoCliente > 0)
			<td style="font-family: sans-serif; color: #333333; padding: 5px 10px; font-size: 11pt; border-bottom: 1px #333 solid; text-align: left;" colspan="7">
			@else
			<td style="font-family: sans-serif; color: #333333; padding: 5px 10px; font-size: 11pt; border-bottom: 1px #333 solid; text-align: left;" colspan="6">
			@endif
				<ul style="padding-inline-start: 15px; margin-block-start: 0em; margin-block-end: 0em;">
					<li>Forma de pago: 
						<span style="font-weight: 600; color: #333333;">
							@foreach($formasPago as $fpag)
								@if($fpag->wcod==$desgloseCesta->formaPago)
									@if ($fpag->wcod == 7)
										{{$nomFormaPago}}
									@else
										{{$fpag->wtit}}
									@endif
								@endif
							@endforeach
						</span>
					</li>
				</ul>
			</td>
		</tr>

		<tr style="background-color: #efefef">
			<td style="font-family: sans-serif; color: #333333; padding: 5px 10px; font-size: 11pt; border-bottom: 1px #333 solid; text-align: left;" colspan="7">
				<ul style="padding-inline-start: 15px; margin-block-start: 0em; margin-block-end: 0em;">
					<li>Código de cliente: <span style="font-weight: 600; color: #333333;">{{session("usuario")->uData->codigo}}</span></li>
				</ul>
			</td>
		</tr>

		<tr style="background-color: #f9f9f9">
			@if($desgloseCesta->importeDescuentoCliente > 0)
			<td style="font-family: sans-serif; color: #333333; padding: 5px 10px; font-size: 11pt; border-bottom: 1px #333 solid; text-align: left;" colspan="7">
			@else
			<td style="font-family: sans-serif; color: #333333; padding: 5px 10px; font-size: 11pt; border-bottom: 1px #333 solid; text-align: left;" colspan="6">
			@endif
				<ul style="padding-inline-start: 15px; margin-block-start: 0em; margin-block-end: 0em;">
					<li>Persona de contacto: <span style="font-weight: 600; color: #333333;">{{session("usuario")->uData->cnom}}</span></li>
				</ul>
			</td>
		</tr>

		<tr style="background-color: #efefef">
			@if($desgloseCesta->importeDescuentoCliente > 0)
			<td style="font-family: sans-serif; color: #333333; padding: 5px 10px; font-size: 11pt; border-bottom: 1px #333 solid; text-align: left;" colspan="7">
			@else
			<td style="font-family: sans-serif; color: #333333; padding: 5px 10px; font-size: 11pt; border-bottom: 1px #333 solid; text-align: left;" colspan="6">
			@endif
				<ul style="padding-inline-start: 15px; margin-block-start: 0em; margin-block-end: 0em;">
					<li>E-mail: <span style="font-weight: 600; color: #333333;">{{session('usuario')->uData->cmail}}</span></li>
				</ul>
			</td>
		</tr>

		<tr style="background-color: #efefef">
			@if($desgloseCesta->importeDescuentoCliente > 0)
			<td style="font-family: sans-serif; color: #333333; padding: 5px 10px; font-size: 11pt; border-bottom: 1px #333 solid; text-align: left;" colspan="7">
			@else
			<td style="font-family: sans-serif; color: #333333; padding: 5px 10px; font-size: 11pt; border-bottom: 1px #333 solid; text-align: left;" colspan="6">
			@endif
				<ul style="padding-inline-start: 15px; margin-block-start: 0em; margin-block-end: 0em;">
					<li>Dirección de envío: <span style="font-weight: 600; color: #333333;">{{$centroEnvioPedido}}</span></li>
				</ul>
			</td>
		</tr>
		
		<tr style="background-color: #f9f9f9">
			@if($desgloseCesta->importeDescuentoCliente > 0)
			<td style="font-family: sans-serif; color: #333333; padding: 5px 10px; font-size: 11pt; border-bottom: 1px #333 solid; text-align: left;" colspan="7">
			@else
			<td style="font-family: sans-serif; color: #333333; padding: 5px 10px; font-size: 11pt; border-bottom: 1px #333 solid; text-align: left;" colspan="6">
			@endif
				<ul style="padding-inline-start: 15px; margin-block-start: 0em; margin-block-end: 0em;">
					<li>¿Consultas sobre tu pedido?: haz clic <a href="https://diginova.es/xweb/preguntasfrecuentes">aquí</a></li>
				</ul>
			</td>
		</tr>

		<tr>
			@if($desgloseCesta->importeDescuentoCliente > 0)
				<td colspan="7">
			@else
				<td colspan="6">
			@endif

				@if(session("usuario")->uData->ctipocli == 22 || session("usuario")->uData->ctipocli == 23 || session("usuario")->uData->ctipocli == 24)
					<img src="https://diginova.es/testmail2/img/diginovafootermail2.jpg" style="width: 100%">
				@else
					<img src="https://diginova.es/testmail2/img/diginovafootermail.jpg" style="width: 100%">
				@endif

				</td>
		</tr>
		<tr>
			@if($desgloseCesta->importeDescuentoCliente > 0)
			<td colspan="7">
			@else
			<td colspan="6">
			@endif
				<div style="font-size: 10px; color: gray; text-align: justify;">Este mensaje y sus archivos adjuntos van dirigidos exclusivamente a su destinatario, pudiendo contener información confidencial sometida a secreto profesional. Si usted no es el destinatario final por favor elimínelo e infórmenos por esta vía. En cumplimiento de la Ley de Servicios de la Sociedad de la Información y de Comercio Electrónico (LSSICE) y de la Ley Orgánica 15/1999 de Protección de Datos de Carácter Personal (LOPD), por los cuales se regulan las medidas de seguridad de los ficheros automatizados, le comunicamos que su dirección de correo electrónico forma parte de la base de datos de Smarters Accesorios S.L. fichero que ha sido previamente registrado en la Agencia de Protección de Datos y cuya finalidad es informarle de las novedades, noticias y promociones de Diginova. Es voluntad de Smarters Accesorios S.L evitar el envío deliberado de correo no solicitado, por lo cual si no desea recibir más comunicaciones comerciales por nuestra parte, le rogamos nos lo indique a través de este enlace: Cancelar Suscripción. También tiene vd. a su disposición los derechos de acceso, rectificación y cancelación que le otorga la legislación correspondiente en esta materia.</div>
			</td>
		</tr>
	</tbody>
</table>
