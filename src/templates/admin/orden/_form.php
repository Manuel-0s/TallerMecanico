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

            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <label for="nombre" class="form-label text-secondary">Nombre <span class="text-danger">*</span></label>
                    <input type="text" name="data[nombre]" value="<?= htmlspecialchars($datos['nombre'] ?? '') ?>"
                           class="form-control bg-light" id="nombre" required minlength="1" maxlength="50"
                           pattern="^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$">
                </div>
                <div class="col-md-4">
                    <label for="primer_apellido" class="form-label text-secondary">Primer Apellido <span class="text-danger">*</span></label>
                    <input type="text" name="data[primer_apellido]" value="<?= htmlspecialchars($datos['primer_apellido'] ?? '') ?>"
                           class="form-control bg-light" id="primer_apellido" required minlength="1" maxlength="50"
                           pattern="^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$">
                </div>
                <div class="col-md-4">
                    <label for="segundo_apellido" class="form-label text-secondary">Segundo Apellido</label>
                    <input type="text" name="data[segundo_apellido]" value="<?= htmlspecialchars($datos['segundo_apellido'] ?? '') ?>"
                           class="form-control bg-light" id="segundo_apellido" maxlength="50"
                           pattern="^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$">
                </div>
            </div>

            <hr class="text-secondary-emphasis">
            <h6 class="text-uppercase text-secondary fw-semibold small mb-3">Datos de contacto</h6>

            <div class="row g-3">
                <div class="col-md-5">
                    <label for="telefono" class="form-label text-secondary">Teléfono <span class="text-danger">*</span></label>
                    <input type="text" name="data[telefono]" value="<?= htmlspecialchars($datos['telefono'] ?? '') ?>"
                           class="form-control bg-light" id="telefono" required minlength="1" maxlength="16"
                           pattern="^\+?[0-9\s-]{10,15}$" placeholder="+52 123 456 7890">
                </div>
                <div class="col-md-7">
                    <label for="correo" class="form-label text-secondary">Correo electrónico <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
                        <input type="email" name="data[correo]" value="<?= htmlspecialchars($datos['correo'] ?? '') ?>"
                               class="form-control bg-light" id="correo" required maxlength="100"
                               pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$"
                               placeholder="usuario@dominio.com">
                    </div>
                </div>
            </div>
        </div>

        <div class="card-footer bg-white border-top d-flex justify-content-end gap-2 py-3 px-4">
            <a href="cliente.php" class="btn btn-outline-secondary">Cancelar</a>
            <button type="submit" name="enviar" class="btn btn-primary px-4">Guardar</button>
        </div>
    </form>
</div>
