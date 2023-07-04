<?php
    $tiposplash=1; // tipo 1 splash de imagen tipo 2 splash html
?>

@if($tiposplash==1)
<a id="splash" href="{{URL::asset('public/images/splash.jpg')}}" data-lightbox="image-splash" style="display: none;z-index:9998;"></a>
@endif
@if($tiposplash==2)
    @if(Session::has("splashhtml"))
    {{Session::forget("splashhtml")}}
        <div id="modalsplash" class="modal fade" role="dialog" style="z-index:999998;">
            <div class="modal-dialog modal-lg">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">{{T::tr('Título')}} (en archivo slash.blade.php)</h4>
                    </div>
                    <div class="modal-body">
                        <p>Texto de la ventana.</p>
                        <p>Texto de la ventana.</p>
                        <p>Texto de la ventana.</p>
                        <p>Texto de la ventana.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal" style="z-index:999999;">{{T::tr('Entendido')}}</button>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function(){
                $('#modalsplash').modal();
            });
        </script>
    @endif
@endif
