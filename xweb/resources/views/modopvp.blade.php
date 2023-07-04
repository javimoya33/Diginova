@extends("base")

@section("dashboard")

<div class="informTit" style="margin: 0 auto; padding: 20px 0px 75px 0px; text-align: center; width: 1240px; margin: 0px auto;">

	<div class="flex-left">
		<button class="btnSolicitarMayor btnAtras" style="height: 42px">
			<a href="/xweb/herramientascomerciales" style="color: #fff;">
				<i class="fa fa-chevron-left" aria-hidden="true"></i> Atrás
			</a>
		</button>
		<div style="margin-left: 20px;">
			<span class="titulo-pvp">Modo PVP</span>
		</div>
	</div>

	<div class="flex-left" style="margin-top: 30px">
		<div class="flex-left flex-wrap-movil"> 
			<span class="titulo-pasos-pvp" style="margin-right: 15px;">Paso 1 - Asignación de márgenes comerciales PVP</span>
			<div style="display: flex">
				<label class="flex-left" style="font-size: 13pt; font-family: montserratextralight; margin-top: 12px; width: 100px;">
					<input type="checkbox" id="activarModoPVP" name="activarModoPVP" value="Activo" <?php if ($activo == 1) { ?> checked <?php } ?> onchange="activarModoPVP({{$ccodcl}})" style="transform: scale(1.3); margin-top: -2px; margin-right: 5px;">
				 	Activar</label>
				<label id="msj_modopvp_activado" style="font-size: 10pt; color: green; visibility: hidden; float: left; margin-top: 17px;">
					El modo PVP ha sido activado
				</label>
			</div>
		</div>
	</div>

	<div class="flex-left">

		<div class="div-subtitulo-paso-pvp" style="margin-top: -6px">
			<span><span style="color: #dc3545; vertical-align: middle;">*</span> La aplicación de los márgenes surtirán efecto de forma inmediata en la web</span>
		</div>

		<button class="btnSolicitarMayor btnAtras" style="visibility: hidden;"></button>
	</div>

	<div class="flex-left div-content-tipo-art" style="margin-top: 25px;">
		
		<div class="div-tipo-art-pvp">
			<img src="/xweb/public/images/margen-pc.png" class="img-tipo-art-pvp">
			<div>
				<span class="span-tipo-art-pvp">Ordenadores</span>
			</div>
			<div>
				<span class="margen-tipo-art-pvp">Margen</span>
			</div>
			<select id="select_margen_pc" style="font-size: 10pt; text-align: center;" onchange="cambioMargen(this, {{$ccodcl}}, 'margen_pc')">
				<?php
					for ($i = 0; $i <= 100; $i += 5)
					{
						$selected = " ";
						if ($margenPC == $i)
						{	
							$selected = " selected ";
						}

						?>

						<option <?php echo $selected; ?> ><?php echo $i; ?>%</option>

						<?php
					}
				?>
			</select>
			<div id="msj_margen_pc" style="line-height: 14px; max-width: 210px; visibility: hidden;">
				<span style="font-size: 10pt; color: green;">Los márgenes se han actualizado correctamente a todos los <b>ordenadores</b></span>
			</div>
		</div>

		<div class="div-tipo-art-pvp">
			<img src="/xweb/public/images/margen-portatil.png" class="img-tipo-art-pvp">
			<div>
				<span class="span-tipo-art-pvp">Portátiles</span>
			</div>
			<div>
				<span class="margen-tipo-art-pvp">Margen</span>
			</div>
			<select id="select_margen_portatil" style="font-size: 10pt; text-align: center;" onchange="cambioMargen(this, {{$ccodcl}}, 'margen_portatil')">
				<?php
					for ($i = 0; $i <= 100; $i += 5)
					{
						$selected = " ";
						if ($margenPortatil == $i)
						{	
							$selected = " selected ";
						}

						?>

						<option <?php echo $selected; ?> ><?php echo $i; ?>%</option>

						<?php
					}
				?>
			</select>
			<div id="msj_margen_portatil" style="line-height: 14px; max-width: 210px; visibility: hidden;">
				<span style="font-size: 10pt; color: green;">Los márgenes se han actualizado correctamente a todos los <b>portátiles</b></span>
			</div>
		</div>

		<div class="div-tipo-art-pvp">
			<img src="/xweb/public/images/margen-monitor.png" class="img-tipo-art-pvp">
			<div>
				<span class="span-tipo-art-pvp">Monitores</span>
			</div>
			<div>
				<span class="margen-tipo-art-pvp">Margen</span>
			</div>
			<select id="select_margen_monitor" style="font-size: 10pt; text-align: center;" onchange="cambioMargen(this, {{$ccodcl}}, 'margen_monitor')">
				<?php
					for ($i = 0; $i <= 100; $i += 5)
					{
						$selected = " ";
						if ($margenMonitor == $i)
						{	
							$selected = " selected ";
						}

						?>

						<option <?php echo $selected; ?> ><?php echo $i; ?>%</option>

						<?php
					}
				?>
			</select>
			<div id="msj_margen_monitor" style="line-height: 14px; max-width: 210px; visibility: hidden;">
				<span style="font-size: 10pt; color: green;">Los márgenes se han actualizado correctamente a todos los <b>monitores</b></span>
			</div>
		</div>

		<div class="div-tipo-art-pvp">
			<img src="/xweb/public/images/margen-otros.png" class="img-tipo-art-pvp"v>
			<div>
				<span class="span-tipo-art-pvp">Otros</span>
			</div>
			<div>
				<span class="margen-tipo-art-pvp">Margen</span>
			</div>
			<select id="select_margen_otros" style="font-size: 10pt; text-align: center;" onchange="cambioMargen(this, {{$ccodcl}}, 'margen_otros')">
				<?php
					for ($i = 0; $i <= 100; $i += 5)
					{
						$selected = " ";
						if ($margenOtros == $i)
						{	
							$selected = " selected ";
						}

						?>

						<option <?php echo $selected; ?> ><?php echo $i; ?>%</option>

						<?php
					}
				?>
			</select>
			<div id="msj_margen_otros" style="line-height: 14px; max-width: 210px; visibility: hidden;">
				<span style="font-size: 10pt; color: green;">Los márgenes se han actualizado correctamente a todos los articulos de <b>otras secciones</b></span>
			</div>
		</div>

	</div>

	<div class="flex-left" style="margin-top: 20px;">

		<div class="flex-left" style="width: auto;">
			<span class="titulo-pasos-pvp">Paso 2 - Cambiar logotipo de la cabecera</span>
		</div>
	</div>

	<div>
		<form id="form_logo_pvp" style="margin: 20px 0px 0px 0px;" method="post" action="" enctype="multipart/form-data" accept-charset="UTF-8" autocomplete="off">
			<div class="flex-left">
				<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
				<input type="file" name="cambiarLogotipoWeb" id="cambiarLogotipoWeb" accept="image/*" onchange="$('#btnSubirLogotipo').click()" style="font-size: 12pt;">
				<button type="submit" id="btnSubirLogotipo" class="btnSolicitarMayor" style="display: none">Subir logotipo</button>
				@if ($errorLogo == 1)
					<label style="font-size: 10pt; color: red; float: left; margin-top: 2px;">
						El archivo de logo subido no es de formato png, jpg, jpeg o gif.
					</label>
				@elseif ($errorLogo == 2)
					<label style="font-size: 10pt; color: red; float: left; margin-top: 2px;">
						El archivo de logo subido pesa demasiado.
					</label>
				@elseif ($errorLogo == 3)
					<label style="font-size: 10pt; color: green; float: left; margin-top: 2px;">
						El logo ha sido actualizado correctamente.
					</label>
				@endif
			</div>
		</form>
	</div>
	<div onmouseover="activarSlider()">
		<div class="flex-left" style="padding-top: 90px;">
			<div class="flex-left" style="width: auto;">
				<span class="titulo-pasos-pvp">Paso 3 - Elaboración de mi presupuesto</span>
			</div>
		</div>

		<div class="flex-left">

			<div class="div-subtitulo-paso-pvp">
				<span>Añada artículos a la cesta, genere su propio presupuesto y envíeselo por email a su cliente</span>
			</div>
		</div>

		<div class="slideshow-container" style="margin: 30px 0px 0px 0px; border: 1px #000 solid;">

			<div class="mySlides fade2">
			  	<img src="/xweb/public/images/generar_presu1.png" style="width:100%">
			</div>

			<div class="mySlides fade2">
			  	<img src="/xweb/public/images/generar_presu2.png" style="width:100%">
			</div>

			<div class="mySlides fade2">
			  	<img src="/xweb/public/images/generar_presu3.png" style="width:100%">
			</div>

		</div>

		<div style="text-align:center; max-width: 1000px;">
		  	<span class="dot"></span> 
		  	<span class="dot"></span> 
		  	<span class="dot"></span> 
		</div>
	</div>
	
</div>

<script>
let slideIndex = 0;
var sliderActivo = false;

showSlides();

function showSlides() {
  let i;
  let slides = document.getElementsByClassName("mySlides");
  let dots = document.getElementsByClassName("dot");
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";  
  }
  slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1}    
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";

  if (sliderActivo)
  {
  	setTimeout(showSlides, 3500);
  }
  //setTimeout(showSlides, 3500); // Change image every 2 seconds
}

function activarSlider()
{
	console.log('Eoooooo');
	if (!sliderActivo)
	{
		setTimeout(showSlides, 3500);
		sliderActivo = true;
	}
}
</script>

@endsection