@extends("base")

@section("dashboard")

<div id="xw_boxcentral" class="catCont" style="min-height:1100px;  margin-top: 0px;">
	<title>Favoritos</title>
	<div class="homeElement">
		<div class="homeContArts" style="width: 1280px">
			<?php
			$leftArticulo = -328;
			$sumaLeftArticulo = 328;
			$widthArticulo = 250;
			$topArticulo = 0;

			$arrArticulos = $arrFavoritos;
			$esAccesorioComponente = false;
			$esFilaOfertas = false;


			if (count($arrArticulos) == 0)
			{
				?>
				<div class="contArtsOcasion" style="margin-bottom: 100px; height: 0px; border: none;">
					<div style="text-align: center; padding-top: 10px;">
						Actualmente no hay artículos en esta sección :(
					</div>
				</div>
				<?php
			}
			?>

			@include("celda_articulo")
		</div>
	</div>

@endsection