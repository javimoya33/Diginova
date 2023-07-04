@extends("base")

@section("dashboard")

<div id='xw_boxcentral' style="padding-top: 100px;">
	
	<div class="conttitulo_tr">
		<div class="titulo_tr" style="margin-top: 0px;margin-bottom: 0;margin:0 auto;"><span>Tpv virtual</span></div>
	</div>

	<div class="tpvvCont">
		@if (count($arrAlbaranes) == 0)
			<div class="rojo">Se ha producido un error. Por favor, vuelva a intentarlo más tarde.</div>
		@else
			<div class="verde">{{$mensaje}}</div>
		@endif
	</div>

	<br /><br /><br />
</div>

@endsection