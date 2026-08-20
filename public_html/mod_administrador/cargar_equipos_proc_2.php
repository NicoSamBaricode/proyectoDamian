<?php 
echo"-------------------------------- <br>";
echo"PROCESANDO <br>";
echo"--------------------------------";
include("../lib/funciones.php");

//require_once ('../lib/excell/PHPExcel.php');
include '../lib/excell/PHPExcel/IOFactory.php';
$link=conectarse();
mysql_set_charset('utf8',$link);

$XLFileType = PHPExcel_IOFactory::identify('Empresas.xls');  
$objReader = PHPExcel_IOFactory::createReader($XLFileType);  
$objReader->setLoadSheetsOnly('Empresas');  
$objPHPExcel = $objReader->load('Empresas.xls');  

//Aqui viene lo que te interesa 

$objWorksheet = $objPHPExcel->setActiveSheetIndexByName('Empresas');  

//LIMPIO LA TABLA
$sql_truncate="truncate usuarios_simu_2018";
mysql_query($sql_truncate,$link);

$fila=2;
while($fila <= 383){

	$nombre=$objPHPExcel->getActiveSheet()->getCell('B'.$fila)->getFormattedValue();
	$zona=$objPHPExcel->getActiveSheet()->getCell('C'.$fila)->getFormattedValue();
	$nom_archivo=$objPHPExcel->getActiveSheet()->getCell('D'.$fila)->getFormattedValue();
	$ciudad=$objPHPExcel->getActiveSheet()->getCell('E'.$fila)->getFormattedValue();
	$provincia=$objPHPExcel->getActiveSheet()->getCell('F'.$fila)->getFormattedValue();
	$us=$objPHPExcel->getActiveSheet()->getCell('G'.$fila)->getFormattedValue();
	$pas=$objPHPExcel->getActiveSheet()->getCell('H'.$fila)->getFormattedValue();
	$privilegio='2'; //cual es el rol empresa o profe
	$registrado='0'; //se cargan en 0 y pasan a 1 cuando se activan con el primer ingreso
	$profesor='11';
	$profesor_txt=$objPHPExcel->getActiveSheet()->getCell('A'.$fila)->getFormattedValue();
	$activo='1';
	
	
	$sql="insert into usuarios_simu_2018 (id_empresa,nombre,zona,nom_archivo,ciudad,provincia,us,pas,privilegio,registrado,profesor,profesor_txt,activo) values('$fila','$nombre','$zona','$nom_archivo','$ciudad','$provincia','$us','$pas','$privilegio','$registrado','$profesor','$profesor_txt','$activo')";
	mysql_query($sql,$link);
	//echo $objPHPExcel->getActiveSheet()->getCell('A'.$fila)->getFormattedValue()."<br>"; 
	
	$fila=$fila+1;
}

echo"-------------------------------- <br>";
echo"PROCESO FINALIZADO <br>";
echo"--------------------------------";
?>
