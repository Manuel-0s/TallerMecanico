<?php $datos = $datos ?? []; ?>
<div class="my-5 mx-5">
    <form enctype="multipart/form-data"
        action="empleado.php?accion=<?php echo $accion ?? 'create';?>&id=<?php echo $_GET['id'] ?? $datos['id'] ?? '' ?>" 
        method="post" 
        class="card">
    
        <input type="hidden" name="id" value="<?php echo $_GET['id'] ?? $datos['id'] ?? ''; ?>">

        <div class="card-header bg-dark text-white">
            <h3><?php echo ($datos['accion'] === 'update') ? 'Actualizar Cliente' : 'Registrar Cliente' ?></h3>
        </div>

        <div class="card-body col-12 col-lg-12 d-flex gap-3">
            <div class="col-md-8">
                <div class="mb-3">
                    <label class="form-label text-muted">Nombre *</label>
                    <input type="text" name="data[nombre]" value="<?php echo $datos['nombre'] ?? 'ejemplo' ?>" class="form-control" id="nombre" required
                    minlength="1" maxlength="50" pattern="^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$">
                </div>
    
                <div class="mb-3">
                    <label class="form-label text-muted">Primer Apellido *</label>
                    <input type="text" name="data[primer_apellido]" value="<?php echo $datos['primer_apellido'] ?? 'ejemplo' ?>" class="form-control" id="primer_apellido" required
                    minlength="1" maxlength="50" pattern="^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$" >
                </div>
    
                <div class="mb-3">
                    <label class="form-label text-muted">Segundo Apellido</label>
                    <input type="text" name="data[segundo_apellido]" value="<?php echo $datos['segundo_apellido'] ?? 'ejemplo' ?>" class="form-control" id="segundo_apellido" required
                    minlength="1" maxlength="50" pattern="^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$">
                </div>
                <div class="mb-3">
                    <label class="form-label text-muted">Rol</label>
                    <select class="form-select" name="data[rol]" id="rol" required>
                    <option selected></option>
                    <option value="administrador">Administrador</option>
                    <option value="mecanico">Mecánico</option>
                    </select>
                </div>
            </div>     
        </div>

        <div class="card-footer d-flex justify-content-end gap-2 bg-white py-3 border-0">
            <input type="submit" name="enviar" class="btn btn-success mt-3" value="Guardar">
            <a href="empleado.php" class="btn btn-danger mt-3">Cancelar</a>
        </div>
    </form>
</div>

