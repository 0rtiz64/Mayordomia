<?php
/**
 * Created by PhpStorm.
 * User: Megacenter
 * Date: 28/11/2017
 * Time: 08:56
 */
include "../gold/enlace.php";

$idEquipo = $_POST['phpEquipoL'];

$verificarEquipo = mysqli_num_rows(mysqli_query($enlace,"SELECT  detalle_integrantes.idetalle_integrantes,integrantes.nombre_integrante,equipos.num_equipo,equipos.nombre_equipo from detalle_integrantes
INNER JOIN integrantes ON detalle_integrantes.id_integrante = integrantes.idintegrante
INNER JOIN equipos ON detalle_integrantes.id_equipo = equipos.id_equipo
INNER JOIN cargos ON detalle_integrantes.id_cargo = cargos.idcargo
WHERE detalle_integrantes.id_equipo= $idEquipo AND cargos.idcargo =10  "));

if ($verificarEquipo > 0){

    $equipoListadoQuery = mysqli_query($enlace,"SELECT  detalle_integrantes.idetalle_integrantes,integrantes.correlativo,integrantes.nombre_integrante,
equipos.num_equipo,equipos.nombre_equipo,integrantes.cel from detalle_integrantes
INNER JOIN integrantes ON detalle_integrantes.id_integrante = integrantes.idintegrante
INNER JOIN equipos ON detalle_integrantes.id_equipo = equipos.id_equipo
INNER JOIN cargos ON detalle_integrantes.id_cargo = cargos.idcargo
WHERE detalle_integrantes.`status`=1  AND detalle_integrantes.id_equipo= $idEquipo AND cargos.idcargo =10 GROUP  BY nombre_integrante ASC");

   $verificaPast = mysqli_num_rows($pastoreadoresQuery = mysqli_query($enlace,"SELECT  detalle_integrantes.idetalle_integrantes,integrantes.num_identidad,integrantes.nombre_integrante,
equipos.num_equipo,equipos.nombre_equipo,integrantes.cel from detalle_integrantes
INNER JOIN integrantes ON detalle_integrantes.id_integrante = integrantes.idintegrante
INNER JOIN equipos ON detalle_integrantes.id_equipo = equipos.id_equipo
INNER JOIN cargos ON detalle_integrantes.id_cargo = cargos.idcargo
WHERE detalle_integrantes.id_equipo= $idEquipo AND cargos.idcargo =9"));

   if($verificaPast >1){

$past1 = mysqli_query($enlace,"SELECT  detalle_integrantes.idetalle_integrantes,integrantes.num_identidad,integrantes.nombre_integrante,
equipos.num_equipo,equipos.nombre_equipo,integrantes.cel from detalle_integrantes
INNER JOIN integrantes ON detalle_integrantes.id_integrante = integrantes.idintegrante
INNER JOIN equipos ON detalle_integrantes.id_equipo = equipos.id_equipo
INNER JOIN cargos ON detalle_integrantes.id_cargo = cargos.idcargo
WHERE detalle_integrantes.id_equipo= $idEquipo AND cargos.idcargo =9
ORDER BY integrantes.nombre_integrante ASC LIMIT 1");


$past2 = mysqli_query($enlace,"SELECT  detalle_integrantes.idetalle_integrantes,integrantes.num_identidad,integrantes.nombre_integrante,
equipos.num_equipo,equipos.nombre_equipo,integrantes.cel from detalle_integrantes
INNER JOIN integrantes ON detalle_integrantes.id_integrante = integrantes.idintegrante
INNER JOIN equipos ON detalle_integrantes.id_equipo = equipos.id_equipo
INNER JOIN cargos ON detalle_integrantes.id_cargo = cargos.idcargo
WHERE detalle_integrantes.id_equipo= $idEquipo AND cargos.idcargo =9
ORDER BY integrantes.nombre_integrante DESC LIMIT 1");

$pastoreador1 = mysqli_fetch_array($past1,MYSQLI_ASSOC);
$pastoreador2 = mysqli_fetch_array($past2,MYSQLI_ASSOC);

$pastA = $pastoreador1["nombre_integrante"];
$pastB =$pastoreador2["nombre_integrante"];

       echo' <div class="col-md-12">';
       echo '<a href="php/EXCELlistadoEquiposDos.php?idEquipo='.$idEquipo.'&PastA='.$pastA.'&pastB='.$pastB.'" class="btn btn-success" style="color: #ffffff" > EXPORTAR A EXCEL</a>';
       echo '<a target="_blank" href="php/PDFlistadoEquiposDos.php?idEquipo='.$idEquipo.'&PastA='.$pastA.'&pastB='.$pastB.'" class="btn btn-danger" style="color: #ffffff; margin-left: 20px" > EXPORTAR A PDF</a>';
       echo'<div class="panel panel-primary">';
       //echo '<a href="php/pdfReporteDetalladoLiderazgo.php?equipo='.$equipo.'&fecha='.$fecha.'&promo='.$promoActiva.'" target="_blank" class="btn btn-danger" style="color: #ffffff"> Generar PDF</a>';
       echo'<div class="panel-heading">';
       echo'<h3 class="panel-title">PASTOREADORES DEL EQUIPO '.$pastoreador1["num_equipo"].'-'.$pastoreador1["nombre_equipo"].'</h3>';
        echo'</div>';
       echo'<div class="panel-body">';
       echo $pastA.' & '.$pastB;
       echo'</div>';
       echo'</div>';
       echo'</div>';
       echo'</div>';

   }else{
       $pastoreadoresQueryUno = mysqli_query($enlace,"SELECT  detalle_integrantes.idetalle_integrantes,integrantes.num_identidad,integrantes.nombre_integrante,
equipos.num_equipo,equipos.nombre_equipo,integrantes.cel from detalle_integrantes
INNER JOIN integrantes ON detalle_integrantes.id_integrante = integrantes.idintegrante
INNER JOIN equipos ON detalle_integrantes.id_equipo = equipos.id_equipo
INNER JOIN cargos ON detalle_integrantes.id_cargo = cargos.idcargo
WHERE detalle_integrantes.id_equipo= $idEquipo AND cargos.idcargo =9");
       $datoUno = mysqli_fetch_array($pastoreadoresQueryUno,MYSQLI_ASSOC);
       echo' <div class="col-md-12">';
       echo '<a href="php/EXCELlistadoUno.php?idEquipo='.$idEquipo.'&PastA='.$datoUno["nombre_integrante"].'" class="btn btn-success" style="color: #ffffff" > EXPORTAR A EXCEL</a>';
       echo '<a href="php/PDFlistadoUno.php?idEquipo='.$idEquipo.'&PastA='.$datoUno["nombre_integrante"].'" class="btn btn-danger" target="_blank" style="color: #ffffff; margin-left: 20px" > EXPORTAR A PDF</a>';
       echo'<div class="panel panel-primary">';
       echo'<div class="panel-heading">';
       echo'<h3 class="panel-title">PASTOREADOR DEL EQUIPO '.$datoUno["num_equipo"].'-'.$datoUno["nombre_equipo"].'</h3>';
       echo'</div>';
       echo'<div class="panel-body">';
       echo $datoUno["nombre_integrante"];
       echo'</div>';
       echo'</div>';
       echo'</div>';
       echo'</div>';

   }





    echo '<div class="table-responsive">';

    echo '<table class="table table-hover" id="example">';

    echo "<thead>";
    echo "<tr>";
    echo "<th>#</th>";
    echo "<th>CORRELATIVO</th>";
    echo "<th>NOMBRE</th>";
    echo "<th>TELEFONO</th>";
    echo "<th>FIRMA</th>";
    echo "</tr>";
    echo "</thead>";

    echo "<tbody>";
 $contador = 1;
    while ($datosEqupoListado = mysqli_fetch_array($equipoListadoQuery,MYSQLI_ASSOC)){
        echo "<tr>";
        echo "<td>".$contador."</td>";
        echo "<td>".$datosEqupoListado["correlativo"]."</td>";
        echo "<td>".$datosEqupoListado["nombre_integrante"]."</td>";
        echo "<td>".$datosEqupoListado["cel"]."</td>";
        echo "<td></td>";
        echo "</tr>";
        $contador++;
    }

    echo "</tbody>";
    echo '</table>';
    echo '</div>';
}else{
    echo "<div class='alert alert-danger' > <strong>ACTUALMENTE NO EXISTEN DATOS PARA ESTE EQUIPO</strong>  </div>";
}
?>