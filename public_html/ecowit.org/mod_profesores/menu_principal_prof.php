<?php
//--------------------------------Inicio de sesion------------------------
include("../lib/sesion.php"); 
if ($_SESSION['permiso'] == 'autorizado' and $_SESSION['privilegio']=='3'){
	
//--------------------------------Fin inicio de sesion------------------------

	include("../lib/funciones.php");
	
	$link=conectarse();

$query_documentos="select * from archivos where habilitado='1' order by nombre"; 
$documentos=mysql_query($query_documentos,$link);


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sistema administrativo</title>
<style type="text/css">
<!--
.style16 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; }
.style21 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12; font-weight: bold; }
.style22 {font-family: Verdana, Arial, Helvetica, sans-serif}
.style25 {font-size: 12}
.style4 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; }
.style5 {font-size: 12px}
.style9 {	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
}
-->
</style>
<link href="estilos_relevamiento.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
body {
	background-color: #063861;
}
-->
</style>
<link href="../css/estilos.css" rel="stylesheet" type="text/css" />
</head>

<body>
<table width="770" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#E8E8EA">
  <tr>
    <td width="800" align="left" valign="middle" bgcolor="#063861"><?php include("../lib/encabezado_prof.php"); ?></td>
  </tr>
  <tr>
    <td height="5" align="left" valign="middle" bgcolor="#063861"></td>
  </tr>
  <tr>
    <td align="left" valign="middle" class="titulos_pantalla">Menú principal</td>
  </tr>
  <tr>
    <td align="left" valign="middle"><table width="400" border="0">
      <tr>
        <td><a href="empresa_listado_prof.php" class="enlace_opcion">Listado de empresas &gt;&gt;</a></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><a href="../acceso/logout.php" class="enlace_opcion">Salir >></a></td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
<?php
}
else
{
$mensaje="Usuario sin permisos";
$destino="../ingreso_certamen.php";
include("../includes/mensaje.php");
}

?>