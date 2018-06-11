<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 23/4/2018
 * Time: 10:58 AM
 */

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
$Equipo=$_POST["phpEquipo"];
$Cargo=$_POST["phpCargo"];
//$Id= $_POST["phpId"];
$fechaentrada = date('Y-m-d  h:i:s');
$NombreMayus = strtoupper($Nombre);


if ($PromCorderitos ==""){
    $PromCorderitos =0;
}

if($FechaCumpleanos ==""){
    $FechaCumpleanos ="1000-01-01";
}



 $query_ver = mysqli_num_rows(mysqli_query($enlace,"SELECT num_identidad FROM servidores WHERE num_identidad='".$Identidad."'"));
if($query_ver >0){



        echo "<div class='alert alert-danger' > <strong>Identidad ya Registrada </strong>  </div>";







}else{

    $ultimoCorrelativo = mysqli_query($enlace,"SELECT max(correlativo +1 ) AS numeroNew FROM servidores  WHERE correlativo LIKE '%99%'");
    $datoUltimoCorrelativo = mysqli_fetch_array($ultimoCorrelativo,MYSQLI_ASSOC);
    $corrNew= $datoUltimoCorrelativo["numeroNew"];
    $query = mysqli_query($enlace,"insert into servidores(promo_cordero,num_identidad,nombre_integrante,fecha_cumple,cel,tel,estado_civil,sexo,trasporte,direccion,areas,apellidoCasada,status,fecha_registro,correlativo) values 
	(".$PromCorderitos.",'".$Identidad."','".$NombreMayus."','".$FechaCumpleanos."','".$Tel1."','".$Tel2."','".$EstadoCivil."','".$Genero."','".$Transporte."','".$Direccion."','".$Areas."','".$ApeCasada."','1','".$fechaentrada."',".$corrNew.")");


    //TOMAR ID INICIO
    $queryTomarId= mysqli_query($enlace,"SELECT idServidor from servidores where num_identidad ='".$Identidad."' ");
    $datosQueryTomarId = mysqli_fetch_array($queryTomarId,MYSQLI_ASSOC);
    $idIntegrante = $datosQueryTomarId["idServidor"];
    //TOMAR ID FIN

if ($Equipo ==""){
    //INSERTAR EN EQUIPO INICIO
    $queryInsertarEnEquipo = mysqli_query($enlace,"insert into serviciodetalle (idServidor,idServicioCargo,fecha,estado) values 
	($idIntegrante,$Cargo,'".$fechaentrada."',1)");
    //INSERTAR EN EQUIPO FIN
}else{
    //INSERTAR EN EQUIPO INICIO
    $queryInsertarEnEquipo = mysqli_query($enlace,"insert into serviciodetalle (idServidor,idServicioEquipo,idServicioCargo,fecha,estado) values 
	($idIntegrante,$Equipo,$Cargo,'".$fechaentrada."',1)");
    //INSERTAR EN EQUIPO FIN
}



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