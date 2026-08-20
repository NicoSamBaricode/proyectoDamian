<?php

require_once __DIR__ . '/../config/database.php';

//-----------------Funciones de fecha-----------------------------------

function timestampToFecha($timeStamp)
{
    $fechaDelTime = getdate($timeStamp);
    $dia = $fechaDelTime['mday'];
    $mes = $fechaDelTime['mon'];
    $anio = $fechaDelTime['year'];
    $hora = $fechaDelTime['hours'];
    $minuto = $fechaDelTime['minutes'];
    $fechaDelTime = $dia . "-" . $mes . "-" . $anio . "  " . $hora . ":" . $minuto;
    return $fechaDelTime;
}

function fechaToTimestamp($cadena)
{
    $retorno = "";
    list($dia, $mes, $anyo) = explode("-", $cadena);
    $retorno = mktime(0, 0, 0, $mes, $dia, $anyo);
    return $retorno;
}

//---------------------------------------------------------------------------

/**
 * Get PDO database connection (replaces old mysql_connect)
 */
function conectarse(): PDO
{
    return Database::getInstance();
}

/**
 * Legacy compatibility - returns PDO instance for old code that expects a link resource
 * @deprecated Use conectarse() directly for PDO
 */
function conectarse_legacy()
{
    trigger_error('conectarse_legacy() is deprecated. Use conectarse() for PDO.', E_USER_DEPRECATED);
    return conectarse();
}

function conectarse_bche()
{
    // MSSQL connection - keeping original for now, would need SQL Server driver
    $host = '10.20.130.6';
    $user = 'sa';
    $pass = 'kristina';
    $dbname = 'Bche';
    
    try {
        $dsn = "sqlsrv:Server=$host;Database=$dbname";
        $pdo = new PDO($dsn, $user, $pass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);
        return $pdo;
    } catch (PDOException $e) {
        echo "Error conectando a la base de datos Bche: " . $e->getMessage();
        exit();
    }
}

function send($text)
{
    header("Content-type: text/html; charset=utf-8");
    echo utf8_encode($text);
}

//---Manejo de fechas------------------------------------

function fecha_mysql_normal($fechavieja)
{
    list($a, $m, $d) = explode("-", $fechavieja);
    return $d . "-" . $m . "-" . $a;
}

function fecha_mysql_normal_completa($fechavieja)
{
    list($f, $h) = explode(" ", $fechavieja);
    list($a, $m, $d) = explode("-", $f);
    list($hor, $min, $seg) = explode(":", $h);
    return $d . "-" . $m . "-" . $a . " " . $hor . ":" . $min . ":" . $seg;
}

function fecha_mysql_saca_mes($fecha_mysql)
{
    list($a, $m, $d) = explode("-", $fecha_mysql);
    return $m;
}

function fecha_mysql_saca_ano($fecha_mysql)
{
    list($a, $m, $d) = explode("-", $fecha_mysql);
    return $a;
}

function fecha_normal_mysql($fechavieja)
{
    list($d, $m, $a) = explode("-", $fechavieja);
    return $a . "-" . $m . "-" . $d;
}

////////////////////////////////////////////////////

// Convierte fecha de mysql a normal (using preg_match instead of deprecated ereg)

function cambiaf_a_mssql($fecha)
{
    if (preg_match("/([0-9]{1,2})\/([0-9]{1,2})\/([0-9]{2,4})/", $fecha, $mifecha)) {
        $lafecha = $mifecha[3] . "/" . $mifecha[2] . "/" . $mifecha[1];
        return $lafecha;
    }
    return $fecha;
}

function cambiaf_desde_mssql($fecha)
{
    if (preg_match("/([0-9]{1,2})\/([0-9]{1,2})\/([0-9]{2,4})/", $fecha, $mifecha)) {
        $lafecha = $mifecha[2] . "/" . $mifecha[1] . "/" . $mifecha[3];
        return $lafecha;
    }
    return $fecha;
}

function cambiaf_a_normal($fecha)
{
    if (preg_match("/([0-9]{2,4})-([0-9]{1,2})-([0-9]{1,2})/", $fecha, $mifecha)) {
        $lafecha = $mifecha[3] . "/" . $mifecha[2] . "/" . $mifecha[1];
        return $lafecha;
    }
    return $fecha;
}

function cambiaf_a_mysql($fecha)
{
    if (preg_match("/([0-9]{1,2})\/([0-9]{1,2})\/([0-9]{2,4})/", $fecha, $mifecha)) {
        $lafecha = $mifecha[3] . "-" . $mifecha[2] . "-" . $mifecha[1];
        return $lafecha;
    }
    return $fecha;
}

function lngBuscaId($txtTabla, $lngId)
{
    $pdo = conectarse();
    $stmt = $pdo->prepare("SELECT MAX($lngId) FROM $txtTabla");
    $stmt->execute();
    $result = $stmt->fetchColumn();
    
    if ($result !== false && $result !== null) {
        return (int)$result + 1;
    }
    return 1;
}

function GetIP()
{
    if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown") !== 0) {
        $ip = getenv("HTTP_CLIENT_IP");
    } elseif (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown") !== 0) {
        $ip = getenv("HTTP_X_FORWARDED_FOR");
    } elseif (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown") !== 0) {
        $ip = getenv("REMOTE_ADDR");
    } elseif (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown") !== 0) {
        $ip = $_SERVER['REMOTE_ADDR'];
    } else {
        $ip = "unknown";
    }
    return $ip;
}

function fecha()
{
    $mes = [
        1 => "enero", 2 => "febrero", 3 => "marzo", 4 => "abril",
        5 => "mayo", 6 => "junio", 7 => "julio", 8 => "agosto",
        9 => "septiembre", 10 => "octubre", 11 => "noviembre", 12 => "diciembre"
    ];
    $dia = ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"];
    
    $gisett = (int)date("w");
    $mesnum = (int)date("m");
    $hora = date(" H:i", time());
    
    return $dia[$gisett] . ", " . date("d") . " de " . $mes[$mesnum] . " de " . date("Y") . " | " . $hora;
}

function extension_valida($img)
{
    $filename = $img;
    if (($pos = strrpos($filename, ".")) === false) {
        echo "Error - file doesn't have a dot... weird.";
        return false;
    }
    $extension = substr($filename, $pos + 1);
    if (($pos = strrpos($filename, "/")) === false) {
        // no path
    } else {
        $name = substr($filename, $pos + 1);
    }
    if (in_array(strtolower($extension), ['xls', 'xlsx'])) {
        return true;
    }
    return false;
}

/**
 * Execute a SELECT query and return all results (PDO replacement for mysql_query + fetch loop)
 */
function queryAll(string $sql, array $params = []): array
{
    $pdo = conectarse();
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll();
}

/**
 * Execute a SELECT query and return single result
 */
function queryOne(string $sql, array $params = []): ?array
{
    $pdo = conectarse();
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $result = $stmt->fetch();
    return $result ?: null;
}

/**
 * Execute an INSERT/UPDATE/DELETE query
 */
function queryExec(string $sql, array $params = []): int
{
    $pdo = conectarse();
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    return $stmt->rowCount();
}

/**
 * Get last insert ID
 */
function lastInsertId(): string
{
    return conectarse()->lastInsertId();
}