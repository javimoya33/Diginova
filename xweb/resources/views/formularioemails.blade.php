@extends("base")

@section("titulo")
{{session("entorno")->config->x_nomemp}} - Formulario suscripción a emails
@endsection

<?php $seccion = ""; ?>

@section("localizador")
<div class="informTit" style="margin: 0 auto; padding: 20px 0px; text-align: center; width: 1240px; margin: 0px auto;">
	@if($seccion=='')
	{{T::tr('Suscríbete a nuestras ofertas por email:')}}
	@endif


</div>
@endsection


@section("dashboard")
@endsection


@section("central")

<iframe data-skip-lazy="" src="https://diginova.ipzmarketing.com/f/tlZS3mbz80Y" frameborder="0" scrolling="no" width="100%" class="ipz-iframe"></iframe>
<script data-cfasync="false" type="text/javascript" src="https://assets.ipzmarketing.com/assets/signup_form/iframe_v1.js"></script>

@endsection

<style type="text/css">
	.content-wrapper, .informTit { background-color: #eeeeed !important; }
	.content-wrapper { padding-top: 30px; min-height: auto !important; }
	#public-area #wrapper { margin: 0 auto !important; }
</style>
