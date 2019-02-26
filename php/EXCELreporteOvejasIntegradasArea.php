<?php
/**
 * Created by David Ortiz.
 * User: David Ortiz
 * Date: 8/11/2017
 * Time: 10:32
 */
require_once 'EXCELfunciones.php';
include '../gold/enlace.php';
$area = $_GET['area'];
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


$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A1', '')
    ->setCellValue('B1', 'REPORTE POR AREA')
    ->setCellValue('C1', '');

//DATOS

$queryIntegrantes = mysqli_query($enlace,"SELECT COUNT(ovejas.nombre) AS cantidad from ovejas
WHERE area1='$area' OR area2='$area' OR area3='$area' OR area4='$area' OR area5='$area'");
$contador = 1;
$datos = mysqli_fetch_array($queryIntegrantes,MYSQLI_ASSOC);
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A2', '')
    ->setCellValue('B2', $area)
    ->setCellValue('C2', 'CANTIDAD:')
    ->setCellValue('D2', $datos["cantidad"]);

$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A3', 'IDENTIDAD')
    ->setCellValue('B3', 'NOMBRE')
    ->setCellValue('C3', 'CEL')
    ->setCellValue('D3', 'TEL')
    ->setCellValue('E3', 'FIJO');


$Integrantes = mysqli_query($enlace,"SELECT ovejas.idOveja,ovejas.identidad, ovejas.nombre, ovejas.cel,ovejas.tel,ovejas.fijo FROM ovejas
WHERE ovejas.area1 = '$area' OR ovejas.area2 = '$area' OR ovejas.area3='$area' OR
ovejas.area4 ='$area' OR ovejas.area5='$area'");
$contador=4;
while ($integrantesDatos = mysqli_fetch_array($Integrantes,MYSQLI_ASSOC)) {
    $objPHPExcel->getActiveSheet()->getCell("A$contador")->setValueExplicit($integrantesDatos["identidad"], PHPExcel_Cell_DataType::TYPE_STRING);

    $objPHPExcel->setActiveSheetIndex(0)
        //->setCellValue("A$contador", $integrantesDatos["identidad"])
        ->setCellValue("B$contador", utf8_encode($integrantesDatos["nombre"]))
        ->setCellValue("C$contador", $integrantesDatos["cel"])
        ->setCellValue("D$contador", $integrantesDatos["tel"])
        ->setCellValue("E$contador", $integrantesDatos["fijo"]);
$contador++;
}

//FIN DATOS


$objPHPExcel->getActiveSheet()->setTitle('DATOS DE OVEJAS INTEGRADAS');
$objPHPExcel->setActiveSheetIndex(0);

getHeders();
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
?>