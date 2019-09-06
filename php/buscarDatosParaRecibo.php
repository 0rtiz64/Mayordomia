<?php
include '../gold/enlace.php';
$idDetallePago = $_POST["phpIdDetallePago"];

$query = mysqli_query($enlace,"SELECT promociones.desc_promocion as promocion, CAST(detallepagos.fechaPago AS DATE) as fecha,
detallepagos.numeroRecibo as numRecibo,integrantes.nombre_integrante as nombre,integrantes.correlativo as expediente,
equipos.num_equipo as numEquipo,equipos.nombre_equipo as nombEquipo,detallepagos.valor,tipopago.nombre as tipopago,
detallepagos.saldoAnt as saldoAnterior, detallepagos.saldoAct as saldoActual,detallepagos.nombreServidor,servicioequipos.nombreEquipo
 from detallepagos
INNER JOIN tipopago on detallepagos.idTipoPago = tipopago.idTipoPago
INNER JOIN integrantes on detallepagos.idIntegrante = integrantes.idintegrante
INNER JOIN detalle_integrantes on detallepagos.idIntegrante = detalle_integrantes.id_integrante
INNER JOIN equipos on detalle_integrantes.id_equipo = equipos.id_equipo
INNER JOIN promociones on detallepagos.idPromocion = promociones.idpromocion
INNER JOIN servicioequipos on detallepagos.equipoServicio = servicioequipos.idEquipo
WHERE detallepagos.idDetallePagos = $idDetallePago");
$datos = mysqli_fetch_array($query,MYSQLI_ASSOC);
$equipo = $datos["numEquipo"].'-'.$datos["nombEquipo"];


//CONVERTIR FECHA INICIO
$fecha = $datos["fecha"];
$dia = substr($fecha,8,2);
$mes = substr($fecha,5,2);
$aaa = substr($fecha,0,4);

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
        $miMes = "SEPT";
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
//CONVERTIR FECHA FINAL

$datos = array(
    0 => $datos["promocion"],
    1 => $fCompleta,
    2 => $datos["numRecibo"],
    3 => $datos["nombre"],
    4 => $datos["expediente"],
    5 => $equipo,
    6 => $datos["valor"],
    7 => $datos["tipopago"],
    8 => $datos["saldoAnterior"],
    9=> $datos["saldoActual"],
    10=> $datos["nombreServidor"],
    11=> $datos["nombreEquipo"]

);
echo json_encode($datos);

?>