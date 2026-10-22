<?php
include_once __DIR__ . '/models/rol/rol.class.php';

$app = new Rol();
$accion = $_GET['accion'] ?? 'read';
$id = $_GET['id'] ?? null;

include_once __DIR__ . '/../templates/admin/sidebar.html';

switch($accion){
    case 'create':
        if(isset($_POST['enviar'])){
            $data = $_POST['data'];
            $app->create($data);
            $roles = $app->getAll();
            include_once __DIR__ . '/../templates/admin/rol/index.php';
        }else{
            $datos['accion'] = 'create';
            include_once __DIR__ . '/../templates/admin/rol/_form.php';
        }
        break;
    case 'update':
        if(isset($_POST['enviar'])){
            $data = $_POST['data'];
            $id = $_POST['id'] ?? $_GET['id'] ?? null;
            $datos = $app->update($id, $data);
            $roles = $app->getAll();
            include_once __DIR__ . '/../templates/admin/rol/index.php';
        }else{
            $datos = $app->getOne($id);
            $datos['accion'] = 'update';
            include_once __DIR__ . '/../templates/admin/rol/_form.php';
        }
        break;
    case 'delete':
        $afectados = $app->delete($id);
        $roles = $app->getAll();
        include_once __DIR__ . '/../templates/admin/rol/index.php';
        break;
    case 'read':
    default:
        $roles = $app->getAll();
        include_once __DIR__ . '/../templates/admin/rol/index.php';
        break;
}

?>