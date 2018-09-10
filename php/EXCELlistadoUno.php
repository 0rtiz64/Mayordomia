<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 8/2/2018
 * Time: 6:03 PM
 */

require_once 'EXCELfunciones.php';
include '../gold/enlace.php';

$idEquipo= $_GET['idEquipo'];
$PastA = $_GET['PastA'];

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


$queryNombreEquipo = mysqli_query($enlace,"SELECT num_equipo,nombre_equipo from equipos WHERE id_equipo = $idEquipo");
$datosNombreEquipo = mysqli_fetch_array($queryNombreEquipo,MYSQLI_ASSOC);
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A1', '')
    ->setCellValue('B1', 'LISTADO DE EQUIPO '.$datosNombreEquipo["num_equipo"].'-'.$datosNombreEquipo["nombre_equipo"].' ')
    ->setCellValue('C1', '');


$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A2', '')
    ->setCellValue('B2', $PastA)
    ->setCellValue('C2', '');


//DATOS

$equipoListadoQuery = mysqli_query($enlace,"SELECT  detalle_integrantes.idetalle_integrantes,integrantes.num_identidad,integrantes.nombre_integrante,
equipos.num_equipo,equipos.nombre_equipo,integrantes.cel,integrantes.correlativo,integrantes.promo_cordero,integrantes.fecha_cumple,integrantes.cel,
 integrantes.estado_civil,integrantes.sexo,integrantes.trasporte,integrantes.direccion,integrantes.areas,integrantes.apellidoCasada from detalle_integrantes
INNER JOIN integrantes ON detalle_integrantes.id_integrante = integrantes.idintegrante
INNER JOIN equipos ON detalle_integrantes.id_equipo = equipos.id_equipo
INNER JOIN cargos ON detalle_integrantes.id_cargo = cargos.idcargo
WHERE detalle_integrantes.`status`=1  AND detalle_integrantes.id_equipo= $idEquipo AND cargos.idcargo =10");




$objPHPExcel->setActiveSheetIndex(0)

    ->setCellValue('A3', 'CORRELATIVO')
    ->setCellValue('B3', 'NOMBRE')
    ->setCellValue('C3', 'IDENTIDAD')
    ->setCellValue('D3', 'TELEFONO')
    ->setCellValue('E3', 'PROMOCION CORDERITOS')
    ->setCellValue('F3', 'CUMPLEAÑOS')
    ->setCellValue('G3', 'ESTADO CIVIL')
    ->setCellValue('H3', 'GENERO')
    ->setCellValue('I3', 'NECESITA TRANSPORTE')
    ->setCellValue('J3', 'DIRECCION')
    ->setCellValue('K3', 'APELLIDO CASADA');



$contador=4;
while ($integrantesDatos = mysqli_fetch_array($equipoListadoQuery,MYSQLI_ASSOC)) {
    $objPHPExcel->getActiveSheet()->getCell("C$contador")->setValueExplicit($integrantesDatos["num_identidad"], PHPExcel_Cell_DataType::TYPE_STRING);

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
        //->setCellValue("A$contador", $integrantesDatos["num_identidad"])
        ->setCellValue("A$contador", $integrantesDatos["correlativo"])
        ->setCellValue("B$contador", $integrantesDatos["nombre_integrante"])
        ->setCellValue("D$contador", $integrantesDatos["correlativo"] )
        ->setCellValue("E$contador", $integrantesDatos["promo_cordero"] )
        ->setCellValue("F$contador",$fCompleta)
        ->setCellValue("G$contador", $integrantesDatos["estado_civil"] )
        ->setCellValue("H$contador", $integrantesDatos["sexo"] )
        ->setCellValue("I$contador", $integrantesDatos["trasporte"] )
        ->setCellValue("J$contador", $integrantesDatos["direccion"] )
        ->setCellValue("K$contador", $integrantesDatos["apellidoCasada"] );


    $contador++;
}

//FIN DATOS


$objPHPExcel->getActiveSheet()->setTitle('LISTADO DE EQUIPO');
$objPHPExcel->setActiveSheetIndex(0);

getHeders();
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
?>