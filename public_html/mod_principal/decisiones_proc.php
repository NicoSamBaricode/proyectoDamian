<?php 
include("../lib/funciones.php");

require_once ('../lib/excell/PHPExcel.php');


//--------------------------------Inicio de sesion------------------------
include("../lib/sesion.php"); 
if ($_SESSION['permiso'] != 'autorizado' ){
	$mensaje="Usuario sin permisos";
	$destino="../acceso/index.php";
	header("location:mensaje_ok.php?mensaje=$mensaje&destino=$destino");
}


$usuario=$_SESSION['id'];

$empresa=$_SESSION['abreviatura'];

$ejercicio=$_SESSION['ejercicio'];

$nom_archivo=$_SESSION['nom_archivo'];
//--------------------------------Fin inicio de sesion------------------------	 

$precio_venta=$_POST['txt_precio_venta'];
$unidades=$_POST['txt_unidades'];
$gastos_comer=$_POST['txt_gastos_comer'];
$compra_bienes=$_POST['txt_compra_bienes'];
$innovacion=$_POST['txt_innovacion'];
$sustentabilidad=$_POST['txt_sustentabilidad'];




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

->setCellValue('A1', 'Precio de venta')
->setCellValue('A2', 'Unidades a producir')
->setCellValue('A3', 'Gastos de comercializacion')
->setCellValue('A4', 'Compra de bienes de uso')
->setCellValue('A5', 'Desarrollo del talento humano')
->setCellValue('A6', 'Innovación y Sustentabilidad')
->setCellValue('B1', $precio_venta)
->setCellValue('B2', $unidades)
->setCellValue('B3', $gastos_comer)
->setCellValue('B4', $compra_bienes)
->setCellValue('B5', $innovacion)
->setCellValue('B6', $sustentabilidad);
// Renombrar Hoja
$objPHPExcel->getActiveSheet()->setTitle('Tecnologia Simple');

//-------Generador Excel--------------------------------
// esto le indica al navegador que muestre el diálogo de descarga aún sin haber descargado todo el contenido
 
//header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        //header('Content-Disposition: attachment;filename="archivo.xls"');
       // header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007'); 
        //$objWriter->save("../../decisiones/prueba_nueva.xlsx");
		
		$objWriter->save("../../datos_sapienter/".$ejercicio."/".$nom_archivo.".xlsx");

//--------Fin Generador Excel----------------------------------


//--AUDITORIA DE LA CARGA---------------------------------------------------------------------------------------------------
$link=conectarse();	 

$sql="insert into decisiones (empresa,ejercicio,precio_de_venta,unidades_a_producir,gastos_de_comercializacion,compra_bienes_de_uso,innovacion_desarrollo,sustentabilidad) values('$usuario','$ejercicio','$precio_venta','$unidades','$gastos_comer','$compra_bienes','$innovacion','$sustentabilidad')";
mysql_query($sql,$link); 

$mensaje="LAS DECISIONES FUERON CARGADAS CORRECTAMENTE";
$destino="menu_principal.php";

include("../includes/mensaje_include.php");


//---------------------------------------------------------------------------------------------------------------------------


?>
