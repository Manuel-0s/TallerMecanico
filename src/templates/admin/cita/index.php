<?php $citas = $citas ?? []?>

<div class="my-5 mx-5">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h2 class="fw-bold mb-1">
                Citas
                <span class="badge bg-primary-subtle text-primary rounded-pill fs-6 align-middle ms-2"><?= count($citas); ?></span>
            </h2>
            <p class="text-muted mb-0">
                Administra las citas programadas y el seguimiento de los servicios del taller.
            </p>
        </div>
        <a href="cita.php?accion=create" class="btn btn-success">
                <i class="fa-solid fa-plus me-1"></i> Agendar
        </a>
    </div>

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
                        <td class="ps-4"><?php echo $cita['fecha']; ?></td>
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
</div>