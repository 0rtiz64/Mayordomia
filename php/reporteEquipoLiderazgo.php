<?php
/**
 * Created by PhpStorm.
 * User: Megacenter
 * Date: 14/9/2017
 * Time: 09:13
 */

include '../gold/enlace.php';
$equipo=$_POST["equipo"];
$fecha=$_POST["fecha"];
$promoActiva=$_POST["promocion"];


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

if ($equipo == 36){
    $queryReporte = mysqli_query($enlace,"SELECT integrantes.num_identidad,integrantes.nombre_integrante, integrantes.cel,cargos.nombre_cargo from marcacionprovicional 
INNER JOIN liderazgo ON marcacionprovicional.idIntegrante = liderazgo.idIntegrante
INNER JOIN integrantes ON liderazgo.idIntegrante= integrantes.idintegrante
INNER JOIN cargos ON liderazgo.idCargo= cargos.idcargo
where CAST(marcacionprovicional.fechaMarcacion AS date) ='".$fecha."' 
and liderazgo.idCargo<> 9 and liderazgo.idCargo<>10 AND liderazgo.estado=1
ORDER BY integrantes.nombre_integrante
");
//$fila = mysqli_fetch_array($queryReporte,MYSQLI_ASSOC);


    $queryPromocion = mysqli_query($enlace,"select promociones.num_promocion from equipos
INNER JOIN promociones ON equipos.id_promocion = promociones.idpromocion
WHERE promociones.idpromocion =".$promoActiva." ");
    $promocion = mysqli_fetch_array($queryPromocion,MYSQLI_ASSOC);



    echo '<a href="php/pdfReporteDetalladoLiderazgo.php?equipo='.$equipo.'&fecha='.$fecha.'&promo='.$promoActiva.'" target="_blank" class="btn btn-danger" style="color: #ffffff"> Generar PDF</a>';
    echo  '<div class="table-responsive">';
    echo '<table class="table table-bordered table-striped" id="example">';
    echo '<div >';
//echo '<img src="myfiles/img/logo2.png" style="float: left;width: 40px; height: 40px;margin-top: 10%">';
    echo '<h2 align="center" >Escuela de Mayordomia   <img src="myfiles/img/logo.png"  style="float: left;width: 70px; height: 70px;"> <img src="myfiles/img/logo2.png" style="float: right;width: 70px; height: 70px;"></h2>';
    echo '<h3 align="center">Reporte Detallado De Asistencia De Liderazgo Promocion '.$promocion["num_promocion"].' </h3>';
    echo '<h4 align="center">'.$fCompleta.'</h4>';
    echo '</div>';
    echo '<thead>';
    echo '<tr>';
    echo '<th align="center">#</th>';
    echo '<th align="center">Identidad</th>';
    echo '<th align="center">Nombre</th>';
    echo '<th align="center"> Cargo</th>';


    echo '</tr>';
    echo '</thead>';
    echo '<tbody align="center">';
    $contador = 1;

    while ($fila = mysqli_fetch_array($queryReporte,MYSQLI_ASSOC)) {


        echo "<td align='center'>" . $contador . "</td>";
        echo "<td align='center'>" . $fila["num_identidad"] . "</td>";
        echo "<td align='center'>" . utf8_encode($fila["nombre_integrante"]) . "</td>";
        echo "<td align='center'>" . $fila["nombre_cargo"] . "</td>";

        echo "</tr>";
        $contador++;
    }


    echo '</tbody>';
    echo'</table>';



    $queryTotalAsistencia= mysqli_query($enlace,"	SELECT COUNT(marcacionprovicional.idIntegrante)as CANTIDAD from marcacionprovicional 
	INNER JOIN liderazgo ON marcacionprovicional.idIntegrante = liderazgo.idIntegrante
	INNER JOIN integrantes ON liderazgo.idIntegrante= integrantes.idintegrante
	where CAST(marcacionprovicional.fechaMarcacion AS date) ='".$fecha."' 
	 AND liderazgo.estado=1");
    $filaAsistenciaTotal= mysqli_fetch_array($queryTotalAsistencia,MYSQLI_ASSOC);


    $queryTotalIntegrantesEquipo= mysqli_query($enlace,"SELECT  COUNT(idLiderazgo) as cantidad FROM liderazgo 
WHERE  liderazgo.estado=1");
    $filaTotalIntegrantesEquipo= mysqli_fetch_array($queryTotalIntegrantesEquipo,MYSQLI_ASSOC);

    $promedioparte1 = $filaAsistenciaTotal["CANTIDAD"]*100;
    $promedioparte2 = $promedioparte1 / $filaTotalIntegrantesEquipo["cantidad"];
    $promedioTotal =  round($promedioparte2,0);

    echo '<label> Asistencia Total: <strong>'.$filaAsistenciaTotal["CANTIDAD"].'</strong></label>';
    echo '<label style="margin-left: 15%">Promedio: <strong>'.$promedioTotal.'%</strong></label>';


    echo '</div>';
}elseif ($equipo == 9){
    $queryReporte = mysqli_query($enlace,"SELECT integrantes.idintegrante,integrantes.num_identidad,integrantes.nombre_integrante,integrantes.cel  from marcacionprovicional 
INNER JOIN pastoreadores ON marcacionprovicional.idIntegrante = pastoreadores.idIntegrante
INNER JOIN integrantes ON marcacionprovicional.idIntegrante = integrantes.idintegrante
where CAST(marcacionprovicional.fechaMarcacion AS date)='".$fecha."'
and pastoreadores.estado= 1
GROUP BY integrantes.nombre_integrante ASC");
//$fila = mysqli_fetch_array($queryReporte,MYSQLI_ASSOC);


    $queryPromocion = mysqli_query($enlace,"SELECT num_promocion from promociones
WHERE `status`=1");
    $promocion = mysqli_fetch_array($queryPromocion,MYSQLI_ASSOC);



    echo '<a href="php/pdfReporteDetalladoPastoreadores.php?equipo='.$equipo.'&fecha='.$fecha.'&promo='.$promoActiva.'" target="_blank" class="btn btn-danger" style="color: #ffffff"> Generar PDF</a>';
    echo  '<div class="table-responsive">';
    echo '<table class="table table-bordered table-striped" id="example">';
    echo '<div >';
//echo '<img src="myfiles/img/logo2.png" style="float: left;width: 40px; height: 40px;margin-top: 10%">';
    echo '<h2 align="center" >Escuela de Mayordomia   <img src="myfiles/img/logo.png"  style="float: left;width: 70px; height: 70px;"> <img src="myfiles/img/logo2.png" style="float: right;width: 70px; height: 70px;"></h2>';
    echo '<h3 align="center">Reporte detallado de asistencia de Pastoreadores Promocion '.$promocion["num_promocion"].' </h3>';
    echo '<h4 align="center">'.$fCompleta.'</h4>';
    echo '</div>';
    echo '<thead>';
    echo '<tr align="center">';
    echo '<th >#</th>';
    echo '<th align="center">Identidad</th>';
    echo '<th align="center">Nombre</th>';
    echo '<th align="center"> Equipo</th>';

    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';
    $contador = 1;

    while ($fila = mysqli_fetch_array($queryReporte,MYSQLI_ASSOC)) {
$idIntegrante = $fila["idintegrante"];
        $validarSiTieneEquipo =mysqli_num_rows( mysqli_query($enlace,"SELECT * from detalle_integrantes 
INNER JOIN promociones on detalle_integrantes.id_promocion = promociones.idpromocion
INNER JOIN equipos on detalle_integrantes.id_equipo = equipos.id_equipo
WHERE promociones.`status` = 1 and detalle_integrantes.id_integrante = $idIntegrante AND detalle_integrantes.id_cargo = 9"));

        if($validarSiTieneEquipo>0){
            $queryTomarEquipo = mysqli_query($enlace,"SELECT * from detalle_integrantes 
INNER JOIN promociones on detalle_integrantes.id_promocion = promociones.idpromocion
INNER JOIN equipos on detalle_integrantes.id_equipo = equipos.id_equipo
WHERE promociones.`status` = 1 and detalle_integrantes.id_integrante = $idIntegrante AND detalle_integrantes.id_cargo = 9");
            $datosEquipo = mysqli_fetch_array($queryTomarEquipo,MYSQLI_ASSOC);
            $equipo= $datosEquipo["num_equipo"].'-'.$datosEquipo["nombre_equipo"];
        }else{
            $equipo ="";
        }

        echo "<td align='center'>" . $contador."</td>";
        echo "<td align='center'>" . $fila["num_identidad"] . "</td>";
        echo "<td align='center'>" . utf8_encode($fila["nombre_integrante"]) . "</td>";
        echo "<td align='center'>" . $equipo . "</td>";



        echo "</tr>";
        $contador++;
    }



    echo '</tbody>';
    echo'</table>';



    $queryTotalAsistencia= mysqli_query($enlace,"SELECT COUNT(marcacionprovicional.idIntegrante) as CANTIDAD from marcacionprovicional 
INNER JOIN pastoreadores ON marcacionprovicional.idIntegrante = pastoreadores.idIntegrante
INNER JOIN integrantes ON marcacionprovicional.idIntegrante = integrantes.idintegrante
where CAST(marcacionprovicional.fechaMarcacion AS date)='".$fecha."'  
 AND pastoreadores.estado = 1");
    $filaAsistenciaTotal= mysqli_fetch_array($queryTotalAsistencia,MYSQLI_ASSOC);


    $queryTotalIntegrantesEquipo= mysqli_query($enlace,"
SELECT COUNT(pastoreadores.idIntegrante)as CANTIDAD FROM pastoreadores
WHERE pastoreadores.estado = 1");
    $filaTotalIntegrantesEquipo= mysqli_fetch_array($queryTotalIntegrantesEquipo,MYSQLI_ASSOC);

    $promedioparte1 = $filaAsistenciaTotal["CANTIDAD"]*100;
    $promedioparte2 = $promedioparte1 / $filaTotalIntegrantesEquipo["CANTIDAD"];
    $promedioTotal =  round($promedioparte2,0);

    echo '<label> Asistencia Total: <strong>'.$filaAsistenciaTotal["CANTIDAD"].'</strong></label>';
    echo '<label style="margin-left: 15%">Promedio: <strong>'.$promedioTotal.'%</strong></label>';


    echo '</div>';
};


?>

