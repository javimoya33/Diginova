@extends("base")

@section("dashboard")

<div id="xw_boxcentral" style="min-height:500px; padding-top: 0px; background-color: #fafafa; background-color: #f3f3f3;">
    
    @section("titulo")
        {{session("entorno")->config->x_nomemp}} - {{T::tr('activación de cuenta')}}
    @endsection

        <h1>Activación de cuenta</h1>

        <br /><br />
        {{$texto}}


</div>

@endsection
