<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 24/4/2018
 * Time: 9:37 AM
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


$equipo= $_POST['phpEquipo'];


$cargo = $_POST['phpCargo'];
$estado= $_POST['phpEstado'];

$query_upedate = mysqli_query($enlace,"UPDATE servidores set promo_cordero = ".$promoCorderitos." ,num_identidad='".$identidad."',nombre_integrante='".$nombre."',fecha_cumple='".$cumple."',cel='".$cel."',tel='".$tel."',estado_civil='".$estadoCivil."',sexo='".$genero."',trasporte='".$transporte."',direccion='".$direccion."',areas ='".$areas."',`status`='1',apellidoCasada ='".$apeCasada."' WHERE idServidor=".$id_integrante);

if($equipo ==""){
    $query_upedate2= mysqli_query($enlace,"UPDATE serviciodetalle set idServicioEquipo = NULL ,idServicioCargo=$cargo,estado=$estado WHERE idServidor=$id_integrante");
}else{
    $query_upedate2= mysqli_query($enlace,"UPDATE serviciodetalle set idServicioEquipo = $equipo,idServicioCargo=$cargo,estado=$estado WHERE idServidor=$id_integrante");

}




$filas1= mysqli_affected_rows($enlace);


mysqli_close($enlace);
?>