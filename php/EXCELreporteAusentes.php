<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 2/3/2018
 * Time: 10:00 AM
 */






require_once 'EXCELfunciones.php';
include '../gold/enlace.php';
$fecha= $_GET['fecha'];
$contador3=1;
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
    ->setCellValue('B1', 'REPORTE AUSENTER DEL '.$fCompleta.'')
    ->setCellValue('C1', '');




//DATOS

$queryAusentes = mysqli_query($enlace,"SELECT DISTINCT nombre_integrante,correlativo, equipos.num_equipo,equipos.nombre_equipo FROM integrantes
INNER JOIN detalle_integrantes ON detalle_integrantes.id_integrante = integrantes.idintegrante
INNER JOIN equipos ON detalle_integrantes.id_equipo = equipos.id_equipo
  WHERE NOT EXISTS (select * from marcacionprovicional WHERE integrantes.idintegrante= marcacionprovicional.idIntegrante
AND CAST(marcacionprovicional.fechaMarcacion AS DATE) ='".$fecha."'
) AND integrantes.correlativo>18010000 AND detalle_integrantes.id_promocion=2 ORDER BY equipos.num_equipo ASC");

//$datos = mysqli_fetch_array($equipoListadoQuery,MYSQLI_ASSOC);


$objPHPExcel->setActiveSheetIndex(0)

    ->setCellValue('A3', '#')
    ->setCellValue('B3', 'CORRELATIVO')
    ->setCellValue('C3', 'NOMBRE')
    ->setCellValue('D3', 'EQUIPO');



$contador=4;
while($result = mysqli_fetch_array($queryAusentes,MYSQLI_ASSOC)){
    //$objPHPExcel->getActiveSheet()->getCell("A$contador")->setValueExplicit($integrantesDatos["num_identidad"], PHPExcel_Cell_DataType::TYPE_STRING);



    $objPHPExcel->setActiveSheetIndex(0)

        ->setCellValue("A$contador",$contador3)
        ->setCellValue("B$contador", $result["correlativo"])
        ->setCellValue("C$contador",$result["nombre_integrante"])
        ->setCellValue("D$contador",$result["num_equipo"] .'-'. $result["nombre_equipo"]);



    $contador++;
    $contador3++;
}

//FIN DATOS


$objPHPExcel->getActiveSheet()->setTitle('LISTADO DE AUSENTES ');
$objPHPExcel->setActiveSheetIndex(0);

getHeders();
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
?>