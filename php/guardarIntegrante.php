<?php 
include '../gold/enlace.php';
//$corr =$_POST["phpCorr"];
$PromCorderitos=$_POST["phpPromoCordero"];
$EstadoCivil=$_POST["phpEstadoCivil"];
$Genero=$_POST["phpGenero"];
$Transporte=$_POST["phpTransporte"];
$Identidad=$_POST["phpIdentidad"];
$Nombre=$_POST["phpNombre"];
$ApeCasada=$_POST["phpApeCasada"];
$FechaCumpleanos=$_POST["phpFechaCumpleanos"];
$Tel1=$_POST["phpTel1"];
$Tel2=$_POST["phpTel2"];
$IntegradoRes=$_POST["phpIntegradoRes"];
$Areas=$_POST["phpAreas"];
$Direccion=$_POST["phpDireccion"];


$rango1=$_POST["phpRango1"];
$rango2=$_POST["phpRango2"];
$rango3=$_POST["phpRango3"];
$rango4=$_POST["phpRango4"];
$rango5=$_POST["phpRango5"];
$rango6=$_POST["phpRango6"];

if($rango1 == ""){
    $rango1 = 0;
}

if($rango2 == ""){
    $rango2 = 0;
}
if($rango3 == ""){
    $rango3 = 0;
}
if($rango4 == ""){
    $rango4 = 0;
}
if($rango5 == ""){
    $rango5 = 0;
}
if($rango6 == ""){
    $rango6 = 0;
}

$documentos=$_POST["phpDocumentos"];
$RespuestaDocumentos=$_POST["phpRespuestaDocumentos"];



$fechaentrada = date('Y-m-d  h:i:s');
$NombreMayus = strtoupper($Nombre);




 $query_ver = mysqli_num_rows(mysqli_query($enlace,"SELECT num_identidad FROM integrantes WHERE num_identidad='".$Identidad."'")); 
if($query_ver >0){
   echo "<div class='alert alert-danger' > <strong>Identidad ya Registrada </strong>  </div>";
   

}else{

 $ultimoCorrelativo = mysqli_query($enlace,"SELECT max(correlativo +1 ) AS numeroNew FROM integrantes ");
 $datoUltimoCorrelativo = mysqli_fetch_array($ultimoCorrelativo,MYSQLI_ASSOC);
 $corrNew= $datoUltimoCorrelativo["numeroNew"];
$query = mysqli_query($enlace,"insert into integrantes (promo_cordero,num_identidad,nombre_integrante,fecha_cumple,cel,tel,estado_civil,sexo,trasporte,direccion,areas,apellidoCasada,status,fecha_registro,correlativo,documentosRespuesta,documentosPendientes) values 
	(".$PromCorderitos.",'".$Identidad."','".$NombreMayus."','".$FechaCumpleanos."','".$Tel1."','".$Tel2."','".$EstadoCivil."','".$Genero."','".$Transporte."','".$Direccion."','".$Areas."','".$ApeCasada."','1','".$fechaentrada."',".$corrNew.",'".$RespuestaDocumentos."','".$documentos."')");


$total = $rango1+$rango2+$rango3+$rango4+$rango5+$rango6;
$encontrarIdIntegrante = mysqli_query($enlace,"select idintegrante from integrantes WHERE num_identidad = '".$Identidad."'");
$arrayEncontrarIdIntegrante= mysqli_fetch_array($encontrarIdIntegrante,MYSQLI_ASSOC);
$idIntegrante = $arrayEncontrarIdIntegrante["idintegrante"];

$queryInsertRangos = mysqli_query($enlace,"insert into rangos (rangos.idIntegrante,rangos.`0-2`,rangos.`2-3`,rangos.`4-5`,rangos.`6-7`,rangos.`8-11`,rangos.otros,rangos.total) 
values 
('".$idIntegrante."','".$rango1."','".$rango2."','".$rango3."','".$rango4."','".$rango5."','".$rango6."','".$total."')");


 if (mysqli_affected_rows($enlace)>0) {
     echo "<div class='alert alert-success' > <strong>Registro Guardado</strong>  </div>";

 	/* 
 	echo "<script>";
	echo "recargarNumeroExpediente(".$Id.");";
	echo "</script>";*/
 	}

 else{
 	echo mysqli_error($enlace);
 }
 mysqli_close($enlace);
}



 ?>