<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 20/2/2018
 * Time: 11:11 AM
 */

include '../gold/enlace.php';
require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;
$filas = "";
$idEquipo= $_GET['idEquipo'];
$pastA = $_GET['PastA'];
$pastB = $_GET['pastB'];
$contador =1;

/*
$dia = substr($fecha,8,2);
$mes = substr($fecha,5,2);
$aaa = substr($fecha,0,4);

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
*/

$queryDatos = mysqli_query($enlace,"SELECT  detalle_integrantes.idetalle_integrantes,integrantes.num_identidad,integrantes.nombre_integrante,
equipos.num_equipo,equipos.nombre_equipo,integrantes.cel,integrantes.correlativo,integrantes.promo_cordero,integrantes.fecha_cumple,integrantes.cel,
 integrantes.estado_civil,integrantes.sexo,integrantes.trasporte,integrantes.direccion,integrantes.areas,integrantes.apellidoCasada from detalle_integrantes
INNER JOIN integrantes ON detalle_integrantes.id_integrante = integrantes.idintegrante
INNER JOIN equipos ON detalle_integrantes.id_equipo = equipos.id_equipo
INNER JOIN cargos ON detalle_integrantes.id_cargo = cargos.idcargo
WHERE  detalle_integrantes.`status`=1  AND detalle_integrantes.id_equipo= $idEquipo AND cargos.idcargo =10 GROUP BY integrantes.nombre_integrante ASC");





while ($rows = mysqli_fetch_array($queryDatos,MYSQLI_ASSOC)){
    $filas.='
       <tr align="center">
        <td>'.$contador.'</td>
        <td>'.$rows["correlativo"].'</td>
        <td style="font-size: small" colspan="2">'.$rows["nombre_integrante"].'</td>
    <td>'.$rows["cel"].'</td>
    <td colspan="2"></td>
    
       </tr>
       ';
    $contador++;
}

$queryEquipo = mysqli_query($enlace,"SELECT * FROM equipos where equipos.id_equipo= $idEquipo");
$datosEquipo = mysqli_fetch_array($queryEquipo,MYSQLI_ASSOC);
$numeroEquipo = $datosEquipo["num_equipo"];
$nombreEquipo= $datosEquipo["nombre_equipo"];

    $contenido= '

   <table style ="width: 100%;" border=1 cellspacing=0 >
<thead>
<tr align="center">
<th align="center"><img src="../myfiles/img/logo.png"   style="width: 70px; height: 70px;"> </th>
<td colspan="5" align="center"><h1>Escuela de Mayordomia</h1> <strong> </strong><br><br> <span>LISTADO DE EQUIPO '.$numeroEquipo.'-'.$nombreEquipo.'</span></td>
<th align="center"><img src="../myfiles/img/logo2.png" style="width: 70px; height: 70px;"></th>
</tr>



<tr style="background-color: #f3dc53;"  align="center">
<td colspan="7"> PASTOREADORES: ' .$pastA.' & '.$pastB.'</td>
</tr>


<tr align="center" style="background-color: #2ecc71; ">
<td><strong>No.</strong></td>
<td><strong>CORRELATIVO</strong></td>
<td colspan="2"><strong>NOMBRE</strong></td>
<td><strong>TELEFONO</strong></td>
<td colspan="2"><strong>FIRMA</strong></td>



</tr>

</thead>
<tbody>

'.$filas.'
    
    
    </tbody>
    </table>
    ';









$dompdf = new DOMPDF();
$dompdf->load_html( $contenido);
$dompdf->render();
//$dompdf->stream("mi_archivo.pdf");
$dompdf->stream("mi_archivo.pdf",array('Attachment'=>0));
?>
