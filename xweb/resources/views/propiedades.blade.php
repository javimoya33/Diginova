<!-- selectores de propiedades de los artículos -->
@if(isset(session("articulo")->matPropiedades))
    @if(!empty(session("articulo")->matPropiedades))
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
                            <?php //echo $values->desval ?>
                            @endif
                        @endforeach
                        <button class="btn btn-default btn-xs dropdown-toggle {{$sel?'propiedadSeleccionada':''}}" type="button" data-toggle="dropdown" aria-expanded="false">
                            {{$tit}} <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            @foreach($propi as $values)
                                @if($values->select)
                                <li class="">
                                    <a href="{{URL::to($propi->p0->ruta)}}" onclick="cambiarPropiedades('{{URL::to('cambiarPropiedades/'.$propi->p0->codprop.'/0')}}');" title="{{T::tr('Anular')}}">{{T::tr('Anular')}}</a>
                                </li>
                                @endif
                            @endforeach
                            @foreach($propi as $values)
                                <li class="{{$values->select?'active':''}}">
                                    <a href="{{URL::to($values->ruta)}}" onclick="cambiarPropiedades('{{URL::to('cambiarPropiedades/'.$values->codprop.'/'.$values->codval)}}');" title="{{$values->desval}}">{{$values->desval}}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
@endif

@if(1==10)
    @if(isset(session("articulo")->matPropiedades))
        @if(!empty(session("articulo")->matPropiedades))
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
                                <?php //echo $values->desval ?>
                                @endif
                            @endforeach
                            <button class="btn btn-default btn-xs dropdown-toggle {{$sel?'propiedadSeleccionada':''}}" type="button" data-toggle="dropdown" aria-expanded="false">
                                {{$tit}} <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                @foreach($propi as $values)
                                    @if($values->select)
                                    <li class="">
                                        <a href="{{URL::to($propi->p0->ruta)}}" onclick="cambiarPropiedades('{{URL::to('cambiarPropiedadesMulti/'.$propi->p0->codprop.'/0')}}');" title="{{T::tr('Anular')}}">{{T::tr('Anular')}}</a>
                                    </li>
                                    @endif
                                @endforeach
                                @foreach($propi as $values)
                                    <li class="{{$values->select?'active':''}}">
                                        <a href="{{URL::to($values->ruta)}}" onclick="cambiarPropiedades('{{URL::to('cambiarPropiedadesMulti/'.$values->codprop.'/'.$values->codval)}}');" title="{{$values->desval}}">{{$values->desval}}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    @endif
    @if(1==10)
        <pre>
            {{var_dump(session("articulo")->matPropiedades)}}
        </pre>
    @endif
@endif

<div class="boxSeparador">&nbsp;</div>
<!-- fin selectores de propiedades de los artículos -->
