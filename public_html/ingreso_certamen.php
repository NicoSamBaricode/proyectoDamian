<?php
$pageTitle = 'Acceso al Certamen - Sapienter';
require_once __DIR__ . '/lib/funciones.php';

try {
    $pdo = conectarse();
    $stmt = $pdo->prepare("
        SELECT id_empresa, nombre, ciudad, provincia 
        FROM usuarios_simu 
        WHERE registrado='0' AND privilegio='2' 
        ORDER BY nombre
    ");
    $stmt->execute();
    $empresas = $stmt->fetchAll();
} catch (PDOException $e) {
    $empresas = [];
    error_log("Error fetching empresas: " . $e->getMessage());
}
require_once __DIR__ . '/layouts/header.php';
?>

<div class="row justify-content-center">
    <div class="col-12">
        <!-- Hero Image -->
        <div class="text-center mb-4">
            <img src="/images/sapienter_certamen.jpg" alt="Certamen Juvenil de Gestión" class="img-fluid rounded shadow-custom" style="max-height: 300px; object-fit: cover;">
        </div>
    </div>
</div>

<div class="row justify-content-center">
    <!-- Login Form - Empresas Registradas -->
    <div class="col-md-6 col-lg-5 mb-4">
        <div class="card login-card shadow-custom">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0"><i class="bi bi-building-fill me-2"></i>Acceso de Empresa</h4>
                <small class="opacity-75">Para equipos ya registrados</small>
            </div>
            <div class="card-body">
                <form action="/acceso/login.php" method="post" class="needs-validation" novalidate>
                    <div class="mb-3">
                        <label for="txtUser" class="form-label"><i class="bi bi-person-fill me-1"></i>Usuario</label>
                        <input type="text" class="form-control" id="txtUser" name="txtUser" required maxlength="20" autocomplete="username">
                        <div class="invalid-feedback">Ingrese su usuario</div>
                    </div>
                    <div class="mb-3">
                        <label for="txtPass" class="form-label"><i class="bi bi-lock-fill me-1"></i>Clave</label>
                        <input type="password" class="form-control" id="txtPass" name="txtPass" required maxlength="20" autocomplete="current-password">
                        <div class="invalid-feedback">Ingrese su clave</div>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="bi bi-box-arrow-in-right me-2"></i>Entrar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- First Time Access Form -->
    <div class="col-md-6 col-lg-5 mb-4">
        <div class="card login-card shadow-custom">
            <div class="card-header bg-warning text-dark">
                <h4 class="mb-0"><i class="bi bi-person-plus-fill me-2"></i>Acceso por Primera Vez</h4>
                <small class="text-muted">Para nuevos equipos sin credenciales</small>
            </div>
            <div class="card-body">
                <form action="/acceso/login_inicial.php" method="post" class="needs-validation" novalidate>
                    <div class="mb-3">
                        <label for="txt_empresa" class="form-label"><i class="bi bi-building me-1"></i>Seleccione su Empresa</label>
                        <select class="form-select" id="txt_empresa" name="txt_empresa" required>
                            <option value="" selected disabled>-- Seleccione una empresa --</option>
                            <?php foreach ($empresas as $empresa): ?>
                                <option value="<?= htmlspecialchars($empresa['id_empresa']) ?>">
                                    <?= htmlspecialchars($empresa['nombre'] . ', ' . $empresa['ciudad'] . ' - ' . $empresa['provincia']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback">Seleccione una empresa</div>
                    </div>
                    <div class="mb-3">
                        <label for="txt_user_inicial" class="form-label"><i class="bi bi-person-fill me-1"></i>Nuevo Usuario</label>
                        <input type="text" class="form-control" id="txt_user_inicial" name="txt_user_inicial" required maxlength="20" autocomplete="username">
                        <div class="invalid-feedback">Ingrese un usuario</div>
                    </div>
                    <div class="mb-3">
                        <label for="txt_pass_inicial" class="form-label"><i class="bi bi-lock-fill me-1"></i>Nueva Clave</label>
                        <input type="password" class="form-control" id="txt_pass_inicial" name="txt_pass_inicial" required maxlength="20" autocomplete="new-password">
                        <div class="invalid-feedback">Ingrese una clave</div>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-warning btn-lg">
                            <i class="bi bi-check-circle-fill me-2"></i>Registrar y Entrar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Information Card -->
<div class="row justify-content-center">
    <div class="col-md-10 col-lg-8">
        <div class="card border-0 shadow-sm bg-light">
            <div class="card-body p-4">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h5 class="fw-bold text-primary mb-2"><i class="bi bi-info-circle-fill me-2"></i>Información Importante</h5>
                        <ul class="mb-0 text-muted small">
                            <li>Si es la primera vez que accede, use el formulario <strong>"Acceso por Primera Vez"</strong></li>
                            <li>Seleccione su empresa de la lista y cree su usuario y clave personal</li>
                            <li>Si ya tiene credenciales, use <strong>"Acceso de Empresa"</strong></li>
                            <li>Los datos son confidenciales y no se comparten con otros equipos</li>
                        </ul>
                    </div>
                    <div class="col-md-4 text-center text-md-end">
                        <a href="/informacion.html" class="btn btn-outline-primary">
                            <i class="bi bi-question-circle-fill me-1"></i> Más Información
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/layouts/footer.php'; ?>