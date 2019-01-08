<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 12/2/2018
 * Time: 10:04 AM
 */


require_once 'EXCELfunciones.php';
include '../gold/enlace.php';
$equipo= $_GET['equipo'];

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
    ->setCellValue('B1', 'REPORTE ENLAZADOS GENERAL')
    ->setCellValue('C1', '');




//DATOS
$queryTodos = mysqli_query($enlace,"SELECT * from equipos
INNER JOIN promociones on equipos.id_promocion = promociones.idpromocion
where promociones.`status`=1 AND equipos.num_equipo>0 GROUP BY nombre_equipo ASC");

//$datos = mysqli_fetch_array($equipoListadoQuery,MYSQLI_ASSOC);


$objPHPExcel->setActiveSheetIndex(0)

    ->setCellValue('A3', 'EQUIPO')
    ->setCellValue('B3', 'OVEJAS INTEGRADAS');



$contador=4;
while ($integrantesDatos = mysqli_fetch_array($queryTodos,MYSQLI_ASSOC)) {
    $idEquipo  =$integrantesDatos["id_equipo"];

    $queryCantidadTodos= mysqli_query($enlace,"SELECT COUNT(*) as cantidadTodos FROM detalle_integrantes
INNER JOIN promociones on detalle_integrantes.id_promocion = promociones.idpromocion
WHERE promociones.`status` = 1 and detalle_integrantes.id_equipo = '".$idEquipo."' and detalle_integrantes.id_cargo = 10");
    $datosCantidadTodos = mysqli_fetch_array($queryCantidadTodos,MYSQLI_ASSOC);

    $objPHPExcel->setActiveSheetIndex(0)

        ->setCellValue("A$contador", $integrantesDatos["nombre_equipo"])
        ->setCellValue("B$contador", $datosCantidadTodos["cantidadTodos"]);



    $contador++;
}
$cantidadTodalTodos= mysqli_query($enlace,"SELECT COUNT(*) AS cantidadTotalTodos FROM detalle_integrantes
INNER JOIN promociones on detalle_integrantes.id_promocion = promociones.idpromocion
WHERE promociones.`status` = 1 and detalle_integrantes.`status` = 1  and detalle_integrantes.id_cargo = 10");
$datosCantidadTotalTodos = mysqli_fetch_array($cantidadTodalTodos,MYSQLI_ASSOC);
$cantidadTotalTodos = $datosCantidadTotalTodos["cantidadTotalTodos"];
  $objPHPExcel->setActiveSheetIndex(0)
->setCellValue("A$contador", "GRAN TOTAL")
->setCellValue("B$contador", $datosCantidadTotalTodos["cantidadTotalTodos"]);

//FIN DATOS


$objPHPExcel->getActiveSheet()->setTitle('LISTADO DE ENLAZADOS ');
$objPHPExcel->setActiveSheetIndex(0);

getHeders();
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
?>