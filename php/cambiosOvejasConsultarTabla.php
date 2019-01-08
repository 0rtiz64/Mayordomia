<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 3/11/2018
 * Time: 9:45 AM
 */

include '../gold/enlace.php';

$nombre = $_POST['nombre'];

$queryPromocionActiva = mysqli_query($enlace,"SELECT * from promociones WHERE `status` = 1");
$datosPromocionActiva = mysqli_fetch_array($queryPromocionActiva,MYSQLI_ASSOC);
$correlativo = $datosPromocionActiva["correlativo"];

echo'<table class="table">';
  echo'<thead style="background-color: #212529; color: white">';
    echo'<tr>';
      echo '<th scope="col">#</th>';
      echo'<th scope="col">NOMBRE</th>';
      echo'<th scope="col">IDENTIDAD</th>';
      echo'<th scope="col" colspan="2">OPCIONES</th>';
    echo'</tr>';
  echo'</thead>';
  echo'<tbody>';


$contador = 1;
$queryIntegrantes = mysqli_query($enlace,"SELECT * FROM integrantes WHERE correlativo > $correlativo and nombre_integrante LIKE '%".$nombre."%' LIMIT 5 ");
while ($datosIntegrantes = mysqli_fetch_array($queryIntegrantes,MYSQLI_ASSOC)){
    $idIntegrante = $datosIntegrantes["idintegrante"];
    $queryConfirmarEnlazado = "SELECT equipos.nombre_equipo, equipos.num_equipo from detalle_integrantes 
INNER JOIN equipos on detalle_integrantes.id_equipo = equipos.id_equipo
INNER JOIN promociones on detalle_integrantes.id_promocion = promociones.idpromocion
WHERE detalle_integrantes.id_integrante = $idIntegrante and detalle_integrantes.id_cargo = 10 and promociones.`status` = 1";

    $confirmarEnlazado = mysqli_num_rows(mysqli_query($enlace,$queryConfirmarEnlazado));
    if($confirmarEnlazado >0){
        //SI ESTA ENLAZADO

        echo'<tr>';
        echo'<th scope="row">'.$contador.'</th>';
        echo'<td>'.$datosIntegrantes["nombre_integrante"].'</td>';
        echo'<td>'.$datosIntegrantes["num_identidad"].'</td>';
        echo '<td><button title="MODIFICAR" class="btn" style="background-color: #007BFF" onclick="modalEditarEnlazado('.$datosIntegrantes["idintegrante"].')" ><i  class="fa fa-edit" style="color: white"></i></button></td>';
        echo'<td>
               <div  class="cerrado" id="btn'.$datosIntegrantes["idintegrante"].'" onclick="impresiones('.$datosIntegrantes["idintegrante"].')" style="height:35px;width: 35px;background-color: #ffca0C; box-shadow: 3px 3px 1px rgba(0,0,0,.2);border-radius: 50%;">
                     <i id="i'.$datosIntegrantes["idintegrante"].'" style="font-size: large"><b>...</b></i>
                     <div  class="collapse" title="TOGA" id="c1'.$datosIntegrantes["idintegrante"].'" style="border-radius: 50%;background-color: yellow;width: 40px;height: 40px;margin-left: -45px;"><i style="color:black;margin-top: 10px;"  class="fa fa-graduation-cap"></i></div>
                     <div  class="collapse" title="MATRICULA" id="c2'.$datosIntegrantes["idintegrante"].'" style="border-radius: 50%;background-color: yellow;width: 40px;height: 40px;"><i style="color:black;margin-top: 10px;"  class="fa fa-users"> </i></div>
                     <div  class="collapse" title="INTEGRACION" id="c3'.$datosIntegrantes["idintegrante"].'" style="border-radius: 50%;background-color: yellow;width: 40px;height: 40px;margin-left: 50px;margin-top: -80px;" align="center"><i style="color:black;margin-top: 10px;" class="fa fa-tags"></i></div>
               </div>
              </td>';
        echo'</tr>';
    }else{
        // NO ESTA ENLAZADO

        echo'<tr>';
        echo'<th scope="row">'.$contador.'</th>';
        echo'<td>'.$datosIntegrantes["nombre_integrante"].'</td>';
        echo'<td>'.$datosIntegrantes["num_identidad"].'</td>';
        echo'<td><button title="MODIFICAR" onclick="modalEditarNoEnlazado('.$datosIntegrantes["idintegrante"].')" class="btn" style="background-color: #007BFF"><i class="fa fa-edit" style="color: white"></i></button></td>';
              echo'<td>
               <div  class="cerrado" id="btn'.$datosIntegrantes["idintegrante"].'" onclick="impresiones('.$datosIntegrantes["idintegrante"].')" style="height:35px;width: 35px;background-color: #ffca0C; box-shadow: 3px 3px 1px rgba(0,0,0,.2);border-radius: 50%;">
                     <i id="i'.$datosIntegrantes["idintegrante"].'" style="font-size: large"><b>...</b></i>
               </div>
               <div style="margin-right: -80px">
                     <div  class="collapse" title="TOGA" id="c1'.$datosIntegrantes["idintegrante"].'" style="border-radius: 50%;background-color: yellow;width: 40px;height: 40px;margin-left: -45px;"><i style="color:black;margin-top: 10px;"  class="fa fa-graduation-cap"></i></div>
                     <div  class="collapse" title="MATRICULA" id="c2'.$datosIntegrantes["idintegrante"].'" style="border-radius: 50%;background-color: yellow;width: 40px;height: 40px;"><i style="color:black;margin-top: 10px;"  class="fa fa-users"> </i></div>
                     <div  class="collapse" title="INTEGRACION" id="c3'.$datosIntegrantes["idintegrante"].'" style="border-radius: 50%;background-color: yellow;width: 40px;height: 40px;margin-left: 50px;margin-top: -80px;" align="center"><i style="color:black;margin-top: 10px;" class="fa fa-tags"></i></div>
                </div>
                    
              </td>';
        echo'</tr>';
    }
$contador ++;
}
echo' </tbody>';
echo'</table>';