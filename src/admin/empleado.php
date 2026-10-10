<?php
    include_once __DIR__ . '/models/empleado/empleado.class.php';

    $app = new Empleado();
    $accion = $_GET['accion'] ?? 'read';
    $id = $_GET['id'] ?? null;

    include_once __DIR__ . '/../templates/admin/sidebar.html';

    switch ($accion) {
        case 'create':
            if(isset($_POST['enviar'])) {
                $data = $_POST['data'];
                $datos = $app -> create($data);
                $empleados = $app->getAll();
                include_once __DIR__ . '/../templates/admin/empleado/index.html';
            } else {
                $datos['accion'] = 'create';
                include_once __DIR__ . '/../templates/admin/empleado/_form.php'; 
            }
            break;
        case 'update':
            if (isset($_POST['enviar'])) {
                $data = $_POST['data'];
                $id = $_POST['id'] ?? $_GET['id'] ?? null;
                $datos = $app->update($id, $data);
                $empleados = $app->getAll();
                include_once __DIR__ . '/../templates/admin/empleado/index.html';
            } else {
                $datos = $app -> getOne($id);
                $datos['accion'] = 'update';
                include_once __DIR__ . '/../templates/admin/empleado/_form.php'; 
            }
            break;
        case 'delete':
            $afectados = $app->delete($id);
            $empleados = $app->getAll();
            include_once __DIR__ . '/../templates/admin/empleado/index.html';
            break;
        case 'read':
        default:
            $empleados = $app->getAll();
            include_once __DIR__ . '/../templates/admin/empleado/index.html';
            break;
           
    }
?>