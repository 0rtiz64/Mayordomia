<?php 
include '../gold/enlace.php';
	require_once 'dompdf/autoload.inc.php';
 	use Dompdf\Dompdf;

$num_promo = $_GET['id_promos'];
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
$cantiadIntegrantes = 0;
$canidadAsistentes = 0;
$cantidaAusentes = 0;
$cantidadPorcentaje = 0;
$queryNombrePromocion = mysqli_query($enlace,"SELECT num_promocion from promociones
WHERE idpromocion = $num_promo ");
$nombrePromocion = mysqli_fetch_array($queryNombrePromocion,MYSQLI_ASSOC);
$query = mysqli_query($enlace,"SELECT DISTINCT cargos.idcargo,cargos.idcargo,cargos.nombre_cargo,COUNT(liderazgo.idCargo) AS Cantidad FROM liderazgo
INNER JOIN cargos ON liderazgo.idCargo= cargos.idcargo
WHERE liderazgo.estado = 1
GROUP BY cargos.idcargo,cargos.nombre_cargo");
while ($rows = mysqli_fetch_array($query,MYSQLI_ASSOC)) {
				# code...
    $queryInterno = mysqli_query($enlace,"SELECT IFNULL(COUNT(*),0) Asistentes from liderazgo
INNER JOIN integrantes ON liderazgo.idIntegrante = integrantes.idintegrante
INNER JOIN marcacionprovicional ON liderazgo.idIntegrante= marcacionprovicional.idIntegrante
INNER JOIN cargos ON liderazgo.idCargo= cargos.idcargo
WHERE liderazgo.idCargo=  ".$rows['idcargo']."
AND CAST(marcacionprovicional.fechaMarcacion AS DATE) = '".$num_fechas."' AND liderazgo.estado = 1");
    $rows_asistente = mysqli_fetch_array($queryInterno,MYSQLI_ASSOC);

	$asis = $rows['Cantidad'] - $rows_asistente['Asistentes'];
	$porcetaje = round(($rows_asistente['Asistentes'] * 100) / $rows['Cantidad'],2);

	            $filas.='<tr style="font-size: 14px;" align="center">
							<td colspan="3">'.$rows['nombre_cargo'].'</td>
							<td>'.$rows_asistente['Asistentes'].'</td>
							<td >'.$porcetaje.'%</td>
	            		</tr>';
	            	$cantiadIntegrantes += $rows['Cantidad'];
				$canidadAsistentes += $rows_asistente['Asistentes'];
			}


$queryAsistenciaPastoreadores = mysqli_query($enlace,"SELECT IFNULL(COUNT(*),0) Asistentes from pastoreadores
INNER JOIN integrantes ON pastoreadores.idIntegrante= integrantes.idintegrante
INNER JOIN marcacionprovicional ON pastoreadores.idIntegrante= marcacionprovicional.idIntegrante
WHERE CAST(marcacionprovicional.fechaMarcacion AS DATE) = '".$num_fechas."' AND pastoreadores.estado = 1");
$datosQueryPastoreadores = mysqli_fetch_array($queryAsistenciaPastoreadores,MYSQLI_ASSOC);
$asistenciaPastoreadores = $datosQueryPastoreadores["Asistentes"];

$queryCantidadPastoreadores = mysqli_query($enlace,"SELECT COUNT(*) as CantPast FROM pastoreadores
where pastoreadores.estado = 1");
$datosQueryCantidadPastoreadores = mysqli_fetch_array($queryCantidadPastoreadores,MYSQLI_ASSOC);
$cantidadPastoreadores = $datosQueryCantidadPastoreadores["CantPast"];
$inasistenciaPastoreadores  = $cantidadPastoreadores - $asistenciaPastoreadores;
$porcetajePastoreadores = round(($asistenciaPastoreadores * 100) /$cantidadPastoreadores,2);

$filas.='<tr style="font-size: 14px;" align="center">
							<td colspan="3">Pastoreadores</td>
							<td>'.$asistenciaPastoreadores.'</td>
							<td >'.$porcetajePastoreadores.'%</td>
	            		</tr>';

$cantidadAsistenciaTotal = $canidadAsistentes+$asistenciaPastoreadores;
$cantidadIntegrantesTotal = $cantiadIntegrantes+$cantidadPastoreadores;
$cantidadInasistenciaTotal = $canidadAsistentes+$inasistenciaPastoreadores;
$cantidaAusentes = $cantidadIntegrantesTotal - $cantidadInasistenciaTotal;
$cantidadPorcentaje = round(($cantidadAsistenciaTotal * 100) / $cantidadIntegrantesTotal,2);
 	$Contenido = '<table border=1 cellspacing="0" width="100%">
					<thead>
						
						<tr >
							<th > <img src="photos/logo.png" alt="" width="70" height="70"> </th>
	<th colspan="3" > <h1>ESCUELA DE MAYORDOMIA </h1> <span style="font-size: 14px;"> REPORTE RESUMEN - PROMOCION '.$nombrePromocion["num_promocion"].'</span> </th>
							
							<th > <img src="photos/logo2.png" alt="" width="70" height="70"> </th>
						</tr>
						
						<tr >
								<th colspan="5">Fecha: '.$fCompleta.'</th>
						</tr >
						
					

						<tr style="background-color:#2ecc71; font-size: 14px;">
							<th colspan="3">CARGO</th>
							<th>ASISTENCIA</th>
							
							<th>PORCENTAJE</th>
						</tr>

					</thead>
						'.$filas.'
					<tbody>
					
				<tr > 
					<td colspan="3" align="center" style="background-color:#95a5a6;"> TOTAL / PROMEDIO </td> 
					<td align="center" style="background-color:#f1c40f;"> '.$cantidadAsistenciaTotal.' </td>
					<td  align="center" style="background-color:#f1c40f;">'.$cantidadPorcentaje.'%</td>
				</tr>
		<tr style="background-color:#95a5a6; font-size: 18px;"> <td colspan="5" align="center"> RESUMEN  </td> </tr>
					</tbody>	
 				 </table>';

 	$dompdf = new DOMPDF();
	$dompdf->load_html($Contenido);
	$dompdf->render();
	//$dompdf->stream("mi_archivo.pdf");
	$dompdf->stream("mi_archivo.pdf",array('Attachment'=>0));
 ?>