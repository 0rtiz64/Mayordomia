<?php
/**
 * Created by PhpStorm.
 * User: Mayor
 * Date: 7/1/2019
 * Time: 9:00 AM
 */


include '../gold/enlace.php';

$identidad=$_POST["phpIdentidad"];

$queryId=mysqli_query($enlace,"select  idintegrante from integrantes
WHERE num_identidad = '".$identidad."'");

$datoId = mysqli_fetch_array($queryId,MYSQLI_ASSOC);

echo  $datoId["idintegrante"];
//echo'<input id="numeroExpedienteRegistrar" type="text" class="form-control" value=" '.$datoId["idintegrante"].'" readonly="readonly">';

?>