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
    ->setCellValue('M3', '0-2 AÑOS')
    ->setCellValue('N3', '2-3 AÑOS')
    ->setCellValue('O3', '4-5 AÑOS')
    ->setCellValue('P3', '6-7 AÑOS')
    ->setCellValue('Q3', '8-11 AÑOS')
    ->setCellValue('R3', 'OTROS')
    ->setCellValue('S3', 'TOTAL');

$promoActiva = mysqli_query($enlace,"SELECT  * from promociones WHERE `status`=1");
$datosPromocionActiva = mysqli_fetch_array($promoActiva,MYSQLI_ASSOC);
$promoActivaCorrelativo= $datosPromocionActiva["correlativo"];
$Integrantes = mysqli_query($enlace," SELECT * from integrantes
where correlativo >$promoActivaCorrelativo
GROUP BY correlativo ASC");


$contador=4;



while ($integrantesDatos = mysqli_fetch_array($Integrantes,MYSQLI_ASSOC)) {


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
        ->setCellValue("L$contador", $fCompletaRegistro);

    $contador++;

$idIntegrante = $integrantesDatos["idintegrante"];
    $queryNinosConfirmar = mysqli_num_rows(mysqli_query($enlace,"SELECT  * from rangos WHERE rangos.idIntegrante = $idIntegrante"));

if($queryNinosConfirmar >0){

    $queryMostrarNinos = mysqli_query($enlace,"SELECT  rangos.`0-2` AS rango1,rangos.`2-3` AS rango2,rangos.`4-5` AS rango3,
rangos.`6-7` AS rango4,rangos.`8-11` AS rango5,rangos.otros,rangos.total from rangos WHERE rangos.idIntegrante = $idIntegrante");
    $datosMostarNinos = mysqli_fetch_array($queryMostrarNinos,MYSQLI_ASSOC);
    $objPHPExcel->setActiveSheetIndex(0)
        //->setCellValue("A$contador", $integrantesDatos["identidad"])
        ->setCellValue("M$contador", $datosMostarNinos["rango1"])
        ->setCellValue("N$contador", $datosMostarNinos["rango2"])
        ->setCellValue("O$contador", $datosMostarNinos["rango3"])
        ->setCellValue("P$contador", $datosMostarNinos["rango4"])
        ->setCellValue("Q$contador", $datosMostarNinos["rango5"])
        ->setCellValue("R$contador", $integrantesDatos["otros"])
        ->setCellValue("S$contador", $integrantesDatos["total"]);

}

}



//FIN DATOS


$objPHPExcel->getActiveSheet()->setTitle('INTEGRANTES MATRICULADOS');
$objPHPExcel->setActiveSheetIndex(0);

getHeders();
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
?>