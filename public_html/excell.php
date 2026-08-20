<?php
 
// Camino a los include
set_include_path(get_include_path() . PATH_SEPARATOR . '../Classes/');</p>
// PHPExcel
require_once 'PHPExcel.php';</p>
// PHPExcel_IOFactory
include 'PHPExcel/IOFactory.php';</p>
// Creamos un objeto PHPExcel
$objPHPExcel = new PHPExcel();</p>
// Leemos un archivo Excel 2007
$objReader = PHPExcel_IOFactory::createReader('Excel2007');
$objPHPExcel = $objReader->load("Archivo.xlsx");</p>
// Indicamos que se pare en la hoja uno del libro
$objPHPExcel->setActiveSheetIndex(0);</p>
//Escribimos en la hoja en la celda B1
$objPHPExcel->getActiveSheet()->SetCellValue('B2', 'Hola mundo');</p>
// Color rojo al texto
$objPHPExcel->getActiveSheet()->getStyle('B2')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_RED);
// Texto alineado a la derecha
$objPHPExcel->getActiveSheet()->getStyle('B2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
// Damos un borde a la celda
$objPHPExcel->getActiveSheet()->getStyle('B2')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
$objPHPExcel->getActiveSheet()->getStyle('B2')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
$objPHPExcel->getActiveSheet()->getStyle('B2')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);</p>
//Guardamos el archivo en formato Excel 2007
//Si queremos trabajar con Excel 2003, basta cambiar el 'Excel2007' por 'Excel5' y el nombre del archivo de salida cambiar su formato por '.xls'
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save("Archivo_salida.xlsx");

?>