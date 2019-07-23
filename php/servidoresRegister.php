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
if($hijos ==""){
    $hijos = 0;
}
$fechaConversion= $_POST["phpFechaConversion"];
if($fechaConversion == ""){
    $fechaConversion ="0000-00-00";
}
$fechaIglesia= $_POST["phpFechaIglesia"];
if($fechaIglesia == ""){
    $fechaIglesia ="0000-00-00";
}
$bautismoEspirituSanto= $_POST["phpBautismoEspirituSanto"];

$fechaReconciliacion= $_POST["phpFechaReconciliacion"];
if($fechaReconciliacion == ""){
    $fechaReconciliacion ="0000-00-00";
}

$fechaBautismoAguas= $_POST["phpFechaBautismoAguas"];
if($fechaBautismoAguas == ""){
    $fechaBautismoAguas ="0000-00-00";
}

$fechaCobertura= $_POST["phpFechaCobertura"];
if($fechaCobertura == ""){
    $fechaCobertura ="0000-00-00";
}
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
if($fechaVigencia == ""){
    $fechaVigencia ="0000-00-00";
}

$fechaGestion= $_POST["phpFechaGestion"];
if($fechaGestion == ""){
    $fechaGestion ="0000-00-00";
}

$fechaEntrega= $_POST["phpFechaEntrega"];
if($fechaEntrega == ""){
    $fechaEntrega ="0000-00-00";
}
$nombreCarnet= $_POST["phpNombreCarnet"];
$fechaInicioMayordomia= $_POST["phpFechaInicioMayordomia"];
if($fechaInicioMayordomia == ""){
    $fechaInicioMayordomia ="0000-00-00";
}
$equipo= $_POST["phpEquipo"];
$cargo= $_POST["phpCargo"];
$estado= $_POST["phpEstado"];
$observaciones= $_POST["phpObservaciones"];

$confirmar = mysqli_num_rows(mysqli_query($enlace,"SELECT * from servidores where num_identidad ='".$identidad."'"));
if($confirmar>0){
    echo 0;
}else{

    $ultimoCorrelativo = mysqli_query($enlace,"SELECT max(correlativo +1 ) AS numeroNew FROM servidores ");
    $datoUltimoCorrelativo = mysqli_fetch_array($ultimoCorrelativo,MYSQLI_ASSOC);
    $corrNew= $datoUltimoCorrelativo["numeroNew"];

    $queryInsertServidor = mysqli_query($enlace,"INSERT INTO servidores (nombre_integrante,sexo,num_identidad,fecha_cumple,tipoSangre,direccion,referencia,trasporte,tipoCasa,
cel,tel,correo,estado_civil,conyugue,hijos,f_conversion,f_iglesia,bautismoEs,f_reconciliacion,f_bautismoAguas,f_cobertura,
promMayordomia,expedienteMayordomia,promo_cordero,areas,nivelEducativo,profesion,habilidades,estadoLaboral,empresa,puesto,telEmpresa,horario,
carnet,vigencia,f_gestion,f_entrega,nombreCarnet,f_inicioMayordomia,observaciones,status)
VALUES ('".$nombre."','".$genero."','".$identidad."','".$fechaNacimiento."','".$tipoSangre."','".$direccion."','".$referencia."','".$transporte."','".$tipoCasa."',
'".$tel1."','".$tel2."','".$correo."','".$civil."','".$conyugue."',".$hijos.",'".$fechaConversion."','".$fechaIglesia."','".$bautismoEspirituSanto."','".$fechaReconciliacion."','".$fechaBautismoAguas."','".$fechaCobertura."',
".$promocionMayordomia.",'".$expedienteMayordomia."',".$promocionCorderitos.",'".$areas."','".$nivelEducativo."','".$profesion."','".$habilidades."','".$estadoLaboral."','".$empresa."','".$puesto."','".$telefonoEmpresa."','".$horario."',
'".$carnet."','".$fechaVigencia."','".$fechaGestion."','".$fechaEntrega."','".$nombreCarnet."','".$fechaInicioMayordomia."','".$observaciones."',1)");

}


?>