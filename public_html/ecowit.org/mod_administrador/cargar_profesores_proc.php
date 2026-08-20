<?php 
include("../lib/funciones.php");

//require_once ('../lib/excell/PHPExcel.php');
include '../lib/excell/PHPExcel/IOFactory.php';
$link=conectarse();
mysql_set_charset('utf8',$link);

$XLFileType = PHPExcel_IOFactory::identify('../../empresas_y_profesores/Profesores.xls');  
$objReader = PHPExcel_IOFactory::createReader($XLFileType);  
$objReader->setLoadSheetsOnly('Profesores');  
$objPHPExcel = $objReader->load('../../empresas_y_profesores/Profesores.xls');  

//Aqui viene lo que te interesa 

$objWorksheet = $objPHPExcel->setActiveSheetIndexByName('Profesores');  


//--CARGA DE PROFESORES------------------
$fila=2;
while($fila <= 1000){

	$nombre=$objPHPExcel->getActiveSheet()->getCell('A'.$fila)->getFormattedValue();
	
	$us=$objPHPExcel->getActiveSheet()->getCell('B'.$fila)->getFormattedValue();
	$pas=$objPHPExcel->getActiveSheet()->getCell('C'.$fila)->getFormattedValue();
	$privilegio='3'; //cual es el rol empresa o profe
	$registrado='1'; //se cargan en 0 y pasan a 1 cuando se activan con el primer ingreso
	$activo='1';
	
	$sql_existe="select nombre from usuarios_simu where nombre='$nombre'";
	$existe=mysql_num_rows(mysql_query($sql_existe,$link));
	
	$sql_max_id="select max(id_empresa) as ultimo from usuarios_simu";
	$ultimo=mysql_result(mysql_query($sql_max_id,$link),0,"ultimo");
	$id_empresa=$ultimo + 1;
	
	if($existe < 1){
	$sql="insert into usuarios_simu (id_empresa,nombre,us,pas,privilegio,registrado,activo) values('$id_empresa','$nombre','$us','$pas','$privilegio','$registrado','$activo')";
	mysql_query($sql,$link);
	}
	
	$fila=$fila+1;
}
//--FIN DE LA CARGA DE PROFESORES

//--INICIO DE VINCULACION-------
$sql_empresas="select id_empresa,nombre,profesor_txt from usuarios_simu where privilegio='2' and profesor is null";
$record_empresas=mysql_query($sql_empresas,$link);

while($empresa=mysql_fetch_array($record_empresas)){
	$nombre_profesor=$empresa["profesor_txt"];
	$id_empresa=$empresa["id_empresa"];
	
	$sql_profesor="select id_empresa,nombre from usuarios_simu where nombre='$nombre_profesor'";
	$id_profesor=mysql_result(mysql_query($sql_profesor,$link),0,"id_empresa");
	
	if($id_profesor>0){
		$sql_set_profesor="update usuarios_simu set profesor='$id_profesor' where id_empresa='$id_empresa' and profesor is null";
		mysql_query($sql_set_profesor,$link);
	}
}

$mensaje="LOS PROFESORES FUERON CARGADOS CORRECTAMENTE";
$destino="menu_principal_admin.php";

include("../includes/mensaje_include.php");
?>
