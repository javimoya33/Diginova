@extends("base")

@section("dashboard")
	
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
		<div>

			<div style="display: none; background-color: #e9db73; margin: 30px auto 0 auto; color: #df831c; padding: 10px 20px; -align: left; font-size: 10pt; width: 1145px;
	    			border: 1px solid #df831c; line-height: 20px;">
				Aquellos procesos RMAs, DOAs y devoluciones comerciales que se formulen durante la Semana Santa podr&aacute;n tener retrasos. <br />La situaci&oacute;n se normalizar&aacute; a partir del d&iacute;a lunes 5 de abril.
			</div>

			<div class="rmaContGeneral2" style="display: block; border-bottom: none; ">
				<div class="rmaContGeneral" style="display: table; width: 1263px; padding-top: 30px; padding-left: 5px;">
					<!--<img class="rmaCajas" alt="RMA" src="images/RMA_diginova.png" />-->

					<div class="rmaTituloSeccion" style="border-bottom: none; font-size: 20pt; padding-bottom: 0; display: table-cell; width: 380px; padding-left: 30px;">
						Formulario RMA
					</div>
	 
					<div class="rmaTituloSeccion rmaTituloDevoluciones" style="border-bottom: none; font-size: 11pt; padding-bottom: 0; display: table-cell; width: 744px; color: #376696; font-weight: bold;">
						Devoluciones en curso:
					</div>
				</div>
			</div>






			<?php // ================ 1234 ==================== ?>

	<script type="text/javascript">
		function hoverImg(element) { element.setAttribute('src', '/xweb/public/images/devolucionnueva_1.jpg'); }
		function unHoverImg(element) { element.setAttribute('src', '/xweb/public/images/devolucionnueva_0.jpg'); }
	</script>


		<div class="rmaContSolicitudes" >
			<div class="rmaSolT">
				<div class="rmaSolC" style="width: 300px; padding-left: 5px;"> 
					<div class="rmaSolC1" style="border-radius: 0px; border: 1px solid lightgray; margin: 25px auto;">
						<!--<div class="rmaSolC12" style="padding: 79px 0;"><a href="/devolucion"><img src="public/images/devolucionnueva_0.jpg" onmouseover="hoverImg(this);" onmouseout="unHoverImg(this);" /></a></div>-->
						<div class="rmaSolC12" style="padding: 79px 0;"><a href="/xweb/devolucion"><img src="public/images/devolucionnueva_0.jpg" onmouseover="hoverImg(this);" onmouseout="unHoverImg(this);" /></a></div>
					</div>
				</div>

				<div class="rmaSolC" style="vertical-align: top;  padding-left: 14px;">
					<div class="rmaTituloSeccion rmaTituloDevoluciones2" style="border-bottom: none; font-size: 11pt; padding-bottom: 0; display: none; width: 744px; color: #376696; font-weight: bold;">
						Devoluciones en curso:
					</div>
					<div class="rmaSolC2 rmaSol1C2" style="border-radius: 0px; border: 1px solid lightgray; vertical-align: top; margin: 25px auto; "> 
						<div class="rmaSolC22">
							<?php 
								
								if($ccodcl > 0)
								{
									/*$strRMAs = "";

									foreach ($arrDevoluciones  as $rma) 
									{
										$numRMA = $rma->numero;
										$strRMAs .= "'".$numRMA."',";
									}
									$strRMAs = substr($strRMAs, 0, -1);*/

							?>


							<div class="rmaSolTabla" style="min-height: 150px; margin-left: 0; " >
								<div class="rmaSolFila rmaSolFila1" style="border-bottom: 1px solid lightgray; width: 100%; background-color: #f9f9f9; font-weight: bold;">
									<div class="rmaSolCelda rmaSolNum" style="padding-left: 20px;">Referencia</div>
									<div class="rmaSolCelda rmaSolFecha" style="width: 100px;">Fecha</div>
									<div class="rmaSolCelda rmaSolEstado" style="width: 185px;">Estado</div>
									<div class="rmaSolCelda rmaSolFecha" style="width: 95px">Consultar hojas RMA</div>
									<div class="rmaSolCelda rmaSolMod" ></div>
								</div>

								<?php
									if (count($arrDevoluciones) == 0)
									{
										?>

										<div style="padding-top: 25px; text-align: center; color: #376696; font-size: 12pt;">
											( Sin solicitudes de devoluci&oacute;n )
										</div>

										<?php
									}
									else
									{
										$contadorDevol = 0;

										foreach ($arrDevoluciones as $rma) 
										{
											$contadorDevol += 1;
											$numRMA = $rma->numero;
											$numeroF = $rma->numeroF;
											$nomdoc = "/xweb/resources/pdfrma/pdf_".$numRMA.".pdf";
											$nomdocEnv = "/xweb/resources/pdfrma/pdf_".$numRMA."_envio.pdf";

											$arrAux = explode(" ", $rma->fecha);

											$rfecha = $rma->fecha;
											$fechaF = $rma->fechaF;
											$horaF = $rma->horaF;
											

											// ========= Estado del parte =========
											$estado = $rma->estado;
											$rmaEstadoStr = "Pendiente de recibir";

											// si estado = 0: comprobar si está autorizada, es decir, si existe rma_autorizacion_solicitud con estado = 0 ó 1
											if ($estado == 0)
											{
												// Buscar recogida MRW
												$recogidaEncontrada = false;
												foreach ($arrRecogidas as $recogida) 
												{
													if ($recogida->rma == $numRMA)
													{
														$recogidaEncontrada = true;
														$recogidaK = $recogida->rclave;
														$recogidaLink = "/xweb/recogida/".$recogidaK;

														if ($recogida->restado == 0) 
														{ 
															$rmaEstadoStr = "<span style='color: red;'>Pendiente de tramitar recogida a MRW: </span>Tramitar recogida <a style='color: #376696; text-decoration: none; font-weight: bold;' href='$recogidaLink'>aquí</a>"; 
														}
														
														if ($recogida->restado == 1) 
														{
															$rmaEstadoStr = "Pendiente de llegada a nuestras instalaciones mediante MRW"; 
														}
													}
												}

												if (!$recogidaEncontrada)
												{															
													$autEncontrada = false;
													foreach ($arrAutorizaciones as $autorizacion) 
													{
														if ($autorizacion->rma == $numRMA)
														{
															$autEncontrada = true;
															if ($autorizacion->estado == 0) { $rmaEstadoStr = "Pendiente de ser autorizada"; }
															if ($autorizacion->estado == 1) { $rmaEstadoStr = "Pendiente de llegada a nuestras instalaciones"; }
														}
													}
												}
											}

											if ($estado == 2)
											{
												$rmaEstadoStr = "En proceso de comprobación";
											}


											if ($estado == 4)
											{
												$rmaEstadoStr = "Pendiente de llegada a nuestras instalaciones mediante MRW"; 
											}


											if ($estado == 5)
											{
												$rmaEstadoStr = "Pendiente de llegada a nuestras instalaciones"; 
											}

											if ($estado == 6)
											{
												$rmaEstadoStr = "Pendiente de llegada a nuestras instalaciones mediante MRW"; 

												// Buscar recogida MRW
												$recogidaEncontrada = false;
												foreach ($arrRecogidas as $recogida) 
												{
													if ($recogida->rma == $numRMA)
													{
														$recogidaEncontrada = true;
														$recogidaK = $recogida->rclave;
														$recogidaLink = "/xweb/recogida/".$recogidaK;

														if ($recogida->restado == 0) 
														{ 
															$rmaEstadoStr = "<span style='color: red;'>Pendiente de tramitar recogida a MRW: </span>Tramitar recogida <a style='color: #376696; text-decoration: none; font-weight: bold;' href='$recogidaLink'>aquí</a>"; 
														}
														
														if ($recogida->restado == 1) 
														{
															$rmaEstadoStr = "Pendiente de llegada a nuestras instalaciones mediante MRW"; 
														}
													}
												}
											}

												if ($estado == 7)
												{
													$rmaEstadoStr = "Pendiente de ser contactado"; 
												}


											// ====================================

											?>
											@if ($contadorDevol == 1)
												@if (strpos(Request::fullUrl(), '_token') !== false)
													<div class="rmaSolFila" style="padding: 10px 0; border-bottom: 0; background: #bdecb6;">
														<div class="rmaSolCelda rmaSolCelda2 rmaSolNum" style="color: #376696; font-weight: bold; text-align: left; padding-left: 20px; font-family: 'montserratbold';"><?php echo $numeroF; ?></div>
														<div class="rmaSolCelda rmaSolCelda2 rmaSolFecha" style=" text-align: left; width: 80px; font-family: 'montserratbold'; text-align: center;"><?php echo $fechaF; ?><br /><?php echo $horaF; ?></div>
														
														<div class="rmaSolCelda rmaSolCelda2 rmaSolEstado" style=" text-align: left; width: 180px; color: black; font-family: 'montserratbold';"><?php echo $rmaEstadoStr; ?></div>

														<div class="rmaSolCelda rmaSolCelda2 rmaSolElim" style="text-align: left !important; width: 50px;">
															<a title="Ver parte RMA" target="_blank" href="{{$nomdoc}}">
																<img src="/xweb/public/images/deviconrma.jpg"  />
															</a>
														</div>
														<div class="rmaSolCelda rmaSolCelda2 rmaSolElim" style="">
															<a title="Ver Etiqueta de Envío" target="_blank" href="{{$nomdocEnv}}">
																<img src="/xweb/public/images/deviconenvio.jpg"  />
															</a>
														</div>
													</div>
													@else
													<div class="rmaSolFila" style="padding: 10px 0; border-bottom: 0;">
														<div class="rmaSolCelda rmaSolCelda2 rmaSolNum" style="color: #376696; font-weight: bold; text-align: left; padding-left: 20px; width: 120px;"><?php echo $numeroF; ?></div>
														<div class="rmaSolCelda rmaSolCelda2 rmaSolFecha" style=" text-align: left; width: 80px; text-align: center;"><?php echo $fechaF; ?><br /><?php echo $horaF; ?></div>
														
														<div class="rmaSolCelda rmaSolCelda2 rmaSolEstado" style=" text-align: left; width: 180px; color: black;"><?php echo $rmaEstadoStr; ?></div>

														<div class="rmaSolCelda rmaSolCelda2 rmaSolElim" style="text-align: left !important; width: 50px;">
															<a title="Ver parte RMA" target="_blank" href="{{$nomdoc}}">
																<img src="/xweb/public/images/deviconrma.jpg"  />
															</a>
														</div>
														<div class="rmaSolCelda rmaSolCelda2 rmaSolElim" style="">
															<a title="Ver Etiqueta de Envío" target="_blank" href="{{$nomdocEnv}}">
																<img src="/xweb/public/images/deviconenvio.jpg"  />
															</a>
														</div>
													</div>
												@endif
											@else
												<div class="rmaSolFila" style="padding: 10px 0; border-bottom: 0;">
													<div class="rmaSolCelda rmaSolCelda2 rmaSolNum" style="color: #376696; font-weight: bold; text-align: left; padding-left: 20px; width: 120px;"><?php echo $numeroF; ?></div>
													<div class="rmaSolCelda rmaSolCelda2 rmaSolFecha" style=" text-align: left; width: 80px; text-align: center;"><?php echo $fechaF; ?><br /><?php echo $horaF; ?></div>
													
													<div class="rmaSolCelda rmaSolCelda2 rmaSolEstado" style=" text-align: left; width: 180px; color: black;"><?php echo $rmaEstadoStr; ?></div>

													<div class="rmaSolCelda rmaSolCelda2 rmaSolElim" style="text-align: left !important; width: 50px;">
														<a title="Ver parte RMA" target="_blank" href="{{$nomdoc}}">
															<img src="/xweb/public/images/deviconrma.jpg"  />
														</a>
													</div>
													<div class="rmaSolCelda rmaSolCelda2 rmaSolElim" style="">
														<a title="Ver Etiqueta de Envío" target="_blank" href="{{$nomdocEnv}}">
															<img src="/xweb/public/images/deviconenvio.jpg"  />
														</a>
													</div>
												</div>
											@endif
											<?php
										}
									}
								?>
							</div>

						<?php } ?>

						</div>
					</div>
					<div class="rmaTituloSeccion" style="border-bottom: none; font-size: 11pt; padding-bottom: 0; display: table-cell; width: 744px; color: #376696; font-weight: bold;">
						Devoluciones resueltas:
					</div>
					<div class="rmaSolC2 rmaSol2C2" style="border-radius: 0px; border: 1px solid lightgray; vertical-align: top; margin: 10px 0px; "> 
						<div class="rmaSolC22">
							<?php 
								if(session('usuario')->uData->codigo > 0)
								{
								 	$ccodcl = session('usuario')->uData->codigo;
									//$arrDevoluciones = $conexLi -> obtDevolucionesResueltas($ccodcl);



									?>

									<div class="rmaSolTabla rmaSolTabla2" style="min-height: 120px; margin-left: 0; " >
										<div class="rmaSolFila rmaSolFila1" style="border-bottom: 1px solid lightgray; width: 765px; background-color: #f9f9f9; font-weight: bold;">
											<div class="rmaSolCelda rmaSolNum" style="padding-left: 20px; width: 150px;">Referencia</div>
											<div class="rmaSolCelda rmaSolFecha rmaColumnNumSerie" style="width: 214px;">Artículo</div>
											<div class="rmaSolCelda rmaSolFecha" style="width: 260px;">Resoluci&oacute;n</div>
											<div class="rmaSolCelda rmaSolEstado rmaSolObsePC" style="width: 225px;">Observaciones</div>
										</div>

										<?php
											if ( count($arrDevolucionesResueltas) == 0 )
											{
												?>

												<div style="padding-top: 70px; text-align: center; color: #376696; font-size: 12pt;">
													( Sin devoluciones resueltas )
												</div>

												<?php
											}
											else
											{
												foreach($arrDevolucionesResueltas as $rma)
												{
													$numRMA = $rma->grma;
													$numeroF = $rma->numeroF;
													$refArticulo = $rma->gcodar;
													$numSerie = $rma->gnumser;
													$gabono = $rma->gabono;

													$observaciones = "";

													if ($rma->gabono == 1 || $rma -> gabono == 5)
													{
														$observaciones = $rma -> gexplicacion;
													}

													$resolucion = "";

											        if ($gabono == 1) { $resolucion = "Reparado"; }
											        else if ($gabono == 5) { $resolucion = "Fuera de garant&iacute;a"; }
											        else { $resolucion = "Abonado"; }

													// Comprobar su galbaran. Si lleva compañía de transporte en bpedid
													if ($rma->galbaran != 0)
													{ 
														$galbaran = $rma->galbaran;
														$bpedid = "";


														$albEncontrado = false; $i = 0;

														foreach ($arrAlbaranesRMA as $arrAlbaranRMA)
														{
															if (!$albEncontrado)
															{
																if ($galbaran == $arrAlbaranRMA->balba)
																{
																	$albEncontrado = true;
																	$bpedid = $arrAlbaranRMA->bpedid;
																	$codEnvio = "A".$galbaran;

																	$textoAniadir = "";
																	// Buscar compañía CEX o MRW
																	$pos = strpos($bpedid, "CEX");
																	if ($pos !== false) 
																	{
																		$textoAniadir = "Enviado por CEX. Nº de seguimiento: $codEnvio";
																	}

																	if ($pos === false)  
																	{
																		$pos = strpos($bpedid, "MRW");
																		if ($pos !== false) 
																		{
																			$textoAniadir = "Enviado por MRW. Nº de seguimiento: $codEnvio";
																		}
																	}

																	$resolucion .= ". $textoAniadir";

																}
															}
														}
													}
													?>

													<div class="rmaSolFila rmaSolFila2" style="padding: 10px 0; border-bottom: 0;">
														<div class="rmaSolCelda rmaSolCelda2 rmaSolNum" style="color: #376696; font-weight: bold; text-align: left; padding-left: 20px; width: 150px;"><?php echo $numeroF?></div>
														<div class="rmaSolCelda rmaSolCelda2 rmaSolFecha rmaColumnNumSerie" style=" text-align: left; min-width: 214px;">
															<?php echo $refArticulo ?><br />
															<span class="rmaSolObsePC" style="font-size: 9pt;">N&ordm; serie: <?php echo $numSerie ?></span>
															<span class="rmaSolObseMV" style="font-size: 8pt;"><?php echo $numSerie ?></span>
														</div>
														<div class="rmaSolCelda rmaSolCelda2 rmaSolFecha" style="color: black; text-align: left; width: 260px;">
															<div><?php echo $resolucion ?></div>
															<span class="rmaSolObseMV"><?php echo $observaciones ?></span>
														</div>
														<div class="rmaSolCelda rmaSolCelda2 rmaSolEstado rmaSolObsePC" style="text-align: left; width: 225px;"><?php echo $observaciones ?></div>
													</div>
													<?php
												}
											}
										?>
									</div>

							<?php } ?>

						</div>
					</div>
				</div>
			</div>
		</div>


		<div class="rmaContGeneral" style='padding-top: 0;'>
			<div class="rmaTituloSeccion" style="font-size: 20pt; border-bottom: none;">
				Pol&iacute;tica RMA
			</div>
			<br />

			<div class="devolucionesPol">
				<div class="devolucionesPolTD1"><img src="public/images/devpol1.jpg"></div>

				<div class="devolucionesPolTD2"><img src="public/images/devpol2.jpg"></div>

				<div class="devolucionesPolTD3">
					<div class="devolucionesPolTD3_1">
						Quedan excluidos de los 2 años de garant&iacute;a
					</div>

					<div class="devolucionesPolTD3_2">
						<table border="0" style="width: 100%;">
							<tr><td class="tdevsAnios1">- Tablets:</td><td class="tdevsAnios2">1 año</td></tr>
							<tr><td class="tdevsAnios1">- Impresoras:</td><td class="tdevsAnios2">1 año</td></tr>
							<tr><td class="tdevsAnios1">- Bater&iacute;as:</td><td class="tdevsAnios2">6 meses</td></tr>
							<tr><td class="tdevsAnios1">- Hdd y componentes:</td><td class="tdevsAnios2">3 meses</td></tr>
							<tr><td class="tdevsAnios1">- Fallos de software:</td><td class="tdevsAnios2">no cubierto</td></tr>
							<tr><td class="tdevsAnios1">- P&eacute;rdida de datos en discos duros:</td><td class="tdevsAnios2">no cubierto</td></tr>
						</table>
					</div>
				</div>

				<div class="devolucionesPolTD4">
					<div class="devolucionesPolTD4_1">
						<img src="public/images/devpol3.jpg">
					</div>

					<div class="devolucionesPolTD4_2">
						<div class="bold" style="font-size: 12pt; padding-bottom: 5px; font-family: montserratbold;">Diagn&oacute;stico claro</div>
						Menciones como "no funciona", "no va", etc. no ser&aacute;n admitidas.
					</div>
				</div>
					
				
			</div>

			<br /><br />
			
			<div style="font-size: 11pt; color: black; margin-bottom: 30px; text-align: left; margin: 0 0 0 3px">
				<span style="font-weight: bold;">Devoluciones de accesorios*</span><br /><br />
				1 mes de DOA. Recogida gratuita y abono del producto o reenv&iacute;o a libre elecci&oacute;n por parte de Diginova.<br />
				<br />*&iquest;Qu&eacute; es un accesorio?:  Cualquier producto que no sea PC, portátil, monitor, todo en 1 o TPV.
				
			</div>



			<br /><br />
			
			<div style="font-size: 11pt; color: black; margin-bottom: 30px; text-align: left; margin: 0 0 0 3px">
				No se admitirán reclamaciones relacionadas con roturas o daños estéticos exteriores después de las 24 horas desde la recepción del pedido.
				<br /><br />
				El cliente deberá mandar el equipo completo objeto de la devolución autorizada. No se admitirán partes sueltas. En caso de envío de un elemento suelto del equipo (ejemplo: un disco duro), la tramitación de la devolución quedará en suspenso hasta la recepción del equipo completo.
			</div>


			<br />
			<br />
			<div class="rmaTituloSeccion" style="font-size: 20pt; border-bottom: none;">
				C&oacute;mo se gestiona un RMA
			</div>
			<br />

			<div class="devolucionesPol" style="margin-bottom: 20px;">
				<div class="devolucionesEnvTD">
					<div class="devolucionesEnvTDImg">
						<img src="public/images/devenv1.jpg" />
					</div>
					<div class="devolucionesEnvTDtxt" style="text-align: center; vertical-align: middle;">Solicitar devoluci&oacute;n</div>
				</div>

				<div class="devolucionesEnvTDF"><img src="public/images/devenvf.png" /></div>

				<div class="devolucionesEnvTD">
					<div class="devolucionesEnvTDImg">
						<img src="public/images/devenv2.jpg" />
					</div>
					<div class="devolucionesEnvTDtxt">Imprimir la Etiqueta de Env&iacute;o <br />(generada tras la solicitud)</div>
				</div>

				<div class="devolucionesEnvTDF"><img src="public/images/devenvf.png" /></div>

				<div class="devolucionesEnvTD">
					<div class="devolucionesEnvTDImg">
						<img src="public/images/devenv3.jpg" />
					</div>
					<div class="devolucionesEnvTDtxt">Empaquetar el art&iacute;culo correctamente</div>
				</div>

				<div class="devolucionesEnvTDF"><img src="public/images/devenvf.png" /></div>

				<div class="devolucionesEnvTD">
					<div class="devolucionesEnvTDImg">
						<img src="public/images/devenv4.jpg" />
					</div>
					<div class="devolucionesEnvTDtxt">Colocar la Etiqueta de Env&iacute;o fuera del embalaje</div>
				</div>

				<div class="devolucionesEnvTDF"><img src="public/images/devenvf.png" /></div>

				<div class="devolucionesEnvTD">
					<div class="devolucionesEnvTDImg">
						<img src="public/images/devenv5.jpg" />
					</div>
					<div class="devolucionesEnvTDtxt" style="text-align: center; vertical-align: middle;">Recogida por mensajer&iacute;a</div>
				</div>

			</div>


		</div>
		
		</div>
	@endif
</div>



@endsection

