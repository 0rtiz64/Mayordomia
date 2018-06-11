<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 21/2/2018
 * Time: 9:44 AM
 */



require_once 'EXCELfunciones.php';
include '../gold/enlace.php';

$equipo=$_GET["equipo"];
$fecha=$_GET["fecha"];
$contador =1;

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


$queryEquipo = mysqli_query($enlace,"SELECT * FROM equipos WHERE id_equipo=$equipo");
$datosEquipo = mysqli_fetch_array($queryEquipo,MYSQLI_ASSOC);


$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A1', '')
    ->setCellValue('B1', 'REPORTE DETALLADO DEL '.$fCompleta.'')
    ->setCellValue('C1', 'Equipo:'.$datosEquipo["num_equipo"].'-'.$datosEquipo["nombre_equipo"].'');




//DATOS

$equipoListadoQuery = mysqli_query($enlace,"SELECT integrantes.num_identidad,integrantes.correlativo,integrantes.nombre_integrante,equipos.num_equipo,equipos.nombre_equipo from marcacionprovicional
INNER JOIN detalle_integrantes ON marcacionprovicional.idIntegrante = detalle_integrantes.id_integrante
INNER JOIN integrantes ON marcacionprovicional.idIntegrante = integrantes.idintegrante
INNER JOIN equipos ON detalle_integrantes.id_equipo =  equipos.id_equipo
INNER JOIN promociones ON detalle_integrantes.id_promocion = promociones.idpromocion
where equipos.id_equipo = ".$equipo."
AND detalle_integrantes.id_cargo=10
AND CAST(marcacionprovicional.fechaMarcacion AS DATE)= '".$fecha."'
AND promociones.`status`=1 ORDER BY nombre_integrante ASC");

//$datos = mysqli_fetch_array($equipoListadoQuery,MYSQLI_ASSOC);


$objPHPExcel->setActiveSheetIndex(0)

    ->setCellValue('A3', 'CORRELATIVO')
    ->setCellValue('B3', 'NOMBRE')
    ->setCellValue('C3', 'IDENTIDAD');



$contador=4;
while ($integrantesDatos = mysqli_fetch_array($equipoListadoQuery,MYSQLI_ASSOC)) {
    $objPHPExcel->getActiveSheet()->getCell("C$contador")->setValueExplicit($integrantesDatos["num_identidad"], PHPExcel_Cell_DataType::TYPE_STRING);



    $objPHPExcel->setActiveSheetIndex(0)

        ->setCellValue("B$contador",utf8_encode( $integrantesDatos["nombre_integrante"]))
        ->setCellValue("A$contador",$integrantesDatos["correlativo"]);



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