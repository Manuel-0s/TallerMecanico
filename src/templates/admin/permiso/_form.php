<?php $datos = $datos ?? []; ?>

<div class="my-5 mx-5">
    <div class="mb-4">
        <h2 class="fw-bold mb-1"><?= ($datos['accion'] ?? '') === 'update' ? 'Actualizar Permiso' : 'Registrar Permiso' ?></h2>
        <p class="text-muted mb-0">Define el identificador y el propósito del permiso del sistema.</p>
    </div>

    <form enctype="multipart/form-data"
        action="permiso.php?accion=<?= htmlspecialchars($accion ?? 'create') ?>&id=<?= htmlspecialchars($_GET['id'] ?? $datos['id'] ?? '') ?>"
        method="post"
        class="card shadow-sm border-0 needs-validation" novalidate>

        <input type="hidden" name="id" value="<?= htmlspecialchars($_GET['id'] ?? $datos['id'] ?? '') ?>">

        <div class="card-body p-4">
            <div class="row g-4">
                <div class="col-lg-8">
                    <h6 class="text-uppercase text-secondary fw-semibold small mb-3">Información del permiso</h6>

                    <div class="mb-4">
                        <label for="permiso" class="form-label text-secondary">Identificador <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="fa-solid fa-key"></i></span>
                            <input type="text" name="data[permiso]" value="<?= htmlspecialchars($datos['permiso'] ?? '') ?>"
                                   class="form-control bg-light font-monospace" id="permiso" required
                                   minlength="1" maxlength="50" pattern="[a-z_]+\.[a-z_]+"
                                   placeholder="Ej. servicio.crear">
                        </div>
                        <div class="form-text">Formato: <code>recurso.accion</code>, usando minúsculas y guion bajo si hace falta.</div>
                    </div>

                    <div class="mb-0">
                        <label for="descripcion" class="form-label text-secondary">Descripción</label>
                        <textarea name="data[descripcion]" id="descripcion" class="form-control bg-light"
                                  rows="4" maxlength="255" placeholder="Describe qué permite realizar este permiso..."><?= htmlspecialchars($datos['descripcion'] ?? '') ?></textarea>
                        <div class="form-text text-end">Máximo 255 caracteres</div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="border rounded-3 bg-light p-3 p-md-4 h-100">
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <span class="d-inline-flex align-items-center justify-content-center rounded-circle bg-primary-subtle text-primary"
                                  style="width: 2.5rem; height: 2.5rem;">
                                <i class="fa-solid fa-circle-info"></i>
                            </span>
                            <h6 class="text-uppercase text-secondary fw-semibold small mb-0">Sobre los permisos</h6>
                        </div>
                        <p class="text-secondary small mb-3">Cada permiso identifica una acción concreta que puede asignarse a uno o más roles.</p>
                        <div class="bg-white border rounded-3 p-3">
                            <span class="text-muted small d-block mb-1">Ejemplo</span>
                            <code class="fw-semibold">servicio.crear</code>
                            <span class="text-muted small d-block mt-2">Recurso: <strong>servicio</strong></span>
                            <span class="text-muted small d-block">Acción: <strong>crear</strong></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-footer bg-white border-top d-flex justify-content-end gap-2 py-3 px-4">
            <a href="permiso.php" class="btn btn-outline-secondary">Cancelar</a>
            <button type="submit" name="enviar" class="btn btn-primary px-4">Guardar</button>
        </div>
    </form>
</div>
