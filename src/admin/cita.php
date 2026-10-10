<?php 
    include_once __DIR__ . '/models/cita/cita.class.php';

    $app = new Cita();
    $accion = $_GET['accion'] ?? 'read';
    $id = $_GET['id'] ?? null;

    include_once __DIR__ . '/../templates/admin/sidebar.html';

    switch ($accion) {
        case 'create':
            if(isset($_POST['enviar'])) {
                $data = $_POST['data'];
                $datos = $app -> create($data);
                $citas = $app->getAll();
                include_once __DIR__ . '/../templates/admin/cita/index.html';
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
                include_once __DIR__ . '/../templates/admin/cita/index.html';
            } else {
                $datos = $app -> getOne($id);
                $datos['accion'] = 'update';
                include_once __DIR__ . '/../templates/admin/cita/_form.php'; 
            }
            break;
        case 'delete':
            $afectados = $app->delete($id);
            $citas = $app->getAll();
            include_once __DIR__ . '/../templates/admin/cita/index.html';
            break;
        case 'read':
        default:
            $citas = $app->getAll();
            include_once __DIR__ . '/../templates/admin/cita/index.html';
            break;
    }
?>