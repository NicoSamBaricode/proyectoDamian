<?php

require_once __DIR__ . '/../lib/funciones.php';

$nombre = $_POST["txtUser"] ?? '';
$pass = $_POST["txtPass"] ?? '';

if (empty($nombre) || empty($pass)) {
    $mensaje = "Error!! - Usuario o contraseña no válido <br>";
    $destino = "../ingreso_certamen.php";
    include("../includes/mensaje.php");
    exit();
}

try {
    $pdo = conectarse();
    
    $stmt = $pdo->prepare("
        SELECT id_empresa, nombre, abreviatura, nom_archivo, zona, ciudad, provincia, 
               privilegio, registrado, tipo_jugador, us, pas, profesor 
        FROM usuarios_simu 
        WHERE us = ? AND pas = ? AND activo = '1'
    ");
    $stmt->execute([$nombre, $pass]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$user) {
        $mensaje = "Error!! - Usuario o contraseña no válido <br>";
        $destino = "../ingreso_certamen.php";
        include("../includes/mensaje.php");
        exit();
    }
    
    $registrado = $user['registrado'];
    
    if ($registrado == '0') {
        $mensaje = "El usuario no ha cambiado sus datos de ingreso originales, por favor ingrese por Acceso por primera vez y establezca un usuario y clave para el ingreso al simulador <br>";
        $destino = "../ingreso_certamen.php";
        include("../includes/mensaje.php");
        exit();
    }
    
    // Inicializamos sesión
    session_start();
    
    // Verificar ejercicios habilitados
    $stmtEj = $pdo->prepare("SELECT ejercicio FROM archivos WHERE habilitado='1'");
    $stmtEj->execute();
    $ejercicio = $stmtEj->fetchColumn();
    
    $stmtEjInv = $pdo->prepare("SELECT ejercicio FROM archivos_invitado WHERE habilitado='1'");
    $stmtEjInv->execute();
    $ejercicioInvitado = $stmtEjInv->fetchColumn();
    
    $_SESSION['subir'] = $ejercicio ? 1 : 0;
    
    $privilegio = $user['privilegio'];
    
    $_SESSION['privilegio'] = $privilegio;
    $_SESSION['id'] = $user['id_empresa'];
    $_SESSION['permiso'] = 'autorizado';
    $_SESSION['nombre'] = $user['nombre'];
    $_SESSION['abreviatura'] = $user['abreviatura'];
    $_SESSION['zona'] = $user['zona'];
    $_SESSION['ciudad'] = $user['ciudad'];
    $_SESSION['provincia'] = $user['provincia'];
    $_SESSION['nom_archivo'] = $user['nom_archivo'];
    $_SESSION['tipo_jugador'] = $user['tipo_jugador'];
    
    // Ejercicio según tipo de jugador
    if ($user['tipo_jugador'] == "Invitado") {
        $_SESSION['ejercicio'] = $ejercicioInvitado;
    } else {
        $_SESSION['ejercicio'] = $ejercicio;
    }
    
    // Redirección según privilegio
    switch ($privilegio) {
        case 1: // Admin
            $_SESSION['admin_us'] = $user['us'];
            $_SESSION['admin_pass'] = $user['pas'];
            $_SESSION['admin_privilegio'] = $privilegio;
            header("Location:../mod_administrador/menu_principal_admin.php");
            break;
            
        case 2: // Empresa
            header("Location:../mod_principal/menu_principal.php");
            break;
            
        case 3: // Profesor
            $_SESSION['prof_us'] = $user['us'];
            $_SESSION['prof_pass'] = $user['pas'];
            $_SESSION['prof_privilegio'] = $privilegio;
            header("Location:../mod_profesores/empresa_listado_prof.php");
            break;
            
        default:
            $mensaje = "Error: Privilegio no reconocido";
            $destino = "../ingreso_certamen.php";
            include("../includes/mensaje.php");
    }
    
} catch (PDOException $e) {
    error_log("Login error: " . $e->getMessage());
    $mensaje = "Error de conexión a la base de datos. Intente más tarde.";
    $destino = "../ingreso_certamen.php";
    include("../includes/mensaje.php");
}