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

/*var_dump(session("entorno")->desgloseCesta);
echo '**************************************';
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

<div id="anadirDireccionUsuario" class="anadirDireccionUsuario">
	<div class="anadirDireccionUsuario-content">
		<span class="closeAnadirDireccionUsuario" id="closeAnadirDireccionUsuario" onclick="ocultarAgregarDireccion()">&times;</span>
		<div class="anadirDireccionUsuario-content1">
			<?php
			$contadorDatosCC = 0;
			?>
			@foreach($datosCC2 as $sb)
				@if ($contadorDatosCC == 0)
					<div class="div_direccion_editar">
						<h3 style="float:left; display: contents;">
							<div style="width: 630px; margin: auto; margin-bottom: 60px;">
								<div class="pfacturas2 divpresupu" style="font-size: 16pt; font-family:'gothamultra'; text-transform: uppercase;">{{T::tr('Nueva dirección de envío')}}</div>
							</div>
						</h3>
						<h6>
							<form class="formRegistro" role="form" method="post" action="{{URL::to('micuenta/centrosmodificar')}}" id="formModif{{$ultCentro}}" name="formModif{{$ultCentro}}" onsubmit="return centroComprobar();">
								<input type="hidden" id="_token" name="_token" value="{{{ csrf_token() }}}" />
								<input type="hidden" name="id" value="{{$ultCentro}}" />
								<input type="hidden" name="pagina" value="cesta" />
								<table align="center" class="tcontacto2" style="text-align: left;">
									<tr>
										<td style="min-width: 130px;">{{T::tr('Nombre')}}</td>
										<td>
											<input type="text" value="" maxlength="50" name="nombreCliente" id="nombreCliente" placeholder="{{T::tr('Mínimo 15 caracteres')}}" />
										</td>
									</tr>
									<tr>
										<td>{{T::tr('Dirección')}}</td>
										<td>
											<input type="text" value="" maxlength="50" name="direccion" id="direccion" placeholder="({{T::tr('Calle, Plaza, etc.')}})" />
										</td>
									</tr>
									<tr>
										<td>{{T::tr('Población')}}</td>
										<td>
											<input type="text" value="" maxlength="40" name="poblacion" id="poblacion" placeholder="" />
										</td>
									</tr>
									<tr>
										<td>{{T::tr('Código Postal')}}</td>
										<td>
											<input type="text" value="" maxlength="8" name="codigoPostal" id="codigoPostal" placeholder=""  />
										</td>
									</tr>
									<tr>
										<td>{{T::tr('Provincia:')}}</td>
										<td>
											<select class="form-control autoWidth" name="provincia" id="provincia" >
												<option value="-1">{{T::tr('Provincia')}}</option>
												@foreach(Utils::matrizProvincias() as $mar)
													<option value="{{$mar['id']}}" {!!strtoupper($sb->ZPAIS)==$mar['nombre']?"selected":''!!}>{{$mar['nombre']}}</option>
												@endforeach
											</select>
										</td>
									</tr>
									<tr>
										<td>{{T::tr('Teléfono:')}}</td>
										<td>
											<input type="text" value="" maxlength="20" name="telefono" id="telefono" placeholder=""  />
										</td>
									</tr>
									<tr>
										<td>{{T::tr('Observaciones')}}</td>
										<td>
											<textarea class="form-control" rows="5" name="observaciones" style="resize: none;"></textarea>
										</td>
									</tr>
									<tr>
										<td></td>
										<td>
											<button type="submit" name="submit" value="submit"  class="btnSolicitarMayor" style="float: right; margin-top: 10px;">Guardar cambios</button>
										</td>
									</tr>
								</table>
							</form>
						</h6>
					</div>
				@endif
				<?php
				$contadorDatosCC += 1;
				?>
			@endforeach
		</div>
	</div>
</div>

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
				<div class="ces_vaciaTd ces_vacia1">Tu cesta de la compra está vacía en este momento :(</div>
				<div class="ces_vaciaTd ces_vacia2">
					<div class="cesV2">Sigue comprando y disfrutando de:</div>
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
					<div class="cesta_titulo1">Cesta</div>
					<div></div>
				</div>

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
													<div class="fichaCant1" onclick="modifyArticulo('{{$bces->acodar}}', '/xweb/modifyArticulo', 0, {{$var}}); location.reload();">
														<span id="ficha_menos">-</span>
													</div>
												@else
													<div class="fichaCant1" style="visibility: hidden;">
														<span id="ficha_menos">-</span>
													</div>
												@endif
												
												<div class="fichaCant2">
													<input type="text" name="canti" class="ficha_cant" id="cantiArti{{$var}}" value="{{Utils::numFormat($bces->cantiCesta,2, '.', '', true)}}" onchange="document.getElementById('forme{{$var}}').submit();" />
												</div>

												@if (!$bces->tieneAmpliacion && !$bces->esAmpliacion)
													<!-- // *** CAMBIAR *** // 
													<div class="fichaCant3" onclick="modifyArticulo('{{$bces->acodar}}', 'diginova.es/modifyArticulo', 1, {{$var}}); location.reload();">
														<span id="ficha_mas">+</span>
													</div>
												  -->
													<div class="fichaCant3" onclick="modifyArticulo('{{$bces->acodar}}', '/xweb/modifyArticulo', 1, {{$var}}); location.reload();">
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
					$sumaPrecioArticulos = $desgloseCesta->sumaPrecioArticulos
					?>
			
					<div class="totalesT">
						<div class="totalesTD totalesTD1">Suma</div>
						<div class="totalesTD totalesTD2">{{Utils::numFormat($sumaPrecioArticulos)}}&euro;</div>
					</div>

					<div class="totalesT">
						<div class="totalesTD totalesTD1">Portes</div>
						<div class="totalesTD totalesTD2" id="cesta_edit_portes_mv">{{Utils::numFormat($importePorte)}}&euro;</div>
					</div>


					@if($desgloseCesta->recargosCargos > 0)
						<div class="totalesT">
							<div class="totalesTD totalesTD1">Recargo F. Pago</div>
							<div class="totalesTD totalesTD2">{{Utils::numFormat($desgloseCesta->recargosCargos)}}&euro;</div>
						</div>
					@endif

					@if($desgloseCesta->recargosFormaEnvio > 0)
						<div class="totalesT">
							<div class="totalesTD totalesTD1">Transporte (provis.)</div>
							<div class="totalesTD totalesTD2">{{Utils::numFormat($desgloseCesta->recargosFormaEnvio)}}&euro;</div>
						</div>
					@endif

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

					@if($desgloseCesta->rec2>0)
						<div class="totalesT">
							<div class="totalesTD totalesTD1">{{T::tr('Recargo Equiv.')}}</div>
							<div class="totalesTD totalesTD2" id="cesta_edit_rec_mv">{{Utils::numFormat($desgloseCesta->rec2)}}&euro;</div>
						</div>
					@else
						<div class="totalesT" style="display: none">
							<div class="totalesTD totalesTD1"></div>
							<div class="totalesTD totalesTD2" id="cesta_edit_rec_mv"></div>
						</div>
					@endif

					@if($desgloseCesta->iva1>0)
						<div class="totalesT">
							<div class="totalesTD totalesTD1">I.V.A.</div>
							<div class="totalesTD totalesTD2">{{Utils::numFormat($desgloseCesta->iva1)}}&euro;</div>
						</div>
					@endif

					@if($desgloseCesta->rec1>0)
						<div class="totalesT">
							<div class="totalesTD totalesTD1">{{T::tr('Recargo Equiv.')}}</div>
							<div class="totalesTD totalesTD2">{{Utils::numFormat($desgloseCesta->rec1)}}&euro;</div>
						</div>
					@endif

					@if($desgloseCesta->iva3>0)
						<div class="totalesT">
							<div class="totalesTD totalesTD1">I.V.A.</div>
							<div class="totalesTD totalesTD2">{{Utils::numFormat($desgloseCesta->iva3)}}&euro;</div>
						</div>
					@endif

					@if($desgloseCesta->rec3>0)
						<div class="totalesT">
							<div class="totalesTD totalesTD1">{{T::tr('Recargo Equiv.')}}</div>
							<div class="totalesTD totalesTD2">{{Utils::numFormat($desgloseCesta->rec3)}}&euro;</div>
						</div>
					@endif

					@if($desgloseCesta->iva4>0)
						<div class="totalesT">
							<div class="totalesTD totalesTD1">I.V.A.</div>
							<div class="totalesTD totalesTD2">{{Utils::numFormat($desgloseCesta->iva4)}}&euro;</div>
						</div>
					@endif

					@if($desgloseCesta->rec4>0)
						<div class="totalesT">
							<div class="totalesTD totalesTD1">{{T::tr('Recargo Equiv.')}}</div>
							<div class="totalesTD totalesTD2">{{Utils::numFormat($desgloseCesta->rec4)}}&euro;</div>
						</div>
					@endif

					@if($desgloseCesta->iva5>0)
						<div class="totalesT">
							<div class="totalesTD totalesTD1">I.V.A.</div>
							<div class="totalesTD totalesTD2">{{Utils::numFormat($desgloseCesta->iva5)}}&euro;</div>
						</div>
					@endif

					@if($desgloseCesta->rec5>0)
						<div class="totalesT">
							<div class="totalesTD totalesTD1">{{T::tr('Recargo Equiv.')}}</div>
							<div class="totalesTD totalesTD2">{{Utils::numFormat($desgloseCesta->rec5)}}&euro;</div>
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
						<td class="cestaart3">Precio</td>
						<td class="cestaart4">Unidades</td>
						<td class="cestaart5">Total</td>
						<td class="cestaart6">&nbsp;</td>
					</tr>
				</table>
				<div class="sepwidth"></div>

				<table border="0" align="center" class="cestaTabla table_cesta_pc">
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
								<tr class="cestaart">
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
									<td class="cestaart3">{{Utils::numFormat(($preciosconiva?$bces->precioConIva:$bces->precioSinIva), $decprec)}}€</td>
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
													<div class="fichaCant1" onclick="modifyArticulo('{{$bces->acodar}}', '/xweb/modifyArticulo', 0, {{$var}}); location.reload();">
														<span id="ficha_menos">-</span>
													</div>
												@else
													<div class="fichaCant1" style="visibility: hidden;">
														<span id="ficha_menos">-</span>
													</div>
												@endif
												
												<div class="fichaCant2">
													<input type="text" name="canti" class="ficha_cant" id="cantiArti{{$var}}" value="{{Utils::numFormat($bces->cantiCesta,2, '.', '', true)}}" onchange="document.getElementById('forme{{$var}}').submit();" />
												</div>

												@if (!$bces->tieneAmpliacion && !$bces->esAmpliacion)
													<!-- // *** CAMBIAR *** // 
													<div class="fichaCant3" onclick="modifyArticulo('{{$bces->acodar}}', 'diginova.es/modifyArticulo', 1, {{$var}}); location.reload();">
														<span id="ficha_mas">+</span>
													</div>
												  -->
													<div class="fichaCant3" onclick="modifyArticulo('{{$bces->acodar}}', 'https://diginova.es/xweb/modifyArticulo', 1, {{$var}}); location.reload();">
														<span id="ficha_mas">+</span>
													</div>
												@else
													<div class="fichaCant1" style="visibility: hidden;">
														<span id="ficha_mas">-</span>
													</div>	
												@endif

											</form>
										</div>
									</td>
									<td class="cestaart5">{{Utils::numFormat(($preciosconiva?$bces->totalLinea*(($bces->porcentajeIva/100)+1):$bces->totalLinea))}}€</td>
									<td class="cestaart6">
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
									</td>
								</tr>
								<tr>
									<td colspan="6">
										<div class="sepwidth"></div>
									</td>
								</tr>
								<?php
								for ($i = 0; $i < count($bces->ampliacion); $i++) 
								{ 
									?>
									<tr class="cestaart">
										<td class="cestaart1"></td>
										<td class="cestaart2">
											<a href="/xweb/articulo/{{$bces->ampliacion[$i]}}">
												{{$bces->descrAmpliacion[$i]}}<br/>
												<span class="cestacod">Cód: <span>{{$bces->ampliacion[$i]}}</span></span>
											</a>
										</td>
										<td class="cestaart3">{{Utils::numFormat(($bces->precioAmpliacion[$i]), $decprec)}}€</td>
										<td class="ficha_cantidad cestaart4">
											<div class="ficha_cantidad1">
												<form id="forme{{$var}}" name="forme" method="post" action="" style="margin-bottom:0; float: right;">
													<div class="fichaCant1" style="visibility: hidden;">
														<span id="ficha_menos">-</span>
													</div>
													<div class="fichaCant2">
														<input type="text" name="canti" class="ficha_cant" id="cantiArti{{$var}}" value="{{$bces->cantAmpliacion[$i]}}" />
													</div>
													<div class="fichaCant1" style="visibility: hidden;">
														<span id="ficha_mas">-</span>
													</div>
												</form>
											</div>
										</td>
										<td class="cestaart5">{{Utils::numFormat(($bces->importeAmpliacion[$i]))}}€</td>
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
				<div class="cestaContTotales" style="padding-bottom: 0px;">
					<div class="cestaContTot" style="width: 1240px; display: flex">
						<div class="cestaContTotSecc" style="width: 958px; display: flex; flex-wrap: wrap;">
							<div class="divSeccionCestaMv" style="width: 188px; float: left; border-right: 1px solid #EBECED;">
								<div class="contFpago" style="padding-left: 0px;">
									<div class="fPagoTit">Forma de pago</div>
									<table style="width: 420px; display: block;">
										<tr>
											<td style="vertical-align: top;">
												<div style="display: block; width: 185px;">
													<?php
													$posTransferencia = 0;
													?>
													@foreach($formasPago as $bfor)
														@if ($bfor->wcod == 1)
															<!-- // *** CAMBIAR *** // 
															<div class="linkFPago formaPagoEnvio {{$desgloseCesta->formaPago==$bfor->wcod?' formaPagoEnvioSelected':''}}" onclick="selecFormasCesta('http://diginova.es/xweb/selecFormasCesta/pago/{{$bfor->wcod}}', this);">
																<input type="radio" name="forma_pago" {{$desgloseCesta->formaPago==$bfor->wcod?' checked':''}}>
																<b>
																	<span class="nomFPago{{$desgloseCesta->formaPago==$bfor->wcod?' formaPagoEnvioSelected':''}}" onmouseover="mostrarPopupTransferencia()" onmouseout="ocultarPopupTransferencia()">Transferencia</span>
																</b>
															</div>
														  -->
															<div class="linkFPago formaPagoEnvio {{$desgloseCesta->formaPago==$bfor->wcod?' formaPagoEnvioSelected':''}}" onclick="selecFormasCesta('/xweb/selecFormasCesta/pago/{{$bfor->wcod}}', this);">
																<input type="radio" name="forma_pago" {{$desgloseCesta->formaPago==$bfor->wcod?' checked':''}}>
																<b>
																	<span class="nomFPago{{$desgloseCesta->formaPago==$bfor->wcod?' formaPagoEnvioSelected':''}}" onmouseover="mostrarPopupTransferencia()" onmouseout="ocultarPopupTransferencia()">Transferencia</span>
																</b>
															</div>
															<?php 
															$topTriangTransferencia = 5 + ($posTransferencia * 31);
															$topCajaTransferencia = -25 + ($posTransferencia * 31);
															?>
														@elseif ($bfor->wcod == 7)
															@if ($formapago != 14 && $formapago != 21)
																<!-- // *** CAMBIAR *** // 
																<div class="linkFPago formaPagoEnvio {{$desgloseCesta->formaPago==$bfor->wcod?' formaPagoEnvioSelected':''}}" onclick="selecFormasCesta('http://diginova.es/xweb/selecFormasCesta/pago/{{$bfor->wcod}}', this);">
																	<input type="radio" name="forma_pago" {{$desgloseCesta->formaPago==$bfor->wcod?' checked':''}}>
																	<b>
																		<span class="nomFPago{{$desgloseCesta->formaPago==$bfor->wcod?' formaPagoEnvioSelected':''}}" style="display: inline-block;">{{$nomFormaPago}}</span>
																	</b>
																</div>
															  -->
																<div class="linkFPago formaPagoEnvio {{$desgloseCesta->formaPago==$bfor->wcod?' formaPagoEnvioSelected':''}}" onclick="selecFormasCesta('/xweb/selecFormasCesta/pago/{{$bfor->wcod}}', this);">
																	<input type="radio" name="forma_pago" {{$desgloseCesta->formaPago==$bfor->wcod?' checked':''}}>
																	<b>
																		<span class="nomFPago{{$desgloseCesta->formaPago==$bfor->wcod?' formaPagoEnvioSelected':''}}" style="display: inline-block;">{{$nomFormaPago}}</span>
																	</b>
																</div>
																<?php
																$posTransferencia += 1;
																?>
															@endif
														@elseif ($bfor->wcod == 3)
															<!-- // *** CAMBIAR *** // 
																<div class="linkFPago formaPagoEnvio {{$desgloseCesta->formaPago==$bfor->wcod?' formaPagoEnvioSelected':''}}" onclick="selecFormasCesta('http://diginova.es/xweb/selecFormasCesta/pago/{{$bfor->wcod}}', this);">
																<input type="radio" name="forma_pago" {{$desgloseCesta->formaPago==$bfor->wcod?' checked':''}}>
																<b>
																	<span class="nomFPago{{$desgloseCesta->formaPago==$bfor->wcod?' formaPagoEnvioSelected':''}}" style="display: inline-block;">Tarjeta de crédito</span>
																</b>
															</div>
															-->
															<div class="linkFPago formaPagoEnvio {{$desgloseCesta->formaPago==$bfor->wcod?' formaPagoEnvioSelected':''}}" onclick="selecFormasCesta('/xweb/selecFormasCesta/pago/{{$bfor->wcod}}', this);">
																<input type="radio" name="forma_pago" {{$desgloseCesta->formaPago==$bfor->wcod?' checked':''}}>
																<b>
																	<span class="nomFPago{{$desgloseCesta->formaPago==$bfor->wcod?' formaPagoEnvioSelected':''}}" style="display: inline-block;">Tarjeta de crédito</span>
																</b>
															</div>
															<?php
															$posTransferencia += 1;
															?>
														@else
															<!-- // *** CAMBIAR *** // 
																<div class="linkFPago formaPagoEnvio {{$desgloseCesta->formaPago==$bfor->wcod?' formaPagoEnvioSelected':''}}" onclick="selecFormasCesta('http://diginova.es/xweb/selecFormasCesta/pago/{{$bfor->wcod}}', this);">
																<input type="radio" name="forma_pago" {{$desgloseCesta->formaPago==$bfor->wcod?' checked':''}}>
																<b>
																	<span class="nomFPago{{$desgloseCesta->formaPago==$bfor->wcod?' formaPagoEnvioSelected':''}}" style="display: inline-block;">{{$bfor->wtit}}{{$bfor->wcod!==7?"":":
																	".session('usuario')->uData->formapago_nombre}}</span>
																</b>
															</div>
															-->
															<div class="linkFPago formaPagoEnvio {{$desgloseCesta->formaPago==$bfor->wcod?' formaPagoEnvioSelected':''}}" onclick="selecFormasCesta('/xweb/selecFormasCesta/pago/{{$bfor->wcod}}', this);">
																<input type="radio" name="forma_pago" {{$desgloseCesta->formaPago==$bfor->wcod?' checked':''}}>
																<b>
																	<span class="nomFPago{{$desgloseCesta->formaPago==$bfor->wcod?' formaPagoEnvioSelected':''}}" style="display: inline-block;">{{$bfor->wtit}}{{$bfor->wcod!==7?"":":
																	".session('usuario')->uData->formapago_nombre}}</span>
																</b>
															</div>
															<?php
															$posTransferencia += 1;
															?>
														@endif
													@endforeach
												</div>
											</td>
											<td style="display: flex;">
												<div class="popuptext cestaAviso1 popupTransferencia hidepopup trianguloTransferencia" style="margin-top: <?php echo $topTriangTransferencia ?>px; margin-left: -8px;"></div>
												<div class="popuptext cestaAviso1 popupTransferencia hidepopup" style="float: left; margin-left: -75px; margin-top: <?php echo $topCajaTransferencia ?>px; margin-left: -14px; font-size: 11pt;">
														<div style="font-family: montserratextrabold;"><b>Atención - Pagos por Transferencia</b></div>
														<div>No realice ningún pago hasta recibir la factura proforma en su email.</div>
												</div>
											</td>
										</tr>
									</table>
								</div>
							</div>

							<div class="divSeccionCestaMv" style="width: 445px; float: left; border-right: 1px solid #EBECED;">
								<div class="contFpago">

									<div style="vertical-align: middle; display: table; width: 100%;">
										<div class="fPagoTit" style="vertical-align: middle; display: table-cell; padding-bottom: 0;">Dirección de envío</div>
										<div style="vertical-align: bottom; display: table-cell;">
											<a onclick="pulsarAgregarDireccion()" class="a_anadir_direccion linkFPago formaPagoEnvio" style="color: rgb(203 7 54); font-family: montserratbold; cursor: pointer; padding: 0px 0px 1px 0px !important;">
												<span class='glyphicon glyphicon-plus' title="{{T::tr('Agregar nueva')}}"></span>&nbsp;{{T::tr('Agregar nueva')}}
											</a>
										</div>
									</div>

									<div style="margin: 0 auto; margin-top: 5px; width: 425px;">

										<select id="select_direccion_envio" class="linkFPago formaPagoEnvio" oninput="selecFormasCesta('{{URL::to('selecFormasCesta/centro')}}' + '/' + this.value, this); " style="width: 405px;border-radius: 0px;">
											<option class="formaPagoEnvio" value="-1">
												-- Seleccione una dirección de envío para su pedido --
											</option>
											@foreach($centrosCliente as $bfor)
												@if ($bfor->ZNOM != '' && $bfor->ZDESACT == 'N')
													<option class="formaPagoEnvio" value="{{$bfor->ZCEN}}">{{$bfor->ZNOM}}
														@if ($bfor->ZDOM != '')
															- {{$bfor->ZDOM}}
															@if ($bfor->ZCODPO != '')
																, {{$bfor->ZCODPO}}
															@endif
															@if ($bfor->ZPOB != '')
																, {{$bfor->ZPOB}}
															@endif
														@endif
													</option>
												@endif
											@endforeach
										</select>

										</div>

										<div id="contAgenciaTransporte" style="">	
											


										</div>

									
								</div>
							</div>

							<div class="divSeccionCestaMv" style="width: 303px; float: left; ">
								<div class="contFpago" style="padding-right: 20px;">
									<div class="fPagoTit">Observaciones</div>
									<form action="{{URL::to('cesta/4')}}" method="post" enctype="multipart/form-data" style="margin-bottom: 0;">
										<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
										<div>
											<textarea cols="47" rows="5" name="cConsulta" id="cConsulta" placeholder="&iquest;Algo que debamos tener en cuenta?" style="border: none; border-bottom: 1px solid black; width: 308px; margin-top: 10px; resize: none;"
												onblur="cambiarDesgloseCesta('{{URL::to('cambiarDesgloseCesta')}}','notas',this.value);">{{$desgloseCesta->anotaciones}}
											</textarea>
											<br />
										</div>
										<div class='xw_boxmicuenta_salto' style='min-height: 5px;width:100%;'></div>
									</form>
								</div>
							</div>



							<div>
								<?php
									/*echo "<br /><br />============<br /><br />";
									var_dump(session("entorno")->desgloseCesta);
									echo "<br /><br />============<br /><br />";*/
								?>
							</div>



							<div class="contFpago divSeccionCestaMv" style=" margin-top: 55px; padding-left: 0px;">
								<div class="fPagoTit">Términos y condiciones</div>
								<div style="margin: 5px 0px 0px; width: 1100px;">
									<input type="checkbox" id="acepto" onclick="">
									<span>
										{{T::tr('He leído y acepto los ')}}<a href="/xweb/nosotros/terminosycondiciones" target="_blank" style="color: rgb(203 7 54);">Condiciones de compra</a>, así como las <a href="/xweb/nosotros/enviosyportes" target="_blank" style="color: rgb(203 7 54);">CONDICIONES DE ENVÍO Y DEVOLUCIÓN</a>
									</span>
								</div>
							</div>
							<div class="sepwidth3"></div>

							<div class="cestaTextos" style="margin-top: 10px;">
								<div class="cestaAviso1">
									<img src="/xweb/public/images/cesalerta.png" />&nbsp;&nbsp;
									<div class="cestaAviso1Text">Aconsejamos realizar su pedido cuanto antes. Los art&iacute;culos almacenados en la cesta no se reservan.</div>
								</div>

								<div class="cestaAviso1" style="background-size: 732px 83px;">
									<img src="/xweb/public/images/camion.png" style="width: 32px" />&nbsp;&nbsp;
									<div class="cestaAviso1Text">
										<b>Portes de ocasión</b> (ordenadores, portátiles, monitores y otros): <br />
										<ul class="cestaUl"> 
											<li>1 equipo: 7,90&euro;</li>
											<li>Por cada equipo adicional: 2&euro;</li>
										</ul>
									</div>
								</div>
							</div>
						</div>

						<div>
							<div class="cestaContTotalesTD cestaContTotales2 table_cesta_pc">
								<?php
								//$sumaPrecioArticulos = $desgloseCesta->sumaPrecioArticulos - $importePorte;
								$sumaPrecioArticulos = $desgloseCesta->sumaPrecioArticulos
								?>
						
								<div class="totalesT">
									<div class="totalesTD totalesTD1">Suma</div>
									<div class="totalesTD totalesTD2">{{Utils::numFormat($sumaPrecioArticulos)}}&euro;</div>
								</div>

								<div class="totalesT">
									<div class="totalesTD totalesTD1">Portes</div>
									<div class="totalesTD totalesTD2" id="cesta_edit_portes">{{Utils::numFormat($importePorte)}}&euro;</div>
								</div>


								@if($desgloseCesta->recargosCargos > 0)
									<div class="totalesT">
										<div class="totalesTD totalesTD1">Recargo F. Pago</div>
										<div class="totalesTD totalesTD2">{{Utils::numFormat($desgloseCesta->recargosCargos)}}&euro;</div>
									</div>
								@endif

								@if($desgloseCesta->recargosFormaEnvio > 0)
									<div class="totalesT">
										<div class="totalesTD totalesTD1">Transporte (provis.)</div>
										<div class="totalesTD totalesTD2">{{Utils::numFormat($desgloseCesta->recargosFormaEnvio)}}&euro;</div>
									</div>
								@endif

								@if($desgloseCesta->importeDescuentoCliente > 0)
									<div class="totalesT">
										<div class="totalesTD totalesTD1">Descuentos</div>
										<div class="totalesTD totalesTD2">{{Utils::numFormat($desgloseCesta->importeDescuentoCliente)}}&euro;</div>
									</div>
								@endif

								@if($desgloseCesta->iva2>0)
									<div class="totalesT">
										<div class="totalesTD totalesTD1">I.V.A.</div>
										<div class="totalesTD totalesTD2" id="cesta_edit_iva">{{Utils::numFormat($desgloseCesta->iva2)}}&euro;</div>
									</div>
								@endif

								@if($desgloseCesta->rec2>0)
									<div class="totalesT">
										<div class="totalesTD totalesTD1">{{T::tr('Recargo Equiv.')}}</div>
										<div class="totalesTD totalesTD2" id="cesta_edit_rec">{{Utils::numFormat($desgloseCesta->rec2)}}&euro;</div>
									</div>
								@else
									<div class="totalesT" style="display: none">
										<div class="totalesTD totalesTD1"></div>
										<div class="totalesTD totalesTD2" id="cesta_edit_rec"></div>
									</div>
								@endif

								@if($desgloseCesta->iva1>0)
									<div class="totalesT">
										<div class="totalesTD totalesTD1">I.V.A.</div>
										<div class="totalesTD totalesTD2">{{Utils::numFormat($desgloseCesta->iva1)}}&euro;</div>
									</div>
								@endif

								@if($desgloseCesta->rec1>0)
									<div class="totalesT">
										<div class="totalesTD totalesTD1">{{T::tr('Recargo Equiv.')}}</div>
										<div class="totalesTD totalesTD2">{{Utils::numFormat($desgloseCesta->rec1)}}&euro;</div>
									</div>
								@endif

								@if($desgloseCesta->iva3>0)
									<div class="totalesT">
										<div class="totalesTD totalesTD1">I.V.A.</div>
										<div class="totalesTD totalesTD2">{{Utils::numFormat($desgloseCesta->iva3)}}&euro;</div>
									</div>
								@endif

								@if($desgloseCesta->rec3>0)
									<div class="totalesT">
										<div class="totalesTD totalesTD1">{{T::tr('Recargo Equiv.')}}</div>
										<div class="totalesTD totalesTD2">{{Utils::numFormat($desgloseCesta->rec3)}}&euro;</div>
									</div>
								@endif

								@if($desgloseCesta->iva4>0)
									<div class="totalesT">
										<div class="totalesTD totalesTD1">I.V.A.</div>
										<div class="totalesTD totalesTD2">{{Utils::numFormat($desgloseCesta->iva4)}}&euro;</div>
									</div>
								@endif

								@if($desgloseCesta->rec4>0)
									<div class="totalesT">
										<div class="totalesTD totalesTD1">{{T::tr('Recargo Equiv.')}}</div>
										<div class="totalesTD totalesTD2">{{Utils::numFormat($desgloseCesta->rec4)}}&euro;</div>
									</div>
								@endif

								@if($desgloseCesta->iva5>0)
									<div class="totalesT">
										<div class="totalesTD totalesTD1">I.V.A.</div>
										<div class="totalesTD totalesTD2">{{Utils::numFormat($desgloseCesta->iva5)}}&euro;</div>
									</div>
								@endif

								@if($desgloseCesta->rec5>0)
									<div class="totalesT">
										<div class="totalesTD totalesTD1">{{T::tr('Recargo Equiv.')}}</div>
										<div class="totalesTD totalesTD2">{{Utils::numFormat($desgloseCesta->rec5)}}&euro;</div>
									</div>
								@endif

								<div class="sepwidth2"></div>

								<div class="totalesT totalesTT">
									<div class="totalesTD totalesTD1 totalesTT1">Total</div>
									<div class="totalesTD totalesTD2 totalesTT2" id="cesta_edit_total">{{Utils::numFormat($desgloseCesta->granTotal)}}&euro;</div>
								</div>

							</div>

							<div class="cestaContTotalesTD cestaContTotales1 table_cesta_pc">
								<a href="{{URL::to('emptyBasket')}}" title="{{T::tr('Vaciar cesta')}}" class="cesta_vaciar" style="margin-top: 45px">Vaciar cesta</a>
								<a href="/xweb/" class="cesta_vaciar cesta_vaciar2">Seguir comprando</a>
							</div>
							<div class="celdaAniadir" style="width: 211px; margin-left: 71px; margin-top: 25px; background-size: 358px;">
								@if($desgloseCesta->formaPago==0 || session('usuario')->uData->codigo==0)
									<a href="#" role="button" disabled title="{{T::tr('Finalizar pedido')}}">{{T::tr('Finalizar pedido')}}</a>
								@endif
								@if($desgloseCesta->formaPago>0 && session('usuario')->uData->codigo>0)
									<!-- botón de finalizar la compra -->
									
									
									@if(1==1)
										<?php // si permite vender sin stock, además al finalizar la compra no comprueba si el material sigue disponible ?>
										<div id="cesta_finalizar">
											<a class="btn btn-success btn-lg" role="button" onclick="
												if ( ($('#select_direccion_envio').val() > -1) &&  ($('#select_agencia').val() > -1) )
												{
													if (finalizarPago())
													{
														var alfa;
														alfa=finalizarCompra('{{URL::to('finalizarCompra')}}');	// 1234													
														console.log(alfa);
														setTimeout( function(){ location.href = alfa; }, 1000); // 1234
													}
													//alert('OK');
												}
												else
												{
													alertify.alert('', 'Debe seleccionar la dirección de envío y la agencia de transporte antes de completar el pedido');
												}
												return false;
												" href="#">{{T::tr('Finalizar compra')}}
											</a>
										</div>
									@endif		
									@if(1==2)
										{{--no permite vender sin stock, al finalizar la compra comprueba si el material sigue disponible--}}
										<a  class="btn btn-success btn-lg" role="button" onclick="
											var alfa;
											alfa=finalizarCompraComprobacionStock('{{URL::to('finalizarCompraComprobacionStock')}}');
											if(alfa=='error'){
												return false;
											}
											if(alfa=='errorMail'){
												//alert('Se ha producido un error al enviar el correo de notificación del pedido, revise el listado de pedidos para confirmar que se ha realizado.');
												alertify.alert('','{{T::tr('Se ha producido un error al enviar el correo de notificación del pedido, revise el listado de pedidos para confirmar que se ha realizado')}}.');
												window.location.href='{{URL::to('micuenta/pedidos')}}';
												return false;
											}
											window.location.href=alfa;
											return false;
											" href="#">
											<span class="glyphicon glyphicon-check"></span> {{T::tr('Finalizar compra')}}
									</a>
									@endif



								@endif
							</div>
						</div>

					</div>
				</div>

				<input type="hidden" name="idAgencia" value="{{$idAgencia}}" />

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
		});
	</script>
@endif
@endif





<script type="text/javascript">
function centroComprobar()
{
	var todoOk = true; 
	var msjCentros = "Por favor, compruebe los siguientes campos:<br /><br />";

	if ( document.getElementById("nombreCliente").value.length < 15 ) { todoOk = false; msjCentros += "- El Nombre debe tener al menos 15 caracteres<br /><br />"; }
	if ( document.getElementById("direccion").value.trim().length == 0 )  { todoOk = false; msjCentros += "- Debe escribir una Dirección válida<br /><br />"; }
	if ( document.getElementById("poblacion").value.trim().length == 0 )  { todoOk = false; msjCentros += "- Debe escribir una Población válida<br /><br />"; }

	// El código postal debe, o bien, tener 5 dígitos, o bien, tener 8 dígitos, siengo uno de ellos un guión (para Portugal)
	if ( 
			(document.getElementById("codigoPostal").value.length != 5  )  &&  
			!( document.getElementById("codigoPostal").value.length == 8 && document.getElementById("codigoPostal").value.search("-") != -1  ) 
			)  

		{ todoOk = false; msjCentros += "- El Código Postal debe tener 5 dígitos<br /><br />"; }

	if ( document.getElementById("provincia").value == -1 ) { todoOk = false; msjCentros += "- Elija una Provincia correcta<br /><br />"; }
	if ( document.getElementById("telefono").value.trim().length == 0 )  { todoOk = false; msjCentros += "- Debe escribir un Teléfono válido<br /><br />"; }

	if ( !todoOk ) { alertify.alert("", msjCentros); }
	
	return todoOk;
}


function finalizarPago()
{
    if (document.getElementById("acepto").checked == false) 
    {
        alertify.alert("","Acepte las Condiciones de compra");
        return false;
    }
    else
    {
        //alertify.success('¡Su pedido se ha realizado con éxito! Recibirá un email con los detalles del pedido.');
        return true;
    }
}

var popupOcultado = true;

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


function hoverImg(element) 
{ 
    element.setAttribute('src', 'public/images/rma_elim1.png'); 
}

function unHoverImg(element) 
{ 
    element.setAttribute('src', 'public/images/rma_elim0.png'); 
}

function pulsarAgregarDireccion()
{
    $('.anadirDireccionUsuario').css('display', 'block');
    $('#div_nueva_direccion').css('display', 'block');
}

function ocultarAgregarDireccion()
{
    $('.anadirDireccionUsuario').css('display', 'none');
}



  $(document).ready(function() {


  	$('#select_direccion_envio').on('change', function() 
  	{ 
	      //Obtenemos el value del input
	      var service = $(this).val();  
	      
	      if (service == -1) 
      	{ 
      		$('#contAgenciaTransporte').html(""); 
      	}
	      else
	      {
	        //var dataString = 'textobusq='+service;
	        //var ccodcl = document.getElementById("codigoBusq").value; 

	        //Le pasamos el valor del input al ajax
	        $.ajax({
	          type: 'GET',
	          url: '/xweb/cesta_agencia/' + service,
	          beforeSend: function() {
	          },
	          success: function(response) 
	          {
	            //Escribimos las sugerencias que nos manda la consulta
	            $('#contAgenciaTransporte').html(response);
	          }
	        });
	      }


	      // Reiniciar subtotales
	      document.getElementById("cesta_edit_portes").innerHTML = "0,00&euro;";
	      document.getElementById("cesta_edit_portes_mv").innerHTML = "0,00&euro;";

		    document.getElementById("cesta_edit_iva").innerHTML = "{{Utils::numFormat($desgloseCesta->iva2)}}&euro;";
		    document.getElementById("cesta_edit_iva_mv").innerHTML = "{{Utils::numFormat($desgloseCesta->iva2)}}&euro;";

    		document.getElementById("cesta_edit_rec").innerHTML = "{{Utils::numFormat($desgloseCesta->rec2)}}&euro;";
    		document.getElementById("cesta_edit_rec_mv").innerHTML = "{{Utils::numFormat($desgloseCesta->rec2)}}&euro;";

    		document.getElementById("cesta_edit_total").innerHTML = "{{Utils::numFormat($desgloseCesta->granTotal)}}&euro;";
    		document.getElementById("cesta_edit_total_mv").innerHTML = "{{Utils::numFormat($desgloseCesta->granTotal)}}&euro;";
  	});





    /*$('#asd').keyup('input',function()
    {
      //Obtenemos el value del input
      var service = $(this).val();  

      setTimeout(function() 
      {
        if($('#textobusq').val() == service)
        {
          //var dataString = 'textobusq='+service;
          var ccodcl = document.getElementById("codigoBusq").value; 
          var tarifa = document.getElementById("tarifaBusq").value; 
          var tipocli = document.getElementById("tipocli").value;
          var conect = document.getElementById("usuario_conectado").value;

          //Le pasamos el valor del input al ajax
          $.ajax({
            type: 'GET',
            url: '/xweb/buscador/' + service,
            beforeSend: function() {
            },
            success: function(response) 
            {
              //Escribimos las sugerencias que nos manda la consulta
              $('#suggestionsBusq').slideDown().html(response);
            }
          });
        }
      }, 1500);
    }); */

  });
</script>

	{{--finalizar--}}
@if(isset(session("entorno")->config->x_txtlegal))
	<div class="col-xs-12 col-md-12 text-left" style="margin:15px;">
		<h5>{!!session("entorno")->config->x_txtlegal!!}</h5>
	</div>
@endif

@endsection






