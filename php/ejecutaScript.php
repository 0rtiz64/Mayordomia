<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 8/2/2018
 * Time: 4:58 PM
 */

require '../gold/enlace.php';

$queryPast = mysqli_query($enlace,"SELECT detalle_integrantes.id_integrante from detalle_integrantes 
where detalle_integrantes.id_cargo = 9 and detalle_integrantes.id_promocion = 1");

while ($rows= mysqli_fetch_array($queryPast,MYSQLI_ASSOC)){
    $queryInsertar = mysqli_query($enlace,"insert into detalle_integrantes (id_integrante,id_promocion,id_equipo,id_cargo,status,fecha_registro) 
values (".$rows['id_integrante'].",2,40,9,1,'2018-02-08 05:15:00')");
}


if (mysqli_affected_rows($enlace)>0) {

    echo "<strong> PASTOREADORES ENLAZADOS</strong>";
    /*
    echo "<script>";
   echo "recargarNumeroExpediente(".$Id.");";
   echo "</script>";*/
}

else{
    echo mysqli_error($enlace);
}
mysqli_close($enlace);