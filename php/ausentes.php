<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 1/3/2018
 * Time: 11:18 AM
 */
include '../gold/enlace.php';
$fecha = $_POST['phpfecha'];

$verificar= mysqli_num_rows(mysqli_query($enlace,"SELECT DISTINCT nombre_integrante, equipos.num_equipo,equipos.nombre_equipo FROM integrantes
INNER JOIN detalle_integrantes ON detalle_integrantes.id_integrante = integrantes.idintegrante
INNER JOIN equipos ON detalle_integrantes.id_equipo = equipos.id_equipo
  WHERE NOT EXISTS (select * from marcacionprovicional WHERE integrantes.idintegrante= marcacionprovicional.idIntegrante
AND CAST(marcacionprovicional.fechaMarcacion AS DATE) ='.$fecha.'  
) AND integrantes.correlativo>18010000 AND detalle_integrantes.id_promocion=2 ORDER BY equipos.num_equipo ASC"));

if($verificar>0){
    echo '<a class="btn btn-danger"  href="php/PDFreporteAusentes.php?fecha='.$fecha.'" target="_blank" style="color:white;"> <span>Exportar A PDF</span> </a>';
    echo '<a class="btn btn-success"  href="php/EXCELreporteAusentes.php/?fecha='.$fecha.'"  style="color:white;float: right"> <span>Exportar A Excel</span> </a>';

    echo'<table class="table table-bordered table-striped" id="listaTabla">';
    echo '<thead>';
    echo '<tr>';
    echo '<th>#</th>';
    echo '<th>CORRELATIVO</th>';
    echo '<th>NOMBRE</th>';
    echo '<th>EQUIPO</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';
    $contador=1;

    $queryAusentes = mysqli_query($enlace,"SELECT DISTINCT nombre_integrante,correlativo, equipos.num_equipo,equipos.nombre_equipo FROM integrantes
INNER JOIN detalle_integrantes ON detalle_integrantes.id_integrante = integrantes.idintegrante
INNER JOIN equipos ON detalle_integrantes.id_equipo = equipos.id_equipo
  WHERE NOT EXISTS (select * from marcacionprovicional WHERE integrantes.idintegrante= marcacionprovicional.idIntegrante
AND CAST(marcacionprovicional.fechaMarcacion AS DATE) ='".$fecha."'
) AND integrantes.correlativo>18010000 AND detalle_integrantes.id_promocion=2 ORDER BY equipos.num_equipo ASC");
    while($result = mysqli_fetch_array($queryAusentes,MYSQLI_ASSOC)){
        echo '<tr>';
        echo '<td>'.$contador.'</td>';
        echo '<td >'.$result["correlativo"].'</td>';
        echo '<td >'.$result["nombre_integrante"].'</td>';
        echo '<td align="center">'.$result["num_equipo"].'-'.$result["nombre_equipo"].'</td>';
        echo '</tr>';
        $contador ++;
    }
    echo '</tbody>';
    echo '</table>';

}else{
    echo "<div class='alert alert-success' > <strong>NO HAY AUSENTES EN ESTA FECHA</strong>  </div>";
}
?>

