<?php
$pageTitle = 'Sapienter - Certamen Juvenil de Gestión';
require_once __DIR__ . '/layouts/header.php';
?>

<!-- Hero Section -->
<section class="hero-section">
    <div class="container text-center">
        <h1 class="display-3 fw-bold">
            <i class="bi bi-mortarboard-fill me-3"></i>
            Certamen Juvenil de Gestión
        </h1>
        <p class="lead mb-4">
            Simulador empresarial educativo para estudiantes.<br>
            Desarrolla tus habilidades de gestión en un entorno realista.
        </p>
        <div class="d-flex justify-content-center gap-3 flex-wrap">
            <a href="/ingreso_certamen.php" class="btn btn-warning btn-lg px-4">
                <i class="bi bi-trophy-fill me-2"></i> Acceder al Certamen
            </a>
            <a href="/informacion.html" class="btn btn-outline-light btn-lg px-4">
                <i class="bi bi-info-circle-fill me-2"></i> Más Información
            </a>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-5">
    <div class="container">
        <div class="row text-center mb-5">
            <div class="col-12">
                <h2 class="fw-bold mb-3">¿Por qué participar?</h2>
                <p class="text-muted lead">Una experiencia educativa completa que simula la gestión empresarial real</p>
            </div>
        </div>
        
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card feature-card h-100 border-0 shadow-custom">
                    <div class="card-body">
                        <div class="icon">
                            <i class="bi bi-graph-up-arrow"></i>
                        </div>
                        <h4 class="fw-bold">Toma de Decisiones</h4>
                        <p class="text-muted">Aprende a analizar mercados, definir estrategias y tomar decisiones financieras críticas.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card feature-card h-100 border-0 shadow-custom">
                    <div class="card-body">
                        <div class="icon">
                            <i class="bi bi-people-fill"></i>
                        </div>
                        <h4 class="fw-bold">Trabajo en Equipo</h4>
                        <p class="text-muted">Colabora con tu equipo para gestionar una empresa virtual y competir con otros grupos.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card feature-card h-100 border-0 shadow-custom">
                    <div class="card-body">
                        <div class="icon">
                            <i class="bi bi-award-fill"></i>
                        </div>
                        <h4 class="fw-bold">Competencia Real</h4>
                        <p class="text-muted">Compite en un entorno simulado realista con retroalimentación inmediata de tus resultados.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- How it Works Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row text-center mb-5">
            <div class="col-12">
                <h2 class="fw-bold mb-3">¿Cómo funciona?</h2>
            </div>
        </div>
        
        <div class="row g-4">
            <div class="col-md-3 text-center">
                <div class="p-3">
                    <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px; font-size: 2rem;">
                        <i class="bi bi-person-plus-fill"></i>
                    </div>
                    <h5 class="fw-bold">1. Regístrate</h5>
                    <p class="text-muted small">Crea tu equipo y accede al simulador</p>
                </div>
            </div>
            <div class="col-md-3 text-center">
                <div class="p-3">
                    <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px; font-size: 2rem;">
                        <i class="bi bi-cpu-fill"></i>
                    </div>
                    <h5 class="fw-bold">2. Decide</h5>
                    <p class="text-muted small">Toma decisiones estratégicas cada ronda</p>
                </div>
            </div>
            <div class="col-md-3 text-center">
                <div class="p-3">
                    <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px; font-size: 2rem;">
                        <i class="bi bi-bar-chart-fill"></i>
                    </div>
                    <h5 class="fw-bold">3. Analiza</h5>
                    <p class="text-muted small">Revisa resultados y ajusta tu estrategia</p>
                </div>
            </div>
            <div class="col-md-3 text-center">
                <div class="p-3">
                    <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px; font-size: 2rem;">
                        <i class="bi bi-trophy-fill"></i>
                    </div>
                    <h5 class="fw-bold">4. Gana</h5>
                    <p class="text-muted small">Compite por el primer puesto</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center">
                <div class="card border-0 shadow-custom" style="background: linear-gradient(135deg, var(--sapienter-primary) 0%, #0b5ed7 100%);">
                    <div class="card-body text-white p-5">
                        <h2 class="fw-bold mb-3">¿Listo para comenzar?</h2>
                        <p class="lead mb-4">Únete a miles de estudiantes que ya participaron en el Certamen Juvenil de Gestión</p>
                        <a href="/ingreso_certamen.php" class="btn btn-warning btn-lg px-5">
                            <i class="bi bi-arrow-right-circle-fill me-2"></i> Comenzar Ahora
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/layouts/footer.php'; ?>