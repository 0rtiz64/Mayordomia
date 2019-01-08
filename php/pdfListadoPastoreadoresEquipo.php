<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 21/9/2018
 * Time: 10:42 AM
 */

include '../gold/enlace.php';
require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;

$filas = "";



$queryIdEquipos= mysqli_query($enlace,"SELECT id_equipo, num_equipo,nombre_equipo from equipos 
INNER JOIN promociones ON equipos.id_promocion = promociones.idpromocion
where promociones.`status` = 1 and  equipos.num_equipo> 0 GROUP BY num_equipo ASC");
$contador = 1;
while ($datosId = mysqli_fetch_array($queryIdEquipos,MYSQLI_ASSOC)){
    $idEquipo = $datosId["id_equipo"];
    $confirmarPastoreadores = mysqli_num_rows(mysqli_query($enlace,"SELECT * from detalle_integrantes 
where detalle_integrantes.id_equipo = $idEquipo AND detalle_integrantes.id_cargo = 9"));



    if($confirmarPastoreadores>1){
        $queryPastoreadoresPorEquipo= mysqli_query($enlace,"SELECT nombre_integrante from detalle_integrantes 
INNER JOIN integrantes on detalle_integrantes.id_integrante = integrantes.idintegrante
where detalle_integrantes.id_equipo = $idEquipo AND detalle_integrantes.id_cargo = 9");

        $filas.='<tr align="center">
        <td>'.$contador.'</td>
        <td>'.$datosId["num_equipo"].'- '.$datosId["nombre_equipo"].'</td>';
        while ($datosPastoreadores = mysqli_fetch_array($queryPastoreadoresPorEquipo,MYSQLI_ASSOC)){
            $filas.='<td>'.$datosPastoreadores["nombre_integrante"].'</td>';
        };
        $filas.='</tr>';
    }else{
        $queryPastoreadoresPorEquipo= mysqli_query($enlace,"SELECT nombre_integrante from detalle_integrantes 
INNER JOIN integrantes on detalle_integrantes.id_integrante = integrantes.idintegrante
where detalle_integrantes.id_equipo = $idEquipo AND detalle_integrantes.id_cargo = 9");
        $datosPastoreadores = mysqli_fetch_array($queryPastoreadoresPorEquipo,MYSQLI_ASSOC);
        $filas.='<tr align="center">
        <td>'.$contador.'</td>
        <td>'.$datosId["num_equipo"].'- '.$datosId["nombre_equipo"].'</td>
        <td>'.$datosPastoreadores["nombre_integrante"].'</td>
        <td></td>
        </tr>';
    }
    $contador++;
}






$contenido='
<table class="table table-bordered display nowrap"  width="100%" border=1 cellspacing=0 >

    <thead>
    <tr align="center">
    <td colspan="1"> <img src="photos/logo.png" alt="" width="70" height="70"> </td>
    <td colspan="2"> <h1>ESCUELA DE MAYORDOMIA</h1> <span  style="font-size: 14px;" > LISTADO PASTOREADORES POR EQUIPO</span></td>
    <td colspan="1"> <img src="photos/logo2.png" alt="" width="70" height="70"> </td>
    </tr >




    <tr style="background-color:#2ecc71;" align="center">
    <td><strong>#</strong></td>
    <td><strong>EQUIPO</strong></td>
    <td><strong>PASTOREADOR 1</strong></td>
    <td><strong> PASTOREADOR 2</strong></td>
    </tr>
    </thead>

    <tbody>
    
       '.$filas.' 
    </tbody>
    </table>';










$dompdf = new DOMPDF();
$dompdf->load_html($contenido);
$dompdf->render();
//$dompdf->stream("mi_archivo.pdf");
$dompdf->stream("mi_archivo.pdf",array('Attachment'=>0));
?>
