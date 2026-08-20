<?php
include("../funciones.php");
require_once("class.ezpdf.php");


//Configuración de página-----------------

$pdf =& new Cezpdf('a4');

$pdf->selectFont('fonts/courier.afm');

$pdf->ezSetCmMargins(1,1,1.5,1.5);

//Fin configuración de página-----------------

$link=conectarse_mysql();

if (isset($_GET["escuela"])){
	$escuela=$_GET["escuela"];
	$query_escuelas="select id_escuela,nombre,direccion from escuelas where id_escuela='$escuela' order by nombre";
	$record_escuelas=mysql_query($query_escuelas,$link);
}
else
{
$query_escuelas="select id_escuela,nombre,direccion from escuelas order by nombre";
$record_escuelas=mysql_query($query_escuelas,$link);
}

/*$query_escuelas="select id_escuela,nombre,direccion from escuelas order by nombre";
$record_escuelas=mysql_query($query_escuelas,$link);*/
//--------------esto


$txttit= "LISTADO DE ESCUELAS Y COORDINADORES \n";
$pdf->ezText($txttit, 15,array('justification'=>'center'));


 while ($escuelas=mysql_fetch_array($record_escuelas)){
 $pdf->ezText("_______________________________________________________________________", 12);
 $escuela=$escuelas["nombre"]." - Dir: ".$escuelas["direccion"];
 $pdf->ezText($escuela, 13,array('justification'=>'center'));
 $pdf->ezText("\n", 8);
 
 $query_coordinador="select id_autoridad,apellido,nombre,documento,telefono,empresa_telefonia,cargo from 
				autoridades where cargo='3' and mesa= '".$escuelas["id_escuela"]."'";
		$record_coordinador=mysql_query($query_coordinador,$link);
		if(mysql_num_rows($record_coordinador)==0){
			
			 $pdf->ezText("", 10);
		}
		else
		{
			$coordinador="Coordinador: ".utf8_decode(mysql_result($record_coordinador,0,"apellido")).", ".mysql_result($record_coordinador,0,"nombre")." DNI: ".mysql_result($record_coordinador,0,"documento")." Telefono: ".mysql_result($record_coordinador,0,"telefono")." ".mysql_result($record_coordinador,0,"empresa_telefonia");
 $pdf->ezText($coordinador, 12);
  $pdf->ezText("\n", 10);
 }
 
 $query_vocal_coordinador="select id_autoridad,apellido,nombre,documento,telefono,cargo from 
				autoridades where cargo='4' and mesa= '".$escuelas["id_escuela"]."'";
		$record_vocal_coordinador=mysql_query($query_vocal_coordinador,$link);
		if(mysql_num_rows($record_vocal_coordinador)==0){
				
			 $pdf->ezText("", 10);
		}
		else
		{
			$vocal="Vocal: ".mysql_result($record_vocal_coordinador,0,"apellido").", ".mysql_result($record_vocal_coordinador,0,"nombre")." DNI: ".mysql_result($record_vocal_coordinador,0,"documento")." Telefono: ".mysql_result($record_vocal_coordinador,0,"telefono");
		$pdf->ezText($vocal, 12);	
		 
		}
		
}// fin while

///-----------esto




$pdf->ezText("\n\n\n", 10);

$pdf->ezText("<b>Fecha:</b> ".date("d/m/Y"), 10);

$pdf->ezText("<b>Hora:</b> ".date("H:i:s")."\n\n", 10);
$pdf->ezStream();

?>