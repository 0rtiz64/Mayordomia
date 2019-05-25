<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 6/4/2018
 * Time: 10:15 AM
 */
include  '../gold/enlace.php';

$tag = $_POST["phpId"];

$confirm = mysqli_num_rows(mysqli_query($enlace,"SELECT * from integrantes 
INNER JOIN detalle_integrantes On integrantes.idintegrante = detalle_integrantes.id_integrante 
INNER JOIN promociones On promociones.idpromocion = detalle_integrantes.id_promocion
where idintegrante = $tag AND promociones.`status`=1"));

if ($confirm>0){
    $query = mysqli_query($enlace,"SELECT * from integrantes where idintegrante = $tag");
    $rows= mysqli_fetch_array($query,MYSQLI_ASSOC);
$alerta= ' <div class="alert alert-success"  align="center"> <strong>'.utf8_encode($rows['nombre_integrante']).'</strong>  </div>';
    $datos = array(
        0 => $rows['idintegrante'],
        1 => utf8_encode($rows['nombre_integrante']),
        2 => $rows['tel'],
        3 => $rows['cel'],
        4 => $rows['correlativo'],
        5 => $alerta,

    );
    echo json_encode($datos);
}else{
    $datos = array(
        0 => 0,
        1 => 0,
        2 => 0,
        3 => 0,
        4 => 0,
        5 => 0,

    );
    echo json_encode($datos);
}





?>