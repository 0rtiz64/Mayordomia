<?php
include '../gold/enlace.php';

$identidada = $_POST['phpIdentidad'];
$nombre = $_POST['phpNombre'];
$cel = $_POST['phpCel'];
$tel= $_POST['phpTel'];
$fijo= $_POST['phpRF'];
$area1 = $_POST['phpArea1'];
$area2 = $_POST['phpArea2'];
$area3 = $_POST['phpArea3'];
$area4 = $_POST['phpArea4'];
$area5 = $_POST['phpArea5'];






$query_ver = mysqli_num_rows(mysqli_query($enlace,"SELECT identidad FROM ovejas WHERE identidad='".$identidada."'"));
if($query_ver >0){
    echo "<div class='alert alert-danger' > <strong>OVEJA YA INTEGRADA</strong>  </div>";


}else{


    $query = mysqli_query($enlace,"insert into ovejas (identidad,nombre,cel,tel,fijo,area1,area2,area3,area4,area5 ) values 
	('".$identidada."','".$nombre."','".$cel."','".$tel."','".$fijo."','".$area1."','".$area2."','".$area3."','".$area4."','".$area5."')");


    /*$queryUpdate = mysqli_query($enlace,"UPDATE integrantes SET nombre_integrante='".$nombre."', cel='".$cel."',tel='".$tel."'
 WHERE num_identidad =$identidada");
*/
    if (mysqli_affected_rows($enlace)>0) {

        echo "<div class='alert alert-success' > <strong>OVEJA INTEGRADA EXITOSAMENTE</strong>  </div>";

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