<?php $usuarios = $usuarios ?? [] ?>
<div class="my-5 mx-5">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-5">
        <div class="mb-3 mb-md-0">
            <h2 class="fw-bold mb-1">
                Usuarios
                <span class="badge bg-primary-subtle text-primary rounded-pill fs-6 align-middle ms-2"><?= count($usuarios); ?></span>
            </h2>
        </div>
        <a href="usuario.php?accion=create" class="btn btn-success mt-3">
                <i class="fa-solid fa-plus me-1"></i> Registrar
        </a>
    </div>
        
    <section class="card shadow-sm border-0 mb-4 p-3">
        <div class="table-responsive">
            <table class="table table-hover mb-0 align-middle">
                <thead class="table-light">
                    <tr>
                        <th scope="col" style="width: 5%">#</th>
                        <th scope="col">Nombre Completo</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Estatus</th>
                        <th scope="col" class="text-end pe-4" style="width: 10%">Acciones</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <?php foreach ($usuarios as $usuario): ?>
                    <tr>
                        <th scope="row"><?php echo $usuario['id_usuario']; ?></span></th>
                        <td><?php echo $usuario['nombre'] . ' ' . $usuario['primer_apellido'] . ' ' . ($usuario['segundo_apellido'] ?? ''); ?></td>
                        <td><?php echo $usuario['correo']; ?></td>
                        <td>
                            <?php if ($usuario['activo']): ?>
                                <span class="badge bg-success">Activo</span>
                            <?php else: ?>
                                <span class="badge bg-danger">Inactivo</span>
                            <?php endif; ?>
                        </td>
                        <td class="text-end">
                            <div class="btn-group btn-group-sm" role="group" aria-label="Acciones de cliente">
                                <a href="usuario.php?accion=update&id=<?= $usuario['id_usuario']; ?>" 
                                class="btn btn-outline-primary" 
                                title="Editar usuario">
                                    <i class="fa-solid fa-pen-to-square"></i> 
                                </a>
                                <a href="usuario.php?accion=delete&id=<?= $usuario['id_usuario']; ?>" 
                                class="btn btn-outline-danger" 
                                title="Eliminar usuario"
                                onclick="return confirm('¿Estás seguro de que deseas eliminar a este cliente?');">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                                <a href="usuario.php?accion=disable&id=<?= $usuario['id_usuario']; ?>" 
                                class="btn btn-outline-secondary" 
                                title="Desactivar usuario"
                                onclick="return confirm('¿Estás seguro de que deseas desactivar a este cliente?');">
                                    <i class="fa-solid fa-power-off"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if (empty($usuarios)): ?>
                        <tr><td colspan="5" class="text-center text-muted py-5">No hay clientes registrados.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </section>
</div>