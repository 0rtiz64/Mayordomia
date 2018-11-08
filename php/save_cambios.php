<?php 
include '../gold/enlace.php';
	
	$estado_civil = $_POST['ECIVIL'];
	$estado_genero = $_POST['EGENERO'];
	$estado_transporte = $_POST['ETRANSPORTE'];
	$id_integrante = $_POST['INTEGRANTE'];
	$id_identidad = $_POST['IDENTIDAD1'];
	$nombreI = $_POST['NOMBREI'];
	$FCumple = $_POST['CUMPLE'];
	$direccion = $_POST['DIRECCION'];

	$CELULAR = $_POST['CEL1'];
	$TELEFONO = $_POST['TEL1'];
	$ESTADOS = $_POST['ESTADO1'];
	$GRAD = $_POST['grad'];

	$EQUIPO =$_POST['EQUIPO'];
	$CARGOS=$_POST['CARGOS'];


$promocionActiva = mysqli_query($enlace,"SELECT idpromocion FROM promociones
WHERE `status`=1");
$datoPromocionActiva = mysqli_fetch_array($promocionActiva,MYSQLI_ASSOC);

	$query_upedate = mysqli_query($enlace,"UPDATE integrantes set num_identidad='".$id_identidad."',nombre_integrante='".$nombreI."',fecha_cumple='".$FCumple."',cel='".$CELULAR."',tel='".$TELEFONO."',estado_civil='".$estado_civil."',sexo='".$estado_genero."',trasporte='".$estado_transporte."',direccion='".$direccion."',`status`='".$ESTADOS."' WHERE idintegrante=".$id_integrante);

	$query_upedate2 = mysqli_query($enlace,"UPDATE detalle_integrantes SET `status` ='".$ESTADOS."',id_equipo='".$EQUIPO."', id_cargo ='".$CARGOS."',toga ='".$GRAD."' WHERE    id_integrante=$id_integrante AND  id_promocion =  '".$datoPromocionActiva['idpromocion']."'");


	 $filas1= mysqli_affected_rows($enlace);
	 
	if ($filas1) {
		# code...

		//segundo query
			echo '<div class="alert alert-success" style="text-align: center;"> 
				<strong> REGISTRO EDITADO CORRECTAMENTE!!</strong>
	 			</div>';
		
	}
mysqli_close($enlace);
	
 ?>