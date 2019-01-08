<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 5/4/2018
 * Time: 10:34 AM
 */

include "../gold/enlace.php";
$order = $_POST["order"];
$idEquipo = $_POST["idEquipo"];
$column_name =$_POST["column_name"];

if($order == 'desc'){
    $order ='asc';
}else{
    $order ='desc';
}



$query = mysqli_query($enlace,"select * from detalle_integrantes 
INNER JOIN integrantes ON detalle_integrantes.id_integrante = integrantes.idintegrante
INNER JOIN equipos ON detalle_integrantes.id_equipo = equipos.id_equipo
WHERE detalle_integrantes.id_equipo = $idEquipo and detalle_integrantes.id_cargo=10 and detalle_integrantes.`status` = 1 ORDER BY $column_name $order ");

$equipoNombreQuery = mysqli_query($enlace,"SELECT * from equipos where id_equipo =$idEquipo");
$datosEquipoNombre = mysqli_fetch_array($equipoNombreQuery,MYSQLI_ASSOC);


echo ' <table class="table table-bordered" id="tablaRegistrosIntegrantes">';
echo  '<thead>';
echo '<tr>';
echo '<td style="text-align: center" colspan="4s">'.$datosEquipoNombre["num_equipo"].'-'.$datosEquipoNombre["nombre_equipo"].' </td>';
echo '</tr>';
echo '<tr>';

echo  '<td>#</td>';
echo  '<td><a class="column_sort" id="nombre_integrante" data-order="'.$order.'" href="#"> Nombre </a></td>';
echo '<td><a class="column_sort" id="num_identidad" data-order ="'.$order.'" href="#">Identidad</a></td>';
echo '<td><a class="column_sort" id="correlativo" data-order="'.$order.'"ref="#">Expediente</a></td>';

echo '</tr>';

echo '</thead';
echo '<tbody>';


$contador = 1;
while ($datos = mysqli_fetch_array($query,MYSQLI_ASSOC)){

    echo'<tr>';
    echo '<td>'.$contador.'</td>';
    echo '<td>'.$datos["nombre_integrante"].'</td>';
    echo '<td>'.$datos["num_identidad"].'</td>';
    echo '<td>'.$datos["correlativo"].'</td>';

    echo'</tr>';

    $contador++;
}
echo '</tbody>';
echo '</table>';
?>