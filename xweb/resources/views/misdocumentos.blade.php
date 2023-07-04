@extends("base")

@section("titulo")
{{$tipo." ".$numero}}
@endsection

@section("dashboard")
@endsection

@section("central")
<form type="POST" id="farti">
	<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
</form>


<?php
	$bforpa = 0;

	foreach($datos -> documento as $dato)
	{
		$bforpa = $dato -> formapago;
	}
		
?>

<!-- rma -->
@if($tipo=="rma")
<?php
//var_dump($datos);
//return;
?>
<div class="row">
	<div class="col-xs-12 col-md-12 text-left">
		<h3>
		<i class="fa fa-book"></i> {{T::tr('Detalle del documento de RMA')}} {{$datos[0]->walba}}
		</h3>
		<table data-toggle="table" class="fondoblanco">
			<thead>
				<tr>
					<th>{{T::tr('Artículo')}}</th>
					<th>{{T::tr('Descripción')}}</th>
					<th>{{T::tr('Cnt.Devuelta')}}</th>
					<th>{{T::tr('Estado')}}</th>
				</tr>
			</thead>
			<tbody>
				@foreach($datos as $dato)
				<tr> 
					<td>
						<a href="{{strlen($dato->urlcodigo)>0?URL::to('producto/'.$dato->urlcodigo).'/'.Utils::urlenc($dato->descrip):''}}" title="{{$dato->xcodar}}">{{$dato->xcodar}}</a>
					</td>
					<td>
						{{$dato->descrip}}
					</td>
					<td class="text-right">{{Utils::numFormat($dato->xcanti,$deccan)}}</td>
					<td class="">@if($dato->numdocumentos>0) {{T::tr('Procesado')}} @else {{T::tr('Pendiente')}} @endif</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	<div class="col-xs-12 col-md-12 text-left">{{T::tr('Fecha del documento')}}:
		{{Utils::fechaEsp($datos[0]->wfecha)}}
	</div>
	<div class="col-xs-12 col-md-12 text-left">
		{{T::tr('Texto referencia cliente')}}:
		{{$datos[0]->wrefcli}}
	</div>
	<div class="col-xs-12 col-md-12 text-left">
		{{T::tr('Anotaciones')}}:
		{!!$datos[0]->wobse!!}
	</div>
	<div class="col-xs-12 col-md-12 text-left" style="margin-top:15px;">
		<a href="{{URL::to('documentos/rma_etiqueta/'.$datos[0]->walba)}}" target="_blank" title="{{T::tr('Imprimir etiqueta de envío')}}">
			<button type="" class="btn btn-lg btn-success" onclick="" style="float:left;">{{T::tr('Imprimir etiqueta de envío')}}</button>
		</a>
	</div>
</div>
@endif

<!-- presupuesto/pedido -->
@if($tipo=="presupuesto"||$tipo=="pedido"||$tipo=="albaran"||$tipo=="factura")

<div style="display: none;">
	<?php
		echo "test1:";
		var_dump($datos);
	?>
</div>


<div class="cesta_titulo" style="padding: 20px 0px; display: block; width: 1240px; margin: 0 auto;">

	@if ($tipo=="pedido")
		<div class="cesta_titulo1">Finalizar compra</div>
	@else
		<a href="/xweb/micuenta/pedidos" class="a_atras_mis_docu">
			<img src="/xweb/public/images/arrow-izq.png" />
		</a>
		<div class="cesta_titulo1" style="font-size: 18pt;">{{$tipo}} {{Utils::pedidoBarras($datos->numdocumento)}}</div>
	@endif
	
</div>

@if ($tipo=="pedido" && $mensaje == 0)
	<div class="finCompraT" style="display: block; width: 1240px; margin: 0 auto;">
		<div class="cesta_titulo1" style="color: green; font-size: 12pt; line-height: 25px;">¡Su pedido se ha realizado con éxito! Recibirá un email con los detalles del pedido.</div>
	</div>
@endif


<div id="cestapagina1" class="cestapagina1">

	<table border="0" align="center" class="cestaTabla cestaTabla1 table_cesta_mv">
		<?php 
		$var = 0;
		$importePortes = 0;
		?>
		@foreach($datos->documento as $bces)
			@if (!$bces->esAmpliacion || $bces->codigo == 'POG' || $bces->codigo == 'POA' || $bces->codigo == 'POV' || $bces->codigo == 'POGS' || $bces->codigo == 'POAS' || $bces->codigo == 'PO')
				@if ($bces->codigo == 'POG' || $bces->codigo == 'POA' || $bces->codigo == 'POV' || $bces->codigo == 'POGS' || $bces->codigo == 'POAS' || $bces->codigo == 'PO')
					<?php
						$importePortes += $bces->importe;
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
							<a href="/xweb/articulo/{{$bces->codigo}}">
								{{$bces->descrip}}<br/>
								<span class="cestacod">Cód: <span>{{$bces->codigo}}</span></span>
							</a>
						</td>
					</tr>
					<tr class="cestaart">
						<td class="cestaart1"></td>
						<td class="cestaart3">
							<div class="cestaart3TotalLinea">{{Utils::numFormat($bces->importe)}}€</div>
							<div class="cestaart3PorUnidad">Precio por unidad {{Utils::numFormat($bces->precio, $decprec)}}€</div>
							<div class="cestaart3Cant">
								<div>Unidades: </div>
								<div class="cestaart3CantUd">{{$bces->cantidad}}</div>
							</div>
						</td>
					</tr>
					<tr class="cestaart cestaartUlt">
						<td class="cestaart1"></td>
						<td class="cestaart3">
							<div class="cestaart3TotalLinea"></div>
							<div class="cestaart3PorUnidad"></div>
							<div class="cestaart3Cant">
								<div></div>
								<div></div>
							</div>
						</td>
					</tr>

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
								<div class="cestaart3Cant">
									<div>Unidades: </div>
									<div class="cestaart3CantUd">{{$bces->cantidad}}</div>
								</div>
							</td>
						</tr>
						<?php
					}
				?>
				@endif
			@endif
		@endforeach
	</table>




	
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
		<?php 
		$var = 0;
		$importePortes = 0;
		?>
		@foreach($datos->documento as $bces)
			@if (!$bces->esAmpliacion || $bces->codigo == 'POG' || $bces->codigo == 'POA' || $bces->codigo == 'POV' || $bces->codigo == 'POGS' || $bces->codigo == 'POAS' || $bces->codigo == 'PO')
				@if ($bces->codigo == 'POG' || $bces->codigo == 'POA' || $bces->codigo == 'POV' || $bces->codigo == 'POGS' || $bces->codigo == 'POAS' || $bces->codigo == 'PO')
					<?php
						$importePortes += $bces->importe;
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
							<a href="/xweb/articulo/{{$bces->codigo}}">
								{{$bces->descrip}}<br/>
								<span class="cestacod">Cód: <span>{{$bces->codigo}}</span></span>
							</a>
						</td>
						<td class="cestaart3">{{Utils::numFormat($bces->precio, $decprec)}}€</td>
						<td class="ficha_cantidad cestaart4">
							<div class="ficha_cantidad1" style="display: block; padding-right: 40px;">{{$bces->cantidad}}</div>
						</td>
						<td class="cestaart5">{{Utils::numFormat($bces->importe)}}€</td>
						<td class="cestaart6"></td>
					</tr>
					<tr>
						<td colspan="6">
							<div class="sepwidth"></div>
						</td>
					</tr>
					<?php
					/*var_dump($bces->ampliacion);
					var_dump('***************************');
					var_dump($bces->descrAmpliacion);
					var_dump('////////////////////////////');
					var_dump('</br>');*/
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
								<div class="ficha_cantidad1" style="display: block; padding-right: 40px;">{{$bces->cantAmpliacion[$i]}}</div>
							</td>
							<td class="cestaart5">{{Utils::numFormat(($bces->importeAmpliacion[$i]), $decprec)}}€</td>
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
	<div class="cestaContTotales" style="display: inline;">
		<div class="cestaContTotalesTD cestaContTotales1" style="display: block; float: left;">
			<a href="/xweb/" class="cesta_vaciar cesta_vaciar2" style="margin-left: 0px; margin-top: 38px;">Seguir comprando</a>
		</div>
		<div class="cestaContTotalesTD cestaContTotales1" style="display: block; float: left;">
			<a href="{{URL::to('/micuenta/pedidos')}}" class="cesta_vaciar cesta_vaciar2" style="margin-left: 0px; margin-top: 38px; padding-left: 5px; text-align: center;">Ver mis pedidos</a>
		</div>
		<div class="cestaContTotalesTD cestaContTotales2" style="float: right; width: 304px; margin-top: 25px;">

			<?php
			$sumaPrecioArticulos = $datos->sumalineas - $importePortes;
			$sumaTotalArticulos = $datos->sumalineas;
			$articulosYportes = $sumaTotalArticulos + $importePortes;
			//echo "<br />datosiva2: ".$datos->iva2."<br />";
			$iva2 = $datos->iva2; 
			//if ( $datos->iva2 != 0 ) { $iva2 = $articulosYportes * 0.21; }

			$rec2 = $datos->rec2;
			//if ( $datos->rec2 != 0 ) { $rec2 = $articulosYportes * 0.052; }

			//$total = $articulosYportes + $iva2 + $rec2;
			$total = $datos->totaldoc;

			?>

			<div class="totalesT">
				<div class="totalesTD totalesTD1 totalesTDCompra">{{T::tr('Suma')}}</div>
				<div class="totalesTD totalesTD2">{{Utils::numFormat($sumaPrecioArticulos)}}&euro;</div>
			</div>

			<div class="totalesT">
				<div class="totalesTD totalesTD1 totalesTDCompra">{{T::tr('Portes')}}</div>
				<div class="totalesTD totalesTD2">{{Utils::numFormat($importePortes)}}&euro;</div>
			</div>

			@if($datos->prcdtogeneral>0)
			<div class="totalesT">
				<div class="totalesTD totalesTD1 totalesTDCompra">{{T::tr('Descuento')}}
					({{Utils::numFormat($datos->prcdtogeneral)}}%)</div>
				<div class="totalesTD totalesTD2">{{Utils::numFormat($datos->dtogeneral)}}&euro;</div>
			</div>
			@endif @if($datos->iva2>0)
			<div class="totalesT">
				<div class="totalesTD totalesTD1 totalesTDCompra">{{T::tr('I.V.A.')}}
					({{Utils::numFormat($datos->tiva2)}}%)</div>
				<div class="totalesTD totalesTD2">{{Utils::numFormat($iva2)}}&euro;</div>
			</div>
			@endif @if($datos->rec2>0)
			<div class="totalesT">
				<div class="totalesTD totalesTD1 totalesTDCompra">{{T::tr('Recargo Equiv.')}}</div>
				<div class="totalesTD totalesTD2">{{Utils::numFormat($rec2)}}&euro;</div>
			</div>
			@endif @if($datos->iva1>0)
			<div class="totalesT">
				<div class="totalesTD totalesTD1 totalesTDCompra">{{T::tr('I.V.A.')}}
					({{Utils::numFormat($datos->tiva1)}}%)</div>
				<div class="totalesTD totalesTD2">{{Utils::numFormat($datos->iva1)}}&euro;</div>
			</div>
			@endif @if($datos->rec1>0)
			<div class="totalesT">
				<div class="totalesTD totalesTD1 totalesTDCompra">{{T::tr('Recargo Equiv.')}}</div>
				<div class="totalesTD totalesTD2">{{Utils::numFormat($datos->rec1)}}&euro;</div>
			</div>
			@endif @if($datos->iva3>0)
			<div class="totalesT">
				<div class="totalesTD totalesTD1 totalesTDCompra">{{T::tr('I.V.A.')}}
					({{Utils::numFormat($datos->tiva3)}}%)</div>
				<div class="totalesTD totalesTD2">{{Utils::numFormat($datos->iva3)}}&euro;</div>
			</div>
			@endif @if($datos->rec3>0)
			<div class="totalesT">
				<div class="totalesTD totalesTD1 totalesTDCompra">{{T::tr('Recargo Equiv.')}}</div>
				<div class="totalesTD totalesTD2">{{Utils::numFormat($datos->rec3)}}&euro;</div>
			</div>
			@endif @if($datos->iva4>0)
			<div class="totalesT">
				<div class="totalesTD totalesTD1 totalesTDCompra">{{T::tr('I.V.A.')}}
					({{Utils::numFormat($datos->tiva4)}}%)</div>
				<div class="totalesTD totalesTD2">{{Utils::numFormat($datos->iva4)}}&euro;</div>
			</div>
			@endif @if($datos->rec4>0)
			<div class="totalesT">
				<div class="totalesTD totalesTD1 totalesTDCompra">{{T::tr('Recargo Equiv.')}}</div>
				<div class="totalesTD totalesTD2">{{Utils::numFormat($datos->rec4)}}&euro;</div>
			</div>
			@endif @if($datos->iva5>0)
			<div class="totalesT">
				<div class="totalesTD totalesTD1 totalesTDCompra">{{T::tr('I.V.A.')}}
					({{Utils::numFormat($datos->tiva5)}}%)</div>
				<div class="totalesTD totalesTD2">{{Utils::numFormat($datos->iva5)}}&euro;</div>
			</div>
			@endif @if($datos->rec5>0)
			<div class="totalesT">
				<div class="totalesTD totalesTD1 totalesTDCompra">{{T::tr('Recargo Equiv.')}}</div>
				<div class="totalesTD totalesTD2">{{Utils::numFormat($datos->rec5)}}&euro;</div>
			</div>
			@endif

			<div class="sepwidth2"></div>

			<div class="totalesT totalesTT">
				<div class="totalesTD totalesTD1 totalesTT1">Total</div>
				<div class="totalesTD totalesTD2 totalesTT2" style="width: 132px;">{{Utils::numFormat($total)}}&euro;</div>
			</div>

		</div>
	</div>
	<div class="xw_boxmicuenta_salto" style="width: 100%;min-width: 300px;">
		@if($tipo=="pedido")
			@if($datos->unicaja)
				<p>
					{{T::tr('Se eligió como forma de pago')}} <b>{{T::tr('Pasarela de Pago TPV Unicaja')}}</b><br />
					@if($datos->pagado==true)
						{{T::tr('El pedido está marcado como')}} <b>{{T::tr('pagado')}}</b><br />
					@endif
				</p>
				@if($datos->pagado==false)
					<form name='ppagostar' action='https://www.unicaja.es/cgi-bin/tpv/ServletTPVM' method='post' ENCTYPE="application/x-www-form-urlencoded">
						<input type='hidden' name='tienda' value='{{trim($datos->unicajaNumeroComercio)}}'/>  
						<input type='hidden' name='referencia' value='{{$datos->clavePago}}'/>  
						<input type='hidden' name='fecha' value='{{$datos->unicajaFecha}}'/>  
						<span style='cursor:pointer;align:center'>
							<img src='{{URL::asset('public/images/tpvunicaja.jpg')}}' alt='' 
								onclick='if(document.getElementById("acepto").checked==false){alertify.alert("","Acepte los términos de servicio");return;}javascript:ppagostar.submit()'/>
							<br/>
							<button type="button" class="btn btn-danger btn_finalizar_pago" aria-label="Left Align"
								onclick='if(document.getElementById("acepto").checked==false){alertify.alert("","Acepte los términos de servicio");return;}javascript:ppagostar.submit()'>
								<span class="glyphicon glyphicon-euro" aria-hidden="true"></span>&nbsp;{{T::tr('Pagar ahora')}}
							</button>
						</span>
					</form>
					<input type="checkbox" id="acepto" onclick="">&nbsp;{{T::tr('Acepto los términos de servicio y la política de privacidad')}}</input>					
				@endif
			@endif
			@if($datos->ceca)
				<p>
					{{T::tr('Se eligió como forma de pago')}} <b>{{T::tr('Pasarela de Pago TPV Cecabank')}}</b><br />
					@if($datos->pagado==true)
						{{T::tr('El pedido está marcado como')}} <b>{{T::tr('pagado')}}</b><br />
					@endif
				</p>
				@if($datos->pagado==false)
					<!--<form name='ppagostar' action='{{$datos->cecaProduccion?'https://pgw.ceca.es/cgi-bin/tpv':'http://tpv.ceca.es:8000/cgi-bin/tpv'}}' method='post' ENCTYPE="application/x-www-form-urlencoded">-->
					<form name='ppagostar' action='{{$datos->cecaProduccion?'https://pgw.ceca.es/tpvweb/tpv/compra.action':'https://tpv.ceca.es/tpvweb/tpv/compra.action'}}' method='post' ENCTYPE="application/x-www-form-urlencoded">
						<input type='hidden' name='MerchantID' value='{{$datos->cecaMerchantID}}'/>  
						<input type='hidden' name='AcquirerBIN' value='{{$datos->cecaAcquirerBIN}}'/>  
						<input type='hidden' name='TerminalID' value='{{$datos->cecaTerminalID}}'/>  
						<input type='hidden' name='URL_OK' value='{{URL::current()}}'/>  
						<input type='hidden' name='URL_NOK' value='{{URL::current()}}'/>  
						<input type='hidden' name='Firma' value='{{$datos->cecaFirma}}'/>  
						<input type='hidden' name='Cifrado' value='SHA2'/>  
						<input type='hidden' name='Num_operacion' value='{{$datos->cecaNumOperacion}}'/>  
						<input type='hidden' name='Importe' value='{{Utils::numFormat($datos->totaldoc*100,0)}}'/>
						<input type='hidden' name='TipoMoneda' value='{{$datos->cecaMoneda}}'/>  
						<input type='hidden' name='Exponente' value='{{$datos->cecaExponente}}'/>  
						<input type='hidden' name='Pago_soportado' value='SSL'/>  
						<input type='hidden' name='Idioma' value='1'/>  
						<input type='hidden' name='Descripcion' value='{{$numero}}'/>  
						<span style='cursor:pointer;align:center'>
							<img src='{{URL::asset('public/images/tpvvceca.jpg')}}' alt='' 
								onclick='if(document.getElementById("acepto").checked==false){alertify.alert("","Acepte los términos de servicio");return;}javascript:ppagostar.submit()'/>
							<br/>
							<button type="button" class="btn btn-danger btn_finalizar_pago" aria-label="Left Align"
							onclick='if(document.getElementById("acepto").checked==false){alertify.alert("","Acepte los términos de servicio");return;}javascript:ppagostar.submit()'>
								<span class="glyphicon glyphicon-euro" aria-hidden="true"></span>&nbsp;{{T::tr('Pagar ahora')}}
							</button>
						</span>
					</form>
					<input type="checkbox" id="acepto" onclick="">&nbsp;{{T::tr('Acepto los términos de servicio y la política de privacidad')}}</input>					
				@endif
			@endif
			@if($datos->iupay)
				<p>
					{{T::tr('Se eligió como forma de pago')}} <b>{{T::tr('Pasarela de Pago TPV Iupay!')}}</b><br />
					@if($datos->pagado==true)
						{{T::tr('El pedido está marcado como')}} <b>{{T::tr('pagado')}}</b><br />
					@endif
				</p>
				@if($datos->pagado==false)
					<form name='ppagostar' action='{{$datos->iupayProduccion?'https://sis.redsys.es/sis/realizarPago':'https://sis-t.redsys.es:25443/sis/realizarPago'}}' method='post'>  
						<input type='hidden' name='Ds_SignatureVersion' value='HMAC_SHA256_V1'/>
						<input type='hidden' name='Ds_MerchantParameters' value='{{$datos->iupayMerchantParameters256}}'/>  
						<input type='hidden' name='Ds_Signature' value='{{$datos->iupaySignature256}}'/>  
						<span style='cursor:pointer;align:center'>
							@if(!$datos->iupayBizum)
							<img src='{{URL::asset('public/images/iupay.jpg')}}' alt='' 
								onclick='if(document.getElementById("acepto").checked==false){alertify.alert("","Acepte los términos de servicio");return;}javascript:ppagostar.submit()'/>
							@endif
							@if($datos->iupayBizum)
							<img src='{{URL::asset('public/images/bizum.png')}}' alt='' 
								onclick='if(document.getElementById("acepto").checked==false){alertify.alert("","Acepte los términos de servicio");return;}javascript:ppagostar.submit()'/>
							@endif
							<br/>
							<button type="button" class="btn btn-danger btn_finalizar_pago" aria-label="Left Align"
								onclick='if(document.getElementById("acepto").checked==false){alertify.alert("","Acepte los términos de servicio");return;}javascript:ppagostar.submit()'>
								<span class="glyphicon glyphicon-euro" aria-hidden="true"></span>&nbsp;{{T::tr('Pagar ahora')}}
							</button>
						</span>
					</form>
					<input type="checkbox" id="acepto" onclick="">&nbsp;{{T::tr('Acepto los términos de servicio y la política de privacidad')}}</input>					
				@endif
			@endif
			@if($datos->tpvredsys && ($bforpa == 19 || $bforpa == 21 ) )
				<p>
					{{T::tr('Se eligió como forma de pago')}} <b>{{T::tr('Tarjeta de Débito/Crédito')}}</b><br />
					@if($datos->pagado==true)
						{{T::tr('El pedido está marcado como')}} <b>{{T::tr('pagado')}}</b><br />
					@endif
				</p>
				@if($datos->pagado==false)

					<?php 
						// 1234 

						if ($datos->documento[0]->bliquid == "N")
						{


							?>

							<div class="sepwidth3"></div>
							<div class="finCompraT" style="margin-bottom: 35px;">
								<div class="finCompraTd" style="width: 718px; vertical-align: middle;"></div>
								<div class="finCompraTd">
									<div class="cestaDivBtn">
										<form name='ppagostar' action='{{$datos->tpvredsysProduccion?'https://sis.redsys.es/sis/realizarPago':'https://sis-t.redsys.es:25443/sis/realizarPago'}}' method='post'>  
											<input type='hidden' name='Ds_SignatureVersion' value='HMAC_SHA256_V1'/>
											<input type='hidden' name='Ds_MerchantParameters' value='{{$datos->tpvredsysMerchantParameters256}}'/>  
											<input type='hidden' name='Ds_Signature' value='{{$datos->tpvredsysSignature256}}'/>
											<input type='hidden' name='Ds_Merchant_Amount' value='{{Utils::numFormat($datos->totaldoc)}}'/>   
											<span style='cursor:pointer;align:center'>
												<br/>
												<button type="button" class="celdaAniadir btn_finalizar_pago" aria-label="Left Align" onclick="setTimeout( function(){ javascript:ppagostar.submit() }, 3000)">
													Pagar ahora
												</button>
											</span>
										</form>
									</div>
								</div>
							</div>		

					<?php } ?>

				@endif
			@endif
			@if($datos->sequra)
				<p>
					{{T::tr('Se eligió como forma de pago')}} <b>Sequra</b><br />
					@if($datos->pagado==true)
						{{T::tr('El pedido está marcado como')}} <b>{{T::tr('pagado')}}</b><br />
					@endif
				</p>
				@if($datos->pagado==false)
					
				<form name="sequra" action="{{URL::to('pago/sequra')}}" method="post">
					<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
					<input type="hidden" name="thisurl" value="{{URL::Current()}}" />
					<input type="hidden" name="alldata" value="{{serialize($datos)}}" />
				
				
				
					<?php $cuenta=-1; ?>
					<?php $datcli=Session::get("usuario")->uData; ?>
					@foreach($datos->documento as $dato)
					<?php $cuenta++; ?>
					<!--<input id="p{{$cuenta}}" name="p[{{$cuenta}}]" type="hidden" value='{{Utils::numFormat($dato->importe,2,".")}}'/>
					<input id="q{{$cuenta}}" name="q[{{$cuenta}}]" type="hidden" value='{{Utils::numFormat($dato->cantidad,$deccan,".")}}'/>-->
					@endforeach
				
					<input id="p0" name="p[0]" type="hidden" value='{{Utils::numFormat($datos->totaldoc,2,".")}}'/>
					<input id="q0" name="q[0]" type="hidden" value='1'/>


					<h2>{{T::tr('Datos de registro')}}</h2>
					<div>
						<div><input type="radio" name="customer-title" value="sr" checked="true"> Sr. <input type="radio" name="customer-title" value="sra"/> Sra. </div>
						<div><label for="customer-firstname">{{T::tr('Nombre')}}:</label><input type="text" id="customer-firstname" name="customer-firstname" value="{{$datcli->cnom}}"/></div>
						<div><label for="customer-lastname">Apellidos:</label><input type="text" id="customer-lastname" name="customer-lastname" value=""/></div>
						<div><label for="customer-email">Email:</label><input type="email" id="customer-email" name="customer-email" value="{{$datcli->cmail}}"/></div>
						<div><label for="customer-phone">Tel:</label><input type="tel" id="customer-phone" name="customer-phone" value="{{$datcli->ctel1}}"/></div>
						<div><label for="customer-address">{{T::tr('Dirección')}}:</label><input type="text" id="customer-address" name="customer-address" value="{{$datcli->cdom}}"/></div>
						<div><label for="customer-city">Ciudad:</label><input type="text" id="customer-city" name="customer-city" value="{{$datcli->cpob}}"/></div>
						<div><label for="customer-cp">CP:</label><input type="text" id="customer-cp" name="customer-cp" value="{{$datcli->ccodpo}}"/></div>
						<div><label for="customer-state">{{T::tr('Provincia')}}:</label><input type="text" id="customer-state" name="customer-state" value="{{$datcli->cpais}}"/></div>
						<div><label for="customer-country">{{T::tr('Provincia')}}:</label><input type="text" id="customer-country" name="customer-country" value="España"/></div>
						<div><label for="customer-nin">NIF:</label><input type="text" id="customer-nin" name="customer-nin" value="{{$datcli->cdni}}"/></div>
						<br style="clear:both"/>
						<div><label for="customer-pass">Contraseña:</label><input type="password" id="customer-pass" name="customer-pass" value=""/></div>
						<div><label for="customer-pass2">{{T::tr('Repetir contraseña')}}:</label><input type="password2" id="customer-pass2" name="customer-pass2" value=""/></div>
					</div>
					<h2>{{T::tr('Direccion de envío')}}</h2>
						<div><label for="shipping-firstname">{{T::tr('Nombre')}}:</label><input type="text" id="shipping-firstname" name="shipping-firstname" value="{{$datcli->cnom}}"/></div>
						<div><label for="shipping-lastname">Apellidos:</label><input type="text" id="shipping-lastname" name="shipping-lastname" value=""/></div>
						<div><label for="shipping-email">Email:</label><input type="email" id="shipping-email" name="shipping-email" value="{{$datcli->cmail}}"/></div>
						<div><label for="shipping-phone">Tel:</label><input type="tel" id="shipping-phone" name="shipping-phone" value="{{$datcli->ctel1}}"/></div>
						<div><label for="shipping-address">{{T::tr('Dirección')}}:</label><input type="text" id="shipping-address" name="shipping-address" value="{{$datcli->cdom}}"/></div>
						<div><label for="shipping-city">Ciudad:</label><input type="text" id="shipping-city" name="shipping-city" value="{{$datcli->cpob}}"/></div>
						<div><label for="shipping-cp">CP:</label><input type="text" id="shipping-cp" name="shipping-cp" value="{{$datcli->ccodpo}}"/></div>
						<div><label for="shipping-state">{{T::tr('Provincia')}}:</label><input type="text" id="shipping-state" name="shipping-state" value="{{$datcli->cpais}}"/></div>
						<div><label for="shipping-country">{{T::tr('Provincia')}}:</label><input type="text" id="shipping-country" name="shipping-country" value="España"/></div>
						<div><label for="shipping-vat">NIF:</label><input type="text" id="shipping-vat" name="shipping-vat" value="{{$datcli->cdni}}"/></div>
					<h2>{{T::tr('Dirección de facturación')}}</h2>
						<div><label for="billing-firstname">{{T::tr('Nombre')}}:</label><input type="text" id="billing-firstname" name="billing-firstname" value="{{$datcli->cnom}}"/></div>
						<div><label for="billing-lastname">Apellidos:</label><input type="text" id="billing-lastname" name="billing-lastname" value=""/></div>
						<div><label for="billing-email">Email:</label><input type="email" id="billing-email" name="billing-email" value="{{$datcli->cmail}}"/></div>
						<div><label for="billing-phone">Tel:</label><input type="tel" id="billing-phone" name="billing-phone" value="{{$datcli->ctel1}}"/></div>
						<div><label for="billing-address">Dirección:</label><input type="text" id="billing-address" name="billing-address" value="{{$datcli->cdom}}"/></div>
						<div><label for="billing-city">Ciudad:</label><input type="text" id="billing-city" name="billing-city" value="{{$datcli->cpob}}"/></div>
						<div><label for="billing-cp">CP:</label><input type="text" id="billing-cp" name="billing-cp" value="{{$datcli->ccodpo}}"/></div>
						<div><label for="billing-state">{{T::tr('Provincia')}}:</label><input type="text" id="billing-state" name="billing-state" value="{{$datcli->cpais}}"/></div>
						<div><label for="billing-country">{{T::tr('Provincia')}}:</label><input type="text" id="billing-country" name="billing-country" value="España"/></div>
						<div><label for="billing-vat">{{T::tr('NIF para la factura')}}:</label><input type="text" id="billing-vat" name="billing-vat" value="{{$datcli->cdni}}"/></div>
						
						<input type="hidden" name="shipping_method" value="normal" checked="true"/>
					<h2>{{T::tr('Métodos de pago')}}</h2>
					<ul>
						<li id="i1"><input type="radio" name="payment_method" value="i1" checked="true">{{T::tr('Recibe primero, paga después')}} <span id="sequra_invoice_method_link" class="sequra_popup_trigger sequra_more_info" rel="sequra_invoice_popup_checkout"><span class="icon-info"></span></span></li>
						<li id="pp3"><input type="radio" name="payment_method" value="pp3">{{T::tr('Pago a plazos')}} <span id="sequra_partpayment_method_link" class="sequra_popup_trigger sequra_more_info" rel="sequra_partpayments_popup_checkout"><span class="icon-info"></span></span><br/>    
						</li>
					</ul>
					<img class="puntero img-responsive" style="text-align: center;" src="{{URL::asset('public/images/tpvsequra.jpg')}}" alt="" 
						onclick="javascript:sequra.submit();"/>
				</form>
				@endif
			@endif
		@endif
	</div>
	<div class="xw_boxmicuenta_salto" style="width: 100%;min-width: 300px;">
		@if($datos->pagado==true)
			{{T::tr('El pedido está marcado como')}} <b>{{T::tr('pagado')}}</b><br />
		@endif
	</div>
</div>
@endif
@endsection
