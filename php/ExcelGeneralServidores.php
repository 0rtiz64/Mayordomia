<?php

/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 27/8/2019
 * Time: 11:12 AM
 */


require_once 'EXCELfunciones.php';
include '../gold/enlace.php';



activeErrorReporting();

noCli();

require_once '../phpExcel/Classes/PHPExcel.php';
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
    ->setCellValue('B1', 'LISTADO GENERAL DE SERVIDORES')
    ->setCellValue('C1', '');


//DATOS


$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A3', '#')
    ->setCellValue('B3', 'IDENTIDAD')
    ->setCellValue('C3', 'NOMBRE COMPLETO')
    ->setCellValue('D3', 'GENERO')
    ->setCellValue('E3', 'FECHA NACIMIENTO')
    ->setCellValue('F3', 'TIPO DE SANGRE')

    ->setCellValue('G3', 'DIRECCION')
    ->setCellValue('H3', 'REFERENCIA')
    ->setCellValue('I3', 'TIPO CASA')
    ->setCellValue('J3', 'TRANSPORTE')
    ->setCellValue('K3', 'TELEFONO 1')
    ->setCellValue('L3', 'TELEFONO 2')
    ->setCellValue('M3', 'CORREO')
    ->setCellValue('N3', 'ESTADO CIVIL')
    ->setCellValue('O3', 'CONYUGUE')
    ->setCellValue('P3', 'HIJOS')

    ->setCellValue('Q3', 'FECHA CONVERSION')
    ->setCellValue('R3', 'FECHA EN IGLESIA')
    ->setCellValue('S3', 'FECHA EN BAUTISMO E.S')
    ->setCellValue('T3', 'FECHA RECONCILIACION')
    ->setCellValue('V3', 'FECHA BAUTISMO AGUAS')
    //->setCellValue('U', 'FECHA COBERTURA')
    ->setCellValue('W3', 'PROM. CORDERITOS')
    ->setCellValue('X3', 'AREAS')
    ->setCellValue('Y3', 'PROM. MAYORDOMIA')
    ->setCellValue('Z3', 'EXPEDIENTE MAYORDOMIA')

    ->setCellValue('AA3', 'NIVEL EDUCATIVO')
    ->setCellValue('AB3', 'PROFESION U OFICIO')
    ->setCellValue('AC3', 'HABILIDADES')

    ->setCellValue('AD3', 'ESTADO LABORAL')
    ->setCellValue('AE3', 'EMPRESA')
    ->setCellValue('AF3', 'PUESTO')
    ->setCellValue('AG3', 'TELEFONO EMPRESA')
    ->setCellValue('AH3', 'HORARIO')

    ->setCellValue('AI3', 'CARNET')
    ->setCellValue('AJ3', 'FECHA VIGENCIA')
    ->setCellValue('AK3', 'FECHA GESTION')
    ->setCellValue('AL3', 'FECHA ENTREGA')
    ->setCellValue('AM3', 'NOMBRE EN CARNET')
    ->setCellValue('AN3', 'FECHA INICIO MAYORDOMIA')
    ->setCellValue('AO3', 'EQUIPO SERVICIO')
    ->setCellValue('AP3', 'CARGO')
    ->setCellValue('AQ3', 'ESTADO')
    ->setCellValue('AR3', 'OBSERVACIONES')
    ->setCellValue('AS3', 'REGISTRADO POR')
    ->setCellValue('AT3', 'CORRELATIVO');



$query = mysqli_query($enlace, "SELECT * from servidores 
GROUP BY servidores.nombre_integrante ASC");


$contador = 4;
$contador2 = 1;
while ($datosFinal = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
$idServidor = $datosFinal["idServidor"];
    $queryDatosEquipo= mysqli_query($enlace,"SELECT servicioequipos.nombreEquipo,serviciocargos.nombreCargo,serviciodetalle.estado from serviciodetalle
INNER JOIN servicioequipos on serviciodetalle.idServicioEquipo = servicioequipos.idEquipo
INNER JOIN serviciocargos on serviciodetalle.idServicioCargo = serviciocargos.idCargo
WHERE serviciodetalle.idServidor =  $idServidor");
    $datosEquipo = mysqli_fetch_array($queryDatosEquipo,MYSQLI_ASSOC);


    $objPHPExcel->getActiveSheet()->getCell("B$contador")->setValueExplicit($datosFinal["num_identidad"], PHPExcel_Cell_DataType::TYPE_STRING);

    //FECHA INICIO
    $fecha = $datosFinal["fecha_cumple"];

    $dia = substr($fecha, 8, 2);
    $mes = substr($fecha, 5, 2);
    $aaa = substr($fecha, 0, 4);

    switch ($mes) {
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


    $fCompleta = $dia . "-" . $miMes . "-" . $aaa;
    //FECHA FINAL


    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue("A$contador", $contador2)
        ->setCellValue("C$contador", utf8_encode($datosFinal["nombre_integrante"]))
        ->setCellValue("D$contador", $datosFinal["sexo"])
        ->setCellValue("E$contador", $fCompleta)
        ->setCellValue("F$contador", $datosFinal["tipoSangre"])

        ->setCellValue("G$contador", $datosFinal["direccion"])
        ->setCellValue("H$contador", $datosFinal["referencia"])
        ->setCellValue("I$contador", $datosFinal["tipoCasa"])
        ->setCellValue("J$contador", $datosFinal["trasporte"])
        ->setCellValue("K$contador", $datosFinal["cel"])
        ->setCellValue("L$contador", $datosFinal["tel"])
        ->setCellValue("M$contador", $datosFinal["correo"])
        ->setCellValue("N$contador", $datosFinal["estado_civil"])
        ->setCellValue("O$contador", $datosFinal["conyugue"])
        ->setCellValue("P$contador", $datosFinal["hijos"])

        ->setCellValue("Q$contador", $datosFinal["f_conversion"])
        ->setCellValue("R$contador", $datosFinal["f_iglesia"])
        ->setCellValue("S$contador", $datosFinal["bautismoEs"])
        ->setCellValue("T$contador", $datosFinal["f_reconciliacion"])
        ->setCellValue("V$contador", $datosFinal["f_bautismoAguas"])
        //->setCellValue("U$contador", $datosFinal["f_cobertura"])
        ->setCellValue("W$contador", $datosFinal["promo_cordero"])
        ->setCellValue("X$contador", $datosFinal["areas"])
        ->setCellValue("Y$contador", $datosFinal["promMayordomia"])
        ->setCellValue("Z$contador", $datosFinal["expedienteMayordomia"])

        ->setCellValue("AA$contador", $datosFinal["nivelEducativo"])
        ->setCellValue("AB$contador", $datosFinal["profesion"])
        ->setCellValue("AC$contador", $datosFinal["habilidades"])

        ->setCellValue("AD$contador", $datosFinal["estadoLaboral"])
        ->setCellValue("AE$contador", $datosFinal["empresa"])
        ->setCellValue("AF$contador", $datosFinal["puesto"])
        ->setCellValue("AG$contador", $datosFinal["telEmpresa"])
        ->setCellValue("AH$contador", $datosFinal["horario"])

        ->setCellValue("AI$contador", $datosFinal["carnet"])
        ->setCellValue("AJ$contador", $datosFinal["vigencia"])
        ->setCellValue("AK$contador", $datosFinal["f_gestion"])
        ->setCellValue("AL$contador", $datosFinal["f_entrega"])
        ->setCellValue("AM$contador", $datosFinal["nombreCarnet"])
        ->setCellValue("AN$contador", $datosFinal["f_inicioMayordomia"])
        ->setCellValue("AO$contador", $datosEquipo["nombreEquipo"])
        ->setCellValue("AP$contador", $datosEquipo["nombreCargo"])
        ->setCellValue("AQ$contador", $datosEquipo["estado"])
        ->setCellValue("AR$contador", $datosFinal["observaciones"])
        ->setCellValue("AS$contador", $datosFinal["registradoPor"])
        ->setCellValue("AT$contador", $datosFinal["correlativo"]);
    $contador++;
    $contador2++;
}


//FIN DATOS


$objPHPExcel->getActiveSheet()->setTitle('LISTADO GENERAL DE SERVIDORES');
$objPHPExcel->setActiveSheetIndex(0);

getHeders();
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
