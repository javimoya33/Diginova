<!-- tienda web/extranet XgestEvo www.xgestevo.net version {{session('entorno')->version}} -->
<link rel='shortcut icon' href="{{URL::asset('public/favicon.ico')}}"/>
@yield('campos_meta')

<?php
  //or, if you DO want a file to cache, use:
  header("Cache-Control: max-age=31536000"); //30days (60sec * 60min * 24hours * 30days)

?>

<meta name="author" content="{{session('entorno')->config->x_nomemp}} - Software de Gestión Xgest - www.xgestevo.net, xweb7 v.{{Session::get('entorno')->version}}"/>
<meta name="publisher" content="{{session('entorno')->config->x_nomemp}} - Software de Gestión Xgest - www.xgestevo.net, xweb7 v.{{Session::get('entorno')->version}}"/>
<meta name="csrf-token" content="{{ csrf_token() }}"/>
<!-- Tell the browser to be responsive to screen width -->
<!--<meta content="width=device-width, initial-scale=1" name="viewport"/>-->
<!--<meta content="width=1024" name="viewport"/>-->
<!-- Bootstrap -->
<!--<link rel="stylesheet" href="{{URL::asset('public/css/bootstrap.min.css')}}"/>-->

<link rel="preload" href="{{URL::asset('public/css/bootstrap.min.css')}}" as="style" onload="this.onload=null;this.rel='stylesheet'">
<noscript><link rel="stylesheet" href="{{URL::asset('public/css/bootstrap.min.css')}}"></noscript>

<!-- Font Awesome -->
<!--<link rel="stylesheet" href="{{URL::asset('public/css/font-awesome.min.css')}}"/>-->
<link rel="preload" href="{{URL::asset('public/css/font-awesome.min.css')}}" as="style" onload="this.onload=null;this.rel='stylesheet'">
<noscript><link rel="stylesheet" href="{{URL::asset('public/css/font-awesome.min.css')}}"></noscript>

<!-- Ionicons -->
<!--<link rel="stylesheet" href="{{URL::asset('public/css/ionicons.min.css')}}"/>-->
<link rel="preload" href="{{URL::asset('public/css/ionicons.min.css')}}" as="style" onload="this.onload=null;this.rel='stylesheet'">
<noscript><link rel="stylesheet" href="{{URL::asset('public/css/ionicons.min.css')}}"></noscript>

<!-- Theme style -->
<!--<link rel="stylesheet" href="{{URL::asset('public/css/AdminLTE.min.css')}}"/>-->
<link rel="preload" href="{{URL::asset('public/css/AdminLTE.min.css')}}" as="style" onload="this.onload=null;this.rel='stylesheet'">
<noscript><link rel="stylesheet" href="{{URL::asset('public/css/AdminLTE.min.css')}}"></noscript>
<!-- lightbox -->
<!--<link rel="stylesheet" href="{{URL::asset('public/css/lightbox.min.css')}}"/>-->
<link rel="preload" href="{{URL::asset('public/css/lightbox.min.css')}}" as="style" onload="this.onload=null;this.rel='stylesheet'">
<noscript><link rel="stylesheet" href="{{URL::asset('public/css/lightbox.min.css')}}"></noscript>

<!--<link rel="stylesheet" href="{{URL::asset('public/css/lightbox.css')}}"/>
<link rel="preload" href="{{URL::asset('public/css/lightbox.css')}}" as="style" onload="this.onload=null;this.rel='stylesheet'">
<noscript><link rel="stylesheet" href="{{URL::asset('public/css/lightbox.css')}}"></noscript>-->


<!-- AdminLTE Skins. Choose a skin from the css/skins
      folder instead of downloading all of them to reduce the load. -->
<!--<link rel="stylesheet" href="{{URL::asset('public/css/_all-skins.min.css')}}"/>-->
<link rel="preload" href="{{URL::asset('public/css/_all-skins.min.css')}}" as="style" onload="this.onload=null;this.rel='stylesheet'">
<noscript><link rel="stylesheet" href="{{URL::asset('public/css/_all-skins.min.css')}}"></noscript>

<!--<link rel="stylesheet" href="{{URL::asset('public/css/bootstrap-table.min.css')}}"/>-->
<link rel="stylesheet" href="{{URL::asset('public/css/datatables.min.css')}}"/>

<!-- datetimepicker -->
<!--<link rel="stylesheet" href="{{URL::asset('public/css/jquery.datetimepicker.css')}}"/>-->
<link rel="preload" href="{{URL::asset('public/css/jquery.datetimepicker.css')}}" as="style" onload="this.onload=null;this.rel='stylesheet'">
<noscript><link rel="stylesheet" href="{{URL::asset('public/css/jquery.datetimepicker.css')}}"></noscript>

<!-- alertify -->
<link rel="stylesheet" href="{{URL::asset('public/css/alertify.min.css')}}"/>
<link rel="stylesheet" href="{{URL::asset('public/css/themes/default.min.css')}}"/>
<!-- xgest -->
<link rel="stylesheet" href="{{URL::asset('public/css/xgest.css?'.Session::get('entorno')->version)}}"/>
<!--<link rel="stylesheet" href="{{URL::asset('public/css/themes/estilo_xweb_1.css')}}"/>-->
<link rel="preload" href="{{URL::asset('public/css/themes/estilo_xweb_1.css')}}" as="style" onload="this.onload=null;this.rel='stylesheet'">
<link rel="preload" media="only screen and (max-width: 992px)" href="{{URL::asset('public/css/themes/estilo_xweb_1_992px.css')}}" as="style" onload="this.onload=null;this.rel='stylesheet'">
<link rel="preload" media="only screen and (max-width: 768px)" href="{{URL::asset('public/css/themes/estilo_xweb_1_768px.css')}}" as="style" onload="this.onload=null;this.rel='stylesheet'">
<link rel="preload" media="only screen and (max-width: 576px)" href="{{URL::asset('public/css/themes/estilo_xweb_1_576px.css')}}" as="style" onload="this.onload=null;this.rel='stylesheet'">
<link rel="preload" media="only screen and (max-width: 425px)" href="{{URL::asset('public/css/themes/estilo_xweb_1_425px.css')}}" as="style" onload="this.onload=null;this.rel='stylesheet'">

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
<!--<link href="https://fonts.googleapis.com/css?family=Mada:500,700&display=swap" rel="stylesheet"/>-->
<link rel="preload" href="https://fonts.googleapis.com/css?family=Mada:500,700&display=swap"  as="style" onload="this.onload=null;this.rel='stylesheet'">
<noscript><link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Mada:500,700&display=swap" ></noscript>

<!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.0/css/fontawesome.min.css" integrity="sha512-6b+NpcSPVqcSpZ3NAJgjI2jEsRFbfSxiQparZY8AMtkG/WboCFEq7YyYpH6Eqmvrfm45kYT/iEqE2VC9yeRg9Q==" crossorigin="anonymous" />-->

<link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.0/css/fontawesome.min.css" integrity="sha512-6b+NpcSPVqcSpZ3NAJgjI2jEsRFbfSxiQparZY8AMtkG/WboCFEq7YyYpH6Eqmvrfm45kYT/iEqE2VC9yeRg9Q==" crossorigin="anonymous" as="style" onload="this.onload=null;this.rel='stylesheet'">
<noscript><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.0/css/fontawesome.min.css" integrity="sha512-6b+NpcSPVqcSpZ3NAJgjI2jEsRFbfSxiQparZY8AMtkG/WboCFEq7YyYpH6Eqmvrfm45kYT/iEqE2VC9yeRg9Q==" crossorigin="anonymous"></noscript>

<!-- jQuery 3 -->
<script src="{{URL::asset('public/js/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<!--<script src="{{URL::asset('public/js/jquery-ui.min.js')}}"></script>-->
<!-- Bootstrap -->
<!--<script src="{{URL::asset('public/js/bootstrap.min.js')}}"></script>-->

<!-- Bootstrap tables -->
<!--<script src="{{URL::asset('public/js/bootstrap-table.min.js')}}"></script>-->
<!-- Bootstrap tables -->
<!--<script src="{{URL::asset('public/js/datatables.min.js')}}"></script>-->
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
<script src="{{URL::asset('public/js/lazyload.min.js')}}"></script>
<!--
<script src="{{URL::asset('public/js/es6-promise.min.js')}}"></script>
<script src="{{URL::asset('public/js/es6-promise.auto.min.js')}}"></script>
-->
<script src="{{URL::asset('public/js/axios.min.js')}}"></script>
<!--<script src="{{URL::asset('public/js/ajax.js')}}"></script>-->

@if(session('entorno')->nombrePagina == 'generadoranuncios2')
  <script src="{{URL::asset('public/js/ajax5GeneradorAnuncios.js')}}"></script>
@else
  <script src="{{URL::asset('public/js/ajax5.js')}}"></script>
@endif

<!-- Sliders -->
<!--<script src="{{URL::asset('public/js/flexslider.js')}}"></script>-->
<script src="{{URL::asset('public/js/background.cycle.js')}}"></script>
<script src="{{URL::asset('public/js/remodal.js')}}"></script>

<script src="{{URL::asset('public/js/jquery.ba-cond.min.js')}}"></script>
<script src="{{URL::asset('public/js/jquery.slitslider.js')}}"></script>
<script src="{{URL::asset('public/js/modernizr.custom.79639.js')}}"></script>

<!-- Buscador -->
<script src="{{URL::asset('public/js/jquery.bpopup.min.js')}}"></script>

<!--<script src='https://www.google.com/recaptcha/api.js'></script>-->
<!--<script src="https://kit.fontawesome.com/317a35d664.js" crossorigin="anonymous"></script>-->

<script src="{{URL::asset('public/js/dom-to-image.js')}}"></script>

<script src="{{URL::asset('public/js/jquery.accordion.js')}}"></script>
<script src="{{URL::asset('public/js/FileSaver.js')}}"></script>

<script src="https://cdn.jsdelivr.net/npm/dayjs@1.10.6/dayjs.min.js"></script>

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
        //app.procesosSecundarios();
      @endif
    @endif
  });
  console.log("Software de Gestión Xgest - www.xgestevo.net, xweb7 v.{{Session::get('entorno')->version}}");
</script>

<script type='text/javascript'>
  $(document).ready(function() {

    $(document).ready(function($) {
      $('#mega-menu-login').dcMegaMenu({
        rowItems: '5',
        fullWidth:true,
        speed: 'fast',
        effect: 'slide'
      });    
    });

    $(document).ready(function($) {
      $('#mega-menu-4').dcMegaMenu({
        rowItems: '5',
        fullWidth:true,
        speed: 'fast',
        effect: 'slide'
      });               
    });

    $( "#loginClickable" ).click(function() { 
      $( "#desplegableLogin" ).slideToggle( "fast", function() {
        // Animation complete.
      });
    });

    $('#textobusq').keyup('input',function()
    {
      //Obtenemos el value del input
      var service = $(this).val();  

      setTimeout(function() 
      {
        if($('#textobusq').val() == service)
        {
          //var dataString = 'textobusq='+service;
          var ccodcl = document.getElementById("codigoBusq").value; 
          var tarifa = document.getElementById("tarifaBusq").value; 
          var tipocli = document.getElementById("tipocli").value;
          var conect = document.getElementById("usuario_conectado").value;

          //Le pasamos el valor del input al ajax
          $.ajax({
            type: 'GET',
            url: '/xweb/buscador/' + service,
            beforeSend: function() {
            },
            success: function(response) 
            {
              //Escribimos las sugerencias que nos manda la consulta
              $('#suggestionsBusq').slideDown().html(response);
              $('#suggestionsBusq').css('display', 'inline-grid');
            }
          });
        }
      }, 1500);
    }); 
  });
</script>

<!-- MegaMenu -->
<script src="{{URL::asset('public/js/jquery.dcmegamenu.1.3.3_2.js')}}"></script>
<script src="{{URL::asset('public/js/jquery.hoverIntent.minified.js')}}"></script>

<script type="text/javascript">
  $(document).ready(function() {

    $(".celdaArtFav").hover(
      //on mouseover
      function() {

        if ($(this).hasClass("celdaArtPresu"))
        {
          $(this).stop().animate({
            height: '460px' 
            }, 'fast' //sets animation speed to slow
          );
        }
        else
        {
          $(this).stop().animate({
            height: '425px' 
            }, 'fast' //sets animation speed to slow
          );
        }
        
        $(this).addClass("celdaSombra");
      },
      //on mouseout
      function() {
        if ($(this).hasClass("celdaArtPresu"))
        {
          $(this).stop().animate({
            height: '342px' //changes back to 270px
            }, 'fast' 
          );
        }
        else
        {
          $(this).stop().animate({
            height: '312px' //changes back to 270px
            }, 'fast' 
          );
        }
        
        $(this).removeClass("celdaSombra");
      }
    );

    $(".celdaArtPresu").hover(
      //on mouseover
      function() {
        $(this).stop().animate({
          height: '460px' 
          }, 'fast' //sets animation speed to slow
        );
        $(this).addClass("celdaSombra");
      },
      //on mouseout
      function() {
        $(this).stop().animate({
          height: '342px' //changes back to 270px
          }, 'fast' 
        );
        $(this).removeClass("celdaSombra");
      }
    );

    $(".celdaArtOfe").hover(
      //on mouseover
      function() {
        if ($(this).hasClass("celdaArtPresu"))
        {
          $(this).stop().animate({
            height: '485px' //changes back to 270px
            }, 'fast' 
          );
        }
        else
        {
          $(this).stop().animate({
            height: '470px' //changes back to 270px
            }, 'fast' 
          );
        }

        $(this).addClass("celdaSombra");
      },
      //on mouseout
      function() {
        $(this).stop().animate({
          height: '312px' //changes back to 270px
          }, 'fast' 
        );
        $(this).removeClass("celdaSombra");
      }
    );
  });
</script>
<style>
    /*jssor slider loading skin spin css*/
    .jssorl-009-spin img {
        animation-name: jssorl-009-spin;
        animation-duration: 1.6s;
        animation-iteration-count: infinite;
        animation-timing-function: linear;
    }

    @keyframes jssorl-009-spin {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }

    /*jssor slider bullet skin 032 css*/
    .jssorb032 { position:absolute; }
    .jssorb032 .i { position:absolute; cursor:pointer; }
    .jssorb032 .i .b { fill:#fff; stroke:#000; stroke-width:1200; stroke-miterlimit:10; }
    .jssorb032 .i:hover .b { fill:#000; stroke:#fff; }
    .jssorb032 .iav .b { fill:#000; stroke:#fff; }

    /*jssor slider arrow skin 051 css*/
    .jssora051 { display:block; position:absolute; cursor:pointer; }
    .jssora051 .a { fill:none; stroke:#fff; stroke-width:360; stroke-miterlimit:10; }
    .jssora051.jssora051ds { pointer-events:none; }
</style>

<script type='text/javascript'>
  document.oncontextmenu = function()
  {
    //return false;
  }
</script>