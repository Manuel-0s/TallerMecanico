<?php
$titulo = 'Valores';
$paginaActual = 'nosotros';

include __DIR__ . '/../templates/public/header.php';
?>
<div class="container">
            <div class="row justify-content-center text-center mb-5">
                <div class="col-lg-8">
                    <i class="fa-solid fa-heart fs-1 text-primary mb-3"></i>
                    <h1 class="display-6 fw-bold mb-3">Nuestros Valores</h1>
                    <p class="lead text-secondary">
                        Los principios que guían cada servicio que ofrecemos.
                    </p>
                </div>
            </div>

            <div class="row g-4 justify-content-center text-center">
                <div class="col-6 col-md-3">
                    <i class="fa-solid fa-handshake fs-2 text-primary mb-2"></i>
                    <h5 class="fw-bold mb-1">Honestidad</h5>
                    <p class="text-secondary small">
                        Diagnósticos claros y presupuestos sin sorpresas.
                    </p>
                </div>
                <div class="col-6 col-md-3">
                    <i class="fa-solid fa-award fs-2 text-primary mb-2"></i>
                    <h5 class="fw-bold mb-1">Calidad</h5>
                    <p class="text-secondary small">
                        Refacciones certificadas y trabajo garantizado.
                    </p>
                </div>
                <div class="col-6 col-md-3">
                    <i class="fa-solid fa-clock fs-2 text-primary mb-2"></i>
                    <h5 class="fw-bold mb-1">Puntualidad</h5>
                    <p class="text-secondary small">
                        Respetamos tu tiempo, entregamos cuando prometemos.
                    </p>
                </div>
                <div class="col-6 col-md-3">
                    <i class="fa-solid fa-user-check fs-2 text-primary mb-2"></i>
                    <h5 class="fw-bold mb-1">Compromiso</h5>
                    <p class="text-secondary small">
                        Cada vehículo recibe la misma atención y cuidado.
                    </p>
                </div>
            </div>
        
            <div class="col text-center py-5">
                <a href="vision.php" class="btn btn-outline-primary">
                     <i class="fa-solid fa-arrow-left ms-1"></i> Ver Visión
                </a>
            </div>
        </div>

<?php include __DIR__ . '/../templates/public/footer.php'; ?>
