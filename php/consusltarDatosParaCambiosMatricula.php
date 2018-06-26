<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 26/1/2018
 * Time: 2:25 PM
 */

include '../gold/enlace.php';

$idIntegrante = $_POST['idIntegrante'];



$sql = mysqli_query($enlace,"select * from integrantes where idintegrante =".$idIntegrante);
$rows = mysqli_fetch_array($sql,MYSQLI_ASSOC);

$confirmarNinos = mysqli_num_rows(mysqli_query($enlace,"SELECT * from rangos WHERE idIntegrante=$idIntegrante"));

if($confirmarNinos>0){
        $queryNinos = mysqli_query($enlace,"SELECT rangos.idRango,rangos.idIntegrante,rangos.`0-2` as rango1,rangos.`2-3` as rango2,rangos.`4-5` as rango3,
rangos.`6-7` as rango4, rangos.`8-11` as rango5, rangos.otros,rangos.total
 from rangos WHERE idIntegrante=$idIntegrante");
    $datosNinos = mysqli_fetch_array($queryNinos,MYSQLI_ASSOC);

    $rango1 = $datosNinos["rango1"];
    $rango2 = $datosNinos["rango2"];
    $rango3 = $datosNinos["rango3"];
    $rango4 = $datosNinos["rango4"];
    $rango5 = $datosNinos["rango5"];
    $otros = $datosNinos["otros"];
    $total= $datosNinos["total"];

    if ($rango1 ==0){
        $rango1 ="";
    }

    if ($rango2 ==0){
        $rango2 ="";
    }
    if ($rango3 ==0){
        $rango3 ="";
    }

    if ($rango4 ==0){
        $rango4 ="";
    }

    if ($rango5 ==0){
        $rango5="";
    }

    if ($otros ==0){
        $otros="";
    }

    if($total == 0){
        $respuestaNinos= 2;
    }else{
        $respuestaNinos= 1;
    }

}else{
    $rango1 = 0;
    $rango2 = 0;
    $rango3 = 0;
    $rango4 = 0;
    $rango5 = 0;
    $otros = 0;
    $total= 0;
    $respuestaNinos= 2;
}


if($rows["areas"]==""){
    $suAre= 0;
}else{
    $suAre=1;
}


$datos = array(
    0 => $rows['promo_cordero'],
    1 => $rows['num_identidad'],
    2 => $rows['nombre_integrante'],
    3 => $rows['fecha_cumple'],
    4 => $rows['cel'],
    5 => $rows['tel'],
    6 => $rows['estado_civil'],
    7 => $rows['sexo'],
    8 => $rows['trasporte'],
    9 => $rows['direccion'],
    10 => $rows['areas'],
    11 => $rows['apellidoCasada'],
    12 => $idIntegrante,
    13 => $suAre,
    14 => $rows["documentosRespuesta"],
    15 => $rows["documentosPendientes"],
    16 =>$rango1,
    17 => $rango2,
    18 => $rango3,
    19 => $rango4,
    20 => $rango5,
    21 => $otros,
    22 => $total,
    23 => $respuestaNinos,
);
echo json_encode($datos);

?>