<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 30/4/2018
 * Time: 9:54 AM
 */



include '../gold/enlace.php';
require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;
$filas = "";
$idEquipo=$_GET["equipo"];
$contador =1;

$queryNombreArea = mysqli_query($enlace,"SELECT * from servicioequipos WHERE idEquipo= $idEquipo");
$datosNombreArea = mysqli_fetch_array($queryNombreArea,MYSQLI_ASSOC);
$nombreArea = $datosNombreArea["nombreEquipo"];
//QUERY
$query = mysqli_query($enlace,"SELECT  servidores.nombre_integrante,servicioequipos.nombreEquipo,serviciocargos.nombreCargo, servidores.correlativo from servidores
INNER JOIN serviciodetalle ON servidores.idServidor = serviciodetalle.idServidor
INNER JOIN servicioequipos On serviciodetalle.idServicioEquipo = servicioequipos.idEquipo
INNER JOIN serviciocargos ON serviciodetalle.idServicioCargo = serviciocargos.idCargo
WHERE serviciodetalle.idServicioEquipo = $idEquipo GROUP BY servidores.nombre_integrante ASC");
while($result = mysqli_fetch_array($query,MYSQLI_ASSOC)){

    $filas.=' 
 <tr align="center " style="font-size: 14px;">

  <td>'.$contador.'</td>
    <td style="font-size: x-small" colspan="2">'.$result["nombre_integrante"].'</td>
   
    <td align="center">'.$result["nombreCargo"].'</td>
    <td align="center">'.$result["correlativo"].'</td> 
    </tr>';

    $contador++;
}

$contenido= '
<table style ="width: 100%;" border=1 cellspacing=0 >
<thead>
<tr align="center">
<!--th align="center"><img src="../myfiles/img/logo.png"   style="width: 70px; height: 70px;"> </th-->
<td colspan="5" align="center"><img src="../myfiles/img/logo.png" style="width: 70px; height: 70px; float: left;margin-top: 1%;margin-left: 1%"><h1 style="margin-left: -10%">Escuela de Mayordomia</h1> <img src="../myfiles/img/logo2.png" style="width: 70px; height: 70px; float: right;margin-top: -7%"></td>
<!--th align="center"><img src="../myfiles/img/logo2.png" style="width: 70px; height: 70px;"></th-->
</tr>

<tr style="background-color: #F1C40F" > 
<td colspan="5" align="center" style="color: black;"><strong>' .$nombreArea.'</strong></td>
</tr>





<tr align="center" style="background-color: #2ecc71; ">
<td width="20px"><strong>#</strong></td>
<td width="250px" colspan="2"><strong>NOMBRE</strong></td>

<td ><strong>CARGO</strong></td>
<td><strong>EXPEDIENTE</strong></td>

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