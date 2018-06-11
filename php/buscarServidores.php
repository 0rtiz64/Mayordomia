<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 23/4/2018
 * Time: 4:17 PM
 */





include '../gold/enlace.php';

$namePerson = strtoupper($_POST['nombre']);




if (empty($_POST['nombre'])){
    echo "";

}
else{
    $query = mysqli_query($enlace,"select * from servidores where nombre_integrante LIKE'%".$namePerson."%'  and correlativo > '990000'");


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
        echo "<td>".$rows["nombre_integrante"]."</td>";
        echo "<td>".$rows["cel"]."</td>";
        echo '<td><a href="javascript:editarServidor('.$rows['idServidor'].');" class="glyphicon glyphicon-edit"></a></td>';

        echo "</tr>";
        $total++;
    }

    echo "</tbody>";
    echo '</table>';
    echo '</div>';


}


?>