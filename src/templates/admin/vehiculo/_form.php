<?php $datos = $datos ?? []; ?>
<?php $clientes = $clientes ?? []; ?>

<div class="my-5 mx-5">
    <div class="mb-4">
        <h2 class="fw-bold mb-1"><?php echo ($datos['accion'] === 'update') ? 'Actualizar Vehículo' : 'Registrar Vehículo' ?></h2>
        <p class="text-muted mb-0">Captura los datos del vehículo.</p>
    </div>

    <form enctype="multipart/form-data" 
        action="vehiculo.php?accion=<?php echo $accion ?? 'create';?>&id=<?php echo $_GET['id'] ?? $datos['id'] ?? '' ?>" 
        method="post" 
        class="card shadow-sm border-0">
    
        <input type="hidden" name="id" value="<?php echo $_GET['id'] ?? $datos['id'] ?? ''; ?>"> 
           
        <div class="card-body p-4">
            <h6 class="text-uppercase text-secondary fw-semibold small mb-3">Información del vehículo</h6>

            <div class="col-md-8">
                <div class="mb-3">
                    <label class="form-label">Matrícula <span class="text-danger">*</span></label>
                    <input type="text" name="data[matricula]" value="<?php echo $datos['matricula'] ?? '' ?>" class="form-control" id="matricula" required
                    pattern="[A-Za-z]{3}[0-9]{4}">  
                </div>
                
                <div class="row"> 
                    <div class="col mb-3">
                        <label class="form-label">Marca <span class="text-danger">*</span></label>
                        <input type="text" name="data[marca]" value="<?php echo $datos['marca'] ?? '' ?>" class="form-control" id="marca" required
                        minlength="1" maxlength="50" pattern="[A-Za-z\s]+">
                    </div>
    
                    <div class="col mb-3">
                        <label class="form-label">Modelo <span class="text-danger">*</span></label>
                        <input type="text" name="data[modelo]" value="<?php echo $datos['modelo'] ?? '' ?>" class="form-control" id="modelo" required
                        minlength="1" maxlength="50" pattern="[A-Za-z0-9\s]+">
                    </div>
    
                    <div class="col mb-3">
                        <label class="form-label">Año <span class="text-danger">*</span></label>
                        <input type="text" name="data[anio]" value="<?php echo $datos['anio'] ?? '' ?>" class="form-control" id="anio" required
                        minlength="1" maxlength="50" pattern="^(19[0-9]{2}|20[0-9]{2}|2100)$">
                    </div>
                </div>
    
                <div class="mb-3">
                    <label class="form-label">Cliente <span class="text-danger">*</span></label>
                    <select class="form-select" name="data[id_cliente]" id="id_cliente" required>
                        <?php 
                            foreach ($clientes as $cliente):
                                $selected = "";
                                if ($datos['id_cliente'] == $cliente['id']){
                                    $selected = 'selected';
                                }
                        ?>
                        <option value="<?php echo $cliente['id_cliente'] ?>" <?php echo $selected ?>> 
                            <?php 
                                echo $cliente['nombre'];
                            ?>
                        </option>        
                        <?php endforeach; ?>
                    </select>
                </div> 
            </div>  
        </div>

        <div class="card-footer bg-white border-0 d-flex justify-content-end gap-2 py-3 px-4">
            <a href="vehiculo.php" class="btn btn-outline-secondary">Cancelar</a>
            <input type="submit" name="enviar" class="btn btn-primary" value="Guardar">
        </div>
    </form>
</div>