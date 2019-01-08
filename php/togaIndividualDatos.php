<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 9/11/2018
 * Time: 8:47 AM
 */
include '../gold/enlace.php';
$idIntegrante = $_POST["phpidIntegrante"];

$query = mysqli_query($enlace ,"SELECT equipos.num_equipo,promociones.desc_promocion from detalle_integrantes
INNER JOIN equipos on detalle_integrantes.id_equipo = equipos.id_equipo
INNER JOIN promociones on detalle_integrantes.id_promocion = promociones.idpromocion
WHERE detalle_integrantes.id_integrante = $idIntegrante and promociones.`status` = 1");
$datos =mysqli_fetch_array($query,MYSQLI_ASSOC);
$numEquipo = $datos["num_equipo"];
$promocion= $datos["desc_promocion"];


$datos = array(
    0 => $numEquipo,
    1 => $promocion,
);
echo json_encode($datos);
?>