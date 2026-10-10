<?php $datos = $datos ?? []; ?>
<?php $clientes = $clientes ?? []; ?>

<div class="col-12">
    <form enctype="multipart/form-data" 
        action="vehiculo.php?accion=<?php echo $accion ?? 'create';?>&id=<?php echo $_GET['id'] ?? $datos['id'] ?? '' ?>" 
        method="post" 
        class="card">
    
        <input type="hidden" name="id" value="<?php echo $_GET['id'] ?? $datos['id'] ?? ''; ?>"> 
           
        <div class="card-header bg-dark text-white">
            <h3><?php echo ($datos['accion'] === 'update') ? 'Actualizar Vehículo' : 'Registrar Vehículo' ?></h3>
        </div>
         
        <div class="card-body col-12 col-lg-12 d-flex gap-3">
            <div class="col-md-8">
                <div class="mb-3">
                    <label class="form-label text-muted">Matricula</label>
                    <input type="text" name="data[matricula]" value="<?php echo $datos['matricula'] ?? '' ?>" class="form-control" id="matricula" required
                    pattern="[A-Za-z]{3}[0-9]{4}">  
                </div>
                
                <div class="row"> 
                    <div class="col mb-3">
                        <label class="form-label text-muted">Marca</label>
                        <input type="text" name="data[marca]" value="<?php echo $datos['marca'] ?? '' ?>" class="form-control" id="marca" required
                        minlength="1" maxlength="50" pattern="[A-Za-z\s]+">
                    </div>
    
                    <div class="col mb-3">
                        <label class="form-label text-muted">Modelo</label>
                        <input type="text" name="data[modelo]" value="<?php echo $datos['modelo'] ?? '' ?>" class="form-control" id="modelo" required
                        minlength="1" maxlength="50" pattern="[A-Za-z0-9\s]+">
                    </div>
    
                    <div class="col mb-3">
                        <label class="form-label text-muted">Año</label>
                        <input type="text" name="data[anio]" value="<?php echo $datos['anio'] ?? '' ?>" class="form-control" id="anio" required
                        minlength="1" maxlength="50" pattern="^(19[0-9]{2}|20[0-9]{2}|2100)$">
                    </div>
                </div>
    
                <div class="mb-3"> 
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

        <div class="card-footer d-flex justify-content-end gap-2 bg-white py-3 border-0">
            <input type="submit" name="enviar" class="btn btn-primary" value="Guardar">
            <a href="servicio.php" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>