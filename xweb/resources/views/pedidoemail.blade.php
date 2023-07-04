<style>
.solido {
	border: 1px #000000 solid;
	border-collapse: collapse;
	padding: 3px;
}
</style>

<table style="border-collapse: collapse; display: block; table-layout: fixed; width: 800px;">
	

		<tr style="background-color: #efefef">
			<td style="font-family: sans-serif; color: #333333; padding: 5px 10px; font-size: 11pt; border-bottom: 1px #333 solid; text-align: left;" colspan="7">
				<ul style="padding-inline-start: 15px; margin-block-start: 0em; margin-block-end: 0em;">
					<li>Código de cliente: <span style="font-weight: 600; color: #333333;">{{session("usuario")->uData->ccodcl}}</span></li>
				</ul>
			</td>
		</tr>

		<tr style="background-color: #f9f9f9">
			<td style="font-family: sans-serif; color: #333333; padding: 5px 10px; font-size: 11pt; border-bottom: 1px #333 solid; text-align: left;" colspan="7">
				<ul style="padding-inline-start: 15px; margin-block-start: 0em; margin-block-end: 0em;">
					<li>Persona de contacto: <span style="font-weight: 600; color: #333333;">{{session("usuario")->uData->cnom}}</span></li>
				</ul>
			</td>
		</tr>

		<tr style="background-color: #efefef">
			<td style="font-family: sans-serif; color: #333333; padding: 5px 10px; font-size: 11pt; border-bottom: 1px #333 solid; text-align: left;" colspan="7">
				<ul style="padding-inline-start: 15px; margin-block-start: 0em; margin-block-end: 0em;">
					<li>E-mail: <span style="font-weight: 600; color: #333333;">{{session('usuario')->uData->cmail}}</span></li>
				</ul>
			</td>
		</tr>

		<tr style="background-color: #f9f9f9">
			<td style="font-family: sans-serif; color: #333333; padding: 5px 10px; font-size: 11pt; border-bottom: 1px #333 solid; text-align: left;" colspan="6">
				<ul style="padding-inline-start: 15px; margin-block-start: 0em; margin-block-end: 0em;">
					<li>¿Consultas sobre tu pedido?: haz clic <a href="https://diginova.es/preguntasfrecuentes">aquí</a></li>
				</ul>
			</td>
		</tr>
</table>
