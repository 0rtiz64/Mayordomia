<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 10/4/2018
 * Time: 8:40 AM
 */
include '../gold/enlace.php';

$tag = $_POST["phpId"];

$query = mysqli_query($enlace,"select * from integrantes where idintegrante = $tag");
$datos = mysqli_fetch_array($query,MYSQLI_ASSOC);

echo  $datos["idintegrante"];
?>