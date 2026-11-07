<?php 
    ob_start();
    require_once __DIR__ . '/models/cita/cita.class.php';
    require_once __DIR__ . '/models/vehiculo/vehiculo.class.php';
    require_once __DIR__ . '/models/auth/auth.class.php';
    require_once __DIR__ . '/models/servicio/servicios.class.php';
    require_once __DIR__ . '/../helpers/pdf.php';

    $appAuth = new Auth();
    $appAuth -> verificarRol('Administrador');

    $app = new Cita();
    $appVehiculo = new Vehiculo();
    $appServicio = new Servicio();
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
                echo "<pre>";
                print_r($_POST);
                echo "</pre>";
                $data = $_POST['data'];
                if ($_POST["tipo_registro"] === "nuevo") {
                    $app -> createNew($data);
                } else {
                    $app -> createExist($data);
                }   
                 $citas = $app->getAll();
                include_once __DIR__ . '/../templates/admin/cita/index.php';
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
                $id = $_POST['id'] ?? $_GET['id'] ?? null;
                $datos = $app->update($id, $data);
                $citas = $app->getAll();
                include_once __DIR__ . '/../templates/admin/cita/index.php';
            } else {
                $datos = $app -> getOne($id);
                $servicios = $appServicio->getAll();
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