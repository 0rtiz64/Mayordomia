<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 8/11/2018
 * Time: 9:35 AM
 */
include '../gold/enlace.php';
$idEquipo = $_POST["phpidEquipo"];
$rawdata = array();
$i=0;

$query = mysqli_query($enlace, "SELECT integrantes.idintegrante,equipos.num_equipo from equipos
INNER JOIN promociones on equipos.id_promocion = promociones.idpromocion
INNER JOIN detalle_integrantes on equipos.id_equipo = detalle_integrantes.id_equipo
INNER JOIN integrantes on detalle_integrantes.id_integrante = integrantes.idintegrante
WHERE promociones.`status` = 1 and detalle_integrantes.id_equipo = '.$idEquipo.' and detalle_integrantes.`status` =1 and detalle_integrantes.toga = 1 and detalle_integrantes.id_cargo = 10 GROUP BY integrantes.nombre_integrante ASC");

while ($datosQuery = mysqli_fetch_array($query)){

    $rawdata[$i]= $datosQuery;
    $i++;

}
sort($rawdata,SORT_REGULAR);
echo json_encode($rawdata);
?>

