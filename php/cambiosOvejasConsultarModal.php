<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 13/12/2018
 * Time: 11:13 AM
 */
include "../gold/enlace.php";
$idIntegrante = $_POST["phpIdIntegrante"];
$enlazado = $_POST["phpEnlazado"];
// ENLAZADO == 1 -> SI ENLAZADO
// ENLAZADO == 2 -> NO ENLAZADO


if($enlazado == 2){
    //NO ESTA ENLAZADO INICIO
    $queryDatosIntegrante = mysqli_query($enlace,"SELECT integrantes.idintegrante,integrantes.num_identidad,integrantes.nombre_integrante,integrantes.fecha_cumple,integrantes.estado_civil,
integrantes.sexo,integrantes.trasporte,integrantes.promo_cordero,integrantes.bautizado,integrantes.documentosRespuesta,integrantes.documentosPendientes,rangos.total as cantidadTotal,
integrantes.cel,integrantes.tel,integrantes.areas,integrantes.registradoPor,integrantes.apellidoCasada,rangos.`0-2` as rango1,
rangos.`2-3` as rango2,rangos.`4-5` as rango3, rangos.`6-7` as rango4,rangos.`8-11` as rango5,rangos.total as rango6, integrantes.documentosPendientes,integrantes.direccion  from integrantes 
INNER JOIN rangos on integrantes.idintegrante = rangos.idIntegrante
WHERE integrantes.idintegrante = $idIntegrante");
    $datosIntegrante = mysqli_fetch_array($queryDatosIntegrante,MYSQLI_ASSOC);

    $identidad= $datosIntegrante["num_identidad"];
    $nombre= $datosIntegrante["nombre_integrante"];
    $fechaNacimiento= $datosIntegrante["fecha_cumple"];
    $civil= $datosIntegrante["estado_civil"];
    $genero= $datosIntegrante["sexo"];
    $transporte= $datosIntegrante["trasporte"];
    $corderitos= $datosIntegrante["promo_cordero"];
    $bautizado= $datosIntegrante["bautizado"];
    $docmentosPendientesRespuesta= $datosIntegrante["documentosRespuesta"];
    $docmentosPendientes= $datosIntegrante["documentosPendientes"];

//VALIDACION RESPUESTA NINOS INICIO//

    if($datosIntegrante["cantidadTotal"] == 0){
        $ninos= 2; //NO
    }else{
        $ninos=1; //SI
    }

//VALIDACION RESPUESTA NINOS FINAL//

    $direccion = $datosIntegrante["direccion"];
    $registradoPor= $datosIntegrante["registradoPor"];
    $apellidoCasada = $datosIntegrante["apellidoCasada"];
    $rango1 = $datosIntegrante["rango1"];
    $rango2 = $datosIntegrante["rango2"];
    $rango3 = $datosIntegrante["rango3"];
    $rango4 = $datosIntegrante["rango4"];
    $rango5 = $datosIntegrante["rango5"];
    $rango6 = $datosIntegrante["rango6"];
    $areas = $datosIntegrante["areas"];

    $datos = array(
        0 => $identidad,
        1 => $nombre,
        2 => $fechaNacimiento,
        3 => $civil,
        4 => $genero,
        5 => $transporte,
        6 => $corderitos,
        7 => $bautizado,
        8 => $docmentosPendientesRespuesta,
        9 => $docmentosPendientes,
        10 => $ninos,
        11 => $direccion,
        12 => $registradoPor,
        13 => $apellidoCasada,
        14 => $rango1,
        15 => $rango2,
        16 => $rango3,
        17 => $rango4,
        18 => $rango5,
        19 => $rango6,
        20 => $areas,

    );
    echo json_encode($datos);

    //NO ESTA ENLAZADO FINAL
}else{
 //ESTA ENLAZADO INICIO
 //ESTA ENLAZADO FINAL
}
?>