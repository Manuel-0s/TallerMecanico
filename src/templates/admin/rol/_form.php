<?php $datos = $datos ?? []; ?>
<?php $permisos = $permisos ?? []; ?>
<?php $permisosSeleccionados = array_map('intval', $datos['permisos'] ?? []); ?>

<div class="my-5 mx-5">
    <div class="mb-4">
        <h2 class="fw-bold mb-1"><?= ($datos['accion'] ?? '') === 'update' ? 'Actualizar Rol' : 'Registrar Rol' ?></h2>
        <p class="text-muted mb-0">Define la información del rol y los permisos que tendrá asignados.</p>
    </div>

    <form enctype="multipart/form-data"
        action="rol.php?accion=<?= htmlspecialchars($accion ?? 'create') ?>&id=<?= htmlspecialchars($_GET['id'] ?? $datos['id'] ?? '') ?>"
        method="post"
        class="card shadow-sm border-0 needs-validation" novalidate>

        <input type="hidden" name="id" value="<?= htmlspecialchars($_GET['id'] ?? $datos['id'] ?? '') ?>">

        <div class="card-body p-4">
            <div class="row g-4">
                <div class="col-lg-5">
                    <h6 class="text-uppercase text-secondary fw-semibold small mb-3">Información del rol</h6>

                    <div class="mb-3">
                        <label for="rol" class="form-label text-secondary">Nombre del rol <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="fa-solid fa-user-shield"></i></span>
                            <input type="text" name="data[rol]" value="<?= htmlspecialchars($datos['rol'] ?? '') ?>"
                                   class="form-control bg-light" id="rol" required minlength="1" maxlength="50"
                                   pattern="[A-Za-zÀ-ÿ\s]+" placeholder="Ej. Supervisor">
                        </div>
                        <div class="form-text">Usa un nombre claro para identificar el nivel de acceso.</div>
                    </div>

                    <div class="mb-0">
                        <label for="descripcion" class="form-label text-secondary">Descripción</label>
                        <textarea name="data[descripcion]" id="descripcion" class="form-control bg-light"
                                  rows="5" maxlength="255" placeholder="Describe brevemente las responsabilidades de este rol..."><?= htmlspecialchars($datos['descripcion'] ?? '') ?></textarea>
                        <div class="form-text text-end">Máximo 255 caracteres</div>
                    </div>
                </div>

                <div class="col-lg-7">
                    <div class="border rounded-3 bg-light p-3 p-md-4 h-100">
                        <div class="d-flex flex-wrap justify-content-between align-items-start gap-2 mb-3">
                            <div>
                                <h6 class="text-uppercase text-secondary fw-semibold small mb-1">Permisos del rol</h6>
                                <p class="text-muted small mb-0">Selecciona las acciones que podrá realizar.</p>
                            </div>
                            <span class="badge bg-white text-secondary border rounded-pill">
                                <?= count($permisos) ?> disponibles
                            </span>
                        </div>

                        <?php if (!empty($permisos)): ?>
                            <div class="d-flex flex-wrap gap-2" aria-label="Permisos del rol">
                                <?php foreach ($permisos as $permiso): ?>
                                    <?php $permisoId = (int) $permiso['id_permiso']; ?>
                                    <input
                                        type="checkbox"
                                        class="btn-check"
                                        name="data[id_permiso][]"
                                        value="<?= $permisoId ?>"
                                        id="permiso-<?= $permisoId ?>"
                                        autocomplete="off"
                                        <?= in_array($permisoId, $permisosSeleccionados, true) ? 'checked' : '' ?>>
                                    <label class="btn btn-sm btn-outline-primary rounded-pill" for="permiso-<?= $permisoId ?>">
                                        <i class="fa-solid fa-key me-1"></i><?= htmlspecialchars($permiso['permiso']) ?>
                                    </label>
                                <?php endforeach; ?>
                            </div>
                        <?php else: ?>
                            <div class="text-center text-muted py-4">
                                <i class="fa-solid fa-key fa-lg mb-2 d-block opacity-50"></i>
                                No hay permisos disponibles para asignar.
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-footer bg-white border-top d-flex justify-content-end gap-2 py-3 px-4">
            <a href="rol.php" class="btn btn-outline-secondary">Cancelar</a>
            <button type="submit" name="enviar" class="btn btn-primary px-4">Guardar</button>
        </div>
    </form>
</div>
