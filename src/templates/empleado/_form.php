<?php $roles = $roles ?? []; ?>
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
                    <label class="form-label text-muted">Nombre</label>
                    <input type="text" name="data[nombre]" value="<?php echo $datos['nombre'] ?? '' ?>" class="form-control" id="nombre" 
                    minlength="1" maxlength="50" pattern="^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$">
                </div>
    
                <div class="mb-3">
                    <label class="form-label text-muted">Primer Apellido</label>
                    <input type="text" name="data[primer_apellido]" value="<?php echo $datos['primer_apellido'] ?? '' ?>" class="form-control" id="primer_apellido" 
                    minlength="1" maxlength="50" pattern="^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$" >
                </div>
    
                <div class="mb-3">
                    <label class="form-label text-muted">Segundo Apellido</label>
                    <input type="text" name="data[segundo_apellido]" value="<?php echo $datos['segundo_apellido'] ?? '' ?>" class="form-control" id="segundo_apellido"
                    minlength="1" maxlength="50" pattern="^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$">
                </div>

                <div class="mb-3">
                    <label class="form-label text-muted">RFC</label>
                    <input type="text" name="data[rfc]" value="<?php echo $datos['rfc'] ?? '' ?>" class="form-control" id="rfc" 
                    minlength="1" maxlength="13" pattern="^[A-Za-z0-9]{13}$">
                </div>

                <div class="mb-3">
                    <label class="form-label text-muted">Correo electrónico</label>
                    <input type="email" name="data[correo]" value="<?php echo $datos['correo'] ?? ''; ?>" class="form-control" id="correo" 
                    pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}">
                </div> 
                    <div class="mb-3">
                    <label class="form-label text-muted">Contraseña</label>
                    <input type="password" name="data[contrasena]" class="form-control" id="contrasena" >
                </div>

                <div class="mb-3">
                    <label class="form-label d-block">Selecciona los roles</label>

                    <div class="d-grid gap-2 d-md-block" aria-label="Roles del usuario">
                        <?php foreach ($roles as $rol): ?>
                            <?php if ($rol["rol"] != "Empleado"): ?>
                                <?php $rolId = (int) $rol['id_rol']; ?>
                                <input
                                    type="checkbox"
                                    class="btn-check"
                                    name="data[id_rol][]"
                                    value="<?php echo $rolId; ?>"
                                    id="rol-<?php echo $rolId; ?>"
                                    <?php echo in_array($rolId, $datos['roles'] ?? [], true) ? 'checked' : ''; ?>
                                >
                                <label class="btn btn-outline-primary" for="rol-<?php echo $rolId; ?>">
                                    <?php echo $rol['rol']; ?>
                                </label>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>     
        </div>

        <div class="card-footer d-flex justify-content-end gap-2 bg-white py-3 border-0">
            <input type="submit" name="enviar" class="btn btn-success mt-3" value="Guardar">
            <a href="empleado.php" class="btn btn-danger mt-3">Cancelar</a>
        </div>
    </form>
</div>

