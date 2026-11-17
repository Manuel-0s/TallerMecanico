<?php
$titulo = 'Lavado y Pulido';
$paginaActual = 'servicios';

include __DIR__ . '/../templates/public/header.php';
?>
<div class="row align-items-center g-5">
            <div class="col-12 col-lg-5">
                <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill mb-3">
                    Estética Automotriz
                </span>
                <h1 class="display-5 fw-bold mb-3">Restaura el brillo y la frescura original de tu auto</h1>
                <p class="text-secondary lead fs-6 mb-4">
                    Tratamientos de detailing profesional con productos de pH balanceado, descontaminado de pintura profunda y desinfección total de interiores.
                </p>
                <a href="contact.php" class="btn btn-outline-primary rounded-pill px-4 py-2">
                    Agendar Cita <i class="fa-solid fa-arrow-right ms-2"></i>
                </a>
            </div>

            <div class="col-12 col-lg-7">
                <div class="border-start border-2 ps-4 d-flex flex-column gap-4">
                    
                    <div>
                        <h5 class="fw-bold mb-1">1. Descontaminado y prelavado de espuma activa</h5>
                        <p class="text-secondary small mb-0">
                            Aplicación de snow foam con pH neutro para remover suciedad sin rayar la laca, más limpieza minuciosa de rines, tolvas y marcos de puertas.
                        </p>
                    </div>

                    <div>
                        <h5 class="fw-bold mb-1">2. Corrección de pintura y abrillantado</h5>
                        <p class="text-secondary small mb-0">
                            Pulido profesional con equipo roto-orbital para remover micro-rayones (swirls), manchas de agua y recuperar la reflectividad de la pintura.
                        </p>
                    </div>

                    <div>
                        <h5 class="fw-bold mb-1">3. Limpieza profunda de interiores a vapor</h5>
                        <p class="text-secondary small mb-0">
                            Lavado por inyección y succión en tapicería o hidratación profunda de vestiduras en piel, eliminando olores, manchas y bacterias.
                        </p>
                    </div>

                    <div>
                        <h5 class="fw-bold mb-1">4. Sellado cerámico e inspección final</h5>
                        <p class="text-secondary small mb-0">
                            Aplicación de sellador hidrofóbico en carrocería y cristales para repeler agua y polvo, entregando un acabado suave y duradero.
                        </p>
                    </div>

                </div>
            </div>
        </div>

<?php include __DIR__ . '/../templates/public/footer.php'; ?>
