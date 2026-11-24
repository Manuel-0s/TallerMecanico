<?php $datos = $datos ?? []; ?>
<?php $clientes = $clientes ?? []; ?>

<div class="my-5 mx-5">
    <div class="mb-4">
        <h2 class="fw-bold mb-1"><?php echo ($datos['accion'] === 'update') ? 'Actualizar Vehículo' : 'Registrar Vehículo' ?></h2>
        <p class="text-muted mb-0">Captura los datos del vehículo.</p>
    </div>

    <form enctype="multipart/form-data"
        action="vehiculo.php?accion=<?php echo $accion ?? 'create';?>&id=<?php echo $_GET['id'] ?? $datos['id'] ?? '' ?>"
        method="post"
        class="card shadow-sm border-0">

        <input type="hidden" name="id" value="<?php echo $_GET['id'] ?? $datos['id'] ?? ''; ?>">

        <div class="card-body p-4">
            <h6 class="text-uppercase text-secondary fw-semibold small mb-3">Información del vehículo</h6>

            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <label for="matricula" class="form-label text-secondary">Matrícula <span class="text-danger">*</span></label>
                    <input type="text" name="data[matricula]" value="<?= htmlspecialchars($datos['matricula'] ?? '') ?>"
                           class="form-control bg-light text-uppercase" id="matricula" required
                           pattern="[A-Za-z]{3}[0-9]{4}" placeholder="ABC1234">
                </div>
                <div class="col-md-4">
                    <label for="marca" class="form-label text-secondary">Marca <span class="text-danger">*</span></label>
                    <input type="text" name="data[marca]" value="<?= htmlspecialchars($datos['marca'] ?? '') ?>"
                           class="form-control bg-light" id="marca" required minlength="1" maxlength="50"
                           pattern="[A-Za-z\s]+">
                </div>
                <div class="col-md-4">
                    <label for="modelo" class="form-label text-secondary">Modelo <span class="text-danger">*</span></label>
                    <input type="text" name="data[modelo]" value="<?= htmlspecialchars($datos['modelo'] ?? '') ?>"
                           class="form-control bg-light" id="modelo" required minlength="1" maxlength="50"
                           pattern="[A-Za-z0-9\s]+">
                </div>
            </div>

            <div class="row g-3">
                <div class="col-md-4">
                    <label for="anio" class="form-label text-secondary">Año <span class="text-danger">*</span></label>
                    <input type="text" name="data[anio]" value="<?= htmlspecialchars($datos['anio'] ?? '') ?>"
                           class="form-control bg-light" id="anio" required
                           pattern="^(19[0-9]{2}|20[0-9]{2}|2100)$" placeholder="2024">
                </div>
                <div class="col-md-8">
                    <label for="id_cliente" class="form-label text-secondary">Cliente <span class="text-danger">*</span></label>
                    <select class="form-select bg-light js-tomselect" name="data[id_cliente]" id="id_cliente"
                            data-placeholder="Busca un cliente..." required>
                        <option value="">Selecciona un cliente</option>
                        <?php foreach ($clientes as $cliente): ?>
                            <option value="<?= htmlspecialchars($cliente['id_cliente']) ?>"
                                <?= (string) ($datos['id_cliente'] ?? '') === (string) $cliente['id_cliente'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($cliente['nombre'] . ' ' . $cliente['primer_apellido'] . ' ' . ($cliente['segundo_apellido'] ?? '')) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div>

        <div class="card-footer bg-white border-top d-flex justify-content-end gap-2 py-3 px-4">
            <a href="vehiculo.php" class="btn btn-outline-secondary">Cancelar</a>
            <button type="submit" name="enviar" class="btn btn-primary px-4">Guardar</button>
        </div>
    </form>
</div>