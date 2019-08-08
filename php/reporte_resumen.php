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
		$query = mysqli_query($enlace,"SELECT DISTINCT cargos.idcargo,cargos.idcargo,cargos.nombre_cargo,COUNT(liderazgo.idCargo) AS Cantidad FROM liderazgo
INNER JOIN cargos ON liderazgo.idCargo= cargos.idcargo
WHERE liderazgo.estado = 1
GROUP BY cargos.idcargo,cargos.nombre_cargo");
		$cont = 1;
			while ($rows = mysqli_fetch_array($query,MYSQLI_ASSOC)) {
				# code...
                //CUENTA CUANTOS VINIERON DE CADA CARGO EN ESA FECHA
				$queryInterno = mysqli_query($enlace,"SELECT IFNULL(COUNT(*),0) Asistentes from liderazgo
INNER JOIN integrantes ON liderazgo.idIntegrante = integrantes.idintegrante
INNER JOIN marcacionprovicional ON liderazgo.idIntegrante= marcacionprovicional.idIntegrante
INNER JOIN cargos ON liderazgo.idCargo= cargos.idcargo
WHERE liderazgo.idCargo=  ".$rows['idcargo']."
AND CAST(marcacionprovicional.fechaMarcacion AS DATE) = '".$num_fecha."' AND liderazgo.estado = 1");
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

           /* }else{
                $cantidaAusentes =0;
                $cantidadPorcentaje = 0;
            }*/

           $queryAsistenciaPastoreadores = mysqli_query($enlace,"SELECT IFNULL(COUNT(*),0) Asistentes from pastoreadores
INNER JOIN integrantes ON pastoreadores.idIntegrante= integrantes.idintegrante
INNER JOIN marcacionprovicional ON pastoreadores.idIntegrante= marcacionprovicional.idIntegrante
WHERE CAST(marcacionprovicional.fechaMarcacion AS DATE) = '".$num_fecha."' AND pastoreadores.estado = 1");
           $datosQueryPastoreadores = mysqli_fetch_array($queryAsistenciaPastoreadores,MYSQLI_ASSOC);
           $asistenciaPastoreadores = $datosQueryPastoreadores["Asistentes"];

           $queryCantidadPastoreadores = mysqli_query($enlace,"SELECT COUNT(*) as CantPast FROM pastoreadores
where pastoreadores.estado = 1");
           $datosQueryCantidadPastoreadores = mysqli_fetch_array($queryCantidadPastoreadores,MYSQLI_ASSOC);
           $cantidadPastoreadores = $datosQueryCantidadPastoreadores["CantPast"];
$inasistenciaPastoreadores  = $cantidadPastoreadores - $asistenciaPastoreadores;
$porcetajePastoreadores = round(($asistenciaPastoreadores * 100) /$cantidadPastoreadores,2);

echo '<tr>';
echo '<td>Pastoreadores</td>';
echo '<td>'.$asistenciaPastoreadores.'</td>';
echo '<td>'.$porcetajePastoreadores.'</td>';
echo '<tr>';

$cantidadAsistenciaTotal = $canidadAsistentes+$asistenciaPastoreadores;
$cantidadIntegrantesTotal = $cantiadIntegrantes+$cantidadPastoreadores;
$cantidadInasistenciaTotal = $canidadAsistentes+$inasistenciaPastoreadores;
$cantidaAusentes = $cantidadIntegrantesTotal - $cantidadInasistenciaTotal;
$cantidadPorcentaje = round(($cantidadAsistenciaTotal * 100) / $cantidadIntegrantesTotal,2);


			echo "<tr>";
					echo "<td colspan='1' style='background-color:#95a5a6;'> TOTAL / PROMEDIO </td>";
					echo "<td style='background-color:#f1c40f;'> ".$cantidadAsistenciaTotal." </td>";
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