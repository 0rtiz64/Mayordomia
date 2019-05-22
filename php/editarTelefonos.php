<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 21/5/2019
 * Time: 3:18 PM
 */
include  '../gold/enlace.php';
$tag = $_POST["phpTag"];

$queryCorrPromocion = mysqli_query($enlace,"SELECT * from promociones where `status` =1");
$datosCorrPromocion = mysqli_fetch_array($queryCorrPromocion,MYSQLI_ASSOC);
$corrPromocion = $datosCorrPromocion["correlativo"];
$query ="SELECT * from integrantes WHERE idintegrante =$tag and correlativo >$corrPromocion";

$confirmar = mysqli_num_rows(mysqli_query($enlace,$query));

if($confirmar>0){
    $queryConsultar = mysqli_query($enlace,$query);
    $datosConsultados= mysqli_fetch_array($queryConsultar,MYSQLI_ASSOC);
    $nombre = $datosConsultados["nombre_integrante"];
    $tel1= $datosConsultados["cel"];
    $tel2 = $datosConsultados["tel"];
    $idIntegrante= $datosConsultados["idintegrante"];


    $datos = array(
        0 => $nombre,
        1 => $tel1,
        2 => $tel2,
        3 => $idIntegrante,
        4 => 1,

    );
    echo json_encode($datos);
}else{
    $datos = array(
        0 => 0,
        1 => 0,
        2 => 0,
        3 => 0,
        4 => 0,

    );
    echo json_encode($datos);
}
?>