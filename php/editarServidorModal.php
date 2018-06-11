<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 26/4/2018
 * Time: 9:54 AM
 */






include '../gold/enlace.php';


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

$queryIdServidor = mysqli_query($enlace,"SELECT idServidor from servidores WHERE num_identidad = '".$identidad."'");
$datoIdServidor = mysqli_fetch_array($queryIdServidor,MYSQLI_ASSOC);
$idServidor = $datoIdServidor["idServidor"];

$query_upedate = mysqli_query($enlace,"UPDATE servidores set promo_cordero = ".$promoCorderitos." ,num_identidad='".$identidad."',nombre_integrante='".$nombre."',fecha_cumple='".$cumple."',cel='".$cel."',tel='".$tel."',estado_civil='".$estadoCivil."',sexo='".$genero."',trasporte='".$transporte."',direccion='".$direccion."',areas ='".$areas."',`status`='1',apellidoCasada ='".$apeCasada."' WHERE num_identidad='".$identidad."' ");

if($equipo ==""){
    $query_upedate2= mysqli_query($enlace,"UPDATE serviciodetalle set idServicioEquipo = NULL ,idServicioCargo=$cargo,estado=1 WHERE idServidor=$idServidor");
}else{
    $query_upedate2= mysqli_query($enlace,"UPDATE serviciodetalle set idServicioEquipo = $equipo,idServicioCargo=$cargo,estado=1 WHERE idServidor=$idServidor");

}




mysqli_close($enlace);
?>