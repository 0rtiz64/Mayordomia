<?php
include '../gold/enlace.php';
$namePerson = $_POST['nombrePersonaEnlazar'];





    $queryCorrelativoPromocion = mysqli_query($enlace,"SELECT * from promociones where `status` =1");
    $datosCorrelativoPromocion = mysqli_fetch_array($queryCorrelativoPromocion,MYSQLI_ASSOC);
$idPromocion = $datosCorrelativoPromocion["idpromocion"];


    $queryConfirm = mysqli_num_rows(mysqli_query($enlace, "SELECT * from detalle_integrantes WHERE id_integrante = $namePerson and id_promocion = $idPromocion"));

    if($queryConfirm>0){

        $datos = array(
            0 => $namePerson,
            1 => 0,
            2 => 0,
            3=> 0,
            4 => 0,

        );
        echo json_encode($datos);
    }else{


        $queryConfirmIntegrante = mysqli_num_rows(mysqli_query($enlace,"SELECT * from integrantes where idintegrante =$namePerson"));

        if($queryConfirmIntegrante>0){
            $queryDatosIntegrante = mysqli_query($enlace,"SELECT * from integrantes where idintegrante =$namePerson");
            $datosIntegrante = mysqli_fetch_array($queryDatosIntegrante,MYSQLI_ASSOC);
            $identidad = $datosIntegrante["num_identidad"];
            $nombre = $datosIntegrante["nombre_integrante"];
            $cel= $datosIntegrante["cel"];

            $datos = array(
                0 => $namePerson,
                1 => $identidad,
                2 => $nombre,
                3=> $cel,
                4 => 1,
            );
            echo json_encode($datos);
        }else{
            $datos = array(
                0 => $namePerson,
                1 => 0,
                2 => 0,
                3=> 0,
                4 => 0,
            );
            echo json_encode($datos);
        }




    }





?>