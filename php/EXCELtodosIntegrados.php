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

$contadorPestanas = 0;
$querySeleccionarTodasAreas = mysqli_query($enlace,"SELECT * from areas GROUP BY Nombre ASC");
while($areas = mysqli_fetch_array($querySeleccionarTodasAreas,MYSQLI_ASSOC)){
    $pestana = $objPHPExcel->createSheet($contadorPestanas); //CREAR PESTANAS;



    $pestana->setCellValue('A2', $areas["Nombre"])
        ->setCellValue('A3', 'No.')
        ->setCellValue('B3', 'CORDERITOS')
        ->setCellValue('C3', 'IDENTIDAD')
        ->setCellValue('D3', 'NOMBRE')
        ->setCellValue('E3', 'TEL 1')
        ->setCellValue('F3', 'TEL 2')
        ->setCellValue('G3', 'ESTADO CIVIL')
        ->setCellValue('H3', 'GENERO')
        ->setCellValue('I3', 'TRANSPORTE')
        ->setCellValue('J3', 'DIRECCION')
        ->setCellValue('K3', 'FECHA NACIMIENTO')
        ->setCellValue('L3', 'AREAS DONDE SIRVE ACTUALMENTE')
        ->setCellValue('M3', 'CORRELATIVO')
        ->setCellValue('N3', 'OTRAS AREAS DONDE SE INTEGRO 1')
        ->setCellValue('O3', 'OTRAS AREAS DONDE SE INTEGRO 2')
        ->setCellValue('P3', 'OTRAS AREAS DONDE SE INTEGRO 3')
        ->setCellValue('Q3', 'OTRAS AREAS DONDE SE INTEGRO 4')
        ->setCellValue('R3', 'OTRAS AREAS DONDE SE INTEGRO 5');
$idArea= $areas["idArea"];

    $queryEnlazadosPorArea = "SELECT 
 integrantes.idintegrante,integrantes.promo_cordero,integrantes.num_identidad,integrantes.nombre_integrante,
integrantes.cel,integrantes.tel,integrantes.estado_civil,integrantes.sexo,integrantes.trasporte,integrantes.direccion,integrantes.fecha_cumple,
integrantes.areas,integrantes.correlativo
 from integracion 
INNER JOIN integrantes on integrantes.idintegrante = integracion.idIntegrante
INNER JOIN promociones on integracion.idPromocion = promociones.idpromocion
INNER JOIN detalle_integrantes on integrantes.idintegrante= detalle_integrantes.id_integrante
WHERE idArea = $idArea and promociones.`status` = 1 and detalle_integrantes.`status` = 1 GROUP BY integrantes.nombre_integrante ASC";


    $confirmarEnlazados = mysqli_num_rows(mysqli_query($enlace,$queryEnlazadosPorArea));
    if($confirmarEnlazados>0){
        $ejecutarQuery = mysqli_query($enlace,$queryEnlazadosPorArea);
        $No = 1;
        $celdas = 4;
        while($datos= mysqli_fetch_array($ejecutarQuery,MYSQLI_ASSOC)){
            $pestana->setCellValue()->getCell("C$celdas")->setValueExplicit($datos["num_identidad"], PHPExcel_Cell_DataType::TYPE_STRING);


            //FECHA INICIO

            $fecha =  $datos["fecha_cumple"];

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





            $pestana->setCellValue('A'.$celdas, $No)
                ->setCellValue('B'.$celdas, $datos["promo_cordero"])
                ->setCellValue('D'.$celdas, $datos["nombre_integrante"])
                ->setCellValue('E'.$celdas, $datos["cel"])
                ->setCellValue('F'.$celdas, $datos["tel"])
                ->setCellValue('G'.$celdas, $datos["estado_civil"])
                ->setCellValue('H'.$celdas, $datos["sexo"])
                ->setCellValue('I'.$celdas, $datos["trasporte"])
                ->setCellValue('J'.$celdas, $datos["direccion"])
                ->setCellValue('K'.$celdas, $fCompleta)
                ->setCellValue('L'.$celdas, $datos["areas"])
                ->setCellValue('M'.$celdas, $datos["correlativo"]);


            //OTRAS AREAS INICIO
            $idIntegrante = $datos["idintegrante"];
            $queryOtrasAreas = mysqli_query($enlace,"SELECT areas.Nombre AS area from integracion 
INNER JOIN areas on integracion.idArea = areas.idArea
WHERE integracion.idIntegrante =$idIntegrante and integracion.idArea <>$idArea");
$celda = 13;
            while ($datosOtrasAreas=mysqli_fetch_array($queryOtrasAreas,MYSQLI_ASSOC)){

                $pestana->setCellValueByColumnAndRow($celda,$celdas,$datosOtrasAreas["area"]);
                $celda++;
            };
            //OTRAS AREAS FINAL

            $No++;
            $celdas++;
        }

    }else{
        $pestana->setCellValue('A4', " AUN NO HAY DATOS EN ESTA AREA");

    }

    $objPHPExcel->setActiveSheetIndex($contadorPestanas);
    $objPHPExcel->getActiveSheet()->setTitle($areas["Nombre"]);
    $contadorPestanas++;
}


$pestana = $objPHPExcel->createSheet($contadorPestanas); //CREAR PESTANAS;
$pestana->setCellValue('A3', 'No.')
    ->setCellValue('B3', 'AREA')
    ->setCellValue('C3', 'CANTIDAD');
$celdasAreas= 4;
$contadorAreas = 1;
$c =0;
$querySeleccionarTodasAreas = mysqli_query($enlace,"SELECT * from areas GROUP BY Nombre ASC");
while($areas = mysqli_fetch_array($querySeleccionarTodasAreas,MYSQLI_ASSOC)){
    $idArea = $areas["idArea"];
$queryNombreArea = mysqli_query($enlace,"SELECT * from areas WHERE idArea = $idArea");
$datosNombreArea = mysqli_fetch_array($queryNombreArea,MYSQLI_ASSOC);
$nombreArea = $datosNombreArea["Nombre"];

    $cantidadPorArea = mysqli_query($enlace,"SELECT COUNT(*) as cantidad,areas.Nombre from integracion
INNER JOIN integrantes on integracion.idIntegrante = integrantes.idintegrante
INNER JOIN  areas on integracion.idArea = areas.idArea
INNER JOIN promociones on integracion.idPromocion = promociones.idpromocion
INNER JOIN detalle_integrantes on integracion.idIntegrante = detalle_integrantes.id_integrante
WHERE integracion.idArea  = $idArea and promociones.`status` = 1 and detalle_integrantes.`status` = 1 GROUP BY integrantes.nombre_integrante ASC");


while ($datosAreas  =mysqli_fetch_array($cantidadPorArea,MYSQLI_ASSOC)){
    $c++;
}
$pestana->setCellValue('A'.$celdasAreas, $contadorAreas)
        ->setCellValue('B'.$celdasAreas, $nombreArea)
        ->setCellValue('C'.$celdasAreas, $c);
$c =0;
$celdasAreas++;
$contadorAreas++;
    $objPHPExcel->setActiveSheetIndex($contadorPestanas);
    $objPHPExcel->getActiveSheet()->setTitle("REPORTE GENERAL");
}



//GENERAL INICIO
$contadorPestanas = $contadorPestanas+1;
$pestana2 = $objPHPExcel->createSheet($contadorPestanas); //CREAR PESTANAS;
$pestana2
    ->setCellValue('A3', 'No.')
    ->setCellValue('B3', 'CORDERITOS')
    ->setCellValue('C3', 'IDENTIDAD')
    ->setCellValue('D3', 'NOMBRE')
    ->setCellValue('E3', 'TEL 1')
    ->setCellValue('F3', 'TEL 2')
    ->setCellValue('G3', 'ESTADO CIVIL')
    ->setCellValue('H3', 'GENERO')
    ->setCellValue('I3', 'TRANSPORTE')
    ->setCellValue('J3', 'DIRECCION')
    ->setCellValue('K3', 'FECHA NACIMIENTO')
    ->setCellValue('L3', 'AREAS DONDE SIRVE ACTUALMENTE')
    ->setCellValue('M3', 'CORRELATIVO')
    ->setCellValue('N3', 'AREAS DONDE SE INTEGRO 1')
    ->setCellValue('O3', 'AREAS DONDE SE INTEGRO 2')
    ->setCellValue('P3', 'AREAS DONDE SE INTEGRO 3')
    ->setCellValue('Q3', 'AREAS DONDE SE INTEGRO 4')
    ->setCellValue('R3', 'AREAS DONDE SE INTEGRO 5');


$consultarTodasIntegraciones = mysqli_query($enlace,"SELECT integrantes.promo_cordero,integrantes.num_identidad,integrantes.nombre_integrante,integrantes.cel,
integrantes.tel,integrantes.estado_civil,integrantes.sexo,integrantes.trasporte,integrantes.direccion,integrantes.direccion,
integrantes.fecha_cumple,integrantes.areas,integrantes.correlativo,integrantes.idintegrante from integracion
INNER JOIN integrantes on integracion.idIntegrante = integrantes.idintegrante
INNER JOIN promociones on integracion.idPromocion = promociones.idpromocion
WHERE promociones.`status` = 1 GROUP BY integracion.idIntegrante ORDER BY integrantes.nombre_integrante ASC");

$No2 = 1;
$contador =4;
while($datosIntegraciones = mysqli_fetch_array($consultarTodasIntegraciones,MYSQLI_ASSOC)){

$idIntegranteInt = $datosIntegraciones["idintegrante"];
    //FECHA INICIO

    $fecha =  $datosIntegraciones["fecha_cumple"];

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


    $fCompletaIntegraciones = $dia."-".$miMes."-".$aaa;
    //FECHA FINAL


    $pestana2->setCellValue()->getCell("C$contador")->setValueExplicit($datosIntegraciones["num_identidad"], PHPExcel_Cell_DataType::TYPE_STRING);

    $pestana2->setCellValue('A'.$contador, $No2)
        ->setCellValue('B'.$contador, $datosIntegraciones["promo_cordero"])
        ->setCellValue('D'.$contador, $datosIntegraciones["nombre_integrante"])
        ->setCellValue('E'.$contador, $datosIntegraciones["cel"])
        ->setCellValue('F'.$contador, $datosIntegraciones["tel"])
        ->setCellValue('G'.$contador, $datosIntegraciones["estado_civil"])
        ->setCellValue('H'.$contador, $datosIntegraciones["sexo"])
        ->setCellValue('I'.$contador, $datosIntegraciones["trasporte"])
        ->setCellValue('J'.$contador, $datosIntegraciones["direccion"])
        ->setCellValue('K'.$contador, $fCompletaIntegraciones)
        ->setCellValue('L'.$contador, $datosIntegraciones["areas"])
        ->setCellValue('M'.$contador, $datosIntegraciones["correlativo"]);

    $areasIntegrante = mysqli_query($enlace,"SELECT areas.Nombre from integracion 
INNER JOIN areas on integracion.idArea = areas.idArea
WHERE integracion.idIntegrante = $idIntegranteInt");
    $cCeldas= 13;
    while ($areasIntegranteDatos = mysqli_fetch_array($areasIntegrante,MYSQLI_ASSOC)){
        $pestana2->setCellValueByColumnAndRow($cCeldas,$contador,$areasIntegranteDatos["Nombre"]);
        $cCeldas++;
    }
    $contador++;
    $No2++;
    $objPHPExcel->setActiveSheetIndex($contadorPestanas);
    $objPHPExcel->getActiveSheet()->setTitle("GENERAL");
}

//GENERAL FINAL

$objPHPExcel->setActiveSheetIndex(0);

getHeders();
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
?>