@extends("base")

@section("dashboard")

<div id="xw_boxcentral">
	<div class="informTit" style="margin: 0 auto; text-align: center;">Albaranes</div>
	<table border="0" align="center" width="950" class="tdocumentos">
		<tr>
			<td>Número de presupuesto</td>
			<td>Fecha</td>
			<td>Base imponible</td>
			<td>Estado</td>
		</tr>
		@foreach($arrAlbaranes as $arrAlbaran)
			<tr>
				<td>
					<a href="">{{$arrAlbaran->BALBA}}</a>
				</td>
				<td>{{$arrAlbaran->BFECHA}}</td>
				<td>100</td>
				<td>CADUCADO</td>
			</tr>	
		@endforeach
	</table>
</div>

@endsection