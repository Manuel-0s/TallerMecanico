<?php $datos = $datos ?? []; ?>
<?php $roles = $roles ?? []; ?>
<div class="my-5 mx-5">
    <form enctype="multipart/form-data" 
        action="usuario.php?accion=<?php echo $accion ?? 'create';?>&id=<?php echo $_GET['id'] ?? $datos['id'] ?? '' ?>" 
        method="post" 
        class="card needs-validation" novalidate>
    
        <input type="hidden" name="id" value="<?php echo $_GET['id'] ?? $datos['id'] ?? ''; ?>"> 
           
        <div class="card-header bg-dark text-white">
            <h3><?php echo ($datos['accion'] === 'update') ? 'Actualizar Usuario' : 'Registrar Usuario' ?></h3>
        </div>
         
        <div class="card-body col-12 col-lg-12 d-flex gap-3">
            <div class="col-md-6">
        
                <div class="mb-3">
                    <label class="form-label text-muted">Nombre</label>
                    <input type="text" name="data[nombre]" value="<?php echo $datos['nombre'] ?? '' ?>" class="form-control" id="nombre" required
                    minlength="1" maxlength="50" pattern="[A-Za-zÀ-ÿ\s]+">
                </div>

                <div class="mb-3">
                    <label class="form-label text-muted">Primer Apellido</label>
                    <input type="text" name="data[primer_apellido]" value="<?php echo $datos['primer_apellido'] ?? '' ?>" class="form-control" id="primer_apellido" required
                    minlength="1" maxlength="50" pattern="[A-Za-zÀ-ÿ\s]+">
                </div>

                <div class="mb-3">
                    <label class="form-label text-muted">Segundo Apellido</label>
                    <input type="text" name="data[segundo_apellido]" value="<?php echo $datos['segundo_apellido'] ?? '' ?>" class="form-control" id="segundo_apellido"
                    minlength="1" maxlength="50" pattern="[A-Za-zÀ-ÿ\s]+">
                </div>
    
                <div class="mb-3">
                    <label class="form-label text-muted">Correo</label>
                    <input type="email" name="data[correo]" value="<?php echo $datos['correo'] ?? '' ?>" class="form-control" id="correo" required
                    pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                    placeholder="ejemplo@dominio.com">
                </div>
    
                <div class="mb-3">
                    <label class="form-label text-muted">Contraseña</label>
                    <input type="password" name="data[contrasena]" class="form-control" id="contrasena" required
                    pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$">
                </div>

                <div class="mb-3">
                    <label class="form-label d-block">Selecciona los roles</label>

                    <div class="d-grid gap-2 d-md-block" aria-label="Roles del usuario">
                        <?php foreach ($roles as $rol): ?>
                            <?php $rolId = (int) $rol['id_rol']; ?>
                            <input
                                type="checkbox"
                                class="btn-check"
                                name="data[id_rol][]"
                                value="<?php echo $rolId; ?>"
                                id="rol-<?php echo $rolId; ?>"
                                autocomplete="off"
                                <?php echo in_array($rolId, $datos['roles'] ?? [], true) ? 'checked' : ''; ?>
                            >
                            <label class="btn btn-outline-primary" for="rol-<?php echo $rolId; ?>">
                                <?php echo $rol['rol']; ?>
                            </label>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>  
        </div>

        <div class="card-footer d-flex justify-content-end gap-2 bg-white py-3 border-0">
            <input type="submit" name="enviar" class="btn btn-primary" value="Guardar">
            <a href="usuario.php" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
