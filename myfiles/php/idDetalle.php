<?php
/**
 * Created by PhpStorm.
 * User: Megacenter
 * Date: 12/9/2017
 * Time: 10:41
 */

class idDetalle
{

    function __construct()
    {
        # code...
    }


//Funcion conexion
    function conexion()
    {
        $con = mysqli_connect("192.168.2.168", "root", "54321", "db_mayordomia");


        if ($con) {
            //echo "Conexion exitosa";
        } else {
            echo "Error al conectar";
        }

        return $con;
    }

    //Funcion conexion Termina


    function obtenerIdIntegrante($identidad)
    {
        $newCon = $this->conexion();
        $query = mysqli_query($newCon, "SELECT idintegrante FROM integrantes WHERE num_identidad ='" . $identidad . "'");
        $idintegrante = mysqli_fetch_array($query, MYSQLI_ASSOC);
        $idDetlle = $this->obtenerIdDetalle($idintegrante['idintegrante']);
        return $idDetlle;
    }


    function obtenerIdDetalle($idintegrante)
    {
        $newCon1 = $this->conexion();
        $query = mysqli_query($newCon1, "SELECT idetalle_integrantes from detalle_integrantes where id_integrante='" . $idintegrante . "'");
        $iddetalleIntegrante = mysqli_fetch_array($query, MYSQLI_ASSOC);
        return $iddetalleIntegrante['idetalle_integrantes'];

    }
}

