<?php 
//--------------------------------Inicio de sesion------------------------
include("../lib/sesion.php"); 
if ($_SESSION['permiso'] != 'autorizado' ){
	$mensaje="Usuario sin permisos";
	$destino="../index.php";
	header("location:mensaje_ok.php?mensaje=$mensaje&destino=$destino");
}
//--------------------------------Fin inicio de sesion------------------------

include("../lib/funciones.php");


$link=conectarse();

$usuario=$_POST['txt_usuario'];
$clave=$_POST['txt_clave'];
$id_empresa=$_SESSION['id'];

$query_existente="select nombre from usuarios_simu where us='$usuario'";
$record_existe=mysql_query($query_existente,$link);

if(mysql_num_rows($record_existe)>0){
		$mensaje="El nombre de usuario ya ha sido elegido por otro equipo, ingrese uno distinto";
		$destino="../acceso/frm_cambio_clave.php";
		header("location:../lib/mensaje.php?mensaje=$mensaje&destino=$destino");
}
else
{
		$query_actualiza_clave="update usuarios_simu set us='$usuario',pas='$clave',registrado='1' where id_empresa='$id_empresa'";

 
		if(mysql_query($query_actualiza_clave,$link)){
			$mensaje="La clave y usuario han sido actualizados correctamente";
			$destino="../ingreso_certamen.php";
			header("location:../lib/mensaje.php?mensaje=$mensaje&destino=$destino");
		}
		else
		{
			$mensaje="No se realizaron los cambios";
			$destino="../ingreso_certamen.php";
			header("location:../lib/mensaje.php?mensaje=$mensaje&destino=$destino");
		}
}
?>

