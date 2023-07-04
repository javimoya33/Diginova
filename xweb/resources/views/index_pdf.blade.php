@extends("base_pdf")
@section("titulo")
	{{session("entorno")->config->x_nomemp}}
@endsection

@section("dashboard")
@endsection
@section("localizador")
@endsection

@section("campos_meta")
@endsection

@section("central")
<br/><br/><br/>
<?php $x=0;?>
@foreach($articulos as $barti)
		<?php $x++;?>
		@if($x==13 || ($x-13)/16==intval(($x-13)/16))
	<div class="saltopagina"></div>
		@endif
<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 text-left boxGlobal" style="height:240px;">
			<div class="row">
	<!--modo cuadrícula-->
				<div class="col-xs-12 boxFoto" name="laimagen" style="height:100px">
						<img class="img-responsive" alt="{{$barti->acodar}}" title="{{$barti->acodar}}" style="max-width: 90%; max-height: 100%;margin:0 auto;margin-top:5%;"  src="{{URL::asset('public/articulos/'.$barti->imag1a)}}" />
				</div>
				<div class="col-xs-12">
				</div>
				<div class="col-xs-12 descripBloqueArt boxTitulo" style="  position: absolute;bottom: 0;height:auto;">
					<p>
						{{$barti->adescr}}</p>
					@if(session('entorno')->config->x_oculpsiva && !session('entorno')->config->x_oculpciva && $barti->totalSinIva>0.0)
					{{Utils::precioFormat( ($barti->totalConIva)+($barti->impcargo*(1+($barti->porcentajeIva/100)))   ,session("entorno")->config->x_decpreci,",",".")}}
					<span style="font-size: small;" alt="I.V.A. incluido" title="I.V.A. incluido">&euro;</span>
					@endif
					@if(!session('entorno')->config->x_oculpsiva && session('entorno')->config->x_oculpciva && $barti->totalSinIva>0.0)
					{{Utils::precioFormat($barti->totalSinIva+$barti->impcargo,session("entorno")->config->x_decpreci,",",".")}}
					<span style="font-size: small;" alt="I.V.A. no incluido" title="I.V.A. no incluido">&euro;</span>
					@endif
					@if(!session('entorno')->config->x_oculpsiva && !session('entorno')->config->x_oculpciva && $barti->totalSinIva>0.0)
					{{Utils::precioFormat(($barti->totalConIva)+($barti->impcargo*(1+($barti->porcentajeIva/100))),session("entorno")->config->x_decpreci,",",".")}}
					<span style="font-size: small;font-weight: normal;">&euro; ({{Utils::precioFormat($barti->totalSinIva+$barti->impcargo,session("entorno")->config->x_decpreci,",",".")}} sin iva)</span>
					@endif
					@if($barti->totalSinIva==0.0)
					&nbsp;
					@endif
				</div>
			</div>
</div>
@endforeach
@endsection