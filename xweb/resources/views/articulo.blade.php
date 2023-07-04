@extends("base")

@section("dashboard")
	@foreach($arrDatosArticulos as $articulo)

		@php
		$acodarMinuscula = strtolower($articulo->ACODAR);
		@endphp

		<?php
            // Foto del artículo
                $artFoto = "nofoto.jpg";

                if (isset($urlfoto))
                {
                    $artFoto = $urlfoto;
                }

                $urlfoto = "https://diginova.es/xweb/public/articulos/".$artFoto;


                if (!is_array(@getimagesize($urlfoto))) 
                {
                    $artFoto = "nofoto.jpg";
                    $urlfoto = "/xweb/public/articulos/".$artFoto;
                }
		?>








		
		<div class="digiFicha">
			<div class="digiDivFicha" style="display: inline-block; background: #fafafa; margin-bottom: 2px; margin-left: 8px; margin-right: 8px; width: 1216px;">
				<table>
					<tr class="trPuntosControl td_art_pc">
						<td style="border-bottom: 7px #fafafa solid;">
							<div class="fCelda fCelda2" style="height: 94px; width: 484px;">
								<div class="fC2Tab1" style="visibility: hidden">
									<div class="fC2Tab11">
										<img src="../public/images/fichaicon1.png" />
									</div>
									<div class="fC2Tab12">
										Certificamos 32 puntos de control y las verificaciones más exigentes
									</div>
								</div>
								<div class="fC2Tab1 fC2Tab2" style="visibility: hidden">
								</div>
							</div>
						</td>
						<td style="border-bottom: 7px #fafafa solid;">
							<div class="fCelda fCelda2" style="height: 94px">
								<div class="fC2Tab1">
									<div class="fC2Tab11">
										<img src="../public/images/fichaicon1.png" />
									</div>
									<div class="fC2Tab12">
										Certificamos 32 puntos de control y las verificaciones más exigentes
									</div>
								</div>
								<div class="fC2Tab1 fC2Tab2">
								</div>
							</div>
						</td>
					</tr>
					<tr class="trInfoArticulo">
						<td style="border-right: 7px #fafafa solid; background-color: #fff; vertical-align: top">
							<div class="fCelda fCelda1" style="height: 450px;">
								<div class="fContImg" style="padding: 0px 15px">
									<!--<a class='imagenlanzada' href='<?php echo $urlfoto; ?>' title='{{$articulo->ADESCR}}  - Foto 1' target='_blank'>
										<img src='<?php echo $urlfoto; ?>' style="max-width: 450px;" border='0' alt='{{$articulo->ADESCR}}' title='{{$articulo->ADESCR}}'/>
									</a>-->


												<div class="row">
													<div class="col-xs-8 col-xs-push-2 col-md-10 col-md-push-1 articuloFoto text-center" style="">
														<a href="{{URL::asset('public/articulos/'.$barti->imag1)}}" data-lightbox="image-1" data-title="{{$barti->adescr}}" title="{{$barti->adescr}}">
															<img onclick="" class="img-responsive " alt="{{$barti->adescr}}" title="{{$barti->adescr}}" style="max-width: 100%;" src="{{URL::asset('public/articulos/'.$barti->imag1)}}" >
														</a>
													</div>
												</div>
												<div class="row">
													<!-- primera imagen pequeña -->
													@if($barti->imag2!=="nofoto.jpg")
													<!-- siguientes imagen pequeña -->
													<div class="col-xs-3 col-md-3 articuloFoto text-center" style="">
														<a href="{{URL::asset('public/articulos/'.$barti->imag2)}}" data-lightbox="image-1" data-title="{{$barti->adescr}}" title="{{$barti->adescr}}">
															<img onclick="" class="img-responsive " alt="{{$barti->adescr}}" title="{{$barti->adescr}}" style="max-width: 100%;" src="{{URL::asset('public/articulos/'.$barti->imag2)}}" >
														</a>
													</div>
													@endif
													@if($barti->imag3!=="nofoto.jpg")
													<!-- siguientes imagen pequeña -->
													<div class="col-xs-3 col-md-3 articuloFoto text-center" style="">
														<a href="{{URL::asset('public/articulos/'.$barti->imag3)}}" data-lightbox="image-1" data-title="{{$barti->adescr}}" title="{{$barti->adescr}}">
															<img onclick="" class="img-responsive " alt="{{$barti->adescr}}" title="{{$barti->adescr}}" style="max-width: 100%;" src="{{URL::asset('public/articulos/'.$barti->imag3)}}" >
														</a>
													</div>
													@endif
													@if($barti->imag4!=="nofoto.jpg")
													<!-- siguientes imagen pequeña -->
													<div class="col-xs-3 col-md-3 articuloFoto text-center" style="">
														<a href="{{URL::asset('public/articulos/'.$barti->imag4)}}" data-lightbox="image-1" data-title="{{$barti->adescr}}" title="{{$barti->adescr}}">
															<img onclick="" class="img-responsive " alt="{{$barti->adescr}}" title="{{$barti->adescr}}" style="max-width: 100%;" src="{{URL::asset('public/articulos/'.$barti->imag4)}}" >
														</a>
													</div>
													@endif
													@if($barti->imag5!=="nofoto.jpg")
													<!-- siguientes imagen pequeña -->
													<div class="col-xs-3 col-md-3 articuloFoto text-center" style="">
														<a href="{{URL::asset('public/articulos/'.$barti->imag5)}}" data-lightbox="image-1" data-title="{{$barti->adescr}}" title="{{$barti->adescr}}">
															<img class="img-responsive " alt="{{$barti->adescr}}" title="{{$barti->adescr}}" style="max-width: 100%;" src="{{URL::asset('public/articulos/'.$barti->imag5)}}" >
														</a>
													</div>
													@endif
												</div>
								</div>
							</div>
						</td>
						<td class="td_art_mv">
							<table style="width: 100%">
								<tr class="trPuntosControl">
									<td style="border-bottom: 7px #fafafa solid;">
										<div class="fCelda fCelda2" style="height: 94px; width: 484px;">
											<div class="fC2Tab1" style="visibility: hidden">
												<div class="fC2Tab11">
													<img src="../public/images/fichaicon1.png" />
												</div>
												<div class="fC2Tab12">
													Revisión exhaustiva: Certificamos 32 puntos de control
												</div>
											</div>
											<div class="fC2Tab1 fC2Tab2" style="visibility: hidden">
											</div>
										</div>
									</td>
									<td style="border-bottom: 7px #fafafa solid;">
										<div class="fCelda fCelda2" style="height: 94px">
											<div class="fC2Tab1">
												<div class="fC2Tab11">
													<img src="../public/images/fichaicon1.png" />
												</div>
												<div class="fC2Tab12">
													Revisión exhaustiva: Certificamos 32 puntos de control
												</div>
											</div>
											<div class="fC2Tab1 fC2Tab2">
											</div>
										</div>
									</td>
								</tr>
								<tr>
									<td colspan="2" style="width: 0px; padding: 0px; margin: 0;">
										<div class="fCelda fCelda5">
											<div class="fVentajas">
												<div class="ffCol">
													<div class="ffCol1">
														<img alt="Garantía" src="/xweb/public/images/iconos_ventajas_ficha_diginova-17.png" />
													</div>
													<div class="ffCol2">
														<div class="ffCol2_1">2 años de garantía</div>
													</div>
												</div>
												<div class="fLineaDivisoria"></div>
												<div class="ffCol">
													<div class="ffCol1">
														<img alt="Garantía" src="/xweb/public/images/iconos_ventajas_ficha_diginova-18.png" />
													</div>
													<div class="ffCol2">
														<div class="ffCol2_1">Financiación</div>
													</div>
												</div>
												<div class="fLineaDivisoria"></div>
												<div class="ffCol">
													<div class="ffCol1">
														<img alt="Garantía" src="/xweb/public/images/iconos_ventajas_ficha_diginova-19.png" />
													</div>
													<div class="ffCol2">
														<div class="ffCol2_1">24h RMA y pedidos</div>
													</div>
												</div>
												<div class="fLineaDivisoria"></div>
												<div class="ffCol">
													<div class="ffCol1">
														<img alt="Garantía" src="/xweb/public/images/iconos_ventajas_ficha_diginova-20.png" />
													</div>
													<div class="ffCol2">
														<div class="ffCol2_1">1 mes de DOA</div>
													</div>
												</div>
											</div>
										</div>
									</td>
								</tr>
							</table>
						</td>
						<td>

							<?php
								$ampliacionesDisponibles = false;

								if ($mostrarAmplMemoriaRAM || $mostrarAmplDiscoDuro || $mostrarConversionTeclado)
								{	
									$ampliacionesDisponibles = true;
								}
							?>

							<div class="fCelda fCelda3" style="<?php if ($ampliacionesDisponibles && session("usuario")->uData->codigo > 0) { echo 'min-height: 270px;'; } else { echo 'min-height: 458px;';  } ?>  ">
								<div style="display: table;">
									<div style="display: table-cell; vertical-align: top;">
										@for ($i = 0; $i < count($arrGradosArticulo); $i++)
											@if ($arrRefArticulos[$i] == $articulo->ACODAR)
												<div id="nom_art_{{$i}}" class="fDes">
													{{$titulo1Articulo}}	
												</div>
												<div id="nom_completo_art_{{$i}}" class="fDes2">
													{{$titulo2Articulo}}
												</div>
												<div id="nom_descr_{{$i}}" class="fDes3">
													Cód: {{$arrRefArticulos[$i]}}
												</div>
											@else
												<div id="nom_art_{{$i}}" class="fDes" style="display: none">
													{{$titulo1Articulo}}
												</div>
												<div id="nom_completo_art_{{$i}}" class="fDes2" style="display: none">
													{{$titulo2Articulo}}
												</div>
												<div id="nom_descr_{{$i}}" class="fDes3" style="display: none">
													Cód: {{$arrRefArticulos[$i]}}
												</div>
											@endif
										@endfor
										<div class="popuptext cestaAviso1 popupTransferencia hidepopup trianguloTransferencia" style="margin-left: 7px; margin-right: -15px; float: right;"></div>
										<div class="popuptext cestaAviso1 popupTransferencia hidepopup" style="float: right; font-size: 11pt; position: relative; height: 40px; width: 305px; margin-top: -19px; margin-right: -22px; padding: 10px;">
												<div>Debes elegir el grado del producto.</div>
										</div>
									</div>
									@if(session('usuario')->uData->codigo>0)
										<div class="divPreciosArt td_art_pc" style="display: table-cell;">
											@for ($i = 0; $i < count($arrGradosArticulo); $i++)
												@if ($arrRefArticulos[$i] == $articulo->ACODAR)
													<div id="div_precio_{{$i}}" class="fPrecios">
												@else
													<div id="div_precio_{{$i}}" class="fPrecios" style="display: none;">
												@endif
													{{number_format($arrPrecioArticulos[$i], 2, ",", ".")}}&euro;
													<span>
														{{number_format($arrPrecioArticulosConIVA[$i], 2, ",", ".")}}&euro; I.V.A. incluido
													</span>
												</div>
											@endfor

											<div class="fPrecioAdd">

												<div id="div_anadir_cesta_disabled" onclick="mostrarMsjGrados()" class="fAdd" <?php if ($numRefRepetidas <= 1) { ?> style="display: none" <?php } ?>>
													<a name="cestaAdd" id="cestaAdd{{$articulo->ACODAR}}" class="fBotonAddDisabled">
														A&ntilde;adir al carrito
													</a>
												</div>

												@for ($i = 0; $i < count($arrGradosArticulo); $i++)
													<div id="div_anadir_cesta_<?php echo $i ?>" class="fAdd" 
														<?php if ($i > 0 || $numRefRepetidas > 1) { ?> style="display: none" <?php } ?>>
														<a name="cestaAdd_{{$i}}" id="cestaAdd{{$arrRefArticulos[$i]}}" 
															class="fBotonAdd" 
															onclick="if (!comprobarDisco()) { alert('Debe indicar si desea instalar el S.O. en el disco de ampliación o mantenerlo en el disco original'); } else{
															addArticulo('{{$arrRefArticulos[$i]}}', 
										                        document.getElementById('cant{{$articulo->ACODAR}}').value, 
										                        '{{URL::to('addArticulo')}}', this, document.getElementById('input_ref_ram').value, document.getElementById('input_ref_discoduro').value,  document.getElementById('input_ref_teclado').value, document.getElementById('input_ampl_so').value); } ">
														A&ntilde;adir</a>
													</div>
												@endfor
											</div>
										</div>
									@endif
								</div>
								@if(session('usuario')->uData->codigo>0)

									<?php
										$astockArti = $barti->astock;

										if (session('usuario')->uData->codigo == 2591 && $articulo->ACODAR == "6910HP600G118GB") { $astockArti = 4; }	//	1234
									?>

									<div id="div_stock_{{$i}}" class="fCantStock td_art_pc" style="display: block; padding: 25px 0;">
										<div style="width: 100%">
											<div class="fCant">
												<div class="fCantTxt">Cantidad:</div>
												<div class="fTabCant">
													<div>
														<img alt="-" src="/xweb/public/images/artmenosoff.png" id="menos{{$articulo->ACODAR}}"
															name="menosCantidad" onclick="celdaCantBajar('{{$articulo->ACODAR}}')" />
													</div>
													<div>
														<input type="text" disabled name="cant_5" id="cant{{$articulo->ACODAR}}" value="1" />
													</div>
													<div>
														<img alt="+" src="/xweb/public/images/artmason.png" id="mas{{$articulo->ACODAR}}" 
															name="masCantidad_5" onclick='celdaCantSubir("{{$articulo->ACODAR}}", 
															{{$astockArti}})' />
													</div>
												</div>
											</div>
											<div class="fStock">
												<span class="digirojo" style="padding-right: 5px;">Stock:</span>
												@if ($astockArti == 1)
													<span>{{$astockArti}} unidad</span>
												@else
													<span>{{$astockArti}} unidades</span>
												@endif
											</div>
										</div>
									</div>

									@if ($numRefRepetidas > 1)

										<div class="eligeGradoCesta" style="float: left; width: 100%; font-family: montserratbolditalic; margin-bottom: 30px;font-size: 15pt; text-align: left;">
											Elige un grado antes de añadir a la cesta
										</div>

										<table class="table_ampliaciones">
											<tr>
												<td style="vertical-align: top; width: 125px;">
													<div class="div_radio_grados div_tipo_articulo">GRADOS</div>
												</td>
												<td class="td_art_pc" style="width: 425px;">
													@for ($i = 0; $i < count($arrGradosArticulo); $i++) 
														@if ($widthDivGrados > 0) 
															<div class="div_radio_grados">
																<input type="radio" id="grado{{$i}}" name="ArtGrado" onclick="elegirGrado(<?php echo count($arrGradosArticulo) ?>, <?php echo $i ?>, <?php echo $arrPrecioArticulos[$i] ?>); calcularTotalArticulo();" value="{{$arrPrecioArticulos[$i]}}">
																@if ($arrGradosArticulo[$i] == 'GAP')
																	<label>GRADO A+ ({{$arrPrecioArticulos[$i]}}€)</label><br>
																@elseif ($arrGradosArticulo[$i] == 'GA')
																	<label>GRADO A ({{$arrPrecioArticulos[$i]}}€)</label><br>
																@elseif ($arrGradosArticulo[$i] == 'GB')
																	<label>GRADO B ({{$arrPrecioArticulos[$i]}}€)</label><br>
																@elseif ($arrGradosArticulo[$i] == 'GC')
																	<label>GRADO C ({{$arrPrecioArticulos[$i]}}€)</label><br>
																@elseif ($arrGradosArticulo[$i] == 'GD')
																	<label>GRADO D ({{$arrPrecioArticulos[$i]}}€)</label><br>
																@elseif ($arrGradosArticulo[$i] == 'GE')
																	<label>GRADO E ({{$arrPrecioArticulos[$i]}}€)</label><br>
																@endif
															</div>
														@endif
													@endfor
												</td>
												<td class="td_precios_ampl" style="vertical-align: top; float: right;">
													<div id="div_precio_grados" class="div_radio_grados div_tipo_articulo">0€</div>
												</td>
											</tr>
											<tr>
												<td colspan="3" class="td_art_mv">
													@for ($i = 0; $i < count($arrGradosArticulo); $i++) 
														@if ($widthDivGrados > 0) 
															<div class="div_radio_grados">
																<input type="radio" id="grado{{$i}}" name="ArtGrado" onclick="elegirGrado(<?php echo count($arrGradosArticulo) ?>, <?php echo $i ?>, <?php echo $arrPrecioArticulos[$i] ?>); calcularTotalArticulo();" value="{{$arrPrecioArticulos[$i]}}">
																@if ($arrGradosArticulo[$i] == 'GAP')
																	<label>GRADO A+ ({{$arrPrecioArticulos[$i]}}€)</label><br>
																@elseif ($arrGradosArticulo[$i] == 'GA')
																	<label>GRADO A ({{$arrPrecioArticulos[$i]}}€)</label><br>
																@elseif ($arrGradosArticulo[$i] == 'GB')
																	<label>GRADO B ({{$arrPrecioArticulos[$i]}}€)</label><br>
																@elseif ($arrGradosArticulo[$i] == 'GC')
																	<label>GRADO C ({{$arrPrecioArticulos[$i]}}€)</label><br>
																@elseif ($arrGradosArticulo[$i] == 'GD')
																	<label>GRADO D ({{$arrPrecioArticulos[$i]}}€)</label><br>
																@elseif ($arrGradosArticulo[$i] == 'GE')
																	<label>GRADO E ({{$arrPrecioArticulos[$i]}}€)</label><br>
																@endif
															</div>
														@endif
													@endfor
												</td>
											</tr>
										</table>
									@else
										<table class="table_ampliaciones" style="display: none">
											<tr>
												<td style="vertical-align: top; width: 125px;">
													<div class="div_radio_grados div_tipo_articulo">GRADOS</div>
												</td>
												<td></td>
												<td class="td_precios_ampl" style="vertical-align: top; float: right;">
													<div id="div_precio_grados" class="div_radio_grados div_tipo_articulo">
														@for ($i = 0; $i < count($arrGradosArticulo); $i++)

															{{number_format($arrPrecioArticulos[$i], 2, ",", ".")}}&euro;

														@endfor
													</div>
												</td>
											</tr>
										</table>
									@endif

									<div id="div_stock_{{$i}}" class="fCantStock td_art_mv" style="padding: 25px 0;">
										<div style="width: 100%; display: flex; flex-wrap: wrap;">
											<div class="divPreciosArt td_art_mv" style="display: table-cell; width: 50%;">
												@for ($i = 0; $i < count($arrGradosArticulo); $i++)
													@if ($arrRefArticulos[$i] == $articulo->ACODAR)
														<div id="div_precio_{{$i}}_mv" class="fPrecios">
													@else
														<div id="div_precio_{{$i}}_mv" class="fPrecios" style="display: none;">
													@endif
															{{number_format($arrPrecioArticulos[$i], 2, ",", ".")}}&euro;
															<span>
																{{number_format($arrPrecioArticulosConIVA[$i], 2, ",", ".")}}&euro; I.V.A. incluido
															</span>
														</div>
												@endfor
											</div>
											<div class="fCant">
												<div class="fCantTxt">Cantidad:</div>
												<div class="fTabCant">
													<div>
														<img alt="-" src="/xweb/public/images/artmenosoff.png" id="menosMv{{$articulo->ACODAR}}"
															name="menosCantidad" onclick="celdaCantBajarMv('{{$articulo->ACODAR}}')" />
													</div>
													<div>
														<input type="text" disabled name="cant_5" id="cantMv{{$articulo->ACODAR}}" class="cantMv{{$articulo->ACODAR}}" value="1" />
													</div>
													<div>
														<img alt="+" src="/xweb/public/images/artmason.png" id="masMv{{$articulo->ACODAR}}" 
															name="masCantidad_5" onclick='celdaCantSubirMv("{{$articulo->ACODAR}}", 
															{{$barti->astock}})' />
													</div>
												</div>
												<div class="fStock">
													<span class="digirojo" style="padding-right: 5px;">Stock:</span>
													@if ($barti->astock < 10)
														<span style="font-size: 10pt">Últimas unidades</span>
													@else
														<span style="font-size: 10pt">+10 unidades</span>
													@endif
												</div>
											</div>
										</div>
									</div>

							</div>

							<input type="hidden" id="input_ref_ram" value="">
							<input type="hidden" id="input_ref_discoduro" value="">
							<input type="hidden" id="input_ref_teclado" value="">
							<input type="hidden" id="input_ampl_so" value="">

									<?php
										// =================== CUADRO AMPLIACIONES ======================

										if ( ($mostrarAmplMemoriaRAM || $mostrarAmplDiscoDuro || $mostrarConversionTeclado)  )
										{
											?>

											<div class="fCelda fCelda3" style="min-height: 270px; margin-top: 8px; padding-top: 0;">
 
									<div style="padding: 20px 0px 10px 0px;font-size: 11pt;color: black;font-weight: bold;font-family: 'montserratbold';">Amplía la memoria y el disco duro de tu equipo aquí</div>
									<div style="padding: 0 0 20px 0;font-size: 10pt;color: rgb(150 150 150);font-weight: bold;font-family: 'montserratregular';">Recuerda que tu equipo ya incluye la memoria y el disco indicado en la descripción</div>

									

									@if ($mostrarAmplMemoriaRAM)

										<table class="table_ampliaciones">
											<tr>
												<td style="vertical-align: top; width: 125px;">
													<div class="div_radio_grados div_tipo_articulo">MEMORIA</div>
												</td>
												<td class="td_art_pc" style="width: 425px;">
													@for ($i = 0; $i < count($arrMemoriasRAM); $i++)
														<div class="divRadioGrados" <?php if ($i == count($arrMemoriasRAM) - 1) { ?> style="display: none" <?php } ?>>
															@if ($i == count($arrMemoriasRAM) - 1)
																<div class="divRadioGradosTD">
																<input type="checkbox" id="{{$arrRefMemoriasRAM[$i]}}" name="refMemoriasRAM" checked onclick="elegirMemoriaRAM(<?php echo $arrPreciosMemoriasRAM[$i] ?>, '{{$arrRefMemoriasRAM[$i]}}', this); calcularTotalArticulo();" value="{{$arrPreciosMemoriasRAM[$i]}}">
																</div>
															@else
																<div class="divRadioGradosTD">
																<input type="checkbox" id="{{$arrRefMemoriasRAM[$i]}}" name="refMemoriasRAM" onclick="elegirMemoriaRAM(<?php echo $arrPreciosMemoriasRAM[$i] ?>, '{{$arrRefMemoriasRAM[$i]}}', this); calcularTotalArticulo();" value="{{$arrPreciosMemoriasRAM[$i]}}">
																</div>
															@endif
															@if (session("usuario")->margenesActivo == 1)
																<div class="divRadioGradosTD">Añadir<br/>(+{{Utils::numFormat($arrPreciosMemoriasRAM[$i])}}€)</div>
															@else
																<div class="divRadioGradosTD">Añadir<br/>(+{{$arrPreciosMemoriasRAM[$i]}}€)</div>
															@endif
															<div class="divRadioGradosTD bold">{{$arrMemoriasRAM[$i]}} </div>
														</div>
													@endfor
												</td>
												<td class="td_precios_ampl" style="vertical-align: top; float: right;">
													<div id="div_precio_ram" class="div_radio_grados div_tipo_articulo">0€</div>
												</td>
											</tr>
											<tr>
												<td colspan="3" class="td_art_mv">
													@for ($i = 0; $i < count($arrMemoriasRAM); $i++)
														<div class="divRadioGrados" <?php if ($i == count($arrMemoriasRAM) - 1) { ?> style="display: none" <?php } ?>>
															@if ($i == count($arrMemoriasRAM) - 1)
																<div class="divRadioGradosTD">
																<input type="checkbox" id="{{$arrRefMemoriasRAM[$i]}}" name="refMemoriasRAM" checked onclick="elegirMemoriaRAM(<?php echo $arrPreciosMemoriasRAM[$i] ?>, '{{$arrRefMemoriasRAM[$i]}}', this); calcularTotalArticulo();" value="{{$arrPreciosMemoriasRAM[$i]}}">
																</div>
															@else
																<div class="divRadioGradosTD">
																<input type="checkbox" id="{{$arrRefMemoriasRAM[$i]}}" name="refMemoriasRAM" onclick="elegirMemoriaRAM(<?php echo $arrPreciosMemoriasRAM[$i] ?>, '{{$arrRefMemoriasRAM[$i]}}', this); calcularTotalArticulo();" value="{{$arrPreciosMemoriasRAM[$i]}}">
																</div>
															@endif
															@if (session("usuario")->margenesActivo == 1)
																<div class="divRadioGradosTD">Añadir<br/>(+{{Utils::numFormat($arrPreciosMemoriasRAM[$i])}}€)</div>
															@else
																<div class="divRadioGradosTD">Añadir<br/>(+{{$arrPreciosMemoriasRAM[$i]}}€)</div>
															@endif
															<div class="divRadioGradosTD bold">{{$arrMemoriasRAM[$i]}} </div>
														</div>
													@endfor
												</td>
											</tr>
										</table>
									@endif


									@if ($mostrarAmplDiscoDuro)
										<table class="table_ampliaciones">
											<tr>
												<td style="vertical-align: top; width: 125px;">
													<div class="div_radio_grados div_tipo_articulo">DISCO DURO</div>
												</td>
												<td class="td_art_pc" style="width: 425px;">
													@for ($i = 0; $i < count($arrDiscosDuros); $i++)
														<div class="divRadioGrados" <?php if ($i == count($arrDiscosDuros) - 1) { ?> style="display: none" <?php } ?>>
															@if ($i == count($arrDiscosDuros) - 1)
																<div class="divRadioGradosTD">
																<input type="checkbox" id="{{$arrRefDiscosDuros[$i]}}" name="refDiscosDuros" checked onclick="elegirDiscoDuro(<?php echo $arrPreciosDiscosDuros[$i] ?>, '{{$arrRefDiscosDuros[$i]}}', this); calcularTotalArticulo();" value="{{$arrPreciosDiscosDuros[$i]}}">
																</div>
															@else
																<div class="divRadioGradosTD">
																<input type="checkbox" id="{{$arrRefDiscosDuros[$i]}}" name="refDiscosDuros" onclick="elegirDiscoDuro(<?php echo $arrPreciosDiscosDuros[$i] ?>, '{{$arrRefDiscosDuros[$i]}}', this); calcularTotalArticulo();" value="{{$arrPreciosDiscosDuros[$i]}}">
																</div>
															@endif
															@if (session("usuario")->margenesActivo == 1)
																<div class="divRadioGradosTD">Añadir<br/>(+{{Utils::numFormat($arrPreciosDiscosDuros[$i])}}€)</div>
															@else
																<div class="divRadioGradosTD">Añadir<br/>(+{{$arrPreciosDiscosDuros[$i]}}€)</div>
															@endif
															<div class="divRadioGradosTD bold">{{$arrDiscosDuros[$i]}} </div>
														</div>
													@endfor
												</td>
												<td class="td_precios_ampl" style="vertical-align: top; float: right">
													<div id="div_precio_discoduro" class="div_radio_grados div_tipo_articulo">0€</div>
												</td>
											</tr>
											<tr>
												<td colspan="3" class="td_art_mv">
													@for ($i = 0; $i < count($arrDiscosDuros); $i++)
														<div class="divRadioGrados" <?php if ($i == count($arrDiscosDuros) - 1) { ?> style="display: none" <?php } ?>>
															@if ($i == count($arrDiscosDuros) - 1)
																<div class="divRadioGradosTD">
																<input type="checkbox" id="{{$arrRefDiscosDuros[$i]}}" name="refDiscosDuros" checked onclick="elegirDiscoDuro(<?php echo $arrPreciosDiscosDuros[$i] ?>, '{{$arrRefDiscosDuros[$i]}}', this); calcularTotalArticulo();" value="{{$arrPreciosDiscosDuros[$i]}}">
																</div>
															@else
																<div class="divRadioGradosTD">
																<input type="checkbox" id="{{$arrRefDiscosDuros[$i]}}" name="refDiscosDuros" onclick="elegirDiscoDuro(<?php echo $arrPreciosDiscosDuros[$i] ?>, '{{$arrRefDiscosDuros[$i]}}', this); calcularTotalArticulo();" value="{{$arrPreciosDiscosDuros[$i]}}">
																</div>
															@endif
															@if (session("usuario")->margenesActivo == 1)
																<div class="divRadioGradosTD">Añadir<br/>(+{{Utils::numFormat($arrPreciosDiscosDuros[$i])}}€)</div>
															@else
																<div class="divRadioGradosTD">Añadir<br/>(+{{$arrPreciosDiscosDuros[$i]}}€)</div>
															@endif
															<div class="divRadioGradosTD bold">{{$arrDiscosDuros[$i]}} </div>
														</div>
													@endfor
												</td>
											</tr>
										</table> 


											<?php
												// Al elegir una ampliación de disco duro, mostar fila preguntando: "Instalar S.O. en disco de ampliación" o "Mantener S.O. en el disco original"
											?>

										<table class="table_ampliaciones" id="ampl_so" style="margin-left: 126px; width: 655px; display: none;">
											<tr style="width: auto;">

												<td style="width: auto">
													<div class="divRadioGrados" >

														<div class="divRadioGradosTD">
															<input type="radio" id="ampl_so_instalar" name="input_ampl_so" value="instalar" onclick="elegirSOinstalar('instalar', this);" /> 
														</div>

														<div class="divRadioGradosTD">
															Instalar S.O. en disco de ampliación
														</div>
											
													</div>
												</td>
												
												<td style="padding-left: 20px;">
													<div class="divRadioGrados" >

														<div class="divRadioGradosTD">
															<input type="radio" id="ampl_so_mantener" name="input_ampl_so" value="mantener" onclick="elegirSOinstalar('mantener', this);" /> 
														</div>

														<div class="divRadioGradosTD">
															Mantener S.O. en disco original
														</div>
											
													</div>
												</td>
											</tr>
										</table> 

										<table class="" id="ampl_ssd" style="background-color: #e50b3e; color: white; margin-left: 129px; margin-bottom: 30px; width: 542px; font-weight: bold; display: none;">
											<tr>
												<td style="padding: 5px 10px;">En caso de disponer de un único espacio SATA, se reemplazará el disco original por el seleccionado</td>
											</tr>
										</table>

										
									@endif

									

									@if ($mostrarConversionTeclado)
										<table class="table_ampliaciones">
											<tr>
												<td style="vertical-align: top; width: 124px;">
													<div class="div_radio_grados div_tipo_articulo">IDIOMA TECLADO</div>
												</td>
												<td class="td_art_pc" style="width: 425px;">
													@foreach ($arrAmplTeclados as $arrAmplTeclado)
														<div class="divRadioGrados">

														@if ($arrAmplTeclado->ACODAR == '69509901')
															<div class="divRadioGradosTD">
																<input type="checkbox" id="{{$arrAmplTeclado->ACODAR}}" name="idioma_teclado" onclick="elegirIdiomaTeclado(this.value, this.id, this); calcularTotalArticulo();" value="{{$arrAmplTeclado->APVP1}}">
															</div>

															@if (session("usuario")->margenesActivo == 1)
																<div class="divRadioGradosTD">Añadir<br />
																	(+{{Utils::numFormat($arrAmplTeclado->APVP1)}}€)
																</div>
															@else
																<div class="divRadioGradosTD">Añadir<br />(+{{$arrAmplTeclado->APVP1}}€)</div>
															@endif

															<div class="divRadioGradosTD bold">ESPAÑOL</div>

														@elseif ($arrAmplTeclado->ACODAR == '69509902')
															<div class="divRadioGradosTD">
																<input type="checkbox" id="{{$arrAmplTeclado->ACODAR}}" name="idioma_teclado" onclick="elegirIdiomaTeclado(this.value, this.id, this); calcularTotalArticulo();" value="{{$arrAmplTeclado->APVP1}}">
															</div>

															@if (session("usuario")->margenesActivo == 1)
																<div class="divRadioGradosTD bold">
																	PORTUGUÉS (+{{Utils::numFormat($arrAmplTeclado->APVP1)}}€)
																</div>
															@else
																<div class="divRadioGradosTD bold">PORTUGUÉS (+{{$arrAmplTeclado->APVP1}}€)</div>
															@endif

														@elseif ($arrAmplTeclado->ACODAR == '69509903')
															<div class="divRadioGradosTD">
																<input type="checkbox" id="{{$arrAmplTeclado->ACODAR}}" name="idioma_teclado" onclick="elegirIdiomaTeclado(this.value, this.id, this); calcularTotalArticulo();" value="{{$arrAmplTeclado->APVP1}}">
															</div>

															@if (session("usuario")->margenesActivo == 1)
																<div class="divRadioGradosTD">Añadir<br />
																	(+{{Utils::numFormat($arrAmplTeclado->APVP1)}}€)
																</div>
															@else
																<div class="divRadioGradosTD">Añadir<br />(+{{$arrAmplTeclado->APVP1}}€)</div>
															@endif

															<div class="divRadioGradosTD bold">FRANCÉS</div>
															
														@endif

														</div>
													@endforeach
													<div class="div_radio_grados" style="display: none">
														<input type="checkbox" id="sin_teclado" name="idioma_teclado" checked onclick="elegirIdiomaTeclado(this.value, '', this); calcularTotalArticulo();" value="0">
														<label>SIN AMPLIACIÓN (+0€)</label><br>
													</div>
												</td>
												<td class="td_precios_ampl" style="vertical-align: top; float: right;">
													<div id="div_precio_teclado" class="div_radio_grados div_tipo_articulo">0€</div>
												</td>
											</tr>
											<tr>
												<td colspan="3" class="td_art_mv">
													@foreach ($arrAmplTeclados as $arrAmplTeclado)
														<div class="divRadioGrados">

														@if ($arrAmplTeclado->ACODAR == '69509901')
															<div class="divRadioGradosTD">
																<input type="checkbox" id="{{$arrAmplTeclado->ACODAR}}" name="idioma_teclado" onclick="elegirIdiomaTeclado(this.value, this.id, this); calcularTotalArticulo();" value="{{$arrAmplTeclado->APVP1}}">
															</div>

															@if (session("usuario")->margenesActivo == 1)
																<div class="divRadioGradosTD">Añadir<br />
																	(+{{Utils::numFormat($arrAmplTeclado->APVP1)}}€)
																</div>
															@else
																<div class="divRadioGradosTD">Añadir<br />(+{{$arrAmplTeclado->APVP1}}€)</div>
															@endif

															<div class="divRadioGradosTD bold">ESPAÑOL</div>

														@elseif ($arrAmplTeclado->ACODAR == '69509902')
															<div class="divRadioGradosTD">
																<input type="checkbox" id="{{$arrAmplTeclado->ACODAR}}" name="idioma_teclado" onclick="elegirIdiomaTeclado(this.value, this.id, this); calcularTotalArticulo();" value="{{$arrAmplTeclado->APVP1}}">
															</div>

															@if (session("usuario")->margenesActivo == 1)
																<div class="divRadioGradosTD bold">
																	PORTUGUÉS (+{{Utils::numFormat($arrAmplTeclado->APVP1)}}€)
																</div>
															@else
																<div class="divRadioGradosTD bold">PORTUGUÉS (+{{$arrAmplTeclado->APVP1}}€)</div>
															@endif

														@elseif ($arrAmplTeclado->ACODAR == '69509903')
															<div class="divRadioGradosTD">
																<input type="checkbox" id="{{$arrAmplTeclado->ACODAR}}" name="idioma_teclado" onclick="elegirIdiomaTeclado(this.value, this.id, this); calcularTotalArticulo();" value="{{$arrAmplTeclado->APVP1}}">
															</div>

															@if (session("usuario")->margenesActivo == 1)
																<div class="divRadioGradosTD">Añadir<br />
																	(+{{Utils::numFormat($arrAmplTeclado->APVP1)}}€)
																</div>
															@else
																<div class="divRadioGradosTD">Añadir<br />(+{{$arrAmplTeclado->APVP1}}€)</div>
															@endif

															<div class="divRadioGradosTD bold">FRANCÉS</div>
															
														@endif

														</div>
													@endforeach
												</td>
											</tr>
										</table>
									@endif

									

											</div>

											<?php
										}

										// ========================= FIN AMPLIACIONES ====================
									?>

								@endif


								</div>
							</div>
						</td>
					</tr>
				</table>

			@if(session('usuario')->uData->codigo>0)
				<div class="divPreciosArt td_art_mv divAnadirFixed">

					<div class="fPrecioAdd">

						<div id="div_anadir_cesta_disabled_mv" onclick="mostrarMsjGrados()" class="fAdd" <?php if ($numRefRepetidas <= 1) { ?> style="display: none" <?php } ?>>
							<a name="cestaAdd" id="cestaAdd{{$articulo->ACODAR}}" class="fBotonAddDisabled">
								A&ntilde;adir al carrito
							</a>
						</div>

						@for ($i = 0; $i < count($arrGradosArticulo); $i++)
							<div id="div_anadir_cesta_<?php echo $i ?>_mv" class="fAdd" 
								<?php if ($i > 0 || $numRefRepetidas > 1) { ?> style="display: none" <?php } ?>>
								<a name="cestaAdd_{{$i}}" id="cestaAdd{{$arrRefArticulos[$i]}}" 
									class="fBotonAdd anadir_carrito_mv" 
									onclick="if (!comprobarDisco()) { alert('Debe indicar si desea instalar el S.O. en el disco de ampliación o mantenerlo en el disco original'); } else{
									addArticulo('{{$arrRefArticulos[$i]}}', 
				                        document.getElementById('cantMv{{$articulo->ACODAR}}').value, 
				                        '{{URL::to('addArticulo')}}', this, document.getElementById('input_ref_ram').value, document.getElementById('input_ref_discoduro').value,  document.getElementById('input_ref_teclado').value, document.getElementById('input_ampl_so').value); } ">
								A&ntilde;adir al carrito</a>
							</div>
						@endfor
					</div>
				</div>
			@endif

			<div class="fCelda fCelda5 td_art_pc">
				<div class="fVentajas">
					<div class="ffCol">
						<div class="ffCol1">
							<img alt="Garantía" src="/xweb/public/images/iconos_ventajas_ficha_diginova-17.png" />
						</div>
						<div class="ffCol2">
							<div class="ffCol2_1">2 años de garantía</div>
						</div>
					</div>
					<div class="fLineaDivisoria"></div>
					<div class="ffCol">
						<div class="ffCol1">
							<img alt="Garantía" src="/xweb/public/images/iconos_ventajas_ficha_diginova-18.png" />
						</div>
						<div class="ffCol2">
							<div class="ffCol2_1">Financiación</div>
						</div>
					</div>
					<div class="fLineaDivisoria"></div>
					<div class="ffCol">
						<div class="ffCol1">
							<img alt="Garantía" src="/xweb/public/images/iconos_ventajas_ficha_diginova-19.png" />
						</div>
						<div class="ffCol2">
							<div class="ffCol2_1">24h RMA</div>
						</div>
					</div>
					<div class="fLineaDivisoria"></div>
					<div class="ffCol">
						<div class="ffCol1">
							<img alt="Garantía" src="/xweb/public/images/iconos_ventajas_ficha_diginova-20.png" />
						</div>
						<div class="ffCol2">
							<div class="ffCol2_1">1 mes de DOA</div>
						</div>
					</div>
				</div>
			</div>

			<div style="display: inline-block; background: white; margin-bottom: -4px; margin-left: 0px; margin-right: 0px;">
				<div class="fCelda fCelda6">
					<div class="ftit">Características</div>
					<div class="fCaracts">
						@for ($i = 0; $i < count($arrGradosArticulo); $i++)
							
							@if ($arrRefArticulos[$i] == $articulo->ACODAR)
								<span id="span_descr_<?php echo $i ?>">
									<?php echo nl2br($arrDescrArticulos[$i]); ?>
								</span>
							@else
								<span id="span_descr_<?php echo $i ?>" style="display: none">
									<?php echo nl2br($arrDescrArticulos[$i]); ?>
								</span>
							@endif

						@endfor
					</div>
				</div>

				<div class="fCelda fCelda7">
					<div class="ftit2">
						<div class="ftit2icon"><img src="/xweb/public/images/diginovatopventas.png"  /></div>
						<div class="ftit2txt">Top ventas</div>								
					</div>
					<div class="fContArts">
						@php
						$numArticulo = 0;
						@endphp
						@foreach($topArticulos as $relalt)
							@if($numArticulo == 3)
								@break
							@endif

							<?php
			                $artFoto = "nofoto.jpg";

			                if (isset($relalt->urlfoto))
			                {
			                    $artFoto = $relalt->urlfoto;
			                }

			                $urlfoto = "https://diginova.es/xweb/public/articulos/".$artFoto;
							?>
							<div class="fArtRelacionado">
								<div class="fArtRela1">
									<div class="fArtRela11">
										<a href="/xweb/articulo/{{$relalt->acodar}}">
											<!--<img src='https://diginova.es/xweb3/fotoartic/art_{{strtolower($relalt->acodar)}}_1.jpg' alt='{{$relalt->adescr}}' title='{{$relalt->adescr}}' border='0'   />-->

											<img src="<?php echo $urlfoto; ?>" alt='{{$relalt->adescr}}' title='{{$relalt->adescr}}' border='0'   />
										</a>
									</div>
									<div class="fArtRela12">
										@if (session("usuario")->margenesActivo == 1)
											{{Utils::numFormat($relalt->precioConMargen)}}€
										@else
											<?php
											if ( (session("usuario")->uData->codigo > 0) && isset($relalt->precioArtRelacionado) )
											{
												?>
												{{Utils::numFormat($relalt->precioArtRelacionado)}}€
												<?php
											}
											?>
										@endif
									</div>
								</div>
								<div class="fArtRela2">
									<a href="/xweb/articulo/{{$relalt->acodar}}">
										{{substr($relalt->adescr, 0, 60)}}...
									</a>
								</div>
							</div>
							@php
							$numArticulo += 1;
							@endphp
						@endforeach
					</div>
				</div>
			</div>

			<div class="fCelda fCelda8">
				<div class="ftit">Relacionados</div>
				<div class="fContArts divArticuloRelacionados">
					@php
					$left = 0;
					@endphp

					<?php
					$contador = 0;
					?>
					@foreach($barti->relacionados as $relalt)
						<?php
						$contador += 1;
						?>

						@if ($contador < 5)

							<?php
			                $artFoto = "nofoto.jpg";

			                if (isset($relalt->urlfoto))
			                {
			                    $artFoto = $relalt->urlfoto;
			                }

			                $urlfoto = "https://diginova.es/xweb/public/articulos/".$artFoto;
							?>


							@if(session("usuario")->uData->codigo == 0)
								<div class="celdaArt celdaArtFav celdaNoSesion" style="position: absolute; top: 0px; left: <?php echo $left; ?>px; z-index: 998">
							@else
								<div class="celdaArt celdaArtFav" style="position: absolute; top: 0px; left: <?php echo $left; ?>px; z-index: 998; height: 315px;">
							@endif
								<div class="celdaFot">
									<table border="0">
										<tr>
											<td style="vertical-align: middle;">
												<a href="/xweb/articulo/{{$relalt->acodar}}">
													<!--<img style="max-height: 150px; max-width: 150px;" src="https://diginova.es/xweb3/fotoartic/art_{{strtolower($relalt->acodar)}}_1.jpg" border="0" alt="{{$relalt->adescr}}" title="{{$relalt->adescr}}">-->

													<img style="max-height: 150px; max-width: 150px;" src="<?php echo $urlfoto; ?>" alt='{{$relalt->adescr}}' title='{{$relalt->adescr}}' border='0'  alt="{{$relalt->adescr}}" title="{{$relalt->adescr}}"  />
												</a>
											</td>
										</tr>
									</table>
								</div>
								<div class="celdaTipo celda_resto">&nbsp;</div>
								<div class="celdaDesc" style="height: 35px;">
									<a href="/xweb/articulo/{{$relalt->acodar}}" title="{{$relalt->adescr}}">
										{{substr($relalt->adescr, 0, 60)}}...	
									</a>		
								</div>
								@if(session("usuario")->uData->codigo == 0)
									<div class="celdaAniadir">
										<a href="/xweb/articulo/{{$relalt->adescr}}">Ver artículo ></a>
									</div>
								@else
									<div style="height: 20px"></div>
									<div class="celdaPrecio">
										@if (session("usuario")->margenesActivo == 1)
											{{Utils::numFormat($relalt->precioConMargen)}}€
										@else
											<?php
											if ( isset($relalt->precioArtRelacionado) )
											{
												?>

												{{Utils::numFormat($relalt->precioArtRelacionado)}}€

												<?php
											}
											?>
										@endif
									</div>
									<div class="celdaInv">
										<div class="celdaCantStock">
											<div class="celdaCant">
												Cantidad: <br/>
												<div class="celdaTabCant">
													<div>
														<img alt="-" src="/xweb/public/images/artmenosoff.png" id="menos{{$relalt->acodar}}" onclick="celdaCantBajar('{{$relalt->acodar}}', {{$relalt->astock}});">
													</div>
													<div>
														<input type="text" disabled name="cant" id="cant{{$relalt->acodar}}" value="1" style="border: none;" />
													</div>
													<div>
														<img alt="+" src="/xweb/public/images/artmason.png" id="mas{{$relalt->acodar}}" onclick="celdaCantSubir('{{$relalt->acodar}}', {{$relalt->astock}});">
													</div>
												</div>
											</div>
											<div class="celdaStock">
												Stock: <br/>
												<div>{{$relalt->astock}} unids.</div>
											</div>
										</div>
										<div class="divMensajeRecibelo">{{$mensajeRecibelo}}</div>
										<div id="cestaAdd{{$relalt->acodar}}" class="celdaAniadir pointer" onclick="addArticulo('{{$relalt->acodar}}', document.getElementById('cant{{$relalt->acodar}}').value,'{{URL::to('addArticulo')}}');">Añadir</div>
									</div>
								@endif
							</div>
							@php
							$left += 305;
							@endphp
						@endif
					@endforeach
				</div>
			</div>

			<br /><br /><br /><br /><br /><br /><br />
			<br /><br /><br /><br /><br /><br /><br />
		</div>

<script type="text/javascript">
function celdaCantBajar(acodar) {
    var valor = document.getElementById("cant" + acodar).value;

    if (valor > 1) { valor--; }

    document.getElementById("cant" + acodar).value = valor; 

    comprobarCants(acodar, valor, 1000);
}

function celdaCantSubir(acodar, max) {
    var valor = document.getElementById("cant" + acodar).value;

    if (valor < max)
    {
        valor++;
        document.getElementById("cant" + acodar).value = valor;
    }
    
    comprobarCants(acodar, valor, max);
}

function celdaCantBajarMv(acodar) {
    var valor = document.getElementById("cantMv" + acodar).value;

    if (valor > 1) { valor--; }

    document.getElementById("cantMv" + acodar).value = valor; 

    comprobarCants(acodar, valor, 1000);
}

function celdaCantSubirMv(acodar, max) {
    var valor = document.getElementById("cantMv" + acodar).value;

    if (valor < max)
    {
        valor++;
        document.getElementById("cantMv" + acodar).value = valor;
    }
    
    comprobarCants(acodar, valor, max);
}

function comprobarCants(acodar, cantidad, max) {
    var itemMenos = document.getElementById("menos" + acodar);
    var itemMas = document.getElementById("mas" + acodar);

    var itemMenosMv = document.getElementById("menosMv" + acodar);
    var itemMasMv = document.getElementById("masMv" + acodar);

    if (cantidad <= 1) 
    { 
    	itemMenos.src = "/xweb/public/images/artmenosoff.png";
    	itemMenosMv.src = "/xweb/public/images/artmenosoff.png";
    }
    else 
    { 
    	itemMenos.src = "/xweb/public/images/artmenoson.png";
    	itemMenosMv.src = "/xweb/public/images/artmenoson.png";
    }

    if (cantidad >= max) 
    { 
    	itemMas.src = "/xweb/public/images/artmasoff.png";
    	itemMasMv.src = "/xweb/public/images/artmasoff.png";

    }
    else 
    { 
    	itemMas.src = "/xweb/public/images/artmason.png"; 
    	itemMasMv.src = "/xweb/public/images/artmason.png"; 
    }
}





function calcularTotalArticulo()
{
    const formatter = new Intl.NumberFormat('es-PE', {
        style: 'decimal',
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    });

    var precioTotal = 0;

    $('.table_ampliaciones .td_precios_ampl div').each(function()
    {
        var precioArticulo = $(this).text().replace("€", "").replace(",", ".");

        precioTotal = parseFloat(precioTotal) + parseFloat(precioArticulo);
        precioTotal = formatter.format(precioTotal);
    });

    //precioTotal = precioTotal.toFixed(2).toString();
    precioTotal = precioTotal.replace(".", ",");

    var precioConIVA = parseFloat(precioTotal) + (parseFloat(precioTotal) * parseFloat(21) / parseFloat(100));
    precioConIVA = precioConIVA.toFixed(2);

    $('.fPrecios').empty();
    $('.fPrecios').text(precioTotal + '€');
    $('.fPrecios').append('<span>' + precioConIVA + '€ I.V.A incluido</span>');
}

function elegirGrado(num_grados, grado, precio)
{
    $("#div_anadir_cesta_disabled").hide();
    $("input[name = 'cant_" + grado + "']").val(1);

    for (var a = 0; a < num_grados; a++)
    {
        (function(a)
        {
            if (a == grado)
            {
                $('#nom_art_' + a).show();
                $('#nom_completo_art_' + a).show();
                $('#nom_descr_' + a).show();
                $('#div_stock_' + a).show();
                $('#div_precio_' + a).show();
                $('#span_descr_' + a).show();
                $('#div_anadir_cesta_' + a).show()
                $('#div_ajustes_' + a).show();
            }
            else
            {
                $('#nom_art_' + a).hide();
                $('#nom_completo_art_' + a).hide();
                $('#nom_descr_' + a).hide();
                $('#div_stock_' + a).hide();
                $('#div_precio_' + a).hide();
                $('#span_descr_' + a).hide();
                $('#div_anadir_cesta_' + a).hide()
                $('#div_ajustes_' + a).hide();
            }

        }(a));
    }

    precio = precio.toString();
    /*if (precio.indexOf(".") > -1)
    {
    	precio = precio + '0';
    }*/

    precio = precio.replace(".", ",");

    $('#div_precio_grados').empty();
    $('#div_precio_grados').text(precio + '€');
    $('#div_precio_grados').css('width', 'auto');
    $('#div_precio_grados').css('float', 'right');
}

function elegirMemoriaRAM(precio, referencia, elemento)
{
    $("input[name='refMemoriasRAM']").each(function() 
    {
        $(this).prop('checked', false);
    });

    if ($('#input_ref_ram').val() == referencia) 
    {
        $(elemento).prop('checked', false);
        $('#sinAmplMemoriaRAM').prop('checked', true);

        $('#div_precio_ram').empty();
        $('#div_precio_ram').text('0€');

        $('#input_ref_ram').val('');
    }
    else
    {
        $(elemento).prop('checked', true);

        $('#div_precio_ram').empty();
        $('#div_precio_ram').text(parseFloat(precio).toFixed(2).replace(".", ",") + '€');
        $('#div_precio_ram').css('width', '100px');

        $('#input_ref_ram').val(referencia);
    }
}

function elegirDiscoDuro(precio, referencia, elemento)
{
    $("input[name='refDiscosDuros']").each(function() 
    {
        $(this).prop('checked', false);
    });

    if ($('#input_ref_discoduro').val() == referencia) 
    {
        $(elemento).prop('checked', false);
        $('#sinAmplDiscoDuro').prop('checked', true);

        $('#div_precio_discoduro').empty();
        $('#div_precio_discoduro').text('0€');

        $('#input_ref_discoduro').val('');
        document.getElementById("ampl_so").style.display = "none";
        document.getElementById("ampl_ssd").style.display = "none";
    }
    else
    {
        $(elemento).prop('checked', true);

        $('#div_precio_discoduro').empty();
        $('#div_precio_discoduro').text(parseFloat(precio).toFixed(2).replace(".", ",") + '€');
        $('#div_precio_discoduro').css('width', '100px');

        $('#input_ref_discoduro').val(referencia);
        document.getElementById("ampl_so").style.display = "block";

        if (
        	(referencia == "695006AMP201" || referencia == "695006AMP202" || referencia == "695006AMP203")
        	&& (document.getElementById("ampl_so_mantener").checked  || document.getElementById("ampl_so_instalar").checked  )
    	   )
        {
        	document.getElementById("ampl_ssd").style.display = "block";
        }
        else 
        {
        	document.getElementById("ampl_ssd").style.display = "none";
        }
    }
}

function elegirIdiomaTeclado(precio, referencia, elemento)
{
    $("input[name='idioma_teclado']").each(function() 
    {
        $(this).prop('checked', false);
    });

    if ($('#input_ref_teclado').val() == referencia) 
    {
        $(elemento).prop('checked', false);
        $('#sin_teclado').prop('checked', true);

        $('#div_precio_teclado').empty();
        $('#div_precio_teclado').text('0€');

        $('#input_ref_teclado').val('');
    }
    else
    {
        $(elemento).prop('checked', true);

        $('#div_precio_teclado').empty();
        $('#div_precio_teclado').text(precio + '€');

        $('#input_ref_teclado').val(referencia);
    }
}



function elegirSOinstalar(valor, elemento)
{
	//document.getElementById("input_ampl_so").value = valor;
	$('#input_ampl_so').val(valor);

	// Si está marcado un SSD SATA, mostrar el mensaje:
	    if ( $('#input_ref_discoduro').val() == "695006AMP201" || $('#input_ref_discoduro').val() == "695006AMP202" || $('#input_ref_discoduro').val() == "695006AMP203" || $('#input_ref_discoduro').val() == "69500225SA512G" ) 
    	{
    		document.getElementById("ampl_ssd").style.display = "table";	
    	}
    	else
    	{
    		document.getElementById("ampl_ssd").style.display = "none";
    	}
		
}

var popupOcultado = true;


function mostrarMsjGrados()
{
    mostrarPopupTransferencia();

    setTimeout(function()
    {
        ocultarPopupTransferencia();
    }, 2000);
}
function mostrarPopupTransferencia() 
{
    $(".popupTransferencia").removeClass("hidepopup");
    $(".popupTransferencia").addClass("showpopup");

    if (popupOcultado)
    {
        popupOcultado = false;
    }
}

function ocultarPopupTransferencia() 
{
    popupOcultado = true;

    $(".popupTransferencia").removeClass("showpopup");
    $(".popupTransferencia").addClass("hidepopup");
}

function comprobarDisco()
{
	var retorno = true;
	var refDiscosDuros = document.getElementsByName("refDiscosDuros");

	var hayDiscoSeleccionado = false;

	for (var i = 0; i < refDiscosDuros.length; i++)
	{
		if (refDiscosDuros[i].checked && refDiscosDuros[i].id != "sinAmplDiscoDuro")
		{
			hayDiscoSeleccionado = true;
		}
	}

	console.log("Hay disco: " + hayDiscoSeleccionado);


	// Si hay ampli de disco seleccionada: comprobar si se ha indicado instalar o mantener el SO
	if (hayDiscoSeleccionado)
	{
		retorno = false;
		var camposSO = document.getElementsByName("input_ampl_so");

		for (var i = 0; i < camposSO.length; i++)
		{
			if (camposSO[i].checked)
			{
				retorno = true;
			}
		}
	}

	return retorno;
}

</script>

<script src="{{URL::asset('public/js/alertify.min.js')}}"></script>

	@endforeach
@endsection
