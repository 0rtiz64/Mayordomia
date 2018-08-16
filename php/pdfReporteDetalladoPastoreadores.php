<?php
include '../gold/enlace.php';
require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;
$filas = "";
$equipo=$_GET["equipo"];
$fecha=$_GET["fecha"];
$promoActiva=$_GET["promo"];
$contador =1;


$dia = substr($fecha,8,2);
$mes = substr($fecha,5,2);
$aaa = substr($fecha,0,4);

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


$queryReporte = mysqli_query($enlace,"SELECT integrantes.num_identidad,integrantes.nombre_integrante,integrantes.cel  from marcacionprovicional 
INNER JOIN detalle_integrantes ON marcacionprovicional.idIntegrante = detalle_integrantes.id_integrante
INNER JOIN integrantes ON marcacionprovicional.idIntegrante = integrantes.idintegrante
where CAST(marcacionprovicional.fechaMarcacion AS date)='".$fecha."' and detalle_integrantes.id_cargo = 9 
and detalle_integrantes.id_promocion= $promoActiva ORDER BY integrantes.nombre_integrante
");

$queryPromocion = mysqli_query($enlace,"SELECT num_promocion from promociones
WHERE `status`=1");
$promocion = mysqli_fetch_array($queryPromocion,MYSQLI_ASSOC);




$queryTotalAsistencia= mysqli_query($enlace,"SELECT COUNT(marcacionprovicional.idIntegrante) as CANTIDAD from marcacionprovicional 
INNER JOIN detalle_integrantes ON marcacionprovicional.idIntegrante = detalle_integrantes.id_integrante
INNER JOIN integrantes ON marcacionprovicional.idIntegrante = integrantes.idintegrante
where CAST(marcacionprovicional.fechaMarcacion AS date)='".$fecha."' and detalle_integrantes.id_cargo = 9 
and detalle_integrantes.id_promocion= $promoActiva");
$filaAsistenciaTotal= mysqli_fetch_array($queryTotalAsistencia,MYSQLI_ASSOC);


$queryTotalIntegrantesEquipo= mysqli_query($enlace,"SELECT COUNT(detalle_integrantes.idetalle_integrantes)as CANTIDAD FROM detalle_integrantes
INNER JOIN cargos on detalle_integrantes.id_cargo = cargos.idcargo
WHERE detalle_integrantes.id_cargo = 9 and detalle_integrantes.id_promocion=$promoActiva");
$filaTotalIntegrantesEquipo= mysqli_fetch_array($queryTotalIntegrantesEquipo,MYSQLI_ASSOC);


$filaNombreEquipo= "Pastoreadores";

$totalAusentes = $filaTotalIntegrantesEquipo["CANTIDAD"]-$filaAsistenciaTotal["CANTIDAD"] ;
$promedioparte1 = $filaAsistenciaTotal["CANTIDAD"]*100;
$promedioparte2 = $promedioparte1 / $filaTotalIntegrantesEquipo["CANTIDAD"];
$promedioTotal =  round($promedioparte2,0);
while ($fila = mysqli_fetch_array($queryReporte,MYSQLI_ASSOC)) {

    $filas.=' 
 <tr >

  <td align="center" align>' . $contador.'</td>
    <td align="center">'.$fila["num_identidad"].'</td>
    <td align="center" colspan="3">'.utf8_encode($fila["nombre_integrante"]).'</td>
    
  ';

    $filas.='
    </tr>';

    $contador++;
}

$contenido= '
<table style ="width: 100%;" border=1 cellspacing=0 >
<thead>
<tr align="center">
<th align="center"><img src="../myfiles/img/logo.png"   style="width: 70px; height: 70px;"> </th>
<td colspan="3" align="center"><h1>Escuela de Mayordomia</h1> <strong> '.$fCompleta.'</strong><br><br> <span>REPORTE DETALLADO DE ASISTENCIA PASTOREO - PROMOCION  '.$promocion["num_promocion"].'</span></td>
<th align="center"><img src="../myfiles/img/logo2.png" style="width: 70px; height: 70px;"></th>
</tr>





<tr align="center" style="background-color: #2ecc71; ">
<td><strong>#</strong></td>
<td><strong>Identidad</strong></td>
<td colspan="3"><strong>Nombre</strong></td>


</tr>

</thead>

<tbody>

'.$filas.'


<tr align="center">
<td>Total de Miembros</td>
<td>Total Asistentes</td>
<td>Total Ausentes</td>
<td colspan="2">Porcentaje Asistencia</td>
</tr>

<tr align="center">
<td>'.$filaTotalIntegrantesEquipo["CANTIDAD"].'</td>
<td>'.$filaAsistenciaTotal["CANTIDAD"].'</td>
<td>'.$totalAusentes.'</td>
<td colspan="2">'.$promedioTotal.'%</td>
</tr>

';


$dompdf = new DOMPDF();
$dompdf->load_html( $contenido);
$dompdf->render();
//$dompdf->stream("mi_archivo.pdf");
$dompdf->stream("mi_archivo.pdf",array('Attachment'=>0));
?>