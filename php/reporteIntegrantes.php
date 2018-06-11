

<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 4/4/2018
 * Time: 2:45 PM
 */

include '../gold/enlace.php';
$idArea = $_POST["phpidArea"];



$confirm =mysqli_num_rows(mysqli_query($enlace,"select * from integracion  
INNER JOIN integrantes ON integracion.idIntegrante = integrantes.idintegrante
INNER JOIN promociones ON integracion.idPromocion = promociones.idpromocion
INNER JOIN detalle_integrantes ON integrantes.idintegrante = detalle_integrantes.id_integrante
WHERE detalle_integrantes.`status`=1 AND   integracion.idArea =$idArea GROUP BY integrantes.nombre_integrante ASC "));


if($confirm>0){
    $query = mysqli_query($enlace,"select * from integracion  
INNER JOIN integrantes ON integracion.idIntegrante = integrantes.idintegrante
INNER JOIN promociones ON integracion.idPromocion = promociones.idpromocion 
INNER JOIN detalle_integrantes ON integrantes.idintegrante = detalle_integrantes.id_integrante
WHERE detalle_integrantes.`status`=1 AND  integracion.idArea =$idArea GROUP BY integrantes.nombre_integrante ASC ");


    $queryCantidadPorArea = mysqli_query($enlace,"SELECT COUNT(*) as cantidad from integracion WHERE idArea =$idArea");
    $DatoCantidadPorArea = mysqli_fetch_array($queryCantidadPorArea,MYSQLI_ASSOC);
    $cantidadPorArea = $DatoCantidadPorArea["cantidad"];


    $queryNombreArea = mysqli_query($enlace,"select * from areas WHERE idArea =$idArea");
    $datosNombreArea = mysqli_fetch_array($queryNombreArea,MYSQLI_ASSOC);
    $nombreArea = $datosNombreArea["Nombre"];
    echo ' <table class="table table-bordered" id="tablaDatos">';
    echo  '<thead>';
    echo '<tr>';
    echo '<td style="text-align: center" colspan="4">  
<a href="php/pdfIntegrados.php?area='.$idArea.'" target="_blank" class="btn btn-danger" style="color: #ffffff;float: left">EXPORTAR A PDF</a> 
'.$nombreArea.' - '.$cantidadPorArea.' 
 <a href="php/EXCELIntegrados.php?area='.$idArea.'"  class="btn btn-success" style="color: #ffffff;float: right" " >EXPORTAR A EXCEL</a>
</td>';
    echo '</tr>';
    echo '<tr>';

    echo  '<td>#</td>';
    echo  '<td><a class="column_sort" id="nombre_integrante" data-order="desc" href="#"> Nombre </a></td>';
    echo '<td><a class="column_sort" id="num_identidad" data-order="desc" href="#">Identidad</a></td>';
    echo '<td><a class="column_sort" id="correlativo" data-order="desc" href="#">Expediente</a></td>';

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


}else{

    echo "<div class='alert alert-danger' > <strong>AUN NO HAY DATOS PARA ESTA AREA</strong>  </div>";
}



?>




