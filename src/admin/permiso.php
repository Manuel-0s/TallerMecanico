<?php
require_once __DIR__ . '/models/permiso/permiso.class.php';

$app = new Permiso();
$accion = $_GET['accion'] ?? 'read';
$id = $_GET['id'] ?? null;

require_once __DIR__ . '/../templates/admin/sidebar.html';

switch ($accion) {
    case 'create':
        if (isset($_POST['enviar'])) {
            $data = $_POST['data'];
            $app->create($data);
            $permisos = $app->getAll();
            include_once __DIR__ . '/../templates/admin/permiso/index.php';
        } else {
            $datos['accion'] = 'create';
            include_once __DIR__ . '/../templates/admin/permiso/_form.php';
        }
        break;
    case 'update':
        if (isset($_POST['enviar'])) {
            $data = $_POST['data'];
            $app->update($id, $data);
            $permisos = $app->getAll();
            include_once __DIR__ . '/../templates/admin/permiso/index.php';
        } else {
            $datos = $app->getOne($id);
            $datos['accion'] = 'update';
            include_once __DIR__ . '/../templates/admin/permiso/_form.php';
        }
        break;
    case 'delete':
        $afectados = $app->delete($id);
        $permisos = $app->getAll();
        include_once __DIR__ . '/../templates/admin/permiso/index.php';
        break;
    case 'read':
    default:
        $permisos = $app->getAll();
        include_once __DIR__ . '/../templates/admin/permiso/index.php';
        break;
}

 require_once __DIR__ . '/../templates/admin/footer.html';
?>