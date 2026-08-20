<?php

//--------------------------------Inicio de sesion------------------------
include("../lib/sesion.php"); 
if ($_SESSION['permiso'] != 'autorizado' ){
	$mensaje="Usuario sin permisos";
	$destino="../acceso/index.php";
	header("location:mensaje_ok.php?mensaje=$mensaje&destino=$destino");
}
$usuario=$_SESSION['id'];
$empresa=$_SESSION['nombre'];
//$ejercicio=$_SESSION['ejercicio'];
$ejercicio=$_GET["idi"];
$zona=$_SESSION['zona'];
//--------------------------------Fin inicio de sesion------------------------



error_reporting(E_ERROR);


//Copia por FTP de resultados fuera del www al actual directorio y lo descarga

$archivo = "InformeMercado_Z".$zona."_E".$ejercicio.".doc";


                     
$ftp_server = "ftp.sapienter.org";
$ftp_user = "simubari17";
$ftp_pass = "S@n1903!";

// establecer una conexión o finalizarla
$conn_id = ftp_connect($ftp_server) or die("No se pudo conectar a $ftp_server"); 

// intentar iniciar sesión
@ftp_login($conn_id, $ftp_user, $ftp_pass);
    
// definir algunas variables

$server_file = "../../datos_sapienter/resultados/".$archivo;


// intenta descargar $server_file y guardarlo en $local_file
if(ftp_get($conn_id, $archivo, $server_file,FTP_BINARY)){

	if (file_exists($archivo)) {
    	header('Content-Description: File Transfer');
    	header('Content-Type: application/octet-stream');
    	header('Content-Disposition: attachment; filename='.basename($archivo));
    	header('Expires: 0');
    	header('Cache-Control: must-revalidate');
    	header('Pragma: public');
    	header('Content-Length: ' . filesize($archivo));
    	ob_clean();
    	flush();
    	readfile($archivo);
		@unlink($archivo);//---Borra del servidor
    	exit;
	}
		
}else
{
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../css/estilos.css" rel="stylesheet" type="text/css" />
</head>

<?php
echo "El informe aun no esta disponible.<br>";
echo "<a href='menu_principal.php' class='enlace_opcion'>Volver al menú principal >></a>";

}

// cerrar la conexión ftp    
 

ftp_close($conn_id); 




?>

