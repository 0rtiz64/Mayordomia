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
$rango=$_POST["phpRango"];
//$Id= $_POST["phpId"];
$fechaentrada = date('Y-m-d  h:i:s');
$NombreMayus = strtoupper($Nombre);




 $query_ver = mysqli_num_rows(mysqli_query($enlace,"SELECT num_identidad FROM integrantes WHERE num_identidad='".$Identidad."'")); 
if($query_ver >0){
   echo "<div class='alert alert-danger' > <strong>Identidad ya Registrada </strong>  </div>";
   

}else{

 $ultimoCorrelativo = mysqli_query($enlace,"SELECT max(correlativo +1 ) AS numeroNew FROM integrantes ");
 $datoUltimoCorrelativo = mysqli_fetch_array($ultimoCorrelativo,MYSQLI_ASSOC);
 $corrNew= $datoUltimoCorrelativo["numeroNew"];
$query = mysqli_query($enlace,"insert into integrantes (promo_cordero,num_identidad,nombre_integrante,fecha_cumple,cel,tel,estado_civil,sexo,trasporte,direccion,areas,apellidoCasada,status,fecha_registro,correlativo,idRango) values 
	(".$PromCorderitos.",'".$Identidad."','".$NombreMayus."','".$FechaCumpleanos."','".$Tel1."','".$Tel2."','".$EstadoCivil."','".$Genero."','".$Transporte."','".$Direccion."','".$Areas."','".$ApeCasada."','1','".$fechaentrada."',".$corrNew.",".$rango.")");



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