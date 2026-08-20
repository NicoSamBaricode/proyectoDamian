<?php
	include("../lib/funciones.php");
	$nombre=$_POST["txt_user_inicial"];
	$pass=$_POST["txt_pass_inicial"];
	$empresa=$_POST["txt_empresa"];
	
	$link=conectarse();
	$query="select id_empresa,nombre,abreviatura,nom_archivo,zona,ciudad,provincia,privilegio from usuarios_simu where us='$nombre' and pas='$pass' and id_empresa='$empresa'";
	
		
	
	$result=mysql_query($query, $link); 
	$filas=mysql_num_rows($result); 


	
	if ($filas==0){
				$mensaje="Eror login inicial!! - Usuario o contraseña no valido <br> ";
				$destino="../index.php";
	
				header("location:mensaje_ok.php?mensaje=$mensaje&destino=$destino");
				
		}
	else
		{
			// Inicializamos sesion  
			session_start();  
			
			// Inicializamos sesion  
			session_start();  
			
			$query_ejersicio="select ejercicio from archivos where habilitado='1'";
			$rec_ejersicio=mysql_query($query_ejersicio, $link); 
			
			// Guardamos una variable 
			$privilegio=mysql_result($result,0,"privilegio");
			$_SESSION['id'] =mysql_result($result,0,"id_empresa");
			$_SESSION['permiso'] = 'autorizado';  
			$_SESSION['nombre'] =mysql_result($result,0,"nombre"); 
			$_SESSION['abreviatura'] =mysql_result($result,0,"abreviatura");
			$_SESSION['zona'] =mysql_result($result,0,"zona");
			$_SESSION['ciudad'] =mysql_result($result,0,"ciudad");
			$_SESSION['provincia'] =mysql_result($result,0,"provincia");
			$_SESSION['ejercicio']=mysql_result($rec_ejersicio,0,"ejercicio");
			$_SESSION['privilegio'] =$privilegio;
			$_SESSION['nom_archivo'] =mysql_result($rec_ejersicio,0,"nom_archivo");
			
			// Guardamos una variable 
			$privilegio=mysql_result($result,0,"privilegio");
			
		
	
				header("Location:frm_cambio_clave.php");
			
		}
		
		
?>