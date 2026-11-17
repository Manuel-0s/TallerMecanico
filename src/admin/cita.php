<?php 
    ob_start();
    require_once __DIR__ . '/models/cita/cita.class.php';
    require_once __DIR__ . '/models/vehiculo/vehiculo.class.php';
    require_once __DIR__ . '/models/auth/auth.class.php';
    require_once __DIR__ . '/models/servicio/servicios.class.php';
    require_once __DIR__ . '/services/cita.service.php';
    require_once __DIR__ . '/../helpers/pdf.php';

    $appAuth = new Auth();
    $appAuth -> verificarRol('Administrador');

    $app = new Cita();
    $appVehiculo = new Vehiculo();
    $appServicio = new Servicio();
    $citaService = new CitaService($app);
    $accion = $_GET['accion'] ?? 'read';
    $id = $_GET['id'] ?? null;

    if ($accion === 'pdf') {
        $cita = $app->getDetalle($id);
        if (!$cita) {
            http_response_code(404);
            exit('Cita no encontrada.');
        }
        $servicios = $app->getServiciosDetalle($id);

      
        include __DIR__ . '/../templates/admin/cita/comprobante.php';
        $html = ob_get_clean();

        (new Pdf())->generar($html, 'cita-' . (int) $id . '.pdf');
        exit;
    }

    include_once __DIR__ . '/../templates/admin/sidebar.html';

    switch ($accion) {
        case 'create':
            if(isset($_POST['enviar'])) {
                try {
                    $citaService->agendar($_POST['data'], $_POST['tipo_registro']);
                    $alerta = ['mensaje' => 'Cita registrada correctamente.', 'tipo' => 'success'];
                    $citas  = $app->getAll();
                    include_once __DIR__ . '/../templates/admin/cita/index.php';
                } catch (ReglaException $e) {
                    $alerta = ['mensaje' => $e->getMessage(), 'tipo' => 'error'];
                    $datos  = $_POST['data'];
                    $datos['accion'] = 'create';
                    $servicios = $appServicio->getAll();
                    $vehiculos = $appVehiculo->getAll();
                    include_once __DIR__ . '/../templates/admin/cita/_form.php';
                }
            } else {
                $servicios = $appServicio->getAll();
                $vehiculos = $appVehiculo->getAll();
                $datos['accion'] = 'create';
                include_once __DIR__ . '/../templates/admin/cita/_form.php'; 
            }
            break;
        case 'update':
            if (isset($_POST['enviar'])) {
                $data = $_POST['data'];    
                $datos = $app->update($id, $data);
                            $citas = $app->getAll();
                include_once __DIR__ . '/../templates/admin/cita/index.php';
            } else {
                $datos = $app -> getOne($id);
                $servicios = $appServicio->getAll();
                $vehiculos = $appVehiculo->getAll();
                $datos['id_servicios'] = $app->getServiciosByCita($id);
                $datos['accion'] = 'update';
                include_once __DIR__ . '/../templates/admin/cita/_form.php'; 
            }
            break;
        case 'delete':
            $afectados = $app->delete($id);
            $citas = $app->getAll();
            include_once __DIR__ . '/../templates/admin/cita/index.php';
            break;
        case 'read':
        default:
            $citas = $app->getAll();
            include_once __DIR__ . '/../templates/admin/cita/index.php';
            break;
    }
    require_once __DIR__ . '/../templates/admin/footer.html';
?>