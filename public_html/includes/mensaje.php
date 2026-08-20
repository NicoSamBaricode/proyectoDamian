<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Mensaje</title>
<style type="text/css">
<!--
.style5 {font-family: Arial, Helvetica, sans-serif; font-weight: bold; font-size: 12px; }
.style17 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; }
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}

.style18 {font-size: 12px; color: #000000; font-family: Verdana, Arial, Helvetica, sans-serif;}
-->
</style>
<link href="css/estilos.css" rel="stylesheet" type="text/css" />
<link href="../css/estilos.css" rel="stylesheet" type="text/css" />
</head>

<body>

<table width="770" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
 <tr>
  <td width="770"><table width="770" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td><?php include("../lib/encabezado.php"); ?></td>
    </tr>
  </table></td>
  </tr>
  <tr>
    <td bgcolor="#E7DAC7"><table width="770" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td height="30" align="left" valign="middle" bgcolor="#FFFFFF">&nbsp;</td>
      </tr>
      <tr>
        <td height="30" align="left" valign="middle" bgcolor="#FFFFFF" class="contnido_index"><?php echo utf8_encode($mensaje);?></td>
      </tr>
      <tr>
        <td height="30" align="left" valign="middle" bgcolor="#FFFFFF" class="titulopantalla">&nbsp;</td>
      </tr>
      <tr>
        <td height="30" align="left" valign="middle" bgcolor="#FFFFFF"><a href="<?php echo $destino;?>" class="enlace_opcion">Continuar -&gt;&gt;</a></td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
