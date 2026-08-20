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

$pageTitle = 'Cuestionario de Autoformación - Ejercicio ' . $ejercicio;
$currentPage = 'cuestionario';
require_once __DIR__ . '/../layouts/header.php';
?>

<script>
function validar(frm) {
    const required = ['txt_1','txt_2','txt_3','txt_4','txt_5','txt_6','txt_7','txt_8','txt_9','txt_10'];
    for (const field of required) {
        if (!frm[field].value) {
            alert("Todas las respuestas son obligatorias");
            frm[field].focus();
            return false;
        }
    }
    return confirm('¿Confirmas el envío del cuestionario?');
}
</script>

<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold mb-0"><i class="bi bi-question-circle-fill me-2"></i>Cuestionario de Autoformación</h2>
            <span class="badge bg-info fs-6">Ejercicio <?= htmlspecialchars($ejercicio) ?></span>
        </div>
    </div>
</div>

<!-- Instructions -->
<div class="row mb-4">
    <div class="col-12">
        <div class="alert alert-info border-0 shadow-sm">
            <div class="d-flex">
                <i class="bi bi-info-circle-fill fs-3 me-3 text-primary"></i>
                <div>
                    <h5 class="mb-1">Instrucciones</h5>
                    <p class="mb-0 small">Responda <strong>Verdadero (V)</strong> o <strong>Falso (F)</strong> a cada afirmación. Todas las preguntas son obligatorias. 
                    Este cuestionario evalúa los conceptos fundamentales de gestión empresarial, trabajo en equipo, ética y sustentabilidad.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Questionnaire Form -->
<div class="row">
    <div class="col-lg-10 mx-auto">
        <div class="card border-0 shadow-custom">
            <div class="card-header bg-info text-white">
                <h4 class="mb-0"><i class="bi bi-journal-text me-2"></i>Cuestionario de Autoformación - Ejercicio <?= htmlspecialchars($ejercicio) ?></h4>
            </div>
            <div class="card-body p-4">
                <form action="cuestionario_proc.php" method="post" id="cuestionarioForm" onSubmit="return validar(this)" class="needs-validation" novalidate>
                    
                    <?php
                    $questions = [
                        1 => "Cada miembro del equipo tiene una concreta personalidad y unas habilidades, conocimientos y experiencias específicas que aportar, que se diferencian de las del resto de miembros del equipo.",
                        2 => "Ser optimista es ser capaz de ver las cosas en su aspecto más favorable. De esta forma se infunde moral y ánimo a los miembros del equipo. Cuando se es positivo, es fácil disfrutar con la tarea, involucrarse con los objetivos del equipo y motivarse cada vez más.",
                        3 => "El desarrollo integral de la persona humana en el trabajo contradice la mayor productividad y eficacia del trabajo mismo. El mundo del trabajo, en efecto, está descubriendo cada vez más que el valor del capital financiero reside en los conocimientos de los trabajadores.",
                        4 => "La relación entre trabajo y capital se realiza también mediante la participación de los trabajadores en la propiedad, en su gestión y en sus frutos. Esta es una exigencia frecuentemente olvidada, que es necesario, por tanto, valorar mejor.",
                        5 => "La empresa debe caracterizarse por la capacidad de servir al bien particular de la sociedad mediante la producción de bienes y servicios útiles, con una lógica de rentabilidad ilimitada y de satisfacción de los intereses de los diversos sujetos implicados.",
                        6 => "Es indispensable que, dentro de la empresa, la legítima búsqueda del beneficio se armonice con la irrenunciable tutela de la dignidad de las personas que a título diverso trabajan en la misma. Estas dos exigencias no se oponen en absoluto.",
                        7 => "Se ha logrado adoptar un modelo circular de producción que asegure recursos para todos y para las generaciones futuras, y que supone limitar al máximo el uso de los recursos renovables, maximizar el consumo, moderar la eficiencia del aprovechamiento, reutilizar y reciclar.",
                        8 => "La pérdida de selvas y bosques implica al mismo tiempo la pérdida de especies que podrían significar en el futuro recursos sumamente importantes, no sólo para la alimentación, sino también para la curación de enfermedades y para múltiples servicios.",
                        9 => "La ecología estudia las relaciones entre los organismos vivientes y el ambiente donde se desarrollan. No exige sentarse a pensar y a discutir acerca de las condiciones de vida, de supervivencia de una sociedad ni poner en duda modelos de desarrollo, producción y consumo.",
                        10 => "Es fundamental buscar soluciones integrales que consideren las interacciones de los sistemas naturales entre sí y con los sistemas sociales. No hay dos crisis separadas, una ambiental y otra social, sino una sola y compleja crisis socio-ambiental."
                    ];
                    
                    foreach($questions as $num => $text): 
                    ?>
                    <div class="card mb-3 border-0 shadow-sm bg-light">
                        <div class="card-header bg-white border-0">
                            <div class="d-flex align-items-center">
                                <span class="badge bg-primary fs-6 me-3"><?= $num ?>)</span>
                                <span class="fw-medium"><?= $text ?></span>
                            </div>
                        </div>
                        <div class="card-body bg-light">
                            <div class="row justify-content-center">
                                <div class="col-md-4">
                                    <div class="btn-group w-100" role="group">
                                        <input type="radio" class="btn-check" name="txt_<?= $num ?>" id="txt_<?= $num ?>_V" value="V" required>
                                        <label class="btn btn-outline-success w-50" for="txt_<?= $num ?>_V">
                                            <i class="bi bi-check-circle me-1"></i> Verdadero (V)
                                        </label>
                                        <input type="radio" class="btn-check" name="txt_<?= $num ?>" id="txt_<?= $num ?>_F" value="F" required>
                                        <label class="btn btn-outline-danger w-50" for="txt_<?= $num ?>_F">
                                            <i class="bi bi-x-circle me-1"></i> Falso (F)
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    
                    <hr class="my-4">
                    
                    <div class="d-flex justify-content-between">
                        <a href="menu_principal.php" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left me-1"></i>Volver
                        </a>
                        <button type="submit" class="btn btn-info btn-lg px-5">
                            <i class="bi bi-send-fill me-2"></i>Enviar Cuestionario
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>

<script>
function validar(frm) {
    const required = ['txt_1','txt_2','txt_3','txt_4','txt_5','txt_6','txt_7','txt_8','txt_9','txt_10'];
    for (const field of required) {
        if (!frm[field].value) {
            alert("Todas las respuestas son obligatorias");
            frm[field].focus();
            return false;
        }
    }
    return confirm('¿Confirmas el envío del cuestionario?');
}

// Highlight selected radio buttons
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.btn-check').forEach(input => {
        input.addEventListener('change', function() {
            const group = this.closest('.btn-group');
            group.querySelectorAll('.btn').forEach(btn => btn.classList.remove('active'));
            if (this.checked) {
                this.nextElementSibling.classList.add('active');
            }
        });
    });
});
</script>