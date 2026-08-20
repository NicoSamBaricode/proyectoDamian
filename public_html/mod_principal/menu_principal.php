<?php

header("Content-Type: text/html;charset=iso-8859-1");

//--------------------------------Inicio de sesion------------------------

require_once __DIR__ . '/../lib/sesion.php'; 

if ($_SESSION['permiso'] != 'autorizado' ){
    $mensaje="Usuario sin permisos";
    $destino="../acceso/index.php";
    header("location:mensaje_ok.php?mensaje=" . urlencode($mensaje) . "&destino=" . urlencode($destino));
    exit();
}

//--------------------------------Fin inicio de sesion------------------------

require_once __DIR__ . '/../lib/funciones.php';

$ejercicio = $_SESSION['ejercicio'];

if($_SESSION['tipo_jugador']=="Participante"){
    $query_documentos = "select * from archivos where habilitado='1' order by nombre"; 
} else {
    $query_documentos = "select * from archivos_invitado where habilitado='1' order by nombre";
}

$pdo = conectarse();
$stmt = $pdo->prepare($query_documentos);
$stmt->execute();
$documentos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Query for descargas
$query_descargas = "select titulo, archivo from informacion order by titulo";
$stmtDesc = $pdo->prepare($query_descargas);
$stmtDesc->execute();
$rec_descargas = $stmtDesc->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Empresa</title>
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
<link href="../../mod_principal/estilos_relevamiento.css" rel="stylesheet" type="text/css" /><link href="../../css/estilos.css" rel="stylesheet" type="text/css" />
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
<body>
<table width="90%" border="0" align="center">
  <tr>
    <td><?php include("../lib/encabezado.php"); ?></td>
  </tr>
  <tr>
    <td align="left" valign="bottom">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" valign="middle">
    <?php if($ejercicio==7){ ?>
    	<a href="cuestionario.php" class="enlace_opcion">Ingresar Decisiones <img src="../images/ir.gif" width="24" height="24" border="0" /></a>
	<?php } else { ?>
    	<a href="decisiones.php" class="enlace_opcion">Ingresar Decisiones <img src="../images/ir.gif" width="24" height="24" border="0" /></a>
    <?php } ?>
    </td>
  </tr>
  <tr>
    <td align="left" valign="middle"><a href="decisiones_historico.php" class="enlace_opcion">Ver decisiones ingresadas</a> <a href="decisiones_historico.php"><img src="../images/ver.gif" width="24" height="24" border="0" /></a></td>
  </tr>
  <tr>
    <td align="left" valign="middle"><a href="cuestionario_historico.php" class="enlace_opcion">Ver cuestionarios ingresados</a> <a href="cuestionario_historico.php"><img src="../images/ver.gif" width="24" height="24" border="0" /></a></td>
  </tr>
  <tr>
    <td align="left" valign="bottom">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" valign="bottom" class="titulo_seccion">Descargar resultado</td>
  </tr>
  <tr>
    <td align="left" valign="bottom"><table width="500" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><a href="../../mod_principal/descargar_resultados.php?idi=2" class="enlace_opcion">Ejercicio 2</a></td>
        <td><a href="../../mod_principal/descargar_resultados.php?idi=3" class="enlace_opcion">Ejercicio 3</a></td>
        <td><a href="../../mod_principal/descargar_resultados.php?idi=4" class="enlace_opcion">Ejercicio 4</a></td>
        <td><a href="../../mod_principal/descargar_resultados.php?idi=5" class="enlace_opcion">Ejercicio 5</a></td>
        <td><a href="../../mod_principal/descargar_resultados.php?idi=6" class="enlace_opcion">Ejercicio 6</a></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align="left" valign="bottom">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" valign="bottom" class="titulo_seccion">Descargar informe de zona</td>
  </tr>
  <tr>
    <td align="left" valign="bottom"><table width="500" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><a href="../../mod_principal/descargar_informe.php?idi=2" class="enlace_opcion">Ejercicio 2</a></td>
        <td><a href="../../mod_principal/descargar_informe.php?idi=3" class="enlace_opcion">Ejercicio 3</a></td>
        <td><a href="../../mod_principal/descargar_informe.php?idi=4" class="enlace_opcion">Ejercicio 4</a></td>
        <td><a href="../../mod_principal/descargar_informe.php?idi=5" class="enlace_opcion">Ejercicio 5</a></td>
        <td><a href="../../mod_principal/descargar_informe.php?idi=6" class="enlace_opcion">Ejercicio 6</a></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align="left" valign="bottom">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" valign="bottom">
    <table width="500" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td class="titulo_seccion">Informativos y tutoriales</td>
      </tr>
      <?php foreach($rec_descargas as $descargas): ?>
      <tr>
        <td><a href="<?php echo "../informacion/".$descargas['archivo']; ?>" target="_blank" class="enlace_opcion"><?php echo $descargas['titulo']." (".$descargas['archivo'].")";  ?></a></td>
      </tr>
      <?php endforeach; ?>
    </table></td>
  </tr>
  <tr>
    <td height="20">&nbsp;</td>
  </tr>
  <tr>
    <td><a href="../../acceso/logout.php" class="enlace_opcion"><img src="../images/salir.gif" width="50" height="50" border="0" title="Salir" /></a></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
    <?php if($_SESSION['prof_privilegio']==3){ ?>
        <form id="form1" name="form1" method="post" action="../../acceso/login.php">
          <input name="txtUser" type="hidden" id="txtUser" value="<?php echo $_SESSION['prof_us'];?>" />
          <input name="txtPass" type="hidden" id="txtPass" value="<?php echo $_SESSION['prof_pass'];?>" />
          <input type="submit" name="button" id="button" value="Panel de profesor" />
        </form>
      <?php } ?>
       
      <?php if($_SESSION['admin_privilegio']==1){ ?>
        <form id="form1" name="form1" method="post" action="../../acceso/login.php">
          <input name="txtUser" type="hidden" id="txtUser" value="<?php echo $_SESSION['admin_us'];?>" />
          <input name="txtPass" type="hidden" id="txtPass" value="<?php echo $_SESSION['admin_pass'];?>" />
          <input type="submit" name="button" id="button" value="Panel de administrador" />
        </form>
      <?php } ?>
    </td>
  </tr>
</table>
</body>
</html>