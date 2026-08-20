<?php

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
</head>

<body>

<script type="text/JavaScript">

function simular() {

	document.form1.e8.value=((parseFloat(document.form1.b11.value) + parseFloat(document.form1.b16.value)) * parseFloat(document.form1.b15.value)).toFixed(2);
	document.form1.e10.value=parseFloat(document.form1.e8.value) + parseFloat(document.form1.e9.value);
	document.form1.e11.value=parseFloat(document.form1.b17.value)* (-1);
	document.form1.e12.value=parseFloat(document.form1.b9.value)* 0.05;
	document.form1.e13.value=parseFloat(document.form1.b19.value)* (-1);
	document.form1.e14.value=parseFloat(document.form1.b20.value)* (-1);
	document.form1.e18.value=parseFloat(document.form1.e10.value) + 
		parseFloat(document.form1.e11.value)+ parseFloat(document.form1.e12.value)+ parseFloat(document.form1.e13.value)+
		parseFloat(document.form1.e14.value)+ parseFloat(document.form1.e15.value)+ parseFloat(document.form1.e16.value)+parseFloat(document.form1.e17.value);
}
//-------------Fin validaciones del formulario---------------------------//   

//---------------------Verificar abandono de la pagina-------------------//
var bPreguntar = true;
     
    window.onbeforeunload = preguntarAntesDeSalir;
     
    function preguntarAntesDeSalir()
    {
      if (bPreguntar)
        return "";
    }
//------------------Fin verificar abandono--------------------------//

</script>
<table width="770" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#F3F3F3">
  <tr>
    <td width="800" align="left" valign="middle"><?php include("lib/encabezado.php"); ?></td>
  </tr>
  <tr>
    <td height="5" align="left" valign="middle"></td>
  </tr>
  <tr>
    <td align="left" valign="middle" class="titulos_pantalla">Menú principal</td>
  </tr>
  <tr>
    <td align="left" valign="middle">
    <table width="770" border="0">
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td class="titulos_pantalla">Descargar resultado</td>
      </tr>
      <tr>
        <td><form id="form1" name="form1" method="post" action="">
          <table width="520" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td align="left" valign="top"><table width="500" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td colspan="2">Ingresá la siguiente información de tu Ejercicio    Anterior</td>
                  </tr>
                  <tr>
                    <td class="etiquetas">Caja y    Bancos (Del Activo Corriente)</td>
                    <td><label>
                      <input name="b6" type="text" id="b6" size="20" maxlength="20" />
                    </label></td>
                  </tr>
                  <tr>
                    <td class="etiquetas">Inversiones    (Del Activo Corriente)</td>
                    <td><input name="b7" type="text" id="b7" size="20" maxlength="20" /></td>
                  </tr>
                  <tr>
                    <td class="etiquetas">Bienes    de Cambio (Del Activo Corriente)</td>
                    <td><input name="b8" type="text" id="b8" size="20" maxlength="20" /></td>
                  </tr>
                  <tr>
                    <td class="etiquetas">Bienes    de Uso (Del Activo no Corriente)</td>
                    <td><input name="b9" type="text" id="b9" size="20" maxlength="20" /></td>
                  </tr>
                  <tr>
                    <td class="etiquetas">Préstamos    (Del Pasivo Corriente)</td>
                    <td><input name="b10" type="text" id="b10" size="20" maxlength="20" /></td>
                  </tr>
                  <tr>
                    <td class="etiquetas">Unidades    en Inventario (Del Inf. de Producción)</td>
                    <td><input name="b11" type="text" id="b11" size="20" maxlength="20" /></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan="2">Ingresá las decisiones del Ejercicio que se desea    simular</td>
                  </tr>
                  <tr>
                    <td class="etiquetas">Precio    de venta</td>
                    <td><input name="b15" type="text" id="b15" size="20" maxlength="20" /></td>
                  </tr>
                  <tr>
                    <td class="etiquetas">Unidades    a producir</td>
                    <td><input name="b16" type="text" id="b16" size="20" maxlength="20" /></td>
                  </tr>
                  <tr>
                    <td class="etiquetas">Gastos    de comercialización</td>
                    <td><input name="b17" type="text" id="b17" size="20" maxlength="20" /></td>
                  </tr>
                  <tr>
                    <td class="etiquetas">Compra    de bienes de uso</td>
                    <td><input name="b18" type="text" id="b18" size="20" maxlength="20" /></td>
                  </tr>
                  <tr>
                    <td class="etiquetas">Innovación    y desarrollo</td>
                    <td><input name="b19" type="text" id="b19" size="20" maxlength="20" /></td>
                  </tr>
                  <tr>
                    <td class="etiquetas">Responsabilidad    Social</td>
                    <td><input name="b20" type="text" id="b20" size="20" maxlength="20" /></td>
                  </tr>
              </table></td>
              <td align="left" valign="top"><table width="520" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td class="etiquetas">ESTADO DE RESULTADOS / INCOME STATEMENT</td>
                    <td colspan="3" class="etiquetas">Distintos    escenarios si se venden los siguientes porcentajes de tus Unidades Ofertadas</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td class="etiquetas">100% de las U. Ofertadas</td>
                    <td class="etiquetas">75% de las U. Ofertadas</td>
                    <td class="etiquetas">50% de lasU. Ofertadas</td>
                  </tr>
                  <tr>
                    <td class="etiquetas">Ventas    Brutas / Gross Sales</td>
                    <td><input name="e8" type="text" id="e8" size="20" maxlength="20" readonly="readonly"/></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td class="etiquetas">Costo de mercaderías vend./ Cost of goods sold</td>
                    <td><input name="e9" type="text" id="e9" value="0" size="20" maxlength="20" readonly="readonly" /></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td class="etiquetas">Resultado Bruto / Gross Result</td>
                    <td><input name="e10" type="text" id="e10" size="20" maxlength="20" readonly="readonly"/></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td class="etiquetas">Gastos de comercialización/Commercial Expenses</td>
                    <td><input name="e11" type="text" id="e11" size="20" maxlength="20" readonly="readonly" /></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td class="etiquetas">Depreciación / Depreciation</td>
                    <td><input name="e12" type="text" id="e12" size="20" maxlength="20" readonly="readonly" /></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td class="etiquetas">Innovación y Desarrollo / Innovation &amp; Development</td>
                    <td><input name="e13" type="text" id="e13" size="20" maxlength="20" readonly="readonly" /></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td class="etiquetas">Responsabilidad Social  / Social Responsibility</td>
                    <td><input name="e14" type="text" id="e14" size="20" maxlength="20" readonly="readonly" /></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td class="etiquetas">Auditoría / Auditing</td>
                    <td><input name="e15" type="text" id="e15" value="0" size="20" maxlength="20" readonly="readonly" /></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td class="etiquetas">Gastos de inventario / Inventory Expenses</td>
                    <td><input name="e16" type="text" id="e16" value="0" size="20" maxlength="20" readonly="readonly" /></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td class="etiquetas">Resultados financieros / Financial Results</td>
                    <td><input name="e17" type="text" id="e17" value="0" size="20" maxlength="20" readonly="readonly" /></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td class="etiquetas">Resultado antes de Imp. / Result before tax</td>
                    <td><input name="e18" type="text" id="e18" value="0" size="20" maxlength="20" readonly="readonly" /></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td class="etiquetas">Impuesto a las Ganancias / Income tax expense</td>
                    <td><input name="e19" type="text" id="e19" value="0" size="20" maxlength="20" readonly="readonly" /></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td class="etiquetas">Resultado Neto / Net Income or Loss</td>
                    <td><input name="e20" type="text" id="e20" value="0" size="20" maxlength="20" readonly="readonly" /></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
              </table></td>
            </tr>
            <tr>
              <td align="left" valign="top"><label>
                <input type="button" name="button" id="button" value="simular" onclick="simular();" />
              </label></td>
              <td align="left" valign="top">&nbsp;</td>
            </tr>
          </table>
                </form>
        </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
