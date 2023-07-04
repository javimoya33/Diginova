@extends("base")

@section("titulo")
{{session("entorno")->config->x_nomemp}} - {{session("entorno")->config->x_faqtit}}
@endsection

@section("localizador")
<h1 class="text-danger">
	{{session("entorno")->config->x_faqtit}}
    <small>
	</small>
</h1>
@endsection

@section("dashboard")
@endsection

@section("central")
	@if(count((array)$matrizFaq)==0)
		<div id="nodata" class="alert alert-danger" role="alert"
			style='display: block'>
			<span class="glyphicon glyphicon-alert"></span>&nbsp;<strong>{{T::tr('Atención')}} </strong>{{T::tr('actualmente no existen datos en esta sección')}}.
		</div>
	@endif
	@if(count((array)$matrizFaq)>0)
		@foreach($matrizFaq as $fac)
			<div>
				<h3 class="text-danger">{{$fac->pregunta}}&nbsp;</h3>
				<span class="label label-info">{{T::tr('Publicado en')}}
					{{Utils::fechaEsp($fac->fecha)}}, {{T::tr('modificado en')}}
					{{Utils::fechaEsp($fac->ultimamod)}}</span>
				<h5>{!!$fac->respuesta!!}</h5>
			</div>
		@endforeach
	@endif
@endsection
