@extends("base")
@section("dashboard")
	@if ($ccodcl == 0)
		<div class="rmaContSolicitudes">
			<div class="rmaSolT">
				<div class="rmaSolC" style="padding: 90px 0;"> 
					Por favor, inicia sesión para continuar
					<br /><br /><br /><br /><br /><br /><br /><br /><br />
				</div>
			</div>
		</div>
	@else
		<div id="xw_boxcentral">
			<div class="div_productos_mensajes div_devoluciones_msj" style="border-top: none">
				<a href="/xweb/preguntasfrecuentes" class="button_consultas_rma a_volver_centro_soporte">
					<i class="fa fa-angle-left" style="float: left; margin-right: 5px; font-weight: 900; font-size: 13pt;"></i>
					Volver
				</a>
				<span class="span_pregunta_consulta">{{$preguntaConsulta}}</span>
				<span class="span_pregunta_consulta" style="font-size: 10pt; margin-top: 3px;">
					Selecciona el artículo sobre el que quieres enviar la consulta: 
				</span>
			</div>
			<div style="display: inline-block; margin-bottom: 20px;">
				@foreach ($arrFacturasByUsuario as $arrFactura)

					@if ($tipoTicket == 1)
						<div class="div_productos_mensajes" style="background: #e6e6e6">
							<div class="img_productos_mensajes" style="padding-bottom: 0px">
								<img src="https://diginova.es/xweb3/fotoartic/art_{{$arrFactura['refArticulo']}}_1.jpg" class="img_articulo_ticket" />
							</div>
							<table class="table_productos_mensajes">
								<tr>
									<td colspan="2" class="nom_productos_mensajes">{{$arrFactura['nombreProducto']}}</td>
								</tr>
								<tr>
									<td class="info_productos_mensajes">
										<div><strong>Ref.:</strong> {{$arrFactura['ACODAR']}}</div>
									</td>
									<td class="info_productos_mensajes">
										<div><strong>Nº Serie:</strong> {{$arrFactura['NNUMSER']}}</div>
									</td>
								</tr>
								<tr>
									<td class="info_productos_mensajes">
										<div><strong>Fecha de compra:</strong> {{$arrFactura['fechaFormato']}}</div>
									</td>
									<td class="info_productos_mensajes">
										<div><strong>Nº Factura:</strong> {{$arrFactura['FDOC']}}</div>
									</td>
								</tr>
							</table>
							<div class="envio_productos_mensajes" style="margin-top: 22px;">
								<a href="/xweb/consulta/{{$ccodcl}}/{{$arrFactura['ACODAR']}}/{{$arrFactura['NNUMSER']}}/{{$tipoTicket}}/{{$id}}" class="button_consultas_rma a_consultas_rma">
									Realizar una consulta
									<i class="fa fa-envelope" style="float: right; margin-left: 5px; margin-top: 3px"></i>
								</a>
							</div>
						</div>
					@elseif ($tipoTicket == 2)
						<?php
							$importe = $arrFactura['importe'];
							$importeF = number_format($importe, 2, ",", ".");
						?>

						<div class="div_productos_mensajes" style="background: #e6e6e6">
							<div class="img_productos_mensajes" style="padding-bottom: 0px">
								<img src="/xweb/public/images/pedido.png" class="img_articulo_ticket" />
							</div>
							<table class="table_productos_mensajes">
								<tr>
									<td colspan="2" class="nom_productos_mensajes">{{$arrFactura['nombreProducto']}}</td>
								</tr>
								<tr>
									<td class="info_productos_mensajes">
										<div><strong>Fecha de compra:</strong> {{$arrFactura['fechaFormato']}}</div>
									</td>
									<td class="info_productos_mensajes">
										<div><strong>Importe:</strong> {{$importeF}}€</div>
									</td>
								</tr>
								@foreach ($arrProductosByUsuario as $arrProducto)
									
									
									
								@endforeach
							</table>
							<div class="envio_productos_mensajes" style="margin-top: 22px;">
								<a href="/xweb/consulta/{{$ccodcl}}/{{$arrFactura['ACODAR']}}/{{$arrFactura['NNUMSER']}}/{{$tipoTicket}}/{{$id}}" class="button_consultas_rma a_consultas_rma">
									Realizar una consulta
									<i class="fa fa-envelope" style="float: right; margin-left: 5px; margin-top: 3px"></i>
								</a>
							</div>
						</div>
					@elseif ($tipoTicket == 3)
						<div class="div_productos_mensajes" style="background: #e6e6e6">
							<table>
								<tr>
									<td style="width: 133px; vertical-align: middle; background: #fff;">
										<div class="img_productos_mensajes" style="padding-bottom: 0px; width: 100%">
											<img src="/xweb/public/images/cambio.png" class="img_articulo_ticket" />
										</div>
									</td>
									<td style="width: 770px">
										<table class="table_productos_mensajes" style="width: 100%">
											<tr>
												<td colspan="2" class="nom_productos_mensajes">RMA: {{$arrFactura['rma']}}</td>
											</tr>
											<tr>
												<td class="info_productos_mensajes">
													<div>
														<strong>Fecha del RMA: {{$arrFactura['fechaRMA']}}</strong>
													</div>
												</td>
												<td class="info_productos_mensajes">
													<div>
														<strong>Estado: {{$arrFactura['estadoRMA']}}</strong>
													</div>
												</td>
											</tr>
											@foreach ($arrProductosByUsuario as $arrProducto)
												@if ($arrFactura['rma'] == $arrProducto['rma'])
													<tr>
														<td colspan="2" class="info_productos_mensajes" style="width: 100%">
															<div style="display: flex;">
																<img src="/xweb/public/images/laptop_rma_off.png" class="img_item_ticket" />
																<div class="div_item_ticket">{{$arrProducto['nombreProducto']}}</div>
															</div>
														</td>
													</tr>
												@endif
											@endforeach
										</table>
									</td>
									<td style="width: 220px; vertical-align: middle;">
										<div class="envio_productos_mensajes" style="width: 100%; margin-top: 0px;">
											<a href="/xweb/consulta/{{$ccodcl}}/{{$arrFactura['ACODAR']}}/{{$arrFactura['NNUMSER']}}/{{$arrFactura['FDOC']}}/{{$tipoTicket}}/{{$id}}" style="display: none; padding: 10px; font-size: 10pt; margin-right: 10px; font-family: montserratregular" class="button_consultas_rma">
												Realizar una consulta
												<i class="fas fa-envelope" style="float: right; margin-left: 5px; margin-top: 4px" aria-hidden="true"></i>
											</a>

											<a href="/xweb/consulta/{{$ccodcl}}/{{$arrFactura['ACODAR']}}/{{$arrFactura['NNUMSER']}}/{{$tipoTicket}}/{{$id}}" style="padding: 10px; font-size: 10pt; margin-right: 10px; font-family: montserratregular" class="button_consultas_rma">
												Realizar una consulta
												<i class="fas fa-envelope" style="float: right; margin-left: 5px; margin-top: 4px" aria-hidden="true"></i>
											</a>
										</div>
									</td>
								</tr>
							</table>
						</div>
					@endif
				@endforeach
			</div>
		</div>
	@endif
@endsection