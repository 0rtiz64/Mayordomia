<?php
include '../gold/enlace.php';

$id = $_POST['phpId'];
$numero = $_POST['phpNumero'];
$nombre= $_POST['phpNombre'];




    $query_upedate = mysqli_query($enlace, "UPDATE equipos SET num_equipo='$numero',
nombre_equipo ='$nombre'
 WHERE id_equipo =$id");


    $filas1 = mysqli_affected_rows($enlace);

    if ($filas1) {
        # code...

        //segundo query
        echo '<div class="alert alert-success" style="text-align: center;"> 
				<strong> EQUIPO EDITADO CORRECTAMENTE</strong>
	 			</div>';

    }
    mysqli_close($enlace);


?>