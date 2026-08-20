<?php

include("../lib/funciones.php");

//--------------------------------Inicio de sesion------------------------

include("../lib/sesion.php"); 

if ($_SESSION['permiso'] != 'autorizado' ){

	$mensaje="Usuario sin permisos";

	$destino="../acceso/index.php";

	header("location:mensaje_ok.php?mensaje=$mensaje&destino=$destino");

}




//--------------------------------Fin inicio de sesion------------------------



//------files--------------------------------------------------------------------

$file_name=$_POST['txt_archivo'];




//Archivo fisico en el servidor, si es el 7 lo manda a cuestionario


$server_file = "../informacion/".$file_name; 


if(unlink($server_file)){


	$link=conectarse();	 

	$sql="delete from informacion where archivo='$file_name'";


					

	mysql_query($sql,$link); 

							

	header('Location: subir_datos.php');


}

else

{

	header('Location: subir_datos.php');

}

			



//------Fin files--------------------------------------------------------------------


?>