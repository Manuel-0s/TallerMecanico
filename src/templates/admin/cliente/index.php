<div class="my-5 mx-5">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h2 class="fw-bold mb-1">
                Clientes
                <span class="badge bg-primary-subtle text-primary rounded-pill fs-6 align-middle ms-2"><?= count($clientes); ?></span>
            </h2>
            <p class="text-muted mb-0">
                Administra el catálogo de clientes, modifica sus datos y gestiona su historial de servicios.
            </p>
        </div>
        <a href="cliente.php?accion=create" class="btn btn-success">
                <i class="fa-solid fa-plus me-1"></i> Agregar
        </a>
    </div>
        
    <section class="card shadow-sm border-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0 align-middle">
                <thead class="table-light">
                    <tr>
                        <th scope="col" class="ps-4">Cliente</th>
                        <th scope="col">Teléfono</th>
                        <th scope="col">Correo</th>
                        <th scope="col" class="text-end pe-4" style="width: 10%">Acciones</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <?php foreach ($clientes as $cliente): ?>
                    <tr>
                        <td class="ps-4"><?= htmlspecialchars($cliente['nombre'] . ' ' . $cliente['primer_apellido'] . ' ' . ($cliente['segundo_apellido'] ?? '')); ?></td>
                        <td><?= htmlspecialchars($cliente['telefono']); ?></td>
                        <td><?= htmlspecialchars($cliente['correo']); ?></td>
                        <td class="text-end pe-4">
                            <div class="btn-group btn-group-sm" role="group" aria-label="Acciones de cliente">
                                <a href="cliente.php?accion=update&id=<?= $cliente['id_cliente']; ?>" 
                                class="btn btn-outline-primary" 
                                title="Editar cliente">
                                    <i class="fa-solid fa-pen-to-square"></i> 
                                </a>
                                <a href="cliente.php?accion=delete&id=<?= $cliente['id_cliente']; ?>" 
                                class="btn btn-outline-danger" 
                                title="Eliminar cliente"
                                onclick="return confirm('¿Estás seguro de que deseas eliminar a este cliente?');">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if (empty($clientes)): ?>
                        <tr>
                            <td colspan="5" class="text-center text-muted py-5">
                                <i class="fa-solid fa-users fa-2x mb-2 d-block"></i>
                                No hay clientes registrados.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </section>
</div>