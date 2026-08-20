<?php



include("../lib/funciones.php");



//--------------------------------Inicio de sesion------------------------



include("../lib/sesion.php"); 



if ($_SESSION['permiso'] != 'autorizado' ){



	$mensaje="Usuario sin permisos";



	$destino="../acceso/index.php";



	header("location:mensaje_ok.php?mensaje=$mensaje&destino=$destino");



}



$titulo=$_POST['txt_titulo'];





//--------------------------------Fin inicio de sesion------------------------





//------files--------------------------------------------------------------------



$file_name= $_FILES['file']['name'];



$file= $_FILES['file']['tmp_name'];





//Archivo fisico en el servidor, si es el 7 lo manda a cuestionario





$server_file = "../informacion/".$file_name; 



//if(ftp_put($conn_id,$server_file,$file,FTP_BINARY)){

if(move_uploaded_file ($file,$server_file)){

	



	$link=conectarse();	 



	$sql="insert into informacion (titulo,archivo)

	values('$titulo','$file_name')";

	

	mysql_query($sql,$link); 



	header('Location: subir_datos.php');



}



else



{



	header('Location: subir_datos.php');



}





//------Fin files--------------------------------------------------------------------





?>