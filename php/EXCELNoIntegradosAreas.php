<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 14/11/2018
 * Time: 4:34 PM
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



// PESTAÑA UNO
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A1', '')
    ->setCellValue('B1', 'REPORTE OVEJAS NO INTEGRADAS EN AREAS')
    ->setCellValue('C1', '');

$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A2', 'No.')
    ->setCellValue('B2', 'CORRELATIVO')
    ->setCellValue('C2', 'OVEJA')
    ->setCellValue('D2', 'TELEFONO')
    ->setCellValue('E2', 'EQUIPO');



$queryNoIntegrados = mysqli_query($enlace,"SELECT integrantes.correlativo,integrantes.nombre_integrante,integrantes.cel,equipos.num_equipo,equipos.nombre_equipo
  FROM detalle_integrantes
INNER JOIN integrantes on detalle_integrantes.id_integrante = integrantes.idintegrante
INNER JOIN promociones on detalle_integrantes.id_promocion = promociones.idpromocion
INNER JOIN equipos on detalle_integrantes.id_equipo = equipos.id_equipo
 WHERE NOT EXISTS (SELECT NULL
                     FROM integracion
                    WHERE detalle_integrantes.id_integrante = integracion.idIntegrante)
AND promociones.`status` = 1 AND detalle_integrantes.id_cargo = 10 and detalle_integrantes.`status` =1 ORDER BY equipos.num_equipo");
$c =1;
$celdas= 3;
while ($datos = mysqli_fetch_array($queryNoIntegrados,MYSQLI_ASSOC)){
    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('A'.$celdas,$c)
        ->setCellValue('B'.$celdas,$datos['correlativo'] )
        ->setCellValue('C'.$celdas, utf8_encode($datos['nombre_integrante']))
        ->setCellValue('D'.$celdas, $datos['cel'])
        ->setCellValue('E'.$celdas, $datos['num_equipo'].'-'.$datos['nombre_equipo']);
    $c++;
    $celdas++;
}






$objPHPExcel->getActiveSheet()->setTitle('NO INTEGRADOS');
$objPHPExcel->setActiveSheetIndex(0);



getHeders();
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
?>