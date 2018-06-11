<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 12/2/2018
 * Time: 10:04 AM
 */


require_once 'EXCELfunciones.php';
include '../gold/enlace.php';
$fecha= $_GET['fecha'];
$dia = substr($fecha,8,2);
$mes = substr($fecha,5,2);
$aaa = substr($fecha,0,4);

switch ($mes){
    case 01:
        $miMes = "ENERO";
        break;

    case 02:
        $miMes = "FEBRERO";
        break;

    case 03:
        $miMes = "MARZO";
        break;

    case 04:
        $miMes = "ABRIL";
        break;

    case 05:
        $miMes = "MAYO";
        break;

    case 06:
        $miMes = "JUNIO";
        break;

    case 07:
        $miMes = "JULIO";
        break;

    case "08":
        $miMes = "AGOSTO";
        break;

    case "09":
        $miMes = "SEPTIEMBRE";
        break;

    case 10:
        $miMes = "OCTUBRE";
        break;

    case 11:
        $miMes = "NOVIEMBRE";
        break;

    case 12:
        $miMes = "DICIEMBRE";
        break;
}


$fCompleta = $dia."-".$miMes."-".$aaa;
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
    ->setCellValue('B1', 'REPORTE GENERAL DE '.$fCompleta.'')
    ->setCellValue('C1', '');




//DATOS

$equipoListadoQuery = mysqli_query($enlace,"SELECT integrantes.num_identidad,integrantes.nombre_integrante,integrantes.cel,integrantes.correlativo from marcacionprovicional 
INNER JOIN integrantes ON marcacionprovicional.idIntegrante = integrantes.idintegrante
where CAST(fechaMarcacion AS DATE)= '".$fecha."'  AND  integrantes.correlativo >18010000 ORDER BY integrantes.nombre_integrante");

//$datos = mysqli_fetch_array($equipoListadoQuery,MYSQLI_ASSOC);


$objPHPExcel->setActiveSheetIndex(0)

    ->setCellValue('A3', 'IDENTIDAD')
    ->setCellValue('B3', 'NOMBRE');



$contador=4;
while ($integrantesDatos = mysqli_fetch_array($equipoListadoQuery,MYSQLI_ASSOC)) {
    $objPHPExcel->getActiveSheet()->getCell("A$contador")->setValueExplicit($integrantesDatos["num_identidad"], PHPExcel_Cell_DataType::TYPE_STRING);



    $objPHPExcel->setActiveSheetIndex(0)

        ->setCellValue("B$contador",utf8_encode( $integrantesDatos["nombre_integrante"]));



    $contador++;
}

//FIN DATOS


$objPHPExcel->getActiveSheet()->setTitle('LISTADO DE EQUIPO ');
$objPHPExcel->setActiveSheetIndex(0);

getHeders();
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
?>