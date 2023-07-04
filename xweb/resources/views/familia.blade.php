@extends("base")

@section("dashboard")

<div id='xw_boxcentral' class="famCont" style="margin-top: {{$marginTop}}; background: transparent;" >
	
	<title>Diginova - {{$catNombre}}</title>

	<div class="catTitulo" style="display: none;">
		<div class="catTituloT" style="{{$strStylesTit}}" >
		
			<div class="catTituloT1" style="{{$strStylesTit1}}" >{{$catDes}}</div>
			<div class="catTituloT2">
				<img alt="{{$catDes}}" src="images/categorialogo{{$codCat}}.png" />
			</div>
		</div>
	</div>

	<div class="grCab">
		<div class="grCab1">
			<div class="grCab11 contEstasEn">
				@if ($codCat != 1160)
					<a href="/xweb">Home</a>&nbsp;&nbsp;|
					&nbsp;
					<a href="/xweb{{$urlCat}}" >{{$catDes}}</a>&nbsp;&nbsp;|
					&nbsp;
					<a href="/xweb/familia/{{$fCod}}" >
						@if ($fCod == '652653658654650660657651659')
							'Cargadores de Portátiles';
						@else
							{{$fDes}}
						@endif
					</a>
				@endif
			</div>
			<div class="grCab12">
				@if ($esConsumibles)
					<div class="grCab12Txt">{{$nomFamiliaF}}</div>
					<div class="grCab12Img">
						<img alt="{{$nomFamiliaF}}" src="../public/images/{{$nomFoto}}" />
					</div>
				@else
					@if ($fCod == '652653658654650660657651659')
						Cargadores de Portátiles
					@else
						{{$fDes}}
					@endif
				@endif
			</div>
		</div>
		<div class="grCab2" style="visibility: hidden;">
			<div class="grCab21">
				<div class="grCab21Ord">Ordenar por</div>
				<div class="grCab21NumArts">
					@if ($numArticulosTotal == 1) 
						1 artículo
					@else 
						{{$numArticulosTotal}} artículos
					@endif
				</div>
			</div>

			@if(session('usuario')->uData->codigo>0)
				<div class="grCab22">
					<div>
						<a href="/xweb/familia/{{$fCod}}/1" class="catOrd" id="catOrd1">Relevancia</a>
					</div>
					<div style="text-align: center;">
						<a href="/xweb/familia/{{$fCod}}/2" class="catOrd " id="catOrd2">Más baratos</a>
					</div>
					
					<div style="text-align: right;">
						<a href="/xweb/familia/{{$fCod}}/3" class="catOrd " id="catOrd3">Mayor precio</a>
					</div>
				</div>
			@else
				<div class="grCab22">
					<div><a class="catOrd catOrdNeg">Relevancia</a></div>
					<div style="text-align: center;"><a class="catOrdDesac">Más baratos</a></div>
					<div style="text-align: right;"><a class="catOrdDesac">Mayor precio</a></div>
				</div>
			@endif
		</div>

		@if(session('usuario')->uData->codigo>0)

			@if ($esConsumibles)
				<div class="grCabFilt">
					<div class="grCabFiltCont">
						<div class="grCabFilt1">
							<div class="catFilt " id="1" value="1" 
								onclick="toggleClaseFiltrosCheck('{{$fCod}}', '1');
										 filtroAjaxConsumibles( {{$fCod}}, 1, {{$tarifa}} ); ">
								
								<div class="catFilt1"><div class="filtro_cuadr"></div></div>
								<div class="catFilt2">Color</div>
							</div>
						</div>

						<div class="grCabFilt1">
							<div class="catFilt " id="2" value="2" 
								onclick="toggleClaseFiltrosCheck('{{$fCod}}', '2');
										 filtroAjaxConsumibles( {{$fCod}}, 2, {{$tarifa}} ); ">
								
								<div class="catFilt1"><div class="filtro_cuadr"></div></div>
								<div class="catFilt2">Cian</div>
							</div>
						</div>

						<div class="grCabFilt1">
							<div class="catFilt " id="3" value="3" 
								onclick="toggleClaseFiltrosCheck('{{$fCod}}', '3');
										 filtroAjaxConsumibles( {{$fCod}}, 3, {{$tarifa}} ); ">
								
								<div class="catFilt1"><div class="filtro_cuadr"></div></div>
								<div class="catFilt2">Magenta</div>
							</div>
						</div>
						
						<div class="grCabFilt1">
							<div class="catFilt " id="4" value="4" 
								onclick="toggleClaseFiltrosCheck('{{$fCod}}', '4');
										 filtroAjaxConsumibles( {{$fCod}}, 4, {{$tarifa}} ); ">
								
								<div class="catFilt1"><div class="filtro_cuadr"></div></div>
								<div class="catFilt2">Amarillo</div>
							</div>
						</div>

						<div class="grCabFilt1">
							<div class="catFilt " id="5" value="5" 
								onclick="toggleClaseFiltrosCheck('{{$fCod}}', '5');
										 filtroAjaxConsumibles( {{$fCod}}, 5, {{$tarifa}} ); ">
								
								<div class="catFilt1"><div class="filtro_cuadr"></div></div>
								<div class="catFilt2">Negro</div>
							</div>
						</div>
					</div>
				</div>
			@endif

		@endif
	</div>

	<div class="homeElement homeElement2">
		@php
		$numFilasArt = count($arrArticulos) / 4;
		$numFilasArt = ceil($numFilasArt);
		$heightFiltradosCat = $numFilasArt * 430;
		@endphp
		<div class="homeContArts" id="homeContArts" style="height: {{$heightFiltradosCat}}px">

			@if (count($arrArticulos) == 0)
				Actualmente no hay artículos en esta sección :(
			@else
				<?php
				$leftArticulo = -225;
				$sumaLeftArticulo = 225;
				
				$widthArticulo = 200;
				$topArticulo = 0;
				$esAccesorioComponente = false;
				$esFilaOfertas = false;
				?>

				@include("celda_articulo")
			@endif

		</div>

		@if (!$mostrandoTodo && $numArticulosTotal > 12) 
			<div class="famVermas" id="famVermas">
				Ver más
			</div>
		@endif
	</div>

</div>

@endsection