<?php
/**
 * Created by PhpStorm.
 * User: Megacenter
 * Date: 20/11/2017
 * Time: 10:56
 */


                            include '../gold/enlace.php';

                            $queryEquiposPromocion = mysqli_query($enlace, "SELECT equipos.id_equipo,equipos.num_equipo,equipos.nombre_equipo from equipos
INNER JOIN promociones ON equipos.id_promocion = promociones.idpromocion
WHERE promociones.`status`= 1");
                            $promocion = mysqli_query($enlace,"SELECT num_promocion,desc_promocion FROM promociones
where `status`=1");
                            $datosPromocion = mysqli_fetch_array($promocion, MYSQLI_ASSOC);

                           echo ' <div class="panel panel-default">';
                          echo'<div class="panel-heading">';
                            echo '<h3 class="panel-title">PROMOCION '.$datosPromocion["num_promocion"].'</h3>';

                          echo '</div>';
                          echo'<div class="panel-body">';

                            echo'<div class="table-responsive">';
                              echo'<table class="table table-bordered table-striped">';
                                echo'<thead  align="center">';
                                  echo'<tr >';
                                    echo '<td ><strong>#</strong></td>';
                                    echo '<td><strong>EQUIPO</strong></td>';
                                    echo '<td><strong>OPCION</strong></td>';

                                  echo'</tr>';
                                echo '</thead>';
                                echo'<tbody align="center">';


                            $contador= 1;
                            while ($datosEquipos = mysqli_fetch_array($queryEquiposPromocion,MYSQLI_ASSOC)){
                                echo '<tr>';
                                echo '<td>'.$contador.' </td>';
                                echo '<td>'.$datosEquipos["num_equipo"].'-'.$datosEquipos["nombre_equipo"].' </td>';
                                echo '<td><a href="javascript:editarEquipo('.$datosEquipos['id_equipo'].');" class="fa fa-cog" title="MODIFICAR"></a></td>';
                                $contador++;
                            }

                            echo'</tbody>';
                            echo'</table>';
                            echo '</div>';

                            echo'</div>';
                            echo'</div>';
                            ?>
