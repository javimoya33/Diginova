
<script type="text/javascript">
    var elegirTramo = false;
</script>

<?php
    if ($elegirTramo)
    {
        ?>

        <script type="text/javascript">
            elegirTramo = true;
        </script>

        <?php
    }
?>

<a class="btn btn-success btn-lg" role="button" onclick="
    if ( ($('#select_direccion_envio').val() > -1) &&  ($('#select_agencia').val() > -1) )
    {
        var todoOk = true;
        if ( elegirTramo )
        {
            if ($('#agencia_tramo').val() == -1)
            {
                todoOk = false;
                alertify.alert('', 'Debe seleccionar el tramo horario de entrega');
            }
        }

        if (todoOk)
        {
            if (finalizarPago())
            {
                var alfa;
                alfa=finalizarCompra('{{URL::to('finalizarCompra')}}'); // 1234                                                 
                console.log(alfa);
                setTimeout( function(){ location.href = alfa; }, 1000); // 1234
            }
            //alert('OK');
        } 

    }
    else
    {
        alertify.alert('', 'Debe seleccionar la dirección de envío y la agencia de transporte antes de completar el pedido');
    }
    return false;
    " href="#">{{T::tr('Finalizar compra')}}
</a>


