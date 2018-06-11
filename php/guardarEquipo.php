<?php
include '../gold/enlace.php';

$idPromocion=$_POST["phpidPromocion"];
$numero=$_POST["phpnumeroEquipo"];
$nombre=$_POST["phpnombreEquipo"];
$past1=$_POST["phpPast1"];
$past2=$_POST["phpPast2"];
$fechaentrada = date('Y-m-d  h:i:s');





$query_ver = mysqli_num_rows(mysqli_query($enlace,"SELECT equipos.num_equipo,equipos.nombre_equipo FROM equipos
INNER JOIN promociones ON equipos.id_promocion = promociones.idpromocion
where promociones.`status`=1 AND equipos.num_equipo = $numero "));

if( $query_ver> 0){
    echo "<div class='alert alert-danger' > <strong>NUMERO DE EQUIPO YA EXISTE</strong>  </div>";
}else{
    $verificaPastoreador1= mysqli_num_rows( mysqli_query($enlace,"SELECT idetalle_integrantes,id_integrante from detalle_integrantes
WHERE id_integrante= $past1 and id_promocion = $idPromocion "));

    if($verificaPastoreador1>0){
        echo "<div class='alert alert-danger' > <strong>PASATOREADOR 1 YA ENLAZADO</strong>  </div>";
    }else{
        if($past2== ""){
            $query = mysqli_query($enlace,"insert into equipos (id_promocion,num_equipo,nombre_equipo,status,fecha_registro) values 
	(".$idPromocion.",".$numero.",'".$nombre."',1,'".$fechaentrada."')");

            $prueba =mysqli_query($enlace,"SELECT id_equipo from equipos
where num_equipo=$numero and id_promocion =$idPromocion");
            $idEquipo= mysqli_fetch_array($prueba);
            $insertPast = mysqli_query($enlace,"insert into detalle_integrantes (id_integrante,id_promocion,id_equipo,id_cargo,status) values 
	(".$past1.",".$idPromocion.",".$idEquipo["id_equipo"].",9,1)");
            echo "<div class='alert alert-success' > <strong>EQUIPO GUARDADO</strong>  </div>";
        }else{

            $verificaPastoreador2= mysqli_num_rows( mysqli_query($enlace,"SELECT idetalle_integrantes,id_integrante from detalle_integrantes
WHERE id_integrante= $past2 and id_promocion = $idPromocion "));
            if($verificaPastoreador2>0){
                echo "<div class='alert alert-danger' > <strong>PASATOREADOR 2 YA ENLAZADO</strong>  </div>";
            }else{

                $query = mysqli_query($enlace,"insert into equipos (id_promocion,num_equipo,nombre_equipo,status,fecha_registro) values 
	(".$idPromocion.",".$numero.",'".$nombre."',1,'".$fechaentrada."')");
                $prueba =mysqli_query($enlace,"SELECT id_equipo from equipos
where num_equipo=$numero and id_promocion =$idPromocion");
                $idEquipo= mysqli_fetch_array($prueba);
                $insertPast = mysqli_query($enlace,"insert into detalle_integrantes (id_integrante,id_promocion,id_equipo,id_cargo,status) values 
	(".$past1.",".$idPromocion.",".$idEquipo["id_equipo"].",9,1)");
                $insertPast2 = mysqli_query($enlace,"insert into detalle_integrantes (id_integrante,id_promocion,id_equipo,id_cargo,status) values 
	(".$past2.",".$idPromocion.",".$idEquipo["id_equipo"].",9,1)");
                echo "<div class='alert alert-success' > <strong>EQUIPO GUARDADO</strong>  </div>";

            }//FIN VERIFICA SI PASTOREADOR 2 ESTA ENLAZADO

        }//FIN VERIFICA SI PASTOREADOR 2 ESTA LLENO

    }//FIN VERIFICA SI PASTOREADOR 1 YA ESTA ENLAZADO
} // FIN VERIFICA SI NUMERO YA EXISTE






?>