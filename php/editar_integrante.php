<?php 
include '../gold/enlace.php';

$id = $_POST['id'];

$sql = mysqli_query($enlace,"SELECT integrantes.num_identidad,integrantes.nombre_integrante AS Name,integrantes.fecha_cumple,integrantes.cel,integrantes.tel,
detalle_integrantes.`status` AS Estado,promociones.idpromocion,equipos.id_equipo AS Ep,cargos.idcargo,integrantes.direccion,integrantes.estado_civil,integrantes.sexo,integrantes.trasporte
 FROM detalle_integrantes
INNER JOIN integrantes ON detalle_integrantes.id_integrante = integrantes.idintegrante
INNER JOIN promociones ON detalle_integrantes.id_promocion = promociones.idpromocion
INNER JOIN equipos ON detalle_integrantes.id_equipo = equipos.id_equipo
INNER JOIN cargos ON detalle_integrantes.id_cargo = cargos.idcargo
WHERE promociones.`status`=1  AND  integrantes.idintegrante =".$id );

$rows = mysqli_fetch_array($sql,MYSQLI_ASSOC);


if($rows['fecha_cumple'] == ""){
    $fechaCumple = "";
}else{
    $fechaCumple=$rows['fecha_cumple'];
}

if($rows['estado_civil'] ==""){
    $civil = "";
}else{
    $civil=$rows['estado_civil'];
}

$datos = array(
				0 => $rows['num_identidad'], 
				1 => utf8_encode($rows['Name']),
				2 => $fechaCumple,
				3 => $rows['cel'],
				4 => $rows['tel'], 
				5 => $rows['Estado'], 
				6 => $rows['idpromocion'],
				7 => $rows['Ep'],
				8 => $rows['idcargo'],
				9 => $rows['direccion'],
				10 => $civil,
				11 => $rows['sexo'],
				12 => $rows['trasporte'],
				13 => $civil,
				);
echo json_encode($datos);

 ?>