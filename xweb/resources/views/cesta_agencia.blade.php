    <div class="fPagoTit" style="margin-top: 40px; margin-bottom: 4px;">Agencia de transporte</div>

        <div >

                <select id="select_agencia" class="linkFPago formaPagoEnvio" style="width: 405px;border-radius: 0px;" onchange="/*selecFormasCesta('{{URL::to('selecFormasCesta/envio')}}' + '/' + this.value, this);*/ " >
                    <option value="-1">-- Seleccione una agencia de transporte --</option>

                    <?php
                        foreach ($portesMatriz as $portesFila) 
                        {
                            $vcod = $portesFila -> VCOD;
                            $vdes = $portesFila -> VDES;
                            $vPrecio = $portesFila -> VPRECIO;
                            $vPrecioF = number_format($vPrecio, 2, ",", "."); $vPrecioF .= "&euro;";

                            ?>

                            <option value="<?php echo $vcod; ?>" ><?php echo $vdes; ?> - <?php echo $vPrecioF; ?></option>

                            <?php
                        }
                    ?>
                </select>
        </div>


        <div id="agencia_div2" style="margin-top: 40px; ">
            
        </div>

<script type="text/javascript">
    $('#select_agencia').on('change', function() 
    { 
          //Obtenemos el value del input
          var service = $(this).val();

          if (service == -1) { $('#agencia_div2').html(""); }
          else
          {
            $.ajax({
                type: 'GET',
                url: '/xweb/cesta_agencia_paso2/' + service,
                beforeSend: function() {
                },
                success: function(response) 
                {
                  //Escribimos las sugerencias que nos manda la consulta
                  $('#agencia_div2').slideDown().html(response);
                }
            });

            $.ajax({
                type: 'GET',
                url: '/xweb/cesta_agencia_paso3/' + service,
                beforeSend: function() {
                },
                success: function(response) 
                {
                  //Escribimos las sugerencias que nos manda la consulta
                  $('#cesta_finalizar').html(response);
                }
            });
          }

        

    });
</script>