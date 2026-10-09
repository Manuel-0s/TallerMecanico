<?php $datos = $datos ?? []; ?>

<form enctype="multipart/form-data" action="servicio.php?accion=<?php echo $accion ?? 'create';?>&id=<?php echo $_GET['id'] ?? $datos['id'] ?? '' ?>" method="post">

    <input type="hidden" name="id" value="<?php echo $_GET['id'] ?? $datos['id'] ?? ''; ?>">

    <div class="row">
        <div>
            <div class="text-center bg-dark text-white p-2 rounded mb-3">
                <h2><?php echo ($datos['accion'] === 'update') ? 'Actualizar Servicio' : 'Registrar Servicio' ?></h2>
            </div>
        </div>

        <div class="col-md-8">
            <div class="mb-3">
                <label class="form-label text-muted">Nombre del servicio</label>
                <input type="text" name="data[servicio]" value="<?php echo $datos['servicio'] ?? '' ?>" class="form-control" id="servicio" required
                minlength="1" maxlength="100">
            </div>

            <div class="mb-3">
                <label class="form-label text-muted">Descripción</label>
                <textarea name="data[descripcion]" class="form-control" style="height: 100px" 
                minlength="1" maxlength="150" required><?php echo $datos['descripcion'] ?? '' ?></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label text-muted">Precio</label>
                <div class="input-group">
                    <span class="input-group-text">$</span>
                    <input type="number" name="data[precio_base]" value="<?php echo $datos['precio_base'] ?? '' ?>" class="form-control" id="precio" required
                    min="0" step="0.01" pattern="^\d+(\.\d{1,2})?$" placeholder="0.00">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label text-muted">Imagen del servicio</label>
                <input type="file" name="data[imagen]" class="form-control" id="imagen" accept="image/*">
            </div>
        </div>
        <div class="col-md-4 d-flex align-items-center justify-content-center bg-light">
            <?php if (!empty($datos['imagen'])): ?>
                <img src="../images/uploads/<?php echo $datos['imagen'] ?? ''; ?>" alt="Previsualización del servicio" class="mb-3 img-fluid" id="preview" 
                style="max-width: 200px; height: auto">
            <?php endif; ?>
        </div>
    </div>

    <input type="submit" name="enviar" class="btn btn-success mt-3" value="Guardar">
    <a href="servicio.php" class="btn btn-danger mt-3">Cancelar</a>
</form>
