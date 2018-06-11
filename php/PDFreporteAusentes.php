<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 2/3/2018
 * Time: 9:45 AM
 */

include '../gold/enlace.php';
require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;
$filas = "";
$fecha=$_GET["fecha"];
$contador =1;


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


//QUERY
$queryAusentes = mysqli_query($enlace,"SELECT DISTINCT nombre_integrante,correlativo, equipos.num_equipo,equipos.nombre_equipo FROM integrantes
INNER JOIN detalle_integrantes ON detalle_integrantes.id_integrante = integrantes.idintegrante
INNER JOIN equipos ON detalle_integrantes.id_equipo = equipos.id_equipo
  WHERE NOT EXISTS (select * from marcacionprovicional WHERE integrantes.idintegrante= marcacionprovicional.idIntegrante
AND CAST(marcacionprovicional.fechaMarcacion AS DATE) ='".$fecha."'
) AND integrantes.correlativo>18010000 AND detalle_integrantes.id_promocion=2 ORDER BY equipos.num_equipo ASC");
while($result = mysqli_fetch_array($queryAusentes,MYSQLI_ASSOC)){

        $filas.=' 
 <tr align="center">

  <td>'.$contador.'</td>
    <td  >'.$result["correlativo"].'</td>
    <td >'.$result["nombre_integrante"].'</td>
    <td align="center">'.$result["num_equipo"].'-'.$result["nombre_equipo"].'</td>

 
    </tr>';

        $contador++;
    }

    $contenido= '
<table style ="width: 100%;" border=1 cellspacing=0 >
<thead>
<tr align="center">
<th align="center"><img src="../myfiles/img/logo.png"   style="width: 70px; height: 70px;"> </th>
<td colspan="2" align="center"><h1>Escuela de Mayordomia</h1> <strong> '.$fCompleta.'</strong><br><br> <span>REPORTE AUSENTES   </span></td>
<th align="center"><img src="../myfiles/img/logo2.png" style="width: 70px; height: 70px;"></th>
</tr>





<tr align="center" style="background-color: #2ecc71; ">
<td><strong>#</strong></td>
<td><strong>CORRELATIVO</strong></td>
<td ><strong>NOMBRE</strong></td>
<td ><strong>EQUIPO</strong></td>
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