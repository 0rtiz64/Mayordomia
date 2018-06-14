<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 26/1/2018
 * Time: 1:15 PM
 */



include '../gold/enlace.php';

$namePerson = strtoupper($_POST['nombre']);




if (empty($_POST['nombre'])){
    echo "";

}
else{
    $queryConsultarCorrelativoActivo = mysqli_query($enlace,"SELECT correlativo from promociones WHERE promociones.`status` = 1");
    $arrayCorrelativoActivo = mysqli_fetch_array($queryConsultarCorrelativoActivo,MYSQLI_ASSOC);
    $correlativoActivo = $arrayCorrelativoActivo["correlativo"];


    $query = mysqli_query($enlace,"SELECT * from integrantes 
where correlativo > '".$correlativoActivo."' AND nombre_integrante like '%".$namePerson."%'");


    echo '<div class="table-responsive">';

    echo '<table class="table table-bordered table-striped" id="example">';

    echo "<thead align='center'>";
    echo "<tr>";
    echo "<th>#</th>";
    echo "<th>IDENTIDAD</th>";
    echo "<th>NOMBRE</th>";
    echo "<th>CEL</th>";
    echo "<th>OPCION</th>";
    echo "</tr>";
    echo "</thead>";

    echo "<tbody>";



    $total = 1;
    while ($rows = mysqli_fetch_array($query,MYSQLI_ASSOC)) {

        # code...
        echo "<tr align='center'>";
        echo "<td>".$total."</td>";
        echo "<td>".$rows["num_identidad"]."</td>";
        echo "<td>".utf8_encode($rows["nombre_integrante"])."</td>";
        echo "<td>".$rows["cel"]."</td>";
        echo '<td><a href="javascript:editarIntegranteMatriculado('.$rows['idintegrante'].');" class="glyphicon glyphicon-edit"></a></td>';

        echo "</tr>";
        $total++;
    }

    echo "</tbody>";
    echo '</table>';
    echo '</div>';


}


?>