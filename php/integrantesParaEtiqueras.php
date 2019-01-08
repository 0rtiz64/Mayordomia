<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 13/2/2018
 * Time: 2:51 PM
 */
include '../gold/enlace.php';
$idEquipo = $_POST["phpidEquipo"];
$fechaentrada = date('Y-m-d ');
$rawdata = array();
$i=0;
$query = mysqli_query($enlace,"select integrantes.nombre_integrante,equipos.num_equipo,equipos.nombre_equipo,integrantes.idintegrante,promociones.desc_promocion from detalle_integrantes 
INNER JOIN integrantes ON detalle_integrantes.id_integrante = integrantes.idintegrante
INNER JOIN equipos ON detalle_integrantes.id_equipo = equipos.id_equipo
INNER JOIN promociones ON detalle_integrantes.id_promocion = promociones.idpromocion
WHERE detalle_integrantes.id_equipo = $idEquipo and detalle_integrantes.id_cargo=10 and CAST(detalle_integrantes.fecha_registro AS DATE)= '".$fechaentrada."' ");
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
echo json_encode($rawdata);


?>