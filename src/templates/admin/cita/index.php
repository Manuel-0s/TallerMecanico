<div class="my-5 mx-5">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-5">
        <div class="mb-3 mb-md-0">
            <h2 class="fw-bold mb-1">
                Citas
            </h2>
            <p class="text-muted mb-0">
                Administra el catálogo de citas.
            </p>
        </div>
        <a href="cita.php?accion=create" class="btn btn-success mt-3">
                <i class="fa-solid fa-plus me-1"></i> Agendar
        </a>
    </div>

    <section class="card shadow-sm border-0 mb-4">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Estatus</th>
                        <th scope="col">Observaciones</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <?php foreach ($citas as $cita): ?>
                    <tr>
                        <th scope="row"><?php echo $cita['id_cita']; ?></th>
                        <td><?php echo $cita['fecha']; ?></td>
                        <td><?php echo $cita['estatus']; ?></td>
                        <td>$<?php echo $cita['observaciones']; ?></td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic outlined example">
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
                </tbody>
            </table>
        </div>
    </section>
</div>