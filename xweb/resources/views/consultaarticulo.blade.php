@extends("base")
@section("dashboard")

	<div id="xw_boxcentral" class="div_consultas" style="background-color: #f3f3f3; padding-top: 0px; min-height: 515px;">
		@if ($codCliente > 0)
			@if ($tipoTicket == 3)
			<!--<form id="form_rma_tickets" style="margin: 30px 0px 0px 0px;" method="post" 
			action="/xweb/consulta/{{$codCliente}}/{{$referencia}}/{{$numSerie}}/{{$refFactura}}/{{$tipoTicket}}/{{$idPregunta}}" 
			enctype="multipart/form-data" accept-charset="UTF-8" autocomplete="off">-->

			<form id="form_rma_tickets" style="margin: 30px 0px 0px 0px;" method="post" 
			action="/xweb/consulta/{{$codCliente}}/{{$referencia}}/{{$numSerie}}/{{$tipoTicket}}/{{$idPregunta}}" 
			enctype="multipart/form-data" accept-charset="UTF-8" autocomplete="off">
			@else
			<form id="form_rma_tickets" style="margin: 30px 0px 0px 0px;" method="post" 
			action="/xweb/consulta/{{$codCliente}}/{{$referencia}}/{{$numSerie}}/{{$tipoTicket}}/{{$idPregunta}}" 
			enctype="multipart/form-data" accept-charset="UTF-8" autocomplete="off">
			@endif
				<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
				<input type="hidden" name="refTicket" value="{{$ticket}}" />
				<input type="hidden" name="nomArticulo" value="{{$nomArticulo}}" />
				<input type="hidden" name="refArticulo" value="{{$referencia}}" />
				<input type="hidden" name="numSerie" value="{{$numSerie}}" />
				<input type="hidden" name="codFactura" value="{{$refFactura}}" />
				<input type="hidden" name="fechaCompra" value="{{$fechaCompra}}" />
				<input type="hidden" name="codCliente" value="{{$codCliente}}" />
				<input type="hidden" name="tipoTicket" value="{{$tipoTicket}}" />
				<input type="hidden" name="tipoPregunta" value="{{$idPregunta}}" />
				<table class="table_averia_tickets">
					<tr>
						<td class="td_volver_consultas_rma" style="width: 10%;">
							<a href="/xweb/preguntasfrecuentes" class="a_comentarios_tickets volver_consultas_rma">
								<i class="fa fa-angle-left" style="float: left; margin-right: 5px; font-size: 12pt;"></i>
								Volver
							</a>
						</td>
						<td style="width: 90%;"></td>
					</tr>
				</table>
				<div style="display: inline-block; margin-top: 15px;">
					<div class="div_productos_mensajes div_consulta_producto_msj" style="background: #e6e6e6; border: none;">
						<div class="img_productos_mensajes">
							@if ($tipoTicket == 5)
								<img src="/xweb/public/images/cambio.png" class="img_articulo_ticket" />
							@else
								<img src="https://diginova.es/xweb3/fotoartic/art_{{$refArticulo}}_1.jpg" class="img_articulo_ticket" />
							@endif
						</div>
						<table class="table_productos_mensajes">
							<tr>
								@if ($tipoTicket == 5)
									<td colspan="2" class="nom_productos_mensajes">Otra consulta administrativa</td>
								@else
									<td colspan="2" class="nom_productos_mensajes">{{$nomArticulo}}</td>
								@endif
							</tr>
							@if ($tipoTicket != 5)
							<tr>
								<td class="info_productos_mensajes">
									<div><strong>Ref.:</strong> {{$referencia}}</div>
								</td>
								<td class="info_productos_mensajes">
									<div><strong>Nº Serie:</strong> {{$numSerie}}</div>
								</td>
							</tr>
							<tr>
								<td class="info_productos_mensajes">
									<div>
										<strong>Fecha de compra:</strong>
										{{$fechaCompra}}
									</div>
								</td>
								<td class="info_productos_mensajes">
									<div><strong>Nº Factura:</strong>{{$refFactura}}</div>
								</td>
							</tr>
							@endif
						</table>
					</div>
				</div>
				@if ($ticketEncontrado)
					<div class="div_parent_consulta_mensajes_msj" style="display: inline-block; margin: 15px 0px 10px 0px;">
	 					<div class="div_productos_mensajes div_consulta_mensajes_msj" style="background: #e6e6e6; margin-bottom: 15px; border-bottom:none;">
	 						<table class="table_productos_mensajes table_comentario_mensaje">
	 							<tr class="thead_producto_mensajes">
	 								<td class="thead_fecha_mensaje td_consulta_msj_uno">Fecha</td>
	 								<td class="thead_fecha_mensaje td_consulta_msj_dos">Usuario</td>
	 								<td class="thead_img_mensaje td_consulta_msj_tres"></td>
	 								<td class="thead_comentario_mensaje td_consulta_msj_cuatro" style="text-align: left;">Comentario</td>
	 							</tr>
	 							@foreach ($arrMensajes as $arrMensaje)
		 							<tr style="background: {{$arrMensaje['colorFondo']}}; border-bottom: 1px #0b2e48 solid;">
			 							<td class="td_fecha_mensaje td_consulta_msj_uno">{{$arrMensaje['fechaMensaje']}}</td>
			 							<td class="td_fecha_mensaje td_consulta_msj_dos">{{$arrMensaje['usuario']}}</td>
			 							<td class="td_img_mensaje td_consulta_msj_tres">
											@if (file_exists($arrMensaje['nombreFichero']))
												@if ($arrMensaje['imgMensaje'] != '')
													<img src="{{ url('/') }}/{{$arrMensaje['nombreFichero']}}" id="img_mensaje_{{$arrMensaje['contMensajes']}}" onclick="clickarImgMensaje('#div_mensaje_<?php echo $arrMensaje['contMensajes']?>')" style="width: 30px; padding: 12px 0px;" />
													<div id="div_mensaje_{{$arrMensaje['contMensajes']}}" class="div_img_mensaje img_mensaje_grande" style="display: none">
														<div class="close_img_mensaje" onclick="cerrarImgMensaje('#div_mensaje_<?php echo $arrMensaje['contMensajes']?>')">
															<img src="/xweb/public/images/close.png" style="width: 22px">
														</div>
														<img src="{{ url('/') }}/{{$arrMensaje['nombreFichero']}}" style="width: 300px;" />
													</div>
												@endif
											@endif
			 							</td>
			 							<td class="td_comentario_mensaje td_consulta_msj_cuatro">{{$arrMensaje['mensaje']}}</td>
			 						</tr>
					 			@endforeach
					 		</table>
					 		<input type="hidden" id="contMensajes" value="{{count($arrMensajes)}}">
			 			</div>
			 		</div>
			 	@endif

				<table class="table_averia_tickets">
					<tr>
						<td class="td_nuevo_msj_ticket_select" style="width: 100%;" colspan="3">
							<select id="select_producto_ticket" class="select_producto_ticket">
								<option value="{{$idPregunta}}" selected>{{$pregunta}}</option>
							</select>
						</td>
					</tr>
					<tr class="tr_nuevo_msj_ticket">
						<td class="td_nuevo_msj_ticket_txtarea" style="width: 74%;">
							<textarea name="text_mensaje_pedido" id="text_mensaje_pedido" placeholder="Déjanos tu comentario..." class="textarea_enviar_mensaje" style="width: 98%; margin-left: 0px;"></textarea>
						</td>
						<td class="td_nuevo_msj_ticket_btn" style="width: 13%;">
							<input type="file" id="input_subir_foto_admin" name="input_subir_foto_admin" onchange="cambiarSubirFotoAdmin()" style="display: none" />
							<button type="button" id="img_subir_foto" class="button_subir_foto a_comentarios_tickets" onclick="pulsarSubirFotoAdmin()">
								<div style="float: left; display: block;">Subir imagen</div>
								<img src="/xweb/public/images/camera_icon.png" id="icon_subir_foto" class="img_subir_foto" />
							</button>
						</td>
						<td class="td_nuevo_msj_ticket_btn" style="width: 13%;">
							<input type="submit" name="EnviarMensaje" class="a_comentarios_tickets input_enviar_comentario" value="Enviar comentario">
						</td>
					</tr>
				</table>

			</form>
		@else
			<div class="rmaContSolicitudes">
				<div class="rmaSolT" style="min-height: 500px;">
					<div class="rmaSolC" style="padding: 30px 0; color: #0b2e48; font-weight: bold; vertical-align: middle;">
						Por favor, inicia sesión para continuar
					</div>
				</div>
			</div>
		@endif
	</div>

@endsection