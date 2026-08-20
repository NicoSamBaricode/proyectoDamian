<?php 
include("../lib/funciones.php");

$link=conectarse();
mysql_set_charset('utf8',$link);




//--INICIO DE VINCULACION-------
$sql_empresas="truncate decisiones";
$record_empresas=mysql_query($sql_empresas,$link);


$mensaje="Historial de decisiones eliminado correctamente";
$destino="menu_principal_admin.php";

include("../includes/mensaje_include.php");
?>
