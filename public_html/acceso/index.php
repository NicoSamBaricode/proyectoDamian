<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Sistema Administrativo</title>

<title>MSCB</title>
<script type="text/javascript">
function tabular(e,obj) {
  tecla=(document.all) ? e.keyCode : e.which;
  if(tecla!=13 && tecla!=38 ) return;
  frm=obj.form;
  for(i=0;i<frm.elements.length;i++) 
    if(frm.elements[i]==obj) { 
      if (i==frm.elements.length-1) i=-1;
      break }
  if(tecla==13) frm.elements[i+1].focus();
  if(tecla==38) frm.elements[i-1].focus();
  return false;
} 
</script>

<style type="text/css">
<!--
.Estilo1 {
	font-family: Tahoma;
	font-size: 12px;
	color: #1E5033;
}
.style2 {
	font-size: 30px;
	font-family: Geneva, Arial, Helvetica, sans-serif;
}
body {
	background-color: #DBDBDB;
	margin-top: 50px;
}
.style4 {font-size: 10px; font-family: Verdana, Arial, Helvetica, sans-serif;}
-->
</style>
</head>

<body onLoad="document.form1.txtUser.focus();">
	<form name="form1" method="post" action="login.php">
	  <table width="500" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td bgcolor="#FFFFFF"><div align="center"><span class="style2">Sistema administrativo </span></div></td>
        </tr>
        <tr>
          <td><table width="500" height="250"  border="0" align="center" cellpadding="5" cellspacing="0" bordercolor="#C3C3C3" background="imagenes/login_recuadro.gif">
            <tr>
              <td width="275" rowspan="3" align="center" valign="top" bgcolor="#FFFFFF"><div align="center"><img src="images/logo_enc.jpg" width="213" height="259"></div></td>
              <td align="center" valign="top" bgcolor="#FFFFFF"><div align="left"><img src="images/login.gif" width="128" height="99"></div></td>
            </tr>
            <tr>
              <th bgcolor="#FFFFFF"><div align="left"> <span class="Estilo1">Usuario</span><br>
                      <input name="txtUser" type="text" class="Controles" id="txtUser" maxlength="50" tabindex="1" onKeyPress="return tabular(event,this)">
                      <br>
                      <span class="Estilo1">Contrase&ntilde;a</span> <br>
                      <input name="txtPass" type="password" class="Controles" id="txtPass" maxlength="10" tabindex="2" onKeyPress="return tabular(event,this)">
              </div></th>
            </tr>
            <tr>
              <td bgcolor="#FFFFFF"><div align="center">
                  <input name="btnLogin" type="submit" id="btnLogin3" value="Entrar" tabindex="3">
              </div></td>
            </tr>
            <tr>
              <td colspan="2" align="left" valign="top" bgcolor="#FFFFFF">&nbsp;</td>
            </tr>
            <tr>
              <td colspan="2" align="left" valign="top"><table width="495" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td><div align="center"></div></td>
                  </tr>
                  <tr>
                    <td><div align="center"></div></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="right" valign="middle"><p align="center" class="style4">.</p></td>
                  </tr>
              </table></td>
            </tr>
          </table></td>
        </tr>
      </table>
</form>
</body>
</html>