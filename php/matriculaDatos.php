<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 21/6/2019
 * Time: 11:39 PM
 */
include "../gold/enlace.php";
$fecha = $_POST["phpFecha"];

$queryCorrelativoInicial = mysqli_query($enlace,"SELECT MIN(correlativo) AS correlativo  from integrantes where CAST(fecha_registro AS DATE) ='".$fecha."' ");
$datosCorerlativoInicial = mysqli_fetch_array($queryCorrelativoInicial,MYSQLI_ASSOC);
$correlativoInicial = $datosCorerlativoInicial["correlativo"];

$queryCorrelativoFinal = mysqli_query($enlace,"SELECT MAX(correlativo) AS correlativo  from integrantes where CAST(fecha_registro AS DATE) ='".$fecha."' ");
$datosCorerlativoFinal= mysqli_fetch_array($queryCorrelativoFinal,MYSQLI_ASSOC);
$correlativoFinal= $datosCorerlativoFinal["correlativo"];

$queryPromoActual = mysqli_query($enlace,"SELECT * from  promociones where `status`=1");
$datosPromoActual= mysqli_fetch_array($queryPromoActual,MYSQLI_ASSOC);
$corrPromoActual = $datosPromoActual["correlativo"];
$corrParametro = substr($corrPromoActual,0,4);

$queryMatriculadosGeneral = mysqli_query($enlace,"SELECT COUNT(*) as GENERAL from integrantes WHERE correlativo LIKE '%".$corrParametro."%' and correlativo > $corrPromoActual");
$datosMatriculadosGeneral = mysqli_fetch_array($queryMatriculadosGeneral,MYSQLI_ASSOC);
$matriculadosGeneral = $datosMatriculadosGeneral["GENERAL"];

$queryMatriculadosHoy = mysqli_query($enlace,"SELECT  COUNT(*) AS HOY FROM integrantes where CAST(fecha_registro AS DATE) = '".$fecha."'");
$datosMatriculadosHoy = mysqli_fetch_array($queryMatriculadosHoy,MYSQLI_ASSOC);
$matriculadosHoy = $datosMatriculadosHoy["HOY"];

echo  '<div class="col-md-3 col-sm-6">';
    echo'<div class="dashboard-tile detail tile-blue">';
        echo'<div class="content">';
            echo'<h1 class="text-left timer" data-from="0" data-to="32" data-speed="2500">'.$correlativoInicial.'</h1>';
            echo'<p>CORRELATIVO INICIAL</p>';
        echo'</div>';
        echo'<div class="icon"><i class="fa fa fa-envelope"></i>';
        echo'</div>';
     echo'</div>';
echo'</div>';

echo  '<div class="col-md-3 col-sm-6">';
echo'<div class="dashboard-tile detail tile-turquoise">';
echo'<div class="content">';
echo'<h1 class="text-left timer" data-from="0" data-to="32" data-speed="2500">'.$correlativoFinal.'</h1>';
echo'<p>CORRELATIVO FINAL</p>';
echo'</div>';
echo'<div class="icon"><i class="fa fa fa-comments"></i>';
echo'</div>';
echo'</div>';
echo'</div>';

echo  '<div class="col-md-3 col-sm-6">';
echo'<div class="dashboard-tile detail tile-purple">';
echo'<div class="content">';
echo'<h1 class="text-left timer" data-from="0" data-to="32" data-speed="2500">'.$matriculadosGeneral.'</h1>';
echo'<p>MATRICULADOS GENERAL</p>';
echo'</div>';
echo'<div class="icon"><i class="fa  fa-bar-chart-o"></i>';
echo'</div>';
echo'</div>';
echo'</div>';

echo  '<div class="col-md-3 col-sm-6">';
echo'<div class="dashboard-tile detail tile-turquoise">';
echo'<div class="content">';
echo'<h1 class="text-left timer" data-from="0" data-to="32" data-speed="2500">'.$matriculadosHoy.'</h1>';
echo'<p>MATRICULADOS HOY</p>';
echo'</div>';
echo'<div class="icon"><i class="fa  fa-bar-chart-o"></i>';
echo'</div>';
echo'</div>';
echo'</div>';

?>