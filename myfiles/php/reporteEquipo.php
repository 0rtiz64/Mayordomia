<?php
/**
 * Created by PhpStorm.
 * User: Megacenter
 * Date: 14/9/2017
 * Time: 09:13
 */

require_once 'conexion.php';
$equipo=$_POST["equipo"];
$fecha=$_POST["fecha"];



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
//$pastoreadores = mysqli_fetch_array($queryPastoreadores,MYSQLI_NUM);

$promo = mysqli_query($con, "SELECT equipos.nombre_equipo,promociones.num_promocion FROM equipos
INNER JOIN promociones ON equipos.id_promocion = promociones.idpromocion
WHERE equipos.id_equipo =$equipo ");
$datoPromocion = mysqli_fetch_array($promo,MYSQLI_ASSOC);

echo '<a href="myfiles/php/pdfEquipoDetallado.php?equipo='.$equipo.'&fecha='.$fecha.'" target="_blank" class="btn btn-danger" style="color: #ffffff; float: right"> Generar PDF</a>';
echo '<a  href="php/EXCELReporteDetalladoIntegrantes.php?equipo='.$equipo.'&fecha='.$fecha.'" class="btn btn-success" style="color: #ffffff; float: inside"> Generar Excel</a>';

echo  '<div class="table-responsive">';
echo '<table class="table table-bordered table-striped" id="example">';
echo '<div >';
//echo '<img src="myfiles/img/logo2.png" style="float: left;width: 40px; height: 40px;margin-top: 10%">';
echo '<h2 align="center" >Escuela de Mayordomia   <img src="myfiles/img/logo.png"  style="float: left;width: 70px; height: 70px;"> <img src="myfiles/img/logo2.png" style="float: right;width: 70px; height: 70px;"></h2>';
echo '<h3 align="center">Reporte Detallado De Asistencia De Ovejas Promocion '.$datoPromocion["num_promocion"].'</h3>';
echo '<h4 align="center">'.$fCompleta.'</h4>';
echo '</div>';
echo '<thead>';
echo '<tr>';
echo '<label >Pastoreador:<strong>'.$pastoreadores1["nombre_integrante"].'</strong></label>';
echo '<label style="float: right">Pastoreador: <strong>'.$pastoreadores2["nombre_integrante"].'</strong></label>';
echo '<th align="center">#</th>';
echo '<th align="center">Correlativo</th>';
echo '<th align="center">Nombre</th>';
echo '<th align="center"> Identidad</th>';


echo '</tr>';
echo '</thead>';
echo '<tbody>';
$contador = 1;

while ($fila = mysqli_fetch_array($queryReporte,MYSQLI_ASSOC)) {


    echo "<td align='center'>" . $contador . "</td>";
    echo "<td align='center'>" . $fila["correlativo"] . "</td>";
    echo "<td align='center'>" . utf8_encode($fila["nombre_integrante"]) . "</td>";
    echo "<td align='center'>" . $fila["num_identidad"] . "</td>";
    echo "</tr>";
    $contador++;
}


echo '</tbody>';
echo'</table>';

/*
$queryTotalAsistenciaAuto = mysqli_query($con,"SELECT count(*)AS cantidad from marcacion 
INNER JOIN detalle_integrantes ON marcacion.iddetalle_integrante = detalle_integrantes.idetalle_integrantes
INNER JOIN equipos ON detalle_integrantes.id_equipo = equipos.id_equipo
INNER JOIN promociones ON detalle_integrantes.id_promocion= promociones.idpromocion
WHERE tipo_marcacion= 1 AND CAST(fecha_marcacion AS DATE)= '".$fecha."' AND detalle_integrantes.id_equipo=$equipo  AND detalle_integrantes.id_cargo = 10 AND promociones.`status`=1 AND detalle_integrantes.`status`=1");
$filaAsistenciaAuto = mysqli_fetch_array($queryTotalAsistenciaAuto,MYSQLI_ASSOC);

$queryTotalAsistenciaManual = mysqli_query($con,"SELECT count(*)AS cantidad from marcacion 
INNER JOIN detalle_integrantes ON marcacion.iddetalle_integrante = detalle_integrantes.idetalle_integrantes
INNER JOIN equipos ON detalle_integrantes.id_equipo = equipos.id_equipo
INNER JOIN promociones ON detalle_integrantes.id_promocion= promociones.idpromocion
WHERE tipo_marcacion= 0 AND CAST(fecha_marcacion AS DATE)= '".$fecha."' AND detalle_integrantes.id_equipo=$equipo  AND detalle_integrantes.id_cargo = 10 AND promociones.`status`=1 AND detalle_integrantes.`status`=1 ");
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



$promedioparte1 = $filaAsistenciaTotal["CANTIDAD"]*100;
$promedioparte2 = $promedioparte1 / $filaTotalIntegrantesEquipo["cantidad"];
$promedioTotal =  round($promedioparte2,0);

echo '<label> Asistencia Total: <strong>'.$filaAsistenciaTotal["CANTIDAD"].'</strong></label>';
//echo '<label style="margin-left: 15%">Asistencia Automatica: <strong></strong></label>';
//echo '<label style="margin-left: 15%">Asistencia Manual: <strong></strong></label>';
echo '<label style="margin-left: 15%">Promedio: <strong>'.$promedioTotal.'%</strong></label>';


echo '</div>';





?>


