<?php

include '../gold/enlace.php';

$namePerson = strtoupper($_POST['nombrePersonaEnlazar']);



if (empty($_POST['nombrePersonaEnlazar'])){
    echo "";

}
else{

    $queryVerificar = mysqli_num_rows(mysqli_query($enlace,"SELECT id,uso from uso"));

    if ($queryVerificar>0){
        $query = mysqli_query($enlace,"SELECT max( uso+1) AS NuevoIntegrante FROM uso ");
        $rows = mysqli_fetch_array($query,MYSQLI_ASSOC);
        $query2 =mysqli_query($enlace,"SELECT max(correlativo +1 ) AS numeroNew FROM uso ");
               $rows2 = mysqli_fetch_array($query2,MYSQLI_ASSOC);
                $corr = $rows2["numeroNew"];
                $id = $rows["NuevoIntegrante"];


        echo'<input id="numeroExpedienteRegistrar" type="text" class="form-control" value=" '.$rows["NuevoIntegrante"].'" readonly="readonly">';

        echo'<input id="correlativo" type="hidden" class="form-control" value=" '.$corr.'" readonly="readonly">';


        $insertar =mysqli_query($enlace,"insert into uso (uso,correlativo) 
values($id,$corr)");

    }else{

        $query = mysqli_query($enlace,"SELECT max(idintegrante +1) AS NuevoIntegrante FROM integrantes ");

        $rows = mysqli_fetch_array($query,MYSQLI_ASSOC);

        $query2 =mysqli_query($enlace,"SELECT max(correlativo +1 ) AS numeroNew FROM integrantes ");
        $rows2 = mysqli_fetch_array($query2,MYSQLI_ASSOC);
        $corr = $rows2["numeroNew"];
        $id = $rows["NuevoIntegrante"];


        echo'<input id="numeroExpedienteRegistrar" type="text" class="form-control" value=" '.$rows["NuevoIntegrante"].'" readonly="readonly">';

        echo'<input id="correlativo" type="hidden" class="form-control" value=" '.$corr.'" readonly="readonly">';

        $insertar =mysqli_query($enlace,"insert into uso (uso,correlativo) 
values($id,$corr)");
    }








}


?>