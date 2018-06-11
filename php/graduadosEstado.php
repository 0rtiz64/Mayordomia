<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 19/1/2018
 * Time: 11:37 AM
 */
include ('../gold/enlace.php');
/*
if ($_FILES['csvFile']['size'] > 0) {

    $csv = $_FILES['csv']['tmp_name'];

    $handle = fopen($csv,'r');

    while ($data = fgetcsv($handle,1000,",","'")){

        if ($data[0]) {

            $identidad = $data[0];

            $queryIdIntegrante = mysqli_query($enlace,"SELECT detalle_integrantes.idetalle_integrantes from integrantes 
INNER JOIN detalle_integrantes ON integrantes.idintegrante = detalle_integrantes.id_integrante
WHERE integrantes.num_identidad = '".$identidad."'");
            $datoIdIntegrante = mysqli_fetch_array($queryIdIntegrante,MYSQLI_ASSOC);
            $idDetalleIntegrante = $datoIdIntegrante["idetalle_integrantes"];

            $queryActualizarEstado = mysqli_query($enlace,"UPDATE detalle_integrantes set `status`=4 WHERE idetalle_integrantes='.$idDetalleIntegrante.' ");
            if ($queryActualizarEstado) {
                # code...

                //segundo query
                echo '<div class="alert alert-success" style="text-align: center;"> 
				<strong> INTEGRANTES GRADUADOS EXITOSAMENTE</strong>
	 			</div>';

            }else{
                echo '<div class="alert alert-warning" style="text-align: center;"> 
				<strong> ERROR AL GRADUAR</strong>
	 			</div>';
            }

        }

    }



}
*/

include ('../phpExcel/Classes/PHPExcel/IOFactory.php');
$html = '<div class="table-responsive">';
    $html= '<table class="table table-bordered table-striped">';
        $html='<thead>';
            $html='<tr>';
                $html='<th>#</th>';
                $html='<th>Identidad</th>';
                $html='<th>Nombre</th>';
                $html='<th> Equipo</th>';
            $html='</tr>';
        $html='</thead>';
        $html='<tbody>';

        $objExcel =PHPExcel_IOFactory::load('ejemplo.xls');
        foreach ($objExcel->getWorksheetIterator() as $worksheet){

        }
?>