<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 2/3/2018
 * Time: 9:45 AM
 */

include '../gold/enlace.php';
require_once 'dompdf2/autoload.inc.php';
use Dompdf\Dompdf;
$filas = "";
$idArea=$_GET["area"];
$contador =1;
$fechaSistemaVerifica = "".date('Y-m-d')."";

$dia = substr($fechaSistemaVerifica,8,2);
$mes = substr($fechaSistemaVerifica,5,2);
$aaa = substr($fechaSistemaVerifica,0,4);

switch ($mes){
    case 01:
        $miMes = "ENERO";
        break;

    case 02:
        $miMes = "FEBRERO";
        break;

    case 03:
        $miMes = "MARZO";
        break;

    case 04:
        $miMes = "ABRIL";
        break;

    case 05:
        $miMes = "MAYO";
        break;

    case 06:
        $miMes = "JUNIO";
        break;

    case 07:
        $miMes = "JULIO";
        break;

    case "08":
        $miMes = "AGOSTO";
        break;

    case "09":
        $miMes = "SEPTIEMBRE";
        break;

    case 10:
        $miMes = "OCTUBRE";
        break;

    case 11:
        $miMes = "NOVIEMBRE";
        break;

    case 12:
        $miMes = "DICIEMBRE";
        break;
}


$fCompleta = $dia."-".$miMes."-".$aaa;



$queryPromoActiva = mysqli_query($enlace,"SELECT * from promociones WHERE `status`=1");
$datosPromoActiva = mysqli_fetch_array($queryPromoActiva,MYSQLI_ASSOC);
$promoActiva= $datosPromoActiva["desc_promocion"];

$queryArea = mysqli_query($enlace,"select Nombre from areas where idArea =$idArea");
$datosArea = mysqli_fetch_array($queryArea,MYSQLI_ASSOC);
$nombreArea =$datosArea["Nombre"];
//QUERY
$query = mysqli_query($enlace,"SELECT integrantes.tel,integrantes.cel,integrantes.nombre_integrante,integrantes.num_identidad,integrantes.correlativo,areas.Nombre, integracion.integrador ,integrantes.areas from integracion 
INNER JOIN integrantes ON integracion.idIntegrante = integrantes.idintegrante
INNER JOIN areas on integracion.idArea = areas.idArea
INNER JOIN promociones ON integracion.idPromocion = promociones.idpromocion
INNER JOIN detalle_integrantes ON integrantes.idintegrante = detalle_integrantes.id_integrante
WHERE detalle_integrantes.`status`=1 AND integracion.idArea=$idArea AND promociones.`status`=1 GROUP BY integrantes.nombre_integrante ASC");
while($result = mysqli_fetch_array($query,MYSQLI_ASSOC)){

    if($result["integrador"]==1){
        $inte = "P";
    }else{
        $inte="";
    }


    if($result["areas"]==""){
        $sirveAct ="";
    }else{
        $sirveAct= $result["areas"];
    }

    $filas.=' 
 <tr align="center " style="font-size: 14px;">

  <td>'.$contador.'</td>
  <td>'.$inte.'</td>
    <td style="font-size: x-small">'.$result["nombre_integrante"].'</td>
    <td >'.$result["num_identidad"].'</td>
    <td align="center">'.$result["correlativo"].'</td>
    <td align="center">'.$result["cel"].'</td>
    <td align="center">'.$result["tel"].'</td>
    <td style="font-size: x-small" align="center">'.$sirveAct.'</td>

 
    </tr>';

    $contador++;
}

$contenido= '
<table style ="width: 100%;" border=1 cellspacing=0 >
<thead>
<tr align="center">
<td colspan="8" align="center"><img src="../myfiles/img/logo.png" style="width: 70px; height: 70px; float: left;margin-top: 1%;margin-left: 1%"><h2 style="margin-left: -10%">Escuela de Mayordomia</h2><h3 style="margin-left: -10%;margin-bottom: -0%">Reporte de Integracion de Areas</h3> <img src="../myfiles/img/logo2.png" style="width: 70px; height: 70px; float: right;margin-top: -10%"></td>

</tr>



<tr style="background-color: #F1C40F" > 
<td colspan="8" align="center" style="color: black;"><strong>' .$nombreArea.'</strong></td>
</tr>

<tr style="background-color: gray" > 
<td colspan="4" align="center" style="color: black;font-size: x-small">FECHA: ' .$fCompleta.'</td>
<td colspan="4" align="center" style="color: black;font-size: x-small">' .$promoActiva.'</td>
</tr>

<tr  > 
<td colspan="3" align="center" style="font-size: xx-large"><strong style="color: white;">.</strong></td>
<td colspan="3" align="center" style="font-size: xx-large"><strong style="color: white;">.</strong></td>
<td colspan="2" align="center" style="font-size: xx-large"><strong style="color: white;">.</strong></td>

</tr>

<tr  > 
<td colspan="3" align="center" style="color: black; font-size: x-small">MULTIMEDIOS PROCESADO POR</td>
<td colspan="3" align="center" style="color: black;font-size: x-small">RESPONSABLE MAYORDOMIA</td>
<td colspan="2" align="center" style="color: black; font-size: x-small">RESPONSABLE MESA</td>
</tr>









<tr align="center" style="background-color: #2ecc71; ">
<td width="20px"><strong>#</strong></td>
<td width="20px"><strong>P</strong></td>
<td width="300px"><strong>NOMBRE</strong></td>
<td  ><strong>IDENTIDAD</strong></td>
<td ><strong>EXPEDIENTE</strong></td>
<td><strong>TELEFONO 1</strong></td>
<td><strong>TELEFONO 2</strong></td>
<td><strong>SIRVE ACTUALMENTE</strong></td>
</tr>

</thead>

<tbody>

'.$filas.'


    </tbody>
    </table>   ';




$confirmarEnlazadosManual = mysqli_num_rows(mysqli_query($enlace,"SELECT * FROM integracionindividual WHERE idArea = $idArea"));

if($confirmarEnlazadosManual>0){
$contenido.='   <table style ="width: 100%;margin-top: 10%" border=1 cellspacing=0 >
<thead>
<tr style="background-color: #F1C40F" > 
<td colspan="6" align="center" style="color: black;"><strong>ESCUELA DE MAYORDOMIA - INTEGRACION MANUAL - NO PERTENECEN A '.$promoActiva.'</strong></td>
</tr>










<tr align="center" style="background-color: #2ecc71; ">
<td width="20px"><strong>#</strong></td>
<td width="300px"><strong>NOMBRE COMPLETO</strong></td>
<td  ><strong>IDENTIDAD</strong></td>
<td><strong>TELEFONO 1</strong></td>
<td><strong>TELEFONO 2</strong></td>
<td><strong>SIRVE ACTUALMENTE</strong></td>
</tr>

</thead>
<tbody>';
$CIM = 1;
    $queryIntegradosManual = mysqli_query($enlace,"SELECT * FROM integracionindividual WHERE idArea =$idArea");
    while ($datosIntegradosManual = mysqli_fetch_array($queryIntegradosManual,MYSQLI_ASSOC)){
        $contenido.='
        <tr align="center">
<td width="20px">'.$contador.'</td>
<td width="300px">'.$datosIntegradosManual["nombre"].'</td>
<td>'.$datosIntegradosManual["identidad"].'</td>
<td>'.$datosIntegradosManual["telefono1"].'</td>
<td>'.$datosIntegradosManual["telefono2"].'</td>
<td>'.$datosIntegradosManual["sirve"].'</td>
</tr>
        ';

        $CIM++;
        $contador++;
    }

    $contenido.='

</tbody>
</table>

';
}else{

}

$dompdf = new DOMPDF();
$dompdf->load_html( $contenido);
$dompdf->render();
$dompdf->set_paper($paperOrientation);
//$dompdf->stream("mi_archivo.pdf");
$dompdf->stream("mi_archivo.pdf",array('Attachment'=>0));
?>