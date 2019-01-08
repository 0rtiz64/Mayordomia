<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 22/8/2018
 * Time: 1:53 PM
 */
include '../gold/enlace.php';
$equipo = $_POST['equipo'];

if ($equipo == 0){
 $queryTodos = mysqli_query($enlace,"SELECT * from equipos
INNER JOIN promociones on equipos.id_promocion = promociones.idpromocion
where promociones.`status`=1 AND equipos.num_equipo>0 GROUP BY num_equipo ASC");
 $tabla = '
<a style="float:left;color : white" class="btn btn-danger"  href="php/pdfReporteEnlazados.php?equipo='.$equipo.'" target="_blank" style="color:white;"> <span>Exportar A PDF</span> </a>
<a style="float:right;color : white" class="btn btn-success"  href="php/EXCELReporteEnlazados.php?equipo='.$equipo.'" style="color:white;"> <span>Exportar A EXCEL</span> </a>
  <div class="table-responsive">
    <table class="table table-bordered display nowrap" id="exampleReporte" width="100%">

    <thead>
    <tr align="center">
    <td colspan="1"> <img src="php/photos/logo.png" alt="" width="70" height="70"> </td>
    <td colspan="1"> <h1>ESCUELA DE MAYORDOMIA</h1> <span  style="font-size: 14px;" > REPORTE ENLAZADOS - TODOS</span></td>
    <td colspan="1"> <img src="php/photos/logo2.png" alt="" width="70" height="70"> </td>
    </tr >




    <tr style="background-color:#2ecc71;" align="center">
    <td colspan="2"><strong>EQUIPO</strong></td>
    <td><strong>OVEJAS INTEGRADAS</strong></td>
    </tr>
    </thead>

    <tbody>';




 while($datosTodos = mysqli_fetch_array($queryTodos,MYSQLI_ASSOC)){
$idEquipo  =$datosTodos["id_equipo"];
$queryCantidadTodos= mysqli_query($enlace,"SELECT COUNT(*) as cantidadTodos FROM detalle_integrantes
INNER JOIN promociones on detalle_integrantes.id_promocion = promociones.idpromocion
WHERE promociones.`status` = 1  AND detalle_integrantes.`status` =1 and detalle_integrantes.id_equipo = '".$idEquipo."' and detalle_integrantes.id_cargo = 10");
$datosCantidadTodos = mysqli_fetch_array($queryCantidadTodos,MYSQLI_ASSOC);
$tabla.="<tr align='center'><td colspan='2'> ".$datosTodos["num_equipo"]." - ".$datosTodos["nombre_equipo"]."</td> <td>".$datosCantidadTodos["cantidadTodos"]."</td> </tr>";
 }

 $cantidadTodalTodos= mysqli_query($enlace,"SELECT COUNT(*) AS cantidadTotalTodos FROM detalle_integrantes
INNER JOIN promociones on detalle_integrantes.id_promocion = promociones.idpromocion
WHERE promociones.`status` = 1 and detalle_integrantes.`status` = 1  and detalle_integrantes.id_cargo = 10");
 $datosCantidadTotalTodos = mysqli_fetch_array($cantidadTodalTodos,MYSQLI_ASSOC);
 $cantidadTotalTodos = $datosCantidadTotalTodos["cantidadTotalTodos"];
$tabla.='
<tr align="center" style="background:yellow;"> <td colspan="2"><strong>GRAN TOTAL</strong></td> <td><strong>'.$cantidadTotalTodos.'</strong></td></tr>
</thead> 
    <tbody>';

 echo $tabla;
}else{

}
?>