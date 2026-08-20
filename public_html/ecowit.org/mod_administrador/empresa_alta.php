<?php
include("../lib/funciones.php");

//--------------------------------Inicio de sesion------------------------
include("../lib/sesion.php"); 
if ($_SESSION['permiso'] == 'autorizado' and $_SESSION['privilegio']=='1'){

$usuario=$_SESSION['id'];
//--------------------------------Fin inicio de sesion------------------------

$link=conectarse();


/////Cargo Valores del contenido
if (isset($_GET['id_empresa'])){

	$id_empresa=$_GET['id_empresa'];
	$sql="select id_empresa,nombre,ciudad,provincia,nom_archivo,zona,us,pas,tipo_jugador from usuarios_simu where id_empresa='$id_empresa'";
	$result=mysql_query($sql,$link);
	
	while($row=mysql_fetch_array($result)){
			$id_empresa=$row["id_empresa"];
			$nombre=$row["nombre"];
			$ciudad=$row["ciudad"];
			$provincia=$row["provincia"];
			$nom_archivo=$row["nom_archivo"];
			$zona=$row["zona"];
			$usuario=$row["us"];
			$clave=$row["pas"];		
			$tipo_jugador=$row["tipo_jugador"];
	}

}
else{
	$id_empresa="";
	$nombre="";
	$nom_archivo="";
	$zona="";
	$usuario="";
	$clave="";
	$tipo_jugador="..";
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
<title>Empresa</title>
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
    <td><a href='empresa_listado.php' target="_self" class="enlace_opcion">Listado de empresas</a></td>
  </tr>
  <tr>
    <td><form action="empresa_alta_proc.php" method="post"  enctype="multipart/form-data" name='form' id="form">
      <p>
        <input name="id_empresa" type="hidden" id="id_empresa" value="<?php echo $id_empresa; ?>" />
      </p>
      <table width="800" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td>Nombre de fantasia:</td>
          <td><label>
          <input name="txt_nombre_fantasia" type="text" id="txt_nombre_fantasia" value="<?php echo $nombre; ?>" size="50" maxlength="50"/>
          </label></td>
        </tr>
        <tr>
          <td>Ciudad:</td>
          <td><label>
          <input name="txt_ciudad" type="text" id="txt_ciudad" value="<?php echo $ciudad; ?>" size="50" maxlength="50"/>
          </label></td>
        </tr>
        <tr>
          <td>Provincia:</td>
          <td><label>
          <input name="txt_provincia" type="text" id="txt_provincia" value="<?php echo $provincia; ?>" size="50" maxlength="50"/>
          </label></td>
        </tr>
        <tr>
          <td>Nombre de archivo:</td>
          <td><label>
            <input name="txt_nom_archivo" type="text" id="txt_nom_archivo" value="<?php echo $nom_archivo; ?>" size="10" maxlength="10" />
          </label></td>
        </tr>

        <tr>
          <td>Zona:</td>
          <td><label>
            <input name="txt_zona" type="text" id="txt_zona" value="<?php echo $zona; ?>" size="5" maxlength="2"/>
          </label></td>
        </tr>
        <tr>
          <td>Usuario:</td>
          <td><label>
            <input type="text" name="txt_usuario" id="txt_usuario" value="<?php echo $usuario; ?>" />
          </label></td>
        </tr>

        <tr>
          <td>Clave:</td>
          <td><input type="text" name="txt_clave" id="txt_clave" value="<?php echo $clave; ?>"/></td>
        </tr>
        <tr>
          <td>Tipo de jugador:</td>
          <td><select name="tipo_jugador" id="tipo_jugador">
            <option><?php echo $tipo_jugador; ?></option>
            <option>Invitado</option>
            <option>Participante</option>
          </select>
          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><input type="hidden" name="control" id="control" /></td>
          <td><input name='Guardar' type='submit' value='Guardar'/></td>
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