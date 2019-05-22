<?php
/**
 * Created by PhpStorm.
 * User: David Ortiza
 * Date: 12/4/2018
 * Time: 2:40 PM
 */


require_once 'EXCELfunciones.php';
include '../gold/enlace.php';
$idArea = $_GET['area'];


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


$queryArea = mysqli_query($enlace,"select Nombre from areas where idArea =$idArea");
$datosArea = mysqli_fetch_array($queryArea,MYSQLI_ASSOC);
$nombreArea =$datosArea["Nombre"];


$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A1', '')
    ->setCellValue('B1', 'LISTADO DE INTEGRACION EN '.$nombreArea.' ')
    ->setCellValue('C1', '');




//DATOS






$objPHPExcel->setActiveSheetIndex(0)

    ->setCellValue('A3', '#')
    ->setCellValue('B3', 'P')
    ->setCellValue('C3', 'NOMBRE')
    ->setCellValue('D3', 'IDENTIDAD')
    ->setCellValue('E3', 'EXPEDIENTE')
    ->setCellValue('F3', 'FECHA NACIMIENTO')
    ->setCellValue('G3', 'ESTDO CIVIL')
    ->setCellValue('H3', 'GENERO ')
    ->setCellValue('I3', 'CEL 1')
    ->setCellValue('J3', 'CEL 2')
    ->setCellValue('K3', 'CORDERITOS')
    ->setCellValue('L3', 'DIRECCION')
    ->setCellValue('M3', 'AREAS');

$query = mysqli_query($enlace,"SELECT integracion.integrador,integrantes.idintegrante,integrantes.nombre_integrante, integrantes.num_identidad,integrantes.fecha_cumple,integrantes.estado_civil,integrantes.sexo,
 integrantes.cel,integrantes.tel,integrantes.promo_cordero,integrantes.direccion,integrantes.areas,integrantes.correlativo from integracion 
INNER JOIN integrantes ON integracion.idIntegrante = integrantes.idintegrante
INNER JOIN areas on integracion.idArea = areas.idArea
INNER JOIN promociones ON integracion.idPromocion = promociones.idpromocion
INNER JOIN detalle_integrantes ON integrantes.idintegrante = detalle_integrantes.id_integrante
WHERE detalle_integrantes.`status`=1 AND  integracion.idArea=$idArea and promociones.`status` = 1 GROUP BY integrantes.nombre_integrante ASC");



$contador=4;
$contador2=1;
while ($datosFinal= mysqli_fetch_array($query,MYSQLI_ASSOC)){
    if($datosFinal["integrador"]==1){
        $inte = "P";
    }else{
        $inte="";
    }

    //INICIO FUNCION CONVERTIR FECHAS
    $fecha =$datosFinal["fecha_cumple"];

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
    //FIN FUNCION CONVERTIR FECHAS



    $objPHPExcel->getActiveSheet()->getCell("C$contador")->setValueExplicit($datosFinal["num_identidad"], PHPExcel_Cell_DataType::TYPE_STRING);

    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue("A$contador", $contador2)
        ->setCellValue("B$contador", $inte)
        ->setCellValue("D$contador", utf8_encode($datosFinal["nombre_integrante"]))
        ->setCellValue("E$contador",$datosFinal["correlativo"])
        ->setCellValue("F$contador",$fCompleta )
        ->setCellValue("G$contador",$datosFinal["estado_civil"] )
        ->setCellValue("H$contador",$datosFinal["sexo"] )
        ->setCellValue("I$contador",$datosFinal["cel"] )
        ->setCellValue("J$contador",$datosFinal["tel"] )
        ->setCellValue("K$contador",$datosFinal["promo_cordero"] )
        ->setCellValue("L$contador",$datosFinal["direccion"] )
        ->setCellValue("M$contador",$datosFinal["areas"] );
    $contador++;
    $contador2++;
}
$objPHPExcel->getActiveSheet()->setTitle('LISTADO DE INTEGRACION');
$objPHPExcel->setActiveSheetIndex(0);




$pestana = $objPHPExcel->createSheet(1); //CREAR PESTANAS;

$pestana->setCellValue('A3', 'No.')
    ->setCellValue('B3', 'NOMBRE')
    ->setCellValue('C3', 'IDENTIDAD')
    ->setCellValue('D3', 'TELEFONO 1')
    ->setCellValue('E3', 'TELEFONO 2')
    ->setCellValue('F3', 'SIRVE ACTUALMENTE');


$queryIntegradosManual = mysqli_query($enlace,"SELECT * FROM integracionindividual 
INNER JOIN promociones on integracionindividual.idPromocion = promociones.idpromocion
WHERE idArea = $idArea and promociones.`status` = 1");
$CM= 1;
$CMC = 4;
while($datosIntegradoManual = mysqli_fetch_array($queryIntegradosManual,MYSQLI_ASSOC)){


    $objPHPExcel->setActiveSheetIndex(1)
        ->setCellValue('A'.$CMC, $CM)
        ->setCellValue('B'.$CMC, utf8_encode($datosIntegradoManual["nombre"]))
        ->setCellValue('D'.$CMC, $datosIntegradoManual["telefono1"])
        ->setCellValue('E'.$CMC, $datosIntegradoManual["telefono2"])
        ->setCellValue('F'.$CMC, $datosIntegradoManual["sirve"]);
    $objPHPExcel->getActiveSheet(1)->getCell("C".$CMC)->setValueExplicit($datosIntegradoManual["identidad"], PHPExcel_Cell_DataType::TYPE_STRING);

    $CM++;
}

//FIN DATOS



$objPHPExcel->setActiveSheetIndex(1);
$objPHPExcel->getActiveSheet()->setTitle("INTEGRADOS MANUAL");


getHeders();
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
?>