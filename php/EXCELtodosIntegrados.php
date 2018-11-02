<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 8/2/2018
 * Time: 6:03 PM
 */

require_once 'EXCELfunciones.php';
include '../gold/enlace.php';



activeErrorReporting();

noCli();

require_once  '../phpExcel/Classes/PHPExcel.php';
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("DAVID ORTIZ")
    ->setLastModifiedBy("DAVID ORTIZ")
    ->setTitle("Office 2007 XLSX Test Document")
    ->setSubject("Office 2007 XLSX Test Document")
    ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
    ->setKeywords("office 2007 openxml php")
    ->setCategory("Test result file");

$contadorPestanas = 0;
$querySeleccionarTodasAreas = mysqli_query($enlace,"SELECT * from areas GROUP BY Nombre ASC");
while($areas = mysqli_fetch_array($querySeleccionarTodasAreas,MYSQLI_ASSOC)){
    $pestana = $objPHPExcel->createSheet($contadorPestanas); //CREAR PESTANAS;



    $pestana->setCellValue('A2', $areas["Nombre"])
        ->setCellValue('A3', 'No.')
        ->setCellValue('B3', 'IDENTIDAD')
        ->setCellValue('C3', 'NOMBRE')
        ->setCellValue('D3', 'CEL')
        ->setCellValue('E3', 'CORRELATIVO');
$idArea= $areas["idArea"];

    $queryEnlazadosPorArea = "SELECT * from integracion 
INNER JOIN integrantes on integrantes.idintegrante = integracion.idIntegrante
INNER JOIN promociones on integracion.idPromocion = promociones.idpromocion
INNER JOIN detalle_integrantes on integrantes.idintegrante= detalle_integrantes.id_integrante
WHERE idArea = $idArea and promociones.`status` = 1 and detalle_integrantes.`status` = 1";

    $confirmarEnlazados = mysqli_num_rows(mysqli_query($enlace,$queryEnlazadosPorArea));
    if($confirmarEnlazados>0){
        $ejecutarQuery = mysqli_query($enlace,$queryEnlazadosPorArea);
        $No = 1;
        $celdas = 4;
        while($datos= mysqli_fetch_array($ejecutarQuery,MYSQLI_ASSOC)){
            $pestana->setCellValue()->getCell("B$celdas")->setValueExplicit($datos["num_identidad"], PHPExcel_Cell_DataType::TYPE_STRING);

            $pestana->setCellValue('A'.$celdas, $No)
                ->setCellValue('C'.$celdas, $datos["nombre_integrante"])
                ->setCellValue('D'.$celdas, $datos["cel"])
                ->setCellValue('E'.$celdas, $datos["correlativo"]);
            $No++;
            $celdas++;
        }

    }else{
        $pestana->setCellValue('A4', " AUN NO HAY DATOS EN ESTA AREA");

    }

    $objPHPExcel->setActiveSheetIndex($contadorPestanas);
    $objPHPExcel->getActiveSheet()->setTitle($areas["Nombre"]);
    $contadorPestanas++;
}


$pestana = $objPHPExcel->createSheet($contadorPestanas); //CREAR PESTANAS;
$pestana->setCellValue('A3', 'No.')
    ->setCellValue('B3', 'AREA')
    ->setCellValue('C3', 'CANTIDAD');
$celdasAreas= 4;
$contadorAreas = 1;
$querySeleccionarTodasAreas = mysqli_query($enlace,"SELECT * from areas GROUP BY Nombre ASC");
while($areas = mysqli_fetch_array($querySeleccionarTodasAreas,MYSQLI_ASSOC)){
    $idArea = $areas["idArea"];

    $cantidadPorArea = mysqli_query($enlace,"SELECT COUNT(*) as cantidad,areas.Nombre from integracion
INNER JOIN  areas on integracion.idArea = areas.idArea
INNER JOIN promociones on integracion.idPromocion = promociones.idpromocion
INNER JOIN detalle_integrantes on integracion.idIntegrante = detalle_integrantes.id_integrante
WHERE integracion.idArea  = $idArea and promociones.`status` = 1 and detalle_integrantes.`status` = 1");
$datosAreas  =mysqli_fetch_array($cantidadPorArea,MYSQLI_ASSOC);
    $pestana->setCellValue('A'.$celdasAreas, $contadorAreas)
        ->setCellValue('B'.$celdasAreas, $datosAreas["Nombre"])
        ->setCellValue('C'.$celdasAreas, $datosAreas["cantidad"]);
$celdasAreas++;
$contadorAreas++;
    $objPHPExcel->setActiveSheetIndex($contadorPestanas);
    $objPHPExcel->getActiveSheet()->setTitle("REPORTE GENERAL");
}





$objPHPExcel->setActiveSheetIndex(0);

getHeders();
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
?>