<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>sapienter.org :: Home</title>
<style type="text/css">
<!--
.Estilo1 {	font-family: Tahoma;
	font-size: 12px;
	color: #1E5033;
}
.style2 {	font-size: 30px;
	font-family: Geneva, Arial, Helvetica, sans-serif;
}
.style4 {font-size: 10px; font-family: Verdana, Arial, Helvetica, sans-serif;}
-->
</style>
<link href="css/estilos.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-image: url(images/fondo_pagina.jpg);
}
-->
</style>
<link href="css/estilos.css" rel="stylesheet" type="text/css" />
</head>

<body>
<table width="900" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="160" align="left" valign="top"><img src="images/encabezado.gif" width="900" height="160" /></td>
  </tr>
  <tr>
    <td height="30" bgcolor="#FFFFFF" class="enlace_opcion"><table width="300" border="0" align="left" cellpadding="0" cellspacing="0">
      <tr>
        <td align="center" valign="middle"><a href="index.php" class="enlace_opcion">Inicio</a></td>
        <td align="center" valign="middle">&nbsp;</td>
        <td align="center" valign="middle">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td><table width="850" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
      <tr>
        <td width="420" align="left" valign="top"><img src="images/img_ingreso.jpg" width="400" height="348" /></td>
        <td width="430" align="left" valign="top" bgcolor="#F2F2F2"><table width="430" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td><form action="acceso/login.php" method="post" name="form1" id="form1">
                  <table width="430" border="0" cellpadding="0" cellspacing="0" bgcolor="#F2F2F2">
                    <tr align="center" valign="middle">
                      <td height="30" colspan="2" bgcolor="#DBDBDB" class="etiquetas">Acceso de empresa</td>
                    </tr>
                    <tr>
                      <td height="20" align="left" valign="bottom" class="etiquetas">Usuario</td>
                      <td height="20" align="left" valign="bottom"><label>
                        <input name="txtUser" type="text" class="datos" id="txtUser" size="20" maxlength="20" />
                      </label></td>
                    </tr>
                    <tr>
                      <td height="20" align="left" valign="bottom" class="etiquetas">Clave</td>
                      <td height="20" align="left" valign="bottom"><label>
                        <input name="txtPass" type="text" class="datos" id="txtPass" size="20" maxlength="20" />
                      </label></td>
                    </tr>
                    <tr>
                      <td height="20" align="left" valign="bottom">&nbsp;</td>
                      <td height="20" align="left" valign="bottom"><input name="btnLogin" type="submit" id="btnLogin3" value="Entrar" tabindex="3" /></td>
                    </tr>
                  </table>
              </form></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td><?php
            include("lib/funciones.php");
$link=conectarse();
$query="select id_empresa,nombre,ciudad,provincia from usuarios_simu where registrado='0' and privilegio='2' order by nombre";
$record_empresas=mysql_query($query, $link); 
?>
                  <form action="acceso/login_inicial.php" method="post" name="form_inicial" id="form2">
                    <table width="430" border="0" cellpadding="0" cellspacing="0" bgcolor="#F2F2F2">
                      <tr align="center" valign="middle" bgcolor="#DBDBDB">
                        <td height="30" colspan="2" class="etiquetas">Acceso por primera vez</td>
                      </tr>
                      <tr>
                        <td height="20" align="left" valign="bottom" class="etiquetas">Empresa</td>
                        <td height="20" align="left" valign="bottom"><label><span class="style17">
                          <select name="txt_empresa" class="datos_formulario" id="txt_empresa" tabindex="3" onkeypress="return tabular(event,this)">
                            <option selected="selected">...</option>
                            <?php
			  
			  while($empresa=mysql_fetch_array($record_empresas)){ 
           
			  ?>
                            <option  value="<?php echo $empresa["id_empresa"]; ?>"><?php echo $empresa["nombre"].", ".$empresa["ciudad"]."-".$empresa["provincia"]; ?></option>
                            <?php
            	
		  	  }
         	?>
                          </select>
                        </span></label></td>
                      </tr>
                      <tr>
                        <td height="20" align="left" valign="bottom" class="etiquetas">Usuario</td>
                        <td height="20" align="left" valign="bottom"><label>
                          <input name="txt_user_inicial" type="text" class="datos" id="txt_user_inicial" size="20" maxlength="20" />
                        </label></td>
                      </tr>
                      <tr>
                        <td height="20" align="left" valign="bottom" class="etiquetas">Clave</td>
                        <td height="20" align="left" valign="bottom"><label>
                          <input name="txt_pass_inicial" type="text" class="datos" id="txt_pass_inicial" size="20" maxlength="20" />
                        </label></td>
                      </tr>
                      <tr>
                        <td height="20" align="left" valign="bottom">&nbsp;</td>
                        <td height="20" align="left" valign="bottom"><input name="btnLogin2" type="submit" id="btnLogin" value="Entrar" tabindex="3" /></td>
                      </tr>
                    </table>
                  </form></td>
            </tr>
        </table></td>
      </tr>
      <tr>
        <td align="left" valign="top">&nbsp;</td>
        <td align="right" valign="top">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>
