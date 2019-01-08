<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 10/7/2018
 * Time: 3:42 PM
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


$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A1', '')
    ->setCellValue('B1', 'LISTADO SERVIDORES')
    ->setCellValue('C1', '');

//DATOS




$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A3', 'IDENTIDAD')
    ->setCellValue('B3', 'NOMBRE')
    ->setCellValue('C3', 'CEL')
    ->setCellValue('D3', 'TEL')
    ->setCellValue('E3', 'FECHA NACIMIENTO')
    ->setCellValue('F3', 'ESTADO CIVIL')
    ->setCellValue('G3', 'GENERO')
    ->setCellValue('H3', 'DIRECCION')
    ->setCellValue('I3', 'AREAS')
    ->setCellValue('J3', 'APELLIDO CASADA')
    ->setCellValue('K3', 'EXPEDIENTE')
    ->setCellValue('L3', 'EQUIPO')
    ->setCellValue('M3', 'CARGO');


$Integrantes = mysqli_query($enlace,"select*from servidores 
INNER JOIN serviciodetalle ON servidores.idServidor =serviciodetalle.idServidor
INNER JOIN servicioequipos ON serviciodetalle.idServicioEquipo = servicioequipos.idEquipo
INNER JOIN serviciocargos ON serviciodetalle.idServicioCargo = serviciocargos.idCargo");
$contador=4;
while ($integrantesDatos = mysqli_fetch_array($Integrantes,MYSQLI_ASSOC)) {
    $objPHPExcel->getActiveSheet()->getCell("A$contador")->setValueExplicit($integrantesDatos["num_identidad"], PHPExcel_Cell_DataType::TYPE_STRING);

    //FECHA INICIO
    $fecha =  $integrantesDatos["fecha_cumple"];

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
    //FECHA FINAL



    $objPHPExcel->setActiveSheetIndex(0)
        //->setCellValue("A$contador", $integrantesDatos["identidad"])
        ->setCellValue("B$contador", $integrantesDatos["nombre_integrante"])
        ->setCellValue("C$contador", $integrantesDatos["cel"])
        ->setCellValue("D$contador", $integrantesDatos["tel"])
        ->setCellValue("E$contador",$fCompleta)
        ->setCellValue("F$contador", $integrantesDatos["estado_civil"])
        ->setCellValue("G$contador", $integrantesDatos["sexo"])
        ->setCellValue("H$contador", $integrantesDatos["direccion"])
        ->setCellValue("I$contador", $integrantesDatos["areas"])
        ->setCellValue("J$contador", $integrantesDatos["apellidoCasada"])
        ->setCellValue("K$contador", $integrantesDatos["correlativo"])
        ->setCellValue("L$contador", $integrantesDatos["nombreEquipo"])
        ->setCellValue("M$contador", $integrantesDatos["nombreCargo"]);
    $contador++;
}


$querySinEquipo = mysqli_query($enlace,"select*from servidores 
INNER JOIN serviciodetalle ON servidores.idServidor =serviciodetalle.idServidor
INNER JOIN serviciocargos ON serviciodetalle.idServicioCargo = serviciocargos.idCargo
WHERE serviciodetalle.idServicioCargo = 1 OR  serviciodetalle.idServicioCargo = 3");
while ($integrantesDatos2 = mysqli_fetch_array($querySinEquipo,MYSQLI_ASSOC)) {
    $objPHPExcel->getActiveSheet()->getCell("A$contador")->setValueExplicit($integrantesDatos2["num_identidad"], PHPExcel_Cell_DataType::TYPE_STRING);

    //FECHA INICIO
    $fecha = $integrantesDatos2["fecha_cumple"];

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
    //FECHA FINAL


    $objPHPExcel->setActiveSheetIndex(0)
        //->setCellValue("A$contador", $integrantesDatos["identidad"])
        ->setCellValue("B$contador", $integrantesDatos2["nombre_integrante"])
        ->setCellValue("C$contador", $integrantesDatos2["cel"])
        ->setCellValue("D$contador", $integrantesDatos2["tel"])
        ->setCellValue("E$contador", $fCompleta)
        ->setCellValue("F$contador", $integrantesDatos2["estado_civil"])
        ->setCellValue("G$contador", $integrantesDatos2["sexo"])
        ->setCellValue("H$contador", $integrantesDatos2["direccion"])
        ->setCellValue("I$contador", $integrantesDatos2["areas"])
        ->setCellValue("J$contador", $integrantesDatos2["apellidoCasada"])
        ->setCellValue("K$contador", $integrantesDatos2["correlativo"])
        ->setCellValue("M$contador", $integrantesDatos2["nombreCargo"]);
    $contador++;
}

//FIN DATOS


$objPHPExcel->getActiveSheet()->setTitle('LISTADO GENERAL DE SERVIDORES');
$objPHPExcel->setActiveSheetIndex(0);

getHeders();
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
?>