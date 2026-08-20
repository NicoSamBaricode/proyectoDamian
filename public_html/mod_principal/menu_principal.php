<?php

header("Content-Type: text/html;charset=UTF-8");

//--------------------------------Inicio de sesion------------------------
require_once __DIR__ . '/../lib/sesion.php'; 

if ($_SESSION['permiso'] != 'autorizado' ){
    $mensaje = "Usuario sin permisos";
    $destino = "../acceso/index.php";
    header("location:mensaje_ok.php?mensaje=" . urlencode($mensaje) . "&destino=" . urlencode($destino));
    exit();
}

//--------------------------------Fin inicio de sesion------------------------
require_once __DIR__ . '/../lib/funciones.php';

$ejercicio = $_SESSION['ejercicio'];

if($_SESSION['tipo_jugador']=="Participante"){
    $query_documentos = "select * from archivos where habilitado='1' order by nombre"; 
} else {
    $query_documentos = "select * from archivos_invitado where habilitado='1' order by nombre";
}

$pdo = conectarse();
$stmt = $pdo->prepare($query_documentos);
$stmt->execute();
$documentos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Query for descargas
$query_descargas = "select titulo, archivo from informacion order by titulo";
$stmtDesc = $pdo->prepare($query_descargas);
$stmtDesc->execute();
$rec_descargas = $stmtDesc->fetchAll(PDO::FETCH_ASSOC);

$pageTitle = 'Panel Principal - Sapienter';
$currentPage = 'menu_principal';
require_once __DIR__ . '/../../layouts/header.php';
?>

<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold mb-0">Panel de Control</h2>
            <span class="badge bg-primary fs-6">Ejercicio <?= htmlspecialchars($ejercicio) ?></span>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="row mb-5">
    <div class="col-12">
        <div class="card border-0 shadow-custom">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="bi bi-lightning-fill me-2"></i>Acciones Rápidas</h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <?php if($ejercicio==7): ?>
                    <div class="col-md-6 col-lg-3">
                        <a href="cuestionario.php" class="btn btn-primary w-100 py-3 d-flex align-items-center justify-content-center gap-2 text-decoration-none" style="min-height: 100px;">
                            <div class="text-center">
                                <i class="bi bi-question-circle-fill fs-1"></i>
                                <div class="fw-bold mt-2">Cuestionario</div>
                                <small class="text-muted">Ejercicio 7 - Autoformación</small>
                            </div>
                        </a>
                    </div>
                    <?php else: ?>
                    <div class="col-md-6 col-lg-3">
                        <a href="decisiones.php" class="btn btn-primary w-100 py-3 d-flex align-items-center justify-content-center gap-2 text-decoration-none" style="min-height: 100px;">
                            <div class="text-center">
                                <i class="bi bi-graph-up fs-1"></i>
                                <div class="fw-bold mt-2">Ingresar Decisiones</div>
                                <small class="text-muted">Ejercicio <?= htmlspecialchars($ejercicio) ?></small>
                            </div>
                        </a>
                    </div>
                    <?php endif; ?>
                    
                    <div class="col-md-6 col-lg-3">
                        <a href="decisiones_historico.php" class="btn btn-outline-primary w-100 py-3 d-flex align-items-center justify-content-center gap-2 text-decoration-none" style="min-height: 100px;">
                            <div class="text-center">
                                <i class="bi bi-clock-history fs-1"></i>
                                <div class="fw-bold mt-2">Historial Decisiones</div>
                                <small class="text-muted">Ver decisiones ingresadas</small>
                            </div>
                        </a>
                    </div>
                    
                    <div class="col-md-6 col-lg-3">
                        <a href="cuestionario_historico.php" class="btn btn-outline-secondary w-100 py-3 d-flex align-items-center justify-content-center gap-2 text-decoration-none" style="min-height: 100px;">
                            <div class="text-center">
                                <i class="bi bi-list-check fs-1"></i>
                                <div class="fw-bold mt-2">Historial Cuestionarios</div>
                                <small class="text-muted">Ver respuestas guardadas</small>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Downloads Section -->
<div class="row mb-5">
    <div class="col-lg-6 mb-4">
        <div class="card border-0 shadow-custom h-100">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0"><i class="bi bi-file-earmark-arrow-down me-2"></i>Descargar Resultados</h5>
            </div>
            <div class="card-body">
                <div class="row g-2">
                    <?php for($i=2; $i<=6; $i++): ?>
                    <div class="col-6 col-md-4">
                        <a href="../../mod_principal/descargar_resultados.php?idi=<?= $i ?>" class="btn btn-outline-success w-100 py-2 text-decoration-none">
                            <i class="bi bi-file-earmark-spreadsheet me-1"></i>Ejercicio <?= $i ?>
                        </a>
                    </div>
                    <?php endfor; ?>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-6 mb-4">
        <div class="card border-0 shadow-custom h-100">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0"><i class="bi bi-file-earmark-text me-2"></i>Descargar Informes de Zona</h5>
            </div>
            <div class="card-body">
                <div class="row g-2">
                    <?php for($i=2; $i<=6; $i++): ?>
                    <div class="col-6 col-md-4">
                        <a href="../../mod_principal/descargar_informe.php?idi=<?= $i ?>" class="btn btn-outline-info w-100 py-2 text-decoration-none">
                            <i class="bi bi-file-earmark-text me-1"></i>Ejercicio <?= $i ?>
                        </a>
                    </div>
                    <?php endfor; ?>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-12">
        <div class="card border-0 shadow-custom">
            <div class="card-header bg-warning text-dark">
                <h5 class="mb-0"><i class="bi bi-journal-text me-2"></i>Informativos y Tutoriales</h5>
            </div>
            <div class="card-body">
                <?php if(empty($rec_descargas)): ?>
                    <div class="text-center text-muted py-4">
                        <i class="bi bi-inbox fs-1"></i>
                        <p class="mt-2">No hay informativos disponibles</p>
                    </div>
                <?php else: ?>
                    <div class="row g-2">
                        <?php foreach($rec_descargas as $descargas): ?>
                        <div class="col-md-6">
                            <a href="<?= '../informacion/' . htmlspecialchars($descargas['archivo']) ?>" target="_blank" class="btn btn-outline-warning w-100 text-start py-2 text-decoration-none">
                                <i class="bi bi-file-earmark me-2"></i>
                                <?= htmlspecialchars($descargas['titulo'] . ' (' . $descargas['archivo'] . ')') ?>
                            </a>
                        </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Admin/Professor Panels -->
<?php if(isset($_SESSION['prof_privilegio']) && $_SESSION['prof_privilegio']==3 || isset($_SESSION['admin_privilegio']) && $_SESSION['admin_privilegio']==1): ?>
<div class="row mt-4">
    <div class="col-12">
        <div class="card border-0 shadow-custom">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0"><i class="bi bi-gear-fill me-2"></i>Paneles de Administración</h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <?php if(isset($_SESSION['prof_privilegio']) && $_SESSION['prof_privilegio']==3): ?>
                    <div class="col-md-6">
                        <form method="post" action="../../acceso/login.php" class="h-100">
                            <input type="hidden" name="txtUser" value="<?= htmlspecialchars($_SESSION['prof_us'] ?? '') ?>">
                            <input type="hidden" name="txtPass" value="<?= htmlspecialchars($_SESSION['prof_pass'] ?? '') ?>">
                            <button type="submit" class="btn btn-outline-info w-100 py-3 h-100 d-flex align-items-center justify-content-center gap-2">
                                <i class="bi bi-person-workspace fs-2"></i>
                                <div class="text-start">
                                    <div class="fw-bold">Panel de Profesor</div>
                                    <small class="text-muted">Gestionar empresas asignadas</small>
                                </div>
                            </button>
                        </form>
                    </div>
                    <?php endif; ?>
                    
                    <?php if(isset($_SESSION['admin_privilegio']) && $_SESSION['admin_privilegio']==1): ?>
                    <div class="col-md-6">
                        <form method="post" action="../../acceso/login.php" class="h-100">
                            <input type="hidden" name="txtUser" value="<?= htmlspecialchars($_SESSION['admin_us'] ?? '') ?>">
                            <input type="hidden" name="txtPass" value="<?= htmlspecialchars($_SESSION['admin_pass'] ?? '') ?>">
                            <button type="submit" class="btn btn-outline-danger w-100 py-3 h-100 d-flex align-items-center justify-content-center gap-2">
                                <i class="bi bi-shield-lock fs-2"></i>
                                <div class="text-start">
                                    <div class="fw-bold">Panel de Administrador</div>
                                    <small class="text-muted">Gestión completa del sistema</small>
                                </div>
                            </button>
                        </form>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<!-- Documents Table -->
<?php if(!empty($documentos)): ?>
<div class="row mt-5">
    <div class="col-12">
        <div class="card border-0 shadow-custom">
            <div class="card-header bg-secondary text-white">
                <h5 class="mb-0"><i class="bi bi-folder-fill me-2"></i>Archivos Disponibles</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Archivo</th>
                                <th class="text-center">Ejercicio</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($documentos as $doc): ?>
                            <tr>
                                <td class="fw-medium"><?= htmlspecialchars($doc['nombre']) ?></td>
                                <td class="text-center">
                                    <span class="badge bg-primary"><?= htmlspecialchars($doc['ejercicio']) ?></span>
                                </td>
                                <td class="text-center">
                                    <a href="<?= '../ejersicios/' . htmlspecialchars($doc['nombre']) ?>" class="btn btn-sm btn-outline-primary" target="_blank">
                                        <i class="bi bi-download me-1"></i>Descargar
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<?php require_once __DIR__ . '/../../layouts/footer.php'; ?>