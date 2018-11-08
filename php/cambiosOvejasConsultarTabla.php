<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 3/11/2018
 * Time: 9:45 AM
 */

include '../gold/enlace.php';

$nombre = $_POST['nombre'];

$queryPromocionActiva = mysqli_query($enlace,"SELECT * from promociones WHERE `status` = 1");
$datosPromocionActiva = mysqli_fetch_array($queryPromocionActiva,MYSQLI_ASSOC);
$correlativo = $datosPromocionActiva["correlativo"];

echo'<table class="table">';
  echo'<thead style="background-color: #212529; color: white">';
    echo'<tr>';
      echo '<th scope="col">#</th>';
      echo'<th scope="col">NOMBRE</th>';
      echo'<th scope="col">IDENTIDAD</th>';
      echo'<th scope="col">OPCIONES</th>';
    echo'</tr>';
  echo'</thead>';
  echo'<tbody>';


$contador = 1;
$queryIntegrantes = mysqli_query($enlace,"SELECT * FROM integrantes WHERE correlativo > $correlativo and nombre_integrante LIKE '%".$nombre."%' ");
while ($datosIntegrantes = mysqli_fetch_array($queryIntegrantes,MYSQLI_ASSOC)){
    $idIntegrante = $datosIntegrantes["idintegrante"];
    $queryConfirmarEnlazado = "SELECT equipos.nombre_equipo, equipos.num_equipo from detalle_integrantes 
INNER JOIN equipos on detalle_integrantes.id_equipo = equipos.id_equipo
INNER JOIN promociones on detalle_integrantes.id_promocion = promociones.idpromocion
WHERE detalle_integrantes.id_integrante = $idIntegrante and detalle_integrantes.id_cargo = 10 and promociones.`status` = 1";

    $confirmarEnlazado = mysqli_num_rows(mysqli_query($enlace,$queryConfirmarEnlazado));
    if($confirmarEnlazado >0){
        //SI ESTA ENLAZADO

        echo'<tr>';
        echo'<th scope="row">'.$contador.'</th>';
        echo'<td>'.$datosIntegrantes["nombre_integrante"].'</td>';
        echo'<td>'.$datosIntegrantes["num_identidad"].'</td>';
        echo '<td>
                <button class="btn" style="background-color: #007BFF"><i class="fa fa-edit" style="color: white"></i></button>
              <button class="btn" style="background-color: #fd8924"><i class="fa fa-print" style="color: white"></i></button>
              </td>';
        echo'</tr>';
    }else{
        // NO ESTA ENLAZADO

        echo'<tr>';
        echo'<th scope="row">'.$contador.'</th>';
        echo'<td>'.$datosIntegrantes["nombre_integrante"].'</td>';
        echo'<td>'.$datosIntegrantes["num_identidad"].'</td>';
        echo'<td>
                <button class="btn" style="background-color: #007BFF"><i class="fa fa-edit" style="color: white"></i></button>
              <button class="btn" style="background-color: #fd8924"><i class="fa fa-print" style="color: white"></i></button>
              </td>';
        echo'</tr>';
    }
$contador ++;
}
echo' </tbody>';
echo'</table>';