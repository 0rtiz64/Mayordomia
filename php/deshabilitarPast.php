<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 26/9/2018
 * Time: 10:12 AM
 */
include '../gold/enlace.php';
$iDPast = $_POST["phpId"];
// ESTADOS
$confirmarEstado = mysqli_query($enlace,"SELECT estado from pastoreadores 
where pastoreadores.idIntegrante = $iDPast");
$datosConfirmar = mysqli_fetch_array($confirmarEstado,MYSQLI_ASSOC);
$estado =  $datosConfirmar["estado"];

if($estado == 1){
    $queryUpdate = mysqli_query($enlace,"UPDATE pastoreadores SET estado=2
 WHERE idIntegrante=$iDPast");


    $consultarEquipo= mysqli_num_rows(mysqli_query($enlace,"SELECT * from detalle_integrantes 
INNER JOIN promociones  on detalle_integrantes.id_promocion = promociones.idpromocion
WHERE detalle_integrantes.id_integrante =  '.$iDPast.' AND promociones.`status`=1"));
    if($consultarEquipo>0){
            $queryIdDetalleIntegrante = mysqli_query($enlace,"SELECT detalle_integrantes.idetalle_integrantes from detalle_integrantes 
INNER JOIN promociones  on detalle_integrantes.id_promocion = promociones.idpromocion
WHERE detalle_integrantes.id_integrante =  '.$iDPast.' AND promociones.`status`=1");
            $datos= mysqli_fetch_array($queryIdDetalleIntegrante,MYSQLI_ASSOC);
            $idDetalleIntegrante = $datos["idetalle_integrantes"];

            $queryUpdateDetalle = mysqli_query($enlace,"UPDATE detalle_integrantes SET detalle_integrantes.`status` = 3

 WHERE detalle_integrantes.idetalle_integrantes=".$idDetalleIntegrante);

    }else{

    }


}else{
    $queryUpdate = mysqli_query($enlace,"UPDATE pastoreadores SET estado=1
 WHERE idIntegrante=$iDPast");

    $consultarEnlazado = mysqli_num_rows(mysqli_query($enlace,"SELECT * from detalle_integrantes 
INNER JOIN promociones on detalle_integrantes.id_promocion = promociones.idpromocion
WHERE  promociones.`status`=1 AND detalle_integrantes.id_integrante =".$iDPast));

    if($consultarEnlazado>0){

    }else{

    }
};



//TABLA
$cont =1;
$queryListarTodosPast = mysqli_query($enlace,"SELECT pastoreadores.idIntegrante,integrantes.nombre_integrante,pastoreadores.estado from pastoreadores
INNER JOIN integrantes  ON pastoreadores.idIntegrante = integrantes.idintegrante");


echo'<table class="table table-hover">';
echo'<tr align="center">';
echo'<td><strong>#</strong></td>';
echo'<td><strong>NOMBRE</strong></td>';
echo'<td><strong>OPCIONES</strong></td>';
echo'</tr>';

while ($datosPastoreadores = mysqli_fetch_array($queryListarTodosPast,MYSQLI_ASSOC)){
    $idInte = $datosPastoreadores["idIntegrante"];
    $query= "SELECT pastoreadores.idIntegrante,integrantes.nombre_integrante,equipos.num_equipo,equipos.nombre_equipo,pastoreadores.estado,detalle_integrantes.`status` AS estadoDetalle  from pastoreadores
INNER JOIN integrantes on pastoreadores.idIntegrante = integrantes.idintegrante
INNER JOIN detalle_integrantes ON pastoreadores.idIntegrante = detalle_integrantes.id_integrante
INNER JOIN promociones ON detalle_integrantes.id_promocion = promociones.idpromocion
INNER JOIN equipos ON detalle_integrantes.id_equipo = equipos.id_equipo
WHERE promociones.`status` =1 AND pastoreadores.idIntegrante =".$idInte;

    $detallePastoreadores= mysqli_num_rows(mysqli_query($enlace,$query));
    if($detallePastoreadores>0){

        $queryDetalles = mysqli_query($enlace,$query);
        $datosDetalles = mysqli_fetch_array($queryDetalles,MYSQLI_ASSOC);

        if($datosDetalles["estado"]== 1){
            $estado = "ACTIVO";
            $clase = "label label-success";
        }else{
            $estado= "INACTIVO";
            $clase = "label label-danger";
        }


        if($datosDetalles["estadoDetalle"] ==1){
            echo'<tr align="center"  data-toggle="tooltip" data-placement="top" title="'.$datosDetalles["num_equipo"].'-'.$datosDetalles["nombre_equipo"].'" >';
            echo'<td>'.$cont.'</td>';
            echo'<td><i class="fa fa-star" style="color: #F1C40F"    ></i> '.utf8_encode($datosDetalles["nombre_integrante"]).'</td>';
            echo'<td><span class="'.$clase.'" onclick="deshabilitarPastoreador('.$idInte.')">'.$estado.'</span></td>';
            echo'</tr>';
        }else{
            echo'<tr align="center">';
            echo'<td>'.$cont.'</td>';
            echo'<td>'.utf8_encode($datosPastoreadores["nombre_integrante"]).'</td>';
            echo'<td><span class="'.$clase.'" onclick="deshabilitarPastoreador('.$idInte.')">'.$estado.'</span></td>';
            echo'</tr>';
        }

    }else{

        if($datosPastoreadores["estado"]== 1){
            $estado = "ACTIVO";
            $clase = "label label-success";
        }else {
            $estado = "INACTIVO";
            $clase = "label label-danger";
        }
        echo'<tr align="center">';
        echo'<td>'.$cont.'</td>';
        echo'<td>'.utf8_encode($datosPastoreadores["nombre_integrante"]).'</td>';
        echo'<td><span class="'.$clase.'" onclick="deshabilitarPastoreador('.$idInte.')">'.$estado.'</span></td>';
        echo'</tr>';
    }
    $cont++;
}

echo' </table>';





?>