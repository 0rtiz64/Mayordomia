<?php 
require_once 'conexion.php';
$queryReporte = mysqli_query($con,"SELECT   marcacion.tipo_marcacion,integrantes.num_identidad,  integrantes.nombre_integrante, equipos.nombre_equipo from marcacion
INNER JOIN detalle_integrantes ON marcacion.iddetalle_integrante = detalle_integrantes.idetalle_integrantes
INNER JOIN integrantes ON detalle_integrantes.id_integrante = integrantes.idintegrante
INNER JOIN equipos ON detalle_integrantes.id_equipo = equipos.id_equipo
WHERE equipos.id_equipo =1 AND  detalle_integrantes.id_cargo = 10  AND cast(fecha_marcacion AS DATE)=  '2017-09-12'
");

$fila = mysqli_fetch_array($queryReporte,MYSQLI_ASSOC);



echo '<table>';
echo '<tr>';
echo  '<td>1</td>';
echo '<td>2</td>';
echo'<td>3</td>';
echo'<td>4</td>';
echo'</tr>';

echo '<tr>';
echo  '<td>5</td>';
echo '<td>6</td>';
echo'<td>7</td>';
echo'<td>8</td>';
echo'</tr>';


echo'</table>';

 ?>