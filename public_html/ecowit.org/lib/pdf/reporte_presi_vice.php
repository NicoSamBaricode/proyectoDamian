<?php
include("../funciones.php");
require_once("class.ezpdf.php");


//Configuración de página-----------------

$pdf =& new Cezpdf('a4');

$pdf->selectFont('fonts/courier.afm');

$pdf->ezSetCmMargins(1,1,1.5,1.5);

//Fin configuración de página-----------------

$pdf->ezText("Listado de Presidentes y vicepresidentes", 12,array('justification'=>'center'));
$pdf->ezText("\n\n\n", 10);

$link=conectarse_mysql();

//-----trae mesas------------------------		

$query_autoridades_mesas="select apellido,nombre,documento from autoridades where cargo='1' or cargo='2' order by apellido";		
$record_autoridades_mesas=mysql_query($query_autoridades_mesas,$link);

while ($autoridades=mysql_fetch_array($record_autoridades_mesas)){
	/*$apellido=utf8_decode($autoridades["apellido"].", ".$autoridades["nombre"]." - Doc: ".$autoridades["documento"]." -Tel: ".$autoridades["telefono"]." 		".$autoridades["empresa_telefonia"]."(".$autoridades["descripcion"].")");*/

	$apellido=utf8_decode($autoridades["apellido"].", ".$autoridades["nombre"])." - Doc: ".$autoridades["documento"];
	$pdf->ezText($apellido, 12);
	$pdf->ezText("\n", 8);
}

//fin trae autoridades-------

	





$pdf->ezText("\n\n\n", 10);

$pdf->ezText("<b>Fecha:</b> ".date("d/m/Y"), 10);

$pdf->ezText("<b>Hora:</b> ".date("H:i:s")."\n\n", 10);
$pdf->ezStream();

?>