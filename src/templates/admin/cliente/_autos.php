<?php
$vehiculos = $vehiculos ?? [];
$nombreCliente = trim(
    ($cliente['nombre'] ?? '') . ' ' .
    ($cliente['primer_apellido'] ?? '') . ' ' .
    ($cliente['segundo_apellido'] ?? '')
);
?>

<div class="my-5 mx-5">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h2 class="fw-bold mb-1">Vehículos del cliente</h2>
            <p class="text-muted mb-0">
                Unidades registradas a nombre de <strong><?= htmlspecialchars($nombreCliente) ?></strong>.
            </p>
        </div>
        <a href="cliente.php" class="btn btn-outline-secondary">
            <i class="fa-solid fa-arrow-left me-1"></i> Volver a clientes
        </a>
    </div>

    <section class="card shadow-sm border-0">
        <div class="card-header bg-white border-0 d-flex align-items-center gap-2 px-4 pt-4">
            <i class="fa-solid fa-car text-primary"></i>
            <h6 class="text-uppercase text-secondary fw-semibold small mb-0">Autos asociados</h6>
            <span class="badge bg-primary-subtle text-primary rounded-pill ms-auto"><?= count($vehiculos) ?></span>
        </div>

        <?php if (!empty($vehiculos)): ?>
            <div class="table-responsive p-3">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th scope="col" class="ps-3">Matrícula</th>
                            <th scope="col">Marca</th>
                            <th scope="col">Modelo</th>
                            <th scope="col">Año</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($vehiculos as $vehiculo): ?>
                            <tr>
                                <td class="ps-3 fw-semibold"><?= htmlspecialchars($vehiculo['matricula']) ?></td>
                                <td><?= htmlspecialchars($vehiculo['marca']) ?></td>
                                <td><?= htmlspecialchars($vehiculo['modelo']) ?></td>
                                <td><?= htmlspecialchars($vehiculo['anio']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="text-center text-muted py-5">
                <i class="fa-solid fa-car fa-2x mb-3 d-block opacity-50"></i>
                Este cliente aún no tiene vehículos registrados.
            </div>
        <?php endif; ?>
    </section>
</div>
