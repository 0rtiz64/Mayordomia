<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 22/3/2018
 * Time: 11:16 AM
 */
include '../gold/enlace.php';

echo'<table class="table table-bordered table-striped" id="listaTabla">';
echo '<thead>';
echo '<tr>';
echo '<th>#</th>';
echo '<th>NOMBRE</th>';
echo '<th>CORRELATIVO</th>';
echo '<th>EQUIPO</th>';
echo '<th>FECHA 1</th>';
echo '<th>FECHA 2</th>';
echo '<th>FECHA 3</th>';
echo '<th>FECHA 4</th>';
echo '<th>FECHA 5</th>';
echo '<th>FECHA 6</th>';
echo '<th>FECHA 7</th>';
echo '<th>FECHA 8</th>';
echo '<th>FECHA 9</th>';
echo '<th>FECHA 10</th>';
echo '<th>FECHA 11</th>';
echo '<th>FECHA 12</th>';


echo '</tr>';
echo '</thead>';
echo '<tbody>';
$contador=1;

//TOMAR TODOS LOS ID DE MARCACION PROVICIONAL
$qTomarId = mysqli_query($enlace,"select * from marcacionprovicional
 GROUP BY idIntegrante");

while ($dTomarId= mysqli_fetch_array($qTomarId,MYSQLI_ASSOC)){
    $idIntegrante = $dTomarId["idIntegrante"];
    $qConsultarNombre =mysqli_query($enlace,"select nombre_integrante,correlativo,equipos.num_equipo,equipos.nombre_equipo from integrantes
INNER JOIN detalle_integrantes On detalle_integrantes.id_integrante = integrantes.idintegrante
INNER JOIN equipos ON detalle_integrantes.id_equipo=equipos.id_equipo
WHERE idintegrante= $idIntegrante ");
    $dConsultarNombre = mysqli_fetch_array($qConsultarNombre,MYSQLI_ASSOC);
    $nombreIntegrante= $dConsultarNombre["nombre_integrante"];
    $correlativoIntegrante= $dConsultarNombre["correlativo"];
    $numEquipo= $dConsultarNombre["num_equipo"];
    $nombreEquipo= $dConsultarNombre["nombre_equipo"];


    echo '<tr>';
    echo '<td>'.$contador.'</td>';
    echo '<td>'.$nombreIntegrante.'</td>';
    echo '<td>'.$correlativoIntegrante.'</td>';
    echo '<td>'.$numEquipo.'-'.$nombreEquipo.'</td>';

    $qContarAsistencias = mysqli_query($enlace,"SELECT  CAST(fechaMarcacion AS date)  AS qFecha  from marcacionprovicional
WHERE idIntegrante=$idIntegrante GROUP BY qFecha ASC");
    while ($dContarAsistencias = mysqli_fetch_array($qContarAsistencias,MYSQLI_ASSOC)){

        $fecha = $dContarAsistencias["qFecha"];
        //INICIO FUNCION CONVERTIR FECHAS
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
        //FIN FUNCION CONVERTIR FECHAS



        echo '<td>'.$fCompleta.'</td>';
    }//FIN WHILE CONTAR ASISTENCIAS
    echo '</tr>';
    $contador++;
}//FIN WHILE dTomarId
echo '</tbody>';
echo '</table>';

?>