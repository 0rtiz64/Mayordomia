<?php
/**
 * PHPExcel
 *
 * Copyright (C) 2006 - 2014 PHPExcel
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @category   PHPExcel
 * @package    PHPExcel
 * @copyright  Copyright (c) 2006 - 2014 PHPExcel (http://www.codeplex.com/PHPExcel)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt	LGPL
 * @version    1.8.0, 2014-03-02
 */

$cuerpo = $_POST['hola'];
$cuerpos = explode(",", $cuerpo);
$cabeceras = $_POST["cb"];
$porciones = explode(",", $cabeceras);
$array = array( "0" => "A", "1" => "B", "2" => "C",   "3" => "D", "4" => "E", "5" => "F", "6" => "G","7" => "H","8" => "I","9" => "J",
                               "10" => "K", "11" => "L","12" => "M","13" => "N","14" => "O","15" => "P","16" => "Q","17" => "R","18" => "S",
                               "19" => "T","20" => "U","21" => "V","22" => "W","23" => "X","24" => "Y","25" => "Z",);
$N =0;
$S =1;
$encabezados = count($porciones);
// variables del cuerpo de la tabla  
$letra = 0;
$numero = 2;
$centinela = 0;
/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/London');

if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');

/** Include PHPExcel */
require_once dirname(__FILE__) . '/../Classes/PHPExcel.php';


// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("Denny Molina")
							 ->setLastModifiedBy("Denny Molina")
							 ->setTitle("Office 2007 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");



	# code...

// Add some data
for ($i=0; $i < $encabezados; $i++) { 
      # code...

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue($array[$i]."1", $porciones[$N]);
  $N++;
  $S++;          
}
// Miscellaneous glyphs, UTF-8
while ($centinela < count($cuerpos)) {
	# code...

		for ($e=0; $e < $encabezados; $e++) { 
			# code...
			$letraNumero = "".$array[$e]."".$numero;
		$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue($letraNumero, $cuerpos[$centinela]);
            $centinela++;            
} //for
//$centinela = $centinela + 1;
$numero++;
} //while


// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Simple');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="01simple.xls"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
