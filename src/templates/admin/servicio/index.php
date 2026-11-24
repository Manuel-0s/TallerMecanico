<?php $servicios = $servicios ?? [] ?>

<div class="my-5 mx-5">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h2 class="fw-bold mb-1">
                Servicios
                <span class="badge bg-primary-subtle text-primary rounded-pill fs-6 align-middle ms-2"><?= count($servicios); ?></span>
            </h2>
            <p class="text-muted mb-0">
                Administra el catálogo de servicios, modifica precios base y gestiona la disponibilidad para las citas del taller.
            </p>
        </div>
        <?php if (in_array('servicio.crear', $_SESSION['permisos'])): ?>
            <a href="servicio.php?accion=create" class="btn btn-success">
                <i class="fa-solid fa-plus me-1"></i> Agregar
            </a>
        <?php endif; ?>
    </div>

    <div class="row g-4">
        <?php if (!empty($servicios)): ?>
            <?php foreach ($servicios as $servicio): ?>
                <div class="col-md-6 col-xl-3">
                    <article class="card h-100 d-flex flex-column shadow-sm border-0">
                        <div class="card-body p-3 pb-0">
                            <div class="border rounded-3 bg-light p-3 d-flex align-items-center justify-content-center"
                                 style="height: 180px; overflow: hidden;">
                                <?php if (!empty($servicio['imagen'])): ?>
                                    <img src="/assets/images/uploads/<?php echo htmlspecialchars($servicio['imagen']); ?>"
                                         class="img-fluid rounded-2"
                                         style="max-height: 150px; max-width: 100%; object-fit: contain;"
                                         alt="Imagen de <?php echo htmlspecialchars($servicio['servicio']); ?>">
                                <?php else: ?>
                                    <div class="text-muted text-center">
                                        <i class="fa-regular fa-image fa-2x mb-2 d-block opacity-50"></i>
                                        <span class="small">Sin imagen disponible</span>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="card-body d-flex flex-column pt-3">
                            <div class="d-flex justify-content-between align-items-start gap-2 mb-2">
                                <h5 class="card-title fw-bold mb-0">
                                    <?php echo htmlspecialchars($servicio['servicio']); ?>
                                </h5>
                                <span class="badge bg-primary-subtle text-primary rounded-pill text-nowrap">
                                    $<?php echo number_format((float) $servicio['precio_base'], 2); ?>
                                </span>
                            </div>
                            <p class="card-text text-secondary small mb-0">
                                <?php echo htmlspecialchars($servicio['descripcion']); ?>
                            </p>
                        </div>
                        
                        <div class="card-footer bg-white border-top d-flex w-100 gap-2 py-3 px-3"
                             role="group" aria-label="Acciones del servicio">
                            <?php if (in_array('servicio.editar', $_SESSION['permisos'])): ?>
                                <a href="servicio.php?accion=update&id=<?php echo $servicio['id_servicio']; ?>"
                                    class="btn btn-outline-primary btn-sm flex-fill">
                                    <i class="fa-solid fa-pen-to-square"></i> Editar
                                </a>
                            <?php endif; ?>

                            <?php if (in_array('servicio.eliminar', $_SESSION['permisos'])): ?>
                                <a href="servicio.php?accion=delete&id=<?php echo $servicio['id_servicio']; ?>"
                                    class="btn btn-outline-danger btn-sm flex-fill">
                                    <i class="fa-solid fa-xmark"></i> Eliminar
                                </a>
                            <?php endif; ?>
                        </div>
                    </article>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12">
                <div class="card shadow-sm border-0 text-center py-5">
                    <i class="fa-solid fa-screwdriver-wrench fa-2x text-secondary mb-3"></i>
                    <p class="text-muted mb-0">No hay servicios disponibles en este momento.</p>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>