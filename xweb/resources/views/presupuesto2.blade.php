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
					<div class="cesta_titulo1">Presupuesto</div>
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

				<table border="0" align="center" class="cestaTabla table_cesta_mv">
					<?php $var=0; ?>
					<?php 
					$importePorte = 0; ?>
					@foreach($articulos as $bces)
						@if (!$bces->esAmpliacion)
							<?php $var++; ?>
							<tr class="cestaart cestaartPrim">
								<td class="cestaart1">
										@if (!$bces->esAmpliacion)
											<img src="<?php echo $bces->urlfoto; ?>">
										@endif
								</td>
								<td class="cestaart2">
									<a href="/xweb/articulo/{{$bces->LCODAR}}">
										{{$bces->ADESCR}}<br/>
										<span class="cestacod">Cód: <span>{{$bces->LCODAR}}</span></span>
									</a>
								</td>
							</tr>
							<tr class="cestaart">
								<td class="cestaart1"></td>
								<td class="cestaart3">
									<div class="cestaart3TotalLinea">{{Utils::numFormat($bces->LIMPOR)}}€</div>
									<div class="cestaart3PorUnidad">Precio por unidad {{Utils::numFormat(($bces->LPRECI), $decprec)}}€</div>
								</td>
							</tr>
							<tr class="cestaart">
								<td class="cestaart1"></td>
								<td class="ficha_cantidad cestaart4">
									<div class="ficha_cantidad1">
										
										<div class="fichaCant2" style="float: left">
											<input type="text" name="canti" class="ficha_cant" id="cantiArti{{$var}}" value="{{Utils::numFormat($bces->LCANTI,2, '.', '', true)}}" />
										</div>

									</div>
									<div class="ficha_eliminar_art">
									</div>
								</td>
							</tr>
							@if ($bces->tieneAmpliacion)
								@foreach ($ampliaciones as $ampliacion)
									<tr class="cestaart cestaamplPrim">
										<td class="cestaart1"></td>
										<td class="cestaart2">
											<a href="/xweb/articulo/{{$ampliacion->ACODAR}}">
												{{$ampliacion->ADESCR}}<br/>
												<span class="cestacod">Cód: <span>{{$ampliacion->ACODAR}}</span></span>
											</a>
										</td>
									</tr>
									<tr class="cestaart cestaamplUlt">
										<td class="cestaart1"></td>
										<td class="cestaart3">
											<div class="cestaart3TotalLinea">{{Utils::numFormat(($ampliacion->AIMPOR), $decprec)}}€</div>
											<div class="cestaart3PorUnidad">Precio por unidad {{Utils::numFormat(($ampliacion->APRECI), $decprec)}}€</div>
										</td>
									</tr>
								@endforeach
							@endif
						@endif
					@endforeach
				</table>

				@foreach ($cabPresupuestos as $cabPresupuesto)
					<div class="cestaContTotalesTD cestaContTotales2 table_cesta_mv">
				
						<div class="totalesT">
							<div class="totalesTD totalesTD1">Suma</div>
							<div class="totalesTD totalesTD2">{{Utils::numFormat($cabPresupuesto->BSUMA)}}&euro;</div>
						</div>

						<div class="totalesT">
							<div class="totalesTD totalesTD1">I.V.A.</div>
							<div class="totalesTD totalesTD2" id="cesta_edit_iva_mv">{{Utils::numFormat($cabPresupuesto->BIVA)}}&euro;</div>
						</div>

						<div class="sepwidth2"></div>

						<div class="totalesT totalesTT">
							<div class="totalesTD totalesTD1 totalesTT1">Total</div>
							<div class="totalesTD totalesTD2 totalesTT2" id="cesta_edit_total_mv">{{Utils::numFormat($cabPresupuesto->BIMPOR)}}&euro;</div>
						</div>

					</div>
				@endforeach

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
						@if (!$bces->esAmpliacion)
							<?php $var++; ?>
							<tr class="cestaart">
								<td class="cestaart1">
										@if (!$bces->esAmpliacion)
											<img src="<?php echo $bces->urlfoto; ?>">
										@endif
								</td>
								<td class="cestaart2">
									<a href="/xweb/articulo/{{$bces->LCODAR}}">
										{{$bces->ADESCR}}<br/>
										<span class="cestacod">Cód: <span>{{$bces->LCODAR}}</span></span>
									</a>
								</td>
								@if ($presuGenerado)
									<td class="cestaart3">{{Utils::numFormat($bces->LPRECI)}}€</td>
								@else
									<td class="cestaart3">{{Utils::numFormat(($bces->LPRECI), $decprec)}}€</td>
								@endif
								<td class="ficha_cantidad cestaart4">
									<div class="ficha_cantidad1">
										@if ($presuGenerado)
											<div class="fichaCant2" style="float: right; padding-right: 40px;">{{Utils::numFormat($bces->LCANTI,2, '.', '', true)}}</div>
										@else
											
											<div class="fichaCant2" style="float: left" style="float: right; padding-right: 40px;">
												<input type="text" name="canti" class="ficha_cant" id="cantiArti{{$var}}" value="{{Utils::numFormat($bces->LCANTI,2, '.', '', true)}}" />
											</div>

										@endif
									</div>
								</td>
								@if ($presuGenerado)
									<td class="cestaart5">{{Utils::numFormat($bces->LIMPOR)}}€</td>
								@else
									<td class="cestaart5">{{Utils::numFormat(($bces->LIMPOR), $decprec)}}€</td>
								@endif
								<td class="cestaart6"></td>
							</tr>
							<tr>
								<td colspan="6">
									<div class="sepwidth"></div>
								</td>
							</tr>
							<!-- 1234 -->
							@foreach ($ampliaciones as $ampliacion)
								@if ($bces->LCODAR == $ampliacion->ACODAR)
									<tr class="cestaart">
										<td class="cestaart1"></td>
										<td class="cestaart2">
											<a href="/xweb/articulo/{{$ampliacion->ACODAR}}">
												{{$ampliacion->ADESCR}}<br/>
												<span class="cestacod">Cód: <span>{{$ampliacion->ACODAR}}</span></span>
											</a>
										</td>
										<td class="cestaart3">{{Utils::numFormat(($ampliacion->APRECI), $decprec)}}€</td>
										<td class="ficha_cantidad cestaart4">
											<div class="ficha_cantidad1">
												<div class="fichaCant2" style="float: right; padding-right: 40px;">{{$ampliacion->ACANTI}}</div>
											</div>
										</td>
										<td class="cestaart5">{{Utils::numFormat(($ampliacion->AIMPOR))}}€</td>
										<td class="cestaart6"></td>
									</tr>
									<tr>
										<td colspan="6">
											<div class="sepwidth"></div>
										</td>
									</tr>
								@endif
							@endforeach
						@endif
					@endforeach
				</table>
				<div class="sepwidth"></div>
				<form id="form_generar_presu" method="post" action="{{URL::to('generarpresupuesto')}}" style="margin: 0px;">
					<div class="cestaContTotales" style="padding-bottom: 0px;">
						<div class="cestaContTot" style="width: 1240px; display: flex; flex-flow: row-reverse;">

							@foreach ($cabPresupuestos as $cabPresupuesto)
								<div>
									<div class="cestaContTotalesTD cestaContTotales2 table_cesta_pc" style="width: 332px;">
								
										<div class="totalesT">
											<div class="totalesTD totalesTD1 totalesTD1Presu">Suma</div>
											<div class="totalesTD totalesTD2">{{$cabPresupuesto->BSUMA}}&euro;</div>
										</div>

										<div class="totalesT">
											<div class="totalesTD totalesTD1 totalesTD1Presu">I.V.A.</div>
											<div class="totalesTD totalesTD2" id="cesta_edit_iva">{{$cabPresupuesto->BIVA}}&euro;</div>
										</div>

										<div class="sepwidth2"></div>

										<div class="totalesT totalesTT">
											<div class="totalesTD totalesTD1 totalesTT1 totalesTD1Presu">Total</div>
											<div class="totalesTD totalesTD2 totalesTT2" id="cesta_edit_total">{{$cabPresupuesto->BIMPOR}}&euro;</div>
										</div>

									</div>
								</div>
							@endforeach

						</div>
					</div>
				</form>

			</div>
		</div>
	@endif
@endif

@endsection






