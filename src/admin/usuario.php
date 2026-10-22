<?php
include_once __DIR__ . '/models/usuario/usuario.class.php';
include_once __DIR__ . '/models/usuario/usuario_rol.class.php';
include_once __DIR__ . '/models/rol/rol.class.php';

$app = new Usuario();
$appRol = new Rol();
$appUsuarioRol = new UsuarioRol();
$accion = $_GET['accion'] ?? 'read';
$id = $_GET['id'] ?? null;

include_once __DIR__ . '/../templates/admin/sidebar.html';

switch ($accion) {
    case 'create':
        if (isset($_POST['enviar'])) {
            $data = $_POST['data'];
            $app->create($data);
            $data['id_usuario'] = $app-> getOneByCorreo($data['correo'])['id_usuario'];
            
            $appUsuarioRol->create($data);
            $usuarios = $app->getAll();   
            include_once __DIR__ . '/../templates/admin/usuario/index.php';
        } else {
            $roles = $appRol->getAll();
            $datos['accion'] = 'create';
            include_once __DIR__ . '/../templates/admin/usuario/_form.php';
        }
        break;
    case 'update':
        if (isset($_POST['enviar'])) {
            $data = $_POST['data'];
            $app->update($id, $data);
            $usuarios = $app->getAll();    
            include_once __DIR__ . '/../templates/admin/usuario/index.php';
        } else {
            $datos = $app->getOne($id);
            $datos['accion'] = 'update';
            include_once __DIR__ . '/../templates/admin/usuario/_form.php';
        }
        break;
    case 'delete':
        $afectados = $app->delete($id);
        $usuarios = $app->getAll();
        include_once __DIR__ . '/../templates/admin/usuario/index.php';
        break;
    case 'disable':
        $afectados = $app->disable($id);
        $usuarios = $app->getAll();
        include_once __DIR__ . '/../templates/admin/usuario/index.php';
        break;
    case 'read':
    default:
        $usuarios = $app->getAll();    
        include_once __DIR__ . '/../templates/admin/usuario/index.php';
        break;
}

?>