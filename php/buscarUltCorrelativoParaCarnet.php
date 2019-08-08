<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 11/1/2018
 * Time: 11:53 AM
 */
include '../gold/enlace.php';

$identidad=$_POST["phpIdentidad"];

$queryId=mysqli_query($enlace,"select  idintegrante,correlativo,cel,tel,num_identidad from integrantes
WHERE num_identidad = '".$identidad."'");

$datoId = mysqli_fetch_array($queryId,MYSQLI_ASSOC);

//echo  $datoId["idintegrante"];
$datos = array(
    0 => $datoId["correlativo"],
    1 => $datoId["idintegrante"],
    2 => $datoId["cel"],
    3 => $datoId["tel"],
    4 => $datoId["num_identidad"]

);
echo json_encode($datos);

//echo'<input id="numeroExpedienteRegistrar" type="text" class="form-control" value=" '.$datoId["idintegrante"].'" readonly="readonly">';

?>