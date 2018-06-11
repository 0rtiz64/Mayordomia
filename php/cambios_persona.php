<?php 

include '../gold/enlace.php';

$namePerson = strtoupper($_POST['nombrePersona']);



if (empty($_POST['nombrePersona'])){
		echo "";
				
	}
	else{
		$query = mysqli_query($enlace,"SELECT integrantes.idintegrante,integrantes.num_identidad,integrantes.nombre_integrante,integrantes.cel,equipos.num_equipo,equipos.nombre_equipo 
FROM detalle_integrantes
INNER JOIN integrantes ON detalle_integrantes.id_integrante = integrantes.idintegrante
INNER JOIN promociones ON detalle_integrantes.id_promocion = promociones.idpromocion
INNER JOIN equipos ON detalle_integrantes.id_equipo = equipos.id_equipo
WHERE integrantes.nombre_integrante LIKE '%".$namePerson."%' AND promociones.`status`=1");


echo '<div class="table-responsive">';

echo '<table class="table table-hover" id="example">';

					echo "<thead>";
				      	  echo "<tr>";
				        		echo "<th>#</th>";
				        		echo "<th>Identidad</th>";
				        		echo "<th>Nombres</th>";
				        		echo "<th>Telefono 1</th>";
				        		echo "<th>Equipo</th>";
								echo "<th>Opcion</th>";
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
		echo "<td>".utf8_encode($rows["cel"])."</td>";
		echo "<td>".$rows["num_equipo"]."-".$rows["nombre_equipo"]."</td>";
		echo '<td><a href="javascript:editarIntegrante('.$rows['idintegrante'].');" class="glyphicon glyphicon-edit"></a></td>';
		
	echo "</tr>";
$total++;
}

		echo "</tbody>";
	echo '</table>';
echo '</div>';


	}


 ?>