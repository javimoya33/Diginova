<a href="#" class="scrollup" title="Up"></a>

<!-- IMAGEN SPLASH -->
<!-- SPLASH EN HTML -->
@include('splash')
<input type="hidden" id="usuario_conectado" value="{{session('usuario')->uData->cnom}}">
<div id="notificacionesGenerales" class='alert'>notificacionesGenerales</div>

<div class="digiHeaderFila1" style="padding: 10px 0px 10px;">
  <div class="div_main_header">
    <div class="digiHeaderCell dHF1_2">
      <div class="tHofe1" style="padding: 0 8px;">
        @if (session("usuario")->margenesActivo == 0)
          <a href="{{URL::to('')}}">
            <img alt="Diginova" src="{{URL::asset('public/images/diginovalogoblanco.png')}}" width="163" height="28" />
          </a>
        @else
          @if (session("usuario")->logotipo == "")
            <a href="{{URL::to('')}}">
              <img alt="Diginova" src="{{URL::asset('public/images/diginovalogoblanco.png')}}" width="163" height="28" />
            </a>
          @else
            <?php
            $logotipo = session('usuario')->logotipo;
            ?>
            <a href="{{URL::to('')}}">
              <img alt="{{session('usuario')->nombreTienda}}" src="{{URL::asset('public/images/logos/'.$logotipo)}}" style="width: auto; height: auto; max-width: 200px; max-height: 53px;" />
            </a>
          @endif
        @endif
      </div>
    </div>
    <div class="dH1Cell dH1C3">
      <div class="digiHeaderCell dHF1_2 flex-center">
        <div class="tHofe1 flex-center" style="margin-top: 1px; margin-right: 10px;">
          @if(session('usuario')->uData->codigo > 0)
            @if (session("usuario")->margenPC == 0 && session("usuario")->margenPortatil == 0 && session("usuario")->margenMonitor == 0)
              @if (session("usuario")->nuevoModoPVP == 1)
                @if (session('entorno')->nombrePagina == 'index')
                  <a alt="Configura tu modo PVP" onclick="mostrarAccesoPVP()" class="a_header_pvp title_pvp">PVP</a>
                @else
                  <a alt="Configura tu modo PVP" onclick="mostrarAccesoPVP()" class="title_pvp" style="color: #28a745;">PVP</a>
                @endif
              @else
                <a alt="Configura tu modo PVP" onclick="mostrarAccesoPVP()" class="title_pvp" style="width: 45px;">PVP</a>
              @endif
            @else
              @if (session('usuario')->margenesActivo == 0)
                @if (session("usuario")->nuevoModoPVP == 1)
                  @if (session('entorno')->nombrePagina == 'index')
                    <a alt="Configura tu modo PVP" onclick="mostrarAccesoPVP()" class="a_header_pvp title_pvp">PVP</a>
                  @else
                    <a alt="Configura tu modo PVP" onclick="mostrarAccesoPVP()" class="title_pvp" style="color: #28a745;">PVP</a>
                  @endif
                @else
                  <a alt="Activa tu modo PVP" onclick="ajaxActivarModoPVP({{session('usuario')->uData->codigo}}, 1, true)" class="title_pvp">PVP</a>
                @endif
              @else
                <a alt="Desactiva tu modo PVP" onclick="ajaxActivarModoPVP({{session('usuario')->uData->codigo}}, 0, true)" class="title_pvp">
                  PVD 
                </a>
              @endif
              <a href="/xweb/modopvp" style="margin-left: 6px">
                <img src="/xweb/public/images/tools_pvp.png" alt="Configura tu modo PVP" class="tools_pvp">
              </a>
            @endif
          @endif
        </div>
        <div class="tHofe1" style="padding: 0px;">
          <a onclick="pulsarBtnLoginMovil({{session('usuario')->uData->codigo}})">
            @if(session('usuario')->uData->codigo > 0)
              <img id="login_menu_movil" alt="Login" title="Login" width="18" height="auto" src="/xweb/public/images/circle.png" style="display: none;">
              <div class="user_menu_movil">
                <div>{{mb_substr(session('usuario')->uData->cnom, 0, 1)}}</div>
              </div>
            @else
              <img id="login_menu_movil" alt="Login" title="Login" width="18" height="auto" src="/xweb/public/images/login.png">
            @endif
          </a>
        </div>
      </div>
      @if(session('usuario')->uData->codigo > 0)
        <div class="divLoading" style="visibility: hidden; display: none;">
          <img src="/xweb/public/images/loading2.gif" class="imgLoading" style="width: 30px;">
        </div>
        <div id="cestaAjaxMv" class="dH1LinkCell dH1LinkCell2 <?php echo (session("usuario")->margenesActivo) ? 'dH1LinkCell2Presu' : ''; ?>">
          <div class="dHIco">
            <span id="counterCestaMv" class="cabCestaNum">{{session('usuario')->uData->numArticulosCesta}}</span>
            <a href="{{URL::to('cesta')}}">
              <img alt="Cesta" src="/xweb/public/images/iconcesta2.png" width="17" height="22" />
            </a>
          </div>
          @if (session("usuario")->margenesActivo)
            <div class="dH1Link dH1LinkPresu">
              <a class="hMicesta" href="{{URL::to('presupuesto')}}" style="font-family: 'montserratsemibold';">Mi presup.</a>
              <br/>
              <span class="cabCestaTotal">
                <a id="importeCestaMv" href="{{URL::to('presupuesto')}}">{{Utils::numFormat(session('usuario')->uData->importeCesta)}}€</a>
              </span>
            </div>
          @else
            <div class="dH1Link">
              <a class="hMicesta" href="{{URL::to('cesta')}}" style="font-family: 'montserratsemibold';">Mi cesta</a>
              <br/>
              <span class="cabCestaTotal">
                <a id="importeCestaMv" href="{{URL::to('cesta')}}">{{Utils::numFormat(session('usuario')->uData->importeCesta)}}€</a>
              </span>
            </div>
          @endif
        </div>
      @endif
    </div>


    <!--<div class="headSepV"></div>
    <div class="digiHeaderCell dHF1_4" style="padding-right: 14px; text-align: right;">
      <a href="/xweb/devoluciones">Trámites RMA</a>
    </div>-->
  </div>
</div>

<div style="display: grid">
  <div class="dH1Cell dH1C2">
    <div class="digiHeaderCell dHF1_outOf dHF1_oferta" style="display: block; width: 42%; padding-right: 3px;">
      <div style="display: flex; justify-content: space-between; padding: 0;">
        <a onclick="pulsarBtnMenuMovil({{session('usuario')->uData->codigo}}, this)">
          <img id="img_menu_movil" alt="Menú" title="Menú" width="20" height="20" src="/xweb/public/images/menu.png">
        </a>
        <div style="display: table; padding-top: 2px;">
          <span class="menuCatNomC2">
            <a class="aMenuCatNomC2" onclick="pulsarBtnMenuMovil({{session('usuario')->uData->codigo}}, this)">Categorias</a>
          </span>
        </div>
        <div class="divNextMenu" onclick="pulsarBtnMenuMovil({{session('usuario')->uData->codigo}}, this)" style="float: right; margin-top: 2px;">
            <img alt="Categorias" src="/xweb/public/images/next.png" class="imgNextMenu" />
        </div>
      </div>
    </div>
    <table border="0" align="center" style="border-spacing: 0px; width: 55%; margin-right: 0px;">
      <tr>
        <td>
          <div id="buscador" style="display: inline-block; width: 822px; padding-bottom: 11px;">
            <input type="hidden" name="codigoBusq" id="codigoBusq" value="{{session('usuario')->uData->codigo}}">
            @if(session('usuario')->uData->codigo > 0)
              <input type="hidden" name="tarifaBusq" id="tarifaBusq" value="{{session('usuario')->uData->ctari}}">
            @else
              <input type="hidden" name="tarifaBusq" id="tarifaBusq" value="0">
            @endif
            <input type="hidden" name="tipocli" id="tipocli" value="{{session('usuario')->uData->ctipocli}}">
            <input type="text" name="secc" id="textobusqMovil" placeholder="Buscar..." autocomplete="off">
            <div id="suggestionsBusqMv"></div>
            <input type="hidden" name="page" id="page" value="busqueda">
          </div>
        </td>
      </tr>
    </table>
  </div>

  <div class="dH1Cell dH1C2" style="background-color: white; justify-content: center;">
    <div style="text-align: center; color: #333;">Mayorista en informática de ocasión</div>
  </div>
</div>


@php
$contCategorias = 0;
@endphp
<div id="div_cabecera_menu" class="div_cabecera_menu" style="display: none">
  <div class="miCTab">
    <div class="menuCatNomC" style="width: 18px;">
      <img alt="Devoluciones y Garantías" src="/xweb/public/images/devolucion.png" style="height: 24px; max-width: 24px; max-height: 24px;" />
    </div>
    <div class="miCCel2" style="width: 155px; font-size: 12pt;">
      <a href="/xweb/preguntasfrecuentes" style="font-size: 11pt;">Devoluciones y Garantías</a>
    </div>
  </div>
  @foreach(session('entorno')->arrCategoriasMenu as $arrCategoriaMenu)
    <li class="dc-mega-li" style="width: 100%; list-style: none; padding: 8px 0px;">
      <div style="display: table; width: 100%;">
          @if (($arrCategoriaMenu->descr == 'Ordenadores') || ($arrCategoriaMenu->descr == 'Portátiles') || ($arrCategoriaMenu->descr == 'Monitores') || ($arrCategoriaMenu->descr == 'Apple'))
          <div class="menuCatNomC">
            <img alt="{{$arrCategoriaMenu->descr}}" src="/xweb/public/images/cat{{$arrCategoriaMenu->descr}}.png" />
          </div>
        @else
          <div class="menuCatNomC"></div>
        @endif
        <span class="menuCatNomC2">
          @if ($contCategorias == 0 || $contCategorias == 1 || $contCategorias == 2 || $contCategorias == 3)
            <a class="aMenuCatNomC2"  href="/xweb/categoria/{{$arrCategoriaMenu->id}}">
              {{$arrCategoriaMenu->descr}}
            </a>
          @elseif ($contCategorias == 5)
            <a class="aMenuCatNomC2" href="/xweb/ofertas" style="padding-top: 10px; line-height: 16px;">
              {{$arrCategoriaMenu->descr}}
            </a>
          @else
            <a class="aMenuCatNomC2" href="/xweb/categoria/{{$arrCategoriaMenu->id}}">
              {{$arrCategoriaMenu->descr}}
            </a>
          @endif
        </span>
        <div class="divNextMenu" onclick="desplegarSubCategorias({{$arrCategoriaMenu->id}}, this)" style="float: right">
          @if ($arrCategoriaMenu->id != 1166)
            <img alt="{{$arrCategoriaMenu->descr}}" src="/xweb/public/images/next.png" class="imgNextSubMenu" />
          @endif
        </div>
      </div> 
      <ul id="ul_menu_{{$arrCategoriaMenu->id}}" class="ulMenuSubCategoriaMv" style="display: none">
        @if ($arrCategoriaMenu->id == 1160)
          <li class="liMenuSubCategoriaMv">
            <a class="menuGrupoLink" href="/xweb/familia/4">iMac</a>
          </li>
          <li class="liMenuSubCategoriaMv">
            <a class="menuGrupoLink" href="/xweb/familia/710">MacBook</a>
          </li>
          <li class="liMenuSubCategoriaMv">
            <a class="menuGrupoLink" href="/xweb/familia/711">iPad</a>
          </li>
        @else
          @foreach(session('entorno')->arrSubCategorias as $arrSubCategorias)
            @if ($arrCategoriaMenu->id == $arrSubCategorias->parent)
              <li class="liMenuSubCategoriaMv">
                <a class="menuGrupoLink" href="/xweb/categoria/{{$arrCategoriaMenu->id}}/{{$arrSubCategorias->GCOD}}">
                  {{$arrSubCategorias->GDES}}
                </a>
              </li>
            @endif
          @endforeach
        @endif
      </ul>
    </li>
    @php
    $contCategorias += 1;
    @endphp
  @endforeach
  <li class="dc-mega-li" style="width: 100%; list-style: none; padding: 8px 0px;">
    <div style="display: table; width: 100%;">
      <div class="menuCatNomC"></div>
      <span class="menuCatNomC2">
        <a class="aMenuCatNomC2"  href="/xweb/favoritos">
          Favoritos
        </a>
      </span>
    </div>
  </li>
</div>

<div id="div_cabecera_login" class="div_cabecera_menu div_cabecera_login" style="display: none; right: 0px;">
  @if(session('usuario')->uData->codigo > 0)
    <div class="micuentaContenido" id="despLog2">
      <div class="miCTitu">Mi perfil</div>
      <div class="miCTab">
        <div class="miCCel1">
          <img alt="Documentos" src="/xweb/public/images/micuenta0_mv.png">
        </div>
        <div class="miCCel2">
          <a style="color: black;" href="{{URL::to('micuenta')}}">{{T::tr('Área de cliente')}}</a>
        </div>
      </div>

      <!--<div class="miCTab" style="">
        <div class="miCCel1">
          <img alt="Documentos" src="/xweb/public/images/micuenta0_mv.png">
        </div>
        <div class="miCCel2">
          <a style="color: black;" href="{{URL::to('herramientascomerciales')}}">{{T::tr('Herramientas comerciales')}}</a>
        </div>
      </div>-->

      <div class="miCTab">
        <div class="miCCel1">
          <img alt="Envíos" src="/xweb/public/images/micuenta5_mv.png">
        </div>
        <div class="miCCel2">
          <form name="sesionon" action="index.php" method="post">
            <a href="{{URL::to('cerrarsesion')}}" class="spancerrar">{{T::tr('Cerrar sesión')}}</a>
          </form>
        </div>
      </div>
    </div>
  @else
    <div class="loginContenido hidden_div3" id="desplegableLogin">
      <div class="logTitu">Iniciar sesión</div>
      <div class="logFormu">
        <form action="{{URL::to('')}}" @submit.prevent="app.iniciosesion('{{URL::to('iniciosesion')}}')" method="post" id="iniciosesion" name="iniciosesion">
          <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
          <input v-model="usuario" id="usuario" name="usuario" type="text" placeholder="usuario" class="form-control input-sm" />
          <input v-model="password" id="password" name="password" type="password" placeholder="password" class="form-control input-sm" />
          <a v-on:click.prevent="recordarclave('{{URL::to('/')}}')" href="#" class="logRecu">Recuperar contraseña</a>
          <input type="submit" name="logsubmit" value="{{T::tr('Entrar')}}" />
          <a class="logRegistro" href="{{URL::to('registro')}}">Registro</a>
        </form>
      </div>
    </div>
  @endif
</div> 

@if(session('entorno')->nombrePagina == 'categoria')
  <div class="digiHeader cabr3" id="idDigiHeader" <?php if(session('usuario')->uData->codigo == 0) { ?> style="height: 277px" <?php } ?>>
@elseif(session('entorno')->nombrePagina == 'familia')
  <div class="digiHeader cabr3" id="idDigiHeader">
@elseif(session('entorno')->nombrePagina == 'ofertas')
  <div class="digiHeader cabr3" id="idDigiHeader">
@elseif(session('entorno')->nombrePagina == 'articulo')
  <div class="digiHeader cabr4" id="idDigiHeader">
@elseif(session('entorno')->nombrePagina == 'articulo2')
  <div class="digiHeader cabr4" id="idDigiHeader">
@elseif(session('entorno')->nombrePagina == 'cesta')
  <div class="digiHeader cabr4" id="idDigiHeader">
@elseif(session('entorno')->nombrePagina == 'cesta2')
  <div class="digiHeader cabr4" id="idDigiHeader">
@elseif(session('entorno')->nombrePagina == 'documentos')
  <div class="digiHeader cabr4" id="idDigiHeader">
@elseif(session('entorno')->nombrePagina == 'condiciones')
  <div class="digiHeader cabr4" id="idDigiHeader">
@elseif(session('entorno')->nombrePagina == 'polenvio')
  <div class="digiHeader cabazul" id="idDigiHeader">
@elseif(session('entorno')->nombrePagina == 'avisolegal')
  <div class="digiHeader cabazul" id="idDigiHeader">
@elseif(session('entorno')->nombrePagina == 'calendario')
  <div class="digiHeader cabazul" id="idDigiHeader">
@elseif(session('entorno')->nombrePagina == 'formaspago')
  <div class="digiHeader cabazul" id="idDigiHeader">
@elseif(session('entorno')->nombrePagina == 'preguntasfrecuentes')
  <div class="digiHeader cabazul" id="idDigiHeader">
@elseif(session('entorno')->nombrePagina == 'devolucionesmensajes')
  <div class="digiHeader cabazul" id="idDigiHeader">
@elseif(session('entorno')->nombrePagina == 'devolucionmensaje')
  <div class="digiHeader cabazul" id="idDigiHeader">
@elseif(session('entorno')->nombrePagina == 'familia')
  <div class="digiHeader cabr2" id="idDigiHeader">
@elseif(session('entorno')->nombrePagina == 'devoluciones')
  <div class="digiHeader cabazul" id="idDigiHeader">
@elseif(session('entorno')->nombrePagina == 'devolucion')
  <div class="digiHeader cabazul" id="idDigiHeader">
@elseif(session('entorno')->nombrePagina == 'devolucion2')
  <div class="digiHeader cabazul" id="idDigiHeader">
@elseif(session('entorno')->nombrePagina == 'devolucionrma')
  <div class="digiHeader cabazul" id="idDigiHeader">
@elseif(session('entorno')->nombrePagina == 'devolucionguardar')
  <div class="digiHeader cabazul" id="idDigiHeader">
@elseif(session('entorno')->nombrePagina == 'devolucionfin')
  <div class="digiHeader cabazul" id="idDigiHeader">
@elseif(session('entorno')->nombrePagina == 'recogida')
  <div class="digiHeader cabazul" id="idDigiHeader">
@elseif(session('entorno')->nombrePagina == 'devolucionnofunciona')
  <div class="digiHeader cabazul" id="idDigiHeader">
@elseif(session('entorno')->nombrePagina == 'devolucionnovendido')
  <div class="digiHeader cabazul" id="idDigiHeader"> 
@elseif(session('entorno')->nombrePagina == 'anadirparte')
  <div class="digiHeader cabazul" id="idDigiHeader">     
@elseif(session('entorno')->nombrePagina == 'consultas')
  <div class="digiHeader cabazul" id="idDigiHeader">
@elseif(session('entorno')->nombrePagina == 'consulta')
  <div class="digiHeader cabazul" id="idDigiHeader">
@elseif(session('entorno')->nombrePagina == 'generadoranuncios')
  <div class="digiHeader cabazul" id="idDigiHeader">
@elseif(session('entorno')->nombrePagina == 'generadorcarteltecno')
  <div class="digiHeader cabazul" id="idDigiHeader">
@elseif(session('entorno')->nombrePagina == 'favoritos')
  <div class="digiHeader cabr3" id="idDigiHeader">
@elseif(session('entorno')->nombrePagina == 'misdocumentos')
  <div class="digiHeader cabazul" id="idDigiHeader">
@elseif(session('entorno')->nombrePagina == 'recibos')
  <div class="digiHeader cabazul" id="idDigiHeader">
@elseif(session('entorno')->nombrePagina == 'cobros')
  <div class="digiHeader cabazul" id="idDigiHeader">
@elseif(session('entorno')->nombrePagina == 'albaranes')
  <div class="digiHeader cabazul" id="idDigiHeader">
@elseif(session('entorno')->nombrePagina == 'drivers')
  <div class="digiHeader cabazul" id="idDigiHeader">
@elseif(session('entorno')->nombrePagina == 'micuenta')
  <div class="digiHeader cabazul" id="idDigiHeader">
@elseif(session('entorno')->nombrePagina == 'herramientascomerciales')
  <div class="digiHeader cabazul" id="idDigiHeader">
@elseif(session('entorno')->nombrePagina == 'generarcsv')
  <div class="digiHeader cabazul" id="idDigiHeader">
@elseif(session('entorno')->nombrePagina == 'nosotros')
  <div class="digiHeader cabazul" id="idDigiHeader">
@elseif(session('entorno')->nombrePagina == 'driver')
  <div class="digiHeader cabazul" id="idDigiHeader">
@elseif(session('entorno')->nombrePagina == 'registro')
  <div class="digiHeader cabazul" id="idDigiHeader">
@elseif(session('entorno')->nombrePagina == 'cambiarclave')
  <div class="digiHeader cabazul" id="idDigiHeader">
@elseif(session('entorno')->nombrePagina == 'mensajes')
  <div class="digiHeader cabazul" id="idDigiHeader">
@elseif(session('entorno')->nombrePagina == 'activarCuenta')
  <div class="digiHeader cabazul" id="idDigiHeader">
@elseif(session('entorno')->nombrePagina == 'tpvvirtual')
  <div class="digiHeader cabr2" id="idDigiHeader">
@elseif(session('entorno')->nombrePagina == 'tpvvirtualcorrecto')
  <div class="digiHeader cabr2" id="idDigiHeader">
@elseif(session('entorno')->nombrePagina == 'proformajustificante')
  <div class="digiHeader cabr2" id="idDigiHeader">
@elseif(session('entorno')->nombrePagina == 'proformajustificanteej')
  <div class="digiHeader cabr2" id="idDigiHeader">
@else
  <div class="digiHeader" id="idDigiHeader" style="position: absolute">
@endif
  <div class="digiHead1">
    <div class="dH1Cell dH1C1">
      @if (session("usuario")->margenesActivo == 0)
        <a href="{{URL::to('')}}">
          <img alt="Diginova" src="{{URL::asset('public/images/diginovalogoblanco.png')}}" width="163" height="28" />
        </a>
      @else
        @if (session("usuario")->logotipo == "")
          <a href="{{URL::to('')}}">
            <img alt="Diginova" src="{{URL::asset('public/images/diginovalogoblanco.png')}}" width="163" height="28" />
          </a>
        @else
          <?php
          $logotipo = session('usuario')->logotipo;
          ?>
          <a href="{{URL::to('')}}">
            <img alt="{{session('usuario')->nombreTienda}}" src="{{URL::asset('public/images/logos/'.$logotipo)}}" style="width: auto; height: auto; max-width: 200px; max-height: 53px;" />
          </a>
        @endif
      @endif
    </div>
    @if(session('usuario')->uData->codigo > 0)
      <div class="dH1Cell dH1C3">
        <div class="divLoading" style="visibility: hidden;">
          <img src="/xweb/public/images/loading2.gif" class="imgLoading" style="width: 30px;">
        </div>
        <div id="cestaAjaxMv" class="dH1LinkCell dH1LinkCell2">
          <div class="dHIco">
            <span id="counterCestaMv" class="cabCestaNum">{{session('usuario')->uData->numArticulosCesta}}</span>
            <a href="{{URL::to('cesta')}}">
              <img alt="Cesta" src="/xweb/public/images/iconcesta2.png" width="29" height="36" />
            </a>
          </div>
          @if (session("usuario")->margenesActivo)
            <div class="dH1Link">
              <a class="hMicesta" href="{{URL::to('presupuesto')}}" style="font-family: 'montserratsemibold';">Mi presup.</a>
              <br/>
              <span class="cabCestaTotal">
                <a id="importeCestaMv" href="{{URL::to('presupuesto')}}">{{Utils::numFormat(session('usuario')->uData->importeCesta)}}€</a>
              </span>
            </div>
          @else
            <div class="dH1Link">
              <a class="hMicesta" href="{{URL::to('cesta')}}" style="font-family: 'montserratsemibold';">Mi cesta</a>
              <br/>
              <span class="cabCestaTotal">
                <a id="importeCestaMv" href="{{URL::to('cesta')}}">{{Utils::numFormat(session('usuario')->uData->importeCesta)}}€</a>
              </span>
            </div>
          @endif
        </div>
      </div>
    @endif
  </div>
  <div class="digiHead2">
    <div class="dH2Cell dH2Menu">
      <div class="menu-container clearfix" style="display: block">
        <button class="nav_menu_toggler_icon">
          <span class="fa fa-bars"></span>
        </button>
        <nav class="manu clearfix" style="width: 1306px;">
          <ul id="mega-menu-4" class="mega-menu full-width">
            @php
            $contCategorias = 0;
            @endphp
            @foreach(session('entorno')->arrCategoriasMenu as $arrCategoriaMenu)
              <li class="dc-mega-li" style="width: {{session('entorno')->arrAnchoCategorias[$contCategorias]}}px;">
                @if (($arrCategoriaMenu->descr == 'Ordenadores') || ($arrCategoriaMenu->descr == 'Portátiles') || ($arrCategoriaMenu->descr == 'Monitores') || ($arrCategoriaMenu->descr == 'Apple'))
                  <span class="menuCatNomC">
                    <img alt="{{$arrCategoriaMenu->descr}}" src="/xweb/public/images/cat{{$arrCategoriaMenu->descr}}.png" />
                  </span>
                @endif
                <span class="menuCatNomC2">
                  @if ($contCategorias == 0 || $contCategorias == 1 || $contCategorias == 2 || $contCategorias == 3)
                    <a class="aMenuCatNomC2"  href="/xweb/categoria/{{$arrCategoriaMenu->id}}" style="font-family: montserratextrabold;">
                      {{$arrCategoriaMenu->descr}}
                    </a>
                  @elseif ($contCategorias == 5)
                    <a class="aMenuCatNomC2" href="/xweb/ofertas" style="padding-top: 10px; line-height: 16px;">
                      {{$arrCategoriaMenu->descr}}
                    </a>
                  @else
                    <a class="aMenuCatNomC2" href="/xweb/categoria/{{$arrCategoriaMenu->id}}">
                      {{$arrCategoriaMenu->descr}}
                    </a>
                  @endif
                </span>
                <div class="sub-container mega" style="width: 2500px; left: 0px; z-index: 1000;">
                  <ul class="ulMenu have_dropdown sub" style="display: none;">
                    <div class="digiCategoria" <?php if ($arrCategoriaMenu->id == 1166) { ?> style="display: flex; justify-content: space-around;" <?php } ?>>
                      <div class="menuGrupos2" <?php if ($arrCategoriaMenu->id == 1118) { ?> style="margin-left: 105px;" <?php } ?>>
                        @if ($arrCategoriaMenu->id == 1125)
                          <div class="menuGrupoPC">
                            <a href="/xweb/categoria/1160">
                              <img title="Apple" alt="Apple" src="{{URL::asset('public/images/apple.png')}}"  width="24" height="30" />
                            </a>
                            <br/>
                            <a href="/xweb/categoria/1125/79">
                              <img title="HP" alt="HP" src="{{URL::asset('public/images/hp.png')}}"  width="30" height="30" />
                            </a>
                            <br/>
                            <a href="/xweb/categoria/1125/83">
                              <img title="Lenovo" alt="Lenovo" src="{{URL::asset('public/images/lenovo.png')}}"  width="75" height="26" />
                            </a>
                            <br/>
                            <a href="/xweb/categoria/1125/82">
                              <img title="Dell" alt="Dell" src="{{URL::asset('public/images/dell.png')}}" width="33" height="33" />
                            </a>
                          </div>
                          <div class="menuGrupoPC">
                            <div class="menuGrupoFot">
                              <a href="/xweb/categoria/1125/103">
                                <img width="80" height="80" alt="Todo en uno" src="{{URL::asset('public/images/todoenuno.webp')}}"  />
                              </a>
                            </div>

                            <div class="menuGrupoDes">
                              <a class="menuGrupoLink" href="/xweb/categoria/1125/103">Todo en uno</a>
                            </div>
                          </div>
                        @elseif ($arrCategoriaMenu->id == 1126)
                          <div class="menuColFil" style="display: table-cell;">
                            <div class="menuBoxFiltro">
                              <a href="/xweb/categoria/1126/128">
                                <img alt="Ultrabooks" src="{{URL::asset('public/images/ultrabooks_portatiles_diginova-05.webp')}}" onclick="window.location='/categoria/1126/128'"  width="111" height="111" /><br/>
                                Ultrabooks
                              </a>
                            </div>
                            <div class="menuBoxFiltro">
                              <a href="/xweb/categoria/1126/130">
                                <img alt="Portátiles premium" src="{{URL::asset('public/images/premium_portatiles_diginova-04.webp')}}"  onclick="window.location='/categoria/1126/130'" width="111" height="111" /><br/>
                                Portátiles premium
                              </a>
                            </div>
                          </div>
                          <div class="menuColFil" style="display: table-cell; border-right: 1px solid gray;">
                            <div class="menuBoxFiltro">
                              <a href="/xweb/categoria/1126/131">
                                <img alt="Portátiles táctiles" src="{{URL::asset('public/images/portatilestactiles_portatiles_diginova-06.webp')}}" onclick="window.location='/categoria/1126/131'" width="111" height="111"  /><br/>
                                Portátiles táctiles
                              </a>
                            </div>
                          </div>
                          <div class="menuGruposPortatiles">
                        @endif
                        <?php
                        $catMonitorEntrado = false;
                        ?>
                        @foreach(session('entorno')->arrSubCategorias as $arrSubCategorias)
                          @if ($arrCategoriaMenu->id == $arrSubCategorias->parent)
                            @php
                            $image = strtolower($arrSubCategorias->GDES);
                            $image = str_replace(" ", "", $image);
                            @endphp
                            <!-- Ordenadores -->
                            @if ($arrCategoriaMenu->id == 1125)
                              <div class="menuGrupoPC">
                                <div class="menuGrupoFot">
                                  <a href="/xweb/categoria/{{$arrCategoriaMenu->id}}/{{$arrSubCategorias->GCOD}}">
                                    <img width="80" height="80" alt="{{$arrSubCategorias->GDES}}" title="{{$arrSubCategorias->GDES}}" src="/xweb/public/images/{{$image}}.webp"/>
                                    </br>
                                  </a>
                                </div>
                                <div class="menuGrupoDes">
                                  <a class="menuGrupoLink" href="/xweb/categoria/{{$arrCategoriaMenu->id}}/{{$arrSubCategorias->GCOD}}">
                                    {{$arrSubCategorias->GDES}}
                                  </a>
                                </div>
                                <ul class="menuGrupoUl">
                                @foreach(session('entorno')->arrSubSubCategorias as $arrSubSubCategorias)
                                  @if ($arrSubCategorias->GCOD == $arrSubSubCategorias->FGRUPO)
                                    <li class="menuGrupoLi menuGrupoLiPC">
                                      <a class="menuGrupoLiLink" href="/xweb/categoria/{{$arrCategoriaMenu->id}}/{{$arrSubCategorias->GCOD}}/{{$arrSubSubCategorias->FCOD}}" 
                                        <?php if ($arrSubCategorias->GCOD == 100) { ?> style="padding-left: 51px" <?php } ?>>
                                        {{$arrSubSubCategorias->FDES}}
                                      </a>
                                    </li>
                                  @endif
                                @endforeach
                                </ul>
                              </div>
                            <!-- Portátiles -->
                            @elseif ($arrCategoriaMenu->id == 1126)
                              <?php
                              $grupocodigo = str_pad(strtolower($arrSubCategorias->GCOD), 6, "0", STR_PAD_LEFT);
                              //$urlfoto = "https://diginova.es/xweb3/fotoartic/grf_".strtolower($grupocodigo)."_1.jpg";
                              $urlfoto = "/xweb/public/articulos/grf".strtolower($grupocodigo).".webp";
                              ?>
                              <div class="menuGrupoPortatil">
                                <div class="menuGrupoFotPortatiles">
                                  <a href="/xweb/categoria/{{$arrCategoriaMenu->id}}/{{$arrSubCategorias->GCOD}}">
                                    <img src="<?php echo $urlfoto ?>" width="80" height="80" border="0" alt="{{$arrSubCategorias->GDES}}" title="{{$arrSubCategorias->GDES}}" />
                                  </a>
                                </div>
                                <div class="menuGrupoDes">
                                  <a href="/xweb/categoria/{{$arrCategoriaMenu->id}}/{{$arrSubCategorias->GCOD}}" class="menuGrupoLink">
                                    {{$arrSubCategorias->GDES}}
                                  </a>
                                </div>
                                <ul class="menuGrupoUl">
                                @foreach(session('entorno')->arrSubSubCategorias as $arrSubSubCategorias)
                                  @if ($arrSubCategorias->GCOD == $arrSubSubCategorias->FGRUPO)
                                    <li class="menuGrupoLi menuGrupoLiPC">
                                      <a class="menuGrupoLiLink" href="/xweb/categoria/{{$arrCategoriaMenu->id}}/{{$arrSubSubCategorias->GCOD}}/{{$arrSubSubCategorias->FCOD}}">{{$arrSubSubCategorias->FDES}}</a>
                                    </li>
                                  @endif
                                @endforeach
                                </ul>
                              </div>
                            <!-- Monitores -->
                            @elseif ($arrCategoriaMenu->id == 1118)
                              @if (!$catMonitorEntrado)
                                <?php
                                $catMonitorEntrado = true; 
                                ?>
                                <div class="menuGrupoMon">
                                  <div class="menuGrupoFotMon">
                                    <a href="/xweb/categoria/1118/58">
                                      <img width="59" height="59" src="/xweb/public/images/mon301.webp" border="0" alt="Monitores 19''" title="Monitores 19''">
                                    </a>
                                  </div>
                                  <ul class="menuGrupoUl">
                                    <li class="menuGrupoLi menuGrupoLiMonitores">
                                      <a class="menuGrupoLiLink menuGrupoLiLinkMon" href="/xweb/categoria/1118/89/58">
                                          <img style="max-width: 95px;" src="/xweb/public/images/hp.png" width="30" height="30"  /> 
                                      </a>
                                    </li>
                                    <li class="menuGrupoLi menuGrupoLiMonitores">
                                      <a class="menuGrupoLiLink menuGrupoLiLinkMon" href="/xweb/categoria/1118/58">
                                          Otras marcas
                                      </a>
                                    </li>
                                  </ul>
                                </div>

                                <div class="menuGrupoMon">
                                  <div class="menuGrupoFotMon">
                                    <a href="/xweb/categoria/1118/61">
                                      <img width="59" height="59" src="/xweb/public/images/mon302.webp" border="0" alt="Monitores 22''" title="Monitores 22''">
                                    </a>
                                  </div>
                                  <ul class="menuGrupoUl">
                                    <li class="menuGrupoLi menuGrupoLiMonitores">
                                      <a class="menuGrupoLiLink menuGrupoLiLinkMon" href="/xweb/categoria/1118/91/61">
                                          Dell 22"
                                      </a>
                                    </li>
                                    <li class="menuGrupoLi menuGrupoLiMonitores">
                                      <a class="menuGrupoLiLink menuGrupoLiLinkMon" href="/xweb/categoria/1118/89/61">
                                          <img style="max-width: 95px;" src="/xweb/public/images/hp.png" width="30" height="30"  /> 
                                      </a>
                                    </li>
                                    <li class="menuGrupoLi menuGrupoLiMonitores">
                                      <a class="menuGrupoLiLink menuGrupoLiLinkMon" href="/xweb/categoria/1118/109/61">
                                          Otras marcas
                                      </a>
                                    </li>
                                  </ul>
                                </div>

                                <div class="menuGrupoMon">
                                  <div class="menuGrupoFotMon">
                                    <a href="/xweb/categoria/1118/62">
                                      <img width="59" height="59" src="/xweb/public/images/mon303.webp" border="0" alt="Monitores 23''" title="Monitores 23''">
                                    </a>
                                  </div>
                                  <ul class="menuGrupoUl">
                                    <li class="menuGrupoLi menuGrupoLiMonitores">
                                      <a class="menuGrupoLiLink menuGrupoLiLinkMon" href="/xweb/categoria/1118/89/62">
                                          <img style="max-width: 95px;" src="/xweb/public/images/hp.png" width="30" height="30"  /> 
                                      </a>
                                    </li>
                                  </ul>
                                </div>

                                <div class="menuGrupoMon">
                                  <div class="menuGrupoFotMon">
                                    <a href="/xweb/categoria/1118/63">
                                      <img width="59" height="59" src="/xweb/public/images/mon304.webp" border="0" alt="Monitores 24''" title="Monitores 24''">
                                    </a>
                                  </div>
                                  <ul class="menuGrupoUl">
                                    <li class="menuGrupoLi menuGrupoLiMonitores">
                                      <a class="menuGrupoLiLink menuGrupoLiLinkMon" href="/xweb/categoria/1118/89/63">
                                          <img style="max-width: 95px;" src="/xweb/public/images/hp.png" width="30" height="30"  /> 
                                      </a>
                                    </li>
                                    <li class="menuGrupoLi menuGrupoLiMonitores">
                                      <a class="menuGrupoLiLink menuGrupoLiLinkMon" href="/xweb/categoria/1118/97/63">
                                          <img style="max-width: 95px;" src="/xweb/public/images/samsung.png" width="95" height="31"  /> 
                                      </a>
                                    </li>
                                  </ul>
                                </div>

                                <div class="menuGrupoMon">
                                  <div class="menuGrupoFotMon">
                                    <a href="/xweb/categoria/1118">
                                      <img width="59" height="59" src="/xweb/public/images/mon305.webp" border="0" alt="Monitores 19''" title="Monitores 19''">
                                    </a>
                                  </div>
                                  <ul class="menuGrupoUl">
                                    <li class="menuGrupoLi menuGrupoLiMonitores">
                                      <a class="menuGrupoLiLink menuGrupoLiLinkMon" href="/xweb/categoria/1118">
                                          Otros
                                      </a>
                                    </li>
                                  </ul>
                                </div>
                              @endif
                            <!-- Otros -->
                            @elseif ($arrCategoriaMenu->id == 1127)
                              <?php
                              $grupocodigo = str_pad(strtolower($arrSubCategorias->GCOD), 6, "0", STR_PAD_LEFT);
                              $urlfoto = "https://diginova.es/xweb3/fotoartic/grf_".strtolower($grupocodigo)."_1.jpg";
                              ?>
                              <div class="menuGrupoOtros" 
                                <?php if ($arrSubCategorias->GDES == 'Impresoras/Escáneres' || $arrSubCategorias->GDES == 'Accesorios' || $arrSubCategorias->GDES == 'Componentes') { ?> style="min-height: 235px" <?php } ?>>
                                <div class="menuGrupoFot">
                                  <a href="/xweb/categoria/{{$arrSubCategorias->GCOD}}">
                                    <img src="<?php echo $urlfoto ?>" width="80" height="80" border="0" alt="{{$arrSubCategorias->GDES}}" title="{{$arrSubCategorias->GDES}}" />
                                  </a>
                                </div>
                                <div class="menuGrupoDes">
                                  <span class="menuGrupoDes1">{{$arrSubCategorias->GDES}}</span>
                                </div>
                                <ul class="menuGrupoUl">
                                @foreach(session('entorno')->arrSubSubCategorias as $arrSubSubCategorias)
                                  @if ($arrSubCategorias->GCOD == $arrSubSubCategorias->FGRUPO)
                                    <li class="menuGrupoLi menuGrupoLiOtros">
                                      <a class="menuGrupoLiLink" href="/xweb/familia/{{$arrSubSubCategorias->FCOD}}">{{$arrSubSubCategorias->FDES}}</a>
                                    </li>
                                  @endif
                                @endforeach
                                </ul>
                              </div>
                            @endif
                          @endif
                        @endforeach
                      </div>
                      @if ($arrCategoriaMenu->id == 1125)
                        @foreach(session('entorno')->arrOrdenadorMenu as $arrOrdenadorMenu)
                          @php
                          $acodarMinuscula = strtolower($arrOrdenadorMenu->ACODAR);
                          @endphp

                          <?php $artFoto = "nofoto.jpg"; if (isset($arrOrdenadorMenu->imag1)) { $artFoto = $arrOrdenadorMenu->imag1; } ?>

                          <div class="menuCatArticulo2">
                            <div class="celdaFot">
                              <table border="0">
                                <tr>
                                  <td style="vertical-align: middle;">
                                    <a href="/xweb/articulo/{{$arrOrdenadorMenu->ACODAR}}">
                                      <!--<img style="max-height: 150px; max-width: 150px;" src="https://diginova.es/xweb3/fotoartic/art_{{$acodarMinuscula}}_1.jpg" border="0" alt="{{$arrOrdenadorMenu->ADESCR}}" title="{{$arrOrdenadorMenu->ADESCR}}" />-->
                                      <img style="max-height: 150px; max-width: 150px;" src="/xweb/public/articulos/<?php echo $artFoto; ?>" border="0" alt="{{$arrOrdenadorMenu->ADESCR}}" title="{{$arrOrdenadorMenu->ADESCR}}" />
                                    </a>
                                  </td>
                                </tr>
                              </table>
                            </div>
                            <div class="celdaDesc">
                              <a class="menuCatArticuloDesc" href="/xweb/articulo/{{$arrOrdenadorMenu->ACODAR}}">
                                {{substr($arrOrdenadorMenu->ADESCR, 0, 70)}}...
                              </a>
                            </div>
                            <div class="celdaPrecio">
                              @if(session('usuario')->uData->codigo > 0)
                                {{Utils::numFormat($arrOrdenadorMenu->APVP1)}}€
                              @endif
                            </div>
                          </div>
                        @endforeach
                      @elseif ($arrCategoriaMenu->id == 1126)
                        </div>
                        @foreach(session('entorno')->arrPortatilMenu as $arrPortatilMenu)
                          @php
                          $acodarMinuscula = strtolower($arrPortatilMenu->ACODAR);
                          @endphp

                          <?php $artFoto = "nofoto.jpg"; if (isset($arrPortatilMenu->imag1)) { $artFoto = $arrPortatilMenu->imag1; } ?>

                          <div class="menuCatArticulo2">
                            <div class="celdaFot">
                              <table border="0">
                                <tr>
                                  <td style="vertical-align: middle;">
                                    <a href="/xweb/articulo/{{$arrPortatilMenu->ACODAR}}">
                                      <img style="max-height: 150px; max-width: 150px;" src="/xweb/public/articulos/<?php echo $artFoto; ?>" border="0" alt="{{$arrPortatilMenu->ADESCR}}" title="{{$arrPortatilMenu->ADESCR}}" />
                                    </a>
                                  </td>
                                </tr>
                              </table>
                            </div>
                            <div class="celdaDesc">
                              <a class="menuCatArticuloDesc" href="/xweb/articulo/{{$arrPortatilMenu->ACODAR}}">
                                {{substr($arrPortatilMenu->ADESCR, 0, 70)}}...
                              </a>
                            </div>
                            <div class="celdaPrecio">
                              @if(session('usuario')->uData->codigo > 0)
                                {{Utils::numFormat($arrPortatilMenu->APVP1)}}€
                              @endif
                            </div>
                          </div>
                        @endforeach
                      @elseif ($arrCategoriaMenu->id == 1118)
                        @foreach(session('entorno')->arrMonitorMenu as $arrMonitorMenu)
                          @php
                          $acodarMinuscula = strtolower($arrMonitorMenu->ACODAR);
                          @endphp

                          <?php $artFoto = "nofoto.jpg"; //if (isset($arrMonitorMenu->imag1)) { $artFoto = $arrMonitorMenu->imag1; } ?>

                          <div class="menuCatArticulo2" style="float: right">
                            <div class="celdaFot">
                              <table border="0">
                                <tr>
                                  <td style="vertical-align: middle;">
                                    <a href="/xweb/articulo/{{$arrMonitorMenu->ACODAR}}">
                                      <img style="max-height: 150px; max-width: 150px;" src="/xweb/public/articulos/<?php echo $artFoto; ?>"  border="0" alt="{{$arrMonitorMenu->ADESCR}}" title="{{$arrMonitorMenu->ADESCR}}" />
                                    </a>
                                  </td>
                                </tr>
                              </table>
                            </div>
                            <div class="celdaDesc">
                              <a class="menuCatArticuloDesc" href="/xweb/articulo/{{$arrMonitorMenu->ACODAR}}">
                                {{substr($arrMonitorMenu->ADESCR, 0, 70)}}...
                              </a>
                            </div>
                            <div class="celdaPrecio">
                              @if(session('usuario')->uData->codigo > 0)
                                {{Utils::numFormat($arrMonitorMenu->APVP1)}}€
                              @endif
                            </div>
                          </div>
                        @endforeach
                      @elseif ($arrCategoriaMenu->id == 1127)
                        @foreach(session('entorno')->arrOtrosMenu as $arrOtrosMenu)
                          @php
                          $acodarMinuscula = strtolower($arrOtrosMenu->ACODAR);
                          @endphp

                          <?php $artFoto = "nofoto.jpg"; if (isset($arrOtrosMenu->imag1)) { $artFoto = $arrOtrosMenu->imag1; } ?>

                          <div class="menuCatArticulo2">
                            <div class="celdaFot">
                              <table border="0">
                                <tr>
                                  <td style="vertical-align: middle;">
                                    <a href="/xweb/articulo/{{$arrOtrosMenu->ACODAR}}">
                                      <img style="max-height: 150px; max-width: 150px;" src="/xweb/public/articulos/<?php echo $artFoto; ?>" border="0" alt="{{$arrOtrosMenu->ADESCR}}" title="{{$arrOtrosMenu->ADESCR}}" />
                                    </a>
                                  </td>
                                </tr>
                              </table>
                            </div>
                            <div class="celdaDesc">
                              <a class="menuCatArticuloDesc" href="/xweb/articulo/{{$arrOtrosMenu->ACODAR}}">
                                {{substr($arrOtrosMenu->ADESCR, 0, 70)}}...
                              </a>
                            </div>
                            <div class="celdaPrecio">
                              @if(session('usuario')->uData->codigo > 0)
                                {{Utils::numFormat($arrOtrosMenu->APVP1)}}€
                              @endif
                            </div>
                          </div>
                        @endforeach
                      <!-- Apple -->
                      @elseif ($arrCategoriaMenu->id == 1160)
                        <div class="digiCategoria">
                          <div class="menuApple">

                            <!-- iMac -->
                            <div class="menuAppleTD">
                              <div class="menuAppleTD1">
                                <a href="/xweb/familia/4">
                                  <img src="/xweb/public/images/imac.webp" width="209" height="72"  />
                                </a>
                              </div>
                              <div class="menuAppleTD2">
                                <a href="/xweb/familia/4" style="color: black;">iMac</a>
                              </div>
                              <div class="menuAppleTD3">
                                Ordenadores de escritorio de Apple
                              </div>
                            </div>

                            <!-- Macbook -->
                            <div class="menuAppleTD" style="">
                              <div class="menuAppleTD1">
                                <a href="/xweb/familia/710">
                                  <img src="/xweb/public/images/macbook.webp" width="225" height="186"  />
                                </a>
                              </div>
                              <div class="menuAppleTD2">
                                <a href="/xweb/familia/710" style="color: black;">Macbook</a>
                              </div>
                              <div class="menuAppleTD3">
                                Portátiles de alto rendimiento
                              </div>
                            </div>

                            <!-- iPad -->
                            <div class="menuAppleTD" style="border-right: 0;">
                              <div class="menuAppleTD1">
                                <a href="/xweb/familia/711">
                                  <img src="/xweb/public/images/ipad.webp" width="204" height="126"  />
                                </a>
                              </div>
                              <div class="menuAppleTD2">
                                <a href="/xweb/familia/711" style="color: black;">iPad</a>
                              </div>
                              <div class="menuAppleTD3">
                                Las famosas <span style="font-style: italic;">tablets</span> de la manzana
                              </div>
                            </div>

                          </div>
                        </div>
                      <!-- Ofertas -->
                      @elseif ($arrCategoriaMenu->id == 1166)
                        @foreach(session('entorno')->arrOfertas as $arrOfertas)
                          @php
                          $acodarMinuscula = strtolower($arrOfertas->ACODAR);
                          @endphp

                          <?php $artFoto = "nofoto.jpg"; if (isset($arrOfertas->imag1)) { $artFoto = $arrOfertas->imag1; } ?>

                          <div class="menuCatArticulo2" style="width: 250px;">
                            <div class="celdaFot">
                              <table border="0">
                                <tr>
                                  <td style="vertical-align: middle;">
                                    <a href="/xweb/articulo/{{$arrOfertas->ACODAR}}">
                                      <img style="max-height: 150px; max-width: 150px;" src="/xweb/public/articulos/<?php echo $artFoto; ?>" border="0" alt="{{$arrOfertas->ADESCR}}" title="{{$arrOfertas->ADESCR}}">
                                    </a> 
                                  </td>
                                </tr>
                              </table>
                            </div>
                            <div style="width: 100%; margin-top: 22px; display: flex; justify-content: space-evenly;">
                              <div style="width: 160px; display: inline-block;">
                                <div class="celdaTipo celda_oferta" style="bottom: 0px;text-align: center;<?php if (session('usuario')->uData->codigo == 0) { ?> left:55px <?php } ?>">Oferta</div>
                                @if(session('usuario')->uData->codigo > 0)
                                  <div class="celdaTipo celda_precio_antiguo" style="bottom: 0px;text-align: center;">{{Utils::numFormat($arrOfertas->precioAntiguo)}}€</div>
                                @endif
                              </div>
                            </div>
                            <div class="celdaDesc">
                              <a class="menuCatArticuloDesc" href="/xweb/articulo/{{$arrOfertas->ACODAR}}">
                                {{substr($arrOfertas->ADESCR, 0, 70)}}...
                              </a>
                            </div>
                            <div class="celdaPrecio">
                              @if(session('usuario')->uData->codigo > 0)
                                {{Utils::numFormat($arrOfertas->precioOferta)}}€
                              @endif
                            </div>
                          </div>
                        @endforeach
                      @endif
                    </div>
                    <div class="menuFilaFin">
                      <div class="menuFilaFin1">
                        <div class="mfCol">
                          <div class="mfCol1">
                            <img alt="Garantía" src="/xweb/public/images/iconsventajas_desplegable_1.webp" width="44" height="44" />
                          </div>
                          <div class="mfCol2">
                            <div class="mfCol2_1">2 años de garantía</div>
                          </div>
                        </div>
                        <div class="mfCol">
                          <div class="mfCol1">
                            <img alt="Garantía" src="/xweb/public/images/iconsventajas_desplegable_2.webp" width="41" height="28" />
                          </div>
                          <div class="mfCol2">
                            <div class="mfCol2_1">Financiación</div>
                          </div>
                        </div>
                        <div class="mfCol">
                          <div class="mfCol1">
                            <img alt="Garantía" src="/xweb/public/images/iconsventajas_desplegable_3.webp" width="43" height="44" />
                          </div>
                          <div class="mfCol2">
                            <div class="mfCol2_1">24h RMA y pedidos</div>
                          </div>
                        </div>
                        <div class="mfCol">
                          <div class="mfCol1">
                            <img alt="Garantía" src="/xweb/public/images/iconsventajas_desplegable_4.webp" width="43" height="44" />
                          </div>
                          <div class="mfCol2">
                            <div class="mfCol2_1">1 mes de DOA</div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </ul>
                </div>
              </li>
              @php
              $contCategorias += 1;
              @endphp
            @endforeach
            <li style="padding-right: 0px; padding-left: 147px;">
              <img alt="Diginova" src="/xweb/public/images/iconsecondlife.png" width="126" height="40"/>
            </li>
          </ul>
        </nav>
      </div>
    </div>
  </div>
  @if (session('entorno')->nombrePagina == 'categoria' || session('entorno')->nombrePagina == 'ofertas')
    @if (session('entorno')->nombrePagina == 'categoria')
    <div class="catTituloOc">
    @elseif (session('entorno')->nombrePagina == 'ofertas')
    <div class="catTituloOc" style="margin-top: 12px;">
    @endif
      <div class="catTituloTOc">
        <div class="catTituloT1Oc">
          @if ($categoria == 1125)
            Ordenadores
          @elseif ($categoria == 1126)
            Portátiles
          @elseif ($categoria == 1118)
            Monitores
          @elseif ($categoria == 1160)
            Apple
          @elseif ($categoria == 1127)
            Otros
          @elseif ($categoria == 1166)
            Ofertas
          @endif
        </div>
        <div class="catTituloT2Oc">
          @if ($categoria == 1125)
            <img alt="" height="128" style="max-width:430px; margin-top: -9px;" src="/xweb/public/images/categorialogo{{$categoria}}.png">
          @elseif ($categoria == 1126)
            <img alt="" height="128" style="max-width: 378px; margin-top: -10px;" src="/xweb/public/images/categorialogo{{$categoria}}.png">
          @elseif ($categoria == 1118)
            <img alt="" height="128" style="max-width:378px; margin-top: -10px;" src="/xweb/public/images/categorialogo{{$categoria}}.png">
          @elseif ($categoria == 1160)
                  
          @elseif ($categoria == 1127)
            <img alt="" height="128" style="width: 621px; height: auto; margin-top: 35px; margin-left: -135px;" src="/xweb/public/images/categorialogo{{$categoria}}.png">
          @elseif ($categoria == 1166)
            <img alt="" style="height: 106px; width: auto;" src="/xweb/public/images/categorialogo{{$categoria}}.png">
          @endif
        </div>
        <div class="catTituloT3Oc">
          @if ($categoria == 1125)
            Los ordenadores de segunda mano son una excelente opción para adquirir equipos con mejores prestaciones y a un precio inmejorable.</br></br>
            Diginova te ofrece Ordenadores de segunda mano de las mejores marcas, como son Acer, Asus, Dell, Fujitsu, HP y Lenovo.
          @elseif ($categoria == 1126)
            Los portátiles de segunda mano son una excelente opción para adquirir equipos con mejores prestaciones y a un precio inmejorable. Cuando hacemos mención a las palabras "portátiles segunda mano" podemos encontrarnos equipos en perfectas condiciones a pesar de haber tenido un uso profesional anterior.</br></br>
            Diginova te ofrece Ordenadores de segunda mano de las mejores marcas, como son Acer, Asus, Dell, Fujitsu, HP y Lenovo.
          @elseif ($categoria == 1118)
            En Diginova disponemos de un amplio catálogo de monitores de segunda mano de todas las pulgadas: 17" | 18.5" | 19" | 20" | 21.5" | 22" | 23" | 24" | 26" | 27" y marcas Dell, Dicota, Fujitsu, HP, Lenovo, LG, NEC, Philips, Samsung y ViewSonic.
          @elseif ($categoria == 1166)
            En esta sección podrás encontrar una selección de nuestros productos a precios imbatibles.
          @endif
        </div>
      </div>
    </div>
    @endif
</div>

<script type="text/javascript">
document.addEventListener("DOMContentLoaded", function() {
  var lazyImages = [].slice.call(document.querySelectorAll("img.lazy"));

  if ("IntersectionObserver" in window) {
    let lazyImageObserver = new IntersectionObserver(function(entries, observer) {
      entries.forEach(function(entry) {
        if (entry.isIntersecting) {
          let lazyImage = entry.target;
          lazyImage.src = lazyImage.dataset.src;
          lazyImage.srcset = lazyImage.dataset.srcset;
          lazyImage.classList.remove("lazy");
          lazyImageObserver.unobserve(lazyImage);
        }
      });
    });

    lazyImages.forEach(function(lazyImage) {
      lazyImageObserver.observe(lazyImage);
    });
  } else {
    // Possibly fall back to event handlers here
  }
});
</script>

<script type="text/javascript">
  $(document).ready(function() {
    $('#textobusqMovil').keyup(function (event)
    {
      //Obtenemos el value del input
      var service = $(this).val();  

      setTimeout(function() 
      {
        if($('#textobusqMovil').val() == service)
        {
          console.log('Holaaaa3');
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
              $('#suggestionsBusqMv').slideDown().html(response);
              $('#suggestionsBusqMv').css('display', 'inline-grid');

              mostrarBanderaNavegador();
            }
          });
        }
      }, 1500);
    });
  });
</script>