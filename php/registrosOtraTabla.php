<?php
/**
 * Created by PhpStorm.
 * User: Mayor
 * Date: 26/4/2018
 * Time: 3:02 PM
 */

include '../gold/enlace.php';
$contador =0;
$query = mysqli_query($enlace,"SELECT * from integrantes where 
correlativo> 990000 AND correlativo <18010000");
while ($dato =mysqli_fetch_array($query,MYSQLI_ASSOC)){
    $insertar = mysqli_query($enlace," insert into servidores (promo_cordero,num_identidad,nombre_integrante,fecha_cumple,cel,tel,estado_civil,sexo,trasporte,direccion,areas,apellidoCasada,status,fecha_registro,correlativo) values 
	(".$dato["promo_cordero"].",'".$dato["num_identidad"]."','".$dato["nombre_integrante"]."','".$dato["fecha_cumple"]."','".$dato["cel"]."','".$dato["tel"]."','".$dato["estado_civil"]."','".$dato["sexo"]."','".$dato["trasporte"]."','".$dato["direccion"]."','".$dato["areas"]."','".$dato["apellidoCasada"]."','1','".$dato["fecha_registro"]."',".$dato["correlativo"].")");

echo $contador." ".$dato["nombre_integrante"]." INSERTADO";
$contador++;
}


?>