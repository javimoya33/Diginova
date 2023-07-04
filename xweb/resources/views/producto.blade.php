@extends("base")

@section("titulo")
{{$barti->adescr}}
@endsection

@section("dashboard")
@endsection

@section("localizador")
	<h1>{{$barti->adescr}}</h1>
		<small>&nbsp;<strong>Cod: {{$barti->acodar}}</strong></small>
	@if(strlen($barti->alt2)>0)
		<small>&nbsp;&nbsp;P/N: {{$barti->alt2}}</small>
	@endif
	@if(strlen($barti->partnumber)>0)
		<small>&nbsp;&nbsp;P/N: {{$barti->partnumber}}</small>
	@endif
	@if(strlen($barti->alt1)>0)
		<small>&nbsp;&nbsp;EAN: {{$barti->alt1}}</small>
	@endif
	@if(strlen($barti->alt3)>0)
		<small>&nbsp;&nbsp;EAN: {{$barti->alt3}}</small>
	@endif
	@if($barti->visitados24h>0)
		<br/><span class="badge badge-primary" style="background-color:red">{{T::tr('visto')}} {{$barti->visitados24h}} {{$barti->visitados24h==1?T::tr('vez'):T::tr('veces')}} {{T::tr('en las últimas 24 horas')}}</span>
	@endif
	@if($barti->atallacol=='D')
		@if(isset(session('entorno')->config->x_agrutc))
			@if(session('entorno')->config->x_agrutc)
					<div class="dropdown" style="margin-top:10px;">
						<button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
							{{$barti->adescr}}
							<span class="caret"></span>
						</button>
						<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
							@foreach($barti->tallascolores as $x)
								@if($x->acodarencoded!=$barti->acodarencoded)
									<li><a href="{{URL::to('producto/'.$x->acodarencoded.'/'.$x->adescrencoded)}}" title="{{$x->adescr}}">{{$x->adescr}}</a></li>
								@endif
							@endforeach
						</ul>
					</div>
			@endif
		@endif
	@endif
	<ol class="breadcrumb" style="position:static;float:none;">
		<li><a href="{{URL::to('/')}}"><i class="fa fa-bookmark" title="{{T::tr('Inicio')}}"></i> {{T::tr('Inicio')}}</a></li>
		<li><a href="{{URL::to('/secciones?b'.$barti->bloque)}}" title="{{$barti->nombloqueoriginal}}">{{$barti->nombloqueoriginal}}</a></li>
		<li><a href="{{URL::to('/secciones?g'.$barti->fgrupo)}}" title="{{$barti->nomgrupooriginal}}">{{$barti->nomgrupooriginal}}</a></li>
		<li class="active"><a href="{{URL::to('/seccion/'.$barti->ffamilia).'/'.Utils::urlenc($barti->nomfamiliaoriginal).'/1'}}" title="{{$barti->nomfamiliaoriginal}}"> {{$barti->nomfamiliaoriginal}}</a></li>
	</ol>

	@if(isset(session('entorno')->config->x_whatsapp))
		@if(strlen(session('entorno')->config->x_whatsapp)>0)
			<a href="https://api.whatsapp.com/send?phone={{session('entorno')->config->x_whatsapp}}&text={{$barti->acodar}} {{$barti->adescr}}" class="floatWP" target="_blank" title="Whatsapp">
			<i class="fa fa-whatsapp my-floatWP"></i>
			</a>
		@endif
	@endif

@endsection

@section("central")
@if($barti->imag1!=="nofoto.jpg")
<!-- primera imagen -->
<div class="row">
	<div class="col-xs-8 col-xs-push-2 col-md-10 col-md-push-1 articuloFoto text-center" style="">
		<a href="{{URL::asset('public/articulos/'.$barti->imag1)}}" data-lightbox="image-1" data-title="{{$barti->adescr}}" title="{{$barti->adescr}}">
			<img onclick="" class="img-responsive lazy" alt="{{$barti->adescr}}" title="{{$barti->adescr}}" style="max-width: 100%;" data-src="{{URL::asset('public/articulos/'.$barti->imag1)}}" src="{{URL::asset('public/images/dot.jpg')}}">
		</a>
	</div>
</div>
<div class="row">
	<!-- primera imagen pequeña -->
	@if($barti->imag2!=="nofoto.jpg")
	<!-- siguientes imagen pequeña -->
	<div class="col-xs-3 col-md-3 articuloFoto text-center" style="">
		<a href="{{URL::asset('public/articulos/'.$barti->imag2)}}" data-lightbox="image-1" data-title="{{$barti->adescr}}" title="{{$barti->adescr}}">
			<img onclick="" class="img-responsive lazy" alt="{{$barti->adescr}}" title="{{$barti->adescr}}" style="max-width: 100%;" data-src="{{URL::asset('public/articulos/'.$barti->imag2)}}" src="{{URL::asset('public/images/dot.jpg')}}">
		</a>
	</div>
	@endif
	@if($barti->imag3!=="nofoto.jpg")
	<!-- siguientes imagen pequeña -->
	<div class="col-xs-3 col-md-3 articuloFoto text-center" style="">
		<a href="{{URL::asset('public/articulos/'.$barti->imag3)}}" data-lightbox="image-1" data-title="{{$barti->adescr}}" title="{{$barti->adescr}}">
			<img onclick="" class="img-responsive lazy" alt="{{$barti->adescr}}" title="{{$barti->adescr}}" style="max-width: 100%;" data-src="{{URL::asset('public/articulos/'.$barti->imag3)}}" src="{{URL::asset('public/images/dot.jpg')}}">
		</a>
	</div>
	@endif
	@if($barti->imag4!=="nofoto.jpg")
	<!-- siguientes imagen pequeña -->
	<div class="col-xs-3 col-md-3 articuloFoto text-center" style="">
		<a href="{{URL::asset('public/articulos/'.$barti->imag4)}}" data-lightbox="image-1" data-title="{{$barti->adescr}}" title="{{$barti->adescr}}">
			<img onclick="" class="img-responsive lazy" alt="{{$barti->adescr}}" title="{{$barti->adescr}}" style="max-width: 100%;" data-src="{{URL::asset('public/articulos/'.$barti->imag4)}}" src="{{URL::asset('public/images/dot.jpg')}}">
		</a>
	</div>
	@endif
	@if($barti->imag5!=="nofoto.jpg")
	<!-- siguientes imagen pequeña -->
	<div class="col-xs-3 col-md-3 articuloFoto text-center" style="">
		<a href="{{URL::asset('public/articulos/'.$barti->imag5)}}" data-lightbox="image-1" data-title="{{$barti->adescr}}" title="{{$barti->adescr}}">
			<img class="img-responsive lazy" alt="{{$barti->adescr}}" title="{{$barti->adescr}}" style="max-width: 100%;" data-src="{{URL::asset('public/articulos/'.$barti->imag5)}}" src="{{URL::asset('public/images/dot.jpg')}}">
		</a>
	</div>
	@endif
</div>
@endif
<?php 
	$codcli=session("usuario")->uData->codigo;
	$stkIdent=session("entorno")-> config->x_stkident; // 0- no muestra 1- muestra disponible/no disponible 2- stock en unidades SI IDENTIFICADO
	$stkNoident=session("entorno")->config->x_stknoident; // true muestra stock false no muestra stock NO IDENTIFICADO
	$bajoPedido=$barti->bajopedido=="S"?true:false;
	$pendiente=$barti->pendiente;
	$fecpendiente=$barti->fecpendiente;
	$stock=$barti->astock;
	$mostrarStock=0; // 0-no muestra a no identificados 1-si muestra a no identificados 2- 3- 4- 5-
	if($codcli==0){
		// no identificados
		switch($stkNoident){
			case true:
				$mostrarStock=1; // muestra disponible/no disponible/en breve
				break;
			case false:
				$mostrarStock=0; // no muestra nada
				break;
		}
	}	
	if($codcli>0){
		switch($stkIdent){
			case 0:
				$mostrarStock=0; // no muestra nada
				break;
			case 1:
				$mostrarStock=1; // muestra disponible/no disponible/en breve
				break;
			case 2:
				$mostrarStock=2; // stocks en cantidades
				break;
		}
	}
	$imas="st_nodisponible.jpg";
	$alte=T::tr('No disponible');
	$ices="art_cestacompra2gris.jpg";
	$icesb="art_cestapaquete2gris.jpg";
	$ices2=T::tr('No disponible');
	$disponible=false;
	if ($bajoPedido==true) {
		$imas="st_bajopedido.jpg";
		$alte=T::tr('Disponible sólo bajo pedido');
		$ices="art_cestacompra2.jpg";
		$icesb="art_cestapaquete2.jpg";
		$ices2="";
		$disponible=true;
	}
	if ($pendiente>0) {
		$imas="st_enbreve.jpg";
		$alte=T::tr('Recepción en')." ".$barti->fecpendiente;
		$ices="art_cestacompra2gris.jpg";
		$icesb="art_cestapaquete2gris.jpg";
		$ices2=T::tr('No disponible');
	}
	if ($stock>0) {
		$imas="st_disponible.jpg";
		$alte=T::tr('Stock disponible');
		if ($stkIdent==2 && $codcli>0) {
			$alte.=" ".$stock." Und.";
		}
		$ices="art_cestacompra2.jpg";
		$icesb="art_cestapaquete2.jpg";
		$ices2="";
		$disponible=true;
	}
	if(session('entorno')->config->x_ventamaxstk){
		$alte=T::tr('Disponible');
		$ices2=T::tr('Disponible');
		$ices="art_cestacompra2.jpg";
		$icesb="art_cestapaquete2.jpg";
		$disponible=true;
	}
	// sacar desglose de stocks por almacen
	if(1==2){
		$stk=session("entorno")->tablas->stk; // fcstk001
		$almacenes=session("entorno")->config->x_stocks; // '1,3,4'
		$xarti=$barti->acodar;
		$gett=DB::select("select aalm,astock from $stk where acodar='$xarti' and aalm in ($almacenes) order by aalm");
		foreach ($gett as $daart){
			echo "{{T::tr('almacén')}}: ".$daart->aalm." - stock: ".$daart->astock."<br/>";
		}
	}

	$usaunidades=false;
	if(strlen($barti->adesuni)>0){
		$unidades=$barti->unidadesmedida; // array con valores
		try {
			$unidades=$barti->unidadesmedida; // array con valores
		} catch (\Throwable $th) {
			$unidades=session("articulo")->unidadesmedida; // array con valores
		}
		$usaunidades=true;
	}


?>
<div class="row" style="margin-top: 20px;">
	@if($mostrarStock==1||$mostrarStock==2)
		<div class="col-xs-2 articuloCaracteristicas text-center">
			<!-- bloque datos de stocks -->
			<img class="img-responsive lazy" style="" alt="{{$alte}}" title="{{$alte}}" data-src="{{URL::asset('public/images/'.$imas)}}" src="{{URL::asset('public/images/dot.jpg')}}" />
		</div>
	@endif
	@if($barti->astock==0 &&session('entorno')->config->x_avisosmail && session("usuario")->uData->codigo>0)
	<div class="col-xs-2 articuloCaracteristicas text-center">
		<img class="img-responsive puntero lazy"
			onclick="tracking('{{$barti->acodarencoded}}','avi','{{URL::to('tracking')}}','{{URL::current()}}');"
			style="" alt="{{T::tr('Avisarme cuando haya stock')}}"
			title="{{T::tr('Avisarme cuando haya stock')}}"
			data-src="{{URL::asset('public/images/art_avisos.jpg')}}" src="{{URL::asset('public/images/dot.jpg')}}" />
	</div>
	@endif
	@if(strlen($barti->imagmar)>0)
	<div class="col-xs-2 articuloCaracteristicas text-center">
		<!-- marca -->
		<img class="img-responsive lazy" style="max-height: 100%;"
			data-src="{{URL::asset('public/articulos/'.$barti->imagmar)}}" src="{{URL::asset('public/images/dot.jpg')}}" alt="{{$barti->amarca}}" title="{{$barti->amarca}}" />
	</div>
	@endif
	@if($barti->singastose=="S")
	<div class="col-xs-2 articuloCaracteristicas text-center">
		<img class="img-responsive lazy" style="" alt="{{T::tr('Sin gastos de envío')}}"
			title="{{T::tr('Sin gastos de envío')}}"
			data-src="{{URL::asset('public/images/art_singastos.jpg')}}" src="{{URL::asset('public/images/dot.jpg')}}" />
	</div>
	@endif
	@if($barti->totalTarifa>$barti->totalSinIva)
	<div class="col-xs-2 articuloCaracteristicas text-center">
		<img class="img-responsive lazy" style="" alt="{{T::tr('Artículo en oferta')}}"
			title="{{T::tr('Artículo en oferta')}}"
			data-src="{{URL::asset('public/images/art_oferta.jpg')}}" src="{{URL::asset('public/images/dot.jpg')}}" />
	</div>
	@endif
	<div class="col-xs-2 articuloCaracteristicas text-center">
		<img class="img-responsive puntero lazy"
			style="float: left; max-width: 33%;"
			onclick="tracking('{{$barti->acodarencoded}}','seg','{{URL::to('tracking')}}','{{URL::current()}}');"
			alt="{{T::tr('Añadir a seguimiento')}}" title="{{T::tr('Añadir a seguimiento')}}"
			data-src="{{(URL::asset('public/images/art_seguimiento.jpg'))}}" src="{{URL::asset('public/images/dot.jpg')}}" />
	</div>
</div>
<div class="row">
	@if(!in_array($barti->ffamilia,array(11111,22222)))
	@endif

	@if(!session('entorno')->config->x_oculpciva)
		<div class="col-xs-12 col-md-12 articuloPrecio text-left" style="font-size:xx-large">
		@if($barti->impcargo>0)
			{{Utils::precioFormat(   ($barti->totalConIva)+($barti->impcargo*(1+($barti->porcentajeIva/100)))   ,session("entorno")->config->x_decpreci,",",".")}}
			<span style="font-size: large;">&nbsp;&euro;&nbsp;(iva y canon incluidos)
			@if($barti->totalTarifa>$barti->totalSinIva)
				
				
				
				
				<br /> <strike>{{Utils::precioFormat($barti->totalTarifa,session("entorno")->config->x_decpreci,",",".")}}+iva</strike>




			@endif
			</span>
		@endif
		@if($barti->impcargo==0)
			{{Utils::precioFormat($barti->totalConIva,session("entorno")->config->x_decpreci,",",".")}}
				<span style="font-size: large;">&nbsp;&euro;&nbsp;(iva incluido)
				@if($barti->totalTarifa>$barti->totalSinIva)
					<!--<br /> <strike>{{Utils::precioFormat($barti->totalTarifa,session("entorno")->config->x_decpreci,",",".")}}+iva</strike>-->
					<br /> <strike>{{Utils::precioFormat(($barti->totalTarifa*(1+($barti->porcentajeIva/100))),session("entorno")->config->x_decpreci,",",".")}}</strike>
				@endif
				@if($barti->totalTarifa>$barti->totalSinIva && 1==2)
					<br /> <strike>{{Utils::precioFormat(   $barti->totalTarifa*(1+($barti->porcentajeIva/100))   ,session("entorno")->config->x_decpreci,",",".")}} con iva</strike>
				@endif
				</span>
		@endif
		</div>
	@endif
	
	@if(!session('entorno')->config->x_oculpsiva)
		<div class="col-xs-12 col-md-12 articuloPrecio text-left" style="font-size:large">
			{{Utils::precioFormat($barti->totalSinIva,session("entorno")->config->x_decpreci,",",".")}}
			<span style="font-size: large;">&nbsp;&euro;&nbsp;({{T::tr('iva no incluido')}})
			@if($barti->impcargo>0)
				(+{{Utils::precioFormat($barti->impcargo,session("entorno")->config->x_decpreci,",",".")}} &euro; de canon)
			@endif
			@if($barti->totalTarifa>$barti->totalSinIva)
				<br /> <strike>{{Utils::precioFormat($barti->totalTarifa,session("entorno")->config->x_decpreci,",",".")}}</strike>
			@endif
			</span>
		</div>
	@endif
	

	@if($barti->atallacol=='D' && 1==2)
		@if(isset(session('entorno')->config->x_agrutc))
			@if(session('entorno')->config->x_agrutc)
				<div class="col-xs-12 col-md-12 ">
					<div class="dropdown">
						<button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
							{{$barti->adescr}}
							<span class="caret"></span>
						</button>
						<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
							@foreach($barti->tallascolores as $x)
								@if($x->acodarencoded!=$barti->acodarencoded)
									<li><a href="{{URL::to('producto/'.$x->acodarencoded.'/'.$x->adescrencoded)}}" title="{{$x->adescr}}">{{$x->adescr}}</a></li>
								@endif
							@endforeach
						</ul>
					</div>
				</div>
			@endif
		@endif
	@endif

</div>
<div class="col-xs-12" style="">
	<div class="row">
		@if($barti->acanminfac+$barti->acanmaxfac>0 || count((array)$barti->ofertas)>0)
			<div class="col-xs-8 articuloCestaDescuentos" style="">
				@if($barti->acanminfac>0)
					Este producto tiene un mínimo de compra de {{$barti->acanminfac}} {{T::tr('unidades')}}.<br />
				@endif
				@if($barti->acanmaxfac>0)
					{{T::tr('Este producto tiene un máximo de compra de')}} {{$barti->acanmaxfac}} {{T::tr('unidades')}}.<br />
				@endif
				@if(count((array)$barti->ofertas)>0)
					@foreach($barti->ofertas as $ofes)
						{{$ofes}}<br />
				@endforeach
				@endif
			</div>
		@endif
		<div class="col-xs-4 articuloCesta" style="float: right;">
			@if($disponible && !$usaunidades)
				<img class="img-responsive text-left puntero lazy" style="float: right;"
					onclick="addArticulo('{{$barti->acodarencoded}}',$('#cantiArti').val(),'{{URL::to('addArticulo')}}');"
					data-src="{{URL::asset('public/images/'.$ices)}}" src="{{URL::asset('public/images/dot.jpg')}}" alt="{{$ices2}}"
					title="{{$ices2}}" />
				<input type="number" id="cantiArti"	style="width: 70px; margin-right: 5px; margin-top: 15px; float: right; text-align: right;"
					value="{{   ($barti->acanminfac>0)?$barti->acanminfac: ( ($barti->aunibul>0 && session('entorno')->config->x_ctrlbul)?$barti->aunibul:1)}}"
					class="form-control" name="cCanti" 
					placeholder="{{T::tr('Cantidad')}}"
					onchange="inputCantidad(this,{{$barti->acanminfac}},{{$barti->acanmaxfac}})"
					onkeyup="" />
				@if($barti->aunibul>1 && session('entorno')->config->x_ctrlbul)	
					<img class="img-responsive text-left puntero lazy" style="float: left;" alt="Comprar paquete ({{$barti->aunibul}} Unds.)" title="Comprar paquete ({{$barti->aunibul}} Unds.)"
						onclick="addArticulo('{{$barti->acodarencoded}}',{{$barti->aunibul}},'{{URL::to('addArticulo')}}');"
						data-src="{{URL::asset('public/images/'.$icesb)}}" src="{{URL::asset('public/images/dot.jpg')}}" alt="{{$ices2}}"
						title="{{$ices2}}" />
				@endif
			@endif
			@if($disponible && $usaunidades)
				<img class="img-responsive text-left puntero lazy" style="float: right;"
					onclick="addArticulo('{{$barti->acodarencoded}}',$('#cantiArti').val(),'{{URL::to('addArticulo')}}');"
					data-src="{{URL::asset('public/images/'.$ices)}}" src="{{URL::asset('public/images/dot.jpg')}}" alt="{{$ices2}}"
					title="{{$ices2}}" />
					<select class="form-control autoWidth" id="cantiArti" name="cantiArti"	style="margin-right: 5px; margin-top: 15px; float: right; text-align: right;">
						<option value="{{$unidades[0]}}">{{$barti->adesuni}}</option>
						@foreach($unidades as $x)
						<option value="{{$x}}">{{$x}}</option>
						@endforeach
					</select>
			@endif
			@if(!$disponible)
				<img class="img-responsive text-left puntero lazy" style="float: right;"
					onclick=""
					data-src="{{URL::asset('public/images/'.$ices)}}" src="{{URL::asset('public/images/dot.jpg')}}" alt="{{$ices2}}"
					title="{{$ices2}}" />
			@endif
		</div>
	</div>
</div>
@if(strlen($barti->aampdes)>0)
<div class="row text-left articuloDatos" style="">
	<div class="col-xs-12 col-sm-10" style="">
		<h4 onclick="layerHideShow($('#datosDescri'));">
			{{T::tr('Descripción')}}:<span class="glyphicon glyphicon-menu-down"></span>
		</h4>
		<div id="datosDescri" class="" style="display: block;">{!!$barti->aampdes!!}</div>
	</div>
	
</div>
@endif
<?php
	$incluirDatosPack=false;
	if($incluirDatosPack){
	$codigo=$barti->acodar;
	$art=session("entorno")->tablas->art;
	$cmp=session("entorno")->tablas->cmp;
	$compose=DB::select("select ccodar,adescr,ccanti from $cmp left join $art on acodar=ccodar where cartpad='$codigo' order by cresnum1,ccodar");
	if(count((array)$compose)>0){
		?>
		<div class="row text-left articuloDatos" style="">
			<div class="col-xs-12 col-sm-10" style="">
				<h4 onclick="layerHideShow($('#datosPack'));">
					{{T::tr('Composición del pack')}}:<span class="glyphicon glyphicon-menu-down"></span>
				</h4>
				<div id="datosPack" class="" style="display: block;">
					<?php 
					foreach ( $compose as $dato ) {
						echo htmlspecialchars($dato->adescr).": ".$dato->ccanti." Unds."."<br/>";
					}
					?>
				</div>
			</div>
		</div>
		<?php
	}
}
?>
@if(strlen($barti->acarac)>0||strlen($barti->alinkweb)>0)
<div class="row text-left articuloDatos" style="">
	<div class="col-xs-12 col-sm-10" style="">
		<h4 onclick="layerHideShow($('#datosCarac'));">
			{{T::tr('Características')}}:<span class="glyphicon glyphicon-menu-down"></span>
		</h4>
		<div id="datosCarac" class="" style="display: block;">
			<?php 
			if(strpos($barti->acarac,"https://prf.icecat.biz/?shopname=")===false){
			?>
				{!!$barti->acarac!!}
			<?php 
			}else{
			?>
				<object type="text/html" data="{!!$barti->acarac!!}" style="width:100%; height:100%; margin:1%;">
				</object>
			<?php 
			}
			?>
			@if(strlen($barti->alinkweb)>0) <br />
			<p>
				{{T::tr('Enlace a web del fabricante')}}: <a href="{{$barti->alinkweb}}"
					target="_blank" title="{{$barti->alinkweb}}">{{$barti->alinkweb}}</a>
			</p>
			@endif
		</div>
	</div>
</div>
@endif
@if(strlen($barti->aobsweb)>0)
<div class="row text-left articuloDatos" style="">
	<div class="col-xs-12 col-sm-10" style="">
		<h4 onclick="layerHideShow($('#datosObse'));">
			{{T::tr('Observaciones')}}:<span class="glyphicon glyphicon-menu-down"></span>
		</h4>
		<div id="datosObse0" class="" style="display: none;">{!!str_replace("\r\n","<br/>",$barti->aobsweb)!!}</div>
		<div id="datosObse" class="" style="display: none;">{!!$barti->aobsweb!!}</div>
	</div>
</div>
@endif
@if(($barti->aunibul>0&&session('entorno')->config->x_ctrlbul)||$barti->apeso>0||($barti->sujetopasivo=="S"&&session('usuario')->uData->cinvsujpas=="S"))
<div class="row text-left articuloDatos" style="">
	<div class="col-xs-12" style="">
		<h4 onclick="layerHideShow($('#datosOtros'));">
			{{T::tr('Otros datos')}}:<span class="glyphicon glyphicon-menu-down"></span>
		</h4>
		<div id="datosOtros" class="" style="display: none;">
			@if($barti->aunibul>0) {{T::tr('Este producto se vende por paquetes de')}}
			{{$barti->aunibul}} {{T::tr('unidades')}}.<br /> @endif @if($barti->apeso>0) {{T::tr('Este producto tiene un peso de')}} {{$barti->apeso}} kgs.<br /> @endif
			@if($barti->sujetopasivo=="S" &&
			session('usuario')->uData->cinvsujpas=="S") {{T::tr('Producto sujeto a inversión de sujeto pasivo')}}.<br /> @endif
		</div>
	</div>
</div>
@endif



@if(isset($barti->documentos) && session('usuario')->uData->codigo>0)
	@if(count($barti->documentos)>0)
		<div class="row text-left articuloDatos" style="">
			<div class="col-xs-12" style="">
				<h4 onclick="layerHideShow($('#datosDoc'));">
					{{T::tr('Documentación disponible')}}:<span class="glyphicon glyphicon-menu-down"></span>
				</h4>
				<div id="datosDoc" class="" style="display: none;">
				@foreach($barti->documentos as $doc)
				<div>
				<a href="{{URL::to('documentos/'.$doc->dcod)}}" target="_blank"><i class="fa fa-download"></i> {{$doc->ddes}}</a>
				</div>
				@endforeach
				</div>
			</div>
		</div>
	@endif
@endif



@if(isset($barti->desgloseStockRg))
	@if(strlen($barti->desgloseStockRg)>0 && session('usuario')->uData->codigo>0)
	<div class="row text-left articuloDatos" style="">
		<div class="col-xs-12 col-sm-10" style="">
			<h4 onclick="layerHideShow($('#datosDesRG'));">
				{{T::tr('Desglose de Stocks por proveedor')}}:<span
					class="glyphicon glyphicon-menu-down"></span>
			</h4>
			<div id="datosDesRG" class="" style="display: none;">
				{!!$barti->desgloseStockRg!!}</div>
		</div>
	</div>
	@endif
@endif
@if(count($barti->relacionados)>0)
<div class="row text-left articuloDatos" style="">
	<div class="col-xs-12 col-sm-10" style="">
		<h4 style="cursor: default;" onclick="">
			{{T::tr('Complementos')}}:
			<!-- relacionados con el principal -->
		</h4>
	</div>
			@foreach($barti->relacionados as $relalt)
			<div class="col-xs-4 col-md-3 articuloMouseOverCapa" style="">
				<a href="{{URL::to('producto/'.$relalt->acodarencoded.'/'.$relalt->adescrencoded)}}" title="{{$relalt->adescr}}">
					<img onclick="" class="img-responsive articuloMouseOver lazy"
						alt="{{$relalt->adescr}}" title="{{$relalt->adescr}}" style=""
						data-src="{{URL::asset('public/articulos/'.$relalt->imag1)}}" src="{{URL::asset('public/images/dot.jpg')}}" />
				</a>
			</div>
			@endforeach
</div>
@endif
@if(count($barti->alternativos)>0)
<div class="row text-left articuloDatos" style="">
	<div class="col-xs-12 col-sm-10" style="">
		<h4 style="cursor: default;" onclick="">
			{{T::tr('También le puede interesar')}}:
			<!-- alternativos, similares -->
		</h4>
	</div>
			@foreach($barti->alternativos as $relalt)
			<div class="col-xs-4 col-md-3 articuloMouseOverCapa" style="">
				<a href="{{URL::to('producto/'.$relalt->acodarencoded.'/'.$relalt->adescrencoded)}}" title="{{$relalt->adescr}}">
					<img onclick="" class="img-responsive articuloMouseOver lazy"
						alt="{{$relalt->adescr}}" title="{{$relalt->adescr}}" style=""
						data-src="{{URL::asset('public/articulos/'.$relalt->imag1)}}" src="{{URL::asset('public/images/dot.jpg')}}" />
				</a>
			</div>
			@endforeach
</div>
@endif

@endsection

@section("campos_meta")
<meta name="keywords" content="{{strlen($barti->meta_keys)>0?$barti->meta_keys:session('entorno')->config->x_pclavepag}}"/>
<meta name="description" content="{{strlen($barti->meta_desc)>0?$barti->meta_desc:$barti->adescr}}"/>
<link rel="canonical" href="{{URL::current()}}" />
<meta name="robots" content="follow, index"/>
@endsection





