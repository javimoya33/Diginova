@extends("base")

@section("titulo")
{{T::tr('Se ha producido un error en la página')}}
@endsection

@section("dashboard")
@endsection

@section("localizador")
	<img class="img-responsive imgresponsive" style="width: 100%;" src="{{URL::asset('public/images/logoempresa.jpg')}}" />
	@if(strlen(session('entorno')->config->x_txtcab)>0)
		<div id="textoEncabezado" class="centrado">{!!session('entorno')->config->x_txtcab!!}</div>
	@endif
	<h1>{{T::tr('Se ha producido un error en la página')}}<small>&nbsp;</small></h1>
@endsection

@section("central")
@endsection






