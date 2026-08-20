<?php

require_once __DIR__ . '/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;

// Test configuration
define('TEST_DB_HOST', getenv('MYSQL_HOST') ?: 'db');
define('TEST_DB_NAME', 'simulador');
define('TEST_DB_USER', 'perseo');
define('TEST_DB_PASS', 'cio154618135');

// Create PDO connection for tests
function getTestPdo(): PDO {
    $dsn = "mysql:host=" . TEST_DB_HOST . ";dbname=" . TEST_DB_NAME . ";charset=utf8mb4";
    $pdo = new PDO($dsn, TEST_DB_USER, TEST_DB_PASS, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);
    return $pdo;
}