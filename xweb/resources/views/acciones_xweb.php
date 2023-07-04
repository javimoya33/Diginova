<?php
$conexionXweb = mysqli_connect("37.59.92.40", "user_xweb4", "qiW_p3", "diginova", "3306") or die("error de conexion Diginova");
mysqli_query($conexionXweb, "SET NAMES 'utf8'");

$accion = $_POST['accion'];

if ($accion == 1)
{
	$ref_ticket = $_POST['ref_ticket'];

    $sql = "UPDATE rma_ticket
            SET estado = 1
            WHERE ref_ticket = '$ref_ticket';";
    $res = mysqli_query($conexionXweb, $sql) or die("Se ha producido un error al actualizar el estado del ticket");
}

mysqli_close($conexionXweb);
?>