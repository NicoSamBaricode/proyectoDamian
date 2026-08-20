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
->setCellValue('C1', 'Damian')
->setCellValue('A2', '10')
->setCellValue('C2', '=sum(A2:B2)');
// Renombrar Hoja
$objPHPExcel->getActiveSheet()->setTitle('Tecnologia Simple');

//-------Generador Excel--------------------------------
// esto le indica al navegador que muestre el diálogo de descarga aún sin haber descargado todo el contenido
 
/*header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="archivo.xls"');
        header('Cache-Control: max-age=0');*/
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007'); 
        $objWriter->save("../decisiones/prueba_nueva.xlsx");

//--------Fin Generador Excel----------------------------------


?>
