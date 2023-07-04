<!--
<img class="" style="width: 100%;"
	src="< ? p h p  echo $message->embed(URL::asset('public/images/logoempresa.jpg')); ? >" />
-->
<p><b>{{T::tr('Destinatario')}}:</b></p>
{!!$datos[0]->direccion!!}
<p>RMA nº {!!$numero!!}</p>
<br/>
<br/>
<p><b>{{T::tr('Remitente')}}:</b></p>
{{$datoscliente->cnom}}<br/>
{{$datoscliente->cdom}}<br/>
{{$datoscliente->ccodpo}} {{$datoscliente->cpob}} {{$datoscliente->cpais}}<br/>
{{$datoscliente->ctel1}}
<br/><br/><br/>
<script src="{{URL::asset('public/js/jquery.min.js')}}"></script>
<script src="{{URL::asset('public/js/jquery-barcode.js')}}"></script>
<div id="bcTarget"></div>
<script>
$("#bcTarget").barcode("RMA{{substr('0000'.$numero,-14)}}", "code128");     
</script>