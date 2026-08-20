<?php

require_once __DIR__ . '/../lib/funciones.php';

$nombre = $_POST["txt_user_inicial"] ?? '';
$pass = $_POST["txt_pass_inicial"] ?? '';
$empresa = $_POST["txt_empresa"] ?? '';

if (empty($nombre) || empty($pass) || empty($empresa)) {
    $mensaje = "Error login inicial!! - Complete todos los campos <br>";
    $destino = "../index.php";
    header("location:mensaje_ok.php?mensaje=" . urlencode($mensaje) . "&destino=" . urlencode($destino));
    exit();
}

try {
    $pdo = conectarse();
    
    // Verificar que la empresa existe
    $stmt = $pdo->prepare("
        SELECT id_empresa, nombre, abreviatura, nom_archivo, zona, ciudad, provincia, privilegio, registrado, us, pas
        FROM usuarios_simu 
        WHERE id_empresa = ?
    ");
    $stmt->execute([$empresa]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$user) {
        $mensaje = "Error login inicial!! - Empresa no encontrada <br>";
        $destino = "../index.php";
        header("location:mensaje_ok.php?mensaje=" . urlencode($mensaje) . "&destino=" . urlencode($destino));
        exit();
    }
    
    // Verificar si ya tiene credenciales establecidas
    if ($user['registrado'] == '1' && !empty($user['us']) && !empty($user['pas'])) {
        $mensaje = "Esta empresa ya tiene credenciales establecidas. Use Acceso de Empresa. <br>";
        $destino = "../ingreso_certamen.php";
        header("location:mensaje_ok.php?mensaje=" . urlencode($mensaje) . "&destino=" . urlencode($destino));
        exit();
    }
    
    // Actualizar la empresa con las nuevas credenciales
    $stmt = $pdo->prepare("
        UPDATE usuarios_simu 
        SET us = ?, pas = ?, registrado = '1' 
        WHERE id_empresa = ?
    ");
    $result = $stmt->execute([$nombre, $pass, $empresa]);
    
    if (!$result || $stmt->rowCount() === 0) {
        $mensaje = "Error al actualizar las credenciales. Intente nuevamente. <br>";
        $destino = "../ingreso_certamen.php";
        header("location:mensaje_ok.php?mensaje=" . urlencode($mensaje) . "&destino=" . urlencode($destino));
        exit();
    }
    
    // Inicializamos sesión
    session_start();
    
    // Verificar ejercicio habilitado
    $stmtEj = $pdo->prepare("SELECT ejercicio, nombre FROM archivos WHERE habilitado='1'");
    $stmtEj->execute();
    $ejercicioData = $stmtEj->fetch(PDO::FETCH_ASSOC);
    
    $ejercicio = $ejercicioData['ejercicio'] ?? null;
    $nomArchivo = $ejercicioData['nombre'] ?? null;
    
    $privilegio = $user['privilegio'];
    
    $_SESSION['id'] = $user['id_empresa'];
    $_SESSION['permiso'] = 'autorizado';
    $_SESSION['nombre'] = $user['nombre'];
    $_SESSION['abreviatura'] = $user['abreviatura'];
    $_SESSION['zona'] = $user['zona'];
    $_SESSION['ciudad'] = $user['ciudad'];
    $_SESSION['provincia'] = $user['provincia'];
    $_SESSION['ejercicio'] = $ejercicio;
    $_SESSION['privilegio'] = $privilegio;
    $_SESSION['nom_archivo'] = $nomArchivo;
    
    // Redirigir a cambio de clave
    header("Location:frm_cambio_clave.php");
    
} catch (PDOException $e) {
    error_log("Login inicial error: " . $e->getMessage() . " Code: " . $e->getCode());
    $mensaje = "Error de base de datos: " . $e->getMessage();
    $destino = "../index.php";
    header("location:mensaje_ok.php?mensaje=" . urlencode($mensaje) . "&destino=" . urlencode($destino));
}