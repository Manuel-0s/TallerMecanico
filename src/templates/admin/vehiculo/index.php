<?php
    $vehiculos = $vehiculos ?? [];
?>

<div class="my-5 mx-5">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h2 class="fw-bold mb-1">
                Vehículos
                <span class="badge bg-primary-subtle text-primary rounded-pill fs-6 align-middle ms-2"><?= count($vehiculos); ?></span>
            </h2>
            <p class="text-muted mb-0">
                Administra el catálogo de vehículos, modifica características y gestiona la disponibilidad para las citas del taller.
            </p>
        </div>
        <a href="vehiculo.php?accion=create" class="btn btn-success">
            <i class="fa-solid fa-plus me-1"></i> Agregar
        </a>
    </div>

    <section class="card shadow-sm border-0">
        <div class="table-responsive mx-3 my-3">
            <table class="table table-hover mb-0 align-middle js-datatable">
                <thead>
                    <tr>
                        <th scope="col" class="ps-4 con-filtro">Matrícula</th>
                        <th scope="col" class="con-filtro">Marca</th>
                        <th scope="col" class="con-filtro">Modelo</th>
                        <th scope="col">Año</th>
                        <th scope="col" class="no-orden text-end pe-4">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($vehiculos as $vehiculo): ?>
                    <tr>
                        <td class="ps-4"><?= htmlspecialchars($vehiculo['matricula']); ?></td>
                        <td><?= htmlspecialchars($vehiculo['marca']); ?></td>
                        <td><?= htmlspecialchars($vehiculo['modelo']); ?></td>
                        <td><?= htmlspecialchars($vehiculo['anio']); ?></td>
                        <td class="text-end pe-4 no-orden">
                            <div class="d-inline-flex gap-1" role="group" aria-label="Acciones de vehículo">
                                <a href="vehiculo.php?accion=update&id=<?= $vehiculo['id_vehiculo']; ?>" 
                                class="btn btn-outline-primary btn-sm" 
                                title="Editar vehiculo">
                                    <i class="fa-solid fa-pen-to-square"></i> 
                                </a>
                                <a href="vehiculo.php?accion=delete&id=<?= $vehiculo['id_vehiculo']; ?>" 
                                class="btn btn-outline-danger btn-sm js-confirmar" 
                                title="Eliminar vehiculo"
                                data-titulo="¿Eliminar este vehículo?"
                                data-mensaje="Esta acción no se puede deshacer. Se eliminará toda la información asociada a este vehículo."
                                data-icono="error">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if (empty($vehiculos)): ?>
                        <tr>
                            <td colspan="5" class="text-center text-muted py-5">
                                <i class="fa-solid fa-car fa-2x mb-2 d-block"></i>
                                No hay vehículos registrados.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </section>
</div>