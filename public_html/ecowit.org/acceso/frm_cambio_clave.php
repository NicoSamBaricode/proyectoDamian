<?php 
//--------------------------------Inicio de sesion------------------------
include("../lib/sesion.php"); 
if ($_SESSION['permiso'] != 'autorizado' ){
	$mensaje="Usuario sin permisos";
	$destino="../index.php";
	header("location:mensaje_ok.php?mensaje=$mensaje&destino=$destino");
}
//--------------------------------Fin inicio de sesion------------------------

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<title>Usuario</title>

<link href="../css/estilos.css" rel="stylesheet" type="text/css">

<script language='javascript' src="../jscripts/funciones.js"></script>
<script type="text/javascript">

//---------------------Verificar abandono de la pagina-------------------//
var bPreguntar = true;
     
    window.onbeforeunload = preguntarAntesDeSalir;
     
    function preguntarAntesDeSalir()
    {
      if (bPreguntar)
        return "";
    }
//------------------Fin verificar abandono--------------------------//

function vacio(q) {  
        for ( i = 0; i < q.length; i++ ) {  
                if ( q.charAt(i) != " " ) {  
                        return true  
                }  
        }  
        return false  
}
//-------------Validaciones del formulario---------------------------//
function validar(frm) {

	if (vacio(document.form1.txt_clave.value)== false | document.form1.txt_clave.value.length<8 | document.form1.txt_clave.value.length>8 ){
  		alert("La clave debe tener 8 caracteres"); 
		document.form1.txt_clave.focus();
  		return (false); 
  	}
	
	if (vacio(document.form1.txt_usuario.value)== false | document.form1.txt_usuario.value.length<8 | document.form1.txt_usuario.value.length>8 ){
  		alert("El usuario debe tener 8 caracteres"); 
		document.form1.txt_usuario.focus();
  		return (false); 
  	}
	
	if (!confirm('¿Confirma el cambio de usuario y clave?')){   
	   return (false); 
   }
}


</script>

<link href="../css/estilos.css" rel="stylesheet" type="text/css" />
</head>


<body class="estilo_body">

<table width="770" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#DBDBDB">
 <tr>
  <td width="770"><?php include("../lib/encabezado.php"); ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#A8B6C6" class="titulos_pantalla">Cambio de usuario y clave</td>
  </tr>
  <tr>
    <td bgcolor="#A8B6C6"><table width="770" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><span class="etiquetas">8 caracteres para el nuevo usuario y 8 para la nueva clave, pueden ser letras,n&uacute;meros o combinaci&oacute;n de ambos.</span></td>
      </tr>
      <tr>
        <td><form id="form1" name="form1" method="post" onsubmit="return validar(this)" action="procesa_cambio_clave.php" >
            <table width="770" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td align="left" valign="middle" bgcolor="#D3DBE2"><table width="400" border="0" align="left" cellpadding="0" cellspacing="1" bordercolor="#FFFFFF">
                <tr>
                      <td width="150" align="left" valign="middle" bgcolor="#D3DBE2" class="etiquetas">Nuevo usuario:</td>
                      <td width="250" align="left" valign="middle" bgcolor="#D3DBE2"><label>
                        <input name="txt_usuario" type="text" id="txt_usuario" size="10" maxlength="8" />
                      </label></td>
                    </tr>
                    <tr>
                      <td width="150" align="left" valign="middle" bgcolor="#D3DBE2" class="etiquetas">Nueva clave :</td>
                      <td width="250" align="left" valign="middle" bgcolor="#D3DBE2"><input name="txt_clave" type="text" id="txt_clave" size="10" maxlength="8" onkeypress="return tabular(event,this)" /></td>
                    </tr>
                    <tr>
                      <td width="150" align="left" valign="middle" bgcolor="#D3DBE2" class="etiquetas">&nbsp;</td>
                      <td width="250" align="left" valign="middle" bgcolor="#D3DBE2">&nbsp;</td>
                    </tr>
                    <tr>
                      <td width="150" align="left" valign="middle" bgcolor="#D3DBE2" class="etiquetas"><input type="submit" name="Submit" value="Aceptar" onclick="bPreguntar = false;" /></td>
                      <td width="250" align="left" valign="middle" bgcolor="#D3DBE2"><label></label></td>
                    </tr>
                </table></td>
              </tr>
            </table>
        </form></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
