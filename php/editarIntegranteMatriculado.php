<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 26/1/2018
 * Time: 3:14 PM
 */

include '../gold/enlace.php';

$id_integrante = $_POST['phpIdIntegrante'];
$promoCorderitos = $_POST['phpPromoCordero'];
$estadoCivil = $_POST['phpEstadoCivil'];
$genero= $_POST['phpGenero'];
$transporte = $_POST['phpTransporte'];
$identidad = $_POST['phpIdentidad'];
$nombre = $_POST['phpNombre'];
$apeCasada= $_POST['phpApeCasada'];
$cumple = $_POST['phpFechaCumpleanos'];
$cel = $_POST['phpTel1'];
$tel = $_POST['phpTel2'];
$areas = $_POST['phpAreas'];
$direccion = $_POST['phpDireccion'];

$query_upedate = mysqli_query($enlace,"UPDATE integrantes set promo_cordero = ".$promoCorderitos." ,num_identidad='".$identidad."',nombre_integrante='".$nombre."',fecha_cumple='".$cumple."',cel='".$cel."',tel='".$tel."',estado_civil='".$estadoCivil."',sexo='".$genero."',trasporte='".$transporte."',direccion='".$direccion."',areas ='".$areas."',`status`='1',apellidoCasada ='".$apeCasada."' WHERE idintegrante=".$id_integrante);



$filas1= mysqli_affected_rows($enlace);

if ($filas1) {
    # code...

    //segundo query
   $respuesta = 1;
   echo $respuesta;

}else{
    $respuesta = 0;
    echo $respuesta;
}
mysqli_close($enlace);
?>