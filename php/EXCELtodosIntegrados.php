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
    ->setCellValue('B1', 'REPORTE GENERAL EXCEL')
    ->setCellValue('C1', '');




//DATOS






$objPHPExcel->setActiveSheetIndex(0)

    ->setCellValue('A3', 'PROMOCION CORDERITOS')
    ->setCellValue('B3', 'IDENTIDAD')
    ->setCellValue('C3', 'NOMBRE')
    ->setCellValue('D3', 'CELULAR 1')
    ->setCellValue('E3', 'CELULAR 2')
    ->setCellValue('F3', 'ESTADO CIVIL')
    ->setCellValue('G3', 'GENERO')
    ->setCellValue('H3', 'TRANSPORTE')
    ->setCellValue('I3', 'DIRECCION')
    ->setCellValue('J3', 'FECHA CUMPLEAÑOS')
    ->setCellValue('K3', 'AREAS')
    ->setCellValue('L3', 'CORRELATIVO')
    ->setCellValue('M3', 'ESTADO')
    ->setCellValue('N3', 'AREA INTEGRADO 1')
    ->setCellValue('O3', 'AREA INTEGRADO 2')
    ->setCellValue('P3', 'AREA INTEGRADO 3')
    ->setCellValue('Q3', 'AREA INTEGRADO 4')
    ->setCellValue('R3', 'AREA INTEGRADO 5');


$confirm = mysqli_num_rows(mysqli_query($enlace,"SELECT idIntegrante from integracion 
INNER JOIN promociones on integracion.idPromocion = promociones.idpromocion
WHERE promociones.`status` = 1
GROUP BY idIntegrante"));

if($confirm>0){
    $qTomarId = mysqli_query($enlace,"SELECT idIntegrante from integracion 
INNER JOIN promociones on integracion.idPromocion = promociones.idpromocion
WHERE promociones.`status` = 1
GROUP BY idIntegrante");



    $contador=4;
    $contador2=1;
    while ($dTomarId= mysqli_fetch_array($qTomarId,MYSQLI_ASSOC)){
        $idIntegrante = $dTomarId["idIntegrante"];
        $qConsultarNombre =mysqli_query($enlace,"select integrantes.num_identidad,integrantes.promo_cordero,integrantes.nombre_integrante,integrantes.cel,integrantes.tel,
integrantes.estado_civil,integrantes.sexo,integrantes.trasporte,integrantes.direccion,integrantes.fecha_cumple,
integrantes.areas,integrantes.correlativo,detalle_integrantes.`status`
from integrantes 
INNER JOIN detalle_integrantes ON integrantes.idintegrante = detalle_integrantes.id_integrante where idintegrante = $idIntegrante ");
        $datos= mysqli_fetch_array($qConsultarNombre,MYSQLI_ASSOC);
        $fecha= $datos["fecha_cumple"];
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

        if($datos["status"]==1){
            $estado ="ACTIVO";
        }else{
            if($datos["status"]==3){
                $estado= "INACTIVO";
            }else{
                if($datos["status"]==2){
                    $estado="RETIRADO";
                }
            }
        }


        $objPHPExcel->getActiveSheet()->getCell("B$contador")->setValueExplicit($datos["num_identidad"], PHPExcel_Cell_DataType::TYPE_STRING);

        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue("A$contador", $datos["promo_cordero"])
            ->setCellValue("C$contador",utf8_encode($datos["nombre_integrante"]))
            ->setCellValue("D$contador",$datos["cel"] )
            ->setCellValue("E$contador",$datos["tel"]  )
            ->setCellValue("F$contador",$datos["estado_civil"])
            ->setCellValue("G$contador",$datos["sexo"]  )
            ->setCellValue("H$contador",$datos["trasporte"] )
            ->setCellValue("I$contador",$datos["direccion"])
            ->setCellValue("J$contador",$fCompleta)
            ->setCellValue("K$contador",$datos["areas"] )
            ->setCellValue("L$contador",$datos["correlativo"] )
            ->setCellValue("M$contador",$estado );
        $qContarAsistencias = mysqli_query($enlace,"SELECT areas.Nombre from integracion
INNER JOIN areas ON integracion.idArea = areas.idArea
where integracion.idIntegrante = $idIntegrante");
        $celda = 13;
        while ($dContarAsistencias = mysqli_fetch_array($qContarAsistencias,MYSQLI_ASSOC)){

            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValueByColumnAndRow($celda,$contador,$dContarAsistencias["Nombre"]);
            $celda++;
        }
        $contador++;
        $contador2++;

    }


    $noIntegradosQuery = mysqli_query($enlace,"Select integrantes.num_identidad, integrantes.promo_cordero,integrantes.nombre_integrante,integrantes.cel,integrantes.tel,
integrantes.estado_civil,integrantes.sexo,integrantes.trasporte,integrantes.direccion,integrantes.fecha_cumple,
integrantes.areas,integrantes.correlativo,detalle_integrantes.`status` from integrantes 
INNER JOIN detalle_integrantes ON integrantes.idintegrante = detalle_integrantes.id_integrante
INNER JOIN promociones ON promociones.idpromocion = detalle_integrantes.id_promocion
WHERE promociones.`status`=1 AND detalle_integrantes.id_cargo=10 AND not exists
 (select idintegrante from integracion where integracion.idIntegrante= integrantes.idintegrante)");

    while ($datosNoInt= mysqli_fetch_array($noIntegradosQuery,MYSQLI_ASSOC)){
        $fecha2= $datosNoInt["fecha_cumple"];
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


        $fCompleta2 = $dia."-".$miMes."-".$aaa;
        //FIN FUNCION CONVERTIR FECHAS

        if($datosNoInt["status"]==1){
            $estado ="ACTIVO";
        }else{
            if($datosNoInt["status"]==3){
                $estado= "INACTIVO";
            }else{
                if($datosNoInt["status"]==2){
                    $estado="RETIRADO";
                }
            }
        }

        $objPHPExcel->getActiveSheet()->getCell("B$contador")->setValueExplicit($datosNoInt["num_identidad"], PHPExcel_Cell_DataType::TYPE_STRING);

        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue("A$contador", $datosNoInt["promo_cordero"])
            ->setCellValue("C$contador", $datosNoInt["nombre_integrante"])
            ->setCellValue("D$contador",$datosNoInt["cel"] )
            ->setCellValue("E$contador", $datosNoInt["tel"])
            ->setCellValue("F$contador",$datosNoInt["estado_civil"])
            ->setCellValue("G$contador",$datosNoInt["sexo"]  )
            ->setCellValue("H$contador",$datosNoInt["trasporte"] )
            ->setCellValue("I$contador",$datosNoInt["direccion"])
            ->setCellValue("J$contador",$fCompleta2)
            ->setCellValue("K$contador",$datosNoInt["areas"] )
            ->setCellValue("L$contador",$datosNoInt["correlativo"] )
            ->setCellValue("M$contador",$estado );

        $contador++;
    }






//FIN DATOS
}else{
    $objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue("A4", "NO EXISTEN DATOS AUN");
}




$objPHPExcel->getActiveSheet()->setTitle('LISTADO DE EQUIPO');
$objPHPExcel->setActiveSheetIndex(0);

getHeders();
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
?>