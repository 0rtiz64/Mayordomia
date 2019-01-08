<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 31/8/2018
 * Time: 11:21 AM
 */
include  '../gold/enlace.php';
/*
$c=1;
$query = mysqli_query($enlace,"SELECT integrantes.idintegrante,integrantes.nombre_integrante,cargos.idcargo,cargos.nombre_cargo, promociones.desc_promocion from detalle_integrantes 
INNER JOIN integrantes ON detalle_integrantes.id_integrante =  integrantes.idintegrante
INNER JOIN cargos on detalle_integrantes.id_cargo = cargos.idcargo
INNER JOIN promociones on detalle_integrantes.id_promocion = promociones.idpromocion
WHERE detalle_integrantes.id_cargo <> 10 and detalle_integrantes.id_cargo <>9 and detalle_integrantes.id_promocion = 3");

while ($datos = mysqli_fetch_array($query,MYSQLI_ASSOC)){
    $idIntegrante = $datos["idintegrante"];
    $idCargo= $datos["idcargo"];

  $queryInsert = mysqli_query($enlace,"insert into liderazgo (idIntegrante,estado,idCargo) values 
	($idIntegrante,1,$idCargo)");

  echo $c.' '.$datos["nombre_integrante"].' INSERTADO  CON EL CARGO DE '.$datos["nombre_cargo"].'<br>';

  $c++;
};
$c= $c-1;
echo '<h1>'.$c.'PERSONAS INSERTADAS';
*/

/*
$query = mysqli_query($enlace,"SELECT  id_integrante from detalle_integrantes 
INNER JOIN promociones on detalle_integrantes.id_promocion = promociones.idpromocion
where promociones.`status` =1 and detalle_integrantes.id_cargo = 10");

while ($d = mysqli_fetch_array($query,MYSQLI_ASSOC)){
    $id_integrante = $d["id_integrante"];
    $query_upedate = mysqli_query($enlace,"UPDATE detalle_integrantes set toga=2 WHERE id_integrante=".$id_integrante);

}
echo ' QUERY SUCCESSFULL';
*/
/*
$c  =1;
$qC  = mysqli_query($enlace,"SELECT * from corderitos WHERE LENGTH(identidad) <13");
while ($datos = mysqli_fetch_array($qC,MYSQLI_ASSOC)){
$id = $datos["idCorderitos"];
    $update = mysqli_query($enlace,"update corderitos set identidad='' WHERE  idCorderitos = $id");
$c++;
}

echo $c.' REGISTROS ACTUALIZADOS';

*/
?>