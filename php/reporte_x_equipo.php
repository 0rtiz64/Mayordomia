<?php 
include '../gold/enlace.php';
//include 'gold/enlace.php';

$num_promo = $_POST['equipo'];
$num_fecha = $_POST['fecha'];

$dia = substr($num_fecha,8,2);
$mes = substr($num_fecha,5,2);
$aaa = substr($num_fecha,0,4);

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

$cantiadIntegrantes = 0;
$canidadAsistentes = 0;
$cantidaAusentes = 0;
$cantidadPorcentaje = 0;


$queryNombrePromocion = mysqli_query($enlace,"SELECT idpromocion,num_promocion  from promociones
WHERE `status`=1");
$nombrePromocion = mysqli_fetch_array($queryNombrePromocion,MYSQLI_ASSOC);


echo '<a class="btn btn-danger"  href="php/reporte_x_equipos.php?id_promos='.$num_promo.'&id_fecs='.$num_fecha.'" target="_blank" style="color:white;"> <span>Exportar A PDF</span> </a>';
echo '<div class="table-responsive">';
echo '<table class="table table-bordered display nowrap" id="exampleReporte" width="100%">';

echo "<thead>";
echo '<tr >';
echo '<th colspan="1"> <img src="php/photos/logo.png" alt="" width="70" height="70"> </th>';
echo '<th colspan="4"> <h1>ESCUELA DE MAYORDOMIA</h1> <span style="font-size: 14px;"> 02 - REPORTE RESUMEN DE ASISTENCIA OVEJAS - PROMOCION '.$nombrePromocion["num_promocion"].'.</span></th>';
echo '<th colspan="1"> <img src="php/photos/logo2.png" alt="" width="70" height="70"> </th>';
echo '</tr >';


echo '<tr >';
echo '<th colspan="6">Fecha: '.$fCompleta.'</th>';
echo '</tr >';
echo '<tr style="background-color:#f1c40f;">';
echo '<th colspan="2">EQUIPO</th>';
echo '<th colspan="4">OVEJAS</th>';
echo "</tr>";

echo "<tr style='background-color:#2ecc71;'>";
echo "<th>No.</th>";
echo "<th>NOMBRE</th>";
echo "<th>CANTIDAD DE INTEGRANTES</th>";
echo "<th>ASISTENTES</th>";
echo "<th>AUSENTES</th>";
echo "<th>PORCENTAJE DE ASISTENCIA</th>";
echo "</tr>";
echo "</thead>";

echo '<tbody>';
$query = mysqli_query($enlace,"SELECT DISTINCT E.id_equipo,E.num_equipo,E.nombre_equipo AS Equipo, COUNT(a.id_equipo) AS cantidad_I FROM detalle_integrantes a 
INNER JOIN equipos E ON a.id_equipo = E.id_equipo
INNER JOIN promociones ON E.id_promocion = promociones.idpromocion
WHERE a.id_promocion = ".$num_promo."  AND a.id_cargo=10 AND a.`status`=1 AND promociones.`status`=1 
GROUP BY E.id_equipo,E.num_equipo,E.nombre_equipo ORDER BY num_equipo");
$cont = 1;
while ($rows = mysqli_fetch_array($query,MYSQLI_ASSOC)) {
    # code...
    $queryInterno = mysqli_query($enlace,"SELECT  IFNULL(COUNT(*),0) Asistentes  from integrantes
INNER JOIN marcacionprovicional ON integrantes.idintegrante = marcacionprovicional.idIntegrante
INNER JOIN detalle_integrantes ON integrantes.idintegrante = detalle_integrantes.id_integrante
INNER JOIN equipos ON detalle_integrantes.id_equipo = equipos.id_equipo
WHERE
detalle_integrantes.id_equipo = ".$rows['id_equipo']." AND
detalle_integrantes.`status` = 1 AND
detalle_integrantes.id_promocion = ".$num_promo." AND
CAST(marcacionprovicional.fechaMarcacion AS DATE) = '".$num_fecha."' AND
detalle_integrantes.id_cargo = 10
");
    $rows_asistente = mysqli_fetch_array($queryInterno,MYSQLI_ASSOC);

    $asis = $rows['cantidad_I'] - $rows_asistente['Asistentes'];
    $porcetaje = round(($rows_asistente['Asistentes'] * 100) / $rows['cantidad_I'],2);
    echo '<tr>';
    echo '<td>'.$rows['num_equipo'].'</td>';
    echo '<td>'.$rows['Equipo'].'</td>';
    echo '<td>'.$rows['cantidad_I'].'</td>';
    echo '<td>'.$rows_asistente['Asistentes'].'</td>';
    echo '<td>'.$asis.'</td>';
    echo '<td>'.$porcetaje.'%</td>';
    echo '<tr>';

    $cantiadIntegrantes += $rows['cantidad_I'];
    $canidadAsistentes += $rows_asistente['Asistentes'];
    //$cont++;
}


$cantidaAusentes = $cantiadIntegrantes - $canidadAsistentes;
$cantidadPorcentaje = round(($canidadAsistentes * 100) / $cantiadIntegrantes,2);

echo "<tr>";
echo "<td colspan='2' style='background-color:#95a5a6;'> TOTALES </td>";
echo "<td style='background-color:#f1c40f;'> ".$cantiadIntegrantes." </td>";
echo "<td style='background-color:#f1c40f;'> ".$canidadAsistentes." </td>";
echo "<td style='background-color:#f1c40f;'> ".$cantidaAusentes." </td>";
echo "<td style='background-color:#f1c40f;'> ".$cantidadPorcentaje."% </td>";
echo "</tr>";

echo "<tr style='background-color:#95a5a6;'>";
echo "<td colspan='6'> <h1>RESUMEN</h1> </td>";
echo "</tr>";
echo '</tbody>';

echo "</div>";



echo "</div>";


?>