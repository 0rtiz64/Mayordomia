<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 20/4/2018
 * Time: 11:36 AM
 */

include "../gold/enlace.php";

$namePerson = strtoupper($_POST['nombre']);
$namePerson1 = str_replace("'","",$namePerson);

$busqueda = mysqli_query($enlace,"select integracion.idIntegrante,nombre_integrante,integrantes.correlativo from integracion
INNER JOIN integrantes ON integracion.idIntegrante = integrantes.idintegrante
inner JOIN detalle_integrantes on integrantes.idintegrante = detalle_integrantes.id_integrante
INNER JOIN promociones on  detalle_integrantes.id_promocion = promociones.idpromocion
where integrantes.correlativo LIKE'%".$namePerson1."%' AND promociones.`status` = 1 and detalle_integrantes.`status`=1  GROUP BY integrantes.correlativo");



echo '<div class="table-responsive">';

echo '<table class="table table-hover" id="example">';

echo "<thead>";
echo "<tr align='center'>";
echo "<td><strong>#</strong></td>";
echo "<td><strong>Nombre</strong></td>";
echo "<td><strong>Opcion</strong></td>";
echo "</tr>";
echo "</thead>";

echo "<tbody>";
$contador = 1;
while ($datos = mysqli_fetch_array($busqueda,MYSQLI_ASSOC)){

  echo "<tr align='center'>";
    echo "<td>".$contador."</td>";
    echo "<td>".$datos['nombre_integrante']."</td>";
    echo '<td><a href="javascript:verAreasIntegrante('.$datos["idIntegrante"].' )" class="btn btn-info btn-xs">Ver Opciones</a> </td>';
    echo "</tr>";
$contador++;
}
echo "</tbody>";
echo '</table>';





?>


