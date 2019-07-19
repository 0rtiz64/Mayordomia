<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 16/7/2019
 * Time: 10:49 AM
 */
include  '../gold/enlace.php';

$numPromo = $_POST["phpPromocion"];
$identidad= $_POST["phpIdentidad"];

$confirm = mysqli_num_rows(mysqli_query($enlace,"SELECT integrantes.correlativo FROM integrantes
INNER JOIN detalle_integrantes on integrantes.idintegrante = integrantes.idintegrante
INNER JOIN promociones on detalle_integrantes.id_promocion = promociones.idpromocion
WHERE integrantes.num_identidad = '".$identidad."' and promociones.num_promocion = '".$numPromo."'  GROUP BY integrantes.correlativo"));

if($confirm >0){
    $query = mysqli_query($enlace,"SELECT integrantes.correlativo FROM integrantes
INNER JOIN detalle_integrantes on integrantes.idintegrante = integrantes.idintegrante
INNER JOIN promociones on detalle_integrantes.id_promocion = promociones.idpromocion
WHERE integrantes.num_identidad = '".$identidad."' and promociones.num_promocion = '".$numPromo."'  GROUP BY integrantes.correlativo");

$datos = mysqli_fetch_array($query,MYSQLI_ASSOC);
$correlativo = $datos["correlativo"];
echo $correlativo;
}else{
    echo 0;
}
?>