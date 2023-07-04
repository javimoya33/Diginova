@if(isset(session('entorno')->listaidiomas))
    @if(count((array)session('entorno')->listaidiomas)>1)
        <ul class="nav navbar-nav">
            <!-- Messages: style can be found in dropdown.less-->
            <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" alt="Idioma" title="Idioma">
                <i class="fa fa-language"></i>
            </a>
            <ul class="dropdown-menu">
                <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                    @foreach(session('entorno')->listaidiomas as $idi)
                    <li><!-- start message -->
                    <a href="{{URL::to('idioma/'.$idi->iid)}}" title="Language">
                        @if($idi->iid==Cookie::get('idioma'))
                            <b>{{$idi->inom}}</b>
                        @else
                            {{$idi->inom}}
                        @endif
                    </a>
                    </li>
                    <!-- end message -->
                    @endforeach
                </ul>
                </li>
            </ul>
        </ul>
    @endif
@endif
