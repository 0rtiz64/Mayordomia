<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 21/5/2019
 * Time: 6:29 PM
 */
include '../gold/enlace.php';
$idInt =$_POST["phpId"];
$tel1=$_POST["phpTel1"];
$tel2 =$_POST["phpTel2"];

$confirmar = mysqli_num_rows(mysqli_query($enlace,"SELECT * from detalle_integrantes 
INNER JOIN integrantes on detalle_integrantes.id_integrante = integrantes.idintegrante
INNER JOIN promociones on detalle_integrantes.id_promocion = promociones.idpromocion
where detalle_integrantes.id_integrante = '".$idInt."' and promociones.`status` = 1"));


if($confirmar>0){
    $queryUpdate = mysqli_query($enlace,"UPDATE integrantes SET cel='".$tel1."',tel = '".$tel2."'
 WHERE idintegrante =$idInt");
    echo 1;
}else{
    echo 0;
}
?>