<table style="border-collapse: collapse; border-spacing: 0" width="750">
	<tr>
		<td colspan="7">
			<img src="https://diginova.es/testmail2/img/diginovaemail.png" style="display: block; margin-bottom: -1px;" width="750">
		</td>
	</tr>
	<tr style="background: #313131; height: 40px">
		<td></td>
		<td colspan="6">
			<div style="font-size: 10pt; font-family: inherit; color: #dedede; font-weight: bold; font-family: Verdana, Arial, Helvetica, sans-serif">
				Acaba de realizar cambios en sus datos de cliente, sus datos actuales son:
			</div>
		</td>
	</tr>
	<tr style="background-color: #e4e4e4">
		<td style="padding: 10px 5px; width: 38px;"></td>
		<td style="font-size: 10pt; font-family: inherit; color: #0b2e48; font-weight: bold; text-align: left; padding-right: 10px; font-family: Verdana, Arial, Helvetica, sans-serif; width: 90px;"></td>
		<td style="font-size: 12pt; font-family: inherit; color: #3b444d; font-weight: bold; font-family: monospace;  width: 237px;"></td>
		<td style="width: 20px"></td>
		<td style="padding: 10px 5px width: 38px;"></td>
		<td style="font-size: 10pt; font-family: inherit; color: #0b2e48; font-weight: bold; text-align: left; padding-right: 10px; font-family: Verdana, Arial, Helvetica, sans-serif;  width:100px;"></td>
		<td style="font-size: 12pt; font-family: inherit; color: #3b444d; font-weight: bold; font-family: monospace;  width: 227px;"></td>
	</tr>
	<tr style="background-color: #e4e4e4">
		<td style="padding: 10px 5px; width: 38px;">
			<img src="https://diginova.es/xweb/images/user_email.png" style="width: 16px; padding-left: 15px;">
		</td>
		<td style="font-size: 10pt; font-family: inherit; color: #0b2e48; font-weight: bold; text-align: left; padding-right: 10px; font-family: Verdana, Arial, Helvetica, sans-serif; width: 90px;">
			Usuario: 
		</td>
		<td style="font-size: 12pt; font-family: inherit; color: #3b444d; font-weight: bold; font-family: monospace;  width: 237px;">
			{{$datos['nombreUsuario']}}
		</td>
		<td style="width: 20px"></td>
		<td style="padding: 10px 5px width: 38px;"></td>
		<td style="font-size: 10pt; font-family: inherit; color: #0b2e48; font-weight: bold; text-align: left; padding-right: 10px; font-family: Verdana, Arial, Helvetica, sans-serif;  width: 100px;"></td>
		<td style="font-size: 12pt; font-family: inherit; color: #3b444d; font-weight: bold; font-family: monospace;  width: 227px;"></td>
	</tr>
	<tr style="background-color: #eee">
		<td style="padding: 10px 5px; width: 38px;">
			<img src="https://diginova.es/xweb/images/name_email.png" style="width: 16px; padding-left: 15px;">
		</td>
		<td style="font-size: 10pt; font-family: inherit; color: #0b2e48; text-align: left; padding-right: 10px; font-family: Verdana, Arial, Helvetica, sans-serif; width: 90px;">
			Nombre: 
		</td>
		<td style="font-size: 12pt; font-family: inherit; color: #3b444d; font-family: monospace; width: 237px;">
			{{$datos['nombreCliente']}}
		</td>
		<td style="width: 20px"></td>
		<td style="padding: 10px 5px; width: 38px;">
			<img src="https://diginova.es/xweb/images/id-card_email.png" style="width: 16px; padding-left: 15px;">
		</td>
		<td style="font-size: 10pt; font-family: inherit; color: #0b2e48; text-align: left; padding-right: 10px; font-family: Verdana, Arial, Helvetica, sans-serif; width: 100px;">
			DNI/CIF: 
		</td>
		<td style="font-size: 12pt; font-family: inherit; color: #3b444d; font-family: monospace; width: 227px;">
			{{$datos['dni']}}
		</td>
	</tr>
	<tr style="background-color: #e4e4e4">
		<td style="padding: 10px 5px; width: 38px;">
			<img src="https://diginova.es/xweb/images/home_email.png" style="width: 16px; padding-left: 15px;">
		</td>
		<td style="font-size: 10pt; font-family: inherit; color: #0b2e48; text-align: left; padding-right: 10px; font-family: Verdana, Arial, Helvetica, sans-serif; width: 90px;">
			Domicilio: 
		</td>
		<td style="font-size: 12pt; font-family: inherit; color: #3b444d; font-family: monospace; width: 237px;">
			{{$datos['direccion']}}
		</td>
		<td style="width: 20px"></td>
		<td style="padding: 10px 5px; width: 38px;">
			<img src="https://diginova.es/xweb/images/postbox_email.png" style="width: 16px; padding-left: 15px;">
		</td>
		<td style="font-size: 10pt; font-family: inherit; color: #0b2e48; text-align: left; padding-right: 10px; font-family: Verdana, Arial, Helvetica, sans-serif; width: 100px;">
			CP: 
		</td>
		<td style="font-size: 12pt; font-family: inherit; color: #3b444d; font-family: monospace; width: 227px;">
			{{$datos['codigoPostal']}}
		</td>
	</tr>
	<tr style="background-color: #eee">
		<td style="padding: 10px 5px; width: 38px;">
			<img src="https://diginova.es/xweb/images/building_email.png" style="width: 16px; padding-left: 15px;">
		</td>
		<td style="font-size: 10pt; font-family: inherit; color: #0b2e48; text-align: left; padding-right: 10px; font-family: Verdana, Arial, Helvetica, sans-serif; width: 90px;">
			Población: 
		</td>
		<td style="font-size: 12pt; font-family: inherit; color: #3b444d; font-family: monospace; width: 237px;">
			{{$datos['poblacion']}}
		</td>
		<td style="width: 20px"></td>
		<td style="padding: 10px 5px; width: 38px;">
			<img src="https://diginova.es/xweb/images/city_email.png" style="width: 16px; padding-left: 15px;">
		</td>
		<td style="font-size: 10pt; font-family: inherit; color: #0b2e48; text-align: left; padding-right: 10px; font-family: Verdana, Arial, Helvetica, sans-serif; width: 100px;">
			Provincia: 
		</td>
		<td style="font-size: 12pt; font-family: inherit; color: #3b444d; font-family: monospace; width: 227px;">
			{{$datos['provinciaNombre']}}
		</td>
	</tr>
	<tr style="background-color: #e4e4e4">
		<td style="padding: 10px 5px; width: 38px;">
			<img src="https://diginova.es/xweb/images/email_email.png" style="width: 16px; padding-left: 15px;">
		</td>
		<td style="font-size: 10pt; font-family: inherit; color: #0b2e48; text-align: left; padding-right: 10px; font-family: Verdana, Arial, Helvetica, sans-serif; width: 90px;">
			Email: 
		</td>
		<td style="font-size: 12pt; font-family: inherit; color: #3b444d; font-family: monospace; width: 237px;">
			{{$datos['eMail']}}
		</td>
		<td style="width: 20px"></td>
		<td style="padding: 10px 5px; width: 38px;">
			<img src="https://diginova.es/xweb/images/phone-call_email.png" style="width: 16px; padding-left: 15px;">
		</td>
		<td style="font-size: 10pt; font-family: inherit; color: #0b2e48; text-align: left; padding-right: 10px; font-family: Verdana, Arial, Helvetica, sans-serif; width: 100px;">
			Teléfono: 
		</td>
		<td style="font-size: 12pt; font-family: inherit; color: #3b444d; font-family: monospace; width: 227px;">
			{{$datos['telefono']}}
		</td>
	</tr>
	<tr>
		<td colspan="7">
			<img src="http://diginova.es/testmail2/img/diginovafootermail.jpg" width="750" style="margin-top: -1px;">
		</td>
	</tr>
	<tr>
		<td colspan="7" style="font-size: 10px; color: gray; text-align: justify">
			Este mensaje y sus archivos adjuntos van dirigidos exclusivamente a su destinatario, pudiendo contener información confidencial sometida a secreto profesional. Si usted no es el destinatario final por favor elimínelo e infórmenos por esta vía. En cumplimiento de la Ley de Servicios de la Sociedad de la Información y de Comercio Electrónico (LSSICE) y de la Ley Orgánica 15/1999 de Protección de Datos de Carácter Personal (LOPD), por los cuales se regulan las medidas de seguridad de los ficheros automatizados, le comunicamos que su dirección de correo electrónico forma parte de la base de datos de Smarters Accesorios S.L. fichero que ha sido previamente registrado en la Agencia de Protección de Datos y cuya finalidad es informarle de las novedades, noticias y promociones de Diginova. Es voluntad de Smarters Accesorios S.L evitar el envío deliberado de correo no solicitado, por lo cual si no desea recibir más comunicaciones comerciales por nuestra parte, le rogamos nos lo indique a través de este enlace: Cancelar supscripción También tiene vd. a su disposición los derechos de acceso, rectificación y cancelación que le otorga la legislación correspondiente en esta materia.
		</td>
	</tr>
</table>