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


//--------------esto


$txttit= "LISTADO DE ESCUELAS Y COORDINADORES \n";
$pdf->ezText($txttit, 15,array('justification'=>'center'));


 while ($escuelas=mysql_fetch_array($record_escuelas)){ //por cada escuela
 $pdf->ezText("_______________________________________________________________________", 12);
 $escuela=$escuelas["nombre"]." - Dir: ".$escuelas["direccion"];
 $pdf->ezText($escuela, 13,array('justification'=>'center'));
 $pdf->ezText("\n", 8);
 //trae coordinador-----------------------
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
//trae vocal--------------------------------- 
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
$pdf->ezText("", 12);
//-----trae mesas------------------------		
$query_mesas="select id_mesa,nro_mesa from escuelas e inner join mesas m on e.id_escuela=m.escuela 
	 where id_escuela='".$escuelas["id_escuela"]."' order by nro_mesa";		
$record_mesas=mysql_query($query_mesas,$link);
while ($mesas=mysql_fetch_array($record_mesas)){
$nro_mesa="Mesa Nro: ".$mesas["nro_mesa"];
$pdf->ezText($nro_mesa, 12);
//trae autoridades de mesa
$query_autoridades_mesas="select apellido,nombre,documento,telefono,empresa_telefonia,descripcion from autoridades a 
inner join mesas m on a.mesa=m.id_mesa
inner join cargos c on a.cargo=c.id_cargo where m.id_mesa='".$mesas["id_mesa"]."' and (a.cargo='1' or a.cargo='2') order by descripcion";		
$record_autoridades_mesas=mysql_query($query_autoridades_mesas,$link);
while ($autoridades=mysql_fetch_array($record_autoridades_mesas)){
$apellido=utf8_decode($autoridades["apellido"].", ".$autoridades["nombre"]." - Doc: ".$autoridades["documento"]." -Tel: ".$autoridades["telefono"]." ".$autoridades["empresa_telefonia"]."(".$autoridades["descripcion"].")");
$pdf->ezText($apellido, 12);
}
$pdf->ezText("", 12);
//fin trae autoridades-------

}//fin while mesas
		
}// fin while

///-----------esto




$pdf->ezText("\n\n\n", 10);

$pdf->ezText("<b>Fecha:</b> ".date("d/m/Y"), 10);

$pdf->ezText("<b>Hora:</b> ".date("H:i:s")."\n\n", 10);
$pdf->ezStream();

?>