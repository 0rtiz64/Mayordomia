<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 5/4/2018
 * Time: 8:39 AM
 */

include '../gold/enlace.php';
$idEquipo = $_POST["phpidEquipo"];
$fechaentrada = date('Y-m-d ');
$rawdata = array();
$i=0;
$query = mysqli_query($enlace,"select integrantes.nombre_integrante,integrantes.cel,integrantes.correlativo,integrantes.num_identidad,integrantes.idintegrante,promociones.desc_promocion,
equipos.num_equipo,equipos.nombre_equipo from detalle_integrantes 
INNER JOIN integrantes ON detalle_integrantes.id_integrante = integrantes.idintegrante
INNER JOIN equipos ON detalle_integrantes.id_equipo = equipos.id_equipo
INNER JOIN promociones ON detalle_integrantes.id_promocion = promociones.idpromocion
WHERE detalle_integrantes.`status`=1 AND detalle_integrantes.id_equipo = $idEquipo and detalle_integrantes.id_cargo=10    GROUP BY integrantes.nombre_integrante ASC");
//and CAST(detalle_integrantes.fecha_registro AS DATE)= '.$fechaentrada.'
/*
$queryCantidad = mysqli_query($enlace,"select COUNT(integrantes.nombre_integrante) AS Cantidad from detalle_integrantes
INNER JOIN integrantes ON detalle_integrantes.id_integrante = integrantes.idintegrante
INNER JOIN equipos ON detalle_integrantes.id_equipo = equipos.id_equipo
WHERE detalle_integrantes.id_equipo = $idEquipo ");
$datosCantidad= mysqli_fetch_array($queryCantidad,MYSQLI_ASSOC);
$cantidad = $datosCantidad["Cantidad"];
*/

while ($datosQuery = mysqli_fetch_array($query)){

    $rawdata[$i]= $datosQuery;
    $i++;

}
sort($rawdata,SORT_REGULAR);
echo json_encode($rawdata);


?>