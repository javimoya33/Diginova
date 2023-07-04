
<?php
    $vcod = $agencia -> VCOD;
    $vobse = $agencia -> VOBSE;
    $vfax1 = $agencia -> VFAX1;
    $vfax2 = $agencia -> VFAX2;
    //$vprecio = $agencia -> VPRECIO;
    $vprecio = $desgloseCesta->recargosFormaEnvio;
    $vprecioF = number_format($vprecio, 2, ",", "."); $vprecioF .= "&euro;";

    $sumaPrecioArticulos = $desgloseCesta -> sumaPrecioArticulos;
    $subtotal = $sumaPrecioArticulos + $vprecio;
    $iva = 0;
    
    //if ($cinvsujpas == "N" && $desgloseCesta -> iva2 > 0 ) { $iva = $subtotal * 0.21; }
    //if ($cinvsujpas == "S" && $desgloseCesta -> iva2 > 0) { $iva = $desgloseCesta -> iva2; } 

    //$iva = $desgloseCesta -> iva2;

    if ( $desgloseCesta -> iva2 != 0 ) { $iva = $subtotal * 0.21; }

    $ivaF = number_format($iva, 2, ",", "."); $ivaF .= "&euro;";

    $recargo = 0;

    //if ($cinvsujpas == "N" && $desgloseCesta -> rec2 > 0 ) { $recargo = $subtotal * 0.052; }
    //if ($cinvsujpas == "S" && $desgloseCesta -> rec2 > 0) { $recargo = $desgloseCesta -> rec2; } 

    $recargo = $desgloseCesta -> rec2;
    //$recargo = $subtotal * 0.052; 

    if ( $desgloseCesta -> rec2 != 0 ) { $recargo = $subtotal * 0.052; }

    $recargoF = number_format($recargo, 2, ",", "."); $recargoF .= "&euro;";

    $total = $subtotal + $iva + $recargo;
    $totalF = number_format($total, 2, ",", "."); $totalF .= "&euro;";

//echo "<br />FormaEnvio: ".session('usuario')->uData->formaEnvio;
?>

<?php
    // Si la agencia tiene VFAX1 y VFAX2, mostrar selector de tramos horarios:
       // if ($mostrarTramo && ( $vfax1 != "" && $vfax2 != "") )
        if ($mostrarTramo)
        {
            ?>

            <div class="fPagoTit" style="margin-top: 0; margin-bottom: 4px;">Horario de entrega</div>

            <select class="linkFPago formaPagoEnvio" style="width: 405px;border-radius: 0px;" id="agencia_tramo" name="agencia_tramo" onchange="selecFormasCesta('{{URL::to('selecFormasCesta/horario')}}' + '/' + this.value, this); ">
                <option value="-1">-- Seleccione horario de entrega --</option>
                <option value="1"><?php echo $vfax1; ?></option>
                <option value="2"><?php echo $vfax2; ?></option>
            </select>

            <?php
        }
?>


<?php
    // Si la agencia tiene observaciones, mostrarla
        if ($vobse != "")
        {
            ?>

                <div id="agencia_observaciones" style="margin-top: 55px; ">
                    <div style="font-weight: bold; color: black; border: 7px solid red; padding: 3px 5px; text-align: center; font-size: 14pt; width: 404px;"><?php echo $vobse; ?></div>
                </div>

            <?php
        }
?>

<script type="text/javascript">
    document.getElementById("cesta_edit_portes").innerHTML = "<?php echo $vprecioF; ?>";
    document.getElementById("cesta_edit_total").innerHTML = "<?php echo $totalF; ?>";

    document.getElementById("cesta_edit_portes_mv").innerHTML = "<?php echo $vprecioF; ?>";
    document.getElementById("cesta_edit_total_mv").innerHTML = "<?php echo $totalF; ?>";
</script>

<?php
    if ($iva != 0)
    {
        ?>

        <script type="text/javascript">
            document.getElementById("cesta_edit_iva").innerHTML = "<?php echo $ivaF; ?>";
            document.getElementById("cesta_edit_iva_mv").innerHTML = "<?php echo $ivaF; ?>";
        </script>

        <?php
    }  
?>

<?php
    if ($recargo != 0)
    {
        ?>

        <script type="text/javascript">
            document.getElementById("cesta_edit_rec").innerHTML = "<?php echo $recargoF; ?>";
            document.getElementById("cesta_edit_rec_mv").innerHTML = "<?php echo $recargoF; ?>";
        </script>

        <?php
    }  
?>
    
    
</script>