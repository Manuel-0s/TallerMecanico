</main>

    <footer class="site-footer mt-auto">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-4">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <i class="fa-solid fa-wrench text-primary fs-4"></i>
                        <h5 class="fw-bold mb-0 text-white">Taller Mecánico</h5>
                    </div>
                    <p class="footer-text small mb-4">
                        Mantenimiento automotriz preventivo y correctivo con refacciones garantizadas.
                    </p>
                    <a href="/pages/appointment.php" class="btn btn-primary rounded-pill px-4">
                        Agendar cita
                    </a>
                </div>

                <div class="col-6 col-lg-2 offset-lg-1">
                    <h6 class="fw-bold text-white mb-3">Servicios</h6>
                    <ul class="list-unstyled small d-flex flex-column gap-2 mb-0">
                        <li><a href="/pages/service-repair.php" class="footer-link">Reparación</a></li>
                        <li><a href="/pages/service-maintenance.php" class="footer-link">Mantenimiento</a></li>
                        <li><a href="/pages/service-car-wash.php" class="footer-link">Lavado</a></li>
                    </ul>
                </div>

                <div class="col-6 col-lg-2">
                    <h6 class="fw-bold text-white mb-3">Nosotros</h6>
                    <ul class="list-unstyled small d-flex flex-column gap-2 mb-0">
                        <li><a href="/pages/mission.php" class="footer-link">Misión</a></li>
                        <li><a href="/pages/vision.php" class="footer-link">Visión</a></li>
                        <li><a href="/pages/values.php" class="footer-link">Valores</a></li>
                    </ul>
                </div>

                <div class="col-lg-3">
                    <h6 class="fw-bold text-white mb-3">Contacto</h6>
                    <ul class="list-unstyled small d-flex flex-column gap-2 footer-text mb-0">
                        <li><i class="fa-solid fa-phone me-2 text-primary"></i> +52 123 456 7890</li>
                        <li><i class="fa-solid fa-envelope me-2 text-primary"></i> contacto@tallerMecanico.com</li>
                        <li><i class="fa-solid fa-location-dot me-2 text-primary"></i> Av. Mecánicos 123, Celaya, Gto.</li>
                    </ul>
                </div>
            </div>

            <hr class="footer-divider my-4">

            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-2">
                <small class="footer-text">&copy; <?= date('Y') ?> Taller Mecánico. Todos los derechos reservados.</small>
                <a href="/pages/privacy.php" class="footer-link small">Política de Privacidad</a>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>AOS.init({ duration: 700, once: true });</script>
</body>
</html>