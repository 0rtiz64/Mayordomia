<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 16/8/2018
 * Time: 9:49 AM
 */
include "../gold/enlace.php";
$promocionConsultar = 2;
$promocionInsertar = 3;
$fechaentrada = date('Y-m-d  h:i:s');
/*
$queryTomarLiderazgoPromocionAnterior = mysqli_query($enlace,"SELECT integrantes.idintegrante,cargos.idcargo  from detalle_integrantes 
INNER JOIN integrantes ON detalle_integrantes.id_integrante = integrantes.idintegrante
INNER JOIN cargos ON detalle_integrantes.id_cargo = cargos.idcargo
INNER JOIN promociones ON detalle_integrantes.id_promocion = promociones.idpromocion
where id_cargo <> 9 AND detalle_integrantes.id_cargo <> 10 AND id_promocion = $promocionConsultar");
$contador = 1;
while ($arrayLiderazgoAnterior = mysqli_fetch_array($queryTomarLiderazgoPromocionAnterior,MYSQLI_ASSOC)){
    $idIntegrante= $arrayLiderazgoAnterior["idintegrante"];
    $idCargo= $arrayLiderazgoAnterior["idcargo"];
    $queryInsertarEnNuevoEquipoLiderazgo =mysqli_query($enlace,"INSERT INTO detalle_integrantes (id_integrante,id_promocion,id_equipo,id_cargo,`status`,fecha_registro) VALUES (".$idIntegrante.",".$promocionInsertar.",63,".$idCargo.",1,'".$fechaentrada."')");
$contador++;
}

echo $contador." REGISTROS GUARDADOS EN EQUIPO DE LIDERAZGO";
*/
$queryTomarPastoreadoresDePromocionPasada = mysqli_query($enlace,"SELECT integrantes.idintegrante,cargos.idcargo from detalle_integrantes 
INNER JOIN integrantes ON detalle_integrantes.id_integrante = integrantes.idintegrante
INNER JOIN cargos ON detalle_integrantes.id_cargo = cargos.idcargo
INNER JOIN promociones ON detalle_integrantes.id_promocion = promociones.idpromocion
where id_cargo = 9  AND id_promocion = $promocionConsultar GROUP BY integrantes.nombre_integrante ASC
");

$contador2 = 1;
while ($arrayPastoreadoresAnterior = mysqli_fetch_array($queryTomarPastoreadoresDePromocionPasada,MYSQLI_ASSOC)){
    $idIntegranteP= $arrayPastoreadoresAnterior["idintegrante"];
    $idCargoP= $arrayPastoreadoresAnterior["idcargo"];
    $queryInsertarEnNuevoEquipoPastoreadores =mysqli_query($enlace,"INSERT INTO pastoreadores (idIntegrante,estado,fechaInicio) VALUES (".$idIntegranteP.",1,'".$fechaentrada."')");
    $contador2++;
}

echo $contador2." REGISTROS GUARDADOS EN EQUIPO DE LIDERAZGO";


