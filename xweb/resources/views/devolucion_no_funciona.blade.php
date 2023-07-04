@extends("base")

@section("dashboard")
<div class="devoluciones">
	<div class="devoluciones1" id="devoluciones1">
	
		<div class="devolCab">
			<div class="devolCabTD devolCab1">
				<span style="font-size: 16pt; ">Devoluciones</span>
				<br /><br /><br />
				<span style="color: #5d7ea4; font-weight: bold; font-size: 10pt;">Motivo de la devoluci&oacute;n:</span>
			</div>
			
			<div class="devolCabTD devolCab2" style="display: none">
	 
			</div>
		</div> 

		<form id="fAniadir" name="fAniadir" enctype="multipart/form-data" method="post" action="/xweb/devolucion" onsubmit="return devolAdd(<?php echo $ccodcl ?>, '<?php echo $acodar; ?>', '<?php echo $nnumser; ?>', <?php echo $fdoc; ?>, document.getElementById('devolSelAveria').value, document.getElementById('devolObs').value, '<?php echo $tipoRMA; ?>');">
			<input type="hidden" name="_token" value="{{ csrf_token() }}"/>
			<input type="hidden" name="ccodcl" value="{{$ccodcl}}" />
			<input type="hidden" name="acodar" value="{{$acodar}}" />
			<input type="hidden" name="adescr" value="{{$adescr}}" />
			<input type="hidden" name="fdoc" value="{{$fdoc}}" />
			<input type="hidden" name="nnumser" value="{{$nnumser}}" /> 
			<input type="hidden" name="categoria" value="{{$categoria}}" />

			<div class="devolArticulosT" id="devolArticulosT">
		        <div class="devolArticulosTR" style="border-color: white;">
					<div class="devolArticulosTD devolArticulosTDImg" style="padding: 0; text-align: left; margin: 0;">
						<a class="devolButton"  href="/xweb/devolucion" style="width: 100px;">Volver</a>
					</div> 
					<div class="devolArticulosTD devolArticulosTDImg" style="padding: 0; text-align: left; margin: 0; width: 300px;">
						&nbsp;
					</div> 
				</div>

				<div class="devolArticulosTR" style="border-color: white;">
		            <div class="devolArticulosTD devolArticulosTDImg">
		                <img title="{{$adescr}}" src="{{$urlfoto}}" width="100" />
		            </div>

		            <div class="devolArticulosTD devolArticulosTDDesc" style="width: 440px;">
		                <span style="font-weight: bold; text-transform: uppercase;">{{$adescr}}</span>
		                <br /><br />
		                <div class="devoArtCodsT">
		                    <div class="devoArtCodsTD">
		                        <b>Ref.:</b> <span style="color: #5d7ea4; font-weight: bold;">{{$acodar}}</span>
		                    </div> 
		                    <div class="devoArtCodsTD">
		                        <b>N&ordm; Serie:</b> <span style="color: #5d7ea4; font-weight: bold;">{{$nnumser}}</span>
		                    </div>
		                </div>

		                <div class="devoArtCodsT" style="padding-top: 5px;">
		                    <div class="devoArtCodsTD">
		                        <b>Fecha de compra:</b> <span style="color: #5d7ea4; font-weight: bold;">{{$ffechaF}}</span>
		                    </div>
		                    <div class="devoArtCodsTD">
		                        <b>N&ordm; Factura:</b> <span style="color: #5d7ea4; font-weight: bold;">{{$fdoc}}</span>
		                    </div>
		                </div>
		            </div>

		            <div class="devolArticulosTD devolArticulosTDOpcSel">
		            	
		            	@if ($puedeAniadir)
		            		<select class="devolSelAveria" id="devolSelAveria" name="devolSelAveria" onchange="devolSel(this.value, '{{$tipoRMA}}', {{$ccodcl}}, {{$diasDesdeCompra}})" >
								<option value="0">Elija un motivo</option>
								@foreach ($arrAverias as $averia) 
									<option value="{{$averia->id}}">{{$averia->nombre}}</option>
								@endforeach
							</select>
						@else
							{{$puedeAniadirMsg}}
		            	@endif

		            </div>
		        </div>

		        <div class="devolArticulosObs">
		        	<div class="devolArticulosObs1">
		        		<div class="devolArticulosObs1" style="text-align: left; padding: 50px; font-size: 12pt; font-weight: bold;">Recuerde enviar los cables correspondientes a los equipos comprados.<br />En caso contrario, se descontará del abono a realizar.</div>
		        	</div>

		        	<div class="devolArticulosObs2" id="devolArticulosObs2" style="vertical-align: top;">
		            	<span id="textoaviso" style="display: none; color: red; padding: 0px 0; margin-bottom: 15px;"></span>
			        

		            	<?php
		            		if ($tipoRMA != "RMA")
		            		{
		            			?>

				        <div class="rmarepararoabonar devolPreg" id="rmarepararoabonar" style="">
				        	<div class="rmarepararoabonar1" style="font-weight: bold; font-size: 9pt;">&iquest;Realizar abono o reparar?</div>
				        	<div class="rmarepararoabonar1_1">Si no es posible la reparaci&oacute;n del producto se realizar&aacute; el abono del mismo</div>
				        	<div class="rmarepararoabonar2"><div class="rmarepararoabonar2_1"><input type="radio" name="rreparar" id="rreparar1" value="1" onchange="preguntaDevolver('<?php echo $tipoRMA; ?>')" /></div><div class="rmarepararoabonar2_2">Reparar</div></div>
				        	<div class="rmarepararoabonar2"><div class="rmarepararoabonar2_1"><input type="radio" name="rreparar" id="rreparar2" value="2" onchange='document.getElementById("pregunta").style.display = "none";' /></div><div class="rmarepararoabonar2_2">Abonar</div></div>
				        </div>


		            			<?php
		            		}
		            	?>


		            	<span id="pregunta" style="display: none; margin: 13px 0 10px 0; width: 305px; "></span>
		            	<span id="pregunta2" style="display: none; margin: 5px 0 10px 0; width: 305px; "></span>
		            	<br />
		            	<span id="textocomentario">Comentario adicional:</span><br />
		            	<textarea id="devolObs" name="devolObs" class="devolObs" rows="3"></textarea>
		            	<br /><br />

		            	<input type="hidden" name="tiporma" id="tiporma" value="{{$tipoRMA}}" />

		            	<input type="submit" class="devolButton" name="solicitudadd" id="solicitudadd" value="A&ntilde;adir a la solicitud"  /> 
		            	
		            	<!--<input type="button" class="devolButton" name="solicitudadd" id="solicitudadd" value="A&ntilde;adir a la solicitud" onclick="devolAdd(<?php echo $ccodcl ?>, '<?php echo $acodar; ?>', '<?php echo $nnumser; ?>', <?php echo $fdoc; ?>, document.getElementById('devolSelAveria').value, document.getElementById('devolObs').value, '<?php echo $tipoRMA; ?>');" />-->

		            </div>
		        </div>
		    </div>
		</form>

	</div>

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
							{{$artDev->rcodar}}
							<br />
							@if ($artDev->rautorizado == 0)
								<img src="/xweb/public/images/devces2.jpg" style="margin-top: 2px;" />
							@endif

						</div>

						<div class="devolCestaArt2">
							<form method="post" action="/xweb/devolucion" onsubmit="return confirm('&iquest;Eliminar de la solicitud?');">
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

			@if (!$hayNoAutorizado)

				@if (count($arrArtsDevolucion) > 0)
					<div class="devolCestaFin">
						<form method="post" action="/xweb/devolucionrma" onsubmit="return confirm('&iquest;Confirma que desea enviar la solicitud?')">
							<input type="hidden" name="_token" value="{{ csrf_token() }}"/>
							<input class="devolButton devolButtonSubmit"  type="submit" name="enviarrma" value="Completar solicitud" />
						</form>
					</div>
				@endif
				
			@endif
		@endif
	</div>
</div>


<script type="text/javascript">

	function devolAdd(ccodcl, acodar, nnumser, fdoc, valorSel, valorObs, tipoRMA)
	{
		console.log("tipoRMA: " + tipoRMA);
		//console.log(" ccodcl=" + ccodcl + " acodar=" + acodar + " nnumser=" + nnumser + " fdoc=" + fdoc + " valorSel=" + valorSel + " valorObs=" + valorObs );
	    var respuesta = true;
	    var rreparar = 0;  if (tipoRMA == "RMA") { rreparar = 1; console.log("RREP: " + rreparar); }
	    var pieza = 0; 
	    var valorSel = document.getElementById("devolSelAveria").value;
	    var valorObs = document.getElementById("devolObs").value;

		/*if (document.getElementById("pieza0").checked == true) { pieza = 0; }
		if (document.getElementById("pieza1").checked == true) { pieza = 1; }*/
//alert("1");
	    if (tipoRMA != "RMA")
	    {
			if (document.getElementById("rreparar1").checked == true) { rreparar = 1; }
			if (document.getElementById("rreparar2").checked == true) { rreparar = 2; }
	    }

//alert("2");
		if (averiaTipoSoloPieza)  
		{
			if (document.getElementById("pieza0").checked == false && document.getElementById("pieza1").checked == false)
			{
				colorearError("devolPreg1", 1);
				alert("Por favor, indique si prefiere reposici\u00F3n de la pieza o env\u00CDo de m\u00E1quina completa");
				respuesta = false;
			} else { colorearError("devolPreg1", 0); }

		} 
//alert("3");

/*alert("solpiez: " + averiaTipoSoloPieza);
alert("resp: " + respuesta);*/
		if (respuesta)
		{
			//alert("rreparar: " + rreparar);

			if (tipoRMA != "RMA")
			{
				if (rreparar == 0)
				{
					colorearError("rmarepararoabonar", 1);
					alert("Por favor, seleccione entre Reparar o Abonar");
					respuesta = false;
				} else { colorearError("rmarepararoabonar", 0) }
			}

			
			if (rreparar == 1 || rreparar == 2)
			{
			    if (valorSel == '0') { alert("Selecciona un motivo correcto"); respuesta = false; }
			    /*else
			    {
			        if ( valorObs == "" ) { alert("Por favor, indique claramente el fallo. Descripciones como \"No funciona\" o \"no va\" no se admitir\u00E1n como v\u00E1lidas"); }
			        else { respuesta = true; }
			    }*/
				
			    if (respuesta && rreparar == 1)
			    { 
					if (document.getElementById("devol1").checked == false && document.getElementById("devol2").checked == false) 
					{ 
						colorearError("devolPreg3", 1);
						alert("Por favor, seleccione c\u00F3mo desea que se le devuelva el producto");
						respuesta = false; 
					} else { colorearError("devolPreg3", 0); }

			    	//alert("OK");
			        //devolucionesGuardarTemp(<?php echo $ccodcl ?>, '<?php echo $acodar; ?>', '<?php echo $nnumser; ?>', <?php echo $fdoc; ?>, valorSel, valorObs);

			    }


			    if (respuesta && rreparar == 1)
			    { 
			    	if (tipoRMA == "DOA")
			    	{
						if (document.getElementById("foto").value.length  == 0 ) 
						{ 
							colorearError("devolPreg4", 1);
							alert("Por favor, incluya una imagen que muestre el fallo obtenido");
							respuesta = false; 
						} else { colorearError("devolPreg4", 0); }
			    	}


			    	//alert("OK");
			        //devolucionesGuardarTemp(<?php echo $ccodcl ?>, '<?php echo $acodar; ?>', '<?php echo $nnumser; ?>', <?php echo $fdoc; ?>, valorSel, valorObs);

			    }

			}

			if (respuesta)
			{
		        if ( valorObs == "" ) 
	        	{ 
	        		colorearError("devolObs", 1);
	        		alert("Por favor, indique claramente el fallo. Descripciones como \"No funciona\" o \"no va\" no se admitir\u00E1n como v\u00E1lidas"); 
	        		respuesta = false; 
	        	} else { colorearError("devolObs", 0); }
			}
		}
		




	    return respuesta;
	}
</script>
@endsection