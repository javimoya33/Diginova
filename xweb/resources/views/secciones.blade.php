@extends("base")

@section("titulo")
{{session("entorno")->config->x_nomemp}} - {{T::tr('mapa del sitio')}}
@endsection

@section("localizador")
@endsection

@section("dashboard")
<!--
	<img class="img-responsive imgresponsive" style="width: 100%;" src="{{URL::asset('public/images/logoempresa.jpg')}}" />
@if(strlen(session('entorno')->config->x_txtcab)>0)
<div id="textoEncabezado" class="centrado">{!!session('entorno')->config->x_txtcab!!}</div>
@endif
-->
@endsection

@section("central")

@if(1==2)
<h1>
	{{T::tr('Todas las categorías')}}
	<small></small>
</h1>
@endif


<?php
$full=Request::fullUrl();
$grupo=false;
$bloque=false;
$general=true;


$pos=strpos($full,"?");

if($pos>0){
	$full=substr($full,$pos+1);
	$tipo=substr($full,0,1);
	$codigo=substr($full,1);
	switch($tipo){
		case "b":
			$bloque=true;
			$general=false;
			break;
			case "g":
			$grupo=true;
			$general=false;
		break;
	}
}

?>

@if($general)
	@foreach(session("menu")->menu as $bmenu)
		<ul id="b{{$bmenu->cod}}">
			<i class="fa fa-angle-double-down"></i>
			{{$bmenu->des}}
			<span class="pull-right-container"></span>
			<ul class="">
				@foreach($bmenu->grupos as $grup)
				<i id="g{{$grup->cod}}" class="fa fa-angle-down"></i> {{$grup->des}}
				<span class="pull-right-container">
				</span>
				<ul class="">
					@foreach($grup->familias as $fama)
					<li id>
						<a href="{{URL::to('/seccion/'.$fama->cod).'/'.Utils::urlenc($fama->des).'/1'}}" title="{{$fama->des}}"><i
								class="fa fa-circle-o"></i> {{$fama->des}}</a>
					</li>
					@endforeach
				</ul>
				@endforeach
			</ul>
		</ul>
	@endforeach
	@if(strlen($seccion)>0)
	<script type="text/javascript">
		$('html, body').animate({
			scrollTop: $('#{{$seccion}}').offset().top
		}, 'fast');
	</script>
	@endif
@endif
@if($bloque)
	@foreach(session("menu")->menu as $bmenu)
		@if($bmenu->cod==$codigo)
			<h1>
				{{$bmenu->des}}
				<small></small>
			</h1>
			@foreach($bmenu->grupos as $grup)
				<div class="alert alert-info" role="alert" style="width:50%;">
						<a href="{{URL::to('/secciones?g'.$grup->cod)}}" title="{{$grup->des}}">
							<i class="fa fa-circle-o"></i> <b>{{$grup->des}}</b>
						</a>
					</div>
			@endforeach
		@endif
	@endforeach
@endif
@if($grupo)
	@foreach(session("menu")->menu as $bmenu)
		@foreach($bmenu->grupos as $grup)
			@if($grup->cod==$codigo)
				<h1>
					{{$grup->des}}
					<small></small>
				</h1>
				@foreach($grup->familias as $fama)
				<div class="alert alert-info" role="alert" style="width:50%;">
					<a href="{{URL::to('/seccion/'.$fama->cod).'/'.Utils::urlenc($fama->des).'/1'}}" title="{{$fama->des}}">
						<i class="fa fa-circle-o"></i> <b>{{$fama->des}}</b>
					</a>
				</div>
				@endforeach
		@endif
		@endforeach
	@endforeach
@endif

@endsection