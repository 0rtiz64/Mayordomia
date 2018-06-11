<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 22/1/2018
 * Time: 8:54 AM
 */
include ('../gold/enlace.php');
$idIntegrante=$_POST["idIntegrantePhp"];
$fechaSistema = "".date('Y-m-d H:i:s')."";
$fechaSistemaVerifica = "".date('Y-m-d')."";

$queryPromocionActiva = mysqli_query($enlace,"SELECT * from promociones WHERE promociones.`status` =1");
$datoPromocionActiva = mysqli_fetch_array($queryPromocionActiva,MYSQLI_ASSOC);
$promocionActiva = $datoPromocionActiva["idpromocion"];

$queryVerificarExisteIdentidad = mysqli_num_rows(mysqli_query($enlace,"SELECT num_identidad,idintegrante FROM integrantes WHERE idintegrante='".$idIntegrante."'"));
//INICIA IF VALIDAR SI EXISTE IDENTIDAD
if($queryVerificarExisteIdentidad>0){
        $queryValidarSiYaMarco = mysqli_num_rows(mysqli_query($enlace,"SELECT *from marcacionprovicional 
WHERE idIntegrante=$idIntegrante and CAST(fechaMarcacion AS DATE) = '".$fechaSistemaVerifica."'"));

        //INICIA VALIDAR SI YA MARCO
    if($queryValidarSiYaMarco>0){
        $querySeleccionarDatos = mysqli_query($enlace,"SELECT num_identidad,nombre_integrante,cel from integrantes where idintegrante =$idIntegrante");
        $datoIntegrante =mysqli_fetch_array($querySeleccionarDatos,MYSQLI_ASSOC);
        $tabla = '<div class="table-responsive">
        <table class="table table-bordered table-striped">
        <thead>
        <tr>
        <th>#</th>
        <th>Identidad</th>
        <th>Nombre</th>
        <th> Celular</th>
        </tr>
        </thead>
        <tbody>
        <tr>
        <td>1</td>
        <td>'.$datoIntegrante["num_identidad"].'</td>
        <td>'.utf8_encode($datoIntegrante["nombre_integrante"]).'</td>
        <td>'.$datoIntegrante["cel"].'</td>
        </tr>

        <tr style="text-align: center;  font-size:16px;">
        <td colspan="4"> <div class="alert alert-danger"> <strong>Este usuario ya habia marcado asistencia</strong>  </div> </td>
        </tr>

        </tbody>
        </table>
        </div>';


//CANTIDAD TOTAL
        $queryCantidadAsistencia = mysqli_query($enlace,"SELECT COUNT(idIntegrante)AS CANTIDAD from marcacionprovicional WHERE CAST(fechaMarcacion AS DATE) = '".$fechaSistemaVerifica."'");
    $datoCantidad = mysqli_fetch_array($queryCantidadAsistencia,MYSQLI_ASSOC);
    $cantidadAsistieron = $datoCantidad["CANTIDAD"];
   // $cantidadDiv = 'Asistencia Ovejas:<span class="badge badge-danager animated bounceIn" id="new-messages">'.$cantidadAsistieron.'</span>';

    //CANTIDAD PASTOREADORES

        $queryCantidadAsistenciaPastoreadores = mysqli_query($enlace,"SELECT COUNT(marcacionprovicional.idIntegrante) as CANTIDAD from marcacionprovicional 
INNER JOIN detalle_integrantes ON marcacionprovicional.idIntegrante = detalle_integrantes.id_integrante
where CAST(marcacionprovicional.fechaMarcacion AS date)='".$fechaSistemaVerifica."' and detalle_integrantes.id_cargo = 9 and detalle_integrantes.id_promocion= $promocionActiva");
        $datoCantidadPastoreadores = mysqli_fetch_array($queryCantidadAsistenciaPastoreadores,MYSQLI_ASSOC);
        $cantidadAsistieronPastoreadores = $datoCantidadPastoreadores["CANTIDAD"];
        $cantidadDivPast = 'Asistencia Pastoreadores:<span class="badge badge-danager animated bounceIn" id="new-messages">'.$cantidadAsistieronPastoreadores.'</span>';


       //CANTIDAD LIDERAZGO
        $queryCantidadAsistenciaLiderazgo = mysqli_query($enlace,"SELECT COUNT(marcacionprovicional.idIntegrante) as CANTIDAD from marcacionprovicional 
INNER JOIN detalle_integrantes ON marcacionprovicional.idIntegrante = detalle_integrantes.id_integrante
where CAST(marcacionprovicional.fechaMarcacion AS date) ='".$fechaSistemaVerifica."' and detalle_integrantes.id_cargo <> 9 and detalle_integrantes.id_cargo <>10 AND detalle_integrantes.id_promocion=$promocionActiva");
        $datoCantidadLiderazgo = mysqli_fetch_array($queryCantidadAsistenciaLiderazgo,MYSQLI_ASSOC);
        $cantidadAsistieronLiderazgo = $datoCantidadLiderazgo["CANTIDAD"];
        $cantidadDivLid = 'Asistencia Liderazgo:<span class="badge badge-danager animated bounceIn" id="new-messages">'.$cantidadAsistieronLiderazgo.'</span>';


        //CANTIDAD OVEJAS
        $totalLid = $cantidadAsistieronPastoreadores+$cantidadAsistieronLiderazgo;
        $totalOvejas =$cantidadAsistieron-$totalLid;
        $cantidadDiv = 'Asistencia Ovejas:<span class="badge badge-danager animated bounceIn" id="new-messages">'.$totalOvejas .'</span>';


        $datos = array(
            0 => $tabla,
            1 => $cantidadDiv,
            2 => $cantidadDivPast,
            3 => $cantidadDivLid,

        );
        echo json_encode($datos);


    }else{

        //INICIA IF VALIDAR SI ESTA ENLAZADO
        $queryVerificarEstaEnlazado = mysqli_num_rows(mysqli_query($enlace,"SELECT integrantes.nombre_integrante,equipos.num_equipo,equipos.nombre_equipo FROM integrantes
INNER JOIN detalle_integrantes ON detalle_integrantes.id_integrante = integrantes.idintegrante
INNER JOIN equipos ON detalle_integrantes.id_equipo = equipos.id_equipo
WHERE idintegrante = $idIntegrante and  detalle_integrantes.id_promocion=$promocionActiva"));
        // INICIA IF VALIDAR SI ESTA ENLAZADO
        if($queryVerificarEstaEnlazado>0) {
            $queryDatosIntegranteEnlzado  =  mysqli_query($enlace,"SELECT integrantes.num_identidad,integrantes.nombre_integrante,equipos.num_equipo,equipos.nombre_equipo,detalle_integrantes.`status` FROM integrantes
        INNER JOIN detalle_integrantes ON detalle_integrantes.id_integrante = integrantes.idintegrante
        INNER JOIN equipos ON detalle_integrantes.id_equipo = equipos.id_equipo
        WHERE idintegrante = $idIntegrante and  detalle_integrantes.id_promocion=$promocionActiva");
            $datosIntegranteEnlzado = mysqli_fetch_array($queryDatosIntegranteEnlzado,MYSQLI_ASSOC);

            $queryInsertarEnMarcacion= mysqli_query($enlace,"INSERT INTO marcacionprovicional (idIntegrante,fechaMarcacion,idPromocion) VALUES($idIntegrante,'".$fechaSistema."',$promocionActiva)");
            if ($datosIntegranteEnlzado["status"] == 3){
              $fila = '
                <tr style="text-align: center;  font-size:16px;">
                <td colspan="4"> <div class="alert alert-info"> <strong>Asistencia automatica marcada. Estado Integrante Inactivo</strong>  </div> </td>
                </tr>
              ';
            }elseif ($datosIntegranteEnlzado["status"] == 2){
                $fila='
                <tr style="text-align: center;  font-size:16px;">
                <td colspan="4"> <div class="alert alert-warning"> <strong>Asistencia automatica marcada. Estado Integrante Retirado</strong>  </div> </td>
                </tr>
                ';
            }elseif ($datosIntegranteEnlzado["status"] == 1){
                $fila='
                <tr style="text-align: center;  font-size:16px;">
                <td colspan="4"> <div class="alert alert-success"> <strong>Asistencia automatica marcada.</strong>  </div> </td>
                </tr>
                ';
            };

          $tabla ='
            <div class="table-responsive">
            <table class="table table-bordered table-striped">
            <thead>
            <tr>
            <th>#</th>
            <th>Identidad</th>
            <th>Nombre</th>
            <th> Equipo</th>
            </tr>
            </thead>
            <tbody>
            <tr>
            <td>1</td>
            <td>'.$datosIntegranteEnlzado["num_identidad"].'</td>
            <td>'.utf8_encode($datosIntegranteEnlzado["nombre_integrante"]).'</td>";
            <td>'.$datosIntegranteEnlzado["num_equipo"].'-'.$datosIntegranteEnlzado["nombre_equipo"].'</td>
            </tr>

           '.$fila.'
            </tbody>
            </table>
            </div>

          ';

//CANTIDAD TOTAL
            $queryCantidadAsistencia = mysqli_query($enlace,"SELECT COUNT(idIntegrante)AS CANTIDAD from marcacionprovicional WHERE CAST(fechaMarcacion AS DATE) = '".$fechaSistemaVerifica."'");
            $datoCantidad = mysqli_fetch_array($queryCantidadAsistencia,MYSQLI_ASSOC);
            $cantidadAsistieron = $datoCantidad["CANTIDAD"];
            // $cantidadDiv = 'Asistencia Ovejas:<span class="badge badge-danager animated bounceIn" id="new-messages">'.$cantidadAsistieron.'</span>';

            //CANTIDAD PASTOREADORES

            $queryCantidadAsistenciaPastoreadores = mysqli_query($enlace,"SELECT COUNT(marcacionprovicional.idIntegrante) as CANTIDAD from marcacionprovicional 
INNER JOIN detalle_integrantes ON marcacionprovicional.idIntegrante = detalle_integrantes.id_integrante
where CAST(marcacionprovicional.fechaMarcacion AS date)='".$fechaSistemaVerifica."' and detalle_integrantes.id_cargo = 9 and detalle_integrantes.id_promocion= $promocionActiva");
            $datoCantidadPastoreadores = mysqli_fetch_array($queryCantidadAsistenciaPastoreadores,MYSQLI_ASSOC);
            $cantidadAsistieronPastoreadores = $datoCantidadPastoreadores["CANTIDAD"];
            $cantidadDivPast = 'Asistencia Pastoreadores:<span class="badge badge-danager animated bounceIn" id="new-messages">'.$cantidadAsistieronPastoreadores.'</span>';


            //CANTIDAD LIDERAZGO
            $queryCantidadAsistenciaLiderazgo = mysqli_query($enlace,"SELECT COUNT(marcacionprovicional.idIntegrante) as CANTIDAD from marcacionprovicional 
INNER JOIN detalle_integrantes ON marcacionprovicional.idIntegrante = detalle_integrantes.id_integrante
where CAST(marcacionprovicional.fechaMarcacion AS date) ='".$fechaSistemaVerifica."' and detalle_integrantes.id_cargo <> 9 and detalle_integrantes.id_cargo <>10 AND detalle_integrantes.id_promocion=$promocionActiva");
            $datoCantidadLiderazgo = mysqli_fetch_array($queryCantidadAsistenciaLiderazgo,MYSQLI_ASSOC);
            $cantidadAsistieronLiderazgo = $datoCantidadLiderazgo["CANTIDAD"];
            $cantidadDivLid = 'Asistencia Liderazgo:<span class="badge badge-danager animated bounceIn" id="new-messages">'.$cantidadAsistieronLiderazgo.'</span>';


            //CANTIDAD OVEJAS
            $totalLid = $cantidadAsistieronPastoreadores+$cantidadAsistieronLiderazgo;
            $totalOvejas =$cantidadAsistieron-$totalLid;
            $cantidadDiv = 'Asistencia Ovejas:<span class="badge badge-danager animated bounceIn" id="new-messages">'.$totalOvejas .'</span>';


            $datos = array(
                0 => $tabla,
                1 => $cantidadDiv,
                2 => $cantidadDivPast,
                3 => $cantidadDivLid,

            );
            echo json_encode($datos);

        }else{
            $queryInsertarEnMarcacion= mysqli_query($enlace,"INSERT INTO marcacionprovicional (idIntegrante,fechaMarcacion,idPromocion) VALUES($idIntegrante,'".$fechaSistema."',$promocionActiva)");
        $queryNoEnlazado = mysqli_query($enlace,"select integrantes.num_identidad,nombre_integrante,cel from integrantes where idintegrante = $idIntegrante");
        $datosNoEnlazado= mysqli_fetch_array($queryNoEnlazado,MYSQLI_ASSOC);

        $tabla = '
            <div class="table-responsive">
            <table class="table table-bordered table-striped">
            <thead>
            <tr>
            <th>#</th>
            <th>Identidad</th>
            <th>Nombre</th>
            <th> Celular</th>
            </tr>
            </thead>
            <tbody>
            <tr>
            <td>1</td>
            <td>'.$datosNoEnlazado["num_identidad"].'</td>
            <td>'.utf8_encode($datosNoEnlazado["nombre_integrante"]).'</td>
            <td>'.$datosNoEnlazado["cel"].'</td>
            </tr>
            <tr style="text-align: center;  font-size:16px;">
            <td colspan="4"> <div class="alert alert-success"> <strong>Asistencia marcada.</strong>  </div> </td>
            </tr>
            </tbody>
            </table>
            </div>
        ';


//CANTIDAD TOTAL
            $queryCantidadAsistencia = mysqli_query($enlace,"SELECT COUNT(idIntegrante)AS CANTIDAD from marcacionprovicional WHERE CAST(fechaMarcacion AS DATE) = '".$fechaSistemaVerifica."'");
            $datoCantidad = mysqli_fetch_array($queryCantidadAsistencia,MYSQLI_ASSOC);
            $cantidadAsistieron = $datoCantidad["CANTIDAD"];
            // $cantidadDiv = 'Asistencia Ovejas:<span class="badge badge-danager animated bounceIn" id="new-messages">'.$cantidadAsistieron.'</span>';

            //CANTIDAD PASTOREADORES

            $queryCantidadAsistenciaPastoreadores = mysqli_query($enlace,"SELECT COUNT(marcacionprovicional.idIntegrante) as CANTIDAD from marcacionprovicional 
INNER JOIN detalle_integrantes ON marcacionprovicional.idIntegrante = detalle_integrantes.id_integrante
where CAST(marcacionprovicional.fechaMarcacion AS date)= '".$fechaSistemaVerifica."' and detalle_integrantes.id_cargo = 9 and detalle_integrantes.id_promocion= $promocionActiva");
            $datoCantidadPastoreadores = mysqli_fetch_array($queryCantidadAsistenciaPastoreadores,MYSQLI_ASSOC);
            $cantidadAsistieronPastoreadores = $datoCantidadPastoreadores["CANTIDAD"];
            $cantidadDivPast = 'Asistencia Pastoreadores:<span class="badge badge-danager animated bounceIn" id="new-messages">'.$cantidadAsistieronPastoreadores.'</span>';


            //CANTIDAD LIDERAZGO
            $queryCantidadAsistenciaLiderazgo = mysqli_query($enlace,"SELECT COUNT(marcacionprovicional.idIntegrante) as CANTIDAD from marcacionprovicional 
INNER JOIN detalle_integrantes ON marcacionprovicional.idIntegrante = detalle_integrantes.id_integrante
where CAST(marcacionprovicional.fechaMarcacion AS date) ='".$fechaSistemaVerifica."' and detalle_integrantes.id_cargo <> 9 and detalle_integrantes.id_cargo <>10 AND detalle_integrantes.id_promocion=$promocionActiva");
            $datoCantidadLiderazgo = mysqli_fetch_array($queryCantidadAsistenciaLiderazgo,MYSQLI_ASSOC);
            $cantidadAsistieronLiderazgo = $datoCantidadLiderazgo["CANTIDAD"];
            $cantidadDivLid = 'Asistencia Liderazgo:<span class="badge badge-danager animated bounceIn" id="new-messages">'.$cantidadAsistieronLiderazgo.'</span>';


            //CANTIDAD OVEJAS
            $totalLid = $cantidadAsistieronPastoreadores+$cantidadAsistieronLiderazgo;
            $totalOvejas =$cantidadAsistieron-$totalLid;
            $cantidadDiv = 'Asistencia Ovejas:<span class="badge badge-danager animated bounceIn" id="new-messages">'.$totalOvejas .'</span>';


            $datos = array(
                0 => $tabla,
                1 => $cantidadDiv,
                2 => $cantidadDivPast,
                3 => $cantidadDivLid,

            );
            echo json_encode($datos);

        }//FIN IF VALIDAR SI ESTA ENLAZADO

    }
        //FIN VALIDAR SI YA MARCO



}else{
    //CANTIDAD TOTAL
    $queryCantidadAsistencia = mysqli_query($enlace,"SELECT COUNT(idIntegrante)AS CANTIDAD from marcacionprovicional WHERE CAST(fechaMarcacion AS DATE) = '".$fechaSistemaVerifica."'");
    $datoCantidad = mysqli_fetch_array($queryCantidadAsistencia,MYSQLI_ASSOC);
    $cantidadAsistieron = $datoCantidad["CANTIDAD"];
    // $cantidadDiv = 'Asistencia Ovejas:<span class="badge badge-danager animated bounceIn" id="new-messages">'.$cantidadAsistieron.'</span>';

    //CANTIDAD PASTOREADORES

    $queryCantidadAsistenciaPastoreadores = mysqli_query($enlace,"SELECT COUNT(marcacionprovicional.idIntegrante) as CANTIDAD from marcacionprovicional 
INNER JOIN detalle_integrantes ON marcacionprovicional.idIntegrante = detalle_integrantes.id_integrante
where CAST(marcacionprovicional.fechaMarcacion AS date)='".$fechaSistemaVerifica."' and detalle_integrantes.id_cargo = 9 and detalle_integrantes.id_promocion= $promocionActiva");
    $datoCantidadPastoreadores = mysqli_fetch_array($queryCantidadAsistenciaPastoreadores,MYSQLI_ASSOC);
    $cantidadAsistieronPastoreadores = $datoCantidadPastoreadores["CANTIDAD"];
    $cantidadDivPast = 'Asistencia Pastoreadores:<span class="badge badge-danager animated bounceIn" id="new-messages">'.$cantidadAsistieronPastoreadores.'</span>';


    //CANTIDAD LIDERAZGO
    $queryCantidadAsistenciaLiderazgo = mysqli_query($enlace,"SELECT COUNT(marcacionprovicional.idIntegrante) as CANTIDAD from marcacionprovicional 
INNER JOIN detalle_integrantes ON marcacionprovicional.idIntegrante = detalle_integrantes.id_integrante
where CAST(marcacionprovicional.fechaMarcacion AS date) ='".$fechaSistemaVerifica."' and detalle_integrantes.id_cargo <> 9 and detalle_integrantes.id_cargo <>10 AND detalle_integrantes.id_promocion=$promocionActiva");
    $datoCantidadLiderazgo = mysqli_fetch_array($queryCantidadAsistenciaLiderazgo,MYSQLI_ASSOC);
    $cantidadAsistieronLiderazgo = $datoCantidadLiderazgo["CANTIDAD"];
    $cantidadDivLid = 'Asistencia Liderazgo:<span class="badge badge-danager animated bounceIn" id="new-messages">'.$cantidadAsistieronLiderazgo.'</span>';


    //CANTIDAD OVEJAS
    $totalLid = $cantidadAsistieronPastoreadores+$cantidadAsistieronLiderazgo;
    $totalOvejas =$cantidadAsistieron-$totalLid;
    $cantidadDiv = 'Asistencia Ovejas:<span class="badge badge-danager animated bounceIn" id="new-messages">'.$totalOvejas .'</span>';


    $alerta =' <div class="alert alert-danger" > <strong> Integrante no encontrado</strong>  </div>';


    $datos = array(
        0 => $alerta,
        1 => $cantidadDiv,
        2 => $cantidadDivPast,
        3 => $cantidadDivLid,

    );
    echo json_encode($datos);

}//FIN IF VALIDAR SI EXISTE IDENTIDAD
?>