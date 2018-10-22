<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 26/9/2018
 * Time: 9:32 AM
 */
include '../gold/enlace.php';
$dato = $_POST["phpDato"];
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