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

		<form method="post" action="/xweb/devolucion" onsubmit="return devolAddNoVendido({{$ccodcl}}, '{{$acodar}}', '{{$nnumser}}', {{$fdoc}});">
			<input type="hidden" name="_token" value="{{csrf_token()}}"/>
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

				<div class="devolArticulosTR" style="border-color: white; vertical-align: top;">
	                <div class="devolArticulosTD devolArticulosTDImg" style="vertical-align: top;">
	                    <img title="{{$adescr}}" src="{{$urlfoto}}" width="100" />
	                </div>

	                <div class="devolArticulosTD devolArticulosTDDesc" style="width: 440px; vertical-align: top;">
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
	                            <b>Fecha de compra:</b> <span style="color: #5d7ea4; font-weight: bold;">{{$fechaF}}</span>
	                        </div>
	                        <div class="devoArtCodsTD">
	                            <b>N&ordm; Factura:</b> <span style="color: #5d7ea4; font-weight: bold;">{{$fdoc}}</span>
	                        </div>
	                    </div>
	                </div>

	                <div class="devolArticulosTD devolArticulosTDOpcSel" style="vertical-align: top;">
	                	@if ($enPlazo)
	                		<div class="rmarepararoabonar devolPreg" id="rmarepararoabonar" >
					        	<div class="rmarepararoabonar1" style="font-weight: bold; font-size: 9pt;">&iquest;Realizar abono o reparar?</div>
					        	<div class="rmarepararoabonar1_1">Si no es posible la reparaci&oacute;n del producto se realizar&aacute; el abono del mismo</div>
					        	<div class="rmarepararoabonar2"><div class="rmarepararoabonar2_1"><input type="radio" name="rreparar" id="rreparar1" value="1" onchange='preguntaDevolver();' /></div><div class="rmarepararoabonar2_2">Reparar</div></div>
					        	<div class="rmarepararoabonar2"><div class="rmarepararoabonar2_1"><input type="radio" name="rreparar" id="rreparar2" value="2" onchange='document.getElementById("pregunta").style.display = "none";' /></div><div class="rmarepararoabonar2_2">Abonar</div></div>
					        </div>
					        <br />
					        <div id="pregunta devolPreg" id="devolPreg2"></div>
					        <br />
							<input type="hidden" name="tiporma" id="tiporma" value="{{$tipoRMA}}" />
							<br />
							<input type="submit" class="devolButton" name="solicitudadd" value="A&ntilde;adir a la solicitud" style="margin-top: 30px;" />
						@else
							@if ($autEstado == -1)
								<form action="" method="post" onsubmit="return confirm('Se eviar&aacute; una petici&oacute;n de autorizaci&oacute;n al comercial asignado. &iquest;Continuar?')">
									<input type="hidden" name="_token" value="{{csrf_token()}}"/>
									<input type="hidden" name="solccodcl" value="{{$ccodcl}}" />
									<input type="hidden" name="solacodar" value="{{$acodar}}" />
									<input type="hidden" name="solnumser" value="{{$nnumser}}" />
									<input type="hidden" name="tiporma" id="tiporma" value="{{$tipoRMA}}" />
									<input type="hidden" name="fdoc" value="{{$fdoc}}" />
									<input class="devolButton" type="submit" name="solicitarautorizacion" value="SOLICITAR AUTORIZACI&Oacute;N" style="width: 210px;">
								</form>
							@endif

							@if ($autEstado == 0)
								<form action="" method="post" onsubmit="return confirm('Se eviar&aacute; una petici&oacute;n de autorizaci&oacute;n al comercial asignado. &iquest;Continuar?')">
									<input type="hidden" name="_token" value="{{csrf_token()}}"/>
									<input type="hidden" name="solccodcl" value="{{$ccodcl}}" />
									<input type="hidden" name="solacodar" value="{{$acodar}}" />
									<input type="hidden" name="solnumser" value="{{$nnumser}}" />
									<input type="hidden" name="tiporma" id="tiporma" value="{{$tipoRMA}}" />
									<input type="hidden" name="fdoc" value="{{$fdoc}}" />
									<input class="devolButton" type="submit" name="solicitarautorizacion" value="SOLICITAR AUTORIZACI&Oacute;N" style="width: 210px;">
								</form>
							@endif

							@if ($autEstado == 1)
					        	<div class="rmarepararoabonar devolPreg" id="rmarepararoabonar" >
						        	<div class="rmarepararoabonar1" style="font-weight: bold; font-size: 9pt;">&iquest;Realizar abono o reparar?</div>
						        	<div class="rmarepararoabonar1_1">Si no es posible la reparaci&oacute;n del producto se realizar&aacute; el abono del mismo</div>
						        	<div class="rmarepararoabonar2"><div class="rmarepararoabonar2_1"><input type="radio" name="rreparar" id="rreparar1" value="1" onchange='preguntaDevolver();' /></div><div class="rmarepararoabonar2_2">Reparar</div></div>
						        	<div class="rmarepararoabonar2"><div class="rmarepararoabonar2_1"><input type="radio" name="rreparar" id="rreparar2" value="2" onchange='document.getElementById("pregunta").style.display = "none";' /></div><div class="rmarepararoabonar2_2">Abonar</div></div>
						        </div>
						        <div id="pregunta"></div>
								<input type="hidden" name="tiporma" id="tiporma" value="{{$tipoRMA}}" />
								<input type="submit" class="devolButton" name="solicitudadd" value="A&ntilde;adir a la solicitud" style="margin-top: 30px;" />
							@elseif ($autEstado == 2)
								<span class="rojo">Fecha de autorizaci&oacute;n vencida. Puede volver a solicitarla:</span><br /><br />

								<form action="" method="post" onsubmit="return confirm('Se eviar&aacute; una petici&oacute;n de autorizaci&oacute;n al comercial asignado. &iquest;Continuar?')">
									<input type="hidden" name="_token" value="{{csrf_token()}}"/>
									<input type="hidden" name="solccodcl" value="{{$ccodcl}}" />
									<input type="hidden" name="solacodar" value="{{$acodar}}" />
									<input type="hidden" name="solnumser" value="{{$nnumser}}" />
									<input type="hidden" name="fdoc" value="{{$fdoc}}" />
									<input class="devolButton" type="submit" name="solicitarautorizacion" value="SOLICITAR AUTORIZACI&Oacute;N" style="width: 210px;">
								</form>
							@elseif ($autEstado == 3)
								<span class="rojo">Fecha de autorizaci&oacute;n vencida. Puede volver a solicitarla:</span><br /><br />

								<form action="" method="post" onsubmit="return confirm('Se eviar&aacute; una petici&oacute;n de autorizaci&oacute;n al comercial asignado. &iquest;Continuar?')">
									<input type="hidden" name="_token" value="{{csrf_token()}}"/>
									<input type="hidden" name="solccodcl" value="{{$ccodcl}}" />
									<input type="hidden" name="solacodar" value="{{$acodar}}" />
									<input type="hidden" name="solnumser" value="{{$nnumser}}" />
									<input type="hidden" name="fdoc" value="{{$fdoc}}" />
									<input class="devolButton" type="submit" name="solicitarautorizacion" value="SOLICITAR AUTORIZACI&Oacute;N" style="width: 210px;">
								</form>
	                		@endif
	                	@endif
	                </div>
	            </div>
	            <div class="devolArticulosTR" style="border-color: white; vertical-align: top; display: none; padding-top: 50px; padding-left: 17px;">
	            	<div class="devolArticulosTD" style="vertical-align: top;">
	            		Se cobrar&aacute;n 10&euro; en concepto de mano de obra si el equipo viene sin los datos borrados
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
						<form method="post" action="" onsubmit="return confirm('&iquest;Confirma que desea enviar la solicitud?')">
							<input class="devolButton devolButtonSubmit"  type="submit" name="enviarrma" value="Completar solicitud" />
						</form>
					</div>
				@endif
			@endif
		@endif
	</div>
</div>



@endsection