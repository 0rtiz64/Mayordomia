<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 18/1/2018
 * Time: 4:06 PM
 */

include '../gold/enlace.php';

	$id_integrante = $_POST['phpIdIntegrante'];
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
$fechaentrada = date('Y-m-d  h:i:s');


$promocionActiva = mysqli_query($enlace,"SELECT idpromocion FROM promociones
WHERE `status`=1");
$datoPromocionActiva = mysqli_fetch_array($promocionActiva,MYSQLI_ASSOC);




$consultaSiTieneCorrelativo = mysqli_query($enlace,"SELECT  correlativo from integrantes
WHERE idintegrante=".$id_integrante);
$datoConsultaSiTieneCorrelativo = mysqli_fetch_array($consultaSiTieneCorrelativo,MYSQLI_ASSOC);
$correlativoActual = $datoConsultaSiTieneCorrelativo["correlativo"];

if($correlativoActual ==""){
    $ultimoCorrelativo = mysqli_query($enlace,"SELECT max(correlativo +1 ) AS numeroNew FROM integrantes ");
    $datoUltimoCorrelativo = mysqli_fetch_array($ultimoCorrelativo,MYSQLI_ASSOC);
    $corrNew= $datoUltimoCorrelativo["numeroNew"];

    $query_upedate = mysqli_query($enlace,"UPDATE integrantes set num_identidad='".$identidad."',nombre_integrante='".$nombre."',fecha_cumple='".$cumple."',cel='".$cel."',tel='".$tel."',estado_civil='".$estadoCivil."',sexo='".$genero."',trasporte='".$transporte."',direccion='".$direccion."',`status`='1',correlativo='".$corrNew."', promo_cordero =".$promoCorderitos.", fecha_registro = '".$fechaentrada."' WHERE idintegrante=".$id_integrante);
}else{
    $query_upedate = mysqli_query($enlace,"UPDATE integrantes set num_identidad='".$identidad."',nombre_integrante='".$nombre."',fecha_cumple='".$cumple."',cel='".$cel."',tel='".$tel."',estado_civil='".$estadoCivil."',sexo='".$genero."',trasporte='".$transporte."',direccion='".$direccion."',`status`='1' , promo_cordero =".$promoCorderitos.", fecha_registro = '".$fechaentrada."' WHERE idintegrante=".$id_integrante);

}

	 $filas1= mysqli_affected_rows($enlace);

	if ($filas1) {
        # code...

        //segundo query
        echo '<div class="alert alert-success" style="text-align: center;"> 
				<strong> REGISTRO EDITADO CORRECTAMENTE</strong>
	 			</div>';

    }else{
        echo '<div class="alert alert-warning" style="text-align: center;"> 
				<strong> DEBES REALIZAR UN CAMBIO PARA GUARDAR</strong>
	 			</div>';
    }
mysqli_close($enlace);

 ?>