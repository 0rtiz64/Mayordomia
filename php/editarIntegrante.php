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
	$bautizado = $_POST['phpBautizado'];
	$registradoPor = $_POST['phpRegistradoPor'];
$fechaentrada = date('Y-m-d  h:i:s');

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
$totalCantidad= $rango1+$rango2+$rango3+$rango4+$rango5+$rango6;


$documentos=$_POST["phpDocumentos"];
$RespuestaDocumentos=$_POST["phpRespuestaDocumentos"];


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

    $query_upedate = mysqli_query($enlace,"UPDATE integrantes set num_identidad='".$identidad."',nombre_integrante='".$nombre."',fecha_cumple='".$cumple."',cel='".$cel."',tel='".$tel."',estado_civil='".$estadoCivil."',sexo='".$genero."',trasporte='".$transporte."',direccion='".$direccion."',`status`='1',correlativo='".$corrNew."', promo_cordero =".$promoCorderitos.", fecha_registro = '".$fechaentrada."',documentosRespuesta = '".$RespuestaDocumentos."',documentosPendientes = '".$documentos."',bautizado = '".$bautizado."', registradoPor = '".$registradoPor."' WHERE idintegrante=".$id_integrante);

    $verificarEnRangos = mysqli_num_rows(mysqli_query($enlace,"SELECT * from rangos WHERE idIntegrante = $id_integrante"));
    if($verificarEnRangos>0){
        $upedateRangos = mysqli_query($enlace,"UPDATE rangos set  rangos.`0-2`=$rango1,rangos.`2-3`=$rango2,rangos.`4-5`=$rango3,rangos.`6-7`=$rango4,rangos.`8-11`=$rango5,rangos.otros=$rango6,rangos.total=$totalCantidad
WHERE idintegrante=$id_integrante");
    }else{
        $queryInsertRangos = mysqli_query($enlace,"insert into rangos (rangos.idIntegrante,rangos.`0-2`,rangos.`2-3`,rangos.`4-5`,rangos.`6-7`,rangos.`8-11`,rangos.otros,rangos.total) 
values 
('".$id_integrante."','".$rango1."','".$rango2."','".$rango3."','".$rango4."','".$rango5."','".$rango6."','".$totalCantidad."')");
    }


}else{
    $ultimoCorrelativo = mysqli_query($enlace,"SELECT max(correlativo +1 ) AS numeroNew FROM integrantes ");
    $datoUltimoCorrelativo = mysqli_fetch_array($ultimoCorrelativo,MYSQLI_ASSOC);
    $corrNew= $datoUltimoCorrelativo["numeroNew"];

    $query_upedate = mysqli_query($enlace,"UPDATE integrantes set num_identidad='".$identidad."',nombre_integrante='".$nombre."',fecha_cumple='".$cumple."',cel='".$cel."',tel='".$tel."',estado_civil='".$estadoCivil."',sexo='".$genero."',trasporte='".$transporte."',direccion='".$direccion."',`status`='1' , promo_cordero =".$promoCorderitos.", fecha_registro = '".$fechaentrada."',documentosRespuesta = '".$RespuestaDocumentos."',documentosPendientes = '".$documentos."',correlativo='".$corrNew."', bautizado ='".$bautizado."',registradoPor = '".$registradoPor."' WHERE idintegrante=".$id_integrante);
    $verificarEnRangos = mysqli_num_rows(mysqli_query($enlace,"SELECT * from rangos WHERE idIntegrante = $id_integrante"));
    if($verificarEnRangos>0){
        $upedateRangos = mysqli_query($enlace,"UPDATE rangos set  rangos.`0-2`=$rango1,rangos.`2-3`=$rango2,rangos.`4-5`=$rango3,rangos.`6-7`=$rango4,rangos.`8-11`=$rango5,rangos.otros=$rango6,rangos.total=$totalCantidad
WHERE idintegrante=$id_integrante");
    }else{
        $queryInsertRangos = mysqli_query($enlace,"insert into rangos (rangos.idIntegrante,rangos.`0-2`,rangos.`2-3`,rangos.`4-5`,rangos.`6-7`,rangos.`8-11`,rangos.otros,rangos.total) 
values 
('".$id_integrante."','".$rango1."','".$rango2."','".$rango3."','".$rango4."','".$rango5."','".$rango6."','".$totalCantidad."')");
    }

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