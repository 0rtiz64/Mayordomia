<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 17/1/2018
 * Time: 2:12 PM
 */

include '../gold/enlace.php';

$identidad=$_POST["phpIdentidad"];

$queryId=mysqli_num_rows(mysqli_query($enlace,"select  idintegrante,promo_cordero,num_identidad,nombre_integrante,fecha_cumple,cel,tel,estado_civil,sexo,trasporte,direccion,areas,apellidoCasada from integrantes
WHERE num_identidad = '".$identidad."'"));

if($queryId>0){

    /*$dato =1;
    echo $dato;
    */

    $queryDatos = mysqli_query($enlace,"select  idintegrante,promo_cordero,num_identidad,nombre_integrante,fecha_cumple,cel,
tel,estado_civil,sexo,trasporte,direccion,areas,apellidoCasada, promociones.desc_promocion 
from integrantes
INNER JOIN detalle_integrantes ON integrantes.idintegrante = detalle_integrantes.id_integrante
INNER JOIN promociones ON detalle_integrantes.id_promocion = promociones.idpromocion
WHERE num_identidad ='".$identidad."'");
    $rows = mysqli_fetch_array($queryDatos,MYSQLI_ASSOC);
    $datos = array(
        0 => $dato =1,
        1 => $rows['num_identidad'],
        2 => $rows['nombre_integrante'],
        3 => $rows['fecha_cumple'],
        4 => $rows['cel'],
        5 => $rows['tel'],
        6 => $rows['estado_civil'],
        7 => $rows['sexo'],
        8 => $rows['trasporte'],
        9 => $rows['direccion'],
        10 => $rows['areas'],
        11 => $rows['apellidoCasada'],
        12 => $rows['promo_cordero'],
        13 => '<h4 class="modal-title" id="myModalLabel" style="color: white">IDENTIDAD YA REGISTRADA EN '.$rows["desc_promocion"].' </h4>',
        14 => $rows['idintegrante'],

        );
    echo json_encode($datos);


}else{

    $datos = array(
        0 => $dato =0,
    );
    echo json_encode($datos);

}

?>