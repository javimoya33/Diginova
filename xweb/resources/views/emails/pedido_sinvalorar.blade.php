<style>
.solido {
	border: 1px #000000 solid;
	border-collapse: collapse;
	padding: 3px;
}
</style>
@if(isset($message))
<img class="" style="width: 40%;"
	src="<?php echo $message->embed(URL::asset('public/images/logoempresa.jpg')); ?>" />
@endif
<h3>{{T::tr('Detalles del pedido realizado por')}} {{session("usuario")->uData->cnom}} en
	{{session("entorno")->config->x_nomemp}}</h3>
<p>{{T::tr('A continuación se muestra el detalle del pedido nº')}}
	{{$desgloseCesta->numPedido}}:</p>
<?php
$decprec = session ( 'entorno' )->config->x_decpreci;
$deccan = session ( 'entorno' )->config->x_deccanti;
?>
<table width='90%' height='auto' class="solido">
	<thead>
		<tr>
			<th class="solido">{{T::tr('Producto')}}</th>
			<th class="solido">{{T::tr('Cantidad')}}</th>
		</tr>
	</thead>
	<tbody>
		@foreach($matrizCesta as $bces)
		<tr>
			<td class="solido">
			@if($bces->imag1a!=="nofoto.jpg")
			<img src="{{URL::asset('public/articulos/'. str_replace(' ','%20',$bces->imag1a))}}" width="80px;" height="auto" style="vertical-align: middle;"/>
			@endif
			{{$bces->acodar}}-{{$bces->adescr}}
			
			</td>
			<td class="solido"><div align='right'>{{Utils::numFormat($bces->cantiCesta,0)}}</div></td>
		</tr>
		@endforeach
	</tbody>
</table>

<p>{{T::tr('La forma de envío seleccionada es')}}:&nbsp;
@foreach($formasEnvio as $fpag)
	@if($fpag->wcod==$desgloseCesta->formaEnvio)
		{{$fpag->wtit}}
		@if($fpag->wrecotiend)
			&nbsp;({{T::tr('recogida en tienda')}} {{$desgloseCesta->enTiendaPorDefecto}})
		@else
		<?php $desgloseCesta->enTiendaPorDefecto="";?>
		@endif
	@endif
@endforeach
</p>
<p>
@if($desgloseCesta->direccionEnvio==0)
	{{T::tr('El pedido se enviará a la dirección especificada en la ficha de cliente')}}
@endif
@if($desgloseCesta->direccionEnvio>0 && $desgloseCesta->enTiendaPorDefecto=="")
	{{T::tr('El pedido se enviará a')}}:<br/>
@foreach($direccionesEnvio as $fpag)
	@if($fpag->id==$desgloseCesta->direccionEnvio)
		{{$fpag->nombre}}<br/>
		{{$fpag->direccion}}<br/>
		{{$fpag->cpostal}}&nbsp;{{$fpag->poblacion}}&nbsp;{{$fpag->provincia}}<br/>
		{{T::tr('Teléfono')}}: &nbsp;{{$fpag->telefono}}<br/>
		{{T::tr('Observaciones')}}:&nbsp;{{$fpag->observaciones}}<br/>
	@endif
@endforeach
@endif
</p>
@if($desgloseCesta->anotaciones!=="")
<p>Anotaciones acerca del pedido:&nbsp;{{$desgloseCesta->anotaciones}}</p>
@endif





@if(1==10)
<pre>
	Datos que se pueden usar:

	
	<br /><br />desgloseCesta
	{{var_dump($desgloseCesta)}}
	
	<br /><br />matrizCesta
	{{var_dump($matrizCesta)}}
	
	<br /><br />direccionesEnvio
	{{var_dump($direccionesEnvio)}}
	
	<br /><br />formasPago
	{{var_dump($formasPago)}}
	
	<br /><br />formasEnvio
	{{var_dump($formasEnvio)}}
	
	@if(!is_null($desgloseCesta->centroDatos))
		{{$desgloseCesta->centroDatos[0]->znom}} centro
	@endif
	
	</pre>
@endif
