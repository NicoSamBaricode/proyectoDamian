<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>MSCB</title>
<style type="text/css">
<!--
	.Controles
	{
		background-color:#F1F0EF;
		font-size:10px;
		border-bottom-style:none;
	}
	body,td,th
	{
		font-size: 12px;
		color: #323232;
	}
	.msg
	{
		font-size:16px;
		color:#FF0000;
	}
	body
	{
		background-color: #FFFFFF;
	}
	a
	{
		font-size: 12px;
		color: #3399FF;
	}
	a:visited
	{
		color: #323232;
	}
	a:link
	{
		color: #323232;
	}
	.Estilo1
	{
		font-size: 14px;
		font-weight: bold;
		font-family: Verdana, Arial, Helvetica, sans-serif;
		color: #993300;
	}
	a:hover
	{
		color: #FF0000;
	}
	a:active
	{
		color: #FF0000;
	}
.Estilo2 {	font-family: Tahoma;
	font-size: 12px;
	color: #1E5033;
}
-->
</style>
</head>

<body>
						<form name="form1" method="post" action="<?php echo $_GET['destination'] ?>">
							<table width="500" height="250"  border="0" align="center" cellpadding="5" cellspacing="0" background="imagenes/login_recuadro.gif" bgcolor="#FFFFFF">
                              <tr>
                                <td width="275" rowspan="3" align="right"><div align="center"><img src="imagenes/login_escudo.jpg" width="213" height="205"></div></td>
                                <td height="102"><div align="left"><img src="imagenes/advertencia.jpg" width="100" height="88"> </div></td>
                              </tr>
                              <tr>
                                <th><div align="left"> 
                                  <?php
								printf("<table align='center'><tr><td class='msg'><div align='center'>".$_GET['msgbox']."</div></td></tr></table>");
							?>
                                  <br>
                                  <br>
                                        <br>
                                </div></th>
                              </tr>
                              <tr>
                                <td><div align="center">                                </div></td>
                              </tr>
                          </table>
														<div align="center"><input name="aceptar" type="submit" id="aceptar" value="Aceptar"></div>
						</form>
</body>
</html>