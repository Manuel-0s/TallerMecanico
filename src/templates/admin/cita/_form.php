<?php $datos = $datos ?? []; ?>
<?php $vehiculos = $vehiculos ?? []; ?>

<div class="my-5 mx-5">
    <div class="mb-4">
        <h2 class="fw-bold mb-1"><?php echo ($datos['accion'] === 'update') ? 'Actualizar Cita' : 'Registrar Cita' ?></h2>
        <p class="text-muted mb-0">Captura los datos de la cita.</p>
    </div>

    <form enctype="multipart/form-data"
        action="cita.php?accion=<?php echo $accion ?? 'create';?>&id=<?php echo $_GET['id'] ?? $datos['id'] ?? '' ?>" 
        method="post" 
        class="card shadow-sm border-0">

        <input type="hidden" name="id" value="<?php echo $_GET['id'] ?? $datos['id'] ?? ''; ?>">

        <div class="card-body p-4">
            <h6 class="text-uppercase text-secondary fw-semibold small mb-3">Detalles de la cita</h6>

            <div class="col-md-8">
                <div class="mb-3">
                    <label class="form-label">Fecha y hora <span class="text-danger">*</span></label>
                    <input type="datetime-local" name="data[fecha]" value="<?php echo $datos['fecha'] ?? ''; ?>" class="form-control" id="fecha" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Estatus <span class="text-danger">*</span></label>
                    <select name="data[estatus]" class="form-select" id="estatus" required>
                        <?php $estatusActual = $datos['estatus'] ?? 'programada'; ?>
                        <?php foreach (['programada', 'atendida', 'cancelada'] as $estatus): ?>
                            <option value="<?php echo $estatus; ?>" <?php echo ($estatusActual === $estatus) ? 'selected' : ''; ?>>
                                <?php echo ucfirst(str_replace('_', ' ', $estatus)); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Vehículo <span class="text-danger">*</span></label>
                    <select class="form-select" name="data[id_vehiculo]" id="id_vehiculo" required>
                        <option value="">Seleccione un vehículo</option>
                        <?php foreach ($vehiculos as $vehiculo): ?>
                            <?php $selected = ((($datos['id_vehiculo'] ?? '') == $vehiculo['id_vehiculo']) ? 'selected' : ''); ?>
                            <option value="<?php echo $vehiculo['id_vehiculo']; ?>" <?php echo $selected; ?>>
                                <?php echo htmlspecialchars($vehiculo['marca'] . ' ' . $vehiculo['modelo'] . ' - ' . $vehiculo['matricula']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Observaciones</label>
                    <textarea name="data[observaciones]" class="form-control" id="observaciones" rows="4" maxlength="255" placeholder="Describe el servicio o problema del vehículo."><?php echo htmlspecialchars($datos['observaciones'] ?? ''); ?></textarea>
                </div>
            </div>
        </div>

        <div class="card-footer bg-white border-0 d-flex justify-content-end gap-2 py-3 px-4">
            <a href="cita.php" class="btn btn-outline-secondary">Cancelar</a>
            <input type="submit" name="enviar" class="btn btn-primary" value="Guardar">
        </div>
    </form>
</div>
