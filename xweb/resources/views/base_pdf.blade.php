<!DOCTYPE html>
<html lang="es-es">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title></title>

<meta content="width=device-width, initial-scale=1" name="viewport"/>

<!-- tienda web/extranet XgestEvo www.xgestevo.net version {{session('entorno')->version}} -->
<link rel='icon' href="{{URL::asset('public/favicon.ico')}}"/>
@yield('campos_meta')
<meta name="author" content="{{session("entorno")->config->x_nomemp}} - Software de Gestión Xgest - www.xgestevo.net, xweb7 v.{{Session::get("entorno")->version}}"/>
<meta name="publisher" content="{{session("entorno")->config->x_nomemp}} - Software de Gestión Xgest - www.xgestevo.net, xweb7 v.{{Session::get("entorno")->version}}"/>
<meta name="csrf-token" content="{{ csrf_token() }}"/>
<!-- Tell the browser to be responsive to screen width -->
<meta content="width=device-width, initial-scale=1" name="viewport"/>
<!-- Bootstrap -->
<link rel="stylesheet" href="{{URL::asset('public/css/bootstrap.min.css')}}"/>
<!-- Font Awesome -->
<link rel="stylesheet" href="{{URL::asset('public/css/font-awesome.min.css')}}"/>
<!-- Ionicons -->
<link rel="stylesheet" href="{{URL::asset('public/css/ionicons.min.css')}}"/>
<!-- Theme style -->
<link rel="stylesheet" href="{{URL::asset('public/css/AdminLTE.min.css')}}"/>
<!-- lightbox -->
<link rel="stylesheet" href="{{URL::asset('public/css/lightbox.min.css')}}"/>
<!-- AdminLTE Skins. Choose a skin from the css/skins
      folder instead of downloading all of them to reduce the load. -->
<link rel="stylesheet" href="{{URL::asset('public/css/_all-skins.min.css')}}"/>
<link rel="stylesheet" href="{{URL::asset('public/css/bootstrap-table.min.css')}}"/>
<link rel="stylesheet" href="{{URL::asset('public/css/datatables.min.css')}}"/>
<!-- datetimepicker -->
<link rel="stylesheet" href="{{URL::asset('public/css/jquery.datetimepicker.css')}}"/>
<!-- alertify -->
<link rel="stylesheet" href="{{URL::asset('public/css/alertify.min.css')}}"/>
<link rel="stylesheet" href="{{URL::asset('public/css/themes/default.min.css')}}"/>
<!-- xgest -->
<link rel="stylesheet" href="{{URL::asset('public/css/xgest.css?'.Session::get('entorno')->version)}}"/>
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
<!-- Google Font -->
<!--
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<link href="https://fonts.googleapis.com/css?family=Ubuntu:500,700&display=swap" rel="stylesheet">
-->
<link href="https://fonts.googleapis.com/css?family=Mada:500,700&display=swap" rel="stylesheet"/>
<!-- jQuery 3 -->
<script src="{{URL::asset('public/js/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{URL::asset('public/js/jquery-ui.min.js')}}"></script>
<!-- Bootstrap -->
<script src="{{URL::asset('public/js/bootstrap.min.js')}}"></script>
<!-- Bootstrap tables -->
<script src="{{URL::asset('public/js/bootstrap-table.min.js')}}"></script>
<!-- Bootstrap tables -->
<script src="{{URL::asset('public/js/datatables.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{URL::asset('public/js/adminlte.min.js')}}"></script>
<!-- lightbox -->
<script src="{{URL::asset('public/js/lightbox.min.js')}}"></script>
<!-- datetimepickerjs -->
<script src="{{URL::asset('public/js/jquery.datetimepicker.js')}}"></script>
<script src="{{URL::asset('public/js/vue.min.js')}}"></script>
<script src="{{URL::asset('public/js/vue-resource.min.js')}}"></script>
<script src="{{URL::asset('public/js/xgest.js?random=x'.Session::get('entorno')->version)}}"></script>
<script src="{{URL::asset('public/js/alertify.min.js')}}"></script>
<!--
<script src="{{URL::asset('public/js/es6-promise.min.js')}}"></script>
<script src="{{URL::asset('public/js/es6-promise.auto.min.js')}}"></script>
-->
<script src="{{URL::asset('public/js/axios.min.js')}}"></script>
<script type="text/javascript">
  $(document).ready(function() {
    cookiesOnLoad();
    supScroll();
    @if(Session::has('splash'))
    mostrarSplash();
    {{Session::forget('splash')}}
    @endif
    @if(isset($seccion))
      @if($seccion=="inicio")
        app.procesosSecundarios();
      @endif
    @endif
  });
  console.log("Software de Gestión Xgest - www.xgestevo.net, xweb7 v.{{Session::get('entorno')->version}}");
</script>

<script>
$(document).ready(function() {
    window.print();
  });
</script>



<style>
body {
}
page[size="A4"] {
  background: white;
  width: 21cm;
  height: 29.7cm;
  display: block;
  margin: 0 auto;
  margin-bottom: 0.5cm;
  box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
}
@page {
  size: A4 portrait; 
}

@media print {
  body, page[size="A4"] {
    margin: 0;
    box-shadow: 0;
  }
   div.saltopagina{
		min-height: 1px;
      page-break-after:always;
   }
}
</style>



</head>

<body>
  
<img class="img-responsive imgresponsive" style="width: 30%;" src="{{URL::asset('public/images/logoempresa_mini.jpg')}}" 
		title="{{session("entorno")->config->x_nomemp}}" alt="{{session("entorno")->config->x_nomemp}}" />

<h2>Catálogo de productos {{$articulos[0]->nomfamiliaoriginal}}</h2>
        @include("base_central")

</body>

</html>