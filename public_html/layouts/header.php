<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= $pageTitle ?? 'Sapienter - Certamen Juvenil de Gestión' ?></title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <!-- Custom CSS -->
    <link href="/css/estilos.css" rel="stylesheet">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/images/favicon.ico">
</head>
<body class="d-flex flex-column min-vh-100">
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="/index.php">
                <i class="bi bi-mortarboard-fill me-2"></i>
                <span class="text-warning">S</span>apienter<span class="text-warning">.</span>org
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/index.php"><i class="bi bi-house-door-fill me-1"></i> Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/ingreso_certamen.php"><i class="bi bi-trophy-fill me-1"></i> Certamen</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/informacion.html"><i class="bi bi-info-circle-fill me-1"></i> Información</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/comollegar.html"><i class="bi bi-geo-alt-fill me-1"></i> Cómo llegar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/regalos.html"><i class="bi bi-gift-fill me-1"></i> Regalos</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Alert Container for flash messages -->
    <div class="container mt-3" id="flash-messages">
        <?php if (isset($_SESSION['flash_message'])): ?>
            <div class="alert alert-<?= htmlspecialchars($_SESSION['flash_type'] ?? 'info') ?> alert-dismissible fade show" role="alert">
                <?= htmlspecialchars($_SESSION['flash_message']) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php unset($_SESSION['flash_message'], $_SESSION['flash_type']); ?>
        <?php endif; ?>
    </div>

    <!-- Main Content -->
    <main class="flex-fill">
        <div class="container py-4">