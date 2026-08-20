<?php
$pageTitle = 'Información del Certamen - Sapienter';
require_once __DIR__ . '/layouts/header.php';
?>

<div class="row">
    <div class="col-12">
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/index.php">Inicio</a></li>
                <li class="breadcrumb-item active" aria-current="page">Información del Certamen</li>
            </ol>
        </nav>
    </div>
</div>

<!-- Hero Section -->
<section class="mb-5">
    <div class="card border-0 shadow-custom" style="background: linear-gradient(135deg, var(--sapienter-primary) 0%, #0b5ed7 100%);">
        <div class="card-body text-white py-5">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h1 class="display-4 fw-bold mb-3">
                            <i class="bi bi-trophy-fill me-3"></i>
                            Certamen Juvenil de Gestión
                        </h1>
                        <p class="lead mb-0 opacity-75">
                            Simulador empresarial educativo para estudiantes de nivel secundario y terciario.
                            Desarrolla habilidades de gestión, finanzas y estrategia en un entorno realista.
                        </p>
                    </div>
                    <div class="col-md-4 text-center">
                        <i class="bi bi-mortarboard-fill" style="font-size: 8rem; opacity: 0.3;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Qué es el Certamen -->
<section class="mb-5">
    <div class="container">
        <div class="row mb-4">
            <div class="col-12 text-center">
                <h2 class="fw-bold">¿Qué es el Certamen?</h2>
                <p class="text-muted">Una experiencia educativa única que simula la gestión empresarial real</p>
            </div>
        </div>
        
        <div class="row g-4">
            <div class="col-md-6">
                <div class="card h-100 border-0 shadow-custom">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-start">
                            <div class="bg-primary bg-opacity-10 text-primary rounded-circle p-3 me-3" style="width: 60px; height: 60px; flex-shrink: 0;">
                                <i class="bi bi-building-fill" style="font-size: 1.5rem;"></i>
                            </div>
                            <div>
                                <h4 class="fw-bold">Simulación Empresarial</h4>
                                <p class="text-muted mb-0">Cada equipo gestiona una empresa virtual tomando decisiones de producción, marketing, finanzas e innovación durante varias rondas.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="card h-100 border-0 shadow-custom">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-start">
                            <div class="bg-success bg-opacity-10 text-success rounded-circle p-3 me-3" style="width: 60px; height: 60px; flex-shrink: 0;">
                                <i class="bi bi-people-fill" style="font-size: 1.5rem;"></i>
                            </div>
                            <div>
                                <h4 class="fw-bold">Trabajo en Equipo</h4>
                                <p class="text-muted mb-0">Los estudiantes forman equipos de 3-5 integrantes, asumiendo roles gerenciales (CEO, CFO, CMO, COO) para tomar decisiones consensuadas.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="card h-100 border-0 shadow-custom">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-start">
                            <div class="bg-warning bg-opacity-10 text-warning rounded-circle p-3 me-3" style="width: 60px; height: 60px; flex-shrink: 0;">
                                <i class="bi bi-graph-up-arrow" style="font-size: 1.5rem;"></i>
                            </div>
                            <div>
                                <h4 class="fw-bold">Retroalimentación Inmediata</h4>
                                <p class="text-muted mb-0">Después de cada ronda, reciben reportes financieros, de mercado y posicionamiento competitivo para ajustar su estrategia.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="card h-100 border-0 shadow-custom">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-start">
                            <div class="bg-info bg-opacity-10 text-info rounded-circle p-3 me-3" style="width: 60px; height: 60px; flex-shrink: 0;">
                                <i class="bi bi-award-fill" style="font-size: 1.5rem;"></i>
                            </div>
                            <div>
                                <h4 class="fw-bold">Competencia Saludable</h4>
                                <p class="text-muted mb-0">Los equipos compiten por métricas de rentabilidad, cuota de mercado, innovación y sustentabilidad. Reconocimientos por categoría y ranking general.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Cómo funciona -->
<section class="mb-5 bg-light py-5">
    <div class="container">
        <div class="row mb-4">
            <div class="col-12 text-center">
                <h2 class="fw-bold">¿Cómo funciona?</h2>
                <p class="text-muted">Proceso simple en 4 etapas</p>
            </div>
        </div>
        
        <div class="row g-4">
            <div class="col-md-3 text-center">
                <div class="p-3">
                    <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px; font-size: 2rem;">
                        <span class="fw-bold">1</span>
                    </div>
                    <h5 class="fw-bold">Inscripción</h5>
                    <p class="text-muted small">Equipos se registran y reciben credenciales de acceso al simulador</p>
                </div>
            </div>
            <div class="col-md-3 text-center">
                <div class="p-3">
                    <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px; font-size: 2rem;">
                        <span class="fw-bold">2</span>
                    </div>
                    <h5 class="fw-bold">Capacitación</h5>
                    <p class="text-muted small">Acceso a materiales, tutoriales y casos de práctica antes de la competencia</p>
                </div>
            </div>
            <div class="col-md-3 text-center">
                <div class="p-3">
                    <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px; font-size: 2rem;">
                        <span class="fw-bold">3</span>
                    </div>
                    <h5 class="fw-bold">Competencia</h5>
                    <p class="text-muted small">Rondas de decisiones con plazos definidos, análisis de resultados y ajustes estratégicos</p>
                </div>
            </div>
            <div class="col-md-3 text-center">
                <div class="p-3">
                    <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px; font-size: 2rem;">
                        <span class="fw-bold">4</span>
                    </div>
                    <h5 class="fw-bold">Premiación</h5>
                    <p class="text-muted small">Evaluación final, ranking de ganadores y entrega de reconocimientos</p>
                </div>
            </div>
        </div>
        
        <!-- Connector lines between steps -->
        <div class="row d-none d-md-block">
            <div class="col-md-3"></div>
            <div class="col-md-3">
                <hr class="border-primary border-2 mt-4 mb-0" style="margin-left: 40px; margin-right: 40px;">
            </div>
            <div class="col-md-3">
                <hr class="border-primary border-2 mt-4 mb-0" style="margin-left: 40px; margin-right: 40px;">
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
</section>

<!-- Áreas de decisión -->
<section class="mb-5">
    <div class="container">
        <div class="row mb-4">
            <div class="col-12 text-center">
                <h2 class="fw-bold">Áreas de Decisión</h2>
                <p class="text-muted">Cada ronda, los equipos definen estrategias en 5 dimensiones clave</p>
            </div>
        </div>
        
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card border-0 shadow-custom h-100">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="bi bi-tag-fill me-2"></i>Precio y Producción</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Precio de venta unitario</li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Unidades a producir</li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Gestión de inventario</li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card border-0 shadow-custom h-100">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0"><i class="bi bi-megaphone-fill me-2"></i>Marketing y Comercialización</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Gastos de comercialización</li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Estrategia de promoción</li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Canales de distribución</li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card border-0 shadow-custom h-100">
                    <div class="card-header bg-warning text-dark">
                        <h5 class="mb-0"><i class="bi bi-cpu-fill me-2"></i>Inversión y Activos</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Compra de bienes de uso</li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Capacidad productiva</li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Mantenimiento y upgrades</li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card border-0 shadow-custom h-100">
                    <div class="card-header bg-info text-white">
                        <h5 class="mb-0"><i class="bi bi-lightbulb-fill me-2"></i>I+D e Innovación</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Inversión en I+D</li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Desarrollo de productos</li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Diferenciación competitiva</li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card border-0 shadow-custom h-100">
                    <div class="card-header bg-danger text-white">
                        <h5 class="mb-0"><i class="bi bi-leaf-fill me-2"></i>Sustentabilidad</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Impacto ambiental</li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Responsabilidad social</li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Certificaciones verdes</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Para profesores -->
<section class="mb-5 bg-light py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h2 class="fw-bold mb-3">Para Docentes</h2>
                <p class="text-muted mb-4">El certamen incluye herramientas pedagógicas para integrar la simulación al currículo:</p>
                <ul class="list-unstyled">
                    <li class="mb-2"><i class="bi bi-check-circle-fill text-primary me-2"></i>Guía docente con objetivos de aprendizaje</li>
                    <li class="mb-2"><i class="bi bi-check-circle-fill text-primary me-2"></i>Rúbricas de evaluación por competencias</li>
                    <li class="mb-2"><i class="bi bi-check-circle-fill text-primary me-2"></i>Panel de seguimiento de equipos en tiempo real</li>
                    <li class="mb-2"><i class="bi bi-check-circle-fill text-primary me-2"></i>Casos de estudio y materiales de apoyo</li>
                    <li class="mb-2"><i class="bi bi-check-circle-fill text-primary me-2"></i>Certificación de participación para estudiantes</li>
                </ul>
                <a href="/ingreso_certamen.php" class="btn btn-primary mt-3">
                    <i class="bi bi-person-plus-fill me-2"></i>Registrar mi curso
                </a>
            </div>
            <div class="col-md-6 text-center">
                <i class="bi bi-person-workspace" style="font-size: 12rem; opacity: 0.1;"></i>
            </div>
        </div>
    </div>
</section>

<!-- FAQ -->
<section class="mb-5">
    <div class="container">
        <div class="row mb-4">
            <div class="col-12 text-center">
                <h2 class="fw-bold">Preguntas Frecuentes</h2>
            </div>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="accordion" id="faqAccordion">
                    <div class="accordion-item border-0 shadow-sm mb-3">
                        <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                <i class="bi bi-question-circle-fill me-2"></i>¿Quiénes pueden participar?
                            </button>
                        </h2>
                        <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">Estudiantes de nivel secundario (últimos años) y terciario/universitario (primeros años), organizados en equipos de 3 a 5 integrantes bajo la supervisión de un docente tutor.</div>
                        </div>
                    </div>
                    
                    <div class="accordion-item border-0 shadow-sm mb-3">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                <i class="bi bi-question-circle-fill me-2"></i>¿Cuánto dura la competencia?
                            </button>
                        </h2>
                        <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">La competencia estándar tiene una duración de 6 a 8 rondas, con una ronda por semana. Cada ronda requiere 2-3 horas de trabajo en equipo para análisis y toma de decisiones.</div>
                        </div>
                    </div>
                    
                    <div class="accordion-item border-0 shadow-sm mb-3">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                <i class="bi bi-question-circle-fill me-2"></i>¿Qué conocimientos previos se necesitan?
                            </button>
                        </h2>
                        <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">No se requieren conocimientos previos avanzados. El simulador incluye tutoriales interactivos y la guía docente cubre los conceptos fundamentales de gestión, finanzas y estrategia necesarios.</div>
                        </div>
                    </div>
                    
                    <div class="accordion-item border-0 shadow-sm mb-3">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                                <i class="bi bi-question-circle-fill me-2"></i>¿Hay costos de inscripción?
                            </button>
                        </h2>
                        <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">Consultar condiciones vigentes. Generalmente hay modalidades gratuitas para instituciones educativas públicas y aranceles diferenciados para privadas. Contactar a <a href="mailto:info@sapienter.org">info@sapienter.org</a>.</div>
                        </div>
                    </div>
                    
                    <div class="accordion-item border-0 shadow-sm mb-3">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq5">
                                <i class="bi bi-question-circle-fill me-2"></i>¿Qué tecnología se necesita?
                            </button>
                        </h2>
                        <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">Solo un navegador web moderno y conexión a internet. La plataforma es responsive y funciona en computadoras, tablets y smartphones. No requiere instalación de software.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Final -->
<section class="mb-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 text-center">
                <div class="card border-0 shadow-custom" style="background: linear-gradient(135deg, var(--sapienter-primary) 0%, #0b5ed7 100%);">
                    <div class="card-body text-white p-5">
                        <h2 class="fw-bold mb-3">¿Listo para llevar a tus estudiantes al siguiente nivel?</h2>
                        <p class="lead mb-4">Inscríbete en el Certamen Juvenil de Gestión y transforma la forma en que aprenden administración de empresas.</p>
                        <div class="d-flex justify-content-center gap-3 flex-wrap">
                            <a href="/ingreso_certamen.php" class="btn btn-warning btn-lg px-5">
                                <i class="bi bi-rocket-takeoff-fill me-2"></i>Comenzar Ahora
                            </a>
                            <a href="mailto:info@sapienter.org" class="btn btn-outline-light btn-lg px-5">
                                <i class="bi bi-envelope-fill me-2"></i>Solicitar Info
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/layouts/footer.php'; ?>