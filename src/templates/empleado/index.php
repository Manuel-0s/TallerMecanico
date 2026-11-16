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
        <div class="table-responsive mx-3 my-3">
            <table class="table table-hover mb-0 align-middle js-datatable">
                <thead>
                    <tr>
                        <th scope="col" class="ps-4">Empleado</th>
                        <th scope="col">RFC</th>
                        <th scope="col" class="con-filtro">Roles</th>
                        <th scope="col" class="con-filtro">Estatus</th>
                        <th scope="col" class="no-orden text-end pe-4">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($empleados as $empleado): ?>
                        <?php
                            $nombreCompleto = trim($empleado['nombre'] . ' ' . $empleado['primer_apellido'] . ' ' . ($empleado['segundo_apellido'] ?? ''));
                            $roles = json_decode($empleado['roles'] ?? '[]', true) ?: [];
                            $activo = (bool) $empleado['activo'];
                            $esPropio = $empleado['id_empleado'] == ($_SESSION['usuario']['id_empleado'] ?? null);
                        ?>

                        <tr>
                            <td class="ps-4">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="avatar avatar-md">
                                        <img src="<?= !empty($empleado['foto'])
                                            ? '/assets/images/uploads/' . htmlspecialchars($empleado['foto'])
                                            : '/assets/images/public/avatar.png' ?>"
                                            class="avatar-img rounded-circle" alt="<?= htmlspecialchars($nombreCompleto) ?>"
                                            max-width="60" height="60"
                                        >
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
                                    <span class="badge rounded-pill bg-primary-subtle text-primary-emphasis me-1"><?php echo htmlspecialchars($rol, ENT_QUOTES, 'UTF-8'); ?></span>
                                <?php endforeach; ?>
                            </td>

                            <td>
                                <?php if ($empleado['activo']): ?>
                                    <span class="badge rounded-pill bg-success-subtle text-success-emphasis">
                                        <i class="fa-solid fa-circle-check"></i> Activo
                                    </span>
                                <?php else: ?> 
                                    <span class="badge rounded-pill bg-danger-subtle text-danger-emphasis">
                                        <i class="fa-solid fa-circle-xmark"></i> Inactivo
                                    </span>
                                <?php endif; ?>
                            </td>

                            <td class="text-end pe-4 no-orden">
                                <div class="d-inline-flex gap-1" role="group" aria-label="Acciones de empleado">
                                    <a href="empleado.php?accion=update&id=<?= $empleado['id_empleado']; ?>" 
                                        class="btn btn-outline-primary btn-sm" 
                                        title="Editar empleado">
                                            <i class="fa-solid fa-pen-to-square"></i> 
                                    </a>

                                    <?php if (!$esPropio): ?>          
                                        <a href="empleado.php?accion=disable&id=<?= $empleado['id_empleado']; ?>" 
                                            class="btn btn-outline-<?php echo $empleado['activo'] ? 'warning' : 'success'; ?> js-confirmar btn-sm"
                                            data-titulo="<?php echo $empleado['activo'] ? '¿Desactivar este usuario?' : '¿Activar este usuario?'; ?>"
                                            data-mensaje="<?php echo $empleado['activo'] ? 'El usuario no podrá iniciar sesión hasta que sea activado nuevamente.' : 'El usuario podrá iniciar sesión nuevamente.'; ?>"
                                            data-icono="warning"
                                            title="Desactivar usuario">
                                                <i class="fa-solid <?php echo $empleado['activo'] ? 'fa-user-slash' : 'fa-user-check'; ?>"></i>
                                        </a>
                                        <a href="empleado.php?accion=delete&id=<?= $empleado['id_empleado']; ?>"
                                            class="btn btn-outline-danger js-confirmar btn-sm"
                                            data-titulo="¿Eliminar este empleado?"
                                            data-mensaje="Esta acción no se puede deshacer. Se eliminará toda la información asociada a este empleado."
                                            data-icono="error" 
                                            title="Eliminar empleado">
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