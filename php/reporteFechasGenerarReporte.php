<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 4/3/2019
 * Time: 3:30 PM
 */
include '../gold/enlace.php';
$equipo = $_POST["phpEquipo"];



echo'<table class="table table-hover">';
    echo'<thead class="bg-success">';
        echo'<tr align="center">';
            echo'<td>#</td>';
            echo'<td><strong>NOMBRE</strong></td>';
            echo'<td><strong>F1</strong></td>';
            echo'<td><strong>F2</strong></td>';
            echo'<td><strong>F3</strong></td>';
            echo'<td><strong>F4</strong></td>';
            echo'<td><strong>F5</strong></td>';
            echo'<td><strong>F6</strong></td>';
            echo'<td><strong>F7</strong></td>';
            echo'<td><strong>F8</strong></td>';
        echo'</tr>';
    echo'</thead>';
    echo'<tbody align="center">';

$queryIntegrantes = mysqli_query($enlace,"SELECT integrantes.idintegrante,integrantes.nombre_integrante from detalle_integrantes
INNER JOIN integrantes on detalle_integrantes.id_integrante = integrantes.idintegrante
WHERE detalle_integrantes.id_equipo = $equipo and detalle_integrantes.id_cargo = 10 GROUP BY integrantes.nombre_integrante ASC");
$c =1;
while($datosIntegrantes = mysqli_fetch_array($queryIntegrantes,MYSQLI_ASSOC)){

    $querySeleccionarFechasDeBusqueda = mysqli_query($enlace,"SELECT clases.f1,clases.f2,clases.f3,clases.f4,clases.f5,clases.f6,clases.f7,clases.f8 from clases 
INNER JOIN promociones on clases.idPromocion = promociones.idpromocion
WHERE promociones.`status`=1");
    $datosFechasBusqueda = mysqli_fetch_array($querySeleccionarFechasDeBusqueda,MYSQLI_ASSOC);

    $idIntegrante= $datosIntegrantes["idintegrante"];
    $fecha1 = $datosFechasBusqueda["f1"];
    $fecha2 = $datosFechasBusqueda["f2"];
    $fecha3 = $datosFechasBusqueda["f3"];
    $fecha4 = $datosFechasBusqueda["f4"];
    $fecha5 = $datosFechasBusqueda["f5"];
    $fecha6 = $datosFechasBusqueda["f6"];
    $fecha7 = $datosFechasBusqueda["f7"];
    $fecha8 = $datosFechasBusqueda["f8"];

    //FECHA 1 INICIO
    $queryF1 = mysqli_num_rows(mysqli_query($enlace,"SELECT * from marcacionprovicional WHERE
idIntegrante = $idIntegrante and CAST(fechaMarcacion AS DATE) = '".$fecha1."' "));
    if($queryF1 >0){
        $resF1 = '<td><i class="fa fa-check"></i></td>';
    }else{
        $resF1='<td>X</td>';
    }
    //FECHA 1 FINAL


    //FECHA 2 INICIO
    $queryF2 = mysqli_num_rows(mysqli_query($enlace,"SELECT * from marcacionprovicional WHERE
idIntegrante = $idIntegrante and CAST(fechaMarcacion AS DATE) = '".$fecha2."' "));
    if($queryF2 >0){
        $resF2 = '<td><i class="fa fa-check"></i></td>';
    }else{
        $resF2='<td>X</td>';
    }
    //FECHA 2 FINAL


    //FECHA 2 INICIO
    $queryF3 = mysqli_num_rows(mysqli_query($enlace,"SELECT * from marcacionprovicional WHERE
idIntegrante = $idIntegrante and CAST(fechaMarcacion AS DATE) = '".$fecha3."' "));
    if($queryF3 >0){
        $resF3 = '<td><i class="fa fa-check"></i></td>';
    }else{
        $resF3='<td>X</td>';
    }
    //FECHA 3 FINAL

    //FECHA 4 INICIO
    $queryF4 = mysqli_num_rows(mysqli_query($enlace,"SELECT * from marcacionprovicional WHERE
idIntegrante = $idIntegrante and CAST(fechaMarcacion AS DATE) = '".$fecha4."' "));
    if($queryF4 >0){
        $resF4 = '<td><i class="fa fa-check"></i></td>';
    }else{
        $resF4='<td>X</td>';
    }
    //FECHA 4 FINAL

    //FECHA 5 INICIO
    $queryF5 = mysqli_num_rows(mysqli_query($enlace,"SELECT * from marcacionprovicional WHERE
idIntegrante = $idIntegrante and CAST(fechaMarcacion AS DATE) = '".$fecha5."' "));
    if($queryF5 >0){
        $resF5 = '<td><i class="fa fa-check"></i></td>';
    }else{
        $resF5='<td>X</td>';
    }
    //FECHA 5 FINAL

    //FECHA 6 INICIO
    $queryF6 = mysqli_num_rows(mysqli_query($enlace,"SELECT * from marcacionprovicional WHERE
idIntegrante = $idIntegrante and CAST(fechaMarcacion AS DATE) = '".$fecha6."' "));
    if($queryF6 >0){
        $resF6 = '<td><i class="fa fa-check"></i></td>';
    }else{
        $resF6='<td>X</td>';
    }
    //FECHA 6 FINAL

    //FECHA 7 INICIO
    $queryF7 = mysqli_num_rows(mysqli_query($enlace,"SELECT * from marcacionprovicional WHERE
idIntegrante = $idIntegrante and CAST(fechaMarcacion AS DATE) = '".$fecha7."' "));
    if($queryF7 >0){
        $resF7 = '<td><i class="fa fa-check"></i></td>';
    }else{
        $resF7='<td>X</td>';
    }
    //FECHA 7 FINAL

    //FECHA 8 INICIO
    $queryF8 = mysqli_num_rows(mysqli_query($enlace,"SELECT * from marcacionprovicional WHERE
idIntegrante = $idIntegrante and CAST(fechaMarcacion AS DATE) = '".$fecha8."' "));
    if($queryF8 >0){
        $resF8 = '<td><i class="fa fa-check"></i></td>';
    }else{
        $resF8='<td>X</td>';
    }
    //FECHA 8 FINAL

    echo'<tr>';
        echo'<td>'.$c.'</td>';
        echo'<td>'.utf8_encode($datosIntegrantes["nombre_integrante"]).'</td>';
        echo $resF1;
        echo $resF2;
        echo $resF3;
        echo $resF4;
        echo $resF5;
        echo $resF6;
        echo $resF7;
        echo $resF8;


    $c++;
}

     echo'</tbody>
     </table>';



?>