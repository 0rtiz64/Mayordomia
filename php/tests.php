<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 31/8/2018
 * Time: 11:21 AM
 */
include  '../gold/enlace.php';


$queryNoIntegrados = mysqli_query($enlace,"Select * From integrantes where Not integrantes.idintegrante In 
(Select detalle_integrantes.id_integrante From detalle_integrantes WHERE detalle_integrantes.id_promocion = 3)	 AND	 integrantes.correlativo LIKE '%1802%'
GROUP BY integrantes.nombre_integrante ASC");

while ($datos = mysqli_fetch_array($queryNoIntegrados,MYSQLI_ASSOC)){
    $IdIntegrante = $datos["idintegrante"];
    $verificarMarcacion = mysqli_num_rows(mysqli_query($enlace,"SELECT * FROM marcacionprovicional WHERE  marcacionprovicional.idIntegrante = $IdIntegrante AND  CAST(fechaMarcacion AS DATE) = '2018-08-25' "));
        if($verificarMarcacion >0){
            echo  $datos["num_identidad"] ."-". $datos["nombre_integrante"] .'<br>';
        }else{

        }

}