<?php
$titulo = 'Contacto';
$paginaActual = 'contacto';

include __DIR__ . '/../templates/public/header.php';
?>
<div class="container py-5">
            <div class="row text-center mb-5">
                <div class="col">
                    <h1 class="display-6 fw-bold">Contacto</h1>
                    <p class="lead text-secondary">Estamos para ayudarte, contáctanos por cualquiera de estos medios.</p>
                </div>
            </div>

            <div class="row text-center g-4">
                <div class="col-12 col-md-3">
                    <i class="fa-solid fa-location-dot fs-2 text-primary mb-2"></i>
                    <h5 class="fw-bold">Dirección</h5>
                    <p class="text-secondary">Av. Principal 123, Celaya, Guanajuato</p>
                </div>
                <div class="col-12 col-md-3">
                    <i class="fa-solid fa-phone fs-2 text-primary mb-2"></i>
                    <h5 class="fw-bold">Teléfono</h5>
                    <p class="text-secondary">(461) 123-4567</p>
                </div>
                <div class="col-12 col-md-3">
                    <i class="fa-solid fa-envelope fs-2 text-primary mb-2"></i>
                    <h5 class="fw-bold">Correo</h5>
                    <p class="text-secondary">tallerMecanico@correo.com</p>
                </div>
                <div class="col-12 col-md-3">
                    <i class="fa-solid fa-clock fs-2 text-primary mb-2"></i>
                    <h5 class="fw-bold">Horario</h5>
                    <p class="text-secondary">Lun - Sáb: 9:00 am - 6:00 pm</p>
                </div>
            </div>

        </div>

<?php include __DIR__ . '/../templates/public/footer.php'; ?>
