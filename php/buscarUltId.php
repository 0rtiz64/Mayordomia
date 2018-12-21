<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 11/1/2018
 * Time: 11:53 AM
 */
include '../gold/enlace.php';

$identidad=$_POST["phpIdentidad"];

$queryId=mysqli_query($enlace,"select  idServidor from servidores
WHERE num_identidad = '".$identidad."'");

$datoId = mysqli_fetch_array($queryId,MYSQLI_ASSOC);

echo  $datoId["idServidor"];
//echo'<input id="numeroExpedienteRegistrar" type="text" class="form-control" value=" '.$datoId["idintegrante"].'" readonly="readonly">';

?>