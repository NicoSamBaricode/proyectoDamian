<?php

//--------------------------------Inicio de sesion------------------------
include("../lib/sesion.php"); 
if ($_SESSION['permiso'] != 'autorizado' ){
	$mensaje="Usuario sin permisos";
	$destino="../acceso/index.php";
	header("location:mensaje_ok.php?mensaje=$mensaje&destino=$destino");
}
$usuario=$_SESSION['id'];
$empresa=$_SESSION['empresa'];
$ejersicio=$_SESSION['ejersicio'];
//--------------------------------Fin inicio de sesion------------------------

//Copia por FTP de resultados fuera del www al actual directorio y lo descarga

$enlace = $empresa."_E".$ejersicio.".xls";
//header ("Content-Disposition: attachment; filename=$enlace");
//header ("Content-Type: application/vnd.ms-excel");

                     
$ftp_server = "ftp.munichpatagonia.com.ar";
$ftp_user = "muchen";
$ftp_pass = "webMun2012";

// establecer una conexión o finalizarla
$conn_id = ftp_connect($ftp_server) or die("No se pudo conectar a $ftp_server"); 

// intentar iniciar sesión
if (@ftp_login($conn_id, $ftp_user, $ftp_pass)) {
    echo "Conectado como $ftp_user@$ftp_server\n";
} else {
    echo "No se pudo conectar como $ftp_user\n";
}

// Obtener los archivos contenidos en el directorio actual
$contents = ftp_nlist($conn_id, "../../../resultados");

// output $contents
//var_dump($contents);

foreach($contents as $c=>$v){ 
echo "<p>El vector con indice $c tiene el valor $v </p>"; 
} 




// definir algunas variables
$local_file = $empresa."_E".$ejersicio.".xls";
$server_file = "../../../resultados/".$local_file;

// intenta descargar $server_file y guardarlo en $local_file
if (ftp_get($conn_id, $local_file, $server_file,FTP_BINARY)) {
    echo "Se ha guardado satisfactoriamente en $local_file\n";
} else {
    echo "Ha habido un problema\n";
}

ftp_close($conn_id);  

// cerrar la conexión ftp


//---------------------------------

$fichero=$enlace;

if (file_exists($fichero)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename='.basename($fichero));
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($fichero));
    ob_clean();
    flush();
    readfile($fichero);
    exit;
}

//---------------------------------




//---Descarga y borra
//readfile($enlace);
//@unlink($local_file);

?>