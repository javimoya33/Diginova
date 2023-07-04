@if(isset($message))
<!--
<img class="" style="width: 100%;"
	src="< ? p h p  echo $message->embed(URL::asset('public/images/logoempresa.jpg')); ? >" />
-->
<img class="" style="width: 100%;"
	src="<?php echo $message->embed(public_path().'/images/logoempresa.jpg'); ?>" />
@endif
<h3>{{Session::get("entorno")->config->x_nomemp}} - {{T::tr('Aviso de disponibilidad de producto')}}</h3>


<p>{{T::tr('Hola')}}, {{$datos['nombreUsuario']}}.</p>
<p>{{T::tr('Le informamos acerca de la disponibilidad del producto')}} {{$datos['codigoArticulo']}} - {{$datos['descripcionArticulo']}} {{T::tr('tal como nos solicitó')}}.</p>
<br/>
@if($datos['articuloBloqueado']=="S")
<p>{{T::tr('Este producto ya no estará disponible en nuestra tienda')}}.</p>
<p>{{T::tr('Sentimos las molestias que esto le pueda causar')}}.</p>
@endif
@if($datos['articuloBloqueado']!=="S")
<p>{{T::tr('El producto en cuestión ya está disponible en nuestra tienda')}}.</p>
<p>{{T::tr('Puede acceder a él desde el siguiente enlace')}}:</p>
<p><a href="{{URL::to('').'/producto/'.$datos['codigoArticulo']}}" title="{{URL::to('/').'/producto/'.$datos['codigoArticulo']}}">{{URL::to('/').'/producto/'.$datos['codigoArticulo']}}</a></p>
@endif









@if(1==10)
	Datos que se pueden usar:
	<pre>
	{{var_dump($datos)}}
	</pre>
@endif