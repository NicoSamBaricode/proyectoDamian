<?php
session_start(); // Inicializamos sesion   
// Comprovamos si existe la variable 
if ($_SESSION['permiso']!="autorizado" ) { 
 	header("location:mensaje_error.php");
}
?>