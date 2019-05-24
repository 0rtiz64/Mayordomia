<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 12/11/2018
 * Time: 10:30 AM
 */

include  '../gold/enlace.php';
$dato = $_POST["phpDato"];
$c = 1;




$totalIntegradosQuery = mysqli_query($enlace,"SELECT * from integracion 
INNER JOIN promociones on integracion.idPromocion =  promociones.idpromocion
WHERE promociones.`status` = 1 GROUP BY idIntegrante");
$cIntegrados =0;
while ($totalIntegradosDatos = mysqli_fetch_array($totalIntegradosQuery,MYSQLI_ASSOC)){
    $cIntegrados++;
}

echo'<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">';
echo'<div class="progress progress-striped active">';
echo'<div class="progress-bar progress-bar-primary" style="width: 100%">'.$cIntegrados.' INTEGRADOS EN PROMOCION</div>';
echo'</div>';
echo'</div>';

$totalIntegracionesQuery = mysqli_query($enlace,"SELECT COUNT(*) as integraciones from integracion
INNER JOIN promociones on integracion.idPromocion = promociones.idpromocion
WHERE promociones.`status` = 1");
$totalIntegracionesDatos = mysqli_fetch_array($totalIntegracionesQuery,MYSQLI_ASSOC);
echo'<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">';
    echo'<div class="progress progress-striped active">';
        echo'<div class="progress-bar progress-bar-info" style="width: 100%">'.$totalIntegracionesDatos["integraciones"].' INTEGRACIONES EN PROMOCION</div>';
    echo'</div>';
echo'</div>';





echo'<table class="table table-bordered">';
echo'<thead>';
echo'<tr align="center">';
echo'<td><strong>AREA</strong></td>';
echo'<td><strong>PROMOCION</strong></td>';
echo'<td><strong>MANUAL</strong></td>';
echo'</tr>';

echo'</thead>';
echo'<tbody>';



$queryAreas = mysqli_query($enlace,"SELECT * from areas GROUP BY Nombre ASC");
while($areas = mysqli_fetch_array($queryAreas,MYSQLI_ASSOC)){
    $idArea = $areas["idArea"];
$nombreArea = $areas["Nombre"];





    $contadorPorArea = mysqli_query($enlace,"SELECT COUNT(*) as C from integracion
INNER JOIN promociones on integracion.idPromocion = promociones.idpromocion
WHERE integracion.idArea = $idArea and promociones.`status` = 1");

    $datosContadorPorArea = mysqli_fetch_array($contadorPorArea,MYSQLI_ASSOC);

    $cantidad = $datosContadorPorArea["C"];

    $cantidadManualQuery = mysqli_query($enlace,"SELECT COUNT(*) as CM from integracionindividual
INNER JOIN promociones on integracionindividual.idPromocion= promociones.idpromocion
WHERE integracionindividual.idArea= $idArea and promociones.`status` = 1");
    $datosContadorPorAreaManual = mysqli_fetch_array($cantidadManualQuery,MYSQLI_ASSOC);
    $cantidadManual = $datosContadorPorAreaManual["CM"];



    $clasBadge = "badge badge-info animated";
                echo'<tr align="center">';
                    echo'<td>'.$nombreArea.'</td>';
                    echo'<td><span class="'.$clasBadge.'" id="new-messages">'.$cantidad.'</span></td>';
                    echo'<td><span class="badge badge-success animated" id="new-messages">'.$cantidadManual.'</span></td>';
                    echo'</tr>';

$c++;
}
echo'</tbody>';
echo'</table>';
?>