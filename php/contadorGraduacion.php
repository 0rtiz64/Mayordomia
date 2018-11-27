<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 14/11/2018
 * Time: 9:37 AM
 */

include  '../gold/enlace.php';
$tag = $_POST["phpTag"];
$cont ="";
$queryDetalleIntegrante ="SELECT * from detalle_integrantes 
INNER JOIN promociones on detalle_integrantes.id_promocion = promociones.idpromocion
WHERE promociones.`status` = 1 and detalle_integrantes.id_integrante = $tag and detalle_integrantes.`status` = 1";

$confirmar= mysqli_num_rows(mysqli_query($enlace,$queryDetalleIntegrante));

if($confirmar>0){
    $query = mysqli_query($enlace,$queryDetalleIntegrante);
    $datosQuery=mysqli_fetch_array($query,MYSQLI_ASSOC);
    $detalleIntegrante = $datosQuery["idetalle_integrantes"];

    $queryGraduacion = "SELECT * from graduacion WHERE idIntegrante = $tag";
    $confirmarLeido = mysqli_num_rows(mysqli_query($enlace,$queryGraduacion));

    if($confirmarLeido>0){
        //INICIO CONTADORES
        $queryEquipos  =mysqli_query($enlace,"SELECT * from equipos
INNER JOIN promociones on equipos.id_promocion = promociones.idpromocion
WHERE promociones.`status`= 1 and num_equipo >0 GROUP BY equipos.num_equipo ASC
 ");


        while ($datosEquipos = mysqli_fetch_array($queryEquipos,MYSQLI_ASSOC)){
            $idEquipo = $datosEquipos["id_equipo"];
            $numEquipo = $datosEquipos["num_equipo"];
            $nombreEquipo= $datosEquipos["nombre_equipo"];

            $maximoDetalle = mysqli_query($enlace,"SELECT count(*) as CantDetalle from detalle_integrantes
 WHERE detalle_integrantes.id_equipo = $idEquipo and detalle_integrantes.`status` = 1 and detalle_integrantes.toga = 2 and detalle_integrantes.id_cargo = 10");
            $datosMaximoDetalle = mysqli_fetch_array($maximoDetalle,MYSQLI_ASSOC);
            $maximoDetalleCantidad = $datosMaximoDetalle["CantDetalle"];

            $queryCantidad= mysqli_query($enlace,"SELECT count(*) as CANTIDAD from graduacion
INNER JOIN detalle_integrantes on graduacion.idDetalleIntegrante = detalle_integrantes.idetalle_integrantes
WHERE detalle_integrantes.id_equipo = $idEquipo and detalle_integrantes.`status` = 1 and detalle_integrantes.id_cargo = 10 and detalle_integrantes.toga = 2");
            $datosCantidadEquipo = mysqli_fetch_array($queryCantidad,MYSQLI_ASSOC);
            $cantidad = $datosCantidadEquipo["CANTIDAD"];

            if($cantidad >= $maximoDetalleCantidad){
                $class ='class="dashboard-tile detail tile-turquoise"';
            }else{
                $class ='class="dashboard-tile detail tile-red"';
            }
            $cont .='<div class="col-md-3 col-sm-6">
            <div '.$class.'>
            <div class="content">
            <h1 class="text-left timer" data-from="0" data-to="180" data-speed="2500">'.$cantidad.'</h1>
            <p>'.$numEquipo.' - '.$nombreEquipo.'</p>
            </div>
            <div class="icon"><i class="fa fa-users"></i>
            </div>
            </div>
            </div>';

        }

        //CONSULTAR PROMOCION ACTIVA INICIO
        $queryPromocion = mysqli_query($enlace,"SELECT * from promociones WHERE `status` = 1");
        $datosPromocion = mysqli_fetch_array($queryPromocion,MYSQLI_ASSOC);
        $idPromocion = $datosPromocion["idpromocion"];
        //CONSULTAR PROMOCION ACTIVA FINAL

        //CONTADOR GENERAL INICIO
        $queryContadorGeneral = mysqli_query($enlace,"SELECT COUNT(*) as CANTIDADGENERAL  from graduacion 
INNER JOIN promociones on graduacion.idPromocion = promociones.idpromocion
WHERE promociones.`status` = 1");
        $datosContadorGeneral = mysqli_fetch_array($queryContadorGeneral,MYSQLI_ASSOC);
        $contadorGeneral = $datosContadorGeneral["CANTIDADGENERAL"];
        $divContadorGeneral = ' <h1 style="margin-top: -2%">
                                  <span class="label label-info pull-left inbox-notification">'.$contadorGeneral.'</span>
                              </h1>';
        //CONTADOR GENERAL FINAL

        $datos = array(
            0 => 2,
            1 => $cont,
            2 => $divContadorGeneral,


        );
        echo json_encode($datos);

        //FINAL CONTADORES


    }else{

        $detalleEquipo = mysqli_query($enlace,$queryDetalleIntegrante);
        $datosDetalleEquipo = mysqli_fetch_array($detalleEquipo,MYSQLI_ASSOC);
        $idEquipoDetalle = $datosDetalleEquipo["id_equipo"];


        $maximoDetalle = mysqli_query($enlace,"SELECT count(*) as CantDetalle from detalle_integrantes
 WHERE detalle_integrantes.id_equipo = $idEquipoDetalle and detalle_integrantes.`status` = 1 and detalle_integrantes.toga = 2 and detalle_integrantes.id_cargo = 10");
$datosMaximoDetalle = mysqli_fetch_array($maximoDetalle,MYSQLI_ASSOC);
$maximoDetalleCantidad = $datosMaximoDetalle["CantDetalle"];


$cantToga = mysqli_query($enlace,"SELECT count(*) as CantToga from graduacion
INNER JOIN detalle_integrantes on graduacion.idDetalleIntegrante = detalle_integrantes.idetalle_integrantes
 WHERE detalle_integrantes.id_equipo = $idEquipoDetalle and detalle_integrantes.`status` = 1 and detalle_integrantes.toga = 2 and detalle_integrantes.id_cargo = 10");

$datosToga =mysqli_fetch_array($cantToga,MYSQLI_ASSOC);
$cantidadToga =$datosToga["CantToga"];
if($cantidadToga == $maximoDetalleCantidad ){
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
WHERE detalle_integrantes.id_equipo = $idEquipo and detalle_integrantes.`status` = 1 and detalle_integrantes.id_cargo = 10 and detalle_integrantes.toga = 2");
        $datosCantidadEquipo = mysqli_fetch_array($queryCantidad,MYSQLI_ASSOC);
        $cantidad = $datosCantidadEquipo["CANTIDAD"];

        if($cantidad >= $maximoDetalleCantidad){
            $class ='class="dashboard-tile detail tile-turquoise"';
        }else{
            $class ='class="dashboard-tile detail tile-red"';
        }
        $cont .='<div class="col-md-3 col-sm-6">
            <div '.$class.'>
            <div class="content">
            <h1 class="text-left timer" data-from="0" data-to="180" data-speed="2500">'.$cantidad.'</h1>
            <p>'.$numEquipo.' - '.$nombreEquipo.'</p>
            </div>
            <div class="icon"><i class="fa fa-users"></i>
            </div>
            </div>
            </div>';

    }

    //CONSULTAR PROMOCION ACTIVA INICIO
    $queryPromocion = mysqli_query($enlace,"SELECT * from promociones WHERE `status` = 1");
    $datosPromocion = mysqli_fetch_array($queryPromocion,MYSQLI_ASSOC);
    $idPromocion = $datosPromocion["idpromocion"];
    //CONSULTAR PROMOCION ACTIVA FINAL


    //CONTADOR GENERAL INICIO
    $queryContadorGeneral = mysqli_query($enlace,"SELECT COUNT(*) as CANTIDADGENERAL  from graduacion 
INNER JOIN promociones on graduacion.idPromocion = promociones.idpromocion
WHERE promociones.`status` = 1");
    $datosContadorGeneral = mysqli_fetch_array($queryContadorGeneral,MYSQLI_ASSOC);
    $contadorGeneral = $datosContadorGeneral["CANTIDADGENERAL"];
    $divContadorGeneral = ' <h1 style="margin-top: -2%">
                                  <span class="label label-info pull-left inbox-notification">'.$contadorGeneral.'</span>
                              </h1>';
    //CONTADOR GENERAL FINAL
    $datos = array(
        0 => 4,
        1 => $cont,
        2 => $divContadorGeneral,


    );
    echo json_encode($datos);

    //FINAL CONTADORES
}else{

    //CONSULTAR PROMOCION ACTIVA INICIO
    $queryPromocion = mysqli_query($enlace,"SELECT * from promociones WHERE `status` = 1");
    $datosPromocion = mysqli_fetch_array($queryPromocion,MYSQLI_ASSOC);
    $idPromocion = $datosPromocion["idpromocion"];
    //CONSULTAR PROMOCION ACTIVA FINAL
    //INSERTAR
    $insertar = mysqli_query($enlace,"insert into graduacion (idIntegrante,idDetalleIntegrante,idPromocion) values 
	($tag,$detalleIntegrante,$idPromocion)");


    //CONTADOR GENERAL INICIO
    $queryContadorGeneral = mysqli_query($enlace,"SELECT COUNT(*) as CANTIDADGENERAL  from graduacion 
INNER JOIN promociones on graduacion.idPromocion = promociones.idpromocion
WHERE promociones.`status` = 1");
    $datosContadorGeneral = mysqli_fetch_array($queryContadorGeneral,MYSQLI_ASSOC);
    $contadorGeneral = $datosContadorGeneral["CANTIDADGENERAL"];
    $divContadorGeneral = ' <h1 style="margin-top: -2%">
                                  <span class="label label-info pull-left inbox-notification">'.$contadorGeneral.'</span>
                              </h1>';
    //CONTADOR GENERAL FINAL

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
WHERE detalle_integrantes.id_equipo = $idEquipo and detalle_integrantes.`status` = 1 and detalle_integrantes.id_cargo = 10 and detalle_integrantes.toga = 2");
        $datosCantidadEquipo = mysqli_fetch_array($queryCantidad,MYSQLI_ASSOC);
        $cantidad = $datosCantidadEquipo["CANTIDAD"];

        if($cantidad >= $maximoDetalleCantidad){
            $class ='class="dashboard-tile detail tile-turquoise"';
        }else{
            $class ='class="dashboard-tile detail tile-red"';
        }
        $cont .='<div class="col-md-3 col-sm-6">
            <div '.$class.'>
            <div class="content">
            <h1 class="text-left timer" data-from="0" data-to="180" data-speed="2500">'.$cantidad.'</h1>
            <p>'.$numEquipo.' - '.$nombreEquipo.'</p>
            </div>
            <div class="icon"><i class="fa fa-users"></i>
            </div>
            </div>
            </div>';

    }

    //CONSULTAR PROMOCION ACTIVA INICIO
    $queryPromocion = mysqli_query($enlace,"SELECT * from promociones WHERE `status` = 1");
    $datosPromocion = mysqli_fetch_array($queryPromocion,MYSQLI_ASSOC);
    $idPromocion = $datosPromocion["idpromocion"];
    //CONSULTAR PROMOCION ACTIVA FINAL

    //CONTADOR GENERAL INICIO
    $queryContadorGeneral = mysqli_query($enlace,"SELECT COUNT(*) as CANTIDADGENERAL  from graduacion 
INNER JOIN promociones on graduacion.idPromocion = promociones.idpromocion
WHERE promociones.`status` = 1");
    $datosContadorGeneral = mysqli_fetch_array($queryContadorGeneral,MYSQLI_ASSOC);
    $contadorGeneral = $datosContadorGeneral["CANTIDADGENERAL"];
    $divContadorGeneral = ' <h1 style="margin-top: -2%">
                                  <span class="label label-info pull-left inbox-notification">'.$contadorGeneral.'</span>
                              </h1>';
    //CONTADOR GENERAL FINAL

    $datos = array(
        0 => 5,
        1 => $cont,
        2 => $divContadorGeneral,


    );
    echo json_encode($datos);

    //FINAL CONTADORES
}


    }//FIN CONFIRMAR LEIDO
}else{


    //TEST INICIO




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
WHERE detalle_integrantes.id_equipo = $idEquipo and detalle_integrantes.`status` = 1 and detalle_integrantes.id_cargo = 10 and detalle_integrantes.toga = 2");
        $datosCantidadEquipo = mysqli_fetch_array($queryCantidad,MYSQLI_ASSOC);
        $cantidad = $datosCantidadEquipo["CANTIDAD"];


        $maximoDetalle = mysqli_query($enlace,"SELECT count(*) as CantDetalle from detalle_integrantes
 WHERE detalle_integrantes.id_equipo = $idEquipo and detalle_integrantes.`status` = 1 and detalle_integrantes.toga = 2 and detalle_integrantes.id_cargo = 10");
        $datosMaximoDetalle = mysqli_fetch_array($maximoDetalle,MYSQLI_ASSOC);
        $maximoDetalleCantidad = $datosMaximoDetalle["CantDetalle"];


        if($cantidad >= $maximoDetalleCantidad){
            $class ='class="dashboard-tile detail tile-turquoise"';
        }else{
            $class ='class="dashboard-tile detail tile-red"';
        }

        $cont .='<div class="col-md-3 col-sm-6">
            <div '.$class.'>
            <div class="content">
            <h1 class="text-left timer" data-from="0" data-to="180" data-speed="2500">'.$cantidad.'</h1>
            <p>'.$numEquipo.' - '.$nombreEquipo.'</p>
            </div>
            <div class="icon"><i class="fa fa-users"></i>
            </div>
            </div>
            </div>';


    }
    //FINAL CONTADORES
    //TEST FINAL
    //CONSULTAR PROMOCION ACTIVA INICIO
    $queryPromocion = mysqli_query($enlace,"SELECT * from promociones WHERE `status` = 1");
    $datosPromocion = mysqli_fetch_array($queryPromocion,MYSQLI_ASSOC);
    $idPromocion = $datosPromocion["idpromocion"];
    //CONSULTAR PROMOCION ACTIVA FINAL



    //CONTADOR GENERAL INICIO
    $queryContadorGeneral = mysqli_query($enlace,"SELECT COUNT(*) as CANTIDADGENERAL  from graduacion 
INNER JOIN promociones on graduacion.idPromocion = promociones.idpromocion
WHERE promociones.`status` = 1");
    $datosContadorGeneral = mysqli_fetch_array($queryContadorGeneral,MYSQLI_ASSOC);
    $contadorGeneral = $datosContadorGeneral["CANTIDADGENERAL"];
    $divContadorGeneral = ' <h1 style="margin-top: -2%">
                                  <span class="label label-info pull-left inbox-notification">'.$contadorGeneral.'</span>
                              </h1>';
    //CONTADOR GENERAL FINAL
    $datos = array(
        0 => 0,
        1 => $cont,
        2 => $divContadorGeneral,


    );
    echo json_encode($datos);


}

?>