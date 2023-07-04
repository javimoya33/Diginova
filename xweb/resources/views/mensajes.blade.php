@extends("base")

@section("titulo")
{{session("entorno")->config->x_faqtit}}
@endsection

@section("localizador")
@endsection

@section("dashboard")
@endsection

@section("central")
	@if($tipo=="registro")
		<div id="xw_boxcentral" style="min-height:500px; padding-top: 0px; background-color: #fafafa; background-color: #f3f3f3;">
			<div id="nodata" class="alert alert-danger" role="alert"
				style='display: block'>
				<span class="glyphicon glyphicon-info"></span>&nbsp;<strong>{{T::tr('Atención')}} </strong>{{T::tr('Se ha enviado un correo a su dirección, compruebe la bandeja de entrada')}}.
			</div>
		</div>
	@endif
@endsection
