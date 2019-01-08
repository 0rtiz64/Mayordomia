<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 5/12/2018
 * Time: 10:20 AM
 */
include '../gold/enlace.php';

$file = addslashes(file_get_contents($_FILES["imgDiploma"]["tmp_name"]));



    $nombre = "FUNCIONA";

    $carpeta = "documentos/diplomas/";

        $src = $carpeta.$nombre;
        move_uploaded_file($file,$src);
        echo 'IMAGEN GUARDADA';
        echo'<img src="'.$src.'">';

