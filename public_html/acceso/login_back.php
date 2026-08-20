<?php

require_once __DIR__ . '/../lib/funciones.php';

$nombre = $_POST["txtUser"] ?? '';
$pass = $_POST["txtPass"] ?? '';

if (empty($nombre) || empty($pass)) {
    $mensaje = "Error!! - Usuario o contraseña no válido <br>";
    $destino = "index.php";
    header("location:mensaje_ok.php?mensaje=" . urlencode($mensaje) . "&destino=" . urlencode($destino));
    exit();
}

try {
    $pdo = conectarse();
    
    $stmt = $pdo->prepare("
        SELECT id_usuario, apellido, nombre, privilegio 
        FROM usuarios 
        WHERE us = ? AND pas = ?
    ");
    $stmt->execute([$nombre, $pass]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$user) {
        $mensaje = "Error!! - Usuario o contraseña no válido <br>";
        $destino = "index.php";
        header("location:mensaje_ok.php?mensaje=" . urlencode($mensaje) . "&destino=" . urlencode($destino));
        exit();
    }
    
    $nombreCompleto = $user['apellido'] . ", " . $user['nombre'];
    $id = $user['id_usuario'];
    $privilegio = $user['privilegio'];
    
    // Inicializamos sesión
    session_start();
    
    $_SESSION['permiso'] = 'autorizado';
    $_SESSION['nombre'] = $nombreCompleto;
    $_SESSION['id'] = $id;
    $_SESSION['privilegio'] = $privilegio;
    
    header("Location:../menu_principal.php");
    
} catch (PDOException $e) {
    error_log("Login back error: " . $e->getMessage());
    $mensaje = "Error de conexión a la base de datos. Intente más tarde.";
    $destino = "index.php";
    header("location:mensaje_ok.php?mensaje=" . urlencode($mensaje) . "&destino=" . urlencode($destino));
}