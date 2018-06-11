<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 24/4/2018
 * Time: 9:46 AM
 */



include '../gold/enlace.php';

$idServidor = $_POST['idIntegrante'];

$sql = mysqli_query($enlace,"select * from servidores where idServidor=".$idServidor);

$rows = mysqli_fetch_array($sql,MYSQLI_ASSOC);

$queryServicioDetallesCofirm = mysqli_num_rows(mysqli_query($enlace,"select * from serviciodetalle 
INNER JOIN servidores on serviciodetalle.idServidor= servidores.idServidor
INNER JOIN servicioequipos on serviciodetalle.idServicioEquipo = servicioequipos.idEquipo
INNER JOIN serviciocargos ON serviciodetalle.idServicioCargo = serviciocargos.idCargo
WHERE servidores.idServidor= $idServidor"));


if($queryServicioDetallesCofirm ==0){
    $queryServicioDetallesSinEquipo = mysqli_query($enlace,"select idCargo,serviciodetalle.estado from serviciodetalle 
INNER JOIN servidores on serviciodetalle.idServidor= servidores.idServidor
INNER JOIN serviciocargos ON serviciodetalle.idServicioCargo = serviciocargos.idCargo
WHERE servidores.idServidor= $idServidor");
    $datosquerySinEquipo = mysqli_fetch_array($queryServicioDetallesSinEquipo,MYSQLI_ASSOC);

$equipo = "";
$cargo= $datosquerySinEquipo["idCargo"];
$estado=$datosquerySinEquipo["estado"];

}else{

    $queryServicioDetallesConEquipo =mysqli_query($enlace,"Select idEquipo,idCargo,serviciodetalle.estado from serviciodetalle 
INNER JOIN servidores on serviciodetalle.idServidor= servidores.idServidor
INNER JOIN servicioequipos on serviciodetalle.idServicioEquipo = servicioequipos.idEquipo
INNER JOIN serviciocargos ON serviciodetalle.idServicioCargo = serviciocargos.idCargo
WHERE servidores.idServidor= $idServidor");
    $datosqueryConnEquipo = mysqli_fetch_array($queryServicioDetallesConEquipo,MYSQLI_ASSOC);

    $equipo = $datosqueryConnEquipo["idEquipo"];
    $cargo= $datosqueryConnEquipo["idCargo"];
    $estado= $datosqueryConnEquipo["estado"];
}




if($rows["areas"]==""){
    $suAre= 0;
}else{
    $suAre=1;
}

$datos = array(
    0 => $rows['promo_cordero'],
    1 => $rows['num_identidad'],
    2 => $rows['nombre_integrante'],
    3 => $rows['fecha_cumple'],
    4 => $rows['cel'],
    5 => $rows['tel'],
    6 => $rows['estado_civil'],
    7 => $rows['sexo'],
    8 => $rows['trasporte'],
    9 => $rows['direccion'],
    10 => $rows['areas'],
    11 => $rows['apellidoCasada'],
    12 => $idServidor,
    13 => $suAre,
    14 => $equipo,
    15 => $cargo,
    16 => $estado


);
echo json_encode($datos);

?>