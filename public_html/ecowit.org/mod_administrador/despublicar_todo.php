<?php
include("../lib/funciones.php");
//--------------------------------Inicio de sesion------------------------
include("../lib/sesion.php"); 
if ($_SESSION['permiso'] == 'autorizado' and $_SESSION['privilegio']=='1'){

$usuario=$_SESSION['id'];
//--------------------------------Fin inicio de sesion------------------------


	if (isset($_GET['noti']))	{
		$id_noticia=$_GET['noti'];
	}
	else{
		$id_noticia=0;
	}
	 
	

	
	
	 

//-----Publica----------------------------------------------------- 

$link=conectarse();	

$sql_despublicar="update archivos set habilitado='0'";
	
mysql_query($sql_despublicar,$link); 


	
//-------------------------------------------------------- 	

	header('Location:listado_ejercicios.php');  

?>
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