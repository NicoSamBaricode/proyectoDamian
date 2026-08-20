<?php 
include("../lib/funciones.php");

//--------------------------------Inicio de sesion------------------------
include("../lib/sesion.php"); 
if ($_SESSION['permiso'] != 'autorizado' ){
	$mensaje="Usuario sin permisos";
	$destino="../acceso/index.php";
	header("location:mensaje_ok.php?mensaje=$mensaje&destino=$destino");
}
$usuario=$_SESSION['id'];
//--------------------------------Fin inicio de sesion------------------------




//-------------------------------------------------

//---------------Querys-----------------------------



$link=conectarse();


$query_noticias="select id_usuario,apellido,nombre from usuarios_simu";


$record_noticias=mysql_query($query_noticias,$link);



//--------------Fin querys----------------------------


?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<title>Listado de empresas</title>

<link href="../css/estilos.css" rel="stylesheet" type="text/css">


<script language='javascript' src="../jscripts/java.js"></script>
<script language='javascript' src="../jscripts/popcalendar.js"></script>

<script type="text/javascript">
function validar(frm) {

   	if (document.form1.txt_descripcion.value==""){
  		alert("Debe ingresar una descripción de la especialidad");
		document.form1.txt_descripcion.focus(); 
  		return (false); 
  	}
	
	if (!confirm('¿Estas seguro de enviar este formulario?')){   
	   return (false); 
   	}
}
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
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
</script>


<link href="../css/estilos.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style17 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; }
-->
</style>
<link href="css/estilos.css" rel="stylesheet" type="text/css" />
</head>


<body class="estilo_body_2" onLoad="document.form1.txt_descripcion.focus();MM_preloadImages('../images/inicio_on.gif')">

<table width="770" border="0" align="center" cellpadding="0" cellspacing="0">
 <tr>
  <td width="770"></td>
  </tr>
  <tr>
    <td><?php //require_once("includes/menu_sup.php");?></td>
  </tr>
  <tr>
    <td bgcolor="#A8B6C6" class="titulos_pantalla">Listado de empresas</td>
  </tr>
  <tr>
    <td><table width="770" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><table width="200" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td align="left" valign="top"><a href="menu_principal_admin.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image1','','../images/inicio_on.gif',1)"><img src="../images/inicio.gif" name="Image1" width="32" height="32" border="0" id="Image1" /></a></td>
            <td align="left" valign="top"><a href="empresa_alta.php" class="enlace_opcion">Nuevo</a></td>
            <td align="left" valign="top">&nbsp;</td>
          </tr>
        </table>          </td>
      </tr>
      <tr>
        <td bgcolor="#D3DBE2"><table width="770" border="0" cellspacing="1">
          <tr>
            <td width="200" bgcolor="#A8B6C6" class="etiquetas">Nro de empresa</td>
            <td width="200" bgcolor="#A8B6C6" class="etiquetas">Nombre</td>
            <td width="100" bgcolor="#A8B6C6" class="etiquetas">&nbsp;</td>
            </tr>
		  <?php 
		  $color_fondo="#FFFFFF";
		  while($noticias=mysql_fetch_array($record_noticias)){ 
		  ?>
          <tr>
            <td width="200" align="left" valign="bottom" bgcolor="<?php echo $color_fondo; ?>" class="datos"><?php echo $noticias["id_usuario"];?></td>
            <td width="200" align="left" valign="bottom" bgcolor="<?php echo $color_fondo; ?>" class="datos"><?php echo $noticias["nombre"];?></td>
            <td width="100" align="left" valign="bottom" bgcolor="<?php echo $color_fondo; ?>" class="datos"><span class="<?php echo $clase;?>"><a href="prensa_noticia_alta.php?tipo=1&id_noticia=<?php echo $noti;?>" class="enlace_opcion">Modificar</a></span></td>
            </tr>
		  <?php 
		  	if ($color_fondo=="#FFFFFF"){
					$color_fondo="#E2E7EB";
				}
				else
				{
				$color_fondo="#FFFFFF";
				} 
		  }
		  ?>
        </table></td>
      </tr>
      <tr>
        <td></td>
      </tr>
      <tr>
        <td></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td bgcolor="#A8B6C6">&nbsp;</td>
  </tr>
  <tr>
    <td><div id="fuente" class="bloque">
      <p>&nbsp;</p>
    </div>
      <!--[if !IE]> Footer <![endif]-->
      <div id="footer" class="bloque">
        <p>| </p>
    </div></td>
  </tr>
</table>
</body>
</html>
