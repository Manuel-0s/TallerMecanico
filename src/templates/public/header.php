<?php
$titulo       = isset($titulo) ? $titulo . ' | Taller Mecánico' : 'Taller Mecánico';
$paginaActual = $paginaActual ?? '';
$cssExtra     = $cssExtra ?? [];

$activo = fn(string $clave) => $paginaActual === $clave ? 'active' : '';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($titulo, ENT_QUOTES, 'UTF-8') ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.1/css/all.min.css">
    <link rel="stylesheet" href="/assets/css/public.css">
    <?php foreach ($cssExtra as $css): ?>
        <link rel="stylesheet" href="<?= htmlspecialchars($css, ENT_QUOTES, 'UTF-8') ?>">
    <?php endforeach; ?>
</head>
<body class="d-flex flex-column min-vh-100">

    <header class="site-header sticky-top">
        <nav class="navbar navbar-expand-lg py-3">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center gap-2" href="/index.php">
                    <img src="/assets/images/public/logos/logo.png" alt="Logo del Taller Mecánico" height="40">
                </a>

                <button class="navbar-toggler border-0 shadow-none" type="button"
                        data-bs-toggle="collapse" data-bs-target="#navbarContenido"
                        aria-controls="navbarContenido" aria-expanded="false" aria-label="Mostrar menú">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarContenido">
                    <ul class="navbar-nav mx-auto gap-lg-2">
                        <li class="nav-item">
                            <a class="nav-link <?= $activo('inicio') ?>" href="/index.php">Inicio</a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle <?= $activo('servicios') ?>" href="#" role="button"
                               data-bs-toggle="dropdown" aria-expanded="false">Servicios</a>
                            <ul class="dropdown-menu border-0 shadow-sm rounded-3">
                                <li><a class="dropdown-item" href="/pages/service-repair.php">Reparación</a></li>
                                <li><a class="dropdown-item" href="/pages/service-maintenance.php">Mantenimiento</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="/pages/service-car-wash.php">Lavado</a></li>
                            </ul>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle <?= $activo('nosotros') ?>" href="#" role="button"
                               data-bs-toggle="dropdown" aria-expanded="false">Nosotros</a>
                            <ul class="dropdown-menu border-0 shadow-sm rounded-3">
                                <li><a class="dropdown-item" href="/pages/mission.php">Misión</a></li>
                                <li><a class="dropdown-item" href="/pages/vision.php">Visión</a></li>
                                <li><a class="dropdown-item" href="/pages/values.php">Valores</a></li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link <?= $activo('contacto') ?>" href="/pages/contact.php">Contacto</a>
                        </li>
                    </ul>

                    <div class="d-flex gap-2">
                        <a href="/admin/login.php" class="btn btn-link text-decoration-none text-secondary">
                            <i class="fa-solid fa-right-to-bracket me-1"></i>Acceso
                        </a>
                        <a href="/pages/appointment.php" class="btn btn-primary rounded-pill px-4">
                            <i class="fa-regular fa-calendar-check me-1"></i>Agendar cita
                        </a>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <main class="flex-grow-1">