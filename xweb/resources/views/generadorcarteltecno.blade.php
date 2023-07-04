@extends("base")

@section("dashboard")

@if(session('usuario')->uData->codigo == 0)
	<div class="rmaContSolicitudes">
		<div class="rmaSolT" style="min-height: 500px;">
			<div class="rmaSolC" style="padding: 30px 0; color: #0b2e48; font-weight: bold; vertical-align: middle;">
				Por favor, inicia sesión para continuar
			</div>
		</div>
	</div>
@else

<div id="xw_boxcentral" style="min-height:500px; padding-top: 0px; background-color: #f3f3f3;">
	<table class="table_generador_anuncios">
		<tr>
			<td class="td_info_cartel_tecno">
				<table class="table_formulario_generador_anuncios" style="margin-top: 20px;">
					<tr>
						<td class="titulo_info_cartel_tecno">
							<i class="fa fa-tasks" aria-hidden="true"></i>
							<div style="margin-top: 2px;">Información</div>
						</td>
					</tr>
					<tr>
						<td style="width: 100%; padding-left: 10px;">
							<table id="table_datos_generador_anuncios" style="width: 100%;">
								<tr>
									<td class="td_elemento_cartel_tecno">
										<div class="div_caract_generador_anuncios" style="padding-right: 10px;">
											<input type="checkbox" id="check_cartel_logo" name="check_cartel_logo" checked="checked" class="check_cartel" onclick="mostrarElementoCartel('#div_cartel_logo')" style="width: 16px;" />
										</div>
										<div style="padding-top: 7px;">Logo</div>
									</td>
									<td class="td_input_cartel_tecno" style="width: 312px;">
										<table>
											<tr>
												<td>
													<div style="font-weight: 100; font-size:10pt; width: 200px; margin-top: -6px;">Sube el logo de tu empresa</div>
												</td>
												<td>
													<input type="file" id="input_cartel_logo" name="input_cartel_logo" onchange="readURLLogoCartel(this)" style="width: 97.5%; margin-top: 4px; font-weight: 100; font-size: 10pt;" />
												</td>
											</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td class="td_elemento_cartel_tecno">
										<div class="div_caract_generador_anuncios" style="padding-right: 10px;">
											<input type="checkbox" id="check_cartel_tlfno" name="check_cartel_tlfno" checked="checked" class="check_cartel" onclick="mostrarElementoCartel('#div_cartel_tlfno')" style="width: 16px;" />
										</div>
										<div style="padding-top: 7px;">Teléfono</div>
									</td>
									<td class="td_input_cartel_tecno">
										<table>
											<tr>
												<td>
													<input type="text" id="input_cartel_dato_tlfno" name="input_cartel_dato_tlfno" oninput="editarTextoCartel('#input_cartel_dato_tlfno', '#div_cartel_dato_tlfno')" value="Tu teléfono" style="width: 415px;" />
												</td>
											</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td class="td_elemento_cartel_tecno">
										<div class="div_caract_generador_anuncios" style="padding-right: 10px;">
											<input type="checkbox" id="check_cartel_web" name="check_cartel_web" checked="checked" class="check_cartel" onclick="mostrarElementoCartel('#div_cartel_web')" style="width: 16px;" />
										</div>
										<div style="padding-top: 7px;">Página web</div>
									</td>
									<td class="td_input_cartel_tecno">
										<table>
											<tr>
												<td>
													<input type="text" id="input_cartel_dato_web" name="input_cartel_dato_web" oninput="editarTextoCartel('#input_cartel_dato_web', '#div_cartel_dato_web')" value="Tu web" style="width: 415px;" />
												</td>
											</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td class="td_elemento_cartel_tecno">
										<div class="div_caract_generador_anuncios" style="padding-right: 10px;">
											<input type="checkbox" id="check_cartel_tienda" name="check_cartel_tienda" checked="checked" class="check_cartel" onclick="mostrarElementoCartel('#div_cartel_tienda')" style="width: 16px;" />
										</div>
										<div style="padding-top: 7px;">Dirección</div>
									</td>
									<td class="td_input_cartel_tecno">
										<table>
											<tr>
												<td>
													<input type="text" id="input_cartel_dato_tienda" name="input_cartel_dato_tienda" oninput="editarTextoCartel('#input_cartel_dato_tienda', '#div_cartel_dato_tienda')" value="Tu dirección" style="width: 415px;" />
												</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr style="border-top: 1px solid #000;">
						<td style="width: 100%">
							<table style="width: 100%">
								<tr>
									<td class="td_elemento_cartel_tecno" style="padding-left: 10px; float: left;">
										<i class="fa fa-tint" aria-hidden="true" style="margin-top: 10px;"></i>
										<div style="margin-top: 8px;">Colores:</div>
									</td>
									<td style="float: left">
										<input type="color" id="input_cartel_color1" name="input_cartel_color1" class="input_color_fuente_anuncio" value="#111c30" oninput="cambiarColorTextoCartel()" />
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr style="border-top: 1px solid #000;">
						<td style="width: 100%">
							<table class="table_formulario_generador_anuncios">
								<tr>
									<td style="width: 9%">
										<i class="fa fa-cube" aria-hidden="true"></i>
										<div style="margin-top: 2px; text-align: right; padding-right: 10px;">Logo: </div>
									</td>
									<td style="width: 9%">
										<table class="table_dir_foto_seleccionado" style="float: left">
											<tr>
												<td></td>
												<td>
													<button id="button_arriba_logo" onmousedown="moverElementoAnuncio('#div_cartel_logo', true, false)" onmouseup="soltarElementoAnuncio()">
														<i class="fa fa-caret-up" style="margin-right: 0px" aria-hidden="true"></i>
													</button>
												</td>
												<td></td>
											</tr>
											<tr>
												<td>
													<button id="button_izq_logo" onmousedown="moverElementoAnuncio('#div_cartel_logo', false, false)" onmouseup="soltarElementoAnuncio()">
														<i class="fa fa-caret-left" style="margin-right: 0px" aria-hidden="true"></i>
													</button>
												</td>
												<td>
													<i class="fa fa-bars" style="width: 30px; font-weight: bold; font-size: 16pt; padding: 3px 6px; margin-right: 0px;"></i>
												</td>
												<td>
													<button id="button_der_logo" onmousedown="moverElementoAnuncio('#div_cartel_logo', false, true)" onmouseup="soltarElementoAnuncio()">
														<i class="fa fa-caret-right" style="margin-right: 0px" aria-hidden="true"></i>
													</button>
												</td>
											</tr>
											<tr>
												<td></td>
												<td>
													<button id="button_abajo_logo" onmousedown="moverElementoAnuncio('#div_cartel_logo', true, true)" onmouseup="soltarElementoAnuncio()">
														<i class="fa fa-caret-down" style="margin-right: 0px" aria-hidden="true"></i>
													</button>
												</td>
												<td></td>
											</tr>
										</table>
									</td>
									<td style="width: 9%"></td>
									<td style="width: 9%">
										<div style="margin-top: 2px; text-align: right; padding-right: 10px;">Información: </div>
									</td>
									<td style="width: 9%">
										<table class="table_dir_foto_seleccionado" style="float: left">
											<tr>
												<td></td>
												<td>
													<button id="button_arriba_tienda" onmousedown="moverElementoAnuncio('#table_cartel_info', true, false)" onmouseup="soltarElementoAnuncio()">
														<i class="fa fa-caret-up" style="margin-right: 0px" aria-hidden="true"></i>
													</button>
												</td>
												<td></td>
											</tr>
											<tr>
												<td>
													<button id="button_izq_tienda" onmousedown="moverElementoAnuncio('#table_cartel_info', false, false)" onmouseup="soltarElementoAnuncio()">
														<i class="fa fa-caret-left" style="margin-right: 0px" aria-hidden="true"></i>
													</button>
												</td>
												<td>
													<i class="fa fa-bars" style="width: 30px; font-weight: bold; font-size: 16pt; padding: 3px 6px; margin-right: 0px;"></i>
												</td>
												<td>
													<button id="button_der_tienda" onmousedown="moverElementoAnuncio('#table_cartel_info', false, true)" onmouseup="soltarElementoAnuncio()">
														<i class="fa fa-caret-right" style="margin-right: 0px" aria-hidden="true"></i>
													</button>
												</td>
											</tr>
											<tr>
												<td></td>
												<td>
													<button id="button_abajo_tienda" onmousedown="moverElementoAnuncio('#table_cartel_info', true, true)" onmouseup="soltarElementoAnuncio()">
														<i class="fa fa-caret-down" style="margin-right: 0px" aria-hidden="true"></i>
													</button>
												</td>
												<td></td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td>
							<div>
								<button id="button_generar_imagen" onclick="generarCartel()" class="button_generar_cartel" style="margin-right: 0px;">
									<i class="fa fa-download" aria-hidden="true"></i>
									Generar cartel			
								</button>
							</div>
						</td>
					</tr>
				</table>
			</td>
			<td class="td_anuncio_generado" style="width: 650px">
				<div>
					<div id="div_anuncio_generado">
						<img src="/xweb/public/carteles/<?php echo $archivo; ?>" style="width: 100%; height: auto; margin-top: -8px;" />
						<div id="div_cartel_logo" name="div_cartel_logo" class="div_cartel_mostrado" style="top: 386px; left: 52px; padding: 7px 16px;">
							<img id="img_logo_cartel" src="/xweb/public/images/tulogo.png" style="max-width: 92px; max-height: 15px;" />
						</div>
						<table id="table_cartel_info" style="position: absolute; top: 386px; left: 186px; width: 500px;">
							<tr class="div_cartel_mostrado" style="padding: 6.5px 6px;">
								<td id="div_cartel_tlfno" name="div_cartel_tlfno" style="width: 112px;">
									<div style="display: flex; margin-right: 10px;">
										<div>
											<img src="/xweb/public/images/icono_telefono.png" style="width: auto; height: 20px;"/>
										</div>
										<div style="padding-top: 3px; padding-left: 5px;">
											<div id="div_cartel_dato_tlfno" style="font-size: 8.5pt; font-family: 'gothamultra'; white-space: nowrap;">Tu teléfono</div>
										</div>
									</div>
								</td>
								<td id="div_cartel_web" name="div_cartel_web" style="width: 104px;">
									<div style="display: flex; margin-right: 10px;"> 
										<div>
											<img src="/xweb/public/images/icono_web.png" style="width: auto; height: 20px;"/>
										</div>
										<div style="padding-top: 4px; padding-left: 5px;">
											<div id="div_cartel_dato_web" style="font-size: 7pt; font-family: 'gothamultra'; white-space: nowrap;">Tu web</div>
										</div>
									</div>
								</td>
								<td id="div_cartel_tienda" name="div_cartel_tienda" style="width: 126px;">
									<div style="display: flex; margin-right: 10px;">
										<div>
											<img src="/xweb/public/images/icono_casa.png" style="width: auto; height: 20px;"/>
										</div>
										<div style="padding-top: 1px; margin-left: 5px; text-align: left; display: table;">
											<div id="div_cartel_dato_tienda" style="font-size: 6pt; font-family: montserratregular; line-height: 9px; vertical-align: middle;display: table-cell; padding-top: 2px;">Tu dirección</div>
										</div>
									</div>
								</td>
							</tr>
						</table>
					</div>
				</div>
			</td>
		</tr>
	</table>
</div>

@endif

@endsection