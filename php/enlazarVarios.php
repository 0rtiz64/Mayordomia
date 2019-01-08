<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 7/12/2017
 * Time: 11:25
 */
include '../gold/enlace.php';


    $idIntegrante = $_POST["idIntegrante"];
    $idEquipo = $_POST["idEquipo"];
    $queryPromocion = mysqli_query($enlace,"SELECT idpromocion from promociones WHERE `status`=1");
    $idPromocion1 = mysqli_fetch_array($queryPromocion,MYSQLI_ASSOC);
    $idPromocion = $idPromocion1["idpromocion"];
$fechaentrada = date('Y-m-d  h:i:s');

    $E = explode(",", $idIntegrante);

$nn = 0;

/*$procesado = array_unique($E);
$length= count($procesado);
echo $procesado[1];
*/

while ($nn < count($E)) {

$verificarIntegrante= mysqli_num_rows(mysqli_query($enlace,"SELECT * from detalle_integrantes 
INNER JOIN promociones ON detalle_integrantes.id_promocion = promociones.idpromocion
WHERE id_integrante = '.$E[$nn].' AND promociones.`status` =1"));
if($verificarIntegrante>0){

}else{
    $sql1 = mysqli_query($enlace,"INSERT INTO detalle_integrantes (id_integrante,id_promocion,id_equipo,id_cargo,`status`,fecha_registro) VALUES (".$E[$nn].",".$idPromocion.", ".$idEquipo.", 10, 1,'".$fechaentrada."')");

}



    $nn++;
}
echo "<div class='alert alert-success' > <strong>INTEGRANTES ENLAZADOS</strong>  </div>";



?>