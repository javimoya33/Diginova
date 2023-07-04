<!-- selectores de propiedades de los artículos -->
@if(1==2)
    @if(isset(session("articulo")->matPropiedades))
        @if(count((array)session("articulo")->matPropiedades)>0)
            <div class="row">
                <div class="col-xs-12">
                    @foreach(session("articulo")->matPropiedades as $propi)
                    <div class="btn-group ">
                        <?php $tit = $propi->p0->desprop; ?>
                        <?php $sel = false ?>
                        @foreach($propi as $values)
                            @if($values->select)
                            <?php $sel = true ?>
                            <?php $tit = $values->desval ?>
                            @endif
                        @endforeach
                        <button class="btn btn-default btn-xs dropdown-toggle {{$sel?'propiedadSeleccionada':''}}" type="button"
                            data-toggle="dropdown" aria-expanded="false">
                            {{$tit}} <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            @foreach($propi as $values)
                                @if($values->select)
                                <li class=""><a href="{{URL::to($propi->p0->ruta)}}"
                                    onclick="cambiarPropiedades('{{URL::to('cambiarPropiedades/'.$propi->p0->codprop.'/0')}}');" title="{{T::tr('Anular')}}">{{T::tr('Anular')}}</a></li>
                                @endif
                            @endforeach
                            @foreach($propi as $values)
                                <li class="{{$values->select?'active':''}}"><a
                                    href="{{URL::to($values->ruta)}}"
                                    onclick="cambiarPropiedades('{{URL::to('cambiarPropiedades/'.$values->codprop.'/'.$values->codval)}}');">{{$values->desval}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    @endforeach

                </div>
            </div>
        @endif
    @endif
@endif
<!-- fin selectores de propiedades de los artículos -->
