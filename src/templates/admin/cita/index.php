<?php 
$citas = $citas ?? [];

$estatusUI = [
    'programada' => ['clase' => 'primary', 'icono' => 'fa-clock'],
    'atendida'   => ['clase' => 'success', 'icono' => 'fa-circle-check'],
    'cancelada'  => ['clase' => 'danger',  'icono' => 'fa-ban'],
];

?>

<div class="my-5 mx-5">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h2 class="fw-bold mb-1">
                Citas
            </h2>
            <p class="text-muted mb-0">
                Administra las citas programadas y el seguimiento de los servicios del taller.
            </p>
        </div>
        <a href="cita.php?accion=create" class="btn btn-success">
                <i class="fa-solid fa-plus me-1"></i> Agendar
        </a>
    </div>
    
    <nav class="mb-4">
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pills-calendar-tab" data-bs-toggle="pill" data-bs-target="#pills-calendar" type="button" role="tab" aria-controls="pills-calendar" aria-selected="true">Calendario</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-table-tab" data-bs-toggle="pill" data-bs-target="#pills-table" type="button" role="tab" aria-controls="pills-table" aria-selected="false">Tabla</button>
            </li>
        </ul>
    </nav>

    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-calendar" role="tabpanel" aria-labelledby="pills-calendar-tab" tabindex="0">
            <div class="row g-4">

                <!-- Calendario -->
                <div class="col-12 col-xl-8">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <div id="calendar"></div>
                        </div>
                    </div>
                </div>

                <!-- Panel de agenda -->
                <div class="col-12 col-xl-4">
                    <div id="panel-agenda" class="d-flex flex-column gap-3">

                        <!-- Resumen del día -->
                        <div class="row g-2">
                            <div class="col-4">
                                <div class="card border-0 shadow-sm h-100 text-center">
                                    <div class="card-body p-3">
                                        <div class="text-secondary small">Hoy</div>
                                        <div class="h3 fw-bold mb-0" id="resumen-total">0</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="card border-0 shadow-sm h-100 text-center">
                                    <div class="card-body p-3">
                                        <div class="text-secondary small">Por atender</div>
                                        <div class="h3 fw-bold text-primary mb-0" id="resumen-programadas">0</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="card border-0 shadow-sm h-100 text-center">
                                    <div class="card-body p-3">
                                        <div class="text-secondary small">Atendidas</div>
                                        <div class="h3 fw-bold text-success mb-0" id="resumen-atendidas">0</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Filtros -->
                        <div class="card border-0 shadow-sm">
                            <div class="card-body p-3">
                                <div class="text-uppercase text-secondary fw-bold small mb-2">Filtrar por estatus</div>
                                <div class="d-flex flex-wrap gap-2">
                                    <input type="checkbox" class="btn-check js-filtro-estatus" id="f-programada" value="programada" autocomplete="off" checked>
                                    <label class="btn btn-outline-primary btn-sm" for="f-programada">
                                        <i class="fa-solid fa-clock me-1"></i>Programadas
                                    </label>

                                    <input type="checkbox" class="btn-check js-filtro-estatus" id="f-atendida" value="atendida" autocomplete="off" checked>
                                    <label class="btn btn-outline-success btn-sm" for="f-atendida">
                                        <i class="fa-solid fa-circle-check me-1"></i>Atendidas
                                    </label>

                                    <input type="checkbox" class="btn-check js-filtro-estatus" id="f-cancelada" value="cancelada" autocomplete="off" checked>
                                    <label class="btn btn-outline-danger btn-sm" for="f-cancelada">
                                        <i class="fa-solid fa-ban me-1"></i>Canceladas
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Agenda: Hoy / Próximas (altura fija con scroll) -->
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-white border-0 pt-3 px-3 pb-2">
                                <ul class="nav nav-pills nav-fill gap-1" id="agenda-tabs" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active py-1" id="tab-hoy" data-bs-toggle="pill" data-bs-target="#pane-hoy" type="button" role="tab" aria-controls="pane-hoy" aria-selected="true">
                                            Hoy <span class="badge text-bg-light border ms-1" id="badge-hoy">0</span>
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link py-1" id="tab-proximas" data-bs-toggle="pill" data-bs-target="#pane-proximas" type="button" role="tab" aria-controls="pane-proximas" aria-selected="false">
                                            Próximas <span class="badge text-bg-light border ms-1" id="badge-proximas">0</span>
                                        </button>
                                    </li>
                                </ul>
                                <small class="text-secondary text-capitalize d-block mt-2" id="fecha-hoy"></small>
                            </div>

                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="pane-hoy" role="tabpanel" aria-labelledby="tab-hoy" tabindex="0">
                                    <div class="list-group list-group-flush overflow-y-auto" id="agenda-hoy" style="max-height: 50vh;"></div>
                                </div>
                                <div class="tab-pane fade" id="pane-proximas" role="tabpanel" aria-labelledby="tab-proximas" tabindex="0">
                                    <div class="list-group list-group-flush overflow-y-auto" id="agenda-proximas" style="max-height: 50vh;"></div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="pills-table" role="tabpanel" aria-labelledby="pills-table-tab" tabindex="0">
            <section class="card shadow-sm border-0">
                <div class="table-responsive mx-3 my-3">
                    
                    <table class="table table-hover mb-0 align-middle js-datatable">
                        <thead>
                            <tr>
                                <th scope="col" class="ps-4 con-fecha">Fecha</th>
                                <th scope="col" class="con-filtro">Estatus</th>
                                <th scope="col">Observaciones</th>
                                <th scope="col" class="no-orden text-end pe-4">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($citas as $cita): ?>
                                <?php
                                    $fecha = new DateTime($cita['fecha']);
                                    $estado = $cita['estatus'];
                                    $ui = $estatusUI[$estado] ?? ['clase' => 'secondary', 'icono' => 'fa-circle'];
                                ?>

                                <tr>
                                    <td class="ps-4" data-order="<?= $fecha->format('Y-m-d H:i:s'); ?>">
                                        <div class="fw-semibold"><?= $fecha->format('d/m/Y'); ?></div>
                                        <small class="text-muted"><?= $fecha->format('h:i A'); ?></small>
                                    </td>

                                    <td>
                                        <span class="badge rounded-pill bg-<?= $ui['clase']; ?>-subtle text-<?= $ui['clase']; ?>-emphasis">
                                            <i class="fa-solid <?= $ui['icono']; ?>"></i> <?= htmlspecialchars(strtoupper($estado)); ?>
                                        </span>
                                    </td>

                                    <td class="text-muted">
                                        <?= htmlspecialchars($cita['observaciones'] ?? '—'); ?>
                                    </td>
                                    
                                    <td class="text-end pe-4 no-orden">
                                        <div class="d-inline-flex gap-1" role="group" aria-label="Acciones de cita">
                                            <a href="cita.php?accion=update&id=<?php echo $cita['id_cita']; ?>" 
                                                class="btn btn-outline-primary btn-sm">
                                                <i class="fa-solid fa-pen-to-square"></i> 
                                            </a>
                                            <a href="cita.php?accion=delete&id=<?php echo $cita['id_cita']; ?>" 
                                                class="btn btn-outline-danger btn-sm">
                                                <i class="fa-solid fa-xmark"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                </div>
            </section>
        </div>
    </div>
</div>

<script src="/assets/js/calendario.js"></script>