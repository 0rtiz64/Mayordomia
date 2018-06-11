<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 30/4/2018
 * Time: 9:28 AM
 */






include "../gold/enlace.php";
$order = $_POST["order"];
$idEquipo = $_POST["idEquipo"];
$column_name =$_POST["column_name"];

if($order == 'desc'){
    $order ='asc';
}else{
    $order ='desc';
}



$query = mysqli_query($enlace,"SELECT  servidores.nombre_integrante,servicioequipos.nombreEquipo,serviciocargos.nombreCargo, servidores.correlativo from servidores
INNER JOIN serviciodetalle ON servidores.idServidor = serviciodetalle.idServidor
INNER JOIN servicioequipos On serviciodetalle.idServicioEquipo = servicioequipos.idEquipo
INNER JOIN serviciocargos ON serviciodetalle.idServicioCargo = serviciocargos.idCargo
WHERE serviciodetalle.idServicioEquipo = $idEquipo  ORDER BY $column_name $order ");

$queryNombreArea = mysqli_query($enlace,"SELECT * from servicioequipos WHERE idEquipo= $idEquipo");
$datosNombreArea = mysqli_fetch_array($queryNombreArea,MYSQLI_ASSOC);
$nombreArea = $datosNombreArea["nombreEquipo"];


echo ' <table class="table table-bordered" id="tablaServidores">';
echo  '<thead>';
echo '<tr>';
echo '<td style="text-align: center" colspan="5">  
<a href="php/pdfListadoServidores.php?equipo='.$idEquipo.'" target="_blank" class="btn btn-danger" style="color: #ffffff;float: left">EXPORTAR A PDF</a> 
'.$nombreArea.' 
 <a href="php/EXCELlistadoServidores.php?equipo='.$idEquipo.'"  class="btn btn-success" style="color: #ffffff;float: right" " >EXPORTAR A EXCEL</a>
</td>';
echo '</tr>';
echo '<tr>';

echo  '<td>#</td>';
echo  '<td colspan="2"><a class="column_sort" id="nombre_integrante" data-order="'.$order.'"  href="#"> Nombre </a></td>';
//echo '<td><a class="column_sort" id="nombreEquipo" data-order="'.$order.'"  href="#">Equipo</a></td>';
echo '<td><a class="column_sort" id="nombreCargo" data-order="'.$order.'"  href="#">Cargo</a></td>';
echo '<td><a class="column_sort" id="correlativo" data-order="'.$order.'"  href="#">Expediente</a></td>';

echo '</tr>';

echo '</thead';
echo '<tbody>';


$contador = 1;
while ($datos = mysqli_fetch_array($query,MYSQLI_ASSOC)){

    echo'<tr>';
    echo '<td>'.$contador.'</td>';
    echo '<td colspan="2">'.$datos["nombre_integrante"].'</td>';
  //  echo '<td>'.$datos["nombreEquipo"].'</td>';
    echo '<td>'.$datos["nombreCargo"].'</td>';
    echo '<td>'.$datos["correlativo"].'</td>';

    echo'</tr>';

    $contador++;
}
echo '</tbody>';
echo '</table>';
?>