<?php
include '../gold/enlace.php';

$numPromocion=$_POST["phpNumeroPromocion"];
$nombrePromocion=$_POST["phpNombrePromocion"];
$estadoPromocion=$_POST["phpEstadoPromocion"];
$correlativoPromocion=$_POST["phpCorrelativoPromocion"];

$fechaSistema = "".date('Y-m-d H:i:s')."";



$query_ver = mysqli_num_rows(mysqli_query($enlace,"SELECT idpromocion,num_promocion,desc_promocion,`status`,CAST(fecha_registro AS DATE) from promociones
where num_promocion ='".$numPromocion."'"));
if($query_ver >0){
    echo "<div class='alert alert-danger' > <strong>NUMERO DE PROMOCION YA  REGISTRADO</strong>  </div>";


}else {

    $queryver2 = mysqli_num_rows(mysqli_query($enlace, "SELECT * from promociones
where  `status`=1 "));
    if ($queryver2 > 0 && $estadoPromocion ==1) {
        echo "<div class='alert alert-danger' > <strong>ACTUALMENTE HAY UNA PROMOCION ACTIVA</strong>  </div>";
    } else {

        $query = mysqli_query($enlace, "insert into promociones (num_promocion,desc_promocion,status,fecha_registro,correlativo) 
values($numPromocion,'$nombrePromocion',$estadoPromocion,'$fechaSistema ',$correlativoPromocion)");


        if (mysqli_affected_rows($enlace) > 0) {

            echo "<div class='alert alert-success' > <strong>PROMOCION GUARDADA</strong>  </div>";
            /*
            echo "<script>";
           echo "recargarNumeroExpediente(".$Id.");";
           echo "</script>";*/
        } else {
            echo mysqli_error($enlace);
        }
        mysqli_close($enlace);
    }

}

?>