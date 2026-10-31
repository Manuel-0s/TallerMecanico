<?php $datos = $datos ?? []; ?>

<div class="my-5 mx-5">
    <div class="mb-4">
        <h2 class="fw-bold mb-1"><?php echo ($datos['accion'] === 'update') ? 'Actualizar Permiso' : 'Registrar Permiso' ?></h2>
        <p class="text-muted mb-0">Captura la información del permiso.</p>
    </div>

    <form enctype="multipart/form-data" 
        action="permiso.php?accion=<?php echo $accion ?? 'create';?>&id=<?php echo $_GET['id'] ?? $datos['id'] ?? '' ?>" 
        method="post" 
        class="card shadow-sm border-0 needs-validation" novalidate>
    
        <input type="hidden" name="id" value="<?php echo $_GET['id'] ?? $datos['id'] ?? ''; ?>"> 
           
        <div class="card-body p-4">
            <h6 class="text-uppercase text-secondary fw-semibold small mb-3">Información del permiso</h6>

            <div class="col-md-6">
        
                <div class="mb-3">
                    <label class="form-label">Nombre del permiso <span class="text-danger">*</span></label>
                    <input type="text" name="data[permiso]" value="<?php echo $datos['permiso'] ?? '' ?>" class="form-control" id="permiso" required
                    minlength="1" maxlength="50" pattern="[a-z_]+\.[a-z_]+">
                </div>

                <div class="mb-3">
                    <label class="form-label">Descripción</label>
                    <textarea name="data[descripcion]" class="form-control" style="height: 100px" 
                    minlength="1" maxlength="255"><?php echo $datos['descripcion'] ?? '' ?></textarea>
                </div>
            </div>  
        </div>

        <div class="card-footer bg-white border-0 d-flex justify-content-end gap-2 py-3 px-4">
            <a href="permiso.php" class="btn btn-outline-secondary">Cancelar</a>
            <input type="submit" name="enviar" class="btn btn-primary" value="Guardar">
        </div>
    </form> 
</div>
