@extends("base")

@section("dashboard")


<div id="xw_boxcentral" class="fichaBoxCentral">

<?php
	if (session('usuario')->uData->codigo == 0)
	{
		?>

		<br /><br />
		<div style="font-size: 14pt;">Por favor, inicia sesión para continuar</div>

		<?php
	}	


	if (session('usuario')->uData->codigo > 0)
	{
?>


		<?php

			// ==== Si no tiene solicitud pendiente (-1)   o si la última fue rechazada (2) ===
				if ($estadoAutorizacion == -1 || $estadoAutorizacion == 2)
				{
					?>

					<div class="informativa csvs" style="margin-top: 0; min-height: 200px;">
						<div class="informTit">Información de artículos</div>
						<br/>
						<br/>

						<div style="font-size: 14pt;">Necesita autorización para esta sección de la web:</div>

						<br /><br />

						<input type="hidden" name="_token" id="_token" value="{{{ csrf_token() }}}" />
						<button class="btnCSV" style="background-color: rgb(11, 46, 72); color: white;" onclick="solicitarAutWeb(this);">Solicitar autorización</button>
					</div>



					<script type="text/javascript">
						function solicitarAutWeb(elemento)
						{
						    var formData = new FormData();
						    formData.append('seccionID', <?php echo $seccionID; ?>);
						    formData.append('seccionNom', '<?php echo $seccionNom; ?>');
						    formData.append('_token', $('#_token').val());

						    $.ajax({
						        url: '/xweb/solicitarAutWeb',
						        type: 'post',
						        data: formData,
						        contentType: false,
						        processData: false,
						        success: function(response) {
						            $(elemento).css('pointer-events', 'none');
						            $(elemento).css('background', 'linear-gradient(to bottom, #b8e356 5%, #a5cc52 100%)');
						            $(elemento).css('margin-left', '192px');
						            $(elemento).text('✓ Solicitud enviada');
						        }
						    });
						}
					</script>

					<?php
				}
			?>





			<?php
			// ==== Si tiene una solicitud pendiente (0) ===
				if ($estadoAutorizacion == 0)
				{
					?>

					<div class="informativa csvs" style="margin-top: 0; min-height: 200px;">
						<div class="informTit">Información de artículos</div>
						<br/>
						<br/>

						<div style="font-size: 14pt;">Necesita autorización para esta sección de la web:</div>

						<br /><br />

						<div style="font-size: 14pt; color: #0b2e48; font-weight: bold;">Su solicitud está pendiente de ser autorizada. Le informaremos por email.</div>
					</div>

					<?php
				}
			?>





			<?php
			// ==== Si tiene solicitud aceptada ===
				if ($estadoAutorizacion == 1)
				{
					?>


					<div class="informativa csvs" style="margin-top: 0; min-height: 790px;">
						<div class="informTit">Información de artículos</div>
						<br/>
						<br/>
						
						<form action="" method="post" name="formliquidaciones" enctype="multipart/form-data" accept-charset="UTF-8" autocomplete="off">
							<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
							<div class="contgencsv">
								Seleccione las familias de artículos que desea exportar y pulse 
								<span style="color: #0b2e48;font-weight: bold;">Aceptar</span>:
								<br/>
								<br/>
								<div class="contCsv">
									<input type="checkbox" style="width: 20px; height: 20px; position: relative; top: 4px;" name="chtodos" onchange="if(this.checked){ seleccionar_todo_csv(); }else{ deseleccionar_todo_csv(); }"/>
									Marcar todos
									<div class="divsub">
										<input type="submit" name="generarcsv" class="generarsubmit btnCSV" value="Aceptar" style="background-color: #0b2e48; color: white;" />
									</div>
								</div>

								<?php
							        if (isset($_POST["generarcsv"]))
							        {
							            if ( !isset($_POST["check"]) )
							            {
							            	?>

							            	<div class="contCsv">No ha seleccionado ninguna familia</div>

							            	<?php
							            }
							            else
							            {
							            	
							            	?>

										        <div class="csvDiv_fila">
										            <div class="csvDiv_celda"><a class="csv_link" target='_blank' href='<?php echo $nomfich; ?>.csv'>Descargar CSV</a></div>
										            <div class="csvDiv_celda"><a class="csv_link" target='_blank' href='<?php echo $nomfichReduc; ?>.csv'>Descargar CSV reducido</a></div>
										            <div class="csvDiv_celda"><a class="csv_link" target='_blank' href='<?php echo $nomfichPresta; ?>.csv'>Descargar art&iacute;culos para Prestashop</a></div>
										            <div class="csvDiv_celda"><a class="csv_link" target='_blank' href='<?php echo $nomfichCat; ?>.csv'>Descargar categor&iacute;as para Prestashop</a></div>
										        </div>

							            	<?php
							            }
							        }
								?>


								@foreach ($arrTiposArtCSV as $arrTipoArtCSV)
									<div class="contParent" style="border-color: #0b2e48;">
										<h2 style="background-color: #0b2e48; color: white;">{{$arrTipoArtCSV->descr}}</h2>
										@foreach ($arrCategoriasCSV as $arrCategoriaCSV)
											@if ($arrTipoArtCSV->id == $arrCategoriaCSV->parent)
												<div>
												@foreach ($arrSubCategoriasCSV as $arrSubCategoriaCSV)
													@if ($arrCategoriaCSV->gcod == $arrSubCategoriaCSV->GCOD)
														&nbsp;
														<br/>
														<span style="color: #0b2e48;font-weight: bold;font-size: 1.3em;margin-bottom: 5px;">
															{{$arrSubCategoriaCSV->GDES}}
														</span>
														<br/>
														<br/>
														@foreach ($arrFamiliasCSV as $arrFamiliaCSV)
															@if ($arrSubCategoriaCSV->GCOD == $arrFamiliaCSV->FGRUPO)
																&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
																<input type="checkbox" name="check[]" id="check{{$arrFamiliaCSV->FCOD}}" value="{{$arrFamiliaCSV->FCOD}}">
																&nbsp;
																<span style="font-size: 1em;">{{$arrFamiliaCSV->FDES}}</span>
																<br/>
															@endif
														@endforeach
														<br/>
													@endif
												@endforeach
												</div>
											@endif
										@endforeach
									</div>
								@endforeach
							</div>
						</form>

				</div>

				<?php
			}
		?>


<?php } ?>
</div>

@endsection