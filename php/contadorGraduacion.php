<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 14/11/2018
 * Time: 9:37 AM
 */

include  '../gold/enlace.php';
$tag = $_POST["phpTag"];

$queryDetalleIntegrante ="SELECT * from detalle_integrantes 
INNER JOIN promociones on detalle_integrantes.id_promocion = promociones.idpromocion
WHERE promociones.`status` = 1 and detalle_integrantes.id_integrante = $tag";

$confirmar= mysqli_num_rows(mysqli_query($enlace,$queryDetalleIntegrante));

if($confirmar>0){
    $query = mysqli_query($enlace,$queryDetalleIntegrante);
    $datosQuery=mysqli_fetch_array($query,MYSQLI_ASSOC);
    $detalleIntegrante = $datosQuery["idetalle_integrantes"];

    $queryGraduacion = "SELECT * from graduacion WHERE idIntegrante = $tag";
    $confirmarLeido = mysqli_num_rows(mysqli_query($enlace,$queryGraduacion));

    if($confirmarLeido>0){
        echo 2; // YA LEIDO
    }else{

        $detalleEquipo = mysqli_query($enlace,$queryDetalleIntegrante);
        $datosDetalleEquipo = mysqli_fetch_array($detalleEquipo,MYSQLI_ASSOC);
        $idEquipoDetalle = $datosDetalleEquipo["id_equipo"];


        $maximoDetalle = mysqli_query($enlace,"SELECT count(*) as CantDetalle from graduacion
INNER JOIN detalle_integrantes on graduacion.idDetalleIntegrante = detalle_integrantes.idetalle_integrantes
 WHERE detalle_integrantes.id_equipo = $idEquipoDetalle and detalle_integrantes.`status` = 1 and detalle_integrantes.toga = 1");
$datosMaximoDetalle = mysqli_fetch_array($maximoDetalle,MYSQLI_ASSOC);
$maximoDetalleCantidad = $datosMaximoDetalle["CantDetalle"];

$cantToga = mysqli_query($enlace,"SELECT count(*) as CantToga from graduacion
INNER JOIN detalle_integrantes on graduacion.idDetalleIntegrante = detalle_integrantes.idetalle_integrantes
 WHERE detalle_integrantes.id_equipo = $idEquipoDetalle and detalle_integrantes.`status` = 1 and detalle_integrantes.toga = 1");

if($cantToga == $maximoDetalle){
    echo 4;
}else{

    //INSERTAR
    $insertar = mysqli_query($enlace,"insert into graduacion (idIntegrante,idDetalleIntegrante) values 
	($tag,$detalleIntegrante)");

    //INICIO CONTADORES
    $queryEquipos  =mysqli_query($enlace,"SELECT * from equipos
INNER JOIN promociones on equipos.id_promocion = promociones.idpromocion
WHERE promociones.`status`= 1 and num_equipo >0 GROUP BY equipos.num_equipo ASC
 ");


    while ($datosEquipos = mysqli_fetch_array($queryEquipos,MYSQLI_ASSOC)){
        $idEquipo = $datosEquipos["id_equipo"];
        $numEquipo = $datosEquipos["num_equipo"];
        $nombreEquipo= $datosEquipos["nombre_equipo"];



        $queryCantidad= mysqli_query($enlace,"SELECT count(*) as CANTIDAD from graduacion
INNER JOIN detalle_integrantes on graduacion.idDetalleIntegrante = detalle_integrantes.idetalle_integrantes
WHERE detalle_integrantes.id_equipo = $idEquipo");
        $datosCantidadEquipo = mysqli_fetch_array($queryCantidad,MYSQLI_ASSOC);
        $cantidad = $datosCantidadEquipo["CANTIDAD"];

        echo'<div class="col-md-3 col-sm-6">';
        echo'<div class="dashboard-tile detail tile-red">';
        echo'<div class="content">';
        echo'<h1 class="text-left timer" data-from="0" data-to="180" data-speed="2500">'.$cantidad.'</h1>';
        echo'<p>'.$numEquipo.' - '.$nombreEquipo.'</p>';
        echo'</div>';
        echo'<div class="icon"><i class="fa fa-users"></i>';
        echo'</div>';
        echo'</div>';
        echo'</div>';

    }
    //FINAL CONTADORES
}


    }//FIN CONFIRMAR LEIDO
}else{
    echo 0;
}

?>