<?php
require_once __DIR__ . '/lib/funciones.php';
try {
    $pdo = conectarse();
    $stmt = $pdo->prepare("SELECT id_empresa, nombre, abreviatura, nom_archivo, zona, ciudad, provincia, privilegio, registrado, us, pas FROM usuarios_simu WHERE id_empresa = ?");
    $stmt->execute([72]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    print_r($user);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}