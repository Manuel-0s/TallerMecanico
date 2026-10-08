<?php $datos = $datos ?? []; ?>

<form enctype="multipart/form-data" action="servicio.php?accion=<?php echo $accion ?? 'create';?>&id=<?php echo $_GET['id'] ?? $datos['id'] ?? '' ?>" method="post">

    <input type="hidden" name="id" value="<?php echo $_GET['id'] ?? $datos['id'] ?? ''; ?>">

    <div class="row">
        <div class="col">
            <div class="mb-3">
                <h2> Registrar Servicio</h2>
            </div>

            <div class="mb-3">
                <label class="form-label">Nombre del servicio</label>
                <input type="text" name="data[servicio]" value="<?php echo $datos['servicio'] ?? '' ?>" class="form-control" id="servicio">
            </div>

            <div class="form-floating">
                <textarea name="data[descripcion]" class="form-control" placeholder="Descripción" id="floatingTextarea2" style="height: 150px"><?php echo $datos['descripcion'] ?? '' ?></textarea>
                <label for="floatingTextarea2">Descripción</label>
            </div>

            <div class="mb-3">
                <label class="form-label">Precio</label>
                <div class="input-group">
                    <span class="input-group-text">$</span>
                    <input type="number" name="data[precio_base]" value="<?php echo $datos['precio_base'] ?? '' ?>" class="form-control" id="precio">
                </div>
            </div>
        </div>

        <div class="col mt-auto">
            <img src="" alt="Previsualización del servicio"  style="max-width: 150px; border-radius: 8px;">
            <div class="mb-3">
                <label class="form-label">Imagen</label>
                <input type="file" name="imagen" class="form-control" id="imagen">
            </div>
        </div>
    </div>

    <input type="submit" name="enviar" class="btn btn-success" value="Guardar">
    <input type="submit" name="" class="btn btn-danger" value="Cancelar">
</form>

