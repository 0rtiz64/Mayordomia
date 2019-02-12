<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 5/2/2018
 * Time: 3:25 PM
 */
include '../gold/enlace.php';

$fecha=$_POST["fecha"];

$queryVerificar = mysqli_num_rows(mysqli_query($enlace,"SELECT * from marcacionprovicional where CAST(fechaMarcacion AS DATE)= '".$fecha."'"));



//FUNCTION FECHA
/* function nombremes($mes){
     setlocale(LC_TIME, 'spanish');
     $nombre=strftime("%B",mktime(0, 0, 0, $mes, 0, 2000));
     return ucwords($nombre);
 }*/

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



if($queryVerificar>0){
    $queryDatos = mysqli_query($enlace,"SELECT integrantes.num_identidad,integrantes.nombre_integrante,integrantes.cel,integrantes.correlativo from marcacionprovicional 
INNER JOIN integrantes ON marcacionprovicional.idIntegrante = integrantes.idintegrante
where CAST(fechaMarcacion AS DATE)= '".$fecha."'  AND  integrantes.correlativo >18010000 ORDER BY integrantes.nombre_integrante");



    echo '<a class="btn btn-danger"  href="php/pdfReporteGeneral.php?fecha='.$fecha.'" target="_blank" style="color:white;"> <span>Exportar A PDF</span> </a>';
    echo '<a class="btn btn-success"  href="php/EXCELReporteGeneral.php?fecha='.$fecha.'" style="color:white;float: right"> <span>Exportar A Excel</span> </a>';
    echo '<div class="table-responsive">';
    echo '<table class="table table-bordered display nowrap" id="exampleReporte" width="100%">';

    echo "<thead align='center'>";
    echo '<tr >';
    echo '<th colspan="1"> <img src="php/photos/logo.png" alt="" width="70" height="70" align="center"> </th>';
    echo '<th colspan="2"> <h1 align="center">ESCUELA DE MAYORDOMIA</h1> <p style="font-size: 14px;" align="center"> 02 - REPORTE RESUMEN PROVICIONAL '.$fCompleta.'</p></th>';
    echo '<th colspan="1" align="center"> <img src="php/photos/logo2.png" alt="" width="70" height="70" > </th>';
    echo '</tr >';




    echo "<tr style='background-color:#2ecc71;'>";
    echo "<th>No.</th>";
    echo "<th>IDENTIDAD</th>";
    echo "<th>NOMBRE</th>";
    echo "<th>CORRELATIVO</th>";
    echo "</tr>";
    echo "</thead>";

    echo '<tbody>';

    $contador = 1;
    while ($rows = mysqli_fetch_array($queryDatos,MYSQLI_ASSOC)){
        echo '<tr>';
        echo '<td>'.$contador.'</td>';
        echo '<td>'.$rows['num_identidad'].'</td>';
        echo '<td>'.utf8_encode($rows['nombre_integrante']).'</td>';
        echo '<td>'.$rows['correlativo'].'</td>';
        echo '<tr>';
        $contador ++;

    //    $canidadAsistentes += $rows_asistente['Asistentes'];
    };



    $queryCantidad = mysqli_query($enlace,"SELECT COUNT(integrantes.num_identidad) AS CANTIDAD from marcacionprovicional 
INNER JOIN integrantes ON marcacionprovicional.idIntegrante = integrantes.idintegrante
where CAST(fechaMarcacion AS DATE)=  '".$fecha."' and integrantes.correlativo >18010000 ");
    $datoCantidad = mysqli_fetch_array($queryCantidad,MYSQLI_ASSOC);

    echo "<tr>";
    echo "<td align='center'  style='background-color:#95a5a6;' colspan='2'> TOTALES </td>";
    echo "<td align='center' style='background-color:#f1c40f;' colspan='2'>".$datoCantidad["CANTIDAD"]."</td>";


    echo "</tr>";


    echo '</tbody>';

    echo "</div>";



    echo "</div>";

}else{
    echo "<div class='alert alert-danger' > <strong>NO HAY DATOS EN ESTA FECHA $fCompleta</strong>  </div>";
}
?>



