<?php
include("../lib/funciones.php");

//--------------------------------Inicio de sesion------------------------
include("../lib/sesion.php"); 
if ($_SESSION['permiso'] == 'autorizado' and $_SESSION['privilegio']=='1'){

$usuario=$_SESSION['id'];
//--------------------------------Fin inicio de sesion------------------------

$link=conectarse();


/////Cargo Valores del contenido
if (isset($_GET['ejer'])){

	$id_parametro=$_GET['ejer'];
	$sql="select id_file, PrecioVentaMin, PrecioVentaMax,UnidadesMin,UnidadesMax, GastosComercializacionMin, GastosComercializacionMax, CompraBienesUsoMin, CompraBienesUsoMax, InnovacionMin, 	InnovacionMax, SustentabilidadMin, SustentabilidadMax from archivos where id_file='$id_parametro'";
	
	$recordset=mysql_query($sql,$link);
	
	$parametros=mysql_fetch_array($recordset);
	
	$PrecioVentaMin=$parametros["PrecioVentaMin"];
	$PrecioVentaMax=$parametros["PrecioVentaMax"];
	
	$UnidadesMin=$parametros["UnidadesMin"];
	$UnidadesMax=$parametros["UnidadesMax"];

	$GastosComercializacionMin=$parametros["GastosComercializacionMin"];
	$GastosComercializacionMax=$parametros["GastosComercializacionMax"];

	$CompraBienesUsoMin=$parametros["CompraBienesUsoMin"];
	$CompraBienesUsoMax=$parametros["CompraBienesUsoMax"];
	
	$InnovacionMin=$parametros["InnovacionMin"];
	$InnovacionMax=$parametros["InnovacionMax"];
	
	$SustentabilidadMin=$parametros["SustentabilidadMin"];
	$SustentabilidadMax=$parametros["SustentabilidadMax"];
	

}
else{
	
	$PrecioVentaMin="";
	$PrecioVentaMax="";

	$GastosComercializacionMin="";
	$GastosComercializacionMax="";

	$CompraBienesUsoMin="";
	$CompraBienesUsoMax="";
	
	$InnovacionMin="";
	$InnovacionMax="";
	
	$SustentabilidadMin="";
	$SustentabilidadMax="";
}
/////fin Cargo Valores del contenido

if (isset($_GET['control'])){
	$control=1;
}
else
{
	$control=0;
}

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Parametros</title>
<link href="css/estilos.css" rel="stylesheet" type="text/css" />
</head>

<body onload="document.form.control.value=<?php echo $control;?>;if(document.form.control.value==1){alert('Datos guardados correctamente')};">
<table width="621" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><span><b><?php echo date("D");?></b></span>
      <!--[if !IE]> Dia <![endif]-->
      <span class="barrita">|</span> <span> <?php echo date("M");?> </span>
      <!--[if !IE]> Mes <![endif]-->
      <span class="barrita">|</span> <span><?php echo date("Y");?></span>
      <!--[if !IE]> Año <![endif]-->
      <span> <?php echo date("H:m");?> </span></td>
  </tr>
  <tr>
    <td class="titulos_pantalla">Alta/Modificacion de empresa</td>
  </tr>
  <tr>
    <td><?php include("../includes/menu_sup.php");?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><form action="setea_parametros.php" method="post"  enctype="multipart/form-data" name='form' id="form">
      <p>
        <input name="id_ejer" type="hidden" id="id_ejer" value="<?php echo $id_parametro; ?>"/>
      </p>
      <table width="800" border="0" cellspacing="0" cellpadding="0">
      <tr>
          <td>&nbsp;</td>
          <td>Minimo</td>
          <td>M&aacute;ximo</td>
        </tr>
        <tr>
          <td>Precio de venta:</td>
          <td><label>
          <input name="txt_1_min" type="text" id="txt_1_min" value="<?php echo $PrecioVentaMin; ?>" size="20" maxlength="20"/>
          </label></td>
          <td><input name="txt_1_max" type="text" id="txt_1_max" value="<?php echo $PrecioVentaMax; ?>" size="20" maxlength="20"/></td>
        </tr>
        <tr>
          <td>Unidades a producir:</td>
          <td><label>
            <input name="txt_2_min" type="text" id="txt_2_min" value="<?php echo $UnidadesMin; ?>" size="20" maxlength="20"/>
          </label></td>
          <td><input name="txt_2_max" type="text" id="txt_2_max" value="<?php echo $UnidadesMax; ?>" size="20" maxlength="20"/></td>
        </tr>
        <tr>
          <td>Gastos de comercializaci&oacute;n:</td>
          <td><label>
            <input name="txt_3_min" type="text" id="txt_3_min" value="<?php echo $GastosComercializacionMin; ?>" size="20" maxlength="20"/>
          </label></td>
          <td><input name="txt_3_max" type="text" id="txt_3_max" value="<?php echo $GastosComercializacionMax; ?>" size="20" maxlength="20"/></td>
        </tr>
        <tr>
          <td>Compra de bienes de uso:</td>
          <td><label>
            <input name="txt_4_min" type="text" id="txt_4_min" value="<?php echo $CompraBienesUsoMin; ?>" size="20" maxlength="20"/>
          </label></td>
          <td><input name="txt_4_max" type="text" id="txt_4_max" value="<?php echo $CompraBienesUsoMax; ?>" size="20" maxlength="20"/></td>
        </tr>

        <tr>
          <td>Desarrollo del talento humano:</td>
          <td><label>
            <input name="txt_5_min" type="text" id="txt_5_min" value="<?php echo $InnovacionMin; ?>" size="20" maxlength="20"/>
          </label></td>
          <td><input name="txt_5_max" type="text" id="txt_5_max" value="<?php echo $InnovacionMax; ?>" size="20" maxlength="20"/></td>
        </tr>
        <tr>
          <td>Innovación y Sustentabilidad:</td>
          <td><label>
            <input name="txt_6_min" type="text" id="txt_6_min" value="<?php echo $SustentabilidadMin; ?>" size="20" maxlength="20"/>
          </label></td>
          <td><input name="txt_6_max" type="text" id="txt_6_max" value="<?php echo$SustentabilidadMax; ?>" size="20" maxlength="20"/></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><input type="hidden" name="control" id="control" /></td>
          <td><input name='Guardar' type='submit' value='Guardar'/></td>
          <td><label>
            <input type="button" name="button" id="button" value="Cancelar"  onclick="location.href='listado_ejercicios.php';" />
          </label></td>
        </tr>
      </table>
      <p>&nbsp;</p>
    </form></td>
  </tr>
</table>
</body>
</html>
<?php
//------------------Fin secion
}
else
{
$mensaje="Usuario sin permisos";
$destino="../ingreso_certamen.php";
include("../includes/mensaje.php");
}

?>