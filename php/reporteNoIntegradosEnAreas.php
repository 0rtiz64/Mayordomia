<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 14/11/2018
 * Time: 4:18 PM
 */
include "../gold/enlace.php";
$dato = $_POST["dato"];

$queryNoIntegrados = mysqli_query($enlace,"SELECT integrantes.correlativo,integrantes.nombre_integrante,integrantes.cel,equipos.num_equipo,equipos.nombre_equipo from detalle_integrantes 
INNER JOIN promociones on detalle_integrantes.id_promocion = promociones.idpromocion
INNER JOIN integrantes on detalle_integrantes.id_integrante = integrantes.idintegrante
INNER JOIN equipos on detalle_integrantes.id_equipo = equipos.id_equipo
WHERE promociones.`status` = 1 and detalle_integrantes.id_cargo = 10 ORDER BY equipos.num_equipo ASC");
$c =1;
echo'<a href="php/pdfNoIntegradosAreas.php" target="_blank" class="btn btn-danger" style="color: white">PDF </a>';
echo'<a href="php/EXCELNoIntegradosAreas.php" class="btn btn-success" style="color: white; float: right">EXCEL </a>';
echo'<table class="table table-bordered">';
echo'<thead>';
echo'<tr>';
echo'<th>#</th>';
echo'<th>CORRELATIVO</th>';
echo'<th>OVEJA</th>';
echo'<th>TELEFONO</th>';
echo'<th>EQUIPO</th>';
echo'</tr>';

echo'</thead>';
echo'<tbody>';

while ($datos = mysqli_fetch_array($queryNoIntegrados,MYSQLI_ASSOC)){

    echo'<tr>';
    echo'<td>'.$c.'</td>';
    echo'<td>'.$datos["correlativo"].'</td>';
    echo'<td>'.$datos["nombre_integrante"].'</td>';
    echo'<td>'.$datos["cel"].'</td>';
    echo'<td>'.$datos["num_equipo"].'- '.$datos["nombre_equipo"].'</td>';
    echo'</tr>';

    $c++;
}

echo'</tbody>';
echo'</table>';
?>