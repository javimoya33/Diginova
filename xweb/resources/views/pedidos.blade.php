@extends("base")

@section("dashboard")

<div id="xw_boxcentral">
	<div class="informTit" style="margin: 0 auto; text-align: center;">Pedidos</div>
	<div class="contdocu">
		<div>
			<div class="fuente" style="font-size: 12pt;">
				<input type="radio" id="pedidos_todos" name="solop" value="N" checked="checked" />&nbsp;Todos &nbsp;&nbsp;&nbsp;
				<input type="radio" id="pedidos_pendientes" name="solop" value="N" />&nbsp;Sólo pendientes
			</div>
		</div> 
	</div>
	<table border="0" align="center" width="950" class="tdocumentos">
		<tr>
			<td>Número de presupuesto</td>
			<td>Fecha</td>
			<td>Base imponible</td>
			<td>Estado</td>
		</tr>
		@foreach($arrPedidos as $arrPedido)
			<tr>
				<td>
					<a href="">{{$arrPedido->BPED}}</a>
				</td>
				<td>{{$arrPedido->BFECPED}}</td>
				<td>100</td>
				<td>CADUCADO</td>
			</tr>	
		@endforeach
		<tr id="tr_sin_pedidos" style="display: none;">
			<td colspan="4" id="xw_boxmicuentanodata" style="margin-top: 20px; background-color: white; color: black; text-align: center;">
				<img src="/xweb/public/images/info.png" border="0" width="20px" height="20px" style="margin-top: -3px" />
				&nbsp;&nbsp;No hay datos en este apartado.
			</td>
		</tr>
	</table>
</div>

@endsection