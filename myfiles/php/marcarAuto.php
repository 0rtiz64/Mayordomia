<?php
/**
 * Created by PhpStorm.
 * User: Megacenter
 * Date: 12/9/2017
 * Time: 10:28
 */

//error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require_once 'conexion.php';
$identidad=$_POST["identidad"];


    $query = mysqli_query($con,"SELECT detalle_integrantes.idetalle_integrantes, integrantes.num_identidad, integrantes.nombre_integrante, equipos.num_equipo,equipos.nombre_equipo,detalle_integrantes.`status` from detalle_integrantes
    INNER JOIN integrantes on detalle_integrantes.id_integrante = integrantes.idintegrante
    INNER JOIN equipos on detalle_integrantes.id_equipo= equipos.id_equipo
  	INNER JOIN promociones ON detalle_integrantes.id_promocion= promociones.idpromocion
    WHERE integrantes.num_identidad = '".$identidad."' AND promociones.`status`=1");

//$filadetalle = mysqli_fetch_array($query,MYSQLI_ASSOC);
//$idDetalle=$filadetalle['idetalle_integrantes'];
   
   $query_ver = mysqli_num_rows(mysqli_query($con,"SELECT num_identidad FROM integrantes WHERE num_identidad='".$identidad."'")); 
if($query_ver==0){
   echo "<div class='alert alert-danger' > <strong> Identidad # ".$identidad." no encontrada</strong>  </div>";
}else{

    echo  '<div class="table-responsive">';
                            echo '<table class="table table-bordered table-striped">';
                                echo '<thead>';
                                echo '<tr>';
                                    echo '<th>#</th>';
                                    echo '<th>Identidad</th>';
                                    echo '<th>Nombre</th>';
                                    echo '<th> Equipo</th>';
                                echo '</tr>';
                                echo '</thead>';
                                echo '<tbody>';
                                    $contador = 1;
                                    $fechaSistema = "".date('Y-m-d H:i:s')."";
                                    $fechaSistemaVerifica = "".date('Y-m-d')."";
                                    while ($fila = mysqli_fetch_array($query,MYSQLI_ASSOC)){


                                        $query_verifica = mysqli_num_rows(mysqli_query($con,"SELECT * FROM marcacion WHERE iddetalle_integrante = ".$fila['idetalle_integrantes']." AND CAST(fecha_marcacion AS DATE) = '".$fechaSistemaVerifica."'"));


                                        if($query_verifica==0){
                                            echo "<tr>";
                                            if($contador == 1){

                                                mysqli_query($con,"INSERT INTO marcacion (iddetalle_integrante,tipo_marcacion,fecha_marcacion) VALUES(".$fila['idetalle_integrantes'].",'1','".$fechaSistema."')");
                                                mysqli_close($con);
                                            }
                                            echo "<td>".$contador."</td>";
                                            echo "<td>".$fila["num_identidad"]."</td>";
                                            echo "<td>".utf8_encode($fila["nombre_integrante"])."</td>";
                                            echo "<td>".$fila["num_equipo"]."-".$fila["nombre_equipo"]."</td>";
                                            echo "</tr>";

                                            if ($fila["status"] == 3){
                                            echo "<tr style='text-align: center;  font-size:16px;'>";
                                            echo "<td colspan='4'> <div class='alert alert-info'> <strong>Asistencia automatica marcada. Estado Integrante Inactivo</strong>  </div> </td>";
                                            echo "</tr>";
                                            }elseif ($fila["status"] == 2){
                                                echo "<tr style='text-align: center;  font-size:16px;'>";
                                                echo "<td colspan='4'> <div class='alert alert-warning'> <strong>Asistencia automatica marcada. Estado Integrante Retirado</strong>  </div> </td>";
                                                echo "</tr>";
                                            }elseif ($fila["status"] == 1){
                                                echo "<tr style='text-align: center;  font-size:16px;'>";
                                                echo "<td colspan='4'> <div class='alert alert-success'> <strong>Asistencia automatica marcada.</strong>  </div> </td>";
                                                echo "</tr>";
                                            };

                                        }else{

                                            echo "<tr>";
                                            echo "<td>".$contador."</td>";
                                            echo "<td>".$fila["num_identidad"]."</td>";
                                            echo "<td>".utf8_encode($fila["nombre_integrante"])."</td>";
                                            echo "<td>".$fila["num_equipo"]."-".$fila["nombre_equipo"]."</td>";
                                            echo "</tr>";


                                            echo "<tr style='text-align: center;  font-size:16px;'>";
                                            echo "<td colspan='4'> <div class='alert alert-danger'> <strong>Este usuario ya habia marcado asistencia!!</strong>  </div> </td>";
                                            echo "</tr>";



                                        }
                                        $contador++;

                                    }


                                echo '</tbody>';
                            echo'</table>';
                    echo '</div>';
                    }

?>