@extends("base")

@section("dashboard")

<div class="devoluciones">
	@if(session('usuario')->uData->codigo == 0)
		<div class="rmaContSolicitudes">
			<div class="rmaSolT">
				<div class="rmaSolC" style="padding: 90px 0;"> 
					Por favor, inicia sesión para continuar
					<br /><br /><br /><br /><br /><br /><br /><br /><br />
				</div>
			</div>
		</div>
	@else
		@if ($soloRMA)
			@if (!$soloHayPieza)
				@if (!$hayDOA || $ccodcl == 8874)
					<form action="/xweb/devoluciones" method="get" id="fdevRMA" name="fdevRMA">
						<input type="hidden" name="_token" value="{{csrf_token()}}"/>
					</form>

					<script type="text/javascript">
						document.getElementById("fdevRMA").submit();
					</script>
				@else
					<form action="/xweb/devolucionguardar" method="post" id="fdevRMA" name="fdevRMA">
						<input type="hidden" name="_token" value="{{csrf_token()}}"/>
						<input type="hidden" name="enviarrma">
					</form>

					<script type="text/javascript">
						document.getElementById("fdevRMA").submit();
					</script>
				@endif
			@endif

			@if ($soloHayPieza)
				<form action="/xweb/devolucionfin" method="post" id="fRMAarts" name="fRMAarts">
					<input type="hidden" name="_token" value="{{csrf_token()}}"/>
					<input type="hidden" name="nomPDF" value="{{$nomPDF}}">
					<input type="hidden" name="nomPDF2" value="{{$nomPDF2}}">
					<input type="hidden" name="solopieza" value="1">
					<input type="hidden" name="soloRMA" value="{{$soloRMA}}">
					<input type="hidden" name="rmacreado" value="{{$numRMA}}">
					<input type="hidden" name="enviarrma" value="{{$numRMA}}">
				</form>

				<script type="text/javascript">
					document.getElementById("fdevRMA").submit();
				</script>
			@endif
		@endif
		<div class="devoluciones1" id="devoluciones1">

			<div class="devolCab">
				<div class="devolCabTD devolCab1">
					<span style="font-size: 16pt; ">Devoluciones</span>
					<br /><br /><br />
					<span style="color: #5d7ea4; font-weight: bold; font-size: 10pt;">Solicitud tramitada</span>
				</div>
				
				
			</div>

			<br />

			@if ($recogida != 1)
				<div class="devolArticulosT" id="devolArticulosT">

					@if ($numRMA != "")
						<form action="/xweb/devoluciones" method="get" id="fRMAarts" name="fRMAarts">
							<input type="hidden" name="_token" value="{{csrf_token()}}"/>
						</form>

						<script type="text/javascript">
							document.getElementById("fRMAarts").submit(); 
						</script>
					@else
						<form action="/xweb/devolucionfin" method="post" id="fRMAarts" name="fRMAarts">
							<input type="hidden" name="_token" value="{{csrf_token()}}"/>
							<input type="hidden" name="nomPDF" value="{{$nomPDF}}">
							<input type="hidden" name="nomPDF2" value="{{$nomPDF2}}">
							<input type="hidden" name="solopieza" value="{{$solopieza}}">
							<input type="hidden" name="soloRMA" value="{{$soloRMA}}">
							<input type="hidden" name="rmacreado" value="{{$numRMA}}">
							<input type="hidden" name="enviarrma" value="{{$numRMA}}">
						</form>

						<script type="text/javascript">
							document.getElementById("fRMAarts").submit(); 
						</script>
					@endif

					<br /><br />

				    <div style="width: 100%; margin: 40px auto 0 auto; text-align: center;">
						<a class="devolButton" href="/xweb/devoluciones" style="width: 100px;">Volver</a>
					</div>

					<br />
					<br />
					<br />

				</div>
			@endif
		</div>
	@endif
</div>

@endsection