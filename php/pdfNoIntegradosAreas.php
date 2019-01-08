<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 14/11/2018
 * Time: 4:34 PM
 */

include '../gold/enlace.php';
require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;

$filas = "";


$filas.='
<table class="table table-bordered display nowrap" id="exampleReporte" width="100%" border=1 cellspacing=0 >

    <thead>
    <tr align="center">
    <td colspan="1"> <img src="photos/logo.png" alt="" width="70" height="70"> </td>
    <td colspan="1"> <h1>ESCUELA DE MAYORDOMIA</h1> <span  style="font-size: 14px;" > NO INTEGRADOS EN AREAS</span></td>
    <td colspan="1"> <img src="photos/logo2.png" alt="" width="70" height="70"> </td>
    </tr >




    <tr style="background-color:#2ecc71;" align="center">
    <td><strong>#</strong></td>
    <td><strong>CORRELATIVO</strong></td>
    <td><strong>OVEJA</strong></td>
    <td><strong>TELEFONO</strong></td>
    <td><strong>EQUIPO</strong></td>
    </tr>
    </thead>

    <tbody>';



$queryTodos = mysqli_query($enlace,"SELECT integrantes.correlativo,integrantes.nombre_integrante,integrantes.cel,equipos.num_equipo,equipos.nombre_equipo
  FROM detalle_integrantes
INNER JOIN integrantes on detalle_integrantes.id_integrante = integrantes.idintegrante
INNER JOIN promociones on detalle_integrantes.id_promocion = promociones.idpromocion
INNER JOIN equipos on detalle_integrantes.id_equipo = equipos.id_equipo
 WHERE NOT EXISTS (SELECT NULL
                     FROM integracion
                    WHERE detalle_integrantes.id_integrante = integracion.idIntegrante)
AND promociones.`status` = 1 AND detalle_integrantes.id_cargo = 10 and detalle_integrantes.`status` =1 ORDER BY equipos.num_equipo");



$c=1;

    while ($datos = mysqli_fetch_array($queryTodos,MYSQLI_ASSOC)){

        $filas.="<tr>
    <td>".$c."</td>
    <td>".$datos["correlativo"]."</td>
    <td>".$datos["nombre_integrante"]."</td>
    <td>".$datos["cel"]."</td>
    <td>".$datos["num_equipo"]."- ".$datos["nombre_equipo"]."</td>
    </tr>";
$c++;
    }

$filas.='</tbody> </table>';











$dompdf = new DOMPDF();
$dompdf->load_html( $filas);
$dompdf->render();
//$dompdf->stream("mi_archivo.pdf");
$dompdf->stream("mi_archivo.pdf",array('Attachment'=>0));
?>