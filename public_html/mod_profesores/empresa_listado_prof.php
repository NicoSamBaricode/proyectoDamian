<?php 
include("../lib/funciones.php");

//--------------------------------Inicio de sesion------------------------
include("../lib/sesion.php"); 
if ($_SESSION['permiso'] == 'autorizado' and $_SESSION['privilegio']=='3'){
	
//--------------------------------Fin inicio de sesion------------------------
//-------Parametros--------------------------------

$usuario=$_SESSION['id'];


//-------------------------------------------------

//---------------Querys-----------------------------



$link=conectarse();


$query_noticias="select id_empresa,nombre,abreviatura,provincia,ciudad,zona,us,pas,nom_archivo from usuarios_simu where profesor='$usuario' order by nombre";


$record_noticias=mysql_query($query_noticias,$link);



//--------------Fin querys----------------------------


?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<title>Listado de tramites</title>

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

</script>


<link href="../css/estilos.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style17 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; }
-->
</style>
<link href="css/estilos.css" rel="stylesheet" type="text/css" />
</head>


<body class="estilo_body_2" onLoad="document.form1.txt_descripcion.focus();">

<table width="770" border="0" align="center" cellpadding="0" cellspacing="0">
 <tr>
  <td width="770"></td>
  </tr>
  <tr>
    <td><?php include("../lib/encabezado_prof.php"); ?></td>
  </tr>
  <tr>
    <td bordercolor="0"><table width="80" border="0">
        <tr>
          <td width="40"><?php include("../includes/menu_sup_prof.php"); ?></td>
          <td width="40"><a href="../acceso/logout.php"><img src="../images/salir.gif" width="40" height="40" border="0" /></a></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td bgcolor="#A8B6C6" class="titulos_pantalla">Listado de empresas</td>
  </tr>
  <tr>
    <td bgcolor="#A8B6C6"><table width="770" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><a href="empresa_alta.php" class="enlace_opcion">Nueva </a></td>
      </tr>
      <tr>
        <td bgcolor="#D3DBE2"><table width="770" border="0" cellspacing="1">
          <tr>
            <td bgcolor="#A8B6C6" class="etiquetas">Equipo</td>
            <td bgcolor="#A8B6C6" class="etiquetas">Zona</td>
            <td bgcolor="#A8B6C6" class="etiquetas">Nom archivo</td>
            <td bgcolor="#A8B6C6" class="etiquetas">Ciudad</td>
            <td bgcolor="#A8B6C6" class="etiquetas">Provincia</td>
            <td bgcolor="#A8B6C6" class="etiquetas">Usuario</td>
            <td bgcolor="#A8B6C6" class="etiquetas">Clave</td>
            <td bgcolor="#A8B6C6" class="etiquetas">&nbsp;</td>
            </tr>
		  <?php 
		  $color_fondo="#FFFFFF";
		  while($noticias=mysql_fetch_array($record_noticias)){ 
		  ?>
          <form action="../acceso/login.php" method="post">
              <tr>
                <td bgcolor="<?php echo $color_fondo; ?>" class="datos"><?php echo $noticias["nombre"];?></td>
                <td bgcolor="<?php echo $color_fondo; ?>" class="datos"><?php echo $noticias["zona"];?></td>
                <td bgcolor="<?php echo $color_fondo; ?>" class="datos"><?php echo $noticias["nom_archivo"];?></td>
                <td bgcolor="<?php echo $color_fondo; ?>" class="datos"><?php echo $noticias["ciudad"];?></td>
                <td bgcolor="<?php echo $color_fondo; ?>" class="datos"><?php echo $noticias["provincia"];?></td>
                <td bgcolor="<?php echo $color_fondo; ?>" class="datos">
                <?php echo $noticias["us"];?>
                  <input name="txtUser"  type="hidden" id="txtUser" value="<?php echo $noticias["us"];?>" />
                </td>
                <td bgcolor="<?php echo $color_fondo; ?>" class="datos">
                	<?php echo $noticias["pas"];?>
                  <input name="txtPass" type="hidden" id="txtPass" value="<?php echo $noticias["pas"];?>" />
               </td>
                <td bgcolor="<?php echo $color_fondo; ?>" class="<?php echo $clase;?>"><input type="submit" name="button" id="button" value="Ir" /></td>
                </tr>
          </form>
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