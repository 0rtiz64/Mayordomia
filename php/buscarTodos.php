<?php
include '../gold/enlace.php';
$namePerson = strtoupper($_POST['nombrePersonaEnlazar']);
$name = explode(' ',$_POST['nombrePersonaEnlazar']);
$num =count($name);

$contador2=1;
if (empty($_POST['nombrePersonaEnlazar'])){
    echo "";
}else {

    $queryConfirm = mysqli_num_rows(mysqli_query($enlace, "Select * From integrantes where Not idintegrante In (Select  id_integrante From detalle_integrantes) 
AND integrantes.idintegrante = $namePerson  AND correlativo >18010000"));

    if($queryConfirm>0){
        $query=mysqli_query($enlace,"Select * From integrantes where Not idintegrante In (Select  id_integrante From detalle_integrantes) 
AND integrantes.idintegrante = $namePerson  AND correlativo >18010000");

        while ($resultadoIntegrantesSinEnlazar = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
            $item =$resultadoIntegrantesSinEnlazar["idintegrante"];
            $datosIntegranteQuery= mysqli_query($enlace,"SELECT num_identidad,nombre_integrante,cel FROM integrantes
WHERE idintegrante = '".$item."'");
            $datosIntegrante = mysqli_fetch_array($datosIntegranteQuery,MYSQLI_ASSOC);
            $identidad = $datosIntegrante["num_identidad"];
            $nombre= $datosIntegrante["nombre_integrante"];
            $cel= $datosIntegrante["cel"];
            $idFila =$contador2."F";

            $datos = array(
                0 => $item,
                1 => $identidad,
                2 => $nombre,
                3=> $cel,
                4 => $idFila,
                5 => 1,


            );
            echo json_encode($datos);

        }



    }else{

        $datos = array(
            0 => $namePerson,
            1 => 0,
            2 => 0,
            3=> 0,
            4 => 0,
            5 => 0,


        );
        echo json_encode($datos);

    }








}



?>