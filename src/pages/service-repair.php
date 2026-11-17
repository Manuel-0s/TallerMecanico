<?php
$titulo = 'Reparaci�n';
$paginaActual = 'servicios';

include __DIR__ . '/../templates/public/header.php';
?>
<div class="row align-items-center g-5">
            <div class="col-12 col-lg-5">
                <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill mb-3">
                    Diagnóstico Especializado
                </span>
                <h1 class="display-5 fw-bold mb-3">De la falla al auto listo sin complicaciones</h1>
                <p class="text-secondary lead fs-6 mb-4">
                    Un proceso claro y transparente para resolver los problemas mecánicos de tu vehículo con presupuesto fijo, pruebas verificables y refacciones garantizadas.
                </p>
                <a href="contact.php" class="btn btn-outline-primary rounded-pill px-4 py-2">
                    Agendar Cita <i class="fa-solid fa-arrow-right ms-2"></i>
                </a>
            </div>

            <div class="col-12 col-lg-7">
                <div class="border-start border-2 ps-4 d-flex flex-column gap-4">
                    
                    <div>
                        <h5 class="fw-bold mb-1">1. Escaneo y evaluación técnica</h5>
                        <p class="text-secondary small mb-0">
                            Conectamos escáneres OBD-II avanzados e inspeccionamos los sistemas mecánicos para identificar el origen exacto del fallo sin cambiar piezas al azar.
                        </p>
                    </div>

                    <div>
                        <h5 class="fw-bold mb-1">2. Presupuesto y opciones de refacción</h5>
                        <p class="text-secondary small mb-0">
                            Te presentamos un presupuesto desglosado por escrito con piezas originales o de calidad OEM certificada. No iniciamos ninguna labor sin tu autorización.
                        </p>
                    </div>

                    <div>
                        <h5 class="fw-bold mb-1">3. Reparación certificada y calibración</h5>
                        <p class="text-secondary small mb-0">
                            Mecánicos calificados realizan el trabajo aplicando los torques y especificaciones del fabricante, concluyendo con borrado de códigos de error y pruebas dinámicas.
                        </p>
                    </div>

                    <div>
                        <h5 class="fw-bold mb-1">4. Entrega de partes usadas y garantía</h5>
                        <p class="text-secondary small mb-0">
                            Te devolvemos los componentes sustituidos como muestra de transparencia y emitimos tu póliza sellada con meses de garantía por escrito.
                        </p>
                    </div>
                </div>
            </div>
        </div>

<?php include __DIR__ . '/../templates/public/footer.php'; ?>
