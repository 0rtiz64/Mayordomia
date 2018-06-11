<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 24/1/2018
 * Time: 8:53 AM
 */


require_once 'EXCELfunciones.php';
include '../gold/enlace.php';
//$area = $_GET['area'];
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
    ->setCellValue('B1', 'REPORTE MATRICULADOS')
    ->setCellValue('C1', '');

//DATOS

$queryIntegrantes = mysqli_query($enlace," Select * from integrantes where not exists
 (select 1 from detalle_integrantes where detalle_integrantes.id_integrante = integrantes.idintegrante  )");
$contador = 1;
$datos = mysqli_fetch_array($queryIntegrantes,MYSQLI_ASSOC);


$objPHPExcel->setActiveSheetIndex(0)

    ->setCellValue('A3', 'PROMOCION CORDERITOS')
    ->setCellValue('B3', 'IDENTIDAD')
    ->setCellValue('C3', 'NOMBRE')
    ->setCellValue('D3', 'CELULAR')
    ->setCellValue('E3', 'ESTADO CIVIL')
    ->setCellValue('F3', 'GENERO')
    ->setCellValue('G3', 'TRANSPORTE')
    ->setCellValue('H3', 'DIRECCION')
    ->setCellValue('I3', 'FECHA CUMPLEAÑOS')
    ->setCellValue('J3', 'AREAS')
    ->setCellValue('K3', 'CORRELATIVO')
    ->setCellValue('L3', 'FECHA MATRICULA')
    ->setCellValue('M3', 'NUM EQUIPO')
    ->setCellValue('N3', 'NOMBRE EQUIPO')
    ->setCellValue('O3', 'ESTADO');


$Integrantes = mysqli_query($enlace," SELECT integrantes.num_identidad,integrantes.promo_cordero,integrantes.nombre_integrante,integrantes.cel,integrantes.estado_civil,integrantes.sexo,
integrantes.trasporte,integrantes.direccion,integrantes.fecha_cumple,integrantes.areas,integrantes.correlativo,integrantes.fecha_registro,
equipos.num_equipo,equipos.nombre_equipo,detalle_integrantes.`status`  from integrantes
INNER JOIN detalle_integrantes ON detalle_integrantes.id_integrante = integrantes.idintegrante
INNER JOIN equipos ON detalle_integrantes.id_equipo = equipos.id_equipo
INNER JOIN promociones ON detalle_integrantes.id_promocion = promociones.idpromocion
WHERE detalle_integrantes.id_cargo = 10 AND promociones.`status`=1
");
$contador=4;



while ($integrantesDatos = mysqli_fetch_array($Integrantes,MYSQLI_ASSOC)) {

    if($integrantesDatos["status"]==1){
        $estado ="ACTIVO";
    }else{
        if($integrantesDatos["status"]==3){
            $estado= "INACTIVO";
        }else{
            if($integrantesDatos["status"]==2){
                $estado="RETIRADO";
            }
        }
    }

    $dia = substr($integrantesDatos["fecha_cumple"],8,2);
    $mes = substr($integrantesDatos["fecha_cumple"],5,2);
    $aaa = substr($integrantesDatos["fecha_cumple"],0,4);

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


    $fCompleta = $dia." ".$miMes." ".$aaa;



    //fecha registro
    $dia = substr($integrantesDatos["fecha_registro"],8,2);
    $mes = substr($integrantesDatos["fecha_registro"],5,2);
    $aaa = substr($integrantesDatos["fecha_registro"],0,4);

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


    $fCompletaRegistro = $dia." ".$miMes." ".$aaa;

    $objPHPExcel->getActiveSheet()->getCell("B$contador")->setValueExplicit($integrantesDatos["num_identidad"], PHPExcel_Cell_DataType::TYPE_STRING);

    $objPHPExcel->setActiveSheetIndex(0)
        //->setCellValue("A$contador", $integrantesDatos["identidad"])
        ->setCellValue("A$contador", $integrantesDatos["promo_cordero"])
        ->setCellValue("C$contador", $integrantesDatos["nombre_integrante"])
        ->setCellValue("D$contador", $integrantesDatos["cel"])
        ->setCellValue("E$contador", $integrantesDatos["estado_civil"])
        ->setCellValue("F$contador", $integrantesDatos["sexo"])
        ->setCellValue("G$contador", $integrantesDatos["trasporte"])
        ->setCellValue("H$contador", $integrantesDatos["direccion"])
        ->setCellValue("I$contador", $fCompleta)
        ->setCellValue("J$contador", $integrantesDatos["areas"])
        ->setCellValue("K$contador", $integrantesDatos["correlativo"])
        ->setCellValue("L$contador", $fCompletaRegistro)
        ->setCellValue("M$contador", $integrantesDatos["num_equipo"])
        ->setCellValue("N$contador", $integrantesDatos["nombre_equipo"])
        ->setCellValue("O$contador", $estado);

    $contador++;
}



//FIN DATOS


$objPHPExcel->getActiveSheet()->setTitle('INTEGRANTES MATRICULADOS');
$objPHPExcel->setActiveSheetIndex(0);

getHeders();
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
?>