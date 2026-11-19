<?php $datos = $datos ?? []; ?>
<div class="my-5 mx-5">
    <div class="mb-4">
        <h2 class="fw-bold mb-1"><?= ($datos['accion'] === 'update') ? 'Actualizar Servicio' : 'Registrar Servicio' ?></h2>
        <p class="text-muted mb-0">Captura la información del servicio.</p>
    </div>

    <form enctype="multipart/form-data" 
        action="servicio.php?accion=<?= $accion ?? 'create'; ?>&id=<?= $_GET['id'] ?? $datos['id'] ?? '' ?>" 
        method="post" 
        class="card shadow-sm border-0">
    
        <input type="hidden" name="id" value="<?= $_GET['id'] ?? $datos['id'] ?? ''; ?>"> 
           
        <div class="card-body p-4">
            <div class="row g-4">
                <div class="col-md-8">
                    <h6 class="text-uppercase text-secondary fw-semibold small mb-3">Información del servicio</h6>

                    <div class="row g-3 mb-3">
                        <div class="col-md-8">
                            <label for="servicio" class="form-label">Nombre del servicio <span class="text-danger">*</span></label>
                            <input type="text" name="data[servicio]" value="<?= htmlspecialchars($datos['servicio'] ?? '') ?>" 
                                   class="form-control bg-light" id="servicio" required minlength="1" maxlength="100"
                                   placeholder="Ej. Cambio de aceite y filtro">
                        </div>

                        <div class="col-md-4">
                            <label for="precio" class="form-label">Precio base <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">$</span>
                                <input type="number" name="data[precio_base]" value="<?= htmlspecialchars($datos['precio_base'] ?? '') ?>" 
                                       class="form-control bg-light" id="precio" required min="0" step="0.01" placeholder="0.00">
                            </div>
                        </div>
                    </div>
        
                    <div class="mb-0">
                        <label for="descripcion" class="form-label">Descripción <span class="text-danger">*</span></label>
                        <textarea name="data[descripcion]" id="descripcion" class="form-control bg-light" 
                                  rows="4" minlength="1" maxlength="150" required
                                  placeholder="Describe brevemente qué incluye este servicio..."><?= htmlspecialchars($datos['descripcion'] ?? '') ?></textarea>
                        <div class="form-text text-end">Máximo 150 caracteres</div>
                    </div>
                </div>

                <div class="col-md-4">
                    <h6 class="text-uppercase text-secondary fw-semibold small mb-3">Imagen del servicio</h6>

                    <div class="border rounded-3 bg-light p-3 text-center d-flex flex-column align-items-center justify-content-center" style="min-height: 220px;">
                        <?php $tieneImagen = !empty($datos['imagen']); ?>
                        
                        <img src="<?= $tieneImagen ? '/assets/images/uploads/' . htmlspecialchars($datos['imagen']) : '' ?>" 
                             alt="Vista previa" 
                             id="preview-imagen" 
                             class="img-fluid rounded mb-2 <?= $tieneImagen ? '' : 'd-none' ?>" 
                             style="max-height: 140px; object-fit: contain;">

                        <div id="placeholder-imagen" class="text-muted my-3 <?= $tieneImagen ? 'd-none' : '' ?>">
                            <i class="fa-regular fa-image fa-2x mb-2 d-block opacity-50"></i>
                            <span class="small d-block">Sin imagen seleccionada</span>
                            <span class="text-secondary" style="font-size: 0.75rem;">JPG, PNG o WEBP (máx. 2 MB)</span>
                        </div>

                        <input type="file" name="data[imagen]" id="imagen" accept="image/jpeg,image/png,image/webp" hidden>
                        
                        <button type="button" id="btn-seleccionar-imagen" class="btn btn-outline-primary btn-sm mt-2">
                            <i class="fa-solid fa-upload me-1"></i> <?= $tieneImagen ? 'Cambiar imagen' : 'Seleccionar imagen' ?>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-footer bg-white border-top d-flex justify-content-end gap-2 py-3 px-4">
            <a href="servicio.php" class="btn btn-outline-secondary">Cancelar</a>
            <button type="submit" name="enviar" class="btn btn-primary px-4">Guardar</button>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const inputImagen = document.getElementById('imagen');
    const btnSeleccionar = document.getElementById('btn-seleccionar-imagen');
    const preview = document.getElementById('preview-imagen');
    const placeholder = document.getElementById('placeholder-imagen');

    btnSeleccionar.addEventListener('click', () => inputImagen.click());

    inputImagen.addEventListener('change', () => {
        const archivo = inputImagen.files[0];
        if (!archivo) return;

        preview.src = URL.createObjectURL(archivo);
        preview.classList.remove('d-none');
        placeholder.classList.add('d-none');
        btnSeleccionar.innerHTML = '<i class="fa-solid fa-rotate me-1"></i> Cambiar imagen';
    });
});
</script>