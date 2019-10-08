<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 19/8/2019
 * Time: 2:53 PM
 */
include '../gold/enlace.php';
$idIntegrante =$_POST["phpIdIntegrante"];
$valor=$_POST["phpValor"];
$tipoPago=$_POST["phpTipoPago"];

$queryTotalAbonado = mysqli_query($enlace,"SELECT SUM(valor) as totalAbonado FROM detallepagos 
INNER JOIN promociones on detallepagos.idPromocion = promociones.idpromocion
WHERE idIntegrante=$idIntegrante and promociones.`status`= 1 and detallepagos.anulado = 0");
$datosTotalAbonado= mysqli_fetch_array($queryTotalAbonado,MYSQLI_ASSOC);
$totalAbonado = $datosTotalAbonado["totalAbonado"];

if($totalAbonado ==""){
    $totalAbonado =0;
}

$queryTotalGastos = mysqli_query($enlace,"SELECT * from pagospromocion 
INNER JOIN promociones on pagospromocion.idPromocion = promociones.idpromocion
where promociones.`status`=1");
$datosTotalGastos = mysqli_fetch_array($queryTotalGastos,MYSQLI_ASSOC);
$totalGastos = $datosTotalGastos["valor"];

$saldoPendiente = $totalGastos-$totalAbonado;

if($tipoPago == 2){
    //PAGO TOTAL
echo $totalGastos;

}else{
    //ABONO,REPOSICION,OTROS
    if($valor > $saldoPendiente){
        echo 1;
    }


}


?>