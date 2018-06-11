<?php 
$conn = mysqli_connect("192.168.2.114","root","54321","personas");

$id = $_POST['nombrePersona'];

$sql = mysqli_query($conn,"SELECT * FROM tbl_cne_m_censo_nacional where NUMERO_IDENTIDAD =".$id);

$rows = mysqli_fetch_array($sql,MYSQLI_ASSOC);


$datos = array(
        0 => $rows['NUMERO_IDENTIDAD'], 
        1 => $rows['FECHA_NACIMIENTO'],
        2 => $rows['NOMBRE_COMPLETO'],
        //3 => $rows['cel'],
        //4 => $rows['tel'], 
        //5 => $rows['Estado'], 
        //6 => $rows['idpromocion'],
        //7 => $rows['Ep'],
        //8 => $rows['idcargo'],
        );
echo json_encode($datos);

 ?>