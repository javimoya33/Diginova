@extends("base")

@section("dashboard") 
	
<div style="display: none;">
	<?php
	//echo "test::";
		//var_dump($arrArticulosCompradosAccesorios);
	?>
</div>


<div class="devolucionesT">
	@if(session('usuario')->uData->codigo == 0)
		<div id="xw_boxcentral" style="min-height:500px; padding-top: 0px; background-color: #fafafa; background-color: #f3f3f3;">
			<div class="devoluciones">
				<div class="rmaContSolicitudes">
					<div class="rmaSolT">
						<div class="rmaSolC" style="padding: 60px 0; font-size: 14pt;"> 
							Por favor, inicia sesión para continuar
							<br /><br /><br /><br /><br /><br /><br /><br /><br />
						</div>
					</div> 
				</div>
				<div class="devolucionesPol">
					<div class="devolucionesPolTD1">
						<img src="/xweb/public/images/devpol1.jpg" />
					</div>
					<div class="devolucionesPolTD2">
						<img src="/xweb/public/images/devpol2.jpg" />
					</div>
					<div class="devolucionesPolTD3">
						<div class="devolucionesPolTD3_1"> Quedan excluidos de los 2 años de garantía</div>
						<div class="devolucionesPolTD3_2">
							<table border="0" style="width: 100%;">
								<tr>
									<td class="tdevsAnios1">- Tablets:</td>
									<td class="tdevsAnios2">1 año</td> 
								</tr>
								<tr>
									<td class="tdevsAnios1">- Impresoras:</td>
									<td class="tdevsAnios2">1 año</td>
								</tr>
								<tr>
									<td class="tdevsAnios1">- Baterías:</td>
									<td class="tdevsAnios2">6 meses</td>
								</tr>
								<tr>
									<td class="tdevsAnios1">- Hdd y componentes:</td>
									<td class="tdevsAnios2">3 meses</td>
								</tr>
								<tr>
									<td class="tdevsAnios1">- Fallos de software:</td>
									<td class="tdevsAnios2">no cubierto</td>
								</tr>
								<tr>
									<td class="tdevsAnios1">- Pérdida de datos en discos duros:</td>
									<td class="tdevsAnios2">no cubierto</td>
								</tr>
							</table>
						</div>
					</div>
					<div class="devolucionesPolTD4">
						<div class="devolucionesPolTD4_1">
							<img src="/xweb/public/images/devpol3.jpg" />
						</div>
						<div class="devolucionesPolTD4_2">
							<div class="bold" style="font-size: 12pt; padding-bottom: 5px; font-family: montserratbold;">Diagnóstico claro</div>
							Menciones como "no funciona", "no va", etc. no serán admitidas.
						</div>
					</div>
				</div>
			</div>
		</div>
	@else 
		<?php
			$ccodcl = session('usuario')->uData->codigo; 

		?> 

		<div>
			<div class="devoluciones">

				@if ($ccodcl == 0)
					<div class="rmaContSolicitudes">
						<div class="rmaSolT">
							<div class="rmaSolC" style="padding: 90px 0;"> 
								Por favor, inicia sesión para continuar
								<br /><br /><br /><br /><br /><br /><br /><br /><br />
							</div>
						</div>
					</div>
				@else
					<div class="devoluciones1" id="devoluciones1">
						<div class="devolCab">
							<form method="post" action="">
								<input type="hidden" name="_token" value="{{ csrf_token() }}"/>
								<input type="hidden" name="codigoBusq" id="codigoBusq" value="<?php echo $ccodcl; ?>" />

								<div class="devolCabTD devolCab1">
									<span style="font-size: 16pt; ">Devoluciones</span>
									<br /><br /><br /> 
								</div>

							</form> 
						</div>

						<br />

						<div style="color: #5d7ea4; font-weight: bold; font-size: 11pt;">Últimas compras:</div><br />

						<div id="devolResultado">
							<div class="w3-bar w3-black tabsBarra">
							  	<button id="devolTabBtn2" class="w3-bar-item tablink w3-button w3-red" onclick="devolTabAbrir(event, 'devolTab1')">
							  		Informática de ocasión<br />
							  		<span style="font-size: 9pt; font-weight: normal; color: gray;">( Portátiles, ordenadores y monitores )</span>
							  	</button>

							  	<button id="devolTabBtn1" class="w3-bar-item tablink w3-button " onclick="devolTabAbrir(event, 'devolTab2')" style="vertical-align: middle;">
							  		Accesorios y tintas<br />&nbsp;
								</button>


							  	<?php
							  	if ( false /*isset($_POST["devolbuscar"])*/ )
							  	{
							  		?>
								  	<button id="devolTabBtn3" class="w3-bar-item tablink w3-button <?php if (isset($_POST['devolbuscar'])) { echo 'w3-red'; } ?>" onclick="devolTabAbrir(event, 'devolTab3')">Resultado de búsqueda<br />&nbsp;</button>

							  		<script type="text/javascript">
							  			devolTabAbrir(event, 'devolTab3');
							  		</script>
							  		<?php 
							  	} 
							  	?>
							</div>

						<div class="devolArtTabTD" id="devolTab1" >
							<div class="devolArticulosT" id="devolArticulosT">

								<?php
									// Si la búsqueda no produjo resultados
										$busquedaSinResultados = false;
										if ($busquedaSinResultados)
										{
											?>

											<div style="padding: 30px 0 20px 0; vertical-align: middle; width: 445px; text-align: center; margin: 0 auto; color: red;">
												La búsqueda no produjo resultados
											</div>

											<?php
										}

								?>

								<div style="padding: 49px 0 20px 0; display: table; vertical-align: middle; width: 445px; text-align: center; margin: 0px auto 0px 20px; float: left;">
									<div style="display: table-cell; vertical-align: middle; width: auto; text-align: center;">Mostrando los últimos </div>

									<div style="display: table-cell; vertical-align: middle; width: auto; text-align: center;">
										<form action="" method="post" style="margin: 0;">
											<input type="hidden" name="_token" value="{{ csrf_token() }}"/>

											<select class="devolSelAveria" id="devlim" name="devlim" onchange="this.form.submit();" style="margin: 0 auto; width: 70px; height: 35px;font-weight: bold; color: #0b2e48;"> 
												<option value="15" <?php if ($lim == 15) { echo " selected "; } ?> >15</option>
												<option value="30" <?php if ($lim == 30) { echo " selected "; } ?> >30</option>
												<option value="50" <?php if ($lim == 50) { echo " selected "; } ?> >50</option>
												<option value="500" <?php if ($lim == 500) { echo " selected "; } ?> >Todos</option>
											</select>
										</form>
									</div>

									<div style="display: table-cell; vertical-align: middle; width: auto; text-align: left;">artículos comprados:</div>
								</div>

								<div class="devolCabTD devolCab2" style="visibility: visible; float: right; margin: 10px 13px 0px 0px;">
										
									<div class="devolCab2_2" >
										<span style="font-size: 10pt;">Buscar por c&oacute;digo art&iacute;culo / nº de serie:</span><br /><br />
										<input type="text" class="devolbuscar" name="devolbuscar" id="devolbuscar" placeholder="Buscar..." value="<?php if ( isset($_POST['devolbuscar']) ) { echo $_POST['devolbuscar']; }  ?>"   />
									</div>

									<div class="devolCab2_3" >
										<input class="devolBtn" type="submit" name="sbmtBuscar" value="Buscar">
									</div>
								</div>


								<div id="devArticulosFilas">
			    					@foreach($arrArticulosCompradosSinAbonar as $articulo)
			        					@if ($articulo->esOcasion)
			        						<div class="devolArticulosTR">
							                    <div class="devolArticulosTD devolArticulosTDImg">
							                        <img title="{{$articulo->adescr}}" src="{{$articulo->urlfoto}}" width="100" />
							                    </div>

							                    <div class="devolArticulosTD devolArticulosTDDesc">
							                        <span style="font-weight: bold; text-transform: uppercase;">{{$articulo->adescr}}</span>
							                        <br /><br />
							                        <div class="devoArtCodsT">
							                            <div class="devoArtCodsTD">
							                                <b>Ref.:</b> <span style="color: #5d7ea4; font-weight: bold;">{{$articulo->acodar}}</span>
							                            </div>
							                            <div class="devoArtCodsTD">
							                                <b>N&ordm; Serie:</b> <span style="color: #5d7ea4; font-weight: bold;">{{$articulo->nnumser}}</span>
							                            </div>
							                        </div>

							                        <div class="devoArtCodsT" style="padding-top: 5px;">
							                            <div class="devoArtCodsTD">
							                                <b>Fecha de compra:</b> <span style="color: #5d7ea4; font-weight: bold;">{{$articulo->fechaF}}</span>
							                            </div>
							                            <div class="devoArtCodsTD">
							                                <b>N&ordm; Factura:</b> <span style="color: #5d7ea4; font-weight: bold;">{{$articulo->fdocF}}</span>
							                            </div>
							                        </div>
							                    </div>

							                    <div class="devolArticulosTD devolArticulosTDOpc1">
							                    	<a href="/xweb/devolucionnofunciona/<?php echo base64_encode(serialize($articulo)); ?>" class="devolButton">NO FUNCIONA >></a>
							                    </div>

							                    <div class="devolArticulosTD devolArticulosTDOpc2">
							                        @if ($articulo->nolohevendido)
							                        	<a href="/xweb/devolucionnovendido/<?php echo base64_encode(serialize($articulo)); ?>" class="devolButton">NO LO HE VENDIDO >></a>
							                        @else
							                        	<!--<a href="/xweb/devolucionnovendido/<?php //echo base64_encode(serialize($articulo)); ?>" class="devolButton">NO LO HE VENDIDO >></a>-->
							                        @endif
							                    </div>
							                </div>
			        					@endif
			        				@endforeach
								</div>

								<div id="resultadoBusqueda">
									
								</div>



							</div>
						</div>

						<div class="devolArtTabTD" id="devolTab2" style="display: none;">
							<div class="devolArticulosT" id="devolArticulosT">

								<div style="padding: 30px 0 20px 0; display: table; vertical-align: middle; width: 445px; text-align: center; margin: 0px auto 0px 20px; float: left;">
									<div style="display: table-cell; vertical-align: middle; width: auto; text-align: center;">Mostrando los últimos </div>

									<div style="display: table-cell; vertical-align: middle; width: auto; text-align: center;">
										<form action="" method="post" style="margin: 0;">
											<input type="hidden" name="_token" value="{{ csrf_token() }}"/>

											<select class="devolSelAveria" id="devlim" name="devlim" onchange="this.form.submit();" style="margin: 0 auto; width: 70px; font-weight: bold; color: #0b2e48;"> 
												<option value="15" <?php if ($lim == 15) { echo " selected "; } ?> >15</option>
												<option value="30" <?php if ($lim == 30) { echo " selected "; } ?> >30</option>
												<option value="50" <?php if ($lim == 50) { echo " selected "; } ?> >50</option>
												<option value="500" <?php if ($lim == 500) { echo " selected "; } ?> >Todos</option>
											</select>
										</form>
									</div>

									<div style="display: table-cell; vertical-align: middle; width: auto; text-align: center;">artículos comprados:</div>
								</div>


								@foreach($arrArticulosCompradosAccesorios as $articulo)
	            					@if (!$articulo->esOcasion)
	            						<div class="devolArticulosTR">
						                    <div class="devolArticulosTD devolArticulosTDImg">
						                        <img title="{{$articulo->adescr}}" src="{{$articulo->urlfoto}}" width="100" />
						                    </div>

						                    <div class="devolArticulosTD devolArticulosTDDesc">
						                        <span style="font-weight: bold; text-transform: uppercase;">{{$articulo->adescr}}</span>
						                        <br /><br />
						                        <div class="devoArtCodsT">
						                            <div class="devoArtCodsTD">
						                                <b>Ref.:</b> <span style="color: #5d7ea4; font-weight: bold;">{{$articulo->acodar}}</span>
						                            </div>
						                            <div class="devoArtCodsTD">
						                                <b>N&ordm; Serie:</b> <span style="color: #5d7ea4; font-weight: bold;">{{$articulo->nnumser}}</span>
						                            </div>
						                        </div>

						                        <div class="devoArtCodsT" style="padding-top: 5px;">
						                            <div class="devoArtCodsTD">
						                                <b>Fecha de compra:</b> <span style="color: #5d7ea4; font-weight: bold;">{{$articulo->fechaF}}</span>
						                            </div>
						                            <div class="devoArtCodsTD">
						                                <b>N&ordm; Factura:</b> <span style="color: #5d7ea4; font-weight: bold;">{{$articulo->fdocF}}</span>
						                            </div>
						                        </div>
						                    </div>

						                    <div class="devolArticulosTD devolArticulosTDOpc2">
						                        <a href="/xweb/anadirparte/<?php echo base64_encode(serialize($articulo)); ?>" class="devolButton">A&Ntilde;ADIR AL PARTE >></a>
						                    </div>
						                </div>
	            					@endif
	            				@endforeach 
							</div>
						</div>



					</div>

					</div> <!-- fin de "devoluciones1" -->





					<?php // ================== Cesta de devoluciones =======================  ?>

					<?php
					if (count($arrArtsDevolucion) > 0)
					{
						?>
						<script type="text/javascript">
							$(document).ready(function() {
						  		var scrollBottom = $('#devoluciones1').height();

						    	$('html,body').animate({scrollTop: scrollBottom},'slow');
						  	});
						</script>
						<?php
					}
					?>

					<div class="devoluciones2">
						<div class="devolCestaCab">Productos a devolver</div>

						<div class="devolCesta">
							<div class="devolCestaArts">
								@foreach ($arrArtsDevolucion as $artDev) 

									<div class="devolCestaArt <?php if ($artDev->rautorizado == 0) { echo "devolCestaArtNoAut"; } ?>">
										<div class="devolCestaArt1">
											@if ($artDev->rautorizado == 0)
												<img src="/xweb/public/images/devces1.jpg" />
											@endif
											<img title="{{$artDev->rdescr}}" src="{{$artDev->urlfoto}}" width="75" />
											<br />
											<div style='text-align: left;'>Ref.: {{$artDev->rcodar}}</div>
											
											
											<?php
												if ($artDev->rnumser != "")
												{
													?>

													<div style='text-align: left;'>N&ordm; serie: <?php echo $artDev->rnumser; ?></div>

													<?php
												}
											?>

											<br />

											@if ($artDev->rautorizado == 0)
												<img src="/xweb/public/images/devces2.jpg" style="margin-top: 2px;" />
											@endif
										</div>

										<div class="devolCestaArt2">
											<form method="post" action="" onsubmit="return confirm('&iquest;Eliminar de la solicitud?');">
												<input type="hidden" name="_token" value="{{csrf_token()}}"/>
												<input type="hidden" name="devolElim" value="1" />
												<input type="hidden" name="idartic" value="{{$artDev->id}}" />
												<input type="image" title="Quitar de la solicitud" src="/xweb/public/images/deleteicon1.png" width="10" height="10" />
											</form>
										</div>
									</div>
								@endforeach
							</div>
						</div>

						@if ($hayAutorizado)
							@if (!$hayNoAutorizado && !$hayDOA)
								<div class="devolCestaFin">
									<form method="post" action="/xweb/devolucionrma" onsubmit="return confirm('&iquest;Confirma que desea enviar la solicitud?')">
										<input type="hidden" name="_token" value="{{ csrf_token() }}"/>
										<input class="devolButton devolButtonSubmit"  type="submit" name="enviarrma" value="Completar solicitud" />
									</form>
								</div>
							@endif

							@if (!$hayNoAutorizado && $hayDOA)
								<div class="devolCestaFin">
									<form method="post" action="/xweb/devolucionguardar" onsubmit="return confirm('&iquest;Confirma que desea enviar la solicitud?')">
										<input type="hidden" name="_token" value="{{ csrf_token() }}"/>
										<input class="devolButton devolButtonSubmit"  type="submit" name="enviarrma" value="Completar solicitud" />
									</form>
								</div>
							@endif
						@endif
					</div>
				@endif
			</div>
		</div>
	@endif
</div>

<script type="text/javascript">

function devolTabAbrir(evt, tabId)
{
    var i, x, tablinks;
    x = document.getElementsByClassName("devolArtTabTD");
    for (i = 0; i < x.length; i++) 
    {
        x[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablink");

    for (i = 0; i < x.length; i++) 
    {
        tablinks[i].className = tablinks[i].className.replace(" w3-red", "");
    }
    
    document.getElementById(tabId).style.display = "block";
    if (tabId == "devolTab3") { document.getElementById("devolTabBtn3").className += " w3-red"; }
    evt.currentTarget.className += " w3-red";
}



  $(document).ready(function() {

    $('#devolbuscar').keyup('input',function()
    {
      //Obtenemos el value del input
      var service = $(this).val(); 
      
      if (service != "")
      {
      	document.getElementById("devArticulosFilas").style.display = "none";
      	document.getElementById("resultadoBusqueda").style.display = "block";
      }
      else
      {
      	document.getElementById("devArticulosFilas").style.display = "block";
      	document.getElementById("resultadoBusqueda").style.display = "none";
      }


      setTimeout(function() 
      {
        if($('#devolbuscar').val() == service)
        {
          //var dataString = 'devolbuscar='+service;

          //Le pasamos el valor del input al ajax
          $.ajax({
            type: 'GET',
            url: '/xweb/devolucion_buscador/' + service,
            beforeSend: function() {
            },
            success: function(response) 
            {
              //Escribimos las sugerencias que nos manda la consulta
              $('#resultadoBusqueda').html(response);
            }
          });
        }
      }, 200);



    }); 
  });

</script>


@endsection

