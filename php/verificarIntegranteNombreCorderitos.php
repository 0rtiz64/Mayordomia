<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 10/12/2018
 * Time: 10:27 AM
 */



include '../gold/enlace.php';

$nombre=$_POST["phpNombre"];


$query = "SELECT * FROM corderitos where  nombre = '".$nombre."'";

$consultar = mysqli_num_rows(mysqli_query($enlace,$query));

if($consultar>0){
    $q = mysqli_query($enlace,$query);
    $d = mysqli_fetch_array($q,MYSQLI_ASSOC);
    $identidad = $d["identidad"];
    $nombre= $d["nombre"];
    $promocion = $d["promocion"];
    $bautizado = $d["bautizado"];
    $datos = array(
        0 => $identidad,
        1 => $nombre,
        2 => $promocion,
        3 => $bautizado,
    );
    echo json_encode($datos);
}
?>