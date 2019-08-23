<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 20/8/2019
 * Time: 4:14 PM
 */
include '../gold/enlace.php';
$idIntegrante = $_POST["phpIdIntegrante"];
$nuevaTalla = $_POST["phpNuevaTalla"];

$query = mysqli_query($enlace,"UPDATE detalle_integrantes 
INNER JOIN promociones on detalle_integrantes.id_promocion = promociones.idpromocion
SET detalle_integrantes.tallaToga = '".$nuevaTalla."'
WHERE promociones.`status`=1 and detalle_integrantes.id_integrante = $idIntegrante");
echo "GUARDADO";
?>