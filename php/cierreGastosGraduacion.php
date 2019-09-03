<?php
include '../gold/enlace.php';
$fecha= $_POST["phpFecha"];

$table = "";

$table.='
<table class="table ">
    <thead>
        <tr align="center">
            <td><strong>#</strong></td>
            <td><strong>ITEM</strong></td>
            <td><strong>VALOR</strong></td>
        </tr>
    </thead>
    <tbody>
';
$contador = 1;
$queryTiposDePago = mysqli_query($enlace,"SELECT * from tipopago WHERE tipopago.estado = 1");
while($datosTipoPago = mysqli_fetch_array($queryTiposDePago,MYSQLI_ASSOC)){
$tipoPago = $datosTipoPago["nombre"];
$idTipoPago =$datosTipoPago["idTipoPago"];
$queryValorTotalPorTipoEnFecha = mysqli_query($enlace,"SELECT SUM(valor) as valorTotal from detallepagos WHERE idTipoPago =$idTipoPago and CAST(fechaPago AS date) = '".$fecha."'");
$datosValorTotalPorTipoEnFecha = mysqli_fetch_array($queryValorTotalPorTipoEnFecha,MYSQLI_ASSOC);
$valorTotalPorTipoEnFecha = $datosValorTotalPorTipoEnFecha["valorTotal"];
if($valorTotalPorTipoEnFecha == ""){
    $valorTotalPorTipoEnFecha=0;
}
$table.='
<tr align="center">
    <td>'.$contador.'</td>
        <td>'.$tipoPago.'</td>
        <td>'.$valorTotalPorTipoEnFecha.'</td>
    </tr>
';
    $contador++;
}

$queryGranTotal = mysqli_query($enlace,"SELECT SUM(valor) as granTotal from detallepagos WHERE  CAST(fechaPago AS date) = '".$fecha."'");
$datosGranTotal = mysqli_fetch_array($queryGranTotal,MYSQLI_ASSOC);
$granTotal =$datosGranTotal["granTotal"];
$table.='
<tr align="center" style="background-color: #343A40;color: whitesmoke;">
     <td colspan="2" >GRAN TOTAL</td>
     <td>'.$granTotal.'</td>
</tr>
    </tbody>
</table>
';
echo $table;
?>