<?php $permisos = $permisos ?? []; ?>

<div class="my-5 mx-5">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-5">
        <div class="mb-3 mb-md-0">
            <h2 class="fw-bold mb-1">
                Permisos
            </h2>
        </div>
        <a href="permiso.php?accion=create" class="btn btn-success mt-3">
                <i class="fa-solid fa-plus me-1"></i> Registrar
        </a>
    </div>
        
    <section class="card shadow-sm border-0 mb-4 p-3">
        <div class="table-responsive">
            <table class="table table-hover mb-0 align-middle">
                <thead class="table-light">
                    <tr>
                        <th scope="col" style="width: 5%">#</th>
                        <th scope="col">Permiso</th>
                        <th scope="col">Descripción</th>
                        <th scope="col" class="text-end pe-4" style="width: 10%">Acciones</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <?php foreach ($permisos as $permiso): ?>
                    <tr>
                        <th scope="row"><?php echo $permiso['id_permiso']; ?></span></th>
                        <td><?php echo $permiso['permiso']; ?></td>
                        <td><?php echo $permiso['descripcion']; ?></td>
                        <td class="text-end">
                            <div class="btn-group btn-group-sm" permisoe="group" aria-label="Acciones de cliente">
                                <a href="permiso.php?accion=update&id=<?= $permiso['id_permiso']; ?>" 
                                class="btn btn-outline-primary" 
                                title="Editar permiso">
                                    <i class="fa-solid fa-pen-to-square"></i> 
                                </a>
                                <a href="permiso.php?accion=delete&id=<?= $permiso['id_permiso']; ?>" 
                                class="btn btn-outline-danger" 
                                title="Eliminar permiso"
                                onclick="return confirm('¿Estás seguro de que deseas eliminar a este cliente?');">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if (empty($permiso)): ?>
                        <tr><td colspan="5" class="text-center text-muted py-5">No hay permisoes registrados.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </section>
</div>