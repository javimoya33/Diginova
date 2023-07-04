@extends("base")

@section("dashboard")
<div class="devoluciones">
	<div class="devoluciones1" id="devoluciones1">

		<div class="devolCab">
			<div class="devolCabTD devolCab1">
				<span style="font-size: 16pt; ">Devoluciones</span>
				<br /><br /><br />
				<span style="color: #5d7ea4; font-weight: bold; font-size: 10pt;">A&ntilde;adir art&iacute;culo:</span>
			</div>
			
			<div class="devolCabTD devolCab2">
	 
			</div>
		</div>


		<form method="post" action="/xweb/devolucion">
			<input type="hidden" name="_token" value="{{csrf_token()}}"/>
			<input type="hidden" name="ccodcl" value="{{$ccodcl}}" />
			<input type="hidden" name="acodar" value="{{$acodar}}" />
			<input type="hidden" name="adescr" value="{{$adescr}}" />
			<input type="hidden" name="fdoc" value="{{$fdoc}}" />
			<input type="hidden" name="nnumser" value="{{$nnumser}}" />


			<div class="devolArticulosT" id="devolArticulosT" style="margin-top: 15px !important;">
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
		                        <b>Ref.:</b> {{$acodar}}
		                    </div>
		                    <div class="devoArtCodsTD">
		                        <b>N&ordm; Serie:</b> {{$nnumser}}
		                    </div>
		                </div>

		                <div class="devoArtCodsT" style="padding-top: 5px;">
		                    <div class="devoArtCodsTD">
		                        <b>Fecha de compra:</b> {{$fechaF}}
		                    </div>
		                    <div class="devoArtCodsTD">
		                        <b>N&ordm; Factura:</b> {{$fdoc}}
		                    </div>
		                </div>
		            </div>

					<div class="devolArticulosTD devolArticulosTDOpcSel" style="vertical-align: top; padding-top: 36px;">
						@if ($puedeAniadir)
							Unidades a devolver: &nbsp;&nbsp;
							<input class="devolUdsNumber" type="number" value="1" min="1" max="{{$udsDisponibles}}" name="unidades" />
						@else
							<div style="color: red;">{{$puedeAniadirMsg}}</div>
						@endif
					</div>
		        </div>

		        <div class="devolArticulosObs">
		        	<div class="devolArticulosObs1"></div>
		        	<div class="devolArticulosObs2" id="devolArticulosObs2" style="visibility: visible;">
						@if ($puedeAniadir)
			            	<span id="textocomentario">Comentario adicional:</span><br />
			            	<textarea id="devolObs" name="devolObs" class="devolObs" rows="3"></textarea>
			            	<br/><br/>
			            	<input type="hidden" name="tiporma" id="tiporma" value="{{$tipoRMA}}" />
			            	<input type="submit" class="devolButton" name="solicitudadd" value="A&ntilde;adir a la solicitud" />
			            @endif
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
							<form method="post" action="" onsubmit="return confirm('&iquest;Eliminar de la solicitud?');">
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

				<div class="devolCestaFin">
					<form method="post" action="" onsubmit="return confirm('&iquest;Confirma que desea enviar la solicitud?')">
						<input class="devolButton devolButtonSubmit"  type="submit" name="enviarrma" value="Completar solicitud" />
					</form>
				</div>
			@endif
		@endif
	</div>
</div>

@endsection