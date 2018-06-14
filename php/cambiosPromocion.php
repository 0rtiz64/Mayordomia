<?php
include '../gold/enlace.php';

$id = $_POST['phpId'];
$numero = $_POST['phpNumero'];
$nombre= $_POST['phpNombre'];
$estado = $_POST['phpEstado'];
$fecha= $_POST['phpFecha'];//CORRELATIVO


$queryVerifica = mysqli_num_rows(mysqli_query($enlace,"SELECT* from promociones where `status`=1"));
if($queryVerifica >0 AND $estado ==1){
    echo "<div class='alert alert-danger' > <strong>ACTUALMENTE EXISTE UNA PROMOCION ACTIVA</strong>  </div>";
}else{

$query_upedate = mysqli_query($enlace,"UPDATE promociones SET num_promocion=$numero,
desc_promocion='$nombre',`status`=$estado,correlativo='$fecha'
 WHERE idpromocion =$id");



$filas1= mysqli_affected_rows($enlace);

if ($filas1) {
    # code...

    //segundo query
    echo '<div class="alert alert-success" style="text-align: center;"> 
				<strong> PROMOCION EDITADA CORRECTAMENTE</strong>
	 			</div>';

}
mysqli_close($enlace);
}

?>