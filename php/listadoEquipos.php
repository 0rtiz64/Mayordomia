<?php
/**
 * Created by PhpStorm.
 * User: Megacenter
 * Date: 27/11/2017
 * Time: 14:46
 */
include '../gold/enlace.php';

$idEquipo=$_POST["phpEquipoL"];

$verificar= mysqli_num_rows($listadoQuery = mysqli_query($enlace,"SELECT integrantes.num_identidad,integrantes.nombre_integrante, cargos.nombre_cargo from detalle_integrantes
INNER JOIN integrantes ON detalle_integrantes.id_integrante = integrantes.idintegrante
INNER JOIN equipos On detalle_integrantes.id_equipo = equipos.id_equipo
INNER JOIN cargos ON detalle_integrantes.id_cargo= cargos.idcargo
where detalle_integrantes.id_equipo = $idEquipo "));

if ($verificar >0){

    $listadoQuery2 = mysqli_query($enlace,"SELECT integrantes.num_identidad,integrantes.nombre_integrante, cargos.nombre_cargo from detalle_integrantes
INNER JOIN integrantes ON detalle_integrantes.id_integrante = integrantes.idintegrante
INNER JOIN equipos On detalle_integrantes.id_equipo = equipos.id_equipo
INNER JOIN cargos ON detalle_integrantes.id_cargo= cargos.idcargo
where detalle_integrantes.id_equipo = $idEquipo ");
    echo'<table class="table table-bordered table-striped" id="listaTabla">';
    echo '<thead>';
    echo '<tr>';
    echo '<th>#</th>';
    echo '<th>IDENTIDAD</th>';
    echo '<th>NOMBRE</th>';
    echo '<th>CARGO</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';
    $contador=1;

    while (  $datosListdo = mysqli_fetch_array($listadoQuery2, MYSQLI_ASSOC))
    {

        echo '<tr>';
        echo '<td>'.$contador.'</td>';
        echo '<td>'.$datosListdo["num_identidad"].'</td>';
        echo '<td>'.$datosListdo["nombre_integrante"].'</td>';
        echo '<td align="center">'.$datosListdo["nombre_cargo"].'</td>';
        echo '</tr>';
        $contador ++;
    }
    echo '</tbody>';
    echo '</table>';

}else{
    echo "<div class='alert alert-danger' > <strong>EQUIPO NO TIENE INTEGRANTES</strong>  </div>";
}



