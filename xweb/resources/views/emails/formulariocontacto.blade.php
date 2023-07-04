@if(isset($message))
<!--
<img class="" style="width: 100%;"
	src="< ? p h p  echo $message->embed(URL::asset('public/images/logoempresa.jpg')); ? >" />
-->
<img class="" style="width: 100%;"
	src="<?php echo $message->embed(public_path().'/images/logoempresa.jpg'); ?>" />
@endif
<h3>{{T::tr('Formulario de contacto de')}} {{session("entorno")->config->x_nomemp}}</h3>
<p>{{$datos['cName']}} {{T::tr('ha escrito')}}:</p>
<p>{{$datos['cConsulta']}}</p>
<p>{{T::tr('Su dirección de correo es')}}: {{$datos['cMail']}}</p>
<p>{{T::tr('Su teléfono es')}}: {{$datos['cTel']}}</p>
@if(session('usuario')->uData->codigo>0)
	<p>{{T::tr('El usuario estaba logeado con código de cliente')}} {{session('usuario')->uData->codigo}}</p>
@endif
