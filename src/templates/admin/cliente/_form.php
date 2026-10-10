<?php $datos = $datos ?? []; ?>
<div class="col-12">
    <form enctype="multipart/form-data"
        action="cliente.php?accion=<?php echo $accion ?? 'create';?>&id=<?php echo $_GET['id'] ?? $datos['id'] ?? '' ?>" 
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
                    <label class="form-label text-muted">Teléfono *</label>
                    <input type="text" name="data[telefono]" value="<?php echo $datos['telefono'] ?? '+52 123 456 7890' ?>" class="form-control" id="telefono" required
                    minlength="1" maxlength="16" pattern="^\+?[0-9\s-]{10,15}$" placeholder="+52 123 456 7890">
                </div>
    
                <div class="mb-3">
                    <label class="form-label text-muted">Correo Electrónico</label>
                    <input type="email" name="data[correo]" value="<?php echo $datos['correo'] ?? 'usuario@dominio.com' ?>" class="form-control" id="correo" required
                    minlength="1" maxlength="100" pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" placeholder="usuario@dominio.com">
                </div>
            </div>     
        </div>

        <div class="card-footer d-flex justify-content-end gap-2 bg-white py-3 border-0">
            <input type="submit" name="enviar" class="btn btn-success mt-3" value="Guardar">
            <a href="cliente.php" class="btn btn-danger mt-3">Cancelar</a>
        </div>
    </form>
</div>

