<div class="modal fade" id="modalMiPerfil" tabindex="-1" aria-labelledby="modalMiPerfilLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-bottom-0 pb-0">
                <h5 class="modal-title fw-bold" id="modalMiPerfilLabel">Mi Perfil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>

            <div class="modal-body text-center pt-2 pb-4 px-4">
                <!-- Avatar -->
                <img src="<?= htmlspecialchars($fotoUsuario, ENT_QUOTES, 'UTF-8') ?>"
                    alt="Foto de perfil" 
                    class="rounded-circle mb-3 shadow-sm object-fit-cover" 
                    width="88" height="88">
                <!-- Nombre y Rol -->
                <h5 class="fw-bold mb-1"><?= htmlspecialchars($_SESSION['nombre'] ?? 'Jose Manuel'); ?></h5>
                <span class="badge bg-primary-subtle text-primary rounded-pill px-3 py-1 mb-4">
                    <?= htmlspecialchars($_SESSION['rol'] ?? 'Administrador'); ?>
                </span>
                <!-- Tarjeta con datos -->
                <div class="bg-light rounded-3 p-3 text-start">
                    <div class="d-flex justify-content-between align-items-center mb-2 pb-2 border-bottom">
                        <span class="text-muted small"><i class="fa-regular fa-envelope me-2"></i>Correo electrónico</span>
                        <span class="fw-medium small"><?= htmlspecialchars($correoUsuario); ?></span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="text-muted small"><i class="fa-solid fa-shield-halved me-2"></i>Estado de cuenta</span>
                        <span class="text-success fw-medium small"><i class="fa-solid fa-circle fa-2xs me-1"></i>Activo</span>
                    </div>
                </div>
            </div>

            <div class="modal-footer border-top-0 pt-0 justify-content-between">
                <a href="perfil/perfil1.php" class="btn btn-outline-primary btn-sm">
                    <i class="fa-solid fa-pen-to-square me-1"></i> Editar datos
                </a>
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>