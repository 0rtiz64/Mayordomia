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


function FcontadorGeneral ($enlace){
   //CONSULTAR PROMOCION ACTIVA INICIO
        $queryPromocion = mysqli_query($enlace,"SELECT * from promociones WHERE `status` = 1");
        $datosPromocion = mysqli_fetch_array($queryPromocion,MYSQLI_ASSOC);
        $idPromocion = $datosPromocion["idpromocion"];
        //CONSULTAR PROMOCION ACTIVA FINAL

    //DEVUELTA INICIO
    $queryDevuelta = mysqli_query($enlace,"SELECT COUNT(*) CANTIDADDEVUELTA from graduacion
INNER JOIN promociones on graduacion.idPromocion= promociones.idpromocion
 WHERE graduacion.devuelta = 1 and promociones.`status` = 1");
    $datosDevuelta = mysqli_fetch_array($queryDevuelta,MYSQLI_ASSOC);
    $cantidadDevuelta = $datosDevuelta["CANTIDADDEVUELTA"];
    //DEVUELTA FINAL

        //CONTADOR GENERAL INICIO
        $queryContadorGeneral = mysqli_query($enlace,"SELECT COUNT(*) as CANTIDADGENERAL  from graduacion 
INNER JOIN promociones on graduacion.idPromocion = promociones.idpromocion
WHERE promociones.`status` = 1");
        $datosContadorGeneral = mysqli_fetch_array($queryContadorGeneral,MYSQLI_ASSOC);
        $contadorGeneral = $datosContadorGeneral["CANTIDADGENERAL"];
        $divContadorGeneral = ' <h1 style="margin-top: -2%">
                                    <div class="form-group col-md-12">
                                        <div class="col-md-6" title="ENTREGADAS"> <span class="label pull-left inbox-notification" style="background: #F0AD4E">E: '.$contadorGeneral.'</span></div>
                                        <div class="col-md-6" title="DEVUELTAS"> <span class="label pull-left inbox-notification" style="background: #416aa6">D: '.$cantidadDevuelta.'</span></div>
                                    </div>
                                 
                              </h1>';
        //CONTADOR GENERAL FINAL

            return $divContadorGeneral;
}




function FcontadoresEquipos ($enlace,$cont){
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
WHERE detalle_integrantes.id_equipo = $idEquipo and detalle_integrantes.`status` = 1 and detalle_integrantes.id_cargo = 10");
        $datosCantidadEquipo = mysqli_fetch_array($queryCantidad,MYSQLI_ASSOC);
        $cantidad = $datosCantidadEquipo["CANTIDAD"];


        $maximoDetalle = mysqli_query($enlace,"SELECT count(*) as CantDetalle from detalle_integrantes
 WHERE detalle_integrantes.id_equipo = $idEquipo and detalle_integrantes.`status` = 1  and detalle_integrantes.id_cargo = 10");
        $datosMaximoDetalle = mysqli_fetch_array($maximoDetalle,MYSQLI_ASSOC);
        $maximoDetalleCantidad = $datosMaximoDetalle["CantDetalle"];


        $queryCantidadDevueltaDeEquipo = mysqli_query($enlace,"SELECT COUNT(*) cantidadDev from graduacion 
WHERE graduacion.idEquipo = $idEquipo and graduacion.devuelta = 1");
        $datosDevueltaEquipo = mysqli_fetch_array($queryCantidadDevueltaDeEquipo,MYSQLI_ASSOC);
        $cantidadDevueltaEquipo = $datosDevueltaEquipo["cantidadDev"];



if($cantidad == 0){
    $class ='class="dashboard-tile detail tile-red"';
}else{
    if( $cantidad == $cantidadDevueltaEquipo ){
        $class ='class="dashboard-tile detail" style ="background:#416aa6;color:#ffff"';
    }else{
        if( $cantidad>0 && $cantidad <$maximoDetalleCantidad){
            $class ='class="dashboard-tile detail" style ="background:#FAB429;color:#ffff"';
        }else{
            if($cantidad>= $maximoDetalleCantidad){
                $class ='class="dashboard-tile detail"  style ="background:#5CB85C;color:#ffff"';
            }
        }
    }
}



        if($cantidad > 0 && $cantidadDevueltaEquipo < $cantidad) {

            $cont.=' 
            <div class="col-md-3 col-sm-6">
                 <div '.$class.'>
                     <div class="content col-md-12">
                          <div class="col-md-10" style="float: left">
                            <h1 class="text-left timer" data-from="0" data-to="180" data-speed="2500">E:'.$cantidad.'- D:'.$cantidadDevueltaEquipo.'</h1>
                        </div>
                <div class="col-md-2" style="float: right;">
                          <input  onclick="checkBox('.$idEquipo.');"  type="checkbox" class="form-control myCheck" style="width: 30px" title="DEVOLVER"> 
                        </div> 
                          <p>'.$numEquipo.' - '.$nombreEquipo.'</p> 
                          <input type="hidden" value="'.$idEquipo.'">   
                      </div>
                <div class="icon"><i class="fa fa-users"></i>
            </div>
            </div>
          </div>';
        }else{
            $cont.=' 
            <div class="col-md-3 col-sm-6">
                 <div '.$class.'>
                     <div class="content">
                         <h1 class="text-left timer" data-from="0" data-to="180" data-speed="2500">E:'.$cantidad.'- D:'.$cantidadDevueltaEquipo.'</h1>
                          <p>'.$numEquipo.' - '.$nombreEquipo.'</p> 
                          <input type="hidden" value="'.$idEquipo.'">   
                      </div>
                <div class="icon"><i class="fa fa-users"></i>
            </div>
            </div>
          </div>';
        }



    }
    return $cont;
}


$queryDetalleIntegrante ="SELECT * from detalle_integrantes 
INNER JOIN promociones on detalle_integrantes.id_promocion = promociones.idpromocion
WHERE promociones.`status` = 1 and detalle_integrantes.id_integrante = $tag and detalle_integrantes.`status` = 1 and detalle_integrantes.id_cargo = 10";

$confirmar= mysqli_num_rows(mysqli_query($enlace,$queryDetalleIntegrante));

if($confirmar>0){
    $query = mysqli_query($enlace,$queryDetalleIntegrante);
    $datosQuery=mysqli_fetch_array($query,MYSQLI_ASSOC);
    $detalleIntegrante = $datosQuery["idetalle_integrantes"];
    $idEquipoInsert = $datosQuery["id_equipo"];
    $queryGraduacion = "SELECT * from graduacion INNER JOIN promociones on graduacion.idPromocion = promociones.idpromocion WHERE graduacion.idIntegrante = $tag and promociones.`status` =1";
    $confirmarLeido = mysqli_num_rows(mysqli_query($enlace,$queryGraduacion));

    if($confirmarLeido>0){
        $datos = array(
            0 => 2,
            1 => FcontadoresEquipos($enlace,$cont),
            2 => FcontadorGeneral($enlace),
        );
        echo json_encode($datos);
    }else{
        $queryPromocion = mysqli_query($enlace,"SELECT * from promociones where `status` = 1");
        $datosPromocion = mysqli_fetch_array($queryPromocion,MYSQLI_ASSOC);
        $idPromocion = $datosPromocion["idpromocion"];
        //INSERTAR
        $insertar = mysqli_query($enlace,"insert into graduacion (idIntegrante,idDetalleIntegrante,idPromocion,devuelta,idEquipo) values 
	($tag,$detalleIntegrante,$idPromocion,2,$idEquipoInsert)");
    $datos = array(
        0 => 4,
        1 => FcontadoresEquipos($enlace,$cont),
        2 => FcontadorGeneral($enlace),
    );
    echo json_encode($datos);
    }
}else{
    $datos = array(
        0 => 0,
        1 => FcontadoresEquipos($enlace,$cont),
        2 => FcontadorGeneral($enlace),
    );
    echo json_encode($datos);
}

?>