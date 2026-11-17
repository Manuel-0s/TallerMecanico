<?php
require_once __DIR__ . '/admin/models/servicio/servicios.class.php';

$servicios = [];
try {
    $servicios = (new Servicio())->getAll();
} catch (Throwable $e) {
    $servicios = [];
}

$slides = array_chunk($servicios, 3);

$titulo = 'Inicio';
$paginaActual = 'inicio';

$e = fn($v) => htmlspecialchars((string) $v, ENT_QUOTES, 'UTF-8');

include __DIR__ . '/templates/public/header.php';
?>

<section class="hero">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6" data-aos="fade-right">
                <span class="badge hero-badge rounded-pill px-3 py-2 mb-3">
                    <i class="fa-solid fa-wrench me-1"></i> Taller automotriz en Celaya
                </span>
                <h1 class="display-4 fw-bold mb-3">
                    Tu auto en las mejores manos, <span class="text-gradient">sin sorpresas</span>
                </h1>
                <p class="lead text-secondary mb-4">
                    Reparación, mantenimiento y lavado con diagnósticos honestos,
                    presupuestos claros y refacciones garantizadas.
                </p>
                <div class="d-flex flex-wrap gap-2">
                    <a href="/pages/appointment.php" class="btn btn-primary btn-lg rounded-pill px-4">
                        <i class="fa-regular fa-calendar-check me-2"></i>Agendar cita
                    </a>
                    <a href="#servicios" class="btn btn-outline-primary btn-lg rounded-pill px-4">
                        Ver servicios <i class="fa-solid fa-arrow-down ms-2"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-6" data-aos="fade-left">
                <div class="hero-visual">
                    <img src="/assets/images/public/home/service-repair.jpg"
                         alt="Mecánico revisando un vehículo"
                         class="img-fluid w-100 rounded-4 shadow-lg object-fit-cover">
                    <div class="hero-float bg-white shadow p-3 d-flex align-items-center gap-3">
                        <span class="icon-circle icon-circle-sm bg-success-subtle text-success">
                            <i class="fa-solid fa-shield-halved"></i>
                        </span>
                        <div class="lh-sm">
                            <strong class="d-block">Garantía por escrito</strong>
                            <small class="text-secondary">En cada reparación</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="stats-strip">
    <div class="container">
        <div class="row g-3 g-lg-4">
            <div class="col-12 col-md-4" data-aos="fade-up">
                <div class="card card-stat border-0 shadow h-100 text-center p-4">
                    <div class="mx-auto mb-3 icon-circle bg-warning-subtle text-warning">
                        <i class="fa-solid fa-star"></i>
                    </div>
                    <h3 class="fw-bold mb-1">+5</h3>
                    <span class="text-secondary">Años de experiencia</span>
                </div>
            </div>
            <div class="col-12 col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div class="card card-stat border-0 shadow h-100 text-center p-4">
                    <div class="mx-auto mb-3 icon-circle bg-success-subtle text-success">
                        <i class="fa-solid fa-file-invoice-dollar"></i>
                    </div>
                    <h3 class="fw-bold mb-1">100%</h3>
                    <span class="text-secondary">Sin costos ocultos</span>
                </div>
            </div>
            <div class="col-12 col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="card card-stat border-0 shadow h-100 text-center p-4">
                    <div class="mx-auto mb-3 icon-circle bg-primary-subtle text-primary">
                        <i class="fa-solid fa-scale-balanced"></i>
                    </div>
                    <h3 class="fw-bold mb-1">$0</h3>
                    <span class="text-secondary">Presupuestos claros</span>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="servicios" class="section">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="display-6 fw-bold">Nuestros servicios</h2>
            <p class="text-secondary mb-0">Soluciones integrales para mantener tu auto en perfecto estado.</p>
        </div>

        <?php if (empty($slides)): ?>
            <div class="text-center text-secondary py-5">
                <i class="fa-solid fa-screwdriver-wrench fa-2x mb-3 d-block"></i>
                Pronto publicaremos nuestro catálogo de servicios.
            </div>
        <?php else: ?>
            <div id="carouselServicios" class="carousel slide servicios-carousel position-relative"
                 data-bs-ride="carousel" data-bs-interval="6000" data-bs-pause="hover">

                <?php if (count($slides) > 1): ?>
                    <div class="carousel-indicators">
                        <?php foreach ($slides as $i => $_): ?>
                            <button type="button" data-bs-target="#carouselServicios"
                                    data-bs-slide-to="<?= $i ?>"
                                    class="<?= $i === 0 ? 'active' : '' ?>"
                                    <?= $i === 0 ? 'aria-current="true"' : '' ?>
                                    aria-label="Grupo de servicios <?= $i + 1 ?>"></button>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <div class="carousel-inner">
                    <?php foreach ($slides as $i => $grupo): ?>
                        <div class="carousel-item <?= $i === 0 ? 'active' : '' ?>">
                            <div class="row g-4 justify-content-center">
                                <?php foreach ($grupo as $servicio): ?>
                                    <div class="col-12 col-md-6 col-lg-4">
                                        <article class="card service-card h-100 border-0 shadow-sm overflow-hidden">
                                            <div class="service-card-img">
                                                <?php if (!empty($servicio['imagen'])): ?>
                                                    <img src="/assets/images/uploads/<?= $e($servicio['imagen']) ?>"
                                                         alt="<?= $e($servicio['servicio']) ?>" loading="lazy">
                                                <?php else: ?>
                                                    <div class="h-100 d-flex align-items-center justify-content-center text-primary">
                                                        <i class="fa-solid fa-car-wrench fa-3x"></i>
                                                    </div>
                                                <?php endif; ?>
                                                <span class="badge text-bg-primary rounded-pill fs-6 service-card-price">
                                                    $<?= number_format((float) $servicio['precio_base'], 2) ?>
                                                </span>
                                            </div>
                                            <div class="card-body p-4 d-flex flex-column">
                                                <h3 class="h5 fw-bold"><?= $e($servicio['servicio']) ?></h3>
                                                <p class="card-text text-secondary small flex-grow-1">
                                                    <?= $e($servicio['descripcion']) ?>
                                                </p>
                                                <a href="/pages/appointment.php" class="btn btn-outline-primary rounded-pill mt-2">
                                                    Agendar <i class="fa-solid fa-arrow-right ms-1"></i>
                                                </a>
                                            </div>
                                        </article>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <?php if (count($slides) > 1): ?>
                    <button class="carousel-control-prev" type="button"
                            data-bs-target="#carouselServicios" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Anterior</span>
                    </button>
                    <button class="carousel-control-next" type="button"
                            data-bs-target="#carouselServicios" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Siguiente</span>
                    </button>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- ============ CÓMO TRABAJAMOS ============ -->
<section class="section bg-light">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="display-6 fw-bold">Así de fácil</h2>
            <p class="text-secondary mb-0">Tres pasos para dejar tu auto como nuevo.</p>
        </div>

        <div class="row g-4 text-center">
            <div class="col-md-4" data-aos="fade-up">
                <div class="step-number mx-auto mb-3">1</div>
                <h3 class="h5 fw-bold">Agenda tu cita</h3>
                <p class="text-secondary small mb-0">Elige fecha, vehículo y los servicios que necesitas.</p>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div class="step-number mx-auto mb-3">2</div>
                <h3 class="h5 fw-bold">Diagnóstico y presupuesto</h3>
                <p class="text-secondary small mb-0">Te explicamos todo y no hacemos nada sin tu autorización.</p>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="step-number mx-auto mb-3">3</div>
                <h3 class="h5 fw-bold">Recoge tu auto</h3>
                <p class="text-secondary small mb-0">Entrega puntual, con garantía y refacciones certificadas.</p>
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="cta-banner rounded-5 text-white text-center p-5" data-aos="zoom-in">
            <h2 class="display-6 fw-bold mb-3">¿Listo para darle un respiro a tu auto?</h2>
            <p class="lead mb-4 opacity-75">Agenda hoy y recibe un diagnóstico claro, sin compromiso.</p>
            <a href="/pages/appointment.php" class="btn btn-light btn-lg rounded-pill px-5 text-primary fw-semibold">
                <i class="fa-regular fa-calendar-check me-2"></i>Agendar cita
            </a>
        </div>
    </div>
</section>

<?php include __DIR__ . '/templates/public/footer.php'; ?>