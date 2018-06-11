<?php
/**
 * Created by PhpStorm.
 * User: Megacenter
 * Date: 26/12/2017
 * Time: 11:33
 */
include_once '../gold/enlace.php';

$identidad = $_POST["phpId"];
$nombre= $_POST["phpNombre"];

$verificar = mysqli_num_rows(mysqli_query($enlace,"SELECT num_identidad from integrantes
where num_identidad = $identidad  "));

if($verificar >0){
    echo "<div class='alert alert-danger' > <strong>PASTOREADOR YA EXISTE</strong>  </div>";
}else{
    $insertarIntegrante = mysqli_query($enlace,"insert into integrantes (num_identidad,nombre_integrante,status) values 
	(".$identidad.",'".$nombre."',1)");

    $tomarIdQuery = mysqli_query($enlace,"SELECT idintegrante FROM integrantes
WHERE num_identidad =$identidad");
    $datoIdIntegrante = mysqli_fetch_array($tomarIdQuery,MYSQLI_ASSOC);
    $idIntegrante= $datoIdIntegrante["idintegrante"];

    $insertPast = mysqli_query($enlace,"insert into detalle_integrantes (id_integrante,id_cargo,status) values 
	(".$idIntegrante.",9,1)");

    if(mysqli_affected_rows($enlace)){
        echo "<div class='alert alert-success' > <strong>PASTOREADOR GUARDADO</strong>  </div>";
    }
}



?>