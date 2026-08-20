<?php
include("../lib/funciones.php");
//--------------------------------Inicio de sesion------------------------
include("../lib/sesion.php"); 
if ($_SESSION['permiso'] == 'autorizado' and $_SESSION['privilegio']=='1'){

$usuario=$_SESSION['id'];
//--------------------------------Fin inicio de sesion------------------------


$id_ejer=$_POST['id_ejer'];
	 
$txt_1_min=$_POST['txt_1_min'];
$txt_1_max=$_POST['txt_1_max'];

$txt_2_min=$_POST['txt_2_min'];
$txt_2_max=$_POST['txt_2_max'];

$txt_3_min=$_POST['txt_3_min'];
$txt_3_max=$_POST['txt_3_max'];

$txt_4_min=$_POST['txt_4_min'];
$txt_4_max=$_POST['txt_4_max'];

$txt_5_min=$_POST['txt_5_min'];
$txt_5_max=$_POST['txt_5_max'];

$txt_6_min=$_POST['txt_6_min'];
$txt_6_max=$_POST['txt_6_max'];

	
	
	 

//-----Publica----------------------------------------------------- 

$link=conectarse();	

$sql="update archivos set PrecioVentaMin='$txt_1_min',PrecioVentaMax='$txt_1_max',
UnidadesMin='$txt_2_min',UnidadesMax='$txt_2_max',
GastosComercializacionMin='$txt_3_min',GastosComercializacionMax='$txt_3_max',
CompraBienesUsoMin='$txt_4_min',CompraBienesUsoMax='$txt_4_max',
InnovacionMin='$txt_5_min',InnovacionMax='$txt_5_max',
SustentabilidadMin='$txt_6_min',SustentabilidadMax='$txt_6_max' 
where id_file='$id_ejer'";
	
mysql_query($sql,$link); 


	
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