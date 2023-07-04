<!DOCTYPE html>
<html lang="es-es">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>@yield("titulo")</title>
  @include('base_includes')
</head>

<body class="hold-transition {{session('entorno')->config->x_skin}} sidebar-mini">
  
  

  



<?php
$quierounapaginadeinicio=true;
$quierounapaginadeinicio=false;
if(session("usuario")->uData->codigo==0 && $quierounapaginadeinicio){
?>
<style>
body {
  padding-top: 250px;
  /*The below background is just to add some color, you can set this to anything*/
  background-color:#31708f;
}
.login-form{width:390px;}
.login-title{font-family: 'Exo', sans-serif;text-align:center;color: white;}
.login-userinput{margin-bottom: 10px;}
.login-button{margin-top:10px;}
.login-options{margin-bottom:0px;}
.login-forgot{float: right;}
</style>
<div class="container login-form" name="appx" id="appx">
  <h2 class="login-title">Inicio de sesión</h2>
  <div class="panel panel-default">
    <div class="panel-body">
      <form action="{{URL::to('')}}" @submit.prevent="app.iniciosesion('{{URL::to('iniciosesion')}}')" method="post" id="iniciosesion" name="iniciosesion">
        <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
        
        <div class="input-group login-userinput">
          <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
          <input v-model="usuario" id="usuario" name="usuario" type="text" class="form-control" name="username" placeholder="Usuario">
        </div>
        <div class="input-group">
          <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
          <input v-model="password" id="password" name="password" type="password" class="form-control" placeholder="Clave">
        </div>
        
        <button class="btn btn-primary btn-block login-button" type="submit"><i class="fa fa-sign-in"></i> Entrar</button>
        <div class="login-options">
          <a v-on:click.prevent="recordarclave('{{URL::to('/')}}')" href="#" class="login-forgot">Recuperar contraseña</a>
        </div>
      </form>     
    </div>
  </div>
</div>
<script src="{{URL::asset('public/js/xgestvue.js?random=x'.Session::get('entorno')->version)}}"></script>
<div id="politica_cookies"></div>
<?php
  echo "</body></html>";return;
}
?>
 
  
  
  <div class="wrapper" name="appx" id="appx" style="position: static;">
    <div id="cabecera_web">
      @include('base_header')
    </div>
    @if(session('entorno')->nombrePagina == 'categoria')
      <div id="cabecera_movil" class="categoriaCabMovil">
        @include('base_header_movil')
      </div>
    @elseif(session('entorno')->nombrePagina == 'ofertas')
      <div id="cabecera_movil" class="categoriaCabMovil">
        @include('base_header_movil')
      </div>
    @else
      <div id="cabecera_movil" class="cabMovil">
        @include('base_header_movil')
      </div>
    @endif
    <!--encabezado con logotipo / datos usuario -->
    @include('base_menu')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- posicionamiento -->
      <section class="content-header">
        @yield("localizador")
      </section>

      <?php
        $esFstv = session("entorno") -> esFstv;

        if ($esFstv)
        {
          ?>

            <? if (!isset($_COOKIE['aviso_festivo'])): ?>

                <!-- aquí estaría el contenido que se espera mostrar ocasionalmente -->
                <script type="text/javascript">
                  alertify.alert('', 'Hoy nuestras oficinas permanecen cerradas por festividad nacional en España');
                </script>

                <?
                setcookie('aviso_festivo', true,  time() +86400); // 1 día equivale a 86400 segundos
                
                ?>

            <? endif; ?>

          <?php
        }
      ?>

      <!-- Main content -->
      @if(session('entorno')->nombrePagina == 'consulta')
      <section class="content" style="background-color: #f3f3f3;">
      @else
      <section class="content">
      @endif
        @yield("dashboard")
        @include("base_central")
      </section>
    </div>
    <!-- IMAGEN SPLASH -->
    <!-- SPLASH EN HTML -->
    @include('base_footer')
  </div>
  <!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
  <!-- ./wrapper -->
</body>

</html>