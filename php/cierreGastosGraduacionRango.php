<?php
include '../gold/enlace.php';
$fecha1= $_POST["phpFecha1"];
$fecha2= $_POST["phpFecha2"];

$table = "";

$table.='
<table class="table">
    <thead>
    <tr align="center">
        <td onclick="imprimirReporteRango()" colspan="3" style="background-color: #343A40;color: whitesmoke;border-top-right-radius: 10px; border-top-left-radius: 10px"><i class="fa fa-print"></i> IMPRIMIR REPORTE</td>
          <input type="hidden" value="'.$fecha1.'" id="fechaImprimirReciboReporteGastosGraduacion">
          <input type="hidden" value="'.$fecha2.'" id="fechaImprimirReciboReporteGastosGraduacion2">
    </tr>
        <tr align="center">
            <td><strong>TRANS.</strong></td>
            <td><strong>ITEM</strong></td>
            <td><strong>VALOR</strong></td>
        </tr>
    </thead>
    <tbody>
';
$contador = 1;
$queryTiposDePago = mysqli_query($enlace,"SELECT * from tipopago WHERE tipopago.estado = 1 GROUP BY nombre ASC");
while($datosTipoPago = mysqli_fetch_array($queryTiposDePago,MYSQLI_ASSOC)){
    $tipoPago = $datosTipoPago["nombre"];
    $idTipoPago =$datosTipoPago["idTipoPago"];
    $queryValorTotalPorTipoEnFecha = mysqli_query($enlace,"SELECT SUM(valor) as valorTotal from detallepagos WHERE idTipoPago =$idTipoPago and anulado = 0 and CAST(fechaPago AS date) BETWEEN  '".$fecha1."' and  '".$fecha2."' ");
    $datosValorTotalPorTipoEnFecha = mysqli_fetch_array($queryValorTotalPorTipoEnFecha,MYSQLI_ASSOC);
    $valorTotalPorTipoEnFecha = $datosValorTotalPorTipoEnFecha["valorTotal"];
    if($valorTotalPorTipoEnFecha == ""){
        $valorTotalPorTipoEnFecha="0";
    }

    $queryCantidadDeTransaccionesPorItem = mysqli_query($enlace,"SELECT COUNT(*) as cantidades from detallepagos WHERE idTipoPago =$idTipoPago and CAST(fechaPago AS date) BETWEEN  '".$fecha1."' and  '".$fecha2."' ");
    $datosCantidadDeTransaccionesPorItem = mysqli_fetch_array($queryCantidadDeTransaccionesPorItem,MYSQLI_ASSOC);
    $cantidadDeTransaccionesPorItem = $datosCantidadDeTransaccionesPorItem["cantidades"];

    $table.='
<tr align="center">
    <td>'.$cantidadDeTransaccionesPorItem.'</td>
        <td>'.$tipoPago.'</td>
        <td>L.'.$valorTotalPorTipoEnFecha.'.00</td>
    </tr>
';
    $contador++;
}

$queryGranTotal = mysqli_query($enlace,"SELECT SUM(valor) as granTotal from detallepagos WHERE  anulado = 0 and CAST(fechaPago AS date) BETWEEN  '".$fecha1."' and  '".$fecha2."' ");
$datosGranTotal = mysqli_fetch_array($queryGranTotal,MYSQLI_ASSOC);
$granTotal =$datosGranTotal["granTotal"];
if($granTotal ==""){
    $granTotal ="0";
}

$queryGranTotalTransacciones = mysqli_query($enlace,"SELECT COUNT(*) as totalTransacciones from detallepagos WHERE   CAST(fechaPago AS date) BETWEEN  '".$fecha1."' and  '".$fecha2."' ");
$datosGranTotalTransacciones= mysqli_fetch_array($queryGranTotalTransacciones,MYSQLI_ASSOC);
$granTotalTransacciones = $datosGranTotalTransacciones["totalTransacciones"];


$table.='
<tr align="center" style="background-color: #343A40;color: whitesmoke;">
     <td  style="border-bottom-left-radius: 10px">'.$granTotalTransacciones.'</td>
     <td >GRAN TOTAL</td>
     <td style="border-bottom-right-radius: 10px">L.'.$granTotal.'.00</td>
</tr>
    </tbody>
</table>
';
echo $table;
?>