<?php 
    include_once __DIR__ . '/models/cita/cita.class.php';
    include_once __DIR__ . '/models/vehiculo/vehiculo.class.php';
    include_once __DIR__ . '/models/auth/auth.class.php';

    $appAuth = new Auth();
    $appAuth -> verificarRol('Administrador');

    $app = new Cita();
    $appVehiculo = new Vehiculo();
    $accion = $_GET['accion'] ?? 'read';
    $id = $_GET['id'] ?? null;

    include_once __DIR__ . '/../templates/admin/sidebar.html';

    $vehiculos = $appVehiculo->getAll();

    switch ($accion) {
        case 'create':
            if(isset($_POST['enviar'])) {
                $data = $_POST['data'];
                $datos = $app -> create($data);
                $citas = $app->getAll();
                include_once __DIR__ . '/../templates/admin/cita/index.php';
            } else {
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