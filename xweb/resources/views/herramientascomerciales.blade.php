@extends("base")

@section("titulo")
{{session("entorno")->config->x_nomemp}} - Herramientas comerciales
@endsection

<?php $seccion = ""; ?>

@section("localizador")
<div class="informTit" style="margin: 0 auto; padding: 20px 0px; text-align: center; width: 1240px; margin: 0px auto;">
	@if($seccion=='')
	{{T::tr('Herramientas comerciales')}}
	@endif


</div>
@endsection


@section("dashboard")
@endsection


@section("central")


<?php
	if (session("usuario")->uData->codigo == 0)
	{
		?>

		<div class="" style="padding: 60px 0px 0px 0px; font-size: 14pt; text-align: center; margin: 0 auto;"> 
			Por favor, inicia sesión para continuar
		</div>


		<?php
	}

	if (session("usuario")->uData->codigo > 0)
	{
		$ccodcl = session('usuario')->uData->codigo;
		$ticli = session("usuario")->uData->ctipocli;

		$esTechnoocasion = false;
		if ( in_array($ticli, array(22, 23, 24)) ) { $esTechnoocasion = true; }

		// Clientes que compran
			$clienteCompra = false; $i = 0;

			foreach ($clientesQueCompran as $cli) 
			{
				if ($cli -> FCODCL == $ccodcl)
				{
					$clienteCompra = true;
				}
			}

		if ( in_array($ccodcl, array(4295, 3908, 9060)) ) { $clienteCompra = true; }
		if ( in_array($ccodcl, array(4295, 3908)) ) { $esTechnoocasion = true; }


		?>

		<div class="micuentaMenu">

			<?php
				if (true)
				{
					?>
						<a class="micuentaOpc" href="generarcsv" >
							<table>
								<tr>
									<td style="width: 60px;">
										<img src="/xweb/public/images/icono_menu_izq.png" style="width: 32px;">
									</td>
									<td class="titulo_area_cliente" style="width: 625px;">Descargar información de artículos</td>
									<td style="width: 140px;">
										<img src="/xweb/public/images/icono_menu_contab.png" style="width: 60px;">
									</td>
								</tr>
							</table>
						</a>
						
					<?php
				}
			?>


			<?php if ($clienteCompra && $ccodcl != 8874) { ?>

				<a class="micuentaOpc" href="generadoranuncios">
					<table>
						<tr>
							<td style="width: 60px;">
								<img src="/xweb/public/images/icono_menu_izq.png" style="width: 32px;">
							</td>
							<td class="titulo_area_cliente" style="width: 625px;">Generador de anuncios</td>
							<td style="width: 140px;">
								<img src="/xweb/public/images/icono_menu_contab.png" style="width: 60px;">
							</td>
						</tr>
					</table>
				</a>

			<?php } ?>



			<?php if ($esTechnoocasion) { ?>

				<a class="micuentaOpc" href="generadorcarteltecno">
					<table>
						<tr>
							<td style="width: 60px;">
								<img src="/xweb/public/images/icono_menu_izq.png" style="width: 32px;">
							</td>
							<td class="titulo_area_cliente" style="width: 625px;">Personalización Cartel Technoocasión</td>
							<td style="width: 140px;">
								<img src="/xweb/public/images/icono_menu_contab.png" style="width: 60px;">
							</td>
						</tr>
					</table>
				</a>

			<?php } ?>


		</div>

<?php
	}
?>

@endsection
