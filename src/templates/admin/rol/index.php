<?php $roles = $roles ?? [] ?>

<div class="my-5 mx-5">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h2 class="fw-bold mb-1">
                Roles
                <span class="badge bg-primary-subtle text-primary rounded-pill fs-6 align-middle ms-2"><?= count($roles); ?></span>
            </h2>
            <p class="text-muted mb-0">Administra los roles y sus permisos de acceso al sistema.</p>
        </div>
        <a href="rol.php?accion=create" class="btn btn-success">
                <i class="fa-solid fa-plus me-1"></i> Registrar
        </a>
    </div>
        
    <section class="card shadow-sm border-0">
        <div class="table-responsive mx-3 my-3">
            <table class="table table-hover mb-0 align-middle js-datatable">
                <thead>
                    <tr>
                        <th scope="col" class="ps-4 con-filtro">Rol</th>
                        <th scope="col">Descripción</th>
                        <th scope="col" class="no-orden text-end pe-4">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($roles as $rol): ?>
                    <tr>
                        <td class="ps-4"><?php echo $rol['rol']; ?></td>
                        <td><?php echo $rol['descripcion']; ?></td>
                        <td class="text-end pe-4 no-orden">
                            <div class="d-inline-flex gap-1" role="group" aria-label="Acciones de rol">
                                <a href="rol.php?accion=update&id=<?= $rol['id_rol']; ?>" 
                                class="btn btn-outline-primary btn-sm" 
                                title="Editar rol">
                                    <i class="fa-solid fa-pen-to-square"></i> 
                                </a>
                                <a href="rol.php?accion=delete&id=<?= $rol['id_rol']; ?>" 
                                class="btn btn-outline-danger btn-sm js-confirmar" 
                                title="Eliminar rol"
                                data-titulo="¿Eliminar este rol?"
                                data-mensaje="Esta acción no se puede deshacer. Se eliminará toda la información asociada a este rol."
                                data-icono="error">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if (empty($roles)): ?>
                        <tr>
                            <td colspan="3" class="text-center text-muted py-5">
                                <i class="fa-solid fa-user-shield fa-2x mb-2 d-block"></i>
                                No hay roles registrados.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </section>
</div>