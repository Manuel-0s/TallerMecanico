<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Taller Mecánico</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.1/css/all.min.css">
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body> 
    <header class="bg-light py-3">
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <img src="../assets/images/logos/logo.png" alt="Logo del Taller Mecánico" height="40">
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContenido" aria-controls="navbarContenido" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarContenido">
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Inicio</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Servicios
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Reparación</a></li>
                                <li><a class="dropdown-item" href="#">Mantenimiento</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="#">Lavado</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Nosotros
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="pages/mission.html">Misión</a></li>
                                <li><a class="dropdown-item" href="pages/vision.html">Visión</a></li>
                                <li><a class="dropdown-item" href="pages/values.html">Valores</a></li>
                            </ul>
                        </li>
                         <li class="nav-item">
                            <a class="nav-link" href="pages/contact.html">Contacto</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main class="container my-auto py-5">
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
    </main>

    <footer class="bg-light py-5 border-top mt-auto text-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col col-lg-4 d-flex flex-column align-items-center">
                    <div class="d-flex align-items-center justify-content-center gap-2 mb-2">
                        <i class="fa-solid fa-wrench text-primary fs-4"></i>
                        <h5 class="fw-bold mb-0">Taller Mecánico</h5>
                    </div>
                    <p class="text-secondary small">
                        Mantenimiento automotriz preventivo y correctivo con refacciones garantizadas.
                    </p>
                </div>

                <div class="col-12 col-lg-3">
                    <h6 class="fw-bold mb-3">Nosotros</h6>
                    <ul class="list-unstyled small d-flex flex-column gap-2">
                        <li><a href="mission.html" class="text-decoration-none text-secondary">Misión</a></li>
                        <li><a href="vision.html" class="text-decoration-none text-secondary">Visión</a></li>
                        <li><a href="values.html" class="text-decoration-none text-secondary">Valores</a></li>
                    </ul>
                </div>

                <div class="col-12 col-md-6 col-lg-4">
                    <h6 class="fw-bold mb-3">Contacto</h6>
                    <ul class="list-unstyled small d-flex flex-column gap-2 text-secondary">
                        <li><i class="fa-solid fa-phone me-2 text-primary"></i> +52 123 456 7890</li>
                        <li><i class="fa-solid fa-envelope me-2 text-primary"></i> contacto@tallerMecanico.com</li>
                        <li><i class="fa-solid fa-location-dot me-2 text-primary"></i> Av. Mecánicos 123</li>
                    </ul>
                </div>
            </div>

            <hr class="text-secondary">

            <div class="row py-4">
                <div class="col text-md-start">
                    <small class="text-secondary">&copy; 2026 Taller Mecánico. Todos los derechos reservados.</small>
                </div>
                <div class="col text-md-end">
                    <span class="text-muted small me-3">Celaya, Guanajuato</span>
                    <a href="privacy.html" class="small">Política de Privacidad</a>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
</body>
<script>AOS.init();</script>
</html>