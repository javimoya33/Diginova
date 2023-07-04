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

	<!-- Lista de Hiddens -->	
	<input type="hidden" id="num_art_mostrados" name="num_art_mostrados" value="10">
	<input type="hidden" id="rotacion_imagen" name="rotacion_imagen" value="0">
	<input type="hidden" id="voltear_imagen" name="voltear_imagen" value="0">

	<div id="xw_boxcentral" style="min-height:500px; padding-top: 0px; background-color: #fafafa; background-color: #f3f3f3;">
		<table class="table_generador_anuncios">
			<tr>
				<td class="td_anuncio_generado">
					<div style="min-height: 350px;">
						<div id="div_anuncio_generado">
							<img src="/xweb/public/fotobanners/fondos/bannerf23.png" id="img_fondo_articulo_seleccionado" style="width: 750px; height: 300px;" />
							<img src="/xweb/public/fotobanners/art_6910do3901gb_1 copia.png" id="img_foto_articulo_seleccionado" />
							<img src="/xweb/public/images/teclado_castellano.png" id="img_teclado_castellano" style="display: none">
							<div id="titulo_articulo_seleccionado">
								<div id="nombre_articulo_seleccionado">
									<div class="div_nombre_articulo" style="float: left; margin-right: 10px;"></div>
									<div class="div_nombre_articulo" style="font-weight: 800; float: left;"></div>
								</div>
							</div>

							<?php
							for ($i = 0; $i < 2; $i++) 
							{ 
								?>
								<div id="div_precio<?php echo $i ?>_articulo_seleccionado" class="div_precio_articulo_seleccionado">
									<table>
										<tr>
											<td colspan="2">
												<div id="txt_precio<?php echo $i ?>_articulo_seleccionado" style="margin-bottom: -5px;">
													<span class="span_txt_precio_articulo" style="font-weight: bold; color: #dadada; font-size: 12.9pt;"></span>
												</div>
											</td>
										</tr>
										<tr>
											<td>
												<div id="tachado<?php echo $i ?>_articulo_seleccionado" class="tachado_articulo_seleccionado" style="display: none; z-index: 9999;">____</div>
												<div id="precio<?php echo $i ?>_articulo_seleccionado" class="precio<?php echo $i ?>_articulo_seleccionado">0</div>
											</td>
											<td>
												<div id="euro<?php echo $i ?>_articulo_seleccionado">€</div>
											</td>
										</tr>
									</table>
								</div>
								<?php
							}
							?>
							
							<div id="div_precio2_articulo_seleccionado" class="div_precio_articulo_seleccionado">
								<table>
									<tr>
										<td colspan="2">
											<div id="txt_precio2_articulo_seleccionado" style="margin-bottom: -5px;">
												<span class="span_txt_precio_articulo" style="color: #dadada; font-size: 10.65pt;"></span>
											</div>
										</td>
									</tr>
									<tr>
										<td>
											<div id="tachado2_articulo_seleccionado" class="tachado_articulo_seleccionado" style="display: none; z-index: 9999;">____</div>
											<div id="precio2_articulo_seleccionado" class="precio2_articulo_seleccionado">0</div>
										</td>
										<td>
											<div id="euro2_articulo_seleccionado">€</div>
										</td>
									</tr>
								</table>
							</div>
							<div id="div_precio3_articulo_seleccionado" class="div_precio_articulo_seleccionado">
								<table>
									<tr>
										<td colspan="2">
											<div id="txt_precio3_articulo_seleccionado" style="margin-bottom: -5px;">
												<span class="span_txt_precio_articulo" style="color: #dadada; font-size: 10.65pt;"></span>
											</div>
										</td>
									</tr>
									<tr>
										<td>
											<div id="tachado3_articulo_seleccionado" class="tachado_articulo_seleccionado" style="display: none; z-index: 9999;">____</div>
											<div id="precio3_articulo_seleccionado" class="precio3_articulo_seleccionado">0</div>
										</td>
										<td>
											<div id="euro3_articulo_seleccionado">€</div>
										</td>
									</tr>
								</table>
							</div>
							<div id="div_carac_text_articulo_seleccionado">
								<div>
									<div class="nombre_caract" style="margin-right: 5px; color: #ffffff; white-space: nowrap;">Procesador</div>
									<div class="valor_caract" style="color: #ff7500; margin-right: 15px; white-space: nowrap;">Intel Core I3 2100 3.1Ghz</div>
								</div>
							</div>
							<div id="div_carac3_text_articulo_seleccionado">
								<div class="nombre_caract"></div>
							</div>
							<div id="div_carac_icon_articulo_seleccionado"></div>
							<div id="div_carac2_icon_articulo_seleccionado">
								<img src="/xweb/public/fotobanners/iconos/discoduro-250-hdd.png" id="img_caract_discoduro" />
								<img src="/xweb/public/fotobanners/iconos/ram-4-ddr3.png" id="img_caract_ram" />
								<img src="/xweb/public/fotobanners/iconos/dvd.png" id="img_caract_dvd" />
								<img src="/xweb/public/fotobanners/iconos/windows-7-pro.png" id="img_caract_so" />
							</div>
							<div id="div_datos_usuario_seleccionado">
								<div id="div_texto_dato1_usuario_seleccionado" class="div_texto_dato_usuario_seleccionado"> </div>
								<div id="div_dato1_usuario_seleccionado" class="div_dato_usuario_seleccionado"> </div>
								<div id="div_texto_dato2_usuario_seleccionado" class="div_texto_dato_usuario_seleccionado"> </div>
								<div id="div_dato2_usuario_seleccionado" class="div_dato_usuario_seleccionado"> </div>
							</div>
							<div id="panel_articulo_seleccionado">
								<div id="div_panel_articulo_seleccionado">
									<div id="div_txt_panel_articulo_seleccionado">HAZTE CON ÉL</div>
									<div id="div_img_flecha_panel" style="border: 1px solid rgba(2, 91, 126, 0.5);">
										<i class="fa fa-chevron-left" id="img_flecha_panel"></i>
									</div>
								</div>
							</div>
						</div>
						<div id="msj_aviso_resolucion">
							La resolución de la imagen del artículo es demasiado baja. Es recomendable que sustituya la imagen por otra de mayor resolución (Mínimo 500px de ancho o 500px de alto).			
						</div>
					</div>
				</td>
				<td class="td_anuncio_generado" rowspan="3">
					<div id="div_scroll_articulos" onscroll="scrollArticulos(this)">
						<div>Seleccione un artículo: </div>
						<div>
							<span class="span_buscar_articulo">Buscar por nombre o referencia: </span>
							<input type="text" id="buscar_generador" placeholder="Buscar un artículo..." oninput="buscarArticulosAnuncio()" onpaste="buscarArticulosAnuncio()" value="" />
						</div>

						<?php $contFacturas = 0; ?>
						@foreach($arrArticulos as $arrArticulo)

							<input type="hidden" id="input_seleccion_articulo_<?php echo $contFacturas ?>" name="input_seleccion_articulo" value="<?php echo strtolower($arrArticulo->ACODAR) ?>">
							<table id="table_list_articulo_<?php echo strtolower($arrArticulo->ACODAR) ?>" class="table_seleccion_articulo" 
								<?php if ($contFacturas >= 10) { ?> style="display: none" <?php } ?>>
								<tr onclick="pulsarArticuloParaAnuncio('{{$arrArticulo->ADESCR}}', {{$arrArticulo->PRECIO}}, '{{$arrArticulo->urlfoto}}');" style="border-left: none;">
									<td class="td_seleccion_imagen" style="width: 40%;">
										<div>
											<img src="{{$arrArticulo->urlfoto}}"/>
										</div>
									</td>
									<td style="width: 60%; vertical-align: top;">
										<table class="table_datos_articulos_comprados">
											<tr>
												<td>
													<div>
														<a title="{{$arrArticulo->ADESCR}}" style="color: #000;">
															<b><?php echo substr($arrArticulo->ADESCR, 0, 40) ?>...</b>
														</a>
													</div>
												</td>
											</tr>
											<tr>
												<td>
													<div>Referencia: {{$arrArticulo->ACODAR}}</div>
												</td>
											</tr>
											<tr>
												<td>
													<div>
																																				
													</div>
												</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
							<?php
							$contFacturas += 1;

						
							?>
						@endforeach
					</div>
				</td>
			</tr>
			<tr>
				<td style="padding: 20px; padding-top: 0px;">
					<form id="radio_plantilla">
						<table class="table_formulario_generador_anuncios">
							<tr>

								<td class="td_generador_espacio_lateral"></td>

								<?php
								for ($i = 0; $i < 5; $i++) 
								{
									?>
									<td class="td_generador_formulario_celda">
										<input type="radio" id="radio_plantilla<?php echo $i ?>" name="radio_plantilla" value="p1" class="input_generador_formulario_celda" onclick="pulsarPlantillaAnuncio<?php echo $i ?>()">
										<div>Plantilla<?php echo $i ?></div>
									</td>

									<?php
									if ($i < 4)
									{
										?>
										<td class="td_generador_espacio_interior"></td>
										<?php
									}
								} 
								?>

								<td class="td_generador_espacio_lateral"></td>

							</tr>
						</table>
					</form>
				</td>
			</tr>
			<tr>
				<td style="padding: 20px; padding-top: 0px;">
					<table class="table_formulario_generador_anuncios" style="border-bottom: 1px #000 solid;">
						<?php
						for ($i = 0; $i < 2; $i++) 
						{
							?>
							<tr>
							<?php
								for ($a = 0; $a < 4; $a++) 
								{ 
									?>
									<td class="td_generador_formulario_celda">
										<div class="div_generador_formulario_celda"><?php echo $arrDatosFormulario[$i * 4 + $a] ?>: </div>
									</td>
									<td class="td_generador_formulario_celda">
										<table class="table_dir_foto_seleccionado" style="float: left">
											<tr>
												<td></td>
												<td>
													<button id="button_arriba_<?php echo $arrButtonFormulario[$i * 4 + $a] ?>" onmousedown="moverElementoAnuncio('<?php echo $arrElementosFormulario[$i * 4 + $a] ?>', true, false)" onmouseup="soltarElementoAnuncio()">
														<i class="fa fa-caret-up" style="margin-right: 0px"></i>
													</button>
												</td>
												<td></td>
											</tr>
											<tr>
												<td>
													<button id="button_izq_img" onmousedown="moverElementoAnuncio('<?php echo $arrElementosFormulario[$i * 4 + $a] ?>', false, false)" onmouseup="soltarElementoAnuncio()">
														<i class="fa fa-caret-left" style="margin-right: 0px"></i>
													</button>
												</td>
												<td>
													<i class="<?php echo $arrIconosFormulario[$i * 4 + $a] ?> i_icon_central_formulario_celda" style="font-size: 13px; padding: 0px 5px;"></i>
												</td>
												<td>
													<button id="button_der_img" onmousedown="moverElementoAnuncio('<?php echo $arrElementosFormulario[$i * 4 + $a] ?>', false, true)" onmouseup="soltarElementoAnuncio()">
														<i class="fa fa-caret-right" style="margin-right: 0px"></i>
													</button>
												</td>
											</tr>
											<tr>
												<td></td>
												<td>
													<button id="button_abajo_img" onmousedown="moverElementoAnuncio('<?php echo $arrElementosFormulario[$i * 4 + $a] ?>', true, true)" onmouseup="soltarElementoAnuncio()">
														<i class="fa fa-caret-down" style="margin-right: 0px"></i>
													</button>
												</td>
												<td></td>
											</tr>
										</table>
									</td>

									<td class="td_generador_formulario_celda"></td>
									<?php
								}
								?>
							</tr>
							<tr>
								<?php
								for ($a = 0; $a < 4; $a++) 
								{
									?>
									<td class="td_generador_formulario_celda">
										<div class="div_generador_formulario_celda"><?php echo $arrDatosFormulario[$i * 4 + $a] ?>: </div>
									</td>
									<td class="td_generador_formulario_celda">
										<table class="table_dir_foto_seleccionado" style="float: left">
											<tr>
												<td>
													<button id="button_menos_<?php echo $arrButtonFormulario[$i * 4 + $a] ?>" onclick="cambiarTamanioFuente('<?php echo $arrElementosTamFormulario[$i * 4 + $a] ?>', false, 1)">
														<i class="fa fa-minus i_btn_generador_formulario i_btn_suma_resta"></i>
													</button>
												</td>
												<td>
													<i class="<?php echo $arrIconosTamFormulario[$i * 4 + $a] ?> i_icon_central_formulario_celda" style="font-size: 13px; padding: 0px 5px;"></i>
												</td>
												<td>
													<button id="button_mas_<?php echo $arrButtonFormulario[$i * 4 + $a] ?>" onclick="cambiarTamanioFuente('<?php echo $arrElementosTamFormulario[$i * 4 + $a] ?>', true, 1)">
														<i class="fa fa-plus i_btn_generador_formulario i_btn_suma_resta"></i>
													</button>
												</td>
											</tr>
											<?php
											if ($a == 0)
											{
												?>
												<tr>
													<td style="padding-top: 5px; padding-right: 1px;">
														<button id="button_girar_izq_img" onmousedown="girarImgAnuncio(true)" onmouseup="soltarElementoAnuncio()">
															<i class="fa fa-undo i_btn_generador_formulario" style="font-size: 13px;"></i>
														</button>
													</td>
													<td style="padding-top: 5px; padding-right: 1px;">
														<button id="button_voltear_img" onclick="voltearImgAnuncio()">
															<i class="fa fa-retweet i_btn_generador_formulario" style="font-size: 13px;"></i>
														</button>
													</td>
													<td style="padding-top: 5px; padding-right: 1px;">
														<button id="button_girar_der_img" onmousedown="girarImgAnuncio(false)" onmouseup="soltarElementoAnuncio()">
															<i class="fa fa-undo i_btn_generador_formulario" style="font-size: 13px; transform:scaleX(-1);"></i>
														</button>
													</td>
												</tr>
												<?php
											}
											?>
										</table>
									</td>

									<td class="td_generador_formulario_celda"></td>
									<?php
								}
								?>
							</tr>
							<?php
						}
						?>



						<tr>
							<td class="td_generador_formulario_celda" style="padding-left: 4px;">
								<div class="div_generador_formulario_celda">Precio: </div>
							</td>
							<td class="td_generador_formulario_celda">
								<table class="table_dir_foto_seleccionado" style="float: left">
									<tr>
										<td>
											<button id="button_quitar_precio" onClick="mostrarPrecio(false)" style="padding: 5px; margin-right: 10px; height: auto;">
												<i class="fa fa-minus i_btn_suma_resta" style="margin-right: 0px; font-size: 16px !important;"></i>
											</button>
										</td>
										<td>
											<button id="button_anadir_precio" onClick="mostrarPrecio(true)" style="padding: 5px;margin-right: 10px; height: auto;">
												<i class="fa fa-plus i_btn_suma_resta" style="margin-right: 0px; font-size: 16px !important;"></i>
											</button>
										</td>
									</tr>
								</table>
							</td>

							<td class="td_generador_formulario_celda"></td>

							<?php
							for ($i = 0; $i < 3; $i++) 
							{ 
								?>
								<td class="td_generador_formulario_celda" style="padding-left: 4px;">
									<div class="precio<?php echo $i; ?>_control" <?php if ($i > 0) { ?> style="display: none;" <?php } ?>>
										<div class="div_generador_formulario_celda">Precio<?php echo $i; ?>: </div>
									</div>
								</td>
								<td class="td_generador_formulario_celda">
									<table class="table_dir_foto_seleccionado precio<?php echo $i; ?>_control" style="float: left; <?php if ($i > 0) { ?> display: none; <?php } ?>">
										<tr>
											<td></td>
											<td>
												<button id="button_arriba_precio<?php echo $i; ?>" onmousedown="moverElementoAnuncio('#div_precio<?php echo $i; ?>_articulo_seleccionado', true, false)" onmouseup="soltarElementoAnuncio()">
													<i class="fa fa-caret-up" style="margin-right: 0px"></i>
												</button>
											</td>
											<td></td>
										</tr>
										<tr>
											<td>
												<button id="button_izq_precio<?php echo $i; ?>" onmousedown="moverElementoAnuncio('#div_precio<?php echo $i; ?>_articulo_seleccionado', false, false)" onmouseup="soltarElementoAnuncio()">
													<i class="fa fa-caret-left" style="margin-right: 0px"></i>
												</button>
											</td>
											<td>
												<input type="text" id="input_dir_precio<?php echo $i; ?>_anuncio" name="input_dir_precio<?php echo $i; ?>_anuncio" disabled="disabled" class="input_dir_precio_anuncio" style="padding-left: 0px" value="">
											</td>
											<td>
												<button id="button_der_precio<?php echo $i; ?>" onmousedown="moverElementoAnuncio('#div_precio<?php echo $i; ?>_articulo_seleccionado', false, true)" onmouseup="soltarElementoAnuncio()">
													<i class="fa fa-caret-right" style="margin-right: 0px"></i>
												</button>
											</td>
										</tr>
										<tr>
											<td></td>
											<td>
												<button id="button_abajo_precio<?php echo $i; ?>" onmousedown="moverElementoAnuncio('#div_precio<?php echo $i; ?>_articulo_seleccionado', true, true)" onmouseup="soltarElementoAnuncio()">
													<i class="fa fa-caret-down" style="margin-right: 0px"></i>
												</button>
											</td>
											<td></td>
										</tr>
									</table>
								</td>

								<td class="td_generador_formulario_celda"></td>
								<?php
							}
							?>
						</tr>
						<tr>
							<td style="width: 9%; padding-left: 4px;"></td>
							<td style="width: 9%"></td>
							<td style="width: 9%"></td>
							<td class="td_generador_formulario_celda" style="padding-left: 4px;">
								<div class="precio_control">
									<div class="div_generador_formulario_celda">Precio: </div>
								</div>
							</td>
							<td class="td_generador_formulario_celda">
								<table class="table_dir_foto_seleccionado precio_control" style="float: left">
									<tr>
										<td>
											<button id="button_menos_precio" onmousedown="cambiarTamanioPrecioAnuncio('', false)" onmouseup="soltarElementoAnuncio()">
												<i class="fa fa-minus i_btn_suma_resta" style="margin-right: 0px; font-size: 10pt; padding: 2px 0px;"></i>
											</button>
										</td>
										<td>
											<i class="fa fa-text-height i_icon_central_formulario_celda" style="font-size: 13pt; padding: 0px 5px;"></i>
										</td>
										<td>
											<button id="button_mas_precio" onmousedown="cambiarTamanioPrecioAnuncio('', true)" onmouseup="soltarElementoAnuncio()">
												<i class="fa fa-plus i_btn_suma_resta" style="margin-right: 0px; font-size: 10pt; padding: 2px 0px;"></i>
											</button>
										</td>
									</tr>
								</table>
							</td>

							<td class="td_generador_formulario_celda"></td>

							<td class="td_generador_formulario_celda" style="padding-left: 4px;">
								<div class="precio2_control" style="display: none;">
									<div class="div_generador_formulario_celda">Precio2: </div>
								</div>
							</td>
							<td class="td_generador_formulario_celda">
								<table class="table_dir_foto_seleccionado precio2_control" style="float: left; display: none;">
									<tr>
										<td>
											<button id="button_menos_precio2" onmousedown="cambiarTamanioPrecioAnuncio('2', false)" onmouseup="soltarElementoAnuncio()">
												<i class="fa fa-minus i_btn_suma_resta" style="margin-right: 0px; font-size: 10pt; padding: 2px 0px;"></i>
											</button>
										</td>
										<td>
											<i class="fa fa-text-height i_icon_central_formulario_celda" style="font-size: 13pt; padding: 0px 5px;"></i>
										</td>
										<td>
											<button id="button_mas_precio2" onmousedown="cambiarTamanioPrecioAnuncio('2', true)" onmouseup="soltarElementoAnuncio()">
												<i class="fa fa-plus i_btn_suma_resta" style="margin-right: 0px; font-size: 10pt; padding: 2px 0px;"></i>
											</button>
										</td>
									</tr>
								</table>
							</td>

							<td class="td_generador_formulario_celda"></td>

							<td class="td_generador_formulario_celda" style="padding-left: 4px;">
								<div class="precio3_control" style="display: none;">
									<div class="div_generador_formulario_celda">Precio3: </div>
								</div>
							</td>
							<td class="td_generador_formulario_celda">
								<table class="table_dir_foto_seleccionado precio3_control" style="float: left; display: none;">
									<tr>
										<td>
											<button id="button_menos_precio3" onmousedown="cambiarTamanioPrecioAnuncio('3', false)" onmouseup="soltarElementoAnuncio()">
												<i class="fa fa-minus i_btn_suma_resta" style="margin-right: 0px; font-size: 10pt; padding: 2px 0px;"></i>
											</button>
										</td>
										<td>
											<i class="fa fa-text-height i_icon_central_formulario_celda" style="font-size: 13pt; padding: 0px 5px;"></i>
										</td>
										<td>
											<button id="button_mas_precio3" onmousedown="cambiarTamanioPrecioAnuncio('3', true)" onmouseup="soltarElementoAnuncio()">
												<i class="fa fa-plus i_btn_suma_resta" style="margin-right: 0px; font-size: 10pt; padding: 2px 0px;"></i>
											</button>
										</td>
									</tr>
								</table>
							</td>
						</tr>




						<tr>
							<td class="td_generador_formulario_celda">
								<div class="div_generador_formulario_celda">Imagen: </div>
							</td>
							<td class="td_generador_formulario_celda">
								<table class="table_dir_foto_seleccionado" style="float: left">
									<tr>
										<td></td>
										<td>
											<button id="button_arriba_img" onmousedown="moverElementoAnuncio('#img_foto_articulo_seleccionado', true, false)" onmouseup="soltarElementoAnuncio()">
												<i class="fa fa-caret-up" style="margin-right: 0px"></i>
											</button>
										</td>
										<td></td>
									</tr>
									<tr>
										<td>
											<button id="button_izq_img" onmousedown="moverElementoAnuncio('#img_foto_articulo_seleccionado', false, false)" onmouseup="soltarElementoAnuncio()">
												<i class="fa fa-caret-left" style="margin-right: 0px"></i>
											</button>
										</td>
										<td>
											<img src="/xweb/public/fotobanners/art_6910do3901gb_1 copia.png" id="img_dir_foto_articulo_seleccionado" width="28" style="padding: 3px;">
										</td>
										<td>
											<button id="button_der_img" onmousedown="moverElementoAnuncio('#img_foto_articulo_seleccionado', false, true)" onmouseup="soltarElementoAnuncio()">
												<i class="fa fa-caret-right" style="margin-right: 0px"></i>
											</button>
										</td>
									</tr>
									<tr>
										<td></td>
										<td>
											<button id="button_abajo_img" onmousedown="moverElementoAnuncio('#img_foto_articulo_seleccionado', true, true)" onmouseup="soltarElementoAnuncio()">
												<i class="fa fa-caret-down" style="margin-right: 0px"></i>
											</button>
										</td>
										<td></td>
									</tr>
								</table>
							</td>

							<td class="td_generador_formulario_celda"></td>

							<td class="td_generador_formulario_celda">
								<div class="div_generador_formulario_celda">Título: </div>
							</td>
							<td class="td_generador_formulario_celda">
								<table class="table_dir_foto_seleccionado" style="float: left">
									<tr>
										<td></td>
										<td>
											<button id="button_arriba_titulo" onmousedown="moverElementoAnuncio('#titulo_articulo_seleccionado', true, false)" onmouseup="soltarElementoAnuncio()">
												<i class="fa fa-caret-up" style="margin-right: 0px"></i>
											</button>
										</td>
										<td></td>
									</tr>
									<tr>
										<td>
											<button id="button_izq_titulo" onmousedown="moverElementoAnuncio('#titulo_articulo_seleccionado', false, false)" onmouseup="soltarElementoAnuncio()">
												<i class="fa fa-caret-left" style="margin-right: 0px"></i>
											</button>
										</td>
										<td>
											<input type="text" disabled="disabled" style="width: 26px; height: 26px; text-align: center; font-weight: bold; font-size: 18pt; padding: 0px; background: none; border: none; margin: 0;" value="T">
										</td>
										<td>
											<button id="button_der_titulo" onmousedown="moverElementoAnuncio('#titulo_articulo_seleccionado', false, true)" onmouseup="soltarElementoAnuncio()">
												<i class="fa fa-caret-right" style="margin-right: 0px"></i>
											</button>
										</td>
									</tr>
									<tr>
										<td></td>
										<td>
											<button id="button_abajo_titulo" onmousedown="moverElementoAnuncio('#titulo_articulo_seleccionado', true, true)" onmouseup="soltarElementoAnuncio()">
												<i class="fa fa-caret-down" style="margin-right: 0px"></i>
											</button>
										</td>
										<td></td>
									</tr>
								</table>
							</td>

							<td class="td_generador_formulario_celda"></td>

							<td class="td_generador_formulario_celda">
								<div class="div_generador_formulario_celda">Caract.: </div>
							</td>
							<td class="td_generador_formulario_celda">
								<table class="table_dir_foto_seleccionado" style="float: left">
									<tr>
										<td></td>
										<td>
											<button id="button_arriba_caract" onmousedown="moverElementoAnuncio('#div_carac_text_articulo_seleccionado', true, false)" onmouseup="soltarElementoAnuncio()">
												<i class="fa fa-caret-up" style="margin-right: 0px"></i>
											</button>
										</td>
										<td></td>
									</tr>
									<tr>
										<td>
											<button id="button_izq_caract" onmousedown="moverElementoAnuncio('#div_carac_text_articulo_seleccionado', false, false)" onmouseup="soltarElementoAnuncio()">
												<i class="fa fa-caret-left" style="margin-right: 0px"></i>
											</button>
										</td>
										<td>
											<i class="fa fa-bars" style="width: 30px; font-weight: bold; font-size: 16pt !important; padding: 1px 3px; margin-right: 0px;"></i>
										</td>
										<td>
											<button id="button_der_caract" onmousedown="moverElementoAnuncio('#div_carac_text_articulo_seleccionado', false, true)" onmouseup="soltarElementoAnuncio()">
												<i class="fa fa-caret-right" style="margin-right: 0px"></i>
											</button>
										</td>
									</tr>
									<tr>
										<td></td>
										<td>
											<button id="button_abajo_caract" onmousedown="moverElementoAnuncio('#div_carac_text_articulo_seleccionado', true, true)" onmouseup="soltarElementoAnuncio()">
												<i class="fa fa-caret-down" style="margin-right: 0px"></i>
											</button>
										</td>
										<td></td>
									</tr>
								</table>
							</td>

							<td class="td_generador_formulario_celda"></td>

							<td class="td_generador_formulario_celda">
								<div class="div_generador_formulario_celda">Iconos: </div>
							</td>
							<td class="td_generador_formulario_celda">
								<table class="table_dir_foto_seleccionado" style="float: left">
									<tr>
										<td></td>
										<td>
											<button id="button_arriba_iconos" onmousedown="moverElementoAnuncio('#div_carac2_icon_articulo_seleccionado', true, false)" onmouseup="soltarElementoAnuncio()">
												<i class="fa fa-caret-up" style="margin-right: 0px"></i>
											</button>
										</td>
										<td></td>
									</tr>
									<tr>
										<td>
											<button id="button_izq_iconos" onmousedown="moverElementoAnuncio('#div_carac2_icon_articulo_seleccionado', false, false)" onmouseup="soltarElementoAnuncio()">
												<i class="fa fa-caret-left" style="margin-right: 0px"></i>
											</button>
										</td>
										<td>
											<i class="fab fa-tag i_icon_central_formulario_celda" style="font-size: 15pt !important;padding: 3px; padding-left: 7px; margin: 0px !important;">
										</td>
										<td>
											<button id="button_der_iconos" onmousedown="moverElementoAnuncio('#div_carac2_icon_articulo_seleccionado', false, true)" onmouseup="soltarElementoAnuncio()">
												<i class="fa fa-caret-right" style="margin-right: 0px"></i>
											</button>
										</td>
									</tr>
									<tr>
										<td></td>
										<td>
											<button id="button_abajo_iconos" onmousedown="moverElementoAnuncio('#div_carac2_icon_articulo_seleccionado', true, true)" onmouseup="soltarElementoAnuncio()">
												<i class="fa fa-caret-down" style="margin-right: 0px"></i>
											</button>
										</td>
										<td></td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>

							<td class="td_generador_formulario_celda">
								<div class="div_generador_formulario_celda">Imagen: </div>
							</td>
							<td class="td_generador_formulario_celda">
								<table class="table_dir_foto_seleccionado" style="float: left">
									<tr>
										<td>
											<button id="button_menos_imagen" onmousedown="cambiarTamanioImagenAnuncio('#img_foto_articulo_seleccionado', false, 1, 0.55)" onmouseup="soltarElementoAnuncio()">
												<i class="fa fa-minus i_btn_generador_formulario i_btn_suma_resta"></i>
											</button>
										</td>
										<td>
											<img src="/xweb/public/images/icon-resize-image.png" width="28" style="padding: 0px 3px;" />
										</td>
										<td>
											<button id="button_mas_imagen" onmousedown="cambiarTamanioImagenAnuncio('#img_foto_articulo_seleccionado', true, 1, 0.55)" onmouseup="soltarElementoAnuncio()">
												<i class="fa fa-plus i_btn_generador_formulario i_btn_suma_resta"></i>
											</button>
										</td>
									</tr>
									<tr>
										<td style="padding-top: 5px; padding-right: 1px;">
											<button id="button_girar_izq_img" onmousedown="girarImgAnuncio(true)" onmouseup="soltarElementoAnuncio()">
												<i class="fa fa-undo i_btn_generador_formulario" style="font-size: 13px;"></i>
											</button>
										</td>
										<td style="padding-top: 5px; padding-right: 1px;">
											<button id="button_voltear_img" onclick="voltearImgAnuncio()">
												<i class="fa fa-retweet i_btn_generador_formulario" style="font-size: 13px;"></i>
											</button>
										</td>
										<td style="padding-top: 5px; padding-right: 1px;">
											<button id="button_girar_der_img" onmousedown="girarImgAnuncio(false)" onmouseup="soltarElementoAnuncio()">
												<i class="fa fa-undo i_btn_generador_formulario" style="font-size: 13px; transform:scaleX(-1);"></i>
											</button>
										</td>
									</tr>
								</table>
							</td>

							<td class="td_generador_formulario_celda"></td>

							<td class="td_generador_formulario_celda">
								<div class="div_generador_formulario_celda">Título: </div>
							</td>
							<td class="td_generador_formulario_celda">
								<table class="table_dir_foto_seleccionado" style="float: left">
									<tr>
										<td>
											<button id="button_menos_titulo" onclick="cambiarTamanioFuente('#nombre_articulo_seleccionado div', false, 1)">
												<i class="fa fa-minus i_btn_generador_formulario i_btn_suma_resta"></i>
											</button>
										</td>
										<td>
											<i class="fa fa-text-height i_icon_central_formulario_celda" style="font-size: 13px; padding: 0px 5px;"></i>
										</td>
										<td>
											<button id="button_mas_titulo" onclick="cambiarTamanioFuente('#nombre_articulo_seleccionado div', true, 1)">
												<i class="fa fa-plus i_btn_generador_formulario i_btn_suma_resta"></i>
											</button>
										</td>
									</tr>
								</table>
							</td>

							<td class="td_generador_formulario_celda"></td>

							<td class="td_generador_formulario_celda">
								<div class="div_generador_formulario_celda">Caract.: </div>
							</td>
							<td class="td_generador_formulario_celda">
								<table class="table_dir_foto_seleccionado" style="float: left">
									<tr>
										<td>
											<button id="button_menos_caract" onclick="cambiarTamanioFuente('#div_carac_text_articulo_seleccionado div', false, 1)">
												<i class="fa fa-minus i_btn_generador_formulario i_btn_suma_resta"></i>
											</button>
										</td>
										<td>
											<i class="fa fa-text-height i_icon_central_formulario_celda" style="font-size: 13pt; padding: 0px 5px;"></i>
										</td>
										<td>
											<button id="button_mas_caract" onclick="cambiarTamanioFuente('#div_carac_text_articulo_seleccionado div', true, 1)">
												<i class="fa fa-plus i_btn_generador_formulario i_btn_suma_resta"></i>
											</button>
										</td>
									</tr>
								</table>
							</td>

							<td class="td_generador_formulario_celda"></td>

							<td class="td_generador_formulario_celda">
								<div class="div_generador_formulario_celda">Iconos: </div>
							</td>
							<td class="td_generador_formulario_celda">
								<table class="table_dir_foto_seleccionado" style="float: left">
									<tr>
										<td>
											<button id="button_menos_iconos" onmousedown="cambiarTamanioImagenAnuncio('#div_carac2_icon_articulo_seleccionado img', false, 0.2, 0.2)" onmouseup="soltarElementoAnuncio()">
												<i class="fa fa-minus i_btn_generador_formulario i_btn_suma_resta"></i>
											</button>
										</td>
										<td>
											<img src="/xweb/public/images/icon-resize-image.png" width="28" style="padding: 0px 3px;" />
										</td>
										<td>
											<button id="button_mas_iconos" onmousedown="cambiarTamanioImagenAnuncio('#div_carac2_icon_articulo_seleccionado img', true, 0.2, 0.2)" onmouseup="soltarElementoAnuncio()">
												<i class="fa fa-plus i_btn_generador_formulario i_btn_suma_resta"></i>
											</button>
										</td>
									</tr>
								</table>
							</td>
						</tr>

						<tr>

							<td class="td_generador_formulario_celda">
								<div class="div_generador_formulario_celda">Datos: </div>
							</td>
							<td class="td_generador_formulario_celda">
								<table class="table_dir_foto_seleccionado" style="float: left">
									<tr>
										<td></td>
										<td>
											<button id="button_arriba_datos" onmousedown="moverElementoAnuncio('#div_datos_usuario_seleccionado', true, false)" onmouseup="soltarElementoAnuncio()">
												<i class="fa fa-caret-up" style="margin-right: 0px"></i>
											</button>
										</td>
										<td></td>
									</tr>
									<tr>
										<td>
											<button id="button_izq_datos" onmousedown="moverElementoAnuncio('#div_datos_usuario_seleccionado', false, false)" onmouseup="soltarElementoAnuncio()">
												<i class="fa fa-caret-left" style="margin-right: 0px"></i>
											</button>
										</td>
										<td>
											<i class="fa fa-info" style="width: 30px; font-weight: bold; font-size: 15pt !important; padding: 1px 3px; margin-right: 0px;"></i>
										</td>
										<td>
											<button id="button_der_datos" onmousedown="moverElementoAnuncio('#div_datos_usuario_seleccionado', false, true)" onmouseup="soltarElementoAnuncio()">
												<i class="fa fa-caret-right" style="margin-right: 0px"></i>
											</button>
										</td>
									</tr>
									<tr>
										<td></td>
										<td>
											<button id="button_abajo_datos" onmousedown="moverElementoAnuncio('#div_datos_usuario_seleccionado', true, true)" onmouseup="soltarElementoAnuncio()">
												<i class="fa fa-caret-down" style="margin-right: 0px"></i>
											</button>
										</td>
										<td></td>
									</tr>
								</table>
							</td>

							<td class="td_generador_formulario_celda"></td>

							<td class="td_generador_formulario_celda">
								<div class="div_generador_formulario_celda">Botón: </div>
							</td>
							<td class="td_generador_formulario_celda">
								<table class="table_dir_foto_seleccionado" style="float: left">
									<tr>
										<td></td>
										<td>
											<button id="button_arriba_panel" onmousedown="moverElementoAnuncio('#panel_articulo_seleccionado', true, false)" onmouseup="soltarElementoAnuncio()">
												<i class="fa fa-caret-up" style="margin-right: 0px"></i>
											</button>
										</td>
										<td></td>
									</tr>
									<tr>
										<td>
											<button id="button_izq_panel" onmousedown="moverElementoAnuncio('#panel_articulo_seleccionado', false, false)" onmouseup="soltarElementoAnuncio()">
												<i class="fa fa-caret-left" style="margin-right: 0px"></i>
											</button>
										</td>
										<td>
											<i class="fa fa-square" style="width: 30px; font-weight: bold; font-size: 15pt !important; padding: 1px 3px; margin-right: 0px;"></i>
										</td>
										<td>
											<button id="button_der_panel" onmousedown="moverElementoAnuncio('#panel_articulo_seleccionado', false, true)" onmouseup="soltarElementoAnuncio()">
												<i class="fa fa-caret-right" style="margin-right: 0px"></i>
											</button>
										</td>
									</tr>
									<tr>
										<td></td>
										<td>
											<button id="button_abajo_panel" onmousedown="moverElementoAnuncio('#panel_articulo_seleccionado', true, true)" onmouseup="soltarElementoAnuncio()">
												<i class="fa fa-caret-down" style="margin-right: 0px"></i>
											</button>
										</td>
										<td></td>
									</tr>
								</table>
							</td>

							<td class="td_generador_formulario_celda"></td>

							<td class="td_generador_formulario_celda">
								<div class="div_generador_formulario_celda">Teclado: </div>
							</td>
							<td class="td_generador_formulario_celda">
								<table class="table_dir_foto_seleccionado" style="float: left">
									<tr>
										<td></td>
										<td>
											<button id="button_arriba_teclado" onmousedown="moverElementoAnuncio('#img_teclado_castellano', true, false)" onmouseup="soltarElementoAnuncio()">
												<i class="fa fa-caret-up" style="margin-right: 0px"></i>
											</button>
										</td>
										<td></td>
									</tr>
									<tr>
										<td>
											<button id="button_izq_teclado" onmousedown="moverElementoAnuncio('#img_teclado_castellano', false, false)" onmouseup="soltarElementoAnuncio()">
												<i class="fa fa-caret-left" style="margin-right: 0px"></i>
											</button>
										</td>
										<td>
											<i class="fa fa-keyboard" style="width: 30px; font-weight: bold; font-size: 15pt !important; padding: 1px 3px; margin-right: 0px;"></i>
										</td>
										<td>
											<button id="button_der_teclado" onmousedown="moverElementoAnuncio('#img_teclado_castellano', false, true)" onmouseup="soltarElementoAnuncio()">
												<i class="fa fa-caret-right" style="margin-right: 0px"></i>
											</button>
										</td>
									</tr>
									<tr>
										<td></td>
										<td>
											<button id="button_abajo_teclado" onmousedown="moverElementoAnuncio('#img_teclado_castellano', true, true)" onmouseup="soltarElementoAnuncio()">
												<i class="fa fa-caret-down" style="margin-right: 0px"></i>
											</button>
										</td>
										<td></td>
									</tr>
								</table>
							</td>

							<td class="td_generador_formulario_celda"></td>

							<td class="td_generador_formulario_celda">
								<div class="div_generador_formulario_celda">Pulgadas: </div>
							</td>
							<td class="td_generador_formulario_celda">
								<table class="table_dir_foto_seleccionado" style="float: left">
									<tr>
										<td></td>
										<td>
											<button id="button_arriba_pulgadas" onmousedown="moverElementoAnuncio('#div_carac3_text_articulo_seleccionado', true, false)" onmouseup="soltarElementoAnuncio()">
												<i class="fa fa-caret-up" style="margin-right: 0px"></i>
											</button>
										</td>
										<td></td>
									</tr>
									<tr>
										<td>
											<button id="button_izq_pulgadas" onmousedown="moverElementoAnuncio('#div_carac3_text_articulo_seleccionado', false, false)" onmouseup="soltarElementoAnuncio()">
												<i class="fa fa-caret-left" style="margin-right: 0px"></i>
											</button>
										</td>
										<td>
											<i class="fa fa-desktop" style="width: 30px; font-weight: bold; font-size: 14pt !important; padding: 1px 3px; margin-right: 0px;"></i>
										</td>
										<td>
											<button id="button_der_pulgadas" onmousedown="moverElementoAnuncio('#div_carac3_text_articulo_seleccionado', false, true)" onmouseup="soltarElementoAnuncio()">
												<i class="fa fa-caret-right" style="margin-right: 0px"></i>
											</button>
										</td>
									</tr>
									<tr>
										<td></td>
										<td>
											<button id="button_abajo_pulgadas" onmousedown="moverElementoAnuncio('#div_carac3_text_articulo_seleccionado', true, true)" onmouseup="soltarElementoAnuncio()">
												<i class="fa fa-caret-down" style="margin-right: 0px"></i>
											</button>
										</td>
										<td></td>
									</tr>
								</table>
							</td>
						</tr>

						<tr>
							<td class="td_generador_formulario_celda" style="padding-left: 4px;">
								<div class="div_generador_formulario_celda">Datos: </div>
							</td>
							<td class="td_generador_formulario_celda">
								<table class="table_dir_foto_seleccionado" style="float: left">
									<tr>
										<td>
											<button id="button_menos_datos" onclick="cambiarTamanioFuente('#div_datos_usuario_seleccionado div', false, 1)">
												<i class="fa fa-minus i_btn_generador_formulario i_btn_suma_resta"></i>
											</button>
										</td>
										<td>
											<i class="fa fa-text-height i_icon_central_formulario_celda" style="font-size: 13pt; padding: 0px 5px;"></i>
										</td>
										<td>
											<button id="button_mas_datos" onclick="cambiarTamanioFuente('#div_datos_usuario_seleccionado div', true, 1)">
												<i class="fa fa-plus i_btn_generador_formulario i_btn_suma_resta"></i>
											</button>
										</td>
									</tr>
								</table>
							</td>

							<td class="td_generador_formulario_celda"></td>

							<td class="td_generador_formulario_celda" style="padding-left: 4px;">
								<div class="div_generador_formulario_celda">Botón: </div>
							</td>
							<td class="td_generador_formulario_celda">
								<table class="table_dir_foto_seleccionado" style="float: left">
									<tr>
										<td>
											<button id="button_menos_panel" onclick="cambiarBoton(false)">
												<i class="fa fa-minus i_btn_generador_formulario i_btn_suma_resta"></i>
											</button>
										</td>
										<td>
											<i class="fa fa-text-height i_icon_central_formulario_celda" style="font-size: 13pt; padding: 0px 5px;"></i>
										</td>
										<td>
											<button id="button_mas_panel" onclick="cambiarBoton(true)">
												<i class="fa fa-plus i_btn_generador_formulario i_btn_suma_resta"></i>
											</button>
										</td>
									</tr>
								</table>
							</td>

							<td class="td_generador_formulario_celda"></td>

							<td class="td_generador_formulario_celda" style="padding-left: 4px;">
								<div class="div_generador_formulario_celda">Teclado: </div>
							</td>
							<td class="td_generador_formulario_celda">
								<table class="table_dir_foto_seleccionado" style="float: left">
									<tr>
										<td>
											<button id="button_menos_teclado" onmousedown="cambiarTamanioImagenAnuncio('#img_teclado_castellano', false, 1, 0.55)" onmouseup="soltarElementoAnuncio()">
												<i class="fa fa-minus i_btn_generador_formulario i_btn_suma_resta"></i>
											</button>
										</td>
										<td>
											<img src="/xweb/public/images/icon-resize-image.png" width="28" style="padding: 0px 3px;" />
										</td>
										<td>
											<button id="button_mas_teclado" onmousedown="cambiarTamanioImagenAnuncio('#img_teclado_castellano', true, 1, 0.55)" onmouseup="soltarElementoAnuncio()">
												<i class="fa fa-plus i_btn_generador_formulario i_btn_suma_resta"></i>
											</button>
										</td>
									</tr>
								</table>
							</td>

							<td class="td_generador_formulario_celda"></td>

							<td class="td_generador_formulario_celda" style="padding-left: 4px;">
								<div class="div_generador_formulario_celda">Pulgadas: </div>
							</td>
							<td class="td_generador_formulario_celda">
								<table class="table_dir_foto_seleccionado" style="float: left">
									<tr>
										<td>
											<button id="button_menos_pulgadas" onclick="cambiarTamanioFuente('#div_carac3_text_articulo_seleccionado div', false, 1)">
												<i class="fa fa-minus i_btn_generador_formulario i_btn_suma_resta"></i>
											</button>
										</td>
										<td>
											<i class="fa fa-text-height i_icon_central_formulario_celda" style="font-size: 13pt; padding: 0px 5px;"></i>
										</td>
										<td>
											<button id="button_mas_pulgadas" onclick="cambiarTamanioFuente('#div_carac3_text_articulo_seleccionado div', true, 1)">
												<i class="fa fa-plus i_btn_generador_formulario i_btn_suma_resta"></i>
											</button>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td class="td_generador_formulario_celda" style="padding-left: 4px;">
								<div class="div_generador_formulario_celda">Precio: </div>
							</td>
							<td class="td_generador_formulario_celda">
								<table class="table_dir_foto_seleccionado" style="float: left">
									<tr>
										<td>
											<button id="button_quitar_precio" onClick="mostrarPrecio(false)" style="padding: 5px; margin-right: 10px; height: auto;">
												<i class="fa fa-minus i_btn_suma_resta" style="margin-right: 0px; font-size: 16px !important;"></i>
											</button>
										</td>
										<td>
											<button id="button_anadir_precio" onClick="mostrarPrecio(true)" style="padding: 5px;margin-right: 10px; height: auto;">
												<i class="fa fa-plus i_btn_suma_resta" style="margin-right: 0px; font-size: 16px !important;"></i>
											</button>
										</td>
									</tr>
								</table>
							</td>

							<td class="td_generador_formulario_celda"></td>

							<td class="td_generador_formulario_celda" style="padding-left: 4px;">
								<div class="precio_control">
									<div class="div_generador_formulario_celda">Precio: </div>
								</div>
							</td>
							<td class="td_generador_formulario_celda">
								<table class="table_dir_foto_seleccionado precio_control" style="float: left">
									<tr>
										<td></td>
										<td>
											<button id="button_arriba_precio" onmousedown="moverElementoAnuncio('#div_precio_articulo_seleccionado', true, false)" onmouseup="soltarElementoAnuncio()">
												<i class="fa fa-caret-up" style="margin-right: 0px"></i>
											</button>
										</td>
										<td></td>
									</tr>
									<tr>
										<td>
											<button id="button_izq_precio" onmousedown="moverElementoAnuncio('#div_precio_articulo_seleccionado', false, false)" onmouseup="soltarElementoAnuncio()">
												<i class="fa fa-caret-left" style="margin-right: 0px"></i>
											</button>
										</td>
										<td>
											<input type="text" id="input_dir_precio_anuncio" name="input_dir_precio_anuncio" disabled="disabled" class="input_dir_precio_anuncio" style="border: none; padding-left: 0px" value="">
										</td>
										<td>
											<button id="button_der_precio" onmousedown="moverElementoAnuncio('#div_precio_articulo_seleccionado', false, true)" onmouseup="soltarElementoAnuncio()">
												<i class="fa fa-caret-right" style="margin-right: 0px"></i>
											</button>
										</td>
									</tr>
									<tr>
										<td></td>
										<td>
											<button id="button_abajo_precio" onmousedown="moverElementoAnuncio('#div_precio_articulo_seleccionado', true, true)" onmouseup="soltarElementoAnuncio()">
												<i class="fa fa-caret-down" style="margin-right: 0px"></i>
											</button>
										</td>
										<td></td>
									</tr>
								</table>
							</td>

							<td class="td_generador_formulario_celda"></td>

							<td class="td_generador_formulario_celda" style="padding-left: 4px;">
								<div class="precio2_control" style="display: none;">
									<div class="div_generador_formulario_celda">Precio2: </div>
								</div>
							</td>
							<td class="td_generador_formulario_celda">
								<table class="table_dir_foto_seleccionado precio2_control" style="float: left; display: none;">
									<tr>
										<td></td>
										<td>
											<button id="button_arriba_precio2" onmousedown="moverElementoAnuncio('#div_precio2_articulo_seleccionado', true, false)" onmouseup="soltarElementoAnuncio()">
												<i class="fa fa-caret-up" style="margin-right: 0px"></i>
											</button>
										</td>
										<td></td>
									</tr>
									<tr>
										<td>
											<button id="button_izq_precio2" onmousedown="moverElementoAnuncio('#div_precio2_articulo_seleccionado', false, false)" onmouseup="soltarElementoAnuncio()">
												<i class="fa fa-caret-left" style="margin-right: 0px"></i>
											</button>
										</td>
										<td>
											<input type="text" id="input_dir_precio2_anuncio" name="input_dir_precio2_anuncio" disabled="disabled" class="input_dir_precio_anuncio" style="padding-left: 0px" value="">
										</td>
										<td>
											<button id="button_der_precio2" onmousedown="moverElementoAnuncio('#div_precio2_articulo_seleccionado', false, true)" onmouseup="soltarElementoAnuncio()">
												<i class="fa fa-caret-right" style="margin-right: 0px"></i>
											</button>
										</td>
									</tr>
									<tr>
										<td></td>
										<td>
											<button id="button_abajo_precio2" onmousedown="moverElementoAnuncio('#div_precio2_articulo_seleccionado', true, true)" onmouseup="soltarElementoAnuncio()">
												<i class="fa fa-caret-down" style="margin-right: 0px"></i>
											</button>
										</td>
										<td></td>
									</tr>
								</table>
							</td>

							<td class="td_generador_formulario_celda"></td>

							<td class="td_generador_formulario_celda" style="padding-left: 4px;">
								<div class="precio3_control" style="display: none;">
									<div class="div_generador_formulario_celda">Precio3: </div>
								</div>
							</td>
							<td class="td_generador_formulario_celda">
								<table class="table_dir_foto_seleccionado precio3_control" style="float: left; display: none;">
									<tr>
										<td></td>
										<td>
											<button id="button_arriba_precio3" onmousedown="moverElementoAnuncio('#div_precio3_articulo_seleccionado', true, false)" onmouseup="soltarElementoAnuncio()">
												<i class="fa fa-caret-up" style="margin-right: 0px"></i>
											</button>
										</td>
										<td></td>
									</tr>
									<tr>
										<td>
											<button id="button_izq_precio3" onmousedown="moverElementoAnuncio('#div_precio3_articulo_seleccionado', false, false)" onmouseup="soltarElementoAnuncio()">
												<i class="fa fa-caret-left" style="margin-right: 0px"></i>
											</button>
										</td>
										<td>
											<input type="text" id="input_dir_precio3_anuncio" name="input_dir_precio3_anuncio" disabled="disabled" class="input_dir_precio_anuncio" style="padding-left: 0px" value="">
										</td>
										<td>
											<button id="button_der_precio3" onmousedown="moverElementoAnuncio('#div_precio3_articulo_seleccionado', false, true)" onmouseup="soltarElementoAnuncio()">
												<i class="fa fa-caret-right" style="margin-right: 0px"></i>
											</button>
										</td>
									</tr>
									<tr>
										<td></td>
										<td>
											<button id="button_abajo_precio3" onmousedown="moverElementoAnuncio('#div_precio3_articulo_seleccionado', true, true)" onmouseup="soltarElementoAnuncio()">
												<i class="fa fa-caret-down" style="margin-right: 0px"></i>
											</button>
										</td>
										<td></td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td style="width: 9%; padding-left: 4px;"></td>
							<td style="width: 9%"></td>
							<td style="width: 9%"></td>
							<td class="td_generador_formulario_celda" style="padding-left: 4px;">
								<div class="precio_control">
									<div class="div_generador_formulario_celda">Precio: </div>
								</div>
							</td>
							<td class="td_generador_formulario_celda">
								<table class="table_dir_foto_seleccionado precio_control" style="float: left">
									<tr>
										<td>
											<button id="button_menos_precio" onmousedown="cambiarTamanioPrecioAnuncio('', false)" onmouseup="soltarElementoAnuncio()">
												<i class="fa fa-minus i_btn_suma_resta" style="margin-right: 0px; font-size: 10pt; padding: 2px 0px;"></i>
											</button>
										</td>
										<td>
											<i class="fa fa-text-height i_icon_central_formulario_celda" style="font-size: 13pt; padding: 0px 5px;"></i>
										</td>
										<td>
											<button id="button_mas_precio" onmousedown="cambiarTamanioPrecioAnuncio('', true)" onmouseup="soltarElementoAnuncio()">
												<i class="fa fa-plus i_btn_suma_resta" style="margin-right: 0px; font-size: 10pt; padding: 2px 0px;"></i>
											</button>
										</td>
									</tr>
								</table>
							</td>

							<td class="td_generador_formulario_celda"></td>

							<td class="td_generador_formulario_celda" style="padding-left: 4px;">
								<div class="precio2_control" style="display: none;">
									<div class="div_generador_formulario_celda">Precio2: </div>
								</div>
							</td>
							<td class="td_generador_formulario_celda">
								<table class="table_dir_foto_seleccionado precio2_control" style="float: left; display: none;">
									<tr>
										<td>
											<button id="button_menos_precio2" onmousedown="cambiarTamanioPrecioAnuncio('2', false)" onmouseup="soltarElementoAnuncio()">
												<i class="fa fa-minus i_btn_suma_resta" style="margin-right: 0px; font-size: 10pt; padding: 2px 0px;"></i>
											</button>
										</td>
										<td>
											<i class="fa fa-text-height i_icon_central_formulario_celda" style="font-size: 13pt; padding: 0px 5px;"></i>
										</td>
										<td>
											<button id="button_mas_precio2" onmousedown="cambiarTamanioPrecioAnuncio('2', true)" onmouseup="soltarElementoAnuncio()">
												<i class="fa fa-plus i_btn_suma_resta" style="margin-right: 0px; font-size: 10pt; padding: 2px 0px;"></i>
											</button>
										</td>
									</tr>
								</table>
							</td>

							<td class="td_generador_formulario_celda"></td>

							<td class="td_generador_formulario_celda" style="padding-left: 4px;">
								<div class="precio3_control" style="display: none;">
									<div class="div_generador_formulario_celda">Precio3: </div>
								</div>
							</td>
							<td class="td_generador_formulario_celda">
								<table class="table_dir_foto_seleccionado precio3_control" style="float: left; display: none;">
									<tr>
										<td>
											<button id="button_menos_precio3" onmousedown="cambiarTamanioPrecioAnuncio('3', false)" onmouseup="soltarElementoAnuncio()">
												<i class="fa fa-minus i_btn_suma_resta" style="margin-right: 0px; font-size: 10pt; padding: 2px 0px;"></i>
											</button>
										</td>
										<td>
											<i class="fa fa-text-height i_icon_central_formulario_celda" style="font-size: 13pt; padding: 0px 5px;"></i>
										</td>
										<td>
											<button id="button_mas_precio3" onmousedown="cambiarTamanioPrecioAnuncio('3', true)" onmouseup="soltarElementoAnuncio()">
												<i class="fa fa-plus i_btn_suma_resta" style="margin-right: 0px; font-size: 10pt; padding: 2px 0px;"></i>
											</button>
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
					
					<table class="table_formulario_generador_anuncios" style="margin-top: 20px; border-bottom: 1px #000 solid;">
						<tr>
							<td class="td_titulo_caract_principal">
								<div class="div_titulo_caract_principal">
									<i class="fa fa-laptop" style="margin-top: 4px;"></i>
									<div style="margin-top: 2px;">Artículo: </div>
								</div>
							</td>
							<td style="width: 75%" colspan="3">
								<table>
									<tr>
										<td>
											<div style="font-weight: 100; font-size: 11pt;">Sube tu propia imagen de artículo</div>
										</td>
										<td>
											<input type="file" id="input_articulo_anuncio" name="input_articulo_anuncio" onchange="cambiarImagenAnuncio(this)" value="">
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td class="td_titulo_caract_principal">
								<div class="div_titulo_caract_principal">
									<i class="fa fa-tv"></i>
									<div>Nombre: </div>
								</div>
							</td>
							<td style="width: 75%" colspan="3">
								<input type="text" id="input_nombre_anuncio" name="input_nombre_anuncio" oninput="cambiarNombreArtAnuncio(this.value)" style="width: 100%" value="">
							</td>
						</tr>
						<tr>
							<td class="td_titulo_caract_principal">
								<div class="div_titulo_caract_principal">
									<i class="fa fa-microchip"></i>
									<div>Gráfica: </div>
								</div>
							</td>
							<td style="width: 75%" colspan="3">
								<input type="text" id="input_grafica_anuncio" name="input_grafica_anuncio" oninput="cambiarGraficaAnuncio(this.value, false)" style="width: 100%" value="">
							</td>
						</tr>
						<tr id="tr_precio_anuncio">
							<td class="td_titulo_caract_principal">
								<div class="div_titulo_caract_principal">
									<i class="fa fa-euro-sign" style="padding-left: 4px;"></i>
									<div>Precio: </div>
								</div>
							</td>
							<td style="width: 40%">
								<input type="text" id="input_precio_anuncio" name="input_precio_anuncio" oninput="cambiarPrecioAnuncio(1, this.value, false)" style="width: 61%; " value="">
								<input type="checkbox" id="check_tachado_precio" onchange="tacharPrecio(this, '')" class="check_tachado_precio" />
								<div style="margin-top: 4px;">Tachar </div>
							</td>
							<td class="td_titulo_caract_principal" style="padding-left: 30px;">
								<div class="div_titulo_caract_principal">
									<i class="fa fa-quote-right" style="padding-left: 4px;"></i>
									<div>Texto: </div>
								</div>
							</td>
							<td style="width: 30%">
								<input type="text" id="input_text_precio_anuncio" name="input_text_precio_anuncio" oninput="escribirTextoPrecio(this, 1)" style="width: 100%" value="">
							</td>
						</tr>
						<tr id="tr_precio2_anuncio">
							<td class="td_titulo_caract_principal">
								<div class="div_titulo_caract_principal">
									<i class="fa fa-euro-sign" style="padding-left: 4px;"></i>
									<div>Precio2: </div>
								</div>
							</td>
							<td style="width: 40%">
								<input type="text" id="input_precio2_anuncio" name="input_precio2_anuncio" oninput="cambiarPrecioAnuncio(2, this.value, false)" style="width: 61%; " value="">
								<input type="checkbox" id="check_tachado2_precio" onchange="tacharPrecio(this, '2')" class="check_tachado_precio" />
								<div style="margin-top: 4px;">Tachar </div>
							</td>
							<td class="td_titulo_caract_principal" style="padding-left: 30px;">
								<div class="div_titulo_caract_principal">
									<i class="fa fa-quote-right" style="padding-left: 4px;"></i>
									<div>Texto: </div>
								</div>
							</td>
							<td style="width: 30%">
								<input type="text" id="input_text_precio2_anuncio" name="input_text_precio2_anuncio" oninput="escribirTextoPrecio(this, 2)" style="width: 100%" value="">
							</td>
						</tr>
						<tr id="tr_precio3_anuncio">
							<td class="td_titulo_caract_principal">
								<div class="div_titulo_caract_principal">
									<i class="fa fa-euro-sign" style="padding-left: 4px;"></i>
									<div>Precio3: </div>
								</div>
							</td>
							<td style="width: 40%">
								<input type="text" id="input_precio3_anuncio" name="input_precio3_anuncio" oninput="cambiarPrecioAnuncio(3, this.value, false)" style="width: 61%; " value="">
								<input type="checkbox" id="check_tachado3_precio" onchange="tacharPrecio(this, '3')" class="check_tachado_precio" />
								<div style="margin-top: 4px;">Tachar </div>
							</td>
							<td class="td_titulo_caract_principal" style="padding-left: 30px;">
								<div class="div_titulo_caract_principal">
									<i class="fa fa-quote-right" style="padding-left: 4px;"></i>
									<div>Texto: </div>
								</div>
							</td>
							<td style="width: 30%">
								<input type="text" id="input_text_precio3_anuncio" name="input_text_precio3_anuncio" oninput="escribirTextoPrecio(this, 3)" style="width: 100%" value="">
							</td>
						</tr>
						<tr>
							<td class="td_titulo_caract_principal" style="vertical-align: top">
								<div class="div_titulo_caract_principal">
									<i class="fa fa-image"></i>
									<div>Fondo: </div>
								</div>
							</td>
							<td style="width: 40%">
								<div id="div_fondos_anuncios" style="height: 40px; overflow: hidden; width: 92%; float: left">
									<input type="hidden" id="num_fondos_seleccionables" value="<?php echo count($arrFondos) ?>">
									@for ($i = 1; $i < count($arrFondosDia); $i++) 
										<table class="table_fondos_anuncios">
											<tr>
												<td style="padding: 0px;padding-left: 2px; font-size: 10pt; text-align: center;">
													{{$i}}
												</td>
											</tr>
											<tr>
												<td style="padding: 0px;">
													<img src="/xweb/public/fotobanners/fondos/bannerf{{$arrFondosDia[$i]}}.png" id="img_fondo_cartel_{{$i}}" onclick="elegirFondo(this)" class="img_icon_fondo_cartel" />
												</td>
											</tr>
										</table>
									@endfor

									@for ($i = 2; $i < count($arrFondosNoDia); $i++) 
										<table class="table_fondos_anuncios">
											<tr>
												<td style="padding: 0px;padding-left: 2px; font-size: 10pt; text-align: center;">
													{{$i}}
												</td>
											</tr>
											<tr>
												<td style="padding: 0px;">
													<img src="/xweb/public/fotobanners/fondos/{{$arrFondosNoDia[$i]}}" id="img_fondo_cartel_{{$i}}" onclick="elegirFondo(this)" class="img_icon_fondo_cartel">
												</td>
											</tr>
										</table>
									@endfor	
								</div>
								<button id="desplegar_fondos" onclick="desplegarFondos()" class="btn_desplegar_fondos">
									<input type="hidden" id="input_fondos_desplegados" value="false" />
									<i class="fa fa-sort-down" class="i_desplegar_fondos" style="font-size: 24px; margin-top: 12px; cursor: pointer;"></i>
								</button>
							</td>
							<td style="width: 45%; vertical-align: top" colspan="2">
								<input type="file" id="input_fondo_anuncio" name="input_fondo_anuncio" onchange="cambiarFondoAnuncio(this)"
									style="margin-top: 10px;" value="">
							</td>
						</tr>
						<tr>
							<td colspan="4" style="width: 100%">
								<table style="width: 100%">
									<tr>
										<td class="td_titulo_caract_principal2">
											<div class="div_titulo_caract_principal">
												<i class="fa fa-tint"></i>
												<div>Título: </div>
											</div>
										</td>
										<td class="td_dato_caract_principal">
											<input type="color" id="input_colora_fuente_anuncio" onchange="cambiarColorA()" 
												class="input_color_fuente_anuncio" name="input_colora_fuente_anuncio" value="#ffffff">
										</td>
										<td class="td_titulo_caract_principal2">
											<div class="div_titulo_caract_principal">
												<i class="fa fa-tint"></i>
												<div>Caract.: </div>
											</div>
										</td>
										<td class="td_dato_caract_principal">
											<input type="color" id="input_colorb_fuente_anuncio" onchange="cambiarColorB()" 
												class="input_color_fuente_anuncio" name="input_colorb_fuente_anuncio"value="#ffffff">
											<input type="color" id="input_colorc_fuente_anuncio" onchange="cambiarColorC()" 
												class="input_color_fuente_anuncio" name="input_colorc_fuente_anuncio"value="#ff7500">
										</td>
										<td class="td_titulo_caract_principal2">
											<div class="div_titulo_caract_principal">
												<i class="fa fa-tint"></i>
												<div>Precio: </div>
											</div>
										</td>
										<td class="td_dato_caract_principal">
											<input type="color" id="input_colord_fuente_anuncio" onchange="cambiarColorD()" 
												class="input_color_fuente_anuncio" name="input_colord_fuente_anuncio"value="#DADADA">
										</td>
										<td class="td_titulo_caract_principal2">
											<div class="div_titulo_caract_principal">
												<i class="fa fa-tint"></i>
												<div>Botón: </div>
											</div>
										</td>
										<td class="td_dato_caract_principal">
											<input type="color" id="input_colore_fuente_anuncio" onchange="cambiarColorE()" 
												class="input_color_fuente_anuncio" name="input_colore_fuente_anuncio"value="#1CBAFB">
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>

					<table id="table_orientacion_anuncio" class="table_formulario_generador_anuncios" style="margin-top: 20px;">
						<tr>
							<td class="td_titulo_caract_principal">
								<div>Orientación: </div>
							</td>
							<td style="width: 85%; border-bottom: 1px #000 solid;" colspan="3">
								<div class="div_tamanios_marco">
									<input type="radio" id="orientHorizontal" name="orientMarco" onchange="cambiarOrientacionAnuncio()" value="horizontal" checked>
									<table style="float: left;">
										<tr>
											<td style="padding: 0px;">
												<img src="/xweb/public/images/picture.png" width="32" style="margin-top: -2px; padding-bottom: 0px;" />
											</td>
										</tr>
										<tr>
											<td style="padding: 0px;">
												<i class="fa fa-arrows-h" style="font-size: 22px; margin-left: 10px; margin-top: -10px;"></i>
											</td>
										</tr>
									</table>
									<div>Horizontal</div>
								</div>
								<div class="div_tamanios_marco">
									<input type="radio" id="orientVertical" name="orientMarco" onchange="cambiarOrientacionAnuncio()" value="vertical" />
									<img src="/xweb/public/images/picture.png" width="32" style="margin-top: -2px" />
									<i class="fa fa-arrows-v" style="font-size: 22px; margin-top: 5px;"></i>
									<div>Vertical</div>
								</div>
							</td>
						</tr>
						<tr>
							<td class="td_titulo_caract_principal">
								<div></div>
							</td>
							<td style="width: 85%" colspan="3">
								<div class="div_tamanios_marco">
									<input type="radio" id="sizeA6" name="sizeMarco" onchange="cambiarTamanioAnuncio()" value="a6">
									<img src="/xweb/public/images/picture.png" width="21" />
									<div>14.8x10.5</div>
								</div>
								<div class="div_tamanios_marco">
									<input type="radio" id="sizeA5" name="sizeMarco" onchange="cambiarTamanioAnuncio()" value="a5">
									<img src="/xweb/public/images/picture.png" width="28" style="margin-top: 1px" />
									<div>21x14.8</div>
								</div>
								<div class="div_tamanios_marco">
									<input type="radio" id="sizeA4" name="sizeMarco" onchange="cambiarTamanioAnuncio()" value="a4">
									<img src="/xweb/public/images/picture.png" width="35" style="margin-top: -3px" />
									<div>29.7x21</div>
								</div>
							</td>
						</tr>
						<tr>
							<td class="td_titulo_caract_principal">
								<div>Tamaños </br>anuncio: </div>
							</td>
							<td style="width: 85%" colspan="3">
								<div class="div_tamanios_marco">
									<input type="radio" id="sizeR1" name="sizeMarco" onchange="cambiarTamanioAnuncio()" value="r1">
									<img src="/xweb/public/images/picture.png" width="21" height="18" />
									<div>21x10</div>
								</div>
								<div class="div_tamanios_marco">
									<input type="radio" id="sizeR2" name="sizeMarco" onchange="cambiarTamanioAnuncio()" value="r2">
									<img src="/xweb/public/images/picture.png" width="28" height="24" style="margin-top: 3px" />
									<div>23x12.5</div>
								</div>
								<div class="div_tamanios_marco">
									<input type="radio" id="sizeR3" name="sizeMarco" onchange="cambiarTamanioAnuncio()" value="r3">
									<img src="/xweb/public/images/picture.png" width="35" height="30" />
									<div>23x16</div>
								</div>
							</td>
						</tr>
						<tr>
							<td class="td_titulo_caract_principal">
								<div></div>
							</td>
							<td style="width: 85%" colspan="3">
								<div class="div_tamanios_marco">
									<input type="radio" id="sizeC1" name="sizeMarco" onchange="cambiarTamanioAnuncio()" value="c1">
									<img src="/xweb/public/images/picture.png" width="21" height="27" style="margin-top: 1px" />
									<div>12x12</div>
								</div>
								<div class="div_tamanios_marco">
									<input type="radio" id="sizeC2" name="sizeMarco" onchange="cambiarTamanioAnuncio()" value="c2">
									<img src="/xweb/public/images/picture.png" width="28" height="35" style="margin-top: -2px" />
									<div>15x15</div>
								</div>
								<div class="div_tamanios_marco">
									<input type="radio" id="sizeC3" name="sizeMarco" onchange="cambiarTamanioAnuncio()" value="c3">
									<img src="/xweb/public/images/picture.png" width="35" height="42" style="margin-top: -6px" />
									<div>21x21</div>
								</div>
							</td>
						</tr>
						<tr>
							<td class="td_titulo_caract_principal">
								<div></div>
							</td>
							<td style="width: 85%" colspan="3">
								<div class="div_tamanios_marco" style="width: 100%">
									<input type="radio" id="sizeX1" name="sizeMarco" onchange="cambiarTamanioAnuncio()" value="x1" checked>
									<img src="/xweb/public/images/picture.png" width="28" height="24" style="margin-top: 3px" />
									<div>Ancho 750px para mailing</div>
								</div>
							</td>
						</tr>
						<tr>
							<td class="td_titulo_caract_principal">
								<div></div>
							</td>
							<td style="width: 85%" colspan="3">
								<div class="div_tamanios_marco">
									<div style="margin-top: 4px;">Ancho: </div>
									<input type="text" id="input_ancho_anuncio" onkeyup="cambiarTamanioPersAnuncio(true)" class="input_tamanios_marco" value="">
								</div>
								<div class="div_tamanios_marco">
									<div style="margin-top: 4px;">Alto: </div>
									<input type="text" id="input_alto_anuncio" onkeyup="cambiarTamanioPersAnuncio(false)" class="input_tamanios_marco" value="">
								</div>
								<div class="div_tamanios_marco">
								</div>
							</td>
						</tr>
					</table>

					<table class="table_formulario_generador_anuncios" style="margin-top: 20px;">
						<tr>
							<td colspan="4" style="width: 100%; border-top: 1px solid #000;">
								<i class="fa fa-bars"></i>
								<div style="margin-top: -2px;">Características</div>
							</td>
						</tr>
						<tr>
							<td colspan="4" style="width: 100%">
								<table id="table_caract_generador_anuncios" style="width: 100%;">
								</table>
							</td>
						</tr>
						<tr>
							<td colspan="4" style="width: 100%; border-top: 1px solid #000;">
								<i class="fa fa-tasks"></i>
								<div style="margin-top: -2px;">Otros datos</div>
							</td>
						</tr>
						<tr>
							<td colspan="4" style="width: 100%">
								<table id="table_datos_generador_anuncios" style="width: 100%; border-bottom: 1px #000 solid">
									<tr>
										<td style="width: 15%; padding-bottom: 0px;">
											<div class="div_caract_generador_anuncios">
												<input type="checkbox" id="check_dato_panel" name="check_dato_panel" checked="checked" onchange="mostrarBotonAnuncio()" style="height: 50px; width: 16px; margin-left: 4px;" />
												<div style="float: left; padding: 18px 8px 0px 9px;">Botón</div>
											</div>
										</td>
										<td style="width: 85%; padding-bottom: 0px;" colspan="2">
											<input type="text" id="input_dato_panel" name="input_dato_panel" oninput="escribirBotonAnuncio()" value="HAZTE CON ÉL" style="width: 100%; margin-right: 10px;" />
										</td>
									</tr>
									<tr>
										<td style="width: 15%; padding: 0px; padding-bottom: 5px;"></td>
										<td style="width: 25%; padding: 0px; padding-bottom: 5px; padding-left: 10px;">
											<div style="float: left; margin-top:-10px;">Flecha apunta hacia la </div>
										</td>
										<td style="width: 60%; padding: 0px; padding-bottom: 5px;">
											<form id="radio_flecha_panel">
												<input type="checkbox" id="input_flecha_izq" onclick="apuntarBotonIzqAnuncio()" name="input_flecha_panel" value="izquierda" checked="checked" />
												<div>Izquierda</div>
												<input type="checkbox" id="input_flecha_der" onclick="apuntarBotonDerAnuncio()" name="input_flecha_panel" value="derecha" />
												<div>Derecha</div>
												<input type="checkbox" id="input_flecha_arr" onclick="apuntarBotonArrAnuncio()" name="input_flecha_panel" value="arriba" />
												<div>Arriba</div>
												<input type="checkbox" id="input_flecha_aba" onclick="apuntarBotonAbjAnuncio()" name="input_flecha_panel" value="abajo"  />
												<div>Abajo</div>
											</form>
										</td>
									</tr>
									<tr>
										<td style="width: 15%; padding: 0px; padding-bottom: 5px;"></td>
										<td style="width: 25%; padding: 0px; padding-bottom: 5px;">
											<div style="float: left; margin-top: -10px; padding-left: 10px;">Estilo de botón </div>
										</td>
										<td style="width: 60%; padding: 0px; padding-bottom: 5px;">
											<form id="radio_estilo_panel" onchange="cambiarEstiloBotonAnuncio()">
												<input type="radio" id="input_flecha_est1" name="input_estilo_panel" value="izquierda" checked />
												<div>Estilo1</div>
												<input type="radio" id="input_flecha_est2" name="input_estilo_panel" value="derecha"/>
												<div>Estilo2</div>
											</form>
										</td>
									</tr>
									<tr>
										<td style="width: 15%">
											<div class="div_caract_generador_anuncios">
												<input type="checkbox" id="check_dato_telefono" onchange="mostrarTelefonoAnuncio()" name="check_dato_telefono" class="input_otros_datos" />
												<div class="div_otros_datos">Teléfono</div>
											</div>
										</td>
										<td style="width: 25%">
											<input type="text" id="input_text_telefono" oninput="escribirTextTelefono()" name="input_text_telefono" value="Teléfono: " style="width: 100%;" />
										</td>
										<td colspan="2" style="width: 60%">
											<input type="text" id="input_dato_telefono" oninput="escribirDatoTelefono()" name="input_dato_telefono" placeholder="987 654 321" value="{{$miTlfno}}" style="width: 98%; float: right; margin-right: 0px;">
										</td>
									</tr>
									<tr>
										<td style="width: 15%">
											<div class="div_caract_generador_anuncios">
												<input type="checkbox" id="check_dato_correo" onchange="mostrarCorreoAnuncio()" name="check_dato_correo" class="input_otros_datos" />
												<div class="div_otros_datos">Correo</div>
											</div>
										</td>
										<td style="width: 25%">
											<input type="text" id="input_text_correo" oninput="escribirTextCorreo()" name="input_text_correo" value="Email: " style="width: 100%; margin-right: 10px;" />
										</td>
										<td colspan="2" style="width: 60%">
											<input type="text" id="input_dato_correo" oninput="escribirDatoCorreo()" name="input_dato_correo" placeholder="miusuario@gmail.com" value="{{$miEmail}}" style="width: 98%; float: right; margin-right: 0px;">
										</td>
									</tr>
									<tr>
										<td style="width: 15%">
											<div class="div_caract_generador_anuncios">
												<input type="checkbox" id="check_dato_teclado" onchange="mostrarTecladoAnuncio()" name="check_dato_teclado" class="input_otros_datos" />
												<div class="div_otros_datos">Teclado</div>
											</div>
										</td>
										<td style="width: 85%" colspan="2">
											<div class="div_caract_generador_anuncios">
												<input type="checkbox" id="check_dato_teclado_con10" onchange="mostrarTecladoConDiezAnuncio()" name="check_dato_teclado_con10" class="input_otros_datos" />
												<div class="div_otros_datos">+10€</div>
											</div>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td>
								<div>
									<button id="button_generar_imagen" class="button_generar_cartel" onclick="renderizarImagen()">
										<i class="fa fa-download" style="margin-top: 4px"></i>
										Generar cartel
									</button>
								</div>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</div>

@endif 

@endsection