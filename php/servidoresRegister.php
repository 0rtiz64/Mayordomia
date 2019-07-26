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

$fechaConversion = $_POST["phpFechaConversion"];
$fechaIglesia= $_POST["phpFechaIglesia"];

$bautismoEspirituSanto= $_POST["phpBautismoEspirituSanto"];

$fechaReconciliacion= $_POST["phpFechaReconciliacion"];


$fechaBautismoAguas= $_POST["phpFechaBautismoAguas"];


$fechaCobertura= $_POST["phpFechaCobertura"];

$promocionCorderitos= $_POST["phpPromocionCorderitos"];
if($promocionCorderitos == ""){
    $promocionCorderitos = 0;
}
$areas= $_POST["phpAreas"];
$promocionMayordomia= $_POST["phpPromocionMayordomia"];
if($promocionMayordomia == ""){
    $promocionMayordomia =0;
}
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
$registradoPor= $_POST["phpRegistradoPor"];
$fechaentrada = date('Y-m-d  h:i:s');
$estado = 1;
$confirmar = mysqli_num_rows(mysqli_query($enlace,"SELECT * from servidores where num_identidad ='".$identidad."'"));
if($confirmar>0){
    echo 0;
}else{

    $ultimoCorrelativo = mysqli_query($enlace,"SELECT max(correlativo +1 ) AS numeroNew FROM servidores ");
    $datoUltimoCorrelativo = mysqli_fetch_array($ultimoCorrelativo,MYSQLI_ASSOC);
    $corrNew= $datoUltimoCorrelativo["numeroNew"];

$query = mysqli_query($enlace,"INSERT INTO servidores (nombre_integrante,num_identidad,sexo,fecha_cumple,tipoSangre,
direccion,referencia,tipoCasa,trasporte,cel,tel,correo,estado_civil,conyugue,hijos,
f_conversion,f_iglesia,bautismoEs,f_reconciliacion,f_bautismoAguas,f_cobertura,promo_cordero,areas,promMayordomia,expedienteMayordomia,
nivelEducativo,profesion,habilidades,
estadoLaboral,empresa,puesto,telEmpresa,horario,
carnet,vigencia,f_gestion,f_entrega,nombreCarnet,f_inicioMayordomia,observaciones,
fecha_registro, status,registradoPor) 
VALUES
('".$nombre."','".$identidad."','".$genero."','".$fechaNacimiento."','".$tipoSangre."',
'".$direccion."','".$referencia."','".$tipoCasa."','".$transporte."','".$tel1."','".$tel2."','".$correo."','".$civil."','".$civil."',".$hijos.",
'".$fechaConversion."','".$fechaIglesia."','".$bautismoEspirituSanto."','".$fechaReconciliacion."','".$fechaBautismoAguas."','".$fechaCobertura."',".$promocionCorderitos.",'".$areas."',".$promocionMayordomia.",'".$expedienteMayordomia."',
'".$nivelEducativo."','".$profesion."','".$habilidades."',
'".$estadoLaboral."','".$empresa."','".$puesto."','".$telefonoEmpresa."','".$horario."',
'".$carnet."','".$fechaVigencia."','".$fechaGestion."','".$fechaEntrega."','".$nombreCarnet."','".$fechaInicioMayordomia."','".$observaciones."',
'".$fechaentrada."',
1,'".$registradoPor."')");


$queryTomarId  = mysqli_query($enlace,"SELECT * from servidores where num_identidad = '".$identidad."'");
$datosTomarId = mysqli_fetch_array($queryTomarId,MYSQLI_ASSOC);
$idServidor = $datosTomarId["idServidor"];

$InsertarEquipo = mysqli_query($enlace,"INSERT INTO serviciodetalle 
(idServidor,idServicioEquipo,idServicioCargo,fecha,estado)
VALUES 
(".$idServidor.",".$equipo.",".$cargo.",'".$fechaentrada."',".$estado.")
");

echo $corrNew;


}

?>