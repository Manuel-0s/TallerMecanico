<?php 
$citas = $citas ?? [];
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
                <div class="table-responsive">
                    <table class="table table-hover mb-0 align-middle">
                        <thead class="table-light">
                            <tr>
                                <th scope="col" class="ps-4">Fecha</th>
                                <th scope="col">Estatus</th>
                                <th scope="col">Observaciones</th>
                                <th scope="col" class="text-end pe-4">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            <?php foreach ($citas as $cita): ?>
                            <tr>
                                <td class="ps-4">
                                    <?php echo (new DateTime($cita['fecha']))->format('d/m/Y - h:i A'); ?>
                                </td>
                                <td><span class="badge rounded-pill bg-primary"><?php echo $cita['estatus']; ?></span></td>
                                <td class="text-muted"><?php echo $cita['observaciones']; ?></td>
                                <td class="text-end pe-4">
                                    <div class="btn-group btn-group-sm" role="group" aria-label="Acciones de cita">
                                        <a href="cita.php?accion=update&id=<?php echo $cita['id_cita']; ?>" type="button" class="btn btn-outline-primary btn-sm">
                                            <i class="fa-solid fa-pen-to-square"></i> 
                                        </a>
                                        <a href="cita.php?accion=delete&id=<?php echo $cita['id_cita']; ?>" type="button" class="btn btn-outline-danger btn-sm">
                                            <i class="fa-solid fa-xmark"></i>
                                        </a>
                                        <a href="cita.php?accion=pdf&id=<?php echo $cita['id_cita']; ?>" 
                                            target="_blank" class="btn btn-outline-secondary btn-sm" title="Comprobante PDF">
                                            <i class="fa-solid fa-file-pdf"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php if (empty($citas)): ?>
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-5">
                                        <i class="fa-solid fa-calendar-days fa-2x mb-2 d-block"></i>
                                        No hay citas registradas.
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </section>
            <?php include __DIR__ . '/../../../admin/paginacion.php'; ?>
        </div>
    </div>
</div>

<script src="../../assets/js/calendario.js"></script>