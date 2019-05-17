<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 13/5/2019
 * Time: 10:10 AM
 */
include '../gold/enlace.php';
$area = $_POST["phpArea"];
$nombre= $_POST["phpNombre"];
$identidad= $_POST["phpIdentidad"];
$telefono1= $_POST["phpTelefono1"];
$telefono2= $_POST["phpTelefono2"];
$sirve= $_POST["phpSirve"];


$queryPromocion = mysqli_query($enlace,"SELECT * from promociones where promociones.`status`=1");
$datosPromocion = mysqli_fetch_array($queryPromocion,MYSQLI_ASSOC);
$idPromocion = $datosPromocion["idpromocion"];
$queryVerificar = mysqli_num_rows(mysqli_query($enlace,"SELECT * from integracionindividual where identidad = '".$identidad."' AND idArea = $area"));

if($queryVerificar >0){
    echo 1;
}else{
    $queryInsert = mysqli_query($enlace,"INSERT INTO integracionindividual 
(nombre,identidad,telefono1,telefono2,sirve,idPromocion,idArea) 
VALUES 
('".$nombre."','".$identidad."','".$telefono1."','".$telefono2."','".$sirve."',$idPromocion,$area)");
echo 0;
}

?>