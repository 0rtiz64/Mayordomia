<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 28/11/2018
 * Time: 2:39 PM
 */
include '../gold/enlace.php';
$idEquipo = $_POST["phpIdEquipo"];
$cantidad = $_POST["phpCantidad"];

$query = mysqli_query($enlace,"SELECT COUNT(*) as C from graduacion WHERE devuelta = 2 AND idEquipo = $idEquipo");
$datos =mysqli_fetch_array($query,MYSQLI_ASSOC);
$C=$datos["C"];
echo  $C;