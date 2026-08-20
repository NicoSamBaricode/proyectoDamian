<?php
//--------------------------------Inicio de sesion------------------------
include("../lib/sesion.php"); 
if ($_SESSION['permiso'] != 'autorizado' ){
	$mensaje="Usuario sin permisos";
	$destino="../acceso/index.php";
	header("location:mensaje_ok.php?mensaje=$mensaje&destino=$destino");
}
//--------------------------------Fin inicio de sesion------------------------

	include("../lib/funciones.php");
	
	$link=conectarse();

if($_SESSION['tipo_jugador']=="Participante"){
	$query_documentos="select * from archivos where habilitado='1' order by nombre"; 
}
else
{
	$query_documentos="select * from archivos_invitado where habilitado='1' order by nombre";
}

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
</head>

<body>
<table width="770" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#F3F3F3">
  <tr>
    <td width="800" align="left" valign="middle"><?php include("../lib/encabezado.php"); ?></td>
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
        <td>
		<?php
		if ($_SESSION['permiso'] =="autorizado"){
		?>
		<table width="770" border="0" cellspacing="0" cellpadding="0">
        <tr>
        <td class="titulos_pantalla">Plantilla para la toma de decisiones del ejercicio <?php echo $doc["ejercicio"];?></td>
      </tr>
        <?php      
//-------------inicio bucle 2--------------------------
while($doc=mysql_fetch_array($documentos)){



//------------------------------------------------------------      
?> 
        <tr>
            <td align="left" valign="middle" bgcolor="#999999"></a></td>
          </tr>
		  <tr>
            <td height="30" align="left" valign="middle" bgcolor="#CCCCCC">
            <?php
            if($_SESSION['tipo_jugador']=="Participante"){
			?>
            	<a href="../ejersicios/<?php echo $doc["nombre"];?>" class="enlace_opcion"><?php echo $doc["nombre"];?></a>
            <?php
			}
			else
			{
			?>
            	<a href="../ejersicios_invitado/<?php echo $doc["nombre"];?>" class="enlace_opcion"><?php echo $doc["nombre"];?></a>
            <?php
			}
			?>
            </td>
          </tr>
<?php
		}
?>
        </table>
		<?php
		}
		?>		</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td class="titulos_pantalla">Descargar resultado</td>
      </tr>
      <tr>
        <td><table width="500" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><a href="descargar_resultados.php?idi=2" class="enlace_opcion">Ejercicio 2</a></td>
            <td><a href="descargar_resultados.php?idi=3" class="enlace_opcion">Ejercicio 3</a></td>
            <td><a href="descargar_resultados.php?idi=4" class="enlace_opcion">Ejercicio 4</a></td>
            <td><a href="descargar_resultados.php?idi=5" class="enlace_opcion">Ejercicio 5</a></td>
            <td><a href="descargar_resultados.php?idi=6" class="enlace_opcion">Ejercicio 6</a></td>
          </tr>
        </table></td>
      </tr>
       <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td class="titulos_pantalla">Descargar infome de zona</td>
      </tr>
      <tr>
        <td><table width="500" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><a href="descargar_informe.php?idi=2" class="enlace_opcion">Ejercicio 2</a></td>
            <td><a href="descargar_informe.php?idi=3" class="enlace_opcion">Ejercicio 3</a></td>
            <td><a href="descargar_informe.php?idi=4" class="enlace_opcion">Ejercicio 4</a></td>
            <td><a href="descargar_informe.php?idi=5" class="enlace_opcion">Ejercicio 5</a></td>
            <td><a href="descargar_informe.php?idi=6" class="enlace_opcion">Ejercicio 6</a></td>
            </tr>
        </table></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td class="titulos_pantalla">Ver decisiones subidas</td>
      </tr>
      <tr>
        <td><table width="650" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><a href="descargar_mis_desiciones.php?idi=2" class="enlace_opcion">Decisiones 2</a></td>
            <td><a href="descargar_mis_desiciones.php?idi=3" class="enlace_opcion">Decisiones 3</a></td>
            <td><a href="descargar_mis_desiciones.php?idi=4" class="enlace_opcion">Decisiones 4</a></td>
            <td><a href="descargar_mis_desiciones.php?idi=5" class="enlace_opcion">Decisiones 5</a></td>
            <td><a href="descargar_mis_desiciones.php?idi=6" class="enlace_opcion">Decisiones 6</a></td>
            <td><a href="descargar_mis_desiciones.php?idi=7" class="enlace_opcion">Mi cuestionario</a></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><a href="subir_ejercicio.php" class="enlace_opcion">Subir decisiones &gt;&gt;</a></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><a href="../acceso/logout.php" class="enlace_opcion">Salir &gt;&gt;</a></td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
