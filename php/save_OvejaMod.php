<?php
include '../gold/enlace.php';
$id=$_POST['phpId'];
$identidad= $_POST['phpIdentidad'];
$nombre= $_POST['phpNombre'];
$cel= $_POST['phpCel'];
$tel= $_POST['phpTel'];
$area1= $_POST['phpArea1'];
$area2 = $_POST['phpArea2'];
$area3= $_POST['phpArea3'];
$area4= $_POST['phpArea4'];
$area5 = $_POST['phpArea5'];
$fijo= $_POST['phpFijo'];



$query_update = mysqli_query($enlace,"UPDATE ovejas set identidad='$identidad',nombre='$nombre',
cel='$cel',tel='$tel',area1='$area1',area2='$area2',area3='$area3',area4='$area4',area5='$area5',fijo='$fijo' 
WHERE idOveja=".$id);



$filas1= mysqli_affected_rows($enlace);

if ($filas1) {
    # code...

    //segundo query
    echo '<div class="alert alert-success" style="text-align: center;"> 
				<strong> OVEJA EDITADA CORRECTAMENTE</strong>
	 			</div>';

}
mysqli_close($enlace);

?>