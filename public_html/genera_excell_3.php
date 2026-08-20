<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<?php 
require_once ('lib/excell/PHPExcel.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);
$objPHPExcel = new PHPExcel();
// Establecer propiedades
$objPHPExcel->getProperties()
->setCreator("Cattivo")
->setLastModifiedBy("Cattivo")
->setTitle("Documento Excel de Prueba")
->setSubject("Documento Excel de Prueba")
->setDescription("Demostracion sobre como crear archivos de Excel desde PHP.")
->setKeywords("Excel Office 2007 openxml php")
->setCategory("Pruebas de Excel");

// Agregar Informacion
$objPHPExcel->setActiveSheetIndex(0)
->setCellValue('A1', 'Valor 1')
->setCellValue('B1', 'Valor 2')
->setCellValue('C1', 'Total')
->setCellValue('A2', '10')
->setCellValue('C2', '=sum(A2:B2)');
// Renombrar Hoja
$objPHPExcel->getActiveSheet()->setTitle('Tecnologia Simple');

// Establecer la hoja activa, para que cuando se abra el documento se muestre primero.
$objPHPExcel->setActiveSheetIndex(0);

// Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.

/*
header('Content-Type: application/vnd.ms-excel'); 
header('Content-Disposition: attachment;filename="pruebaReal.xlsx"'); 
header('Cache-Control: max-age=0'); */

//-------Generador Excel--------------------------------
// esto le indica al navegador que muestre el diálogo de descarga aún sin haber descargado todo el contenido
 
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="archivo.xls"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007'); 
        $objWriter->save("archivo.xls");
//--------Fin Generador Excel----------------------------------


?>
