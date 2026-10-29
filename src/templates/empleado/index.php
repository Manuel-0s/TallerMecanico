<div class="my-5 mx-5">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-5">
        <div class="mb-3 mb-md-0">
            <h2 class="fw-bold mb-1">
                Empleados
            </h2>
            <p class="text-muted mb-0">
                Administra el catálogo de empleados, modifica sus datos y gestiona su información laboral.
            </p>
        </div>
        <a href="empleado.php?accion=create" class="btn btn-success mt-3">
                <i class="fa-solid fa-plus me-1"></i> Agregar
        </a>
    </div>
        
    <section class="card shadow-sm border-0 mb-4 p-3">
        <div class="table-responsive">
            <table class="table table-hover mb-0 align-middle">
                <thead class="table-light">
                    <tr>
                        <th scope="col" style="width: 5%">#</th>
                        <th scope="col">Nombre Completo</th>
                        <th scope="col">Rol</th>
                        <th scope="col" class="text-end pe-4" style="width: 10%">Acciones</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <?php foreach ($empleados as $empleado): ?>
                    <tr>
                        <th scope="row"><?= $empleado['id_empleado']; ?></span></th>
                        <td><?= htmlspecialchars($empleado['nombre'] . ' ' . $empleado['primer_apellido'] . ' ' . ($empleado['segundo_apellido'] ?? '')); ?></td>
                        <td><?= htmlspecialchars($empleado['rol']); ?></td>
                        <td class="text-end">
                            <div class="btn-group btn-group-sm" role="group" aria-label="Acciones de empleado">
                                <a href="empleado.php?accion=update&id=<?= $empleado['id_empleado']; ?>" 
                                class="btn btn-outline-primary" 
                                title="Editar empleado">
                                    <i class="fa-solid fa-pen-to-square"></i> 
                                </a>
                                <a href="empleado.php?accion=delete&id=<?= $empleado['id_empleado']; ?>" 
                                class="btn btn-outline-danger" 
                                title="Eliminar empleado"
                                onclick="return confirm('¿Estás seguro de que deseas eliminar a este empleado?');">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if (empty($empleado)): ?>
                        <tr><td colspan="5" class="text-center text-muted py-5">No hay empleados registrados.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </section>
</div>