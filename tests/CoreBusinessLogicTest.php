<?php

require_once __DIR__ . '/bootstrap.php';

use PHPUnit\Framework\TestCase;

class CoreBusinessLogicTest extends TestCase
{
    private PDO $pdo;

    protected function setUp(): void
    {
        $this->pdo = getTestPdo();
    }

    public function testDatabaseConnection(): void
    {
        $this->assertInstanceOf(PDO::class, $this->pdo);
        $result = $this->pdo->query("SELECT 1")->fetchColumn();
        $this->assertEquals(1, $result);
    }

    public function testUsuariosSimuTableExists(): void
    {
        $tables = $this->pdo->query("SHOW TABLES LIKE 'usuarios_simu'")->fetchAll();
        $this->assertCount(1, $tables);
    }

    public function testArchivosTableExists(): void
    {
        $tables = $this->pdo->query("SHOW TABLES LIKE 'archivos'")->fetchAll();
        $this->assertCount(1, $tables);
    }

    public function testDecisionesTableExists(): void
    {
        $tables = $this->pdo->query("SHOW TABLES LIKE 'decisiones'")->fetchAll();
        $this->assertCount(1, $tables);
    }

    public function testAuthenticationQuery(): void
    {
        // Test the core login query (using prepared statement for security)
        $stmt = $this->pdo->prepare("
            SELECT id_empresa, nombre, abreviatura, nom_archivo, zona, ciudad, provincia, privilegio, registrado, tipo_jugador, us, pas, profesor 
            FROM usuarios_simu 
            WHERE us = ? AND pas = ? AND activo = '1'
        ");
        $stmt->execute(['test_user', 'test_pass']);
        $result = $stmt->fetch();
        
        // Should return false for non-existent user (no exception)
        $this->assertFalse($result);
    }

    public function testGetEmpresasQuery(): void
    {
        // Test the query used in ingreso_certamen.php
        $stmt = $this->pdo->prepare("
            SELECT id_empresa, nombre, ciudad, provincia 
            FROM usuarios_simu 
            WHERE registrado = '0' AND privilegio = '2' 
            ORDER BY nombre
        ");
        $stmt->execute();
        $result = $stmt->fetchAll();
        
        // Should execute without error
        $this->assertIsArray($result);
    }

    public function testArchivosQuery(): void
    {
        // Test archivos query (used for exercise files)
        $stmt = $this->pdo->prepare("
            SELECT id_file, ejercicio, nombre, habilitado 
            FROM archivos 
            WHERE habilitado = 1
        ");
        $stmt->execute();
        $result = $stmt->fetchAll();
        
        $this->assertIsArray($result);
    }

    public function testDecisionesInsert(): void
    {
        // Test that we can insert a decision (core business logic)
        $stmt = $this->pdo->prepare("
            INSERT INTO decisiones (empresa, ejercicio, precio_de_venta, unidades_a_producir, gastos_de_comercializacion, compra_bienes_de_uso, innovacion_desarrollo)
            VALUES (?, ?, ?, ?, ?, ?, ?)
        ");
        
        // Use a transaction to not pollute the database
        $this->pdo->beginTransaction();
        try {
            $stmt->execute([9999, 2, 75000, 50000, 100000, 50000, 25000]);
            $insertId = $this->pdo->lastInsertId();
            $this->assertIsString($insertId);
            $this->assertGreaterThan(0, (int)$insertId);
        } finally {
            $this->pdo->rollBack();
        }
    }

    public function testCuestionariosInsert(): void
    {
        // Test questionnaire insertion
        $stmt = $this->pdo->prepare("
            INSERT INTO cuestionarios (empresa, r1, r2, r3, r4, r5, r6, r7, r8, r9, r10)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");
        
        $this->pdo->beginTransaction();
        try {
            $stmt->execute([9999, 'V', 'F', 'V', 'V', 'F', 'V', 'V', 'F', 'V', 'F']);
            $insertId = $this->pdo->lastInsertId();
            $this->assertIsString($insertId);
            $this->assertGreaterThan(0, (int)$insertId);
        } finally {
            $this->pdo->rollBack();
        }
    }

    public function testUsuarioRegistrationFlag(): void
    {
        // Test checking if user has registered (changed password)
        $stmt = $this->pdo->prepare("SELECT registrado FROM usuarios_simu WHERE us = ?");
        $stmt->execute(['nonexistent']);
        $result = $stmt->fetchColumn();
        $this->assertFalse($result);
    }

    public function testPrivilegeLevels(): void
    {
        // Verify privilege levels exist (1=admin, 2=empresa, 3=profesor, etc.)
        $stmt = $this->pdo->query("SELECT DISTINCT privilegio FROM usuarios_simu WHERE privilegio IS NOT NULL");
        $privileges = $stmt->fetchAll(PDO::FETCH_COLUMN);
        // Convert to strings for comparison since DB may return integers
        $privileges = array_map('strval', $privileges);
        
        $this->assertContains('1', $privileges); // Admin
        $this->assertContains('2', $privileges); // Empresa
        $this->assertContains('3', $privileges); // Profesor
    }
}