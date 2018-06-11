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


);
echo json_encode($datos);

?>