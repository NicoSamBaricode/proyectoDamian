<?php

include("../lib/funciones.php");

$nombre=$_POST["txtUser"];

$pass=$_POST["txtPass"];

	

$link=conectarse();

$query="select id_empresa,nombre,abreviatura,nom_archivo,zona,ciudad,provincia,privilegio,registrado,tipo_jugador,us,pas,profesor from usuarios_simu where us='$nombre' and pas='$pass' and activo='1' ";

	

$result=mysql_query($query, $link); 

$filas=mysql_num_rows($result); 





	

if ($filas==0){

		$mensaje="Eror!! - Usuario o contraseña no valido <br> ";

		$destino="../ingreso_certamen.php";

		include("../includes/mensaje.php");
}

else

{

		$registrado=mysql_result($result,0,"registrado");

		if($registrado=='0'){

			$mensaje="El usuario no ha cambiado sus datos de ingreso originales, por favor ingrese por Acceso por primera vez y establezca un usuario y clave para el ingreso al simulador <br> ";

				

			$destino="../ingreso_certamen.php";

	

			include("../includes/mensaje.php");

		}

		else

		{

			// Inicializamos sesion  

			
			session_start();  
			

			$query_ejercicio="select ejercicio from archivos where habilitado='1'";

			$rec_ejercicio=mysql_query($query_ejercicio, $link); 
			
			$query_ejercicio_invitado="select ejercicio from archivos_invitado where habilitado='1'";

			$rec_ejercicio_invitado=mysql_query($query_ejercicio_invitado, $link); 

			

			if(mysql_num_rows($rec_ejercicio)==0){

				$_SESSION['subir']=0;

			}

			else

			{

				$_SESSION['subir']=1;

			}

				

			

			// Guardamos una variable 

			$privilegio=mysql_result($result,0,"privilegio");
			
			$_SESSION['privilegio'] =$privilegio;

			$_SESSION['id'] =mysql_result($result,0,"id_empresa");

			$_SESSION['permiso'] = 'autorizado';  

			$_SESSION['nombre'] =mysql_result($result,0,"nombre"); 

			$_SESSION['abreviatura'] =mysql_result($result,0,"abreviatura");

			$_SESSION['zona'] =mysql_result($result,0,"zona");

			$_SESSION['ciudad'] =mysql_result($result,0,"ciudad");

			$_SESSION['provincia'] =mysql_result($result,0,"provincia");
			
			
			//---Si es invitado utiliza otros ejercicios.
			
			if(mysql_result($result,0,"tipo_jugador")=="Invitado"){
				$_SESSION['ejercicio']=mysql_result($rec_ejercicio_invitado,0,"ejercicio");
			}
			else
			{
				$_SESSION['ejercicio']=mysql_result($rec_ejercicio,0,"ejercicio");
			}

			


			$_SESSION['nom_archivo'] =mysql_result($result,0,"nom_archivo");
			
			$_SESSION['tipo_jugador'] =mysql_result($result,0,"tipo_jugador");
			
			

			
			
				
			
			switch($privilegio) {
    			case 1:
					$_SESSION['admin_us']=mysql_result($result,0,"us");
					$_SESSION['admin_pass']=mysql_result($result,0,"pas");
					$_SESSION['admin_privilegio']=$privilegio;
        			header("Location:../mod_administrador/menu_principal_admin.php");
					break;
    			case 2:
        			header("Location:../mod_principal/menu_principal.php");
					break;
    			case 3:
					$_SESSION['prof_us']=mysql_result($result,0,"us");
					$_SESSION['prof_pass']=mysql_result($result,0,"pas");
					$_SESSION['prof_privilegio']=$privilegio;
					
        			header("Location:../mod_profesores/empresa_listado_prof.php");
					break;
			}

	}

}

		

		

?>