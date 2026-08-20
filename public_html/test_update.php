<?php
require_once __DIR__ . '/lib/funciones.php';
try {
    $pdo = conectarse();
    $stmt = $pdo->prepare("UPDATE usuarios_simu SET us = ?, pas = ?, registrado = '1' WHERE id_empresa = ?");
    $result = $stmt->execute(['nuevouser', 'nuevapass', 72]);
    echo "Result: " . ($result ? 'true' : 'false') . "\n";
    echo "Row count: " . $stmt->rowCount() . "\n";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
    echo "Code: " . $e->getCode() . "\n";
}