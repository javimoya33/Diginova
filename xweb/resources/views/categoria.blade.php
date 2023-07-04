@extends("base")

@section("dashboard")
	<div id="xw_boxcentral" class="catCont" style="min-height:1100px;  margin-top: 0px; <?php if ($categoria == 1127) { ?> margin-left: 10px; margin-bottom: 0px; <?php } ?>">
	  	<title>Diginova - Ordenadores</title>
	  	@php 
  		$indiceCategoria = 0;
  		$f2 = 0;
        @endphp
	  	@if ($categoria == 1125)
	  		@php 
	  		$indiceCategoria = 1;
	  		$f2 = 100;
	        @endphp
		@elseif ($categoria == 1126)
	  		@php 
	  		$indiceCategoria = 2;
	  		$f2 = 104;
	        @endphp
		@elseif ($categoria == 1118)
	  		@php 
	  		$indiceCategoria = 3;
	  		$f2 = 105;
	        @endphp
	  	@elseif ($categoria == 1160 || $categoria == 1127)
	  		@php 
	  		$indiceCategoria = 4;
	  		$f2 = 132;
	        @endphp
	    @elseif ($categoria == 1166)
	    	@php 
	  		$indiceCategoria = 5;
	  		$f2 = 132;
	        @endphp
		@endif
		
		<?php
			$subcategoria = "";
			$subcategoria2 = "";
		?>

		@if ($subcategoria != '')
			<script type="text/javascript">
			  $(document).ready(function() {

			    $("#" + <?php echo $subcategoria ?>).trigger("click");

			  });
			</script>
		@endif

		@if ($subcategoria2 != '')
			<script type="text/javascript">
			  $(document).ready(function() {

			    $("#" + <?php echo $subcategoria2 ?>).trigger("click");

			  });
			</script>
		@endif

		@if ($categoria != 1127)
			<div class="catContGruposO">
		    	<div class="catContGruposO1">
		    		<div class="categoria categoriaO">
		    			@if ($categoria != 1160)
			    			<div class="catCol0Mv">
		    					<div onclick="mostrarFiltrosMv(this)" class="catCol0DivMv">Filtrar</div>
		    					<div id="divCerrarCol0Mv" onclick="cerrarFiltrosMv(this)" class="catCol0DivMv" style="width: 50px; visibility: hidden;">
		    						<img src="/xweb/public/images/close2.png" style="width: 23px;">
		    					</div>
		    					<div class="catCeldaOrden">
	    							<div class="catOrdenar">
	    								<div class="catMarcasTit">
	    									<span>Ordenar por</span>
	    								</div>
	    								<div class="catCriteriosOrden">
	    									<div id="catOrd1" class="catOrd catOrdNeg" onclick="filtroAjaxCatCheck3( 1, 0, 0); toggleOrden(1);">
	    										Relevancia
	    									</div>
	    									<div id="catOrd2" class="catOrd" onclick="filtroAjaxCatCheck3( 1, 0, 0, <?php echo session('usuario')->uData->codigo ?>, -1, -1, 1 ); toggleOrden(2);">
	    										Más baratos
	    									</div>
	    									<div id="catOrd3" class="catOrd" onclick="filtroAjaxCatCheck3( 1, 0, 0, <?php echo session('usuario')->uData->codigo ?>, -1, -1, 2 ); toggleOrden(3);">
	    										Mayor precio
	    									</div>
	    								</div>
	    							</div>
	    						</div>
		    				</div>
		    			@endif

		    			@if ($categoria == 1127 || $categoria == 1166)
		    				<div class="catCol1" style="display: none">
		    			@else
		    				<div class="catCol1">
		    			@endif
		    				<div class="col1Filtro">
		    					<div class="catCol1Div">
		    						<section id="mytabsFilts" data-accordion-group>
		    							@if ($categoria == 1125 || $categoria == 1126)
			    							<section data-accordion class="catFiltGrupo open">
			    								<div class="acordElementoFiltro acordItemFilro" data-control onclick="clickAcordeon(this)">Precio</div>
			    								@php
			    								$styleCatFilGru = "transition: max-height 300ms ease 0s; max-height: 224px; height: auto;";
			    								@endphp
			    								<div data-content id="catFilGru1" class="catFilGru" style="{{$styleCatFilGru}}">
			    									<article>
			    										<ul class="ulFiltros" style="padding-left: 0px; margin-bottom: 0px;">
			    											@foreach($arrFiltrosPrecios as $filtro => $precios)
													            @foreach($precios as $id => $nombre)
													            <div id="{{$id}}" value="{{$id}}" onclick="toggleClaseFiltrosCheck('1', '{{$id}}'); filtroAjaxCatCheck2( 1, '{{$id}}', 2); visualizarFiltros(); calcularAlturaContenedorArticulos(); ocultarGrupoFiltros();" class="catFilt ">
				    												<div class="catFilt1">
				    													<div class="filtro_cuadr"></div>
				    												</div>
				    												<div class="catFilt2">{{$nombre}}</div>
				    											</div>
													            @endforeach
													        @endforeach
			    										</ul>
			    									</article>
			    								</div>
			    							</section>

			    							<section data-accordion class="catFiltGrupo open">
			    								<div class="acordElementoFiltro acordItemFilro" data-control onclick="clickAcordeon(this)">Generación Procesador</div>
			    								@php
			    								$styleCatFilGru = "transition: max-height 300ms ease 0s; max-height: 224px; height: auto;";
			    								@endphp
			    								<div data-content id="catFilGru1" class="catFilGru" style="{{$styleCatFilGru}}">
			    									<article>
			    										<ul class="ulFiltros" style="padding-left: 0px; margin-bottom: 0px;">
			    											@foreach($arrGeneracionProcesadores as $procesador)
													            <div id="Gen{{$procesador}}" value="Gen{{$procesador}}" onclick="toggleClaseFiltrosCheck('1', 'Gen{{$procesador}}'); filtroAjaxCatCheck2( 1, 'Gen{{$procesador}}', 2); visualizarFiltros(); calcularAlturaContenedorArticulos(); ocultarGrupoFiltros();" class="catFilt ">
				    												<div class="catFilt1">
				    													<div class="filtro_cuadr"></div>
				    												</div>
				    												<div class="catFilt2">{{$procesador}}º Generación</div>
				    											</div>
													        @endforeach
			    										</ul>
			    									</article>
			    								</div>
			    							</section>

			    							<section data-accordion class="catFiltGrupo open">
			    								<div class="acordElementoFiltro acordItemFilro" data-control onclick="clickAcordeon(this)">Cantidad</div>
			    								@php
			    								$styleCatFilGru = "transition: max-height 300ms ease 0s; max-height: 224px; height: auto;";
			    								@endphp
			    								<div data-content id="catFilGru1" class="catFilGru" style="{{$styleCatFilGru}}">
			    									<article>
			    										<ul class="ulFiltros" style="padding-left: 0px; margin-bottom: 0px;">
			    											@foreach($arrFiltrosCantidad as $filtro => $cantidades)
													            @foreach($cantidades as $id => $nombre)
													            <div id="{{$id}}" value="{{$id}}" onclick="toggleClaseFiltrosCheck('1', '{{$id}}'); filtroAjaxCatCheck2( 1, '{{$id}}', 2); visualizarFiltros(); calcularAlturaContenedorArticulos(); ocultarGrupoFiltros();" class="catFilt ">
				    												<div class="catFilt1">
				    													<div class="filtro_cuadr"></div>
				    												</div>
				    												<div class="catFilt2">{{$nombre}}</div>
				    											</div>
													            @endforeach
													        @endforeach
			    										</ul>
			    									</article>
			    								</div>
			    							</section>
			    						@endif
			    						
		    							@if ($categoria == 1125 || $categoria == 1126 || $categoria == 1118 || $categoria == 1166)

		    								@php
	    									$contGrupos = 0;
	    									@endphp
		    								@foreach($arrCatFiltros as $fila)
		    									@php
		    									$codFiltro1 = $fila->idfiltro1;
												$nomFiltro1 = ""; $nomFiltro1 = $fila->descrfiltro1;

												$contGrupos++; $strOpen = "";
												$strOpen = "open";
												$styleCatFilGru = "transition: max-height 300ms ease 0s; max-height: 224px; height: auto;";

												$styleSectionFiltro = '';

		    									if ($nomFiltro1 == 'Marca')
		    									{
		    										$styleSectionFiltro = 'catFiltGrupoMarca';
		    									}

		    									@endphp

		    									<?php
		    									if ($codFiltro1 != 19)
		    									{
		    										?>

	    										<section data-accordion class="catFiltGrupo {{$styleSectionFiltro}} {{$strOpen}}">
				    								<div class="acordElementoFiltro acordItemFilro" data-control onclick="clickAcordeon(this)">{{$nomFiltro1}}</div>
				    								<div data-content id="catFilGru1" class="catFilGru" style="{{$styleCatFilGru}}">
				    									<article>

				    										@php
				    										$contFila = 0;

				    										foreach ($arrFiltros as $filt) 
															{
																if ($fila->idfiltro1 == $filt->idfiltro1)
																{
																	$codF2 = $filt->idfiltro2;
																	$classFilt = "catFilt ";

																	if (session('usuario')->uData->ctari == "")
																	{
																		$numTarifa = 0;
																	}
																	else
																	{
																		$numTarifa = session('usuario')->uData->ctari;
																	}

																	if(session('usuario')->uData->codigo == 0)
																	{
																		$ccodcl = 0;
																	}
																	else
																	{
																		$ccodcl = session('usuario')->uData->ctari;
																	}

																	@endphp
						    										<ul class="ulFiltros" style="padding-left: 0px; margin-bottom: 0px;">
						    											<div id="<?php echo $codF2; ?>" value="<?php echo $codF2; ?>" class="<?php echo $classFilt; ?>" onclick="toggleClaseFiltrosCheck('<?php echo $indiceCategoria; ?>', '<?php echo $codF2; ?>'); filtroAjaxCatCheck2( <?php echo $indiceCategoria; ?>, '<?php echo $codF2; ?>', <?php echo $numTarifa; ?>); filtroTienda( <?php echo $indiceCategoria; ?>, <?php echo $codF2; ?>, '', <?php echo $ccodcl; ?>); visualizarFiltros(); calcularAlturaContenedorArticulos(); ocultarGrupoFiltros();">
						    												<div class="catFilt1">
						    													<div class="filtro_cuadr"></div>
						    												</div>
						    												<div class="catFilt2">
						    													@if ($filt->descrfiltro2 == 'Tiny')
						    														@php echo 'Mini PC – Tiny' @endphp
						    													@else
						    														@php echo $filt->descrfiltro2; @endphp
						    													@endif
						    												</div>
						    											</div>
						    										</ul>
						    										@php
																}
					    										$contFila += 1;
					    									}
					    									@endphp
				    									</article>
				    								</div>
			    								</section>

		    										<?php
		    									}
		    									?>

		    								@endforeach
		    							@endif
		    						</section>
		    					</div>
		    				</div>
		    			</div>
		    			<div class="catCol2">
		    				<div class="catCol2Div">
		    					<div class="catFilaTipos">
		    						<div class="catSubtipos1">
		    							@if ($categoria == 1125)
							          		<div class="catSub">
			    								<div class="catFilt " id="103" value="103" onclick="toggleClaseFiltrosIcon('1', '103'); filtroAjaxCatCheck2( 1, 17, 0); filtroTienda(1, 103, '', <?php echo $ccodcl; ?>); calcularAlturaContenedorArticulos();">
			    									<img id="imgfil103" src="/xweb/public/images/filtricon103.png">
			    								</div>
			    							</div>
			    							<div class="catSub">
			    								<div class="catFilt " id="104" value="104" onclick="toggleClaseFiltrosIcon('1', '104'); filtroAjaxCatCheck2( 1, 17, 0); filtroTienda(1, 104, '', <?php echo $ccodcl; ?>); calcularAlturaContenedorArticulos(); ">
			    									<img id="imgfil104" src="/xweb/public/images/filtricon104.png">
			    								</div>
			    							</div>
			    							<div class="catSub">
			    								<div class="catFilt " id="105" value="105" onclick="toggleClaseFiltrosIcon('1', '105'); filtroAjaxCatCheck2( 1, 17, 0); filtroTienda(1, 105, '', <?php echo $ccodcl; ?>); calcularAlturaContenedorArticulos(); ">
			    									<img id="imgfil105" src="/xweb/public/images/filtricon105.png">
			    								</div>
			    							</div>
				    						<div class="catSub">
			    								<div class="catFilt " id="132" value="132" onclick="toggleClaseFiltrosIcon('1', '132'); filtroAjaxCatCheck2( 1, 17, 0); filtroTienda(1, 132, '', <?php echo $ccodcl; ?>); calcularAlturaContenedorArticulos(); ">
			    									<img id="imgfil132" src="/xweb/public/images/filtricon132.png">
			    								</div>
			    							</div>
			    						@elseif ($categoria == 1126)
							          		<div class="catSub">
			    								<div class="catFilt " id="128" value="128" onclick="toggleClaseFiltrosIcon('1', '128'); filtroAjaxCatCheck2( 2, 21, 0); filtroTienda(1, 128, '', <?php echo $ccodcl; ?>); calcularAlturaContenedorArticulos(); ">
			    									<img id="imgfil128" src="/xweb/public/images/filtricon128.png">
			    								</div>
			    							</div>
			    							<div class="catSub">
			    								<div class="catFilt " id="129" value="129" onclick="toggleClaseFiltrosIcon('1', '129'); filtroAjaxCatCheck2( 2, 21, 0); filtroTienda(1, 129, '', <?php echo $ccodcl; ?>); calcularAlturaContenedorArticulos(); ">
			    									<img id="imgfil129" src="/xweb/public/images/filtricon129.png">
			    								</div>
			    							</div>
			    							<div class="catSub">
			    								<div class="catFilt " id="130" value="130" onclick="toggleClaseFiltrosIcon('1', '130'); filtroAjaxCatCheck2( 2, 21, 0); filtroTienda(1, 130, '', <?php echo $ccodcl; ?>); calcularAlturaContenedorArticulos(); ">
			    									<img id="imgfil130" src="/xweb/public/images/filtricon130.png">
			    								</div>
			    							</div>
				    						<div class="catSub">
			    								<div class="catFilt " id="131" value="131" onclick="toggleClaseFiltrosIcon('1', '131'); filtroAjaxCatCheck2( 2, 21, 0); filtroTienda(1, 131, '', <?php echo $ccodcl; ?>); calcularAlturaContenedorArticulos(); ">
			    									<img id="imgfil131" src="/xweb/public/images/filtricon131.png">
			    								</div>
			    							</div>
							        	@endif
		    						</div>
		    					</div>
		    					@if ($categoria == 1166)
		    						<div class="catFila2 sombraCatF2">
			    						<div class="catCeldaMarcas">
			    							<div class="catMarcas">
			    								<div class="catMarcasTit">
			    									<span>Tipo</span>
			    								</div>
			    								<div class="catMarcasLogos" style="margin-left: 13px">
													<?php
													col1MostrarFiltroMarca(23, 134, 'Ordenador', 5); 
													col1MostrarFiltroMarca(23, 135, 'Portátil', 5); 
													col1MostrarFiltroMarca(23, 136, 'Monitor', 5);
													?> 
			    								</div>
			    							</div>
			    						</div>
			    						<div class="catCeldaOrden">
			    							<div class="catOrdenar">
			    								<div class="catMarcasTit">
			    									<span>Ordenar por</span>
			    								</div>
			    								<div class="catCriteriosOrden">
			    									<div id="catOrd1" class="catOrd catOrdNeg" onclick="filtroAjaxCatCheck2( 1, 0, 0); toggleOrden(1);">
			    										Relevancia
			    									</div>
			    									<div id="catOrd2" class="catOrd" onclick="filtroAjaxCatCheck2( 1, 0, 0, <?php echo session('usuario')->uData->codigo ?>, -1, -1, 1 ); toggleOrden(2);">
			    										Más baratos
			    									</div>
			    									<div id="catOrd3" class="catOrd" onclick="filtroAjaxCatCheck2( 1, 0, 0, <?php echo session('usuario')->uData->codigo ?>, -1, -1, 2 ); toggleOrden(3);">
			    										Mayor precio
			    									</div>
			    								</div>
			    							</div>
			    						</div>
			    					</div>
			    				@elseif ($categoria == 1118)
		    					@else
		    						<div class="catFila2 sombraCatF2">
			    						<div class="catCeldaMarcas">
			    							<div class="catMarcas">
			    								<div class="catMarcasTit">
			    									<span>Marcas</span>
			    								</div>
			    								<div class="catMarcasLogos">
													@if ($categoria == 1125)
														<?php
														col1MostrarFiltroMarca(12, 80, 'Acer', 1); 
														col1MostrarFiltroMarca(12, 79, 'HP', 1); 
														col1MostrarFiltroMarca(12, 83, 'Lenovo', 1); 
														col1MostrarFiltroMarca(12, 82, 'Dell', 1); 
														col1MostrarFiltroMarca(12, 84, 'Fujitsu', 1);
														?>
													@elseif ($categoria == 1126)
														<?php
														col1MostrarFiltroMarca(13, 126, 'Apple', 2);
														col1MostrarFiltroMarca(13, 87, 'Lenovo', 2);
														col1MostrarFiltroMarca(13, 86, 'Dell', 2);  
														col1MostrarFiltroMarca(13, 85, 'HP', 2); 
														col1MostrarFiltroMarca(13, 111, 'Toshiba', 2); 
														col1MostrarFiltroMarca(13, 88, 'Fujitsu', 2);
														?>
													@elseif ($categoria == 1118)
														<?php
														col1MostrarFiltroMarca(14, 89, 'HP', 3); 
														col1MostrarFiltroMarca(14, 92, 'Dicota', 3); 
														col1MostrarFiltroMarca(14, 93, 'NEC', 3); 
														col1MostrarFiltroMarca(14, 96, 'Philips', 3); 
														col1MostrarFiltroMarca(14, 97, 'Samsung', 3); 
														col1MostrarFiltroMarca(14, 98, 'ViewSonic', 3);
														?>
													@endif
			    								</div>
			    							</div>
			    						</div>
			    						<div class="catCeldaOrden">
			    							<div class="catOrdenar">
			    								<div class="catMarcasTit">
			    									<span>Ordenar por</span>
			    								</div>
			    								<div class="catCriteriosOrden">
			    									<div id="catOrd1" class="catOrd catOrdNeg" onclick="filtroAjaxCatCheck2( 1, 0, 0); toggleOrden(1);">
			    										Relevancia
			    									</div>
			    									<div id="catOrd2" class="catOrd" onclick="filtroAjaxCatCheck2( 1, 0, 0, <?php echo session('usuario')->uData->codigo ?>, -1, -1, 1 ); toggleOrden(2);">
			    										Más baratos
			    									</div>
			    									<div id="catOrd3" class="catOrd" onclick="filtroAjaxCatCheck2( 1, 0, 0, <?php echo session('usuario')->uData->codigo ?>, -1, -1, 2 ); toggleOrden(3);">
			    										Mayor precio
			    									</div>
			    								</div>
			    							</div>
			    						</div>
			    					</div>
		    					@endif
		    				</div>

		    				<div class="catColumna catArticulos">
		    					<div id="filtradosCat" class="elementsOcasion">

		    						<?php
		    						$numArtConStock = 0;

		    						foreach ($arrDatosArticulos as $arrDatosArticulo) 
		    						{
		    							if ($arrDatosArticulo->ASTOCK > 0)
		    							{
		    								$numArtConStock += 1;
		    							}
		    						}
		    						?>

		    						@php
		    						$numFilasArt = $numArtConStock / 4;
		    						$numFilasArt = ceil($numFilasArt) - 1;
		    						$esFilaOfertas = false;
		    						@endphp

		    						@if ($esPagOfertas)
		    							@php
			    						$heightFiltradosCat = $numFilasArt * 550;
			    						@endphp
		    						@else
		    							@php
			    						$heightFiltradosCat = $numFilasArt * 450;
			    						@endphp
		    						@endif

		    						

		    						<!--<div id="filtrosActivos" class="filtrosActivos" style="display: none;"></div>-->
		    						@php
		    						$numFilasArt = $numArtConStock / 4;
		    						$numFilasArt = ceil($numFilasArt);
		    						$heightFiltradosCat = $numFilasArt * 450;

		    						@endphp
		    						<div id="filtradosCat" class="contArtsOcasion contArtsOcasionMv filtradosCat" style="margin-bottom: 100px; height: {{$heightFiltradosCat}}px">
		    							<?php
		    							if ($categoria == 1166)
		    							{
		    								$leftArticulo = -315;
											$sumaLeftArticulo = 315;
		    							}
		    							else
		    							{
		    								$leftArticulo = -225;
											$sumaLeftArticulo = 225;
		    							}
										
										$widthArticulo = 200;
										$topArticulo = 0;
										$arrArticulos = $arrDatosArticulos;
										$esAccesorioComponente = false;
										?>

										@if (count($arrArticulos) == 0)
											<div style="text-align: center; padding-top: 10px;">Actualmente no hay artículos en esta sección :(</div>
										@else
											@include("celda_articulo")
										@endif
		    						</div>
		    					</div>
		    				</div>
		    			</div>
		    		</div>
		    	</div>
		    </div>
		@else
			<img alt="Diginova" src="/xweb/public/images/diginovasubbanner1.png" class="img_banner_categorias" style="margin: 15px 16px 15px 16px; max-width: 1224px;" />
			<div class="catContGrupos1" style="min-height: 340px;">
				<?php
				$topSubCategoria = 25;
				$leftSubCategoria = -10;
				$zindexSubCategoria = 999;
				$numCeldasSubCategoria = 0;
				?>
				@foreach($arrSubCategorias as $arrSubCategoria)
					<?php
					$zindexSubCategoria -= 1;
					?>
					<div class="catGrupo" onmouseover="mostrarCatGrupo(this)" onmouseleave="ocultarCatGrupo(this)" style="position: absolute; top: <?php echo $topSubCategoria ?>px; left: <?php echo $leftSubCategoria ?>px; z-index: <?php echo $zindexSubCategoria ?>; height: 72px;">
						<div class="catGrupoFila">
							<div class="catGrupoC1">{{$arrSubCategoria->GDES}}</div>
							<div class="catGrupoC2">
								<img height="70" src="/xweb/public/images/catgrupoicon{{$arrSubCategoria->GCOD}}.png" />
							</div>
						</div>
						<div class="catGFams">
							<ul>
								@foreach($arrFamilias as $arrFamilia)
									@if ($arrFamilia->FGRUPO == $arrSubCategoria->GCOD)
										<li>
											<a href="/xweb/familia/{{$arrFamilia->FCOD}}">{{$arrFamilia->FDES}}</a>
										</li>
									@endif
								@endforeach
							</ul>
						</div>
					</div>
					<?php
					$leftSubCategoria += 419;
					$numCeldasSubCategoria += 1;

					if ($numCeldasSubCategoria % 3 == 0 && $numCeldasSubCategoria > 0)
					{
						$topSubCategoria += 110;
						$leftSubCategoria = -10;
					}
					?>
				@endforeach
			</div>

			<div class="catContGrupos1 catSubt" style="min-height: auto; padding-left: 26px; margin-top: 15px;">Accesorios de teléfonos y tablets destacados</div>
		@endif

		@if ($categoria == 1127)
			<div class="homeElementConsumibles">
				<div class="homeContArts"> 
					@if (count($arrAccesorios) == 0)
						Actualmente no hay artículos en esta sección :(
					@else
						@php
						$leftArticulo = -311;
						$sumaLeftArticulo = 311;
						$widthArticulo = 250;
						$topArticulo = 0;
						$arrArticulos = $arrAccesorios;
						$esAccesorioComponente = true;
						$esFilaOfertas = false;
						@endphp

						@include("celda_articulo")
					@endif
				</div>
			</div>

			<div class="homeElementConsumibles">
				<div class="catSubt catSubtBord">Componentes destacados</div>
				<div class="homeContArts">
					@if (count($arrComponentes) == 0)
						Actualmente no hay artículos en esta sección :(
					@else
						@php
						$leftArticulo = -311;
						$sumaLeftArticulo = 311;
						$widthArticulo = 250;
						$topArticulo = 0;
						$arrArticulos = $arrComponentes;
						$esAccesorioComponente = true;
						$esFilaOfertas = false;
						@endphp

						@include("celda_articulo")
					@endif
				</div>
			</div>
		@endif

	</div>

	<script type="text/javascript">
		function toggleOrden(criterio) {

			$('#catOrd1').removeClass('catOrd');
			$('#catOrd2').removeClass('catOrd');
			$('#catOrd3').removeClass('catOrd');
			$('#catOrd1').removeClass('catOrdNeg');
			$('#catOrd2').removeClass('catOrdNeg');
			$('#catOrd3').removeClass('catOrdNeg');
			$('#catOrd1').addClass('catOrd');
			$('#catOrd2').addClass('catOrd');
			$('#catOrd3').addClass('catOrd');

			$('#catOrd' + criterio).addClass('catOrdNeg');
		}

		function toggleClaseFiltros(e, t) {
		    /*if (4 == e) {
		        var r = document.getElementsByClassName("fbValor_2");
		        for (i = 0; i < r.length; i++) r[i].className = "fbValor "
		    }*/
		    /*var n = document.getElementById(t);
		    "fbValor " == n.className ? n.className = "fbValor fbValor_2" : n.className = "fbValor "*/
		    var n = document.getElementById(t);
		    "catFilt " == n.className ? n.className = "catFilt catFilt_2" : n.className = "catFilt "
		}

		function toggleClaseFiltrosIcon(e, t) { 
			var n = document.getElementById(t);
			var imageFilt = document.getElementById("imgfil" + t);
			
		    if ("catFilt " == n.className )
		    {
		    	n.className = "catFilt catFilt_2"; imageFilt.src = "/xweb/public/images/filtricon" + t + "on.png";
		    }
		    else
		    {
		     	n.className = "catFilt "; imageFilt.src = "/xweb/public/images/filtricon" + t + ".png"
		    }
		}

		function toggleClaseFiltrosCheck(e, t) {
		    var n = document.getElementById(t);
		    "catFilt " == n.className ? n.className = "catFilt catFilt_2" : n.className = "catFilt "
		}

		function toggleClaseFiltrosMarca(e, t, elemento, idMarca = 0) {



		    /*if (4 == e) {
		        var r = document.getElementsByClassName("fbValor_2");
		        for (i = 0; i < r.length; i++) r[i].className = "fbValor "
		    }*/
		    /*var n = document.getElementById(t);
		    "fbValor " == n.className ? n.className = "fbValor fbValor_2" : n.className = "fbValor "*/
		    var n = document.getElementById(idMarca);
		    "catFilt " == n.className ? n.className = "catFilt catFilt_2" : n.className = "catFilt "

		    if (elemento.classList.contains('catFilt_2'))
		    {
		    	elemento.className = "catFilt ";
		    }
		    else
		    {
		    	elemento.className = "catFilt catFilt_2";
		    }

		    $('#filtradosCat .celdaArt').each(function()
        	{
        		var nombreArt = $(this).find('.celdaDesc').text();

        		if (nombreArt.indexOf(t) > -1)
        		{
        			$(this).addClass('fil' + idMarca);
        		}
        	});
		}
	</script>

	<script type="text/javascript">
		//toggleClaseFiltrosIcon('<?php echo $indiceCategoria; ?>', '<?php echo $f2; ?>');
		//filtroAjaxCatCheck2( 1, 17, 0, );
	</script>

	<script type="text/javascript">

	    $(document).ready(function() 
	    {
	    	visualizarFiltros();
	        /*$('#mytabsFilts [data-accordion]').accordion({singleOpen: false});

	        $('#multiple [data-accordion]').accordion({
	          singleOpen: false
	        });

	        $('#single[data-accordion]').accordion({
	          transitionEasing: 'cubic-bezier(0.455, 0.030, 0.515, 0.955)',
	          transitionSpeed: 200
	        });*/
	    });
	</script>
@endsection

<?php
function col1MostrarFiltro($numFiltro1, $numFiltro2, $descFiltro, $indiceCategoria)
{
	$numtari = 0;

	if($_SESSION['x_usuario']->_conectado==true)
	{
		$numtari = $_SESSION['x_usuario']->_tarifa;
	} 

	?>

	<div class="fbValor " id="<?php echo $numFiltro2; ?>" value="<?php echo $numFiltro2; ?>" 
		onclick="toggleClaseFiltros('<?php echo $indiceCategoria; ?>', '<?php echo $numFiltro2; ?>');
				 filtroAjaxCat( <?php echo $indiceCategoria; ?>, <?php echo $numFiltro2; ?>, <?php echo $numtari; ?> );
				  ">
		<?php echo $descFiltro; ?>
	</div> 

	<?php
}

function col1MostrarFiltroMarca($numFiltro1, $numFiltro2, $descFiltro, $indiceCategoria, $nomImagen = "")
{
	$nomMarca = strtoupper($descFiltro);

	$numtari = 0; $ccodcl = 0;

	?>
	@if(session('usuario')->uData->codigo==0)
		@php
		$numtari = session('usuario')->uData->ctari;
		@endphp
	@endif

	@if ($numtari == "")
		@php
		$numtari = 0;
		@endphp
	@endif

	<div class="catFilt " id="<?php echo $numFiltro2; ?>" value="<?php echo $numFiltro2; ?>" 
		onclick=" calcularAlturaContenedorArticulos();  ocultarGrupoFiltros();/*toggleClaseFiltrosMarca('<?php echo $indiceCategoria; ?>', '<?php echo $descFiltro; ?>', this, <?php echo $numFiltro2; ?>);
				 filtroAjaxCatCheck2( <?php echo $indiceCategoria; ?>, <?php echo $numFiltro2; ?>, <?php echo $numtari; ?>, <?php echo $ccodcl; ?>);
				 filtroTienda( <?php echo $indiceCategoria; ?>, <?php echo $numFiltro2; ?>, '', <?php echo $ccodcl; ?>);*/">
		@if ($indiceCategoria == 5)
			<div class="catFilt1" style="width: 25px !important">
				<div class="filtro_cuadr"></div>
			</div>
			<div class="catFilt2"><?php echo $descFiltro ?></div> 
		@else
			<img alt="<?php echo $descFiltro; ?>" src="/xweb/public/images/marcas/<?php echo $nomMarca; ?>.png" />
		@endif
	</div> 

	<?php
}
?>

<script type="text/javascript">

function filtroAjaxCatCheck2(codCat, codFilt, tarifa, ccodcl, minP = -1, maxP = -1, ordenar = 0) 
{
    setTimeout(function()
    {
        if ($("#catOrd1").hasClass("catOrdNeg")) 
        {
            ordenar = 0;
        }

        if ($("#catOrd2").hasClass("catOrdNeg")) 
        {
            ordenar = 1;
        }

        if ($("#catOrd3").hasClass("catOrdNeg")) 
        {
            ordenar = 2;
        }

        $('#filtradosCat .celdaArt').each(function()
        {
            $(this).css('display', 'none');
        });

        if (codCat == 5)
        {
            leftCelda = -315;
        }
        else
        {
            leftCelda = -225;
        }

        var topCelda = 0;
        var numCeldas = 0;
        var filtroPulsado = false;
        var arrFiltrosActivos = [];
        var hayFiltrosActivos = false;
        var arrArticulosFiltrados = [];
        var arrPrecioArtsFiltrados = [];
        var arrRefArtsFiltrados = [];

        $('#filtradosCat .celdaArt').each(function()
        {
            var tieneFiltrosDeTodasLasCategorias = true;

            var clasesFilArticulo = $(this).attr("class");
            clasesFilArticulo = clasesFilArticulo.replaceAll("fil", "");

            var arrClasesFilArticulo = clasesFilArticulo.split(' ');

            $('.catFilGru').each(function()
            {
                hayFiltrosActivos = true;
                var tieneFiltrosActivos = false;
                var artTieneFiltrosDeEstaCategoria = false;

                $('.catFilt_2', this).each(function()
                {
                    tieneFiltrosActivos = true;

                    for (var i = 0; i < arrClasesFilArticulo.length; i++)
                    {
                        if (arrClasesFilArticulo[i] == $(this).attr('id'))
                        {
                            artTieneFiltrosDeEstaCategoria = true;
                        }
                    }
                });

                if (tieneFiltrosActivos && !artTieneFiltrosDeEstaCategoria)
                {
                    tieneFiltrosDeTodasLasCategorias = false;
                }
            });

            if (tieneFiltrosDeTodasLasCategorias)
            {
                if ($(this).is(":hidden"))
                {
                    var refArticulo = $(this).find('#refArticulo').val();

                    var precioArticulo = $(this).find('.celdaPrecio').text();
                    precioArticulo = parseInt(precioArticulo);

                    arrArticulosFiltrados.push([refArticulo, precioArticulo]);

                    if (ordenar == 0)
                    {
                        $(this).css('display', 'block');
                        $(this).css('top', topCelda + 'px');
                        $(this).css('left', leftCelda + 'px');

                        numCeldas += 1;
                        
                        if (codCat == 5)
                        {
                            leftCelda += 315;
                        }
                        else
                        {
                            leftCelda += 225;
                        }

                        if ((numCeldas % 4) == 0)
                        {
                            topCelda += 430;
                            leftCelda = 0;
                        }
                    }
                }
            }
        });

        if (numCeldas == 0 && hayFiltrosActivos == false)
        {
            $('#filtradosCat .celdaArt').each(function()
            {
                $(this).css('display', 'block');
                $(this).css('top', topCelda + 'px');
                $(this).css('left', leftCelda + 'px');

                numCeldas += 1;

                if (codCat == 5)
                {
                    leftCelda += 315;
                }
                else
                {
                    leftCelda += 225;
                }

                if ((numCeldas % 4) == 0)
                {
                    topCelda += 430;
                    leftCelda = 0;
                }
            });
        }
        else 
        {
            if (ordenar > 0)
            {
                arrArticulosFiltrados.sort(function(a, b){
                        return a[1] - b[1];
                    });

                if (ordenar == 1)
                {
                    var index, entry;

                    for (index = 0; index < arrArticulosFiltrados.length; ++index)
                    {
                        entry = arrArticulosFiltrados[index];

                        $('#filtradosCat .celdaArt').each(function()
                        {
                            var refArticulo = $(this).find('#refArticulo').val();

                            if (entry[0] == refArticulo)
                            {
                                $(this).css('display', 'block');
                                $(this).css('top', topCelda + 'px');
                                $(this).css('left', leftCelda + 'px');

                                numCeldas += 1;
                                leftCelda += 225;

                                if ((numCeldas % 4) == 0)
                                {
                                    topCelda += 430;
                                    leftCelda = 0;
                                }
                            }
                        });
                    }
                }
                else
                {
                    var index, entry;

                    for (index = arrArticulosFiltrados.length - 1; index >= 0; index--)
                    {
                        entry = arrArticulosFiltrados[index];

                        $('#filtradosCat .celdaArt').each(function()
                        {
                            var refArticulo = $(this).find('#refArticulo').val();

                            if (entry[0] == refArticulo)
                            {
                                $(this).css('display', 'block');
                                $(this).css('top', topCelda + 'px');
                                $(this).css('left', leftCelda + 'px');

                                numCeldas += 1;
                                leftCelda += 225;

                                if ((numCeldas % 4) == 0)
                                {
                                    topCelda += 430;
                                    leftCelda = 0;
                                }
                            }
                        });
                    }
                }
            }
        }
    }, 500);
}

function filtroAjaxCatCheck3(codCat, codFilt, tarifa, ccodcl, minP = -1, maxP = -1, ordenar = 0) 
{
    setTimeout(function()
    {
        if ($("#catOrd1").hasClass("catOrdNeg")) 
        {
            ordenar = 0;
        }

        if ($("#catOrd2").hasClass("catOrdNeg")) 
        {
            ordenar = 1;
        }

        if ($("#catOrd3").hasClass("catOrdNeg")) 
        {
            ordenar = 2;
        }

        $('.contArtsOcasionMv .celdaArt').each(function()
        {
            $(this).css('display', 'none');
        });

        var topCelda = 0;
        var leftCelda = 0;
        var numCeldas = 0;
        var filtroPulsado = false;
        var arrFiltrosActivos = [];
        var hayFiltrosActivos = false;
        var arrArticulosFiltrados = [];
        var arrPrecioArtsFiltrados = [];
        var arrRefArtsFiltrados = [];
        var ordenArt = 0;

        $('.contArtsOcasionMv .celdaArt').each(function()
        {
            var tieneFiltrosDeTodasLasCategorias = true;

            var clasesFilArticulo = $(this).attr("class");
            clasesFilArticulo = clasesFilArticulo.replaceAll("fil", "");

            var arrClasesFilArticulo = clasesFilArticulo.split(' ');

            $('.catFilGru').each(function()
            {
                hayFiltrosActivos = true;
                var tieneFiltrosActivos = false;
                var artTieneFiltrosDeEstaCategoria = false;

                $('.catFilt_2', this).each(function()
                {
                    tieneFiltrosActivos = true;

                    for (var i = 0; i < arrClasesFilArticulo.length; i++)
                    {
                        if (arrClasesFilArticulo[i] == $(this).attr('id'))
                        {
                            artTieneFiltrosDeEstaCategoria = true;
                        }
                    }
                });

                if (tieneFiltrosActivos && !artTieneFiltrosDeEstaCategoria)
                {
                    tieneFiltrosDeTodasLasCategorias = false;
                }
            });

            if (tieneFiltrosDeTodasLasCategorias)
            {
                if ($(this).is(":hidden"))
                {
                    var refArticulo = $(this).find('#refArticulo').val();

                    var precioArticulo = $(this).find('.celdaPrecio').text();
                    precioArticulo = parseInt(precioArticulo);

                    arrArticulosFiltrados.push([refArticulo, precioArticulo]);

                    if (ordenar == 0)
                    {
                        $(this).css('display', 'block');
                        $(this).css('top', topCelda + 'px');
                        $(this).css('left', leftCelda + 'px');

                        numCeldas += 1;
                        
                        if (codCat == 5)
                        {
                            leftCelda += 315;
                        }
                        else
                        {
                            leftCelda += 225;
                        }

                        if ((numCeldas % 4) == 0)
                        {
                            topCelda += 430;
                            leftCelda = 0;
                        }
                    }
                }
            }
        });

        if (numCeldas == 0 && hayFiltrosActivos == false)
        {
            $('.contArtsOcasionMv .celdaArt').each(function()
            {
                $(this).css('display', 'block');
                $(this).css('top', topCelda + 'px');
                $(this).css('left', leftCelda + 'px');

                numCeldas += 1;

                if (codCat == 5)
                {
                    leftCelda += 315;
                }
                else
                {
                    leftCelda += 225;
                }

                if ((numCeldas % 4) == 0)
                {
                    topCelda += 430;
                    leftCelda = 0;
                }
            });
        }
        else 
        {
            if (ordenar > 0)
            {
                arrArticulosFiltrados.sort(function(a, b){
                        return a[1] - b[1];
                    });

                if (ordenar == 1)
                {
                    var index, entry;

                    for (index = 0; index < arrArticulosFiltrados.length; ++index)
                    {
                        entry = arrArticulosFiltrados[index];

                        $('.contArtsOcasionMv .celdaArt').each(function()
                        {
                            var refArticulo = $(this).find('#refArticulo').val();

                            if (entry[0] == refArticulo)
                            {
                            	ordenArt += 1;

                                $(this).css('display', 'block');
                                $(this).css('order', ordenArt);
                                $(this).css('top', topCelda + 'px !important');
                                $(this).css('left', leftCelda + 'px !important');

                                numCeldas += 1;
                                leftCelda += 225;

                                if ((numCeldas % 4) == 0)
                                {
                                    topCelda += 430;
                                    leftCelda = 0;
                                }
                            }
                        });
                    }
                }
                else
                {
                    var index, entry;

                    for (index = arrArticulosFiltrados.length - 1; index >= 0; index--)
                    {
                        entry = arrArticulosFiltrados[index];

                        $('.contArtsOcasionMv .celdaArt').each(function()
                        {
                            var refArticulo = $(this).find('#refArticulo').val();

                            if (entry[0] == refArticulo)
                            {
                            	ordenArt += 1;

                                $(this).css('display', 'block');
                                $(this).css('order', ordenArt);
                                $(this).css('top', topCelda + 'px !important');
                                $(this).css('left', leftCelda + 'px !important');

                                numCeldas += 1;
                                leftCelda += 225;

                                if ((numCeldas % 4) == 0)
                                {
                                    topCelda += 430;
                                    leftCelda = 0;
                                }
                            }
                        });
                    }
                }
            }
        }
    }, 500);
}

function filtroTienda(codCat, codFilt, pvdPorcentaje, ccodcl, minP = -1, maxP = -1, ordenar = 0) { 

    var cadenaFiltros = "0,";
    var verdes = document.getElementsByClassName("catFilt catFilt_2");
    var i;
    for (i = 0; i < verdes.length; i++) 
    {
        cadenaFiltros = cadenaFiltros + verdes[i].id + ",";
    } 
    cadenaFiltros = cadenaFiltros.slice(0, -1);
    cadenaFiltros = cadenaFiltros.substring(2);

    url2 = "/xweb/filtrosactivos/" + codCat + "/" + cadenaFiltros;
    
    document.getElementById("filtrosActivos").style.display = "block";

    if (cadenaFiltros == "") { document.getElementById("filtrosActivos").style.display = "none"; }


   
    if (window.XMLHttpRequest) {
        reqFCat2 = new XMLHttpRequest();
        reqFCat2.onreadystatechange = processReqChangeCatCheckActiv;
        reqFCat2.open("GET", url2, true);
        reqFCat2.send(null);
        //  Internet Explorer
    } else if (window.ActiveXObject) {
        isIE = true;
        reqFCat2 = new ActiveXObject("Microsoft.XMLHTTP");
        if (reqFCat2) {
            reqFCat2.onreadystatechange = processReqChangeCatCheckActiv;
            reqFCat2.open("GET", url2, true);
            reqFCat2.send();
        }
    }
}

function processReqChangeCatCheckActiv() { 
    var campo = document.getElementById("filtrosActivos");

    if(reqFCat2.readyState == 4) {
        campo.innerHTML = reqFCat2.responseText;
    } else {
        campo.innerHTML = '<img width="30" height="30" src="/xweb/public/images/loading.gif" align="middle" /> Cargando...';
    }
}

function visualizarFiltros() {

	setTimeout(function() {

		$('.ulFiltros').children('div').each(function() {

			var idElement = $(this).attr('id');

			var hayArticulosConEsteFiltro = false;

			$('.celdaArt').each(function() 
			{
				if ($(this).hasClass('fil' + idElement))
				{
					if($(this).is(':visible'))
					{
						hayArticulosConEsteFiltro = true;
					}
				}
			});

			if (!hayArticulosConEsteFiltro)
			{
				$(this).css('display', 'none');
			}
			else
			{
				$(this).css('display', 'table');
			}
		});

		visualizarMarcas();
	}, 1000);
}

function visualizarMarcas()
{
	$('.catMarcasLogos').children('div').each(function() 
	{
		$(this).children('img').css('filter', 'grayscale(100%)');

		var hayArticulosConEstaMarca = false;
		var nombreMarca = $(this).children('img').attr('alt');

		$('.celdaArt').each(function() 
		{
			if($(this).is(':visible'))
			{
				var descrArticulo = $(this).children('.celdaDesc').children('a').text();

				descrArticulo = descrArticulo.toLowerCase();
				nombreMarca = nombreMarca.toLowerCase();

				if (descrArticulo.indexOf(nombreMarca) != -1)
				{
					hayArticulosConEstaMarca = true;
				}
			}
		});

		if (hayArticulosConEstaMarca)
		{
			$(this).children('img').css('filter', 'grayscale(0%)');
		}
	});
}

</script>
