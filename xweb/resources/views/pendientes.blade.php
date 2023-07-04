@extends("base")

@section("dashboard")

<div id="xw_boxcentral" class="fichaBoxCentral">
	<br/>
	<div class="titulo_tr" style="margin-top: 5px;margin-bottom: 10px;">
		<span>Recibos, cobros y albaranes pendientes</span>
	</div>
	<br/>
	<div id="xw_boxmicuenta" style="width: 950px; margin: 0 auto;margin-top:-30px;">
		<p class="pfacturas">Relación de albaranes pendientes de facturar:</p>
		<table border="0" align="center" width="950" class="tdocumentos" style="margin-top: 10px;">
			<tr>
				<td>Albarán</td>
				<td>Fecha</td>
				<td>Texto pedido</td>
				<td>Base imponible</td>
			</tr>
		</table>
	</div>
	<br/>
	<div id="xw_boxmicuenta" style="width: 950px; margin: 0 auto;margin-top:-30px;">
		<p class="pfacturas">Relación de recibos pendientes de cobro (ordenados por fecha de vencimiento):</p>
		<table border="0" align="center" width="950" class="tdocumentos" style="margin-top: 10px;">
			<tr>
				<td>Factura</td>
				<td>Nº Rec.</td>
				<td>Fecha</td>
				<td>Vencimiento</td>
				<td>Importe</td>
				<td>Cobrado</td>
				<td>Pendiente</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td style="background-color: #ff0041;" align="right">Suma:</td>
				<td style="background-color: #ff0041;">Fecha</td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
		</table>
	</div>
	<br/>
	<div id="xw_boxmicuenta" style="width: 950px; margin: 0 auto;margin-top:-30px;">
		<p class="pfacturas">Relación de cobros recibidos pendientes de vencimiento:</p>
		<table border="0" align="center" width="950" class="tdocumentos" style="margin-top: 10px;">
			<tr>
				<td>Factura</td>
				<td>Nº Rec.</td>
				<td>Fecha</td>
				<td>Vencimiento</td>
				<td>Importe</td>
				<td>Cobrado</td>
				<td>Pendiente</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td style="background-color: #ff0041;" align="right">Suma:</td>
				<td style="background-color: #ff0041;">Fecha</td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
		</table>
	</div>
</div>

@endsection