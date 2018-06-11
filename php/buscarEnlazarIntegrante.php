<?php

include '../gold/enlace.php';

$namePerson = strtoupper($_POST['nombrePersonaEnlazar']);



if (empty($_POST['nombrePersonaEnlazar'])){
    echo "";

}
else{
    $query = mysqli_query($enlace,"Select integrantes.idintegrante, integrantes.num_identidad,integrantes.nombre_integrante 
from integrantes where Not idintegrante 
In (Select detalle_integrantes.id_integrante From detalle_integrantes)
AND integrantes.nombre_integrante LIKE'%".$namePerson."%' ");

    $rows = mysqli_fetch_array($query,MYSQLI_ASSOC);

    echo'<table class="table table-bordered table-striped" id="listaTabla">';
    echo '<thead>';
    echo '<tr>';
    echo '<th>#</th>';
    echo '<th>IDENTIDAD</th>';
    echo '<th>NOMBRE</th>';
    echo '<th>SELECCIONAR</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';
    $contador2=1;
    while (  $resultadoIntegrantesSinEnlazar = mysqli_fetch_array($query, MYSQLI_ASSOC))
    {


        echo '<tr>';
        echo '<td>'.$contador2.'</td>';
        echo '<td>'.$resultadoIntegrantesSinEnlazar["num_identidad"].'</td>';
        echo '<td>'.$resultadoIntegrantesSinEnlazar["nombre_integrante"].'</td>';
        echo '<td><input type="checkbox" value="'.$resultadoIntegrantesSinEnlazar["idintegrante"].'"></td>';
        echo '</tr>';


        $contador2 ++;
    }
    echo '</tbody>';
    echo '</table>';



}


?>