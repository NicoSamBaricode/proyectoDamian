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

$respuesta_1=$_POST['txt_1'];
$respuesta_2=$_POST['txt_2'];
$respuesta_3=$_POST['txt_3'];
$respuesta_4=$_POST['txt_4'];
$respuesta_5=$_POST['txt_5'];
$respuesta_6=$_POST['txt_6'];
$respuesta_7=$_POST['txt_7'];
$respuesta_8=$_POST['txt_8'];
$respuesta_9=$_POST['txt_9'];
$respuesta_10=$_POST['txt_10'];





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


->setCellValue('A20', $respuesta_1)
->setCellValue('A25', $respuesta_2)
->setCellValue('A30', $respuesta_3)
->setCellValue('A35', $respuesta_4)
->setCellValue('A40', $respuesta_5)
->setCellValue('A45', $respuesta_6)
->setCellValue('A50', $respuesta_7)
->setCellValue('A55', $respuesta_8)
->setCellValue('A60', $respuesta_9)
->setCellValue('A65', $respuesta_10);
// Renombrar Hoja
$objPHPExcel->getActiveSheet()->setTitle('Tecnologia Simple');

//-------Generador Excel--------------------------------
// esto le indica al navegador que muestre el diálogo de descarga aún sin haber descargado todo el contenido
 
//header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        //header('Content-Disposition: attachment;filename="archivo.xls"');
       // header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007'); 
        //$objWriter->save("../../decisiones/prueba_nueva.xlsx");
		
		$objWriter->save("../../datos_sapienter/autoformacion/".$nom_archivo.".xlsx");

//--------Fin Generador Excel----------------------------------


//--AUDITORIA DE LA CARGA---------------------------------------------------------------------------------------------------
$link=conectarse();	 

$sql="insert into cuestionarios (empresa,r1,r2,r3,r4,r5,r6,r7,r8,r9,r10) values('$usuario','$respuesta_1','$respuesta_2','$respuesta_3','$respuesta_4','$respuesta_5','$respuesta_6','$respuesta_7','$respuesta_8','$respuesta_9','$respuesta_10')";

mysql_query($sql,$link);

$mensaje="LAS DECISIONES FUERON CARGADAS CORRECTAMENTE";
$destino="menu_principal.php";

include("../includes/mensaje_include.php");


//---------------------------------------------------------------------------------------------------------------------------


?>
