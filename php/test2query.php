<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 4/4/2018
 * Time: 8:56 AM
 */
include '../gold/enlace.php';

$query = mysqli_query($enlace,"select * from equipos WHERE id_promocion =2");
$datos = mysqli_fetch_array($query,MYSQLI_ASSOC);

$contador = 1;
while ($datos = mysqli_fetch_assoc($query)){
    $arreglo["data"][] =$datos;
$contador++;
}

echo json_encode($arreglo);
