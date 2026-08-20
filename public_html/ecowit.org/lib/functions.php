<?php


function chmod_R($path, $filemode) {
   if (!is_dir($path))
       return chmod($path, $filemode);
   $dh = opendir($path);
   while ($file = readdir($dh)) {
       if($file != '.' && $file != '..') {
           $fullpath = $path.'/'.$file;
           if(!is_dir($fullpath)) {
             if (!chmod($fullpath, $filemode))
                 return FALSE;
           } else {
             if (!chmod_R($fullpath, $filemode))
                 return FALSE;
           }
       }
   }
   closedir($dh);
   if(chmod($path, $filemode))
     return TRUE;
   else
     return FALSE;
}

//function para paginar resultados
function paginar($actual, $total, $por_pagina, $enlace) {
  $total_paginas = ceil($total/$por_pagina);
  $anterior = $actual - 1;
  $posterior = $actual + 1;
  if ($actual>1)
    $texto = "<a href=\"$enlace$anterior\">&laquo;</a> ";
  else
    $texto = "<b>&laquo;</b> ";
  for ($i=1; $i<$actual; $i++)
    $texto .= "<a href=\"$enlace$i\">$i</a> ";
  $texto .= "<strong>$actual</strong> ";
  for ($i=$actual+1; $i<=$total_paginas; $i++)
    $texto .= "<a href=\"$enlace$i\">$i</a> ";
  if ($actual<$total_paginas)
    $texto .= "<a href=\"$enlace$posterior\">&raquo;</a>";
  else
    $texto .= "<b>&raquo;</b>";
  return $texto;
}


///////////////function send///////////////
function send($text){
	//header("Content-type: text/html; charset=utf-8");
	echo utf8_encode($text);
}
//////////////function conectarse
function conectarse(){
	if (!($link=mysql_connect("localhost","root","cavaliere"))){
	   echo "Error conectando a la base de datos.";
	   exit();
	   }
	if (!mysql_select_db("sitio_mscb",$link)){
	   echo "Error seleccionando la base de datos.";
	   exit();
	   }
	return $link;
}

function conectarse_boletin(){
	if (!($link=mysql_connect("localhost","juanma","nahuel"))){
	   echo "Error conectando a la base de datos.";
	   exit();
	   }
	if (!mysql_select_db("boletinoficial",$link)){
	   echo "Error seleccionando la base de datos.";
	   exit();
	   }
	return $link;
}
//////////////function conectarse_protocolo
function conectarse_protocolo(){
	if (!($link=mysql_connect("localhost","root","nahuel"))){
	   echo "Error conectando a la base de datos.";
	   exit();
	   }
	if (!mysql_select_db("protocolo",$link)){
	   echo "Error seleccionando la base de datos.";
	   exit();
	   }
	return $link;
}

////////////Convierte fecha de mysql a normal
function cambiaf_a_normal($fecha){
	ereg( "([0-9]{2,4})-([0-9]{1,2})-([0-9]{1,2})", $fecha, $mifecha);
	$lafecha=$mifecha[3]."/".$mifecha[2]."/".$mifecha[1];
	return $lafecha;
}
//////////Convierte fecha de normal a mysql
function cambiaf_a_mysql($fecha){
	ereg( "([0-9]{1,2})/([0-9]{1,2})/([0-9]{2,4})", $fecha, $mifecha);
	$lafecha=$mifecha[3]."-".$mifecha[2]."-".$mifecha[1];
	return $lafecha;
} 
//////////77function buscar id
function lngBuscaId($txtTabla,$lngId){
	$link=Conectarse();
	$qry="Select max($lngId) from $txtTabla;";
	$result=mysql_query($qry,$link);
	$tuplas=0;
	$tuplas = mysql_num_rows($result);
	if ($tuplas!=0){
		while($array = mysql_fetch_array($result)) {
				$id=$array[0]+1;
				return $id;
					}
	}
	else{
		 $id=1;
		 return $id;
	}
}
/////function toma ip de cliente////	
function GetIP(){
   if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"),"unknown"))
		   $ip = getenv("HTTP_CLIENT_IP");
   else if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown"))
		   $ip = getenv("HTTP_X_FORWARDED_FOR");
   else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown"))
		   $ip = getenv("REMOTE_ADDR");
   else if (isset($_SERVER[´REMOTE_ADDR´]) && $_SERVER[´REMOTE_ADDR´] && strcasecmp($_SERVER[´REMOTE_ADDR´], "unknown"))
		   $ip = $_SERVER[´REMOTE_ADDR´];
   else
		   $ip = "unknown";
  
   return($ip);
}

function extension($img){

		$filename=$img;
		if (($pos = strrpos($filename, ".")) === FALSE)
		 	echo "Error - file doesn't have a dot... weird.";
		else {
		  $extension = substr($filename, $pos + 1);
		}
		if (($pos = strrpos($filename, "/")) === FALSE)
		  echo "";
		else {
		  $name = substr($filename, $pos + 1);
		}
		return $extencion;
}
function thumb($img,$ancho,$alto,$destino){
		//echo $filename;
		$filename=$img;
		if (($pos = strrpos($filename, ".")) === FALSE)
		 //echo ""; 		 // 
		 	echo "Error - file doesn't have a dot... weird.";
		else {
		  //echo "";		  
		  $extension = substr($filename, $pos + 1);
		}
		if (($pos = strrpos($filename, "/")) === FALSE)
		  echo "";//echo "Error - file doesn't have a dot... weird.";
		else {
		  $name = substr($filename, $pos + 1);
		}
		//echo $extencion;
		
		if (($extension=="jpeg")||($extension=="jpg")||($extension=="JPG")){
			$fuente = @imagecreatefromjpeg($img);
			$imgAncho = imagesx ($fuente);
			$imgAlto =imagesy($fuente);
			//$imagen = ImageCreate($ancho,$alto);
			//ImageCopyResized($imagen,$fuente,0,0,0,0,$ancho,$alto,$imgAncho,$imgAlto);
			$imagen=imagecreatetruecolor($ancho,$alto);
			imagecopyresampled($imagen,$fuente,0,0,0,0,$ancho,$alto,$imgAncho,$imgAlto);
			imagejpeg($imagen,$destino."tn_".$name);
		}
		elseif ($extension=="gif"){
			//echo realpath("tmp")."/tn_".$name;
			$fuente = @imagecreatefromgif($img);
			$imgAncho = imagesx ($fuente);
			$imgAlto =imagesy($fuente);
			//$imagen = ImageCreate($ancho,$alto);
			//ImageCopyResized($imagen,$fuente,0,0,0,0,$ancho,$alto,$imgAncho,$imgAlto);
			$imagen=imagecreatetruecolor($ancho,$alto);
			imagecopyresampled($imagen,$fuente,0,0,0,0,$ancho,$alto,$imgAncho,$imgAlto);
			//imagegif($imagen,realpath("tmp")."/tn_".$name);
			imagegif($imagen,$destino."tn_".$name);
		}
		elseif ($extension=="bmp"){
			$fuente = @imagecreatefromwbmp($img);
			$imgAncho = imagesx ($fuente);
			$imgAlto =imagesy($fuente);
			//$imagen = ImageCreate($ancho,$alto);
			//ImageCopyResized($imagen,$fuente,0,0,0,0,$ancho,$alto,$imgAncho,$imgAlto);
			$imagen=imagecreatetruecolor($ancho,$alto);
			imagecopyresized($imagen,$fuente,0,0,0,0,$ancho,$alto,$imgAncho,$imgAlto);
			imagewbmp($imagen,$destino."tn_".$name);
		}
		else echo "extension no reconocida (".$extension.")";
		chmod_R(realpath("tmp"),0777);
		chmod(realpath("tmp"),0777);		
}


function codificador_hexa ($email_address) {
$codificado = bin2hex("$email_address");
$codificado = chunk_split($codificado, 2, '%');
$codificado = '%' . substr($codificado, 0, strlen($codificado) - 1);
return $codificado;
}
function cut_string($string, $charlimit){
	if(substr($string,$charlimit-1,1) != ' '){
		$string = substr($string,'0',$charlimit);
		$array = explode(' ',$string);
		array_pop($array);
		$new_string = implode(' ',$array);
		return $new_string.' ...';
	}
	else{
		return substr($string,'0',$charlimit-1).' ...';
	}
}

function exten($img){
		$filename=$img;
		if (($pos = strrpos($filename, ".")) === FALSE)
		 	echo "Error - file doesn't have a dot... weird.";
		else {
		  $extension = substr($filename, $pos + 1);
		}
		if (($pos = strrpos($filename, "/")) === FALSE)
		  echo "";
		else {
		  $name = substr($filename, $pos + 1);
		}
		
		if (($extension=="jpeg")||
			($extension=="jpg")||
			($extension=="JPG")||
			($extension=="gif")||
			($extension=="bmp")){
				return true;
		}
		else return false;
}
function resizeimage($image,$wr){
	$size = getimagesize($image);
	$wo=$size[0];
	$ho=$size[1];
	//$wr=480;
	$hr=($wr*$ho)/$wo;
	return $hr;
}



function getSector($id_sector){

			$link=conectarse();
			$sql="SELECT a.id_sector,a.descripcion,a.direccion,a.telefono,a.mail,
				b.id_sector,b.descripcion,b.direccion,b.telefono,b.mail,
				c.id_sector,c.descripcion ,c.direccion,c.telefono,c.mail,a.mail2
			FROM sectores a,sectores b, sectores c
			WHERE a.id_subsector=b.id_sector
			and b.id_subsector=c.id_sector
			and a.id_sector=".$id_sector;

			$result=mysql_query($sql,$link);
			while($row=mysql_fetch_array($result)){
				$arr=array($row[0],$row[1],$row[2],$row[3],$row[4],
							$row[5],$row[6],$row[7],$row[8],$row[9],
							$row[10],$row[11],$row[12],$row[13],$row[14],$row[15]);
				return $arr;
				exit();
				
			/*
				descripcion=$row[0]; 	
				id_sector=$row[1]; 	
				direccion=$row[2]; 	 	
				telefono=$row[3]; 	 	
				mail=$row[4]; 	 	
				
				id_sector=$row[5]; 	 	
				descripcion=$row[6]; 	 	
				direccion=$row[7]; 	 	
				telefono=$row[8]; 	 	
				mail=$row[10]; 	 	
				
				id_sector=$row[11]; 	 	
				descripcion=$row[12]; 	 	
				direccion=$row[13]; 	 	
				telefono=$row[14]; 	 	
				mail=$row[15]; 	
			*/
			
			}
}

function getGrupo($id_grupo){

			$link=conectarse();
			$sql="SELECT *
			FROM contenidos_grupos
			WHERE 1 and id_grupo=".$id_grupo;
			$result=mysql_query($sql,$link);
			while($row=mysql_fetch_array($result)){
				return $row["grupo"];
				exit();
			}
}
function getId_Sector($id_grupo){

			$link=conectarse();
			$sql="SELECT count(*),b.id_sector fROM contenidos a,contenidos b
				wHERE a.id_grupo=".$id_grupo."
				and a.id_contenido=b.id_contenido
				group by a.id_grupo";
			$result=mysql_query($sql,$link);
			while($row=mysql_fetch_array($result)){
				return $row["id_sector"];
				exit();
			}
			return NULL;
}

 
function fecha_enc(){ 
		$mes = date("n"); 
		$mesArray = array( 1 => "Enero", 
						2 => "Febrero", 
						3 => "Marzo", 
						4 => "Abril", 
						5 => "Mayo", 
						6 => "Junio", 
						7 => "Julio", 
						8 => "Agosto", 
						9 => "Septiembre", 
						10 => "Octubre", 
						11 => "Noviembre", 
						12 => "Diciembre" ); 
		$semana = date("D"); 
		$semanaArray = array( "Mon" => "Lunes", 
						"Tue" => "Martes", 
						"Wed" => "Miercoles", 
						"Thu" => "Jueves", 
						"Fri" => "Viernes", 
						"Sat" => "Sábado", 
						"Sun" => "Domingo"); 
		$mesReturn = $mesArray[$mes]; 
		$semanaReturn = $semanaArray[$semana]; 
		$dia = date("d"); 
		$año = date ("Y"); 
		return $dia." de ".$mesReturn." de ".$año; 
		}

function fechanueva($fechavieja){
    list($a,$m,$d)=explode("-",$fechavieja);
    return $d."-".$m."-".$a;
};	

function convierte_fecha_hora($fechahora){
    list($fecha,$hora)=explode(" ",$fechahora); //Separo la fecha de la hora
	list($a,$m,$d)=explode("-",$fecha); //Desmenuzo la fecha
	list($hor,$min,$seg)=explode(":",$hora); //Desmenuzo la hora
    return $d."-".$m."-".$a." ".$hor.":".$min.":".$seg;
};

?>
