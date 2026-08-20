<?php

//--------------------------------Inicio de sesion------------------------
require_once __DIR__ . '/../lib/sesion.php'; 

if ($_SESSION['permiso'] != 'autorizado' || $_SESSION['privilegio'] != '1'){
    $mensaje = "Usuario sin permisos";
    $destino = "../ingreso_certamen.php";
    include("../includes/mensaje.php");
    exit();
}

//--------------------------------Fin inicio de sesion------------------------
require_once __DIR__ . '/../lib/funciones.php';

try {
    $pdo = conectarse();
    
    $stmt = $pdo->prepare("SELECT * FROM archivos WHERE habilitado='1' ORDER BY nombre");
    $stmt->execute();
    $documentos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
} catch (PDOException $e) {
    error_log("Admin menu error: " . $e->getMessage());
    $documentos = [];
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sistema administrativo</title>
<link href="estilos_relevamiento.css" rel="stylesheet" type="text/css" /><link href="../css/estilos.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style26 {font-size: 350px}
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
-->
</style>
</head>
<body>
<table width="770" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#E8E8EA">
  <tr>
    <td width="800" align="left" valign="middle"><?php include("../lib/encabezado_administrador.php"); ?></td>
  </tr>
  <tr>
    <td height="5" align="left" valign="middle" bgcolor="#063861"></td>
  </tr>
  <tr>
    <td align="left" valign="middle" class="titulos_pantalla">Menú principal</td>
  </tr>
  <tr>
    <td align="center" valign="middle"><table width="700" border="0">
    <td width="350">&nbsp;</td>
    <td width="350">&nbsp;</td>
      <tr>
        <td width="350"><a href="../acceso/frm_cambio_clave.php" class="enlace_opcion style26">Cambiar datos de usuario>></a></td>
        <td width="350"><a href="cargar_equipos_proc.php" class="enlace_opcion style26">Importar equipos desde Excel>></a></td>
      </tr>
      <tr>
        <td width="350">&nbsp;</td>
        <td width="350">&nbsp;</td>
      </tr>
      <tr>
        <td width="350"><a href="listado_ejercicios.php" class="enlace_opcion style26">Listado de ejercicios >></a></td>
        <td width="350"><a href="cargar_profesores_proc.php" class="enlace_opcion style26">Importar profesores desde Exdel>></a></td>
      </tr>
      <tr>
        <td width="350">&nbsp;</td>
        <td width="350">&nbsp;</td>
      </tr>
      <tr>
        <td width="350"><a href="empresa_listado.php" class="enlace_opcion style26">Listado de empresas >></a></td>
        <td width="350"><a href="reset_equipos_profesores.php" class="enlace_opcion style26">Reset usuarios>></a></td>
      </tr>
      <tr>
        <td width="350">&nbsp;</td>
        <td width="350">&nbsp;</td>
      </tr>
      <tr>
        <td width="350"><a href="../acceso/logout.php" class="enlace_opcion style26">Salir >></a></td>
        <td width="350"><a href="reset_decisiones.php" class="enlace_opcion style26">Reset historico decisiones>></a></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><a href="subir_datos.php" class="enlace_opcion style26">Subir datos>></a></td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>