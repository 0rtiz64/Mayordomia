<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 19/2/2018
 * Time: 1:34 PM
 */
include '../gold/enlace.php';
$idIntegrante= $_POST['nombrePersona'];

$queryPromocionActiva = mysqli_query($enlace,"SELECT * from promociones where promociones.`status`=1");
$datosPromocionActiva = mysqli_fetch_array($queryPromocionActiva,MYSQLI_ASSOC);
$promoActiva = $datosPromocionActiva["idpromocion"];
$promoActiva2 = $datosPromocionActiva["desc_promocion"];



$verificar = mysqli_num_rows( mysqli_query($enlace, "SELECT integrantes.nombre_integrante, equipos.num_equipo,equipos.nombre_equipo,integrantes.idintegrante from detalle_integrantes
INNER JOIN integrantes ON detalle_integrantes.id_integrante = integrantes.idintegrante
INNER JOIN equipos ON detalle_integrantes.id_equipo = equipos.id_equipo
where detalle_integrantes.id_integrante = $idIntegrante  and detalle_integrantes.id_promocion = $promoActiva "));


if($verificar>0){
    $query = mysqli_query($enlace, "SELECT integrantes.nombre_integrante, equipos.num_equipo,equipos.nombre_equipo,integrantes.idintegrante from detalle_integrantes
INNER JOIN integrantes ON detalle_integrantes.id_integrante = integrantes.idintegrante
INNER JOIN equipos ON detalle_integrantes.id_equipo = equipos.id_equipo
where detalle_integrantes.id_integrante = $idIntegrante  and detalle_integrantes.id_promocion = $promoActiva ");

    $rows=  mysqli_fetch_array($query,MYSQLI_ASSOC);

    $datos = array(
        0 => utf8_encode($rows['nombre_integrante']),
        1 => $rows['num_equipo'],
        2 => $rows['nombre_equipo'],
        3 => $rows['idintegrante'],
        4 => 1,
        5 => $promoActiva2,
    );
    echo json_encode($datos);
}else{
    $datos = array(
        0 => 0,
        1 => 1,
        2 => 2,
        3 => 3,
        4 => 0,
        5 => $promoActiva2,
    );
    echo json_encode($datos);
}




?>