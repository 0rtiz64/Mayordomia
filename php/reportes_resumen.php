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
$query = mysqli_query($enlace,"SELECT DISTINCT cargos.idcargo,cargos.nombre_cargo,COUNT(detalle_integrantes.id_cargo) AS Cantidad FROM detalle_integrantes
INNER JOIN cargos ON detalle_integrantes.id_cargo = cargos.idcargo
INNER JOIN promociones ON detalle_integrantes.id_promocion = promociones.idpromocion
WHERE promociones.idpromocion=$num_promo AND detalle_integrantes.id_cargo <> 10 AND detalle_integrantes.`status`=1
GROUP BY cargos.idcargo,cargos.nombre_cargo");
while ($rows = mysqli_fetch_array($query,MYSQLI_ASSOC)) {
				# code...
    $queryInterno = mysqli_query($enlace,"SELECT IFNULL(COUNT(*),0) Asistentes from detalle_integrantes
INNER JOIN integrantes ON detalle_integrantes.id_integrante = integrantes.idintegrante
INNER JOIN marcacionprovicional ON detalle_integrantes.id_integrante= marcacionprovicional.idIntegrante
INNER JOIN cargos ON detalle_integrantes.id_cargo = cargos.idcargo
WHERE detalle_integrantes.id_promocion=$num_promo AND detalle_integrantes.id_cargo =  ".$rows['idcargo']."
AND CAST(marcacionprovicional.fechaMarcacion AS DATE) = '".$num_fechas."'");
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

$cantidaAusentes = $cantiadIntegrantes - $canidadAsistentes;
$cantidadPorcentaje = round(($canidadAsistentes * 100) / $cantiadIntegrantes,2);
 	$Contenido = '<table border=1 cellspacing="0" width="100%">
					<thead>
						
						<tr >
							<th > <img src="photos/logo.png" alt="" width="70" height="70"> </th>
	<th colspan="3" > <h1>ESCUELA DE MAYORDOMIA </h1> <span style="font-size: 14px;"> 03 - REPORTE RESUMEN - PROMOCION '.$nombrePromocion["num_promocion"].'</span> </th>
							
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
					<td align="center" style="background-color:#f1c40f;"> '.$canidadAsistentes.' </td>
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