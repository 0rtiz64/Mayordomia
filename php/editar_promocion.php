
<?php
include '../gold/enlace.php';

$id = $_POST['id'];

$sql = mysqli_query($enlace,"select num_promocion, desc_promocion, `status`, CAST(fecha_registro AS DATE)AS fRegistro from promociones
where idpromocion =".$id);

$rows = mysqli_fetch_array($sql,MYSQLI_ASSOC);


$datos = array(
    0 => $rows['num_promocion'],
    1 => $rows['desc_promocion'],
    2 => $rows['fRegistro'],
    3 => $rows['status'],


);
echo json_encode($datos);

?>
