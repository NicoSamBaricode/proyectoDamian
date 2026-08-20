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

$respuesta_1 = $_POST['txt_1'] ?? '';
$respuesta_2 = $_POST['txt_2'] ?? '';
$respuesta_3 = $_POST['txt_3'] ?? '';
$respuesta_4 = $_POST['txt_4'] ?? '';
$respuesta_5 = $_POST['txt_5'] ?? '';
$respuesta_6 = $_POST['txt_6'] ?? '';
$respuesta_7 = $_POST['txt_7'] ?? '';
$respuesta_8 = $_POST['txt_8'] ?? '';
$respuesta_9 = $_POST['txt_9'] ?? '';
$respuesta_10 = $_POST['txt_10'] ?? '';

if (empty($respuesta_1) || empty($respuesta_2) || empty($respuesta_3) || empty($respuesta_4) || empty($respuesta_5) || empty($respuesta_6) || empty($respuesta_7) || empty($respuesta_8) || empty($respuesta_9) || empty($respuesta_10)) {
    $mensaje = "Todas las respuestas son obligatorias";
    $destino = "cuestionario.php";
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
    ->setCellValue('A20', $respuesta_1)
    ->setCellValue('A25', $respuesta_2)
    ->setCellValue('A30', $respuesta_3)
    ->setCellValue('A35', $respuesta_4)
    ->setCellValue('A40', $respuesta_5)
    ->setCellValue('A45', $respuesta_6)
    ->setCellValue('A50', $respuesta_7)
    ->setCellValue('A55', $respuesta_8)
    ->setCellValue('A60', $respuesta_9)
    ->setCellValue('A65', $respuesta_10);

$objPHPExcel->getActiveSheet()->setTitle('Tecnologia Simple');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007'); 
$objWriter->save("../../datos_sapienter/autoformacion/".$nom_archivo.".xlsx");

//--AUDITORIA DE LA CARGA---------------------------------------------------------------------------------------------------
try {
    $pdo = conectarse();
    
    $sql = "INSERT INTO cuestionarios (empresa, r1, r2, r3, r4, r5, r6, r7, r8, r9, r10) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$usuario, $respuesta_1, $respuesta_2, $respuesta_3, $respuesta_4, $respuesta_5, $respuesta_6, $respuesta_7, $respuesta_8, $respuesta_9, $respuesta_10]);
    
    $mensaje = "EL CUESTIONARIO FUE CARGADO CORRECTAMENTE";
    $destino = "menu_principal.php";
    include("../includes/mensaje_include.php");
    
} catch (PDOException $e) {
    error_log("Cuestionario proc error: " . $e->getMessage());
    $mensaje = "Error al guardar el cuestionario: " . $e->getMessage();
    $destino = "menu_principal.php";
    include("../includes/mensaje_include.php");
}

//---------------------------------------------------------------------------------------------------------------------------