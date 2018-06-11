<?php
/**
 * Created by PhpStorm.
 * User: Megacenter
 * Date: 27/11/2017
 * Time: 11:14
 */

include '../gold/enlace.php';
$idIntegrante=$_POST["phpIdIntegrante"];
$idEquipo=$_POST["phpEquipo"];
$idCargo=$_POST["phpCargo"];
$fechaentrada = date('Y-m-d  h:i:s');

$consultarPromocionActiva = mysqli_query($enlace, "SELECT idpromocion,num_promocion,desc_promocion FROM promociones 
where `status`=1");
$datosPromocionActiva = mysqli_fetch_array($consultarPromocionActiva,MYSQLI_ASSOC);
$promocionActiva = $datosPromocionActiva["idpromocion"];

$verificar = mysqli_num_rows(mysqli_query($enlace,"SELECT idetalle_integrantes,id_integrante,id_promocion from detalle_integrantes
where id_integrante =$idIntegrante and id_promocion=$promocionActiva")) ;

if ($verificar >0){
    echo "<div class='alert alert-danger' > <strong>OVEJA YA INTEGRADA</strong>  </div>";
}else{

    $query = mysqli_query($enlace,"insert into detalle_integrantes (id_integrante,id_promocion,id_equipo,id_cargo,status,fecha_registro) 
values (".$idIntegrante.",".$promocionActiva.",".$idEquipo.",".$idCargo.",1,'".$fechaentrada."')");

    if (mysqli_affected_rows($enlace)>0) {

        $query = mysqli_query($enlace,"Select integrantes.idintegrante, integrantes.num_identidad,integrantes.nombre_integrante 
from integrantes where Not idintegrante 
In (Select detalle_integrantes.id_integrante From detalle_integrantes) ");

        $rows = mysqli_fetch_array($query,MYSQLI_ASSOC);

        echo'<table class="table table-bordered table-striped" id="listaTabla">';
        echo '<thead>';
        echo '<tr>';
        echo '<th>#</th>';
        echo '<th>IDENTIDAD</th>';
        echo '<th>NOMBRE</th>';
        echo '<th>SELECCIONAR</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
        $contador2=1;
        while (  $resultadoIntegrantesSinEnlazar = mysqli_fetch_array($query, MYSQLI_ASSOC))
        {


            echo '<tr>';
            echo '<td>'.$contador2.'</td>';
            echo '<td>'.$resultadoIntegrantesSinEnlazar["num_identidad"].'</td>';
            echo '<td>'.$resultadoIntegrantesSinEnlazar["nombre_integrante"].'</td>';
            echo '<td align="center"><a href="javascript:enlazarIntegrante('.$resultadoIntegrantesSinEnlazar["idintegrante"].')" class="btn btn-info btn-sm">ENLAZAR</a></td>';
            //  echo '<td><input type="checkbox" value="'.$resultadoIntegrantesSinEnlazar["idintegrante"].'"></td>';
            echo '</tr>';


            $contador2 ++;
        }
        echo '</tbody>';
        echo '</table>';

    }

    else{
        echo mysqli_error($enlace);
    }
    mysqli_close($enlace);

}

?>