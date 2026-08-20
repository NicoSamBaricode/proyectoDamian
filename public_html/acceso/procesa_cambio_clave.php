<?php 
//--------------------------------Inicio de sesion------------------------
require_once __DIR__ . '/../lib/sesion.php'; 
if ($_SESSION['permiso'] != 'autorizado' ){
    $mensaje="Usuario sin permisos";
    $destino="../index.php";
    header("location:mensaje_ok.php?mensaje=" . urlencode($mensaje) . "&destino=" . urlencode($destino));
    exit();
}
//--------------------------------Fin inicio de sesion------------------------

require_once __DIR__ . '/../lib/funciones.php';

try {
    $pdo = conectarse();
    
    $usuario = $_POST['txt_usuario'] ?? '';
    $clave = $_POST['txt_clave'] ?? '';
    $id_empresa = $_SESSION['id'] ?? 0;
    
    if (empty($usuario) || empty($clave) || empty($id_empresa)) {
        $mensaje = "Complete todos los campos";
        $destino = "../acceso/frm_cambio_clave.php";
        header("location:../lib/mensaje.php?mensaje=" . urlencode($mensaje) . "&destino=" . urlencode($destino));
        exit();
    }
    
    // Verificar si el usuario ya existe
    $stmt = $pdo->prepare("SELECT nombre FROM usuarios_simu WHERE us = ?");
    $stmt->execute([$usuario]);
    $existe = $stmt->fetchColumn();
    
    if ($existe) {
        $mensaje = "El nombre de usuario ya ha sido elegido por otro equipo, ingrese uno distinto";
        $destino = "../acceso/frm_cambio_clave.php";
        header("location:../lib/mensaje.php?mensaje=" . urlencode($mensaje) . "&destino=" . urlencode($destino));
        exit();
    }
    
    // Actualizar clave y usuario
    $stmt = $pdo->prepare("UPDATE usuarios_simu SET us = ?, pas = ?, registrado = '1' WHERE id_empresa = ?");
    $result = $stmt->execute([$usuario, $clave, $id_empresa]);
    
    if ($result) {
        $mensaje = "La clave y usuario han sido actualizados correctamente";
        $destino = "../ingreso_certamen.php";
        header("location:../lib/mensaje.php?mensaje=" . urlencode($mensaje) . "&destino=" . urlencode($destino));
    } else {
        $mensaje = "No se realizaron los cambios";
        $destino = "../ingreso_certamen.php";
        header("location:../lib/mensaje.php?mensaje=" . urlencode($mensaje) . "&destino=" . urlencode($destino));
    }
    
} catch (PDOException $e) {
    error_log("Cambio clave error: " . $e->getMessage());
    $mensaje = "Error de conexión a la base de datos. Intente más tarde.";
    $destino = "../ingreso_certamen.php";
    header("location:../lib/mensaje.php?mensaje=" . urlencode($mensaje) . "&destino=" . urlencode($destino));
}