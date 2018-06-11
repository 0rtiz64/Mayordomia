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



$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A1', '')
    ->setCellValue('B1', 'LISTADO DE ASISTENCIAS GENERAL')
    ->setCellValue('C1', '');




//DATOS






$objPHPExcel->setActiveSheetIndex(0)

    ->setCellValue('A3', '#')
    ->setCellValue('B3', 'NOMBRE')
    ->setCellValue('C3', 'CORRELATIVO')
    ->setCellValue('D3', 'EQUIPO')
    ->setCellValue('E3', 'CARGO')
    ->setCellValue('F3', 'FECHA 1')
    ->setCellValue('G3', 'FECHA 2')
    ->setCellValue('H3', 'FECHA 3')
    ->setCellValue('I3', 'FECHA 4')
    ->setCellValue('J3', 'FECHA 5')
    ->setCellValue('K3', 'FECHA 6')
    ->setCellValue('L3', 'FECHA 7')
    ->setCellValue('M3', 'FECHA 8')
    ->setCellValue('N3', 'FECHA 9')
    ->setCellValue('O3', 'FECHA 10')
    ->setCellValue('P3', 'FECHA 11')
    ->setCellValue('Q3', 'FECHA 12');

$qTomarId = mysqli_query($enlace,"select * from marcacionprovicional
 GROUP BY idIntegrante");



$contador=4;
$contador2=1;
while ($dTomarId= mysqli_fetch_array($qTomarId,MYSQLI_ASSOC)){
    $idIntegrante = $dTomarId["idIntegrante"];
    $qConsultarNombre =mysqli_query($enlace,"select nombre_integrante,correlativo,equipos.num_equipo,equipos.nombre_equipo,cargos.nombre_cargo from integrantes
INNER JOIN detalle_integrantes On detalle_integrantes.id_integrante = integrantes.idintegrante
INNER JOIN equipos ON detalle_integrantes.id_equipo=equipos.id_equipo
INNER JOIN cargos ON detalle_integrantes.id_cargo = cargos.idcargo
WHERE idintegrante= $idIntegrante ");

    $queryGetNombre= mysqli_query($enlace,"SELECT nombre_integrante from integrantes
WHERE idintegrante = $idIntegrante ");
    $datosGetNombre= mysqli_fetch_array($queryGetNombre,MYSQLI_ASSOC);

    $dConsultarNombre = mysqli_fetch_array($qConsultarNombre,MYSQLI_ASSOC);
    $nombreIntegrante= $datosGetNombre["nombre_integrante"];
    $correlativoIntegrante= $dConsultarNombre["correlativo"];
    $numEquipo= $dConsultarNombre["num_equipo"];
    $nombreEquipo= $dConsultarNombre["nombre_equipo"];
    $cargo= $dConsultarNombre["nombre_cargo"];


   // $objPHPExcel->getActiveSheet()->getCell("C$contador")->setValueExplicit($correlativoIntegrante, PHPExcel_Cell_DataType::TYPE_STRING);

    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue("A$contador", $contador2)
        ->setCellValue("C$contador", $correlativoIntegrante)
        ->setCellValue("B$contador", $nombreIntegrante)
        ->setCellValue("D$contador",$numEquipo.'-'.$nombreEquipo )
        ->setCellValue("E$contador",$cargo );
    $qContarAsistencias = mysqli_query($enlace,"SELECT  CAST(fechaMarcacion AS date)  AS qFecha  from marcacionprovicional
WHERE idIntegrante=$idIntegrante GROUP BY qFecha ASC");
    $celda = 5;
    while ($dContarAsistencias = mysqli_fetch_array($qContarAsistencias,MYSQLI_ASSOC)){
        $fecha = $dContarAsistencias["qFecha"];

        //INICIO FUNCION CONVERTIR FECHAS
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
        $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValueByColumnAndRow($celda,$contador,$fCompleta);
        $celda++;
    }
    $contador++;
    $contador2++;

}








//FIN DATOS


$objPHPExcel->getActiveSheet()->setTitle('LISTADO DE EQUIPO');
$objPHPExcel->setActiveSheetIndex(0);

getHeders();
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
?>