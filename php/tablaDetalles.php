<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 2/4/2018
 * Time: 4:45 PM
 */
include '../gold/enlace.php';

$id = $_POST['phpId'];

$tomarDatos= mysqli_query($enlace,"select integrantes.nombre_integrante,equipos.num_equipo,equipos.nombre_equipo,promociones.desc_promocion, integrantes.correlativo from detalle_integrantes 
INNER JOIN equipos on detalle_integrantes.id_equipo =equipos.id_equipo
INNER JOIN promociones on detalle_integrantes.id_promocion= promociones.idpromocion
INNER JOIN integrantes on detalle_integrantes.id_integrante = integrantes.idintegrante
where id_integrante = $id AND promociones.`status`=1");

$datos = mysqli_fetch_array($tomarDatos,MYSQLI_ASSOC);


echo'<table class="table table-hover">';
                echo'<thead>';
                echo'<tr align="center">';

                    echo'<th colspan="4"  style="text-align: center">'.$datos["nombre_integrante"].'</th>';
                echo'</tr>';
                echo '</thead>';
                echo '<tbody>';
                echo'<tr >';
                    echo'<td style="text-align: center">Equipo</td>';
                    echo'<td style="text-align: center">'.$datos["num_equipo"].'-'.$datos["nombre_equipo"].'</td>';
                echo '</tr>';

                echo'<tr >';
                    echo '<td style="text-align: center">Correlativo</td>';
                    echo '<td style="text-align: center">'.$datos["correlativo"].'</td>';
                echo'</tr>';

                echo '<tr>';
                    echo '<td colspan="4" style="text-align: center">Promocion 32</td>';
                echo '</tr>';

                echo '</tbody>';
            echo '</table>';

?>