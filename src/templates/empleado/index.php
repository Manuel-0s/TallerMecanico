<?php $empleados = $empleados ?? [] ?>
<?php $roles = $roles ?? [] ?>
<div class="my-5 mx-5">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h2 class="fw-bold mb-1">
                Empleados
                <span class="badge bg-primary-subtle text-primary rounded-pill fs-6 align-middle ms-2"><?= count($empleados); ?></span>
            </h2>
            <p class="text-muted mb-0">
                Administra el personal del taller, sus roles y el acceso al sistema.
            </p>
        </div>
        <a href="empleado.php?accion=create" class="btn btn-success">
            <i class="fa-solid fa-plus me-1"></i> Agregar
        </a>
    </div>
        
    <section class="card shadow-sm border-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0 align-middle">
                <thead class="table-light">
                    <tr>
                        <th scope="col" class="ps-4">Empleado</th>
                        <th scope="col">RFC</th>
                        <th scope="col">Roles</th>
                        <th scope="col">Estatus</th>
                        <th scope="col" class="text-end pe-4">Acciones</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <?php foreach ($empleados as $empleado): ?>
                        <?php
                            $nombreCompleto = trim($empleado['nombre'] . ' ' . $empleado['primer_apellido'] . ' ' . ($empleado['segundo_apellido'] ?? ''));
                            $roles= json_decode($empleado['roles'] ?? '[]', true) ?: [];
                            $activo = (bool) $empleado['activo'];
                            $esPropio = ($empleado['id_empleado'] == $_SESSION['usuario']['id_empleado'] ?? null);
                        ?>

                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="avatar avatar-md">
                                        <img src="<?= $empleado['foto'] ?? 'https://via.placeholder.com/40' ?>" alt="<?= $nombreCompleto ?>" class="rounded-circle">
                                    </div>
                                    <div class="lh-sm">
                                        <p class="mb-0"><b><?= $nombreCompleto ?></b></p>
                                        <small class="text-muted"><?= $empleado['correo'] ?></small>
                                    </div>
                                </div>
                            </td>

                            <td class="text-muted"><?php echo $empleado['rfc']; ?></td>

                            <td>
                                <?php foreach ($roles as $rol): ?>
                                    <span class="badge bg-primary me-1"><?php echo ($rol) ?> </span>
                                <?php endforeach; ?>
                            </td>

                            <td>
                                <?php if ($empleado['activo']): ?>
                                    <span class="badge rounded-pill bg-success">Activo</span>
                                <?php else: ?> 
                                    <span class="badge rounded-pill bg-danger">Inactivo</span>
                                <?php endif; ?>
                            </td>

                            <td class="text-end pe-4">
                                <div class="btn-group btn-group-sm" role="group" aria-label="Acciones de empleado">
                                    <a href="empleado.php?accion=update&id=<?= $empleado['id_empleado']; ?>" 
                                        class="btn btn-outline-primary" 
                                        title="Editar empleado">
                                            <i class="fa-solid fa-pen-to-square"></i> 
                                    </a>

                                    <?php if (!$esPropio): ?>          
                                        <a href="empleado.php?accion=disable&id=<?= $empleado['id_empleado']; ?>" 
                                            class="btn btn-outline-<?php echo $empleado['activo'] ? 'warning' : 'success'; ?>" 
                                            title="Desactivar usuario"
                                            onclick="return confirm('¿Estás seguro de que deseas desactivar a este empleado?');">
                                                <i class="fa-solid <?php echo $empleado['activo'] ? 'fa-user-slash' : 'fa-user-check'; ?>"></i>
                                        </a>
                                        <a href="empleado.php?accion=delete&id=<?= $empleado['id_empleado']; ?>" 
                                            class="btn btn-outline-danger" 
                                            title="Eliminar empleado"
                                            onclick="return confirm('¿Estás seguro de que deseas eliminar a este empleado?');">
                                                <i class="fa-solid fa-trash"></i>
                                        </a>
                                    <?php endif; ?>

                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                      <?php if (empty($empleados)): ?>
                        <tr>
                            <td colspan="5" class="text-center text-muted py-5">
                                <i class="fa-solid fa-id-badge fa-2x mb-2 d-block"></i>
                                No hay empleados registrados.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </section>
</div>