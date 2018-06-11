<?php

include '../gold/enlace.php';

$namePerson = strtoupper($_POST['nombrePersona']);
$namePerson1 = str_replace("'","",$namePerson);


if (empty($_POST['nombrePersona'])){
    echo "";

}
else{
    $query = mysqli_query($enlace,"SELECT integrantes.cel,integrantes.idintegrante,integrantes.num_identidad,integrantes.nombre_integrante,integrantes.correlativo
FROM integrantes
WHERE integrantes.nombre_integrante LIKE'%".$namePerson1."%' ");

 $promocion= mysqli_query($enlace,"SELECT idpromocion,num_promocion,desc_promocion from promociones 
where `status` =1");

 $datoPromocion = mysqli_fetch_array($promocion,MYSQLI_ASSOC);
    echo '<div class="table-responsive">';

    echo '<table class="table table-hover" id="example">';

    echo "<thead>";
    echo "<tr>";
    echo "<th>#</th>";
    echo "<th>Identidad</th>";
    echo "<th>Nombres</th>";
    echo "<th>Correlativo</th>";
    echo "<th>Ficha</th>";
    echo "<th>Carnet</th>";
    echo "<th>Etiqueta</th>";
    echo "<th>Integracion</th>";
    echo "</tr>";
    echo "</thead>";

    echo "<tbody>";

    $total = 1;
    while ($rows = mysqli_fetch_array($query,MYSQLI_ASSOC)) {
        # code...
        echo "<tr>";
        echo "<td>".$total."</td>";
        echo "<td>".$rows["num_identidad"]."</td>";
        echo "<td>".$rows["nombre_integrante"]."</td>";
        echo "<td>".$rows["correlativo"]."</td>";
        echo '<td><a href="php/testFicha.php?numero='.$rows["idintegrante"].'" target="_blank"  class="btn btn-danger btn-sm" style="color:white;" id="PDF">FICHA</a> </td>';
        echo '<td> <a href="javascript:sendData(\''.$datoPromocion["desc_promocion"].'\',\''.$rows["nombre_integrante"].'\',\''.$rows["num_identidad"].'\','.$rows["correlativo"].','.$rows["idintegrante"].')" class="btn btn-primary btn-sm">CARNET </a></td>';        echo '<td><a href="javascript:tomarDatosDetalleIntegrante('.$rows["idintegrante"].')" class="btn btn-info btn-sm">ETIQUETA</a> </td>';
        echo '<td> <a href="javascript:sendDataIntegracionIndividual(\''.$rows["cel"].'\',\''.$rows["nombre_integrante"].'\',\''.$rows["num_identidad"].'\','.$rows["correlativo"].','.$rows["idintegrante"].')" class="btn btn-primary btn-sm">INTEGRACION </a></td>';
        //echo '<td> <a href="javascript:probando(\''.$rows["nombre_integrante"].'\')" class="btn btn-primary btn-sm">CARNET </a></td>';        echo '<td><a href="javascript:prueba()" class="btn btn-info btn-sm">ETIQUETA</a> </td>';
        echo "</tr>";
        $total++;
    }

    echo "</tbody>";
    echo '</table>';
    echo '</div>';


}


?>