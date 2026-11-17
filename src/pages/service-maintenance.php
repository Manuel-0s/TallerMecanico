<?php
$titulo = 'Mantenimiento';
$paginaActual = 'servicios';

include __DIR__ . '/../templates/public/header.php';
?>
<div class="row align-items-center g-5">
            <div class="col-12 col-lg-5">
                <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill mb-3">
                    Prevención y Cuidado
                </span>
                <h1 class="display-5 fw-bold mb-3">Mantén tu motor al 100% y evita averías costosas</h1>
                <p class="text-secondary lead fs-6 mb-4">
                    Inspecciones por kilometraje estandarizadas para alargar la vida útil de tu motor, reducir el consumo de gasolina y viajar siempre seguro.
                </p>
                <a href="contact.php" class="btn btn-outline-primary rounded-pill px-4 py-2">
                    Agendar Cita <i class="fa-solid fa-arrow-right ms-2"></i>
                </a>
            </div>

            <div class="col-12 col-lg-7">
                <div class="border-start border-2 ps-4 d-flex flex-column gap-4">
                    
                    <div>
                        <h5 class="fw-bold mb-1">1. Inspección de puntos de seguridad</h5>
                        <p class="text-secondary small mb-0">
                            Revisión sin costo adicional del grosor de balatas, amortiguadores, estado de batería, luces, presión de neumáticos y niveles de fluidos.
                        </p>
                    </div>

                    <div>
                        <h5 class="fw-bold mb-1">2. Cambio de lubricantes y filtros</h5>
                        <p class="text-secondary small mb-0">
                            Drenado y relleno con aceite sintético según la viscosidad exacta del manual de tu auto, junto con filtros nuevos de aceite, aire y cabina.
                        </p>
                    </div>

                    <div>
                        <h5 class="fw-bold mb-1">3. Afinación del sistema de inyección</h5>
                        <p class="text-secondary small mb-0">
                            Limpieza por ultrasonido de inyectores, calibración o reemplazo de bujías (platino o iridio) y lavado del cuerpo de aceleración.
                        </p>
                    </div>

                    <div>
                        <h5 class="fw-bold mb-1">4. Bitácora y recordatorio de servicio</h5>
                        <p class="text-secondary small mb-0">
                            Colocamos la etiqueta de kilometraje sugerido en tu parabrisas y guardamos el registro para notificarte a tiempo tu próxima visita.
                        </p>
                    </div>
                </div>
            </div>
        </div>

<?php include __DIR__ . '/../templates/public/footer.php'; ?>
