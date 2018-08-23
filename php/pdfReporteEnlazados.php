<?php
include '../gold/enlace.php';
require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;
$equipo =$_GET["equipo"];
$filas = "";


$filas.='
<table class="table table-bordered display nowrap" id="exampleReporte" width="100%" border=1 cellspacing=0 >

    <thead>
    <tr align="center">
    <td colspan="1"> <img src="photos/logo.png" alt="" width="70" height="70"> </td>
    <td colspan="1"> <h1>ESCUELA DE MAYORDOMIA</h1> <span  style="font-size: 14px;" > REPORTE ENLAZADOS - GENERAL</span></td>
    <td colspan="1"> <img src="photos/logo2.png" alt="" width="70" height="70"> </td>
    </tr >




    <tr style="background-color:#2ecc71;" align="center">
    <td colspan="2"><strong>EQUIPO</strong></td>
    <td><strong>OVEJAS INTEGRADAS</strong></td>
    </tr>
    </thead>

    <tbody>';



$queryTodos = mysqli_query($enlace,"SELECT * from equipos
INNER JOIN promociones on equipos.id_promocion = promociones.idpromocion
where promociones.`status`=1 AND equipos.num_equipo>0");





    while ($rows = mysqli_fetch_array($queryTodos,MYSQLI_ASSOC)){
        $idEquipo  =$rows["id_equipo"];
        $queryCantidadTodos= mysqli_query($enlace,"SELECT COUNT(*) as cantidadTodos FROM detalle_integrantes
INNER JOIN promociones on detalle_integrantes.id_promocion = promociones.idpromocion
WHERE promociones.`status` = 1 and detalle_integrantes.id_equipo = '".$idEquipo."' and detalle_integrantes.id_cargo = 10");
        $datosCantidadTodos = mysqli_fetch_array($queryCantidadTodos,MYSQLI_ASSOC);
        $filas.="<tr align='center'><td colspan='2'>".$rows["nombre_equipo"]."</td> <td>".$datosCantidadTodos["cantidadTodos"]."</td> </tr>";

    }



$cantidadTodalTodos= mysqli_query($enlace,"SELECT COUNT(*) AS cantidadTotalTodos FROM detalle_integrantes
INNER JOIN promociones on detalle_integrantes.id_promocion = promociones.idpromocion
WHERE promociones.`status` = 1 and detalle_integrantes.id_cargo = 10");
$datosCantidadTotalTodos = mysqli_fetch_array($cantidadTodalTodos,MYSQLI_ASSOC);
$cantidadTotalTodos = $datosCantidadTotalTodos["cantidadTotalTodos"];
$filas.='
<tr align="center" style="background:yellow;"> <td colspan="2"><strong>GRAN TOTAL</strong></td> <td><strong>'.$cantidadTotalTodos.'</strong></td></tr>
</thead> 
    <tbody>';









$dompdf = new DOMPDF();
$dompdf->load_html( $filas);
$dompdf->render();
//$dompdf->stream("mi_archivo.pdf");
$dompdf->stream("mi_archivo.pdf",array('Attachment'=>0));
?>