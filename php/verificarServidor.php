<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 25/4/2018
 * Time: 2:49 PM
 */
include '../gold/enlace.php';
$identidad = $_POST["phpIdentidad"];

$queryConfirmar =mysqli_num_rows( mysqli_query($enlace,"SELECT * from servidores WHERE num_identidad ='".$identidad."'  "));

if($queryConfirmar>0){
    $queryServidor = mysqli_query($enlace,"SELECT * from servidores WHERE num_identidad ='".$identidad."' ");
    $d =mysqli_fetch_array($queryServidor,MYSQLI_ASSOC);
    $idServidor = $d["idServidor"];

    //VERIFICAR SI TIENE EQUIPO
    $verificarEquipo = mysqli_num_rows(mysqli_query($enlace,"SELECT * from serviciodetalle 
INNER JOIN serviciocargos ON serviciodetalle.idServicioCargo = serviciocargos.idCargo
INNER JOIN servicioequipos ON serviciodetalle.idServicioEquipo =servicioequipos.idEquipo
WHERE serviciodetalle.idServidor = $idServidor
"));
    if($verificarEquipo>0){
        //SI TIENE EQUIPO
        $datosServidor1 = mysqli_query($enlace,"SELECT * from serviciodetalle 
INNER JOIN serviciocargos ON serviciodetalle.idServicioCargo = serviciocargos.idCargo
INNER JOIN servicioequipos ON serviciodetalle.idServicioEquipo =servicioequipos.idEquipo
WHERE serviciodetalle.idServidor = $idServidor
");
        $s= mysqli_fetch_array($datosServidor1,MYSQLI_ASSOC);
        $idEquipo = $s["idServicioEquipo"];
        $idCargo =$s["idServicioCargo"];
    }else{
        //NO TIENE EQUIPO
        $datosServidor2=mysqli_query($enlace,"SELECT * from serviciodetalle 
INNER JOIN serviciocargos ON serviciodetalle.idServicioCargo = serviciocargos.idCargo
WHERE serviciodetalle.idServidor = $idServidor
");
        $s2= mysqli_fetch_array($datosServidor2,MYSQLI_ASSOC);

        $idEquipo= "";
        $idCargo =$s2["idServicioCargo"];
    }


    if($d["areas"]==""){
        $suAre= "";
    }else{
        $suAre=1;
    }


    $datos = array(
        0 => $dato =1,
        1 => $d["num_identidad"],
        2 => $d["nombre_integrante"],
        3 => $d["fecha_cumple"],
        4 => $d["cel"],
        5 => $d["tel"],
        6 => $d["estado_civil"],
        7 => $d["sexo"],
        8 => $d["trasporte"],
        9 => $d["direccion"],
        10 => $d["areas"],
        11 => $d["apellidoCasada"],
        12 => $d["promo_cordero"],
        13 => $suAre,
        14 => $idEquipo,
        15 => $idCargo,

    );
    echo json_encode($datos);


}else{
//VALIDAR SI EXISTE EN TABLA INTEGRANTES

    $queryValidarEnIntegrantes= mysqli_num_rows(mysqli_query($enlace,"SELECT * from integrantes WHERE  num_identidad ='".$identidad."' "));


    if($queryValidarEnIntegrantes>0){
        //TOMAR DATOS INTEGRANTE
        $queryEnIntegrantes = mysqli_query($enlace,"SELECT * from integrantes WHERE  num_identidad ='".$identidad."' ");
        $datosIntegrantes = mysqli_fetch_array($queryEnIntegrantes,MYSQLI_ASSOC);

            $identidad = $datosIntegrantes["num_identidad"];
            $nombre= $datosIntegrantes["nombre_integrante"];
            $fechaNacimiento= $datosIntegrantes["fecha_cumple"];
            $civil= $datosIntegrantes["estado_civil"];
            $genero= $datosIntegrantes["sexo"];
            $transporte= $datosIntegrantes["trasporte"];
            $tel1= $datosIntegrantes["cel"];
            $tel2= $datosIntegrantes["tel"];

            if($datosIntegrantes["areas"] ==""){
                $respuestaIntegrado= 0;
            }else{
                $respuestaIntegrado= 1;
            }
            $areas = $datosIntegrantes["areas"];
            $corderitos = $datosIntegrantes["promo_cordero"];
            $direccion = $datosIntegrantes["direccion"];
            $casada = $datosIntegrantes["apellidoCasada"];


        $datos = array(
            0 => $datos = 2,
            1 => $identidad,
            2 => $nombre,
            3 => $fechaNacimiento,
            4 => $tel1,
            5 => $tel2,
            6 => $civil,
            7 => $genero,
            8 => $transporte,
            9 => $direccion,
            10 => $areas,
            11 => $casada,
            12 => $corderitos,
            13 => $respuestaIntegrado,


        );
        echo json_encode($datos);
    }else{
        $datos = array(
            0 => $datos = 0,
            1 => 0,
            2 => 0,
            3 => 0,
            4 => 0,
            5 => 0,
            6 => 0,
            7 => 0,
            8 => 0,
            9 => 0,
            10 => 0,
            11 => 0,
            12 => 0,


        );
        echo json_encode($datos);
    } //FIN IF VALIDAR SI EXISTE EN INTEGRANTES

} // FIN IF PRINCIPAL






?>