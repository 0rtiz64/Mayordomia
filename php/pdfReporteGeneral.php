<?php
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

$queryVerificar = mysqli_num_rows(mysqli_query($enlace,"SELECT * from marcacionprovicional where CAST(fechaMarcacion AS DATE)= '".$fecha."'"));

if($queryVerificar>0){
    $queryDatos = mysqli_query($enlace,"SELECT integrantes.num_identidad,integrantes.nombre_integrante,integrantes.cel,integrantes.correlativo from marcacionprovicional 
INNER JOIN integrantes ON marcacionprovicional.idIntegrante = integrantes.idintegrante
where CAST(fechaMarcacion AS DATE)= '".$fecha."'  AND  integrantes.correlativo >18010000 ORDER BY integrantes.nombre_integrante ");





   while ($rows = mysqli_fetch_array($queryDatos,MYSQLI_ASSOC)){
       $filas.='
       <tr align="center">
        <td>'.$contador.'</td>
        <td>'.$rows["num_identidad"].'</td>
        <td style="font-size: small" colspan="2">'.$rows["nombre_integrante"].'</td>
    
       </tr>
       ';
       $contador++;
   }

    $queryCantidad = mysqli_query($enlace,"SELECT COUNT(integrantes.num_identidad) AS CANTIDAD from marcacionprovicional 
INNER JOIN integrantes ON marcacionprovicional.idIntegrante = integrantes.idintegrante
where CAST(fechaMarcacion AS DATE)=  '".$fecha."' and integrantes.correlativo >18010000  ");
    $datoCantidad = mysqli_fetch_array($queryCantidad,MYSQLI_ASSOC);
    $contenido= '

   <table style ="width: 100%;" border=1 cellspacing=0 >
<thead>
<tr align="center">
<th align="center"><img src="../myfiles/img/logo.png"   style="width: 70px; height: 70px;"> </th>
<td colspan="2" align="center"><h1>Escuela de Mayordomia</h1> <strong> '.$fCompleta.'</strong><br><br> <span>REPORTE GENERAL DE ASISTENCIA</span></td>
<th align="center"><img src="../myfiles/img/logo2.png" style="width: 70px; height: 70px;"></th>
</tr>






<tr align="center" style="background-color: #2ecc71; ">
<td><strong>No.</strong></td>
<td><strong>IDENTIDAD</strong></td>
<td colspan="2"><strong>NOMBRE</strong></td>

</tr>

</thead>
<tbody>

'.$filas.'
    <tr>
        <td align="center"  style="background-color:#95a5a6;" colspan="2"> TOTALES </td>
        <td align="center" style="background-color:#f1c40f;" colspan="2">'.$datoCantidad["CANTIDAD"].'</td>
    </tr>
    

    </tbody>
    </table>
    ';

}else{

}







$dompdf = new DOMPDF();
$dompdf->load_html( $contenido);
$dompdf->render();
//$dompdf->stream("mi_archivo.pdf");
$dompdf->stream("mi_archivo.pdf",array('Attachment'=>0));
?>