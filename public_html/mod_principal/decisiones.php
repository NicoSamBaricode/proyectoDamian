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
    
    // Get exercise parameters
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
    error_log("Decisiones error: " . $e->getMessage());
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
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
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
    if ( (frm.txt_precio_venta.value > <?php echo $PrecioVentaMax; ?> || frm.txt_precio_venta.value < <?php echo $PrecioVentaMin; ?>) || !/^([0-9])*$/.test(frm.txt_precio_venta.value) ){
        alert("Precio de venta. Debe ser un número entero, comprendido entre " + <?php echo $PrecioVentaMin; ?> + " y " + <?php echo $PrecioVentaMax; ?>); 
        frm.txt_precio_venta.focus();
        return (false); 
    }
     if ( (frm.txt_unidades.value > <?php echo $UnidadesMax; ?> || frm.txt_unidades.value < <?php echo $UnidadesMin; ?>) || !/^([0-9])*$/.test(frm.txt_unidades.value)){
        alert("Unidades a Producir. Debe ser un número entero, comprendido entre " + <?php echo $UnidadesMin; ?> + " y " + <?php echo $UnidadesMax; ?>); 
        frm.txt_unidades.focus();
        return (false); 
    }
    if ( (frm.txt_gastos_comer.value > <?php echo $GastosComercializacionMax; ?> || frm.txt_gastos_comer.value < <?php echo $GastosComercializacionMin; ?>) || !/^([0-9])*$/.test(frm.txt_gastos_comer.value) ){
        alert("Gastos de comercialización. Debe ser un número entero, comprendido entre " + <?php echo $GastosComercializacionMin; ?> + " y " + <?php echo $GastosComercializacionMax; ?>); 
        frm.txt_gastos_comer.focus();
        return (false); 
    }
    if ( (frm.txt_compra_bienes.value > <?php echo $CompraBienesUsoMax; ?> || frm.txt_compra_bienes.value < <?php echo $CompraBienesUsoMin; ?>) || !/^([0-9])*$/.test(frm.txt_compra_bienes.value)){
        alert("Compra bienes de uso. Debe ser un número entero, comprendido entre " + <?php echo $CompraBienesUsoMin; ?> + " y " + <?php echo $CompraBienesUsoMax; ?>); 
        frm.txt_compra_bienes.focus();
        return (false); 
    }
    if ( (frm.txt_innovacion.value > <?php echo $InnovacionMax; ?> || frm.txt_innovacion.value < <?php echo $InnovacionMin; ?>) || !/^([0-9])*$/.test(frm.txt_innovacion.value) ){
        alert("Innovación y desarrollo. Debe ser un número entero, comprendido entre " + <?php echo $InnovacionMin; ?> + " y " + <?php echo $InnovacionMax; ?>); 
        frm.txt_innovacion.focus();
        return (false); 
    }
    if ( (frm.txt_sustentabilidad.value > <?php echo $SustentabilidadMax; ?> || frm.txt_sustentabilidad.value < <?php echo $SustentabilidadMin; ?>) || !/^([0-9])*$/.test(frm.txt_sustentabilidad.value) ){
        alert("Sustentabilidad. Debe ser un número entero, comprendido entre " + <?php echo $SustentabilidadMin; ?> + " y " + <?php echo $SustentabilidadMax; ?>); 
        frm.txt_sustentabilidad.focus();
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
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
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
    <td align="left" valign="top" class="titulos_pantalla">Subir decisiones</td>
  </tr>
  <tr>
    <td align="left" valign="top"><table width="100%" border="0">
      <tr>
        <td><form action="decisiones_proc.php" method="post" enctype="multipart/form-data" name="form" id="form" onSubmit="return validar(this)">
          <p>&nbsp;</p>
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="300" height="30" class="borde_inferior">Precio de venta:</td>
              <td height="30" align="left" valign="bottom" class="borde_inferior">
              <input name="txt_precio_venta" type="text" id="txt_precio_venta" size="20" maxlength="20"/><?php echo "Min: ".$PrecioVentaMin." Max: ".$PrecioVentaMax; ?></td>
            </tr>
            <tr>
              <td width="300" height="30" class="borde_inferior">Unidades a producir:</td>
              <td height="30" align="left" valign="bottom" class="borde_inferior">
                <input name="txt_unidades" type="text" id="txt_unidades" size="20" maxlength="20"/>
                <strong>Min: 0 Max: La capacidad m&aacute;xima de tu f&aacute;brica para este Ejercicio Econ&oacute;mico</strong></td>
            </tr>
            <tr>
              <td width="300" height="30" class="borde_inferior">Gastos de comercializaci&oacute;n:</td>
              <td height="30" align="left" valign="bottom" class="borde_inferior">
                <input name="txt_gastos_comer" type="text" id="txt_gastos_comer" size="20" maxlength="20"/><?php echo "Min: ".$GastosComercializacionMin." Max: ".$GastosComercializacionMax; ?>
              </td>
            </tr>
            <tr>
              <td width="300" height="30" class="borde_inferior">Compra de bienes de uso:</td>
              <td height="30" align="left" valign="bottom" class="borde_inferior">
                <input name="txt_compra_bienes" type="text" id="txt_compra_bienes" size="20" maxlength="20" /><?php echo "Min: ".$CompraBienesUsoMin." Max: ".$CompraBienesUsoMax; ?>
              </td>
            </tr>
            <tr>
              <td width="300" height="30" class="borde_inferior"><strong>Desarrollo del talento humano</strong>:</td>
              <td height="30" align="left" valign="bottom" class="borde_inferior">
                <input name="txt_innovacion" type="text" id="txt_innovacion" size="20" maxlength="20"/><?php echo "Min: ".$InnovacionMin." Max: ".$InnovacionMax; ?>
              </td>
            </tr>
            <tr>
              <td width="300" height="30" class="borde_inferior">Innovaci&oacute;n y Sustentabilidad:</td>
              <td height="30" align="left" valign="bottom" class="borde_inferior">
                <input name="txt_sustentabilidad" type="text" id="txt_sustentabilidad" size="20" maxlength="20" /><?php echo "Min: ".$SustentabilidadMin." Max: ".$SustentabilidadMax; ?>
              </td>
            </tr>
            <tr>
              <td width="300" class="etiquetas">&nbsp;</td>
              <td align="left" valign="bottom">&nbsp;</td>
            </tr>
            <tr>
              <td width="300"><input type="hidden" name="control" id="control" /></td>
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