<?php
include '../gold/enlace.php';

$identidad=$_POST["phpCedula"];



$query_buscar = mysqli_num_rows(mysqli_query($enlace,"SELECT num_identidad FROM integrantes WHERE num_identidad ='".$identidad."'"));

if($query_buscar==0){
    echo "<div class='alert alert-danger' style='text-align: center;'> <strong>INTEGRANTE CON IDENTIDAD ".$identidad." NO SE ENCUENTRA REGISTRADO!!</strong>  </div>";
}else{


    $queryIntegrante = mysqli_query($enlace,"SELECT integrantes.idintegrante,integrantes.num_identidad,integrantes.nombre_integrante,integrantes.cel,integrantes.tel
 FROM integrantes
WHERE integrantes.num_identidad =$identidad ");
    echo '<div class="table-responsive">';

    echo '<table class="table table-hover" id="example">';

    echo "<thead>";
    echo "<tr >";
    echo "<th>#</th>";
    echo "<th>IDENTIDAD</th>";
    echo "<th>NOMBRE COMPLETO</th>";
    echo "<th>CELULAR</th>";
    echo "<th>TELEFONO</th>";
    echo "<th>OPCION</th>";


    echo "</tr>";
    echo "</thead>";

    echo "<tbody>";
    $contador = 1;
    $datos = mysqli_fetch_array($queryIntegrante,MYSQLI_ASSOC);
        echo "<tr >";
        echo "<td>".$contador."</td>";
        echo "<td>".$datos["num_identidad"]."</td>";
        echo "<td>".utf8_encode($datos["nombre_integrante"])."</td>";
        echo "<td>".$datos["cel"]."</td>";
        echo "<td>".$datos["tel"]."</td>";
        echo '<td>
                    <p class="btn btn-primary" title="INTEGRAR" >
                        <a style="color: white" href="javascript:editarIntegrante('.$datos['idintegrante'].');" class="fa fa-plus-circle" ></a>
                    </p>
                    <p class="btn " style="background-color: #F0AD4E">
                        <a style="color: white" href="javascript:miEditarOvejas('.$datos['idintegrante'].');" class="fa fa-cog" title="MODIFICAR"></a>
                    </p>
                </td>';

        echo "</tr>";
        $contador ++;

    echo "</tbody>";
    echo '</table>';
    echo '</div>';

}
?>


