<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 28/2/2018
 * Time: 2:05 PM
 */


                        include '../gold/enlace.php';
                        $fechaentrada = date('Y-m-d ');
                        $queryNumPromo= mysqli_query($enlace,"select * from promociones where `status` =1");
                        $datosNumPromo = mysqli_fetch_array($queryNumPromo,MYSQLI_ASSOC);
                        $num_promo= $datosNumPromo["idpromocion"];
                        $foto = ' <div class="list-item-image">
                        <img src="assets/img/user.png" class="img-circle">
                    </div>';
                        $queryCantidadTotales = mysqli_query($enlace,"SELECT DISTINCT E.id_equipo,E.num_equipo,E.nombre_equipo AS Equipo, COUNT(a.id_equipo) AS cantidad_I FROM detalle_integrantes a 
INNER JOIN equipos E ON a.id_equipo = E.id_equipo
INNER JOIN promociones ON E.id_promocion = promociones.idpromocion
WHERE a.id_promocion = ".$num_promo."  AND a.id_cargo=10 AND a.`status`=1 AND promociones.`status`=1 
GROUP BY E.id_equipo,E.num_equipo,E.nombre_equipo");
                        while ( $equipos = mysqli_fetch_array($queryCantidadTotales,MYSQLI_ASSOC)){
                            $queryConteoPorEquipo = mysqli_query($enlace,"SELECT  IFNULL(COUNT(*),0) Asistentes  from integrantes
INNER JOIN marcacionprovicional ON integrantes.idintegrante = marcacionprovicional.idIntegrante
INNER JOIN detalle_integrantes ON integrantes.idintegrante = detalle_integrantes.id_integrante
INNER JOIN equipos ON detalle_integrantes.id_equipo = equipos.id_equipo
WHERE
detalle_integrantes.id_equipo = ".$equipos['id_equipo']." AND
detalle_integrantes.`status` = 1 AND
detalle_integrantes.id_promocion = ".$num_promo." AND
CAST(marcacionprovicional.fechaMarcacion AS DATE) = '".$fechaentrada."' AND
detalle_integrantes.id_cargo = 10");
                            $datosConteoAsistieron = mysqli_fetch_array($queryConteoPorEquipo,MYSQLI_ASSOC);




                            $asistieron = $datosConteoAsistieron["Asistentes"];
                            $Totales = $equipos["cantidad_I"];
                            $porcetaje = round(($asistieron* 100) / $Totales,2);

    if($porcetaje <= 50){
        $barra ='  <div class="progress-bar progress-bar-danger" style="width: '.$porcetaje.'%">'.$porcetaje.'%</div>';
    }else{
        if($porcetaje >50 && $porcetaje <=80){
            $barra ='  <div class="progress-bar progress-bar-primary" style="width: '.$porcetaje.'%">'.$porcetaje.'%</div>';
        }else{
            if($porcetaje>80){
                $barra ='  <div class="progress-bar progress-bar-success" style="width: '.$porcetaje.'%">'.$porcetaje.'%</div>';
            }
        }
    }


                            echo '<a href="javascript:void(0)" class="list-item">';
                            echo $foto;
                            echo '<div class="list-item-content">';
                            echo '<h4>'.$equipos["num_equipo"].'-'.$equipos["Equipo"].' <span class="badge badge-danager animated bounceIn" id="new-messages">'.$asistieron .'</span></h4> ';
                            echo '<br>';
                            echo'<div class="progress progress-striped active">';
                            echo $barra;
                            echo'</div>';
                            echo'</div>';

                            echo'</a>';
///BORRAR RESTO DE CODIGO CON FOTO POR INTEGRANTE
                        }

                        ?>