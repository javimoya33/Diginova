<?php

if (count($resultados) == 0)
{
    ?>

    <div class="devolArticulosTR">
        <div class="devolArticulosTD devolArticulosTDDesc" style="text-align: center;
    padding-top: 50px;
    color: #0b2e48;
    font-weight: bold;">
            La búsqueda no produjo resultados
        </div>
    </div>

    <?php
}


foreach ($resultados as $articulo) 
{
        if (!is_array(@getimagesize($articulo->urlfoto))) 
        {
            //$articulo->urlfoto = "https://diginova.es/xweb3/fotoartic/nofoto2tmp.jpg";
            $articulo->urlfoto = "https://diginova.es/xweb/public/articulos/nofoto.jpg";
        }

    ?>

        <div class="devolArticulosTR">
            <div class="devolArticulosTD devolArticulosTDImg">
                <img title="<?php echo $articulo->adescr; ?>" src="<?php echo $articulo->urlfoto; ?>" width="100" />
            </div>

            <div class="devolArticulosTD devolArticulosTDDesc">
                <span style="font-weight: bold; text-transform: uppercase;"><?php echo $articulo->adescr; ?></span>
                <br /><br />
                <div class="devoArtCodsT">
                    <div class="devoArtCodsTD">
                        <b>Ref.:</b> <span style="color: #5d7ea4; font-weight: bold;"><?php echo $articulo->acodar; ?></span>
                    </div>
                    <div class="devoArtCodsTD">
                        <b>N&ordm; Serie:</b> <span style="color: #5d7ea4; font-weight: bold;"><?php echo $articulo->nnumser; ?></span>
                    </div>
                </div>

                <div class="devoArtCodsT" style="padding-top: 5px;">
                    <div class="devoArtCodsTD">
                        <b>Fecha de compra:</b> <span style="color: #5d7ea4; font-weight: bold;"><?php echo $articulo->fechaF; ?></span>
                    </div>
                    <div class="devoArtCodsTD">
                        <b>N&ordm; Factura:</b> <span style="color: #5d7ea4; font-weight: bold;"><?php echo $articulo->fdocF; ?></span>
                    </div>
                </div>
            </div>

            <div class="devolArticulosTD devolArticulosTDOpc1">
                <a href="/xweb/devolucionnofunciona/<?php echo base64_encode(serialize($articulo)); ?>" class="devolButton">NO FUNCIONA >></a>
            </div>

            <div class="devolArticulosTD devolArticulosTDOpc2">
                <?php
                if ($articulo->nolohevendido)                
                {
                    ?>

                    <a href="/xweb/devolucionnovendido/<?php echo base64_encode(serialize($articulo)); ?>" class="devolButton">NO LO HE VENDIDO >></a>

                    <?php
                }
                ?>
            </div>
        </div>

    <?php
}

?>
