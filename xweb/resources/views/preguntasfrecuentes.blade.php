@extends("base")
@section("dashboard")
	@if ($codCliente == 0)
		<div id="xw_boxcentral" style="min-height:500px; padding-top: 0px; background-color: #fafafa; background-color: #f3f3f3;">
			<div class="devoluciones">
				<div class="rmaContSolicitudes">
					<div class="rmaSolT">
						<div class="rmaSolC" style="padding: 60px 0; font-size: 14pt;"> 
							Por favor, inicia sesión para continuar
							<br /><br /><br /><br /><br /><br /><br /><br /><br />
						</div>
					</div>
				</div>
				<div class="devolucionesPol">
					<div class="devolucionesPolTD1">
						<img src="/xweb/public/images/devpol1.jpg" />
					</div>
					<div class="devolucionesPolTD2"> 
						<img src="/xweb/public/images/devpol2.jpg" />
					</div>
					<div class="devolucionesPolTD3">
						<div class="devolucionesPolTD3_1"> Quedan excluidos de los 2 años de garantía</div>
						<div class="devolucionesPolTD3_2">
							<table border="0" style="width: 100%;">
								<tr> 
									<td class="tdevsAnios1">- Tablets:</td>
									<td class="tdevsAnios2">1 año</td>
								</tr>
								<tr>
									<td class="tdevsAnios1">- Impresoras:</td>
									<td class="tdevsAnios2">1 año</td>
								</tr>
								<tr>
									<td class="tdevsAnios1">- Baterías:</td>
									<td class="tdevsAnios2">6 meses</td>
								</tr>
								<tr>
									<td class="tdevsAnios1">- Hdd y componentes:</td>
									<td class="tdevsAnios2">3 meses</td>
								</tr>
								<tr>
									<td class="tdevsAnios1">- Fallos de software:</td>
									<td class="tdevsAnios2">no cubierto</td>
								</tr>
								<tr>
									<td class="tdevsAnios1">- Pérdida de datos en discos duros:</td>
									<td class="tdevsAnios2">no cubierto</td>
								</tr>
							</table>
						</div>
					</div>
					<div class="devolucionesPolTD4">
						<div class="devolucionesPolTD4_1">
							<img src="/xweb/public/images/devpol3.jpg" />
						</div>
						<div class="devolucionesPolTD4_2">
							<div class="bold" style="font-size: 12pt; padding-bottom: 5px; font-family: montserratbold;">Diagnóstico claro</div>
							Menciones como "no funciona", "no va", etc. no serán admitidas.
						</div>
					</div>
				</div>
			</div>
		</div>
	@else
		<div id="xw_boxcentral" style="min-height:500px; padding-top: 0px; background-color: #fafafa; background-color: #f3f3f3;">
			
			<div style="display: none">
				<ul id="ul_preguntas_consultas">

					@foreach($arrRMAPreguntas as $arrPregunta)
						<li>
							<p><?php echo $arrPregunta->id_pregunta; ?></p>
							<span><?php echo $arrPregunta->tipo_pregunta; ?></span>
							<a><?php echo utf8_decode($arrPregunta->pregunta); ?></a>
						</li>
					@endforeach

				</ul>
			</div>


			<div class="faqMsgT">
				<div class="faqMsgTD faqMsgTD1">Si no encuentras una soluci&oacute;n a tu consulta en nuestras <span class="rma2 bold">preguntas frecuentes</span>, gestiona tu devoluci&oacute;n aqu&iacute;:</div>
				<div class="faqMsgTD faqMsgTD2"><a class="faqLink" href="/xweb/devoluciones">Centro de devoluciones</a></div>
			</div>

			<div class="faqTitulo">Preguntas frecuentes</div>

			<div class="divBuscadorConsulta" style="width: 1204px;display: table; margin: 0 auto;">
				<input type="text" id="input_buscador_consultas" placeholder="Buscar una consulta..." onkeyup="buscadorConsultas()"/>
				<button id="btn_preg_frecuentes" class="button_tipo_consultas active_consultas" onclick="clickPreguntasFrecuentes()">Preguntas frecuentes</button>
				<button id="btn_consultas_abiertas" class="button_tipo_consultas" onclick="clickBtnConsultas(true)">Consultas abiertas</button>
				<button id="btn_consultas_cerradas" class="button_tipo_consultas" onclick="clickBtnConsultas(false)">Consultas cerradas</button>
			</div>

			<div class="rmaContSolicitudes" id="div_preguntas_frecuentes">
				<div style="width: 1204px;display: table; margin: 0 auto; margin-bottom: 50px; ">
					<div id="div_preg_productos" style="width: 400px;display: table; margin: 0 auto; float: left;">
						<div id="titulo_preg_tecnicas" class="titulo_preguntas" style="margin-left: 17px; margin-bottom: 1px; border-collapse: separate; width: 366px;">
							<img src="/xweb/public/images/reparar.png" class="img_titulo_consultas"/>
							<div class="div_titulo_consultas">Consultas t&eacute;cnicas</div>
						</div>
						@php
				    	$contPreguntas1 = 0;
				    	@endphp
				    	@foreach($arrRMAPreguntas as $arrPregunta)
				    		@if ($arrPregunta->tipo_pregunta == 1)
				    			@php
						    	$contPreguntas1 += 1;
						    	@endphp
						    	<table class="rmaSolT" id="table_pregunta_{{$arrPregunta->id_pregunta}}" style="margin-left: 17px; margin-bottom: 1px; border-collapse: separate; width: 366px;">
									<tr class="tr_faq" id="tr_preg_tecnicas_<?php echo $contPreguntas1 ?>" onclick="clickPregTecnicas(<?php echo $contPreguntas1 ?>, <?php echo $arrPregunta->id_pregunta ?>)">
										<td class="td_faq_txt">
											<div class="div_faq">
												{{$arrPregunta->pregunta}}
											</div>
										</td>
									</tr>
									<tr class="tr_faq" id="tr_resp_tecnicas_<?php echo $contPreguntas1 ?>" style="display: none;">
										<td class="td_faq_txt">
											<div class="div_faq div_resp" style="font-family: montserratregular; font-size: 10pt; color: #0b2e48;">
												@php
										    	echo $arrPregunta->respuesta;
										    	@endphp
											</div>
										</td>
									</tr>
								</table>
				    		@endif
				    	@endforeach
					</div>
					<div id="div_preg_envios" style="width: 400px;display: table; margin: 0 auto; display: table; float: left;">
						<div id="titulo_preg_envios" class="titulo_preguntas" style="margin-left: 17px; margin-bottom: 1px; border-collapse: separate; width: 366px;">
							<img src="/xweb/public/images/pedido_rma_off.png" class="img_titulo_consultas"/>
							<div class="div_titulo_consultas">Consultas sobre mi Envío</div>
						</div>
						@php
				    	$contPreguntas2 = 0;
				    	@endphp
				    	@foreach($arrRMAPreguntas as $arrPregunta)
				    		@if ($arrPregunta->tipo_pregunta == 2)
				    			@php
						    	$contPreguntas2 += 1;
						    	@endphp
						    	<table class="rmaSolT" id="table_pregunta_{{$arrPregunta->id_pregunta}}" style="margin-left: 17px; margin-bottom: 1px; border-collapse: separate; width: 366px;">
									<tr class="tr_faq" id="tr_preg_envios_<?php echo $contPreguntas2 ?>" onclick="clickPregEnvios(<?php echo $contPreguntas2 ?>)">
										<td class="td_faq_txt">
											<div class="div_faq">
												{{$arrPregunta->pregunta}}
											</div>
										</td>
									</tr>
									<tr class="tr_faq" id="tr_resp_envios_<?php echo $contPreguntas2 ?>" style="display: none;">
										<td class="td_faq_txt" style="padding-top: 8px;">
											<div class="div_faq div_resp" style="font-family: montserratregular; font-size: 10pt; color: #0b2e48;">
												@php
										    	echo $arrPregunta->respuesta;
										    	@endphp
											</div>
										</td>
									</tr>
								</table>
				    		@endif
				    	@endforeach
						<div id="titulo_preg_productos" class="titulo_preguntas" style="margin-left: 17px;margin-bottom: 1px; border-collapse: separate; width: 366px; margin-top: 20px;">
							<img src="/xweb/public/images/laptop_rma_off.png" class="img_titulo_consultas"/>
							<div class="div_titulo_consultas">Consultas sobre Producto</div>
						</div>
						@php
				    	$contPreguntas6 = 0;
				    	@endphp
				    	@foreach($arrRMAPreguntas as $arrPregunta)
				    		@if ($arrPregunta->tipo_pregunta == 6)
				    			@php
						    	$contPreguntas6 += 1;
						    	@endphp
						    	<table class="rmaSolT" id="table_pregunta_{{$arrPregunta->id_pregunta}}" style="margin-left: 17px; margin-bottom: 1px; border-collapse: separate; width: 366px;">
									<tr class="tr_faq" id="tr_preg_productos_<?php echo $contPreguntas6 ?>" onclick="clickPregProductos(<?php echo $contPreguntas6 ?>)">
										<td class="td_faq_txt">
											<div class="div_faq">
												@php
										    	echo $arrPregunta->pregunta;
										    	@endphp
											</div>
										</td>
									</tr>
									<tr class="tr_faq" id="tr_resp_productos_<?php echo $contPreguntas6 ?>" style="display: none;">
										<td class="td_faq_txt" style="padding-top: 8px;">
											<div class="div_faq div_resp" style="font-family: montserratregular; font-size: 10pt;  color: #0b2e48;">
												@php
										    	echo $arrPregunta->respuesta;
										    	@endphp
											</div>
										</td>
									</tr>
								</table>
				    		@endif
				    	@endforeach
					</div>
					<div id="div_preg_abonos" style="width: 400px;display: table; margin: 0 auto; display: table; float: left;">
						<div id="titulo_preg_rma" class="titulo_preguntas" style="margin-left: 17px; margin-bottom: 1px; border-collapse: separate; width: 366px;">
							<img src="/xweb/public/images/cambio.png" class="img_titulo_consultas"/>
							<div class="div_titulo_consultas">Consultas sobre RMA</div>
						</div>
						@php
				    	$contPreguntas3 = 0;
				    	@endphp
				    	@foreach($arrRMAPreguntas as $arrPregunta)
				    		@if ($arrPregunta->tipo_pregunta == 3)
				    			@php
						    	$contPreguntas3 += 1;
						    	@endphp
						    	<table class="rmaSolT" id="table_pregunta_{{$arrPregunta->id_pregunta}}" style="margin-left: 17px; margin-bottom: 1px; border-collapse: separate; width: 366px;">
									<tr class="tr_faq" id="tr_preg_otros_<?php echo $contPreguntas3 ?>" onclick="clickPregOtros(<?php echo $contPreguntas3 ?>)">
										<td class="td_faq_txt">
											<div class="div_faq">
												{{$arrPregunta->pregunta}}
											</div>
										</td>
									</tr>
									<tr class="tr_faq" id="tr_resp_otros_<?php echo $contPreguntas3 ?>" style="display: none;">
										<td class="td_faq_txt" style="padding-top: 8px;">
											<div class="div_faq div_resp" style="font-family: montserratregular; font-size: 10pt;  color: #0b2e48;">
												@php
										    	echo $arrPregunta->respuesta;
										    	@endphp
											</div>
										</td>
									</tr>
								</table>
				    		@endif
				    	@endforeach
						<div id="titulo_preg_admin" class="titulo_preguntas" style="margin-left: 17px;margin-bottom: 1px; border-collapse: separate; width: 366px; margin-top: 20px;">
							<img src="/xweb/public/images/documentos.png" class="img_titulo_consultas"/>
							<div class="div_titulo_consultas">Consultas Administrativas</div>
						</div>
						@php
				    	$contPreguntas5 = 0;
				    	@endphp
				    	@foreach($arrRMAPreguntas as $arrPregunta)
				    		@if ($arrPregunta->tipo_pregunta == 5)
				    			@php
						    	$contPreguntas5 += 1;
						    	@endphp

						    	@if ($arrPregunta->id_pregunta == 24)
									<form id="form_consulta_otros" method="post" action="/xweb/consulta/{{$codCliente}}/{{$refArticulo}}/{{$numSerie}}/5/24" enctype="multipart/form-data" accept-charset="UTF-8" autocomplete="off">
										<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
										<input type="hidden" name="refTicket" value="0" />
										<input type="hidden" name="refArticulo" value="" />
										<input type="hidden" name="numSerie" value="" />
										<input type="hidden" name="codFactura" value="" />
										<input type="hidden" name="fechaCompra" value="" />
										<input type="hidden" name="codCliente" value="{{$codCliente}}" />
										<input type="hidden" name="tipoTicket" value="5" />
										<input type="hidden" name="tipoPregunta" value="24" />
										<table class="rmaSolT" id="table_pregunta_{{$arrPregunta->id_pregunta}}" style="margin-left: 17px; margin-bottom: 1px; border-collapse: separate; width: 366px;">
											<tr class="tr_faq" id="tr_preg_admin_{{$contPreguntas5}}" onclick="clickPregAdmin(<?php echo $contPreguntas5 ?>)">
												<td class="td_faq_txt">
													<div class="div_faq">{{$arrPregunta->pregunta}}</div>
												</td>
											</tr>
											<tr class="tr_faq" id="tr_resp_admin_{{$contPreguntas5}}" style="display: none;">
												<td class="td_faq_txt" style="padding-top: 8px;" colspan="3">
													<div class="div_faq div_resp" style="font-family: montserratregular; font-size: 10pt">
														@php
											    		echo $arrPregunta->respuesta;
											    		@endphp

														<table style="width: 96%;">
															<tr>
																<td style="width: 85%;">
																	<textarea name="text_mensaje_pedido" id="text_mensaje_pedido" placeholder="D&eacute;janos tu comentario..." class="textarea_enviar_mensaje" style="width: 185px; margin-left: 0px; margin-bottom: 28px; height: 67px;"></textarea>
																</td>
																<td style="width: 15%;">
																	<input type="file" id="input_subir_foto_admin" name="input_subir_foto_admin" onchange="cambiarSubirFotoAdmin()" style="display: none" />
																	<button type="button" id="img_subir_foto_admin" class="button_subir_foto a_comentarios_tickets" onclick="pulsarSubirFotoAdmin()" style="padding: 10px 6px; margin-bottom: 15px;">
																		<div style="float: left; display: block; margin-left: 0px">	
																			Subir imagen
																		</div>
																		<img src="/xweb/public/images/camera_icon.png" id="icon_subir_foto" class="img_subir_foto" style="width: 16px;" />
																	</button>
																	<input type="submit" name="EnviarMensaje" class="button_consultas_rma" style="padding: 10px 12px; font-size: 9pt; margin-left: 10px; color: #fff; display: block; float: right; margin-bottom: 27px; font-family: montserratregular;" value="Enviar consulta">
																</td>
															</tr>
														</table>
													</div>
												</td>
												<td></td>
											</tr>
										</table>
									</form>
								@else
									<table class="rmaSolT" id="table_pregunta_{{$arrPregunta->id_pregunta}}" style="margin-left: 17px; margin-bottom: 1px; border-collapse: separate; width: 366px;">
										<tr class="tr_faq" id="tr_preg_admin_{{$contPreguntas5}}" onclick="clickPregAdmin(<?php echo $contPreguntas5 ?>)">
											<td class="td_faq_txt">
												<div class="div_faq">
													{{$arrPregunta->pregunta}}
												</div>
											</td>
										</tr>
										<tr class="tr_faq" id="tr_resp_admin_{{$contPreguntas5}}" style="display: none;">
											<td class="td_faq_txt" style="padding-top: 8px;">
												<div class="div_faq div_resp" style="font-family: montserratregular; font-size: 10pt;  color: #0b2e48;">
													@php
											    	echo $arrPregunta->respuesta;
											    	@endphp
												</div>
											</td>
										</tr>
									</table>
								@endif
				    		@endif
				    	@endforeach
					</div>
				</div>
			</div>

			<input type="hidden" id="num_preguntas1" value="{{ $contPreguntas1 }}" />
			<input type="hidden" id="num_preguntas2" value="{{ $contPreguntas2 }}" />
			<input type="hidden" id="num_preguntas3" value="{{ $contPreguntas3 }}" />
			<input type="hidden" id="num_preguntas5" value="{{ $contPreguntas5 }}" />
			<input type="hidden" id="num_preguntas6" value="{{ $contPreguntas6 }}" />

			<div id="div_tickets_productos" class="div_tickets_productos" style="width: 1204px;display: table; margin: 0 auto; margin-bottom: 50px;">
				<form id="form_consultas_tickets" style="margin: 30px 0px 0px 0px;" method="post" action="" 
					enctype="multipart/form-data" accept-charset="UTF-8" autocomplete="off">
					<?php
					$numTicketsAbiertos = 0;
					$numTicketsCerrados = 0;
					?>
					@foreach($arrTickets as $arrTicket)
						<input type="hidden" name="_token" id="_token" value="{{{ csrf_token() }}}" />
						<input type="hidden" name="refTicket_{{$arrTicket['id']}}" value="{{$arrTicket['ref_ticket']}}" />
						<input type="hidden" name="refArticulo_{{$arrTicket['id']}}" value="{{$arrTicket['ref_articulo']}}" />
						<input type="hidden" name="numSerie_{{$arrTicket['id']}}" value="{{$arrTicket['num_serie']}}" />
						<input type="hidden" name="codFactura_{{$arrTicket['id']}}" value="{{$arrTicket['ref_factura']}}" />
						<input type="hidden" name="codCliente_{{$arrTicket['id']}}" value="{{$arrTicket['cod_cliente']}}" />
						<input type="hidden" name="tipoTicket_{{$arrTicket['id']}}" value="{{$arrTicket['tipo_ticket']}}" />
						<input type="hidden" name="tipoPregunta_{{$arrTicket['id']}}" value="{{$arrTicket['tipo_pregunta']}}" />


						
							@if ($arrTicket['estado'] == 0)
								<?php
								$numTicketsAbiertos += 1;
								?>
								<table class="rmaSolT table_tickets_abiertos" style="margin-left: 17px; margin-bottom: 1px; border-collapse: separate; width: 1166px; display: none;">
									<tr class="tr_faq">
										<td class="td_faq_txt td_ticket_abierta td_pc_faq" onclick="mostrarTicket(this)" style="width: 8%; display: table-cell;">
											<div style="color: #44c767;">
												<input type="hidden" value="{{$arrTicket['ref_ticket']}}">
												<button type="text" class="button_ticket">
													Consulta abierta
												</button>
											</div>
										</td>
							@else
								<?php
								$numTicketsCerrados += 1;
								?>
								<table class="rmaSolT table_tickets_cerrados" style="margin-left: 17px; margin-bottom: 1px; border-collapse: separate; width: 1166px; display: none;">
									<tr class="tr_faq_cerrada">
										<td class="td_faq_txt td_ticket_cerrada td_pc_faq" onclick="mostrarTicket(this)" style="width: 8%; display: table-cell;">
											<div style="color: #44c767;">
												<button type="text" class="button_ticket">
													Consulta cerrada
												</button>
											</div>
										</td>
							@endif
										<td class="td_faq_icon td_pc_faq" onclick="mostrarTicket(this)" style="width: 5%">
											<img src="https://diginova.es/xweb3/fotoartic/art_{{$arrTicket['acodarMinuscula']}}_1.jpg" class="img_articulo_faq" style="width: 40px;" />
										</td>
										<td class="td_faq_txt td_pc_faq" onclick="mostrarTicket(this)" style="width: 40%">
											<div class="div_faq" style="font-size: 10pt;">
												{{$arrTicket['ADESCR']}}	
											</div>
											<div class="div_faq div_faq_subtitulo">
												{{$arrTicket['pregunta']}}
											</div>
										</td>
										<td class="td_faq_txt td_pc_faq" onclick="mostrarTicket(this)" style="width: 30%">
											<div class="div_faq" style="display: flex;  padding: 5px 0px;">
												<div style="font-size: 9pt; float: left; width: 80px;">Referencia: </div>
												<div style="font-family: montserratextrabold; font-size: 9pt;">
													{{$arrTicket['ref_articulo']}}	
												</div>	
											</div>
											<div class="div_faq" onclick="mostrarTicket(this)" style="display: flex;">
												<div style="font-size: 9pt; float: left; width: 80px;">Nº Serie: </div>
												<div style="font-family: montserratextrabold; font-size: 9pt;">
													{{$arrTicket['num_serie']}}		
												</div>
											</div>
										</td>

										<td class="td_mv_faq div_msj_mv" style="width: 20%; float: left;">
											<img src="https://diginova.es/xweb3/fotoartic/art_{{$arrTicket['acodarMinuscula']}}_1.jpg" class="img_articulo_faq" style="width: 40px;" />
										</td>

										<td class="td_mv_faq td_info_consulta">
											<table>
												<tr>
													<td class="td_faq_icon" onclick="mostrarTicket(this)" style="width: 5%">
														@if ($arrTicket['estado'] == 0)
															<div class="div_tipo_consulta" style="color: #44c767;">
																<input type="hidden" value="{{$arrTicket['ref_ticket']}}">
																<button type="text" class="button_ticket">
																	Consulta abierta
																</button>
															</div>
														@else
															<div class="div_tipo_consulta" style="color: #44c767;">
																<button type="text" class="button_ticket">
																	Consulta cerrada
																</button>
															</div>
														@endif
														<img src="https://diginova.es/xweb3/fotoartic/art_{{$arrTicket['acodarMinuscula']}}_1.jpg" class="img_articulo_faq div_msj_pc" style="width: 40px;" />
													</td>
												</tr>
												<tr>
													<td class="td_faq_txt" onclick="mostrarTicket(this)" style="width: 40%">
														<div class="div_faq" style="font-size: 10pt;">
															{{$arrTicket['ADESCR']}}	
														</div>
														<div class="div_faq div_faq_subtitulo">
															{{$arrTicket['pregunta']}}
														</div>
													</td>
												</tr>
												<tr>
													<td class="td_faq_txt" onclick="mostrarTicket(this)" style="width: 30%">
														<div class="div_faq" style="display: flex;  padding: 5px 0px;">
															<div style="font-size: 8pt; float: left; width: 80px;">Referencia: </div>
															<div style="font-family: montserratextrabold; font-size: 9pt;">
																{{$arrTicket['ref_articulo']}}	
															</div>	
														</div>
														<div class="div_faq" onclick="mostrarTicket(this)" style="display: flex;">
															<div style="font-size: 8pt; float: left; width: 80px;">Nº Serie: </div>
															<div style="font-family: montserratextrabold; font-size: 9pt;">
																{{$arrTicket['num_serie']}}		
															</div>
														</div>
													</td>
												</tr>
												<tr>
													@if ($arrTicket['estado'] == 0)
														<td class="td_faq_txt" style="width: 10%; padding-bottom: 5px;">
															<div style="color: #44c767;">
																<input type="button" class="button_ticket_abierta" onclick="cerrarConsulta('<?php echo $arrTicket["ref_ticket"] ?>')" value="Cerrar consulta">
																<input type="hidden" value="{{$arrTicket['ref_ticket']}}">
															</div>
														</td>
													@else
														<td class="td_faq_txt" style="width: 10%; padding-bottom: 5px;"></td>
													@endif
												</tr>
											</table>
										</td>

										@if ($arrTicket['estado'] == 0)
											<td class="td_faq_txt td_pc_faq" style="width: 10%; padding-bottom: 5px;">
												<div style="color: #44c767;">
													<input type="button" class="button_ticket_abierta" onclick="cerrarConsulta('<?php echo $arrTicket["ref_ticket"] ?>')" value="Cerrar consulta">
													<input type="hidden" value="{{$arrTicket['ref_ticket']}}">
												</div>
											</td>
										@else
											<td class="td_faq_txt td_pc_faq" style="width: 10%; padding-bottom: 5px;"></td>
										@endif
										<td class="td_faq_icon td_faq_flecha" onclick="mostrarTicket(this)" style="width: 5%">
											<img src="/xweb/public/images/flecha_abajo_rma.png" class="img_arrow" style="width: 28px;" />
										</td>
									</tr>
									<tr class="tr_faq tr_comentarios" style="display: none;">
										<td colspan="6" style="padding-bottom: 20px;">
											<table class="rmaSolT table_ticket_mensajes" style="width: 1166px">
												<tbody style="display: inline-block; width: 100%;">
													<tr class="thead_producto_mensajes" style="display: flex; width: 100%;">
														<td class="thead_fecha_mensaje th_msj_uno" style="width: 5%"></td>
														<td class="thead_fecha_mensaje th_msj_dos div_msj_pc" style="width: 10%">Fecha</td>
														<td class="thead_fecha_mensaje th_msj_tres" style="width: 15%">Usuario</td>
														<td class="thead_fecha_mensaje th_msj_cuatro" style="width: 10%"></td>
														<td class="thead_fecha_mensaje th_msj_cinco" style="width: 60%; text-align: left;">Comentario</td>
													</tr>
													@foreach ($arrMensajes as $arrMensaje)
														@if ($arrMensaje['ref_ticket'] == $arrTicket['ref_ticket'])
															<tr style="background: #e1e1e1; border-bottom: 1px #0b2e48 solid; display: flex; width: 100%;">
																<td class="td_faq_icon td_msj_uno" style="width: 5%">
																	<img src="/xweb/public/images/laptop_rma_on.png" class="img_faq" />
																</td>
																<td class="td_fecha_mensaje td_msj_dos div_msj_pc" style="width: 10%">
																	{{$arrMensaje['fecha_mensaje']}}
																</td>
																<td class="td_fecha_mensaje td_msj_tres div_msj_pc" style="width: 15%">
																	@if ($arrMensaje['remitente'] == 0)
																		{{$arrTicket['CNOMBREWEB']}}
																	@else
																		T&eacute;cnico RMA
																	@endif
																</td>
																<td class="td_fecha_mensaje td_msj_tres div_msj_mv" style="width: 10%">
																	<div>
																		@if ($arrMensaje['remitente'] == 0)
																			{{$arrTicket['CNOMBREWEB']}}
																		@else
																			T&eacute;cnico RMA
																		@endif
																	</div>
																	<div>{{$arrMensaje['fecha_mensaje']}}</div>
																</td>
																<td class="td_fecha_mensaje td_msj_cuatro" style="width: 10%">
																	@if ($arrMensaje['img_mensaje'] != '')
																		<img src="{{ url('/') }}/public/imgclientes/{{$arrMensaje['img_mensaje']}}" 
																		width="30" id="img_mensaje_{{$arrMensaje['contMensajes']}}" />
																		<div class="div_img_mensaje" style="display: none">
																			<img src="{{ url('/') }}/imgclientes/{{$arrMensaje['img_mensaje']}}" style="width: 300px;" />
																		</div>
																	@endif
																</td>
																<td class="td_comentario_mensaje td_msj_cinco" style="width: 60%">
																	{{$arrMensaje['mensaje']}}
																</td>
															</tr>
														@endif
													@endforeach
													@if ($arrTicket['estado'] == 0)
														<tr style="background: #eeeeee; border-bottom: 1px #0b2e48 solid; display: flex; width: 100%;">
															<td class="td_faq_icon td_faq_uno" style="width: 5%">
																<img src="/xweb/public/images/otros_rma_on.png" class="img_faq" style="float: left; margin-left: 8px; margin-top: 10px;" />
															</td>
															<td colspan="2" class="td_faq_dos" style="width: 83%">
																<textarea placeholder="D&eacute;janos tu comentario" name="text_mensaje_pedido_{{$arrTicket['id']}}" class="txtarea_ticket_comentario" style="margin: 11px 0px; width: 97%; float: left;"></textarea>
																<div id="div_error_mensaje" class="div_error_mensaje" style="display: none">
																	<span>Debes introducir un comentario antes de enviar la consulta</span>
																</div>
															</td>
															<td class="td_fecha_mensaje td_faq_tres" style="width: 12%; margin-top: 0px;">
																<input type="file" name="input_subir_foto_{{$arrTicket['id']}}" class="input_subir_foto_mens" onchange="cambiarSubirFotoMens(this)" style="display: none" />
																<button type="button" name="img_subir_foto" onclick="pulsarSubirFotoMens(this)" class="button_subir_foto a_comentarios_tickets" style="padding: 10px 7px; margin-bottom: 15px; margin-left: 0px; margin-top:  0px; float: left;">
																	<div style="float: left; display: block; margin-left: 0px">		
																		Subir imagen
																	</div>
																	<img src="/xweb/public/images/camera_icon.png" name="icon_subir_foto_{{$arrTicket['id']}}" class="img_subir_foto" style="width: 16px;" />
																</button>
																<input type="submit" name="EnviarMensaje_{{$arrTicket['id']}}" class="button_consultas_rma" style="padding: 10px 12px; font-size: 9pt; margin-right: 10px; color: #fff; display: block; float: left; margin-top: 0px; font-family: montserratregular;" value="Enviar consulta">
															</td>
														</tr>
													@endif
												</tbody>
											</table>
										</td>
									</tr>
								</table>
						
					@endforeach

					<div class="table_tickets_abiertos" style="display: none;">
					<?php
					if ($numTicketsAbiertos == 0)
					{
						?>
						<div style="font-size: 12pt; font-weight: bold;">No tienes consultas abiertas</div>
						<?php
					}
					?>
					</div>

					<div class="table_tickets_cerrados" style="display: none;">
					<?php
					if ($numTicketsCerrados == 0)
					{
						?>
						<div style="font-size: 12pt; font-weight: bold;">No tienes consultas cerradas</div>
						<?php
					} 
					?>
					<input type="file" id="input_subir_foto" name="input_subir_foto" onchange="cambiarImagenConsulta()" style="display: none" />
				</form>
			</div>
		</div>
	@endif


	<script type="text/javascript">

function clickPregTecnicas(i, idPregunta)
{
    var numPreguntas = $('#num_preguntas1').val();

    for (var a = 0; a <= numPreguntas; a++)
    {
        (function(a) {

            $('#tr_resp_tecnicas_' + a).hide(500);
            $('#tr_preg_tecnicas_' + a).css('background', '#f6f6f6');
            $('#tr_preg_tecnicas_' + a + ' .div_faq').css('color', '#0c2e49');
        }(a));
    }

    if ($('#tr_resp_tecnicas_' + i).css("display") == "none")
    {
        $('#tr_resp_tecnicas_' + i).show(500);
        $('#tr_preg_tecnicas_' + i).css('background', '#0c2e49');
        $('#tr_preg_tecnicas_' + i + ' .div_faq').css('color', '#f6f6f6');
    }
    else
    {
        $('#tr_resp_tecnicas_' + i).hide(500);
        $('#tr_preg_tecnicas_' + i).css('background', '#f6f6f6');
        $('#tr_preg_tecnicas_' + i + ' .div_faq').css('color', '#0c2e49');
    }
}

function clickPregEnvios(i, idPregunta)
{
    var numPreguntas = $('#num_preguntas2').val();

    for (var a = 0; a <= numPreguntas; a++)
    {
        (function(a) {

            $('#tr_resp_envios_' + a).hide(500);
            $('#tr_preg_envios_' + a).css('background', '#f6f6f6');
            $('#tr_preg_envios_' + a + ' .div_faq').css('color', '#0c2e49');
        }(a));
    }

    if ($('#tr_resp_envios_' + i).css("display") == "none")
    {
        $('#tr_resp_envios_' + i).show(500);
        $('#tr_preg_envios_' + i).css('background', '#0c2e49');
        $('#tr_preg_envios_' + i + ' .div_faq').css('color', '#f6f6f6');
    }
    else
    {
        $('#tr_resp_envios_' + i).hide(500);
        $('#tr_preg_envios_' + i).css('background', '#f6f6f6');
        $('#tr_preg_envios_' + i + ' .div_faq').css('color', '#0c2e49');
    }
}

function clickPregProductos(i, idPregunta)
{
    var numPreguntas = $('#num_preguntas6').val();

    for (var a = 0; a <= numPreguntas; a++)
    {
        (function(a) {

            $('#tr_resp_productos_' + a).hide(500);
            $('#tr_preg_productos_' + a).css('background', '#f6f6f6');
            $('#tr_preg_productos_' + a + ' .div_faq').css('color', '#0c2e49');
        }(a));
    }

    if ($('#tr_resp_productos_' + i).css("display") == "none")
    {
        $('#tr_resp_productos_' + i).show(500);
        $('#tr_preg_productos_' + i).css('background', '#0c2e49');
        $('#tr_preg_productos_' + i + ' .div_faq').css('color', '#f6f6f6');
    }
    else
    {
        $('#tr_resp_productos_' + i).hide(500);
        $('#tr_preg_productos_' + i).css('background', '#f6f6f6');
        $('#tr_preg_productos_' + i + ' .div_faq').css('color', '#0c2e49');
    }
}

function clickPregOtros(i, idPregunta)
{
    var numPreguntas = $('#num_preguntas3').val();

    for (var a = 0; a <= numPreguntas; a++)
    {
        (function(a) {

            $('#tr_resp_otros_' + a).hide(500);
            $('#tr_preg_otros_' + a).css('background', '#f6f6f6');
            $('#tr_preg_otros_' + a + ' .div_faq').css('color', '#0c2e49');
        }(a));
    }

    if ($('#tr_resp_otros_' + i).css("display") == "none")
    {
        $('#tr_resp_otros_' + i).show(500);
        $('#tr_preg_otros_' + i).css('background', '#0c2e49');
        $('#tr_preg_otros_' + i + ' .div_faq').css('color', '#f6f6f6');
    }
    else
    {
        $('#tr_resp_otros_' + i).hide(500);
        $('#tr_preg_otros_' + i).css('background', '#f6f6f6');
        $('#tr_preg_otros_' + i + ' .div_faq').css('color', '#0c2e49');
    }
}

function clickPregAdmin(i, idPregunta)
{
    var numPreguntas = $('#num_preguntas5').val();

    for (var a = 0; a <= numPreguntas; a++)
    {
        (function(a) {

            $('#tr_resp_admin_' + a).hide(500);
            $('#tr_preg_admin_' + a).css('background', '#f6f6f6');
            $('#tr_preg_admin_' + a + ' .div_faq').css('color', '#0c2e49');
        }(a));
    }

    if ($('#tr_resp_admin_' + i).css("display") == "none")
    {
        $('#tr_resp_admin_' + i).show(500);
        $('#tr_preg_admin_' + i).css('background', '#0c2e49');
        $('#tr_preg_admin_' + i + ' .div_faq').css('color', '#f6f6f6');
    }
    else
    {
        $('#tr_resp_admin_' + i).hide(500);
        $('#tr_preg_admin_' + i).css('background', '#f6f6f6');
        $('#tr_preg_admin_' + i + ' .div_faq').css('color', '#0c2e49');
    }
}

function clickPreguntasFrecuentes()
{
    $('#div_preguntas_frecuentes').show(200);
    $('.table_tickets_abiertos').hide();
    $('.table_tickets_cerrados').hide();
    $('#btn_preg_frecuentes').addClass('active_consultas');
    $('#btn_consultas_abiertas').removeClass('active_consultas');
    $('#btn_consultas_cerradas').removeClass('active_consultas');
}

function clickBtnConsultas(activo)
{
    if (activo)
    {
        $('#div_preguntas_frecuentes').hide();
        $('.table_tickets_abiertos').show(200);
        $('.table_tickets_cerrados').hide();
        $('#btn_preg_frecuentes').removeClass('active_consultas');
        $('#btn_consultas_abiertas').addClass('active_consultas');
        $('#btn_consultas_cerradas').removeClass('active_consultas');
    }
    else
    {
        $('#div_preguntas_frecuentes').hide();
        $('.table_tickets_abiertos').hide();
        $('.table_tickets_cerrados').show(200);
        $('#btn_preg_frecuentes').removeClass('active_consultas');
        $('#btn_consultas_abiertas').removeClass('active_consultas');
        $('#btn_consultas_cerradas').addClass('active_consultas');
    }
}

function mostrarTicket(elemento)
{
    var tr_comentario = $(elemento).parent().parent().find('.tr_comentarios');

    if (tr_comentario.css('display') == 'none')
    {
        tr_comentario.show(200);
    }
    else
    {
        tr_comentario.hide(200);
    }
}

function cerrarConsulta(refTicket)
{
    if (window.confirm('¿Estás seguro que quieres cerrar esta consulta?'))
    {
        var formData = new FormData();
        formData.append('refTicket', refTicket);
        formData.append('_token', $('#_token').val());

        $.ajax({
            url: '/xweb/cerrarconsulta',
            type: 'post',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {

                location.reload();
            }
        }); 
    }
}


function buscadorConsultas(){

    var input_buscador_consultas = document.getElementById("input_buscador_consultas");
    var filter = input_buscador_consultas.value.toUpperCase();

    var titulo_preguntas_tecnicas = document.getElementById("titulo_preg_tecnicas");
    var titulo_preguntas_envios = document.getElementById("titulo_preg_envios");
    var titulo_preguntas_productos = document.getElementById("titulo_preg_productos");
    var titulo_preguntas_rma = document.getElementById("titulo_preg_rma");
    var titulo_preguntas_administrativas = document.getElementById("titulo_preg_admin");

    var cont_preguntas_tecnicas = 0;
    var cont_preguntas_envios = 0;
    var cont_preguntas_productos = 0;
    var cont_preguntas_rma = 0;
    var cont_preguntas_administrativas = 0;

    var ul = document.getElementById("ul_preguntas_consultas");
    var li = ul.getElementsByTagName("li");

    var tablePregunta;

    titulo_preguntas_tecnicas.style.display = "";
    titulo_preguntas_envios.style.display = "";
    titulo_preguntas_productos.style.display = "";
    titulo_preguntas_rma.style.display = "";
    titulo_preguntas_administrativas.style.display = "";

    for (i = 0; i < li.length; i++) 
    {
        id = li[i].getElementsByTagName("p")[0];
        txtId = id.textContent || id.innerText;

        tipo_pregunta = li[i].getElementsByTagName("span")[0];
        txtTipo_pregunta = tipo_pregunta.textContent || tipo_pregunta.innerText;

        pregunta = li[i].getElementsByTagName("a")[0];
        txtPregunta = pregunta.textContent || pregunta.innerText;

        tablePregunta = document.getElementById("table_pregunta_" + txtId);

        if (txtPregunta.toUpperCase().indexOf(filter) > -1) 
        {
            li[i].style.display = "";
            tablePregunta.style.display = "";

            if (txtTipo_pregunta == 1)
            {
                cont_preguntas_tecnicas += 1;
            }
            else if (txtTipo_pregunta == 2)
            {
                cont_preguntas_envios += 1;
            }
            else if (txtTipo_pregunta == 3)
            {
                cont_preguntas_rma += 1;
            }
            else if (txtTipo_pregunta == 5)
            {
                cont_preguntas_administrativas += 1;
            }
            else if (txtTipo_pregunta == 6)
            {
                cont_preguntas_productos += 1;
            }
        } 
        else 
        {
            li[i].style.display = "none";
            tablePregunta.style.display = "none";
        }
    }

    if (cont_preguntas_tecnicas == 0)
    {
        titulo_preguntas_tecnicas.style.display = "none";
    }

    if (cont_preguntas_envios == 0)
    {
        titulo_preguntas_envios.style.display = "none";
    }

    if (cont_preguntas_productos == 0)
    {
        titulo_preguntas_productos.style.display = "none";
    }

    if (cont_preguntas_rma == 0)
    {
        titulo_preguntas_rma.style.display = "none";
    }

    if (cont_preguntas_administrativas == 0)
    {
        titulo_preguntas_administrativas.style.display = "none";
    }
}
	</script>
@endsection