<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 17/1/2018
 * Time: 2:12 PM
 */

include '../gold/enlace.php';

$identidad=$_POST["phpIdentidad"];

$queryId=mysqli_num_rows(mysqli_query($enlace,"select  idintegrante,promo_cordero,num_identidad,nombre_integrante,fecha_cumple,cel,tel,estado_civil,sexo,trasporte,direccion,areas,apellidoCasada,bautizado from integrantes
WHERE num_identidad = '".$identidad."'"));

if($queryId>0){


    $queryDatos = mysqli_query($enlace,"SELECT * from integrantes WHERE num_identidad ='".$identidad."'");
    $rows = mysqli_fetch_array($queryDatos,MYSQLI_ASSOC);
    $validacionPromocion = 0;
    if($rows["correlativo"] ==""){
        $desPromocion ="PROMOCION 31";
    }else{
        $correlativoIntegrante=  substr($rows["correlativo"],0,4);
        $tomarPromocion = mysqli_query($enlace,"SELECT * from promociones where correlativo LIKE '%".$correlativoIntegrante."%' ");
        $datosTomarPromocion = mysqli_fetch_array($tomarPromocion,MYSQLI_ASSOC);
        $desPromocion =$datosTomarPromocion["desc_promocion"];

        $promoActiva =mysqli_query($enlace,"SELECT * from promociones WHERE `status`=1");
        $datosPromoActiva=mysqli_fetch_array($promoActiva,MYSQLI_ASSOC);
        if ($datosPromoActiva["desc_promocion"]== $desPromocion){
            $validacionPromocion = 1;
        }
    }



if($rows["areas"] ==""){
    $respuestaIntegrado = "No";
}else{
    $respuestaIntegrado="Si";
}






//QUERY CONSULTAR NINOS FIN


    $datos = array(
        0 => $dato =1,
        1 => $rows['num_identidad'],
        2 => utf8_encode($rows['nombre_integrante']),
        3 => $rows['fecha_cumple'],
        4 => $rows['cel'],
        5 => $rows['tel'],
        6 => $rows['estado_civil'],
        7 => $rows['sexo'],
        8 => $rows['trasporte'],
        9 => $rows['direccion'],
        10 => $rows['areas'],
        11 => $rows['apellidoCasada'],
        12 => $rows['promo_cordero'],
        13 => '<h4 class="modal-title" id="myModalLabel" style="color: white">IDENTIDAD YA REGISTRADA EN '.$desPromocion.' </h4>',
        14 => $rows['idintegrante'],
        15 => $respuestaIntegrado,
        16 => $rows["documentosRespuesta"],
        17 => $rows["documentosPendientes"],
        18 => $validacionPromocion,
        19 => $rows["bautizado"],


        );
    echo json_encode($datos);


}else{

    $confirmar = mysqli_num_rows(mysqli_query($enlace,"SELECT * from corderitos where identidad = $identidad"));
    if($confirmar>0){
        $queryCorderitos = mysqli_query($enlace,"SELECT * from corderitos where identidad = $identidad");
        $datosCorderitos = mysqli_fetch_array($queryCorderitos,MYSQLI_ASSOC);
        $nombre = $datosCorderitos["nombre"];
        $promocion= $datosCorderitos["promocion"];
        $bautizado= $datosCorderitos["bautizado"];
        $datos = array(
            0 => $dato =2,
            1 => $dato =$nombre,
            2 => $dato =$promocion,
            3 => $dato =$bautizado,
        );
        echo json_encode($datos);
    }


}

?>