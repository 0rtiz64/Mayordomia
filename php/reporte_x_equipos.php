<?php 
include '../gold/enlace.php';
	require_once 'dompdf/autoload.inc.php';
 	use Dompdf\Dompdf;

$num_promos = $_GET['id_promos'];
$num_fechas = $_GET['id_fecs'];

$dia = substr($num_fechas,8,2);
$mes = substr($num_fechas,5,2);
$aaa = substr($num_fechas,0,4);

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


$filas = "";
$cantidadIntegrantes = 0;
$cantidadAsistentes = 0;
$cantidadAusentes = 0;
$cantidadPorcentaje = 0;
$query = mysqli_query($enlace,"SELECT DISTINCT E.id_equipo,E.num_equipo,E.nombre_equipo AS Equipo, COUNT(a.id_equipo) AS cantidad_I FROM detalle_integrantes a 
INNER JOIN equipos E ON a.id_equipo = E.id_equipo
INNER JOIN promociones ON E.id_promocion = promociones.idpromocion
WHERE a.id_promocion = ".$num_promos."  AND a.id_cargo=10 AND a.`status`=1 AND promociones.`status`=1 
GROUP BY E.id_equipo,E.num_equipo,E.nombre_equipo ORDER BY num_equipo ");
while ($rows = mysqli_fetch_array($query,MYSQLI_ASSOC)) {
				# code...
				$queryInterno = mysqli_query($enlace,"SELECT  IFNULL(COUNT(*),0) Asistentes  from integrantes
INNER JOIN marcacionprovicional ON integrantes.idintegrante = marcacionprovicional.idIntegrante
INNER JOIN detalle_integrantes ON integrantes.idintegrante = detalle_integrantes.id_integrante
INNER JOIN equipos ON detalle_integrantes.id_equipo = equipos.id_equipo
WHERE
detalle_integrantes.id_equipo = ".$rows['id_equipo']." AND
detalle_integrantes.`status` = 1 AND
detalle_integrantes.id_promocion = ".$num_promos." AND
CAST(marcacionprovicional.fechaMarcacion AS DATE) = '".$num_fechas."' AND
detalle_integrantes.id_cargo = 10");
	$rows_asistente = mysqli_fetch_array($queryInterno,MYSQLI_ASSOC);

	$asis = $rows['cantidad_I'] - $rows_asistente['Asistentes'];
	$porcetaje = round(($rows_asistente['Asistentes'] * 100) / $rows['cantidad_I'],2);

	            $filas.='<tr style="font-size: 14px;" align="center">
							<td>'.$rows['num_equipo'].'</td>
							<td>'.$rows['Equipo'].'</td>
							<td>'.$rows['cantidad_I'].'</td>
							<td>'.$rows_asistente['Asistentes'].'</td>
							<td>'.$asis.'</td>
							<td colspan="2">'.$porcetaje.'%</td>
	            		</tr>';
	            	$cantidadIntegrantes += $rows['cantidad_I'];
	            	$cantidadAsistentes += $rows_asistente['Asistentes'];
			}

			$promocion = mysqli_query($enlace,"select num_promocion,`status` from promociones
WHERE `status`=1");
$datoPromocion = mysqli_fetch_array($promocion, MYSQLI_ASSOC);
$cantidadAusentes = $cantidadIntegrantes - $cantidadAsistentes;
$cantidadPorcentaje = round(($cantidadAsistentes * 100) / $cantidadIntegrantes,2);
 	$Contenido = '<table border=1 cellspacing="0" width="100%">
					<thead>
						
						<tr >
							<th > <img src="photos/logo.png" alt="" width="70" height="70"> </th>
	<th colspan="5" > <h1>ESCUELA DE MAYORDOMIA </h1> <span style="font-size: 14px;"> 02 - REPORTE RESUMEN DE ASISTENCIA OVEJAS - PROMOCION '.$datoPromocion["num_promocion"].'</span> </th>
							
							<th > <img src="photos/logo2.png" alt="" width="70" height="70"> </th>
						</tr>
						
						<tr >
								<th colspan="7">Fecha: '.$fCompleta.'</th>
						</tr >
						
						<tr  style="background-color:#f1c40f;">
								<th colspan="2">EQUIPO</th>
								<th colspan="5">OVEJAS</th>
						</tr >

						<tr style="background-color:#2ecc71; font-size: 10px;">
							<th >No.</th>
							<th>NOMBRE</th>
							<th >CANTIDAD DE INTEGRANTES</th>
							<th>ASISTENTES</th>
							<th>AUSENTES</th>
							<th colspan="2">PORCENTAJE DE ASISTENCIA</th>
						</tr>

					</thead>

					<tbody>
					'.$filas.'
				<tr > 
					<td colspan="2" align="center" style="background-color:#95a5a6;"> TOTALES </td> 
					<td align="center" style="background-color:#f1c40f;"> '.$cantidadIntegrantes.' </td>
					<td align="center" style="background-color:#f1c40f;"> '.$cantidadAsistentes.' </td>
					<td align="center" style="background-color:#f1c40f;"> '.$cantidadAusentes.' </td>
					<td colspan="2" align="center" style="background-color:#f1c40f;">'.$cantidadPorcentaje.'%</td>
				</tr>
		<tr style="background-color:#95a5a6; font-size: 18px;"> <td colspan="7" align="center"> RESUMEN  </td> </tr>
					</tbody>	
 				 </table>';

 	$dompdf = new DOMPDF();
	$dompdf->load_html($Contenido);
	$dompdf->render();
	//$dompdf->stream("mi_archivo.pdf");
	$dompdf->stream("mi_archivo.pdf",array('Attachment'=>0));
 ?>