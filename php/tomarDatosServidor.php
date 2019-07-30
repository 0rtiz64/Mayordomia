<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 29/7/2019
 * Time: 8:20 AM
 */
include '../gold/enlace.php';
$identidad = $_POST["phpIdentidad"];

$query = mysqli_query($enlace,"SELECT * from servidores where num_identidad = '".$identidad."'");
$datos = mysqli_fetch_array($query,MYSQLI_ASSOC);

$nombre= $datos["nombre_integrante"];
$genero= $datos["sexo"];
$fechaNacimiento= $datos["fecha_cumple"];
$tipoSangre= $datos["tipoSangre"];
$direccion= $datos["direccion"];
$referencia= $datos["referencia"];
$tipoCasa= $datos["tipoCasa"];
$transporte= $datos["trasporte"];
$tel1= $datos["tel1"];
$tel2= $datos["tel2"];
$correo= $datos["correo"];
$civil= $datos["estado_civil"];
$conyugue= $datos["conyugue"];
$hijos= $datos["hijos"];
$fechaConversion= $datos["f_conversion"];
$fechaIglesia= $datos["f_iglesia"];
$bautismoEs= $datos["bautismoEs"];
$fechaReconciliacion= $datos["f_reconciliacion"];
$fechaBautismoAguas= $datos["f_bautismoAguas"];
$fechaCobertura= $datos["f_cobertura"];
$promocionCorderitos= $datos["promo_cordero"];
$areas= $datos["areas"];
$promocionMayordomia= $datos["promMayordomia"];
$expediente= $datos["expedienteMayordomia"];
$nivelEducativo= $datos["expedienteMayordomia"];
