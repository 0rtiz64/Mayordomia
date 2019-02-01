<?php 
include '../gold/enlace.php';
//include 'gold/enlace.php';

$num_promo = $_POST['equipo'];
$num_fecha = $_POST['fecha'];

$dia = substr($num_fecha,8,2);
$mes = substr($num_fecha,5,2);
$aaa = substr($num_fecha,0,4);

switch ($mes){
    case 01:
        $miMes = "ENERO";
        break;

    case 02:
        $miMes = "FEBRERO";
        break;

    case 03:
        $miMes = "MARZO";
        break;

    case 04:
        $miMes = "ABRIL";
        break;

    case 05:
        $miMes = "MAYO";
        break;

    case 06:
        $miMes = "JUNIO";
        break;

    case 07:
        $miMes = "JULIO";
        break;

    case "08":
        $miMes = "AGOSTO";
        break;

    case "09":
        $miMes = "SEPTIEMBRE";
        break;

    case 10:
        $miMes = "OCTUBRE";
        break;

    case 11:
        $miMes = "NOVIEMBRE";
        break;

    case 12:
        $miMes = "DICIEMBRE";
        break;
}


$fCompleta = $dia."-".$miMes."-".$aaa;

$cantiadIntegrantes = 0;
$canidadAsistentes = 0;
$cantidaAusentes = 0;
$cantidadPorcentaje = 0;
$queryNombrePromocion = mysqli_query($enlace,"SELECT num_promocion from promociones
WHERE idpromocion = $num_promo ");
$nombrePromocion = mysqli_fetch_array($queryNombrePromocion,MYSQLI_ASSOC);

echo '<a class="btn btn-danger"  href="php/reportes_resumen.php?id_promos='.$num_promo.'&id_fecs='.$num_fecha.'" target="_blank" style="color:white;"> <span>Exportar A PDF</span> </a>';
echo '<div class="table-responsive">';
		echo '<table class="table table-bordered display nowrap" id="exampleReporte" width="100%">';

		echo "<thead>";
						echo '<tr >';
							echo '<th colspan="1"> <img src="php/photos/logo.png" alt="" width="70" height="70"> </th>';
echo '<th colspan="1"> <h1>ESCUELA DE MAYORDOMIA</h1> <span style="font-size: 14px;"> 03 - REPORTE RESUMEN - PROMOCION '.$nombrePromocion["num_promocion"].'</span></th>';
							echo '<th colspan="1"> <img src="php/photos/logo2.png" alt="" width="70" height="70"> </th>';
						echo '</tr >';


						echo '<tr >';
							echo '<th colspan="4">Fecha : '.$fCompleta.'</th>';
						echo '</tr >';
						


				      	  echo "<tr style='background-color:#2ecc71;'>";
				      	  		echo "<th >CARGO</th>";
				        		echo "<th>ASISTENCIA</th>";
								echo "<th>PORCENTAJE</th>";
				      	  echo "</tr>";
		echo "</thead>";

		echo '<tbody>';
//CUENTA CUANTOS HAY EN CADA CARGO  
		$query = mysqli_query($enlace,"SELECT DISTINCT cargos.idcargo,cargos.nombre_cargo,COUNT(detalle_integrantes.id_cargo) AS Cantidad FROM detalle_integrantes
INNER JOIN cargos ON detalle_integrantes.id_cargo = cargos.idcargo
INNER JOIN promociones ON detalle_integrantes.id_promocion = promociones.idpromocion
WHERE promociones.idpromocion=$num_promo AND detalle_integrantes.id_cargo <> 10 AND detalle_integrantes.`status`=1
GROUP BY cargos.idcargo,cargos.nombre_cargo");
		$cont = 1;
			while ($rows = mysqli_fetch_array($query,MYSQLI_ASSOC)) {
				# code...
                //CUENTA CUANTOS VINIERON DE CADA CARGO EN ESA FECHA
				$queryInterno = mysqli_query($enlace,"SELECT IFNULL(COUNT(*),0) Asistentes from detalle_integrantes
INNER JOIN integrantes ON detalle_integrantes.id_integrante = integrantes.idintegrante
INNER JOIN marcacionprovicional ON detalle_integrantes.id_integrante= marcacionprovicional.idIntegrante
INNER JOIN cargos ON detalle_integrantes.id_cargo = cargos.idcargo
WHERE detalle_integrantes.id_promocion=$num_promo AND detalle_integrantes.id_cargo =  ".$rows['idcargo']."
AND CAST(marcacionprovicional.fechaMarcacion AS DATE) = '".$num_fecha."' AND detalle_integrantes.`status`=1");
	$rows_asistente = mysqli_fetch_array($queryInterno,MYSQLI_ASSOC);

	//AUSENTES
	$asis = $rows['Cantidad'] - $rows_asistente['Asistentes'];
	$porcetaje = round(($rows_asistente['Asistentes'] * 100) / $rows['Cantidad'],2);
				echo '<tr>';
					echo '<td>'.$rows['nombre_cargo'].'</td>';
					echo '<td>'.$rows_asistente['Asistentes'].'</td>';
					echo '<td>'.$porcetaje.'%</td>';
				echo '<tr>';

				$cantiadIntegrantes += $rows['Cantidad'];
				$canidadAsistentes += $rows_asistente['Asistentes'];
				//$cont++;
			}

			//if ($rows["status"]== 1){
$cantidaAusentes = $cantiadIntegrantes - $canidadAsistentes;
$cantidadPorcentaje = round(($canidadAsistentes * 100) / $cantiadIntegrantes,2);
           /* }else{
                $cantidaAusentes =0;
                $cantidadPorcentaje = 0;
            }*/
			echo "<tr>";
					echo "<td colspan='1' style='background-color:#95a5a6;'> TOTAL / PROMEDIO </td>";
					echo "<td style='background-color:#f1c40f;'> ".$canidadAsistentes." </td>";
					//echo "<td style='background-color:#f1c40f;'> ".$canidadAsistentes." </td>";
					//echo "<td style='background-color:#f1c40f;'> ".$cantidaAusentes." </td>";
					echo "<td style='background-color:#f1c40f;'> ".$cantidadPorcentaje."% </td>";
			echo "</tr>";

			echo "<tr style='background-color:#95a5a6;'>";
					echo "<td colspan='3'> <h1>RESUMEN</h1> </td>";
			echo "</tr>";
		echo '</tbody>';

		echo "</div>";



echo "</div>";


 ?>