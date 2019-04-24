<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 18/6/2018
 * Time: 3:22 PM
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
    ->setCellValue('B1', 'DOCUMENTOS PENDIENTES')
    ->setCellValue('C1', '');




//DATOS






$objPHPExcel->setActiveSheetIndex(0)

    ->setCellValue('A3', '#')
    ->setCellValue('B3', 'NOMBRE')
    ->setCellValue('C3', 'CORDERITOS')
    ->setCellValue('D3', 'IDENTIDAD')
    ->setCellValue('E3', 'FECHA NACIMIENTO')
    ->setCellValue('F3', 'TELEFONO 1')
    ->setCellValue('G3', 'TELEFONO 2')
    ->setCellValue('H3', 'ESTADO CIVIL')
    ->setCellValue('I3', 'GENERO')
    ->setCellValue('J3', 'AREAS')
    ->setCellValue('K3', 'CORRELATIVO')
    ->setCellValue('L3', 'DOCUMENTOS PENDIENTES')
    ->setCellValue('M3', 'EQUIPO');

$promoActiva = mysqli_query($enlace,"SELECT * from promociones where `status`  = 1");
$datosPromoActiva = mysqli_fetch_array($promoActiva,MYSQLI_ASSOC);
$correlativoPromo = $datosPromoActiva["correlativo"];


$verificar = mysqli_num_rows(mysqli_query($enlace,"SELECT * from integrantes WHERE integrantes.documentosRespuesta = 1 and correlativo > $correlativoPromo "));

if ($verificar >0){
    $qTomarId = mysqli_query($enlace,"SELECT * from integrantes WHERE integrantes.documentosRespuesta = 1 and correlativo > 19010000 GROUP BY correlativo ASC");

    $contador =4;
    $contador1 =1;

    while ($dTomarId= mysqli_fetch_array($qTomarId,MYSQLI_ASSOC)){
$idIntegrante = $dTomarId["idintegrante"];
$fecha = $dTomarId["fecha_cumple"];
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



        $objPHPExcel->getActiveSheet()->getCell("D$contador")->setValueExplicit($dTomarId["num_identidad"], PHPExcel_Cell_DataType::TYPE_STRING);


        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue("A$contador", $contador1)
            ->setCellValue("B$contador", utf8_encode($dTomarId["nombre_integrante"]))
            ->setCellValue("C$contador", $dTomarId["promo_cordero"])
            ->setCellValue("E$contador",$fCompleta )
            ->setCellValue("F$contador",$dTomarId["cel"] )
            ->setCellValue("G$contador",$dTomarId["tel"] )
            ->setCellValue("H$contador",$dTomarId["estado_civil"])
            ->setCellValue("I$contador",$dTomarId["sexo"] )
            ->setCellValue("J$contador",$dTomarId["areas"] )
            ->setCellValue("K$contador",$dTomarId["correlativo"] )
            ->setCellValue("L$contador",$dTomarId["documentosPendientes"] );


        //VERIFICAR SI ESTA ENLAZADO A EQUIPO INICIO
        $queryVerificarEquipo =mysqli_num_rows(mysqli_query($enlace,"SELECT equipos.nombre_equipo,equipos.num_equipo from detalle_integrantes 
INNER JOIN equipos on detalle_integrantes.id_equipo = equipos.id_equipo
INNER JOIN promociones on detalle_integrantes.id_promocion = promociones.idpromocion
WHERE promociones.`status` = 1 and detalle_integrantes.id_integrante = $idIntegrante"));

         if($queryVerificarEquipo>0){
             //SI TIENE EQUIPO
             $equipos= mysqli_query($enlace,"SELECT equipos.nombre_equipo,equipos.num_equipo from detalle_integrantes 
INNER JOIN equipos on detalle_integrantes.id_equipo = equipos.id_equipo
INNER JOIN promociones on detalle_integrantes.id_promocion = promociones.idpromocion
WHERE promociones.`status` = 1 and detalle_integrantes.id_integrante = $idIntegrante");
             $datosEquipo = mysqli_fetch_array($equipos,MYSQLI_ASSOC);
             $objPHPExcel->setActiveSheetIndex(0)
                 ->setCellValue("M$contador",$datosEquipo["num_equipo"].'-'.$datosEquipo["nombre_equipo"]);
         }else{
             // NO TIENE EQUIPO
             $objPHPExcel->setActiveSheetIndex(0)
                 ->setCellValue("M$contador","");
         }
        //VERIFICAR SI ESTA ENLAZADO A EQUIPO FINAL

        $contador++;
        $contador1++;
    }
}else{
    //NO TIENEN
    $objPHPExcel->setActiveSheetIndex(0)

        ->setCellValue("B$contador", $dTomarId["AUN NO EXISTEN DATOS"]);
}













//FIN DATOS


$objPHPExcel->getActiveSheet()->setTitle('DOCUMENTOS PENDIENTES');
$objPHPExcel->setActiveSheetIndex(0);

getHeders();
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
?>
