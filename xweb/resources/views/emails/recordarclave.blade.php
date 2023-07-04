<table style="border-collapse: collapse; display: block; table-layout: fixed; width: 800px;">
	<thead>
		<tr>
			<td>
				<img src="https://diginova.es/testmail2/img/diginovaemail.png" style="width: 100.2%; margin-bottom: -5px; margin-left: -1px;">
			</td>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>
				<h3>{{T::tr('Recordatorio de contraseña en')}} {{session("entorno")->config->x_nomemp}}</h3>
			</td>
		</tr>
		<tr>
			<td>
				<p>{{T::tr('Hola')}}, {{$datos['nombre']}}</p>
			</td>
		</tr>
		<tr>
			<td>
				<p>{{T::tr('Respondiendo a su solicitud de recordatorio de contraseña, estos los datos introducidos en nuestra web')}}:</p>
			</td>
		</tr>
		<tr>
			<td>
				<p>{{T::tr('Nombre de usuario')}}: {{$datos['usuario']}}</p>
			</td>
		</tr>
		<tr>
			<td>
				<p>{{T::tr('Dirección de mail')}}: {{$datos['mail']}}</p>
			</td>
		</tr>
		<tr>
			<td>
				<p>{{T::tr('Pulse sobre este enlace para cambiar su contraseña')}}:&nbsp;<a href="{{$datos['clave']}}" title="{{$datos['clave']}}">{{$datos['clave']}}</a></p>
			</td>
		</tr>
		<tr>
			<td>
				<div style="font-size: 10px; color: gray; text-align: justify;">Este mensaje y sus archivos adjuntos van dirigidos exclusivamente a su destinatario, pudiendo contener información confidencial sometida a secreto profesional. Si usted no es el destinatario final por favor elimínelo e infórmenos por esta vía. En cumplimiento de la Ley de Servicios de la Sociedad de la Información y de Comercio Electrónico (LSSICE) y de la Ley Orgánica 15/1999 de Protección de Datos de Carácter Personal (LOPD), por los cuales se regulan las medidas de seguridad de los ficheros automatizados, le comunicamos que su dirección de correo electrónico forma parte de la base de datos de Smarters Accesorios S.L. fichero que ha sido previamente registrado en la Agencia de Protección de Datos y cuya finalidad es informarle de las novedades, noticias y promociones de Diginova. Es voluntad de Smarters Accesorios S.L evitar el envío deliberado de correo no solicitado, por lo cual si no desea recibir más comunicaciones comerciales por nuestra parte, le rogamos nos lo indique a través de este enlace: Cancelar Suscripción. También tiene vd. a su disposición los derechos de acceso, rectificación y cancelación que le otorga la legislación correspondiente en esta materia.</div>
			</td>
		</tr>
	</tbody>
</table>











@if(1==10)
	Datos que se pueden usar:
	<pre>
	{{var_dump($datos)}}
	</pre>
@endif