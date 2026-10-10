<?php 
    include_once __DIR__ . '/models/servicio/servicios.class.php';

    $app = new Servicio();
    $accion = $_GET['accion'] ?? 'read';
    $id = $_GET['id'] ?? null;

    include_once __DIR__ . '/../templates/admin/sidebar.html';

    switch ($accion) {
        case 'create':
            if(isset($_POST['enviar'])) {
                $data = $_POST['data'];
                $datos = $app -> create($data);
                $servicios = $app->getAll();
                include_once __DIR__ . '/../templates/admin/servicio/index.html';
            } else {
                $datos['accion'] = 'create';
                include_once __DIR__ . '/../templates/admin/servicio/_form.php'; 
            }
            break;
        case 'update':
            if (isset($_POST['enviar'])) {
                $data = $_POST['data'];
                $id = $_POST['id'] ?? $_GET['id'] ?? null;
                $datos = $app->update($id, $data);
                $servicios = $app->getAll();
                include_once __DIR__ . '/../templates/admin/servicio/index.html';
            } else {
                $datos = $app -> getOne($id);
                $datos['accion'] = 'update';
                include_once __DIR__ . '/../templates/admin/servicio/_form.php'; 
            }
            break;
        case 'delete':
            $afectados = $app->delete($id);
            $servicios = $app->getAll();
            include_once __DIR__ . '/../templates/admin/servicio/index.html';
            break;
        case 'read':
        default:
            $servicios = $app->getAll();
            include_once __DIR__ . '/../templates/admin/servicio/index.html';
            break;
           
    }

    include_once __DIR__ . '/../templates/admin/footer.html';
?>