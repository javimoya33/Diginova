@if(isset($message))
	<!--
	<img class="" style="width: 100%;"
		src="< ? p h p  echo $message->embed(URL::asset('public/images/logoempresa.jpg')); ? >" />
	-->
	<img class="" style="width: 100%;"
		src="<?php echo (public_path().'/images/logoempresa.jpg'); ?>" />
@endif
<h3>{{T::tr('Documento de RMA en')}} {{session("entorno")->config->x_nomemp}}</h3>
<p>{!!$notas!!}</p>
