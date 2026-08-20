<?php
include("../lib/funciones.php");



	

	
	if (!isset($_POST['id_empresa']) || ($_POST['id_empresa']<=0))	{
		
		$sql_type="Insert";
	}
	else{
		$id_empresa=$_POST['id_empresa'];
		$sql_type="Update";
	}
	 
	 

$nombre=$_POST['txt_nombre_fantasia'];
$ciudad=$_POST['txt_ciudad'];
$provincia=$_POST['txt_provincia'];
$nom_archivo=$_POST['txt_nom_archivo'];
$zona=$_POST['txt_zona'];
$usuario=$_POST['txt_usuario'];
$clave=$_POST['txt_clave'];
$tipo_jugador=$_POST['tipo_jugador'];
	
	 

//-----Inserta o actualiza----------------------------------------------------- 

$link=conectarse();	 

	if ($sql_type=="Insert") {
		$sql="insert into usuarios_simu (nombre,nom_archivo,ciudad,provincia,zona,privilegio,us,pas,tipo_jugador)
			values('$nombre','$nom_archivo','$ciudad','$provincia','$zona','2','$usuario','$clave','$tipo_jugador')";
	}
		else
	{
		$sql="update usuarios_simu set 
			nombre='$nombre',
			nom_archivo='$nom_archivo',
			ciudad='$ciudad',
			provincia='$provincia',
			zona='$zona',
			us='$usuario',
			pas='$clave',
			tipo_jugador='$tipo_jugador'
			where id_empresa=$id_empresa";
	}
	//echo $sql;	
	mysql_query($sql,$link); 
	
	if ($sql_type=="Insert") {
		$identificador=mysql_insert_id();
	}
	else
	{
		$identificador=$id_empresa;
	}
	
//-----Fin inserta o actualiza----------------------------------------------------- 	


	
	header('Location:empresa_alta.php?id_empresa='.$identificador.'&control=1');  


?>