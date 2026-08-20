<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>

<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.style2 {font-family: Arial, Helvetica, sans-serif; font-size: 24px;}

-->
</style>
<link href="../css/estilos.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style7 {
	color: #FF0000;
	font-weight: bold;
	font-size: 18px;
}
.style9 {
	color: #00FF00;
	font-weight: bold;
	font-size: 18px;
}
.style10 {
	color: #0000FF;
	font-weight: bold;
	font-size: 18px;
}
.style13 {font-size: 20px}
.style16 {font-size: 18px; color: #FF0000;}
.style17 {
	color: #000000;
	font-size: 14px;
	font-weight: bold;
}
-->
</style>
</head>

<body>

<table width="570" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td width="570" valign="top" class="style2"><table width="100%" border="0" cellspacing="0" cellpadding="5">
      <tr>
        <td align="left" valign="top" class="titulo_header"><span class="style13">Programa de simulaci&oacute;n</span></td>
      </tr>
      <tr>
        <td align="left" valign="top" class="etiquetas" >Empresa:<?php echo " ".$_SESSION['nombre']; ?></td>
      </tr>
      <tr>
        <td align="left" valign="top" class="etiquetas" >Ubicaci&oacute;n:<?php echo " ".$_SESSION['provincia'].", ".$_SESSION['ciudad']; ?></td>
      </tr>
      <tr>
        <td align="left" valign="top" class="etiquetas">Zona:<?php echo " ".$_SESSION['zona']; ?></td>
      </tr>
      <tr>
        <td align="left" valign="top" class="etiquetas">Ejercicio:<?php echo " ". $_SESSION['ejercicio']; ?></td>
      </tr>
      <tr>
        <td height="2" align="left" valign="top" bgcolor="#00CC00" class="etiquetas"></td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
