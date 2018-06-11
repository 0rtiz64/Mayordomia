<?php
include '../gold/enlace.php';

$id = $_POST['id'];

$sql = mysqli_query($enlace,"SELECT equipos.id_equipo,equipos.num_equipo,equipos.nombre_equipo from equipos
where equipos.id_equipo=".$id);

$rows = mysqli_fetch_array($sql,MYSQLI_ASSOC);


/*
 * IDENTIFICAR SI ES UNO O DOS PASTOREADORES*
$queryPastoreadores = mysqli_query($enlace,"SELECT integrantes.nombre_integrante, detalle_integrantes.id_cargo,equipos.nombre_equipo from detalle_integrantes
INNER JOIN integrantes ON detalle_integrantes.id_integrante = integrantes.idintegrante
INNER JOIN equipos On detalle_integrantes.id_equipo= equipos.id_equipo
WHERE equipos.id_equipo = $id and detalle_integrantes.id_cargo = 9");

$datosPastoreadores= mysqli_fetch_array($queryPastoreadores,MYSQLI_ASSOC);
  */
$datos = array(
    0 => $rows['id_equipo'],
    1 => $rows['num_equipo'],
    2 => $rows['nombre_equipo'],



);
echo json_encode($datos);

?>