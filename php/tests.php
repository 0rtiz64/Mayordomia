<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 31/8/2018
 * Time: 11:21 AM
 */
include  '../gold/enlace.php';
/*

$querySeleccionarCel = mysqli_query($enlace,"SELECT * FROM integrantes where correlativo >19010000 and  LENGTH(tel) = 11");
$C=1;
while ($datos= mysqli_fetch_array($querySeleccionarCel,MYSQLI_ASSOC)){
    $p1 = substr($datos["tel"],1,9);
    $p2 = substr($datos["cel"],4,8);
    $cel = $p1.'-'.$p2;
    echo $C.'-----'.$datos["nombre_integrante"].'-----CEL VIEJO:->'.$datos["tel"].'----------'.'CEL NUEVO:->'.$p1;
    echo'<br>';
  // $idIntegrante = $datos["idintegrante"];
   // $uptade = mysqli_query($enlace,"UPDATE integrantes set cel=$p1 WHERE idintegrante=$idIntegrante");
    $C++;
}
*/

/*
$queryAgregarLiderazgo = mysqli_query($enlace,"SELECT  integrantes.idintegrante,idcargo from detalle_integrantes 
INNER JOIN integrantes on detalle_integrantes.id_integrante = integrantes.idintegrante
INNER JOIN cargos on detalle_integrantes.id_cargo = cargos.idcargo
WHERE id_equipo = 112 AND integrantes.idintegrante  IN (SELECT liderazgo.idIntegrante
                       FROM liderazgo) GROUP BY integrantes.nombre_integrante ASC");
$c=1;
while($datosAgregarLiderazgo = mysqli_fetch_array($queryAgregarLiderazgo,MYSQLI_ASSOC)){
    $idIntegrante = $datosAgregarLiderazgo["idintegrante"];
    $idCargo = $datosAgregarLiderazgo["idcargo"];
    $insertarEnTabla = mysqli_query($enlace,"insert into liderazgo (idIntegrante,estado,idCargo) values 
    $insertarEnTabla = mysqli_query($enlace,"UPDATE liderazgo SET estado = 2");
    $c++;

}

echo $c." REGISTROS INSERTADOS GUEY :V";
*/

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
//EQUIPO LIDERAZGO INICIO
    $queryLiderazgo = mysqli_query($enlace,"SELECT * FROM detalle_integrantes WHERE id_equipo = 89 and `status` = 1");
    while($datosLiderazgo = mysqli_fetch_array($queryLiderazgo,MYSQLI_ASSOC)){
        $idIntegrante = $datosLiderazgo["id_integrante"];
        $idCargo= $datosLiderazgo["id_cargo"];
      echo  $idIntegrante.'-'.$idCargo.'<br>';
        $queryInsert = mysqli_query($enlace,"insert into detalle_integrantes (id_integrante,STATUS,id_cargo,id_equipo, id_promocion)  values
	($idIntegrante,1,$idCargo,112,5)");
    }
//EQUIPO LIDERAZGO FINAL



/*
//COMPARAR FICHA CON FOTO INICIA
$queryPromoActual = mysqli_query($enlace,"SELECT * FROM integrantes WHERE correlativo > 19010000");
while ($datos = mysqli_fetch_array($queryPromoActual,MYSQLI_ASSOC)){

    //INICIO RUTA IMAGEN
    $rutaImg1F="../Fotos/";
    $finRutaF=".jpg";
    $identidadF =$datos["num_identidad"];
    $rutaImg2F=$rutaImg1F.$identidadF.$finRutaF;
//FIN RUTA IMAGEN

    if(file_exists($rutaImg2F)){

    }else{
        echo $datos["correlativo"]." NO TIENE FOTO </br>" ;
    }
}
//COMPARAR FICHA CON FOTO FINAL
*/


/* VERIFICAS QUE INTEGRANTES DE LA TABLA DE LIDERAZGO ESTAN ACTIVOS COMO PASTOREADORES EN TABLA Y ACTIVOS COMO LIDERAZGO EN TABLA
$queryTomarPast = mysqli_query($enlace,"SELECT * from pastoreadores WHERE estado =1 ");
$c = 1;
while ($datosPast = mysqli_fetch_array($queryTomarPast,MYSQLI_ASSOC)){
    $id = $datosPast["idIntegrante"];
    $confirmarEnLid = mysqli_num_rows(mysqli_query($enlace,"SELECT * from liderazgo WHERE idIntegrante= $id "));
    if($confirmarEnLid>0){
        $query =mysqli_query($enlace,"SELECT * from liderazgo WHERE idIntegrante= $id ");
        $datoEncontrado = mysqli_fetch_array($query,MYSQLI_ASSOC);
        echo $id.'<br>';
    }
    $c++;
}
*/
echo "SCRIPT COMENTADO";
?>