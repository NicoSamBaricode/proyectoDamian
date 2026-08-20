<?php
include("../lib/funciones.php");
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




//------files--------------------------------------------------------------------
$file_name= $_FILES['file']['name'];
$file= $_FILES['file']['tmp_name'];

if (($file != "none")&&(extension_valida($file_name)==true)){
	
	
	//---Parametros de conexion FTP_----------------------
	$ftp_server = "ftpp.sapienter.org";
	$ftp_user = "simubari17";
	$ftp_pass = "S@n1903!";
	//----------------------------------------------------			
				
				
	// establecer una conexión o finalizarla
	$conn_id = ftp_connect($ftp_server) or die("No se pudo conectar a $ftp_server"); 
				
	// intentar iniciar sesión
	@ftp_login($conn_id, $ftp_user, $ftp_pass);
					
	//Archivo fisico en el servidor
	$server_file = "../../sistem/".$ejercicio."/".$nom_archivo.".xls"; 
	
			
	if(ftp_put($conn_id, $server_file, $file, FTP_BINARY)){
	
		$link=conectarse();	 
		$sql="insert into participante_archivo (id_participante,ejercicio,archivo)
		values('$usuario','$ejercicio','$file_name')";
					
		mysql_query($sql,$link); 
							
		$mensaje="Las decisiones fueron subidas correctamente. <br> ";
								
		//$destino="menu_principal.php";
		$destino="../lib/pdf/recibo.php";
		include("../includes/mensaje_recibo.php");
						
	}
	else
	{
		$mensaje="Error interno del sistema, realice nuevamente el proceso de subida de las decisiones. <br> ";
								
		$destino="menu_principal.php";
		include("../includes/mensaje.php");
	}
			
}
else
{
			$mensaje="El archivo no fue subido correctamente, verifique que sea un archivo de Excel. <br> ";
				
			$destino="menu_principal.php";
			include("../includes/mensaje.php");
}
//------Fin files--------------------------------------------------------------------





	
	


?>