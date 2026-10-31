<?php $datos = $datos ?? []; ?>
<?php $permisos = $permisos ?? []; ?>

<div class="my-5 mx-5">
    <div class="mb-4">
        <h2 class="fw-bold mb-1"><?php echo ($datos['accion'] === 'update') ? 'Actualizar Rol' : 'Registrar Rol' ?></h2>
        <p class="text-muted mb-0">Captura la información del rol y sus permisos.</p>
    </div>

    <form enctype="multipart/form-data" 
        action="rol.php?accion=<?php echo $accion ?? 'create';?>&id=<?php echo $_GET['id'] ?? $datos['id'] ?? '' ?>" 
        method="post" 
        class="card shadow-sm border-0 needs-validation" novalidate>
    
        <input type="hidden" name="id" value="<?php echo $_GET['id'] ?? $datos['id'] ?? ''; ?>"> 
           
        <div class="card-body p-4">
            <h6 class="text-uppercase text-secondary fw-semibold small mb-3">Información del rol</h6>

            <div class="col-md-6">
        
                <div class="mb-3">
                    <label class="form-label">Nombre del Rol <span class="text-danger">*</span></label>
                    <input type="text" name="data[rol]" value="<?php echo $datos['rol'] ?? '' ?>" class="form-control" id="rol" required
                    minlength="1" maxlength="50" pattern="[A-Za-zÀ-ÿ\s]+">
                </div>

                <div class="mb-3">
                    <label class="form-label">Descripción</label>
                    <textarea name="data[descripcion]" class="form-control" style="height: 100px" 
                    minlength="1" maxlength="255"><?php echo $datos['descripcion'] ?? '' ?></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label d-block">Selecciona los permisos</label>

                    <div class="d-flex flex-wrap gap-2" aria-label="Permisos del rol">
                        <?php foreach ($permisos as $permiso): ?>
                            <?php $permisoId = (int) $permiso['id_permiso']; ?>
                            <input
                                type="checkbox"
                                class="btn-check"
                                name="data[id_permiso][]"
                                value="<?php echo $permisoId; ?>"
                                id="permiso-<?php echo $permisoId; ?>"
                                autocomplete="off"
                                <?php echo in_array($permisoId, $datos['permisos'] ?? [], true) ? 'checked' : ''; ?>
                            >
                            <label class="btn btn-sm btn-outline-primary" for="permiso-<?php echo $permisoId; ?>">
                                <?php echo htmlspecialchars($permiso['permiso']); ?>
                            </label>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>  
        </div>

        <div class="card-footer bg-white border-0 d-flex justify-content-end gap-2 py-3 px-4">
            <a href="rol.php" class="btn btn-outline-secondary">Cancelar</a>
            <input type="submit" name="enviar" class="btn btn-primary" value="Guardar">
        </div>
    </form> 
</div>
