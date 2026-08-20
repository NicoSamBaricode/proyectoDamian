<?php
	include("../lib/funciones.php");
	$nombre=$_POST["txtUser"];
	$pass=$_POST["txtPass"];
	
	$link=conectarse();
	$query="select id_usuario,apellido,nombre,privilegio from usuarios where us='$nombre' and pas='$pass'";
			
	
	$result=mysql_query($query, $link); 
	$filas=mysql_num_rows($result); 


	
	if ($filas==0){
				$mensaje="Eror!! - Usuario o contraseña no valido <br> ";
				$destino="index.php";
	
				header("location:mensaje_ok.php?mensaje=$mensaje&destino=$destino");
				
		}
	else
		{
			
			$nombre=mysql_result($result,0,"apellido").", ".mysql_result($result,0,"nombre");
			$id=mysql_result($result,0,"id_usuario");
			$privilegio=mysql_result($result,0,"privilegio");
		
			
			
			
			// Inicializamos sesion  
			session_start();  
			// Guardamos una variable  
			$_SESSION['permiso'] = 'autorizado';  
			$_SESSION['nombre'] =$nombre;  
			$_SESSION['id'] =$id;
			$_SESSION['privilegio'] =$privilegio;
		
		
			header("Location:../menu_principal.php");
		}
		
		
?>