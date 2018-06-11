<?php

include '../gold/enlace.php';

$namePerson = strtoupper($_POST['nombrePersonaEnlazar']);



if (empty($_POST['nombrePersonaEnlazar'])){
    echo "";

}
else{
    $query = mysqli_query($enlace,"SELECT integrantes.idintegrante,integrantes.nombre_integrante
FROM integrantes
WHERE integrantes.nombre_integrante LIKE'%".$namePerson."%' LIMIT 1");

    $rows = mysqli_fetch_array($query,MYSQLI_ASSOC);

    echo '<div class="col-md-6">';
        echo'<input id="integranteEnlazar" type="text" class="form-control" value=" '.$rows["nombre_integrante"].'">';
        echo  '<input id="idIntegranteEnlazar" type="hidden" value="'.$rows["idintegrante"].'">';
    echo '</div>';



}


?>