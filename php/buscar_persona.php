<?php 

include '../gold/enlace.php';

$namePerson = strtoupper($_POST['nombrePersona']);
$namePerson1 = str_replace("'","",$namePerson);


if (empty($_POST['nombrePersona'])){
		echo "";
				
	}
	else{
		$query = mysqli_query($enlace,"SELECT num_identidad,nombre_integrante,cel,correlativo FROM integrantes
where nombre_integrante LIKE '%".$namePerson1."%'");


echo '<div class="table-responsive">';

echo '<table class="table table-hover" id="example">';

					echo "<thead>";
				      	  echo "<tr>";
				        		echo "<th>#</th>";
				        		echo "<th>Identidad</th>";
				        		echo "<th>Nombres</th>";
				        		echo "<th>Celular</th>";
				        		echo "<th>Correlativo</th>";
								echo "<th>Copiar</th>";
				      	  echo "</tr>";
				    echo "</thead>";

				    echo "<tbody>";

$total = 1;
while ($rows = mysqli_fetch_array($query,MYSQLI_ASSOC)) {
	# code...
	echo "<tr>";
		echo "<td>".$total."</td>";
		echo "<td>".$rows["num_identidad"]."</td>";
		echo "<td>".utf8_encode($rows["nombre_integrante"])."</td>";
		echo "<td>".$rows["cel"]."</td>";
		echo "<td>".$rows["correlativo"]."</td>";
echo '<td><a href="javascript:Mostrar(\''.$rows["num_identidad"].'\');" class="glyphicon glyphicon-share-alt"></a></td>';
	echo "</tr>";
$total++;
}

		echo "</tbody>";
	echo '</table>';
echo '</div>';


	}


 ?>