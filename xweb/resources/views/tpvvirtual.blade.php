@extends("base")

@section("dashboard")

<div id='xw_boxcentral' style="padding-top: 20px; min-height: 730px;">

	<div id="xw_boxcontacto" style="margin-top:-10px">
		<div class="conttitulo_tr">
			<br /><br />
			<div class="titulo_tr" style="margin-top: 0px;margin-bottom: 0;margin:0 auto;"><span>Tpv virtual</span></div>
			<br /><br /><br /><br />
		</div>
		
		<div class="tpvvCont">
			
			<table class="tTpvps" border="0" align="center" width="550">
				<tr>
					<td>Nombre: </td>
					<td class="azulbold">{{$cnom}}</td>
				</tr>
				<tr>
					<td>Nº Albarán: </td>
					<td class="azulbold">{{$balba}}</td>
				</tr>
				<tr>
					<td>Total:</td>
					<td class="azulbold">{{$totalF}} &euro;</td>
				</tr>
			</table>
			<br /><br />
			<div class="tpvTexto">
				Haga click en "Continuar" para ir a la plataforma de pago seguro.
			</div>

			<br />							
			
			<form name="frm" action="{{$urlForm}}" method="POST" >
				<input type="hidden" name="Ds_SignatureVersion" value="{{$version}}"/></br>
				<input type="hidden" name="Ds_MerchantParameters" value="{{$params}}"/></br>
				<input type="hidden" name="Ds_Signature" value="{{$signature}}"/></br>
				<input style="cursor: pointer;" type="submit" value="Continuar">
			</form>
		</div>
	</div>

	<br /><br /><br /><br /><br /><br />
</div>

@endsection