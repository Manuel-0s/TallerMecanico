<?php  $ordens = $ordens ?? [] ?>

<div class="my-5 mx-5">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h2 class="fw-bold mb-1">
                Ordenes de trabajo
            </h2>
            <p class="text-muted mb-0">
                Administra el catálogo de ordens, modifica sus datos y gestiona su historial de servicios.
            </p>
        </div>
        <a href="orden.php?accion=create" class="btn btn-success">
                <i class="fa-solid fa-plus me-1"></i> Agregar
        </a>
    </div>
        
    <section class="card shadow-sm border-0">
        <div class="table-responsive mx-3 my-3">
            <table class="table table-hover mb-0 align-middle js-datatable">
                <thead>
                    <tr>
                        <th scope="col" class="ps-4">Folio</th>
                        <th scope="col" class="con-filtro">Estatus</th>
                        <th scope="col" class="con-filtro">Correo</th>
                        <th scope="col" class="no-orden text-end pe-4">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($ordens as $orden): ?>
                    <tr>
                        <td class="ps-4"><?= htmlspecialchars($orden['nombre'] . ' ' . $orden['primer_apellido'] . ' ' . ($orden['segundo_apellido'] ?? '')); ?></td>
                        <td><?= htmlspecialchars($orden['telefono']); ?></td>
                        <td><?= htmlspecialchars($orden['correo']); ?></td>
                        <td class="text-end pe-4 no-orden">
                            <div class="d-inline-flex gap-1" role="group" aria-label="Acciones de orden">
                                <a href="orden.php?accion=update&id=<?= $orden['id_orden']; ?>" 
                                    class="btn btn-outline-primary btn-sm" 
                                    title="Editar orden">
                                        <i class="fa-solid fa-pen-to-square"></i> 
                                </a>

                                <a href="orden.php?accion=delete&id=<?= $orden['id_orden']; ?>" 
                                    class="btn btn-outline-danger btn-sm js-confirmar" 
                                    title="Eliminar orden"
                                    data-titulo="¿Eliminar este orden?"
                                    data-mensaje="Esta acción no se puede deshacer. Se eliminará toda la información asociada a este orden."
                                    data-icono="error">
                                        <i class="fa-solid fa-trash"></i> 
                                </a>
                                <div class="dropdown d-inline-block">
                                    <button class="btn btn-sm btn-ghost-secondary" 
                                        type="button" 
                                        data-bs-toggle="dropdown" 
                                        aria-expanded="false"
                                        aria-label="Más opciones">
                                        <i class="fa-solid fa-ellipsis-vertical"></i>
                                    </button>
                                    <ul class="dropdown-menu">                                        
                                        <a href="orden.php?accion=getCar&id=<?= $orden['id_orden']; ?>" 
                                            class="btn btn-outline-secondary btn-sm dropdown-item" 
                                            title="Ver autos asociados">
                                                <i class="fa-solid fa-car"></i> Ver autos asociados
                                        </a>
                                        <a href="orden.php?accion=historial&id=<?= $orden['id_orden']; ?>" 
                                            class="btn btn-outline-secondary btn-sm dropdown-item" 
                                            title="Ver historial de servicios">
                                                <i class="fa-solid fa-clock-rotate-left"></i> Historial de servicios
                                        </a>
                                    </ul>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if (empty($ordens)): ?>
                        <tr>
                            <td colspan="4" class="text-center text-muted py-5">
                                <i class="fa-solid fa-users fa-2x mb-2 d-block"></i>
                                No hay ordens registrados.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </section>
</div>