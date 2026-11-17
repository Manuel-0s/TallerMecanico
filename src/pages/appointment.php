<?php
$titulo = 'Agendar cita';
$paginaActual = '';

include __DIR__ . '/../templates/public/header.php';
?>
<div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6">
                
                <div class="text-center mb-4">
                    <h1 class="h3 fw-bold">Agenda tu Cita</h1>
                    <p class="text-secondary small">Déjanos tus datos y nos pondremos en contacto.</p>
                </div>

                <div class="card border-0 shadow-sm rounded-4 p-4">
                    <form action="#" method="POST">
                        <div class="row g-3">
                            <div class="col-12 col-md-6">
                                <label for="nombre" class="form-label small">Nombre Completo</label>
                                <input type="text" class="form-control" id="nombre" placeholder="Juan Pérez" required>
                            </div>

                            <div class="col-12 col-md-6">
                                <label for="telefono" class="form-label small">Teléfono</label>
                                <input type="tel" class="form-control" id="telefono" placeholder="461 000 0000" required>
                            </div>

                            <div class="col-12 col-md-6">
                                <label for="auto" class="form-label small">Vehículo (Marca y Modelo)</label>
                                <input type="text" class="form-control" id="auto" placeholder="Ej. Nissan Versa 2018" required>
                            </div>

                            <div class="col-12 col-md-6">
                                <label for="servicio" class="form-label small">Servicio</label>
                                <select class="form-select" id="servicio" required>
                                    <option value="" selected disabled>Selecciona uno</option>
                                    <option value="diagnostico">Diagnóstico y Reparación</option>
                                    <option value="preventivo">Mantenimiento Preventivo</option>
                                    <option value="detallado">Lavado y Detallado</option>
                                    <option value="otro">Otro</option>
                                </select>
                            </div>

                            <div class="col-12">
                                <label for="fecha" class="form-label small">Fecha Tentativa</label>
                                <input type="date" class="form-control" id="fecha" required>
                            </div>

                            <div class="col-12">
                                <label for="comentarios" class="form-label small">Observaciones</label>
                                <textarea class="form-control" id="comentarios" rows="2" placeholder="¿Algún detalle o síntoma que debamos saber?"></textarea>
                            </div>

                            <div class="col-12 text-end mt-3">
                                <button type="submit" class="btn btn-primary rounded-pill px-4 py-2">
                                    <i class="fa-solid fa-calendar-check me-2"></i>Confirmar Cita
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>

<?php include __DIR__ . '/../templates/public/footer.php'; ?>
