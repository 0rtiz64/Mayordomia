<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 18/7/2019
 * Time: 8:34 AM
 */
include '../gold/enlace.php';

$nombre = $_POST["phpNombre"];
$identidad= $_POST["phpIdentidad"];
$genero = $_POST["phpGenero"];
$fechaNacimiento = $_POST["phpFechaNacimiento"];
$tipoSangre = $_POST["phpTipoSangre"];
$direccion= $_POST["phpDireccion"];
$referencia= $_POST["phpReferencia"];
$tipoCasa= $_POST["phpTipoCasa"];
$transporte= $_POST["phpTransporte"];
$tel1= $_POST["phpTel1"];
$tel2= $_POST["phpTel2"];
$correo= $_POST["phpCorreo"];
$civil= $_POST["phpCivil"];
$conyugue= $_POST["phpConyugue"];
$hijos= $_POST["phpHijos"];
$fechaConversion= $_POST["phpFechaConversion"];
$fechaIglesia= $_POST["phpFechaIglesia"];
$bautismoEspirituSanto= $_POST["phpBautismoEspirituSanto"];
$fechaReconciliacion= $_POST["phpFechaReconciliacion"];
$fechaBautismoAguas= $_POST["phpFechaBautismoAguas"];
$fechaCobertura= $_POST["phpFechaCobertura"];
$promocionCorderitos= $_POST["phpPromocionCorderitos"];
$areas= $_POST["phpAreas"];
$promocionMayordomia= $_POST["phpPromocionMayordomia"];
$expedienteMayordomia= $_POST["phpExpedienteMayordomia"];
$nivelEducativo= $_POST["phpNivelEducativo"];
$profesion= $_POST["phpProfesion"];
$habilidades= $_POST["phpHabilidades"];
$estadoLaboral= $_POST["phpEstadoLaboral"];
$empresa= $_POST["phpEmpresa"];
$puesto= $_POST["phpPuesto"];
$telefonoEmpresa= $_POST["phpTelefonoEmpresa"];
$horario= $_POST["phpHorario"];
$carnet= $_POST["phpCarnet"];
$fechaVigencia= $_POST["phpFechaVigencia"];
$fechaGestion= $_POST["phpFechaGestion"];
$fechaEntrega= $_POST["phpFechaEntrega"];
$nombreCarnet= $_POST["phpNombreCarnet"];
$fechaInicioMayordomia= $_POST["phpFechaInicioMayordomia"];
$equipo= $_POST["phpEquipo"];
$cargo= $_POST["phpCargo"];
$estado= $_POST["phpEstado"];
$observaciones= $_POST["phpObservaciones"];

$confirmar = mysqli_num_rows(mysqli_query($enlace,"SELECT * from servidores where num_identidad ='".$identidad."'"));
if($confirmar>0){
    echo 0;
}else{
    $queryInsertServidor = mysqli_query($enlace,"INSERT INTO servidores (nombre_integrante,sexo,num_identidad,fecha_cumple,tipoSangre,direccion,referencia,trasporte,
cel,tel,correo,estado_civil,conyugue,hijos,f_conversion,f_iglesia,bautismoEs,f_reconciliacion,f_bautismoAguas,f_cobertura,
promMayordomia,expedienteMayordomia,promo_cordero,areas,nivelEducativo,profesion,habilidades,estadoLaboral,empresa,puesto,telEmpresa,horario,
carnet,vigencia,f_gestion,f_entrega,nombreCarnet,f_inicioMayordomia,observaciones,status)
VALUES ('".$nombre."','".$genero."','".$identidad."','".$fechaNacimiento."','".$tipoSangre."','".$direccion."','".$referencia."','".$transporte."',
'".$tel1."','".$tel2."','".$correo."','".$civil."','".$conyugue."','.$hijos.','".$fechaConversion."','".$fechaIglesia."','".$bautismoEspirituSanto."','".$fechaReconciliacion."','".$fechaBautismoAguas."','".$fechaCobertura."',
'.$promocionMayordomia.','".$expedienteMayordomia."','.$promocionCorderitos.','".$areas."','".$nivelEducativo."','".$profesion."','".$habilidades."','".$estadoLaboral."','".$empresa."','".$telefonoEmpresa."','".$horario."',
'".$carnet."','".$fechaVigencia."','".$fechaGestion."','".$fechaEntrega."','".$nombreCarnet."','".$fechaInicioMayordomia."','".$observaciones."',1)");

    echo 1;
}
?>