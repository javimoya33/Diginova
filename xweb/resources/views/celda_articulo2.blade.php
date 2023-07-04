<?php
$numCeldasFila = 0;
$zindexCeldasFila = 100;
?>

@foreach($arrArticulos as $arrArticulo)
	@if ($arrArticulo->ASTOCK > 0)
		<?php
		$acodarMinuscula = strtolower($arrArticulo->ACODAR);

		// Foto del artículo
		$artFoto = "nofoto.jpg";

		if (isset($arrArticulo->imag1))
		{
			$artFoto = $arrArticulo->ADESCR;
		}

		$artFoto = str_replace(' ', '-', $artFoto);
		$artFoto = preg_replace('/[^A-Za-z0-9\-]/', '', $artFoto);
		$artFoto .= ".jpg";

			

		$articuloConVariosGrados = false;
		$ocultarArticulo = false;

		for ($i = 0; $i < count($arrRefRepetidas); $i++) 
		{ 
			if ($arrRefRepetidas[$i] == $arrArticulo->ACODAR)
			{
				$articuloConVariosGrados = true;
			}
		}

		for ($i = 0; $i < count($arrRefOcultas); $i++) 
		{ 
			if ($arrRefOcultas[$i] == $arrArticulo->ACODAR)
			{
				if (!$esPortada)
				{
					$ocultarArticulo = true;
				}
			}
		}
		?>

		@if ($ocultarArticulo)
			<div style="display: none">
		@else
			<?php
			$leftArticulo += $sumaLeftArticulo;
			
			if ($numCeldasFila % 4 == 0 && $numCeldasFila > 0)
			{
				$topArticulo += 450;	// 1234   450
				$leftArticulo = 0;
				$zindexCeldasFila -= 1;
			}

			$numCeldasFila += 1;

			$filtros = '';
			$filtroTeclado = '';
			$filtroPremium = '';

			if ($arrArticulo->tieneTeclado)
			{
				$filtroTeclado = '133';
			}

			if (str_contains($arrArticulo->ADESCR, 'Premium')) 
			{
				$filtroPremium = '128';
			}

			$clasePresupuesto = '';

			if (session("usuario")->margenesActivo == 1) 
			{
				$clasePresupuesto = 'celdaArtPresu';
			}




			if (!$esAccesorioComponente)
			{
				$filtros = 'fil'.$arrArticulo->fil1.' '.'fil'.$arrArticulo->fil2.' '.'fil'.$arrArticulo->fil3.' '.'fil'.$arrArticulo->fil4.' '.'fil'.$arrArticulo->fil5.' '.'fil'.$arrArticulo->fil6.' '.'fil'.$arrArticulo->fil7.' '.'fil'.$arrArticulo->fil8.' '.'fil'.$arrArticulo->fil9.' '.'fil'.$arrArticulo->fil10.' '.'fil'.$arrArticulo->fil11.' '.'fil'.$arrArticulo->fil12.' '.'fil'.$arrArticulo->filtroPrecio.' '.'fil'.$arrArticulo->filtroCantidad.' '.'fil'.$filtroTeclado.' '.'filGen'.$arrArticulo->ATIPO.' '.'filGen'.$filtroPremium.' '.$clasePresupuesto;
			}
			/*if (!$esAccesorioComponente)
			{
				$filtros = 'fil'.$arrArticulo->fil1.' '.'fil'.$arrArticulo->fil2.' '.'fil'.$arrArticulo->fil3.' '.'fil'.$arrArticulo->fil4.' '.'fil'.$arrArticulo->fil5.' '.'fil'.$arrArticulo->fil6.' '.'fil'.$arrArticulo->fil7.' '.'fil'.$arrArticulo->fil8.' '.'fil'.$arrArticulo->fil9.' '.'fil'.$arrArticulo->fil10.' '.'fil'.$arrArticulo->fil11.' '.'fil'.$arrArticulo->fil12.' '.'filGen'.$arrArticulo->ATIPO;
			}*/
			?>
			@if (session("usuario")->uData->codigo == 0)
				<div class="celdaArt 
					<?php if ($arrArticulo->esOferta == 1) 
					{ ?> 
						celdaArtOfe 
					<?php } ?> 
					celdaArtFav celdaNoSesion 
					<?php echo $filtros ?> 
					<?php if (Session::get("entorno")->nombrePagina == '' && $leftArticulo == 0) { ?> 
						primerArtFila 
					<?php } ?>" 
					style="position: absolute; top: <?php echo $topArticulo ?>px; left: <?php echo $leftArticulo; ?>px; width: <?php echo $widthArticulo; ?>px">
			@else
				<div class="celdaArt 
					<?php if ($arrArticulo->esOferta == 1) { ?> 
						celdaArtOfe 
					<?php } ?> 
					celdaArtFav 
					<?php echo $filtros ?> 
					<?php if (Session::get("entorno")->nombrePagina == '' && $leftArticulo == 0) { ?> 
						primerArtFila 
					<?php } ?>" 
					style="position: absolute; top: <?php echo $topArticulo ?>px; left: <?php echo $leftArticulo; ?>px; width: <?php echo $widthArticulo; ?>px; <?php if ($arrArticulo->esOferta == 0) { 
							if (session("usuario")->margenesActivo == 0) { ?> 
								height: 312px; <?php } else {?> height: 342px; 
							<?php }
						} 
						else 
						{ 
							if ($arrArticulo->esOferta == 1)
							{
								?> height: 368px; <?php 
							}
							else
							{
								?> height: 355px; <?php 
							}
						} ?>">
			@endif
		@endif
			<input type="hidden" id="refArticulo" value="{{$arrArticulo->ACODAR}}" /> 
			@if ($ccodcl > 0)
				@if ($arrArticulo->tieneTeclado)
					<div class="celdaFav" id="celdaFav{{$arrArticulo->ACODAR}}" style="visibility: visible; display: block; float: left;">
						<div class="celdaFavT"> 
							<img class="idiomaTeclado" title="Idioma de teclado personalizable" src="/xweb/public/images/teclado_personalizable2.png" width="30" />
						</div>
						<div id="celdaBandera" class="celdaBandera">
							<img title="Idioma de teclado español" src="/xweb/public/images/banderaespana.png" />
						</div>
					</div>
				@endif
			
				<div class="celdaFav" id="celdaFav{{$arrArticulo->ACODAR}}" {{$arrArticulo->FAVICONSTYLE}} >
					<div class="celdaFavT">				
						<img class="celdaFavIcon" id="celdaFavIcon{{$arrArticulo->ACODAR}}" title="{{$arrArticulo->FAVTITLE}}" src="{{$arrArticulo->FAVRUTA}}" width="24" height="20"  
							onclick="marcarFavorito({{$ccodcl}}, '{{$arrArticulo->ACODAR}}', {{$arrArticulo->FAVORITO}}, this);" /> 
					</div>
					<div class="celdaFavT celdaFavT2" id="celdaFavGuardado{{$arrArticulo->ACODAR}}"></div>
				</div>
			@endif
			<div class="celdaFot">
				<table border="0">
					<tr>
						<td style="vertical-align: middle;">
							<a href="/xweb/articulo/{{$arrArticulo->ACODAR}}">
								<img style="max-height: 150px; max-width: 150px;" src="/xweb/public/articulos/<?php echo $artFoto; ?>" border="0" alt="" title="" />
								<!--<img style="max-height: 150px; max-width: 150px;"  class="lazy" src="/xweb/public/articulos/nofoto.jpg" data-src="/xweb/public/articulos/<?php echo $artFoto; ?>" 
									data-srcset="nofoto.jpg 2x, /xweb/public/articulos/<?php echo $artFoto; ?> 1x" alt="">-->
							</a>
						</td>
					</tr>
				</table>
			</div>
			@if(session("usuario")->uData->codigo > 0)
					@if ($arrArticulo->esOferta == 1)
					<div style="width: 100%; display: flex; justify-content: space-evenly;">
						@if ($ccodcl > 0)
							<div style="width: 155px; display: inline-block; margin-bottom: 8px;">
						@else
							<div style="width: 95px; display: inline-block;">
						@endif
							<div class="celdaTipo celda_oferta">oferta</div>
							@if(session("usuario")->uData->codigo > 0)
								<div class="celdaTipo celda_precio_antiguo">
									@if(session("usuario")->uData->ctari == 1)
										{{Utils::numFormat($arrArticulo->APVP1)}}€
									@elseif(session("usuario")->uData->ctari == 2)
										{{Utils::numFormat($arrArticulo->APVP2)}}€
									@elseif(session("usuario")->uData->ctari == 3)
										{{Utils::numFormat($arrArticulo->APVP3)}}€
									@elseif(session("usuario")->uData->ctari == 4)
										{{Utils::numFormat($arrArticulo->APVP4)}}€
									@elseif(session("usuario")->uData->ctari == 5)
										{{Utils::numFormat($arrArticulo->ARESNUM5)}}€
									@elseif(session("usuario")->uData->ctari == 6)
										{{Utils::numFormat($arrArticulo->ARESNUM6)}}€
									@endif
								</div>
							@endif
						</div>
					</div>
				@else
					<!--<div class="celdaTipo celda_resto">&nbsp;</div>-->
				@endif
			@endif
			<div class="celdaDesc">
				<a href="/xweb/articulo/{{$arrArticulo->ACODAR}}" title="{{$arrArticulo->ADESCR}}">
					@php
					$adescrAbrev = substr($arrArticulo->ADESCR, 0, 62);
					echo $adescrAbrev;
					@endphp			
				</a>
			</div>
			@if(session("usuario")->uData->codigo == 0)
				<div class="celdaAniadir">
					<a href="/xweb/articulo/{{$arrArticulo->ACODAR}}">Ver artículo ></a>
				</div>
			@else

				@if($articuloConVariosGrados)
					<div class="div_desde">Desde</div>
				@endif

				@if($arrArticulo->esAmpliable)
					<div class="div_desde div_ampliable">Ampliable</div>
				@else
					<div class="div_desde div_ampliable" style="visibility: hidden;">Ampliable</div>
				@endif

				@if (session('entorno')->nombrePagina == 'ofertas')
					<div class="celdaPrecio" style="width: <?php echo $widthArticulo ?>px; margin-top: 0px;">
				@else
					<div class="celdaPrecio" style="width: <?php echo $widthArticulo ?>px;">
				@endif
					@if ($categoria == 1166)
						@if (session("usuario")->margenesActivo)
							{{Utils::numFormat($arrArticulo->precioConMargen)}}€
						@else
							@if(session("usuario")->uData->ctari == 1)
								{{Utils::numFormat($arrArticulo->OPRE1)}}€
							@elseif(session("usuario")->uData->ctari == 2)
								{{Utils::numFormat($arrArticulo->OPRE2)}}€
							@elseif(session("usuario")->uData->ctari == 3)
								{{Utils::numFormat($arrArticulo->OPRE3)}}€
							@elseif(session("usuario")->uData->ctari == 4)
								{{Utils::numFormat($arrArticulo->OPRE4)}}€
							@elseif(session("usuario")->uData->ctari == 5)
								{{Utils::numFormat($arrArticulo->OPRE5)}}€
							@elseif(session("usuario")->uData->ctari == 6)
								{{Utils::numFormat($arrArticulo->OPRE6)}}€
							@endif
						@endif
					@else
						@if ($arrArticulo->esOferta == 1)
							<?php if ( isset($arrOfertas) ) { ?>
							@foreach ($arrOfertas as $arrOferta)
								@if (session("usuario")->margenesActivo)
									{{Utils::numFormat($arrArticulo->precioConMargen)}}€
									<?php break; ?>
								@else
									@if ($arrOferta->ACODAR == $arrArticulo->ACODAR)
										@if(session("usuario")->uData->ctari == 1)
											{{Utils::numFormat($arrOferta->OPRE1)}}€
										@elseif(session("usuario")->uData->ctari == 2)
											{{Utils::numFormat($arrOferta->OPRE2)}}€
										@elseif(session("usuario")->uData->ctari == 3)
											{{Utils::numFormat($arrOferta->OPRE3)}}€
										@elseif(session("usuario")->uData->ctari == 4)
											{{Utils::numFormat($arrOferta->OPRE4)}}€
										@elseif(session("usuario")->uData->ctari == 5)
											{{Utils::numFormat($arrOferta->OPRE5)}}€
										@elseif(session("usuario")->uData->ctari == 6)
											{{Utils::numFormat($arrOferta->OPRE6)}}€
										@endif
									@endif
								@endif
							@endforeach
							<?php } ?>

						@else
							@if (session("usuario")->margenesActivo)
								{{Utils::numFormat($arrArticulo->precioConMargen)}}€
							@else
								@if(session("usuario")->uData->ctari == 1)
									{{Utils::numFormat($arrArticulo->APVP1)}}€
								@elseif(session("usuario")->uData->ctari == 2)
									{{Utils::numFormat($arrArticulo->APVP2)}}€
								@elseif(session("usuario")->uData->ctari == 3)
									{{Utils::numFormat($arrArticulo->APVP3)}}€
								@elseif(session("usuario")->uData->ctari == 4)
									{{Utils::numFormat($arrArticulo->APVP4)}}€
								@elseif(session("usuario")->uData->ctari == 5)
									{{Utils::numFormat($arrArticulo->ARESNUM5)}}€
								@elseif(session("usuario")->uData->ctari == 6)
									{{Utils::numFormat($arrArticulo->ARESNUM6)}}€
								@else
									{{Utils::numFormat($arrArticulo->APVP1)}}€
								@endif
							@endif
						@endif
					@endif
				</div>
				@if (session("usuario")->margenesActivo)
					<div class="fPrecios" style="line-height: 20px; text-align: center;">
						<?php $precioConMargenConIVA = $arrArticulo->precioConMargen + ($arrArticulo->precioConMargen * 21 / 100); ?>
						<span style="float: none; vertical-align: text-top;">{{Utils::numFormat($precioConMargenConIVA)}}€ I.V.A. incluido</span>
					</div>
				@endif
				<div class="celdaInv">
					<div class="celdaCantStock" style="width: <?php echo $widthArticulo ?>px;">
						<div class="celdaCant">
							Cantidad: <br/>
							<div class="celdaTabCant">
								<div>
									<img alt="-" src="/xweb/public/images/artmenosoff.png" id="menos{{$arrArticulo->ACODAR}}"
										name="menosCantidad" onclick="celdaCantBajar('{{$arrArticulo->ACODAR}}')" />
								</div>
								<div>
									<input type="text" disabled id="cant{{$arrArticulo->ACODAR}}" value="1" style="border: none;" />
								</div>
								<div>
									<img alt="+" src="/xweb/public/images/artmason.png" id="mas{{$arrArticulo->ACODAR}}" 
										name="masCantidad_5" onclick='celdaCantSubir("{{$arrArticulo->ACODAR}}", 
										{{$arrArticulo->ASTOCK}})' />
								</div>
							</div>
						</div>
						<div class="celdaStock">
							Stock: <br/>
							<div>{{$arrArticulo->ASTOCK}} unids.</div>
						</div>
					</div>
					<div class="divMensajeRecibelo">{{$mensajeRecibelo}}</div>
					<div id="cestaAdd{{$arrArticulo->ACODAR}}" class="celdaAniadir pointer" onclick="addArticulo('{{$arrArticulo->ACODAR}}', document.getElementById('cant{{$arrArticulo->ACODAR}}').value,'{{URL::to('addArticulo')}}', this);">Añadir</div>
				</div>
			@endif
		</div>
	@endif
@endforeach


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

function comprobarCants(acodar, cantidad, max) {
    var itemMenos = document.getElementById("menos" + acodar);
    var itemMas = document.getElementById("mas" + acodar);

    if (cantidad <= 1) { itemMenos.src = "/xweb/public/images/artmenosoff.png"; }
    else { itemMenos.src = "/xweb/public/images/artmenoson.png"; }

    if (cantidad >= max) { itemMas.src = "/xweb/public/images/artmasoff.png"; }
    else { itemMas.src = "/xweb/public/images/artmason.png"; }
}


function marcarFavorito(ccodcl, acodar, favorito, elemento)
{
    $.ajax({
        url: '/xweb/marcarfavorito/' + ccodcl + '/' + acodar + '/' + favorito,
        type: 'get',
        contentType: false,
        processData: false,
        success: function(response) {

            if (favorito == 0)
            {
                $('#celdaFavIcon' + acodar).attr('src', '/xweb/public/images/fav1.png');
                $('#celdaFavIcon' + acodar).attr("onclick", "marcarFavorito(" + ccodcl + ", '" + acodar + "', 1)");
                $('#celdaFavGuardado' + acodar).text('Guardado en favoritos');
                $(elemento).attr('src', '/xweb/public/images/fav1.png');
            }
            else 
            {
                $('#celdaFavIcon' + acodar).attr('src', '/xweb/public/images/fav0.png');
                $('#celdaFavIcon' + acodar).attr("onclick", "marcarFavorito(" + ccodcl + ", '" + acodar + "', 0)");
                $('#celdaFavGuardado' + acodar).text('Quitado de favoritos');
                $(elemento).attr('src', '/xweb/public/images/fav0.png');
            }
        }
    });
}

function scrollArticulos(elemento)
{
    if (elemento.scrollHeight - elemento.scrollTop - elemento.clientHeight <= 0) 
    {
        let numArtMostrados = document.getElementById('num_art_mostrados').value;
        numArtMostrados = parseInt(numArtMostrados) + 10;
        mostrarArticulos(numArtMostrados);
    }
}
</script>