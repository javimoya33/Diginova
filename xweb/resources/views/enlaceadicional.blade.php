@extends("base")

@section("titulo")
{{session("entorno")->config->x_nomemp}} - {{{$id->titulo}}}
@endsection

@section("localizador")
<h1 class="text-danger">
	{{{$id->titulo}}}
    <small>
	</small>
</h1>
@endsection

@section("dashboard")
@endsection

@section("central")
	<p><h4>{!!$id->texto!!}</h4></p>
@endsection
