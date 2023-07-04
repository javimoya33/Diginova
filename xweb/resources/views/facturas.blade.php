@extends("base")

@section("dashboard")

<div id="xw_boxcentral">
	<div class="informTit" style="margin: 0 auto; text-align: center;">Facturas</div>
	<p class="pfacturas2">Por favor, seleccione el rango de fechas de las facturas que desea consultar:</p>
	<br/>
	<br/>
	<div class="rangofacturas2">
		<form name="pidefechas" method="post">
			De:&nbsp;
			<select name="diaini" size="1">
				@for ($i = 1; $i <= 31; $i++)
					@if ($i == 1)
						<option value="{{$i}}" selected>01</option>
					@else
						@if ($i < 10)
							<option value="{{$i}}">0{{$i}}</option>
						@else
							<option value="{{$i}}">{{$i}}</option>
						@endif
					@endif
				@endfor
			</select>
			&nbsp;/&nbsp;
			<select name="mesini" size="1">
				@for ($i = 1; $i <= 12; $i++)
					@if ($i == 1)
						<option value="{{$i}}" selected>01</option>
					@else
						@if ($i < 10)
							<option value="{{$i}}">0{{$i}}</option>
						@else
							<option value="{{$i}}">{{$i}}</option>
						@endif
					@endif
				@endfor
			</select>
			&nbsp;/&nbsp;
			<select name="anioini" size="1">
				@for ($i = $anio; $i >= 1990; $i--)
					@if ($i == $anio)
						<option value="{{$i}}" selected>{{$anio}}</option>
					@else
						<option value="{{$i}}">{{$i}}</option>
					@endif				
				@endfor
			</select>
			&nbsp;&nbsp;Hasta:&nbsp;
			<select name="diafin" size="1">
				@for ($i = 1; $i <= 31; $i++)
					@if ($i == 31)
						<option value="{{$i}}" selected>{{$i}}</option>
					@else
						@if ($i < 10)
							<option value="{{$i}}">0{{$i}}</option>
						@else
							<option value="{{$i}}">{{$i}}</option>
						@endif
					@endif
				@endfor
			</select>
			&nbsp;/&nbsp;
			<select name="mesini" size="1">
				@for ($i = 1; $i <= 12; $i++)
					@if ($i == 12)
						<option value="{{$i}}" selected>{{$i}}</option>
					@else
						@if ($i < 10)
							<option value="{{$i}}">0{{$i}}</option>
						@else
							<option value="{{$i}}">{{$i}}</option>
						@endif
					@endif
				@endfor
			</select>
			&nbsp;/&nbsp;
			<select name="anioini" size="1">
				@for ($i = $anio; $i >= 1990; $i--)
					@if ($i == $anio)
						<option value="{{$i}}" selected>{{$anio}}</option>
					@else
						<option value="{{$i}}">{{$i}}</option>
					@endif				
				@endfor
			</select>
			<img style="margin-left:10px; margin-top: -20px; position:relative; top:9px; cursor:pointer;" align="top" src="/public/images/Lupa_DiginovaIcon.png" title="Buscar entre fechas" alt="Buscar entre fechas" border="0" />
		</form>
	</div>
	<table border="0" align="center" width="950" class="tdocumentos">
		<tr>
			<td>Número de factura</td>
			<td>Fecha</td>
			<td>Base imponible</td>
			<td>I.V.A</td>
			<td>Total Factura</td>
			<td></td>
			<td>Estado de mi envío</td>
			<td>Observaciones</td>
		</tr>
		@foreach($arrFacturas as $arrFactura)
			<tr>
				<td>
					<a href="">{{$arrFactura->FDOC}}</a>
				</td>
				<td>{{date('d-m-Y', strtotime($arrFactura->FFECHA))}}</td>
				<td>100</td>
				<td>100</td>
				<td>100</td>
				<td>
					<a target="_blank" onclick="link = document.getElementById('linkFactura'); link.setAttribute('href', 'index.php?page=facturapdf&cod=FAC00262022000078'); dialogo.showModal();" style="cursor: pointer;">
						<img align="top" src="/public/images/facpdf.jpg" border="0" width="15" height="15" title="Guardar PDF" alt="Guardar PDF">
					</a>
				</td>
				<td></td>
				<td>{{$arrFactura->FOBSE}}</td>
			</tr>	
		@endforeach
		<tr id="tr_sin_facturas" style="display: none;">
			<td colspan="4" id="xw_boxmicuentanodata" style="margin-top: 20px; background-color: white; color: black; text-align: center;">
				<img src="/public/images/info.png" border="0" width="20px" height="20px" style="margin-top: -3px" />
				&nbsp;&nbsp;No hay datos en este apartado.
			</td>
		</tr>
	</table>
</div>

@endsection