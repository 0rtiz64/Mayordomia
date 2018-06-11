<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 8/2/2018
 * Time: 4:58 PM
 */

require '../gold/enlace.php';

$queryLid = mysqli_query($enlace,"SELECT integrantes.nombre_integrante,cargos.nombre_cargo,detalle_integrantes.id_integrante,detalle_integrantes.id_cargo from detalle_integrantes 
INNER JOIN  integrantes ON detalle_integrantes.id_integrante = integrantes.idintegrante
INNER JOIN cargos ON detalle_integrantes.id_cargo = cargos.idcargo
where detalle_integrantes.id_cargo <> 9 and detalle_integrantes.id_cargo <>10  and detalle_integrantes.id_promocion = 1");

while ($rows= mysqli_fetch_array($queryLid,MYSQLI_ASSOC)){
    $queryInsertar = mysqli_query($enlace,"insert into detalle_integrantes (id_integrante,id_promocion,id_equipo,id_cargo,status,fecha_registro) 
values (".$rows["id_integrante"].",2,39,".$rows["id_cargo"].",1,'2018-02-08 06:00:00')");
}


if (mysqli_affected_rows($enlace)>0) {

    echo "<strong> LIDERAZGO ENLAZADOS</strong>";
    /*
    echo "<script>";
   echo "recargarNumeroExpediente(".$Id.");";
   echo "</script>";*/
}

else{
    echo mysqli_error($enlace);
}
mysqli_close($enlace);