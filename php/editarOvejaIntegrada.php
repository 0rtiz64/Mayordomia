<?php
include '../gold/enlace.php';

$recibo = $_POST['phpRecibo'];

$sql = mysqli_query($enlace,"SELECT integrantes.num_identidad, ovejas.idOveja,ovejas.identidad , ovejas.nombre,ovejas.cel,ovejas.tel,ovejas.fijo,
ovejas.area1,ovejas.area2,ovejas.area3,ovejas.area4,ovejas.area5 FROM integrantes
INNER JOIN ovejas ON integrantes.num_identidad=ovejas.identidad
where integrantes.idintegrante=".$recibo );

$rows = mysqli_fetch_array($sql,MYSQLI_ASSOC);


$datos = array(
    0 => $rows['identidad'],
    1 => $rows['nombre'],
    2 => $rows['cel'],
    3 => $rows['tel'],
    4 => $rows['area1'],
    5 => $rows['area2'],
    6 => $rows['area3'],
    7 => $rows['area4'],
    8 => $rows['area5'],
    9 => $rows['idOveja'],
    10 => $rows['fijo'],

);
echo json_encode($datos);

?>