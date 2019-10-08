<?php
include  '../gold/enlace.php';
$fecha1 = $_GET["fecha"];
$fecha2 = $_GET["fecha2"];
$queryPromoActiva = mysqli_query($enlace,"SELECT * from promociones where `status` =1");
$datosPromoActiva = mysqli_fetch_array($queryPromoActiva,MYSQLI_ASSOC);
$promocion = $datosPromoActiva["desc_promocion"];

$dia = substr($fecha1,8,2);
$mes = substr($fecha1,5,2);
$aaa = substr($fecha1,0,4);

switch ($mes){
    case 01:
        $miMes = "ENE";
        break;

    case 02:
        $miMes = "FEB";
        break;

    case 03:
        $miMes = "MAR";
        break;

    case 04:
        $miMes = "ABR";
        break;

    case 05:
        $miMes = "MAY";
        break;

    case 06:
        $miMes = "JUN";
        break;

    case 07:
        $miMes = "JUL";
        break;

    case "08":
        $miMes = "AGO";
        break;

    case "09":
        $miMes = "SEP";
        break;

    case 10:
        $miMes = "OCT";
        break;

    case 11:
        $miMes = "NOV";
        break;

    case 12:
        $miMes = "DIC";
        break;
}


$fCompleta = $dia."-".$miMes."-".$aaa;

$print = "";

$print.='
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <script >
        window.print();
    </script>
</head>
<body>
<p align="center" style="font-size: x-small;font-family: \'Arial\'">IGLESIA DE CRISTO EBENEZER</p>
<p align="center" style="font-size: x-small;font-family: \'Arial\'">ESCUELA DE MAYORDOMIA</p>
<p align="center" style="font-size: x-small;font-family: \'Arial\'">REPORTE GASTOS GRADUACION</p>
<p align="center" style="font-size: x-small;font-family: \'Arial\'">'.$promocion.' -  '.$fCompleta.'</p>
<hr>
<table>
    <thead>
    <tr align="center" style="font-size: x-small;font-family: \'Arial\'">
        <td>Trans.</td>
        <td>ITEM</td>
        <td>VALOR</td>
    </tr>
    </thead>
    <tbody>
';

$queryTiposDePago = mysqli_query($enlace,"SELECT * from tipopago WHERE tipopago.estado = 1 GROUP BY nombre ASC");
while($datosTipoPago = mysqli_fetch_array($queryTiposDePago,MYSQLI_ASSOC)) {
    $tipoPago = $datosTipoPago["nombre"];
    $idTipoPago = $datosTipoPago["idTipoPago"];
    $queryValorTotalPorTipoEnFecha = mysqli_query($enlace,"SELECT SUM(valor) as valorTotal from detallepagos WHERE idTipoPago =$idTipoPago and anulado = 0 and CAST(fechaPago AS date) BETWEEN  '".$fecha1."' and  '".$fecha2."' ");
    $datosValorTotalPorTipoEnFecha = mysqli_fetch_array($queryValorTotalPorTipoEnFecha, MYSQLI_ASSOC);
    $valorTotalPorTipoEnFecha = $datosValorTotalPorTipoEnFecha["valorTotal"];
    if ($valorTotalPorTipoEnFecha == "") {
        $valorTotalPorTipoEnFecha = "0";
    }

    $queryCantidadDeTransaccionesPorItem = mysqli_query($enlace,"SELECT COUNT(*) as cantidades from detallepagos WHERE idTipoPago =$idTipoPago and CAST(fechaPago AS date) BETWEEN  '".$fecha1."' and  '".$fecha2."' ");
    $datosCantidadDeTransaccionesPorItem = mysqli_fetch_array($queryCantidadDeTransaccionesPorItem, MYSQLI_ASSOC);
    $cantidadDeTransaccionesPorItem = $datosCantidadDeTransaccionesPorItem["cantidades"];

    $print .= '
 <tr align="center" style="font-size: x-small;font-family: \'Arial\'">
            <td>' . $cantidadDeTransaccionesPorItem . '</td>
            <td>' . $tipoPago . '</td>
            <td ><p style="margin-left: -10%">L.'.$valorTotalPorTipoEnFecha .'.00</p></td>
        </tr>
        
   
';
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

$print.='

       
        <tr align="center" style="font-size: x-small;font-family: \'Arial\'">
            <td colspan="3"><hr> </td>

        </tr>
        <tr align="center" style="font-size: x-small;font-family: \'Arial\'">
            <td>'.$granTotalTransacciones.'</td>
            <td>GRAN TOTAL</td>
            <td>L.'.$granTotal.'.00</td>
        </tr>
    </tbody>
</table>
</body>
</html>
';

echo  $print;

?>
<?php
