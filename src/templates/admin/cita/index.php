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
            <div id="calendar"></div>
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
                                            <i class="<?= $ui['icono']; ?>"></i><?= htmlspecialchars(strtoupper($estado)); ?>
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
                                            <a href="cita.php?accion=pdf&id=<?php echo $cita['id_cita']; ?>" 
                                                class="btn btn-outline-secondary btn-sm" title="Comprobante PDF">
                                                <i class="fa-solid fa-file-pdf"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <?php if (empty($citas)): ?>
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-5">
                                        <i class="fa-solid fa-calendar-days fa-2x mb-2 d-block"></i>
                                        No hay citas registradas.
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>

                </div>
            </section>
        </div>
    </div>
</div>

<script src="../../assets/js/calendario.js"></script>