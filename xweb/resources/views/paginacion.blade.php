@if(count($articulos)>0)
    @if($articulos[0]->totalPaginas>1)
        <div class="row">
            <div class="col-xs-12">
                <nav>
                    <ul class="pagination" style="margin: 0px;">
                        <li>
                            @if($seccion=="seccion")
                                <a href="{{URL::to('seccion/'.$articulos[0]->ffamilia.'/'.Utils::urlenc($articulos[0]->nomfamiliaoriginal).'/1')}}"
                                    aria-label="Previous" title="anterior"> <span aria-hidden="true">&laquo;</span>
                                </a>
                            @endif
                            @if($seccion=="especial")
                                <a href="{{URL::to('especial/'.$idmenu.'/'.Utils::urlenc($titulo).'/1')}}" aria-label="Previous" title="anterior">
                                <span aria-hidden="true">&laquo;</span>
                                </a>
                            @endif
                            @if($seccion=="novedades")
                                <a href="{{URL::to('novedades/1')}}" aria-label="Previous" title="anterior">
                                <span aria-hidden="true">&laquo;</span>
                                </a>
                            @endif
                            @if($seccion=="buscar")
                                <a href="{{URL::to('buscar/1?busqueda_texto='.session('articulo')->matBusquedas->texto.'&busqueda_marca='.session('articulo')->matBusquedas->marca.'&busqueda_familia='.session('articulo')->matBusquedas->familia)}}"	aria-label="Previous" title="buscar">
                                <span aria-hidden="true">&laquo;</span>
                                </a>
                            @endif
                        </li>
                        @for ($i = $articulos[0]->paginaActual-4; $i < $articulos[0]->paginaActual; $i++)
                            @if($i>0)
                                <li>
                                    @if($seccion=="seccion")
                                        <a href="{{URL::to('seccion/'.$articulos[0]->ffamilia.'/'.Utils::urlenc($articulos[0]->nomfamiliaoriginal).'/'.$i)}}" title="{{$i}}">{{$i}}
                                        </a>
                                    @endif
                                    @if($seccion=="especial")
                                        <a href="{{URL::to('especial/'.$idmenu.'/'.Utils::urlenc($titulo).'/'.$i)}}" title="{{$i}}">{{$i}}
                                        </a>
                                    @endif
                                    @if($seccion=="novedades")
                                        <a href="{{URL::to('novedades/'.$i)}}" title="{{$i}}">{{$i}}
                                        </a>
                                    @endif
                                    @if($seccion=="buscar")
                                        <a href="{{URL::to('buscar/'.$i.'?busqueda_texto='.session('articulo')->matBusquedas->texto.'&busqueda_marca='.session('articulo')->matBusquedas->marca.'&busqueda_familia='.session('articulo')->matBusquedas->familia)}}" title="{{$i}}">{{$i}}
                                        </a>
                                    @endif
                                </li>
                            @endif
                        @endfor
                        <li class="active">
                            <a href="#" title="{{$articulos[0]->paginaActual}}">{{$articulos[0]->paginaActual}}</a>
                        </li>
                        @for ($i = $articulos[0]->paginaActual+1; $i<$articulos[0]->paginaActual+5; $i++)
                            @if($i<=$articulos[0]->totalPaginas)
                                <li>
                                    @if($seccion=="seccion")
                                        <a href="{{URL::to('seccion/'.$articulos[0]->ffamilia.'/'.Utils::urlenc($articulos[0]->nomfamiliaoriginal).'/'.$i)}}" title="{{$i}}">{{$i}}
                                        </a>
                                    @endif
                                    @if($seccion=="especial")
                                        <a href="{{URL::to('especial/'.$idmenu.'/'.Utils::urlenc($titulo).'/'.$i)}}" title="{{$i}}">{{$i}}
                                        </a>
                                    @endif
                                    @if($seccion=="novedades")
                                        <a href="{{URL::to('novedades/'.$i)}}" title="{{$i}}">{{$i}}
                                        </a>
                                    @endif
                                    @if($seccion=="buscar")
                                        <a href="{{URL::to('buscar/'.$i.'?busqueda_texto='.session('articulo')->matBusquedas->texto.'&busqueda_marca='.session('articulo')->matBusquedas->marca.'&busqueda_familia='.session('articulo')->matBusquedas->familia)}}" title="{{$i}}">{{$i}}
                                        </a>
                                    @endif
                                </li>
                            @endif
                        @endfor
                        <li>
                            @if($seccion=="seccion")
                                <a href="{{URL::to('seccion/'.$articulos[0]->ffamilia.'/'.Utils::urlenc($articulos[0]->nomfamiliaoriginal).'/'.$articulos[0]->totalPaginas)}}"
                                    aria-label="Next" title="Siguiente"> <span aria-hidden="true">&raquo;</span>
                                </a>
                            @endif
                            @if($seccion=="especial")
                                <a href="{{URL::to('especial/'.$idmenu.'/'.Utils::urlenc($titulo).'/'.$articulos[0]->totalPaginas)}}"
                                    aria-label="Next" title="Siguiente"> <span aria-hidden="true">&raquo;</span>
                                </a>
                            @endif
                            @if($seccion=="novedades")
                                <a href="{{URL::to('novedades/'.$articulos[0]->totalPaginas)}}"
                                    aria-label="Next" title="Siguiente"> <span aria-hidden="true">&raquo;</span>
                                </a>
                            @endif
                            @if($seccion=="buscar")
                                <a href="{{URL::to('buscar/'.$articulos[0]->totalPaginas.'?busqueda_texto='.session('articulo')->matBusquedas->texto.'&busqueda_marca='.session('articulo')->matBusquedas->marca.'&busqueda_familia='.session('articulo')->matBusquedas->familia)}}" aria-label="Next" title="Siguiente">
                                <span aria-hidden="true">&raquo;</span>
                                </a>
                            @endif
                        </li>
                    </ul>
                    <strong style="vertical-align: top;">&nbsp;{{$articulos[0]->totalArticulos}} {{T::tr('productos')}}</strong>
                </nav>
            </div>
        </div>
    @endif
@endif
