<?php 
include("../lib/funciones.php");

$link=conectarse();
mysql_set_charset('utf8',$link);




//--INICIO DE VINCULACION-------
$sql_empresas="delete from usuarios_simu where privilegio <> '1'";
$record_empresas=mysql_query($sql_empresas,$link);


$mensaje="Equipos y profesores fueron eliminados correctamente";
$destino="menu_principal_admin.php";

include("../includes/mensaje_include.php");
?>
