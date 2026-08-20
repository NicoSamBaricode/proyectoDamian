<?php 

require_once __DIR__ . '/../lib/funciones.php';
require_once __DIR__ . '/../lib/excell/PHPExcel.php';

//--------------------------------Inicio de sesion------------------------
require_once __DIR__ . '/../lib/sesion.php'; 

if ($_SESSION['permiso'] != 'autorizado' ){
    $mensaje = "Usuario sin permisos";
    $destino = "../acceso/index.php";
    header("location:mensaje_ok.php?mensaje=" . urlencode($mensaje) . "&destino=" . urlencode($destino));
    exit();
}

//--------------------------------Fin inicio de sesion------------------------	 

$usuario = $_SESSION['id'];
$empresa = $_SESSION['abreviatura'];
$ejercicio = $_SESSION['ejercicio'];
$nom_archivo = $_SESSION['nom_archivo'];

$precio_venta = $_POST['txt_precio_venta'] ?? '';
$unidades = $_POST['txt_unidades'] ?? '';
$gastos_comer = $_POST['txt_gastos_comer'] ?? '';
$compra_bienes = $_POST['txt_compra_bienes'] ?? '';
$innovacion = $_POST['txt_innovacion'] ?? '';
$sustentabilidad = $_POST['txt_sustentabilidad'] ?? '';

if (empty($precio_venta) || empty($unidades) || empty($gastos_comer) || empty($compra_bienes) || empty($innovacion) || empty($sustentabilidad)) {
    $mensaje = "Todos los campos son obligatorios";
    $destino = "decisiones.php";
    include("../includes/mensaje_include.php");
    exit();
}

error_reporting(E_ALL);
ini_set('display_errors', 1);

$objPHPExcel = new PHPExcel();

$objPHPExcel->getProperties()
    ->setCreator("Cattivo")
    ->setLastModifiedBy("Cattivo")
    ->setTitle("Documento Excel de Prueba")
    ->setSubject("Documento Excel de Prueba")
    ->setDescription("Demostracion sobre como crear archivos de Excel desde PHP.")
    ->setKeywords("Excel Office 2007 openxml php")
    ->setCategory("Pruebas de Excel");

$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A1', 'Precio de venta')
    ->setCellValue('A2', 'Unidades a producir')
    ->setCellValue('A3', 'Gastos de comercializacion')
    ->setCellValue('A4', 'Compra de bienes de uso')
    ->setCellValue('A5', 'Desarrollo del talento humano')
    ->setCellValue('A6', 'Innovación y Sustentabilidad')
    ->setCellValue('B1', $precio_venta)
    ->setCellValue('B2', $unidades)
    ->setCellValue('B3', $gastos_comer)
    ->setCellValue('B4', $compra_bienes)
    ->setCellValue('B5', $innovacion)
    ->setCellValue('B6', $sustentabilidad);

$objPHPExcel->getActiveSheet()->setTitle('Tecnologia Simple');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007'); 
$objWriter->save("../../datos_sapienter/".$ejercicio."/".$nom_archivo.".xlsx");

//--AUDITORIA DE LA CARGA---------------------------------------------------------------------------------------------------
try {
    $pdo = conectarse();
    
    $sql = "INSERT INTO decisiones (empresa, ejercicio, precio_de_venta, unidades_a_producir, gastos_de_comercializacion, compra_bienes_de_uso, innovacion_desarrollo, sustentabilidad) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$usuario, $ejercicio, $precio_venta, $unidades, $gastos_comer, $compra_bienes, $innovacion, $sustentabilidad]);
    
    $mensaje = "LAS DECISIONES FUERON CARGADAS CORRECTAMENTE";
    $destino = "menu_principal.php";
    include("../includes/mensaje_include.php");
    
} catch (PDOException $e) {
    error_log("Decisiones proc error: " . $e->getMessage());
    $mensaje = "Error al guardar las decisiones: " . $e->getMessage();
    $destino = "menu_principal.php";
    include("../includes/mensaje_include.php");
}

//---------------------------------------------------------------------------------------------------------------------------