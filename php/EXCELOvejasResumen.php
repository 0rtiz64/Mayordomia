<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 8/10/2018
 * Time: 1:25 PM
 */



require_once 'EXCELfunciones.php';
include '../gold/enlace.php';

$num_promo = $_GET['id_promos'];
$num_fecha = $_GET['id_fecs'];


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
    ->setCellValue('B1', 'REPORTE OVEJAS RESUMEN')
    ->setCellValue('C1', '');

$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A2', 'No.')
    ->setCellValue('B2', 'NOMBRE')
    ->setCellValue('C2', 'CANTIDAD DE INTEGRANTES')
    ->setCellValue('D2', 'ASISTENTES')
    ->setCellValue('E2', 'AUSENTES')
    ->setCellValue('F2', 'PORCENTAJE DE ASISTENCIA');

$cantiadIntegrantes = 0;
$canidadAsistentes = 0;
$cantidaAusentes = 0;
$cantidadPorcentaje = 0;

$query = mysqli_query($enlace,"SELECT DISTINCT E.id_equipo,E.num_equipo,E.nombre_equipo AS Equipo, COUNT(a.id_equipo) AS cantidad_I FROM detalle_integrantes a 
INNER JOIN equipos E ON a.id_equipo = E.id_equipo
INNER JOIN promociones ON E.id_promocion = promociones.idpromocion
WHERE a.id_promocion = ".$num_promo."  AND a.id_cargo=10 AND a.`status`=1 AND promociones.`status`=1 
GROUP BY E.id_equipo,E.num_equipo,E.nombre_equipo ORDER BY num_equipo");

$celdas = 3;
while ($rows = mysqli_fetch_array($query,MYSQLI_ASSOC)) {
    # code...
    $queryInterno = mysqli_query($enlace,"SELECT  IFNULL(COUNT(*),0) Asistentes  from integrantes
INNER JOIN marcacionprovicional ON integrantes.idintegrante = marcacionprovicional.idIntegrante
INNER JOIN detalle_integrantes ON integrantes.idintegrante = detalle_integrantes.id_integrante
INNER JOIN equipos ON detalle_integrantes.id_equipo = equipos.id_equipo
WHERE
detalle_integrantes.id_equipo = ".$rows['id_equipo']." AND
detalle_integrantes.`status` = 1 AND
detalle_integrantes.id_promocion = ".$num_promo." AND
CAST(marcacionprovicional.fechaMarcacion AS DATE) = '".$num_fecha."' AND
detalle_integrantes.id_cargo = 10
");
    $rows_asistente = mysqli_fetch_array($queryInterno,MYSQLI_ASSOC);

    $asis = $rows['cantidad_I'] - $rows_asistente['Asistentes'];
    $porcetaje = round(($rows_asistente['Asistentes'] * 100) / $rows['cantidad_I'],2);


    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('A'.$celdas,$rows['num_equipo'] )
        ->setCellValue('B'.$celdas,$rows['Equipo'] )
        ->setCellValue('C'.$celdas, $rows['cantidad_I'])
        ->setCellValue('D'.$celdas, $rows_asistente['Asistentes'])
        ->setCellValue('E'.$celdas, $asis)
        ->setCellValue('F'.$celdas, $porcetaje.'%');




    $cantiadIntegrantes += $rows['cantidad_I'];
    $canidadAsistentes += $rows_asistente['Asistentes'];
    $celdas++;
}

$cantidaAusentes = $cantiadIntegrantes - $canidadAsistentes;
$cantidadPorcentaje = round(($canidadAsistentes * 100) / $cantiadIntegrantes,2);
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('B'.$celdas,"TOTALES")
    ->setCellValue('C'.$celdas,$cantiadIntegrantes)
    ->setCellValue('D'.$celdas,$canidadAsistentes)
    ->setCellValue('E'.$celdas,$cantidaAusentes )
    ->setCellValue('F'.$celdas,$cantidadPorcentaje.'%');



//PESTAÑA DOS

$pestana2 = $objPHPExcel->createSheet(1); //Setting index when creating

$pestana2->setCellValue('A2', 'INACTIVOS - RETIRADOS')
    ->setCellValue('A3', 'No.')
    ->setCellValue('B3', 'NOMBRE EQUIPO')
    ->setCellValue('C3', 'NOMBRE INTEGRANTE')
    ->setCellValue('D3', 'ESTADO');

$celdas2 = 4;

$queryPromoActiva = mysqli_query($enlace,"SELECT * FROM promociones WHERE `status` = 1");
$datosQueryPromoActiva = mysqli_fetch_array($queryPromoActiva,MYSQLI_ASSOC);
$correlativo = $datosQueryPromoActiva["correlativo"];

$queryTodos = mysqli_query($enlace,"SELECT detalle_integrantes.`status` as estado, integrantes.nombre_integrante,equipos.num_equipo,equipos.nombre_equipo 
from marcacionprovicional
INNER JOIN detalle_integrantes ON marcacionprovicional.idIntegrante = detalle_integrantes.id_integrante
INNER JOIN integrantes on marcacionprovicional.idIntegrante = integrantes.idintegrante
INNER JOIN promociones ON detalle_integrantes.id_promocion = promociones.idpromocion
INNER JOIN equipos on detalle_integrantes.id_equipo = equipos.id_equipo
WHERE CAST(marcacionprovicional.fechaMarcacion AS DATE) = '".$num_fecha."' AND promociones.`status` = 1 
and detalle_integrantes.id_cargo = 10 AND detalle_integrantes.`status` <>1");
$cont2 = 1;
while ($datosTodos = mysqli_fetch_array($queryTodos,MYSQLI_ASSOC)){
    $estado = $datosTodos["estado"];
    if($estado == 3){
        $nombreEstado = "INCACTIVO";
    }else{
        if($estado == 2){
            $nombreEstado="RETIRADO";
        }
    }


    $pestana2->setCellValue('A'.$celdas2, $cont2)
        ->setCellValue('B'.$celdas2, $datosTodos["num_equipo"].'-'.$datosTodos["nombre_equipo"])
        ->setCellValue('C'.$celdas2, utf8_encode($datosTodos["nombre_integrante"]))
        ->setCellValue('D'.$celdas2, $nombreEstado);


    $cont2++;
    $celdas2++;
};

$cont2= $cont2-1;

$pestana2->setCellValue('B'.$celdas2, "TOTALES")
    ->setCellValue('C'.$celdas2, $cont2);









//PESTAÑA TRES
$pestana3 = $objPHPExcel->createSheet(2); //Setting index when creating

//Write cells
$pestana3->setCellValue('A2', 'NO ENLAZADOS')
    ->setCellValue('A3', 'No.')
    ->setCellValue('B3', 'NOMBRE INTEGRANTE')
    ->setCellValue('C3', 'TELEFONO')
    ->setCellValue('D3', 'CORRELATIVO');

$celdas3 = 4;
$queryNoEnlazados = mysqli_query($enlace,"SELECT integrantes.nombre_integrante,integrantes.cel,integrantes.correlativo
  FROM marcacionprovicional
INNER JOIN promociones on marcacionprovicional.idPromocion = promociones.idpromocion
INNER JOIN integrantes on marcacionprovicional.idIntegrante = integrantes.idintegrante
 WHERE NOT EXISTS (SELECT NULL
                     FROM detalle_integrantes
                    WHERE detalle_integrantes.id_integrante= marcacionprovicional.idIntegrante) AND promociones.`status` = 1 and CAST(marcacionprovicional.fechaMarcacion AS DATE) = '".$num_fecha."'");
$cont3=1;
while ($datosNoEnlazados = mysqli_fetch_array($queryNoEnlazados,MYSQLI_ASSOC)){

    $pestana3->setCellValue('A'.$celdas3, $cont3)
        ->setCellValue('B'.$celdas3, utf8_encode($datosNoEnlazados["nombre_integrante"]))
        ->setCellValue('C'.$celdas3, $datosNoEnlazados["cel"])
        ->setCellValue('D'.$celdas3, $datosNoEnlazados["correlativo"]);
    $celdas3++;
    $cont3++;
}
$cont3= $cont3-1;

$pestana3->setCellValue('B'.$celdas3, "TOTALES")
    ->setCellValue('C'.$celdas3, $cont3);








$objPHPExcel->getActiveSheet()->setTitle('ACTIVOS');
$objPHPExcel->setActiveSheetIndex(0);

$objPHPExcel->setActiveSheetIndex(1);
$objPHPExcel->getActiveSheet()->setTitle('INACTIVOS - RETIRADOS');

$objPHPExcel->setActiveSheetIndex(2);
$objPHPExcel->getActiveSheet()->setTitle('NO ENLAZADOS');

getHeders();
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
?>