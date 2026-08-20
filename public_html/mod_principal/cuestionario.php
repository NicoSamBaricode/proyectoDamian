<?php

header("Content-Type: text/html;charset=iso-8859-1");

//--------------------------------Inicio de sesion------------------------
require_once __DIR__ . '/../lib/sesion.php'; 
require_once __DIR__ . '/../lib/funciones.php';

if ($_SESSION['permiso'] != 'autorizado'){
    $mensaje = "Usuario sin permisos";
    $destino = "../ingreso_certamen.php";
    include("../includes/mensaje.php");
    exit();
}

if ($_SESSION['subir'] == 0){	
    $mensaje = "El plazo para subir decisiones ha finalizado.";
    $destino = "menu_principal.php";
    include("../includes/mensaje.php");	
    exit();
}

//--------------------------------Fin inicio de sesion------------------------
$ejercicio = $_SESSION['ejercicio'];

try {
    $pdo = conectarse();
    
    // Get document list
    $stmt = $pdo->prepare("SELECT * FROM archivos WHERE habilitado='1' ORDER BY nombre");
    $stmt->execute();
    $documentos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Get exercise parameters (from archivos table)
    $stmt = $pdo->prepare("
        SELECT PrecioVentaMin, PrecioVentaMax, UnidadesMin, UnidadesMax, 
               GastosComercializacionMin, GastosComercializacionMax, 
               CompraBienesUsoMin, CompraBienesUsoMax, InnovacionMin, InnovacionMax, 
               SustentabilidadMin, SustentabilidadMax
        FROM archivos
        WHERE ejercicio = ?
    ");
    $stmt->execute([$ejercicio]);
    $parametros = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$parametros) {
        $mensaje = "No se encontraron parámetros para el ejercicio actual.";
        $destino = "menu_principal.php";
        include("../includes/mensaje.php");
        exit();
    }
    
    $PrecioVentaMin = $parametros["PrecioVentaMin"];
    $PrecioVentaMax = $parametros["PrecioVentaMax"];
    $UnidadesMin = $parametros["UnidadesMin"];
    $UnidadesMax = $parametros["UnidadesMax"];
    $GastosComercializacionMin = $parametros["GastosComercializacionMin"];
    $GastosComercializacionMax = $parametros["GastosComercializacionMax"];
    $CompraBienesUsoMin = $parametros["CompraBienesUsoMin"];
    $CompraBienesUsoMax = $parametros["CompraBienesUsoMax"];
    $InnovacionMin = $parametros["InnovacionMin"];
    $InnovacionMax = $parametros["InnovacionMax"];
    $SustentabilidadMin = $parametros["SustentabilidadMin"];
    $SustentabilidadMax = $parametros["SustentabilidadMax"];
    
} catch (PDOException $e) {
    error_log("Cuestionario error: " . $e->getMessage());
    $mensaje = "Error de conexión a la base de datos.";
    $destino = "menu_principal.php";
    include("../includes/mensaje.php");
    exit();
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
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
<script language='javascript' src="../jscripts/funciones.js"></script>
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
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n].
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}
function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//-->
</script>
//-------------Validaciones del formulario---------------------------//
function validar(frm) {
    if ( (frm.txt_1.value == "") || (frm.txt_2.value == "") || (frm.txt_3.value == "") || (frm.txt_4.value == "") || (frm.txt_5.value == "") || (frm.txt_6.value == "") || (frm.txt_7.value == "") || (frm.txt_8.value == "") || (frm.txt_9.value == "") || (frm.txt_10.value == "") ){
        alert("Todas las respuestas son obligatorias"); 
        return (false); 
    }
}
//-------------Fin validaciones del formulario---------------------------//   
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
</style>
</head>
<body onload="MM_preloadImages('../images/inicio_on.gif')">
<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="800" align="left" valign="top"><?php include("../lib/encabezado.php"); ?></td>
  </tr>
  <tr>
    <td align="left" valign="top"><table width="200" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td align="left" valign="top"><a href="menu_principal.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image1','','../images/inicio_on.gif',1)"> <img src="../images/inicio.gif" alt="" name="Image1" width="32" height="32" border="0" id="Image1" /></a></td>
        <td align="left" valign="top">&nbsp;</td>
        <td align="left" valign="top">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align="left" valign="top" class="titulos_pantalla">Cuestionario de Autoformaci&oacute;n 2019</td>
  </tr>
  <tr>
    <td align="left" valign="top"><table width="1000" border="0">
      <tr>
        <td><form action="cuestionario_proc.php" method="post" enctype="multipart/form-data" name="form" id="form" onSubmit="return validar(this)">
          <p>&nbsp;</p>
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="900" height="60" class="borde_inferior">1)Cada miembro  del equipo tiene una concreta personalidad y unas habilidades, conocimientos y  experiencias espec&iacute;ficas que aportar, que se diferencian de las del resto de  miembros del equipo. </td>
              <td height="60" align="center" valign="middle" class="borde_inferior"><select name="txt_1" id="txt_1">
                <option>V</option>
                <option>F</option>
              </select>
              <label></label></td>
            </tr>
            <tr>
              <td width="900" height="60" class="borde_inferior">2) Ser optimista es ser capaz de ver las cosas en su aspecto m&aacute;s favorable.  De esta forma se infunde moral y &aacute;nimo a los miembros del equipo. Cuando se es  positivo, es f&aacute;cil disfrutar con la tarea, involucrarse con los objetivos del  equipo y motivarse cada vez m&aacute;s.</td>
              <td height="60" align="center" valign="middle" class="borde_inferior"><strong>
              <select name="txt_2" id="txt_2">
                <option>V</option>
                <option>F</option>
              </select>
              </strong></td>
            </tr>
            <tr>
              <td width="900" height="60" class="borde_inferior">3) El desarrollo integral de la persona humana en  el trabajo contradice la mayor productividad y eficacia del trabajo mismo. El  mundo del trabajo, en efecto, est&aacute; descubriendo cada vez m&aacute;s que el valor del  capital financiero reside en los conocimientos de los trabajadores.</td>
              <td height="60" align="center" valign="middle" class="borde_inferior"><select name="txt_3" id="txt_3">
                <option>V</option>
                <option>F</option>
              </select></td>
            </tr>
            <tr>
              <td width="900" height="60" class="borde_inferior">4) La relaci&oacute;n entre trabajo y  capital se realiza tambi&eacute;n mediante la participaci&oacute;n de los trabajadores en la  propiedad, en su gesti&oacute;n y en sus frutos. Esta es una  exigencia frecuentemente olvidada, que es necesario, por tanto, valorar mejor.</td>
              <td height="60" align="center" valign="middle" class="borde_inferior"><select name="txt_4" id="txt_4">
                <option>V</option>
                <option>F</option>
              </select></td>
            </tr>
            <tr>
              <td width="900" height="60" class="borde_inferior">5)La empresa debe caracterizarse por la capacidad de servir al bien  particular de la sociedad mediante la producci&oacute;n de bienes y servicios &uacute;tiles, con una l&oacute;gica de rentabilidad ilimitada y de  satisfacci&oacute;n de los intereses de los diversos sujetos implicados. </td>
              <td height="60" align="center" valign="middle" class="borde_inferior"><select name="txt_5" id="txt_5">
                <option>V</option>
                <option>F</option>
              </select></td>
            </tr>
            <tr>
              <td width="900" height="60" class="borde_inferior">6)Es indispensable que, dentro de la empresa, la leg&iacute;tima b&uacute;squeda del  beneficio se armonice con la irrenunciable tutela de la dignidad de las  personas que a t&iacute;tulo diverso trabajan en la misma.&nbsp;Estas dos exigencias no se oponen en  absoluto. </td>
              <td height="60" align="center" valign="middle" class="borde_inferior"><select name="txt_6" id="txt_6">
                <option>V</option>
                <option>F</option>
              </select></td>
            </tr>
            <tr>
              <td width="900" height="60" class="borde_inferior">7) Se ha logrado adoptar un modelo circular de producci&oacute;n que asegure  recursos para todos y para las generaciones futuras, y que supone limitar al m&aacute;ximo  el uso de los recursos renovables, maximizar el consumo, moderar la eficiencia  del aprovechamiento, reutilizar y reciclar.</td>
              <td height="60" align="center" valign="middle" class="borde_inferior"><select name="txt_7" id="txt_7">
                <option>V</option>
                <option>F</option>
              </select></td>
            </tr>
            <tr>
              <td width="900" height="60" class="borde_inferior">8) La p&eacute;rdida de selvas y bosques implica al mismo tiempo la p&eacute;rdida de  especies que podr&iacute;an significar en el futuro recursos sumamente importantes, no  s&oacute;lo para la alimentaci&oacute;n, sino tambi&eacute;n para la curaci&oacute;n de enfermedades y para  m&uacute;ltiples servicios.</td>
              <td height="60" align="center" valign="middle" class="borde_inferior"><select name="txt_8" id="txt_8">
                <option>V</option>
                <option>F</option>
              </select></td>
            </tr>
            <tr>
              <td width="900" height="60" class="borde_inferior">9) La ecolog&iacute;a estudia las relaciones entre los organismos vivientes y el  ambiente donde se desarrollan. No exige sentarse a pensar y a discutir acerca  de las condiciones de vida, de supervivencia de una sociedad ni poner en duda  modelos de desarrollo, producci&oacute;n y consumo.</td>
              <td height="60" align="center" valign="middle" class="borde_inferior"><select name="txt_9" id="txt_9">
                <option>V</option>
                <option>F</option>
              </select></td>
            </tr>
            <tr>
              <td width="900" height="70" class="borde_inferior">10) Es fundamental buscar soluciones integrales que consideren las  interacciones de los sistemas naturales entre s&iacute; y con los sistemas sociales.  No hay dos crisis separadas, una ambiental y otra social, sino una sola y  compleja crisis socio-ambiental.</td>
              <td height="70" align="center" valign="middle" class="borde_inferior"><select name="txt_10" id="txt_10">
                <option>V</option>
                <option>F</option>
              </select></td>
            </tr>
            <tr>
              <td width="900" class="etiquetas">&nbsp;</td>
              <td align="left" valign="bottom">&nbsp;</td>
            </tr>
            <tr>
              <td width="800"><input type="hidden" name="control" id="control" /></td>
              <td><input name='Guardar' type='submit' value='Guardar'/></td>
            </tr>
          </table>
          <p>&nbsp;</p>
        </form></td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>