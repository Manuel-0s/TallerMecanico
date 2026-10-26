<?php 
    include_once __DIR__ . '/models/servicio/servicios.class.php';
    include_once __DIR__ . '/../helpers/fileUploader.php';

    $app = new Servicio();
    $uploader = new FileUploader();
    $accion = $_GET['accion'] ?? 'read';
    $id = $_GET['id'] ?? null;

    include_once __DIR__ . '/../templates/admin/sidebar.html';

    switch ($accion) {
        case 'create':
            if(isset($_POST['enviar'])) {
                $data = $_POST['data'];
                $data['imagen'] = $uploader->cargarArchivo(
                    'imagen',
                    __DIR__ . '/../assets/images/uploads'
                );
                $datos = $app -> create($data);
                $servicios = $app->getAll();
                include_once __DIR__ . '/../templates/admin/servicio/index.php';
            } else {
                $datos['accion'] = 'create';
                include_once __DIR__ . '/../templates/admin/servicio/_form.php';
            }
            break;
        case 'update':
            if (isset($_POST['enviar'])) {
                $data = $_POST['data'];
                $id = $_POST['id'] ?? $_GET['id'] ?? null;
                $imagen = $uploader->cargarArchivo(
                    'imagen',
                    __DIR__ . '/../assets/images/uploads'
                );
                $data['imagen'] = $imagen ?? ($app->getOne($id)['imagen'] ?? null);
                $datos = $app->update($id, $data);
                $servicios = $app->getAll();
                include_once __DIR__ . '/../templates/admin/servicio/index.php';
            } else {
                $datos = $app -> getOne($id);
                $datos['accion'] = 'update';
                include_once __DIR__ . '/../templates/admin/servicio/_form.php'; 
            }
            break;
        case 'delete':
            $afectados = $app->delete($id);
            $servicios = $app->getAll();
            include_once __DIR__ . '/../templates/admin/servicio/index.php';
            break;
        case 'read':
        default:
            $servicios = $app->getAll();
            include_once __DIR__ . '/../templates/admin/servicio/index.php';
            break;
           
    }

    include_once __DIR__ . '/../templates/admin/footer.html';
?>