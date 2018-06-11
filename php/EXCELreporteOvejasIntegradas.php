<?php
/**
 * Created by David Ortiz.
 * User: David Ortiz
 * Date: 8/11/2017
 * Time: 10:32
 */
require_once 'EXCELfunciones.php';
include '../gold/enlace.php';

activeErrorReporting();

noCli();

require_once  '../phpExcel/Classes/PHPExcel.php';
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("Denny Molina")
    ->setLastModifiedBy("Denny Molina")
    ->setTitle("Office 2007 XLSX Test Document")
    ->setSubject("Office 2007 XLSX Test Document")
    ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
    ->setKeywords("office 2007 openxml php")
    ->setCategory("Test result file");


$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A1', '#')
    ->setCellValue('B1', 'AREA')
    ->setCellValue('C1', 'CANTIDAD');

//DATOS

$queryAlabanza = mysqli_query($enlace,"SELECT  COUNT(nombre) AS cantidad FROM ovejas
WHERE area1 = 'ALABANZA' OR area2 = 'ALABANZA' OR area3='ALABANZA' OR area4= 'ALABANZA' OR area5='ALABANZA'");
$datosAlabanza = mysqli_fetch_array($queryAlabanza,MYSQLI_ASSOC);
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A2', '1')
    ->setCellValue('B2', 'ALABANZA')
    ->setCellValue('C2', $datosAlabanza["cantidad"]);


$queryArca= mysqli_query($enlace,"SELECT  COUNT(nombre) AS cantidad FROM ovejas
WHERE area1 = 'ARCA DE LOS TESOROS' OR area2 = 'ARCA DE LOS TESOROS' OR area3='ARCA DE LOS TESOROS' OR area4= 'ARCA DE LOS TESOROS' OR area5='ARCA DE LOS TESOROS'");
$datosArca = mysqli_fetch_array($queryArca,MYSQLI_ASSOC);
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A3', '2')
    ->setCellValue('B3', 'ARCA DE LOS TESOROS')
    ->setCellValue('C3', $datosArca["cantidad"]);

$queryBernabe= mysqli_query($enlace,"SELECT  COUNT(nombre) AS cantidad FROM ovejas
WHERE area1 = 'BERNABE' OR area2 = 'BERNABE' OR area3='BERNABE' OR area4= 'BERNABE' OR area5='BERNABE'");
$datosBernabe = mysqli_fetch_array($queryBernabe,MYSQLI_ASSOC);
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A4', '3')
    ->setCellValue('B4', 'BERNABE')
    ->setCellValue('C4', $datosBernabe["cantidad"]);

$queryCorrosVarones= mysqli_query($enlace,"SELECT  COUNT(nombre) AS cantidad FROM ovejas
WHERE area1 = 'CORROS VARONES' OR area2 = 'CORROS VARONES' OR area3='CORROS VARONES' OR area4= 'CORROS VARONES' OR area5='CORROS VARONES'");
$datosCorrosVarones = mysqli_fetch_array($queryCorrosVarones,MYSQLI_ASSOC);
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A5', '4')
    ->setCellValue('B5', 'CORROS VARONES')
    ->setCellValue('C5', $datosCorrosVarones["cantidad"]);


$queryCronicas= mysqli_query($enlace,"SELECT  COUNT(nombre) AS cantidad FROM ovejas
WHERE area1 = 'CRONICAS' OR area2 = 'CRONICAS' OR area3='CRONICAS' OR area4= 'CRONICAS' OR area5='CRONICAS'");
$datosCronicas = mysqli_fetch_array($queryCronicas,MYSQLI_ASSOC);
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A6', '5')
    ->setCellValue('B6', 'CRONICAS')
    ->setCellValue('C6', $datosCronicas["cantidad"]);

$queryPandero= mysqli_query($enlace,"SELECT  COUNT(nombre) AS cantidad FROM ovejas
WHERE area1 = 'DANZA PANDERO' OR area2 = 'DANZA PANDERO' OR area3='DANZA PANDERO' OR area4= 'DANZA PANDERO' OR area5='DANZA PANDERO'");
$datosPandero= mysqli_fetch_array($queryPandero,MYSQLI_ASSOC);
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A7', '6')
    ->setCellValue('B7', 'DANZA PANDERO')
    ->setCellValue('C7', $datosPandero["cantidad"]);

$queryCenter= mysqli_query($enlace,"SELECT  COUNT(nombre) AS cantidad FROM ovejas
WHERE area1 = 'EBENECENTER' OR area2 = 'EBENECENTER' OR area3='EBENECENTER' OR area4= 'EBENECENTER' OR area5='EBENECENTER'");
$datosCenter= mysqli_fetch_array($queryCenter,MYSQLI_ASSOC);
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A8', '7')
    ->setCellValue('B8', 'EBENECENTER')
    ->setCellValue('C8', $datosCenter["cantidad"]);

$querySamaritano= mysqli_query($enlace,"SELECT  COUNT(nombre) AS cantidad FROM ovejas
WHERE area1 = 'EL BUEN SAMARITANO' OR area2 = 'EL BUEN SAMARITANO' OR area3='EL BUEN SAMARITANO' OR area4= 'EL BUEN SAMARITANO' OR area5='EL BUEN SAMARITANO'");
$datosSamaritano= mysqli_fetch_array($querySamaritano,MYSQLI_ASSOC);
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A9', '8')
    ->setCellValue('B9', 'EL BUEN SAMARITANO')
    ->setCellValue('C9', $datosSamaritano["cantidad"]);


$queryMayordomia= mysqli_query($enlace,"SELECT  COUNT(nombre) AS cantidad FROM ovejas
WHERE area1 = 'ESC DE MAYORDOMIA' OR area2 = 'ESC DE MAYORDOMIA' OR area3='ESC DE MAYORDOMIA' OR area4= 'ESC DE MAYORDOMIA' OR area5='ESC DE MAYORDOMIA'");
$datosMayordomia= mysqli_fetch_array($queryMayordomia,MYSQLI_ASSOC);
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A10', '9')
    ->setCellValue('B10', 'ESC DE MAYORDOMIA')
    ->setCellValue('C10', $datosMayordomia["cantidad"]);

$queryProfetica= mysqli_query($enlace,"SELECT  COUNT(nombre) AS cantidad FROM ovejas
WHERE area1 = 'ESC PROFETICA' OR area2 = 'ESC PROFETICA' OR area3='ESC PROFETICA' OR area4= 'ESC PROFETICA' OR area5='ESC PROFETICA'");
$datosProfetica= mysqli_fetch_array($queryProfetica,MYSQLI_ASSOC);
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A11', '10')
    ->setCellValue('B11', 'ESC PROFETICA')
    ->setCellValue('C11', $datosProfetica["cantidad"]);

$queryKeruso= mysqli_query($enlace,"SELECT  COUNT(nombre) AS cantidad FROM ovejas
WHERE area1 = 'KERUSSO' OR area2 = 'KERUSSO' OR area3='KERUSSO' OR area4= 'KERUSSO' OR area5='KERUSSO'");
$datosKeruso= mysqli_fetch_array($queryKeruso,MYSQLI_ASSOC);
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A12', '11')
    ->setCellValue('B12', 'KERUSSO')
    ->setCellValue('C12', $datosKeruso["cantidad"]);

$queryCuna= mysqli_query($enlace,"SELECT  COUNT(nombre) AS cantidad FROM ovejas
WHERE area1 = 'SALA CUNA' OR area2 = 'SALA CUNA' OR area3='SALA CUNA' OR area4= 'SALA CUNA' OR area5='SALA CUNA'");
$datosCuna= mysqli_fetch_array($queryCuna,MYSQLI_ASSOC);
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A13', '12')
    ->setCellValue('B13', 'SALA CUNA')
    ->setCellValue('C13', $datosCuna["cantidad"]);

$queryA= mysqli_query($enlace,"SELECT  COUNT(nombre) AS cantidad FROM ovejas
WHERE area1 = 'SERVIDORES A' OR area2 = 'SERVIDORES A' OR area3='SERVIDORES A' OR area4= 'SERVIDORES A' OR area5='SERVIDORES A'");
$datosA= mysqli_fetch_array($queryA,MYSQLI_ASSOC);
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A14', '13')
    ->setCellValue('B14', 'SERVIDORES A')
    ->setCellValue('C14', $datosA["cantidad"]);

$queryB= mysqli_query($enlace,"SELECT  COUNT(nombre) AS cantidad FROM ovejas
WHERE area1 = 'SERVIDORES B' OR area2 = 'SERVIDORES B' OR area3='SERVIDORES B' OR area4= 'SERVIDORES B' OR area5='SERVIDORES B'");
$datosB= mysqli_fetch_array($queryB,MYSQLI_ASSOC);
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A15', '14')
    ->setCellValue('B15', 'SERVIDORES B')
    ->setCellValue('C15', $datosB["cantidad"]);

$queryC= mysqli_query($enlace,"SELECT  COUNT(nombre) AS cantidad FROM ovejas
WHERE area1 = 'SERVIDORES C' OR area2 = 'SERVIDORES C' OR area3='SERVIDORES C' OR area4= 'SERVIDORES C' OR area5='SERVIDORES C'");
$datosC= mysqli_fetch_array($queryC,MYSQLI_ASSOC);
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A16', '15')
    ->setCellValue('B16', 'SERVIDORES C')
    ->setCellValue('C16', $datosC["cantidad"]);

$queryD= mysqli_query($enlace,"SELECT  COUNT(nombre) AS cantidad FROM ovejas
WHERE area1 = 'SERVIDORES D' OR area2 = 'SERVIDORES D' OR area3='SERVIDORES D' OR area4= 'SERVIDORES D' OR area5='SERVIDORES D'");
$datosD= mysqli_fetch_array($queryD,MYSQLI_ASSOC);
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A17', '16')
    ->setCellValue('B17', 'SERVIDORES D')
    ->setCellValue('C17', $datosD["cantidad"]);

$queryE= mysqli_query($enlace,"SELECT  COUNT(nombre) AS cantidad FROM ovejas
WHERE area1 = 'SERVIDORES E' OR area2 = 'SERVIDORES E' OR area3='SERVIDORES E' OR area4= 'SERVIDORES E' OR area5='SERVIDORES E'");
$datosE= mysqli_fetch_array($queryE,MYSQLI_ASSOC);
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A18', '17')
    ->setCellValue('B18', 'SERVIDORES E')
    ->setCellValue('C18', $datosE["cantidad"]);

$queryF= mysqli_query($enlace,"SELECT  COUNT(nombre) AS cantidad FROM ovejas
WHERE area1 = 'SERVIDORES F' OR area2 = 'SERVIDORES F' OR area3='SERVIDORES F' OR area4= 'SERVIDORES F' OR area5='SERVIDORES F'");
$datosF= mysqli_fetch_array($queryF,MYSQLI_ASSOC);
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A19', '18')
    ->setCellValue('B19', 'SERVIDORES F')
    ->setCellValue('C19', $datosF["cantidad"]);

$queryG= mysqli_query($enlace,"SELECT  COUNT(nombre) AS cantidad FROM ovejas
WHERE area1 = 'SERVIDORES G' OR area2 = 'SERVIDORES G' OR area3='SERVIDORES G' OR area4= 'SERVIDORES G' OR area5='SERVIDORES G'");
$datosG= mysqli_fetch_array($queryG,MYSQLI_ASSOC);
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A20', '19')
    ->setCellValue('B20', 'SERVIDORES G')
    ->setCellValue('C20', $datosG["cantidad"]);

$queryH= mysqli_query($enlace,"SELECT  COUNT(nombre) AS cantidad FROM ovejas
WHERE area1 = 'SERVIDORES H' OR area2 = 'SERVIDORES H' OR area3='SERVIDORES H' OR area4= 'SERVIDORES H' OR area5='SERVIDORES H'");
$datosH= mysqli_fetch_array($queryH,MYSQLI_ASSOC);
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A21', '20')
    ->setCellValue('B21', 'SERVIDORES H')
    ->setCellValue('C21', $datosH["cantidad"]);

$queryI= mysqli_query($enlace,"SELECT  COUNT(nombre) AS cantidad FROM ovejas
WHERE area1 = 'SERVIDORES I' OR area2 = 'SERVIDORES I' OR area3='SERVIDORES I' OR area4= 'SERVIDORES I' OR area5='SERVIDORES I'");
$datosI= mysqli_fetch_array($queryI,MYSQLI_ASSOC);
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A22', '21')
    ->setCellValue('B22', 'SERVIDORES I')
    ->setCellValue('C22', $datosI["cantidad"]);


$queryJ= mysqli_query($enlace,"SELECT  COUNT(nombre) AS cantidad FROM ovejas
WHERE area1 = 'SERVIDORES J' OR area2 = 'SERVIDORES J' OR area3='SERVIDORES J' OR area4= 'SERVIDORES J' OR area5='SERVIDORES J'");
$datosJ= mysqli_fetch_array($queryJ,MYSQLI_ASSOC);
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A23', '22')
    ->setCellValue('B23', 'SERVIDORES J')
    ->setCellValue('C23', $datosJ["cantidad"]);

$queryK= mysqli_query($enlace,"SELECT  COUNT(nombre) AS cantidad FROM ovejas
WHERE area1 = 'SERVIDORES K' OR area2 = 'SERVIDORES K' OR area3='SERVIDORES K' OR area4= 'SERVIDORES K' OR area5='SERVIDORES K'");
$datosK= mysqli_fetch_array($queryK,MYSQLI_ASSOC);
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A24', '23')
    ->setCellValue('B24', 'SERVIDORES K')
    ->setCellValue('C24', $datosK["cantidad"]);


$queryL= mysqli_query($enlace,"SELECT  COUNT(nombre) AS cantidad FROM ovejas
WHERE area1 = 'SERVIDORES L' OR area2 = 'SERVIDORES L' OR area3='SERVIDORES L' OR area4= 'SERVIDORES L' OR area5='SERVIDORES L'");
$datosL= mysqli_fetch_array($queryL,MYSQLI_ASSOC);
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A25', '24')
    ->setCellValue('B25', 'SERVIDORES L')
    ->setCellValue('C25', $datosL["cantidad"]);

$queryEmpresarial= mysqli_query($enlace,"SELECT  COUNT(nombre) AS cantidad FROM ovejas
WHERE area1 = 'DOCTRINA EMPRESARIAL' OR area2 = 'DOCTRINA EMPRESARIAL' OR area3='DOCTRINA EMPRESARIAL' OR area4= 'DOCTRINA EMPRESARIAL' OR area5='DOCTRINA EMPRESARIAL'");
$datosEmpresarial= mysqli_fetch_array($queryEmpresarial,MYSQLI_ASSOC);
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A26', '25')
    ->setCellValue('B26', 'DOCTRINA EMPRESARIAL')
    ->setCellValue('C26', $datosEmpresarial["cantidad"]);

$queryPlus= mysqli_query($enlace,"SELECT  COUNT(nombre) AS cantidad FROM ovejas
WHERE area1 = 'JOVENES PLUS' OR area2 = 'JOVENES PLUS' OR area3='JOVENES PLUS' OR area4= 'JOVENES PLUS' OR area5='JOVENES PLUS'");
$datosPlus= mysqli_fetch_array($queryPlus,MYSQLI_ASSOC);
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A27', '26')
    ->setCellValue('B27', 'JOVENES PLUS')
    ->setCellValue('C27', $datosPlus["cantidad"]);


$queryTele= mysqli_query($enlace,"SELECT  COUNT(nombre) AS cantidad FROM ovejas
WHERE area1 = 'TELEVISION' OR area2 = 'TELEVISION' OR area3='TELEVISION' OR area4= 'TELEVISION' OR area5='TELEVISION'");
$datosTele= mysqli_fetch_array($queryTele,MYSQLI_ASSOC);
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A28', '27')
    ->setCellValue('B28', 'TELEVISION')
    ->setCellValue('C28', $datosTele["cantidad"]);


$queryAvanzada= mysqli_query($enlace,"SELECT  COUNT(nombre) AS cantidad FROM ovejas
WHERE area1 = 'DOCTRINA AVANZADA' OR area2 = 'DOCTRINA AVANZADA' OR area3='DOCTRINA AVANZADA' OR area4= 'DOCTRINA AVANZADA' OR area5='DOCTRINA AVANZADA'");
$datosAvanzada= mysqli_fetch_array($queryAvanzada,MYSQLI_ASSOC);
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A29', '28')
    ->setCellValue('B29', 'DOCTRINA AVANZADA')
    ->setCellValue('C29', $datosAvanzada["cantidad"]);


$queryCorrosMujeres= mysqli_query($enlace,"SELECT  COUNT(nombre) AS cantidad FROM ovejas
WHERE area1 = 'CORROS MUJERES' OR area2 = 'CORROS MUJERES' OR area3='CORROS MUJERES' OR area4= 'CORROS MUJERES' OR area5='CORROS MUJERES'");
$datosCorrosMujeres= mysqli_fetch_array($queryCorrosMujeres,MYSQLI_ASSOC);
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A30', '29')
    ->setCellValue('B30', 'CORROS MUJERES')
    ->setCellValue('C30', $datosCorrosMujeres["cantidad"]);

$queryMusica= mysqli_query($enlace,"SELECT  COUNT(nombre) AS cantidad FROM ovejas
WHERE area1 = 'ESCUELA DE MUSICA' OR area2 = 'ESCUELA DE MUSICA' OR area3='ESCUELA DE MUSICA' OR area4= 'ESCUELA DE MUSICA' OR area5='ESCUELA DE MUSICA'");
$datosMusica= mysqli_fetch_array($queryMusica,MYSQLI_ASSOC);
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A31', '30')
    ->setCellValue('B31', 'ESCUELA DE MUSICA')
    ->setCellValue('C31', $datosMusica["cantidad"]);


$queryMiriam= mysqli_query($enlace,"SELECT  COUNT(nombre) AS cantidad FROM ovejas
WHERE area1 = 'DANZA MIRIAM' OR area2 = 'DANZA MIRIAM' OR area3='DANZA MIRIAM' OR area4= 'DANZA MIRIAM' OR area5='DANZA MIRIAM'");
$datosMiriam= mysqli_fetch_array($queryMiriam,MYSQLI_ASSOC);
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A32', '31')
    ->setCellValue('B32', 'DANZA MIRIAM')
    ->setCellValue('C32', $datosMiriam["cantidad"]);


$queryCaleb= mysqli_query($enlace,"SELECT  COUNT(nombre) AS cantidad FROM ovejas
WHERE area1 = 'CALEB' OR area2 = 'CALEB' OR area3='CALEB' OR area4= 'CALEB' OR area5='CALEB'");
$datosCaleb= mysqli_fetch_array($queryCaleb,MYSQLI_ASSOC);
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A33', '32')
    ->setCellValue('B33', 'CALEB')
    ->setCellValue('C33', $datosCaleb["cantidad"]);

$queryShadai= mysqli_query($enlace,"SELECT  COUNT(nombre) AS cantidad FROM ovejas
WHERE area1 = 'SHADAI' OR area2 = 'SHADAI' OR area3='SHADAI' OR area4= 'SHADAI' OR area5='SHADAI'");
$datosShadai= mysqli_fetch_array($queryShadai,MYSQLI_ASSOC);
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A34', '33')
    ->setCellValue('B34', 'SHADAI')
    ->setCellValue('C34', $datosShadai["cantidad"]);

$queryTeens= mysqli_query($enlace,"SELECT  COUNT(nombre) AS cantidad FROM ovejas
WHERE area1 = 'TEENS' OR area2 = 'TEENS' OR area3='TEENS' OR area4= 'TEENS' OR area5='TEENS'");
$datosTeens= mysqli_fetch_array($queryTeens,MYSQLI_ASSOC);
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A35', '34')
    ->setCellValue('B35', 'TEENS')
    ->setCellValue('C35', $datosTeens["cantidad"]);


$queryObreros= mysqli_query($enlace,"SELECT  COUNT(nombre) AS cantidad FROM ovejas
WHERE area1 = 'OBREROS' OR area2 = 'OBREROS' OR area3='OBREROS' OR area4= 'OBREROS' OR area5='OBREROS'");
$datosObreros= mysqli_fetch_array($queryObreros,MYSQLI_ASSOC);
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A36', '35')
    ->setCellValue('B36', 'OBREROS')
    ->setCellValue('C36', $datosObreros["cantidad"]);

//FIN DATOS


$objPHPExcel->getActiveSheet()->setTitle('OVEJAS INTEGRADAS');
$objPHPExcel->setActiveSheetIndex(0);

getHeders();
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
?>