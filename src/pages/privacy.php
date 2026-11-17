<?php
$titulo = 'Aviso de Privacidad';
$paginaActual = '';

include __DIR__ . '/../templates/public/header.php';
?>
<div class="row justify-content-center">
            <div class="col-12 col-lg-8">
                
                <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 bg-white">
                    <div class="mb-4 border-bottom pb-3">
                        <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill mb-2">Legal</span>
                        <h1 class="h2 fw-bold mb-1">Aviso de Privacidad y Términos</h1>
                    </div>

                    <div class="d-flex flex-column gap-4 text-secondary small">
                        <div>
                            <h6 class="fw-bold text-dark mb-2">1. Responsable de tus datos</h6>
                            <p class="mb-0">
                                <strong>Taller Mecánico</strong>, con domicilio en Av. Mecánicos 123, Celaya, Guanajuato, es responsable de resguardar y dar uso adecuado a los datos personales que nos proporcionas.
                            </p>
                        </div>

                        <div>
                            <h6 class="fw-bold text-dark mb-2">2. Datos que recabamos</h6>
                            <p class="mb-0">
                                Únicamente solicitamos nombre completo, número telefónico, correo electrónico y datos generales de tu automóvil (marca, modelo, año) para elaborar presupuestos y llevar el control de tus servicios.
                            </p>
                        </div>

                        <div>
                            <h6 class="fw-bold text-dark mb-2">3. Uso de la información</h6>
                            <p class="mb-0">
                                Tu información solo se utiliza para agendar citas, entregarte reportes del estado de tu auto, contactarte para la entrega del vehículo y notificarte próximos mantenimientos preventivos. No compartimos ni vendemos tus datos a terceros.
                            </p>
                        </div>

                        <div>
                            <h6 class="fw-bold text-dark mb-2">4. Presupuestos y diagnósticos</h6>
                            <p class="mb-0">
                                Todo trabajo mecánico se realiza bajo previa autorización por escrito o confirmación digital del propietario. No realizamos cambios de refacciones sin aviso previo.
                            </p>
                        </div>

                        <div>
                            <h6 class="fw-bold text-dark mb-2">5. Contacto para dudas</h6>
                            <p class="mb-0">
                                Si deseas solicitar la eliminación o actualización de tus datos en nuestro registro, puedes escribirnos a <a href="#" class="text-primary text-decoration-none">contacto@tallerMecanico.com</a> o acudir a nuestras instalaciones.
                            </p>
                        </div>
                    </div>

                    <div class="mt-4 pt-3 border-top text-end">
                        <a href="../index.php" class="btn btn-outline-secondary rounded-pill px-4">Volver al Inicio</a>
                    </div>
                </div>

            </div>
        </div>

<?php include __DIR__ . '/../templates/public/footer.php'; ?>
