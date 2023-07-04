@extends("base")

@section("dashboard")

<div id='xw_boxcentral' style="padding-top: 20px; min-height: 730px;">

	<div id="xw_boxcontacto" style="margin-top:-10px">
		<div class="conttitulo_tr">
			<br /><br />
			<div class="titulo_tr" style="margin-top: 0px;margin-bottom: 0;margin:0 auto;"><span>Justificante de proforma</span></div>
			<br /><br /><br /><br />
		</div>
		
		<div class="tpvvCont">

			<?php
				$balba = 0; 
				
				if ( count($filaProforma) == 0 )
				{
					?>

					Proforma no encontrada


					<?php
				}
				else
				{
					$filaProforma = $filaProforma[0];
					$balba = $filaProforma -> strdocs;
					$cnom = $filaProforma -> cnom;
					$totalpendiente = $filaProforma -> totalpendiente;
					$totalpendienteF = number_format($totalpendiente, 2, ",", "."); $totalpendienteF .= "&euro;";


					?>


					<form action="/xweb/proformajustificanteej" method="post" enctype="multipart/form-data">
						<input type="hidden" id="_token" name="_token" value="{{{ csrf_token() }}}" />
						<input type="hidden" name="MAX_FILE_SIZE" value="200000" /> 
						<input type="hidden" name="k" value="<?php echo $k; ?>" /> 

						<table class="tTpvps" border="0" align="center" width="550">
							<tr>
								<td>Nombre: </td>
								<td class="azulbold"><?php echo $cnom; ?></td>
							</tr>
							<tr>
								<td>Nº Albarán: </td>
								<td class="azulbold"><?php echo $balba; ?></td>
							</tr>
							<tr>
								<td>Total:</td>
								<td class="azulbold"><?php echo $totalpendienteF; ?></td>
							</tr>
						</table>


						<table class="tTpvps" border="0" align="center" width="600"  style="margin-top: 50px;">
							<tr>
								<td>Por favor, remita el justificante de pago. Debe ser en formato PDF:</td>
							</tr>
							
							<tr>
								<td style="padding: 15px 0 30px 20px;"><input type="file" name="pdfFile" /></td>
							</tr>
							
							<tr>
								<td style="text-align: left; padding-left: 105px;"><input type="submit" name="justificante_enviar" value="Continuar" style="cursor: pointer;" /></td>
							</tr>
						</table>
					</form>

					<?php
				}

				if (isset( $todoOk )  )
				{
					if ($todoOk)
					{
						?>

						<div style="color: green;">El archivo se ha enviado correctamente.<br /><br /><br />El pedido ser&aacute; procesado lo antes posible.<br /><br /><br /><br /><br /><br /><br /><br /><br /></div>

						<?php
					}
					else
					{
						?>

						<div style='color:  red;'>Se ha producido un error. Por favor, vuelva a intentarlo.</div>

						<?php
					}
				}

			?>
			

			<br /><br />

			<br />		
		</div>
	</div>

	<br /><br /><br /><br /><br /><br />
</div>

@endsection