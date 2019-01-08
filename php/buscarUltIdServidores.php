<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 5/7/2018
 * Time: 12:48 PM
 */

include '../gold/enlace.php';

$identidad=$_POST["phpIdentidad"];

$queryId=mysqli_query($enlace,"select  idServidor from servidores
WHERE num_identidad = '".$identidad."'");

$datoId = mysqli_fetch_array($queryId,MYSQLI_ASSOC);

echo  $datoId["idServidor"];
//echo'<input id="numeroExpedienteRegistrar" type="text" class="form-control" value=" '.$datoId["idintegrante"].'" readonly="readonly">';

?>