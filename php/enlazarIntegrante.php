<?php
include '../gold/enlace.php';

$idIntegrante=$_POST["idIntegrante"];
$idEquipo=$_POST["idEquipo"];
$idCargo=$_POST["idCargo"];
$estado=$_POST["estado"];
$comentario=$_POST["comentario"];
$fechaentrada = date('Y-m-d  h:i:s');

$queryPromocion =mysqli_query($enlace,"SELECT id_promocion from equipos
where id_equipo ='".$idEquipo."'");
$resultadoPromocion=  mysqli_fetch_array($queryPromocion,MYSQLI_ASSOC);
$promocion = $resultadoPromocion["id_promocion"];
$query_ver = mysqli_num_rows(mysqli_query($enlace,"SELECT detalle_integrantes.id_integrante,equipos.num_equipo,equipos.nombre_equipo from detalle_integrantes
INNER JOIN equipos ON detalle_integrantes.id_equipo = equipos.id_equipo
WHERE id_integrante ='".$idIntegrante."' AND detalle_integrantes.id_promocion ='".$promocion."' "));


if($query_ver >0){
    echo "<div class='alert alert-danger' > <strong>Este Integrante ya se encuentra enlazado </strong>  </div>";


}else{


    $query = mysqli_query($enlace,"insert into detalle_integrantes (id_integrante,id_promocion,id_equipo,id_cargo,comentario,status,fecha_registro) 
values (".$idIntegrante.",".$promocion.",".$idEquipo.",".$idCargo.",'".$comentario."','".$estado."','".$fechaentrada."')");



    if (mysqli_affected_rows($enlace)>0) {

        echo "<strong> Integrante Enlazado</strong>";
        /*
        echo "<script>";
       echo "recargarNumeroExpediente(".$Id.");";
       echo "</script>";*/
    }

    else{
        echo mysqli_error($enlace);
    }
    mysqli_close($enlace);
}



?>