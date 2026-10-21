<?php $datos = $datos ?? []; ?>
<?php $vehiculos = $vehiculos ?? []; ?>

<div class="my-5 mx-5">
    <form enctype="multipart/form-data"
        action="cita.php?accion=<?php echo $accion ?? 'create';?>&id=<?php echo $_GET['id'] ?? $datos['id'] ?? '' ?>" 
        method="post" 
        class="card">

        <input type="hidden" name="id" value="<?php echo $_GET['id'] ?? $datos['id'] ?? ''; ?>">

        <div class="card-header bg-dark text-white">
            <h3><?php echo ($datos['accion'] === 'update') ? 'Actualizar Cita' : 'Registrar Cita' ?></h3>
        </div>

        <div class="card-body col-12 col-lg-12 d-flex gap-3">
            <div class="col-md-8">
                <div class="mb-3">
                    <label class="form-label text-muted">Fecha y hora *</label>
                    <input type="datetime-local" name="data[fecha]" value="<?php echo $datos['fecha'] ?? ''; ?>" class="form-control" id="fecha" required>
                </div>

                <div class="mb-3">
                    <label class="form-label text-muted">Estatus *</label>
                    <select name="data[estatus]" class="form-select" id="estatus" required>
                        <?php $estatusActual = $datos['estatus'] ?? 'pendiente'; ?>
                        <?php foreach (['pendiente', 'confirmada', 'en_proceso', 'completada', 'cancelada'] as $estatus): ?>
                            <option value="<?php echo $estatus; ?>" <?php echo ($estatusActual === $estatus) ? 'selected' : ''; ?>>
                                <?php echo ucfirst(str_replace('_', ' ', $estatus)); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label text-muted">Vehículo *</label>
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
                    <label class="form-label text-muted">Observaciones</label>
                    <textarea name="data[observaciones]" class="form-control" id="observaciones" rows="4" maxlength="255" placeholder="Describe el servicio o problema del vehículo."><?php echo htmlspecialchars($datos['observaciones'] ?? ''); ?></textarea>
                </div>
            </div>
        </div>

        <div class="card-footer d-flex justify-content-end gap-2 bg-white py-3 border-0">
            <input type="submit" name="enviar" class="btn btn-primary" value="Guardar">
            <a href="cita.php" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
