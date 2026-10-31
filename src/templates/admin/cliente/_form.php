<?php $datos = $datos ?? []; ?>
<div class="my-5 mx-5">
    <div class="mb-4">
        <h2 class="fw-bold mb-1"><?php echo ($datos['accion'] === 'update') ? 'Actualizar Cliente' : 'Registrar Cliente' ?></h2>
        <p class="text-muted mb-0">Captura los datos del cliente.</p>
    </div>

    <form enctype="multipart/form-data"
        action="cliente.php?accion=<?php echo $accion ?? 'create';?>&id=<?php echo $_GET['id'] ?? $datos['id'] ?? '' ?>" 
        method="post" 
        class="card shadow-sm border-0">
    
        <input type="hidden" name="id" value="<?php echo $_GET['id'] ?? $datos['id'] ?? ''; ?>">

        <div class="card-body p-4">
            <h6 class="text-uppercase text-secondary fw-semibold small mb-3">Datos personales</h6>

            <div class="col-md-8">
                <div class="mb-3">
                    <label class="form-label">Nombre <span class="text-danger">*</span></label>
                    <input type="text" name="data[nombre]" value="<?php echo $datos['nombre'] ?? '' ?>" class="form-control" id="nombre" required
                    minlength="1" maxlength="50" pattern="^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$">
                </div>
    
                <div class="mb-3">
                    <label class="form-label">Primer Apellido <span class="text-danger">*</span></label>
                    <input type="text" name="data[primer_apellido]" value="<?php echo $datos['primer_apellido'] ?? '' ?>" class="form-control" id="primer_apellido" required
                    minlength="1" maxlength="50" pattern="^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$" >
                </div>
    
                <div class="mb-3">
                    <label class="form-label">Segundo Apellido</label>
                    <input type="text" name="data[segundo_apellido]" value="<?php echo $datos['segundo_apellido'] ?? '' ?>" class="form-control" id="segundo_apellido" required
                    minlength="1" maxlength="50" pattern="^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$">
                </div>
    
                <div class="mb-3">
                    <label class="form-label">Teléfono <span class="text-danger">*</span></label>
                    <input type="text" name="data[telefono]" value="<?php echo $datos['telefono'] ?? '' ?>" class="form-control" id="telefono" required
                    minlength="1" maxlength="16" pattern="^\+?[0-9\s-]{10,15}$" placeholder="+52 123 456 7890">
                </div>
    
                <div class="mb-3">
                    <label class="form-label">Correo Electrónico <span class="text-danger">*</span></label>
                    <input type="email" name="data[correo]" value="<?php echo $datos['correo'] ?? '' ?>" class="form-control" id="correo" required
                    minlength="1" maxlength="100" pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" placeholder="usuario@dominio.com">
                </div>
            </div>     
        </div>

        <div class="card-footer bg-white border-0 d-flex justify-content-end gap-2 py-3 px-4">
            <a href="cliente.php" class="btn btn-outline-secondary">Cancelar</a>
            <input type="submit" name="enviar" class="btn btn-primary" value="Guardar">
        </div>
    </form>
</div>
