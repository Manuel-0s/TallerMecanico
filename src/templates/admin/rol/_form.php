<?php $datos = $datos ?? []; ?>
<div class="my-5 mx-5">
    <form enctype="multipart/form-data" 
        action="rol.php?accion=<?php echo $accion ?? 'create';?>&id=<?php echo $_GET['id'] ?? $datos['id'] ?? '' ?>" 
        method="post" 
        class="card needs-validation" novalidate>
    
        <input type="hidden" name="id" value="<?php echo $_GET['id'] ?? $datos['id'] ?? ''; ?>"> 
           
        <div class="card-header bg-dark text-white">
            <h3><?php echo ($datos['accion'] === 'update') ? 'Actualizar Rol' : 'Registrar Rol' ?></h3>
        </div>
         
        <div class="card-body col-12 col-lg-12 d-flex gap-3">
            <div class="col-md-6">
        
                <div class="mb-3">
                    <label class="form-label text-muted">Nombre del Rol</label>
                    <input type="text" name="data[rol]" value="<?php echo $datos['rol'] ?? '' ?>" class="form-control" id="rol" required
                    minlength="1" maxlength="50" pattern="[A-Za-zÀ-ÿ\s]+">
                </div>

                <div class="mb-3">
                    <label class="form-label text-muted">Descripción</label>
                    <textarea name="data[descripcion]" class="form-control" style="height: 100px" 
                    minlength="1" maxlength="255"><?php echo $datos['descripcion'] ?? '' ?></textarea>
                </div>
            </div>  
        </div>

        <div class="card-footer d-flex justify-content-end gap-2 bg-white py-3 border-0">
            <input type="submit" name="enviar" class="btn btn-primary" value="Guardar">
            <a href="rol.php" class="btn btn-secondary">Cancelar</a>
        </div>
    </form> 
</div>
