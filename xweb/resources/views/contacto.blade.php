@extends("base")

@section("titulo")
{{session("entorno")->config->x_nomemp}} - {{T::tr('contactar')}}
@endsection

@section("localizador")
<h1>
    {{T::tr('Contactar')}}
    <small>
	</small>
</h1>
@endsection

@section("dashboard")
@endsection

@section("central")
@if(!$matrizMail->configurado)
{{T::tr('Lo sentimos, el formulario de contacto no está disponible en este momento')}}
@endif
@if($matrizMail->configurado)
<h3 class="text-danger">
	{{T::tr('Se enviará un correo de contacto a')}} <a href="mailto:{{$matrizMail->dir}}" title="{{$matrizMail->dir}}">{{$matrizMail->dir}}</a>
</h3>
<form @submit.prevent="app.contacto()" class="" role="form" method="post" action="#" name="formContacto" id="formContacto">
	<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
	<div class="form-group">
		<label for="usr">{{T::tr('Nombre')}}:</label>
		<input type="text" value="" class="form-control" name="cName" id="cName" placeholder="Mi nombre" minlength="6" v-model="nombreCliente" />
	</div>
	<div class="form-group">
		<label for="email">{{T::tr('Dirección de mail')}}:</label>
		<input type="email" value="" class="form-control" name="cMail" id="cMail" placeholder="Correo electrónico" minlength="3" v-model="eMail" />
	</div>
	<div class="form-group">
		<label for="telefono">{{T::tr('Teléfono')}}:</label>
		<input type="text" value="" class="form-control" name="cTel" id="cTel" placeholder="{{T::tr('Teléfono')}}" v-model="telefono" />
	</div>
	<div class="form-group">
		<label for="comment">{{T::tr('Consulta')}}:</label>
		<textarea class="form-control" rows="5" name="cConsulta" id="cConsulta" minlength="3" v-model="consulta"></textarea>
	</div>




	Sus datos serán tratados por {{session("entorno")->config->x_nomemp}} con la finalidad exclusiva de dar respuesta a su consulta o petición. No serán cedidos a ningún tercero. Nuestro plazo de conservación, si usted no es cliente, es de 1 año. Puede ejercitar sus derechos de acceso, rectificación, oposición, supresión, portabilidad, limitación y a nos ser objeto de decisiones automatizadas en nuestro correo <a href="mailto:{{$matrizMail->dir}}">{{$matrizMail->dir}}</a> donde le atenderá el responsable. Puede ampliar nuestra información sobre el tratamiento de datos en el enlace a la Política de privacidad.<br/>
	
	
	
	<input type="checkbox" id="acepto" onclick="">&nbsp;Acepto el tratamiento de mis datos con la finalidad descrita y tras leer el <a href="{{URL::to('politicacookies')}}">{{T::tr('aviso de privacidad')}}</a>.</input>
	<br/>



	<input type="text" name="captcha" id="captcha" maxlength="6" size="6" v-model="cCha"/>
	<img src='data:image/jpg;charset=utf8;base64,{{base64_encode(session("captcha_img"))}}'/>
	<br/>



	<button 
		type="submit" 
		class="btn btn-primary" 
		onclick="

			if(document.getElementById('acepto').checked==false)
			{
				alertify.alert('','{{T::tr('Acepte los términos de servicio')}}');
				return false;
			}
			">
			{{T::tr('Enviar')}}
		</button>
	<div  v-if="rotar" class="loader" style="float:left;" id="rotate"></div>&nbsp;
</form>
@endif
@endsection
