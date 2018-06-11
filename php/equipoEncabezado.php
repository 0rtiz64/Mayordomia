<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 22/5/2018
 * Time: 3:32 PM
 */




include '../gold/enlace.php';
$idEquipo = $_POST["phpidEquipo"];
$fechaentrada = date('Y-m-d ');

$query = mysqli_query($enlace,"SELECT * from equipos 
INNER JOIN promociones on equipos.id_promocion = promociones.idpromocion
WHERE  id_equipo= $idEquipo");

$rows = mysqli_fetch_array($query,MYSQLI_ASSOC);
$datos = array(
    0 => $rows['desc_promocion'],
   1 => $rows['num_equipo'],
    2 => $rows['nombre_equipo'],

);
echo json_encode($datos);



?>