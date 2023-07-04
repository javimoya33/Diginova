@extends("base")

@section("titulo")
	{{session("entorno")->config->x_nomemp}}
@endsection

@section("localizador")
	<!--
	{{Cookie::get('idioma', '1')}}
	@if(Cookie::get('idioma', '1')==1)
		<< código para idioma 1 >>
	@endif
	@if(Cookie::get('idioma', '1')==2)
		<< código para idioma 2 >>
	@endif
	@if(Cookie::get('idioma', '1')==3)
		<< código para idioma 3 >>
	@endif
	-->
	@if($seccion=="inicio")

		<!--<script src="{{URL::asset('public/js/jquery.min.js')}}"></script>-->
		<script src="{{URL::asset('public/js/jssor.slider.min.js')}}"></script>
		<script src="{{URL::asset('public/js/jssor.slider-27.4.0.min.js')}}" type="text/javascript"></script>
		<script src="{{URL::asset('public/js/jquery.dcmegamenu.1.3.3.js')}}" type="text/javascript"></script>
		<script src="{{URL::asset('public/js/jquery.dcmegamenu.1.3.3.min.js')}}" type="text/javascript"></script>
		<script src="{{URL::asset('public/js/jssor.slider-27.4.0.min.js')}}" type="text/javascript"></script>
		<script src="{{URL::asset('public/js/jquery.hoverIntent.minified.js')}}" type="text/javascript"></script>
		<script>
		    jQuery(document).ready(function ($) {

		    	var jssor_1_SlideoTransitions = [
	            	[{b:-1,d:1,o:-0.7}],
	              	[{b:900,d:2000,x:-379,e:{x:7}}],
	              	[{b:900,d:2000,x:-379,e:{x:7}}],
	              	[{b:-1,d:1,o:-1,sX:2,sY:2},{b:0,d:900,x:-171,y:-341,o:1,sX:-2,sY:-2,e:{x:3,y:3,sX:3,sY:3}},{b:900,d:1600,x:-283,o:-1,e:{x:16}}]
	            ];

		        var options = { 
		        	$AutoPlay: 1,
		        	$Idle: 5000,
              		$SlideDuration: 800,
              		$SlideEasing: $Jease$.$OutQuint,
              		$CaptionSliderOptions: {
		            	$Class: $JssorCaptionSlideo$,
		                $Transitions: jssor_1_SlideoTransitions
		            },
		            $ArrowNavigatorOptions: {
		                $Class: $JssorArrowNavigator$
		            },
		            $BulletNavigatorOptions: {
		                $Class: $JssorBulletNavigator$
		            }
		        };
		        var jssor1_slider = new $JssorSlider$("jssor_1", options);

		        var MAX_WIDTH = 3000;

	            function ScaleSlider() {
	                var containerElement = jssor1_slider.$Elmt.parentNode;
	                var containerWidth = containerElement.clientWidth;

	                if (containerWidth) {

	                    var expectedWidth = Math.min(MAX_WIDTH || containerWidth, containerWidth);

	                    jssor1_slider.$ScaleWidth(expectedWidth);
	                }
	                else {
	                    window.setTimeout(ScaleSlider, 40);
	                }
	            }

	            ScaleSlider();

	            $Jssor$.$AddEvent(window, "load", ScaleSlider);
	            $Jssor$.$AddEvent(window, "resize", ScaleSlider);
	            $Jssor$.$AddEvent(window, "orientationchange", ScaleSlider);
		    });
		</script>
		<div id="jssor_1" style="position:relative;margin:0 auto;top:0px;left:0px;width:1500px;height:582px;overflow:hidden;">
		    <div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:1500px;height:582px;overflow:hidden;">
		    	@foreach(session('entorno')->arrNumBannerAMostrar as $arrNumBannerAMostrar)
			        <div>
			        	@if ($arrNumBannerAMostrar == 23)
			        		<a href="/xweb/nosotros/calidadymedioambiente" target="_blank">
			        			<!--<img data-u="image" src="public/images/banners/banner{{$arrNumBannerAMostrar}}.webp" />-->

								<img data-u="image"     src="/xweb/public/images/banners/banner{{$arrNumBannerAMostrar}}.webp" data-src="/xweb/public/images/banners/banner{{$arrNumBannerAMostrar}}.webp" 
									alt="">
			        		</a>
			        	@else
			        		<!--<img data-u="image" src="public/images/banners/banner{{$arrNumBannerAMostrar}}.webp" />-->
							<img data-u="image"   src="/xweb/public/images/banners/banner{{$arrNumBannerAMostrar}}.webp" data-src="/xweb/public/images/banners/banner{{$arrNumBannerAMostrar}}.webp" 
								 alt="">
			        	@endif
		        	</div>
		        @endforeach
		    </div>
		    <div data-u="navigator" class="jssorb032" style="position:absolute;bottom:12px;right:12px;" data-autocenter="1" data-scale="0.5" data-scale-bottom="0.75">
	            <div data-u="prototype" class="i" style="width:16px;height:16px;">
	            	
	                <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
	                    <circle class="b" cx="8000" cy="8000" r="5800"></circle>
	                </svg>
	            </div>
	        </div>
		</div>

		

		
	    <script src="{{URL::asset('public/js/jquery.cslider.js')}}"></script>
		@if(strlen(session('entorno')->config->x_txtcab)>0)
		<div id="textoEncabezado" class="centrado">{!!session('entorno')->config->x_txtcab!!}</div>
		@endif

		<div style="background-color: #fff"><?php /*var_dump(session('entorno'));*/ ?></div>
	@endif

	@if($seccion=="especial")
	<!--@if($registros==0)
	<h1>{{T::tr('No hay datos')}}</h1>
	@endif
	@if($registros>0)
	<a href="{{URL::to('especial/'.$idmenu.'/'.Utils::urlenc($titulo).'/1')}}" title="{{Utils::urlenc($titulo,2)}}">{{Utils::urlenc($titulo,2)}}</a>
	@include("botonordenar")
	@endif-->
	@endif
	@if($seccion=="seguimiento")
	<h1><a href="{{URL::to('seguimiento')}}" title="{{T::tr('Productos en seguimiento')}}">{{T::tr('Productos en seguimiento')}}</a><small>&nbsp;{{T::tr('puede eliminar de seguimiento pulsando el clip')}}</small></h1>
	@include("botonordenar")
	@endif
	@if($seccion=="compras")
	<h1><a href="{{URL::to('micuenta')}}" title="{{T::tr('Mi cuenta')}}">{{T::tr('Mi cuenta')}}</a><small>{{T::tr('Productos que he comprado')}}</small></h1>
	@include("botonordenar")
	@endif
	@if($seccion=="avisos")
	<h1><a href="{{URL::to('avisos')}}" title="{{T::tr('Productos con avisos')}}">{{T::tr('Productos con avisos')}}</a><small>{{T::tr('productos sin stock, recibirá un aviso cuando se disponga de stock')}}</small></h1>
	@include("botonordenar")
	@endif
	@if($seccion=="buscar")
		<!-- <h1>{{T::tr('Búsqueda de productos. Buscar')}} '{{session('articulo')->matBusquedas->texto}}'<small></small></h1> -->
		<h1>{{T::tr('Búsqueda de productos. Buscar')}} {{session('articulo')->matBusquedas->texto}}<small></small></h1>
		@include("botonordenar")
	@endif
@endsection


@section("dashboard")
	@if(session('entorno')->config->x_oculart && session("usuario")->uData->codigo==0)
		<div class="alert alert-danger text-left" role="alert" style=''>{{T::tr('Inicie sesión o regístrese para visualizar los productos')}}.</div>
	@endif
	<!--@if(session('entorno')->config->x_oculpre && session("usuario")->uData->codigo==0 && $seccion!="buscar")
		<div class="col-xs-12 alert alert-danger text-left" role="alert" style=''>
		{{T::tr('Inicie sesión o regístrese para visualizar los precios de los productos')}}.</div>
	@endif-->
	@if($seccion=="buscar")
		<h4>{{T::tr('Afine la búsqueda')}}:<small></small></h4>
		@include("busquedaavanzada")
	@endif
	@if($seccion=="seccion")
		@include("propiedades")
	@endif
@endsection
@section("central")
	<div id="div_central_portada_mv" class="fCelda fCelda5">
		<table class="table_categoria_mv">
			<tr>
				<td class="td_categoria_mv">
					<table class="table_categoria_mv_table">
						<tr>
							<td class="td_categoria_mv_td">
								<a href="/xweb/categoria/1125">
									<div class="div_img_categoria_mv">
										<img src="/xweb/public/images/ordenador_portada_mv.png">
									</div>
								</a>
							</td>
							<td class="td_categoria_mv_td">
								<a href="/xweb/categoria/1126">
									<div class="div_img_categoria_mv">
										<img src="/xweb/public/images/portatil_portada_mv.png">
									</div>
								</a>
							</td>
						</tr>
						<tr>
							<td class="td_categoria_mv_td">
								<a href="/xweb/categoria/1125">
									<div class="div_txt_categoria_mv">Ordenadores</div>
								</a>
							</td>
							<td class="td_categoria_mv_td">
								<a href="/xweb/categoria/1126">
									<div class="div_txt_categoria_mv">Portátiles</div>
								</a>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td class="td_categoria_mv">
					<table class="table_categoria_mv_table">
						<tr>
							<td class="td_categoria_mv_td">
								<a href="/xweb/categoria/1118">
									<div class="div_img_categoria_mv">
										<img src="/xweb/public/images/monitor_portada_mv.png">
									</div>
								</a>
							</td>
							<td class="td_categoria_mv_td">
								<a href="/xweb/categoria/1160">
									<div class="div_img_categoria_mv">
										<img src="/xweb/public/images/apple_portada_mv.png">
									</div>
								</a>
							</td>
						</tr>
						<tr>
							<td class="td_categoria_mv_td">
								<a href="/xweb/categoria/1118">
									<div class="div_txt_categoria_mv">Monitores</div>
								</a>
							</td>
							<td class="td_categoria_mv_td">
								<a href="/xweb/categoria/1160">
									<div class="div_txt_categoria_mv">Apple</div>
								</a>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td class="td_categoria_mv">
					<table class="table_categoria_mv_table">
						<tr>
							<td class="td_categoria_mv_td">
								<a href="/xweb/categoria/1127">
									<div class="div_img_categoria_mv">
										<img src="/xweb/public/images/otros_portada2_mv.png">
									</div>
								</a>
							</td>
							<td class="td_categoria_mv_td">
								<a href="/xweb/ofertas">
									<div class="div_img_categoria_mv">
										<img src="/xweb/public/images/ofertas_portada3_mv.png">
									</div>
								</a>
							</td>
						</tr>
						<tr>
							<td class="td_categoria_mv_td">
								<a href="/xweb/categoria/1127">
									<div class="div_txt_categoria_mv">Otros</div>
								</a>
							</td>
							<td class="td_categoria_mv_td">
								<a href="/xweb/ofertas">
									<div class="div_txt_categoria_mv">Ofertas</div>
								</a>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</div>
	<div id="div_central_portada">
		<div class="fCelda fCelda5" style="padding: 0px; background-image: url('/xweb/public/images/barra-degradado.jpg'); margin: 0px; width: 100%;">
			<div class="fCelda51" style="width: 1244px; margin: 0 auto; display: flex;">
				<div class="ffCol ffCol-first" style="width: 610px; float: left; padding: 25px 0px;">
					<div class="ffCol1" style="width: 600px; padding: 0px; float: left;">
						<div class="homeTitu2 homeTitu2A homeOrdenadores">
							<a href="/xweb/categoria/1125">Ordenadores ocasión</a>
						</div>
					</div>
				</div>
				<div class="ffCol-second" style="width: 692px; display: flex;">
					<div class="ffCol">
						<div class="ffCol1">
							<img alt="2 años de Garantía" src="{{URL::asset('public/images/garantia.webp')}}" width="165" />
						</div>
					</div>
					<div class="ffCol">
						<div class="ffCol1">
							<img alt="Respuesta en 24h" src="{{URL::asset('public/images/rma.webp')}}" width="165" />
						</div>
					</div>
					<div class="ffCol">
						<div class="ffCol1">
							<img alt="1 mes para doa" src="{{URL::asset('public/images/doa.webp')}}" width="165" />
						</div>
					</div>
				</div>
			</div>
		</div>



		<div class="homeElement" style="padding-top: 140px">
			<div class="homeTitu">
				<div class="homeTitu1">&nbsp;</div>
				<div class="homeTitu2 homeTitu2A">
					<a style="color: #ff1d25;">Últimas entradas</a>
				</div>
				<div class="homeTitu1">&nbsp;</div>
			</div>

			<div class="homeContArts">
				<?php
					$leftArticulo = -328;
					$sumaLeftArticulo = 328;
					$widthArticulo = 250;
					$topArticulo = 0;
					//$arrArticulos = $arrPortatiles;
					$arrArticulos = array();
					if (isset($arrUltimasEntradas1) ) { $arrArticulos = $arrUltimasEntradas1; }
					$esAccesorioComponente = false;
					$esFilaOfertas = false;
				?>

				@include("celda_articulo")

			</div>
		</div>


		<div class="homeElement" style="padding-top: 0">

			<div class="homeContArts">
				<?php
					$leftArticulo = -328;
					$sumaLeftArticulo = 328;
					$widthArticulo = 250;
					$topArticulo = 0;
					//$arrArticulos = $arrPortatiles;
					$arrArticulos = array();
					if (isset($arrUltimasEntradas2) ) { $arrArticulos = $arrUltimasEntradas2; }
					$esAccesorioComponente = false;
					$esFilaOfertas = false;
				?>

				@include("celda_articulo")

			</div>
		</div>



		<div  class="homeElement">
			<a target="_blank" href="/xweb/categoria/1118">
				<img src="{{URL::asset('public/images/bannerhomme_monitores_diginova-24.webp')}}" class="img_banner_index">

				<!--<img width="1281" height="350" class="lazy" src="/xweb/public/articulos/nofoto.jpg" data-src="{{URL::asset('public/images/bannerhomme_monitores_diginova-24.webp')}}" 
									data-srcset="nofoto.jpg 2x, {{URL::asset('public/images/bannerhomme_monitores_diginova-24.webp')}} 1x" alt="">-->
			</a>
		</div>


		<div class="homeElement" <?php if (session('usuario')->margenesActivo == 1) { ?> style="margin-bottom: 75px" <?php } ?>>
			<div class="homeTitu">
				<div class="homeTitu1">&nbsp;</div>
				<div class="homeTitu2 homeTitu2A">
					<a href="/xweb/categoria/1125">Ordenadores ocasión</a>
				</div>
				<div class="homeTitu1">&nbsp;</div>
			</div>

			<div class="homeContArts">
				<?php
					$leftArticulo = -328;
					$sumaLeftArticulo = 328;
					$widthArticulo = 250;
					$topArticulo = 0;
					//$arrArticulos = $arrOrdenadores;
					$arrArticulos = array();
					if (isset($arrOrdenadores) ) { $arrArticulos = $arrOrdenadores; }
					$esAccesorioComponente = false;
					$esFilaOfertas = false;


				?>

				@include("celda_articulo")

			</div>
		</div>





		<div class="homeElement" <?php if (session('usuario')->margenesActivo == 1) { ?> style="margin-bottom: 75px" <?php } ?>>
			<div class="homeTitu">
				<div class="homeTitu1">&nbsp;</div>
				<div class="homeTitu2 homeTitu2A">
					<a href="/xweb/categoria/1126">Portátiles ocasión</a>
				</div>
				<div class="homeTitu1">&nbsp;</div>
			</div>

			<div class="homeContArts">

				<?php
					$leftArticulo = -328;
					$sumaLeftArticulo = 328;
					$widthArticulo = 250;
					$topArticulo = 0;
					//$arrArticulos = $arrPortatiles;
					$arrArticulos = array();
					if (isset($arrPortatiles) ) { $arrArticulos = $arrPortatiles; }
					$esAccesorioComponente = false;
					$esFilaOfertas = false;


				?>

				@include("celda_articulo")


			</div>

		</div>

		<div class="homeElement" <?php if (session('usuario')->margenesActivo == 1) { ?> style="margin-bottom: 75px" <?php } ?>>
			<div class="homeTitu">
				<div class="homeTitu1">&nbsp;</div>
				<div class="homeTitu2 homeTitu2A">
					<a href="/xweb/categoria/1118">Monitores ocasión</a>
				</div>
				<div class="homeTitu1">&nbsp;</div>
			</div>

			<div class="homeContArts">

				<?php
					$leftArticulo = -328;
					$sumaLeftArticulo = 328;
					$widthArticulo = 250;
					$topArticulo = 0;
					//$arrArticulos = $arrMonitores;
					$arrArticulos = array();
					if (isset($arrMonitores) ) { $arrArticulos = $arrMonitores; }
					$esAccesorioComponente = false;
					$esFilaOfertas = false;


				?>

				@include("celda_articulo")

			</div>

		</div>
	</div>
@endsection

@section("campos_meta")
<meta name="keywords" content="{{session('entorno')->config->x_pclavepag}}"/>
<meta name="description" content="{{session('entorno')->config->x_descripag}}"/>
<link rel="canonical" href="{{URL::current()}}" />
<meta name="robots" content="follow, index"/>
@endsection

@section("central")

@if($seccion=="seccion"||$seccion=="especial"||$seccion=="buscar")
	@include("paginacion")
	@include("selectores")
@endif

@if($seccion=="seccion"||$seccion=="especial"||$seccion=="buscar")
@include("paginacion")
@endif

@endsection