<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 20/4/2018
 * Time: 10:49 AM
 */
include "../gold/enlace.php";
$idArea = $_POST['idArea'];
$idIntegrante = $_POST['idIntegrante'];

$remover = mysqli_query($enlace,"DELETE FROM integracion
WHERE idIntegrante = $idIntegrante AND idArea = $idArea");


//MOSTRAR TABLA INICIO

$queryNombre = mysqli_query($enlace,"SELECT integrantes.nombre_integrante,areas.Nombre  from integracion
INNER JOIN integrantes ON integracion.idIntegrante = integrantes.idintegrante
INNER JOIN areas ON integracion.idArea = areas.idArea
WHERE integracion.idIntegrante =$idIntegrante ");
$datoNombre = mysqli_fetch_array($queryNombre,MYSQLI_ASSOC);
$nombre = $datoNombre["nombre_integrante"];

echo '<table class="table table-hover" id="example">';

echo "<thead>";

echo "<tr align='center'>
    <td colspan='3' ><strong>$nombre</strong></td>
</tr>";
echo "<tr align='center'>";
echo "<td><strong>#</strong></td>";
echo "<td><strong>Area</strong></td>";
echo "<td><strong>Opcion</strong></td>";
echo "</tr>";
echo "</thead>";

echo "<tbody>";
$contador = 1;


$query= mysqli_query($enlace,"SELECT areas.idArea,integrantes.nombre_integrante,areas.Nombre  from integracion
INNER JOIN integrantes ON integracion.idIntegrante = integrantes.idintegrante
INNER JOIN areas ON integracion.idArea = areas.idArea
WHERE integracion.idIntegrante =$idIntegrante ");
while ($datos= mysqli_fetch_array($query,MYSQLI_ASSOC)){
    echo "<tr align='center'>";
    echo "<td>".$contador."</td>";
    echo "<td>".$datos['Nombre']."</td>";
    echo '<td><a href="javascript:retirarArea('.$datos["idArea"].','.$idIntegrante.')" class="btn btn-danger btn-xs" style="color: white">Retirar</a> </td>';
    echo "</tr>";
    $contador++;
}
//MOSTRAR TABLA FINAL


?>