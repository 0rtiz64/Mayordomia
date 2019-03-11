<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 5/3/2019
 * Time: 10:02 AM
 */



require_once 'EXCELfunciones.php';
include '../gold/enlace.php';
$equipo = $_GET['equipo'];


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


$queryNombreEquipo = mysqli_query($enlace,"SELECT * FROM equipos where id_equipo = $equipo");
$datosEquipo = mysqli_fetch_array($queryNombreEquipo,MYSQLI_ASSOC);


$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A1', '')
    ->setCellValue('B1', $datosEquipo["num_equipo"].'-'.$datosEquipo["nombre_equipo"])
    ->setCellValue('C1', '');




//DATOS





$querySeleccionarFechasParaTitulo = mysqli_query($enlace,"SELECT * from clases 
INNER JOIN promociones on clases.idPromocion = promociones.idpromocion
where promociones.`status`= 1");
$datosFechasParaTitulo= mysqli_fetch_array($querySeleccionarFechasParaTitulo,MYSQLI_ASSOC);
$objPHPExcel->setActiveSheetIndex(0)

    ->setCellValue('A3', '#')
    ->setCellValue('B3', 'NOMBRE')
    ->setCellValue('C3', convertirFechas($datosFechasParaTitulo["f1"]))
    ->setCellValue('D3', convertirFechas($datosFechasParaTitulo["f2"]))
    ->setCellValue('E3', convertirFechas($datosFechasParaTitulo["f3"]))
    ->setCellValue('F3', convertirFechas($datosFechasParaTitulo["f4"]))
    ->setCellValue('G3', convertirFechas($datosFechasParaTitulo["f5"]))
    ->setCellValue('H3', convertirFechas($datosFechasParaTitulo["f6"]))
    ->setCellValue('I3', convertirFechas($datosFechasParaTitulo["f7"]))
    ->setCellValue('J3', convertirFechas($datosFechasParaTitulo["f8"]));


$celda =4;

$queryIntegrantes = mysqli_query($enlace,"SELECT integrantes.idintegrante,integrantes.nombre_integrante from detalle_integrantes
INNER JOIN integrantes on detalle_integrantes.id_integrante = integrantes.idintegrante
WHERE detalle_integrantes.id_equipo = $equipo and detalle_integrantes.id_cargo = 10 GROUP BY integrantes.nombre_integrante ASC");
$c =1;

while($datosIntegrantes = mysqli_fetch_array($queryIntegrantes,MYSQLI_ASSOC)){

    $querySeleccionarFechasDeBusqueda = mysqli_query($enlace,"SELECT clases.f1,clases.f2,clases.f3,clases.f4,clases.f5,clases.f6,clases.f7,clases.f8 from clases 
INNER JOIN promociones on clases.idPromocion = promociones.idpromocion
WHERE promociones.`status`=1");
    $datosFechasBusqueda = mysqli_fetch_array($querySeleccionarFechasDeBusqueda,MYSQLI_ASSOC);

    $idIntegrante= $datosIntegrantes["idintegrante"];
    $fecha1 = $datosFechasBusqueda["f1"];
    $fecha2 = $datosFechasBusqueda["f2"];
    $fecha3 = $datosFechasBusqueda["f3"];
    $fecha4 = $datosFechasBusqueda["f4"];
    $fecha5 = $datosFechasBusqueda["f5"];
    $fecha6 = $datosFechasBusqueda["f6"];
    $fecha7 = $datosFechasBusqueda["f7"];
    $fecha8 = $datosFechasBusqueda["f8"];

    //FECHA 1 INICIO
    $queryF1 = mysqli_num_rows(mysqli_query($enlace,"SELECT * from marcacionprovicional WHERE
idIntegrante = $idIntegrante and CAST(fechaMarcacion AS DATE) = '".$fecha1."' "));
    if($queryF1 >0){
        $resF1 = 'SI';
    }else{
        $resF1='NO';
    }
    //FECHA 1 FINAL


    //FECHA 2 INICIO
    $queryF2 = mysqli_num_rows(mysqli_query($enlace,"SELECT * from marcacionprovicional WHERE
idIntegrante = $idIntegrante and CAST(fechaMarcacion AS DATE) = '".$fecha2."' "));
    if($queryF2 >0){
        $resF2 = 'SI';
    }else{
        $resF2='NO';
    }
    //FECHA 2 FINAL


    //FECHA 2 INICIO
    $queryF3 = mysqli_num_rows(mysqli_query($enlace,"SELECT * from marcacionprovicional WHERE
idIntegrante = $idIntegrante and CAST(fechaMarcacion AS DATE) = '".$fecha3."' "));
    if($queryF3 >0){
        $resF3 = 'SI';
    }else{
        $resF3='NO';
    }
    //FECHA 3 FINAL

    //FECHA 4 INICIO
    $queryF4 = mysqli_num_rows(mysqli_query($enlace,"SELECT * from marcacionprovicional WHERE
idIntegrante = $idIntegrante and CAST(fechaMarcacion AS DATE) = '".$fecha4."' "));
    if($queryF4 >0){
        $resF4 = 'SI';
    }else{
        $resF4='NO';
    }
    //FECHA 4 FINAL

    //FECHA 5 INICIO
    $queryF5 = mysqli_num_rows(mysqli_query($enlace,"SELECT * from marcacionprovicional WHERE
idIntegrante = $idIntegrante and CAST(fechaMarcacion AS DATE) = '".$fecha5."' "));
    if($queryF5 >0){
        $resF5 = 'SI';
    }else{
        $resF5='NO';
    }
    //FECHA 5 FINAL

    //FECHA 6 INICIO
    $queryF6 = mysqli_num_rows(mysqli_query($enlace,"SELECT * from marcacionprovicional WHERE
idIntegrante = $idIntegrante and CAST(fechaMarcacion AS DATE) = '".$fecha6."' "));
    if($queryF6 >0){
        $resF6 = 'SI';
    }else{
        $resF6='NO';
    }
    //FECHA 6 FINAL

    //FECHA 7 INICIO
    $queryF7 = mysqli_num_rows(mysqli_query($enlace,"SELECT * from marcacionprovicional WHERE
idIntegrante = $idIntegrante and CAST(fechaMarcacion AS DATE) = '".$fecha7."' "));
    if($queryF7 >0){
        $resF7 = 'SI';
    }else{
        $resF7='NO';
    }
    //FECHA 7 FINAL

    //FECHA 8 INICIO
    $queryF8 = mysqli_num_rows(mysqli_query($enlace,"SELECT * from marcacionprovicional WHERE
idIntegrante = $idIntegrante and CAST(fechaMarcacion AS DATE) = '".$fecha8."' "));
    if($queryF8 >0){
        $resF8 = 'SI';
    }else{
        $resF8='NO';
    }
    //FECHA 8 FINAL


    $datosFechasParaTitulo= mysqli_fetch_array($querySeleccionarFechasParaTitulo,MYSQLI_ASSOC);
    $objPHPExcel->setActiveSheetIndex(0)

        ->setCellValue('A'.$celda, $c)
        ->setCellValue('B'.$celda, utf8_encode($datosIntegrantes["nombre_integrante"]))
        ->setCellValue('C'.$celda, $resF1)
        ->setCellValue('D'.$celda, $resF2)
        ->setCellValue('E'.$celda, $resF3)
        ->setCellValue('F'.$celda, $resF4)
        ->setCellValue('G'.$celda, $resF5)
        ->setCellValue('H'.$celda, $resF6)
        ->setCellValue('I'.$celda, $resF7)
        ->setCellValue('J'.$celda, $resF8);

    $c++;
    $celda++;
}

/*





    $objPHPExcel->getActiveSheet()->getCell("C$contador")->setValueExplicit($datosFinal["num_identidad"], PHPExcel_Cell_DataType::TYPE_STRING);

    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue("A$contador", $contador2)
        ->setCellValue("B$contador", $inte)
        ->setCellValue("D$contador", utf8_encode($datosFinal["nombre_integrante"]))
        ->setCellValue("E$contador",$datosFinal["correlativo"])
        ->setCellValue("F$contador",$fCompleta )
        ->setCellValue("G$contador",$datosFinal["estado_civil"] )
        ->setCellValue("H$contador",$datosFinal["sexo"] )
        ->setCellValue("I$contador",$datosFinal["cel"] )
        ->setCellValue("J$contador",$datosFinal["tel"] )
        ->setCellValue("K$contador",$datosFinal["promo_cordero"] )
        ->setCellValue("L$contador",$datosFinal["direccion"] )
        ->setCellValue("M$contador",$datosFinal["areas"] );
    $contador++;
    $contador2++;
}








//FIN DATOS

*/
function convertirFechas($fecha){
    //INICIO FUNCION CONVERTIR FECHAS

    $dia = substr($fecha,8,2);
    $mes = substr($fecha,5,2);
    $aaa = substr($fecha,0,4);
    $miMes ="";
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


  return  $fCompleta = $dia."-".$miMes."-".$aaa;
    //FIN FUNCION CONVERTIR FECHAS
}

$objPHPExcel->getActiveSheet()->setTitle('LISTADO DE INTEGRACION');
$objPHPExcel->setActiveSheetIndex(0);

getHeders();
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
?>