<?php 

include '../gold/enlace.php';

$namePerson = strtoupper($_POST['nombrePersona']);
$namePerson1 = str_replace("'","",$namePerson);


if (empty($_POST['nombrePersona'])){
		echo "";
				
	}else{
$queryPromoActiva = mysqli_query($enlace,"SELECT * from promociones where `status` = 1");
$datosPromo = mysqli_fetch_array($queryPromoActiva,MYSQLI_ASSOC);
$correlativo = $datosPromo["correlativo"];
    $query1 = "SELECT num_identidad,nombre_integrante,cel,correlativo FROM integrantes
where nombre_integrante LIKE '%".$namePerson1."%' ";

$query2 = "SELECT num_identidad,nombre_integrante,cel,correlativo FROM integrantes
INNER JOIN pastoreadores on integrantes.idintegrante = pastoreadores.idIntegrante
where nombre_integrante LIKE '%".$namePerson1."%' and pastoreadores.estado = 1";

$query3 ="SELECT integrantes.num_identidad,integrantes.nombre_integrante,integrantes.cel,integrantes.correlativo FROM liderazgo
INNER JOIN integrantes ON liderazgo.idIntegrante = integrantes.idintegrante
WHERE integrantes.nombre_integrante LIKE '%".$namePerson1."%' and liderazgo.estado = 1";

$num = mysqli_num_rows(mysqli_query($enlace,$query1));

$q = mysqli_query($enlace,$query1);

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
                    $total = 1;
				    while($rows = mysqli_fetch_array($q,MYSQLI_ASSOC)){
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

				    echo "<tbody>";

$total = 1;




		echo "</tbody>";
	echo '</table>';
echo '</div>';


	}


 ?>