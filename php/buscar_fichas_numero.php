<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 28/2/2018
 * Time: 9:25 AM
 */



include '../gold/enlace.php';

$namePerson = $_POST['nombrePersona'];
$namePerson1 = str_replace("'","",$namePerson);


if (empty($_POST['nombrePersona'])){
    echo "";

}
else{


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
    echo "<th>Graduacion</th>";
    echo "</tr>";
    echo "</thead>";

    echo "<tbody>";

    $total = 1;

    $queryRows =mysqli_num_rows( mysqli_query($enlace,"SELECT integrantes.cel,integrantes.idintegrante,integrantes.num_identidad,integrantes.nombre_integrante,integrantes.correlativo
FROM integrantes
WHERE integrantes.correlativo = $namePerson "));

    if($queryRows>0){
        $query = mysqli_query($enlace,"SELECT integrantes.cel,integrantes.idintegrante,integrantes.num_identidad,integrantes.nombre_integrante,integrantes.correlativo
FROM integrantes
WHERE integrantes.correlativo = $namePerson ");

        while ($rows = mysqli_fetch_array($query,MYSQLI_ASSOC)) {
            # code...
            echo "<tr>";
            echo "<td>".$total."</td>";
            echo "<td>".$rows["num_identidad"]."</td>";
            echo "<td>".utf8_encode($rows["nombre_integrante"])."</td>";
            echo "<td>".$rows["correlativo"]."</td>";
            echo '<td><a href="php/fichaInscripcion.php?numero='.$rows["idintegrante"].'" target="_blank"  class="btn btn-danger btn-sm" style="color:white;" id="PDF">FICHA</a> </td>';
            echo '<td> <a href="javascript:sendDataTag(\''.$datoPromocion["desc_promocion"].'\',\''.utf8_encode($rows["nombre_integrante"]).'\',\''.$rows["num_identidad"].'\','.$rows["correlativo"].','.$rows["idintegrante"].')" class="btn btn-primary btn-sm">CARNET </a></td>';        echo '<td><a href="javascript:tomarDatosDetalleIntegrante('.$rows["idintegrante"].')" class="btn btn-info btn-sm">ETIQUETA</a> </td>';
            echo '<td> <a href="javascript:sendDataIntegracionIndividual(\''.$rows["cel"].'\',\''.utf8_encode($rows["nombre_integrante"]).'\',\''.$rows["num_identidad"].'\','.$rows["correlativo"].','.$rows["idintegrante"].')" class="btn btn-primary btn-sm">INTEGRACION </a></td>';
            echo '<td> <a href="javascript:togaIndividual('.$rows["idintegrante"].')" class="btn btn-info btn-sm">GRADUACION</a></td>';

            //echo '<td> <a href="javascript:probando(\''.$rows["nombre_integrante"].'\')" class="btn btn-primary btn-sm">CARNET </a></td>';        echo '<td><a href="javascript:prueba()" class="btn btn-info btn-sm">ETIQUETA</a> </td>';
            echo "</tr>";
            $total++;
        }
    }else{


        $query = mysqli_query($enlace,"SELECT servidores.cel,servidores.idServidor,servidores.num_identidad,servidores.nombre_integrante,servidores.correlativo
FROM  servidores
WHERE servidores.correlativo =  $namePerson ");

        while ($rows = mysqli_fetch_array($query,MYSQLI_ASSOC)) {
            # code...
            echo "<tr>";
            echo "<td>".$total."</td>";
            echo "<td>".$rows["num_identidad"]."</td>";
            echo "<td>".utf8_encode($rows["nombre_integrante"])."</td>";
            echo "<td>".$rows["correlativo"]."</td>";
            echo '<td><a href="php/fichaServidores.php?numero='.$rows["idServidor"].'" target="_blank"  class="btn btn-danger btn-sm" style="color:white;" id="PDF">FICHA</a> </td>';

            //echo '<td> <a href="javascript:probando(\''.$rows["nombre_integrante"].'\')" class="btn btn-primary btn-sm">CARNET </a></td>';        echo '<td><a href="javascript:prueba()" class="btn btn-info btn-sm">ETIQUETA</a> </td>';
            echo "</tr>";
            $total++;
        }


    }




    echo "</tbody>";
    echo '</table>';
    echo '</div>';


}


?>