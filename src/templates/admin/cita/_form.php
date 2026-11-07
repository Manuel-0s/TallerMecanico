<?php $datos = $datos ?? []; ?>
<?php $vehiculos = $vehiculos ?? []; ?>
<?php $servicios = $servicios ?? []; ?>

<div class="my-5 mx-5">
    <div class="mb-4">
        <h2 class="fw-bold mb-1"><?php echo ($datos['accion'] === 'update') ? 'Actualizar Cita' : 'Registrar Cita' ?></h2>
        <p class="text-muted mb-0">Captura los datos del cliente, vehículo y la cita.</p>
    </div>

    <form enctype="multipart/form-data"
        action="cita.php?accion=<?php echo $accion ?? 'create';?>&id=<?php echo $_GET['id'] ?? $datos['id'] ?? '' ?>" 
        method="post" 
        class="card shadow-sm border-0">

        <input type="hidden" name="id" value="<?php echo $_GET['id'] ?? $datos['id'] ?? ''; ?>">

        <div class="card-body p-4 p-md-5">
            <?php if (!isset($datos['id_cita'])): ?>
                <div class="btn-group w-100 mb-4">
                    <input type="radio" class="btn-check" name="tipo_registro" 
                            id="tipo_existente" value="existente" autocomplete="off" checked>
                    <label class="btn btn-outline-primary" for="tipo_existente">
                        <i class="fa-solid fa-magnifying-glass me-2"></i>Vehículo Existente</label>

                    <input type="radio" class="btn-check" name="tipo_registro" 
                            id="tipo_nuevo" value="nuevo" autocomplete="off">
                    <label class="btn btn-outline-primary" for="tipo_nuevo">
                        <i class="fa-solid fa-user-plus me-2"></i>Nuevo Cliente/Vehículo</label>
                </div>
            <?php endif; ?>

            <div id="seccion_existente" class="mb-4">
                <h6 class="text-uppercase text-secondary fw-bold small mb-3">Seleccionar Vehículo </h6>

                <select class="form-select bg-light border-0 js-tomselect"
                        data-placeholder="Busca un vehiculo..."
                        name="data[id_vehiculo]" 
                        id="id_vehiculo" 
                        required
                        >
                    <option value="" disabled <?php echo empty($datos['id_vehiculo']) ? 'selected' : ''; ?>></option>
                    <?php foreach ($vehiculos as $vehiculo): ?>
                        <option value="<?php echo $vehiculo['id_vehiculo']; ?>"
                            <?php echo (($datos['id_vehiculo'] ?? '') == $vehiculo['id_vehiculo']) ? 'selected' : ''; ?>>
                            <?php echo ($vehiculo['matricula']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div id="seccion_nuevo" class="d-none">
                <!-- SECCIÓN CLIENTE -->
                <h6 class="text-uppercase text-secondary fw-bold small mb-3">Datos del cliente</h6>
                <div class="row g-3 mb-4">
                    <div class="col-md-4">
                        <label class="form-label text-secondary">Nombre <span class="text-danger">*</span></label>
                        <input type="text" name="data[nombre]" value="<?php echo $datos['nombre'] ?? '' ?>" 
                                class="form-control bg-light border-0 input-nuevo" id="nombre" 
                                minlength="1" maxlength="50" pattern="^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label text-secondary">Primer Apellido <span class="text-danger">*</span></label>
                        <input type="text" name="data[primer_apellido]" value="<?php echo $datos['primer_apellido'] ?? '' ?>"
                                class="form-control bg-light border-0 input-nuevo" id="primer_apellido" 
                                minlength="1" maxlength="50" pattern="^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label text-secondary">Segundo Apellido</label>
                        <input type="text" name="data[segundo_apellido]" value="<?php echo $datos['segundo_apellido'] ?? '' ?>" 
                                class="form-control bg-light border-0" id="segundo_apellido"
                                minlength="1" maxlength="50" pattern="^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$">
                    </div>
                </div>

                <!-- SECCIÓN CONTACTO -->
                <h6 class="text-uppercase text-secondary fw-bold small mb-3">Datos de contacto</h6>
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label class="form-label text-secondary">Teléfono <span class="text-danger">*</span></label>
                        <input type="text" name="data[telefono]" value="<?php echo $datos['telefono'] ?? '' ?>" 
                                class="form-control bg-light border-0 input-nuevo" id="telefono" 
                                minlength="10" maxlength="15" pattern="^[0-9]{10,15}$" placeholder="Ej. 4611234567" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-secondary">Correo electrónico <span class="text-danger">*</span></label>
                        <input type="email" name="data[correo]" value="<?php echo $datos['correo'] ?? '' ?>" 
                                class="form-control bg-light border-0 input-nuevo" id="correo" 
                                pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}"
                                placeholder="usuario@dominio.com" required>
                    </div>
                </div>

                <hr class="text-secondary-emphasis opacity-25 my-4">

                <!-- SECCIÓN VEHÍCULO -->
                <h6 class="text-uppercase text-secondary fw-bold small mb-3">Datos del vehículo</h6>
                <div class="row g-3 mb-4">
                    <div class="col-md-3 col-sm-6">
                        <label class="form-label text-secondary">Matrícula <span class="text-danger">*</span></label>
                        <input type="text" name="data[matricula]" value="<?php echo $datos['matricula'] ?? '' ?>" 
                                class="form-control text-uppercase bg-light border-0 input-nuevo" id="matricula" 
                                minlength="6" maxlength="10" pattern="^[A-Za-z0-9-]{6,10}$" placeholder="ABC-123" required>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <label class="form-label text-secondary">Marca <span class="text-danger">*</span></label>
                        <input type="text" name="data[marca]" value="<?php echo $datos['marca'] ?? '' ?>" 
                                class="form-control bg-light border-0 input-nuevo" id="marca" 
                                minlength="1" maxlength="50" required>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <label class="form-label text-secondary">Modelo <span class="text-danger">*</span></label>
                        <input type="text" name="data[modelo]" value="<?php echo $datos['modelo'] ?? '' ?>" 
                                class="form-control bg-light border-0 input-nuevo" id="modelo" 
                                minlength="1" maxlength="50" required>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <label class="form-label text-secondary">Año <span class="text-danger">*</span></label>
                        <input type="text" name="data[anio]" value="<?php echo $datos['anio'] ?? '' ?>" 
                                class="form-control bg-light border-0 input-nuevo" id="anio" 
                                minlength="4" maxlength="4" pattern="^(19|20)\d{2}$" placeholder="Ej. 2020" required>
                    </div>
                </div>
            </div>
            <hr class="text-secondary-emphasis opacity-25 my-4">
            
            <!-- SECCIÓN CITA -->
            <h6 class="text-uppercase text-secondary fw-bold small mb-3">Datos de la cita</h6>
            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <label class="form-label text-secondary" for="fecha">Fecha y hora <span class="text-danger">*</span></label>
                    <?php
                        $fecha = !empty($datos['fecha'])
                            ? date('Y-m-d\TH:i', strtotime($datos['fecha']))
                            : '';
                    ?>
                    <input type="datetime-local" name="data[fecha]" value="<?php echo htmlspecialchars($fecha); ?>"
                        class="form-control bg-light border-0" id="fecha" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label text-secondary" for="estatus">Estatus <span class="text-danger">*</span></label>
                    <?php $estatusActual = $datos['estatus'] ?? 'programada'; ?>
                    <select name="data[estatus]" class="form-select bg-light border-0" id="estatus" required>
                        <?php foreach (['programada', 'atendida', 'cancelada'] as $estatus): ?>
                            <option value="<?php echo $estatus; ?>" <?php echo ($estatusActual === $estatus) ? 'selected' : ''; ?>>
                                <?php echo ucfirst($estatus); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-12 mt-3">
                    <label class="form-label text-secondary" for="observaciones">Observaciones</label>
                    <textarea name="data[observaciones]" class="form-control bg-light border-0" id="observaciones"
                        rows="3" maxlength="255"
                        placeholder="Describe el servicio o problema del vehículo..."><?php echo htmlspecialchars($datos['observaciones'] ?? ''); ?></textarea>
                </div>
            </div>
            <hr class="text-secondary-emphasis opacity-25 my-4">

            <!-- SECCIÓN SERVICIOS -->
            <h6 class="text-uppercase text-secondary fw-bold small mb-3">Selecciona los servicios</h6>
            <div class="row g-3 mb-4">
                
                <?php foreach ($servicios as $servicio): ?>
                    <?php 
                        $servicioId = (int) $servicio['id_servicio']; 
                        $checked = in_array($servicioId, $datos['id_servicios'] ?? [], true) ? 'checked' : '';
                    ?>
                    <div class="col-md-4 col-lg-2">
                        <input
                            type="checkbox"
                            class="btn-check"
                            name="data[id_servicio][]"
                            value="<?php echo $servicioId; ?>"
                            id="servicio-<?php echo $servicioId; ?>"
                            <?php echo $checked; ?>
                        >
                        <label class="btn btn-outline-primary w-100 h-100 text-start p-3" for="servicio-<?php echo $servicioId; ?>">
                            <span class="d-block fw-semibold"><?php echo $servicio['servicio']; ?></span>
                            <span class="badge bg-light text-dark border mt-2">
                                $<?php echo number_format($servicio['precio_base'], 2); ?>
                            </span>
                        </label>
                    </div>
                <?php endforeach; ?>                         
            </div>                   

        </div>
            <div class="card-footer bg-white border-0 d-flex justify-content-end gap-2 py-3 px-4">
                <a href="cita.php" class="btn btn-outline-secondary px-4">Cancelar</a>
                <button type="submit" name="enviar" class="btn btn-primary px-4">Agendar</button>
            </div>
        </div>
    </form>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const radios = document.querySelectorAll('input[name="tipo_registro"]');
        const seccionExistente = document.getElementById('seccion_existente');
        const seccionNuevo = document.getElementById('seccion_nuevo');
        const selectVehiculo = document.getElementById('id_vehiculo');
        const inputsNuevos = document.querySelectorAll('.input-nuevo');

        function actualizarFormulario(tipo) {
            const esNuevo = tipo === 'nuevo';

            seccionExistente.classList.toggle('d-none', esNuevo);
            seccionNuevo.classList.toggle('d-none', !esNuevo);
            selectVehiculo.required = !esNuevo;

            inputsNuevos.forEach(input => {
                input.required = esNuevo;
            });
        }

        radios.forEach(radio => {
            radio.addEventListener('change', function() {
                actualizarFormulario(this.value);
            });
        });

        const radioSeleccionado = document.querySelector('input[name="tipo_registro"]:checked');
        actualizarFormulario(radioSeleccionado ? radioSeleccionado.value : 'existente');
    });
</script>