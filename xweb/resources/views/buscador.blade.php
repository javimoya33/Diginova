<?php
if (count($arrResultados) > 0)
{
// Mostrar icono de teclado en castellano o portugués
    $tecladoPortu = false;

    if ( isset($zonaCliente) )
    {
        if ($zonaCliente == 80)
        {
            $tecladoPortu = true;
        }
    }

    ?>
    <div class="buscador_desplegable busqnocerrar">
        <div class="busqcerrar"><span class="busqcerrarX" onclick="cerrarVentanaBusqueda()">X</span></div>
        <div class="busqArticulos">
            <?php
            foreach ($arrResultados as $arrResultado) 
            {
                // Foto del artículo
                $artFoto = "nofoto.jpg";

                if (isset($arrResultado["urlfoto"]))
                {
                    $artFoto = $arrResultado["urlfoto"];
                }

                $urlfoto = "https://diginova.es/xweb/public/articulos/".$artFoto;


                if (!is_array(@getimagesize($urlfoto))) 
                {
                    $artFoto = "nofoto.jpg";
                    $urlfoto = "/xweb/public/articulos/".$artFoto;
                }

                if ($ccodcl > 0)
                {
                    ?>
                    <div class="celdaArt celdaArtFav celdaArtFavBusq celdaBusq" style="margin-bottom: 75px; height: 438px; border-bottom: none">
                    <?php
                }
                else
                {
                    ?>
                    <div class="celdaArt celdaArtFav celdaArtFavBusq celdaBusq" style="margin-bottom: 75px; height: 290px; border-bottom: none">
                    <?php 
                }
                ?>

                    <?php
                    if ($ccodcl > 0)
                    {
                        ?>
                        <div class="celdaFav" id="celdaFav<?php echo $arrResultado['ACODAR'] ?>" style="visibility: visible; display: block; float: left; padding-top: 2px; padding-right: 5px;">
                            <?php
                            if ($arrResultado['tieneTeclado'])
                            {
                                ?>
                                <div class="celdaFavT">             
                                    <img class="celdaFavIcon" id="celdaFavIcon<?php echo $arrResultado['ACODAR'] ?>" title="Idioma de teclado personalizable" src="/xweb/public/images/teclado_personalizable.png" style="width: 30px; margin-top: 2px;" /> 
                                </div>

                                <div id="celdaBandera" class="celdaBandera">
                                    <?php 
                                        if ( !$tecladoPortu )
                                        {
                                            ?>

                                            <img title="Idioma de teclado español" src="/xweb/public/images/banderaespana.png" />

                                            <?php
                                        }

                                        if ( $tecladoPortu )
                                        {
                                            ?>

                                            <img title="Idioma de teclado portugués" src="/xweb/public/images/banderaportugal.png" />

                                            <?php
                                        }
                                    ?>
                                    
                                </div>
                                
                                <?php
                            }
                            ?>
                        </div>
                           
                        <div class="celdaFav" id="celdaFav<?php echo $arrResultado['ACODAR'] ?>">  
                            <div class="celdaFavT">             
                                <img class="celdaFavIcon" id="celdaFavIcon<?php echo $arrResultado['ACODAR'] ?>" title="" src="<?php echo $arrResultado['favRuta'] ?>"   
                                    onclick="favorito();" /> 
                            </div>
                            <div class="celdaFavT celdaFavT2" id="celdaFavGuardado<?php echo $arrResultado['ACODAR'] ?>"></div>
                        </div>
                        <?php
                    }
                    ?>

                    <div class="celdaFot">
                        <table border="0">
                            <tr>
                                <td style="vertical-align: middle;">
                                    <a href="/xweb/articulo/<?php echo $arrResultado['ACODAR'] ?>">
                                        <img style="max-height: 150px; max-width: 150px;" src="<?php echo $urlfoto; ?>"  border="0" alt="Art. <?php echo $arrResultado['ADESCR'] ?>" title="<?php echo utf8_decode($arrResultado['ADESCR']); ?>"/>
                                    </a>
                                </td>
                            </tr>
                        </table>
                    </div>

                    <div class="celdaTipo celda_<?php echo $arrResultado['tipo']; ?>">
                        &nbsp;
                    </div>

                    <div class="celdaDesc">
                        <a href="/xweb/articulo/<?php echo $arrResultado['ACODAR'] ?>" 
                            title="<?php echo utf8_decode($arrResultado['ADESCR']); ?>" >
                            <?php echo utf8_decode($arrResultado['descrip']); ?>
                        </a>
                    </div>

                    <?php
                    if ($ccodcl < 1)
                    {
                        ?>
                        <div class="celdaAniadir">
                            <a href="/xweb/articulo/<?php echo $arrResultado['ACODAR']; ?>">Ver art&iacute;culo ></a>
                        </div>
                        <?php
                    }
                    else
                    {
                        if($arrResultado['esAmpliable'])
                        {
                            ?>
                            <div class="div_desde div_ampliable">Ampliable</div>
                            <?php
                        }
                        ?>
                        <div class="celdaPrecio"><?php echo $arrResultado['precio']; ?>€</div>

                        <div class="celdaInv">
                            <div class="celdaCantStock">
                                <div class="celdaCant">
                                    Cantidad:<br />
                                    <div class="celdaTabCant" style="margin-top: 6px">
                                        <div>
                                            <img alt="-" src="/xweb/public/images/artmenosoff.png" id="menos<?php echo $arrResultado['ACODAR'] ?>"
                                                name="menosCantidad" onclick="celdaCantBajar('<?php echo $arrResultado['ACODAR'] ?>')" />
                                        </div>
                                        <div>
                                            <input type="text" disabled id="cant<?php echo $arrResultado['ACODAR'] ?>" value="1" style="border: none;" />
                                        </div>
                                        <div>
                                            <img alt="+" src="/xweb/public/images/artmason.png" id="mas<?php echo $arrResultado['ACODAR'] ?>" 
                                                name="masCantidad" onclick='celdaCantSubir("<?php echo $arrResultado['ACODAR'] ?>", 
                                                <?php echo $arrResultado['numASTOCK'] ?>)' />
                                        </div>
                                    </div>
                                </div>
                                <div class="celdaStock">
                                    Stock:
                                    <br />
                                    <div style="padding-top: 10px;"><?php echo $arrResultado['ASTOCK'] ?></div>
                                </div>
                            </div>
                            <div class="divMensajeRecibelo"><?php echo $arrResultado['mensajeRecibelo'] ?></div>

                            <?php
                            if ($arrResultado['numASTOCK'] == 0)
                            {
                                ?>
                                <div class="celdaAniadir">
                                    <a href="/xweb/articulo/<?php echo $arrResultado['ACODAR'] ?>">Ver artículo ></a>
                                </div>
                                <?php
                            }
                            else
                            {
                                ?>
                                <div id="cestaAdd<?php echo $arrResultado['ACODAR'] ?>" class="celdaAniadir pointer" onclick="addArticulo('<?php echo $arrResultado['ACODAR'] ?>', document.getElementById('cant<?php echo $arrResultado['ACODAR'] ?>').value,'{{URL::to('addArticulo')}}',
                                        '#cestaAdd<?php echo $arrResultado['ACODAR'] ?>');">Añadir</div>
                                <?php
                            }
                            ?>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
    <?php
}
else
{
    ?>
    <div class="busqNoRes">
        <div class="busqcerrar"><span class="busqcerrarX" onclick="cerrarVentanaBusqueda()">X</span></div>
        <div style="text-align: center; font-size: 12pt;">No se encontraron resultados</div>
    </div>
    <?php
}


?>

<script type="text/javascript">
    function cerrarVentanaBusqueda()
    {
        $('#suggestionsBusq').css('display', 'none');
        $('#suggestionsBusqMv').css('display', 'none');
    }
</script>
