<?php

header("Content-Type: text/html;charset=UTF-8");

//--------------------------------Inicio de sesion------------------------
require_once __DIR__ . '/../lib/sesion.php'; 
require_once __DIR__ . '/../lib/funciones.php';

if ($_SESSION['permiso'] != 'autorizado'){
    $mensaje = "Usuario sin permisos";
    $destino = "../ingreso_certamen.php";
    include("../includes/mensaje.php");
    exit();
}

if ($_SESSION['subir'] == 0){	
    $mensaje = "El plazo para subir decisiones ha finalizado.";
    $destino = "menu_principal.php";
    include("../includes/mensaje.php");	
    exit();
}

//--------------------------------Fin inicio de sesion------------------------
$ejercicio = $_SESSION['ejercicio'];

try {
    $pdo = conectarse();
    
    // Get document list
    $stmt = $pdo->prepare("SELECT * FROM archivos WHERE habilitado='1' ORDER BY nombre");
    $stmt->execute();
    $documentos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Get exercise parameters
    $stmt = $pdo->prepare("
        SELECT PrecioVentaMin, PrecioVentaMax, UnidadesMin, UnidadesMax, 
               GastosComercializacionMin, GastosComercializacionMax, 
               CompraBienesUsoMin, CompraBienesUsoMax, InnovacionMin, InnovacionMax, 
               SustentabilidadMin, SustentabilidadMax
        FROM archivos
        WHERE ejercicio = ?
    ");
    $stmt->execute([$ejercicio]);
    $parametros = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$parametros) {
        $mensaje = "No se encontraron parámetros para el ejercicio actual.";
        $destino = "menu_principal.php";
        include("../includes/mensaje.php");
        exit();
    }
    
    $PrecioVentaMin = $parametros["PrecioVentaMin"];
    $PrecioVentaMax = $parametros["PrecioVentaMax"];
    $UnidadesMin = $parametros["UnidadesMin"];
    $UnidadesMax = $parametros["UnidadesMax"];
    $GastosComercializacionMin = $parametros["GastosComercializacionMin"];
    $GastosComercializacionMax = $parametros["GastosComercializacionMax"];
    $CompraBienesUsoMin = $parametros["CompraBienesUsoMin"];
    $CompraBienesUsoMax = $parametros["CompraBienesUsoMax"];
    $InnovacionMin = $parametros["InnovacionMin"];
    $InnovacionMax = $parametros["InnovacionMax"];
    $SustentabilidadMin = $parametros["SustentabilidadMin"];
    $SustentabilidadMax = $parametros["SustentabilidadMax"];
    
} catch (PDOException $e) {
    error_log("Decisiones error: " . $e->getMessage());
    $mensaje = "Error de conexión a la base de datos.";
    $destino = "menu_principal.php";
    include("../includes/mensaje.php");
    exit();
}

$pageTitle = 'Ingresar Decisiones - Ejercicio ' . $ejercicio;
$currentPage = 'decisiones';
require_once __DIR__ . '/../../layouts/header.php';
?>

<script>
// Validaciones del formulario
function validar(frm) {
    const fields = [
        {id: 'txt_precio_venta', min: <?= $PrecioVentaMin ?>, max: <?= $PrecioVentaMax ?>, name: 'Precio de venta'},
        {id: 'txt_unidades', min: <?= $UnidadesMin ?>, max: <?= $UnidadesMax ?>, name: 'Unidades a producir'},
        {id: 'txt_gastos_comer', min: <?= $GastosComercializacionMin ?>, max: <?= $GastosComercializacionMax ?>, name: 'Gastos de comercialización'},
        {id: 'txt_compra_bienes', min: <?= $CompraBienesUsoMin ?>, max: <?= $CompraBienesUsoMax ?>, name: 'Compra bienes de uso'},
        {id: 'txt_innovacion', min: <?= $InnovacionMin ?>, max: <?= $InnovacionMax ?>, name: 'Innovación y desarrollo'},
        {id: 'txt_sustentabilidad', min: <?= $SustentabilidadMin ?>, max: <?= $SustentabilidadMax ?>, name: 'Sustentabilidad'}
    ];
    
    for (const field of fields) {
        const val = parseInt(document.getElementById(field.id).value);
        if (isNaN(val) || val < field.min || val > field.max) {
            alert(field.name + ". Debe ser un número entero, comprendido entre " + field.min + " y " + field.max);
            document.getElementById(field.id).focus();
            return false;
        }
    }
    return confirm('¿Confirmas el envío de las decisiones?');
}
</script>

<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold mb-0"><i class="bi bi-graph-up me-2"></i>Ingresar Decisiones</h2>
            <span class="badge bg-primary fs-6">Ejercicio <?= htmlspecialchars($ejercicio) ?></span>
        </div>
    </div>
</div>

<!-- Parameter Reference Card -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm bg-light">
            <div class="card-header bg-secondary text-white">
                <h5 class="mb-0"><i class="bi bi-info-circle me-2"></i>Parámetros del Ejercicio <?= htmlspecialchars($ejercicio) ?></h5>
            </div>
            <div class="card-body">
                <div class="row g-2">
                    <div class="col-md-2"><strong>Precio Venta:</strong> $<?= number_format($PrecioVentaMin,0,',','.') ?> - $<?= number_format($PrecioVentaMax,0,',','.') ?></div>
                    <div class="col-md-2"><strong>Unidades:</strong> <?= $UnidadesMin ?> - <?= $UnidadesMax ?></div>
                    <div class="col-md-2"><strong>Gastos Com.:</strong> $<?= number_format($GastosComercializacionMin,0,',','.') ?> - $<?= number_format($GastosComercializacionMax,0,',','.') ?></div>
                    <div class="col-md-2"><strong>Bienes Uso:</strong> $<?= number_format($CompraBienesUsoMin,0,',','.') ?> - $<?= number_format($CompraBienesUsoMax,0,',','.') ?></div>
                    <div class="col-md-2"><strong>Innovación:</strong> $<?= number_format($InnovacionMin,0,',','.') ?> - $<?= number_format($InnovacionMax,0,',','.') ?></div>
                    <div class="col-md-2"><strong>Sustentab.:</strong> $<?= number_format($SustentabilidadMin,0,',','.') ?> - $<?= number_format($SustentabilidadMax,0,',','.') ?></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Decision Form -->
<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card border-0 shadow-custom">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0"><i class="bi bi-pencil-square me-2"></i>Formulario de Decisiones - Ejercicio <?= htmlspecialchars($ejercicio) ?></h4>
            </div>
            <div class="card-body p-4">
                <form action="decisiones_proc.php" method="post" id="decisionForm" onSubmit="return validar(this)" class="needs-validation" novalidate>
                    
                    <div class="row g-3">
                        <!-- Precio de venta -->
                        <div class="col-md-6">
                            <label for="txt_precio_venta" class="form-label fw-bold"><i class="bi bi-tag-fill me-1"></i>Precio de venta</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" class="form-control" id="txt_precio_venta" name="txt_precio_venta" 
                                       min="<?= $PrecioVentaMin ?>" max="<?= $PrecioVentaMax ?>" required
                                       placeholder="Ingrese precio">
                                <span class="input-group-text">Min: $<?= number_format($PrecioVentaMin,0,',','.') ?> | Max: $<?= number_format($PrecioVentaMax,0,',','.') ?></span>
                            </div>
                            <div class="invalid-feedback">Ingrese un precio entre $<?= number_format($PrecioVentaMin,0,',','.') ?> y $<?= number_format($PrecioVentaMax,0,',','.') ?></div>
                        </div>
                        
                        <!-- Unidades a producir -->
                        <div class="col-md-6">
                            <label for="txt_unidades" class="form-label fw-bold"><i class="bi bi-boxes me-1"></i>Unidades a producir</label>
                            <input type="number" class="form-control" id="txt_unidades" name="txt_unidades" 
                                   min="<?= $UnidadesMin ?>" max="<?= $UnidadesMax ?>" required
                                   placeholder="Ingrese unidades">
                            <div class="form-text">Min: <?= $UnidadesMin ?> | Max: <?= $UnidadesMax ?> (capacidad máxima de fábrica)</div>
                            <div class="invalid-feedback">Ingrese unidades entre <?= $UnidadesMin ?> y <?= $UnidadesMax ?></div>
                        </div>
                        
                        <!-- Gastos de comercialización -->
                        <div class="col-md-6">
                            <label for="txt_gastos_comer" class="form-label fw-bold"><i class="bi bi-megaphone me-1"></i>Gastos de comercialización</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" class="form-control" id="txt_gastos_comer" name="txt_gastos_comer" 
                                       min="<?= $GastosComercializacionMin ?>" max="<?= $GastosComercializacionMax ?>" required
                                       placeholder="Ingrese gastos">
                                <span class="input-group-text">Min: $<?= number_format($GastosComercializacionMin,0,',','.') ?> | Max: $<?= number_format($GastosComercializacionMax,0,',','.') ?></span>
                            </div>
                            <div class="invalid-feedback">Ingrese gastos entre $<?= number_format($GastosComercializacionMin,0,',','.') ?> y $<?= number_format($GastosComercializacionMax,0,',','.') ?></div>
                        </div>
                        
                        <!-- Compra de bienes de uso -->
                        <div class="col-md-6">
                            <label for="txt_compra_bienes" class="form-label fw-bold"><i class="bi bi-tools me-1"></i>Compra de bienes de uso</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" class="form-control" id="txt_compra_bienes" name="txt_compra_bienes" 
                                       min="<?= $CompraBienesUsoMin ?>" max="<?= $CompraBienesUsoMax ?>" required
                                       placeholder="Ingrese inversión">
                                <span class="input-group-text">Min: $<?= number_format($CompraBienesUsoMin,0,',','.') ?> | Max: $<?= number_format($CompraBienesUsoMax,0,',','.') ?></span>
                            </div>
                            <div class="invalid-feedback">Ingrese inversión entre $<?= number_format($CompraBienesUsoMin,0,',','.') ?> y $<?= number_format($CompraBienesUsoMax,0,',','.') ?></div>
                        </div>
                        
                        <!-- Innovación y desarrollo -->
                        <div class="col-md-6">
                            <label for="txt_innovacion" class="form-label fw-bold"><i class="bi bi-lightbulb me-1"></i>Desarrollo del talento humano</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" class="form-control" id="txt_innovacion" name="txt_innovacion" 
                                       min="<?= $InnovacionMin ?>" max="<?= $InnovacionMax ?>" required
                                       placeholder="Ingrese inversión">
                                <span class="input-group-text">Min: $<?= number_format($InnovacionMin,0,',','.') ?> | Max: $<?= number_format($InnovacionMax,0,',','.') ?></span>
                            </div>
                            <div class="invalid-feedback">Ingrese inversión entre $<?= number_format($InnovacionMin,0,',','.') ?> y $<?= number_format($InnovacionMax,0,',','.') ?></div>
                        </div>
                        
                        <!-- Sustentabilidad -->
                        <div class="col-md-6">
                            <label for="txt_sustentabilidad" class="form-label fw-bold"><i class="bi bi-leaf me-1"></i>Innovación y Sustentabilidad</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" class="form-control" id="txt_sustentabilidad" name="txt_sustentabilidad" 
                                       min="<?= $SustentabilidadMin ?>" max="<?= $SustentabilidadMax ?>" required
                                       placeholder="Ingrese inversión">
                                <span class="input-group-text">Min: $<?= number_format($SustentabilidadMin,0,',','.') ?> | Max: $<?= number_format($SustentabilidadMax,0,',','.') ?></span>
                            </div>
                            <div class="invalid-feedback">Ingrese inversión entre $<?= number_format($SustentabilidadMin,0,',','.') ?> y $<?= number_format($SustentabilidadMax,0,',','.') ?></div>
                        </div>
                    </div>
                    
                    <hr class="my-4">
                    
                    <div class="d-flex justify-content-between">
                        <a href="menu_principal.php" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left me-1"></i>Volver
                        </a>
                        <button type="submit" class="btn btn-primary btn-lg px-5">
                            <i class="bi bi-save-fill me-2"></i>Guardar Decisiones
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Help Sidebar -->
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm sticky-top" style="top: 20px;">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0"><i class="bi bi-lightbulb me-2"></i>Guía Rápida</h5>
            </div>
            <div class="card-body">
                <div class="accordion" id="helpAccordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#help1">
                                <i class="bi bi-tag me-2"></i>Precio de Venta
                            </button>
                        </h2>
                        <div id="help1" class="accordion-collapse collapse" data-bs-parent="#helpAccordion">
                            <div class="accordion-body small">Define el precio unitario de tu producto. Afecta directamente la demanda y el posicionamiento de mercado.</div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#help2">
                                <i class="bi bi-boxes me-2"></i>Unidades a Producir
                            </button>
                        </h2>
                        <div id="help2" class="accordion-collapse collapse" data-bs-parent="#helpAccordion">
                            <div class="accordion-body small">Cantidad a fabricar. No puede superar la capacidad máxima de tu fábrica. Exceso genera costos de inventario.</div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#help3">
                                <i class="bi bi-megaphone me-2"></i>Gastos de Comercialización
                            </button>
                        </h2>
                        <div id="help3" class="accordion-collapse collapse" data-bs-parent="#helpAccordion">
                            <div class="accordion-body small">Inversión en marketing y publicidad. Aumenta la visibilidad y demanda de tu producto.</div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#help4">
                                <i class="bi bi-tools me-2"></i>Compra Bienes de Uso
                            </button>
                        </h2>
                        <div id="help4" class="accordion-collapse collapse" data-bs-parent="#helpAccordion">
                            <div class="accordion-body small">Inversión en maquinaria y equipamiento. Aumenta capacidad productiva futura.</div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#help5">
                                <i class="bi bi-lightbulb me-2"></i>Talento Humano / Innovación
                            </button>
                        </h2>
                        <div id="help5" class="accordion-collapse collapse" data-bs-parent="#helpAccordion">
                            <div class="accordion-body small">Desarrollo de capacidades del equipo. Mejora productividad y calidad.</div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#help6">
                                <i class="bi bi-leaf me-2"></i>Sustentabilidad
                            </button>
                        </h2>
                        <div id="help6" class="accordion-collapse collapse" data-bs-parent="#helpAccordion">
                            <div class="accordion-body small">Inversión en prácticas sostenibles. Mejora imagen corporativa y reduce riesgos regulatorios.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Quick Links -->
        <div class="card border-0 shadow-sm mt-3">
            <div class="card-body">
                <a href="menu_principal.php" class="btn btn-outline-secondary w-100 mb-2">
                    <i class="bi bi-arrow-left me-1"></i>Volver al Panel
                </a>
                <a href="decisiones_historico.php" class="btn btn-outline-primary w-100">
                    <i class="bi bi-clock-history me-1"></i>Ver Historial
                </a>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../../layouts/footer.php'; ?>

<script>
// Client-side validation
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('decisionForm');
    if (form) {
        form.addEventListener('submit', function(e) {
            if (!form.checkValidity()) {
                e.preventDefault();
                e.stopPropagation();
            }
            form.classList.add('was-validated');
        });
    }
});
</script>