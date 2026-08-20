<?php



//--------------------------------Inicio de sesion------------------------



include("../lib/sesion.php"); 



if ($_SESSION['permiso'] != 'autorizado'){



	$mensaje="Usuario sin permisos";

	$destino="../ingreso_certamen.php";

	include("../includes/mensaje.php");





}

else

{

	if ($_SESSION['subir']==0){	

	

		$mensaje="El plazo para subir desiciones ha finalizado.";

		$destino="menu_principal.php";

		include("../includes/mensaje.php");	

	}

	else

	{

	

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

		

		<link href="estilos_relevamiento.css" rel="stylesheet" type="text/css" /><link href="../css/estilos.css" rel="stylesheet" type="text/css" />

		

		<script type="text/javascript">
<!--
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//-->
</script>
		<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
-->
</style></head>

		

		

		

		<body onload="MM_preloadImages('../images/inicio_on.gif')">

		

		<table width="900" border="0" align="center" cellpadding="0" cellspacing="0">

		

		  <tr>

		

			

		

		    <td width="800" align="left" valign="top"><?php include("../lib/encabezado.php"); ?></td>
		  </tr>

		

		  <tr>

		

			<td align="left" valign="top"><table width="200" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td align="left" valign="top"><a href="menu_principal.php" 

                onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image1','','../images/inicio_on.gif',1)"> <img src="../images/inicio.gif" alt="" name="Image1" width="32" height="32" border="0" id="Image1" /></a></td>
                <td align="left" valign="top">&nbsp;</td>
                <td align="left" valign="top">&nbsp;</td>
              </tr>
            </table></td>
		  </tr>

		

		  <tr>

		

			<td align="left" valign="top" class="titulos_pantalla">Subir ejercicio 7</td>
		  </tr>

		

		  <tr>

		

			<td align="left" valign="top"><table width="100%" border="0">
              <tr>
                <td><form action="subir_ejercicio_7_proc.php" method="post"  enctype="multipart/form-data" name='form' id="form">
                    <table width="600" border="0" cellspacing="0" cellpadding="0">

                      <tr valign="middle">
                        <td width="200" height="35" align="left" valign="bottom" class="etiquetas">Decisiones del ejercicio:</td>
                        <td height="35" align="left" valign="bottom"><input name='file' type='file' /></td>
                      </tr>
                      <tr>
                        <td colspan="2">&nbsp;</td>
                      </tr>
                    </table>
                  <p>
                      <input name='Guardar' type='submit' value='Guardar'/>
                    </p>
                </form></td>
              </tr>
            </table></td>
		  </tr>
		</table>

		

		</body>

		

		</html>

	

<?php

	}

}

?>