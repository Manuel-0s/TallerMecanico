<?php 
    include_once __DIR__ . '/models/vehiculo/vehiculo.class.php';
    include_once __DIR__ . '/models/cliente/cliente.class.php';
    include_once __DIR__ . '/models/auth/auth.class.php';

    $appAuth = new Auth();
    $appAuth -> verificarRol('Empleado');

    $app = new Vehiculo();
    $appCliente = new Cliente();
    $accion = $_GET['accion'] ?? 'read';
    $id = $_GET['id'] ?? null;

    include_once __DIR__ . '/../templates/admin/sidebar.html';

    $clientes = $appCliente->getAll();

    switch ($accion) {
        case 'create':
            if(isset($_POST['enviar'])) {
                $data = $_POST['data'];
                $datos = $app -> create($data);
                $vehiculos = $app->getAll();
                include_once __DIR__ . '/../templates/admin/vehiculo/index.php';
            } else {
                $datos['accion'] = 'create';
                include_once __DIR__ . '/../templates/admin/vehiculo/_form.php'; 
            }
            break;
        case 'update':
            if (isset($_POST['enviar'])) {
                $data = $_POST['data'];
                $id = $_POST['id'] ?? $_GET['id'] ?? null;
                $datos = $app->update($id, $data);
                $vehiculos = $app->getAll();
                include_once __DIR__ . '/../templates/admin/vehiculo/index.php';
            } else {
                $datos = $app -> getOne($id);
                $datos['accion'] = 'update';
                include_once __DIR__ . '/../templates/admin/vehiculo/_form.php'; 
            }
            break;
        case 'delete':
            $afectados = $app->delete($id);
            $vehiculos = $app->getAll();
            include_once __DIR__ . '/../templates/admin/vehiculo/index.php';
            break;
        case 'read':
        default:
            $vehiculos = $app->getAll();
            include_once __DIR__ . '/../templates/admin/vehiculo/index.php';
            break;
           
    }
    include_once __DIR__ . '/../templates/admin/footer.html';
?>