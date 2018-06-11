<?php
include '../gold/enlace.php';

$id = $_POST['id'];

$sql = mysqli_query($enlace,"SELECT  integrantes.idintegrante,integrantes.num_identidad,integrantes.nombre_integrante,integrantes.cel,integrantes.tel
 FROM integrantes
WHERE integrantes.idintegrante =".$id );

$rows = mysqli_fetch_array($sql,MYSQLI_ASSOC);


$datos = array(
    0 => $rows['num_identidad'],
    1 => $rows['nombre_integrante'],
    2 => $rows['cel'],
    3 => $rows['tel'],

);
echo json_encode($datos);

?>