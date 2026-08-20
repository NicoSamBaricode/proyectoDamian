<?php

//-----------------Funciones de fecha-----------------------------------
function timestampToFecha ($timeStamp)
{
    $fechaDelTime=getdate($timeStamp);
		  $dia=$fechaDelTime[mday];
		  $mes=$fechaDelTime[mon];
		  $anio=$fechaDelTime[year];
		  $hora=$fechaDelTime[hours];
		  $minuto=$fechaDelTime[minutes];
$fechaDelTime=$dia."-".$mes."-".$anio."  ".$hora.":".$minuto;		

    return $fechaDelTime;
}


function fechaToTimestamp ($cadena)
{
    $retorno = "";

    
    list ($dia, $mes, $anyo)          = explode ("-", $fecha);
	
   
    if (!$fecha)
    {
        list ($dia, $mes, $anyo) = explode ("-", $cadena);
    }
       
  
    $retorno = mktime(0,0,0,$mes,$dia,$anyo);

    return $retorno;
}


//---------------------------------------------------------------------------

	function conectarse(){
		if (!($link=mysql_connect("localhost","perseo","cio154618135")))  {
		   echo "Error conectando a la base de datos.";
		   exit();
		   }
			if (!mysql_select_db("simulador_universidad",$link))  {
		   echo "Error seleccionando la base de datos simulador_universidad. ";
		   exit();
		   }
		return $link;
	}
	function conectarse_bche(){
		if (!($link=mssql_connect("10.20.130.6","sa","kristina")))  {
		   echo "Error conectando a la base de datos.";
		   exit();
		   }
		if (!mssql_select_db("Bche",$link))  {
		   echo "Error seleccionando la base de datos. ";
		   exit();
		   }
		return $link;
	}

	function send($text) {
		header("Content-type: text/html; charset=utf-8");
		echo utf8_encode($text);
	}	
	
	//---Manejo de fechas------------------------------------
function fecha_mysql_normal($fechavieja){
    list($a,$m,$d)=explode("-",$fechavieja);
    return $d."-".$m."-".$a;
};

function fecha_mysql_normal_completa($fechavieja){
    list($f,$h)=explode(" ",$fechavieja);
	list($a,$m,$d)=explode("-",$f);
	list($hor,$min,$seg)=explode(":",$h);

    return $d."-".$m."-".$a." ".$hor.":".$min.":".$seg;
};

function fecha_mysql_saca_mes($fecha_mysql){
    list($a,$m,$d)=explode("-",$fecha_mysql);
    return $m;
};

function fecha_mysql_saca_ano($fecha_mysql){
    list($a,$m,$d)=explode("-",$fecha_mysql);
    return $a;
};

function fecha_normal_mysql($fechavieja){
    list($d,$m,$a)=explode("-",$fechavieja);
    return $a."-".$m."-".$d;
};

	////////////////////////////////////////////////////
	//Convierte fecha de mysql a normal
	////////////////////////////////////////////////////
	function cambiaf_a_mssql($fecha){
		ereg( "([0-9]{1,2})/([0-9]{1,2})/([0-9]{2,4})", $fecha, $mifecha);
		$lafecha=$mifecha[3]."/".$mifecha[2]."/".$mifecha[1];
		return $lafecha;
	}
	function cambiaf_desde_mssql($fecha){
		ereg( "([0-9]{1,2})/([0-9]{1,2})/([0-9]{2,4})", $fecha, $mifecha);
		$lafecha=$mifecha[2]."/".$mifecha[1]."/".$mifecha[3];
		return $lafecha;
	}
	function cambiaf_a_normal($fecha){
		ereg( "([0-9]{2,4})-([0-9]{1,2})-([0-9]{1,2})", $fecha, $mifecha);
		$lafecha=$mifecha[3]."/".$mifecha[2]."/".$mifecha[1];
		return $lafecha;
	}
	////////////////////////////////////////////////////
	//Convierte fecha de normal a mysql
	////////////////////////////////////////////////////
	
	function cambiaf_a_mysql($fecha){
		ereg( "([0-9]{1,2})/([0-9]{1,2})/([0-9]{2,4})", $fecha, $mifecha);
		$lafecha=$mifecha[3]."-".$mifecha[2]."-".$mifecha[1];
		return $lafecha;
	} 
	function lngBuscaId($txtTabla,$lngId) 
	{
		
		$link=Conectarse();
		$qry="Select max($lngId) from $txtTabla;";
		$result=mssql_query($qry,$link);
		$tuplas=0;
		$tuplas = mssql_num_rows($result);
		
		
		if ($tuplas!=0)
		{
			while($array = mssql_fetch_array($result)) {
					$id=$array[0]+1;
					return $id;
						}
		}
		else
		{
			 $id=1;
			 return $id;
		}
				
	}
	function GetIP()
	{
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

	function fecha()
	{
		/* Definición de los meses del año en castellano */
		$mes[0]="-";
		$mes[1]="enero";
		$mes[2]="febrero";
		$mes[3]="marzo";
		$mes[4]="abril";
		$mes[5]="mayo";
		$mes[6]="junio";
		$mes[7]="julio";
		$mes[8]="agosto";
		$mes[9]="septiembre";
		$mes[10]="octubre";
		$mes[11]="noviembre";
		$mes[12]="diciembre";

		/* Definición de los días de la semana */
		$dia[0]="Domingo";
		$dia[1]="Lunes";
		$dia[2]="Martes";
		$dia[3]="Miércoles";
		$dia[4]="Jueves";
		$dia[5]="Viernes";
		$dia[6]="Sábado";
		
		/* Implementación de las variables que calculan la fecha */
		$gisett=(int)date("w");
		$mesnum=(int)date("m");
		/* Variable que calcula la hora*/
		$hora = date(" H:i",time());
		
		/* Presentación de los resultados en una forma similar a la siguiente:
		Miércoles, 23 de junio de 2004 | 17:20
		*/
		
		return $dia[$gisett].", ".date("d")." de ".$mes[$mesnum]." de ".date("Y")." | ".$hora;
	}
	//mostrar un fecha con formato normal
//	<input type="text" name="fecha" value="<?echo cambiaf_a_normal($fila->fecha);

function extension_valida($img){
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
		
		if (($extension=="xls" or $extension=="xlsx"))
			
			{
				return true;
		}
		else return false;
}

?>