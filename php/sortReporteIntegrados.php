<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 12/4/2018
 * Time: 4:04 PM
 */



include "../gold/enlace.php";
$order = $_POST["order"];
$idArea = $_POST["idArea"];
$column_name =$_POST["column_name"];

if($order == 'desc'){
    $order ='asc';
}else{
    $order ='desc';
}



$query = mysqli_query($enlace,"select * from integracion  
INNER JOIN integrantes ON integracion.idIntegrante = integrantes.idintegrante
INNER JOIN promociones ON integracion.idPromocion = promociones.idpromocion
WHERE integracion.idArea  = $idArea  ORDER BY $column_name $order ");

$queryNombreArea = mysqli_query($enlace,"select * from areas WHERE idArea =$idArea");
$datosNombreArea = mysqli_fetch_array($queryNombreArea,MYSQLI_ASSOC);
$nombreArea = $datosNombreArea["Nombre"];


echo ' <table class="table table-bordered" id="tablaRegistrosIntegrantes">';
echo  '<thead>';
echo '<tr>';
echo '<td style="text-align: center" colspan="4">  
<a href="php/pdfIntegrados.php?area='.$idArea.'" target="_blank" class="btn btn-danger" style="color: #ffffff;float: left">EXPORTAR A PDF</a> 
'.$nombreArea.' 
 <a href="php/EXCELIntegrados.php?area='.$idArea.'"  class="btn btn-success" style="color: #ffffff;float: right" " >EXPORTAR A EXCEL</a>
</td>';
echo '</tr>';
echo '<tr>';

echo  '<td>#</td>';
echo  '<td><a class="column_sort" id="nombre_integrante" data-order="'.$order.'" href="#"> Nombre </a></td>';
echo '<td><a class="column_sort" id="num_identidad" data-order ="'.$order.'" href="#">Identidad</a></td>';
echo '<td><a class="column_sort" id="correlativo" data-order="'.$order.'"ref="#">Expediente</a></td>';

echo '</tr>';

echo '</thead';
echo '<tbody>';


$contador = 1;
while ($datos = mysqli_fetch_array($query,MYSQLI_ASSOC)){

    echo'<tr>';
    echo '<td>'.$contador.'</td>';
    echo '<td>'.$datos["nombre_integrante"].'</td>';
    echo '<td>'.$datos["num_identidad"].'</td>';
    echo '<td>'.$datos["correlativo"].'</td>';

    echo'</tr>';

    $contador++;
}
echo '</tbody>';
echo '</table>';
?>