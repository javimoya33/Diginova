@extends("base")

@section("titulo")
{{session("entorno")->config->x_nomemp}} - {{T::tr('Cesta de la compra')}}
@endsection

@section("dashboard")
	<!-- no se ha iniciado sesión --> 
	@if(session('usuario')->uData->codigo==0)
		<div class="alert alert-danger">
			<span class="glyphicon glyphicon-alert"></span> {{T::tr('Inicie sesión o	regístrese para finalizar la compra')}}
		</div>
	@endif
    @if($registros==0)
      <div class="alert alert-danger text-left" role="alert" style=''>{{T::tr('La cesta está vacía')}}.</div>
    @endif
@endsection

@section("central")
<?php
  
$preciosconiva=false;

$decprec=session('entorno')->config->x_decpreci;
$deccan=session('entorno')->config->x_deccanti;


/*var_dump($articulos);
echo '**************************************';*/
 /*var_dump(session("entorno")->desgloseCesta);
echo '**************************************'; */
/*var_dump(session("usuario"));
echo '**************************************';*/
?>
@if ($cantArticulosSinAmpliacion < 2)
<script type="text/javascript">
	//deleteArticulo('POA','{{URL::to('deleteArticulo')}}', {{$numArticulosSinAmpliacion}});
</script>
@endif


<?php

	/*if ( isset(session("entorno")->desgloseCesta->portesTotal) )
	{
		echo "<br /> sesion: ".session("entorno")->desgloseCesta->portesTotal;
	}*/


	//echo "<br />formaEnvio: ".$desgloseCesta->formaEnvio;


	//var_dump(session("entorno") -> portesTarifas;



?>

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
	@if (empty($articulos))
		<div id="cestapagina1" class="cestapagina1">
			<div class="cesta_vacia">
				<div class="ces_vaciaTd ces_vacia1">Tu cesta de presupuestos está vacía en este momento :(</div>
				<div class="ces_vaciaTd ces_vacia2">
					<div class="cesV2">Sigue presupuestando y disfrutando de:</div>
					<div class="cesV2Table">
						<div class="cesV2Table1">
							<img alt="Diginova" src="/xweb/public/images/iconos_ventajas_ficha_diginova-18.png" />
						</div>
						<div class="cesV2Table2">
							<span>Financiación</span>
						</div>
					</div> 
					<div class="cesV2Table">
						<div class="cesV2Table1">
							<img alt="Diginova" src="/xweb/public/images/iconos_ventajas_ficha_diginova-19.png" />
						</div>
						<div class="cesV2Table2">
							<span>24h RMA y pedidos</span>
						</div>
					</div>
				</div>
				<div class="ces_vaciaTd ces_vacia3">
					<div class="cesV2Table" style="height: 105px; display: block;"></div>
					<div class="cesV2Table">
						<div class="cesV2Table1">
							<img alt="Diginova" src="/xweb/public/images/iconos_ventajas_ficha_diginova-17.png" />
						</div>
						<div class="cesV2Table2">
							<span>2 años de garantía</span>
						</div>
					</div>
					<div class="cesV2Table">
						<div class="cesV2Table1">
							<img alt="Diginova" src="/xweb/public/images/iconos_ventajas_ficha_diginova-19.png" />
						</div>
						<div class="cesV2Table2">
							<span>1 mes de DOA</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	@else

		<div class="fichaBoxCentral">
			<div id="cestapagina1" class="cestapagina1">
				<div class="cesta_titulo">
					<div class="cesta_titulo1">Presupuesto 2</div>
					<div></div>
				</div>

				@if ($presuGenerado)
					<div class="finCompraT" style="display: block; width: 1240px; margin: 0 auto;">
						<div class="cesta_titulo1" style="color: green; font-size: 12pt; line-height: 25px;">¡Su presupuesto se ha realizado con éxito! En el siguiente enlace puede descargar el PDF con los detalles del presupuesto y enviárselo por email a su cliente.</div>
					</div>

					<div>
						<a href="/xweb/resources/pdfpresu/presu_{{$linkPDF}}.pdf" target="_blank" style="font-weight: bold; color: #ff0041; font-family: 'montserratextrabold'; text-decoration: underline;">Descargar PDF del presupuesto</a>
					</div>
				@endif

				<?php 
					//$formaEnvio = session("entorno")->desgloseCesta->formaEnvio;
					//echo "A: $formaEnvio<br />"; 
				?>

				<table border="0" align="center" class="cestaTabla table_cesta_mv">
					<?php $var=0; ?>
					<?php 
					$importePorte = 0; ?>
					@foreach($articulos as $bces)
						@if (!$bces->esAmpliacion || $bces->acodar == 'POG' || $bces->acodar == 'POA' || $bces->acodar == 'POV' || $bces->acodar == 'POGS' || $bces->acodar == 'POAS' || $bces->acodar == 'PO')
							@if ($bces->acodar == 'POG' || $bces->acodar == 'POA' || $bces->acodar == 'POV' || $bces->acodar == 'POGS' || $bces->acodar == 'POAS' || $bces->acodar == 'PO')
								<?php
								//$importePorte += $bces->totalLinea;
								?>
							@else
								<?php $var++; ?>
								<tr class="cestaart cestaartPrim">
									<td class="cestaart1">
											@if (!$bces->esAmpliacion)
												<?php
													$urlFoto = $bces -> urlfoto;
												?>

												<img src="<?php echo $urlFoto; ?>">
											@endif
									</td>
									<td class="cestaart2">
										<a href="/xweb/articulo/{{$bces->acodar}}">
											{{$bces->adescr}}<br/>
											<span class="cestacod">Cód: <span>{{$bces->acodar}}</span></span>
										</a>
									</td>
								</tr>
								<tr class="cestaart">
									<td class="cestaart1"></td>
									<td class="cestaart3">
										<div class="cestaart3TotalLinea">{{Utils::numFormat(($preciosconiva?$bces->totalLinea*(($bces->porcentajeIva/100)+1):$bces->totalLinea))}}€</div>
										<div class="cestaart3PorUnidad">Precio por unidad {{Utils::numFormat(($preciosconiva?$bces->precioConIva:$bces->precioSinIva), $decprec)}}€</div>
									</td>
								</tr>
								<tr class="cestaart">
									<td class="cestaart1"></td>
									<td class="ficha_cantidad cestaart4">
										<div class="ficha_cantidad1">
											<form id="forme{{$var}}" name="forme" method="post" action="" style="margin-bottom:0; float: right;">
												<input type="hidden" name="_token" value="{{csrf_token()}}"/>
												<input type="hidden" name="page" size="2" maxlength="30" value="cesta" />
												<input type="hidden" name="action" size="2" maxlength="30" value="modify" />
												<input type="hidden" name="codigo" size="2" maxlength="30" value="{{$bces->acodar}}" />
												<input type="hidden" name="cantidad" id="canti{{$var}}" size="2" maxlength="30" value="{{$bces->cantiCesta}}" />
												<input type="hidden" name="linea" size="2" maxlength="30" value="{{$var}}" />

												@if (!$bces->tieneAmpliacion && !$bces->esAmpliacion)
													<!-- // *** CAMBIAR *** // 
													<div class="fichaCant1" onclick="modifyArticulo('{{$bces->acodar}}', 'http://diginova.es/modifyArticulo', 0, {{$var}}); location.reload();">
														<span id="ficha_menos">-</span>
													</div>
												  -->
													<div class="fichaCant1" style="float: left" onclick="modifyArticulo('{{$bces->acodar}}', '/xweb/modifyArticulo', 0, {{$var}}); location.reload();">
														<span id="ficha_menos">-</span>
													</div>
												@else
													<div class="fichaCant1" style="visibility: hidden;">
														<span id="ficha_menos">-</span>
													</div>
												@endif
												
												<div class="fichaCant2" style="float: left">
													<input type="text" name="canti" class="ficha_cant" id="cantiArti{{$var}}" value="{{Utils::numFormat($bces->cantiCesta,2, '.', '', true)}}" onchange="document.getElementById('forme{{$var}}').submit();" />
												</div>

												@if (!$bces->tieneAmpliacion && !$bces->esAmpliacion)
													<!-- // *** CAMBIAR *** // 
													<div class="fichaCant3" onclick="modifyArticulo('{{$bces->acodar}}', 'diginova.es/modifyArticulo', 1, {{$var}}); location.reload();">
														<span id="ficha_mas">+</span>
													</div>
												  -->
													<div class="fichaCant3" style="float: left" onclick="modifyArticulo('{{$bces->acodar}}', '/xweb/modifyArticulo', 1, {{$var}}); location.reload();">
														<span id="ficha_mas">+</span>
													</div>
												@else
													<div class="fichaCant1" style="visibility: hidden;">
														<span id="ficha_mas">-</span>
													</div>	
												@endif

											</form>
										</div>
										<div class="ficha_eliminar_art">
											@if (!$bces->esAmpliacion)
												@if ($bces->acodar != '91019901P')
													<a onclick="
														<?php
														for ($i = 0; $i < count($bces->ampliacion); $i++) 
														{
															?>
															deleteArticulo('{{$bces->ampliacion[$i]}}','{{URL::to('deleteArticulo')}}', {{$bces->restoCantAmpliacion[$i]}});
															<?php
														}
														?>
														deleteArticulo('{{$bces->acodarencoded}}','{{URL::to('deleteArticulo')}}', 0); location.reload(); ">
														<img alt="Quitar" title="Quitar del pedido" src="public/images/rma_elim0.png" onmouseover="hoverImg(this);" onmouseout="unHoverImg(this);" />
													</a>
												@endif
											@endif
										</div>
									</td>
								</tr>
								@if ($bces->tieneAmpliacion)
									<?php
									for ($i = 0; $i < count($bces->ampliacion); $i++) 
									{ 
										?>
										<tr class="cestaart cestaamplPrim">
											<td class="cestaart1"></td>
											<td class="cestaart2">
												<a href="/xweb/articulo/{{$bces->ampliacion[$i]}}">
													{{$bces->descrAmpliacion[$i]}}<br/>
													<span class="cestacod">Cód: <span>{{$bces->ampliacion[$i]}}</span></span>
												</a>
											</td>
										</tr>
										<tr class="cestaart cestaamplUlt">
											<td class="cestaart1"></td>
											<td class="cestaart3">
												<div class="cestaart3TotalLinea">{{Utils::numFormat(($bces->importeAmpliacion[$i]), $decprec)}}€</div>
												<div class="cestaart3PorUnidad">Precio por unidad {{Utils::numFormat(($bces->precioAmpliacion[$i]), $decprec)}}€</div>
											</td>
										</tr>
										<?php
									}
									?>
								@endif
							@endif
						@endif
					@endforeach
				</table>

				<div class="cestaContTotalesTD cestaContTotales1 table_cesta_mv">
					<a href="{{URL::to('emptyBasket')}}" title="{{T::tr('Vaciar cesta')}}" class="cesta_vaciar" style="margin-top: 45px">
						<img src="/xweb/public/images/eliminaricon.png" />Vaciar cesta
					</a>
					<a href="/xweb/" class="cesta_vaciar cesta_vaciar2">Seguir comprando</a>
				</div>

				<div class="cestaContTotalesTD cestaContTotales2 table_cesta_mv">
					<?php
					//$sumaPrecioArticulos = $desgloseCesta->sumaPrecioArticulos - $importePorte;
					$sumaPrecioArticulos = $desgloseCesta->sumaPrecioArticulos;
					?>
			
					<div class="totalesT">
						<div class="totalesTD totalesTD1">Suma</div>
						<div class="totalesTD totalesTD2">{{Utils::numFormat($sumaPrecioArticulos)}}&euro;</div>
					</div>

					<div class="totalesT" style="display: none">
						<div class="totalesTD totalesTD1">Portes</div>
						<div class="totalesTD totalesTD2" id="cesta_edit_portes_mv">{{Utils::numFormat($importePorte)}}&euro;</div>
					</div>



					@if($desgloseCesta->importeDescuentoCliente > 0)
						<div class="totalesT">
							<div class="totalesTD totalesTD1">Descuentos</div>
							<div class="totalesTD totalesTD2">{{Utils::numFormat($desgloseCesta->importeDescuentoCliente)}}&euro;</div>
						</div>
					@endif

					@if($desgloseCesta->iva2>0)
						<div class="totalesT">
							<div class="totalesTD totalesTD1">I.V.A.</div>
							<div class="totalesTD totalesTD2" id="cesta_edit_iva_mv">{{Utils::numFormat($desgloseCesta->iva2)}}&euro;</div>
						</div>
					@endif

					@if($desgloseCesta->iva1>0)
						<div class="totalesT">
							<div class="totalesTD totalesTD1">I.V.A.</div>
							<div class="totalesTD totalesTD2">{{Utils::numFormat($desgloseCesta->iva1)}}&euro;</div>
						</div>
					@endif

					@if($desgloseCesta->iva3>0)
						<div class="totalesT">
							<div class="totalesTD totalesTD1">I.V.A.</div>
							<div class="totalesTD totalesTD2">{{Utils::numFormat($desgloseCesta->iva3)}}&euro;</div>
						</div>
					@endif

					@if($desgloseCesta->iva4>0)
						<div class="totalesT">
							<div class="totalesTD totalesTD1">I.V.A.</div>
							<div class="totalesTD totalesTD2">{{Utils::numFormat($desgloseCesta->iva4)}}&euro;</div>
						</div>
					@endif

					@if($desgloseCesta->iva5>0)
						<div class="totalesT">
							<div class="totalesTD totalesTD1">I.V.A.</div>
							<div class="totalesTD totalesTD2">{{Utils::numFormat($desgloseCesta->iva5)}}&euro;</div>
						</div>
					@endif

					<div class="sepwidth2"></div>

					<div class="totalesT totalesTT">
						<div class="totalesTD totalesTD1 totalesTT1">Total</div>
						<div class="totalesTD totalesTD2 totalesTT2" id="cesta_edit_total_mv">{{Utils::numFormat($desgloseCesta->granTotal)}}&euro;</div>
					</div>

				</div>

				<table border="0" align="center" class="cestaTabla cestaTabla1 table_cesta_pc">
					<tr class="cestaart cestaartTit">
						<td class="cestaart1">Artículo</td>
						<td class="cestaart2">&nbsp;</td>
						<td class="cestaart4">Unidades</td>
						<td class="cestaart3">Precio / Ud</td>
						<td class="cestaart3">Margen</td>
						<td class="cestaart5">Total</td>
						<td class="cestaart6">&nbsp;</td>
					</tr>
				</table>
				<div class="sepwidth"></div>

<form id="form_generar_presu" method="post" action="{{URL::to('generarpresupuestomod')}}" style="margin: 0px;">
				<table border="0" align="center" class="cestaTabla table_cesta_pc">
					<?php $var=0; ?>
					<?php 

					// 1234

					$importePorte = 0; ?>
					@foreach($articulos as $bces)
						@if (!$bces->esAmpliacion || $bces->acodar == 'POG' || $bces->acodar == 'POA' || $bces->acodar == 'POV' || $bces->acodar == 'POGS' || $bces->acodar == 'POAS' || $bces->acodar == 'PO')
							@if ($bces->acodar == 'POG' || $bces->acodar == 'POA' || $bces->acodar == 'POV' || $bces->acodar == 'POGS' || $bces->acodar == 'POAS' || $bces->acodar == 'PO')
								<?php
								//$importePorte += $bces->totalLinea;
								?>
							@else
								<?php $var++; ?>
								<tr class="cestaart art1">
									<td class="cestaart1">
											@if (!$bces->esAmpliacion)
												<?php
													$urlFoto = $bces -> urlfoto;
												?>

												<img src="<?php echo $urlFoto; ?>">
											@endif
									</td>
									<td class="cestaart2">
										<a href="/xweb/articulo/{{$bces->acodar}}">
											{{$bces->adescr}}<br/>
											<span class="cestacod">Cód: <span>{{$bces->acodar}}</span></span>
										</a>
									</td>


									<!-- UNIDADES -->
										<td class="ficha_cantidad cestaart4">
											<div class="ficha_cantidad1">
												@if ($presuGenerado)
													<div class="fichaCant2" style="float: right; padding-right: 40px;">{{Utils::numFormat($bces->cantiCesta,2, '.', '', true)}}</div>
												@else
													<form id="forme{{$var}}" name="forme" method="post" action="" style="margin-bottom:0; float: right;">
														<input type="hidden" name="_token" value="{{csrf_token()}}"/>
														<input type="hidden" name="page" size="2" maxlength="30" value="cesta" />
														<input type="hidden" name="action" size="2" maxlength="30" value="modify" />
														<input type="hidden" name="codigo" size="2" maxlength="30" value="{{$bces->acodar}}" />
														<input type="hidden" name="cantidad" id="canti{{$var}}" size="2" maxlength="30" value="{{$bces->cantiCesta}}" />
														<input type="hidden" name="linea" size="2" maxlength="30" value="{{$var}}" />
														

														@if (!$bces->tieneAmpliacion && !$bces->esAmpliacion)
															<!-- // *** CAMBIAR *** // 
															<div class="fichaCant1" onclick="modifyArticulo('{{$bces->acodar}}', 'http://diginova.es/modifyArticulo', 0, {{$var}}); location.reload();">
																<span id="ficha_menos">-</span>
															</div>
														  -->
															<div class="fichaCant1" style="float: left" onclick="modifyArticulo('{{$bces->acodar}}', '/xweb/modifyArticulo', 0, {{$var}}); location.reload();">
																<span id="ficha_menos">-</span>
															</div>
														@else
															<div class="fichaCant1" style="visibility: hidden;">
																<span id="ficha_menos">-</span>
															</div>
														@endif
														
														<div class="fichaCant2" style="float: left" style="float: right; padding-right: 40px;">
															<input type="text" name="canti" class="ficha_cant" id="cantiArti{{$var}}" namealt="canti_<?php echo $bces->acodar; ?>" value="{{Utils::numFormat($bces->cantiCesta,2, '.', '', true)}}" onchange="document.getElementById('forme{{$var}}').submit();" />
														</div>

														@if (!$bces->tieneAmpliacion && !$bces->esAmpliacion)
															<!-- // *** CAMBIAR *** // 
															<div class="fichaCant3" onclick="modifyArticulo('{{$bces->acodar}}', 'diginova.es/modifyArticulo', 1, {{$var}}); location.reload();">
																<span id="ficha_mas">+</span>
															</div>
														  -->
															<div class="fichaCant3" style="float: left" onclick="modifyArticulo('{{$bces->acodar}}', '/xweb/modifyArticulo', 1, {{$var}}); location.reload();">
																<span id="ficha_mas">+</span>
															</div>
														@else
															<div class="fichaCant1" style="visibility: hidden;">
																<span id="ficha_mas">-</span>
															</div>	
														@endif

													</form>
												@endif
											</div>
										</td>


									<!-- PRECIO UNIDAD -->
										@if ($presuGenerado)
											<td class="cestaart3">{{Utils::numFormat($bces->precioSinIva)}}€</td>
										@else
											<td class="cestaart3"><!--{{Utils::numFormat(($bces->precioSinIva), $decprec)}}€-->
												<!--<input type="text" onchange="editarPrecioPresupuesto('{{$bces->acodar}}', this, {{$ccodcl}})"  value="{{Utils::numFormat(($bces->precioSinIva), $decprec)}}" />€-->
												<input class="numformato_precio" pvd="<?php echo $bces -> pvd; ?>" pvdYrecargo="<?php echo $bces -> pvdYrecargo; ?>" referencia="<?php echo $bces -> acodar; ?>" type="text" id="txt_precio_<?php echo $bces->acodar; ?>" name="txt_precio_<?php echo $bces->acodar; ?>" valor="<?php echo $bces->precioSinIva; ?>" value="{{Utils::numFormat(($bces->precioSinIva), $decprec)}}" style="text-align: center; width: 110px;" onfocus="this.select();" /> €
											</td>
										@endif


									<!-- MARGEN -->
										<td class="cestaart3"> 
											<input class="numformato_margen" pvd="<?php echo $bces -> pvd; ?>" pvdYrecargo="<?php echo $bces -> pvdYrecargo; ?>"  referencia="<?php echo $bces -> acodar; ?>" type="text" id="txt_margen_<?php echo $bces->acodar; ?>" name="txt_margen_<?php echo $bces->acodar; ?>" value="<?php echo $bces -> margen; ?>" style="text-align: center; width: 70px;" onfocus="this.select();" /> %
										</td>

									<!-- TOTAL LÍNEA -->
										@if ($presuGenerado)
											<td class="cestaart5">{{Utils::numFormat($bces->totalLinea)}}€</td>
										@else
											<td  class="cestaart5"><span style="font-family: montserratbold; font-size: 18px; text-align: right; width: 180px; " id="total_linea_<?php echo $bces->acodar; ?>">{{Utils::numFormat(($bces->totalLinea), $decprec)}}</span>€</td>
										@endif


									<td class="cestaart6">
										@if (!$presuGenerado)
											@if (!$bces->esAmpliacion)
												@if ($bces->acodar != '91019901P')
													<a onclick="
														<?php
														for ($i = 0; $i < count($bces->ampliacion); $i++) 
														{
															?>
															deleteArticulo('{{$bces->ampliacion[$i]}}','{{URL::to('deleteArticulo')}}', {{$bces->restoCantAmpliacion[$i]}});
															<?php
														}
														?>
														deleteArticulo('{{$bces->acodarencoded}}','{{URL::to('deleteArticulo')}}', 0); location.reload(); ">
														<img alt="Quitar" title="Quitar del pedido" src="public/images/rma_elim0.png" onmouseover="hoverImg(this);" onmouseout="unHoverImg(this);" />
													</a>
												@endif
											@endif
										@endif
									</td>
								</tr>
								<tr>
									<td colspan="6">
										<div class="sepwidth"></div>
									</td>
								</tr>
								<?php
								// 1234
								for ($i = 0; $i < count($bces->ampliacion); $i++) 
								{ 
									?>
									<tr class="cestaart  art2">
										<td class="cestaart1"></td>
										<td class="cestaart2">
											<a href="/xweb/articulo/{{$bces->ampliacion[$i]}}">
												{{$bces->descrAmpliacion[$i]}}<br/>
												<span class="cestacod">Cód: <span>{{$bces->ampliacion[$i]}}</span></span>
											</a>
										</td>

										<td class="ficha_cantidad cestaart4">
											<div class="ficha_cantidad1">
												<form id="forme{{$var}}" name="forme" method="post" action="" style="margin-bottom:0; float: right;">
													<div class="fichaCant1" style="visibility: hidden;">
														<span id="ficha_menos">-</span>
													</div>
													<div class="fichaCant2">
														<input type="text" name="canti" class="ficha_cant" id="cantiArti{{$var}}" namealt="canti_<?php echo $bces -> ampliacion[$i]; ?>" value="{{$bces->cantAmpliacion[$i]}}" />
													</div>
													<div class="fichaCant1" style="visibility: hidden;">
														<span id="ficha_mas">-</span>
													</div>
												</form>
											</div>
										</td>


									<!-- PRECIO UNIDAD -->
											<td class="cestaart3">											
												<input class="numformato_precio" pvd="<?php echo $bces -> pvd; ?>" pvdYrecargo="<?php echo $bces -> pvdYrecargo; ?>" referencia="<?php echo $bces -> ampliacion[$i]; ?>" type="text" id="txt_precio_<?php echo $bces->ampliacion[$i]; ?>" name="txt_precio_<?php echo $bces->ampliacion[$i]; ?>" valor="<?php echo $bces->precioAmpliacion[$i]; ?>" value="<?php echo $bces -> precioAmpliacion[$i]; ?>" style="text-align: center; width: 110px;" onfocus="this.select();" /> €
											</td>
				


									<!-- MARGEN -->
										<td class="cestaart3"> 
											<input class="numformato_margen" pvd="<?php echo $bces -> pvd; ?>" pvdYrecargo="<?php echo $bces -> pvdYrecargo; ?>"  referencia="<?php echo $bces -> ampliacion[$i]; ?>" type="text" id="txt_margen_<?php echo $bces->ampliacion[$i]; ?>" name="txt_margen_<?php echo $bces->ampliacion[$i]; ?>" value="<?php echo $bces -> margen; ?>" style="text-align: center; width: 70px;" onfocus="this.select();" /> %
										</td>

									<!-- TOTAL LÍNEA -->
											<td  class="cestaart5">
												<span style="font-family: montserratbold; font-size: 18px; text-align: right; width: 180px; " id="total_linea_<?php echo $bces -> ampliacion[$i]; ?>"><?php echo $bces -> importeAmpliacion[$i]; ?></span>€
											</td>
					



										<td class="cestaart6"></td>
									</tr>



									<tr>
										<td colspan="6">
											<div class="sepwidth"></div>
										</td>
									</tr>
									<?php
								}
								?>
							@endif
						@endif

						




					@endforeach
				</table>
				<div class="sepwidth"></div>

				<!-- 1234  action  generarpresupuesto -->

				
					<div class="cestaContTotales" style="padding-bottom: 0px;">
						<div class="cestaContTot" style="width: 1240px; display: flex">
							<div class="cestaContTotSecc" style="width: 958px; display: block;">

								@if (!$presuGenerado)
									<div class="divGrupoPresuDatosCliente">
										<div class="divFilaPresuDatosCliente">
											<div style="font-family: montserratbold; font-size: 14pt;">Introduzca los datos del cliente</div>
										</div>
									</div>
									
									<div class="divGrupoPresuDatosCliente">
										<div class="divFilaPresuDatosCliente">
											<input type="text" id="presuClienteNombre" name="presuClienteNombre" placeholder="Nombre y apellidos" value="" />
										</div>
									</div>

									<div class="divGrupoPresuDatosCliente">
										<div class="divFilaPresuDatosCliente">
											<input type="text" id="presuClienteTlfno" name="presuClienteTlfno" placeholder="Teléfono" value="" />
											<input type="text" id="presuClienteEmail" name="presuClienteEmail" placeholder="Email" value="" />
										</div>
									</div>

									<div class="divGrupoPresuDatosCliente">
										<div class="divFilaPresuDatosCliente">
											<input type="text" id="presuClienteDir" name="presuClienteDir" placeholder="Dirección de envío" value="" />
										</div>
									</div>

									<div class="divGrupoPresuDatosCliente">
										<div class="divFilaPresuDatosCliente">
											<input type="text" id="presuClienteCP" name="presuClienteCP" placeholder="CP" value="" />
											<input type="text" id="presuClientePob" name="presuClientePob" placeholder="Población" value="" />
											<input type="text" id="presuClienteProv" name="presuClienteProv" placeholder="Provincia" value="" />
										</div>
									</div>
								@endif

							</div>

							<div>
								<div class="cestaContTotalesTD cestaContTotales2 table_cesta_pc" style="width: 332px;">
									<?php
									//$sumaPrecioArticulos = $desgloseCesta->sumaPrecioArticulos - $importePorte;
									$sumaPrecioArticulos = $desgloseCesta->sumaPrecioArticulos
									?>
							
									<div class="totalesT">
										<div class="totalesTD totalesTD1 totalesTD1Presu">Suma</div>
										<div id="sumaPrecioArticulos" class="totalesTD totalesTD2" valor="{{$sumaPrecioArticulos}}">{{$sumaPrecioArticulos}}&euro;</div>
									</div>

									<div class="totalesT" style="display: none">
										<div class="totalesTD totalesTD1 totalesTD1Presu">Portes</div>
										<div class="totalesTD totalesTD2" id="cesta_edit_portes">{{$importePorte}}&euro;</div>
									</div>



									@if($desgloseCesta->importeDescuentoCliente > 0)
										<div class="totalesT">
											<div class="totalesTD totalesTD1 totalesTD1Presu">Descuentos</div>
											<div class="totalesTD totalesTD2">{{$desgloseCesta->importeDescuentoCliente}}&euro;</div>
										</div>
									@endif

									@if($desgloseCesta->iva2>0)
										<div class="totalesT">
											<div class="totalesTD totalesTD1 totalesTD1Presu">I.V.A.</div>
											<div class="totalesTD totalesTD2" id="cesta_edit_iva" valor="{{$desgloseCesta->iva2}}">{{$desgloseCesta->iva2}}&euro;</div>
										</div>
									@endif

									@if($desgloseCesta->iva1>0)
										<div class="totalesT">
											<div class="totalesTD totalesTD1 totalesTD1Presu">I.V.A.</div>
											<div class="totalesTD totalesTD2">{{$desgloseCesta->iva1}}&euro;</div>
										</div>
									@endif

									@if($desgloseCesta->iva3>0)
										<div class="totalesT">
											<div class="totalesTD totalesTD1 totalesTD1Presu">I.V.A.</div>
											<div class="totalesTD totalesTD2" >{{$desgloseCesta->iva3}}&euro;</div>
										</div>
									@endif

									@if($desgloseCesta->iva4>0)
										<div class="totalesT">
											<div class="totalesTD totalesTD1 totalesTD1Presu">I.V.A.</div>
											<div class="totalesTD totalesTD2">{{$desgloseCesta->iva4}}&euro;</div>
										</div>
									@endif

									@if($desgloseCesta->iva5>0)
										<div class="totalesT">
											<div class="totalesTD totalesTD1 totalesTD1Presu">I.V.A.</div>
											<div class="totalesTD totalesTD2">{{$desgloseCesta->iva5}}&euro;</div>
										</div>
									@endif

									<div class="sepwidth2"></div>

									<div class="totalesT totalesTT">
										<div class="totalesTD totalesTD1 totalesTT1 totalesTD1Presu">Total</div>
										<div class="totalesTD totalesTD2 totalesTT2" id="cesta_edit_total" valor="{{$desgloseCesta->granTotal}}">{{$desgloseCesta->granTotal}}&euro;</div>
									</div>

								</div>

								@if (!$presuGenerado)
									<div class="cestaContTotalesTD cestaContTotales1 table_cesta_pc">
										<a href="{{URL::to('emptyBasket')}}" title="{{T::tr('Vaciar cesta')}}" class="cesta_vaciar" style="width: 259px; margin-top: 45px">Vaciar presupuesto</a>
										<a href="/xweb/" class="cesta_vaciar cesta_vaciar2" style="width: 259px; text-align: center;">Seguir navegando</a>
									</div>
									<div class="celdaAniadir" style="width: 260px; margin-left: 71px; margin-top: 25px; background-size: 358px;">
										@if($desgloseCesta->formaPago==0 || session('usuario')->uData->codigo==0)
											<a href="#" role="button" disabled title="{{T::tr('Finalizar pedido')}}">{{T::tr('Finalizar pedido')}}</a>
										@endif
										@if($desgloseCesta->formaPago>0 && session('usuario')->uData->codigo>0)
											<div id="cesta_finalizar">
												<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
												<input type="hidden" name="articulos" value="<?php echo  base64_encode(serialize($articulos)); ?>" />
												<input type="submit" value="{{T::tr('Generar presupuesto')}}" />
											</div>
										@endif
									</div>
								</div>
								@endif

						</div>
					</div>
				</form>

			</div>
		</div>
	@endif
@endif






<div class="" style="margin-top: 10px;">
</div>


	{{--resumen--}}
	{{--envio--}}




@if(isset(session('entorno')->config->x_pedirplazo))
@if(session('entorno')->config->x_pedirplazo)
	Seleccione si desea un plazo de entrega: 
	<div class="panel-body">
		<form method="post" action="" id="horario">
			<input name="elplazo" id="datetimepicker2" type="text"
				style="margin-top: 10px; width: auto;"
				class="form-control input-normal" readonly="readonly"
				value="{{$desgloseCesta->plazoEntrega}}"
				placeholder="Seleccione una fecha"
				onchange="cambiarDesgloseCesta('{{URL::to('cambiarDesgloseCesta')}}','plazo',this.value);" />
		</form>
	</div>
	<script>
		$(document).ready(function() {
			$('#datetimepicker2').datetimepicker({
				dayOfWeekStart : 1,
				lang:'es',
				format:'d/m/Y',
				timepicker:false,
				onClose:function(ct,$input){
					return;
				}
			});

	</script>
@endif
@endif


@if ($presuGenerado)
	<script type="text/javascript">
		$.ajax({
	      url: '/xweb/emptyBasket',
	      type: 'get',
	      contentType: false,
	      processData: false,
	      success: function(response) {
	      }
	  });
	</script>
@endif


<script type="text/javascript">

var popupOcultado = true;

if (window.history.replaceState) { // verificamos disponibilidad
    window.history.replaceState(null, null, window.location.href);
}


function hoverImg(element) 
{ 
    element.setAttribute('src', 'public/images/rma_elim1.png'); 
}

function unHoverImg(element) 
{ 
    element.setAttribute('src', 'public/images/rma_elim0.png'); 
}


		$(document).ready(function() {
				$(".numformato_precio").on({
				    "focus": function (event) {
				        $(event.target).select();
				    },
				    /*"change": function (event) {
				        $(event.target).val(function (index, value ) {
				            return value.replace(/\D/g, "")
				                        .replace(/([0-9])([0-9]{2})$/, '$1,$2')
				                        .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");
				        });
				    },*/
				    "change": function (event) {
				    	var valor = $(event.target).val();
				    	valor = Number(valor).toFixed(2);
				    	$(event.target).attr("valor",valor);
				    	
				    	// Calcular el margen
					    	var pvd = $(event.target).attr("pvd");
					    	var referencia = $(event.target).attr("referencia");
					    	var diferencia = valor - pvd;
					    	var margen = diferencia * 100 / pvd;
					    	margen = Math.round(margen);
					    	
					    // Mostrar margen en el campo
					    	document.getElementById("txt_margen_" + referencia).value = margen;
				    	
				    	// Actualizar totales
					    	pvpActualizarTotales();
				    }
				});

				$(".numformato_margen").on({
				    "focus": function (event) {
				        $(event.target).select();
				    },
				    "change": function (event) {
				    	var margen = $(event.target).val();

				        $(event.target).val(function (index, value ) {
				            return value.replace(/\D/g, "")
				                        .replace(/([0-9])([0-9]{2})$/, '$1,$2')
				                        .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");
				        });
				   

				    	// Calcular el precio UD
					    	var pvd = $(event.target).attr("pvd");
					    	pvd = pvd * 1;
					    	var referencia = $(event.target).attr("referencia");
					    	var precioUd = pvd + ( pvd * margen / 100 );		
				    		precioUd = Number(precioUd).toFixed(2);
				    		
					    	
					    // Mostrar precio UD en el campo
					    	//document.getElementById("txt_precio_" + referencia).value = precioUd;
					    	var campoPrecioUd = document.getElementById("txt_precio_" + referencia);
					    	campoPrecioUd.value = precioUd;
					    	campoPrecioUd.setAttribute("valor", precioUd);


				    	// Actualizar totales
					    	pvpActualizarTotales();
					  }
				});
		});


		function pvpActualizarTotales()
		{
				var suma = 0;

				// Recorrer cada línea
					var txtPrecios = document.getElementsByClassName("numformato_precio");
					var i = 0;				

					for (var i=0; i < txtPrecios.length; i++)
					{
							var acodar = txtPrecios[i].getAttribute("referencia");
							var precioUd = txtPrecios[i].getAttribute("valor");
							var cantidad = document.querySelector("[namealt=canti_" + acodar + "]").value;

							precioUd = Number(precioUd).toFixed(2);

							var precioLinea = precioUd * cantidad;
							precioLinea = Number(precioLinea).toFixed(2);

							var spanTotalLinea = document.getElementById("total_linea_" + acodar);
							spanTotalLinea.setAttribute("valor", precioLinea);
							spanTotalLinea.innerHTML = precioLinea;

							suma += Number(precioLinea);
							
					  	//console.log("acodar: " + acodar + " precioUd: " + precioUd + " cantidad: " + cantidad + " precioLinea: " + precioLinea);
					}


					suma = Number(suma).toFixed(2);

		   // Actualizar los totales
					// Suma
						//var suma = suma.toFixed(2);
						var spanSuma = document.getElementById("sumaPrecioArticulos");
						spanSuma.setAttribute("valor", suma);
						spanSuma.innerHTML = suma;

					// IVA
						var totalIva = suma * 0.21;
						totalIva = Number(totalIva).toFixed(2);
						var spanIVA = document.getElementById("cesta_edit_iva");
						spanIVA.setAttribute("valor", totalIva);
						spanIVA.innerHTML = totalIva;


					// Total
						var totalPresupuesto = Number(suma) + Number(totalIva); 
						totalPresupuesto = Number(totalPresupuesto).toFixed(2);
						var spanTotal = document.getElementById("cesta_edit_total");
						spanTotal.setAttribute("valor", totalPresupuesto);
						spanTotal.innerHTML = totalPresupuesto;


						//console.log("suma: " + suma + " totalIva: " + totalIva + " totalPresupuesto: " + totalPresupuesto);
		}
</script>

	{{--finalizar--}}
@if(isset(session("entorno")->config->x_txtlegal))
	<div class="col-xs-12 col-md-12 text-left" style="margin:15px;">
		<h5>{!!session("entorno")->config->x_txtlegal!!}</h5>
	</div>
@endif

@endsection






