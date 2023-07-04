@extends("base")

@section("titulo")
{{session("entorno")->config->x_nomemp}} - Herramientas comerciales
@endsection

<?php $seccion = ""; ?>

@section("localizador")
<div class="informTit" style="margin: 0 auto; padding: 20px 0px; text-align: center; width: 1240px; margin: 0px auto;">
	@if($seccion=='')
	{{T::tr('TEST')}}
	@endif






								

</div>
@endsection


@section("dashboard")
@endsection


@section("central")

<?php 
	/*$esFstv = session("entorno") -> esFstv;

	if ($esFstv)
	{
		?>

			<? if (!isset($_COOKIE['aviso_festivo'])): ?>

			    <!-- aquí estaría el contenido que se espera mostrar ocasionalmente -->
					<script type="text/javascript">
						alertify.alert('', 'Hoy nuestras oficinas permanecen cerradas por festividad nacional en España');
					</script>

			    <?
			    //setcookie('aviso_festivo', true,  time() +86400); // 1 día equivale a 86400 segundos
			    setcookie('aviso_festivo', true,  time() +10); // 1 día equivale a 86400 segundos
			    ?>

			<? endif; ?>

		<?php
	}*/
?>

@endsection
