<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 10/4/2018
 * Time: 11:28 AM
 */
include '../gold/enlace.php';
$idIntegrante = $_POST["idIntegrante"];
$idArea = $_POST["idEquipo"];
$integrador= $_POST["integrador"];
$queryPromocion = mysqli_query($enlace,"SELECT idpromocion from promociones WHERE `status`=1");
$idPromocion1 = mysqli_fetch_array($queryPromocion,MYSQLI_ASSOC);
$idPromocion = $idPromocion1["idpromocion"];
$fechaentrada = date('Y-m-d  h:i:s');


$E = explode(",", $idIntegrante);
$nn = 1;

while ($nn < count($E)) {
$query = "SELECT * from integracion 
INNER JOIN promociones on integracion.idPromocion = promociones.idpromocion
WHERE integracion.idIntegrante = $E[$nn] and integracion.idArea = $idArea AND promociones.`status` = 1";
    $verificar = mysqli_num_rows(mysqli_query($enlace,$query));


    if($verificar==0){
        $sql1 = mysqli_query($enlace,"INSERT INTO integracion (idIntegrante,idArea,idPromocion,fechaEntrada,integrador) VALUES (".$E[$nn].",".$idArea.", ".$idPromocion.",'".$fechaentrada."',".$integrador.")");
    }



    $nn++;
}



$botones =' <div class="alert alert-success"  align="center"> <strong>OVEJAS INTEGRADAS</strong>  </div>
 <a href="php/pdfIntegrados.php?area='.$idArea.'" target="_blank" class="btn btn-danger" style="color: #ffffff">EXPORTAR A PDF</a> 
 <a href="php/EXCELIntegrados.php?area='.$idArea.'"  class="btn btn-success" style="color: #ffffff">EXPORTAR A EXCEL</a>';

#?'.$idArea.'=area

echo $botones;
?>