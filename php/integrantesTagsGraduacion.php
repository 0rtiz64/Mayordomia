<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 6/11/2018
 * Time: 11:44 AM
 */
include '../gold/enlace.php';
$idEquipo = $_POST["phpIdEquipo"];

$query = "SELECT * from equipos
INNER JOIN promociones on equipos.id_promocion = promociones.idpromocion
INNER JOIN detalle_integrantes on equipos.id_equipo = detalle_integrantes.id_equipo
INNER JOIN integrantes on detalle_integrantes.id_integrante = integrantes.idintegrante
WHERE promociones.`status` = 1 and detalle_integrantes.id_equipo = '.$idEquipo.' and detalle_integrantes.`status` =1 and detalle_integrantes.toga = 2 and detalle_integrantes.id_cargo = 10 GROUP BY integrantes.nombre_integrante ASC";
$queryConfirma = mysqli_num_rows(mysqli_query($enlace,$query));

if($queryConfirma >0){


    echo '<button type="button" class="btn btn-success" onclick="imprimirTagsTogas('.$idEquipo.')"><i class="fa fa-print"></i> IMPRIMIR TAGS</button>';

    echo'<table class="table table-hover">';
                          echo'<thead>';
                            echo'<tr align="center">';
                              echo'<td><strong>#</strong></td>';
                              echo'<td><strong>NOMBRE</strong></td>';
                              echo'<td><strong>EXPEDIENTE</strong></td>';
                            echo'</tr>';
                          echo'</thead>';
                          echo'<tbody>';
                        $queryDatos = mysqli_query($enlace,$query);
                        $cont =1;
                        while ($datos = mysqli_fetch_array($queryDatos,MYSQLI_ASSOC)){
                            echo'<tr align="center">';
                            echo'<td>'.$cont.'</td>';
                            echo'<td>'.$datos["nombre_integrante"].'</td>';
                            echo'<td>'.$datos["correlativo"].'</td>';
                            echo'</tr>';
                            $cont++;
                        }


                          echo'</tbody>';
                        echo'</table>';
}else{
    echo 0;
}
?>