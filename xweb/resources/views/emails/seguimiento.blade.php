@if(isset($message))
<!--
<img class="" style="width: 100%;"
	src="< ? p h p  echo $message->embed(URL::asset('public/images/logoempresa.jpg')); ? >" />
-->
<img class="" style="width: 100%;"
	src="<?php echo $message->embed(public_path().'/images/logoempresa.jpg'); ?>" />
@endif
<h3>{{Session::get("entorno")->config->x_nomemp}} - {{T::tr('Seguimiento de su envío')}}</h3>


<p>{{T::tr('Hola')}}, {{$datos['nombreUsuario']}}.</p>
<p>{{T::tr('Le informamos acerca de los datos de seguimiento de su envío')}}.</p>
<p>{{T::tr('Puede acceder a él desde el siguiente enlace')}}:</p>
<p><a href="{{$datos['rutaseguimiento']}}" title="{{$datos['rutaseguimiento']}}">{{$datos['rutaseguimiento']}}</a></p>









@if(1==10)
	Datos que se pueden usar:
	<pre>
	{{var_dump($datos)}}
	</pre>
@endif