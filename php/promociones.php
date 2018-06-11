<?php

include '../gold/enlace.php';

$namePerson = strtoupper($_POST['numeroPromocion']);



if (empty($_POST['numeroPromocion'])){
    echo "";

}
else{
    $query = mysqli_query($enlace,"SELECT idpromocion,num_promocion,desc_promocion,`status`,CAST(fecha_registro AS DATE) AS FECHAREGISTRO from promociones
where num_promocion  LIKE '%".$namePerson."%'");


    echo '<div class="table-responsive">';

    echo '<table class="table table-bordered table-striped" id="example">';

    echo "<thead align='center'>";
    echo "<tr>";
    echo "<th>#</th>";
    echo "<th>NUMERO</th>";
    echo "<th>NOMBRE</th>";
    echo "<th>FECHA</th>";
    echo "<th>ESTADO</th>";
    echo "<th>OPCION</th>";
    echo "</tr>";
    echo "</thead>";

    echo "<tbody>";



    $total = 1;
    while ($rows = mysqli_fetch_array($query,MYSQLI_ASSOC)) {

        if ($rows["status"]== 1){
            $estadoPromocion = "ACTIVA";
        }else{
            $estadoPromocion ="FINALIZADA";
        };
        # code...
        echo "<tr align='center'>";
        echo "<td>".$total."</td>";
        echo "<td>".$rows["num_promocion"]."</td>";
        echo "<td>".utf8_encode($rows["desc_promocion"])."</td>";
        echo "<td>".utf8_encode($rows["FECHAREGISTRO"])."</td>";
        echo "<td>".$estadoPromocion."</td>";
        echo '<td><a href="javascript:editarPromocion('.$rows['idpromocion'].');" class="glyphicon glyphicon-edit"></a></td>';

        echo "</tr>";
        $total++;
    }

    echo "</tbody>";
    echo '</table>';
    echo '</div>';


}


?>