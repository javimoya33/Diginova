@extends("base")

@section("dashboard")
 
<div id='xw_boxcentral' style="min-height:500px; padding-top: 0px; background-color: #f4f4f4">
	<div class="devoluciones" style="padding-top: 0;">
		<div class="devolCab" style="display: block; height: 30px;">
			<div class="devolCabTD devolCab1" style="margin-bottom: 0px; display: block;">
				<br /><br />
				<span style="font-size: 16pt; color: #5d7ea4;">Devoluciones</span>
			</div>
		</div>
 
		<br />
		@if ($rclave != "" && $rma != "")		
			@if ($rma == 1)
				@if ($registro != false) 

					<div class="recogCont " style="min-height: 50px;">
						<div class="recogTit" style="color: black; font-weight: normal; font-size: 12pt; ">
							Se ha tramitado el parte RMA nº <span style="color: #5d7ea4; font-weight: bold;">{{$registro->rma}}</span>. A continuación podrá solicitar la recogida mediante MRW.
						</div> 
					</div>

				@endif 
			@endif
		@endif

		<br /><br />
		<div class="devolCab"> 
			<div class="devolCabTD devolCab1">
				<span style="color: #5d7ea4; font-weight: bold; font-size: 10pt;">Tramitar recogida:</span>
			</div>
			<br />
		</div>
		
		<div class="recogCont">
			@if ($rclave != "")
				@if ($registro) 

					@if ($estado == 0)
						<div class="recogTit">
							<div class="recogTit1" style="color: #5d7ea4; font-weight: bold; font-size: 14pt;">Es obligatorio cumplimentar el siguiente formulario para tramitar la recogida:</div>

							<br/><br/><br/>
						</div>
					@endif


					<div class="recogTit">
						<div class="recogTit1"><img alt="Etiqueta MRW" src="/xweb/public/images/mrwetiqueta.png" /></div>
					</div>

					<div class="recogTransportista <?php if ($estado == 0) { echo "recogTransFondo"; } else { echo "recogTransFondo2"; } ?>" style="text-align: left;">


						@if ($estado == 0)

							<!-- action recogida2 1234 -->
							<form method="post" action="/xweb/recogida/{{$rclave}}/{{$rma}}">
								<input type="hidden" name="_token" value="{{csrf_token()}}"/>
								<div class="recogFormTR">
									<div class="recogFormTD" style="width: 350px">
										<div class="recogFormSpan">Dirección de recogida:</div>
										<input type="hidden" id="idCliente" value="{{$ccodcl}}"/>

										<select id="direccion_tipo" onchange="direccionTipo(this.value);">
											<option value="0">Dirección original de la compra</option>
											<option value="1">Otra dirección</option>
										</select>

									</div>
								</div>

								<div class="recogFormTR recogFormTR1">
									<div class="recogFormTD" style="width: 350px">

										<div class="recogFormSpan">Nº de bultos</div>
										<input style="{{$claseErrBultos}}" type="text" name="recBultos" maxlength="2" placeholder="Bultos..." 
												value="<?php if ($numeroBultos > 0) { echo $numeroBultos; } else { echo ''; } ?>" />
									</div>

									<div class="recogFormTD recogFormTDInfo">
										<div class="recogFormTDInfo1">Complete el formulario para que podamos solicitar la recogida a la compañía de transporte.</div>
										<div class="recogFormTDInfo2">
											MRW realizará la recogida en un plazo máximo de 48h.
											<br /><br />
											El producto debe estar preparado para la recogida en la fecha y hora indicada. En caso contrario, la recogida se anular&aacute; y el cliente deberá volver a empezar el proceso de devoluci&oacute;n.
										</div>

									</div>
								</div>

								<div class="recogFormTR" style="width: 777px;">
									<div class="recogFormTD">
										<div class="recogFormSpan">Nombre de la empresa</div>
										<input style="{{$claseErrNombre}} width: 100%;" type="text"  name="recNombre" id="recNombre" placeholder="Nombre de la empresa..." 
												value="<?php if ($cliEmpresa != "") { echo $cliEmpresa; } else { echo $znom; } ?>" />
									</div>
								</div>

								<div class="recogFormTR">
									<div class="recogFormTD">
										<div class="recogFormSpan">Persona de contacto</div>
										<input style="{{$claseErrContacto}}" type="text"  name="recContacto" placeholder="Persona de contacto..." 
												value="<?php if ($contacto != "") { echo $contacto; } else { echo $cliContacto; } ?>" />
									</div>

									<div class="recogFormTD">
										<div class="recogFormSpan">Teléfono</div>
										<input style="{{$claseErrTelef}}" type="text"  id="recTelef" name="recTelef" placeholder="Teléfono..." value="{{$ztel}}" />
									</div>
								</div>

								<div class="recogFormTR" style="width: 809px;">
									<div class="recogFormTD" style="width: 421px;">
										<div class="recogFormSpan">Calle</div>
										<input style="{{$claseErrCalle}} width: 357px;" type="text"   id="recCalle" name="recCalle" placeholder="Calle..." value="<?php if ($calle != "") { echo $calle; } else { echo $zdom; } ?>" />
									</div>

									<div class="recogFormTD" style="width: 198px;">
										<div class="recogFormSpan">Número</div>
										<input style="{{$claseErrNumero}} width: 138px;" type="text"  id="recNumero" name="recNumero" placeholder="Número..." 
												value="<?php if ($numero != "") { echo $znumero; } ?>" />
									</div>

									<div class="recogFormTD" style="width: 190px;">
										<div class="recogFormSpan">Escalera/piso/puerta</div>
										<input style="{{$claseErrResto}} width: 158px;" type="text"  name="recResto" id="recResto" placeholder="Escalera / Piso / Puerta..." 
												value="<?php if ($resto != "") { echo $zresto; } ?>" />
									</div>
								</div>

								<div class="recogFormTR">
									<div class="recogFormTD">
										<div class="recogFormSpan">Código postal</div>
										<input style="{{$claseErrCP}}" maxlength="5" type="text"   id="recCP" name="recCP" placeholder="Código postal..." value="<?php if ($codigoPostal != "") { echo $codigoPostal; } else { echo $zcodpo; } ?>" />
									</div>

									<div class="recogFormTD">
										<div class="recogFormSpan">Localidad</div>
										<input style="{{$claseErrPoblacion}}" type="text" id="recPoblacion"  name="recPoblacion" placeholder="Localidad..." value="<?php if ($poblacion != "") { echo $poblacion; } else { echo $zpob; } ?>"  />
									</div>
								</div>

								<div class="recogFormTR">
									<div class="recogFormTD" style="width: 425px;">
												<script type="text/javascript">
													// FECHA



													var a = jQuery.noConflict();

													a(document).ready(function() {
														a.datetimepicker.setLocale('es');
													});

													var hoy = new Date();
													var hoyStr = hoy.getDate() + "." + ("0"+(hoy.getMonth()+1)).slice(-2) + "." + hoy.getFullYear();
													hoy.setHours(9);
													hoy.setMinutes(0);

													a(document).ready(function() {
														a('#datetimeFecha').datetimepicker({
															timepicker:false, 
															dayOfWeekStart : 1,
															format:'d/n/Y',
															minDate:'+1970/01/02',
															//defaultDate: new Date(),
															defaultDate:'<?php echo $fechaSeleccionada; ?>',formatDate:'d/m/Y',
															disabledWeekDays: [6, 0]
														});
													});
													
	
													/*
													// Hora desde
													var b = jQuery.noConflict();

													b(document).ready(function() {
														b.datetimepicker.setLocale('es');
													});

													b(document).ready(function() {
														b('#time1').datetimepicker({
															datepicker: false,
															format:'H:i',
															defaultTime:'09:00',
															minTime:'09:00',
															allowTimes:[
															  '09:00',
															  '09:30',
															  '10:00',
															  '10:30',
															  '11:00',
															  '11:30',
															  '12:00',
															  '12:30',
															  '13:00',
															  '13:30',
															  '14:00',
															  '14:30',
															  '15:00',
															  '15:30',
															  '16:00',
															  '16:30',
															  '17:00',
															  '17:30',
															  '18:00',
															  '18:30',
															  '19:00'
															]
														});
													});


													// Hora hasta
													var c = jQuery.noConflict();

													c(document).ready(function() {
														c.datetimepicker.setLocale('es');
													});

													c(document).ready(function() {
														c('#time2').datetimepicker({
															datepicker: false,
															format:'H:i',
															defaultTime:'18:00',
															minTime:'09:00',
															allowTimes:[
															  '09:00',
															  '09:30',
															  '10:00',
															  '10:30',
															  '11:00',
															  '11:30',
															  '12:00',
															  '12:30',
															  '13:00',
															  '13:30',
															  '14:00',
															  '14:30',
															  '15:00',
															  '15:30',
															  '16:00',
															  '16:30',
															  '17:00',
															  '17:30',
															  '18:00',
															  '18:30',
															  '19:00'
															]
														});
													});*/

													
													

												</script>
										<div class="recogFormSpan">Fecha de recogida</div>
										<input autocomplete="off" type="text" id="datetimeFecha" name="datetimeFecha" class="datetimeFecha" placeholder="Fecha de recogida..." 
											value="{{$fechaSeleccionada}}" />
									</div>

									<div class="recogFormTD"></div>
								</div>

								<div class="recogFormTR">
									<div class="recogFormTD" style="width: 425px;">
										<div class="recogFormSpan">Horario de recogida</div>

										<div class="recogFormTD" style="">
												<select name="horarioreco" id="horarioreco" style="width: 160px; cursor: pointer;">
													<option value="0" <?php if ($horarioreco == 0) { echo " selected "; } ?> >De 9:00 a 14:00</option>
													<option value="1" <?php if ($horarioreco == 1) { echo " selected "; } ?> >De 14:00 a 20:00 </option>
												</select>
										</div>
									</div>

									<div class="recogFormTD">
										<input class="recogSubmit" type="submit" style="background-image: url('/xweb/public/images/recogbtn2.png')" name="recEnviar" />
									</div>
								</div>
							</form>

						@else

							@if ($errorHay)

								@if ($estado != 1)
									<br /><br /><span style='color: red; font-weight: bold;'>{{$errorTXT}}</span>
								@else

									<br /><br /><div class="recogMsg">Se ha generado la solicitud de recogida.</div>

									<br /><br />
									<br /><br />

									<a target="_blank" href="{{$rurl}}" style="padding-left: 67px;"><img alt="Etiqueta Transportista" src="/xweb/public/images/recogbtn3.png" /></a>

									<br />

									<div class="recogMsgTr">
										<div class="recogMsgTd recogMsgTd1"><img src="/xweb/public/images/recogmouse.png"></div>
										<div class="recogMsgTd recogMsgTd2">Tras acceder a la Etiqueta del Transportista, podrá imprimirla haciendo click sobre ella <br />
											con el botón derecho de su ratón.</div>
									</div>

								@endif

							@endif

						@endif
					</div>
				@endif
			@endif
		</div>

	</div>
				
	<br /><br /><br /><br /><br /><br />

				
</div>

<script type="text/javascript">
	function direccionTipo(valor)
	{
		if (valor == 0)
		{
			document.getElementById("recNombre").value = "<?php echo $znom; ?>";
			document.getElementById("recTelef").value = "<?php echo $ztel; ?>";
			document.getElementById("recCalle").value = "<?php echo $zdom; ?>";
			document.getElementById("recNumero").value = "<?php echo $znumero; ?>";
			document.getElementById("recResto").value = "<?php echo $zresto; ?>";
			document.getElementById("recCP").value = "<?php echo $zcodpo; ?>";
			document.getElementById("recPoblacion").value = "<?php echo $zpob; ?>";
		}

		if (valor == 1)
		{
			document.getElementById("recNombre").value = "";
			document.getElementById("recTelef").value = "";
			document.getElementById("recCalle").value = "";
			document.getElementById("recNumero").value = "";
			document.getElementById("recResto").value = "";
			document.getElementById("recCP").value = "";
			document.getElementById("recPoblacion").value = "";
		}
	}
</script>


@endsection