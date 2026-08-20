<?php
include("../funciones.php");

//--------------------------------Inicio de sesion------------------------
include("../sesion.php"); 
if ($_SESSION['permiso'] != 'autorizado' ){
	$mensaje="Usuario sin permisos";
	$destino="../../acceso/index.php";
	header("location:mensaje_ok.php?mensaje=$mensaje&destino=$destino");
}
$usuario=$_SESSION['id'];
$empresa=$_SESSION['abreviatura'];
$ejercicio=$_SESSION['ejercicio'];
$nom_archivo=$_SESSION['nom_archivo'];
//--------------------------------Fin inicio de sesion------------------------

require_once("class.ezpdf.php");


//Configuración de página-----------------

$pdf =& new Cezpdf('a4');

$pdf->selectFont('../fonts/courier.afm');

$pdf->ezSetCmMargins(1,1,1.5,1.5);

//Fin configuración de página-----------------


$link=conectarse();

$query_empresa="select nombre,zona,ciudad,provincia from usuarios_simu where
id_empresa='$usuario'";

$record_empresa=mysql_query($query_empresa,$link);
$datos_empresa=mysql_fetch_array($record_empresa);

$nom_empresa=$datos_empresa["nombre"];
$ciudad_empresa=$datos_empresa["ciudad"];
$provincia_empresa=$datos_empresa["provincia"];

$query_subido="select top ejercicio,archivo,fecha from participante_archivo where
id_participante='$usuario' 
order by fecha desc";

$record_subido=mysql_query($query_subido,$link);
$recibo=mysql_fetch_array($record_subido); 


$titulo="Comprobante de envío de las decisiones tomadas por la empresa ".$nom_empresa.", de la localidad de ".$ciudad_empresa. " en la provincia de ".$provincia_empresa.", correspondientes al ejercicio ".$ejercicio;

//$fecha= date("H:i:s");

$pdf->ezText($titulo, 14);

$fecha=timestampToFecha(time()-10800);

$pdf->ezText("\n\n\n", 10);

//$pdf->ezText("<b>Fecha:</b> ".date("d/m/Y"), 10);

$pdf->ezText("<b>Fecha:</b> ".$fecha, 10);

$pdf->ezStream();

?>