<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 28/2/2019
 * Time: 2:00 PM
 */

include '../gold/enlace.php';
$num = $_POST["phpNum"];
$fecha = $_POST["phpFecha"];

switch ($num){
    case 1:

        $confirmarF1 = mysqli_num_rows(mysqli_query($enlace,"SELECT f1 FROM clases 
INNER JOIN promociones on clases.idPromocion =  promociones.idpromocion
 WHERE promociones.`status`  =1"));
        if($confirmarF1 >0){
            $guardarF1 = mysqli_query($enlace,"UPDATE clases 
INNER JOIN promociones on clases.idPromocion =  promociones.idpromocion
set clases.f1 = '".$fecha."'
 WHERE promociones.`status`  =1");
        }else{
            //TOMAR ID PROMOCION ACTIVA INICIO
            $queryPromocionActiva = mysqli_query($enlace,"SELECT * from promociones
where promociones.`status`=1");
            $datosPromocionActiva  =mysqli_fetch_array($queryPromocionActiva,MYSQLI_ASSOC);
            $idPromocionActiva = $datosPromocionActiva["idpromocion"];
            //TOMAR ID PROMOCION ACTIVA FINAL
            //INSERT
            $guardarF1 = mysqli_query($enlace,"insert into clases (f1,idpromocion) 
values('".$fecha."',$idPromocionActiva)");
        }


     break;


    case 2:
        $guardarF2 = mysqli_query($enlace,"UPDATE clases 
INNER JOIN promociones on clases.idPromocion =  promociones.idpromocion
set clases.f2 = '".$fecha."'
 WHERE promociones.`status`  =1");
        break;


    case 3:
        $guardarF3 = mysqli_query($enlace,"UPDATE clases 
INNER JOIN promociones on clases.idPromocion =  promociones.idpromocion
set clases.f3 = '".$fecha."'
 WHERE promociones.`status`  =1");
        break;

    case 4:
        $guardarF4 = mysqli_query($enlace,"UPDATE clases 
INNER JOIN promociones on clases.idPromocion =  promociones.idpromocion
set clases.f4 = '".$fecha."'
 WHERE promociones.`status`  =1");
        break;

    case 5:
        $guardarF5 = mysqli_query($enlace,"UPDATE clases 
INNER JOIN promociones on clases.idPromocion =  promociones.idpromocion
set clases.f5 = '".$fecha."'
 WHERE promociones.`status`  =1");
        break;

    case 6:
        $guardarF6 = mysqli_query($enlace,"UPDATE clases 
INNER JOIN promociones on clases.idPromocion =  promociones.idpromocion
set clases.f6 = '".$fecha."'
 WHERE promociones.`status`  =1");
        break;

    case 7:
        $guardarF7 = mysqli_query($enlace,"UPDATE clases 
INNER JOIN promociones on clases.idPromocion =  promociones.idpromocion
set clases.f7 = '".$fecha."'
 WHERE promociones.`status`  =1");
        break;

    case 8:
        $guardarF8 = mysqli_query($enlace,"UPDATE clases 
INNER JOIN promociones on clases.idPromocion =  promociones.idpromocion
set clases.f8 = '".$fecha."'
 WHERE promociones.`status`  =1");
        break;
}

echo  $num;
?>