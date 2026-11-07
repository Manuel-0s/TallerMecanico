<?php $roles = $roles ?? []; ?>
<?php $datos = $datos ?? []; ?>

<div class="my-5 mx-5">
    <div class="mb-4">
        <h2 class="fw-bold mb-1"><?php echo ($datos['accion'] === 'update') ? 'Actualizar Empleado' : 'Registrar Empleado' ?></h2>
        <p class="text-muted mb-0">
            Captura los datos del empleado.
        </p>
    </div>

    <form enctype="multipart/form-data"
        action="empleado.php?accion=<?php echo $accion ?? 'create';?>&id=<?php echo $_GET['id'] ?? $datos['id'] ?? '' ?>" 
        method="post" 
        class="card shadow-sm border-0">
    
        <input type="hidden" name="id" value="<?php echo $_GET['id'] ?? $datos['id'] ?? ''; ?>">

        <div class="card-body p-4">
            <h6 class="text-uppercase text-secondary fw-bold small mb-3">Datos personales</h6>

            <div class="row g-4 mb-4">

                <!-- Foto del empleado -->
                <div class="col-md-3 text-center">
                    <img id="foto-preview"
                        src="<?= !empty($datos['foto'])
                                ? '/assets/images/uploads/' . htmlspecialchars($datos['foto'])
                                : '/assets/images/public/avatar.png' ?>"
                        alt="Foto del empleado"
                        class="rounded-circle border object-fit-cover"
                        width="150" height="150">

                    <input type="file" name="data[foto]" id="foto-input" accept="image/*" hidden>

                    <div class="d-grid gap-2 mt-3">
                        <button type="button" id="btn-subir-foto" class="btn btn-outline-secondary btn-sm">
                            <i class="fa-solid fa-upload me-1"></i> Subir foto
                        </button>
                        <button type="button" class="btn btn-outline-primary btn-sm"
                                data-bs-toggle="modal" data-bs-target="#modal-camara">
                            <i class="fa-solid fa-camera me-1"></i> Tomar foto
                        </button>
                    </div>
                </div>

                <!-- Campos personales -->
                <div class="col-md-9">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label text-secondary">Nombre <span class="text-danger">*</span></label>
                            <input type="text" name="data[nombre]" value="<?php echo $datos['nombre'] ?? '' ?>" 
                                    class="form-control bg-light" id="nombre" 
                                    minlength="1" maxlength="50" pattern="^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$" required>
                        </div>
            
                        <div class="col-md-4">
                            <label class="form-label text-secondary">Primer Apellido <span class="text-danger">*</span></label>
                            <input type="text" name="data[primer_apellido]" value="<?php echo $datos['primer_apellido'] ?? '' ?>"
                                    class="form-control bg-light" id="primer_apellido" 
                                    minlength="1" maxlength="50" pattern="^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$" required>
                        </div>
            
                        <div class="col-md-4">
                            <label class="form-label text-secondary">Segundo Apellido</label>
                            <input type="text" name="data[segundo_apellido]" value="<?php echo $datos['segundo_apellido'] ?? '' ?>" 
                                    class="form-control bg-light" id="segundo_apellido"
                                    minlength="1" maxlength="50" pattern="^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$">
                        </div>
            
                        <div class="col-md-4">
                            <label for="rfc" class="form-label text-secondary">RFC <span class="text-danger">*</span></label>
                            <input type="text" name="data[rfc]" value="<?php echo $datos['rfc'] ?? '' ?>" 
                                    class="form-control text-uppercase bg-light" id="rfc" 
                                    minlength="13" maxlength="13" pattern="^[A-Za-z0-9]{13}$" placeholder="ABCD123456XXX" required>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="text-secondary-emphasis">
            <h6 class="text-uppercase text-secondary fw-bold small mb-3">Cuenta de acceso</h6>

            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <label class="form-label text-secondary">Correo electrónico <span class="text-danger">*</span></label>
                    <div class="input-group"> 
                        <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-envelope"></i></span>
                        <input type="email" name="data[correo]" 
                            value="<?php echo $datos['correo'] ?? ''; ?>" class="form-control bg-light" id="correo" 
                            pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}"
                            placeholder="usuario@dominio.com" required>
                    </div>
                </div> 
                <div class="col-md-6">
                    <label class="form-label text-secondary">Contraseña <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon2"><i class="fa-solid fa-key"></i></span>
                        <input type="password" name="data[contrasena]" class="form-control bg-light" id="contrasena"
                                minlength="8" maxlength="50" placeholder="Mínimo 8 caracteres" 
                                <?php echo ($datos['accion'] === 'update') ? '' : 'required'; ?>>
                    </div>
                </div>
            </div> 

            <hr class="text-secondary-emphasis">
 
            <h6 class="text-uppercase text-secondary fw-bold small mb-1">Roles</h6>
            <p class="text-muted small mb-3">El rol <strong>Empleado</strong> se asigna automáticamente. Selecciona los roles adicionales.</p>

            <div class="d-flex flex-wrap gap-2" aria-label="Roles del empleado">
                <?php foreach ($roles as $rol): ?>
                     <?php if ($rol["rol"] != "Empleado"): ?>
                        <?php $rolId = (int) $rol['id_rol']; ?>
                        <input
                            type="checkbox"
                            class="btn-check"
                            name="data[id_rol][]"
                            value="<?php echo $rolId; ?>"
                            id="rol-<?php echo $rolId; ?>"
                            <?php echo in_array($rolId, $datos['roles'] ?? [], true) ? 'checked' : ''; ?>
                            >
                        <label class="btn btn-sm btn-outline-primary" for="rol-<?php echo $rolId; ?>">
                            <?php echo $rol['rol']; ?>
                        </label>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>      
        </div>

        <div class="card-footer bg-white border-0 d-flex justify-content-end gap-2 py-3 px-4">
            <a href="empleado.php" class="btn btn-outline-secondary">Cancelar</a>
            <input type="submit" name="enviar" class="btn btn-primary" value="Guardar">
        </div>
    </form>
</div>

<!-- Modal de la cámara -->
<div class="modal fade" id="modal-camara" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tomar foto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body text-center">
                <video id="camara-video" class="w-100 rounded" autoplay playsinline muted></video>
                <canvas id="camara-canvas" class="w-100 rounded d-none"></canvas>
                <p id="camara-error" class="text-danger small mt-2 d-none"></p>
            </div>
            <div class="modal-footer">
                <button type="button" id="btn-capturar" class="btn btn-primary">
                    <i class="fa-solid fa-camera"></i> Capturar
                </button>
                <button type="button" id="btn-repetir" class="btn btn-outline-secondary d-none">Repetir</button>
                <button type="button" id="btn-usar-foto" class="btn btn-success d-none">Usar foto</button>
            </div>
        </div>
    </div>
</div>

<script src="../../assets/js/camara.js"></script>