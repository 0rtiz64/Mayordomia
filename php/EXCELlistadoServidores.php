<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 30/4/2018
 * Time: 2:05 PM
 */


require_once 'EXCELfunciones.php';
include '../gold/enlace.php';
$idEquipo = $_GET['equipo'];


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


$queryNombreArea = mysqli_query($enlace,"SELECT * from servicioequipos WHERE idEquipo= $idEquipo");
$datosNombreArea = mysqli_fetch_array($queryNombreArea,MYSQLI_ASSOC);
$nombreArea = $datosNombreArea["nombreEquipo"];


$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A1', '')
    ->setCellValue('B1', 'LISTADO DE SERVIDORES DEL '.$nombreArea.' ')
    ->setCellValue('C1', '');




//DATOS






$objPHPExcel->setActiveSheetIndex(0)

    ->setCellValue('A3', '#')
    ->setCellValue('B3', 'NOMBRE')
    ->setCellValue('C3', 'IDENTIDAD')
    ->setCellValue('D3', 'EXPEDIENTE')
    ->setCellValue('E3', 'FECHA NACIMIENTNO')
    ->setCellValue('F3', 'ESTADO CIVIL')
    ->setCellValue('G3', 'GENERO')
    ->setCellValue('H3', 'CEL 1')
    ->setCellValue('I3', 'CEL 2')
    ->setCellValue('J3', 'CORDERITOS')
    ->setCellValue('K3', 'DIRECCION')
    ->setCellValue('L3', 'AREAS')
    ->setCellValue('M3', 'EQUIPO')
    ->setCellValue('N3', 'CARGO');

$query = mysqli_query($enlace,"SELECT * from servidores
INNER JOIN serviciodetalle ON servidores.idServidor = serviciodetalle.idServidor
INNER JOIN servicioequipos On serviciodetalle.idServicioEquipo = servicioequipos.idEquipo
INNER JOIN serviciocargos ON serviciodetalle.idServicioCargo = serviciocargos.idCargo
WHERE serviciodetalle.idServicioEquipo = $idEquipo GROUP BY servidores.nombre_integrante ASC");



$contador=4;
$contador2=1;
while ($datosFinal= mysqli_fetch_array($query,MYSQLI_ASSOC)){


    $objPHPExcel->getActiveSheet()->getCell("C$contador")->setValueExplicit($datosFinal["num_identidad"], PHPExcel_Cell_DataType::TYPE_STRING);

    //FECHA INICIO
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
    //FECHA FINAL


    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue("A$contador", $contador2)
        ->setCellValue("B$contador", utf8_encode($datosFinal["nombre_integrante"]))
        ->setCellValue("D$contador", $datosFinal["correlativo"])
        ->setCellValue("E$contador",$fCompleta)
        ->setCellValue("F$contador",$datosFinal["estado_civil"] )
        ->setCellValue("G$contador",$datosFinal["sexo"] )
        ->setCellValue("H$contador",$datosFinal["cel"] )
        ->setCellValue("I$contador",$datosFinal["tel"] )
        ->setCellValue("J$contador",$datosFinal["promo_cordero"] )
        ->setCellValue("K$contador",$datosFinal["direccion"] )
        ->setCellValue("L$contador",$datosFinal["areas"] )
        ->setCellValue("M$contador",$datosFinal["nombreEquipo"] )
        ->setCellValue("N$contador",$datosFinal["nombreCargo"] );
    $contador++;
    $contador2++;
}








//FIN DATOS


$objPHPExcel->getActiveSheet()->setTitle('LISTADO DE INTEGRACION');
$objPHPExcel->setActiveSheetIndex(0);

getHeders();
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
?>