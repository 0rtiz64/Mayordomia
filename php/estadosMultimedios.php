<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 6/2/2019
 * Time: 10:49 AM
 */
include '../gold/enlace.php';
$idIntegrante = $_POST["phpIdIntegrante"];
$accion= $_POST["phpAccion"];

$queryNombre = mysqli_query($enlace,"SELECT nombre_integrante from integrantes WHERE idintegrante = $idIntegrante");
$datosQueryNombre = mysqli_fetch_array($queryNombre,MYSQLI_ASSOC);
$Nombre=$datosQueryNombre["nombre_integrante"];





if($accion ==1){
    //ACTIVAR
    $queryDesactivar = mysqli_query($enlace,"UPDATE liderazgo set  estado=1 WHERE idintegrante=$idIntegrante ");

    //CONTADORES INICIO
    $queryCantidadesActivos = mysqli_query($enlace,"SELECT COUNT(*) as activos from liderazgo WHERE estado= 1  and (idCargo = 8 or idCargo =5)");
    $datosCantidadActivos = mysqli_fetch_array($queryCantidadesActivos,MYSQLI_ASSOC);
    $activos = $datosCantidadActivos["activos"];


    $queryCantidadesDesactivos = mysqli_query($enlace,"SELECT COUNT(*) as desactivos from liderazgo WHERE estado= 2  and (idCargo = 8 or idCargo =5)");
    $datosCantidaddesactivos = mysqli_fetch_array($queryCantidadesDesactivos,MYSQLI_ASSOC);
    $desactivos = $datosCantidaddesactivos["desactivos"];

//CONTADORES FINAL




//TABLA ACTIVOS INICIO

    $tablaActivos = '';

    $tablaActivos.='<table class="table table-hover" >
                                                      <thead>
                                                      <tr align="center">
                                                          <td><strong>#</strong></td>
                                                          <td><strong>NOMBRE</strong></td>
                                                          <td><strong>OPCIONES</strong></td>
                                                      </tr>
                                                      </thead>
                                                      <tbody>';


    include "../gold/enlace.php";
    $queryA = mysqli_query($enlace,"SELECT integrantes.idintegrante,integrantes.nombre_integrante,liderazgo.estado from liderazgo 
INNER JOIN integrantes on liderazgo.idIntegrante = integrantes.idintegrante
WHERE estado= 1  and (idCargo = 8 or idCargo =5) GROUP BY integrantes.nombre_integrante ASC");
    $cA=1;
    while ($DatosA =mysqli_fetch_array($queryA,MYSQLI_ASSOC)){
        if($DatosA["estado"]==1){
            $botonA = '<button type="button" class="btn btn-danger btn-trans" onclick="desactivar('.$DatosA["idintegrante"].')">DESACTIVAR</button>';
        }else{
            $botonA = '<button type="button" class="btn btn-success btn-trans" onclick="activar('.$DatosA["idintegrante"].')">ACTIVAR</button>';
        }
        $tablaActivos.='<tr align="center">
                                                          <td>'.$cA.'</td>
                                                          <td>'.$DatosA["nombre_integrante"].'</td>
                                                          <td>'.$botonA.'</td>
                                                          </tr>';

        $cA++;
    }

    $tablaActivos.='</tbody>
                                                  </table>';

    //TABLA ACTIVOS FINAL


    //TABLA DESACTIVOS INICIO
    $tablaDesactivos = '';

    $tablaDesactivos.='<table class="table table-hover" >
                                                      <thead>
                                                      <tr align="center">
                                                          <td><strong>#</strong></td>
                                                          <td><strong>NOMBRE</strong></td>
                                                          <td><strong>OPCIONES</strong></td>
                                                      </tr>
                                                      </thead>
                                                      <tbody>';


    include "../gold/enlace.php";
    $queryD = mysqli_query($enlace,"SELECT integrantes.idintegrante,integrantes.nombre_integrante,liderazgo.estado from liderazgo 
INNER JOIN integrantes on liderazgo.idIntegrante = integrantes.idintegrante
WHERE estado= 2  and (idCargo = 8 or idCargo =5) GROUP BY integrantes.nombre_integrante ASC");
    $cD=1;
    while ($DatosD =mysqli_fetch_array($queryD,MYSQLI_ASSOC)){
        if($DatosD["estado"]==1){
            $botonD = '<button type="button" class="btn btn-danger btn-trans" onclick="desactivar('.$DatosD["idintegrante"].')">DESACTIVAR</button>';
        }else{
            $botonD = '<button type="button" class="btn btn-success btn-trans" onclick="activar('.$DatosD["idintegrante"].')">ACTIVAR</button>';
        }
        $tablaDesactivos.='<tr align="center">
                                                          <td>'.$cD.'</td>
                                                          <td>'.$DatosD["nombre_integrante"].'</td>
                                                          <td>'.$botonD.'</td>
                                                          </tr>';

        $cD++;
    }

    $tablaDesactivos.='</tbody>
                                                  </table>';

    //TABLA DESACTIVOS FINAL


    $datos = array(
        0 =>table(),
        1 => $Nombre,
        2 => $activos,
        3 => $desactivos,
        4 => $tablaActivos,
        5 => $tablaDesactivos,
    );
    echo json_encode($datos);

}else{
    //DESACTIVAR
    $queryDesactivar = mysqli_query($enlace,"UPDATE liderazgo set  estado=2 WHERE idintegrante=$idIntegrante ");
    //CONTADORES INICIO
    $queryCantidadesActivos = mysqli_query($enlace,"SELECT COUNT(*) as activos from liderazgo WHERE estado= 1  and (idCargo = 8 or idCargo =5)");
    $datosCantidadActivos = mysqli_fetch_array($queryCantidadesActivos,MYSQLI_ASSOC);
    $activos = $datosCantidadActivos["activos"];


    $queryCantidadesDesactivos = mysqli_query($enlace,"SELECT COUNT(*) as desactivos from liderazgo WHERE estado= 2  and (idCargo = 8 or idCargo =5)");
    $datosCantidaddesactivos = mysqli_fetch_array($queryCantidadesDesactivos,MYSQLI_ASSOC);
    $desactivos = $datosCantidaddesactivos["desactivos"];

//CONTADORES FINAL



//TABLA ACTIVOS INICIO

    $tablaActivos = '';

    $tablaActivos.='<table class="table table-hover" >
                                                      <thead>
                                                      <tr align="center">
                                                          <td><strong>#</strong></td>
                                                          <td><strong>NOMBRE</strong></td>
                                                          <td><strong>OPCIONES</strong></td>
                                                      </tr>
                                                      </thead>
                                                      <tbody>';


    include "../gold/enlace.php";
    $queryA = mysqli_query($enlace,"SELECT integrantes.idintegrante,integrantes.nombre_integrante,liderazgo.estado from liderazgo 
INNER JOIN integrantes on liderazgo.idIntegrante = integrantes.idintegrante
WHERE estado= 1  and (idCargo = 8 or idCargo =5) GROUP BY integrantes.nombre_integrante ASC");
    $cA=1;
    while ($DatosA =mysqli_fetch_array($queryA,MYSQLI_ASSOC)){
        if($DatosA["estado"]==1){
            $botonA = '<button type="button" class="btn btn-danger btn-trans" onclick="desactivar('.$DatosA["idintegrante"].')">DESACTIVAR</button>';
        }else{
            $botonA = '<button type="button" class="btn btn-success btn-trans" onclick="activar('.$DatosA["idintegrante"].')">ACTIVAR</button>';
        }
        $tablaActivos.='<tr align="center">
                                                          <td>'.$cA.'</td>
                                                          <td>'.$DatosA["nombre_integrante"].'</td>
                                                          <td>'.$botonA.'</td>
                                                          </tr>';

        $cA++;
    }

    $tablaActivos.='</tbody>
                                                  </table>';

    //TABLA ACTIVOS FINAL


    //TABLA DESACTIVOS INICIO
    $tablaDesactivos = '';

    $tablaDesactivos.='<table class="table table-hover" >
                                                      <thead>
                                                      <tr align="center">
                                                          <td><strong>#</strong></td>
                                                          <td><strong>NOMBRE</strong></td>
                                                          <td><strong>OPCIONES</strong></td>
                                                      </tr>
                                                      </thead>
                                                      <tbody>';


    include "../gold/enlace.php";
    $queryD = mysqli_query($enlace,"SELECT integrantes.idintegrante,integrantes.nombre_integrante,liderazgo.estado from liderazgo 
INNER JOIN integrantes on liderazgo.idIntegrante = integrantes.idintegrante
WHERE estado= 2  and (idCargo = 8 or idCargo =5) GROUP BY integrantes.nombre_integrante ASC");
    $cD=1;
    while ($DatosD =mysqli_fetch_array($queryD,MYSQLI_ASSOC)){
        if($DatosD["estado"]==1){
            $botonD = '<button type="button" class="btn btn-danger btn-trans" onclick="desactivar('.$DatosD["idintegrante"].')">DESACTIVAR</button>';
        }else{
            $botonD = '<button type="button" class="btn btn-success btn-trans" onclick="activar('.$DatosD["idintegrante"].')">ACTIVAR</button>';
        }
        $tablaDesactivos.='<tr align="center">
                                                          <td>'.$cD.'</td>
                                                          <td>'.$DatosD["nombre_integrante"].'</td>
                                                          <td>'.$botonD.'</td>
                                                          </tr>';

        $cD++;
    }

    $tablaDesactivos.='</tbody>
                                                  </table>';

    //TABLA DESACTIVOS FINAL

    $datos = array(
        0 =>table(),
        1 => $Nombre,
        2 => $activos,
        3 => $desactivos,
        4 => $tablaActivos,
        5 => $tablaDesactivos,
    );
    echo json_encode($datos);
}

function table(){
    $tabla = '';

    $tabla.='<table class="table table-hover" >
                                      <thead>
                                      <tr align="center">
                                          <td><strong>#</strong></td>
                                          <td><strong>NOMBRE</strong></td>
                                          <td><strong>OPCIONES</strong></td>
                                      </tr>
                                      </thead>
                                      <tbody>
';


                                    include "../gold/enlace.php";

                                      $query = mysqli_query($enlace,"SELECT integrantes.idintegrante,integrantes.nombre_integrante,liderazgo.estado from liderazgo 
INNER JOIN integrantes on liderazgo.idIntegrante = integrantes.idintegrante
WHERE idCargo = 8 OR idCargo =5 GROUP BY integrantes.nombre_integrante ASC");
                                      $c=1;
                                      while ($Datos =mysqli_fetch_array($query,MYSQLI_ASSOC)){
                                         if($Datos["estado"]==1){
                                             $boton = '<button type="button" class="btn btn-danger btn-trans" onclick="desactivar('.$Datos["idintegrante"].')">DESACTIVAR</button>';
                                         }else{
                                             $boton = '<button type="button" class="btn btn-success btn-trans" onclick="activar('.$Datos["idintegrante"].')">ACTIVAR</button>';
                                         }

                                         $tabla.='
                                         <tr align="center">
                                          <td>'.$c.'</td>
                                          <td>'.$Datos["nombre_integrante"].'</td>
                                          <td>'.$boton.'</td>
                                          </tr>
                                         ';
                                          $c++;
                                      }


                $tabla.=' </tbody>
                                  </table>';

                                      return $tabla;

}

?>