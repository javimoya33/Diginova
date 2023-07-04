      <?php
      $cook=[];
      $bloque=0;
      $grupo=0;
      $familia=0;
      if(isset($articulos)){
        if(!empty($articulos)){
          try {
            $cook=$articulos[0];
          } catch (\Throwable $th) {
          }
        }
      }else{
        if(isset($barti)){
          $cook=$barti;
        }
      }
      if(!empty($cook)){
        //var_dump($cook);
        //var_dump(session("menu")->menu);
        try {
          $bloque=$cook->bloque+0;
          $grupo=$cook->fgrupo+0;
          $familia=$cook->ffamilia+0;
        } catch (\Throwable $th) {
        }

        $maxgrus=1;
        foreach(session("menu")->menu as $bmenu){
          $cuen=count((array)$bmenu->grupos);
          $maxgrus=$cuen>$maxgrus?$cuen:$maxgrus;
        }
        if($maxgrus==1){
          // no se usan los bloques de grupos de familias
          $bloque=$grupo;
        }
      }
      //echo $bloque." ".$grupo." ".$familia." ".$seccion;
      if(isset($seccion)){
        switch($seccion){
          case "inicio":
          case "seguimiento":
          case "avisos":
            $bloque=0;
            $grupo=0;
            $familia=0;
          break;
        }
      }
      //var_dump(session("menu")->menu);return;
      ?>

  
<!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- search form -->
      <form action="{{URL::to('buscar/1')}}" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="busqueda_texto" id="busqueda_texto_2" class="form-control" placeholder="buscar..." value="" />
          <span class="input-group-btn">
            <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
            </button>
          </span>
        </div>
      </form>
      {{-- var_dump(session("menu")->menu) --}}
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="menu-superior"><a href="{{URL::to('')}}" title="{{T::tr('Inicio')}}"><i class="fa fa-bookmark text-yellow"></i> {{T::tr('Inicio')}}</a></li>
        <li class="menu-superior"><a href="{{URL::to('seguimiento')}}" title="{{T::tr('Seguimiento')}}"><i class="fa fa-paperclip text-yellow"></i> <span>{{T::tr('Seguimiento')}}</span></a></li>
        @if(session("usuario")->uData->codigo>0)
        <li class="menu-superior"><a href="{{URL::to('avisos')}}" title="{{T::tr('Avisos')}}"><i class="fa fa-bell-o text-yellow"></i> <span>{{T::tr('Avisos')}}</span></a></li>
        @endif
        <li class="menu-superior"><a href="{{URL::to('contactar')}}" title="{{T::tr('Contactar')}}"><i class="fa fa-pencil-square-o text-yellow"></i> <span>{{T::tr('Contactar')}}</span></a></li>
        @if(session('entorno')->config->x_faq && strlen(trim(session('entorno')->config->x_faqtit))>0)
        <li class="menu-superior"><a href="{{URL::to('faq')}}" title="{{trim(session('entorno')->config->x_faqtit)}}"><i class="fa fa-question-circle text-yellow"></i> <span>{{trim(session('entorno')->config->x_faqtit)}}</span></a></li>
        @endif
        @if(session('entorno')->config->x_desarrollo)
        <li class="menu-superior"><a href="{{URL::to('reset')}}"><span>reset (para tests)</span></a></li>
        @endif
        
        <?php
        /*
        $nombloque = 0;
        $nomgrupo = 0;
        $nomfamilia = 0;
        //$rutt=Route::getCurrentRoute()->getPath();
        $rutt = Route::currentRouteName();
        if (isset($matrizArt) && strpos($rutt, "seccion") !== false) {
          if (count($matrizArt) > 0) {
            $nombloque = $matrizArt[0]->bloque;
            $nomgrupo = $matrizArt[0]->fgrupo;
            $nomfamilia = $matrizArt[0]->ffamilia;
          }
        }
        if (isset($barti) && strpos($rutt, "producto") !== false) {
          if (count($barti) > 0) {
            $nombloque = $barti->bloque;
            $nomgrupo = $barti->fgrupo;
            $nomfamilia = $barti->ffamilia;
          }
        }
        */
        ?>

        <?php
        $gruposelec = 0;
        if (isset($articulos[0]->fgrupo)) {
          $gruposelec = $articulos[0]->fgrupo;
        }
        ?>

        <li class="header">Enlaces</li>
        <!-- menus adicionales izquierda, modo texto o imagen -->
        @if (!empty(session("menu")->menuEnlacesIzq))
        @foreach(session("menu")->menuEnlacesIzq as $bmenu)
        @if($bmenu->imagen=="" && $bmenu->externo=="")
        <li class="menu-adicional">
          <a class="menu-adicional" style="white-space: normal;word-wrap: break-word;" href="{{URL::to('enlace/'.$bmenu->cod)}}" title="{{$bmenu->titulo}}">
            <i class="fa fa-circle-o text-green"></i> {{$bmenu->titulo}}</a>
        </li>
        @endif
        @if($bmenu->imagen=="" && $bmenu->externo!="")
        <li class="menu-adicional">
          <a class="menu-adicional" style="white-space: normal;word-wrap: break-word;" href="{{$bmenu->externo}}" target="_blank" title="{{$bmenu->titulo}}">
            <i class="fa fa-circle-o text-green"></i> {{$bmenu->titulo}}</a>
        </li>
        @endif
        @if($bmenu->imagen!="" && $bmenu->externo=="")
        <li>
          <a href="{{URL::to('enlace/'.$bmenu->cod)}}" title="{{$bmenu->titulo}}">
            <img class="img-responsive" style="width: 96%" alt="{{$bmenu->titulo}}" title="{{$bmenu->titulo}}" src="{{URL::asset('public/images')}}/{{$bmenu->imagen}}" />
          </a>
        </li>
        @endif
        @if($bmenu->imagen!="" && $bmenu->externo!="")
        <li>
          <a href="{{$bmenu->externo}}" target="_blank" title="{{$bmenu->titulo}}">
            <img class="img-responsive" style="width: 96%" alt="{{$bmenu->titulo}}" title="{{$bmenu->titulo}}" src="{{URL::asset('public/images')}}/{{$bmenu->imagen}}" />
          </a>
        </li>
        @endif
        @endforeach
        @endif
        <!-- fin menus adicionales izquierda -->
        <!-- menus adicionales derecha -->
        @if (!empty(Session::get("menu")->menuEnlacesDer))
        @foreach(session("menu")->menuEnlacesDer as $bmenu)
        @if($bmenu->imagen=="" && $bmenu->externo=="")
        <li><a href="{{URL::to('enlace/d'.$bmenu->cod)}}" title="{{$bmenu->titulo}}"><i class="fa fa-circle-o text-green"></i> <span> {{$bmenu->titulo}}</span></a></li>
        @endif
        @if($bmenu->imagen=="" && $bmenu->externo!="")
        <li><a href="{{$bmenu->externo}}" target="_blank" title="{{$bmenu->titulo}}"><i class="fa fa-circle-o text-green"></i> <span> {{$bmenu->titulo}}</span></a></li>
        @endif
        @if($bmenu->imagen!="" && $bmenu->externo=="")
        <li>
          <a href="{{URL::to('enlace/d'.$bmenu->cod)}}" title="{{$bmenu->titulo}}">
            <img class="img-responsive" style="width: 96%" alt="{{$bmenu->titulo}}" title="{{$bmenu->titulo}}" src="{{URL::asset('public/images')}}/{{$bmenu->imagen}}" />
          </a>
        </li>
        @endif
        @if($bmenu->imagen!="" && $bmenu->externo!="")
        <li>
          <a href="{{$bmenu->externo}}" target="_blank" title="{{$bmenu->titulo}}">
            <img class="img-responsive" style="width: 96%" alt="{{$bmenu->titulo}}" title="{{$bmenu->titulo}}" src="{{URL::asset('public/images')}}/{{$bmenu->imagen}}" />
          </a>
        </li>
        @endif
        @endforeach
        @endif
        <!-- fin menus adicionales derecha -->
        <li class="menu-superior"><a href="{{URL::to('politicacookies')}}" title="{{T::tr('Aviso legal / Política de Cookies')}}"><i class="fa fa-pencil-square-o text-yellow"></i> <span>{{T::tr('Aviso legal / Política de Cookies')}}</span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>