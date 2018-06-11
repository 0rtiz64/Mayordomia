<?php

include '../gold/enlace.php';

$namePerson = strtoupper($_POST['nombrePersona']);
$namePerson1 = str_replace("'","",$namePerson);


if (empty($_POST['nombrePersona'])){
    echo "";

}
else{
    $query = mysqli_query($enlace,"SELECT detalle_integrantes.idetalle_integrantes,integrantes.idintegrante, integrantes.nombre_integrante,detalle_integrantes.id_promocion FROM detalle_integrantes
INNER JOIN integrantes ON detalle_integrantes.id_integrante = integrantes.idintegrante
WHERE detalle_integrantes.id_cargo = 9 and integrantes.nombre_integrante LIKE '%".$namePerson1."%'");

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