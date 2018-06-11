<?php
require_once 'conexion.php';
require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;
$filas = "";
$equipo=$_GET["equipo"];
$fecha=$_GET["fecha"];
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

//QUERY



$queryReporte = mysqli_query($con,"SELECT integrantes.num_identidad,integrantes.correlativo,integrantes.nombre_integrante,equipos.num_equipo,equipos.nombre_equipo from marcacionprovicional
INNER JOIN detalle_integrantes ON marcacionprovicional.idIntegrante = detalle_integrantes.id_integrante
INNER JOIN integrantes ON marcacionprovicional.idIntegrante = integrantes.idintegrante
INNER JOIN equipos ON detalle_integrantes.id_equipo =  equipos.id_equipo
INNER JOIN promociones ON detalle_integrantes.id_promocion = promociones.idpromocion
where equipos.id_equipo = ".$equipo."
AND detalle_integrantes.id_cargo=10
AND CAST(marcacionprovicional.fechaMarcacion AS DATE)= '".$fecha."'
AND promociones.`status`=1 ORDER BY nombre_integrante ASC
");


$queryPastoreadores1 = mysqli_query($con,"SELECT  integrantes.nombre_integrante from detalle_integrantes 
INNER JOIN integrantes ON detalle_integrantes.id_integrante = integrantes.idintegrante
where detalle_integrantes.id_equipo ='".$equipo."'  AND detalle_integrantes.id_cargo = 9
 order by integrantes.nombre_integrante ASC limit 1");

$queryPastoreadores2 = mysqli_query($con,"SELECT  integrantes.nombre_integrante from detalle_integrantes 
INNER JOIN integrantes ON detalle_integrantes.id_integrante = integrantes.idintegrante
where  detalle_integrantes.id_equipo = '".$equipo."'  AND detalle_integrantes.id_cargo = 9
 order by integrantes.nombre_integrante DESC limit 1");

$pastoreadores1 = mysqli_fetch_assoc($queryPastoreadores1);
$pastoreadores2 = mysqli_fetch_assoc($queryPastoreadores2);

/*
$queryTotalAsistenciaAuto = mysqli_query($con,"SELECT count(*)AS cantidad from marcacion 
INNER JOIN detalle_integrantes ON marcacion.iddetalle_integrante = detalle_integrantes.idetalle_integrantes
INNER JOIN equipos ON detalle_integrantes.id_equipo = equipos.id_equipo
INNER JOIN promociones ON detalle_integrantes.id_promocion= promociones.idpromocion
WHERE tipo_marcacion= 1 AND CAST(fecha_marcacion AS DATE)= '".$fecha."' AND detalle_integrantes.id_equipo=$equipo  AND detalle_integrantes.id_cargo = 10 AND promociones.`status`=1 AND detalle_integrantes.`status`=1;");
$filaAsistenciaAuto = mysqli_fetch_array($queryTotalAsistenciaAuto,MYSQLI_ASSOC);

$queryTotalAsistenciaManual = mysqli_query($con,"SELECT count(*)AS cantidad from marcacion 
INNER JOIN detalle_integrantes ON marcacion.iddetalle_integrante = detalle_integrantes.idetalle_integrantes
INNER JOIN equipos ON detalle_integrantes.id_equipo = equipos.id_equipo
INNER JOIN promociones ON detalle_integrantes.id_promocion= promociones.idpromocion
WHERE tipo_marcacion= 0 AND CAST(fecha_marcacion AS DATE)= '".$fecha."' AND detalle_integrantes.id_equipo=$equipo  AND detalle_integrantes.id_cargo = 10 AND promociones.`status`=1 AND detalle_integrantes.`status`=1 ;");
$filaAsistenciaManual = mysqli_fetch_array($queryTotalAsistenciaManual,MYSQLI_ASSOC);
*/
$queryTotalAsistencia= mysqli_query($con,"SELECT COUNT(*) AS CANTIDAD  from marcacionprovicional
INNER JOIN detalle_integrantes ON marcacionprovicional.idIntegrante = detalle_integrantes.id_integrante
INNER JOIN promociones ON detalle_integrantes.id_promocion = promociones.idpromocion
WHERE CAST(marcacionprovicional.fechaMarcacion AS DATE) = '".$fecha."'
AND detalle_integrantes.id_equipo = $equipo
AND detalle_integrantes.id_cargo =10
AND promociones.`status`=1
AND detalle_integrantes.`status`=1");
$filaAsistenciaTotal= mysqli_fetch_array($queryTotalAsistencia,MYSQLI_ASSOC);


$queryTotalIntegrantesEquipo= mysqli_query($con,"SELECT count(*) AS cantidad from detalle_integrantes
INNER JOIN promociones ON detalle_integrantes.id_promocion= promociones.idpromocion 
WHERE id_equipo= '".$equipo."' AND detalle_integrantes.id_cargo=10 AND promociones.`status`=1 AND detalle_integrantes.`status`=1");
$filaTotalIntegrantesEquipo= mysqli_fetch_array($queryTotalIntegrantesEquipo,MYSQLI_ASSOC);

$queryNombreEquipo= mysqli_query($con,"SELECT nombre_equipo, num_equipo from equipos
where id_equipo = ".$equipo );
$filaNombreEquipo= mysqli_fetch_array($queryNombreEquipo,MYSQLI_ASSOC);

$promo = mysqli_query($con, "SELECT equipos.nombre_equipo,promociones.num_promocion FROM equipos
INNER JOIN promociones ON equipos.id_promocion = promociones.idpromocion
WHERE equipos.id_equipo =$equipo ");
$datoPromocion = mysqli_fetch_array($promo,MYSQLI_ASSOC);



    $totalAusentes = $filaTotalIntegrantesEquipo["cantidad"]-$filaAsistenciaTotal["CANTIDAD"] ;
$promedioparte1 = $filaAsistenciaTotal["CANTIDAD"]*100;
$promedioparte2 = $promedioparte1 / $filaTotalIntegrantesEquipo["cantidad"];
$promedioTotal =  round($promedioparte2,0);

while ($fila = mysqli_fetch_array($queryReporte,MYSQLI_ASSOC)) {

    $filas.=' 
 <tr >

  <td align="center">'.$contador.'</td>
    <td align="center">'.$fila["correlativo"].'</td>
    <td colspan="2" align="center" >'.utf8_encode($fila["nombre_integrante"]).'</td>
 <td align="center">'.$fila["num_identidad"].'</td>
    </tr>';

    $contador++;
}



$contenido= '
<table style ="width: 100%;" border=1 cellspacing=0 >
<thead>
<tr align="center">
<th align="center"><img src="../img/logo.png"   style="width: 70px; height: 70px;"> </th>
<td colspan="3" align="center"><h1>Escuela de Mayordomia</h1> <strong> '.$fCompleta.'</strong><br><br> <span >REPORTE DETALLADO DE ASISTENCIA OVEJAS - PROMOCION '.$datoPromocion["num_promocion"].' </span></td>
<th align="center"><img src="../img/logo2.png" style="width: 70px; height: 70px;"></th>
</tr>

<tr align="center">
<td colspan="2">Pastoreador:'.$pastoreadores1["nombre_integrante"].' </td>

<td><strong>'.$filaNombreEquipo["num_equipo"].'  '.$filaNombreEquipo["nombre_equipo"].'</strong></td>
<td colspan="2">Pastoreador: '.$pastoreadores2["nombre_integrante"].'</td>
</tr>




<tr align="center" style="background-color: #2ecc71; ">
<td><strong>#</strong></td>
<td><strong>Correlativo</strong></td>
<td colspan="2"><strong>Nombre</strong></td>
<td><strong>Identidad</strong></td>
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
<td>'.$filaTotalIntegrantesEquipo["cantidad"].'</td>
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