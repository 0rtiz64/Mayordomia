<?php

include '../gold/enlace.php';

$namePerson = strtoupper($_POST['nombrePersona']);
$namePerson1 = str_replace("'","",$namePerson);


if (empty($_POST['nombrePersona'])){
    echo "";

}
else{
    $query = mysqli_query($enlace,"SELECT integrantes.idintegrante, integrantes.nombre_integrante FROM pastoreadores
INNER JOIN integrantes ON pastoreadores.idIntegrante= integrantes.idintegrante
WHERE integrantes.nombre_integrante LIKE '%".$namePerson1."%' AND pastoreadores.estado= 1");

$datoEncontrado = mysqli_fetch_array($query,MYSQLI_ASSOC);

echo'<input type="text" class="form-control " value="'.utf8_encode($datoEncontrado["nombre_integrante"]).'" readonly>';
echo'<input type="hidden" class="form-control" value="'.$datoEncontrado["idintegrante"].'">';
echo'<div id="alertPastoreadorAsignar1" style="background-color: #58D68D; color: white; border-radius:4px" align="center" class="collapse">AGREGADO EN PASTOREADOR 1</div>';
echo'<div id="alertPastoreadorAsignar2" style="background-color: #58D68D; color: white; border-radius:4px" align="center" class="collapse">AGREGADO EN PASTOREADOR 2</div>';
echo'<div style="margin-left: 280px; margin-top: -35px">';
echo '<a href="javascript:seleccionar(\''.$datoEncontrado["idintegrante"].'\',\''.utf8_encode($datoEncontrado["nombre_integrante"]).'\');" class="btn btn-info ">SELECCIONAR</a>';
echo'</div>';



}


?>